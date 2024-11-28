@extends('layouts.dashboard-peserta')
@section('content')
<div class="bg-white rounded-lg shadow-md p-8 w-full mx-auto">
    <!-- Quiz Title and Description -->
    <h1 class="text-3xl font-bold mb-4 text-gray-800">Quiz: Dasar-dasar Laravel</h1>
    <p class="mb-6 text-gray-600">
        Uji pemahaman Anda tentang dasar-dasar Laravel dengan menjawab pertanyaan berikut. Semoga berhasil!
    </p>

    <!-- Quiz Form -->
    <form action="" method="POST">
        @csrf
        <!-- Example Questions -->
        @foreach([
            ['question' => 'Apa itu Laravel?', 'options' => ['Framework PHP', 'Framework JavaScript', 'Database', 'Library CSS']],
            ['question' => 'Apa fungsi dari Eloquent di Laravel?', 'options' => ['Untuk membuat view', 'Untuk mengelola route', 'ORM untuk database', 'Library untuk JavaScript']],
            ['question' => 'Apa kegunaan dari migration?', 'options' => ['Untuk membuat controller', 'Untuk membuat file CSS', 'Untuk mengelola perubahan struktur database', 'Untuk menambahkan gambar']],
        ] as $index => $quiz)
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-3">Pertanyaan {{ $index + 1 }}: {{ $quiz['question'] }}</h2>
                @foreach($quiz['options'] as $optionIndex => $option)
                    <div class="flex items-center mb-2">
                        <input 
                            type="radio" 
                            name="answers[{{ $index }}]" 
                            value="{{ $option }}" 
                            id="question-{{ $index }}-option-{{ $optionIndex }}"
                            class="mr-2 text-blue-600 focus:ring-blue-500">
                        <label for="question-{{ $index }}-option-{{ $optionIndex }}" class="text-gray-700">{{ $option }}</label>
                    </div>
                @endforeach
            </div>
        @endforeach

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white w-full py-2 rounded-lg font-semibold hover:bg-blue-600 transition-colors">
            Kirim Jawaban
        </button>
    </form>
</div>
@endsection
