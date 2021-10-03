@extends('painel.layout.index')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Pontuações e Bilhetes Gerados</h4>
            @can('create_nota')
                <div class="page-title-right">
                    <a href="{{route("nota.create")}}" class="btn btn-outline-secondary waves-effect">Nova Nota Fiscal</a>
                </div>
            @endcan
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

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Minha lista de Pontos e Bilhetes Gerados</h4>
                <p class="card-title-desc"></p>

                <!-- Nav tabs - LISTA - INI -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#ativa" role="tab">
                            <span class="d-block d-sm-none"></span>
                            <span class="d-sm-block">Score
                            </span>
                        </a>
                    </li>
                </ul>
                <!-- Nav tabs - LISTA - FIM -->

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">

                <!-- Nav tabs - LISTA PENDENTE - INI -->
                <div class="tab-pane active" id="ativa" role="tabpanel">
                    <table id="dt_score" class="table table-striped table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Promoção</th>
                            <th>Cliente</th>
                            <th>Pontuação</th>
                            <th>Bilhetes</th>
                            <th>Status</th>
                            <th>Premiado ?</th>
                            <th style="text-align:center;">Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($scores as $score)
                        <tr>
                            <td>{{$score['promocao_nome']}}</td>
                            <td>{{$score['cliente_nome']}} - {{ $score['cliente_cidade']}}/{{ $score['cliente_uf'] }}</td>
                            <td>{{$score['qtd_pontos']}}</td>
                            <td>{{$score['qtd_bilhetes']}}</td>
                            <td>{{$score['promocao_status']}}</td>
                            <td>
                                @if($score['bilhete_premiado'] == 'PREMIADO')
                                    <span class="avatar-title bg-success">
                                        {{$score['bilhete_premiado']}}
                                    </span>
                                @else
                                    {{$score['bilhete_premiado']}}
                                @endif
                            </td>
                            <td style="text-align:center;">

                            @can('view_score')
                                @php $cliente = $score['cliente']; $promocao = $score['promocao']; @endphp
                                <a href="{{route('score.show', compact('promocao', 'cliente'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Visualizar os detalhes da Pontuação"></i></a>
                            @endcan

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">Nenhum registro encontrado</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Nav tabs - LISTA PENDENTE - FIM -->

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

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

    @if(count($scores) > 0)
        <script>
            var table_AT = $('#dt_score').DataTable({
                language: {
                    url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
                },
                "order": [[ 4, "asc" ], [ 0, "asc" ], [ 1, "asc" ]],
            });
        </script>
    @endif


@endsection
