<?php

namespace Violetshih\NewebPay;

use Carbon\Carbon;
use Illuminate\Contracts\Config\Repository as Config;

abstract class BaseNewebPay
{
    use Concerns\HasEncryption,
        Concerns\HasSender,
        Concerns\HasTradeData;

    /**
     * The config instance.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * The newebpay MerchantID.
     *
     * @var string
     */
    protected $MerchantID;

     /**
     * The newebpay PartnerID. 平台商推廣代號
     *
     * @var string
     */
    protected $PartnerID;

    /**
     * The newebpay HashKey.
     *
     * @var string
     */
    protected $HashKey;

    /**
     * The newebpay HashIV.
     *
     * @var string
     */
    protected $HashIV;

    /**
     * The newebpay URL.
     *
     * @var string
     */
    protected $url;

    /**
     * The newebpay production base URL.
     *
     * @var string
     */
    protected $productionUrl = 'https://core.newebpay.com/';

    /**
     * The newebpay test base URL.
     *
     * @var string
     */
    protected $testUrl = 'https://ccore.newebpay.com/';

    /**
     * Now timestamp.
     *
     * @var int
     */
    protected $timestamp;

    /**
     * Create a new base newebpay instance.
     *
     * @param  \Illuminate\Contracts\Config\Repository  $config
     * @return void
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->PartnerID = $this->config->get('newebpay.PartnerID');
        $this->MerchantID = $this->config->get('newebpay.MerchantID');
        $this->HashKey = $this->config->get('newebpay.HashKey');
        $this->HashIV = $this->config->get('newebpay.HashIV');

        $this->setTimestamp();
        $this->setVersion();
        $this->setRespondType();
        $this->boot();
    }

    /**
     * The newebpay boot hook.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Generate the newebpay full URL.
     *
     * @param  string  $path
     * @return string
     */
    public function generateUrl($path)
    {
        return ($this->config->get('newebpay.Debug') ? $this->testUrl : $this->productionUrl) . $path;
    }

    /**
     * Get the newebpay full URL.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the newebpay API path.
     *
     * @param  string  $path
     * @return self
     */
    public function setApiPath($path)
    {
        $this->url = $this->generateUrl($path);

        return $this;
    }

    public function switchMerchant($merchantID,$hashkey,$hashiv,$switch_tradedata_also = true)
    {
        
        $this->MerchantID = $merchantID;
        $this->HashKey = $hashkey;
        $this->HashIV = $hashiv;
        if($switch_tradedata_also){
            $this->TradeData['MerchantID'] = $merchantID;
        }
        return $this;
    }

    public function resetDefaultMerchant($switch_tradedata_also = true)
    {
        
        $this->MerchantID = $this->config->get('newebpay.MerchantID');
        $this->HashKey = $this->config->get('newebpay.HashKey');
        $this->HashIV = $this->config->get('newebpay.HashIV');
        if($switch_tradedata_also){
            $this->TradeData['MerchantID'] = $this->config->get('newebpay.MerchantID');

        }

        return $this;
    }
    public function setTradeDataMerchantID($mid)
    {
        $this->TradeData['MerchantID'] = $mid;
        return $this;
    }
    /**
     * Get request data.
     *
     * @return array
     */
    public function getRequestData()
    {
        return [];
    }

    /**
     * Submit data to newebpay API.
     *
     * @return mixed
     */
    public function submit()
    {
        return $this->sender->send($this->getRequestData(), $this->url);
    }

    /**
     * 解碼加密字串
     *
     * @param  string  $encryptString
     * @return mixed
     *
     * @throws \Violetshih\NewebPay\Exceptions\NewebpayDecodeFailException
     */
    public function decode($encryptString)
    {
        try {
            $decryptString = $this->decryptDataByAES($encryptString, $this->HashKey, $this->HashIV);

            return json_decode($decryptString, true);
        } catch (Throwable $e) {
            throw new NewebpayDecodeFailException($e, $encryptString);
        }
    }

    public function submitAndDecode( $key ){
        $encryptString = $this->submit();
        return $this->decode($encryptString[$key]);
    }
}
