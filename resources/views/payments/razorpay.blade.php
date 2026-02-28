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
            --red-dark: #c0392b;
            --bg: #dfdfdf;
            --card-bg: #fff;
            --text-muted: #8a8fa8;
            --border: #e2e5ef;
            --input-bg: #f7f8fc;
        }

        /* ===== Section wrapper — SAME as original ===== */
        .payment_section {
            padding: 80px 0 80px 0;
            background: var(--bg);
        }

        /* ===== Heading ===== */
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
            font-weight: 500;
        }

        /* ===== Card box ===== */
        .payment_box {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.04), 0 20px 60px rgba(0, 0, 0, 0.12);
            padding: 44px 40px 36px;
            max-width: 460px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }

        .payment_box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--navy) 0%, var(--red) 50%, var(--navy) 100%);
        }

        /* ===== Field label ===== */
        .field_label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 10px;
            display: block;
        }

        /* ===== Amount input row ===== */
        .amount-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .amount-wrapper {
            position: relative;
            flex: 1;
        }

        .rupee-sign {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            font-weight: 800;
            color: #c8cdd8;
            pointer-events: none;
            font-family: 'Syne', sans-serif;
            line-height: 1;
            transition: color 0.2s;
        }

        .amount-input {
            width: 100%;
            padding: 16px 16px 16px 38px;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-size: 24px;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
            color: var(--navy);
            background: var(--input-bg);
            outline: none;
            box-sizing: border-box;
            transition: all 0.2s ease;
            -moz-appearance: textfield;
        }

        .amount-input::-webkit-outer-spin-button,
        .amount-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .amount-input:focus {
            border-color: var(--navy);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(26, 26, 46, 0.07);
        }

        .amount-wrapper:focus-within .rupee-sign {
            color: var(--navy);
        }

        .amount-input.input-error {
            border-color: var(--red) !important;
            background: #fff8f8 !important;
        }

        /* ===== Quick amount buttons ===== */
        .quick-amounts-row {
            display: flex;
            flex-direction: row;
            gap: 10px;
            /* spacing between buttons */
            flex-wrap: wrap;
            margin-top: 8px;
        }

        .quick-amounts-row button {
            background: #f0f0f5;
            border: 2px solid #e0e0ea;
            border-radius: 10px;
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 700;
            color: #6b7190;
            cursor: pointer;
            transition: 0.2s ease;
        }


        /* Hover same rakha */
        .quick-amounts button:hover {
            background: var(--navy);
            border-color: var(--navy);
            color: #fff;
            transform: translateY(-2px);
            /* thoda premium hover feel */
        }

        /* Optional: Active Click Effect */
        .quick-amounts button:active {
            transform: scale(0.96);
        }

        /* ===== Pay button ===== */
        .pay-btn {
            width: 100%;
            padding: 15px 20px;
            background: var(--navy);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.1em;
            cursor: pointer;
            transition: all 0.22s ease;
            font-family: 'Syne', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            white-space: nowrap;
            margin-top: 24px;
        }

        .pay-btn:hover {
            background: var(--red);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(231, 76, 60, 0.3);
        }

        .pay-btn:active {
            transform: translateY(0);
        }

        /* ===== Divider ===== */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 22px 0 16px;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: #f0f0f0;
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

            <h1 class="payment_taital">Pay To Publish your blog!!</h1>
            <p class="payment_sub">Fast, safe & encrypted checkout via Razorpay</p>

            <div class="payment_box">

                <form action="{{ route('razorpay.payment') }}" method="POST">
                    @csrf

                    <span class="field_label">Enter Amount</span>

                    <div class="amount-row d-flex flex-column">

                        <div class="amount-wrapper">
                            <input
                                type="number"
                                name="amount"
                                id="amountInput"
                                value="{{ old('amount') }}"
                                placeholder="0"
                                class="amount-input @error('amount') input-error @enderror"
                                required>
                            <span class="rupee-sign">₹</span>
                        </div>

                        <div class="quick-amounts-row d-flex gap-2 mt-2">
                            <button type="button" onclick="document.getElementById('amountInput').value=100">₹100</button>
                            <button type="button" onclick="document.getElementById('amountInput').value=500">₹500</button>
                            <button type="button" onclick="document.getElementById('amountInput').value=1000">₹1,000</button>
                            <button type="button" onclick="document.getElementById('amountInput').value=2500">₹2,500</button>
                        </div>

                    </div>

                    @error('amount')
                    <small class="text-danger" style="font-size:12px;margin-top:4px;display:block;">{{ $message }}</small>
                    @enderror

                    <button type="submit" class="pay-btn">
                        🔐 &nbsp;PROCEED TO PAY &nbsp;
                        <svg width="15" height="15" viewBox="0 0 16 16" fill="none" style="opacity:0.6;flex-shrink:0">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                </form>

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