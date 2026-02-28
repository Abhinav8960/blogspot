<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    @include('home.homecss')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@400;500;600&display=swap');

        :root {
            --navy: #1a1a2e;
            --red: #e74c3c;
            --green: #22c55e;
            --green-bg: #f0fdf4;
            --green-border: #bbf7d0;
            --bg: #eceef2;
            --card-bg: #fff;
            --text-muted: #8a8fa8;
            --border: #e2e5ef;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'DM Sans', sans-serif; }

        .status_section {
            padding: 80px 0 80px 0;
            background: #dfdfdf;
        }

        

        .status_box {
            background: var(--card-bg);
            max-width: 460px;
            margin: 0 auto;
            padding: 56px 40px 44px;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.04), 0 20px 60px rgba(0,0,0,0.10);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Green accent top bar for success */
        .status_box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--navy), var(--green), var(--navy));
        }

        /* ===== Checkmark circle ===== */
        .status_icon_wrap {
            width: 80px;
            height: 80px;
            margin: 0 auto 28px;
            background: var(--green-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--green-border);
            animation: popIn 0.4s cubic-bezier(0.34,1.56,0.64,1) both;
        }

        @keyframes popIn {
            from { transform: scale(0.5); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .status_icon { font-size: 36px; line-height: 1; }

        /* ===== Confetti dots (pure CSS) ===== */
        .confetti-dot {
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            animation: float 3s ease-in-out infinite;
        }

        .confetti-dot:nth-child(1) { background: var(--green); top: 15%; left: 10%; animation-delay: 0s; }
        .confetti-dot:nth-child(2) { background: var(--red); top: 20%; right: 12%; animation-delay: 0.4s; width:6px; height:6px; border-radius:2px; }
        .confetti-dot:nth-child(3) { background: var(--navy); top: 70%; left: 8%; animation-delay: 0.8s; width:5px; height:5px; }
        .confetti-dot:nth-child(4) { background: var(--green); top: 75%; right: 10%; animation-delay: 1.2s; width:7px; height:7px; border-radius: 2px; }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.6; }
            50% { transform: translateY(-12px) rotate(15deg); opacity: 1; }
        }

        /* ===== Text ===== */
        .status_title {
            font-family: 'Syne', sans-serif;
            font-size: 26px;
            font-weight: 800;
            color: var(--navy);
            margin-bottom: 10px;
            letter-spacing: -0.3px;
        }

        .status_text {
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.65;
            margin-bottom: 36px;
            font-weight: 500;
        }

        /* ===== Button ===== */
        .btn_custom {
            padding: 14px 32px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: 0.06em;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-family: 'Syne', sans-serif;
            transition: all 0.2s ease;
        }

        .btn_home {
            background: var(--navy);
            color: #fff;
            box-shadow: 0 4px 16px rgba(26,26,46,0.18);
        }

        .btn_home:hover {
            background: var(--red);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(231,76,60,0.30);
        }

        /* ===== Divider + Trust ===== */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 32px 0 20px;
        }

        .divider-line { flex: 1; height: 1px; background: var(--border); }
        .divider-text { font-size: 11px; color: #c0c4d4; font-weight: 600; letter-spacing: 0.05em; }

        .trust_row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .trust_item {
            font-size: 11px;
            color: #b0b5c8;
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 600;
        }

        .trust_sep { width: 3px; height: 3px; background: #d8dbe8; border-radius: 50%; }
    </style>
</head>

<body>

<div class="header_section">
    @include('home.header')
</div>

<div class="status_section">
    <div class="container">
        <div class="status_box">

            {{-- Decorative confetti dots --}}
            <span class="confetti-dot"></span>
            <span class="confetti-dot"></span>
            <span class="confetti-dot"></span>
            <span class="confetti-dot"></span>

            <div class="status_icon_wrap">
                <span class="status_icon">✅</span>
            </div>

            <div class="status_title">Payment Successful</div>
            <div class="status_text">
                Thank you! Your payment has been processed successfully.
            </div>

            <a href="{{ url('/') }}" class="btn_custom btn_home">
                🏠 &nbsp;Go Home
            </a>

            <div class="divider">
                <span class="divider-line"></span>
                <span class="divider-text">SECURED BY</span>
                <span class="divider-line"></span>
            </div>

            <div class="trust_row">
                <span class="trust_item">🔒 SSL Encrypted</span>
                <span class="trust_sep"></span>
                <span class="trust_item">✅ PCI DSS Safe</span>
                <span class="trust_sep"></span>
                <span class="trust_item">⚡ Instant</span>
            </div>

        </div>
    </div>
</div>

@include('home.footer')

</body>
</html>