<?php

namespace Violetshih\NewebPay\Partner;
use Violetshih\NewebPay\BaseNewebPay;
use Violetshih\NewebPay\Concerns\HasMerchantData;

class MerchantModify extends BaseNewebPay
{
    use HasMerchantData;
    /**
     * The newebpay boot hook.
     *
     * @return void
     */
    public function boot()
    {
        $this->setApiPath('API/AddMerchant/modify');
        $this->setVersion("1.6");
        $this->setAsyncSender();
        $this->setDecodeMode("partner");

        $this->switchMerchant( $this->PartnerID, $this->PartnerHashKey, $this->PartnerHashIV);
    }
    /**
     * Get request data.
     *
     * @return array
     */
    public function getRequestData()
    {
        $postData = $this->encryptDataByAES($this->MerchantData, $this->PartnerHashKey, $this->PartnerHashIV);

        return [
            'PartnerID_' => $this->PartnerID,
            'PostData_' => $postData,
        ];
    }
}
