<?php

namespace Violetshih\NewebPay\Partner;

use Throwable;
use Violetshih\NewebPay\Exceptions\NewebpayDecodeFailException;
use Violetshih\NewebPay\BaseNewebPay;

class NewebPayPartner extends BaseNewebPay
{
  

    /*------平台商------*/
    /**
     * 修改合作商店資料
     *
     * @param  string  $tradedata_merchant_id 要修改的合作商店代號
   
     * @return \Violetshih\NewebPay\Partner\MerchantModify
     */
    public function MerchantModify($tradedata_merchant_id)
    {
        $newebPay = new MerchantModify($this->config);
        $newebPay->setTradeDataMerchantID($tradedata_merchant_id);
        return $newebPay;
    }

    /**
     * 新增合作商店資料Web
     *
     * @param  string  $newMerchantID 自定義商店代號
     * 格式為金流合作推廣商代號(3 碼， 限為大寫英文字)+自訂編號(最長 12 碼，限為數字)。
     * @return \Violetshih\NewebPay\Partner\MerchantModify
     */
    public function MerchantAddWeb($newMerchantID)
    {
        $newebPay = new MerchantAdd($this->config);
        $newebPay->setMerchantID($newMerchantID);
        return $newebPay;
    }
}
