<?php

namespace App\Http\Controllers;

use App\Http\Services\RecipeApi;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    protected $recipeApi;

    public function __construct(RecipeApi $recipeApi)
    {
        $this->recipeApi = $recipeApi;
    }

    public function home()
    {
        return view('recipes'); // 検索フォームが表示される
    }
    
    public function search(Request $request)
    {
        // ユーザーが入力したキーワードを取得
        $keyword = $request->input('keyword');

        // 小カテゴリの検索（APIを使ってカテゴリ名をキーワードで検索）
        $categories = $this->recipeApi->getCategoriesByKeyword($keyword);

        // 検索結果のカテゴリをそのままビューに渡す
        return view('recipes', [
            'popularRecipes' => $categories, // カテゴリを popularRecipes としてビューに渡す
            'keyword' => $keyword
        ]);
    }
}