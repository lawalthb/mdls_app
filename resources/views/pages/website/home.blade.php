@extends('layouts.app')
@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/placeholder/slide1.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption">
                        <h1>Welcome to Merit Datalight School</h1>
                        <p>Excellence in Education</p>
                    </div>
                </div>

                <div class="carousel-item active">
                    <img src="{{ asset('images/placeholder/slide2.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption">
                        <!-- <h1>Welcome to Merit Datalight School</h1>
                        <p>Excellence in Education</p> -->
                    </div>
                </div>

                <div class="carousel-item active">
                    <img src="{{ asset('images/placeholder/slide3.jpg') }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption">
                        <!-- <h1>Welcome to Merit Datalight School</h1>
                        <p>Excellence in Education</p> -->
                    </div>
                </div>


                <!-- Add more carousel items here -->
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>

    </div>
</section>

<!-- Quick Links Section -->
<section class="quick-links py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="material-icons">school</i>
                        <h3>Student Portal</h3>
                        <p>Access your results and academic information</p>
                        <a href="{{ url('/login') }}" class="btn btn-primary">Login</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="material-icons">event</i>
                        <h3>Latest Events</h3>
                        <p>Stay updated with college events</p>
                        <a href="{{ url('events') }}" class="btn btn-primary">View Events</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="material-icons">contact_mail</i>
                        <h3>Contact Us</h3>
                        <p>Get in touch with us</p>
                        <a href="{{ url('contact') }}" class="btn btn-primary">Contact</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection