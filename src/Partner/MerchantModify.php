<?php

namespace Violetshih\NewebPay\Partner;
use Violetshih\NewebPay\BaseNewebPay;

class MerchantModify extends BaseNewebPay
{
    /**
     * The newebpay boot hook.
     *
     * @return void
     */
    public function boot()
    {
        $this->setApiPath('API/AddMerchant/modify');
        $this->setVersion("1.7");
        $this->setAsyncSender();
        $this->switchMerchant( $this->PartnerID, $this->PartnerHashKey, $this->PartnerHashIV);
    }
    
    public function updateAgreedFee($data)
    {
       
        $this->setAgreedFee($data );
        return $this;
    }
    public function updatePaymentType($data)
    {
       
        $this->setPaymentType($data );
        return $this;
    }
    public function updateAgreedDay($data)
    {
       
        $this->setAgreedDay($data );
        return $this;
    }
    /**
     * Get request data.
     *
     * @return array
     */
    public function getRequestData()
    {
        $postData = $this->encryptDataByAES($this->TradeData, $this->HashKey, $this->HashIV);

        return [
            'PartnerID_' => $this->PartnerID,
            'PostData_' => $postData,
        ];
    }
}
