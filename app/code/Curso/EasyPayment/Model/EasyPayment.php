<?php
namespace Curso\EasyPayment\Model;

class EasyPayment extends \Magento\Payment\Model\Method\AbstractMethod
{

    const EASY_PAYMENT_METHOD_INVOICE_CODE = 'easypayment';

    /**
    * Payment method code
    *
    * @var string
    */
    protected $_code = self::EASY_PAYMENT_METHOD_INVOICE_CODE;
}