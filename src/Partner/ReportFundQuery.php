<?php

namespace Violetshih\NewebPay\Partner;
use Violetshih\NewebPay\BaseNewebPay;
use Violetshih\NewebPay\Concerns\HasMerchantData;

class ReportFundQuery extends BaseNewebPay
{
    use HasMerchantData;
    protected $CheckValues;
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
    /**
     * Get request data.
     *
     * @return array
     */
    public function getRequestData()
    {
        $this->CheckValues['TimeStamp'] = $this->timestamp;

        $CheckValue = $this->queryCheckValue($this->CheckValues, $this->PartnerHashKey, $this->PartnerHashIV);
        return [
            'MerchantID' =>  $this->CheckValues['MerchantID'],
            'FundTime' => $this->CheckValues['FundTime'],
            'CheckValue' => $CheckValue,
            'TimeStamp' => $this->timestamp,
            'Version' => $this->MerchantData['Version']
        ];
    }
}
