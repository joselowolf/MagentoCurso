<?php
namespace Curso\News\Controller\Adminhtml\AllNews;

class Index extends \Magento\Backend\App\Action
{
	/**
	 * @var [type]
	 */
	protected $resultPageFactory;
	
	/**
	 * @param \Magento\Backend\App\Action\Context $context
	 * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
	 * @param \Curso\News\Helper\Data $helperData
	 */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Curso\News\Helper\Data $helperData
	) {
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
		$this->helperData = $helperData;
	}
    /**
     * @return void
     */
	public function execute()
	{
		//echo $this->helperData->getStorefrontConfig('news_link');
		//exit();
		$resultPage = $this->resultPageFactory->create();
		return $resultPage;
	}
}