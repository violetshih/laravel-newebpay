<?php

namespace Violetshih\NewebPay;

class NewebPayPlatformMerchantModify extends BaseNewebPay
{
    /**
     * The newebpay boot hook.
     *
     * @return void
     */
    public function boot()
    {
        $this->setApiPath('API/AddMerchant/modify');
        $this->setAsyncSender();

        $this->TradeData['MerchantID'] = $this->MerchantID;
    }
     /**
     * setPaymentType
     * ['Credit'=>1,GooglePay=>1]
     * @return \Violetshih\NewebPay\NewebPayPlatformMerchantModify
     */
    public function updatePaymentType($data)
    {
        $list = [];
        foreach ($data as $method => $is_open) {
            $text = $method.":".$is_open;
            array_push($list,$text);
        }
        $result = implode(', ', $list);
        $this->setPaymentType($result );
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
            'MerchantID_' => $this->MerchantID,
            'PostData_' => $postData,
        ];
    }
}
