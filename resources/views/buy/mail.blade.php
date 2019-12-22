
<div>
    この度はご購入ありがとうございます。
</div>
<div>
    入金が確認され次第、発送いたします。
</div>
<div>


{{-- 変数 --}}
@php
$total = 0;
@endphp

@forelse($parameter as $stock)
<p>{{$stock->name}}　単価：{{$stock->price}}円　個数：{{$stock->cartStockNum}}個　小計：{{$stock->price * $stock->cartStockNum}}円</p>

{{-- 合計金額の計算 --}}
@php
$total += $stock->price * $stock->cartStockNum;
@endphp


@empty
    <p>商品はありません。</p>
@endforelse

{{-- 合計金額の表示 --}}
合計金額：{{$total}}円です。
</div>