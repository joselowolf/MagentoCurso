<?php
namespace Curso\News\Api;

interface AllnewsRepositoryInterface
{
	public function save(\Curso\News\Api\Data\AllnewsInterface $news);

    public function getById($newsId);

    public function delete(\Curso\News\Api\Data\AllnewsInterface $news);

    public function deleteById($newsId);
}
