@extends('layouts.guest')

@section('content')
    <!-- Banner Start -->
    <section class="contact-banner page-banner">
        <div class="page-banner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title text-center">
                            <h2>Contact</h2>
                            <a href="{{ route('index') }}">Home</a>
                            <span>|</span>
                            <a href="#">Contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Contact Pge Section Start -->
    <section class="contact-page-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="contact-page-title">
                        <span>Contact With Us</span>
                        <h2>
                            If you Have any query, Dont Hesitate <br />
                            Contact with us
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-inform">
                        <div class="information">
                            <i class="fas fa-map-marker-alt"></i>
                            <a href="#">Patel Complex, R.C.B.W.School, Near Old R.T.O.Office, Mannarpuram,
                                Tiruchirapalli.</a>
                        </div>
                        <div class="information text-left">
                            <i class="fas fa-envelope-open"></i>
                            <div class="">
                                <a href="mailto:safeaquatech@gmail.com">safeaquatech@gmail.com</a><br>
                                <a href="mailto:info@safeaquatech.com">info@safeaquatech.com</a>
                            </div>
                        </div>
                        <div class="information">
                            <i class="fas fa-phone"></i>
                            <div class="">
                                <br>
                                <a href="tel:+919344330043">+91 93443 30043</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <form class="contact_form" method="POST" action="{{ route('contact.store') }}" data-aos="fade-left"
                        data-aos-duration="1000" autocomplete="off">
                        @csrf
                        <div class="contact-page-form">
                            <div style="display: flex;">
                                <input class="text col-lg-6" name="name" style="margin-right: 5px;"
                                    placeholder="Full Name *" required value="{{ old('name') }}" />
                                <input class="text col-lg-6" name="email" style="margin-left: 5px;"
                                    placeholder="Enter Email *" required value="{{ old('email') }}" />
                            </div>
                            <div style="display: flex;">
                                <input class="text col-lg-6" name="phone" style="margin-right: 5px;"
                                    placeholder="Enter Phone Number *" required value="{{ old('phone') }}" />
                                <input class="text col-lg-6" name="subject" style="margin-left: 5px;"
                                    placeholder="Enter Subject *" required value="{{ old('subject') }}" />
                            </div>
                            <textarea name="message" class="subject" placeholder="How Can I Help You?" required>{{ old('message') }}</textarea>

                           
                            <div class="d-flex flex-md-row flex-column">
                                <div>
                                <div class="cf-turnstile" data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}"></div>
                                </div>
                                <div style="margin-left: 30px;">
                                    <button class="submit-btn mt-0" type="submit" value="Send Mail" name="submit">Send
                                        Message</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Page Section End -->

    <!-- Location Map Start -->
    <div class="location">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.295919319873!2d78.68609090998632!3d10.788632489316544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3baaf53b6dbb6b8b%3A0x6c6bb258bff85bd5!2sSAFE%20AQUA%20TECH%20-%20water%20purifier%2C%20commercial%20water%20plant%2C%20water%20softener%20dealers%2Csuppliers%20in%20trichy!5e0!3m2!1sen!2sin!4v1691306296906!5m2!1sen!2sin"
                        height="450" style="border:0; width:inherit;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Location Map End -->
@endsection
