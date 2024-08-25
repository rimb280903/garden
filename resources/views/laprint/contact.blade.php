@extends('layouts.header')
@section('content')

    <body id="header">
        <!-- gta section start -->
        <section class="gta-area gta-area__2 pt-125 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="gta-bg__2">
                            <img src="{{ asset('/assets/images/bg/gta-bg-2.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-6 pl-50">
                        <div class="contact-form">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form action="{{ route('sendMail') }}" method="POST" id="contact-form">
                                @csrf
                                <div class="form-group mt-25 row">
                                    <div class="col">
                                        <input type="text" name="name" id="name" placeholder="Your Name">
                                        @error('name')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <input type="text" name="Lname" id="Lname" placeholder="Your Last Name">
                                        @error('Lname')
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror
                                    </div>


                                </div>

                                <div class="form-group mt-25">
                                    <input type="text" name="phone" id="phone" placeholder="Phone Number">
                                    @error('phone')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>

                                <div class="form-group mt-25">
                                    <input type="email" name="email" id="mail" placeholder="Email Address">
                                    @error('email')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <div class="form-group mt-25">
                                    <textarea name="message" id="message" >{{ isset($product) ? $product : '' }}, {{ isset($command) ? $command : '' }}
                                    </textarea>
                                    
                                    
                                    @error('message')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                                <!-- <button type="submit" class="site-btn site-btn__2 mt-15"><span class="icon icon__black"><i class="far fa-arrow-right"></i></span> Contact us</button>
                                        <p class="ajax-response"></p> -->
                                <button type="button" class="site-btn site-btn__s2 mt-55" onclick="submitForm()">
                                    <span class="icon icon__black"><i class="far fa-arrow-right"></i></span> Contact
                                    us</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- gta section end -->

        <!-- feature section start -->
        <section class="feature-area feature-area__3 pt-125 pb-125">
            <div class="container">
                <div class="row mt-none-30">
                    <div class="col-xl-3 col-lg-6 col-md-6 mt-30">
                        <div class="feature-item feature-item__3">
                            <div class="feature-item__icon feature-item__icon--1">
                                <img src="{{ asset('/assets/images/icons/whatsapp.png') }}" alt="">
                            </div>
                            <div class="feature-item__content">
                                <h4 class="feature-item__title">WhatsApp</h4>
                                <p>+212 6 04 72 71 24 </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 mt-30">
                        <div class="feature-item feature-item__3">
                            <div class="feature-item__icon feature-item__icon--2">
                                <img src="{{ asset('/assets/images/icons/adresse.png') }}" alt="">
                            </div>
                            <div class="feature-item__content">
                                <h4 class="feature-item__title">Adresse</h4>
                                <p>Casablanca 101 rue farhat hachad</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 mt-30">
                        <div class="feature-item feature-item__3">
                            <div class="feature-item__icon feature-item__icon--3">
                                <img src="{{ asset('/assets/images/icons/phone.png') }}" alt="">
                            </div>
                            <div class="feature-item__content">
                                <h4 class="feature-item__title">Phone</h4>
                                <p> <a href="tel: +212 6 20 57 10 18 ">+212 6 20 57 10 18</a> </p>
                                <a href="tel: +212 6 95 20 90 35 ">+212 6 95 20 90 35</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 mt-30">
                        <div class="feature-item feature-item__3">
                            <div class="feature-item__icon feature-item__icon--4">
                                <img src="{{ asset('/assets/images/icons/gmail.png') }}" alt="">
                            </div>
                            <div class="feature-item__content">
                                <h4 class="feature-item__title">Gmail</h4>
                                <a href="mailto: contact.laprint@gmail.com">contact.laprint@gmail.com</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- feature section end -->
        <script>
            function submitForm() {
                Swal.fire({
                    title: 'Validating your information',
                    icon: 'info',
                    timer: 1000,
                    showConfirmButton: false
                }).then(() => {
                    document.getElementById('contact-form').submit();
                });
            }
        </script>
    @endsection
