<?php
namespace Curso\HelloWorld\Block\Index;

class ByeWorld extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getByeWorldMessage()
    {
        return 'Chao lola';
    }
    public function getCurrentDate(){
        return  date('Y-m-d');
    }
}