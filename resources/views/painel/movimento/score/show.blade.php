@extends('painel.layout.index')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Pontuações e Bilhetes Gerados</h4>
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

                <h4 class="card-title">{{$promocao->nome}} - {{$nome_cliente}}</h4>
                <p class="card-title-desc"></p>


                <div class="row">
                    <div class="col-lg-3">
                        <div class="card border border-primary">
                            <div class="card-header bg-transparent border-primary">
                                <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3"></i>Listagem de Pontos</h5>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-6 d-flex justify-content-center"><b>Data Criação</b></div>
                                    <div class="col-6 d-flex justify-content-center"><b>Quantidade</b></div>
                                </div>

                                @forelse($pontos as $ponto)
                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-center">
                                            {{$ponto->data_criacao_formatada}}
                                        </div>
                                        <div class="col-6 d-flex justify-content-center">
                                            {{$ponto->quantidade}}
                                        </div>
                                    </div>
                                @empty
                                    <div class="row">
                                        <div class="col-12">
                                            Nenhum registro encontrado
                                        </div>
                                    </div>
                                @endforelse

                                <p></p>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <b>Total:</b> {{$pontos->sum('quantidade')}} ponto(s)
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="card border border-success">
                            <div class="card-header bg-transparent border-success">
                                <h5 class="my-0 text-success"><i class="mdi mdi-check-all me-3"></i>Listagem de Bilhetes</h5>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-2 d-flex justify-content-center"><b>Data Criação</b></div>
                                    <div class="col-6 d-flex justify-content-left"><b>Número Sorte</b></div>
                                    <div class="col-2 d-flex justify-content-center"><b>Status</b></div>
                                    <div class="col-2 d-flex justify-content-center"><b>Encerramento</b></div>
                                </div>

                                @forelse($bilhetes as $bilhete)
                                    <div class="row">
                                        <div class="col-2 d-flex justify-content-center">
                                            {{$bilhete->data_criacao_formatada}}
                                        </div>
                                        <div class="col-6 d-flex justify-content-left">
                                            {{$bilhete->numero_sorte_formatado}}
                                        </div>
                                        <div class="col-2 d-flex justify-content-center">
                                            @if($bilhete->status_descricao == 'PREMIADO')
                                                <span class="avatar-title bg-success">
                                                    {{$bilhete->status_descricao}}
                                                </span>
                                            @else
                                                {{$bilhete->status_descricao}}
                                            @endif
                                        </div>
                                        <div class="col-2 d-flex justify-content-center">
                                            {{$bilhete->data_encerramento_formatada}}
                                        </div>
                                    </div>
                                @empty
                                    <div class="row">
                                        <div class="col-12">
                                            Nenhum registro encontrado
                                        </div>
                                    </div>
                                @endforelse

                                <p></p>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <b>Quantidade:</b> {{$bilhetes->count()}} bilhete(s)
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection


@section('script-js')
@endsection
