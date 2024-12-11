@extends('layouts.dashboard-peserta')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Hasil Pencarian untuk: "{{ $query }}"</h1>

    @if($quizzes->isNotEmpty())
        <h2 class="text-lg font-semibold">Quizzes</h2>
        <ul>
            @foreach($quizzes as $quiz)
                <li>{{ $quiz->title }}</li>
            @endforeach
        </ul>
    @endif

    @if($courses->isNotEmpty())
        <h2 class="text-lg font-semibold">Courses</h2>
        <ul>
            @foreach($courses as $course)
                <li>{{ $course->title }}</li>
            @endforeach
        </ul>
    @endif

    @if($categories->isNotEmpty())
        <h2 class="text-lg font-semibold">Categories</h2>
        <ul>
            @foreach($categories as $category)
                <li>{{ $category->name }}</li>
            @endforeach
        </ul>
    @endif

    @if($users->isNotEmpty())
        <h2 class="text-lg font-semibold">Users</h2>
        <ul>
            @foreach($users as $user)
                <li>{{ $user->name }} ({{ $user->email }})</li>
            @endforeach
        </ul>
    @endif

    @if($materi->isNotEmpty())
        <h2 class="text-lg font-semibold">Materi</h2>
        <ul>
            @foreach($materi as $m)
                <li>{{ $m->judul }}</li>
            @endforeach
        </ul>
    @endif

    @if($ratings->isNotEmpty())
        <h2 class="text-lg font-semibold">Ratings</h2>
        <ul>
            @foreach($ratings as $rating)
                <li>{{ $rating->review }}</li>
            @endforeach
        </ul>
    @endif

    @if(
        $quizzes->isEmpty() && 
        $courses->isEmpty() && 
        $categories->isEmpty() && 
        $users->isEmpty() && 
        $materi->isEmpty() && 
        $ratings->isEmpty()
    )
        <p class="text-gray-500">Tidak ada hasil yang ditemukan untuk "{{ $query }}".</p>
    @endif
</div>
@endsection
