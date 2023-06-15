@extends('frontend.layouts.master')

@section("content")

    @if(count($banners)>0)
    <!-- Welcome Slides Area -->
    <section class="welcome_area">
        <div class="welcome_slides owl-carousel">
        
          @foreach($banners as $banner)
            <!-- Single Slide -->
            <div class="single_slide bg-img" style="background-image: url({{$banner->photo}});">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-md-6">
                            <div class="welcome_slide_text">
                                <h2 class="text-white" data-animation="fadeInUp" data-delay="300ms">{{$banner->title}}</h2>
                                <h4 class="text-white" data-animation="fadeInUp" data-delay="600ms">{!! html_entity_decode($banner->description) !!}</h4>
                                <a href="#" class="btn btn-primary" data-animation="fadeInUp" data-delay="900ms">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          @endforeach
        </div>
    </section>
    <!-- Welcome Slides Area -->
    @endif


@if(count($categories))
    <!-- Top Catagory Area -->
    <div class="top_catagory_area mt-50 clearfix">
        <div class="container">
            <div class="row">
            @foreach($categories as $cat)
                <!-- Single Catagory -->
                <div class="col-12 col-md-4">
                    <div class="single_catagory_area mt-50"></div>
                      <a href="{{route('product.category', $cat->slug)}}">
                            <img src="{{$cat->photo}}" alt="{{$cat->title}}">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Top Catagory Area -->
@endif
    <!-- Quick View Modal Area -->
    <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-body">
                    <div class="quickview_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 col-lg-5">
                                    <div class="quickview_pro_img">
                                        <img class="first_img" src="frontend/img/product-img/new-1-back.png" alt="">
                                        <img class="hover_img" src="frontend/img/product-img/new-1.png" alt="">
                                        <!-- Product Badge -->
                                        <div class="product_badge">
                                            <span class="badge-new">New</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-7">
                                    <div class="quickview_pro_des">
                                        <h4 class="title">Boutique Silk Dress</h4>
                                        <div class="top_seller_product_rating mb-15">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </div>
                                        <h5 class="price">$120.99 <span>$130</span></h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita
                                            quibusdam aspernatur, sapiente consectetur accusantium perspiciatis
                                            praesentium eligendi, in fugiat?</p>
                                        <a href="#">View Full Product Details</a>
                                    </div>
                                    <!-- Add to Cart Form -->
                                    <form class="cart" method="post">
                                        <div class="quantity">
                                            <input type="number" class="qty-text" id="qty" step="1" min="1" max="12"
                                                name="quantity" value="1">
                                        </div>
                                        <button type="submit" name="addtocart" value="5" class="cart-submit">Add to
                                            cart</button>
                                        <!-- Wishlist -->
                                        <div class="modal_pro_wishlist">
                                            <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                        </div>
                                        <!-- Compare -->
                                        <div class="modal_pro_compare">
                                            <a href="compare.html"><i class="icofont-exchange"></i></a>
                                        </div>
                                    </form>
                                    <!-- Share -->
                                    <div class="share_wf mt-30">
                                        <p>Share with friends</p>
                                        <div class="_icon">
                                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                            <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View Modal Area -->


    @php 
    $new_product = \App\Models\Product::where(["status"=>"active" ,"conditions"=>"NEW"])->orderBy("id" , "DESC")->limit(10)->get();
    @endphp

    @if(count($new_product)>0)
    <!-- New Arrivals Area -->
    <section class="new_arrivals_area section_padding_100 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_heading new_arrivals">
                        <h5>New Arrivals</h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="new_arrivals_slides owl-carousel">
                        <!-- Single Product -->

                        @foreach($new_product as $nproduct)
                        <!-- Single Product -->
                        <div class="single-product-area">
                            <div class="product_image">

                            @php 
                            $photo = explode(",",$nproduct->photo);
                            @endphp
                                <!-- Product Image -->
                                <img class="normal_img" src="{{$photo[0]}}" alt="{{$nproduct->title}}">

                                <!-- Product Badge -->
                                <div class="product_badge">
                                    <span>{{$nproduct->conditions}}</span>
                                </div>

                                <!-- Wishlist -->
                                <div class="product_wishlist">
                                    <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                </div>

                                <!-- Compare -->
                                <div class="product_compare">
                                    <a href="compare.html"><i class="icofont-exchange"></i></a>
                                </div>
                            </div>

                            <!-- Product Description -->
                            <div class="product_description">
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#"><i class="icofont-shopping-cart"></i> Add to Cart</a>
                                </div>

                                <!-- Quick View -->
                                <div class="product_quick_view">
                                    <a href="#" data-toggle="modal" data-target="#quickview"><i
                                            class="icofont-eye-alt"></i> Quick View</a>
                                </div>

                                <p class="brand_name">{{\App\Models\Brand::where('id' , $nproduct->brand_id)->value("title")}}</p>
                                <a href="{{route('product.detail' , $nproduct->slug)}}">{{ucfirst($nproduct->title)}}</a>
                                <h6 class="product-price">{{ number_format($nproduct->offre_price , 2) }} <small> <del class="text-danger">{{ number_format($nproduct->price , 2) }}</del> </small> </h6>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- New Arrivals Area -->
    @endif

    <!-- Featured Products Area -->
    <section class="featured_product_area">
        <div class="container">
            <div class="row">
                <!-- Featured Offer Area -->
                <div class="col-12 col-lg-6">
                    <div class="featured_offer_area d-flex align-items-center"
                        style="background-image: url(img/bg-img/fea_offer.jpg);">
                        <div class="featured_offer_text">
                            <p>Summer 2018</p>
                            <h2>30% OFF</h2>
                            <h4>All kid’s items</h4>
                            <a href="#" class="btn btn-primary btn-sm mt-3">Shop Now</a>
                        </div>
                    </div>
                </div>

                <!-- Featured Product Area -->
                <div class="col-12 col-lg-6">
                    <div class="section_heading featured">
                        <h5>Featured Products</h5>
                    </div>

                    <!-- Featured Product Slides -->
                    <div class="featured_product_slides owl-carousel">
                        <!-- Single Product -->
                        <div class="single-product-area">
                            <div class="product_image">
                                <!-- Product Image -->
                                <img class="normal_img" src="frontend/img/product-img/new-2.png" alt="">
                                <img class="hover_img" src="frontend/img/product-img/new-2-back.png" alt="">

                                <!-- Product Badge -->
                                <div class="product_badge">
                                    <span>Sale</span>
                                </div>

                                <!-- Wishlist -->
                                <div class="product_wishlist">
                                    <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                </div>

                                <!-- Compare -->
                                <div class="product_compare">
                                    <a href="compare.html"><i class="icofont-exchange"></i></a>
                                </div>
                            </div>

                            <!-- Product Description -->
                            <div class="product_description">
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#"><i class="icofont-shopping-cart"></i> Add to Cart</a>
                                </div>

                                <!-- Quick View -->
                                <div class="product_quick_view">
                                    <a href="#" data-toggle="modal" data-target="#quickview"><i
                                            class="icofont-eye-alt"></i> Quick View</a>
                                </div>

                                <a href="#">Flower Textured Dress</a>
                                <h6 class="product-price">$17 <span>$26</span></h6>
                                <div class="product_rating">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Single Product -->
                        <div class="single-product-area">
                            <div class="product_image">
                                <!-- Product Image -->
                                <img class="normal_img" src="frontend/img/product-img/new-4.png" alt="">
                                <img class="hover_img" src="frontend/img/product-img/new-4-back.png" alt="">

                                <!-- Product Badge -->
                                <div class="product_badge">
                                    <span>Sale</span>
                                </div>

                                <!-- Wishlist -->
                                <div class="product_wishlist">
                                    <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                </div>

                                <!-- Compare -->
                                <div class="product_compare">
                                    <a href="compare.html"><i class="icofont-exchange"></i></a>
                                </div>
                            </div>

                            <!-- Product Description -->
                            <div class="product_description">
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#"><i class="icofont-shopping-cart"></i> Add to Cart</a>
                                </div>

                                <!-- Quick View -->
                                <div class="product_quick_view">
                                    <a href="#" data-toggle="modal" data-target="#quickview"><i
                                            class="icofont-eye-alt"></i> Quick View</a>
                                </div>

                                <a href="#">Box Shape Dress</a>
                                <h6 class="product-price">$21.25</h6>
                                <div class="product_rating">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Single Product -->
                        <div class="single-product-area">
                            <div class="product_image">
                                <!-- Product Image -->
                                <img class="normal_img" src="frontend/img/product-img/new-7.png" alt="">
                                <img class="hover_img" src="frontend/img/product-img/new-7-back.png" alt="">

                                <!-- Product Badge -->
                                <div class="product_badge">
                                    <span>Sale</span>
                                </div>

                                <!-- Wishlist -->
                                <div class="product_wishlist">
                                    <a href="wishlist.html"><i class="icofont-heart"></i></a>
                                </div>

                                <!-- Compare -->
                                <div class="product_compare">
                                    <a href="compare.html"><i class="icofont-exchange"></i></a>
                                </div>
                            </div>

                            <!-- Product Description -->
                            <div class="product_description">
                                <!-- Add to cart -->
                                <div class="product_add_to_cart">
                                    <a href="#"><i class="icofont-shopping-cart"></i> Add to Cart</a>
                                </div>

                                <!-- Quick View -->
                                <div class="product_quick_view">
                                    <a href="#" data-toggle="modal" data-target="#quickview"><i
                                            class="icofont-eye-alt"></i> Quick View</a>
                                </div>

                                <a href="#">Black Dress</a>
                                <h6 class="product-price">$41 <span>$44</span></h6>
                                <div class="product_rating">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Products Area -->

    <!-- Best Rated/Onsale/Top Sale Product Area -->
    <section class="best_rated_onsale_top_sellares section_padding_100_70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tabs_area">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" role="tablist" id="product-tab">
                            <li class="nav-item">
                                <a href="#top-sellers" class="nav-link" data-toggle="tab" role="tab">Top Sellers</a>
                            </li>
                            <li class="nav-item">
                                <a href="#best-rated" class="nav-link" data-toggle="tab" role="tab">Best Rated</a>
                            </li>
                            <li class="nav-item">
                                <a href="#on-sale" class="nav-link active" data-toggle="tab" role="tab">On Sale</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade" id="top-sellers">
                                <div class="top_sellers_area">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/top-1.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>KID’s Fashion</h5>
                                                    <h6>$49.39 <span>$55.31</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/top-2.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Beach Cap</h5>
                                                    <h6>$20 <span>$25</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/top-3.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Gold Neckless</h5>
                                                    <h6>$69 <span>$71</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/top-4.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Diamond Neckless</h5>
                                                    <h6>$300 <span>$310</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/top-5.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Sport Shoes</h5>
                                                    <h6>$30 <span>$34</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/top-6.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Pin Up Bikini</h5>
                                                    <h6>$27 <span>$29</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="best-rated">
                                <div class="best_rated_area">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/best-1.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Sports Bra</h5>
                                                    <h6>$60 <span>$63</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/best-2.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Trendy Glasses</h5>
                                                    <h6>$30 <span>$32</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/best-3.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Women Watch</h5>
                                                    <h6>$79 <span>$85</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/best-4.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Headphone</h5>
                                                    <h6>$18 <span>$21</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/best-5.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Plus Bra</h5>
                                                    <h6>$51 <span>$58</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/best-6.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Laptop</h5>
                                                    <h6>$130 <span>$160</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane fade show active" id="on-sale">
                                <div class="on_sale_area">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/onsale-1.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Speaker</h5>
                                                    <h6>$60 <span>$70</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/onsale-2.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Fancy Lamp</h5>
                                                    <h6>$34 <span>$40</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/onsale-3.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Sport Bra</h5>
                                                    <h6>$63 <span>$70</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/onsale-4.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>S'well Water</h5>
                                                    <h6>$12 <span>$13</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/onsale-5.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>Slipper</h5>
                                                    <h6>$24 <span>$36</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-lg-4">
                                            <div class="single_top_sellers">
                                                <div class="top_seller_image">
                                                    <img src="frontend/img/product-img/onsale-6.png" alt="Top-Sellers">
                                                </div>
                                                <div class="top_seller_desc">
                                                    <h5>T-shirt</h5>
                                                    <h6>$96 <span>$120</span></h6>
                                                    <div class="top_seller_product_rating">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>

                                                    <!-- Info -->
                                                    <div
                                                        class="ts-seller-info mt-3 d-flex align-items-center justify-content-between">
                                                        <!-- Add to cart -->
                                                        <div class="ts_product_add_to_cart">
                                                            <a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Add To Cart"><i
                                                                    class="icofont-shopping-cart"></i></a>
                                                        </div>

                                                        <!-- Wishlist -->
                                                        <div class="ts_product_wishlist">
                                                            <a href="wishlist.html" data-toggle="tooltip"
                                                                data-placement="top" title="Wishlist"><i
                                                                    class="icofont-heart"></i></a>
                                                        </div>

                                                        <!-- Compare -->
                                                        <div class="ts_product_compare">
                                                            <a href="compare.html" data-toggle="tooltip"
                                                                data-placement="top" title="Compare"><i
                                                                    class="icofont-exchange"></i></a>
                                                        </div>

                                                        <!-- Quick View -->
                                                        <div class="ts_product_quick_view">
                                                            <a href="#" data-toggle="modal" data-target="#quickview"><i
                                                                    class="icofont-eye-alt"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Best Rated/Onsale/Top Sale Product Area -->

    <!-- Offer Area -->
    <section class="offer_area">
        <div class="container">
            <div class="row">
                <!-- Beach Offer -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="beach_offer_area mb-4 mb-md-0">
                        <img src="frontend/img/product-img/beach.png" alt="beach-offer">
                        <div class="beach_offer_info">
                            <p>Upto 70% OFF</p>
                            <h3>Beach Item</h3>
                            <a href="#" class="btn btn-primary btn-sm mt-15">SHOP NOW</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Apparels Offer -->
                    <div class="apparels_offer_area">
                        <img src="frontend/img/product-img/apparels.jpg" alt="Beach-Offer">
                        <div class="apparels_offer_info d-flex align-items-center">
                            <div class="apparels-offer-content">
                                <h4>Apparel &amp; <br><span>Garments</span></h4>
                                <a href="#" class="btn">Buy Now <i class="icofont-rounded-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Deals of the Week -->
                    <div class="weekly_deals_area mt-30">
                        <img src="frontend/img/product-img/weekly-offer.jpg" alt="weekly-deals">
                        <div class="weekly_deals_info">
                            <h4>Deals of the Week</h4>
                            <div class="deals_timer">
                                <ul data-countdown="2021/02/14 14:21:38">
                                    <!-- Please use event time this format: YYYY/MM/DD hh:mm:ss -->
                                    <li><span class="days">00</span>days</li>
                                    <li><span class="hours">00</span>hours</li>
                                    <li class="d-block blank-timer"></li>
                                    <li><span class="minutes">00</span>min</li>
                                    <li><span class="seconds">00</span>sec</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <!-- Elect Offer -->
                            <div class="elect_offer_area mt-30 mt-lg-0">
                                <img src="frontend/img/product-img/elect.jpg" alt="Elect-Offer">
                                <div class="elect_offer_info d-flex align-items-center">
                                    <div class="elect-offer-content">
                                        <h4>Electronics</h4>
                                        <a href="#" class="btn">Buy Now <i class="icofont-rounded-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12">
                            <!-- Backpack Offer -->
                            <div class="backpack_offer_area mt-30">
                                <img src="frontend/img/product-img/backpack.jpg" alt="Backpack-Offer">
                                <div class="backpack_offer_info">
                                    <h4>Backpacks</h4>
                                    <a href="#" class="btn">Buy Now <i class="icofont-rounded-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Offer Area End -->

    <!-- Popular Brands Area -->
    <section class="popular_brands_area section_padding_100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="popular_section_heading mb-50">
                        <h5>Popular Brands</h5>
                    </div>
                </div>
                <div class="col-12">
                    <div class="popular_brands_slide owl-carousel">
                        <div class="single_brands">
                            <img src="frontend/img/partner-img/1.jpg" alt="">
                        </div>
                        <div class="single_brands">
                            <img src="frontend/img/partner-img/2.jpg" alt="">
                        </div>
                        <div class="single_brands">
                            <img src="frontend/img/partner-img/3.jpg" alt="">
                        </div>
                        <div class="single_brands">
                            <img src="frontend/img/partner-img/4.jpg" alt="">
                        </div>
                        <div class="single_brands">
                            <img src="frontend/img/partner-img/5.jpg" alt="">
                        </div>
                        <div class="single_brands">
                            <img src="frontend/img/partner-img/6.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Popular Brands Area -->

    <!-- Special Featured Area -->
    <section class="special_feature_area pt-5">
        <div class="container">
            <div class="row">
                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-ship"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Free Shipping</h6>
                            <p>For orders above $100</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-box"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Happy Returns</h6>
                            <p>7 Days free Returns</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-money"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>100% Money Back</h6>
                            <p>If product is damaged</p>
                        </div>
                    </div>
                </div>

                <!-- Single Feature Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="single_feature_area mb-5 d-flex align-items-center">
                        <div class="feature_icon">
                            <i class="icofont-live-support"></i>
                            <span><i class="icofont-check-alt"></i></span>
                        </div>
                        <div class="feature_content">
                            <h6>Dedicated Support</h6>
                            <p>We provide support 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Special Featured Area -->


@endsection

