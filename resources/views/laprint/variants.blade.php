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

    <!--====== Yield Styles Here ======-->
    <style>
        /* Style pour le fond de couleur */
        body {
            background-color: #e5e5e5;
        }
    </style>

</head>


<body id="header">
    <!-- [if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <!-- preloader  -->
    @php
        use App\Models\Category;
        $categories = Category::with('products')
            ->take(5)
            ->get();
    @endphp

    <!-- header start -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="navbar-brand">
            <a href="{{ route('/') }}" class="footer__logo">
                <img src="{{ asset('assets/images/logo/logo2.png') }}">
            </a>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

        </div>
    </nav>


    <!-- header end -->


    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <!-- Carré avec la petite photo zoomable -->
                <div class="product-image">
                    <img class="img-fluid" src="{{ asset('/assets/images/dynamic/' . $product->image_path) }}"
                        alt="{{ $product->image_path }}">
                </div>
            </div>
            <div class="col-md-6" style="margin-left: -80px; margin-right: 80px;padding-right: -90px;">
                <!-- Formulaire pour personnaliser le produit -->
                <form action="{{ route('cart_item') }}" method="post">
                    @csrf
                    <div class="product-form">
                        <table>
                            <h2>{{ $product->nom_P }} <span><a
                                        href="{{ route('category', ['id' => $product->category->id]) }}">({{ $product->category->nom_C }})
                                    </a> </span></h2>

                            <br>
                            @foreach ($product->productVariants->groupBy('variant.id') as $variantId => $variants)
                                <tr>
                                    <td>
                                        <label
                                            for="variant{{ $variantId }}">{{ $variants->first()->variant->nom_V }}</label>
                                    </td>
                                    <td>
                                        <select class="form-control select-variant"
                                            name="{{ $variants->first()->variant->nom_V }}"
                                            id="{{ $variants->first()->variant->nom_V }}">


                                            @foreach ($variants as $variant)
                                                <option value="{{ $variant->prix }}">{{ $variant->valeur }} </option>
                                            @endforeach
                                        </select>

                                    </td>
                                </tr>
                            @endforeach

                            <input type="hidden" name="id_produit" value="{{ $product->id }}">
                            <input type="hidden" name="selected_options" id="selected_options" value="">
                            <input type="hidden" name="prix_total" id="prix_total" value="">
                        </table>
                    </div>
            </div>
            <div class="col-md-3">
                </form>
                <!-- Carré de prix et de commande -->

                <div class="product-price">
                    <h2>Prix Totale</h2>
                    <p id="prix">Votre Prix:</p>
                    <button type="button" class="btn" onclick="addToCart(event)">check Command</button></a>
                    <form action="{{ route('contactC') }}" method="POST">
                        @csrf

                        <input type="hidden" name="command" id="command">
                        <input type="hidden" name="produit" id="produit" value="{{ $product->nom_P }}">

                        <button class="btn" type="submit">

                            Commander


                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- footer start -->
    <footer class="footer pt-120 " style="margin-top: 300px;">
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



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <!-- JS Here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function addToCart(event) {
            event.preventDefault(); // prevent default form submission behavior

            var selectedOptions = "";

            $('.select-variant option:selected').each(function() {
                var parentSelectName = $(this).parent().attr('name');
                selectedOptions += parentSelectName + ': ' + $(this).html() + ' ';
            });

            // Set the value of the hidden input field to the concatenated options
            $('#selected_options').val(selectedOptions);
            $('#command').val(selectedOptions);


            // Show alert with selected options
            alert(selectedOptions);
        }

        function changeValueCommand(event) {
            event.preventDefault();

            var selectedOptions = "";

            $('.select-variant option:selected').each(function() {
                var parentSelectName = $(this).parent().attr('name');
                selectedOptions += parentSelectName + ': ' + $(this).html() + ' ';
            });

            $('#command').val(selectedOptions);

        }




        $(document).ready(function() {
            $('.select-variant, #quantity').change(function() {
                var price = {{ $product->prix_base }};
                var quantity = parseInt($('#quantity').val());
                console.log('change event fired');
                $('.select-variant option:selected').each(function() {
                    if ($(this).parent().attr('id') === 'Quantité') {
                        price *= parseFloat($(this)
                            .val()); // use parseFloat() instead of parseInt()
                    } else {
                        price += parseFloat($(this)
                            .val()); // use parseFloat() instead of parseInt()
                    }
                });;
                $('#prix').html('Votre Prix : ' + price.toFixed(2) + 'DH');
                $('#prix_total').val(price);
            });
        });
        $(document).ready(function() {
            $('.select-variant').change(changeValueCommand);
        });
    </script>





</body>

</html>
