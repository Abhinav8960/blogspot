<!DOCTYPE html>
<html>

<head>
    <title>Fake Store Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        .table-container {
            overflow-x: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background-color: #007bff;
            color: white;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            font-size: 15px;
            text-transform: uppercase;
        }

        tbody tr {
            border-bottom: 1px solid #ddd;
            transition: 0.3s;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        img {
            height: 60px;
            object-fit: contain;
        }

        .price {
            font-weight: bold;
            color: green;
        }

        .badge {
            background: #28a745;
            color: white;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <h1>🛒 Fake Store Products Table</h1>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                @if(count($products) == 0)
                <tr>
                    <td colspan="6" style="text-align:center; padding:25px; color:grey; font-weight:bold;">
                        No Product Found
                    </td>
                </tr>
                @else
                @foreach($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <img src="{{ $product['image'] }}" alt="Product">
                    </td>
                    <td>{{ \Illuminate\Support\Str::limit($product['title'], 40) }}</td>
                    <td>
                        <span class="badge">{{ $product['category'] }}</span>
                    </td>
                    <td class="price">₹ {{ $product['price'] }}</td>
                    <td>
                        ⭐ {{ $product['rating']['rate'] }}
                        ({{ $product['rating']['count'] }})
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

</body>

</html>