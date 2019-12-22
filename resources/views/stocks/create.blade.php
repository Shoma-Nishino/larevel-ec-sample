<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post" action="{{ url('/stocks') }}">
        {{ csrf_field() }}
        <p><label for="name">商品名</label></p>
        <p><input type="text" name="name" value="{{old('name')}}"></p>

        <p><label for="stockNum">出品数</label></p>
        <p><input type="text" name="stockNum" value="{{old('stockNum')}}"></p>

        <p><label for="pricd">金額</label></p>
        <p><input type="text" name="price" value="{{old('price')}}"></p>

        <p><input type="submit" value="送信"></p>
    </form>
</body>
</html>