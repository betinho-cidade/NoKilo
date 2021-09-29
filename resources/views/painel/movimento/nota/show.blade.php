@extends('painel.layout.index')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Informações da Nota Fiscal</h4>
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

<small style="color: mediumpurple">{!! $nota->breadcrumb !!}</small>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <!-- FORMULÁRIO - INICIO -->

            <h4 class="card-title">Formulário de Atualização - Nota Fiscal</h4>
            <p class="card-title-desc">A Nota Fiscal cadastrada será aprovada/reprovada pela Adminstração do Site. Sendo aprovada, ela será registrada e acumulará pontos para a geração do bilhete/número para sorteio.
                <br><code>IMPORTANTE: </code> Uma vez APROVADA, não será possível mais nenhuma ação na nota fiscal, uma vez que os pontos que representam o valor da nota, serão computados ao cliente.
            </p>
            <form name="edit_nota" method="POST" action="{{route('nota.update', compact('nota'))}}"  class="needs-validation"  novalidate>
                @csrf
                @method('put')

                <!-- Dados Pessoais - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Nota Fiscal
                    <a href="{{ route('nota.download', compact('nota')) }}">
                        <i class="mdi mdi-file-download mdi-18px" style="color: goldenrod;cursor: pointer" title="Download da Nota"></i>
                    </a>
                </h5>
                </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="promocao">Promoção Associada</label>
                                <input type="text" disabled class="form-control" value="{{ $nota->promocao->nome }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="franquia">Onde Comprei</label>
                                <select id="franquia" name="franquia" class="form-control" required>
                                    <option value="">---</option>
                                    @foreach($franquias as $franquia)
                                        <option value="{{$franquia->id}}" {{($franquia->id == $nota->franquia_id) ? 'selected' : '' }}>{{$franquia->nome}} - {{ $franquia->end_cidade}}/{{ $franquia->end_uf }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="data_nota">Data da Nota Fiscal</label>
                                <input type="date" name="data_nota" id="data_nota" class="form-control" value="{{$nota->data_nota_ajustada}}">
                            </div>
                            <div class="valid-feedback">ok!</div>
                            <div class="invalid-feedback">Inválido!</div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="valor">Valor da Nota Fiscal (R$)</label>
                                <input type="text" name="valor" id="valor" class="form-control" value="{{$nota->valor}}" placeholder="Formato 99.99">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="situacao">Situação</label>
                                <select id="situacao" name="situacao" class="form-control" required>
                                    <option value="">---</option>
                                    <option value="P" {{($nota->status == 'P') ? 'selected' : '' }}>Pendente</option>
                                    <option value="A" {{($nota->status == 'A') ? 'selected' : '' }}>Aprovada</option>
                                    <option value="R" {{($nota->status == 'R') ? 'selected' : '' }}>Reprovada</option>
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="motivo_reprovacao">Motivo para Reprovação</label>
                                <textarea name="motivo_reprovacao" id="motivo_reprovacao" class="form-control" rows="2" placeholder="Informe o motivo para Reprovação da Nota...">{{ $nota->motivo_reprovacao}}</textarea>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>

                    <p></p>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="invalidCheck" required>
                                <label class="custom-control-label" for="invalidCheck">Confirmar alteração da Nota ?</label>
                                <div class="invalid-feedback">
                                    Nenhuma outra ação poderá ser realizada, pois os pontos que representam o valor da nota serão computados ao cliente.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Atualizar Cadastro</button>
            </form>

            <!-- FORMULÁRIO - FIM -->
            </div>
        </div>
    </div>
</div>

@endsection


@section('script-js')
    <script src="{{asset('nazox/assets/js/pages/form-validation.init.js')}}"></script>
    <script src="{{asset('nazox/assets/js/pages/form-element.init.js')}}"></script>
@endsection
