<?php

namespace App\Repositories;

use App\Models\News;
use Carbon\Carbon;

class NewsRepository
{
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function getNews()
    {
        $now = new Carbon();
        return $this->news
            ->newQuery()
            ->where("started_at", "<=", $now)
            ->where("ended_at", ">=", $now)
            ->get();
    }
}