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
        // ----CREDIT---------
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
                $result["CREDIT"]["status"] = "N/A";
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
                $result["CREDIT"]["is3D"] = "N/A";
                break;
        }
        $result["CREDIT"]["AgreedDay"] = $data["CREDIT"][3];
        $result["CREDIT"]["AgreedFee"] = $data["CREDIT"][4];

        // ----APPLEPAY---------
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
                $result["APPLEPAY"]["status"] = "N/A";
                break;
        }
        $result["APPLEPAY"]["note"] = $data["APPLEPAY"][1];

        // ----GOOGLEPAY---------
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
                $result["GOOGLEPAY"]["status"] = "N/A";
                break;
        }
        $result["GOOGLEPAY"]["note"] = $data["GOOGLEPAY"][1];

        // ----SAMSUNGPAY---------
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
                $result["SAMSUNGPAY"]["status"] = "N/A";
                break;
        }
        $result["SAMSUNGPAY"]["note"] = $data["SAMSUNGPAY"][1];

        // ----CREDITINS 信用卡分期---------
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
                $result["CREDITINS"]["status"] = "N/A";
                break;
        }
        $result["CREDITINS"]["note"] = $data["CREDITINS"][1];
        $result["CREDITINS"]["AgreedDay"] = $data["CREDITINS"][2];
        $result["CREDITINS"]["AgreedFee"] = "分3期：".$data["CREDITINS"][3]." | 分6期：".$data["CREDITINS"][4]." | 分9期：".$data["CREDITINS"][5]." | 分12期：".$data["CREDITINS"][6]." | 分18期：".$data["CREDITINS"][7]." | 分24期：".$data["CREDITINS"][8]." | 分30期：".$data["CREDITINS"][9];
        
        // ----CREDITBONUS---------
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
                $result["CREDITBONUS"]["status"] = "N/A";
                break;
        }
        $result["CREDITBONUS"]["note"] = $data["CREDITBONUS"][1];
        $result["CREDITBONUS"]["banks"] = $data["CREDITBONUS"][2];

        // ----CREDITFOREIGN---------
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
                $result["CREDITFOREIGN"]["status"] = "N/A";
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
                $result["CREDITFOREIGN"]["is3D"] = "N/A";
                break;
        }
        $result["CREDITFOREIGN"]["AgreedFee"] = $data["CREDITFOREIGN"][3];

        // ----CREDITREGULAR 信用卡定期定額---------
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
                $result["CREDITREGULAR"]["status"] = "N/A";
                break;
        }
        $result["CREDITREGULAR"]["note"] = $data["CREDITREGULAR"][1];
    
        // ----CREDITDCC 信用卡動態貨幣 轉換---------
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
                $result["CREDITDCC"]["status"] = "N/A";
                break;
        }
        $result["CREDITDCC"]["note"] = $data["CREDITDCC"][1];
        $result["CREDITDCC"]["AgreedDay"] = $data["CREDITDCC"][2];
        $result["CREDITDCC"]["AgreedFee"] = $data["CREDITDCC"][3];

        // ----UNIONPAY---------
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
                $result["UNIONPAY"]["status"] = "N/A";
                break;
        }
        $result["UNIONPAY"]["note"] = $data["UNIONPAY"][1];
        $result["UNIONPAY"]["AgreedDay"] = $data["UNIONPAY"][2];
        $result["UNIONPAY"]["AgreedFee"] = $data["UNIONPAY"][3];

        // ----ATM---------
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
                $result["ATM"]["status"] = "N/A";
                break;
        }
        $result["ATM"]["note"] = $data["ATM"][1];
        $result["ATM"]["AgreedDay"] = $data["ATM"][2];
        $result["ATM"]["AgreedFee"] = $data["ATM"][3]."｜單筆上限：". $data["ATM"][4];

        // ----WEBATM---------
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
                $result["WEBATM"]["status"] = "N/A";
                break;
        }
        $result["WEBATM"]["note"] = $data["WEBATM"][1];
        $result["WEBATM"]["AgreedDay"] = $data["WEBATM"][2];
        $result["WEBATM"]["AgreedFee"] = $data["WEBATM"][3]."｜單筆上限：". $data["WEBATM"][4];

        // ----CVS---------
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
                $result["CVS"]["status"] = "N/A";
                break;
        }
        $result["CVS"]["note"] = $data["CVS"][1];
        $result["CVS"]["AgreedDay"] = $data["CVS"][2];
        $result["CVS"]["AgreedFee"] = $data["CVS"][3];

        // ----CVSBARCODE---------
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
                $result["CVSBARCODE"]["status"] = "N/A";
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
