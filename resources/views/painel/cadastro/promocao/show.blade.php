@extends('painel.layout.index')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Informações da Promoção</h4>
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

<small style="color: mediumpurple">{!! $promocao->breadcrumb !!}</small>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <!-- FORMULÁRIO - INICIO -->

            <h4 class="card-title">Formulário de Atualização - Promoção</h4>
            <p class="card-title-desc">A Promoção cadastrada será a base das notas registradas pelo Cliente, bem como da geração dos bilhetes (número da sorte).</p>
            <form name="edit_promocao" method="POST" action="{{route('promocao.update', compact('promocao'))}}"  class="needs-validation"  novalidate>
                @csrf
                @method('put')

                <!-- Dados Pessoais - INI -->
                <div class="bg-soft-primary p-3 rounded" style="margin-bottom:10px;">
                    <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Dados Promoção</h5>
                </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{$promocao->nome}}" placeholder="Nome" required>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="data_inicio">Data Início</label>
                                <input type="date" name="data_inicio" id="data_inicio" class="form-control" value="{{$promocao->data_inicio_ajustada}}" required>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="data_fim">Data Fim</label>
                                <input type="date" name="data_fim" id="data_fim" class="form-control" value="{{$promocao->data_fim_ajustada}}">
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="situacao">Situação</label>
                                <select id="situacao" name="situacao" class="form-control" required>
                                    <option value="">---</option>
                                    <option value="A" {{($promocao->status == 'A') ? 'selected' : '' }}>Andamento</option>
                                    <option value="F" {{($promocao->status == 'F') ? 'selected' : '' }}>Finalizada</option>
                                </select>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="pontuacao">Pontuação</label>
                                <input type="text" class="form-control" id="pontuacao" name="pontuacao" value="{{$promocao->pontuacao}}" placeholder="Pontuação" required>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="observacao">Nome</label>
                                <textarea class="form-control" id="observacao" name="observacao" placeholder="Observações/Detalhes da Promoção...">{{ $promocao->observacao }}</textarea>
                                <div class="valid-feedback">ok!</div>
                                <div class="invalid-feedback">Inválido!</div>
                            </div>
                        </div>
                    </div>


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
                <button class="btn btn-primary" type="submit">Atualizar Cadastro</button>
            </form>

            <p></p>
            <div class="bg-soft-success p-3 rounded" style="margin-bottom:10px;">
                <h5 class="text-primary font-size-14" style="margin-bottom: 0px;">Marcar Bilhere como Premiado</h5>
            </div>

            <!-- Nav tabs - LISTA - INI -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#ativa" role="tab">
                        <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                        <span class="d-none d-sm-block">Bilhetes Gerados ( <code class="highlighter-rouge">{{$bilhetes->count()}}</code> )
                        </span>
                    </a>
                </li>
            </ul>
            <!-- Nav tabs - LISTA - FIM -->

            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">

            <!-- Nav tabs - LISTA - BILHETES - INI -->
            <div class="tab-pane active" id="ativa" role="tabpanel">
                <table id="dt_bilhetes" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Data Criação</th>
                        <th>Número Sorte</th>
                        <th>Status</th>
                        <th>Encerramento</th>
                        <th style="text-align:center;">Ações</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($bilhetes as $bilhete)
                    <tr>
                        <td>{{$bilhete->user->name}}</td>
                        <td>{{$bilhete->data_criacao_formatada}}</td>
                        <td>{{$bilhete->numero_sorte}}</td>
                        <td>{{$bilhete->status_descricao}}</td>
                        <td>{{$bilhete->data_encerramento_formatada}}</td>
                        <td style="text-align:center;">

                        @can('bilhete_premiado')
                            @if($bilhete->status == 'P' && $promocao->status == 'A')
                                <a href="javascript:;" data-toggle="modal" onclick="bilhetePremiado('{{$promocao->id}}', '{{$bilhete->id}}')"
                                    data-target="#modal-bilhete_premiado"><i class="mdi mdi-alpha-b-circle" style="color: crimson;font-size: 30px" title="Marcar o Bilhete como Premiado ?"></i></a>
                                    <form action="" id="bilheteForm" method="post">
                                    @csrf
                                    @method('put')
                                    </form>
                                    @section('modal_target')"formSubmit();"@endsection
                                    @section('modal_type')@endsection
                                    @section('modal_name')"modal-bilhete_premiado"@endsection
                                    @section('modal_msg_title')Deseja Marcar o Bilhete como Premiado ? @endsection
                                    @section('modal_msg_description')Após a ação de marcação, não será mais permitida QUALQUER alteração, pois o cliente receberá uma notificação que o mesmo foi PREMIADO. @endsection
                                    @section('modal_close')Fechar @endsection
                                    @section('modal_save')Marcar Premiado @endsection
                            @elseif($bilhete->status == 'S')
                                <i class="mdi mdi-alpha-b-circle" style="color: green;font-size: 30px" title="Bilhete PREMIADO"></i>
                            @endif
                        @endcan
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">Nenhum registro encontrado</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Nav tabs - LISTA - BILHETES - FIM -->
            </div>


            <!-- FORMULÁRIO - FIM -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('script-js')
    <!-- Required datatable js -->
    <script src="{{asset('nazox/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('nazox/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('nazox/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('nazox/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
   <!-- Datatable init js -->
    <script src="{{asset('nazox/assets/js/pages/datatables.init.js')}}"></script>

    @if($bilhetes->count() > 0)
        <script>
            var table_AD = $('#dt_bilhetes').DataTable({
                language: {
                    url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
                },
                "order": [[ 0, "asc" ]],
                {{--  columnDefs: [
                    {
                        targets: [ 0 ],
                        visible: false,
                    },
                ],  --}}
            });
        </script>
    @endif


    <script>
       function bilhetePremiado(promocao, bilhete)
       {
            var promocao = promocao;
            var bilhete = bilhete;

            var url = '{{ route('promocao.bilhete_premiado', [':promocao', ':bilhete']) }}';
            url = url.replace(':promocao', promocao);
            url = url.replace(':bilhete', bilhete);
            $("#bilheteForm").attr('action', url);
        }

       function formSubmit()
       {
           $("#bilheteForm").submit();
       }

    </script>

@endsection
