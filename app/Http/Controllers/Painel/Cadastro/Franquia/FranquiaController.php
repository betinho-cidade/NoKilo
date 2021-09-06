<?php

namespace App\Http\Controllers\Painel\Cadastro\Franquia;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Franquia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cadastro\Franquia\CreateRequest;
use App\Http\Requests\Cadastro\Franquia\UpdateRequest;
use Image;
use Carbon\Carbon;


class FranquiaController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_franquia')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $franquias = Franquia::orderBy('nome', 'desc')
                            ->get();

        return view('painel.cadastro.franquia.index', compact('user', 'franquias'));
    }



    public function create()
    {
        if(Gate::denies('create_franquia')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $usuarios = User::join('role_user', 'role_user.user_id', 'users.id')
                        ->join('roles', 'role_user.role_id', 'roles.id')
                        ->where('roles.name', 'Franquia')
                        ->leftJoin('franquias', 'users.id', '=', 'franquias.user_id')
                        ->whereNull('franquias.user_id')
                        ->orderBy('users.id', 'desc')
                        ->select('users.*')
                        ->get();

        return view('painel.cadastro.franquia.create', compact('user', 'usuarios'));
    }



    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_franquia')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $franquia = new Franquia();

            $franquia->user_id = $request->usuario;
            $franquia->nome = $request->nome;
            $franquia->end_cep = $request->end_cep;
            $franquia->end_cidade = $request->end_cidade;
            $franquia->end_uf = $request->end_uf;
            $franquia->end_logradouro = $request->end_logradouro;
            $franquia->end_numero = $request->end_numero;
            $franquia->end_bairro = $request->end_bairro;
            $franquia->end_complemento = $request->end_complemento;

            $franquia->save();

            DB::commit();

        } catch (Exception $ex){

            DB::rollBack();

            $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. " . $ex->getMessage();
        }

        if ($message && $message !='') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);
        } else {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'A Franquia <code class="highlighter-rouge">'. $request->nome .'</code> foi criada com sucesso');
        }

        return redirect()->route('franquia.index');
    }



    public function show(Franquia $franquia)
    {

        if(Gate::denies('edit_franquia')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();


        $usuarios = User::join('role_user', 'role_user.user_id', 'users.id')
                        ->join('roles', 'role_user.role_id', 'roles.id')
                        ->where('roles.name', 'Franquia')
                        ->leftJoin('franquias', 'users.id', '=', 'franquias.user_id')
                        ->whereNull('franquias.user_id')
                        ->orderBy('users.id', 'desc')
                        ->select('users.*')
                        ->get();


        return view('painel.cadastro.franquia.show', compact('user', 'franquia', 'usuarios'));
    }



    public function update(UpdateRequest $request, Franquia $franquia)
    {
        if(Gate::denies('edit_franquia')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $franquia->user_id = $request->usuario;
            $franquia->nome = $request->nome;
            $franquia->end_cep = $request->end_cep;
            $franquia->end_cidade = $request->end_cidade;
            $franquia->end_uf = $request->end_uf;
            $franquia->end_logradouro = $request->end_logradouro;
            $franquia->end_numero = $request->end_numero;
            $franquia->end_bairro = $request->end_bairro;
            $franquia->end_complemento = $request->end_complemento;

            $franquia->save();

            DB::commit();

        } catch (Exception $ex){

            DB::rollBack();

            $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. " . $ex->getMessage();
        }

        if ($message && $message !='') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);
        } else {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'A Franquia <code class="highlighter-rouge">'. $franquia->nome .'</code> foi alterada com sucesso');
        }

        return redirect()->route('franquia.index');
    }



    public function destroy(Franquia $franquia, Request $request)
    {
        if(Gate::denies('delete_franquia')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $franquia_nome = $franquia->nome;

        try {
            DB::beginTransaction();

            $franquia->delete();

            DB::commit();

        } catch (Exception $ex){

            DB::rollBack();

            if(strpos($ex->getMessage(), 'Integrity constraint violation') !== false){
                $message = "Não foi possível excluir o registro, pois existem referências ao mesmo em outros processos.";
            } else{
                $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. ".$ex->getMessage();
            }

        }

        if ($message && $message !='') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);
        } else {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'A Franquia <code class="highlighter-rouge">'. $franquia_nome .'</code> foi excluída com sucesso');
        }

        return redirect()->route('franquia.index');
    }



    public function js_viacep(Request $request)
    {

        if(Gate::denies('view_franquia')){
            abort('403', 'Página não disponível');
        }

        $cep = Str::of($request->cep)->replaceMatches('/[^z0-9]++/', '')->__toString();

        $url = 'https://viacep.com.br/ws/'. $cep .'/json/';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 3);

        $result = curl_exec($ch);

        curl_close($ch);

        $mensagem = json_decode($result,true);

        echo json_encode($mensagem);
    }


}
