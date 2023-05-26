<?php

namespace App\Services;

use App\Repositories\NewsRepository;

class NewsService
{
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function getNews()
    {
        return $this->newsRepository->getNews();
    }

    public function search($newsId, $startDate, $endDate, $sort)
    {
        return $this->newsRepository->search($newsId, $startDate, $endDate, $sort);
    }

    public function findBy($id)
    {
        return $this->newsRepository->findBy($id);
    }

    public function createOrUpdate($newsId, $newsTitle, $newsDescription, $newsStartedAt, $newsEndedAt)
    {
        return $this->newsRepository->createOrUpdate($newsId, $newsTitle, $newsDescription, $newsStartedAt, $newsEndedAt);
    }
}