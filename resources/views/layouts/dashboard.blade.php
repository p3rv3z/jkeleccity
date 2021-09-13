<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $appConfig->name ?? 'Inventory Management' }} | @yield('title', 'Dashboard')</title>

  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}" />
  <link rel="stylesheet" href="{{asset('adminlte/plugins/summernote/summernote-bs4.min.css')}}" />

  {{-- Data table style start --}}
  <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css" rel="stylesheet" />
  {{-- Data table style end --}}

  {{-- Dropify style cdn start--}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog==" crossorigin="anonymous" />
  {{-- Dropify style cdn end--}}

  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>
  @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed" style="background: #f4f6f9">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="ml-auto navbar-nav">
        <!-- Messages Dropdown Menu -->
        {{-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{ asset('adminlte/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="mr-3 img-size-50 img-circle" />
        <div class="media-body">
          <h3 class="dropdown-item-title">
            Brad Diesel
            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
          </h3>
          <p class="text-sm">Call me whenever you can...</p>
          <p class="text-sm text-muted"><i class="mr-1 far fa-clock"></i> 4 Hours Ago</p>
        </div>
  </div>
  <!-- Message End -->
  </a>
  <div class="dropdown-divider"></div>
  <a href="#" class="dropdown-item">
    <!-- Message Start -->
    <div class="media">
      <img src="{{ asset('adminlte/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="mr-3 img-size-50 img-circle" />
      <div class="media-body">
        <h3 class="dropdown-item-title">
          John Pierce
          <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
        </h3>
        <p class="text-sm">I got your message bro</p>
        <p class="text-sm text-muted"><i class="mr-1 far fa-clock"></i> 4 Hours Ago</p>
      </div>
    </div>
    <!-- Message End -->
  </a>
  <div class="dropdown-divider"></div>
  <a href="#" class="dropdown-item">
    <!-- Message Start -->
    <div class="media">
      <img src="{{ asset('adminlte/dist/img/user3-128x128.jpg')}}" alt="User Avatar" class="mr-3 img-size-50 img-circle" />
      <div class="media-body">
        <h3 class="dropdown-item-title">
          Nora Silvester
          <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
        </h3>
        <p class="text-sm">The subject goes here</p>
        <p class="text-sm text-muted"><i class="mr-1 far fa-clock"></i> 4 Hours Ago</p>
      </div>
    </div>
    <!-- Message End -->
  </a>
  <div class="dropdown-divider"></div>
  <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
  </div>
  </li> --}}
  <!-- Notifications Dropdown Menu -->
  <li class="nav-item">
    {{-- <a class="py-1 nav-link" href="/user/profile">
      <img class="img-circle h-100" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
    </a> --}}
    <a class="btn btn-info btn-sm mt-1" href="{{ route('home') }}" target="_blank">Visit Website</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
      <i class="fas fa-ellipsis-v"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
      @can('appConfig')
      <a href="{{ route('appConfig') }}" class="dropdown-item">
        {{ __('App Configuration') }}
      </a>
      <div class="dropdown-divider"></div>
      @endcan
      <form method="POST" action="{{ route('logout') }}">
        @csrf

        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">
          {{ __('Logout') }}
        </a>
      </form>
    </div>
  </li>

  {{-- <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li> --}}
  </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="text-center brand-link">
      <span class="text-center brand-text font-weight-light">{{ $appConfig->name ?? 'Inventory MGT' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : null }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard{{-- <span class="right badge badge-danger">New</span> --}}</p>
            </a>
          </li>
          @canany(['category.create', 'category.edit', 'category.index', 'category.delete'])
          <li class="nav-item">
            <a href="{{ route('category.index') }}" class="nav-link {{ request()->is('dashboard/category*') ? 'active' : null }}">
              <i class="nav-icon fas fa-stamp"></i>
              <p>
                Category
              </p>
            </a>
          </li>
          @endcanany
          @canany(['product_type.create', 'product_type.edit', 'product_type.index', 'product_type.delete'])
          <li class="nav-item">
            <a href="{{ route('product_type.index') }}" class="nav-link {{ request()->is('dashboard/product_type*') ? 'active' : null }}">
              <i class="nav-icon fas fa-stamp"></i>
              <p>
                Product Type
              </p>
            </a>
          </li>
          @endcanany
          @canany(['brand.create', 'brand.edit', 'brand.index', 'brand.delete'])
          <li class="nav-item">
            <a href="{{ route('brand.index') }}" class="nav-link {{ request()->is('dashboard/brand*') ? 'active' : null }}">
              <i class="nav-icon fas fa-stamp"></i>
              <p>
                Brand
              </p>
            </a>
          </li>
          @endcanany
          @canany(['product.show', 'product.create', 'product.edit', 'product.index', 'product.delete'])
          <li class="nav-item">
            <a href="{{ route('product.index') }}" class="nav-link {{ !request()->is('dashboard/product_type*') && request()->is('dashboard/product*') ? 'active' : null }}">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                Product
              </p>
            </a>
          </li>
          @endcanany
          @canany(['purchase.show', 'purchase.create', 'purchase.edit', 'purchase.index', 'purchase.delete'])
          <li class="nav-item">
            <a href="{{ route('purchase.index') }}" class="nav-link {{ request()->is('dashboard/purchase*') && !request()->is('dashboard/purchase_return*') ? 'active' : null }}">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Purchase
              </p>
            </a>
          </li>
          @endcanany
          @canany(['purchase_return.index', 'purchase_return.create', 'purchase_return.show', 'purchase_return.edit', 'purchase_return.delete'])
          <li class="nav-item">
            <a href="{{ route('purchase_return.index') }}" class="nav-link {{ request()->is('dashboard/purchase_return*') ? 'active' : null }}">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                Purchase Return
              </p>
            </a>
          </li>
          @endcanany
          @canany(['sale.index', 'sale.create', 'sale.show', 'sale.edit', 'sale.delete'])
          <li class="nav-item">
            <a href="{{ route('sale.index') }}" class="nav-link {{ request()->is('dashboard/sale*') && !request()->is('dashboard/sale_return*') ? 'active' : null }}">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                Sale
              </p>
            </a>
          </li>
          @endcanany
          @canany(['sale_return.index', 'sale_return.create', 'sale_return.show', 'sale_return.edit', 'sale_return.delete'])
          <li class="nav-item">
            <a href="{{ route('sale_return.index') }}" class="nav-link {{ request()->is('dashboard/sale_return*') ? 'active' : null }}">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                Sale Return
              </p>
            </a>
          </li>
          @endcanany
          @canany(['expense.create', 'expense.index', 'expense.edit', 'expense.delete', 'expense_category.index', 'expense_category.create', 'expense_category.edit', 'expense_category.delete'])
          <li class="nav-item {{ request()->is('dashboard/expense*') ? 'menu-open' : null }}">
            <a href="#" class="nav-link {{ request()->is('dashboard/expense*') ? 'active' : null }}">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Expense
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="pl-2 nav nav-treeview">
              @can('expense_category.index')
              <li class="nav-item">
                <a href="{{ route('expense_category.index') }}" class="nav-link {{ request()->is('dashboard/expense_category*') ? 'active' : null }}">
                  <i class="fas fa-stream nav-icon"></i>
                  <p>Expense Categories</p>
                </a>
              </li>
              @endcan
              @can('expense.index')
              <li class="nav-item">
                <a href="{{ route('expense.index') }}" class="nav-link {{ (request()->is('dashboard/expense') || request()->is('dashboard/expense/*')) ? 'active' : null }}">
                  <i class="nav-icon fas fa-money-bill-wave"></i>
                  <p>
                    All Expense
                  </p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcanany
          @canany(['report.purchase', 'report.sale', 'report.stock', 'report.expense', 'report.transaction'])
          <li class="nav-item {{ request()->is('dashboard/report*') ? 'menu-open' : null }}">
            <a href="#" class="nav-link {{ request()->is('dashboard/report*') ? 'active' : null }}">
              <i class="nav-icon fas fa-file-contract"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="pl-2 nav nav-treeview">
              @can('report.purchase')
              <li class="nav-item">
                <a href="{{ route('report.purchase') }}" class="nav-link {{ request()->is('dashboard/report/purchase') ? 'active' : null }}">
                  <i class="fas fa-truck nav-icon"></i>
                  <p>Purchase Report</p>
                </a>
              </li>
              @endcan
              @can('report.sale')
              <li class="nav-item">
                <a href="{{ route('report.sale') }}" class="nav-link {{ request()->is('dashboard/report/sale') ? 'active' : null }}">
                  <i class="fas fa-hand-holding-usd nav-icon"></i>
                  <p>Sale Report</p>
                </a>
              </li>
              @endcan
              @can('report.stock')
              <li class="nav-item">
                <a href="{{ route('report.stock') }}" class="nav-link {{ request()->is('dashboard/report/stock') ? 'active' : null }}">
                  <i class="fas fa-cubes nav-icon"></i>
                  <p>Stock Report</p>
                </a>
              </li>
              @endcan
              @can('report.expense')
              <li class="nav-item">
                <a href="{{ route('report.expense') }}" class="nav-link {{ request()->is('dashboard/report/expense') ? 'active' : null }}">
                  <i class="fas fa-money-bill-wave nav-icon"></i>
                  <p>Expense Report</p>
                </a>
              </li>
              @endcan
              @can('report.transaction')
              {{-- <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="fas fa-funnel-dollar nav-icon"></i>
                  <p>Transaction Report</p>
                </a>
              </li> --}}
              @endcan
            </ul>
          </li>
          @endcanany
          @canany(['user.create', 'user.edit', 'user.index', 'user.delete'])
          <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('dashboard/user*') ? 'active' : null }}">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                User Management
              </p>
            </a>
          </li>
          @endcanany
          @canany(['user.create', 'user.edit', 'user.index', 'user.delete'])
          <li class="nav-item">
            <a href="{{ route('role.index') }}" class="nav-link {{ request()->is('dashboard/role*') ? 'active' : null }}">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Role
              </p>
            </a>
          </li>
          @endcanany
          @canany(['user.create', 'user.edit', 'user.index', 'user.delete'])
          <li class="nav-item">
            <a href="{{ route('permission.index') }}" class="nav-link {{ request()->is('dashboard/permission*') ? 'active' : null }}">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Permission
              </p>
            </a>
          </li>
          @endcanany
          @canany(['banner_image.create', 'banner_image.edit', 'banner_image.index', 'banner_image.delete'])
          <li class="nav-item">
            <a href="{{ route('banner_image.index') }}" class="nav-link {{ request()->is('dashboard/banner_image*') ? 'active' : null }}">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Banner Image
              </p>
            </a>
          </li>
          @endcanany
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    {{ $slot ?? null }} {{-- only for profile route --}}
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="d-flex justify-content-between">
            <span>&copy; 2020 <a href="#">Inventory.com</a> All rights reserved.</span>
            <span>Version 1.0</span>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  @stack('modals')

  @include('layouts.components.alert')
  @include('layouts.components.delete-modal')

  {{-- scripts --}}
  <script src="{{ asset('js/dashboard.js')}}"></script>

  @livewireScripts

  {{-- Datatable js --}}
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.colVis.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.5.0/jszip.min.js"></script>
  <script src="{{asset('adminlte/plugins/summernote/summernote-bs4.min.js')}}"></script>

  {{-- Dropify script cdn start --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous"></script>
  {{-- Dropify script cdn end --}}

  <script>
    $(function() {
      let dtButtonClasses = 'btn-default btn-sm';
      $.extend(true, $.fn.dataTable.defaults, {
        responsive: true,
        lengthMenu: [
          [-1, 10, 25, 50, 100],
          ["All", 10, 25, 50, 100]
        ],
        pageLength: 10,
        order: [
          [0, "asc"],
        ],
        dom: '<"row justify-content-between"lBf>rt<"row justify-content-between"ip>',
        buttons: {
          buttons: [{
              extend: 'print',
              className: dtButtonClasses,
              text: 'Print',
              footer: true
            },
            {
              extend: 'pdf',
              className: dtButtonClasses,
              text: 'PDF',
              footer: true
            },
            {
              extend: 'excel',
              className: dtButtonClasses,
              text: 'Excel',
              footer: true
            },
            {
              extend: 'csv',
              className: dtButtonClasses,
              text: 'CSV',
              footer: true
            },
            {
              extend: 'copy',
              className: dtButtonClasses,
              text: 'Copy',
              footer: true
            },
          ],
          dom: {
            button: {
              className: 'btn'
            }
          }
        },
        drawCallback: function() {
          $('table').addClass("table-sm table-hover table-striped text-nowrap");
          $('#DataTables_Table_0_paginate ul.pagination').addClass("pagination-sm");
        }
      });

      // event from livewire
      document.addEventListener('addedFromAnywhere', () => {
        $('.modal').modal('hide');
        $(".alert")
          .delay(2000)
          .fadeOut();
      });

      // Global Delete Modal
      let openModals = document.querySelectorAll("[data-delete-action]");
      openModals.forEach(openModal => {
        openModal.addEventListener("click", function(e) {
          $("#delete-modal").modal('show');
          document.querySelector("#modal-delete-form").setAttribute("action", openModal.getAttribute("data-delete-action"));
        });
      });

      //select2 all customization
      $('.select-all').click(function() {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', 'selected')
        $select2.trigger('change')
      })
      $('.deselect-all').click(function() {
        let $select2 = $(this).parent().siblings('.select2')
        $select2.find('option').prop('selected', '')
        $select2.trigger('change')
      })

      $('.select2').select2({
        placeholder: 'Select option',
      });

      $('.select2-withoutSearch').select2({
        placeholder: 'Select option',
        minimumResultsForSearch: Infinity
      });

      $('.select2-withTags').select2({
        placeholder: 'Select option',
        tags: "true",
      });


      // Select2 with livewire
      /* $('.select2').on('change', function (e) {
          let livewire = $(this).data('livewire')
          eval(livewire).set('fieldProduct', $(this).val());
        }); */
    });
  </script>

  @stack('scripts')
</body>

</html>