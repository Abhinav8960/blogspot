<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('home.homecss')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&display=swap');

        /* ===== Section wrapper — same as contact_section ===== */
        .payment_section {
            padding: 80px 0 80px 0;
            background: #dfdfdf;
        }

        /* ===== Heading ===== */
        .payment_taital {
            font-family: 'Righteous', cursive;
            font-size: 38px;
            font-weight: 700;
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

        /* ===== Card box ===== */
        .payment_box {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.12);
            padding: 40px 36px;
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
            background: linear-gradient(90deg, #1a1a2e, #e74c3c, #1a1a2e);
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
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            font-weight: 700;
            color: #aaa;
            pointer-events: none;
            font-family: 'Syne', sans-serif;
            line-height: 1;
            transition: color 0.2s;
        }

        .amount-input {
            width: 100%;
            padding: 13px 16px 13px 34px;
            border: 1.5px solid #e0e0e0;
            border-radius: 10px;
            font-size: 22px;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
            color: #1a1a2e;
            background: #fafafa;
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
            border-color: #1a1a2e;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(26, 26, 46, 0.08);
        }

        .amount-wrapper:focus-within .rupee-sign {
            color: #1a1a2e;
        }

        .amount-input.input-error {
            border-color: #e74c3c !important;
            background: #fff8f8 !important;
        }

        /* ===== Quick amount buttons — horizontal row ===== */
        .quick-amounts {
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex-shrink: 0;
        }

        .quick-amounts button {
            background: #f0f0f5;
            border: 1.5px solid #e0e0ea;
            border-radius: 7px;
            padding: 5px 12px;
            font-size: 12px;
            font-weight: 600;
            color: #555;
            cursor: pointer;
            white-space: nowrap;
            transition: all 0.18s ease;
            font-family: 'Poppins', sans-serif;
            line-height: 1.4;
        }

        .quick-amounts button:hover {
            background: #1a1a2e;
            border-color: #1a1a2e;
            color: #fff;
        }

        /* ===== Pay button ===== */
        .pay-btn {
            width: 100%;
            padding: 15px 20px;
            background: #1a1a2e;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.08em;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'Syne', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            white-space: nowrap;
            margin-top: 24px;
        }

        .pay-btn:hover {
            background: #e74c3c;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(231, 76, 60, 0.3);
        }

        .pay-btn:active {
            transform: translateY(0);
        }

        /* ===== Trust row ===== */
        .trust_row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid #f0f0f0;
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

                    {{-- Amount input + Quick buttons side by side --}}
                    <div class="amount-row">
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

                        <div class="quick-amounts">
                            <button type="button" onclick="document.getElementById('amountInput').value=100">₹100</button>
                            <button type="button" onclick="document.getElementById('amountInput').value=500">₹500</button>
                            <button type="button" onclick="document.getElementById('amountInput').value=1000">₹1,000</button>
                            <button type="button" onclick="document.getElementById('amountInput').value=2500">₹2,500</button>
                        </div>
                    </div>

                    @error('amount')
                    <small class="text-danger" style="font-size:12px;">{{ $message }}</small>
                    @enderror

                    <button type="submit" class="pay-btn">
                        🔐 &nbsp;PROCEED TO PAY &nbsp;
                        <svg width="15" height="15" viewBox="0 0 16 16" fill="none" style="opacity:0.6;flex-shrink:0">
                            <path d="M3 8h10M9 4l4 4-4 4" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                </form>

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