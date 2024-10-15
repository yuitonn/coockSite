<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <form action="{{ url('/recipes/search') }}" method="get">
        <input type="text" name="keyword" placeholder="料理名を入力">
        <button type="submit">検索</button>
    </form>

    <h1>検索結果</h1>
    @if(isset($popularRecipes) && count($popularRecipes) > 0)
        <h2>どんな{{ $keyword }}が食べたい？</h2>
        <ul>
            @foreach($popularRecipes as $category)
                <li>
                    <a href="{{ $category['categoryUrl'] }}">
                        <p>{{ $category['categoryName'] }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p>該当するカテゴリが見つかりませんでした。</p>
    @endif
</x-app-layout>
