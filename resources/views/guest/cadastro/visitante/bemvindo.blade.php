<html lang="pt">

	<!-- Cityinbag - Head INI -->
    <head>
        <meta charset="utf-8" />
        <title>FAFIS | Forms</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Fafis Forms" name="description" />
        <meta content="Cityinbag" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="http://localhost:8000/nazox/assets/images/favicon.png">

        <!-- jquery.vectormap css -->
        <link href="http://localhost:8000/nazox/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <!-- DataTables -->
        <link href="http://localhost:8000/nazox/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="http://localhost:8000/nazox/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="http://localhost:8000/nazox/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="http://localhost:8000/nazox/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="http://localhost:8000/nazox/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />


        <link href="http://localhost:8000/nazox/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">

        <!-- Cityinbag Css-->
        <link href="http://localhost:8000/css/cityinbag.css" id="app-style" rel="stylesheet" type="text/css" />

        <!-- Cityinbag - CSS INICIO-->
            <link href="http://localhost:8000/nazox/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
        <!-- Cityinbag - CSS FIM-->


        <!-- Cityinbag - JavaScript INI -->
        <!-- JAVASCRIPT -->
        <script src="http://localhost:8000/nazox/assets/libs/jquery/jquery.min.js"></script>
        <script src="http://localhost:8000/nazox/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="http://localhost:8000/nazox/assets/libs/metismenu/metisMenu.min.js"></script>

        <script src="http://localhost:8000/nazox/assets/js/app.js"></script>
        <script src="http://localhost:8000/nazox/assets/js/pages/form-validation.init.js"></script>
        <script src="http://localhost:8000/nazox/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>
        <script src="http://localhost:8000/nazox/assets/js/pages/form-element.init.js"></script>
        <script src="http://localhost:8000/nazox/assets/libs/select2/js/select2.min.js"></script>
        <!-- form mask -->
        <script src="http://localhost:8000/nazox/assets/libs/inputmask/jquery.inputmask.min.js"></script>

    </head>

	<!-- Cityinbag - Head FIM-->

    <body data-sidebar="dark">

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Solicitação de Cadastro - REALIZADA COM SUCESSO</h4>
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

            <h4 class="card-title">Formulário de Solicitação de Cadastro - ENVIADA</h4>
            <p class="card-title-desc">A solicitação de cadastro informado foi enviada para nossa equipe de análise. Agradecemos o preenchimento.</p>

            <!-- FORMULÁRIO - FIM -->
            </div>
        </div>
    </div>
</div>


</body>
</html>
