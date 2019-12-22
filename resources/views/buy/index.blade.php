

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
購入履歴一覧

{{-- 変数 --}}
@php
$total = 0;
@endphp

@forelse($stocks as $stock)
<p>{{$stock->name}}　単価：{{$stock->price}}円　個数：{{$stock->cartStockNum}}個　小計：{{$stock->price * $stock->cartStockNum}}円</p>

{{-- 合計金額の計算 --}}
@php
$total += $stock->price * $stock->cartStockNum;
@endphp



@empty
    <p>カートの中に商品はありません。</p>
@endforelse

{{-- 合計金額の表示 --}}
合計金額：{{$total}}円です。

</body>
</html>
