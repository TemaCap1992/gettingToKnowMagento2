<?php

namespace Amasty\CoolModule\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Index extends Template
{
    /**
     *@var ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function sayWazzupTo($name)
    {
        return 'Wazzup, ' . $name;
    }

    public function sayHelloFromConfig()
    {
        return $this->scopeConfig->getValue('cool_config/general/greeting_text');

    }
    public function showInputQty()
    {
        return $this->scopeConfig->getValue('cool_config/general/field_qty');

    }
//    {
//        return $this->scopeConfig->getValue('cool_config/general/show_qty');
//
//        if( $this->scopeConfig->getValue('cool_config/general/show_qty') == 1
//        ) {
//
//            return $this->scopeConfig->getValue('cool_config/general/show_qty');
//        } else {
//            return 0000000000;
//        }
//
//    }
}
