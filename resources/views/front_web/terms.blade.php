<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="author" content="Grayrids">
        <title>ZFix</title>
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('frontweb/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontweb/css/line-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('frontweb/css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('frontweb/css/owl.theme.css') }}">
        <link rel="stylesheet" href="{{ asset('frontweb/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('frontweb/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('frontweb/css/nivo-lightbox.css') }}">
        <link rel="stylesheet" href="{{ asset('frontweb/css/main.css') }}">    
        <link rel="stylesheet" href="{{ asset('frontweb/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('frontweb/css/zf.css') }}">

        <link rel="shortcut icon" href="{{ asset('media/logos/favicon.ico') }}" />
    
      </head>
</head>
<body>
    <!-- Header Section Start -->
    <header id="home" class="hero-area-2">    
        <div class="overlay"></div>
        <nav class="navbar navbar-expand-md fixed-top scrolling-navbar" style=" background-image: -moz-linear-gradient(0deg, #3c96ff 0%, #2dfbff 100%);
        background-image: -webkit-linear-gradient(0deg, #3c96ff 0%, #2dfbff 100%);
        background-image: -ms-linear-gradient(0deg, #3c96ff 0%, #2dfbff 100%);">
          <div class="container">
            <a href="/" class="navbar-brand"><img src="{{ asset('frontweb/img/zfix_logo.png')}}" alt=""></a>  
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <i class="lni-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
              <ul class="navbar-nav mr-auto w-100 justify-content-end">
                <li class="nav-item">
                  <a class="nav-link page-scroll" href="/">Home</a>
                </li>
              </ul>
            </div>
          </div>
        </nav> 
      </header>
      <!-- Header Section End --> 

            <div class="container-claim">
              <div class="row justify-content-center">
                    <h2>
                        Terms & Condition
                    </h2>
              </div>
              <div class="justify">
                <p>
                  1.  Smartphone dan tablet adalah benar milik pribadi bukan merupakan hasil kejahatan (pencurian/perampokan/penadahan) ataupun kepemilikan lainnya secara illegal.
                </p>
                <br>
                <p>
                  2.	Smartphone dan tablet dengan kondisi layar dan LCD yang sempurna (Tidak pecah dan berfungsi baik).
                </p>
                <br>
                <p>
                  3.  Tidak ada pengembalian uang jika layar dan LCD smartphone dan tablet dalam kondisi tidak sempurna atau kegagalan pada saat melakukan verifikasi (test layar atau foto).
                </p>
                <br>
                <p>
                  4.	ZFix tidak melindungi kerusakan lain, selain pada bagian layar/LCD.
                </p>
                <br>
                <p>
                  5.	ZFix tidak melindungi kerusakan layar yang dilakukan secara sengaja.
                </p>
                <br>
                <p>
                  6.	ZFix berhak menolak pengajuan perbaikan jika terjadi penipuan atau upaya kecurangan apapun.
                </p>
                <br>
                <p>
                  7.	ZFix berhak membatalkan pengajuan perbaikan jika pemohon tidak mengungkapkan atau menyembunyikan fakta terkait kronologi kerusakan.
                </p>
                <p>
                  8.  Untuk informasi lebih lanjut kamu dapat mengunduh syarat dan ketentuan di www.zfix.id
                </p>
              </div>
            </div>
      </div>

      <!-- Footer Section Start -->
    <footer>
      <!-- Footer Area Start -->
      <section class="footer-Content">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <img src="{{ asset('frontweb/img/zfix_logo.png') }}" alt="" style="margin-bottom: 10px;">
              <div class="textwidget">
                <p>ZFix Membership adalah sebuah layanan keanggotaan yang akan memberikan perlindungan layar untuk gadget kamu. Layanan ini dapat digunakan untuk semua jenis dan tipe gadget.</p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <div class="widget">
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
              <div class="widget">
                <h3 class="block-title">Support</h3>
                <ul class="menu">
                  <li><a href="{{ route('frontweb.terms') }}">Terms & Condition</a></li>
                  <li><a href="{{ route('frontweb.privacy') }}">Kebijakan Privasi</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- Copyright Start  -->
        <div class="copyright">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="site-info float-left">
                  <p>&copy; 2021</p>
                </div>              
                <div class="float-right">  
                </div>
              </div>
            </div>
          </div>
      <!-- Copyright End -->
      </section>
      <!-- Footer area End -->
      
    </footer>
    <!-- Footer Section End --> 
    <!-- Go To Top Link -->
    <a href="#" class="back-to-top">
      <i class="lni-chevron-up"></i>
    </a> 

    <!-- Preloader -->
    <div id="preloader">
      <div class="loader" id="loader-1"></div>
    </div>
    <!-- End Preloader -->

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="{{ asset('frontweb/js/jquery-min.js') }}"></script>
    <script src="{{ asset('frontweb/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontweb/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontweb/js/owl.carousel.js') }}"></script> 
    <script src="{{ asset('frontweb/js/jquery.mixitup.js') }}"></script>       
    <script src="{{ asset('frontweb/js/jquery.nav.js') }}"></script>    
    <script src="{{ asset('frontweb/js/scrolling-nav.js') }}"></script>    
    <script src="{{ asset('frontweb/js/jquery.easing.min.js') }}"></script>     
    <script src="{{ asset('frontweb/js/wow.js') }}"></script>   
    <script src="{{ asset('frontweb/js/jquery.counterup.min.js') }}"></script>     
    <script src="{{ asset('frontweb/js/nivo-lightbox.js') }}"></script>     
    <script src="{{ asset('frontweb/js/jquery.magnific-popup.min.js') }}"></script>     
    <script src="{{ asset('frontweb/js/waypoints.min.js') }}"></script>      
    {{-- <script src="{{ asset('frontweb/js/form-validator.min.js') }}"></script>
    <script src="{{ asset('frontweb/js/contact-form-script.js') }}"></script>    --}}
    <script src="{{ asset('frontweb/js/main.js') }}"></script> 
    
</body>
</html>