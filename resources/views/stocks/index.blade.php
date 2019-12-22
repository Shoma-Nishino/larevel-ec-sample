<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <a href="{{ url('stocks/create') }}">商品新規登録</a>
    <a href="{{ url('carts/index') }}">カートを見る</a>
    <a href="{{ url('buy/index') }}">購入履歴</a>
    @if (!Auth::check()) 
        <a href="{{ route('login') }}">Login</a>
    @endif
    @if (Auth::check())
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    @endif


    <p>開発中のときだけ表示させているユーザーID：{{var_dump(Auth::id())}}</p>

    <form method="GET" action="/">
        <input type="text" name="keyword">
        <input type="submit" value="商品検索">
    </form>

    @forelse($stocks as $stock)

    <p>商品名</p>
    {{$stock->name}}

    <p>出品数</p>
    {{$stock->stockNum}}

    <p>価格</p>
    {{$stock->price}}

    <form method="post" action="{{ url('/carts') }}">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="stock_id" value="{{ $stock->id }}">
        <p><label for="cartStockNum">購入数</label></p>
        <p><input type="text" name="cartStockNum" value="{{old('cartStockNum')}}"></p>
        <p><input type="submit" value="カートに入れる"></p>
    </form>

    @empty
    <p>投稿がありません。</p>
    @endforelse

    <p>ページネーション</p>
    {{ $stocks->links() }}
</body>
</html>
