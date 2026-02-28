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
            --bg: #dfdfdf;
            --card-bg: #fff;
            --text-muted: #8a8fa8;
            --border: #e2e5ef;
        }

        body {
            font-family: 'DM Sans', sans-serif;
        }

        /* ===== Section — same as page 1 ===== */
        .payment_section {
            padding: 80px 0 80px 0;
            background: var(--bg);
        }

        .payment_taital {
            font-family: 'Righteous', cursive;
            font-size: 38px;
            font-weight: 400;
            color: #1a1a2e;
            margin-bottom: 6px;
            text-align: center;
        }

        .payment_sub {
            font-size: 14px;
            color: #888;
            margin-bottom: 36px;
            text-align: center;
        }

        /* ===== Card ===== */
        .payment_box {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04), 0 20px 60px rgba(0, 0, 0, 0.10);
            padding: 60px 40px 48px;
            max-width: 460px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .payment_box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--navy) 0%, var(--red) 50%, var(--navy) 100%);
            background-size: 200% 100%;
            animation: shimmer 2s linear infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: 200% center;
            }

            100% {
                background-position: -200% center;
            }
        }

        /* ===== Spinner ===== */
        .spinner-wrap {
            width: 72px;
            height: 72px;
            margin: 0 auto 28px;
            position: relative;
        }

        .spinner-wrap::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 4px solid var(--border);
        }

        .spinner-wrap::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 4px solid transparent;
            border-top-color: var(--red);
            border-right-color: var(--navy);
            animation: spin 0.9s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .spinner-icon {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
        }

        .processing-title {
            font-family: 'Syne', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 8px;
        }

        .processing-text {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* ===== Divider ===== */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 32px 0 20px;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .divider-text {
            font-size: 11px;
            color: #c0c4d4;
            font-weight: 600;
            letter-spacing: 0.05em;
        }

        /* ===== Trust row ===== */
        .trust_row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .trust_item {
            font-size: 11px;
            color: #bbb;
            display: flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
        }

        .trust_sep {
            width: 3px;
            height: 3px;
            background: #ddd;
            border-radius: 50%;
            flex-shrink: 0;
        }
    </style>
</head>

<body>

    <div class="header_section">
        @include('home.header')
    </div>

    <div class="payment_section">
        <div class="container">

            <h1 class="payment_taital">Processing ...</h1>
            <p class="payment_sub">Fast, safe & encrypted checkout via Razorpay</p>

            <div class="payment_box">

                <div class="spinner-wrap">
                    <span class="spinner-icon">💳</span>
                </div>

                <div class="processing-title">Opening Payment Gateway</div>
                <p class="processing-text">Please wait while we securely redirect you to Razorpay. Do not close this window.</p>

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

            {{-- Razorpay script — logic untouched --}}
            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
            <script>
                var redirectUrl = "{{ route('razorpay.index') }}";

                var timeoutRedirect = setTimeout(function() {
                    window.location.href = redirectUrl;
                }, 10000); // 5 seconds

                var options = {
                    "key": "{{env('RAZORPAY_KEY')}}",
                    "amount": "{{ $amount }}",
                    "currency": "INR",
                    "name": "BlogSpot",
                    "description": "Test Transaction",
                    "order_id": "{{ $orderId }}",

                    "handler": function(response) {
                        clearTimeout(timeoutRedirect); // stop timeout if success

                        var payId = response.razorpay_payment_id;
                        var orderId = response.razorpay_order_id;
                        var sign = response.razorpay_signature;

                        window.location.href =
                            "{{ route('razorpay.callback') }}?payId=" + payId +
                            "&orderId=" + orderId +
                            "&sign=" + sign;
                    },

                    "modal": {
                        "ondismiss": function() {
                            window.location.href = redirectUrl;
                        }
                    },

                    "prefill": {
                        "name": "{{ $name }}",
                        "email": "{{ $email }}",
                        "contact": "{{ $contact }}"
                    },

                    "theme": {
                        "color": "#1a1a2e"
                    }
                };

                var rzp1 = new Razorpay(options);

                window.onload = function() {
                    rzp1.open();
                };
            </script>

        </div>
    </div>

    @include('home.footer')

</body>

</html>