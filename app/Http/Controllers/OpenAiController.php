<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class OpenAiController extends Controller
{
    public function imageCreate(Request $request)
    {
        $text = $request->get("text");

        $response =  OpenAI::images()->create([
            'prompt' => $text,
            'n' => 1,
            'size' => '512x512',
            'response_format' => 'url',
        ]);

        foreach($response["data"] as $res) {
            $url["url"] = $res["url"];
        }

        return response()->json([
            "result" => true,
            "status" => 200,
            "message" => "画像の生成に成功しました。",
            "data" => $url["url"],
        ]);
    }

    public function imageEdit(Request $request)
    {
        $text = $request->get("text");
        $image = $request->get("image");
        $image2 = $request->get("image2");

        $response = OpenAI::images()->edit([
            'image' => fopen($image, 'r'),
            'mask' => fopen('image_edit_mask.png', 'r'),
            'prompt' => $text,
            'n' => 1,
            'size' => '256x256',
            'response_format' => 'url',
        ]);

        $response = $response->created;

        foreach ($response->data as $data) {
            $data->url; 
            $data->b64_json; 
        }

        return response()->json([
            "result" => true,
            "status" => 200,
            "message" => "画像を編集しました。",
            "data" => $response->toArray(),
        ]);
    }
}
