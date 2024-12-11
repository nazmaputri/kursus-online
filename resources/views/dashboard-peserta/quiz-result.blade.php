@extends('layouts.dashboard-peserta')

@section('content')
    <div class="container mx-auto">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
            <h1 class="text-2xl font-bold border-b-2 pb-2 flex justify-between items-center">
                <span>Hasil Kuis : {{ $quiz->title }}</span>
                <span class="text-3xl cursor-pointer hover:text-red-500" onclick="closeQuizResult()">×</span>
            </h1>
            <script>
                function closeQuizResult() {
                    // Redirect ke route 'study-peserta' dengan ID course
                    window.location.href = "{{ route('study-peserta', ['id' => $course->id]) }}";
                }
            </script>
            <div class="mt-6 flex flex-col lg:flex-row gap-8">
                <div class="lg:w-1/3 bg-white shadow-md rounded-lg p-6 sticky top-6 border">
                    <h2 class="text-xl font-bold border-b-2 pb-2">Skor Anda</h2>
                
                    <!-- Tanggal Ujian (Paling Atas) -->
                    <p class="text-sm text-gray-700 mt-2">
                        Tanggal Mengerjakan : {{ \Carbon\Carbon::parse($startTime)->format('d M Y') }}
                    </p>
                
                    <!-- Menggunakan Flexbox untuk mengatur Total Soal dan Skor agar bersebelahan -->
                    <div class="flex justify-between items-center mt-4 space-x-2 p-4">
                        <!-- Total Soal -->
                        <div class="flex flex-col items-center text-center">
                            <p class="text-lg text-gray-700">Total Soal :</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ count($quiz->questions) }}</p>
                        </div>         
                        
                        <!-- Skor -->
                        <div class="flex flex-col items-center text-center">
                            <p class="text-lg text-gray-700">Skor :</p>
                            <p class="text-2xl font-semibold text-blue-500">{{ $score }}</p>
                        </div>                        
                    </div>                    
                
                    <!-- Status Lulus atau Tidak -->
                    @if ($score >= 70)
                        <p class="text-green-500 text-center mt-4">Selamat, Anda lulus kuis ini!</p>
                    @else
                        <p class="text-red-500 text-center mt-4">Maaf, Anda belum lulus kuis ini.</p>
                    @endif
                </div>                             

                <!-- Detail Jawaban -->
                <div class="lg:w-2/3 bg-white shadow-md rounded-lg border p-6 overflow-y-auto max-h-[calc(100vh-200px)]">
                    <h2 class="text-xl font-bold mb-4 border-b-2 pb-2">Detail Jawaban</h2>
                    @foreach ($results as $result)
                        <div class="border-b border-gray-200 py-4">
                            <p class="font-semibold">{{ $result['question'] }}</p>
                            <p class="mt-1">
                                <span class="font-medium">Jawaban Anda :</span>
                                <span class="{{ $result['is_correct'] ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $result['submitted_answer'] ?? 'Tidak dijawab' }}
                                </span>
                            </p>
                            <p class="mt-1">
                                <span class="font-medium">Jawaban Benar :</span>
                                <span class="text-green-500">{{ $result['correct_answer'] }}</span>
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
