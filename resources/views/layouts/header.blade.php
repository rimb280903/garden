<!doctype html>
<html class="no-js" lang="zxx">

<head>

    <!--========= Required meta tags =========-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>Laprint</title>

    <!--====== Favicon ======-->
    <link rel="shortcut icon" href="{{ asset('/assets/images/logo/favicon.png') }}" type="images/x-icon">

    <!--====== CSS Here ======-->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">


    <!--====== Yield Styles Here ======-->
    @yield('style')

</head>


<body id="header">
    <!-- [if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <!-- preloader  -->
    @php
        use App\Models\Category;
        $categories = Category::with('products')
            
            ->get();
    @endphp

    <!-- header start -->
    <header>
        <div class="header__bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-9 col-lg-12">
                        <div class="navarea">
                            <a href="{{ route('/') }}" class="site-logo">
                                <img src="{{ asset('/assets/images/logo/logo.png') }}" alt="LOGO">
                            </a>
                            <div class="mainmenu">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li class="menu_has_children">
                                            <a href="{{ url('') }}">Accueil</a>
                                        </li>
                                        @foreach ($categories as $category)
                                            <li>
                                                <a
                                                    href="{{ route('category', ['id' => $category->id]) }}">{{ $category->nom_C }}</a>
                                                @if (count($category->products) > 0)
                                                    <ul class="sub-menu">
                                                        @foreach ($category->products as $product)
                                                            <li><a
                                                                    href="{{ route('variants2', $product->id) }}">{{ $product->nom_P }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                        <li>
                                            <a href="{{ route('aboutUs') }}">About Us</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('blog') }}">Blogs</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('contact') }}">Contact Us</a>
                                        </li>

                                    </ul>
                                </nav>
                            </div>
                            <div class="mobile-menu"></div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </header>


    <!-- header end -->


    @yield('content')


    <!-- footer start -->
    <footer class="footer pt-120">
        <div class="container">
            <div class="row mt-none-50 justify-content-center">
                <div class="col-xl-2 col-lg-3 mt-50">
                    <a href="{{ route('/') }}" class="footer__logo">
                        <img src="{{ asset('assets/images/logo/logo2.png') }}">

                    </a>
                </div>
                <div class="col-xl-2 col-lg-4 mt-50 pl-45 pr-0">
                    <div class="footer-widget">
                        <h4 class="widget-title">Our Service</h4>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="{{ route('category', ['id' => $category->id]) }}"><i
                                            class="fa fa-angle-right"></i> {{ $category->nom_C }}</a></li>
                            @endforeach
                        </ul>
                    </div>


                </div>
                <div class="col-xl-3 col-lg-5 mt-50 pl-70 pr-0">
                    <div class="footer-widget">
                        <h4 class="widget-title">Information About Us</h4>
                        <div class="recent-news__content ">
                            <a href="https://www.google.com/maps/search/Casablanca+101+rue+farhat+hachad/@33.5895676,-7.6166857,19.02z"
                                target="_blank" class="recent-news__title">Casablanca 101 rue farhat hachad</a>
                        </div>
                        <div class="recent-news mt-none-20">

                            <div class="recent-news__content mt-20">
                                <a href="tel:+212604727124" class="recent-news__title">+212 6 04 72 71 24</a>
                            </div>
                            <div class="recent-news__content mt-20">
                                <a href="tel:+212620571018" class="recent-news__title">+212 6 20 57 10 18</a>
                            </div>
                            <div class="recent-news__content mt-20">
                                <a href="tel:+212695209035" class="recent-news__title">+212 6 95 20 90 35</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 offset-xl-1 col-lg-6 mt-50">
                    <div class="footer-widget">
                        <div class="newslater">
                            <img src="{{ asset('assets/images/logo/logo2.png') }}">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom mt-115 text-center">
            admin? <a href="{{ route('admin.login') }}">Log In</a>
        </div>
    </footer>
    <!-- footer end -->

    <!--========= JS Here =========-->
    <script data-cfasync="false"
        src="{{ asset('/../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('/assets/js/counterup.min.js') }}"></script>
    <script src="{{ asset('/assets/js/lightcase.js') }}"></script>
    <script src="{{ asset('/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('/assets/js/tilt.jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('/assets/js/scrollwatch.js') }}"></script>
    <script src="{{ asset('/assets/js/sticky-header.js') }}"></script>
    <script src="{{ asset('/assets/js/waypoint.js') }}"></script>
    <script src="{{ asset('/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('/assets/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('/assets/js/odometer.min.js') }}"></script>
    <script src="{{ asset('/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('/assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('/../../../maps/api/js?key=AIzaSyDfpGBFn5yRPvJrvAKoGIdj1O1aO9QisgQ') }}"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <!-- JS Here -->
    @yield('script')





</body>

</html>
