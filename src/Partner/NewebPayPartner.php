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
     * @param  string  $merchantID 要修改的合作商店代號
   
     * @return \Violetshih\NewebPay\Partner\MerchantModify
     */
    public function MerchantModify($merchantID)
    {
        $newebPay = new MerchantModify($this->config);
        $newebPay->setMerchantID($merchantID);
        return $newebPay;
    }

    /**
     * 新增合作商店資料Web
     *
     * @param  string  $newMerchantID 自定義商店代號
     * 格式為金流合作推廣商代號(3 碼， 限為大寫英文字)+自訂編號(最長 12 碼，限為數字)。
     * @return \Violetshih\NewebPay\Partner\MerchantAddWeb
     */
    public function MerchantAddWeb($newMerchantID)
    {
        $newebPay = new MerchantAddWeb($this->config);
        $newebPay->setMerchantID($newMerchantID);
        return $newebPay;
    }
 /**
     * 查詢合作商店資料
     *
     * @param  string  $merchantID 查詢目標的商店代號
     * @return \Violetshih\NewebPay\Partner\Checkshopopen
     */
    public function Checkshopopen($merchantID)
    {
        $newebPay = new Checkshopopen($this->config);
        $newebPay->setMerchantID($merchantID);
        return $newebPay;
    }
      /**
     * 撥款指示
     *
     * @param  string  $merchantID 合作商店代號
     * @param  string  $no 訂單編號
     * @param  string  $amt 請款金額

     * @return \Violetshih\NewebPay\Partner\ExportInstruct
     */
    public function ExportInstruct($merchantID,$no, $amt)
    {
        $newebPay = new ExportInstruct($this->config);
        $newebPay->setMerchantID($merchantID);
        $newebPay->setOrder($no, $amt);
        return $newebPay;
    }
      /**
     * 帳務明細查詢
     *
     * @param  string  $merchantID 合作商店代號
     * @param  string  $fundTime 撥款日期
     * @param  string  $allowVersion true=平台方，false=商店自己

     * @return \Violetshih\NewebPay\Partner\ReportFundQuery
     */
    public function ReportFundQuery($merchantID,$fundTime,$allowVersion = true )
    {
        $newebPay = new ReportFundQuery($this->config);
        $newebPay->setQuery($merchantID,$fundTime);
        $newebPay->allowVersion($allowVersion);
        
        return $newebPay;
    }
}
