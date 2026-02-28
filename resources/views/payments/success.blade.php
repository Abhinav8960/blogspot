<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('home.homecss')

    <style>
        .status_section {
            padding: 100px 0;
            background: #f4f6f9;
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
            color: #28a745;
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

        .btn_custom {
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
        }

        .btn_home {
            background: #1a1a2e;
            color: #fff;
        }

        .btn_home:hover {
            background: #e74c3c;
        }
    </style>
</head>

<body>

<div class="header_section">
    @include('home.header')
</div>

<div class="status_section">
    <div class="status_box">
        <div class="status_icon">✅</div>
        <div class="status_title">Payment Successful</div>
        <div class="status_text">
            Thank you! Your payment has been processed successfully.
        </div>

        <a href="{{ url('/') }}" class="btn_custom btn_home">
            Go Home
        </a>
    </div>
</div>

@include('home.footer')

</body>
</html>