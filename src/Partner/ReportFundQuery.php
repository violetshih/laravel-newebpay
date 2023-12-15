<?php

namespace Violetshih\NewebPay\Partner;
use Violetshih\NewebPay\BaseNewebPay;
use Violetshih\NewebPay\Concerns\HasMerchantData;

class ReportFundQuery extends BaseNewebPay
{
    use HasMerchantData;
    protected $CheckValues;
    protected $hasVersion;
    /**
     * The newebpay boot hook.
     *
     * @return void
     */
    public function boot()
    {
        $this->setApiPath('API/ReportFund/Query');
        $this->setPartnerVersion("1.1");
        $this->setAsyncSender();
        $this->setDecodeMode("partner");
    }
    public function setQuery($MerchantID, $FundTime)
    {
        $this->CheckValues['MerchantID'] = $MerchantID;
        $this->CheckValues['FundTime'] = $FundTime;

        return $this;
    }
    public function allowVersion($allowVersion)
    {
        $this->hasVersion = $allowVersion;

        return $this;
    }
    /**
     * Get request data.
     *
     * @return array
     */
    public function getRequestData()
    {
        $this->CheckValues['TimeStamp'] = $this->timestamp;

        $CheckValue = $this->queryCheckValue2($this->CheckValues, $this->HashKey, $this->HashIV);
        $postData =  [
            'MerchantID' =>  $this->CheckValues['MerchantID'],
            'FundTime' => $this->CheckValues['FundTime'],
            'CheckValue' => $CheckValue,
            'TimeStamp' => $this->timestamp
        ];
        if($this->hasVersion){
            $postData ["Version"] = $this->MerchantData['Version'];
        }
        return $postData;
    }
}
