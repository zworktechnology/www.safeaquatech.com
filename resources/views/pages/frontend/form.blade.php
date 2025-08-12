@extends('layouts.guest')

@section('content')
    <!-- Banner Start -->
    <section class="contact-banner page-banner">
        <div class="page-banner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title text-center">
                            <h2>Dealership Interested Form</h2>
                            <a href="{{ route('index') }}">Home</a>
                            <span>|</span>
                            <a href="#">Dealership Interested Form</a>
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
                        <span>Dealership Interested Form</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form class="contact_form" method="POST" action="{{ route('dealership.store') }}" data-aos="fade-left"
                        data-aos-duration="1000" autocomplete="off">
                        @csrf
                        <div class="contact-page-form">
                            <div style="display: flex;">
                                <div class="col-lg-6">
                                    <label>Full Name <spna class="text-danger">*</spna></label>
                                    <input class="text" name="name" style="margin-right: 5px;" placeholder="Full Name"
                                        required value="{{ old('name') }}" />
                                </div>
                                <div class="col-lg-6">
                                    <label>Compay Name <spna class="text-danger">*</spna></label>
                                    <input class="text" name="company_name" style="margin-left: 5px;"
                                        placeholder="M/s. XYZ pvt Ltd" required value="{{ old('company_name') }}" />
                                </div>
                            </div>
                            <div style="display: flex;">
                                <div class="col-lg-12">
                                    <label>Office Address <spna class="text-danger">*</spna></label>
                                    <input class="text" name="office_address" style="margin-right: 5px;"
                                        placeholder="Office Address" required value="{{ old('office_address') }}" />
                                </div>
                            </div>
                            <div style="display: flex;">
                                <div class="col-lg-12">
                                    <label>Work Area <spna class="text-danger">*</spna></label>
                                    <input class="text col-lg-12" name="work_area" style="margin-right: 5px;"
                                        placeholder="Work Area" required value="{{ old('work_area') }}" />
                                </div>
                            </div>
                            <div style="display: flex;">
                                <div class="col-lg-6">
                                    <label>Date of Birth <spna class="text-danger">*</spna></label>
                                    <input class="text" type="date" name="date_of_birth" style="margin-right: 5px;"
                                        placeholder="Full Name" required value="{{ old('date_of_birth') }}" />
                                </div>
                                <div class="col-lg-6">
                                    <label>Wedding Day<spna class="text-danger">*</spna></label>
                                    <input class="text" type="date" name="weeding_date" style="margin-left: 5px;"
                                        placeholder="M/s. XYZ pvt Ltd" required value="{{ old('weeding_date') }}" />
                                </div>
                            </div>
                            <div style="display: flex;">
                                <div class="col-lg-4">
                                    <label>Phone Number <spna class="text-danger">*</spna></label>
                                    <input class="text" type="number" name="phone_number" style="margin-right: 5px;"
                                        placeholder="+91 00xxx xxx00" required value="{{ old('phone_number') }}" />
                                </div>
                                <div class="col-lg-4">
                                    <label>What's App Number <spna class="text-danger">*</spna></label>
                                    <input class="text" type="number" name="whats_app" style="margin-left: 5px;"
                                        placeholder="+91 00xxx xxx00" required value="{{ old('whats_app') }}" />
                                </div>
                                <div class="col-lg-4">
                                    <label>Interested In <spna class="text-danger">*</spna></label>
                                    <select class="text" name="interested_in">
                                        <option value="Dealer">Dealer</option>
                                        <option value="Free Launcher">Free Launcher</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                            <div style="display: flex">
                                <div style="margin-left: 30px;">
                                    <button class="submit-btn" type="submit" value="Send Mail" name="submit">Send
                                        Enquiry</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
