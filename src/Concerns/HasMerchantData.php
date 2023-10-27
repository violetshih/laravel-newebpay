<?php

namespace Violetshih\NewebPay\Concerns;

use Illuminate\Support\Carbon;

trait HasMerchantData
{
    /**
     * The newebpay trade data.
     *
     * @var array
     */
    protected $MerchantData = [];
    protected function _format($conf)
    {
       
        if($conf) {
            $list = [];
            foreach ($conf as $method => $value) {
                $text = $method.":".$value;
                array_push($list,$text);
            }
            return  implode('|', $list);
        }
        return null;
    }
    /**
     * Get the newebpay MerchantData.
     *
     * @return array
     */
    public function getMerchantData()
    {
        return $this->MerchantData;
    }
    
    /**
     * Set now timestamp.
     *
     * @return self
     */
    public function setTimestamp()
    {
        $this->timestamp = Carbon::now()->timestamp;
        $this->MerchantData['TimeStamp'] = $this->timestamp;

        return $this;
    }

    /**
     * 串接版本
     *
     * @param  string|null  $version
     * @return self
     */
    public function setPartnerVersion($version)
    {
        $this->MerchantData['Version'] = $version ;

        return $this;
    }

    /**
     * 回傳格式
     *
     * Support types: "JSON", "String"
     *
     * @param  string|null  $type
     * @return self
     */
    public function setRespondType($type = null)
    {
        $this->MerchantData['RespondType'] = $type ?? $this->config->get('newebpay.RespondType');

        return $this;
    }

    

    
    /**
     * 付款完成後導向頁面
     *
     * 僅接受 port 80 or 443
     *
     * @param  string|null  $url
     * @return self
     */
    public function setReturnURL($url = null)
    {
        $this->MerchantData['ReturnURL'] = $url ?? $this->config->get('newebpay.PartnerReturnURL');

        return $this;
    }

    /**
     * 付款完成後的通知連結
     *
     * 以幕後方式回傳給商店相關支付結果資料
     * 僅接受 port 80 or 443
     *
     * @param  string|null  $url
     * @return self
     */
    public function setNotifyURL($url = null)
    {
        $this->MerchantData['NotifyURL'] = $url ?? $this->config->get('newebpay.PartnerNotifyURL');

        return $this;
    }

    public function setAgreedFee($val = null)
    {
        $val  = $val ?? $this->config->get('newebpay.AgreedFee');
        $this->MerchantData['AgreedFee'] =  $this->_format($val);
        return $this;
    }

    public function setMerchantID($val )
    {
        $this->MerchantData['MerchantID'] = $val ;

        return $this;
    }

    public function setAgreedDay($val = null)
    {
        $val  = $val ?? $this->config->get('newebpay.AgreedDay');
        $this->MerchantData['AgreedDay'] =  $this->_format($val);
        return $this;
    }

    public function setCreditAutoType($val = null)
    {
        $this->MerchantData['CreditAutoType'] = $val ?? $this->config->get('newebpay.CreditAutoType');

        return $this;
    }

    public function setCreditLimit($val = null)
    {
        $this->MerchantData['CreditLimit'] = $val ?? $this->config->get('newebpay.CreditLimit');

        return $this;
    }
    /**
     * 啟用支付方式
     * 以陣列輸入['CSV'=>1,'CREDIT=>0']
     * 轉換成 CVS:1|CREDIT:0 表示設定超商代 碼繳費預設為啟用，信用卡預設為不 啟用
     *
     * @param  array|null  $val
     * @return self
     */
    public function setPaymentType($val = null)
    {
        $val  = $val ?? $this->config->get('newebpay.PaymentType');
       
        $this->MerchantData['PaymentType'] =  $this->_format($val);
        return $this;
    }

    public function setWithdraw($val = null)
    {
        $this->MerchantData['Withdraw'] = $val ?? $this->config->get('newebpay.Withdraw');

        return $this;
    }

    public function setWithdrawMer($val = null)
    {
        $this->MerchantData['WithdrawMer'] = $val ?? $this->config->get('newebpay.WithdrawMer');

        return $this;
    }

    public function setWithdrawSetting($val = null)
    {
        $this->MerchantData['WithdrawSetting'] = $val ?? $this->config->get('newebpay.WithdrawSetting');

        return $this;
    }

   
}
