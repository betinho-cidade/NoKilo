@extends('painel.layout.index')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Relatório Franquias x Notas - RESUMO</h4>
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

                <h4 class="card-title">Promoção x Franquia x Notas</h4>
                <p class="card-title-desc"></p>

                <!-- Nav tabs - LISTA - INI -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#ativa" role="tab">
                            <span class="d-block d-sm-none"></span>
                            <span class="d-sm-block">Notas
                            </span>
                        </a>
                    </li>
                </ul>
                <!-- Nav tabs - LISTA - FIM -->

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">

                <!-- Nav tabs - LISTA ATIVA - INI -->
                <div class="tab-pane active" id="ativa" role="tabpanel">
                    <table id="dt_franquias" class="table table-striped table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Promoção</th>
                            <th>Franquia</th>
                            <th style="text-align: center">Pendentes</th>
                            <th style="text-align: center">Aprovadas</th>
                            <th style="text-align: center">Reprovadas</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($franquias as $franquia)
                        <tr>
                            <td>{{$franquia->promocao->nome}}</td>
                            <td>{{$franquia->franquia->nome}}</td>
                            <td style="text-align: center">{{$franquia->pendente}}</td>
                            <td style="text-align: center">{{$franquia->aprovada}}</td>
                            <td style="text-align: center">{{$franquia->reprovada}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">Nenhum registro encontrado</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Nav tabs - LISTA ATIVA - FIM -->

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

    @if(count($franquias) > 0)
        <script>
            var table_AT = $('#dt_franquias').DataTable({
                language: {
                    url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
                },
                "order": [[ 0, "asc" ], [ 2, "desc" ], [ 3, "desc" ], [ 1, "asc" ]],
            });
        </script>
    @endif

@endsection
