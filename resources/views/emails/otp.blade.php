<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kode OTP Verifikasi Akun</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f5f5f5; padding:20px;">
    <div style="max-width:600px;margin:0 auto;background:#ffffff;border-radius:8px;padding:20px;">
        <h2 style="text-align:center;margin-bottom:10px;">Verifikasi Akun SIMASI</h2>
        <p>Halo,</p>
        <p>Terima kasih telah mendaftar di <strong>SIMASI</strong>.</p>
        <p>Berikut adalah kode OTP untuk verifikasi akunmu:</p>

        <div style="text-align:center;margin:20px 0;">
            <span style="display:inline-block;padding:10px 20px;font-size:24px;
                         letter-spacing:6px;border-radius:6px;background:#2563eb;
                         color:#ffffff;font-weight:bold;">
                {{ $otp }}
            </span>
        </div>

        <p>Kode ini berlaku selama <strong>10 menit</strong>. Jangan berikan kode ini kepada siapa pun.</p>

        <p style="margin-top:20px;">Salam,<br>
        <strong>SIMASI</strong></p>
    </div>
</body>
</html>
