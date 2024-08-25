@extends('layouts.header')
@section('content')


    <!-- hero start -->
    <section class="hero owl-carousel">
        <div class="hero__item">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-xl-6 col-lg-7">
                        <div class="hero__content">
                            <h2 class="hero__title" data-animation="fadeIn" data-delay=".2s" data-duration=".5s">Laprint
                                Your <br>
                                Printing Solution</h2>
                            <a  data-animation="fadeInUp" data-delay=".7s" data-duration=".9s" href="{{route('aboutUs')}}" class="site-btn"><span class="icon"><i class="far fa-arrow-right"></i></span> Read More</a>
                            <div class="shape">
                                <img src="assets/images/shape/hero-shape.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__image d-flex align-self-stretch">
                <img src="assets/images/banner/image1.jpg" alt="">
            </div>
        </div>
        <div class="hero__item">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-xl-6 col-lg-7">
                        <div class="hero__content">
                            <h2 class="hero__title" data-animation="fadeIn" data-delay=".2s" data-duration=".5s">Laprint
                                Your <br>
                                Printing
                                Solution</h2>
                            <a data-animation="fadeInUp" data-delay=".7s" data-duration=".9s" href="{{route('aboutUs')}}" class="site-btn"><span class="icon"><i class="far fa-arrow-right"></i></span> Read More</a>
                            <div class="shape">
                                <img src="assets/images/shape/hero-shape.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__image d-flex align-self-stretch">
                <img src="assets/images/banner/image2.jpg" alt="">
            </div>
        </div>
    </section>
    <!-- hero end -->

    <!-- feature section start -->
    <section class="feature-area pt-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 text-center">
                    <div class="section-header mb-50">
                        <h2 class="section-title">Company Feature</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-none-30">
                <div class="col-xl-3 col-lg-6 col-md-6 mt-30">
                    <div class="feature-item">
                        <div class="feature-item__icon feature-item__icon--1">
                            <img src="assets/images/icons/f-1.png" alt="">
                        </div>
                        <div class="feature-item__content">
                            <h4 class="feature-item__title">Impression Digitale</h4>
                            <p>Laprint offre des services d'impression digitale de haute qualité pour répondre aux besoins de ses clients.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mt-30">
                    <div class="feature-item">
                        <div class="feature-item__icon feature-item__icon--2">
                            <img src="assets/images/icons/f-2.png" alt="">
                        </div>
                        <div class="feature-item__content">
                            <h4 class="feature-item__title">Large choix </h4>
                            <p> Laprint propose une variété de produits pour répondre aux besoins et préférences de ses clients.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mt-30">
                    <div class="feature-item">
                        <div class="feature-item__icon feature-item__icon--3">
                            <img src="assets/images/icons/f-3.png" alt="">
                        </div>
                        <div class="feature-item__content">
                            <h4 class="feature-item__title">Service proximité</h4>
                            <p> Laprint facilite l'accessibilité de ses produits et services grâce à ses agences locales et à ses solutions en ligne</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 mt-30">
                    <div class="feature-item">
                        <div class="feature-item__icon feature-item__icon--4">
                            <img src="assets/images/icons/f-4.png" alt="">
                        </div>
                        <div class="feature-item__content">
                            <h4 class="feature-item__title">Conseils</h4>
                            <p>Laprint offre des conseils adaptés aux besoins uniques de chaque client pour assurer leur satisfaction et leur fidélisation.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- feature section end -->

    <!-- about section start -->
    <section class="about-area pt-130 pb-130">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-6 pr-0">
                    <div class="about__bg" data-tilt="" data-tilt-perspective="3000">
                        <img src="assets/images/bg/about-bg-1.png" alt="">
                    </div>
                </div>
                <div class="col-xl-6 pl-80">
                    <div class="section-header mb-40">
                        <!-- <h4 class="sub-heading mb-10">About Us</h4> -->
                        <h2 class="section-title mb-35">Qui sommes-nous?</h2>
                        <p>Bienvenue chez Laprint - votre partenaire de confiance pour tous vos besoins en matière d'impression,
                            de fournitures de bureau, de matériels informatiques et de mobilier de bureau au Maroc.
                        </p>
                    </div>
                    <div class="about-lists">
                        <ul>
                            <li><i class="fa fa-check"></i> Laprint valorise la qualité de ses services.
                            </li>
                            <li><i class="fa fa-check"></i> Laprint comprend que chaque client est unique.</li>
                        </ul>
                        <a href="{{route('aboutUs')}}" class="site-btn site-btn__s2 mt-55"><span class="icon icon__black"><i class="far fa-arrow-right"></i></span> Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about section end -->

    <!-- project section start -->
   
    <!-- project section end -->

    <section>
        <div>
            <div>
                <br>
                <br>
            </div>
        </div>
    </section>
    <!-- service section end -->

    <!-- cta section start -->
    <section class="cta-area theme-bg pt-105 pb-115">
        <div class="container">
            <div class="row">
                <div class="col-xl-8">
                    <div class="section-header">
                        <h2 class="section-title section-title__white">We help take your small <br>
                            business to the next level.</h2>
                    </div>
                </div>
                <div class="col-xl-4 text-right">
                    <div class="cta-right">
                        <p>Extra Support</p>
                        <a href="{{route('contact')}}" class="site-btn site-btn__s3">
                            <span class="icon"><i class="far fa-arrow-right"></i></span>
                          Contact
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- cta section end -->

    <!-- gta section start -->

    <!-- gta section end -->

    <!-- faq section start -->
    <section class="faq-area pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="section-header mb-25">

                       <center> <h2 class="section-title">Blogs</h2></center>
                    </div>
                    <div class="accordion faqs" id="accordionFaq">
                        @foreach ($latest_blogs as $blog)


                        <div class="card">
                            <div class="card__header" id="heading{{$blog->id}}">
                                <h5 class="mb-0 title">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse{{$blog->id}}" aria-expanded="false" aria-controls="collapse{{$blog->id}}">
                                        {{$blog->title}}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse{{$blog->id}}" class="collapse" aria-labelledby="heading{{$blog->id}}" data-parent="#accordionFaq">
                                <div class="card__body">
                                    <p>{{$blog->description}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="faq-bg">
                        <img src="assets/images/bg/faq-bg-1.jpeg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- faq section end -->
    @endsection
