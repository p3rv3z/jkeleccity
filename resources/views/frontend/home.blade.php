@extends('layouts.frontend')

@section('title', 'Home')

@section('content')
@php
  $app_config = \App\Models\AppConfig::first();
@endphp
<!-- Hero Section Begin -->
<section class="hero-section">
  <div class="hero-items owl-carousel">
    @foreach($slider_images as $slider_image)
      <div class="single-hero-items set-bg" data-setbg="{{ asset($slider_image->getFirstMediaUrl('banner_image')) }}">
      </div>
    @endforeach
  </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<div class="banner-section spad">
  <div class="container-fluid">
    <div class="row">
      @foreach($small_banners as $small_banner)
        <div class="col-lg-4">
          <div class="single-banner">
            <img src="{{ asset($small_banner->getFirstMediaUrl('banner_image')) }}" alt="">
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
<!-- Banner Section End -->

<!-- Man Banner Section Begin -->
<section class="man-banner spad">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <div class="section-title">
          <h2 class="">Refrigerator</h2>
        </div>
        <div class="product-slider owl-carousel">
          @foreach($refrigerators as $item)
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
                  ৳{{ number_format($item->latest_purchase->offer_price ?? 0 , 2, '.', ',') }}
                  <br>
                  <span class="text-danger">Regular price:
                    <br>
                    ৳{{ number_format($item->latest_purchase->regular_price ?? 0, 2, '.', ',') }}
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

    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <div class="section-title">
          <h2>Air Conditioner</h2>
        </div>
        <div class="product-slider owl-carousel">
          @foreach($air_conditioners as $item)
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
                  ৳{{ number_format($item->latest_purchase->offer_price ?? 0 , 2, '.', ',') }}
                  <br>
                  <span class="text-danger">Regular price:
                    <br>
                    ৳{{ number_format($item->latest_purchase->regular_price ?? 0, 2, '.', ',') }}
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

    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <div class="section-title">
          <h2>Washing Machine</h2>
        </div>
        <div class="product-slider owl-carousel">
          @foreach($washing_machines as $item)
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
                  ৳{{ number_format($item->latest_purchase->offer_price ?? 0 , 2, '.', ',') }}
                  <br>
                  <span class="text-danger">Regular price:
                    <br>
                    ৳{{ number_format($item->latest_purchase->regular_price ?? 0, 2, '.', ',') }}
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

    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <div class="section-title">
          <h2>Kitchen Appliances</h2>
        </div>
        <div class="product-slider owl-carousel">
          @foreach($kitchen_appliances as $item)
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
                  ৳{{ number_format($item->latest_purchase->offer_price ?? 0 , 2, '.', ',') }}
                  <br>
                  <span class="text-danger">Regular price:
                    <br>
                    ৳{{ number_format($item->latest_purchase->regular_price ?? 0, 2, '.', ',') }}
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

    <div class="row">
      <div class="col-lg-10 offset-lg-1">
        <div class="section-title">
          <h2>Television</h2>
        </div>
        <div class="product-slider owl-carousel">
          @foreach($televisions as $item)
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
                  ৳{{ number_format($item->latest_purchase->offer_price ?? 0 , 2, '.', ',') }}
                  <br>
                  <span class="text-danger">Regular price:
                    <br>
                    ৳{{ number_format($item->latest_purchase->regular_price ?? 0, 2, '.', ',') }}
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
</section>
<!-- Man Banner Section End -->

@endsection