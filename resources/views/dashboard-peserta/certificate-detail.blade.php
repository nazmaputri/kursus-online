@extends('layouts.dashboard-peserta')

@section('content')
<div class="container mx-auto">
    <div class="bg-white p-8 rounded-lg shadow-md relative">
        <h2 class="text-2xl font-bold mb-8 border-b-2 text-center border-gray-300 pb-2 uppercase">
            Sertifikat
        </h2>

        <!-- Preview Sertifikat -->
        <div class="w-full mb-6">
            <iframe src="{{ route('certificate.show', ['courseId' => $course->id]) }}" class="w-full h-[600px] border-2 rounded-lg shadow-md"></iframe>
        </div>

        <!-- Tombol Download Sertifikat -->
        <div class="w-full flex justify-center mb-6">
            <a href="{{ route('certificate.download', $course->id) }}" class="flex-1">
                <button class="w-full py-2 rounded-lg font-semibold flex items-center justify-center gap-2 
                    bg-red-100/50 text-red-500 border border-red-500 hover:bg-red-600 hover:text-white transition-colors group">
                    <!-- SVG Icon for Certificate -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6 transition-all 
                        group-hover:fill-white fill-red-500">
                        <path d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                    </svg>
                    Unduh Sertifikat
                </button>
            </a>
        </div>

        <!-- Tombol Kembali di bawah tombol Download Sertifikat -->
        <div class="w-full flex justify-end">
            <a href="{{ route('welcome-peserta') }}" class="bg-sky-300 hover:bg-sky-600 text-white font-bold py-2 px-4 justify-end rounded shadow-sm transition-all">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
