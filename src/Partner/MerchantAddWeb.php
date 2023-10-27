<?php

namespace Violetshih\NewebPay\Partner;
use Violetshih\NewebPay\BaseNewebPay;
use Violetshih\NewebPay\Concerns\HasMerchantData;

class MerchantAddWeb extends BaseNewebPay
{
    use HasMerchantData;

    /**
     * The newebpay boot hook.
     *
     * @return void
     */
    public function boot()
    {
        $this->setApiPath('API/AddMerchantWeb');
        $this->setVersion("1.7");
        $this->setSyncSender();
        $this->setReturnURL();
        $this->setNotifyURL();

        $this->setAgreedFee();
        $this->setAgreedDay();
        $this->setCreditAutoType();
        $this->setCreditLimit();
        $this->setWithdraw();
        $this->setWithdrawMer();
        $this->setWithdrawSetting();
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
