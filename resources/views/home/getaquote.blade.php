{{-- ===================== GET A QUOTE BUTTON ===================== --}}
<div class="getquote_bt">
    <a href="javascript:void(0)" onclick="openQuotePopup()">Get A Quote</a>
</div>

{{-- Bootstrap Icons CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

{{-- ===================== QUOTE POPUP ===================== --}}
<div id="quotePopup" class="qp-overlay" onclick="handleOverlayClick(event)">
    <div class="qp-modal">

        {{-- Close --}}
        <button type="button" class="qp-close" onclick="closeQuotePopup()">
            <i class="bi bi-x-lg"></i>
        </button>

        {{-- Header --}}
        <div class="qp-header">
            <div class="qp-header-icon"><i class="bi bi-chat-quote-fill"></i></div>
            <div>
                <h4>Get A Free Quote</h4>
                <p>We'll get back to you within 24 hours</p>
            </div>
        </div>

        <form id="quoteForm" onsubmit="submitQuoteForm(event)">
            @csrf

            {{-- Name & Email row --}}
            <div class="qp-field">
                <span class="qp-field-icon"><i class="bi bi-person"></i></span>
                <input type="text" name="name" class="qp-input" placeholder="Full Name" required>
            </div>

            <div class="qp-field">
                <span class="qp-field-icon"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="qp-input" placeholder="Email Address" required>
            </div>

            {{-- Phone --}}
            <div class="qp-field">
                <span class="qp-field-icon"><i class="bi bi-telephone"></i></span>
                <input type="tel" id="q_phone" name="phone" class="qp-input" placeholder="Phone Number" required maxlength="15">
            </div>

            {{-- Custom Dropdown --}}
            <input type="hidden" name="subject" id="q_subject_val">
            <div class="qp-drop" id="qpDrop">
                <button type="button" class="qp-drop-btn" onclick="toggleDrop()">
                    <i class="bi bi-compass" style="color:#aaa; font-size:15px;"></i>
                    <span id="qpDropLabel">Select Activity</span>
                    <i class="bi bi-chevron-down qp-chev"></i>
                </button>
                <div class="qp-drop-list" id="qpDropList">
                    <div class="qp-drop-item" onclick="pickDrop('Adventure', this)"><i class="bi bi-lightning-charge"></i> Adventure</div>
                    <div class="qp-drop-item" onclick="pickDrop('Mountaineering', this)"><i class="bi bi-triangle"></i> Mountaineering</div>
                    <div class="qp-drop-item" onclick="pickDrop('Rafting', this)"><i class="bi bi-water"></i> Rafting</div>
                    <div class="qp-drop-item" onclick="pickDrop('Hitchhiking', this)"><i class="bi bi-signpost-split"></i> Hitchhiking</div>
                    <div class="qp-drop-item" onclick="pickDrop('Trekking', this)"><i class="bi bi-map"></i> Trekking</div>
                </div>
            </div>

            {{-- Message --}}
            <div class="qp-field">
                <span class="qp-field-icon qp-field-icon-ta"><i class="bi bi-chat-left-text"></i></span>
                <textarea name="message" class="qp-input qp-textarea" placeholder="Your Message (optional)" rows="2"></textarea>
            </div>

            {{-- Submit --}}
            <button type="submit" class="qp-btn" id="qp-submit-btn">
                <span id="qp-btn-text"><i class="bi bi-send me-1"></i> Send Request</span>
                <span id="qp-btn-loader" style="display:none;">
                    <span class="qp-spinner"></span> Sending...
                </span>
            </button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .qp-overlay {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 9999;
        background: rgba(0, 0, 0, 0.55);
        align-items: center;
        justify-content: center;
        padding: 12px;
    }

    .qp-overlay.active {
        display: flex;
    }

    .qp-modal {
        background: #fff;
        width: 100%;
        max-width: 430px;
        border-radius: 16px;
        padding: 26px 22px 22px;
        position: relative;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.18);
        animation: qpUp .2s ease;
    }

    @keyframes qpUp {
        from {
            opacity: 0;
            transform: translateY(16px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Close */
    .qp-close {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 30px;
        height: 30px;
        background: #f3f4f6;
        border: none;
        border-radius: 50%;
        font-size: 13px;
        cursor: pointer;
        color: #555;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background .15s, transform .2s;
        line-height: 1;
    }

    .qp-close:hover {
        background: #e5e7eb;
        color: #111;
        transform: rotate(90deg);
    }

    /* Header */
    .qp-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
        padding-right: 28px;
    }

    .qp-header-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: linear-gradient(135deg, #2b2278, #8b5cf6);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 20px;
        flex-shrink: 0;
    }

    .qp-header h4 {
        margin: 0 0 2px;
        font-size: 17px;
        font-weight: 700;
        color: #111;
    }

    .qp-header p {
        margin: 0;
        font-size: 12.5px;
        color: #888;
    }

    /* Two col row */
    .qp-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    /* Field wrapper */
    .qp-field {
        position: relative;
        margin-top: 10px;
    }

    .qp-field-icon {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #bbb;
        font-size: 14px;
        pointer-events: none;
        z-index: 1;
        display: flex;
        align-items: center;
    }

    .qp-field-icon-ta {
        top: 11px;
        transform: none;
    }

    /* Inputs */
    .qp-input {
        display: block;
        width: 100%;
        height: 40px;
        padding: 0 12px 0 34px;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        font-size: 13.5px;
        color: #222;
        background: #f9fafb;
        box-sizing: border-box;
        outline: none;
        font-family: inherit;
        transition: border-color .2s, background .2s;
    }

    .qp-input:focus {
        border-color: #2b2278;
        background: #fff;
    }

    .qp-input::placeholder {
        color: #bbb;
    }

    .qp-textarea {
        height: auto;
        padding: 10px 12px 10px 34px;
        resize: none;
    }

    /* Dropdown */
    .qp-drop {
        position: relative;
        margin-top: 10px;
    }

    .qp-drop-btn {
        width: 100%;
        height: 40px;
        padding: 0 12px;
        background: #f9fafb;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        font-size: 13.5px;
        color: #bbb;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        outline: none;
        transition: border-color .2s, background .2s;
        font-family: inherit;
    }

    .qp-drop-btn span {
        flex: 1;
        text-align: left;
    }

    .qp-drop-btn.selected {
        color: #222;
    }

    .qp-drop.open .qp-drop-btn,
    .qp-drop-btn:focus {
        border-color: #2b2278;
        background: #fff;
    }

    .qp-chev {
        font-size: 12px;
        color: #bbb;
        transition: transform .2s;
        flex-shrink: 0;
    }

    .qp-drop.open .qp-chev {
        transform: rotate(180deg);
    }

    .qp-drop-list {
        display: none;
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        right: 0;
        background: #fff;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        z-index: 99999;
        overflow: hidden;
    }

    .qp-drop.open .qp-drop-list {
        display: block;
    }

    .qp-drop-item {
        padding: 9px 14px;
        font-size: 13.5px;
        color: #333;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background .12s;
    }

    .qp-drop-item i {
        font-size: 14px;
        color: #aaa;
    }

    .qp-drop-item:hover {
        background: #f0f0ff;
        color: #2b2278;
    }

    .qp-drop-item:hover i {
        color: #2b2278;
    }

    .qp-drop-item.active {
        background: #ede9fe;
        color: #2b2278;
        font-weight: 600;
    }

    .qp-drop-item.active i {
        color: #2b2278;
    }

    /* Submit */
    .qp-btn {
        margin-top: 14px;
        width: 100%;
        height: 44px;
        background: linear-gradient(135deg, #2b2278, #8b5cf6);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 14.5px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(99, 102, 241, .4);
        transition: opacity .2s, transform .15s;
        font-family: inherit;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .qp-btn:hover:not(:disabled) {
        opacity: .9;
        transform: translateY(-1px);
    }

    .qp-btn:active:not(:disabled) {
        transform: scale(.98);
    }

    .qp-btn:disabled {
        opacity: .6;
        cursor: not-allowed;
    }

    /* Spinner */
    @keyframes qpSpin {
        to {
            transform: rotate(360deg);
        }
    }

    .qp-spinner {
        width: 15px;
        height: 15px;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, .4);
        border-top-color: #fff;
        display: inline-block;
        animation: qpSpin .7s linear infinite;
    }

    @media (max-width: 480px) {
        .qp-row {
            grid-template-columns: 1fr;
        }

        .qp-modal {
            padding: 20px 14px 18px;
        }
    }
</style>

<script>
    function openQuotePopup() {
        document.getElementById('quotePopup').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeQuotePopup() {
        document.getElementById('quotePopup').classList.remove('active');
        document.body.style.overflow = '';
        closeDrop();
    }

    function handleOverlayClick(e) {
        if (e.target === document.getElementById('quotePopup')) closeQuotePopup();
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeQuotePopup();
    });

    function toggleDrop() {
        document.getElementById('qpDrop').classList.toggle('open');
    }

    function closeDrop() {
        document.getElementById('qpDrop').classList.remove('open');
    }

    function pickDrop(val, el) {
        document.getElementById('q_subject_val').value = val;
        document.getElementById('qpDropLabel').textContent = val;
        document.getElementById('qpDrop').querySelector('.qp-drop-btn').classList.add('selected');
        document.querySelectorAll('.qp-drop-item').forEach(function(i) {
            i.classList.remove('active');
        });
        el.classList.add('active');
        closeDrop();
    }
    document.addEventListener('click', function(e) {
        var d = document.getElementById('qpDrop');
        if (d && !d.contains(e.target)) closeDrop();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var ph = document.getElementById('q_phone');
        if (!ph) return;
        ph.addEventListener('keypress', function(e) {
            if (!/[0-9+\-\s]/.test(e.key)) e.preventDefault();
        });
        ph.addEventListener('paste', function(e) {
            e.preventDefault();
            this.value = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9+\-\s]/g, '');
        });
        ph.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9+\-\s]/g, '');
        });
    });

    function submitQuoteForm(e) {
        e.preventDefault();
        if (!document.getElementById('q_subject_val').value) {
            document.getElementById('qpDrop').querySelector('.qp-drop-btn').style.borderColor = '#ef4444';
            return;
        }
        var form = document.getElementById('quoteForm');
        var btn = document.getElementById('qp-submit-btn');
        var btnTxt = document.getElementById('qp-btn-text');
        var loader = document.getElementById('qp-btn-loader');

        btn.disabled = true;
        btnTxt.style.display = 'none';
        loader.style.display = 'flex';

        var csrf = form.querySelector('input[name="_token"]');
        fetch("{{ route('quote.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf ? csrf.value : ''
                },
                body: new FormData(form)
            })
            .then(function(r) {
                return r.json();
            })
            .then(function(data) {
                if (data.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sent!',
                        text: data.message || 'We will contact you shortly.',
                        confirmButtonColor: '#2b2278'
                    });
                    form.reset();
                    document.getElementById('qpDropLabel').textContent = 'Select Activity';
                    document.getElementById('qpDrop').querySelector('.qp-drop-btn').classList.remove('selected');
                    document.querySelectorAll('.qp-drop-item').forEach(function(i) {
                        i.classList.remove('active');
                    });
                    closeQuotePopup();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: data.message || 'Something went wrong.',
                        confirmButtonColor: '#2b2278'
                    });
                }
            })
            .catch(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Network error.',
                    confirmButtonColor: '#2b2278'
                });
            })
            .finally(function() {
                btn.disabled = false;
                btnTxt.style.display = 'flex';
                loader.style.display = 'none';
            });
    }
</script>