@extends('layouts.frontend')

@section('title', $product->name)

@section('content')

@php
  $app_config = \App\Models\AppConfig::first();
@endphp
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="breadcrumb-text product-more">
          <a href="{{ route('home') }}"><i class="fa fa-home"></i> Home</a>
          <a href="">{{ $product->name }}</a>
          <span>Detail</span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad page-details">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-8">
            <div class="product-pic-zoom">
              <img class="product-big-img" src="{{ $product->getFirstMediaUrl('product_image') }}" alt="">
              <div class="zoom-icon">
                <i class="fa fa-search-plus"></i>
              </div>
            </div>
            {{-- <div class="product-thumbs">
              <div class="product-thumbs-track ps-slider owl-carousel">
                <div class="pt active" data-imgbigurl="img/product-single/product-1.jpg"><img src="img/product-single/product-1.jpg" alt=""></div>
                <div class="pt" data-imgbigurl="img/product-single/product-2.jpg"><img src="img/product-single/product-2.jpg" alt=""></div>
                <div class="pt" data-imgbigurl="img/product-single/product-3.jpg"><img src="img/product-single/product-3.jpg" alt=""></div>
                <div class="pt" data-imgbigurl="img/product-single/product-3.jpg"><img src="img/product-single/product-3.jpg" alt=""></div>
              </div>
            </div> --}}
          </div>
          <div class="col-lg-4">
            <div class="product-details">
              <div class="pd-title">
                <h3>{{ $product->name }}</h3>
              </div>
              <hr>
              <ul class="pd-tags">
                <li><span>Model:</span> <span class="font-weight-normal">{{ $product->model_name }}</span></li>
                <li><span>Availability:</span>
                  @if($product->final_stock)
                    <span class="text-brand">In Stock</span>
                  @else
                    <span class="text-danger">Out of Stock</span>
                  @endif
                </li>
                <hr>
                <li><span>CATEGORY:</span> <span class="font-weight-normal">{{ $product->product_type->category->name }}, {{ $product->product_type->name }}</span></li>
                <li><span>Brand:</span> <span class="font-weight-normal">{{ $product->brand->name }}</span></li>

              </ul>
              <hr>
              <div class="pd-desc">
                <h4 class="text-danger">Offer Price:</h4>
                <h4 class="text-danger">৳{{ number_format($product->purchase->first()->offer_price ?? 0 , 2, '.', ',') }}</h4>
                <h4>Regular Price:</h4>
                <h4>৳{{ number_format($product->purchase->first()->unit_price ?? 0, 2, '.', ',') }}</h4>
              </div>

              <div class="">
                <a href="tel:{{ $app_config->helpline }}" class="primary-btn pd-cart rounded"><i class="fa fa-phone pr-2"></i>Call Now</a>
              </div>

              {{-- <div class="pd-share">
                <div class="p-code">Sku : 00012</div>
                <div class="pd-social">
                  <a href="#"><i class="ti-facebook"></i></a>
                </div>
              </div> --}}
            </div>
          </div>
        </div>
        <div class="product-tab">
          <div class="tab-item">
            <ul class="nav" role="tablist">
              <li>
                <a class="active" data-toggle="tab" href="#tab-1" role="tab">SPECIFICATIONS</a>
              </li>
              {{-- <li>
                <a data-toggle="tab" href="#tab-2" role="tab">SPECIFICATIONS</a>
              </li> --}}
              {{-- <li>
                <a data-toggle="tab" href="#tab-3" role="tab">Customer Reviews (02)</a>
              </li> --}}
            </ul>
          </div>
          <div class="tab-item-content">
            <div class="tab-content">
              <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                <div class="product-content">
                  <div class="row">
                    <div class="col-lg-7">
                      <p>{!! $product->description !!}</p>
                    </div>
                    <div class="col-lg-5">
                      <img src="img/product-single/tab-desc.jpg" alt="">
                    </div>
                  </div>
                </div>
              </div>
              {{-- <div class="tab-pane fade" id="tab-2" role="tabpanel">
                <div class="specification-table">
                  <table>
                    <tr>
                      <td class="p-catagory">Customer Rating</td>
                      <td>
                        <div class="pd-rating">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-o"></i>
                          <span>(5)</span>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-catagory">Price</td>
                      <td>
                        <div class="p-price">$495.00</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-catagory">Add To Cart</td>
                      <td>
                        <div class="cart-add">+ add to cart</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-catagory">Availability</td>
                      <td>
                        <div class="p-stock">22 in stock</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-catagory">Weight</td>
                      <td>
                        <div class="p-weight">1,3kg</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-catagory">Size</td>
                      <td>
                        <div class="p-size">Xxl</div>
                      </td>
                    </tr>
                    <tr>
                      <td class="p-catagory">Color</td>
                      <td><span class="cs-color"></span></td>
                    </tr>
                    <tr>
                      <td class="p-catagory">Sku</td>
                      <td>
                        <div class="p-code">00012</div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="tab-3" role="tabpanel">
                <div class="customer-review-option">
                  <h4>2 Comments</h4>
                  <div class="comment-option">
                    <div class="co-item">
                      <div class="avatar-pic">
                        <img src="img/product-single/avatar-1.png" alt="">
                      </div>
                      <div class="avatar-text">
                        <div class="at-rating">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-o"></i>
                        </div>
                        <h5>Brandon Kelley <span>27 Aug 2019</span></h5>
                        <div class="at-reply">Nice !</div>
                      </div>
                    </div>
                    <div class="co-item">
                      <div class="avatar-pic">
                        <img src="img/product-single/avatar-2.png" alt="">
                      </div>
                      <div class="avatar-text">
                        <div class="at-rating">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-o"></i>
                        </div>
                        <h5>Roy Banks <span>27 Aug 2019</span></h5>
                        <div class="at-reply">Nice !</div>
                      </div>
                    </div>
                  </div>
                  <div class="personal-rating">
                    <h6>Your Ratind</h6>
                    <div class="rating">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star-o"></i>
                    </div>
                  </div>
                  <div class="leave-comment">
                    <h4>Leave A Comment</h4>
                    <form action="#" class="comment-form">
                      <div class="row">
                        <div class="col-lg-6">
                          <input type="text" placeholder="Name">
                        </div>
                        <div class="col-lg-6">
                          <input type="text" placeholder="Email">
                        </div>
                        <div class="col-lg-12">
                          <textarea placeholder="Messages"></textarea>
                          <button type="submit" class="site-btn">Send message</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Product Shop Section End -->

<!-- Related Products Section End -->
<div class="related-products spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2>Related Products</h2>
        </div>
        <div class="product-slider owl-carousel">
          @foreach($related_products as $item)
            <div class="product-item">
              <div class="pi-pic">
                <a href="{{ route('product.detail', $item->id) }}"><img src="{{ $item->getFirstMediaUrl('product_image') }}" alt=""></a>
                @if($item->final_stock)
                  <div class="sale bg-brand">In Stock</div>
                @else
                  <div class="sale bg-danger">Out of Stock</div>
                @endif
              </div>
              <div class="pi-text">
                <div class="catagory-name">{{ $item->model_name }}</div>
                <a href="{{ route('product.detail', $item->id) }}">
                  <h5>{{ $item->name }}</h5>
                </a>
                <div class="product-price">
                  Offer price:
                  <br>
                  ৳{{ number_format($item->purchase->first()->offer_price ?? 0 , 2, '.', ',') }}
                  <br>
                  <span class="text-danger">Regular price:
                    <br>
                    ৳{{ number_format($item->purchase->first()->regular_price ?? 0, 2, '.', ',') }}
                  </span>
                </div>
              </div>
              <div class="d-flex justify-content-center">
                <a href="tel:{{ $app_config->helpline }}" class="primary-btn pd-cart px-4 py-2 mt-4 rounded"><i class="fa fa-phone pr-2"></i>Call Now</a>
              </div>

            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Related Products Section End -->
@endsection