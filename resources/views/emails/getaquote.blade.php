<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #1a1a2e;
        }

        .bs-wrap {
            width: 100%;
            max-width: 100%;
            font-family: 'Poppins', sans-serif;
            background: #1a1a2e;
            overflow: hidden;
        }

        /* ── HEADER ── */
        .bs-header {
            text-align: center;
            width: 100%;
            padding: 20px 16px 15px;
            background: transparent;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .logo-text {
            font-family: 'Poppins', sans-serif;
            font-size: 60px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: -1.5px;
            position: relative;
            z-index: 2;
        }

        .logo-blog {
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .logo-spot {
            background: linear-gradient(45deg, #66b2c5, #89d8fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ── NOTIFICATION STRIP ── */
        .bs-notif {
            background: linear-gradient(90deg, rgba(102, 178, 197, 0.12), rgba(102, 178, 197, 0.06));
            border-bottom: 1px solid rgba(102, 178, 197, 0.15);
            padding: 10px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* ── BODY ── */
        .bs-body {
            padding: 22px 20px 26px;
        }

        /* ── FIELD ROWS ── */
        .bs-field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            border-bottom: 1px solid rgba(102, 178, 197, 0.12);
        }

        .bs-field {
            padding: 10px 0;
        }

        .bs-field:first-child {
            padding-right: 20px;
            border-right: 1px solid rgba(102, 178, 197, 0.12);
        }

        .bs-field:last-child {
            padding-left: 20px;
        }

        .bs-field-single {
            padding: 10px 0;
            border-bottom: 1px solid rgba(102, 178, 197, 0.12);
        }

        .bs-label {
            font-size: 10px;
            color: rgba(102, 178, 197, 0.7);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
            margin-bottom: 3px;
        }

        .bs-value {
            font-size: 13px;
            color: #f0f0f0;
            font-weight: 500;
            word-break: break-all;
        }

        /* ── FOOTER ── */
        .bs-footer {
            background: rgba(0, 0, 0, 0.3);
            border-top: 1px solid rgba(255, 255, 255, 0.07);
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        @media (max-width: 500px) {
            .bs-field-row {
                grid-template-columns: 1fr;
            }

            .bs-field:first-child {
                padding-right: 0;
                border-right: none;
                border-bottom: 1px solid rgba(102, 178, 197, 0.12);
            }

            .bs-field:last-child {
                padding-left: 0;
            }

            .logo-text {
                font-size: 40px !important;
            }

            .bs-body {
                padding: 18px 14px 22px;
            }

            .notif-badge {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="bs-wrap">

        <!-- LOGO HEADER -->
        <div class="bs-header">
            <a href="/" style="text-decoration: none; display: inline-block; transition: all 0.3s ease;">
                <div style="line-height: 1; position: relative; display: inline-block;">
                    <span class="logo-text logo-blog">Blog</span><span class="logo-text logo-spot">Spot</span>
                    <div style="position: absolute; bottom: 5px; left: 0; right: 0; height: 15px; background: rgba(102,178,197,0.2); filter: blur(10px); z-index: 1;"></div>
                </div>
                <div style="position: relative; margin-top: 10px;">
                    <div style="height: 3px; width: 150px; background: linear-gradient(90deg, transparent, #66b2c5, #66b2c5, transparent); margin: 0 auto 15px; border-radius: 3px; box-shadow: 0 0 15px rgba(102,178,197,0.7);"></div>
                    <div style="font-family: 'Poppins', sans-serif; font-size: 13px; color: #b0b0b0; letter-spacing: 4px; text-transform: uppercase; font-weight: 300; text-shadow: 0 1px 2px rgba(0,0,0,0.3);">
                        WRITE <span style="color: #66b2c5; margin: 0 5px;">•</span> SHARE <span style="color: #66b2c5; margin: 0 5px;">•</span> INSPIRE
                    </div>
                </div>
            </a>
        </div>

        <!-- Notification Strip -->
        <div class="bs-notif">
            <div style="width: 8px; height: 8px; border-radius: 50%; background: #66b2c5; box-shadow: 0 0 8px rgba(102,178,197,0.8); flex-shrink: 0;"></div>
            <span style="font-size: 11px; color: #66b2c5; font-weight: 500; letter-spacing: 1.5px; text-transform: uppercase;">New message received</span>
            <span class="notif-badge" style="margin-left: auto; background: rgba(102,178,197,0.12); border: 1px solid rgba(102,178,197,0.35); border-radius: 20px; padding: 3px 12px; font-size: 10px; color: #89d8fc; font-weight: 600; letter-spacing: 1px; text-transform: uppercase;">Contact Form</span>
        </div>

        <!-- BODY -->
        <div class="bs-body">

            <h1 style="font-size: 18px; font-weight: 700; color: #ffffff; margin: 0 0 3px; letter-spacing: -0.3px;">Contact Form Submission</h1>
            <p style="font-size: 12px; color: #b0b0b0; font-weight: 300; margin: 0 0 18px; opacity: 0.6;">Someone just reached out through your website</p>

            <!-- Name + Phone -->
            <div class="bs-field-row">
                <div class="bs-field">
                    <div class="bs-label">Name</div>
                    <div class="bs-value">{{ $contact->name }}</div>
                </div>
                <div class="bs-field">
                    <div class="bs-label">Phone</div>
                    <div class="bs-value">{{ $contact->phone }}</div>
                </div>
            </div>

            <!-- Email -->
            <div class="bs-field-single">
                <div class="bs-label">Email Address</div>
                <div class="bs-value" style="background: linear-gradient(45deg, #66b2c5, #89d8fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ $contact->email }}</div>
            </div>

            <!-- Divider -->
            <div style="display: flex; align-items: center; gap: 10px; margin: 18px 0 15px;">
                <div style="flex: 1; height: 1px; background: linear-gradient(90deg, transparent, rgba(102,178,197,0.35), transparent);"></div>
                <div style="width: 26px; height: 26px; border: 1px solid rgba(102,178,197,0.35); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 0 8px rgba(102,178,197,0.15);">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#66b2c5" stroke-width="2">
                        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                    </svg>
                </div>
                <div style="flex: 1; height: 1px; background: linear-gradient(90deg, transparent, rgba(102,178,197,0.35), transparent);"></div>
            </div>

            <!-- Message -->
            <div style="background: rgba(0,0,0,0.2); border: 1px solid rgba(102,178,197,0.12); border-radius: 10px; overflow: hidden;">
                <div style="background: rgba(102,178,197,0.08); border-bottom: 1px solid rgba(102,178,197,0.12); padding: 10px 15px; display: flex; align-items: center; gap: 8px;">
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#66b2c5" stroke-width="2">
                        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                    </svg>
                    <span style="font-size: 10px; color: rgba(102,178,197,0.8); text-transform: uppercase; letter-spacing: 2px; font-weight: 600;">Message</span>
                </div>
                <div style="padding: 16px 15px; font-size: 13px; color: #b0b0b0; line-height: 1.8; font-weight: 300;">{{ $contact->message }}</div>
            </div>

        </div>

        <!-- Footer -->
        <div class="bs-footer">
            <span style="font-size: 11px; color: rgba(176,176,176,0.4); font-weight: 300; font-family: 'Poppins', sans-serif;">Automated email from</span>
            <span style="font-size: 11px; background: linear-gradient(45deg, #66b2c5, #89d8fc); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; font-weight: 700; letter-spacing: 2px; font-family: 'Poppins', sans-serif;">BLOGSPOT</span>
            <span style="font-size: 11px; color: rgba(176,176,176,0.3); font-weight: 300; font-family: 'Poppins', sans-serif;">Contact Form</span>
        </div>

    </div>

</body>

</html>