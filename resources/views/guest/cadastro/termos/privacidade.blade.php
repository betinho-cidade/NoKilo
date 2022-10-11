
<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Nokilo | Promoções</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Nokilo - Promoções" name="description" />
        <meta content="Nokilo" name="Nokilo" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="{{asset('nazox/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{asset('nazox/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset('nazox/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <!-- Cityinbag - CSS -->
        <link href="{{asset('css/cityinbag.css')}}" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{route('painel')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('nazox/assets/images/logo-sm-dark.png')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('nazox/assets/images/logo-dark.png')}}" alt="" height="20">
                                </span>
                            </a>

                            <a href="{{route('painel')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('nazox/assets/images/logo-sm-light.png')}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('nazox/assets/images/logo-light.png')}}" alt="" height="36">
                                </span>
                            </a>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li>
                                <a href="index.html" class="waves-effect" style="cursor: default;color: #ffffff;pointer-events: none;">
                                    <i class="fa fa-check" style="color: #ffffff;"></i><span class="badge badge-pill badge-success float-right"></span>
                                    <span>Título Extra Aqui </span>
                                </a>
                            </li>
                            <li>
                                <a style="padding: .625rem 1rem;  color: #b7b7b7;cursor: default;pointer-events: none;">
                                    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non nisi id augue semper varius ac pretium leo. In at nisi id elit semper elementum. Ut eget ex luctus.</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                    <!-- CADASTRO DE NOVO USUARIO - INI -->

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">Política de Privacidade</h4>
                            </div>
                        </div>
                    </div>

                    @if(session()->has('message.level'))
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-{{ session('message.level') }}">
                            {!! session('message.content') !!}
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($errors->any())
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger">
                                  <ul>
                                    @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                    @endforeach
                                  </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                <!-- FORMULÁRIO - INICIO -->

                                <p class="card-title-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non nisi id augue semper varius ac pretium leo. In at nisi id elit semper elementum. Ut eget ex luctus, convallis massa vitae, condimentum ex. Fermentum dui a blandit sodales. Maecenas fermentum eu felis vel auctor. Etiam tincidunt, leo ut porttitor scelerisque, ipsum nibh lacinia felis, sit amet porttitor ex dui eget tellus. Morbi quis dui quis ante aliquet ultricies. Nullam justo massa, tristique eget vehicula non, tincidunt at lacus. Donec nulla nunc, varius eu diam in, blandit suscipit nisl. Sed augue velit, cursus a blandit ut, scelerisque a augue. Etiam euismod lacus ex, non hendrerit arcu feugiat nec. Ut eu massa finibus, pulvinar nulla vel, molestie velit. Donec semper tincidunt velit quis mollis. Maecenas molestie tellus vel magna pretium, ut varius metus pharetra.</p>
                                <p class="card-title-desc">Pellentesque dapibus mi in rutrum dapibus. Praesent sed auctor metus. Aenean fringilla, sem non porttitor consequat, tortor erat luctus ligula, ac congue lectus urna ac ante. Morbi vitae enim metus. Proin mi turpis, porttitor sed nisi eu, imperdiet imperdiet nisl. Phasellus in nisi ac neque lacinia varius. Integer nec malesuada magna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Donec ac lorem ornare, aliquet ipsum ut, fermentum enim. Vestibulum eu mi libero. Vivamus at fermentum purus. Nunc sit amet hendrerit mauris, a scelerisque mauris. Proin commodo eros nunc, eget gravida erat suscipit at. Pellentesque vestibulum finibus lorem a imperdiet. Proin efficitur nunc ac dapibus elementum. Vivamus iaculis nisl lectus, in commodo turpis rutrum in. </p>
                                <p class="card-title-desc">Nunc neque dolor, viverra id justo tincidunt, interdum feugiat est. Proin a suscipit nibh. Fusce elementum pulvinar feugiat. a arcu id ante dapibus venenatis. Nam orci augue, dictum nec hendrerit id, ultrices ut lectus. Sed egestas egestas lacus in efficitur. Proin tempor lectus non ligula porta pellentesque. Ut arcu mauris, consectetur sed aliquet eu, lacinia vitae leo. Aenean tincidunt ornare elit, et accumsan massa tempor vel. </p>
                                <p class="card-title-desc">Mauris a lorem mattis mauris lobortis eleifend at sed risus. Fusce magna sem, cursus sed urna sit amet, malesuada pulvinar quam. Aenean at eros ullamcorper nisl sagittis laoreet eu sed ligula. Fusce laoreet malesuada nunc. taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec sollicitudin at orci non malesuada. Nullam hendrerit sapien mi, non placerat lacus consequat a. Cras sit amet leo nec tortor elementum aliquet. Maecenas hendrerit pharetra congue. </p>
                                <p class="card-title-desc"> Aenean malesuada nisi orci, et fermentum lectus gravida at. Etiam ut lectus justo. Vestibulum ut ultricies magna. Aliquam erat volutpat. Ut rhoncus risus non porta viverra. Nulla eu sapien eget magna finibus pellentesque. Fusce fermentum dolor in magna tincidunt porta. Nunc sapien nulla, aliquet ut quam id, tempus gravida dui.</p>


                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CADASTRO DE NOVO USUARIO - FIM -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                2014-<script>document.write(new Date().getFullYear())</script> © Cityinbag.
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->

        <script src="{{asset('nazox/assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('nazox/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('nazox/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{asset('nazox/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('nazox/assets/js/app.js')}}"></script>

        <script src="{{asset('nazox/assets/js/pages/form-validation.init.js')}}"></script>
        <script src="{{asset('nazox/assets/js/pages/form-element.init.js')}}"></script>

        <!-- Facebook Pixel Code -->
        <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '725924801618237');
        fbq('track', 'PageView');
        </script>
        <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=725924801618237&ev=PageView&noscript=1"
        /></noscript>
        <!-- End Facebook Pixel Code -->

    </body>
</html>














