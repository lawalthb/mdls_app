@extends('layouts.app')
@section('content')
<section class="about-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>About Our College</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                <h3>Our Mission</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                <h3>Our Vision</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('images/placeholder/about.jpg') }}" class="img-fluid rounded" alt="About Us">
            </div>
        </div>
    </div>
</section>
@endsection
