<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="{{ asset('/css2-1?family=Russo+One&display=swap') }}" rel="stylesheet">
    <link href="{{ asset('/css2-4?family=Exo+2:wght@400;500;600;700;800;900&display=swap') }}" rel="stylesheet">
    <link
        href="{{ asset('/css2-5?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap') }}"
        rel="stylesheet">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/bootstrap.css') }}">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">




    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.css') }}">

    <style>
        .product-select label {
            margin-right: 50px;
        }

        .product-select select {
            width: 368px;
            border: 2px solid #ddd;
        }

        .prix_total {
            margin-top: 0;
            margin: -20px;
            padding: 15px;
            font-family: 'SansaBd', 'Arial';
            background-color: #000000;
            color: white;
            text-align: center;
            font-size: 25px;
        }
    </style>
</head>

<body>
    <form action="{{ route('cart_item') }}" method="post">
        @csrf
        <section class="product-section">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                        <div class="row g-4">
                            <div class="col-xl-6 wow fadeInUp">
                                <div class="product-left-box">
                                    <div class="row g-2">
                                        <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                            <div class="product-main-2 no-arrow">
                                                <div>
                                                    <div class="slider-image">
                                                        <img src="{{ asset('/assets/images/dynamic/' . $product->image_path) }}"
                                                            id="img-1"
                                                            data-zoom-image="assets/images/product/category/1.jpg"
                                                            class="img-fluid image_zoom_cls-0 blur-up lazyload"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="right-box-contain">
                                    <h2 class="name">{{ $product->nom_P }} <button type="button" class="btn"
                                            onclick="addToCart(e)">Ajouter au panier</button></h2>
                                    <div class="price-rating">
                                        <h3 class="theme-color price">{{ $product->prix_base }}DH</h3>

                                    </div>


                                    <div><br></div>
                                    <div class="product-select">
                                        <table>
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
                                                                <option value="{{ $variant->prix }}">
                                                                    {{ $variant->valeur }} </option>
                                                            @endforeach
                                                        </select>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            <input type="hidden" name="id_produit" value="{{ $product->id }}">
                                            <input type="hidden" name="selected_options" id="selected_options"
                                                value="">
                                            <input type="hidden" name="prix_total" id="prix_total" value="">
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="product-section-box">
                                    <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                                data-bs-target="#description" type="button" role="tab"
                                                aria-controls="description" aria-selected="true">Description</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content custom-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="description" role="tabpanel"
                                            aria-labelledby="description-tab">
                                            <div class="product-description">
                                                <div class="nav-desh">
                                                    <p>{{ $product->description_P }}</p>
                                                </div>


                                            </div>
                                        </div>


                                        <div class="tab-pane fade" id="review" role="tabpanel"
                                            aria-labelledby="review-tab">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--  -->
                    <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                        <div class="right-sidebar-box">
                            <div class="vendor-box">
                                <div class="prix_total">
                                    <h2 class="fw-500">Prix Total</h5>
                                </div>
                                <p class="vendor-detail" id="prix">Prix :</p>

                                <div class="vendor-list">
                                    <ul>
                                        <li>
                                            <div class="address-contact">
                                                <i data-feather="map-pin"></i>
                                                <h5>Address: <span class="text-content">1288 Franklin Avenue</span>
                                                </h5>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="address-contact">
                                                <i data-feather="headphones"></i>
                                                <h5>Contact Seller: <span class="text-content">(+1)-123-456-789</span>
                                                </h5>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <!-- latest jquery-->
    <script src="{{ asset('/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- jquery ui-->
    <script src="{{ asset('/assets/js/jquery-ui.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap/popper.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('/assets/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('/assets/js/feather/feather-icon.js') }}"></script>

    <!-- Lazyload Js -->
    <script src="{{ asset('/assets/js/lazysizes.min.js') }}"></script>

    <!-- Slick js-->
    <script src="{{ asset('/assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('/assets/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('/assets/js/custom-slick-animated.js') }}"></script>
    <script src="{{ asset('/assets/js/slick/custom_slick.js') }}"></script>

    <!-- Price Range Js -->
    <script src="{{ asset('/assets/js/ion.rangeSlider.min.js') }}"></script>

    <!-- sidebar open js -->
    <script src="{{ asset('/assets/js/filter-sidebar.js') }}"></script>

    <!-- Quantity js -->
    <script src="{{ asset('/assets/js/quantity-2.js') }}"></script>

    <!-- Zoom Js -->
    <script src="{{ asset('/assets/js/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('/assets/js/zoom-filter.js') }}"></script>

    <!-- Timer Js -->
    <script src="{{ asset('/assets/js/timer1.js') }}"></script>

    <!-- Sticky-bar js -->
    <script src="{{ asset('/assets/js/sticky-cart-bottom.js') }}"></script>

    <!-- WOW js -->
    <script src="{{ asset('/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('/assets/js/custom-wow.js') }}"></script>

    <!-- script js -->
    <script src="{{ asset('/assets/js/script.js') }}"></script>

    <!-- thme setting js -->
    <script src="{{ asset('/assets/js/theme-setting.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>


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

            // Show SweetAlert popup with selected options
            Swal.fire({
                title: 'Selected Options:',
                text: selectedOptions,
                icon: 'success',
                confirmButtonText: 'OK'
            });
        }

        $(document).ready(function() {
            $('.select-variant, #quantity').change(function() {
                var price = {{ $product->prix_base }};
                var quantity = parseInt($('#quantity').val());

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
    </script>

</body>

</html>
