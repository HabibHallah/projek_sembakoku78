<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Sembakoku</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    @if(auth()->check())
        <meta name="user-id" content="{{ auth()->id() }}">
        <meta name="user-name" content="{{ auth()->user()->name }}">
        <meta name="user-email" content="{{ auth()->user()->email }}">
        <meta name="user-phone" content="{{ auth()->user()->phone }}">
    @else
        <meta name="user-id" content="">
        <meta name="user-name" content="">
        <meta name="user-email" content="">
        <meta name="user-phone" content="">
    @endif



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  </head>
  <body>
    <!-- Alert Status -->
    @if (session('status'))
      <div id="alert" class="alert alert-success alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert" style="z-index: 1050;">
          {{ session('status') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <script>
          // Menghilangkan alert setelah 3 detik
          setTimeout(() => {
              const alertElement = document.getElementById('alert');
              if (alertElement) {
                  alertElement.classList.remove('show');
                  alertElement.addEventListener('transitionend', () => alertElement.remove());
              }
          }, 3000);
      </script>
    @endif

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <defs>
        <symbol xmlns="http://www.w3.org/2000/svg" id="link" viewBox="0 0 24 24">
          <path fill="currentColor" d="M12 19a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0-4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm-5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm7-12h-1V2a1 1 0 0 0-2 0v1H8V2a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3Zm1 17a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-9h16Zm0-11H4V6a1 1 0 0 1 1-1h1v1a1 1 0 0 0 2 0V5h8v1a1 1 0 0 0 2 0V5h1a1 1 0 0 1 1 1ZM7 15a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0 4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="arrow-right" viewBox="0 0 24 24">
          <path fill="currentColor" d="M17.92 11.62a1 1 0 0 0-.21-.33l-5-5a1 1 0 0 0-1.42 1.42l3.3 3.29H7a1 1 0 0 0 0 2h7.59l-3.3 3.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l5-5a1 1 0 0 0 .21-.33a1 1 0 0 0 0-.76Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="category" viewBox="0 0 24 24">
          <path fill="currentColor" d="M19 5.5h-6.28l-.32-1a3 3 0 0 0-2.84-2H5a3 3 0 0 0-3 3v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-10a3 3 0 0 0-3-3Zm1 13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-13a1 1 0 0 1 1-1h4.56a1 1 0 0 1 .95.68l.54 1.64a1 1 0 0 0 .95.68h7a1 1 0 0 1 1 1Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="calendar" viewBox="0 0 24 24">
          <path fill="currentColor" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3Zm1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="heart" viewBox="0 0 24 24">
          <path fill="currentColor" d="M20.16 4.61A6.27 6.27 0 0 0 12 4a6.27 6.27 0 0 0-8.16 9.48l7.45 7.45a1 1 0 0 0 1.42 0l7.45-7.45a6.27 6.27 0 0 0 0-8.87Zm-1.41 7.46L12 18.81l-6.75-6.74a4.28 4.28 0 0 1 3-7.3a4.25 4.25 0 0 1 3 1.25a1 1 0 0 0 1.42 0a4.27 4.27 0 0 1 6 6.05Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="plus" viewBox="0 0 24 24">
          <path fill="currentColor" d="M19 11h-6V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="minus" viewBox="0 0 24 24">
          <path fill="currentColor" d="M19 11H5a1 1 0 0 0 0 2h14a1 1 0 0 0 0-2Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="cart" viewBox="0 0 24 24">
          <path fill="currentColor" d="M8.5 19a1.5 1.5 0 1 0 1.5 1.5A1.5 1.5 0 0 0 8.5 19ZM19 16H7a1 1 0 0 1 0-2h8.491a3.013 3.013 0 0 0 2.885-2.176l1.585-5.55A1 1 0 0 0 19 5H6.74a3.007 3.007 0 0 0-2.82-2H3a1 1 0 0 0 0 2h.921a1.005 1.005 0 0 1 .962.725l.155.545v.005l1.641 5.742A3 3 0 0 0 7 18h12a1 1 0 0 0 0-2Zm-1.326-9l-1.22 4.274a1.005 1.005 0 0 1-.963.726H8.754l-.255-.892L7.326 7ZM16.5 19a1.5 1.5 0 1 0 1.5 1.5a1.5 1.5 0 0 0-1.5-1.5Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="check" viewBox="0 0 24 24">
          <path fill="currentColor" d="M18.71 7.21a1 1 0 0 0-1.42 0l-7.45 7.46l-3.13-3.14A1 1 0 1 0 5.29 13l3.84 3.84a1 1 0 0 0 1.42 0l8.16-8.16a1 1 0 0 0 0-1.47Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="trash" viewBox="0 0 24 24">
          <path fill="currentColor" d="M10 18a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1ZM20 6h-4V5a3 3 0 0 0-3-3h-2a3 3 0 0 0-3 3v1H4a1 1 0 0 0 0 2h1v11a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8h1a1 1 0 0 0 0-2ZM10 5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1h-4Zm7 14a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8h10Zm-3-1a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="star-outline" viewBox="0 0 15 15">
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M7.5 9.804L5.337 11l.413-2.533L4 6.674l2.418-.37L7.5 4l1.082 2.304l2.418.37l-1.75 1.793L9.663 11L7.5 9.804Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="star-solid" viewBox="0 0 15 15">
          <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="search" viewBox="0 0 24 24">
          <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="user" viewBox="0 0 24 24">
          <path fill="currentColor" d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19ZM12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="close" viewBox="0 0 15 15">
          <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z"/>
        </symbol>
      </defs>
    </svg>

    <div class="preloader-wrapper">
      <div class="preloader">
      </div>
    </div>

    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart" aria-labelledby="MyCart">
      <div class="offcanvas-header justify-content-center">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
          <div class="order-md-last">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                  <span class="text-primary">Keranjang</span>
                  <span class="badge bg-primary rounded-pill" id="cart-count">0</span>
              </h4>
              <ul class="list-group mb-3" id="cart-list">
                  <!-- Barang akan ditambahkan di sini oleh JavaScript -->
              </ul>
              <button class="w-100 btn btn-primary btn-lg" id="checkout-button" type="button">Continue to Checkout</button>
          </div>
      </div>
  </div>


    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasSearch" aria-labelledby="Search">
      <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <div class="order-md-last">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Search</span>
          </h4>
          <form role="search" action="index.html" method="get" class="d-flex mt-3 gap-0">
            <input class="form-control rounded-start rounded-0 bg-light" type="email" placeholder="What are you looking for?" aria-label="What are you looking for?">
            <button class="btn btn-dark rounded-end rounded-0" type="submit">Search</button>
          </form>
        </div>
      </div>
    </div>

    <header>
      <div class="container-fluid">
          <div class="row py-3 border-bottom">
              <div class="col-sm-4 col-lg-3 text-center text-sm-start">
                  <div class="main-logo">
                      <a href="/">
                          <img src="{{ asset('assets/images/logo.png') }}" alt="logo" class="img-fluid">
                      </a>
                  </div>
              </div>

              <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
                  <div class="search-bar row bg-light p-2 my-2 rounded-4">
                      <div class="col-11 col-md-11">
                          <form id="search-form" class="text-center" action="{{ url('/search') }}" method="get">
                              <input type="text" class="form-control border-0 bg-transparent" placeholder="Cari produk di sini..." name="query" value="{{ request('query') }}" />
                          </form>
                      </div>
                      <div class="col-1">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                              <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z" />
                          </svg>
                      </div>
                  </div>
              </div>

              <div class="col-sm-8 col-lg-4 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
                <ul class="d-flex justify-content-end list-unstyled m-0">
                  <li class="d-flex align-items-center">
                      @auth
                          <a href="{{ route('auth-login-basic') }}" class="rounded-circle bg-light p-2 mx-1">
                              <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#user"></use></svg>
                          </a>
                          <span class="ms-2">{{ Auth::user()->name }}</span> <!-- Menampilkan nama pengguna -->

                          <!-- Tombol Logout (Menggunakan button Bootstrap) -->
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                              @csrf
                              <button type="submit" class="btn btn-outline-danger btn-sm ms-2">
                                  <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#logout"></use></svg>
                                  Logout
                              </button>
                          </form>
                      @else
                          <a href="{{ route('auth-login-basic') }}" class="rounded-circle bg-light p-2 mx-1">
                              <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#user"></use></svg>
                          </a>
                      @endauth
                  </li>
                  <li class="d-lg-none">
                      <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                          <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#cart"></use></svg>
                      </a>
                  </li>
                  <li class="d-lg-none">
                      <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch">
                          <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#search"></use></svg>
                      </a>
                  </li>
              </ul>


                  <div class="cart text-end d-none d-lg-block dropdown">
                      <button class="border-0 bg-transparent d-flex flex-column gap-2 lh-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                          <span class="fs-6 text-muted dropdown-toggle">Keranjang</span>
                          <span class="cart-total fs-5 fw-bold">Rp0</span>
                      </button>
                  </div>
              </div>
          </div>
      </div>
      <div class="container-fluid">
          <div class="row py-3">
              <div class="d-flex justify-content-center justify-content-sm-between align-items-center">
                  <nav class="main-menu d-flex navbar navbar-expand-lg">
                      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                          <span class="navbar-toggler-icon"></span>
                      </button>

                      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                          <div class="offcanvas-header justify-content-center">
                              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                          </div>

                          <div class="offcanvas-body">
                              <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
                                  <li class="nav-item dropdown">
                                      <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Pages</a>
                                      <ul class="dropdown-menu" aria-labelledby="pages">
                                          <li><a href="/" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart">Cart </a></li>
                                          <li><a href="#produk" class="dropdown-item">Produk </a></li>
                                      </ul>
                                  </li>
                              </ul>
                          </div>
                      </div>
              </div>
          </div>
      </div>
  </header>


    <section class="py-3" style="background-image: url('assets/images/background-pattern.jpg');background-repeat: no-repeat;background-size: cover;">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="banner-blocks">

              <div class="banner-ad large bg-info block-1">

                <div class="swiper main-swiper">
                  <div class="swiper-wrapper">

                    <div class="swiper-slide">
                      <div class="row banner-content p-5">
                        <div class="content-wrapper col-md-7">
                          <div class="categories my-3">100% alami</div>
                          <h3 class="display-4">Beras Merah Segar & Berkualitas</h3>
                          <p>Beras merah terbaik, kaya akan serat dan nutrisi. Cocok untuk gaya hidup sehat Anda.</p>
                        </div>
                        <div class="img-wrapper col-md-5">
                          <img src="{{ asset('assets/images/product-thumb-1.png') }}" class="img-fluid">
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="row banner-content p-5">
                        <div class="content-wrapper col-md-7">
                          <div class="categories mb-3 pb-3">100% alami</div>
                          <h3 class="banner-title">Gula Merah Asli & Berkualitas</h3>
                          <p>Gula merah murni, ideal untuk aneka masakan dan minuman tradisional. Pilihan terbaik untuk cita rasa alami.</p>
                        </div>
                        <div class="img-wrapper col-md-5">
                          <img src="{{ asset('assets/images/product-thumb-2.png') }}" class="img-fluid">
                        </div>
                      </div>
                    </div>

                    <div class="swiper-slide">
                      <div class="row banner-content p-5">
                        <div class="content-wrapper col-md-7">
                          <div class="categories mb-3 pb-3">100% alami</div>
                          <h3 class="banner-title">Beras Berkualitas Tinggi</h3>
                          <p>Beras pilihan terbaik dengan tekstur pulen dan aroma wangi. Cocok untuk hidangan keluarga sehari-hari.</p>
                        </div>
                        <div class="img-wrapper col-md-5">
                          <img src="{{ asset('assets/images/product-thumb-3.png') }}" class="img-fluid">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="swiper-pagination"></div>

                </div>
              </div>

              <div class="banner-ad bg-success-subtle block-2" style="background:url('assets/images/ad-image-1.png') no-repeat;background-position: right bottom">
                <div class="row banner-content p-5">

                  <div class="content-wrapper col-md-7">
                    <div class="categories sale mb-3 pb-3">20% off</div>
                    <h3 class="banner-title">Fruits & Vegetables</h3>
                  </div>

                </div>
              </div>

              <div class="banner-ad bg-danger block-3" style="background:url('assets/images/ad-image-2.png') no-repeat;background-position: right bottom">
                <div class="row banner-content p-5">

                  <div class="content-wrapper col-md-7">
                    <div class="categories sale mb-3 pb-3">15% off</div>
                    <h3 class="item-title">Baked Products</h3>
                  </div>

                </div>
              </div>

            </div>
            <!-- / Banner Blocks -->

          </div>
        </div>
      </div>
    </section>

    {{-- <section class="py-5 overflow-hidden">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="section-header d-flex flex-wrap justify-content-between mb-5">
              <h2 class="section-title">Kategori</h2>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12">

            <div class="category-carousel swiper">
              <div class="swiper-wrapper">
                <a href="index.html" class="nav-link category-item swiper-slide">
                  <img src="{{ asset('assets/images/icon-vegetables-broccoli.png') }}" alt="Category Thumbnail">
                  <h3 class="category-title">Fruits & Veges</h3>
                </a>
                <a href="index.html" class="nav-link category-item swiper-slide">
                  <img src="{{ asset('assets/images/icon-bread-baguette.png') }}" alt="Category Thumbnail">
                  <h3 class="category-title">Breads & Sweets</h3>
                </a>
                <a href="index.html" class="nav-link category-item swiper-slide">
                  <img src="{{ asset('assets/images/icon-soft-drinks-bottle.png') }}" alt="Category Thumbnail">
                  <h3 class="category-title">Fruits & Veges</h3>
                </a>
                <a href="index.html" class="nav-link category-item swiper-slide">
                  <img src="{{ asset('assets/images/icon-wine-glass-bottle.png') }}" alt="Category Thumbnail">
                  <h3 class="category-title">Fruits & Veges</h3>
                </a>
                <a href="index.html" class="nav-link category-item swiper-slide">
                  <img src="{{ asset('assets/images/icon-animal-products-drumsticks.png') }}" alt="Category Thumbnail">
                  <h3 class="category-title">Fruits & Veges</h3>
                </a>
                <a href="index.html" class="nav-link category-item swiper-slide">
                  <img src="{{ asset('assets/images/icon-bread-herb-flour.png') }}" alt="Category Thumbnail">
                  <h3 class="category-title">Fruits & Veges</h3>
                </a>

              </div>
            </div>

          </div>
        </div>
      </div>
    </section> --}}

    <section class="py-5" id="produk">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12">
                  <div class="bootstrap-tabs product-tabs">
                      <div class="tabs-header d-flex justify-content-between border-bottom my-5">
                          <h2>Produk</h2>
                      </div>
                      <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                          @foreach($barang as $item)
                          <div class="col">
                              <div class="product-item">
                                  @if($item->stok == 0)
                                  <span class="badge bg-danger position-absolute m-3">Habis</span>
                                  @endif
                                  <figure>
                                      <a href="#" title="{{ $item->nama_barang }}">
                                          <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama_barang }}" class="tab-image img-fluid">
                                      </a>
                                  </figure>
                                  <h3>{{ $item->nama_barang }}</h3>
                                  <span class="qty">Stok: {{ $item->stok }}</span>
                                  <span class="price">Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
                                  <div class="d-flex align-items-center justify-content-between">
                                      <div class="input-group product-qty">
                                          <span class="input-group-btn">
                                              <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                                                  <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                                              </button>
                                          </span>
                                          <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                                          <span class="input-group-btn">
                                              <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                                  <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                                              </button>
                                          </span>
                                      </div>
                                      <a href="/cart/add" class="nav-link add-to-cart"
                                        data-id="{{ $item->id }}"
                                        data-name="{{ $item->nama_barang }}"
                                        data-price="{{ $item->harga }}">
                                          Keranjang <iconify-icon icon="uil:shopping-cart"></iconify-icon>
                                      </a>
                                  </div>
                              </div>
                          </div>
                          @endforeach
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>

    <section class="py-5">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-6">
            <div class="banner-ad bg-danger mb-3" style="background: url('assets/images/ad-image-3.png');background-repeat: no-repeat;background-position: right bottom;">
              <div class="banner-content p-5">

                <div class="categories text-primary fs-3 fw-bold">Penawaran Spesial</div>
                <h3 class="banner-title">Kecap Bango</h3>
                <p>Cita rasa autentik untuk hidangan Anda!</p>
              </div>

            </div>
          </div>
          <div class="col-md-6">
            <div class="banner-ad bg-info" style="background: url('assets/images/ad-image-4.png');background-repeat: no-repeat;background-position: right bottom;">
              <div class="banner-content p-5">

                <div class="categories text-primary fs-3 fw-bold">Penawaran Spesial</div>
                <h3 class="banner-title">Minyak Bimoli</h3>
                <p>Pilihan terbaik untuk masakan lezat Anda!</p>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

    <section class="py-5">
      <div class="container-fluid">
        <div class="row row-cols-1 row-cols-sm-3 row-cols-lg-5">
          <div class="col">
            <div class="card mb-3 border-0">
              <div class="row">
                <div class="col-md-2 text-dark">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M21.5 15a3 3 0 0 0-1.9-2.78l1.87-7a1 1 0 0 0-.18-.87A1 1 0 0 0 20.5 4H6.8l-.33-1.26A1 1 0 0 0 5.5 2h-2v2h1.23l2.48 9.26a1 1 0 0 0 1 .74H18.5a1 1 0 0 1 0 2h-13a1 1 0 0 0 0 2h1.18a3 3 0 1 0 5.64 0h2.36a3 3 0 1 0 5.82 1a2.94 2.94 0 0 0-.4-1.47A3 3 0 0 0 21.5 15Zm-3.91-3H9L7.34 6H19.2ZM9.5 20a1 1 0 1 1 1-1a1 1 0 0 1-1 1Zm8 0a1 1 0 1 1 1-1a1 1 0 0 1-1 1Z"/></svg>
                </div>
                <div class="col-md-10">
                  <div class="card-body p-0">
                    <h5>Penawaran Spesial</h5>
                    <p class="card-text">Nikmati keuntungan belanja tanpa biaya tambahan.</p>
                  </div>
                </div>
              </div>
              </div>
          </div>
          <div class="col">
            <div class="card mb-3 border-0">
              <div class="row">
                <div class="col-md-2 text-dark">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M19.63 3.65a1 1 0 0 0-.84-.2a8 8 0 0 1-6.22-1.27a1 1 0 0 0-1.14 0a8 8 0 0 1-6.22 1.27a1 1 0 0 0-.84.2a1 1 0 0 0-.37.78v7.45a9 9 0 0 0 3.77 7.33l3.65 2.6a1 1 0 0 0 1.16 0l3.65-2.6A9 9 0 0 0 20 11.88V4.43a1 1 0 0 0-.37-.78ZM18 11.88a7 7 0 0 1-2.93 5.7L12 19.77l-3.07-2.19A7 7 0 0 1 6 11.88v-6.3a10 10 0 0 0 6-1.39a10 10 0 0 0 6 1.39Zm-4.46-2.29l-2.69 2.7l-.89-.9a1 1 0 0 0-1.42 1.42l1.6 1.6a1 1 0 0 0 1.42 0L15 11a1 1 0 0 0-1.42-1.42Z"/></svg>
                </div>
                <div class="col-md-10">
                  <div class="card-body p-0">
                    <h5>100% Pembayaran Aman</h5>
                    <p class="card-text">Transaksi Anda dijamin aman dan terpercaya.</p>
                  </div>
                </div>
              </div>
              </div>
          </div>
          <div class="col">
            <div class="card mb-3 border-0">
              <div class="row">
                <div class="col-md-2 text-dark">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M22 5H2a1 1 0 0 0-1 1v4a3 3 0 0 0 2 2.82V22a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-9.18A3 3 0 0 0 23 10V6a1 1 0 0 0-1-1Zm-7 2h2v3a1 1 0 0 1-2 0Zm-4 0h2v3a1 1 0 0 1-2 0ZM7 7h2v3a1 1 0 0 1-2 0Zm-3 4a1 1 0 0 1-1-1V7h2v3a1 1 0 0 1-1 1Zm10 10h-4v-2a2 2 0 0 1 4 0Zm5 0h-3v-2a4 4 0 0 0-8 0v2H5v-8.18a3.17 3.17 0 0 0 1-.6a3 3 0 0 0 4 0a3 3 0 0 0 4 0a3 3 0 0 0 4 0a3.17 3.17 0 0 0 1 .6Zm2-11a1 1 0 0 1-2 0V7h2ZM4.3 3H20a1 1 0 0 0 0-2H4.3a1 1 0 0 0 0 2Z"/></svg>
                </div>
                <div class="col-md-10">
                  <div class="card-body p-0">
                    <h5>Jaminan Kualitas</h5>
                    <p class="card-text">Produk terbaik dengan kualitas terjamin.</p>
                  </div>
                </div>
              </div>
              </div>
          </div>
          <div class="col">
            <div class="card mb-3 border-0">
              <div class="row">
                <div class="col-md-2 text-dark">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M12 8.35a3.07 3.07 0 0 0-3.54.53a3 3 0 0 0 0 4.24L11.29 16a1 1 0 0 0 1.42 0l2.83-2.83a3 3 0 0 0 0-4.24A3.07 3.07 0 0 0 12 8.35Zm2.12 3.36L12 13.83l-2.12-2.12a1 1 0 0 1 0-1.42a1 1 0 0 1 1.41 0a1 1 0 0 0 1.42 0a1 1 0 0 1 1.41 0a1 1 0 0 1 0 1.42ZM12 2A10 10 0 0 0 2 12a9.89 9.89 0 0 0 2.26 6.33l-2 2a1 1 0 0 0-.21 1.09A1 1 0 0 0 3 22h9a10 10 0 0 0 0-20Zm0 18H5.41l.93-.93a1 1 0 0 0 0-1.41A8 8 0 1 1 12 20Z"/></svg>
                </div>
                <div class="col-md-10">
                  <div class="card-body p-0">
                    <h5>Dijamin Hemat</h5>
                    <p class="card-text">Belanja hemat dengan penawaran terbaik.</p>
                  </div>
                </div>
              </div>
              </div>
          </div>
          <div class="col">
            <div class="card mb-3 border-0">
              <div class="row">
                <div class="col-md-2 text-dark">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="currentColor" d="M18 7h-.35A3.45 3.45 0 0 0 18 5.5a3.49 3.49 0 0 0-6-2.44A3.49 3.49 0 0 0 6 5.5A3.45 3.45 0 0 0 6.35 7H6a3 3 0 0 0-3 3v2a1 1 0 0 0 1 1h1v6a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3v-6h1a1 1 0 0 0 1-1v-2a3 3 0 0 0-3-3Zm-7 13H8a1 1 0 0 1-1-1v-6h4Zm0-9H5v-1a1 1 0 0 1 1-1h5Zm0-4H9.5A1.5 1.5 0 1 1 11 5.5Zm2-1.5A1.5 1.5 0 1 1 14.5 7H13ZM17 19a1 1 0 0 1-1 1h-3v-7h4Zm2-8h-6V9h5a1 1 0 0 1 1 1Z"/></svg>
                </div>
                <div class="col-md-10">
                  <div class="card-body p-0">
                    <h5>Penawaran Harian</h5>
                    <p class="card-text">Nikmati promo menarik setiap hari.</p>
                  </div>
                </div>
              </div>
              </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="py-5">
      <div class="container-fluid">
        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer-menu">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
                    <div class="social-links mt-5">
                        <ul class="d-flex list-unstyled gap-2">
                            <li>
                                <a href="#" class="btn btn-outline-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M15.12 5.32H17V2.14A26.11 26.11 0 0 0 14.26 2c-2.72 0-4.58 1.66-4.58 4.7v2.62H6.61v3.56h3.07V22h3.68v-9.12h3.06l.46-3.56h-3.52V7.05c0-1.05.28-1.73 1.76-1.73Z"/></svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-outline-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M22.991 3.95a1 1 0 0 0-1.51-.86a7.48 7.48 0 0 1-1.874.794a5.152 5.152 0 0 0-3.374-1.242a5.232 5.232 0 0 0-5.223 5.063a11.032 11.032 0 0 1-6.814-3.924a1.012 1.012 0 0 0-.857-.365a.999.999 0 0 0-.785.5a5.276 5.276 0 0 0-.242 4.769l-.002.001a1.041 1.041 0 0 0-.496.89a3.042 3.042 0 0 0 .027.439a5.185 5.185 0 0 0 1.568 3.312a.998.998 0 0 0-.066.77a5.204 5.204 0 0 0 2.362 2.922a7.465 7.465 0 0 1-3.59.448A1 1 0 0 0 1.45 19.3a12.942 12.942 0 0 0 7.01 2.061a12.788 12.788 0 0 0 12.465-9.363a12.822 12.822 0 0 0 .535-3.646l-.001-.2a5.77 5.77 0 0 0 1.532-4.202Zm-3.306 3.212a.995.995 0 0 0-.234.702c.01.165.009.331.009.488a10.824 10.824 0 0 1-.454 3.08a10.685 10.685 0 0 1-10.546 7.93a10.938 10.938 0 0 1-2.55-.301a9.48 9.48 0 0 0 2.942-1.564a1 1 0 0 0-.602-1.786a3.208 3.208 0 0 1-2.214-.935q.224-.042.445-.105a1 1 0 0 0-.08-1.943a3.198 3.198 0 0 1-2.25-1.726a5.3 5.3 0 0 0 .545.046a1.02 1.02 0 0 0 .984-.696a1 1 0 0 0-.4-1.137a3.196 3.196 0 0 1-1.425-2.673c0-.066.002-.133.006-.198a13.014 13.014 0 0 0 8.21 3.48a1.02 1.02 0 0 0 .817-.36a1 1 0 0 0 .206-.867a3.157 3.157 0 0 1-.087-.729a3.23 3.23 0 0 1 3.226-3.226a3.184 3.184 0 0 1 2.345 1.02a.993.993 0 0 0 .921.298a9.27 9.27 0 0 0 1.212-.322a6.681 6.681 0 0 1-1.026 1.524Z"/></svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-outline-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M23 9.71a8.5 8.5 0 0 0-.91-4.13a2.92 2.92 0 0 0-1.72-1A78.36 78.36 0 0 0 12 4.27a78.45 78.45 0 0 0-8.34.3a2.87 2.87 0 0 0-1.46.74c-.9.83-1 2.25-1.1 3.45a48.29 48.29 0 0 0 0 6.48a9.55 9.55 0 0 0 .3 2a3.14 3.14 0 0 0 .71 1.36a2.86 2.86 0 0 0 1.49.78a45.18 45.18 0 0 0 6.5.33c3.5.05 6.57 0 10.2-.28a2.88 2.88 0 0 0 1.53-.78a2.49 2.49 0 0 0 .61-1a10.58 10.58 0 0 0 .52-3.4c.04-.56.04-3.94.04-4.54ZM9.74 14.85V8.66l5.92 3.11c-1.66.92-3.85 1.96-5.92 3.08Z"/></svg>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn btn-outline-light">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="currentColor" d="M17.34 5.46a1.2 1.2 0 1 0 1.2 1.2a1.2 1.2 0 0 0-1.2-1.2Zm4.6 2.42a7.59 7.59 0 0 0-.46-2.43a4.94 4.94 0 0 0-1.16-1.77a4.7 4.7 0 0 0-1.77-1.15a7.3 7.3 0 0 0-2.43-.47C15.06 2 14.72 2 12 2s-3.06 0-4.12.06a7.3 7.3 0 0 0-2.43.47a4.78 4.78 0 0 0-1.77 1.15a4.7 4.7 0 0 0-1.15 1.77a7.3 7.3 0 0 0-.47 2.43C2 8.94 2 9.28 2 12s0 3.06.06 4.12a7.29 7.29 0 0 0 .47 2.43a4.7 4.7 0 0 0 1.15 1.77a4.78 4.78 0 0 0 1.77 1.15a7.29 7.29 0 0 0 2.43.47c1.07 0 1.7-.04 2.4-.12a6.77 6.77 0 0 0 5.85 5.85c.69.08 1.32.12 2.4.12s1.7-.04 2.43-.47a4.7 4.7 0 0 0 1.77-1.15a4.7 4.7 0 0 0 1.15-1.77a7.29 7.29 0 0 0 .47-2.43c.06-.12.06-.25.06-.37s0-.24-.06-.37Z"/><path fill="currentColor" d="M12 16.62a4.62 4.62 0 1 0 4.62-4.62a4.62 4.62 0 0 0-4.62 4.62Zm0 7.69c1.4 0 2.72-.54 3.69-1.47c.97-.93 1.5-2.22 1.5-3.55s-.53-2.62-1.5-3.55c-.97-.93-2.3-1.47-3.69-1.47s-2.72.54-3.69 1.47c-.97.93-1.5 2.22-1.5 3.55s.53 2.62 1.5 3.55c.97.93 2.3 1.47 3.69 1.47Z"/></svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="map-container" style="position:relative; overflow:hidden; padding-bottom:50%; height:0; border:1px solid #ddd; border-radius:8px;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.836946496281!2d-122.47825518468143!3d37.81992967975195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80858142f08e7db7%3A0xddd69a1e2b8c745f!2sGolden%20Gate%20Bridge!5e0!3m2!1sen!2sus!4v1617316789998!5m2!1sen!2sus"
                        width="100%"
                        height="100%"
                        style="border:0; position:absolute; top:0; left:0; border-radius:8px;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>


        </div>
      </div>
    </footer>
    <div id="footer-bottom">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 copyright">
            <p>© 2023 Foodmart. All rights reserved.</p>
          </div>
          <div class="col-md-6 credit-link text-start text-md-end">
            <p>Free HTML Template by <a href="https://templatesjungle.com/">TemplatesJungle</a> Distributed by <a href="https://themewagon">ThemeWagon</a></p>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}" ></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
    // Function to update the cart display
    function updateCartView(cart) {
        const cartList = document.querySelector('#cart-list');
        const cartCount = document.querySelector('#cart-count');
        const cartTotal = document.querySelector('.cart-total'); // Elemen total harga keranjang pada halaman utama
        cartList.innerHTML = ''; // Clear the cart list
        let total = 0;

        Object.entries(cart).forEach(([id, item]) => {
            total += item.totalPrice; // Update with totalPrice

            cartList.innerHTML += `
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <div>
                        <h6 class="my-0">${item.name}</h6>
                        <small class="text-body-secondary">Qty: ${item.quantity}</small>
                    </div>
                    <span class="text-body-secondary">Rp${item.totalPrice.toLocaleString()}</span>
                    <button class="btn btn-danger btn-sm" onclick="removeFromCart(${id})">Remove</button>
                </li>
            `;
        });

        // Update the cart item count
        cartCount.innerHTML = Object.keys(cart).length;

        // Add the total price to the cart list
        const totalItem = document.createElement('li');
        totalItem.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'lh-sm');
        totalItem.innerHTML = `
            <span class="text-body-secondary">Total</span>
            <strong>Rp${total.toLocaleString()}</strong>
        `;
        cartList.appendChild(totalItem);

        // Update the cart total on the main page
        if (cartTotal) {
            cartTotal.innerHTML = `Rp${total.toLocaleString()}`;
        }
    }

    // Event listener for "Add to Cart" button
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            // Get product data from data-* attributes
            const id = this.dataset.id;
            const name = this.dataset.name;
            const price = parseFloat(this.dataset.price); // Ensure price is a number

            // Get the quantity selected by the user
            const quantity = parseInt(this.closest('.product-item').querySelector('input[name="quantity"]').value);

            console.log("Adding to cart: ", id, name, price, quantity);

            // Calculate the total price for the quantity selected
            const totalPrice = price * quantity;

            // Get the cart from localStorage
            let cart = JSON.parse(localStorage.getItem('cart')) || {};

            // Update cart with new item or update quantity
            if (cart[id]) {
                cart[id].quantity += quantity;
                cart[id].totalPrice = cart[id].price * cart[id].quantity;
            } else {
                cart[id] = {
                    id, name, price, quantity, totalPrice
                };
            }

            // Save updated cart to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Update the cart display
            updateCartView(cart);
        });
    });

    // Fetch the cart data from localStorage when the page is loaded
    const cartData = JSON.parse(localStorage.getItem('cart')) || {};
    updateCartView(cartData);

    // Function to remove item from the cart
    window.removeFromCart = function(id) {
        let cart = JSON.parse(localStorage.getItem('cart')) || {};

        // Remove item from the cart
        delete cart[id];

        // Save the updated cart to localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Update the cart display
        updateCartView(cart);
    };

    // Fetch the cart data when the cart modal is opened
    document.getElementById('offcanvasCart').addEventListener('show.bs.offcanvas', function () {
        const cartData = JSON.parse(localStorage.getItem('cart')) || {};
        updateCartView(cartData);
    });
});

      </script>

      <script>
        document.getElementById('checkout-button').addEventListener('click', function () {
            // Ambil data keranjang dari localStorage
            const cartItems = JSON.parse(localStorage.getItem('cart')) || {};

            if (Object.keys(cartItems).length === 0) {
                alert('Keranjang Anda kosong. Silakan tambahkan barang ke keranjang terlebih dahulu.');
                return;
            }

            // Lanjutkan dengan mengirimkan data keranjang untuk membuat transaksi
            fetch('/payment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    cart_data: cartItems,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.snap_token) {
                    // Panggil snap untuk memproses pembayaran di Midtrans
                    snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            // Setelah pembayaran berhasil, kirim data pesanan ke server
                            alert('Pembayaran berhasil!');

                            const cartItems = JSON.parse(localStorage.getItem('cart')) || {};
                            const userId = document.querySelector('meta[name="user-id"]').content;
                            const userName = document.querySelector('meta[name="user-name"]').content;

                            // Mengirim data pesanan ke server
                            fetch('/store-pesanan', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                },
                                body: JSON.stringify({
                                    user_id: userId,
                                    user_name: userName,
                                    cart_data: cartItems,
                                    transaction_id: result.transaction_id, // ID transaksi Midtrans
                                    payment_status: result.transaction_status, // Status pembayaran
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Tindakan jika data berhasil disimpan ke database
                                localStorage.removeItem('cart'); // Hapus keranjang setelah berhasil checkout

                                // Arahkan pengguna ke halaman utama setelah berhasil
                                window.location.href = '/';  // Arahkan ke halaman utama (landing page)
                            })
                            .catch(error => {
                                console.error('Error storing pesanan:', error);
                                alert('Gagal menyimpan pesanan.');
                            });
                        },
                        onPending: function(result) {
                            alert('Pembayaran masih dalam proses.');
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal.');
                        }
                    });
                } else {
                    alert('Gagal membuat transaksi');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
  </body>
</html>
