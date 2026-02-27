<!DOCTYPE html>
<html>

<head>
    <title>Business Headlines</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            overflow: hidden;
            transition: 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
            flex: 1;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #222;
        }

        .card-desc {
            font-size: 14px;
            color: #555;
            margin-bottom: 15px;
        }

        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 15px;
            background: #fafafa;
            font-size: 13px;
            border-top: 1px solid #eee;
        }

        .read-btn {
            text-decoration: none;
            background: #007bff;
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
        }

        .read-btn:hover {
            background: #0056b3;
        }

        .empty {
            text-align: center;
            padding: 40px;
            font-size: 18px;
            color: #888;
        }
    </style>
</head>

<body>

<h1>📰 Business Headlines</h1>

@if(count($products) == 0)
    <div class="empty">
        No News Found
    </div>
@else
    <div class="container">
        @foreach($products as $product)
            <div class="card">

                <img src="{{ $product['urlToImage'] ?? 'https://via.placeholder.com/400x200' }}" alt="News Image">

                <div class="card-body">
                    <div class="card-title">
                        {{ \Illuminate\Support\Str::limit($product['title'], 80) }}
                    </div>

                    <div class="card-desc">
                        {{ \Illuminate\Support\Str::limit($product['description'], 120) }}
                    </div>
                </div>

                <div class="card-footer">
                    <span>
                        {{ \Carbon\Carbon::parse($product['publishedAt'])->format('d M Y') }}
                    </span>

                    <a href="{{ $product['url'] }}" target="_blank" class="read-btn">
                        Read More
                    </a>
                </div>

            </div>
        @endforeach
    </div>
@endif

</body>
</html>