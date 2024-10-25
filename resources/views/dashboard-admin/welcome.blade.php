@extends('layouts.dashboard-admin')
@section('content')
    <div class="bg-white rounded-lg shadow-md p-8 w-full flex flex-col md:flex-row items-center">
        <div class="md:w-2/3 text-center md:text-left">
            <h1 class="text-3xl font-bold mb-4 text-gray-800">Welcome,</h1>
            <p class="mb-6 text-gray-600">
                We are thrilled to have you here. Dive into our wide array of events, learn new skills, and connect with experts in the field.
            </p>
            <p class="mb-8 text-gray-600">
                Get ready to explore endless possibilities and enhance your learning experience.
            </p>
            <a href="#" class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-300">
                Explore Events
            </a>
        </div>
        <div class="md:w-1/3 flex justify-center md:justify-end">
            <img src="{{ asset('storage/online-course.png') }}" alt="Welcome Image" class="w-40"/>
        </div>
    </div>
@endsection