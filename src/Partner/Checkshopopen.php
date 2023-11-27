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
        $this->setDecodeMode("partner");
    }
    /**
     * format response data.
     *
     * @return array
     */
    public function transformResultData($data)
    {
        $result = [];
        foreach ($data as $key => $value) {
            $data[$key] = explode('|', $value);
            $result[$key] = count($data[$key] ) == 1? $value : [];
            
        }
        // ----member---------
        switch ($data["MemberState"][0]) {
            
            case "01":
                $result["MemberState"] = "已驗證";
                break;
            case "02":
                $result["MemberState"] = "未驗證";
                break;
            case "03":
                $result["MemberState"] = "請重新上傳影像檔";
                break;
            case "04":
                $result["MemberState"] = "請修改資料";
                break;
            case "05":
                $result["MemberState"] = "請修改資料並重新上傳影像檔";
                break;
            case "06":
                $result["MemberState"] = "異動申請需補件";
                break;
            case "07":
                $result["MemberState"] = "異動申請審核中";
                break;
            case "08":
                $result["MemberState"] = "異動申請審核未通過";
                break;
            case "09":
                $result["MemberState"] = "撤銷申請";
                break;
            case "10":
                $result["MemberState"] = "暫時停權";
                break;
            case "11":
                $result["MemberState"] = "永久停權";
                break;
            default:
                $result["MemberState"] = $data["MemberState"][0];
                break;
        }
        switch ($data["MerchantState"][0]) {
            
            case "01":
                $result["MerchantState"] = "審核通過";
                break;
            case "02":
                $result["MerchantState"] = "需補件";
                break;
            case "03":
                $result["MerchantState"] = "永久拒絕";
                break;
            case "04":
                $result["MerchantState"] = "待審核";
                break;
            case "05":
                $result["MerchantState"] = "暫存未建店";
                break;
            case "06":
                $result["MerchantState"] = "關閉中";
                break;
           
            default:
                $result["MerchantState"] = $data["MerchantState"][0];
                break;
        }
        // ----CREDIT---------
        $result["CREDIT"]["name"] = "信用卡";
        switch ($data["CREDIT"][0]) {
            case "0":
                $result["CREDIT"]["status"] = "未啟用";
                break;
            case "1":
                $result["CREDIT"]["status"] = "啟用";
                break;
            case "2":
                $result["CREDIT"]["status"] = "會員隱藏";
                break;
            case "3":
                $result["CREDIT"]["status"] = "申請中";
                break;
            case "4":
                $result["CREDIT"]["status"] = "暫時拒絕";
                break;
            case "5":
                $result["CREDIT"]["status"] = "關閉";
                break;
            case "7":
                $result["CREDIT"]["status"] = "永久拒絕";
                break;
            default:
                $result["CREDIT"]["status"] = $data["CREDIT"][0];
                break;
        }
        $result["CREDIT"]["note"] = $data["CREDIT"][1];
        switch ($data["CREDIT"][2]) {
            case "0":
                $result["CREDIT"]["is3D"] = "非3D";
                break;
            case "1":
                $result["CREDIT"]["is3D"] = "3D";
                break;
            case "2":
                $result["CREDIT"]["is3D"] = "強制3D";
                break;
            default:
                $result["CREDIT"]["is3D"] = $data["CREDIT"][2];
                break;
        }
        $result["CREDIT"]["AgreedDay"] = $data["CREDIT"][3];
        $result["CREDIT"]["AgreedFee"] = $data["CREDIT"][4];

        // ----APPLEPAY---------
        $result["APPLEPAY"]["name"] = "APPLEPAY";
        switch ($data["APPLEPAY"][0]) {
            case "0":
                $result["APPLEPAY"]["status"] = "未啟用";
                break;
            case "1":
                $result["APPLEPAY"]["status"] = "啟用";
                break;
            case "2":
                $result["APPLEPAY"]["status"] = "會員隱藏";
                break;
            case "3":
                $result["APPLEPAY"]["status"] = "申請中";
                break;
            case "4":
                $result["APPLEPAY"]["status"] = "拒絕";
                break;
            case "5":
                $result["APPLEPAY"]["status"] = "關閉";
                break;
            default:
                $result["APPLEPAY"]["status"] = $data["APPLEPAY"][0];
                break;
        }
        $result["APPLEPAY"]["note"] = $data["APPLEPAY"][1];

        // ----GOOGLEPAY---------
        $result["GOOGLEPAY"]["name"] = "GOOGLEPAY";
        switch ($data["GOOGLEPAY"][0]) {
            case "0":
                $result["GOOGLEPAY"]["status"] = "未啟用";
                break;
            case "1":
                $result["GOOGLEPAY"]["status"] = "啟用";
                break;
            case "2":
                $result["GOOGLEPAY"]["status"] = "會員隱藏";
                break;
            case "3":
                $result["GOOGLEPAY"]["status"] = "申請中";
                break;
            case "4":
                $result["GOOGLEPAY"]["status"] = "拒絕";
                break;
            case "5":
                $result["GOOGLEPAY"]["status"] = "關閉";
                break;
            default:
                $result["GOOGLEPAY"]["status"] = $data["GOOGLEPAY"][0];
                break;
        }
        $result["GOOGLEPAY"]["note"] = $data["GOOGLEPAY"][1];

        // ----SAMSUNGPAY---------
        $result["SAMSUNGPAY"]["name"] = "SAMSUNGPAY";
        switch ($data["SAMSUNGPAY"][0]) {
            case "0":
                $result["SAMSUNGPAY"]["status"] = "未啟用";
                break;
            case "1":
                $result["SAMSUNGPAY"]["status"] = "啟用";
                break;
            case "2":
                $result["SAMSUNGPAY"]["status"] = "會員隱藏";
                break;
            case "3":
                $result["SAMSUNGPAY"]["status"] = "申請中";
                break;
            case "4":
                $result["SAMSUNGPAY"]["status"] = "拒絕";
                break;
            case "5":
                $result["SAMSUNGPAY"]["status"] = "關閉";
                break;
            default:
                $result["SAMSUNGPAY"]["status"] = $data["SAMSUNGPAY"][0];
                break;
        }
        $result["SAMSUNGPAY"]["note"] = $data["SAMSUNGPAY"][1];

        // ----CREDITINS 信用卡分期---------
        $result["CREDITINS"]["name"] = "信用卡分期";
        switch ($data["CREDITINS"][0]) {
            case "0":
                $result["CREDITINS"]["status"] = "未啟用";
                break;
            case "1":
                $result["CREDITINS"]["status"] = "啟用";
                break;
            case "2":
                $result["CREDITINS"]["status"] = "會員隱藏";
                break;
            case "3":
                $result["CREDITINS"]["status"] = "申請中";
                break;
            case "4":
                $result["CREDITINS"]["status"] = "拒絕";
                break;
            case "5":
                $result["CREDITINS"]["status"] = "關閉";
                break;
            default:
                $result["CREDITINS"]["status"] = $data["CREDITINS"][0];
                break;
        }
        $result["CREDITINS"]["note"] = $data["CREDITINS"][1];
        $result["CREDITINS"]["AgreedDay"] = $data["CREDITINS"][2];
        $result["CREDITINS"]["AgreedFee"] = "分3期：".$data["CREDITINS"][3]." | 分6期：".$data["CREDITINS"][4]." | 分9期：".$data["CREDITINS"][5]." | 分12期：".$data["CREDITINS"][6]." | 分18期：".$data["CREDITINS"][7]." | 分24期：".$data["CREDITINS"][8]." | 分30期：".$data["CREDITINS"][9];
        
        // ----CREDITBONUS---------
        $result["CREDITBONUS"]["name"] = "信用卡紅利";
        switch ($data["CREDITBONUS"][0]) {
            case "0":
                $result["CREDITBONUS"]["status"] = "未啟用";
                break;
            case "1":
                $result["CREDITBONUS"]["status"] = "啟用";
                break;
            case "2":
                $result["CREDITBONUS"]["status"] = "會員隱藏";
                break;
            case "3":
                $result["CREDITBONUS"]["status"] = "申請中";
                break;
            case "4":
                $result["CREDITBONUS"]["status"] = "拒絕";
                break;
            case "5":
                $result["CREDITBONUS"]["status"] = "關閉";
                break;
            default:
                $result["CREDITBONUS"]["status"] = $data["CREDITBONUS"][0];
                break;
        }
        $result["CREDITBONUS"]["note"] = $data["CREDITBONUS"][1];
        $result["CREDITBONUS"]["banks"] = $data["CREDITBONUS"][2];

        // ----CREDITFOREIGN---------
        $result["CREDITFOREIGN"]["name"] = "國外卡";
        switch ($data["CREDITFOREIGN"][0]) {
            case "0":
                $result["CREDITFOREIGN"]["status"] = "未啟用";
                break;
            case "1":
                $result["CREDITFOREIGN"]["status"] = "啟用";
                break;
            case "2":
                $result["CREDITFOREIGN"]["status"] = "會員隱藏";
                break;
            case "3":
                $result["CREDITFOREIGN"]["status"] = "申請中";
                break;
            case "4":
                $result["CREDITFOREIGN"]["status"] = "暫時拒絕";
                break;
            case "5":
                $result["CREDITFOREIGN"]["status"] = "關閉";
                break;
            case "7":
                $result["CREDITFOREIGN"]["status"] = "永久拒絕";
                break;
            default:
                $result["CREDITFOREIGN"]["status"] = $data["CREDITFOREIGN"][0];
                break;
        }
        $result["CREDITFOREIGN"]["note"] = $data["CREDITFOREIGN"][1];
        switch ($data["CREDITFOREIGN"][2]) {
            case "0":
                $result["CREDITFOREIGN"]["is3D"] = "非3D";
                break;
            case "1":
                $result["CREDITFOREIGN"]["is3D"] = "3D";
                break;
            case "2":
                $result["CREDITFOREIGN"]["is3D"] = "強制3D";
                break;
            default:
                $result["CREDITFOREIGN"]["is3D"] = $data["CREDITFOREIGN"][2];
                break;
        }
        $result["CREDITFOREIGN"]["AgreedFee"] = $data["CREDITFOREIGN"][3];

        // ----CREDITREGULAR 信用卡定期定額---------
        $result["CREDITREGULAR"]["name"] = "信用卡信用卡定期定額紅利";
        switch ($data["CREDITREGULAR"][0]) {
            case "0":
                $result["CREDITREGULAR"]["status"] = "未啟用";
                break;
            case "1":
                $result["CREDITREGULAR"]["status"] = "啟用";
                break;
            case "2":
                $result["CREDITREGULAR"]["status"] = "會員隱藏";
                break;
            case "3":
                $result["CREDITREGULAR"]["status"] = "申請中";
                break;
            case "4":
                $result["CREDITREGULAR"]["status"] = "拒絕";
                break;
            case "5":
                $result["CREDITREGULAR"]["status"] = "關閉";
                break;
            default:
                $result["CREDITREGULAR"]["status"] = $data["CREDITREGULAR"][0];
                break;
        }
        $result["CREDITREGULAR"]["note"] = $data["CREDITREGULAR"][1];
    
        // ----CREDITDCC 信用卡動態貨幣 轉換---------
        $result["CREDITDCC"]["name"] = "信用卡動態貨幣";
        switch ($data["CREDITDCC"][0]) {
            case "0":
                $result["CREDITDCC"]["status"] = "未啟用";
                break;
            case "1":
                $result["CREDITDCC"]["status"] = "啟用";
                break;
            case "2":
                $result["CREDITDCC"]["status"] = "會員隱藏";
                break;
            case "3":
                $result["CREDITDCC"]["status"] = "申請中";
                break;
            case "4":
                $result["CREDITDCC"]["status"] = "暫時拒絕";
                break;
            case "5":
                $result["CREDITDCC"]["status"] = "關閉";
                break;
            default:
                $result["CREDITDCC"]["status"] = $data["CREDITDCC"][0];
                break;
        }
        $result["CREDITDCC"]["note"] = $data["CREDITDCC"][1];
        $result["CREDITDCC"]["AgreedDay"] = $data["CREDITDCC"][2];
        $result["CREDITDCC"]["AgreedFee"] = $data["CREDITDCC"][3];

        // ----UNIONPAY---------
        $result["UNIONPAY"]["name"] = "銀聯卡";
        switch ($data["UNIONPAY"][0]) {
            case "0":
                $result["UNIONPAY"]["status"] = "未啟用";
                break;
            case "1":
                $result["UNIONPAY"]["status"] = "啟用";
                break;
            case "2":
                $result["UNIONPAY"]["status"] = "隱藏";
                break;
            case "5":
                $result["UNIONPAY"]["status"] = "關閉";
                break;
            default:
                $result["UNIONPAY"]["status"] = $data["UNIONPAY"][0];
                break;
        }
        $result["UNIONPAY"]["note"] = $data["UNIONPAY"][1];
        $result["UNIONPAY"]["AgreedDay"] = $data["UNIONPAY"][2];
        $result["UNIONPAY"]["AgreedFee"] = $data["UNIONPAY"][3];

        // ----ATM---------
        $result["ATM"]["name"] = "ATM";
        switch ($data["ATM"][0]) {
            case "0":
                $result["ATM"]["status"] = "未啟用";
                break;
            case "1":
                $result["ATM"]["status"] = "啟用";
                break;
            case "2":
                $result["ATM"]["status"] = "不啟用";
                break;
            case "3":
                $result["ATM"]["status"] = "申請中";
                break;
            case "4":
                $result["ATM"]["status"] = "拒絕";
                break;
            case "5":
                $result["ATM"]["status"] = "關閉";
                break;
            default:
                $result["ATM"]["status"] = $data["ATM"][0];
                break;
        }
        $result["ATM"]["note"] = $data["ATM"][1];
        $result["ATM"]["AgreedDay"] = $data["ATM"][2];
        $result["ATM"]["AgreedFee"] = $data["ATM"][3]."｜單筆上限：". $data["ATM"][4];

        // ----WEBATM---------
        $result["WEBATM"]["name"] = "WEBATM";
        switch ($data["WEBATM"][0]) {
            case "0":
                $result["WEBATM"]["status"] = "未啟用";
                break;
            case "1":
                $result["WEBATM"]["status"] = "啟用";
                break;
            case "2":
                $result["WEBATM"]["status"] = "不啟用";
                break;
            case "3":
                $result["WEBATM"]["status"] = "申請中";
                break;
            case "4":
                $result["WEBATM"]["status"] = "拒絕";
                break;
            case "5":
                $result["WEBATM"]["status"] = "關閉";
                break;
            default:
                $result["WEBATM"]["status"] = $data["WEBATM"][0];
                break;
        }
        $result["WEBATM"]["note"] = $data["WEBATM"][1];
        $result["WEBATM"]["AgreedDay"] = $data["WEBATM"][2];
        $result["WEBATM"]["AgreedFee"] = $data["WEBATM"][3]."｜單筆上限：". $data["WEBATM"][4];

        // ----CVS---------
        $result["CVS"]["name"] = "超商代碼繳費";
        switch ($data["CVS"][0]) {
            case "0":
                $result["CVS"]["status"] = "未啟用";
                break;
            case "1":
                $result["CVS"]["status"] = "啟用";
                break;
            case "2":
                $result["CVS"]["status"] = "不啟用";
                break;
            case "3":
                $result["CVS"]["status"] = "申請中";
                break;
            case "4":
                $result["CVS"]["status"] = "拒絕";
                break;
            case "5":
                $result["CVS"]["status"] = "關閉";
                break;
            default:
                $result["CVS"]["status"] = $data["CVS"][0];
                break;
        }
        $result["CVS"]["note"] = $data["CVS"][1];
        $result["CVS"]["AgreedDay"] = $data["CVS"][2];
        $result["CVS"]["AgreedFee"] = $data["CVS"][3];

        // ----CVSBARCODE---------
        $result["CVSBARCODE"]["name"] = "超商條碼繳費";
        switch ($data["CVSBARCODE"][0]) {
            case "0":
                $result["CVSBARCODE"]["status"] = "未啟用";
                break;
            case "1":
                $result["CVSBARCODE"]["status"] = "啟用";
                break;
            case "2":
                $result["CVSBARCODE"]["status"] = "不啟用";
                break;
            case "3":
                $result["CVSBARCODE"]["status"] = "申請中";
                break;
            case "4":
                $result["CVSBARCODE"]["status"] = "拒絕";
                break;
            case "5":
                $result["CVSBARCODE"]["status"] = "關閉";
                break;
            default:
                $result["CVSBARCODE"]["status"] = $data["CVSBARCODE"][0];
                break;
        }
        $result["CVSBARCODE"]["note"] = $data["CVSBARCODE"][1];
        $result["CVSBARCODE"]["AgreedDay"] = $data["CVSBARCODE"][2];
        $result["CVSBARCODE"]["AgreedFee"] = $data["CVSBARCODE"][3];
        return $result;
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
