@extends('painel.layout.index')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Promoções</h4>

            <div class="page-title-right">
                <a href="{{route("promocao.create")}}" class="btn btn-outline-secondary waves-effect">Nova Promoção</a>
            </div>
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

                <h4 class="card-title">Listagem das Promoções</h4>
                <p class="card-title-desc"></p>

                <!-- Nav tabs - LISTA - INI -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#andamento" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Promoções Andamento ( <code class="highlighter-rouge">{{$promocaos_AD->count()}}</code> )
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#finalizado" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Promoções Finalizadas ( <code class="highlighter-rouge">{{$promocaos_FN->count()}}</code> )
                            </span>
                        </a>
                    </li>
                </ul>
                <!-- Nav tabs - LISTA - FIM -->

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">

                <!-- Nav tabs - LISTA - ANDAMENTO - INI -->
                <div class="tab-pane active" id="andamento" role="tabpanel">
                    <table id="dt_promocaos_andamento" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Ordenação</th>
                            <th>Nome</th>
                            <th>Pontuação</th>
                            <th>Data Início</th>
                            <th>Data Fim</th>
                            <th style="text-align:center;">Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($promocaos_AD as $promocao)
                        <tr>
                            <td>{{$promocao->data_inicio_ordenacao}}</td>
                            <td>{{$promocao->nome}}</td>
                            <td>{{$promocao->pontuacao}}</td>
                            <td>{{$promocao->data_inicio_formatada}}</td>
                            <td>{{$promocao->data_fim_formatada}}</td>
                            <td style="text-align:center;">

                            @can('edit_promocao')
                                <a href="{{route('promocao.show', compact('promocao'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar a Promoção"></i></a>
                            @endcan

                            @can('delete_promocao')
                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$promocao->id}})"
                                    data-target="#modal-delete-promocao"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir a Promoção"></i></a>
                                    <form action="" id="deleteForm" method="post">
                                    @csrf
                                    @method('DELETE')
                                    </form>
                                    @section('modal_target')"formSubmit();"@endsection
                                    @section('modal_type')@endsection
                                    @section('modal_name')"modal-delete-promocao"@endsection
                                    @section('modal_msg_title')Deseja excluir o registro ? @endsection
                                    @section('modal_msg_description')O registro selecionado será excluído definitivamente, BEM COMO TODOS seus relacionamentos. @endsection
                                    @section('modal_close')Fechar @endsection
                                    @section('modal_save')Excluir @endsection
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
                <!-- Nav tabs - LISTA - ANDAMENTO - FIM -->


                <!-- Nav tabs - LISTA - FINALIZADO - INI -->
                <div class="tab-pane" id="finalizado" role="tabpanel">
                    <table id="dt_promocaos_finalizado" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Ordenação</th>
                            <th>Nome</th>
                            <th>Pontuação</th>
                            <th>Data Início</th>
                            <th>Data Fim</th>
                            <th style="text-align:center;">Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($promocaos_FN as $promocao)
                        <tr>
                            <td>{{$promocao->data_inicio_ordenacao}}</td>
                            <td>{{$promocao->nome}}</td>
                            <td>{{$promocao->pontuacao}}</td>
                            <td>{{$promocao->data_inicio_formatada}}</td>
                            <td>{{$promocao->data_fim_formatada}}</td>
                            <td style="text-align:center;">

                            @can('edit_promocao')
                                <a href="{{route('promocao.show', compact('promocao'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar a Promoção"></i></a>
                            @endcan

                            @can('delete_promocao')
                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$promocao->id}})"
                                    data-target="#modal-delete-promocao"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir a Promoção"></i></a>
                                    <form action="" id="deleteForm" method="post">
                                    @csrf
                                    @method('DELETE')
                                    </form>
                                    @section('modal_target')"formSubmit();"@endsection
                                    @section('modal_type')@endsection
                                    @section('modal_name')"modal-delete-promocao"@endsection
                                    @section('modal_msg_title')Deseja excluir o registro ? @endsection
                                    @section('modal_msg_description')O registro selecionado será excluído definitivamente, BEM COMO TODOS seus relacionamentos. @endsection
                                    @section('modal_close')Fechar @endsection
                                    @section('modal_save')Excluir @endsection
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
                <!-- Nav tabs - LISTA - FINALIZADO - FIM -->

                </div>


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

    @if($promocaos_AD->count() > 0)
        <script>
            var table_AD = $('#dt_promocaos_andamento').DataTable({
                language: {
                    url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
                },
                "order": [[ 0, "asc" ]],
                columnDefs: [
                    {
                        targets: [ 0 ],
                        visible: false,
                    },
                ],
            });
        </script>
    @endif

    @if($promocaos_FN->count() > 0)
        <script>
            var table_FN = $('#dt_promocaos_finalizado').DataTable({
                language: {
                    url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
                },
                "order": [[ 0, "asc" ]],
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
           var url = '{{ route("promocao.destroy", ":id") }}';
           url = url.replace(':id', id);
           $("#deleteForm").attr('action', url);
       }

       function formSubmit()
       {
           $("#deleteForm").submit();
       }
    </script>

@endsection
