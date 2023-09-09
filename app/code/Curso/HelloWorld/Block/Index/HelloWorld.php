<?php
namespace Curso\HelloWorld\Block\Index;

class HelloWorld extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getHelloWorldMessage()
    {
        return 'Hola, este es nuestro primer módulo';
    }
    public function getCurrentDate(){
        return  date('Y-m-d');
    }
}