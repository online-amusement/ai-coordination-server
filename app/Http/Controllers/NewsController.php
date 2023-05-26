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

    public function index(Request $request)
    {
        $newsId = $request->input("searchNewsId");
        $startDate = $request->input("searchStartDate");
        $endDate = $request->input("searchEndDate");
        $sort = $request->input("searchSort");

        $news = $this->newsService->search($newsId, $startDate, $endDate, $sort);

        $news = json_encode($news);

        return view('news', compact('news'));
    }

    public function create(Request $request)
    {
        $news = null;

        return view('news-edit', compact("news"));
    }

    public function edit(Request $request, $id)
    {
        $apiToken = $request->bearerToken();

        $news = $this->newsService->findBy($id)->first();

        $news = json_encode($news);

        return view('news-edit', compact("news"));
    }

    public function save(Request $request)
    {
        $newsId = $request->input('id');
        $newsTitle = $request->input('title');
        $newsDescription = $request->input('description');
        $newsStartedAt = $request->input('started_at');
        $newsEndedAt = $request->input('ended_at');


        $news = $this->newsService->createOrUpdate($newsId, $newsTitle, $newsDescription, $newsStartedAt, $newsEndedAt);

        return redirect()->to('/news');
    }

    public function delete(Request $request, $id) 
    {
        $apiToken = $request->bearerToken();

        $news = $this->newsService->findBy($id)->first();

        $news->delete();

        return redirect()->to('/news');
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
