<?php

namespace Violetshih\NewebPay;

use Throwable;
use Violetshih\NewebPay\Exceptions\MerchantModify;

class NewebPayPartner extends BaseNewebPay
{
  

    /*------平台商------*/
    /**
     * 修改合作商店資料
     *
     * @param  string  $tradedata_merchant_id 要修改的合作商店代號
   
     * @return \Violetshih\NewebPay\MerchantModify
     */
    public function MerchantModify($tradedata_merchant_id)
    {
        $newebPay = new MerchantModify($this->config);
        $newebPay->setTradeDataMerchantID($tradedata_merchant_id);
        return $newebPay;
    }
}
