<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Kelulusan</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

        body {
            margin: 0;
            padding: 10;
            font-family: 'Montserrat', sans-serif;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .certificate-container {
            position: relative;
            width: 1123px; /* Ukuran A4 Landscape */
            height: 794px;
            background-color: #ffffff;
            border: 8px solid #2563eb;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            overflow: hidden;
        }

        .side-background {
            background-color: #2563eb;
            position: absolute;
            height: 100%;
            width: 130px;
            left: 0;
            top: 0;
        }

        .logo-container {
            position: absolute;
            top: 30px;
            left: 20px;
            background-color: #ffffff;
            border-radius: 50%;
            padding: 10px;
            border: 4px solid #2563eb;
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-container img {
            width: 80px;
            height: auto;
        }

        .certificate-content-wrapper {
            width: calc(100% - 160px);
            margin-left: 160px;
            text-align: left;
            border-top: 4px solid #2563eb;
            border-bottom: 4px solid #2563eb;
            padding: 40px;
        }

        .certificate-title {
            font-size: 3.5rem;
            font-weight: bold;
            color: #2563eb;
            text-transform: uppercase;
            text-align: left;
            margin-bottom: 0px;
        }

        .certificate-subtitle {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2563eb;
            text-transform: uppercase;
            text-align: left;
            margin-top: -10px;
        }

        .certificate-text {
            font-size: 1.3rem;
            color: #4b5563;
            margin-top: 20px;
        }

        .certificate-name {
            font-size: 2rem;
            font-weight: bold;
            color: #374151;
            text-transform: uppercase;
            border-bottom: 2px solid #2563eb;
            display: inline-block;
            padding-bottom: 5px;
            margin-top: 10px;
        }

        .signature {
            position: absolute;
            right: 50px;
            bottom: 20px;
            text-align: center;
        }

        .signature img {
            width: 120px;
            height: auto;
        }

        .signature-line {
            border-top: 2px solid #9ca3af;
            width: 200px;
            margin: 10px auto 5px;
        }

        .signature-title {
            font-size: 1rem;
            font-weight: bold;
            color: #374151;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
            }

            .certificate-container {
                width: 1123px !important;
                height: 794px !important;
                page-break-before: avoid;
                page-break-after: avoid;
                page-break-inside: avoid;
                border: none;
                box-shadow: none;
            }

            .side-background {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="side-background"></div>
        <div class="logo-container">
            <img src="{{ asset('storage/eduflix-1.png') }}" alt="Logo">
        </div>
        <div class="certificate-content-wrapper">
            <div class="certificate-title">SERTIFIKAT</div>
            <div class="certificate-subtitle">KELULUSAN</div>
            <p class="certificate-text">Diberikan kepada</p>
            <div class="certificate-name">{{ $participant_name }}</div>
            <p class="certificate-text">Atas penyelesaian kursus <strong>{{ $course_title }}</strong> dalam kategori {{ $course_category }}.</p>
        </div>

        <div class="signature">
            <img src="{{ asset('storage/tanda-tangan.png') }}" alt="Tanda Tangan">
            <div class="signature-line"></div>
            <p class="signature-title">CEO</p>
        </div>
    </div>
</body>
</html>
