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
                            url: "{{route('visitante.js_viacep')}}",
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



    </head>

	<!-- Cityinbag - Head FIM-->

    <body data-sidebar="dark">

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Solicitação de Cadastro</h4>
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

            <h4 class="card-title">Formulário de Solicitação de Cadastro - Novo Membro</h4>
            <p class="card-title-desc">A solicitação de cadastro será enviada aos responsáveis para análise e efetivação.</p>
            <form name="create_visitante" method="POST" action="{{route('visitante.store')}}"  class="needs-validation"  novalidate>
                @csrf

                <!-- Dados Pessoais - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Pessoais</h5>
                </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{old('nome')}}" placeholder="Nome" required>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email_membro">E-mail</label>
                                <input type="email" class="form-control" id="email_membro" name="email_membro" value="{{old('email_membro')}}" placeholder="E-mail">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cpf">CPF</label>
                            <input type="text" name="cpf" id="cpf" class="form-control mask_cpf" value="{{old('cpf')}}" placeholder="(999.999.999-99)">
                        </div>

                        <div class="col-md-2">
                            <label for="sexo">Sexo</label>
                            <select id="sexo" name="sexo" class="form-control" required>
                                <option value="">---</option>
                                <option value="M" {{(old('sexo') == 'M') ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{(old('sexo') == 'F') ? 'selected' : '' }}>Feminino</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="celular">Telefone Celular</label>
                            <input type="text" name="celular" id="celular" class="form-control mask_celular" value="{{old('celular')}}" placeholder="(99) 99999-9999" required>
                        </div>
                        <div class="col-md-4">
                            <label for="data_nascimento">Data Nascimento</label>
                            <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="{{old('data_nascimento')}}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="naturalidade">Naturalidade</label>
                            <input type="text" name="naturalidade" id="naturalidade" class="form-control" value="{{old('naturalidade')}}" required>
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Pessoais - FIM -->


                <!-- Dados Complementares - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Complementares</h5>
                </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="estado_civil">Estado Civil</label>
                            <select id="estado_civil" name="estado_civil" class="form-control">
                                <option value="">---</option>
                                <option value="SL" {{(old('estado_civil') == 'SL') ? 'selected' : '' }}>Solteiro</option>
                                <option value="CS" {{(old('estado_civil') == 'CS') ? 'selected' : '' }}>Casado</option>
                                <option value="SP" {{(old('estado_civil') == 'SP') ? 'selected' : '' }}>Separado</option>
                                <option value="DV" {{(old('estado_civil') == 'DV') ? 'selected' : '' }}>Divorciado</option>
                                <option value="VI" {{(old('estado_civil') == 'VI') ? 'selected' : '' }}>Viúvo</option>
                                <option value="UE" {{(old('estado_civil') == 'UE') ? 'selected' : '' }}>União Estável</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="conjuge">Nome Cônjuge</label>
                                <input type="text" class="form-control" id="conjuge" name="conjuge" value="{{old('conjuge')}}" placeholder="Nome">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="data_casamento">Data Casamento</label>
                            <input type="date" name="data_casamento" id="data_casamento" class="form-control" value="{{old('data_casamento')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="escolaridade">Escolaridade</label>
                            <select id="escolaridade" name="escolaridade" class="form-control">
                                'EF','EM','EP','ES','MS','DO','PD','NA','AL','NI'
                                <option value="">---</option>
                                <option value="EF" {{(old('escolaridade') == 'EF') ? 'selected' : '' }}>Ensino Fundamental</option>
                                <option value="EM" {{(old('escolaridade') == 'EM') ? 'selected' : '' }}>Ensino Médio</option>
                                <option value="EP" {{(old('escolaridade') == 'EP') ? 'selected' : '' }}>Ensino Profissionalizante</option>
                                <option value="ES" {{(old('escolaridade') == 'ES') ? 'selected' : '' }}>Ensino Superior</option>
                                <option value="MS" {{(old('escolaridade') == 'MS') ? 'selected' : '' }}>Mestrado</option>
                                <option value="DO" {{(old('escolaridade') == 'DO') ? 'selected' : '' }}>Doutorado</option>
                                <option value="PD" {{(old('escolaridade') == 'PD') ? 'selected' : '' }}>Pós Doutorado</option>
                                <option value="NA" {{(old('escolaridade') == 'NA') ? 'selected' : '' }}>Não Alfabetizado</option>
                                <option value="AL" {{(old('escolaridade') == 'AL') ? 'selected' : '' }}>Alfabetizado</option>
                                <option value="NI" {{(old('escolaridade') == 'N1') ? 'selected' : '' }}>Não Informada</option>
                            </select>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>

                        <div class="col-md-3">
                            <label for="profissao">Profissão</label>
                            <input type="text" name="profissao" id="profissao" class="form-control" value="{{old('profissao')}}" placeholder="Profissão">
                        </div>
                        <div class="col-md-3">
                            <label for="nome_pai">Nome do Pai</label>
                            <input type="text" name="nome_pai" id="nome_pai" class="form-control" value="{{old('nome_pai')}}" placeholder="Nome do Pai">
                        </div>
                        <div class="col-md-3">
                            <label for="nome_mae">Nome da Mãe</label>
                            <input type="text" name="nome_mae" id="nome_mae" class="form-control" value="{{old('nome_mae')}}" placeholder="Nome da Mãe" required>
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Complementares - FIM -->

                <!-- Dados Endereço - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Endereço</h5>
                </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="end_cep">CEP</label>
                            <img src="{{asset('images/loading.gif')}}" id="img-loading-cep" style="display:none;max-width: 17%; margin-left: 26px;">
                            <input type="text" name="end_cep" id="end_cep" class="form-control dynamic_cep mask_cep" value="{{old('end_cep')}}" placeholder="99.999-999">
                        </div>

                        <div class="col-md-4">
                            <label for="end_cidade">Cidade</label>
                            <input type="text" name="end_cidade" id="end_cidade" class="form-control" value="{{old('end_cidade')}}">
                        </div>

                        <div class="col-md-2">
                            <label for="end_uf">Estado</label>
                            <input type="text" name="end_uf" id="end_uf" class="form-control" value="{{old('end_uf')}}">
                        </div>

                        <div class="col-md-4">
                            <label for="end_bairro">Bairro</label>
                            <input type="text" name="end_bairro" id="end_bairro" class="form-control" value="{{old('end_bairro')}}">
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="end_endereco">Endereço</label>
                            <input type="text" name="end_logradouro" id="end_logradouro" class="form-control" value="{{old('end_logradouro')}}">
                        </div>

                        <div class="col-md-2">
                            <label for="end_numero">Número</label>
                            <input type="text" name="end_numero" id="end_numero" value="{{old('end_numero')}}" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label for="end_complemento">Complemento </label>
                            <input type="text" name="end_complemento" id="end_complemento" class="form-control" value="{{old('end_complemento')}}">
                        </div>
                    </div>
                    <p></p>
                <!-- Dados Endereço - FIM -->


                <!-- Dados Eclesiásticos - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Eclesiásticos</h5>
                </div>

                    <fieldset class="border p-3">
                        <legend class="w-auto">Batismo</legend>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="data_batismo">Data</label>
                                <input type="date" name="data_batismo" id="data_batismo" class="form-control" value="{{old('data_batismo')}}">
                            </div>
                            <div class="col-md-4">
                                <label for="pastor_batismo">Pastor</label>
                                <input type="text" name="pastor_batismo" id="pastor_batismo" class="form-control" value="{{old('pastor_batismo')}}" placeholder="Pastor Batismo">
                            </div>
                            <div class="col-md-5">
                                <label for="igreja_batismo">Igreja</label>
                                <input type="text" name="igreja_batismo" id="igreja_batismo" class="form-control" value="{{old('igreja_batismo')}}" placeholder="Igreja Batismo">
                            </div>
                        </div>
                    </fieldset>
                    <p></p>
                    <fieldset class="border p-3">
                        <legend class="w-auto">Profissão de Fé</legend>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="data_profissao_fe">Data</label>
                                <input type="date" name="data_profissao_fe" id="data_profissao_fe" class="form-control" value="{{old('data_profissao_fe')}}">
                            </div>
                            <div class="col-md-4">
                                <label for="pastor_profissao_fe">Pastor</label>
                                <input type="text" name="pastor_profissao_fe" id="pastor_profissao_fe" class="form-control" value="{{old('pastor_profissao_fe')}}" placeholder="Pastor Profissão Fé">
                            </div>
                            <div class="col-md-5">
                                <label for="igreja_profissao_fe">Igreja</label>
                                <input type="text" name="igreja_profissao_fe" id="igreja_profissao_fe" class="form-control" value="{{old('igreja_profissao_fe')}}" placeholder="Igreja Profissão Fé">
                            </div>
                        </div>
                    </fieldset>
                    <p></p>

                    <!-- Dados Ministeriais -- INI -->
                    <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                        <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Ministeriais</h5>
                    </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="aptidao">Descrição das Aptidões</label>
                                    <textarea class="form-control" id="aptidao" name="aptidao" placeholder="Aptidões" rows="3">{{ old('aptidao')}}</textarea>
                                    <div class="valid-feedback">ok!</div>
                                    <div class="invalid-feedback">Inválido!</div>
                                </div>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="invalidCheck" required>
                                        <label class="custom-control-label" for="invalidCheck">Aceito os termos e condições acima</label>
                                        <div class="invalid-feedback">
                                            Você deve aceitar os termos antes de enviar o formulário.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Dados Ministeriais -- FIM -->

                <button class="btn btn-primary" type="submit">Salvar Cadastro</button>
            </form>

            <!-- FORMULÁRIO - FIM -->
            </div>
        </div>
    </div>
</div>


</body>
</html>
