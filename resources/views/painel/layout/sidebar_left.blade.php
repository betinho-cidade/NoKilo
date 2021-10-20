            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->

                        <ul class="metismenu list-unstyled" id="side-menu">


                            @if($user->roles->contains('name', 'Gestor'))
                            <!-- Menus Relacioandos a administração - Acesso somente para GESTOR - INICIO-->

                            <li class="menu-title">GESTÃO</li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ri-store-2-line"></i>
                                    <span>Cadastros</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('usuario.index') }}">Usuários</a></li>
                                    <li><a href="{{ route('franquia.index') }}">Franquias</a></li>
                                    <li><a href="{{ route('promocao.index') }}">Promoções</a></li>
                                </ul>
                            </li>
                            {{--  <li>
                                <a href="{{route('tipo_solicitacao.index')}}" class="waves-effect">
                                    <i class="ri-file-user-line"></i>
                                    <span>Tipos de Solicitação</span>
                                </a>
                            </li>  --}}
                            <!-- Menus Relacioandos a administração - Acesso somente para GESTOR - FIM-->
                            @endif


                            {{--  @if($user->roles->contains('name', 'Gestor'))  --}}
                            <!-- Menus Relacioandos aos movimentos - INICIO-->

                            <li class="menu-title">MOVIMENTAÇÃO</li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="ri-store-2-line"></i>
                                    <span>Notas / Bilhetes</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{ route('nota.index') }}">Notas Fiscais</a></li>
                                    <li><a href="{{ route('score.index') }}">Pontos / Bilhetes Gerados</a></li>
                                    @if($user->roles->contains('name', 'Gestor'))
                                        <li><a href="{{ route('report.index') }}">Franquia x Notas</a></li>
                                    @endif
                                </ul>
                            </li>
                            {{--  <li>
                                <a href="{{route('tipo_solicitacao.index')}}" class="waves-effect">
                                    <i class="ri-file-user-line"></i>
                                    <span>Tipos de Solicitação</span>
                                </a>
                            </li>  --}}
                            <!-- Menus Relacioandos aos movimentos - FIM-->
                            {{--  @endif  --}}

                        </ul>

                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
