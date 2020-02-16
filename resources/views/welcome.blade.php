 <!-- =========================================================
 * Argon Dashboard PRO v1.1.0
 =========================================================

 * Product Page: https://www.creative-tim.com/product/argon-dashboard-pro
 * Copyright 2019 Creative Tim (https://www.creative-tim.com)

 * Coded by Creative Tim

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
  -->
  <!DOCTYPE html>
 <html>

 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
   <meta name="author" content="Creative Tim">
   <title>Buataja - platform membership</title>
   <!-- Favicon -->
   <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png">

   <!-- Fonts -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
   <!-- Icons -->
   <link rel="stylesheet" href="./assets/vendor/nucleo/css/nucleo.css" type="text/css">
   <link rel="stylesheet" href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
   <!-- Page plugins -->
   <!-- Argon CSS -->
   <link rel="stylesheet" href="./assets/css/argon.css?v=1.1.0" type="text/css">
 </head>

 <body>
   <!-- Navabr -->
   <nav id="navbar-main" class="navbar navbar-horizontal navbar-main navbar-expand-lg navbar-dark bg-gradient-warning">
     <div class="container">
     <a href="{{ url('/') }}">
                 <img src="{{ asset('assets/img/favicon.png') }}" class="avatar avatar-sm">
               </a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <div class="navbar-collapse navbar-custom-collapse collapse" id="navbar-collapse">
       <div class="navbar-collapse-header">
           <div class="row">
             <div class="col-6 collapse-brand">
             <a href="{{ url('/') }}">
                 <img src="{{ asset('assets/img/favicon.png') }}" class="avatar avatar-sm">
               </a>
             </div>
             <div class="col-6 collapse-close">
               <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                 <span></span>
                 <span></span>
               </button>
             </div>
           </div>
         </div>

         <ul class="navbar-nav mr-auto">
           <li class="nav-item">
             <a href="./pages/dashboards/dashboard.html" class="nav-link">
               <span class="nav-link-inner--text">home</span>
             </a>
           </li>
           <!-- <li class="nav-item">
             <a href="./pages/examples/pricing.html" class="nav-link">
               <span class="nav-link-inner--text">Pricing</span>
             </a>
           </li> -->
           <li class="nav-item">
             <a href="./pages/examples/lock.html" class="nav-link">
               <span class="nav-link-inner--text">about us</span>
             </a>
           </li>

         </ul>
         <hr class="d-lg-none" />
         <ul class="navbar-nav align-items-lg-center ml-lg-auto">
          
          <li class="nav-item d-lg-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <span class="nav-link-inner--text">Pencarian</span>
                <!-- <i class="fa fa-search text-dark">Pencarian</i> -->
              </a>
            </li>
            <li class="nav-item">
            <form action="/da5e6997913d68b2b6a59381a94e664a" method="post"  enctype="multipart/form-data" class="navbar-search navbar-search-light  mr-sm-3" id="navbar-search-main">
          {{ csrf_field() }}
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" name="key" id="key" placeholder="Cari Kreator" type="text" required>
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form></li>
         @if (Route::has('login'))
                    @auth
                    <li class="nav-item">
           <a href="{{ url('106a6c241b8797f52e1e77317b96a201') }}" class="nav-link">
               <span class="nav-link-inner--text">beranda</span>
             </a>
                    @else
                    <li class="nav-item">
           <a href="{{ url('login') }}" class="nav-link">
               <span class="nav-link-inner--text">login</span>
             </a>
           </li>

                        @if (Route::has('register'))
                        <li class="nav-item">
           <a href="{{ url('register') }}" class="nav-link">
               <span class="nav-link-inner--text">register</span>
             </a>
           </li>
                        @endif
                    @endauth
            @endif
           
            
           
         </ul>
       </div>
     </div>
   </nav>
   <!-- Main content -->
   <div class="main-content">
     <!-- Header -->
     <div class="header  pt-5 pb-7">
       <div class="container">
         <div class="header-body">
           <div class="row align-items-center">
             <div class="col-lg-6 order-2 order-sm-1">
             <br>
               <div class="pr-5">
                 <h1 class="display-1  font-weight-bold mb-0">Hai kreator...</h1>
                 <h2 class="display-3  font-weight-light">BERANI TAMPIL BEDA.</h2>
                 <p class=" mt-4">Cara bersahabat bagi content creator untuk mendapat dukungan dana dari para penikmat karyanya </p>
                  <p class=" mt-4 text-warning">#beraniberbeda #beraniberkarya #buatajadulu</p>
                 
                 <div class="mt-5">
                 <!-- <a href="https://www.creative-tim.com/product/argon-dashboard-pro" class="btn btn-neutral my-2">kenapa membership?</a> -->

                   <a href="{{ url('8f8fe8570a6fca0299bce1c90079cbe6/1') }}" class="btn btn-warning my-2">gabung jadi kreator</a>
                 </div>
               </div>
             </div>
             <div class="col-lg-6 order-1 order-sm-2">
               <div class="row pt-1">
               <div class="col-md-12 ">
                <img src="./assets/img/Asset 1.png" class="img-fluid">
              </div>
              
               </div>
             </div>
           </div>
         </div>
       </div>
       <div class="separator separator-bottom separator-skew zindex-100">
         <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
           <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
         </svg>
       </div>
     </div>
     <section class="py-6 pb-9 bg-default">
       <div class="row justify-content-center text-center">
         <div class="col-md-6">
           <p class="display-3 text-white">Kenapa harus ke buataja?</p>
               <p class="text-white">Dengan membantu 1 kreator, 
               anda juga telah berkontribusi kepada perkembangan 
               konten kreator lain nya, kami buataja.id mewakili 
               seluruh konten kreator di Indonesia, mengucapkan 
               terimakasih atas apresiasi anda kepada konten 
               kreator lokal, maupun Internasional.</p>
         </div>
       </div>
     </section>
     <section class="section section-lg pt-lg-0 mt--7">
       <div class="container">
         <div class="row justify-content-center  text-center">
           <div class="col-lg-12">
             <div class="row">
               <div class="col-lg-4">
                 <div class="card card-lift--hover shadow border-0">
                   <div class="card-body py-5">
                     <div class="icon icon-shape bg-gradient-primary text-white rounded-circle mb-4">
                       <i class="ni ni-check-bold"></i>
                     </div>
                     <h4 class="h3 text-primary text-uppercase">Kemudahan Pembayaran</h4>
                     <p class="description mt-3">Dengan metoda pembayaran yang mudah, fans bisa mendukung hanya dengan 2 klik saja! Mendukung GoPay, OVO dan transfer bank.</p>
                     <div>
               
                     </div>
                   </div>
                 </div>
               </div>
               <div class="col-lg-4">
                 <div class="card card-lift--hover shadow border-0">
                   <div class="card-body py-5">
                     <div class="icon icon-shape bg-gradient-success text-white rounded-circle mb-4">
                       <i class="ni ni-istanbul"></i>
                     </div>
                     <h4 class="h3 text-success text-uppercase">Support segala Kreator</h4>
                     <p class="description mt-3">Upload konten sesuka kamu berupa musik, video, blog bahkan komik.</p>
                     <div>
               
                     </div>
                   </div>
                 </div>
               </div>
               <div class="col-lg-4">
                 <div class="card card-lift--hover shadow border-0">
                   <div class="card-body py-5">
                     <div class="icon icon-shape bg-gradient-warning text-white rounded-circle mb-4">
                       <i class="ni ni-planet"></i>
                     </div>
                     <h4 class="h3 text-warning text-uppercase">Berikan Konten Ekslusif</h4>
                     <p class="description mt-3">Dengan tulisan, gambar, dan audio (podcast), berikan fans konten ekslusif atau early access dari karyamu. Manjakan fans kamu. </p>
                     <div>
                       
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </section>
     <section class="py-6">
       <div class="container">
         <div class="row row-grid align-items-center">
           <div class="col-md-6 order-md-2">
             <img src="./assets/img/theme/Asset 1.png" width="300px" class="thumb img-fluid">
           </div>
           <div class="col-md-6 order-md-1">
             <div class="pr-md-5">
               <h1>Kemudahan Pembayaran</h1>
               <p>Dengan metoda pembayaran yang mudah, fans bisa mendukung hanya dengan 2 klik saja! Mendukung GoPay, OVO dan transfer bank.</p>
               <ul class="list-unstyled mt-5">
                 <li class="py-2">
                   <div class="d-flex align-items-center">
                     <div>
                       <div class="badge badge-circle badge-success mr-3">
                         <i class="ni ni-satisfied"></i>
                       </div>
                     </div>
                     <div>
                       <h4 class="mb-0">Gopay</h4>
                     </div>
                   </div>
                 </li><li class="py-2">
                   <div class="d-flex align-items-center">
                     <div>
                       <div class="badge badge-circle badge-success mr-3">
                         <i class="ni ni-satisfied"></i>
                       </div>
                     </div>
                     <div>
                       <h4 class="mb-0">Ovo</h4>
                     </div>
                   </div>
                 </li>
                 <li class="py-2">
                   <div class="d-flex align-items-center">
                     <div>
                       <div class="badge badge-circle badge-success mr-3">
                         <i class="ni ni-satisfied"></i>
                       </div>
                     </div>
                     <div>
                       <h4 class="mb-0">Bank transfer</h4>
                     </div>
                   </div>
                 </li>
               </ul>
             </div>
           </div>
         </div>
       </div>
     </section>
     <section class="py-6">
       <div class="container">
         <div class="row row-grid align-items-center">
           <div class="col-md-6">
             <img src="./assets/img/theme/Asset 2.png" width="300px" class="thumb img-fluid">
           </div>
           <div class="col-md-6">
             <div class="pr-md-5">
               <h1>Berikan Konten Ekslusif</h1>
               <p>Dengan tulisan, gambar, dan audio (podcast), berikan fans konten ekslusif atau early access dari karyamu. Manjakan fans kamu.</p>
               <!-- <a href="./pages/examples/profile.html" class="font-weight-bold text-warning mt-5">Explore pages</a> -->
             </div>
           </div>
         </div>
       </div>
     </section>
     <section class="py-6">
       <div class="container">
         <div class="row row-grid align-items-center">
           <div class="col-md-6 order-md-2">
             <img src="./assets/img/theme/Asset 3.png" width="150px" class="thumb img-fluid">
           </div>
           <div class="col-md-6 order-md-1">
             <div class="pr-md-5">
               <h1>Support segala Kreator</h1>
               <p>Upload konten sesuka kamu berupa musik, video, blog bahkan komik.</p>
               <!-- <a href="./pages/widgets.html" class="font-weight-bold text-info mt-5">Explore widgets</a> -->
             </div>
           </div>
         </div>
       </div>
     </section>
     <section class="py-7 section-nucleo-icons overflow-hidden" style="	background-image: url('./assets/img/cover (4).jpg');
      background-position:center;
      background-repeat:no-repeat;
      background-size:cover;">
       <div class="container">
         <div class="row justify-content-center">
           <div class="col-lg-8 text-center text-white">
             <h2 class="display-3 text-white">Mari bergabung dengan buataja</h2>
             <p class="lead">
               Lebih dari 100+ kreator lokal telah bergabung dan percaya dengan buataja. kamu kapan berkarya bareng kita?
             </p>
             
           </div>
         </div>
           <!-- <a href="./docs/foundation/icons.html">
             <div class="icons-container blur-item mt-5"> --> 
               <!-- Center -->
               <!-- <i class="icon ni ni-diamond"></i> -->
               <!-- Right 1 -->
               <!-- <i class="icon icon-sm ni ni-album-2"></i>
               <i class="icon icon-sm ni ni-app"></i>
               <i class="icon icon-sm ni ni-atom"></i> -->
               <!-- Right 2 -->
               <!-- <i class="icon ni ni-bag-17"></i>
               <i class="icon ni ni-bell-55"></i>
               <i class="icon ni ni-credit-card"></i> -->
               <!-- Left 1 -->
               <!-- <i class="icon icon-sm ni ni-briefcase-24"></i>
               <i class="icon icon-sm ni ni-building"></i>
               <i class="icon icon-sm ni ni-button-play"></i> -->
               <!-- Left 2 -->
               <!-- <i class="icon ni ni-calendar-grid-58"></i>
               <i class="icon ni ni-camera-compact"></i>
               <i class="icon ni ni-chart-bar-32"></i>
             </div>
           </a> -->
     </section>
   </div>
   <!-- Footer -->
   <footer class="py-5" id="footer-main">
     <div class="container">
       <div class="row align-items-center justify-content-xl-between">
         <div class="col-xl-6">
           <div class="copyright text-center text-xl-left text-muted">
             &copy; 2019 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
           </div>
         </div>
         <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link" target="_blank">buataja.id</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">tentang kami</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/license" class="nav-link" target="_blank">License</a>
                        </li>
                    </ul>
                </div>
       </div>
     </div>
   </footer>
   <!-- Argon Scripts -->
   <!-- Core -->
   <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>
   <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
   <script src="./assets/vendor/js-cookie/js.cookie.js"></script>
   <script src="./assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
   <script src="./assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
   <!-- Optional JS -->
   <script src="./assets/vendor/onscreen/dist/on-screen.umd.min.js"></script>
   <!-- Argon JS -->
   <script src="./assets/js/argon.js?v=1.1.0"></script>
   <!-- Demo JS - remove this in your project -->
   <script src="./assets/js/demo.min.js"></script>
 </body>

 </html>