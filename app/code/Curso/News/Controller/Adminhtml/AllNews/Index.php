<?php
namespace Curso\News\Controller\Adminhtml\AllNews;

class Index extends \Magento\Backend\App\Action
{
	/**
	 * Undocumented variable
	 *
	 * @var \Curso\News\Model\AllnewsFactory $allNewsFactory
	 */
	protected $allNewsFactory;
	/**
	 * @var \Magento\Framework\View\Result\PageFactory $resultPageFactory
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
		\Curso\News\Model\AllnewsFactory $allNewsFactory
	) {
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
		$this->allNewsFactory = $allNewsFactory;
	}
    /**
     * @return void
     */
	public function execute()
	{
		$allnews = $this->allNewsFactory->create();
		$newsCollection = $allnews->getCollection();
		
		echo '<pre>';print_r($newsCollection->getData());
		// $resultPage = $this->resultPageFactory->create();
		// return $resultPage;
	}
}