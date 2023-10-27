<?php

namespace Violetshih\NewebPay\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Violetshih\NewebPay\Partner\MerchantAdd payment(string $no, int $amt, string $desc, string $email) 付款
 * @method static \Violetshih\NewebPay\Partner\MerchantAddWeb creditCancel(string $no, int $amt, string $type = 'order')
 * @method static \Violetshih\NewebPay\Partner\MerchantModify requestPayment(string $no, int $amt, string $type = 'order')

 * @method static mixed decode(string $encryptString)
 *
 * @see \Violetshih\NewebPayy\Partner\NewebPayPartner
 */
class NewebPayPartner extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Violetshih\NewebPay\Partner\NewebPayPartner::class;
    }
}
