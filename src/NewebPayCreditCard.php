<?php

namespace Violetshih\NewebPay;

class NewebPayCreditCard extends BaseNewebPay
{
    protected $mode;

    /**
     * The newebpay boot hook.
     *
     * @return void
     */
    public function boot()
    {
       
        $this->TradeData['MerchantID'] = $this->MerchantID;
    }

    /**
     * 3d 驗證交易
     *
     * @param  bool  $p3d
     * @return self
     */
    public function setP3D($p3d = false)
    {
        // 需考慮傳送 notify & return url when p3d is true;
        $this->TradeData['P3D'] = $p3d;

        return $this;
    }
     /**
     * 約定信用卡agreement
     *
     */
    public function setCREDITAGREEMENT()
    {
        $this->TradeData['CREDITAGREEMENT'] = 1;

        return $this;
    }
    public function setANDROIDPAYAGREEMENT()
    {
        $this->TradeData['ANDROIDPAYAGREEMENT'] = 1;

        return $this;
    }
    public function setSAMSUNGPAYAGREEMENT()
    {
        $this->TradeData['SAMSUNGPAYAGREEMENT'] = 1;

        return $this;
    }
    /**
     * 約定信用卡有效日期
     * @param  string  $deadline  yymm，例 1912=2019 年 12 月
     * @return self
     */
    public function setTokenLife($deadline = "")
    {
        $this->TradeData['TokenLife'] = $deadline;

        return $this;
    }
    /**
     * 首次授權信用卡交易-幕前
     *
     * @param  array  $data
     * @return self
     */
    public function firstTradeFrontend($data)
    {
        $this->$mode = 'frontend';
        $this->setSyncSender();
        $this->setApiPath('MPG/mpg_gateway');
        $this->setCREDITAGREEMENT();
        $this->setLangType();
        $this->setReturnURL();
        $this->setNotifyURL();
        $this->setClientBackURL();
        $this->setLoginType();
        $this->setOrderComment();
        $this->setTokenTerm();
        
        $this->TradeData['MerchantOrderNo'] = $data['no'];
        $this->TradeData['Amt'] = $data['amt'];
        $this->TradeData['ItemDesc'] = $data['desc'];
        $this->TradeData['Email'] = $data['email'];
        $this->TradeData['TokenTerm'] = $data['tokenTerm'];

        return $this;
    }
     /**
     * 首次授權信用卡交易-幕後
     *
     * @param  array  $data
     * @return self
     */
    public function firstTradeBackend($data)
    {
        
        $this->$mode = 'backend';
        $this->setApiPath('API/CreditCard');
        $this->setAsyncSender();
        $this->TradeData['TokenSwitch'] = 'get';
        $this->setP3D(true);
        $this->TradeData['MerchantOrderNo'] = $data['no'];
        $this->TradeData['Amt'] = $data['amt'];
        $this->TradeData['ProdDesc'] = $data['desc'];
        $this->TradeData['PayerEmail'] = $data['email'];
        $this->TradeData['CardNo'] = $data['cardNo'];
        $this->TradeData['Exp'] = $data['exp'];
        $this->TradeData['CVC'] = $data['cvc'];
        $this->TradeData['TokenTerm'] = $data['tokenTerm'];

        return $this;
    }
    /**
     * 使用 Token 授權
     *
     * @param  array  $data
     * @return self
     */
    public function tradeWithToken($data)
    {
        $this->$mode = 'backend';
        $this->setApiPath('API/CreditCard');
        $this->setASyncSender();
        $this->TradeData['TokenSwitch'] = 'on';
        $this->setP3D(false);
        $this->TradeData['MerchantOrderNo'] = $data['no'];
        $this->TradeData['Amt'] = $data['amt'];
        $this->TradeData['ProdDesc'] = $data['desc'];
        $this->TradeData['PayerEmail'] = $data['email'];
        $this->TradeData['TokenValue'] = $data['tokenValue'];
        $this->TradeData['TokenTerm'] = $data['tokenTerm'];

        return $this;
    }

    /**
     * Get request data.
     *
     * @return array
     */
    public function getRequestData()
    {
        $tradeInfo = $this->encryptDataByAES($this->TradeData, $this->HashKey, $this->HashIV);
        if($this->$mode == 'frontend'){
            $tradeSha = $this->encryptDataBySHA($tradeInfo, $this->HashKey, $this->HashIV);

            return [
                'MerchantID' => $this->MerchantID,
                'TradeInfo' => $tradeInfo,
                'TradeSha' => $tradeSha,
                'Version' => $this->TradeData['Version'],
            ];
        }else{
            return [
                'MerchantID_' => $this->MerchantID,
                'PostData_' => $tradeInfo,
                'Pos_' => $this->config->get('newebpay.RespondType'),
            ];
        }

        
    }
}
