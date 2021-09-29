@extends('painel.layout.index')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Nova Nota Fiscal</h4>
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

            <h4 class="card-title">CADASTRE SUA NOTA:</h4>
            <p class="card-title-desc">Aguarde só mais um pouquinho. Sua nota fiscal será avaliada e logo você conhecerá o seu número da sorte. Fique de olho no e-mail cadastrado e dedos cruzados!</p>
            <form name="create_nota" method="POST" action="{{route('nota.store')}}"  class="needs-validation"  accept-charset="utf-8" enctype="multipart/form-data" novalidate>
                @csrf

                <!-- Dados Pessoais - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Nota</h5>
                </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="promocao">Promoção Associada</label>
                                <select id="promocao" name="promocao" class="form-control">
                                    <option value="">---</option>
                                    @foreach($promocaos as $promocao)
                                        <option value="{{$promocao->id}}" {{($promocao->id == old('promocao')) ? 'selected' : '' }}>{{$promocao->nome}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="franquia">Onde Comprei</label>
                                <select id="franquia" name="franquia" class="form-control">
                                    <option value="">---</option>
                                    @foreach($franquias as $franquia)
                                        <option value="{{$franquia->id}}" {{($franquia->id == old('franquia')) ? 'selected' : '' }}>{{$franquia->nome}} - {{ $franquia->end_cidade}}/{{ $franquia->end_uf }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="path_nota">Nota Fiscal (imagem/pdf)</label>
                            <div class="form-group custom-file">
                                <input type="file" class="custom-file-input" id="path_nota" name="path_nota" accept="image/*, application/pdf">
                                <label class="custom-file-label" for="path_nota">Selecionar a Nota</label>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                    <p></p>
                {{-- <div class="row">
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
                </div> --}}
                <button class="btn btn-primary" type="submit">Salvar Cadastro</button>
            </form>

            <!-- FORMULÁRIO - FIM -->
            </div>
        </div>
    </div>
</div>

@endsection


@section('script-js')
    <script src="{{asset('nazox/assets/js/pages/form-validation.init.js')}}"></script>
    <script src="{{asset('nazox/assets/libs/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="{{asset('nazox/assets/js/pages/form-element.init.js')}}"></script>
@endsection
