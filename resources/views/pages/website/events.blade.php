@extends('layouts.website')
@section('content')

<!-- Page Header -->
<section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">School Events & Gallery</h1>
        <p class="text-lg sm:text-xl">Capturing memorable moments at Merit Datalight School</p>
    </div>
</section>

<!-- Events Gallery -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($images as $image)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2">
                <img src="{{ asset('images/placeholder/' . $image) }}" alt="School Event" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">School Activity</h3>
                    <p class="text-gray-600 text-sm">Merit Datalight School - Excellence in Education</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
