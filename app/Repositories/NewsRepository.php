<?php

namespace App\Repositories;

use App\Models\News;
use Carbon\Carbon;

class NewsRepository
{
    const ASC = 'asc';
    const DESC = 'desc';

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

    public function search($newsId, $startDate, $endDate, $sort)
    {
        $news = $this->news->newQuery();

        if($newsId != null) {
            $news = $news->where("id", $newsId);
        }

        if($startDate != null || $endDate != null){
            $news = $news->where("started_at", '>' ,$startDate)->where("ended_at", '<', $endDate);
        }

        if($sort == "降順") {
            return $news
                ->orderBy("id", self::DESC)
                ->paginate(10);
        }else {
            return $news
                ->orderBy("id", self::ASC)
                ->paginate(10);
        }
    }

    public function findBy($id)
    {
        return $this->news
            ->newQuery()
            ->where("id", $id);
    }

    public function createOrUpdate($newsId, $newsTitle, $newsDescription, $newsStartedAt, $newsEndedAt)
    {
        $news = $this->news->newQuery();

        $image = $news->find($newsId);
        if(is_null($image)) {
            $newsImage = null;
        }else {
            $newsImage = $image->image;
        }

        $news = $news->updateOrCreate(
            ["id" => $newsId],
            [
                "title" => $newsTitle, 
                "description" => $newsDescription, 
                "image" => $newsImage, 
                "started_at" => $newsStartedAt, 
                "ended_at" => $newsEndedAt, 
            ],
        );

        return $news;
    }
}
