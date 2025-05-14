<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREATE PRODUCT</title>
</head>
<body>
    <h1>create new product</h1>
    <form action="{{ route('product.save') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <input type="text" name="title" placeholder="Product title">
        <input type="text" name="price" placeholder="Price">
        <input type="text" name="qty" placeholder="Quantity">
        <input type="text" name="desc" placeholder="Description">
        <input type="file" name="img_path">
        <button type="submit">create</button>
    </form>
    <a href="{{ route('product.index') }}">cancel</a>
</body>
</html>