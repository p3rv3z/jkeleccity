<div>
  @php
    $app_config = \App\Models\AppConfig::first();
  @endphp
  <!-- Breadcrumb Section Begin -->
  <div class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-text">
            <a href="#"><i class="fa fa-home"></i> Home</a>
            <a>Search</a>
            <span>{{ ucfirst($search) }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumb Section End -->

  <!-- Product Shop Section Begin -->
  <section class="product-shop spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 products-sidebar-filter">
          <div class="filter-widget">
            <h4 class="fw-title text-uppercase">Categories</h4>
            <ul class="filter-catagories">
              @forelse($categories as $category)
                <li><a class="text-uppercase {{ $selectedProductType == $category->id ? 'text-brand' : '' }}" href="" wire:click.prevent="$set('selectedCategory', {{ $category->id }})">{{ $category->name }}</a></li>
              @empty
                <li><a>No product type found!</a></li>
              @endforelse
            </ul>
          </div>
          @if($product_types)
            <div class="filter-widget">
              <h4 class="fw-title text-uppercase">Sub Categories</h4>
              <ul class="filter-catagories">
                @forelse($product_types as $product_type)
                  <li><a class="text-uppercase {{ $selectedProductType == $product_type->id ? 'text-brand' : '' }}" href="" wire:click.prevent="$set('selectedProductType', {{ $product_type->id }})">{{ $product_type->name }}</a></li>
                @empty
                  <li><a>No product type found!</a></li>
                @endforelse
              </ul>
            </div>
          @endif
          <div class="filter-widget">
            <h4 class="fw-title text-uppercase">Brands</h4>
            <div class="fw-tags">
              @forelse($brands as $brand)
                <a class="text-uppercase {{ $selectedBrand == $brand->id ? 'bg-brand' : '' }}" href="" wire:click.prevent="$set('selectedBrand', {{ $brand->id }})">{{ $brand->name }}</a>
              @empty
                No brand found!
              @endforelse
            </div>
          </div>
          {{-- <div class="filter-widget">
            <h4 class="fw-title">Price</h4>
            <div class="filter-range-wrap">
              <div class="range-slider">
                <div class="price-input">
                  <input type="text" id="minamount">
                  <input type="text" id="maxamount">
                </div>
              </div>
              <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="1000" data-max="100000">
                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
              </div>
            </div>
            <a href="#" class="filter-btn">Filter</a>
          </div> --}}
        </div>
        <div class="col-lg-9 order-1 order-lg-2">
          <div class="product-show-option">
            <div class="row">
              <div class="col-lg-2 col-md-2">
                <div class="select-option">
                  <select id="paginate" class="form-control" wire:model="productPerPage" name>
                    <option value="" disabled>Show</option>
                    <option value="12">12</option>
                    <option value="24">24</option>
                    <option value="36">36</option>
                  </select>
                  {{-- <select class="p-show">
                    <option>Show:</option>
                    <option value="10">10</option>
                    <option value="10">10</option>

                  </select> --}}
                </div>

              </div>
              {{-- <div class="col-lg-5 col-md-5 text-right">
                <p>Show 01- 09 Of 36 Product</p>
              </div> --}}
            </div>
          </div>
          <div class="product-list">
            <div class="row">
              @forelse($products as $item)
                <div class="col-6 col-md-4 col-lg-3">
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
                        ৳{{ number_format($item->purchase->first()->offer_price ?? 0, 2, '.', ',') }}
                        <br>
                        <span class="text-danger ">Regular price:
                          <br>
                          ৳{{ number_format($item->purchase->first()->regular_price ?? 0, 2, '.', ',') }}
                        </span>
                      </div>
                    </div>
                    <div class="d-flex justify-content-center">
                      <a href="tel:{{ $app_config->helpline }}" class="primary-btn pd-cart px-4 py-2 mt-4 rounded"><i class="fa fa-phone pr-2"></i>Call Now</a>
                    </div>
                  </div>
                </div>
              @empty
                No product found
              @endforelse
            </div>
          </div>
          <div class="d-flex justify-content-center">
            {{ $products->links() }}
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Product Shop Section End -->

  <!-- Featured Products Section End -->
<div class="related-products spad">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="section-title">
          <h2>Featured Products</h2>
        </div>
        <div class="product-slider owl-carousel">
          @foreach($featured_products as $item)
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
<!-- Featured Products Section End -->
</div>