<?php

namespace Violetshih\NewebPay\Concerns;

use Illuminate\Support\Carbon;

trait HasMemberData
{
    /**
     * The newebpay member data.
     *
     * @var array
     */
    protected $MemberData = [];
 
    /**
     * Get the newebpay MemberData.
     *
     * @return array
     */
    public function getMemberData()
    {
        return $this->MemberData;
    }
    /**
     * 會員證號
     *
     * @param  string|null  $memberUnified
     * @return self
     */
    public function setMenberUnified($memberUnified = null)
    {
        $this->MemberData['MenberUnified'] = $memberUnified;

        return $this;
    }

    /**
     * 聯繫人姓名
     *
     * @param  string|null  $name
     * @return self
     */
    public function setApplicantName($name = null)
    {
        $this->MemberData['ApplicantName'] = $name;

        return $this;
    }

    /**
     * 聯繫人 email
     *
     * @param  string|null  $email
     * @return self
     */
    public function setApplicantEmail($email = null)
    {
        $this->MemberData['ApplicantEmail'] = $email;

        return $this;
    }

    /**
     * 聯繫人電話
     *
     * @param  string|null  $phone
     * @return self
     */
    public function setApplicantPhone($phone = null)
    {
        $this->MemberData['ApplicantPhone'] = $phone;

        return $this;
    }

    /**
     * 會員名稱
     *
     * @param  string|null  $name
     * @return self
     */
    public function setMemberName($name = null)
    {
        $this->MemberData['MemberName'] = $name;

        return $this;
    }

    /**
     * 實收資本額
     *
     * @param  string|null  $amount
     * @return self
     */
    public function setCapitalAmount($amount = null)
    {
        $this->MemberData['CapitalAmount'] = $amount;

        return $this;
    }

    /**
     * 核准設立日期
     *
     * @param  string|null  $date
     * @return self
     */
    public function setIncorporationDate($date = null)
    {
        $this->MemberData['IncorporationDate'] = $date;

        return $this;
    }

    /**
     * 公司登記地址
     *
     * @param  string|null  $address
     * @return self
     */
    public function setCompanyAddress($address = null)
    {
        $this->MemberData['CompanyAddress'] = $address;

        return $this;
    }

    /**
     * 企業代表人中文姓名
     *
     * @param  string|null  $name
     * @return self
     */
    public function setRepresentName($name = null)
    {
        $this->MemberData['RepresentName'] = $name;

        return $this;
    }

    /**
     * 企業代表人身分證字號
     *
     * @param  string|null  $managerId
     * @return self
     */
    public function setManagerID($managerId = null)
    {
        $this->MemberData['ManagerID'] = $managerId;

        return $this;
    }

    /**
     * 發證日期
     *
     * @param  string|null  $date
     * @return self
     */
    public function setIDCardDate($date = null)
    {
        $this->MemberData['IDCardDate'] = $date;

        return $this;
    }

    /**
     * 身份證發證地點
     *
     * @param  string|null  $place
     * @return self
     */
    public function setIDCardPlace($place = null)
    {
        $this->MemberData['IDCardPlace'] = $place;

        return $this;
    }

    /**
     * 身分證領補換
     *
     * @param  int|null  $type
     * @return self
     */
    public function setIDFrom($type = null)
    {
        $this->MemberData['IDFrom'] = $type;

        return $this;
    }

    /**
     * 出生年月日
     *
     * @param  string|null  $date
     * @return self
     */
    public function setDate($date = null)
    {
        $this->MemberData['Date'] = $date;

        return $this;
    }

    /**
     * 居留證到期日
     *
     * @param  string|null  $exp
     * @return self
     */
    public function setARCexp($exp = null)
    {
        $this->MemberData['ARCexp'] = $exp;

        return $this;
    }

    /**
     * 居留證背面序號
     *
     * @param  string|null  $srlno
     * @return self
     */
    public function setARCsrlno($srlno = null)
    {
        $this->MemberData['ARCsrlno'] = $srlno;

        return $this;
    }

    /**
     * 護照到期日
     *
     * @param  string|null  $exp
     * @return self
     */
    public function setPassportexp($exp = null)
    {
        $this->MemberData['Passportexp'] = $exp;

        return $this;
    }

    /**
     * 法人登記地址
     *
     * @param  string|null  $address
     * @return self
     */
    public function setRepresentCPAdd($address = null)
    {
        $this->MemberData['RepresentCPAdd'] = $address;

        return $this;
    }

    /**
     * 法人實收資本額
     *
     * @param  string|null  $amount
     * @return self
     */
    public function setRepresentCapitalAmt($amount = null)
    {
        $this->MemberData['RepresentCapitalAmt'] = $amount;

        return $this;
    }

    /**
     * 法人公司代表人名稱
     *
     * @param  string|null  $name
     * @return self
     */
    public function setRepresentManagerName($name = null)
    {
        $this->MemberData['RepresentManagerName'] = $name;

        return $this;
    }

    /**
     * 會員電話
     *
     * @param  string|null  $phone
     * @return self
     */
    public function setMemberPhone($phone = null)
    {
        $this->MemberData['MemberPhone'] = $phone;

        return $this;
    }

    /**
     * 會員金融機構帳戶戶名
     *
     * @param  string|null  $name
     * @return self
     */
    public function setModifyAccName($name = null)
    {
        $this->MemberData['ModifyAccName'] = $name;

        return $this;
    }

    /**
     * 會員金融機構帳戶金融機構代碼
     *
     * @param  string|null  $code
     * @return self
     */
    public function setBankCode($code = null)
    {
        $this->MemberData['BankCode'] = $code;

        return $this;
    }

    /**
     * 會員金融機構帳戶金融機構分行代碼
     *
     * @param  string|null  $code
     * @return self
     */
    public function setSubBankCode($code = null)
    {
        $this->MemberData['SubBankCode'] = $code;

        return $this;
    }

    /**
     * 會員金融機構帳戶帳號
     *
     * @param  string|null  $account
     * @return self
     */
    public function setBankAccount($account = null)
    {
        $this->MemberData['BankAccount'] = $account;

        return $this;
    }

    /**
     * 商店客服信箱
     *
     * @param  string|null  $email
     * @return self
     */
    public function setMerchantEmail($email = null)
    {
        $this->MemberData['MerchantEmail'] = $email;

        return $this;
    }

    /**
     * 聯絡地址－城市
     *
     * @param  string|null  $city
     * @return self
     */
    public function setMerchantAddrCity($city = null)
    {
        $this->MemberData['MerchantAddrCity'] = $city;

        return $this;
    }

    /**
     * 聯絡地址－地區
     *
     * @param  string|null  $area
     * @return self
     */
    public function setMerchantAddrArea($area = null)
    {
        $this->MemberData['MerchantAddrArea'] = $area;

        return $this;
    }

    /**
     * 聯絡地址－郵遞區號
     *
     * @param  string|null  $code
     * @return self
     */
    public function setMerchantAddrCode($code = null)
    {
        $this->MemberData['MerchantAddrCode'] = $code;

        return $this;
    }

    /**
     * 聯絡地址－路名及門牌號碼
     *
     * @param  string|null  $address
     * @return self
     */
    public function setMerchantAddr($address = null)
    {
        $this->MemberData['MerchantAddr'] = $address;

        return $this;
    }

    /**
     * 商店英文聯絡地址
     *
     * @param  string|null  $address
     * @return self
     */
    public function setMerchantEnAddr($address = null)
    {
        $this->MemberData['MerchantEnAddr'] = $address;

        return $this;
    }
}

