<?php
    return [
        /*
     * 開啟藍新金流測試模式 (bool)
     */

    'Debug' => env('NEWEBPAY_DEBUG'),

    /*
     * 藍新金流商店代號
     */

    'MerchantID' => env('NEWEBPAY_MERCHANT_ID'),
    'HashKey' => env('NEWEBPAY_HASH_KEY'),
    'HashIV' => env('NEWEBPAY_HASH_IV'),

    /*
     * 藍新金流商店平台商代號
     */

     'PartnerID' => env('NEWEBPAY_PARTNER_ID'),
     'PartnerHashKey' => env('NEWEBPAY_PARTNER_HASH_KEY'),
     'PartnerHashIV' => env('NEWEBPAY_PARTNER_HASH_IV'),
    /*
     * 回傳格式 JSON/String
     */

    'RespondType' => 'JSON',

    /*
     * 串接版本
     */

    'Version' => '1.5',
    'PeriodVersion' => '1.0',

    /*
     * 語系 zh-tw/en
     * 定期定額 zh-Tw
     */

    'LangType' => 'zh-Tw',

    /*
     * 交易秒數限制 (int)
     *
     * default: 0
     * 0: 不限制
     * 秒數下限為 60 秒，當秒數介於 1~59 秒時，會以 60 秒計算
     * 秒數上限為 900 秒，當超過 900 秒時，會 以 900 秒計算
     */

    'TradeLimit' => 0,

    /*
     * 繳費有效期限
     *
     * default: 7
     * maxValue: 180
     */

    'ExpireDate' => 7,

    /*
     * 付款完成後導向頁面
     *
     * 僅接受 port 80 or 443
     * default: null
     */

    'ReturnURL' => env('NEWEBPAY_RETURN_URL') != null ? env('APP_URL') . env('NEWEBPAY_RETURN_URL') : null,

    /*
     * 付款完成後的通知連結
     *
     * 以幕後方式回傳給商店相關支付結果資料
     * 僅接受 port 80 or 443
     * default: null
     */

    'NotifyURL' => env('NEWEBPAY_NOTIFY_URL') != null ? env('APP_URL') . env('NEWEBPAY_NOTIFY_URL') : null,

    /*
     * 定期定額扣款完成後的通知連結
     *
     * 以幕後方式回傳給商店相關支付結果資料
     * 僅接受 port 80 or 443
     * default: null
     */
    'PeriodNotifyURL' => env('NEWEBPAY_PERIOD_NOTIFY_URL') != null ? env('APP_URL') . env('NEWEBPAY_NOTIFY_URL') : null,
    /*
     * 商店取號網址
     *
     * 此參數若為空值，則會顯示取號結果在智付寶頁面。
     * default: null
     */

    'CustomerURL' => env('NEWEBPAY_CUSTOMER_URL') != null ? env('APP_URL') . env('NEWEBPAY_CUSTOMER_URL') : null,

    /*
     * 付款取消-返回商店網址
     *
     * 當交易取消時，平台會出現返回鈕，使消費者依以此參數網址返回商店指定的頁面
     * default: null
     */

    'ClientBackURL' => env('NEWEBPAY_CLIENT_BACK_URL') != null ? env('APP_URL') . env('NEWEBPAY_CLIENT_BACK_URL') : null,

    /*
     * 付款人電子信箱是否開放修改 (bool)
     *
     * default: true
     */

    'EmailModify' => true,

    /*
     * 是否需要登入智付寶會員 (bool)
     */

    'LoginType' => false,

    /*
     * 商店備註
     *
     * 1.限制長度為 300 字。
     * 2.若有提供此參數，將會於 MPG 頁面呈現商店備註內容。
     * default: null
     */

    'OrderComment' => null,

    /*
     * 支付方式
     */

    'PaymentMethod' => [

        /*
         * 信用卡支付 (default: true)
         * Enable: 是否啟用信用卡支付
         * CreditRed: 是否啟用紅利
         * InstFlag: 是否啟用分期
         *
         * 0: 不啟用
         * 1: 啟用全部分期
         * 3: 分 3 期
         * 6: 分 6 期功能
         * 12: 分 12 期功能
         * 18: 分 18 期功能
         * 24: 分 24 期功能
         * 以逗號方式開啟多種分期
         */
        'CREDIT' => true,
        'InstFlag' => 0,
        'CreditRed' => false,
        // Google Pay (default: false)
        'ANDROIDPAY' => false,

        // Samsung Pay (default: false)
        'SAMSUNGPAY' => false,

        // 銀聯卡支付 (default: false)
        'UNIONPAY' => false,

        // WEBATM支付 (default: false)
        'WEBATM' => false,

        // ATM支付 (default: false)
        'VACC' => false,

        // 超商代碼繳費支付 (default: false)
        'CVS' => false,

        // 條碼繳費支付 (default: false)
        'BARCODE' => false,

        // ezPay 電子錢包 (default: false)
        'P2G' => false,
    ],

    /*
     * 定期定額
     * PeriodTyp 週期類別
     *
     * D = 固定天期
     * W = 每週
     * M = 每月
     * Y = 每年
     *
     * 授權周期：
     *   固定天期(2-999 天) 以授權日期隔日起算.
     *   每月授權若當月沒該日期則由該月最後一天做為扣款日.
     *
     * 每張委託單, 每個期別僅能授權一次, 若需授權多次, 請建立多張委託單
     */
    'PeriodType' => [
        /*
         * D = 固定天期
         * W = 每週
         * M = 每月
         * Y = 每年
         *
         * 授權周期：
         *   固定天期(2-999 天) 以授權日期隔日起算.
         *   每月授權若當月沒該日期則由該月最後一天做為扣款日.
         *
         * 每張委託單, 每個期別僅能授權一次, 若需授權多次, 請建立多張委託單
         */
        'Type' => [
            'Day' => 'D',
            'Week' => 'W',
            'Month' => 'M',
            'YEAR' => 'Y',
        ],
        'StartType' => [
            'DEBIT_TEN_DOLLAR' => 1,
            'DEBIT_ALL' => 2,
            'NO_DEBIT' => 4,
        ],
        'AlterType' => [
            'SUSPEND' => 'suspend',
            'TERMINATE' => 'terminate',
            'RESTART' => 'restart',
        ],
    ],

    /*
     * 付款方式-物流啟用
     *
     * 1 = 啟用超商取貨不付款
     * 2 = 啟用超商取貨付款
     * 3 = 啟用超商取貨不付款及超商取貨付款
     * null = 不開啟
     */
    'CVSCOM' => null,

    /* ========= 平台商參數=========
    
    /*交易手續費，若未設定之支付方式，則使用金流 合作推廣商與藍新金流約定之預設*/
    'AgreedFee' => null,

    /*
        不同付款方式的撥款天數，若指定API撥款，填0
    */ 
    'AgreedDay' => [
        'CREDIT' => 0,
        'UnionPay' => 0,
        'ForeignCard' => 0,
        'DCC' => 0,
        'ApplePay' => 0,
        'GooglePay' => 0,
        'SamsungPay' => 0,
        'PERIOD' => 0,
        'WEBATM' => 0,
        'VACC' => 0,
        'CVS' => 0,
        'BARCODE' => 0
    ],

    /*
    信用卡自動請款
        1 =自動請款
        0 =手動請款
    */
    'CreditAutoType' => 1,

     /*
    信用卡 30 天 收款額度，若未帶入此參數，則使用金流合作 推廣商與藍新金流約定之預設值
    */
    'CreditLimit' => null,

    /*啟用支付方式*/
    'PaymentType' =>[
        'CREDIT' => 1,
        'UnionPay' => 1,
        'ForeignCard' => 1,
        'DCC' => 1,
        'ApplePay' => 0,
        'GooglePay' => 0,
        'SamsungPay' => 0,
        'PERIOD' => 0,
        'WEBATM' => 1,
        'VACC' => 1,
        'CVS' => 0,
        'BARCODE' => 0
    ],

    /*會員帳戶自動提領啟用
    1=會員帳戶中有餘額時即進行提領 
    2=每週三當會員帳戶中有餘額時進行提領
    3=設定每週執行日期 
    4=設定每月執行日期 
    9=開啟商店提領
    如帶空值或未帶此參數，則指定每 周三當會員帳戶中有餘額時即進行提領
    */
    'Withdraw' => 9,

    /*會員商店 自動提領啟用
        1. 當 Withdraw=9 時為必填 
        2. 參數數值如下:
            1=當商店帳戶中有餘額時即進行提領
            2=每周三當商店帳戶中有餘額時進 行提領
            3=設定每週執行日期 4=設定每月執行日期
    */
    'WithdrawMer'=>1,

    /*自動提領規則
        1. 當 Withdraw=3 時，則此參數值如 下:
            1 = 週一 2 = 週二 3 = 週三 4 = 週四 5 = 週五 6 = 週六 0 = 週日
            2. 當 Withdraw=4 時，則此參數值為 01-31
            3. 若設定為 31 日，若於無 31 日之月 份將於該月最後一天進行提領
            4. 需指定至少兩個提領日期，請用 [;]符號分隔帶入 例:WithdrawSetting = 01;15;20
    */
    'WithdrawSetting' => null,
    'PartnerNotifyURL' => env('NEWEBPAY_PARTNER_NOTIFY_URL') != null ? env('APP_URL') . env('NEWEBPAY_PARTNER_NOTIFY_URL') : null,
    'PartnerReturnURL' => env('NEWEBPAY_PARTNER_RETURN_URL') != null ? env('APP_URL') . env('NEWEBPAY_PARTNER_RETURN_URL') : null,

    // Async請求時代入的headers
    'Headers'=>[ ],

    ];
   


?>
