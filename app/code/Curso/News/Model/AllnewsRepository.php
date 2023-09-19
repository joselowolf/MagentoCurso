<?php

namespace Curso\News\Model;

use Curso\News\Api\Data;
use Curso\News\Api\AllnewsRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Curso\News\Model\ResourceModel\Allnews as ResourceAllnews;
use Curso\News\Model\ResourceModel\Allnews\CollectionFactory as AllnewsCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class AllnewsRepository implements AllnewsRepositoryInterface
{
    protected $resource;
    protected $allnewsFactory;
    protected $dataObjectHelper;
    protected $dataObjectProcessor;
    protected $dataAllnewsFactory;
    private $storeManager;

    public function __construct(
        ResourceAllnews $resource,
        AllnewsFactory $allnewsFactory,
        Data\AllnewsInterfaceFactory $dataAllnewsFactory,
        DataObjectHelper $dataObjectHelper,
		DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
		$this->allnewsFactory = $allnewsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataAllnewsFactory = $dataAllnewsFactory;
		$this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }
    /**
     * Save method
     *
     * @param \Curso\News\Api\Data\AllnewsInterface $news
     * @return \Curso\News\Api\Data\AllnewsInterface 
     */
    public function save(\Curso\News\Api\Data\AllnewsInterface $news)
    {
        if ($news->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $news->setStoreId($storeId);
        }
        try {
            $this->resource->save($news);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the news: %1', $exception->getMessage()),
                $exception
            );
        }
        return $news;
    }
    /**
     * Get by ID
     *
     * @param string|int $newsId
     * @return object
     */
    public function getById($newsId)
    {
		$news = $this->allnewsFactory->create();
        $news->load($newsId);
        if (!$news->getId()) {
            throw new NoSuchEntityException(__('News with id "%1" does not exist.', $newsId));
        }
        return $news;
    }
	/**
     * Delete an element
     *
     * @param \Curso\News\Api\Data\AllnewsInterface $news
     * @return boolean
     */
    public function delete(\Curso\News\Api\Data\AllnewsInterface $news)
    {
        try {
            $this->resource->delete($news);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the news: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }
    /**
     * Delete by ID
     *
     * @param string|int $newsId
     * @return void
     */
    public function deleteById($newsId)
    {
        return $this->delete($this->getById($newsId));
    }
}
