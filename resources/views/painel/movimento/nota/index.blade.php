@extends('painel.layout.index')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Notas Fiscais</h4>
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

                <h4 class="card-title">Listagem das Notas Fiscais</h4>
                <p class="card-title-desc"></p>

                <!-- Nav tabs - LISTA - INI -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#pendente" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Notas Pendentes ( <code class="highlighter-rouge">{{$notas->where('status', 'P')->count()}}</code> )
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#aprovada" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Notas Aprovadas ( <code class="highlighter-rouge">{{$notas->where('status', 'A')->count()}}</code> )
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#reprovada" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Notas Reprovadas ( <code class="highlighter-rouge">{{$notas->where('status', 'R')->count()}}</code> )
                            </span>
                        </a>
                    </li>
                </ul>
                <!-- Nav tabs - LISTA - FIM -->

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">

                <!-- Nav tabs - LISTA PENDENTE - INI -->
                <div class="tab-pane active" id="pendente" role="tabpanel">
                    <table id="dt_notas_PD" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Ordenação</th>
                            <th>Cliente</th>
                            <th>Nota</th>
                            <th>Promoção</th>
                            <th>Loja</th>
                            <th>Data Nota</th>
                            <th>Valor</th>
                            <th style="text-align:center;">Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($notas->where('status', 'P') as $nota)
                        <tr>
                            <td>{{$nota->data_nota_ordenacao}}</td>
                            <td>{{$nota->user->name}} - {{ $nota->user->end_cidade}}/{{ $nota->user->end_uf }}</td>
                            <td style="text-align:center;">
                                <a href="{{ route('nota.download', compact('nota')) }}">
                                    <i class="mdi mdi-file-download mdi-18px" style="color: goldenrod;cursor: pointer" title="Download da Nota"></i>
                                </a>
                            </td>
                            <td>{{$nota->promocao->nome}}</td>
                            <td>{{$nota->franquia->nome}} - {{ $nota->franquia->end_cidade}}/{{ $nota->franquia->end_uf }}</td>
                            <td>{{$nota->data_nota_formatada}}</td>
                            <td>{{$nota->valor_nota}}</td>
                            <td style="text-align:center;">

                            @can('edit_nota')
                                <a href="{{route('nota.show', compact('nota'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar a Nota Fiscal"></i></a>
                            @endcan

                            @can('delete_nota')
                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$nota->id}})"
                                    data-target="#modal-delete-nota"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir a Nota Fiscal"></i></a>
                                    <form action="" id="deleteForm" method="post">
                                    @csrf
                                    @method('DELETE')
                                    </form>
                                    @section('modal_target')"formSubmit();"@endsection
                                    @section('modal_type')@endsection
                                    @section('modal_name')"modal-delete-nota"@endsection
                                    @section('modal_msg_title')Deseja excluir o registro ? @endsection
                                    @section('modal_msg_description')O registro selecionado será excluído definitivamente, BEM COMO TODOS seus relacionamentos. @endsection
                                    @section('modal_close')Fechar @endsection
                                    @section('modal_save')Excluir @endsection
                            @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">Nenhum registro encontrado</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Nav tabs - LISTA PENDENTE - FIM -->

                <!-- Nav tabs - LISTA APROVADA - INI -->
                <div class="tab-pane" id="aprovada" role="tabpanel">
                    <table id="dt_notas_AP" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Ordenação</th>
                            <th>Cliente</th>
                            <th>Nota</th>
                            <th>Promoção</th>
                            <th>Loja</th>
                            <th>Data Nota</th>
                            <th>Valor</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($notas->where('status', 'A') as $nota)
                        <tr>
                            <td>{{$nota->data_nota_ordenacao}}</td>
                            <td>{{$nota->user->name}} - {{ $nota->user->end_cidade}}/{{ $nota->user->end_uf }}</td>
                            <td style="text-align:center;">
                                <a href="{{ route('nota.download', compact('nota')) }}">
                                    <i class="mdi mdi-file-download mdi-18px" style="color: goldenrod;cursor: pointer" title="Download da Nota"></i>
                                </a>
                            </td>
                            <td>{{$nota->promocao->nome}}</td>
                            <td>{{$nota->franquia->nome}} - {{ $nota->franquia->end_cidade}}/{{ $nota->franquia->end_uf }}</td>
                            <td>{{$nota->data_nota_formatada}}</td>
                            <td>{{$nota->valor_nota}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">Nenhum registro encontrado</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Nav tabs - LISTA APROVADA - FIM -->

                <!-- Nav tabs - LISTA REPROVADA - INI -->
                <div class="tab-pane" id="reprovada" role="tabpanel">
                    <table id="dt_notas_RP" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Ordenação</th>
                            <th>Cliente</th>
                            <th>Nota</th>
                            <th>Promoção</th>
                            <th>Loja</th>
                            <th>Motivo</th>
                            <th style="text-align:center;">Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($notas->where('status', 'R') as $nota)
                        <tr>
                            <td>{{$nota->data_nota_ordenacao}}</td>
                            <td>{{$nota->user->name}} - {{ $nota->user->end_cidade}}/{{ $nota->user->end_uf }}</td>
                            <td style="text-align:center;">
                                <a href="{{ route('nota.download', compact('nota')) }}">
                                    <i class="mdi mdi-file-download mdi-18px" style="color: goldenrod;cursor: pointer" title="Download da Nota"></i>
                                </a>
                            </td>
                            <td>{{$nota->promocao->nome}}</td>
                            <td>{{$nota->franquia->nome}} - {{ $nota->franquia->end_cidade}}/{{ $nota->franquia->end_uf }}</td>
                            <td title="{{$nota->motivo_reprovacao}}">{{$nota->motivo_reprovacao_resumida}}</td>
                            <td style="text-align:center;">

                            @can('edit_nota')
                                <a href="{{route('nota.show', compact('nota'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar a Nota Fiscal"></i></a>
                            @endcan

                            @can('delete_nota')
                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$nota->id}})"
                                    data-target="#modal-delete-nota"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir a Nota Fiscal"></i></a>
                                    <form action="" id="deleteForm" method="post">
                                    @csrf
                                    @method('DELETE')
                                    </form>
                                    @section('modal_target')"formSubmit();"@endsection
                                    @section('modal_type')@endsection
                                    @section('modal_name')"modal-delete-nota"@endsection
                                    @section('modal_msg_title')Deseja excluir o registro ? @endsection
                                    @section('modal_msg_description')O registro selecionado será excluído definitivamente, BEM COMO TODOS seus relacionamentos. @endsection
                                    @section('modal_close')Fechar @endsection
                                    @section('modal_save')Excluir @endsection
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
                <!-- Nav tabs - LISTA REPROVADA - FIM -->


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

    @if($notas->where('status', 'P')->count() > 0)
        <script>
            var table_PD = $('#dt_notas_PD').DataTable({
                language: {
                    url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
                },
                "order": [[ 0, "desc" ]],
                columnDefs: [
                    {
                        targets: [ 0 ],
                        visible: false,
                    },
                ],
            });
        </script>
    @endif

    @if($notas->where('status', 'A')->count() > 0)
        <script>
            var table_PD = $('#dt_notas_AP').DataTable({
                language: {
                    url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
                },
                "order": [[ 0, "desc" ]],
                columnDefs: [
                    {
                        targets: [ 0 ],
                        visible: false,
                    },
                ],
            });
        </script>
    @endif

    @if($notas->where('status', 'R')->count() > 0)
        <script>
            var table_PD = $('#dt_notas_RP').DataTable({
                language: {
                    url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
                },
                "order": [[ 0, "desc" ]],
                columnDefs: [
                    {
                        targets: [ 0 ],
                        visible: false,
                    },
                ],
            });
        </script>
    @endif

    <script>
       function deleteData(id)
       {
           var id = id;
           var url = '{{ route("nota.destroy", ":id") }}';
           url = url.replace(':id', id);
           $("#deleteForm").attr('action', url);
       }

       function formSubmit()
       {
           $("#deleteForm").submit();
       }
    </script>

@endsection
