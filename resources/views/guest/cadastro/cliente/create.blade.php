
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

        <!-- CSS PERSONALIZADO CADASTRO CITYINBAG -->

        <style type="text/css">
            .btn-primary{background-color: #8d01a0 !important;border-color: #8d01a0 !important;}
            .btn-primary:hover, .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle{    box-shadow: none;background-color: #750185 !important;border-color: #750185 !important;}

            .bg-soft-primary {background-color: #fef68c !important;}
            .text-primary, .page-title-box h4, .card-title, label{  color: #8d01a0!important;}

            body[data-sidebar=dark] .navbar-brand-box {background: #311538;}
            body[data-sidebar=dark] .vertical-menu{background: #3f1a48;}

        </style>


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
                                <h4 class="mb-0">VAI QUE É TUUUA!</h4>
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

                                <h4 class="card-title">Preencha seus Dados</h4>
                                <p class="card-title-desc">Para participar, precisamos de algumas informações. A senha deve conter no mínimo 8 dígitos. Boa sorte!</p>
                                <form name="create_usuario" method="POST" action="{{route('cliente.store')}}"  class="needs-validation" novalidate>
                                    @csrf

                                    <!-- Dados Pessoais - INI -->
                                    <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                                        <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Pessoais</h5>
                                    </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nome">Nome</label>
                                                    <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}" placeholder="Nome" required>
                                                    <div class="valid-feedback">ok!</div>
                                                    <div class="invalid-feedback">Inválido!</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="cpf">CPF</label>
                                                    <input type="text" name="cpf" id="cpf" class="form-control mask_cpf" value="{{old('cpf')}}" placeholder="(999.999.999-99)" required>
                                                    <div class="valid-feedback">ok!</div>
                                                    <div class="invalid-feedback">Inválido!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="celular">Celular</label>
                                                        <input type="text" name="celular" id="celular" class="form-control mask_celular" value="{{old('celular')}}" placeholder="(99) 99999-9999" required>
                                                    <div class="valid-feedback">ok!</div>
                                                    <div class="invalid-feedback">Inválido!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="data_nascimento">Data Nascimento</label>
                                                    <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="{{old('data_nascimento')}}" required>
                                                    <div class="valid-feedback">ok!</div>
                                                    <div class="invalid-feedback">Inválido!</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Dados Endereço - INI -->
                                        <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                                            <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Endereço</h5>
                                        </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="end_cep">CEP</label>
                                                        <img src="{{asset('images/loading.gif')}}" id="img-loading-cep" style="display:none;max-width: 17%; margin-left: 26px;">
                                                        <input type="text" name="end_cep" id="end_cep" class="form-control dynamic_cep mask_cep" value="{{old('end_cep')}}" placeholder="99.999-999">
                                                        <div class="valid-feedback">ok!</div>
                                                        <div class="invalid-feedback">Inválido!</div>
                                                        </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="end_cidade">Cidade</label>
                                                        <input type="text" name="end_cidade" id="end_cidade" class="form-control" value="{{old('end_cidade')}}">
                                                        <div class="valid-feedback">ok!</div>
                                                        <div class="invalid-feedback">Inválido!</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="end_uf">Estado</label>
                                                        <input type="text" name="end_uf" id="end_uf" class="form-control" value="{{old('end_uf')}}">
                                                        <div class="valid-feedback">ok!</div>
                                                        <div class="invalid-feedback">Inválido!</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="end_bairro">Bairro</label>
                                                        <input type="text" name="end_bairro" id="end_bairro" class="form-control" value="{{old('end_bairro')}}">
                                                        <div class="valid-feedback">ok!</div>
                                                        <div class="invalid-feedback">Inválido!</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p></p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="end_endereco">Endereço</label>
                                                        <input type="text" name="end_logradouro" id="end_logradouro" class="form-control" value="{{old('end_logradouro')}}">
                                                        <div class="valid-feedback">ok!</div>
                                                        <div class="invalid-feedback">Inválido!</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="end_numero">Número</label>
                                                        <input type="text" name="end_numero" id="end_numero" value="{{old('end_numero')}}" class="form-control">
                                                        <div class="valid-feedback">ok!</div>
                                                        <div class="invalid-feedback">Inválido!</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="end_complemento">Complemento </label>
                                                        <input type="text" name="end_complemento" id="end_complemento" class="form-control" value="{{old('end_complemento')}}">
                                                        <div class="valid-feedback">ok!</div>
                                                        <div class="invalid-feedback">Inválido!</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p></p>
                                        <!-- Dados Endereço - FIM -->
                                        <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                                            <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Acesso</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Login Acesso (E-mail)</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Login Acesso" required>
                                                    <div class="valid-feedback">ok!</div>
                                                    <div class="invalid-feedback">Inválido!</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="password">Senha</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
                                                    <div class="valid-feedback">ok!</div>
                                                    <div class="invalid-feedback">Inválido!</div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="password_confirm">Senha Confirmação</label>
                                                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Senha de Confirmação" required>
                                                    <div class="valid-feedback">ok!</div>
                                                    <div class="invalid-feedback">Inválido!</div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Dados Pessoais -- FIM -->

                                    <div class="row aceites">
                                        <div class="col-lg-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="privacidade" name="privacidade" required>
                                                <label class="custom-control-label" for="privacidade"></label>

                                                <a href="{{ route('cliente.termo_privacidade') }}" class="stretched-link" target="_blank">
                                                    <label>Tenho conhecimento e aceito a política de privacidade</label>
                                                </a>

                                                <div class="invalid-feedback" style="margin: -6px 0 10px 0;">
                                                    Você deve aceitar os termos da política de privacidade antes de enviar seu cadastro
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="lgpd" name="lgpd">
                                                <label class="custom-control-label" for="lgpd"></label>

                                                <a href="{{ route('cliente.termo_lgpd') }}" class="stretched-link" target="_blank">
                                                    <label>Autorizo o tratamento de dados pessoais para marketing de produtos e serviços</label>
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                    </div>
                                    <button class="btn btn-primary" type="submit">Salvar Cadastro</button>
                                </form>

                                <!-- FORMULÁRIO - FIM -->
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
        <script src="{{asset('nazox/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
        <script src="{{asset('nazox/assets/js/pages/form-element.init.js')}}"></script>
        <!-- form mask -->
        <script src="{{asset('nazox/assets/libs/inputmask/jquery.inputmask.min.js')}}"></script>

        <script>
            $(document).ready(function(){
                $('.mask_cep').inputmask('99.999-999');
                $('.mask_cpf').inputmask('999.999.999-99');
                $('.mask_celular').inputmask('(99) 99999-9999');
                $('.select2').select2();
            });
        </script>

        <script type='text/javascript'>
            $(document).ready(function(){
                $('.dynamic_cep').change(function(){

                    if ($(this).val() != ''){
                        document.getElementById("img-loading-cep").style.display = '';

                        var cep = $('#end_cep').val();
                        var _token = $('input[name="_token"]').val();

                        $('#end_logradouro').val('');
                        $('#end_complemento').val('');
                        $('#end_numero').val('');
                        $('#end_bairro').val('');
                        $('#end_cidade').val('');
                        $('#end_uf').val('');

                        $.ajax({
                            url: "{{route('cliente.js_viacep_new')}}",
                            method: "POST",
                            data: {_token:_token, cep:cep},
                            success:function(result){
                                dados = JSON.parse(result);
                                if(dados==null || dados['error'] == 'true'){
                                        console.log(dados);
                                } else{
                                        $('#end_logradouro').val(dados['logradouro']);
                                        $('#end_complemento').val(dados['complemento']);
                                        $('#end_bairro').val(dados['bairro']);
                                        $('#end_cidade').val(dados['localidade']);
                                        $('#end_uf').val(dados['uf']);
                                }
                                document.getElementById("img-loading-cep").style.display = 'none';
                            },
                            error:function(erro){
                                document.getElementById("img-loading-cep").style.display = 'none';
                            }
                        })
                    }
                });
            });
        </script>

    </body>
</html>














