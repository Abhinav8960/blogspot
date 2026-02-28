<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('home.homecss')

    <style>
        .status_section {
            padding: 100px 0;
            background: #fdf2f2;
            text-align: center;
        }

        .status_box {
            background: #fff;
            max-width: 500px;
            margin: auto;
            padding: 50px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .status_icon {
            font-size: 60px;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        .status_title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .status_text {
            color: #777;
            margin-bottom: 30px;
        }

        .btn_group {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn_custom {
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
        }

        .btn_retry {
            background: #e74c3c;
            color: #fff;
        }

        .btn_retry:hover {
            background: #c0392b;
        }

        .btn_home {
            background: #1a1a2e;
            color: #fff;
        }

        .btn_home:hover {
            background: #000;
        }
    </style>
</head>

<body>

<div class="header_section">
    @include('home.header')
</div>

<div class="status_section">
    <div class="status_box">
        <div class="status_icon">❌</div>
        <div class="status_title">Payment Failed</div>
        <div class="status_text">
            Something went wrong. Please try again.
        </div>

        <div class="btn_group">
            <a href="{{ route('razorpay.index') }}" class="btn_custom btn_retry">
                Retry Payment
            </a>

            <a href="{{ url('/') }}" class="btn_custom btn_home">
                Go Home
            </a>
        </div>
    </div>
</div>

@include('home.footer')

</body>
</html>