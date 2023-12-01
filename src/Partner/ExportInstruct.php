<?php

namespace Violetshih\NewebPay\Partner;
use Violetshih\NewebPay\BaseNewebPay;
use Violetshih\NewebPay\Concerns\HasMerchantData;

class ExportInstruct extends BaseNewebPay
{
    use HasMerchantData;

    /**
     * The newebpay boot hook.
     *
     * @return void
     */
    public function boot()
    {
        $this->setApiPath('API/ExportInstruct');
        $this->setPartnerVersion("1.0");
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
            'PostData_' => $postData
        ];
    }
}
