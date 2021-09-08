
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
                                    <i class="ri-lock-line" style="color: #ffffff;"></i><span class="badge badge-pill badge-success float-right"></span>
                                    <span>Acesso Restrito </span>
                                </a>
                            </li>
                            <li>
                                <a style="padding: .625rem 1rem;  color: #b7b7b7;cursor: default;pointer-events: none;">
                                    <span>O acesso ao menu do portal é restrito a assinantes, relize a assinatura para liberar esta opção.</span>
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
                                <h4 class="mb-0">Cliente NoKilo - CADASTRO REALIZADO</h4>
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

                                <h4 class="card-title">Parabéns !!!</h4>
                                <p class="card-title-desc">Você realizou seu cadastro com sucesso.</p>

                                {{--  <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Plano: {{ $plano_assinatura->name }} - R$ {{ number_format($plano_assinatura->amountPerPayment, 2, ",", ".") }}</h5>
                                 </div>  --}}

                                <p>Agora, acesse ao <a href="{{ route('login') }}">Portal Nokilo</a>, faça seu login com o e-mail e senha que acabou de criar e desfrute de nossas promoção.</p>
                                <a href="{{ route('login') }}" style=" padding: 12px 19px; background: #353535; color: #fff; display: inline-flex; border-radius: 5px; ">Acesso ao Portal</a>

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

    </body>
</html>














