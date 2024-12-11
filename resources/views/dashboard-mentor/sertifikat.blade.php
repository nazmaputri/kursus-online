<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Kursus</title>
    <style>
        /* Gaya dasar */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #ffffff; /* Background putih untuk cetak */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .certificate-container {
            position: relative;
            width: 90%;
            max-width: 1120px;
            background-color: #ffffff;
            border: 8px solid #2563eb; /* Blue border */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 20px;
            padding: 10px;
        }

        /* Elemen biru pada pojok kiri atas dan kanan */
        .corner-element {
            position: absolute;
            background-color: #2563eb; /* Blue color */
            height: 50px;
            width: 50px;
        }

        .top-left {
            top: 0;
            left: 0;
            transform: rotate(45deg);
        }

        .top-right {
            top: 0;
            right: 0;
            transform: rotate(45deg);
        }

        /* Elemen biru pada pojok kiri bawah dan kanan bawah */
        .bottom-left {
            bottom: 0;
            left: 0;
            transform: rotate(45deg);
        }

        .bottom-right {
            bottom: 0;
            right: 0;
            transform: rotate(45deg);
        }

        /* Konten utama */
        .certificate-content-wrapper {
            border: 3px solid #2563eb; /* Blue border around content */
            padding: 20px;
            margin: 20px;
            border-radius: 8px;
        }

        .certificate-content {
            margin: 20px;
            padding: 10px;
            text-align: center; /* Menyusun semua teks di tengah */
        }

        /* Logo dan teks EDUFLIX */
        .certificate-header {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .certificate-logo img {
            width: 80px;
            margin-right: 20px;
        }

        .certificate-title-wrapper {
            font-size: 2rem;
            font-weight: bold;
            color: #1e40af; /* Darker blue */
            text-transform: uppercase;
        }

        .certificate-subtitle {
            font-size: 1.2rem;
            font-style: italic;
            color: #6b7280; /* Gray */
            margin-bottom: 40px;
        }

        .certificate-name {
            font-size: 2rem; /* Meningkatkan ukuran font untuk nama peserta */
            font-weight: bold;
            color: #374151; /* Dark gray */
            margin: 20px 0;
            text-transform: uppercase;
        }

        .certificate-details p {
            font-size: 1rem;
            color: #4b5563; /* Medium gray */
            margin: 10px 0;
        }

        .certificate-details span {
            font-weight: bold;
            color: #2563eb; /* Blue */
        }

        /* Div tanda tangan */
        .certificate-signatures-wrapper {
            display: flex; /* Menggunakan Flexbox untuk sejajar */
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
        }

        .signature {
            text-align: center;
            width: 45%; /* Lebar tanda tangan */
        }

        .signature-line {
            border-top: 2px solid #9ca3af; /* Garis tanda tangan */
            width: 150px;
            margin: 0 auto 10px;
        }

        .signature-title {
            font-size: 1rem;
            font-weight: bold;
            color: #374151; /* Dark gray */
        }

        /* Tambahkan gaya untuk Sertifikat Penyelesaian */
        .certificate-completion-title {
            font-size: 3rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #2563eb; /* Warna biru */
            text-align: center;
            margin-top: 30px;
        }

        /* Media Query untuk Cetak */
        @media print {
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
            }

            .certificate-container {
                width: 1120px; /* Ukuran A4 landscape */
                height: 794px;
                border: none;
                padding: 0;
            }

            /* Menyembunyikan elemen saat cetak */
            .corner-element {
                display: none;
            }

            /* Menyesuaikan tanda tangan saat cetak */
            .certificate-signatures-wrapper {
                position: absolute;
                bottom: 40px; /* Jarak dari bawah */
                left: 0;
                right: 0;
                display: flex;
                justify-content: space-between;
                padding: 0 40px;
                box-sizing: border-box;
            }

            .certificate-content-wrapper {
                padding: 20px;
                margin: 20px;
            }

            .certificate-content {
                margin: 0;
                padding: 0;
            }
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <!-- Elemen biru di pojok kiri atas dan kanan -->
        <div class="corner-element top-left"></div>
        <div class="corner-element top-right"></div>

        <!-- Elemen biru di pojok kiri bawah dan kanan -->
        <div class="corner-element bottom-left"></div>
        <div class="corner-element bottom-right"></div>

        <!-- Content Wrapper with Blue Border -->
        <div class="certificate-content-wrapper">
            <!-- Content -->
            <div class="certificate-content">
                <!-- Header with Logo and EDUFLIX Text -->
                <div class="certificate-header">
                    <div class="certificate-logo">
                        <img src="{{ asset('storage/public/eduflix-1.png') }}" alt="Logo">
                    </div>
                </div>

                <!-- Sertifikat Penyelesaian Title -->
                <div class="certificate-completion-title">
                    SERTIFIKAT KELULUSAN
                </div>

                <!-- Diberikan Kepada -->
                <p class="certificate-subtitle">Diberikan kepada</p>
                <h3 class="certificate-name">{{ $participant_name }}</h3>

                <!-- Nama Kursus -->
                <p class="certificate-details">
                    Atas Penyelesaian Kursus <span>{{ $course_title }}</span> Dengan Kategori {{ $course_category }}
                </p>

                <!-- Tanda Tangan -->
                <div class="certificate-signatures-wrapper">
                    {{-- <!-- Tanda Tangan Kiri -->
                    <div class="signature">
                        <div class="signature-line"></div>
                        <p class="signature-title">{{ $signature_title_left }}</p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</body>
</html>
