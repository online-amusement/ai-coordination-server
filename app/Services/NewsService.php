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
}