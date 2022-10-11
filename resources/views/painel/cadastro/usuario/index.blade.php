@extends('painel.layout.index')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Usuários do Sistema</h4>

            <div class="page-title-right">
                <a href="{{route("usuario.create")}}" class="btn btn-outline-secondary waves-effect">Novo Usuário</a>
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

                <form id="search_user" action="{{route('usuario.search')}}" method="GET">
                    @csrf

                    <span class="float-right">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="%nome%">
                        </div>

                        <div class="col-md-3">
                            <select id="perfil" name="perfil" class="form-control dynamic">
                                <option value="">---</option>
                                <option value="T">Todos</option>
                                <option value="G">Gestor</option>
                                <option value="F">Franquia</option>
                                <option value="C">Cliente</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                                <select id="situacao" name="situacao" class="form-control dynamic">
                                    <option value="A">Ativo</option>
                                    <option value="I">Inativo</option>
                                </select>
                        </div>

                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Filtrar</button>
                        </div>
                    </div>
                    </span>
                </form>

                <h4 class="card-title">Listagem dos Usuários Registrados no Sistema</h4>

                @php $count = 0; @endphp
                <span style="font-size:12px;">
                @if($search)
                    @foreach ($search as $param=>$value )
                        @if($value)
                            @if($count == 0)
                                <code>Filtro:</code>
                            @endif
                            <code>[{{ $param }}:{{ $value }}]&nbsp;</code>
                            @php $count = $count + 1; @endphp
                        @endif
                    @endforeach
                    <p></p>
                @endif
                </sapn>

                <!-- Nav tabs - LISTA USUARIO - INI -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#ativa" role="tab">
                            <span class="d-block d-sm-none"><i class="ri-checkbox-circle-line"></i></span>
                            <span class="d-none d-sm-block">Usuários ( <code class="highlighter-rouge">{{($users) ? $users->count() : 0}}</code> )</span>
                        </a>
                    </li>
                    @if($users)
                        <span class="float-right" style="font-size: 12px;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Registros: {{ ($users->lastItem()) ? $users->lastItem() : 0}} / {{ $users->total() }} &nbsp;&nbsp;&nbsp;
                            Página: {{ $users->currentPage() }} / {{ $users->lastPage() }} &nbsp;&nbsp;&nbsp;
                            @if($users->previousPageUrl()) <a href="{{ $users->previousPageUrl() . '&' . http_build_query($search)}}"> <i class="mdi mdi-skip-previous" style="font-size: 16px;" title="Anterior"></i>  </a> @else <i class="mdi mdi-dots-horizontal" style="font-size: 16px;" title="..."></i> @endif
                            @if($users->hasMorePages()) <a href="{{ $users->nextPageUrl() . '&' . http_build_query($search)}}"> <i class="mdi mdi-skip-next" style="font-size: 16px;" title="Próximo"></i>  </a> @else <i class="mdi mdi-dots-horizontal" style="font-size: 16px;" title="..."></i> @endif
                        </span>
                        <br>
                    @endif
                </ul>
                <!-- Nav tabs - LISTA USUARIO - FIM -->

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">

                <!-- Nav tabs - LISTA USUÁRIO - ATIVA - INI -->
                <div class="tab-pane active" id="ativa" role="tabpanel">
                    <table id="dt_users" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Login</th>
                            <th style="text-align:center;">Perfil</th>
                            <th style="text-align:center;">Privacidade</th>
                            <th style="text-align:center;">Marketing</th>
                            <th style="text-align:center;">Ações</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($users)
                            @forelse($users as $usuario)
                            <tr>
                                <td>{{$usuario->name}} - {{ $usuario->end_cidade}}/{{ $usuario->end_uf }}</td>
                                <td>{{$usuario->email}}</td>
                                <td style="text-align:center;">{{$usuario->perfil}}</td>
                                <td style="text-align:center;">{{$usuario->termo_privacidade}}</td>
                                <td style="text-align:center;">{{$usuario->marketing}}</td>
                                <td style="text-align:center;">

                                @can('edit_usuario')
                                    <a href="{{route('usuario.show', compact('usuario'))}}"><i class="fa fa-edit" style="color: goldenrod" title="Editar o Usuário"></i></a>
                                @endcan

                                @can('delete_usuario')
                                    <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$usuario->id}})"
                                        data-target="#modal-delete-usuario"><i class="fa fa-minus-circle" style="color: crimson" title="Excluir o Usuário"></i></a>
                                        <form action="" id="deleteForm" method="post">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        @section('modal_target')"formSubmit();"@endsection
                                        @section('modal_type')@endsection
                                        @section('modal_name')"modal-delete-usuario"@endsection
                                        @section('modal_msg_title')Deseja excluir o registro ? @endsection
                                        @section('modal_msg_description')O registro selecionado será excluído definitivamente, BEM COMO TODOS seus relacionamentos. @endsection
                                        @section('modal_close')Fechar @endsection
                                        @section('modal_save')Excluir @endsection
                                @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">Nenhum registro encontrado. Escolha uma opção no filtro ao lado.</td>
                            </tr>
                            @endforelse
                        @else
                            <tr>
                                <td colspan="6">Nenhum registro encontrado. Escolha uma opção no filtro ao lado.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <!-- Nav tabs - LISTA USUARIO - ATIVA - FIM -->
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

    <script src="{{asset('nazox/assets/js/pages/form-validation.init.js')}}"></script>

    @if($users && $users->count() > 0)
        <script>
            var table_AT = $('#dt_users').DataTable({
                language: {
                    url: '{{asset('nazox/assets/localisation/pt_br.json')}}'
                },
                "order": [[ 0, "desc" ]]
            });
        </script>
    @endif

    <script>
       function deleteData(id)
       {
           var id = id;
           var url = '{{ route("usuario.destroy", ":id") }}';
           url = url.replace(':id', id);
           $("#deleteForm").attr('action', url);
       }

       function formSubmit()
       {
           $("#deleteForm").submit();
       }
    </script>

@endsection
