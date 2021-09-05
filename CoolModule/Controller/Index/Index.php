<?php

namespace Amasty\CoolModule\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
class Index extends Action
{
    /**
     *@var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     *@var CheckoutSession
     */
    private $session;

    /**
     *@var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     *@var ProductCollectionFactory
     */
    private $productColletionFactory;


    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        CheckoutSession $session,
        ProductRepositoryInterface $productRepository,
        ProductCollectionFactory $collectionFactory

    )
    {
        $this->scopeConfig = $scopeConfig;
        $this->session = $session;
        $this->productRepository = $productRepository;
        $this->productColletionFactory = $collectionFactory;
        parent::__construct($context);

    }

    public function execute()
    {
        $productCollection = $this->productColletionFactory->create();
        $productCollection->addAttributeToFilter('sku', ['24-MB01']);
        foreach ($productCollection as $product) {
       // echo $product->getSku();
        }
      //die();


        $product = $this->productRepository->get('24-MB01');

        $quote = $this->session->getQuote();
        if (!$quote->getId()){
            $quote->save();
        }
        $quote->addProduct($product, 3);
        $quote->save();
//        die('done');



        if( $this->scopeConfig->isSetFlag('cool_config/general/enabled')
        ) {
            return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        } else {
            die('SORRY, go home!!');
        }
    }
}


