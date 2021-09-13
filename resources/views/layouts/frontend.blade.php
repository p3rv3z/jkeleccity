@php
  $app_config = App\Models\AppConfig::first();
  $refrigerator = App\Models\Category::Where('name', 'REFRIGERATOR')->with('product_types')->first();
  $air_conditioner = App\Models\Category::Where('name', 'AIR CONDITIONER')->with('product_types')->first();
  $television = App\Models\Category::Where('name', 'TELEVISION')->with('product_types')->first();
  $washing_machine = App\Models\Category::Where('name', 'WASHING MACHINE')->with('product_types')->first();
  $microwave_oven = App\Models\Category::Where('name', 'MICROWAVE OVEN')->with('product_types')->first();
  $kitchen_appliances = App\Models\Category::Where('name', 'KITCHEN APPLIANCES')->with('product_types')->first();
  $others = App\Models\Category::Where('name', 'Others')->with('product_types')->first();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="UTF-8">
    <meta name="description" content="an electronics shop">
    <meta name="keywords" content="electronics">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $app_config->name }} | @yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    {{-- favicon --}}
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('config_images/'.$app_config->favicon) ?? "https://via.placeholder.com/16x16.png" }}">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/themify-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css">
    @livewireStyles
  </head>

  <body>

    {{-- <!-- Page Preloder -->
    {{-- <div id="preloder">
      <div class="loader"></div>
    </div> --}}

    <!-- Header Section Begin -->
    <header class="header-section">
      <div class="header-top">
        <div class="container">
          <div class="ht-left">
            <div class="mail-service">
              <i class=" fa fa-envelope"></i>
              {{ $app_config->email }}
            </div>
            <div class="phone-service">
              <i class=" fa fa-phone"></i>
              {{ $app_config->helpline }}
            </div>
          </div>
          <div class="ht-right">
            <a href="{{ route('login') }}" class="login-panel"><i class="fa fa-user"></i>Login</a>
            <div class="top-social">
              <a href="{{ $app_config->facebook }}" target="_blank"><i class="ti-facebook"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="inner-header">
          <div class="row">
            <div class="col-lg-2 col-md-2 p-2">
              <div class="logo p-0">
                <a href="{{ route('home') }}">
                  <img height="50px" src="{{ asset('config_images/'.$app_config->logo)}}" alt="">
                </a>
              </div>
            </div>
            <div class="col-lg-5 col-md-6 offset-lg-4 offset-md-3 p-2">
              <div class="advanced-search">
                <div class="input-group">
                  <form action="{{ route('product.search') }}" method="get" id="searchForm">
                    @csrf
                    <input name="search" type="text" placeholder="Name, Model, Category, Brand">
                  </form>
                  <button type="button" onclick="document.getElementById('searchForm').submit();"><i class="ti-search"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="nav-item">
        <div class="container">
          <nav class="nav-menu mobile-menu">
            <ul>
              <li class="{{ request()->is('/') ? 'active' : null }}"><a href="{{ route('home') }}">Home</a></li>
              <li class="@empty(! $refrigerator){{ request()->is('products/'.$refrigerator->id.'*') ? 'active' : null }}@endempty"><a href="@empty(! $refrigerator) {{ route('products', $refrigerator->id ) }} @endempty">REFRIGERATOR</a>
              @empty(! $refrigerator)
                <ul class="dropdown">
                  @foreach($refrigerator->product_types as $type)
                    <li><a class="text-uppercase" href="{{ route('products', [$refrigerator->id, $type->id]) }}">{{ $type->name }}</a></li>
                  @endforeach
                </ul>
                @endempty
              </li>
              <li class="@empty(! $air_conditioner){{ request()->is('products/'.$air_conditioner->id.'*') ? 'active' : null }}@endempty"><a href="@empty(! $air_conditioner) {{ route('products', $air_conditioner->id ) }} @endempty">AIR CONDITIONER</a>
              @empty(! $air_conditioner)
                <ul class="dropdown">
                  @foreach($air_conditioner->product_types as $type)
                    <li><a class="text-uppercase" href="@empty(! $air_conditioner){{ route('products', [$air_conditioner->id, $type->id]) }}@endempty">{{ $type->name }}</a></li>
                  @endforeach
                </ul>
                @endempty
              </li>
              <li class="@empty(! $television){{ request()->is('products/'.$television->id.'*') ? 'active' : null }}@endempty"><a href="@empty(! $television) {{ route('products', $television->id ) }} @endempty">TELEVISION</a>
              @empty(! $television)
                <ul class="dropdown">
                  @foreach($television->product_types as $type)
                    <li><a class="text-uppercase" href="@empty(! $television){{ route('products', [$television->id, $type->id]) }}@endempty">{{ $type->name }}</a></li>
                  @endforeach
                </ul>
                @endempty
              </li>
              <li class="@empty(! $washing_machine){{ request()->is('products/'.$washing_machine->id.'*') ? 'active' : null }}@endempty"><a href="@empty(! $washing_machine) {{ route('products', $washing_machine->id ) }} @endempty">WASHING MACHINE</a>
              @empty(! $washing_machine)
                <ul class="dropdown">
                  @foreach($washing_machine->product_types as $type)
                    <li><a class="text-uppercase" href="{{ route('products', [$washing_machine->id, $type->id]) }}">{{ $type->name }}</a></li>
                  @endforeach
                </ul>
                @endempty
              </li>

              <li class="@empty(! $microwave_oven){{ request()->is('products/'.$microwave_oven->id.'*') ? 'active' : null }}@endempty"><a href="@empty(! $microwave_oven) {{ route('products', $microwave_oven->id ) }} @endempty">MICROWAVE OVEN</a>
              @empty(! $microwave_oven)
                <ul class="dropdown">
                  @foreach($microwave_oven->product_types as $type)
                    <li><a class="text-uppercase" href="{{ route('products', [$microwave_oven->id, $type->id]) }}">{{ $type->name }}</a></li>
                  @endforeach
                </ul>
                @endempty
              </li>

              <li class="@empty(! $kitchen_appliances){{ request()->is('products/'.$kitchen_appliances->id.'*') ? 'active' : null }}@endempty"><a href="@empty(! $kitchen_appliances) {{ route('products', $kitchen_appliances->id ) }} @endempty">KITCHEN APPLIANCES</a>
              @empty(! $kitchen_appliances)
                <ul class="dropdown">
                  @foreach($kitchen_appliances->product_types as $type)
                    <li><a class="text-uppercase" href="{{ route('products', [$kitchen_appliances->id, $type->id]) }}">{{ $type->name }}</a></li>
                  @endforeach
                </ul>
                @endempty
              </li>

              <li class="@empty(! $others){{ request()->is('products/'.$others->id.'*') ? 'active' : null }}@endempty"><a href="@empty(! $others) {{ route('products', $others->id ) }} @endempty">Others</a>
              @empty(! $others)
                <ul class="dropdown">
                  @foreach($others->product_types as $type)
                    <li><a class="text-uppercase" href="{{ route('products', [$others->id, $type->id]) }}">{{ $type->name }}</a></li>
                  @endforeach
                </ul>
                @endempty
              </li>


            </ul>
          </nav>
          <div id="mobile-menu-wrap"></div>
        </div>
      </div>
    </header>
    <!-- Header End -->

    @section('content')

    @show

    <!-- Footer Section Begin -->
    <footer class="footer-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="footer-left">
              <div class="footer-logo">
                <a href="{{ route('home') }}"><img width="165" height="50" src="{{ asset('config_images/'.$app_config->logo) }}" alt=""></a>
              </div>
              <ul>
                <li>{!! $app_config->address !!}</li>
                <li>Helpline: {{ $app_config->helpline }}</li>
                <li>Whatsapp Support: {{ $app_config->whatsapp_support }}</li>
                <li>Email: {{ $app_config->email }}</li>
                <li>Working Days: {{ $app_config->working_days }}</li>
              </ul>
              <div class="footer-social">
                <a href="{{ $app_config->facebook }}" target="_blank"><i class="fa fa-facebook"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-4 offset-lg-1">
            <div class="newslatter-item">
              <h5>Join Our Newsletter Now</h5>
              <p>Get E-mail updates about our latest shop and special offers.</p>
              <form action="#" class="subscribe-form">
                <input type="text" placeholder="Enter Your Mail">
                <button type="button">Subscribe</button>
              </form>
            </div>
          </div>

          <div class="col-lg-3 offset-lg-1">
            <div class="footer-widget">
              <h5>Information</h5>
              <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Services</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="copyright-reserved">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="copyright-text">

                &copy; {{ $app_config->name }}
                <script>
                  document.write(new Date().getFullYear());
                </script> All rights reserved | Developed by <a href="https://nanovity.net" target="_blank">Nanovity</a>.

              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.dd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    @livewireScripts
  </body>

</html>