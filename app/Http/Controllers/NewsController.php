<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsService;

class NewsController extends Controller
{
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function news(Request $request)
    {
        $news = $this->newsService->getNews();

        if($news) {
            return response()->json([
                "result" => true,
                "status" => 200,
                "message" => 'お知らせを取得しました。',
                "data" => $news,
            ]);
        }
        return response()->json([
            "result" => false,
            "status" => 401,
            "message" => 'お知らせはありません。',
        ]);
    }
}
