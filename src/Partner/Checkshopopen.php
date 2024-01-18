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
        $result["MemberState"] = $data["MemberState"][0];
        switch ($data["MemberState"][0]) {
            case "01":
                $result["MemberStateText"] = "已驗證";
                break;
            case "02":
                $result["MemberStateText"] = "未驗證";
                break;
            case "03":
                $result["MemberStateText"] = "請重新上傳影像檔";
                break;
            case "04":
                $result["MemberStateText"] = "請修改資料";
                break;
            case "05":
                $result["MemberStateText"] = "請修改資料並重新上傳影像檔";
                break;
            case "06":
                $result["MemberStateText"] = "異動申請需補件";
                break;
            case "07":
                $result["MemberStateText"] = "異動申請審核中";
                break;
            case "08":
                $result["MemberStateText"] = "異動申請審核未通過";
                break;
            case "09":
                $result["MemberStateText"] = "撤銷申請";
                break;
            case "10":
                $result["MemberStateText"] = "暫時停權";
                break;
            case "11":
                $result["MemberStateText"] = "永久停權";
                break;
            default:
                $result["MemberStateText"] = $data["MemberState"][0];
                break;
        }
        $result["MerchantState"] = $data["MerchantState"][0];
        switch ($data["MerchantState"][0]) {
            
            case "01":
                $result["MerchantStateText"] = "審核通過";
                break;
            case "02":
                $result["MerchantStateText"] = "需補件";
                break;
            case "03":
                $result["MerchantStateText"] = "永久拒絕";
                break;
            case "04":
                $result["MerchantStateText"] = "待審核";
                break;
            case "05":
                $result["MerchantStateText"] = "暫存未建店";
                break;
            case "06":
                $result["MerchantStateText"] = "關閉中";
                break;
           
            default:
                $result["MerchantStateText"] = $data["MerchantState"][0];
                break;
        }
        // ----CREDIT---------
        $result["CREDIT"]["name"] = "信用卡";
        $result["CREDIT"]["status"] = $data["CREDIT"][0];

        switch ($data["CREDIT"][0]) {
            case "0":
                $result["CREDIT"]["statusText"] = "未啟用";
                break;
            case "1":
                $result["CREDIT"]["statusText"] = "啟用";
                break;
            case "2":
                $result["CREDIT"]["statusText"] = "會員隱藏";
                break;
            case "3":
                $result["CREDIT"]["statusText"] = "申請中";
                break;
            case "4":
                $result["CREDIT"]["statusText"] = "暫時拒絕";
                break;
            case "5":
                $result["CREDIT"]["statusText"] = "關閉";
                break;
            case "7":
                $result["CREDIT"]["statusText"] = "永久拒絕";
                break;
            default:
                $result["CREDIT"]["statusText"] = $data["CREDIT"][0];
                break;
        }
        $result["CREDIT"]["note"] = $data["CREDIT"][1];
        $result["CREDIT"]["is3D"] = $data["CREDIT"][2];

        switch ($data["CREDIT"][2]) {
            case "0":
                $result["CREDIT"]["is3DText"] = "非3D";
                break;
            case "1":
                $result["CREDIT"]["is3DText"] = "3D";
                break;
            case "2":
                $result["CREDIT"]["is3DText"] = "強制3D";
                break;
            default:
                $result["CREDIT"]["is3DText"] = $data["CREDIT"][2];
                break;
        }
        $result["CREDIT"]["AgreedDay"] = $data["CREDIT"][3];
        $result["CREDIT"]["AgreedFee"] = $data["CREDIT"][4];

        // ----APPLEPAY---------
        $result["APPLEPAY"]["name"] = "APPLEPAY";
        $result["APPLEPAY"]["status"] = $data["APPLEPAY"][0];
        switch ($data["APPLEPAY"][0]) {
            case "0":
                $result["APPLEPAY"]["statusText"] = "未啟用";
                break;
            case "1":
                $result["APPLEPAY"]["statusText"] = "啟用";
                break;
            case "2":
                $result["APPLEPAY"]["statusText"] = "會員隱藏";
                break;
            case "3":
                $result["APPLEPAY"]["statusText"] = "申請中";
                break;
            case "4":
                $result["APPLEPAY"]["statusText"] = "拒絕";
                break;
            case "5":
                $result["APPLEPAY"]["statusText"] = "關閉";
                break;
            default:
                $result["APPLEPAY"]["statusText"] = $data["APPLEPAY"][0];
                break;
        }
        $result["APPLEPAY"]["note"] = $data["APPLEPAY"][1];

        // ----GOOGLEPAY---------
        $result["GOOGLEPAY"]["name"] = "GOOGLEPAY";
        $result["GOOGLEPAY"]["status"] = $data["GOOGLEPAY"][0];

        switch ($data["GOOGLEPAY"][0]) {
            case "0":
                $result["GOOGLEPAY"]["statusText"] = "未啟用";
                break;
            case "1":
                $result["GOOGLEPAY"]["statusText"] = "啟用";
                break;
            case "2":
                $result["GOOGLEPAY"]["statusText"] = "會員隱藏";
                break;
            case "3":
                $result["GOOGLEPAY"]["statusText"] = "申請中";
                break;
            case "4":
                $result["GOOGLEPAY"]["statusText"] = "拒絕";
                break;
            case "5":
                $result["GOOGLEPAY"]["statusText"] = "關閉";
                break;
            default:
                $result["GOOGLEPAY"]["statusText"] = $data["GOOGLEPAY"][0];
                break;
        }
        $result["GOOGLEPAY"]["note"] = $data["GOOGLEPAY"][1];

        // ----SAMSUNGPAY---------
        $result["SAMSUNGPAY"]["name"] = "SAMSUNGPAY";
        $result["SAMSUNGPAY"]["status"] = $data["SAMSUNGPAY"][0];
        switch ($data["SAMSUNGPAY"][0]) {
            case "0":
                $result["SAMSUNGPAY"]["statusText"] = "未啟用";
                break;
            case "1":
                $result["SAMSUNGPAY"]["statusText"] = "啟用";
                break;
            case "2":
                $result["SAMSUNGPAY"]["statusText"] = "會員隱藏";
                break;
            case "3":
                $result["SAMSUNGPAY"]["statusText"] = "申請中";
                break;
            case "4":
                $result["SAMSUNGPAY"]["statusText"] = "拒絕";
                break;
            case "5":
                $result["SAMSUNGPAY"]["statusText"] = "關閉";
                break;
            default:
                $result["SAMSUNGPAY"]["statusText"] = $data["SAMSUNGPAY"][0];
                break;
        }
        $result["SAMSUNGPAY"]["note"] = $data["SAMSUNGPAY"][1];

        // ----CREDITINS 信用卡分期---------
        $result["CREDITINS"]["name"] = "信用卡分期";
        $result["CREDITINS"]["status"] = $data["CREDITINS"][0];
        switch ($data["CREDITINS"][0]) {
            case "0":
                $result["CREDITINS"]["statusText"] = "未啟用";
                break;
            case "1":
                $result["CREDITINS"]["statusText"] = "啟用";
                break;
            case "2":
                $result["CREDITINS"]["statusText"] = "會員隱藏";
                break;
            case "3":
                $result["CREDITINS"]["statusText"] = "申請中";
                break;
            case "4":
                $result["CREDITINS"]["statusText"] = "拒絕";
                break;
            case "5":
                $result["CREDITINS"]["statusText"] = "關閉";
                break;
            default:
                $result["CREDITINS"]["statusText"] = $data["CREDITINS"][0];
                break;
        }
        $result["CREDITINS"]["note"] = $data["CREDITINS"][1];
        $result["CREDITINS"]["AgreedDay"] = $data["CREDITINS"][2];
        $result["CREDITINS"]["AgreedFee"] = "分3期：".$data["CREDITINS"][3]." | 分6期：".$data["CREDITINS"][4]." | 分9期：".$data["CREDITINS"][5]." | 分12期：".$data["CREDITINS"][6]." | 分18期：".$data["CREDITINS"][7]." | 分24期：".$data["CREDITINS"][8]." | 分30期：".$data["CREDITINS"][9];
        
        // ----CREDITBONUS---------
        $result["CREDITBONUS"]["name"] = "信用卡紅利";
        $result["CREDITBONUS"]["status"] = $data["CREDITBONUS"][0];
        switch ($data["CREDITBONUS"][0]) {
            case "0":
                $result["CREDITBONUS"]["statusText"] = "未啟用";
                break;
            case "1":
                $result["CREDITBONUS"]["statusText"] = "啟用";
                break;
            case "2":
                $result["CREDITBONUS"]["statusText"] = "會員隱藏";
                break;
            case "3":
                $result["CREDITBONUS"]["statusText"] = "申請中";
                break;
            case "4":
                $result["CREDITBONUS"]["statusText"] = "拒絕";
                break;
            case "5":
                $result["CREDITBONUS"]["statusText"] = "關閉";
                break;
            default:
                $result["CREDITBONUS"]["statusText"] = $data["CREDITBONUS"][0];
                break;
        }
        $result["CREDITBONUS"]["note"] = $data["CREDITBONUS"][1];
        $result["CREDITBONUS"]["banks"] = $data["CREDITBONUS"][2];

        // ----CREDITFOREIGN---------
        $result["CREDITFOREIGN"]["name"] = "國外卡";
        $result["CREDITFOREIGN"]["status"] = $data["CREDITFOREIGN"][0];
        switch ($data["CREDITFOREIGN"][0]) {
            case "0":
                $result["CREDITFOREIGN"]["statusText"] = "未啟用";
                break;
            case "1":
                $result["CREDITFOREIGN"]["statusText"] = "啟用";
                break;
            case "2":
                $result["CREDITFOREIGN"]["statusText"] = "會員隱藏";
                break;
            case "3":
                $result["CREDITFOREIGN"]["statusText"] = "申請中";
                break;
            case "4":
                $result["CREDITFOREIGN"]["statusText"] = "暫時拒絕";
                break;
            case "5":
                $result["CREDITFOREIGN"]["statusText"] = "關閉";
                break;
            case "7":
                $result["CREDITFOREIGN"]["statusText"] = "永久拒絕";
                break;
            default:
                $result["CREDITFOREIGN"]["statusText"] = $data["CREDITFOREIGN"][0];
                break;
        }
        $result["CREDITFOREIGN"]["note"] = $data["CREDITFOREIGN"][1];
        $result["CREDITFOREIGN"]["is3D"] = $data["CREDITFOREIGN"][2];
        switch ($data["CREDITFOREIGN"][2]) {
            case "0":
                $result["CREDITFOREIGN"]["is3DText"] = "非3D";
                break;
            case "1":
                $result["CREDITFOREIGN"]["is3DText"] = "3D";
                break;
            case "2":
                $result["CREDITFOREIGN"]["is3DText"] = "強制3D";
                break;
            default:
                $result["CREDITFOREIGN"]["is3DText"] = $data["CREDITFOREIGN"][2];
                break;
        }
        $result["CREDITFOREIGN"]["AgreedFee"] = $data["CREDITFOREIGN"][3];

        // ----CREDITREGULAR 信用卡定期定額---------
        $result["CREDITREGULAR"]["name"] = "信用卡信用卡定期定額紅利";
        $result["CREDITREGULAR"]["status"] = $data["CREDITREGULAR"][0];
        switch ($data["CREDITREGULAR"][0]) {
            case "0":
                $result["CREDITREGULAR"]["statusText"] = "未啟用";
                break;
            case "1":
                $result["CREDITREGULAR"]["statusText"] = "啟用";
                break;
            case "2":
                $result["CREDITREGULAR"]["statusText"] = "會員隱藏";
                break;
            case "3":
                $result["CREDITREGULAR"]["statusText"] = "申請中";
                break;
            case "4":
                $result["CREDITREGULAR"]["statusText"] = "拒絕";
                break;
            case "5":
                $result["CREDITREGULAR"]["statusText"] = "關閉";
                break;
            default:
                $result["CREDITREGULAR"]["statusText"] = $data["CREDITREGULAR"][0];
                break;
        }
        $result["CREDITREGULAR"]["note"] = $data["CREDITREGULAR"][1];
    
        // ----CREDITDCC 信用卡動態貨幣 轉換---------
        $result["CREDITDCC"]["name"] = "信用卡動態貨幣";
        $result["CREDITDCC"]["status"] = $data["CREDITDCC"][0];
        switch ($data["CREDITDCC"][0]) {
            case "0":
                $result["CREDITDCC"]["statusText"] = "未啟用";
                break;
            case "1":
                $result["CREDITDCC"]["statusText"] = "啟用";
                break;
            case "2":
                $result["CREDITDCC"]["statusText"] = "會員隱藏";
                break;
            case "3":
                $result["CREDITDCC"]["statusText"] = "申請中";
                break;
            case "4":
                $result["CREDITDCC"]["statusText"] = "暫時拒絕";
                break;
            case "5":
                $result["CREDITDCC"]["statusText"] = "關閉";
                break;
            default:
                $result["CREDITDCC"]["statusText"] = $data["CREDITDCC"][0];
                break;
        }
        $result["CREDITDCC"]["note"] = $data["CREDITDCC"][1];
        $result["CREDITDCC"]["AgreedDay"] = $data["CREDITDCC"][2];
        $result["CREDITDCC"]["AgreedFee"] = $data["CREDITDCC"][3];

        // ----UNIONPAY---------
        $result["UNIONPAY"]["name"] = "銀聯卡";
        $result["UNIONPAY"]["status"] = $data["UNIONPAY"][0];
        switch ($data["UNIONPAY"][0]) {
            case "0":
                $result["UNIONPAY"]["statusText"] = "未啟用";
                break;
            case "1":
                $result["UNIONPAY"]["statusText"] = "啟用";
                break;
            case "2":
                $result["UNIONPAY"]["statusText"] = "隱藏";
                break;
            case "5":
                $result["UNIONPAY"]["statusText"] = "關閉";
                break;
            default:
                $result["UNIONPAY"]["statusText"] = $data["UNIONPAY"][0];
                break;
        }
        $result["UNIONPAY"]["note"] = $data["UNIONPAY"][1];
        $result["UNIONPAY"]["AgreedDay"] = $data["UNIONPAY"][2];
        $result["UNIONPAY"]["AgreedFee"] = $data["UNIONPAY"][3];

        // ----ATM---------
        $result["ATM"]["name"] = "ATM";
        $result["ATM"]["status"] =$data["ATM"][0];
        switch ($data["ATM"][0]) {
            case "0":
                $result["ATM"]["statusText"] = "未啟用";
                break;
            case "1":
                $result["ATM"]["statusText"] = "啟用";
                break;
            case "2":
                $result["ATM"]["statusText"] = "不啟用";
                break;
            case "3":
                $result["ATM"]["statusText"] = "申請中";
                break;
            case "4":
                $result["ATM"]["statusText"] = "拒絕";
                break;
            case "5":
                $result["ATM"]["statusText"] = "關閉";
                break;
            default:
                $result["ATM"]["statusText"] = $data["ATM"][0];
                break;
        }
        $result["ATM"]["note"] = $data["ATM"][1];
        $result["ATM"]["AgreedDay"] = $data["ATM"][2];
        $result["ATM"]["AgreedFee"] = $data["ATM"][3]."｜單筆上限：". $data["ATM"][4];

        // ----WEBATM---------
        $result["WEBATM"]["name"] = "WEBATM";
        $result["WEBATM"]["status"] = $data["WEBATM"][0];
        switch ($data["WEBATM"][0]) {
            case "0":
                $result["WEBATM"]["statusText"] = "未啟用";
                break;
            case "1":
                $result["WEBATM"]["statusText"] = "啟用";
                break;
            case "2":
                $result["WEBATM"]["statusText"] = "不啟用";
                break;
            case "3":
                $result["WEBATM"]["statusText"] = "申請中";
                break;
            case "4":
                $result["WEBATM"]["statusText"] = "拒絕";
                break;
            case "5":
                $result["WEBATM"]["statusText"] = "關閉";
                break;
            default:
                $result["WEBATM"]["statusText"] = $data["WEBATM"][0];
                break;
        }
        $result["WEBATM"]["note"] = $data["WEBATM"][1];
        $result["WEBATM"]["AgreedDay"] = $data["WEBATM"][2];
        $result["WEBATM"]["AgreedFee"] = $data["WEBATM"][3]."｜單筆上限：". $data["WEBATM"][4];

        // ----CVS---------
        $result["CVS"]["name"] = "超商代碼繳費";
        $result["CVS"]["status"] = $data["CVS"][0];
        switch ($data["CVS"][0]) {
            case "0":
                $result["CVS"]["statusText"] = "未啟用";
                break;
            case "1":
                $result["CVS"]["statusText"] = "啟用";
                break;
            case "2":
                $result["CVS"]["statusText"] = "不啟用";
                break;
            case "3":
                $result["CVS"]["statusText"] = "申請中";
                break;
            case "4":
                $result["CVS"]["statusText"] = "拒絕";
                break;
            case "5":
                $result["CVS"]["statusText"] = "關閉";
                break;
            default:
                $result["CVS"]["statusText"] = $data["CVS"][0];
                break;
        }
        $result["CVS"]["note"] = $data["CVS"][1];
        $result["CVS"]["AgreedDay"] = $data["CVS"][2];
        $result["CVS"]["AgreedFee"] = $data["CVS"][3];

        // ----CVSBARCODE---------
        $result["CVSBARCODE"]["name"] = "超商條碼繳費";
        $result["CVSBARCODE"]["status"] = $data["CVSBARCODE"][0];
        switch ($data["CVSBARCODE"][0]) {
            case "0":
                $result["CVSBARCODE"]["statusText"] = "未啟用";
                break;
            case "1":
                $result["CVSBARCODE"]["statusText"] = "啟用";
                break;
            case "2":
                $result["CVSBARCODE"]["statusText"] = "不啟用";
                break;
            case "3":
                $result["CVSBARCODE"]["statusText"] = "申請中";
                break;
            case "4":
                $result["CVSBARCODE"]["statusText"] = "拒絕";
                break;
            case "5":
                $result["CVSBARCODE"]["statusText"] = "關閉";
                break;
            default:
                $result["CVSBARCODE"]["statusText"] = $data["CVSBARCODE"][0];
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
