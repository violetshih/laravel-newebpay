<?php

namespace Violetshih\NewebPay\Partner;
use Violetshih\NewebPay\BaseNewebPay;
use Violetshih\NewebPay\Concerns\HasMerchantData;
use Violetshih\NewebPay\Concerns\HasMemberData;
class MerchantModify extends BaseNewebPay
{
    use HasMerchantData,HasMemberData;
    /**
     * The newebpay boot hook.
     *
     * @return void
     */
    public function boot()
    {
        $this->setApiPath('API/AddMerchant/modify');
        $this->setPartnerVersion("1.6");
        $this->setAsyncSender();
        $this->setDecodeMode("partner");

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
