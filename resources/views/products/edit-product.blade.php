<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT PRODUCT</title>
</head>
<body>
    <h1>edit product</h1>
    <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{ $product->title }}">
        <input type="text" name="price" value="{{ $product->price }}">
        <input type="text" name="qty" value="{{ $product->qty }}">
        <input type="text" name="desc" value="{{ $product->desc }}">
        <img src="{{ asset('imgs/'.$product->img_path) }}" alt="img" width="50">
        <input type="file" name="img_path">
        <button type="submit">update</button>
    </form>
</body>
</html>