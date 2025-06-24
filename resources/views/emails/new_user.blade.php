<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Email</title>
    <style>
        body { 
            font-family: Poppins; 
            background: #f8f8f8; color: #222; 
        }

        .container{
            background: #f8f8f8; color: #222; 
            background: #fff; 
            border-radius: 8px; 
            padding: 32px; 
            max-width: 720px; 
            margin: 32px auto; 
            box-shadow: 0 2px 12px rgba(0,0,0,0.07); 
        }

        .email-body { 
            /* background: #fff;  */
            /* border-radius: 8px;  */
            padding: 16px; 
            max-width: 1200px; 
            /* margin: 32px auto;  */
            /* box-shadow: 0 2px 12px rgba(0,0,0,0.07);  */
        }

        .email-header{

        }

        .logo-image{
            width: 120px;
            height: auto;
            display: block;
            margin: 0 auto 0 ; 
        }

        .h3{
            margin: 0px;
        }

        .email-footer {
            background: #f7f7f7;
            border-radius: 8px;
            padding: 28px 16px 18px 16px;
            margin: 32px 0 0 0;
            text-align: center;
        }
        .email-footer h4 {
            margin: 0 0 8px 0;
            font-size: 18px;
            font-weight: 700;
            color: #222;
        }
        .email-footer p {
            color: var(--Neutral-Gray-700, #595959);
            margin-bottom: 8px;
        }
        .email-footer .callout {
            display: inline-flex;
            align-items: center;
            background: #E62129;
            color: #fff;
            font-weight: 500;
            font-size: 15px;
            border-radius: 8px;
            padding: 8px 18px;
            margin: 16px 0 0 0;
            gap: 8px;
        }
        .email-footer .callout img, .email-footer .callout svg {
            width: 20px;
            height: 20px;
            vertical-align: middle;
        }
        .email-footer .footer-icons {
            display: flex;
            justify-content: center;
            gap: 48px;
            margin-top: 28px;
        }
        .email-footer .footer-icons img, .email-footer .footer-icons svg {
            width: 28px;
            height: 28px;
            opacity: 0.85;
        }
        .p {
            font-size: 16px;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="email-header">
            <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="logo-image">
        </div>
        <div class="email-body">
            <h3>Selamat Datang di Universitas Pertamina!</h3>
            <p>Anda telah menjadi bagian dari kami!</p>
            <img src="{{ asset('images/logo.svg') }}">
            <div class="info">
                <p>Hai, <strong>Iman Saputra</strong>. Senang kamu bergabung!</p>
                <p>Terima kasih telah mendaftar. Kamu telah berhasil mendaftar sebagai Mahasiswa Baru Universitas Pertamina. Silakan verifikasi akun kamu dengan mengklik tombol di bawah.</p>
                <p>Simpan informasi login kamu di bawah ini:</p>
                <p>Username: example@student.universitaspertamina.ac.id<br/>
                Password: DFKEDJK</p>
                <p>Simpan email ini untuk pengingat akun kamu. Jangan bagikan appun dan kepada siapapun tentang akun kamu.</p>
                <div style="text-align:center;">
                    <button class="button button-outline">Verifikasi Akun Kamu</button>
                    <button class="button button-clean">Baca Panduan Di Sini</button>
                </div>
                Jika tidak berhasil, salin dan tempel tautan berikut di browser kamu:<br/>
                <a href="">https://universitaspertamina.ac.id</a><br />
            </div>
        </div>
        <div class="email-footer">
            <p>Direktorat Pendidikan Universitas Pertamina</p>
            <h4>Butuh Bantuan?</h4>
            <p>Tim kami selalu siap membantu!</p>
            <div class="callout">+62 812 1149 9915</div>
        </div>
    </div>
</body>
</html>
