<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Laravel Vue JS Ecommerce Website</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Status</th>
                        <th scope="col">Catalog Visibility</th>
                        <th scope="col">Description</th>
                        <th scope="col">Regular Price (RM)</th>
                        <th scope="col">Sale Price (RM)</th>
                        <th scope="col">Stock Quantity</th>
                        <th scope="col">In Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $data)
                    <tr>
                        <th scope="row">{{ $data->id }}</th>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->type }}</td>
                        <td>{{ $data->status }}</td>
                        <td>{{ $data->catalog_visibility }}</td>
                        <td>{{ $data->description }}</td>
                        <td>{{ $data->regular_price }}</td>
                        <td>{{ $data->sale_price }}</td>
                        <td>{{ $data->stock_quantity }}</td>
                        <td>{{ $data->in_stock }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {!! $products->links() !!}
            </div>
        </div>
    </body>
</html>