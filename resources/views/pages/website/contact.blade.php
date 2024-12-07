@extends('layouts.app')
@section('content')
<section class="contact-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Contact Us</h2>
                <form action="{{ url('contact/send') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" class="form-control" name="subject" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
            <div class="col-md-6">
                <h3>Our Location</h3>
                <div class="map-container">
                    <!-- Add your Google Maps embed code here -->
                    <img src="{{ asset('images/placeholder/map.jpg') }}" class="img-fluid" alt="Map">
                </div>
                <div class="contact-info mt-4">
                    <h4>Contact Information</h4>
                    <p><i class="material-icons">location_on</i> [Your Address]</p>
                    <p><i class="material-icons">phone</i> [Phone Number]</p>
                    <p><i class="material-icons">email</i> [Email Address]</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
