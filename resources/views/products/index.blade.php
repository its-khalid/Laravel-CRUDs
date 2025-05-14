<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEX</title>
</head>
<body>
    @if (session('success'))
        <p> {{ session('success') }} </p>
    @endif
    <h1>content goes heres</h1>
    <a href="{{ route('product.create') }}">create new product</a>
    <form action="{{ route('product.index') }}" method="get">
        <input type="text" name="query" placeholder="Search" value="{{ request('query') }}">
        <button type="submit">search</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>title</th>
                <th>price</th>
                <th>quantity</th>
                <th>description</th>
                <th>image</th>
                <th>update</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td> {{ $product->id }} </td>
                    <td> {{ $product->title }} </td>
                    <td> {{ $product->price }} </td>
                    <td> {{ $product->qty }} </td>
                    <td> {{ $product->desc }} </td>
                    <td> <img src="{{ asset('imgs/'.$product->img_path) }}" alt="img" width="50"> </td>
                    <td> <a href="{{ route('product.edit', $product->id) }}">edit</a> </td>
                    <td>
                        <form action="{{ route('product.delete', $product->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button>delete</button>
                        </form> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>