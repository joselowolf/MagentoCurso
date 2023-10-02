<?php
namespace Curso\Vehicle\Controller\Adminhtml\VehicleBrand;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Curso_Vehicle::brand/index';

    const PAGE_TITLE = 'Page Title';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    protected $_vehicleBrandFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
       \Magento\Backend\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       \Curso\Vehicle\Model\VehicleBrandFactory $vehicleBrandFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_vehicleBrandFactory = $vehicleBrandFactory;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $vehicleBrands = $this->_vehicleBrandFactory->create();
		$vehicleBrandsCollection = $vehicleBrands->getCollection();
		
		echo '<pre>';print_r($vehicleBrandsCollection->getData());

        // /** @var \Magento\Framework\View\Result\Page $resultPage */
        // $resultPage = $this->_pageFactory->create();
        // $resultPage->setActiveMenu(static::ADMIN_RESOURCE);
        // $resultPage->addBreadcrumb(__(static::PAGE_TITLE), __(static::PAGE_TITLE));
        // $resultPage->getConfig()->getTitle()->prepend(__(static::PAGE_TITLE));

        // return $resultPage;
    }

}
