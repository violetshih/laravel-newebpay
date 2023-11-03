<?php

namespace Violetshih\NewebPay\Partner;
use Violetshih\NewebPay\BaseNewebPay;
use Violetshih\NewebPay\Concerns\HasMerchantData;

class Checkshopopen extends BaseNewebPay
{
    use HasMerchantData;

    /**
     * The newebpay boot hook.
     *
     * @return void
     */
    public function boot()
    {
        $this->setApiPath('API/Checkshopopen');
        $this->setPartnerVersion("1.1");
        $this->setAsyncSender();
    }
    
    /**
     * Get request data.
     *
     * @return array
     */
    public function getRequestData()
    {
        $postData = $this->encryptDataByAES($this->MerchantData, $this->PartnerHashKey, $this->PartnerHashIV);
        $hashData = $this->encryptDataBySHA($postData,$this->PartnerHashKey, $this->PartnerHashIV);
        return [
            'UID_' => $this->PartnerID,
            'EncryptData_' => $postData,
            'HashData_' => $hashData,
            'Version_' => $this->MerchantData['Version']
        ];
    }
}
