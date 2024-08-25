<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('/assets/css/produitBootstrap.css') }}">

    <!-- link css -->
    <link rel="stylesheet" href="{{ asset('/assets/css/produit.css') }}">

</head>
<body>
    <section class="product-section">
    <div class="container">
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
                                                    <img src="{{ asset("/assets/images/dynamic/".$product->image_path) }}" id="img-1" data-zoom-image="{{ asset("/assets/images/dynamic/".$product->image_path) }}" class="img-fluid image_zoom_cls-0 blur-up lazyload" alt="{{$product->image_path}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="right-box-contain">
                                <h2 class="name">{{$product->nom_P}}</h2>
                                <div class="price-rating">
                                    <h3 class="theme-color price">{{$product->prix_base}} DH</h3>
                                    
                                </div>
                                <hr>
                                <div><br></div>
                                <div class="product-select">
                                    <form action="{{route('cart_item')}}" method="post">
                                        @csrf
                                    <table >
                                        @foreach($product->productVariants->groupBy('variant.id') as $variantId => $variants)
                                        <tr>
                                          <td>
                                            <label for="variant{{ $variantId }}">{{ $variants->first()->variant->nom_V }}</label>
                                          </td> 
                                            <td>
                                              <select class="form-control select-variant" 
                                            name="{{ $variants->first()->variant->nom_V }}" id="{{ $variants->first()->variant->nom_V }}">
                            
                            
                                            @foreach($variants as $variant)
                            
                                                    <option value="{{ $variant->prix }}">{{ $variant->valeur }} </option>
                                                    
                                            @endforeach
                                            </select>
                                            
                                      </td> </tr> 
                                    @endforeach
                                    </table>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="product-section-box">
                                <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                                    </li>
                                </ul>

                                <div class="tab-content custom-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                        <div class="product-description">
                                            <div class="nav-desh">
                                                <p class="text-bold">{{$product->description_P}}</p>
                                            </div>

                                            
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                        
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
                            <div class="text-center">
                            <p class="vendor-detail text-success fw-bold" id="prix">Prix :</p></div>
                
                            <div class="vendor-list">
                                <ul>
                                    <li>
                                        <div class="address-contact">
                                            <i data-feather="map-pin"></i>
                                            <h5>Address: <span class="text-content mt-2">Adresse Casablanca 101 rue farhat hachad</span></h5>
                                        </div>
                                    </li>
                
                                    <li>
                                        <div class="address-contact">
                                            <i data-feather="headphones"></i>
                                            <h5>Contact Seller: <span class="text-content">(+212)6 04 72 71 24</span></h5>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
         $(document).ready(function() {
        $('.select-variant, #quantity').change(function() {
            var price = {{ $product->prix_base }};
            var quantity = parseInt($('#quantity').val());
            
            $('.select-variant option:selected').each(function() {
                if ($(this).parent().attr('id') === 'Quantité') {
                    price *= parseFloat($(this).val()); // use parseFloat() instead of parseInt()
                } else {
                    price += parseFloat($(this).val()); // use parseFloat() instead of parseInt()
                }
            });
            ;
            $('#prix').html('Prix : ' + price.toFixed(3) + ' DH');
            $('#prix_total').val(price); //pour panier input prix total
        });
    });
    </script>

    


    <!-- jquery ui-->
    <!-- <script src="assets/js/jquery-ui.min.js"></script> -->

    <!-- Bootstrap js-->
    <!-- <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bootstrap/bootstrap-notify.min.js"></script>
    <script src="assets/js/bootstrap/popper.min.js"></script> -->

    <!-- feather icon js-->
    <!-- <script src="assets/js/feather/feather.min.js"></script>
    <script src="assets/js/feather/feather-icon.js"></script> -->

    <!-- Lazyload Js -->
    <!-- <script src="assets/js/lazysizes.min.js"></script> -->

    <!-- Slick js-->
    <!-- <script src="assets/js/slick/slick.js"></script>
    <script src="assets/js/slick/slick-animation.min.js"></script>
    <script src="assets/js/custom-slick-animated.js"></script>
    <script src="assets/js/slick/custom_slick.js"></script> -->

    <!-- Price Range Js -->
    <!-- <script src="assets/js/ion.rangeSlider.min.js"></script> -->

    <!-- sidebar open js -->
    <!-- <script src="assets/js/filter-sidebar.js"></script> -->

    <!-- Quantity js -->
    <!-- <script src="assets/js/quantity-2.js"></script> -->

    <!-- Zoom Js -->
    <!-- <script src="assets/js/jquery.elevatezoom.js"></script>
    <script src="assets/js/zoom-filter.js"></script> -->

    <!-- Timer Js -->
    <!-- <script src="assets/js/timer1.js"></script> -->

    <!-- Sticky-bar js -->
    <!-- <script src="assets/js/sticky-cart-bottom.js"></script> -->

    <!-- WOW js -->
    <!-- <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/custom-wow.js"></script> -->

    <!-- script js -->
    <!-- <script src="assets/js/script.js"></script> -->

    <!-- thme setting js -->
    <!-- <script src="assets/js/theme-setting.js"></script> -->

</body>
</html>