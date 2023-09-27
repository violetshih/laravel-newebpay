<?php

namespace Violetshih\NewebPay\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Violetshih\NewebPay\NewebPayMPG payment(string $no, int $amt, string $desc, string $email) 付款
 * @method static \Violetshih\NewebPay\NewebPayCancel creditCancel(string $no, int $amt, string $type = 'order')
 * @method static \Violetshih\NewebPay\NewebPayClose requestPayment(string $no, int $amt, string $type = 'order')
 * @method static \Violetshih\NewebPay\NewebPayClose requestRefund(string $no, int $amt, string $type = 'order')
 * @method static \Violetshih\NewebPay\NewebPayQuery query(string $no, int $amt)
 * @method static \Violetshih\NewebPay\NewebPayCreditCard creditcardFirstTradeBackend(array $data)
 * @method static \Violetshih\NewebPay\NewebPayCreditCard creditcardFirstTradeFrontend(array $data)
 * @method static \Violetshih\NewebPay\NewebPayCreditCard creditcardTradeWithToken(array $data)
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
