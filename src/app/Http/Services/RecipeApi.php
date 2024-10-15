<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;
class RecipeApi
{
    protected $apiUrl = 'https://app.rakuten.co.jp/services/api/Recipe/';
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('RAKUTEN_API_KEY');
    }

    // キーワードを用いて小カテゴリを検索するメソッド
    public function getCategoriesByKeyword($keyword)
    {
        // 楽天レシピAPIから小カテゴリを取得
        $response = Http::get($this->apiUrl . 'CategoryList/20170426', [
            'applicationId' => $this->apiKey,
            'categoryType' => 'small', // 小カテゴリのみ取得
        ]);
        

        // 小カテゴリを取得し、キーワードに基づいてフィルタリング
        $categories = $response->json()['result']['small'];
        

        // カテゴリ名にキーワードが含まれるものを返す
        return array_filter($categories, function($category) use ($keyword) {
            return strpos($category['categoryName'], $keyword) !== false;
        });
    }
}