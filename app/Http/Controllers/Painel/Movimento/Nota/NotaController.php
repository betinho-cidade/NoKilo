<?php

namespace App\Http\Controllers\Painel\Movimento\Nota;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Nota;
use App\Models\Ponto;
use App\Models\Bilhete;
use App\Models\Franquia;
use App\Models\Promocao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Movimento\Nota\CreateRequest;
use App\Http\Requests\Movimento\Nota\UpdateRequest;
use Image;
use Carbon\Carbon;


class NotaController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_nota')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $roles = $user->roles;

        $data = [
            'user_id' => $user->id,
            'role' => $roles->first()->name,
            'franquia_id' => $user->franquia->id ?? null,
        ];

        $notas = Nota::where(function($query) use ($data){

            if ($data['role'] == 'Cliente') {
                $query->where('user_id', $data['user_id']);

            } else if (($data['role'] == 'Franquia') && ($data['franquia_id'])) {
                $query->where('franquia_id', $data['franquia_id']);

            } else if($data['role'] == 'Gestor') {
                return null;

            } else {
                $query->where('franquia_id', '-0');
            }
        })
        ->get();


        return view('painel.movimento.nota.index', compact('user', 'notas'));
    }



    public function create()
    {
        if(Gate::denies('create_nota')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $franquias = Franquia::all();

        $promocaos = Promocao::where('status', 'A')->get();


        return view('painel.movimento.nota.create', compact('user', 'franquias', 'promocaos'));
    }



    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_nota')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $roles = $user->roles;

        if($roles->first()->name != 'Cliente'){
            abort('403', 'Página não disponível');
        }

        $message = '';

        try {

            DB::beginTransaction();

            $nota = new Nota();

            $nota->user_id = $user->id;
            $nota->promocao_id = $request->promocao;
            $nota->franquia_id = $request->franquia;
            $nota->status = 'P';
            $nota->path_nota = '';

            $nota->save();

            if ($request->path_nota) {

                $nome_arquivo = 'NF_'.time().'.'.$request->path_nota->getClientOriginalExtension();
                $path_nota = 'notas/' . $user->id;

                $nota->path_nota = $nome_arquivo;

                $request->path_nota->storeAs($path_nota, $nome_arquivo);

                $nota->save();
            }

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
            $request->session()->flash('message.content', 'A Nota registrada em <code class="highlighter-rouge">'. $request->data_criacao_formatada .'</code> foi criada com sucesso');
        }

        return redirect()->route('nota.index');
    }



    public function show(Nota $nota)
    {

        if(Gate::denies('edit_nota')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $roles = $user->roles;

        if($roles->first()->name == 'Cliente'){
            abort('403', 'Página não disponível');

        } else if($roles->first()->name == 'Franquia' && (!$user->franquia || $user->franquia->id != $nota->franquia_id) ){
            abort('403', 'Página não disponível');
        }

        $franquias = Franquia::all();

        return view('painel.movimento.nota.show', compact('user', 'nota', 'franquias'));
    }


    public function update(UpdateRequest $request, Nota $nota)
    {
        if(Gate::denies('edit_nota')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $roles = $user->roles;

        if($roles->first()->name == 'Cliente'){
            abort('403', 'Página não disponível');

        } else if($roles->first()->name == 'Franquia' && (!$user->franquia || $user->franquia->id != $nota->franquia_id) ){
            abort('403', 'Página não disponível');

        } else if($nota->status =='A'){
            abort('403', 'Página não disponível');
        }

        $message = '';

        try {

            DB::beginTransaction();

            $nota->franquia_id = $request->franquia;
            $nota->status = $request->situacao;
            $nota->data_nota = $request->data_nota;
            $nota->valor = $request->valor;

            $nota->save();

            if($nota->status == 'R'){
                $nota->motivo_reprovacao = $request->motivo_reprovacao;
                $nota->save();

            } else if($nota->status == 'A'){

                $pontuacao = intval($nota->valor);

                $ponto = new Ponto();

                $ponto->nota_id = $nota->id;
                $ponto->quantidade = $pontuacao;

                $ponto->save();

                $qtd_pontos = Ponto::whereIn('nota_id',$nota->user->notas->where('promocao_id', $nota->promocao_id)->where('status', 'A')->pluck('id'))
                                     ->sum('quantidade');

                $qtd_bilhetes = Bilhete::where('user_id',$nota->user_id)
                                     ->where('promocao_id',$nota->promocao_id)
                                     ->where('status', 'P')
                                     ->count();

                $pontuacao = $nota->promocao->pontuacao;

                $total_pontos = ($qtd_pontos - ($qtd_bilhetes*$pontuacao));

                if(($total_pontos > 0) && (($total_pontos - $pontuacao) >= 0)){
                    $new_bilhetes = intval($total_pontos/$pontuacao);

                    for ($i=0; $i<$new_bilhetes; $i++){
                        $bilhete = new Bilhete();

                        $bilhete->user_id = $nota->user->id;
                        $bilhete->promocao_id = $nota->promocao->id;
                        $bilhete->status = 'P';
                        $bilhete->numero_sorte = Carbon::now()->format('YmdHisu');

                        $bilhete->save();
                    }
                }
            }

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
            $request->session()->flash('message.content', 'A Nota Fiscal <code class="highlighter-rouge">'. $nota->path_nota .'</code> foi alterada com sucesso');
        }

        return redirect()->route('nota.index');
    }



    public function destroy(Nota $nota, Request $request)
    {
        if(Gate::denies('delete_nota')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $roles = $user->roles;

        if($nota->status == 'A'){
            abort('403', 'Página não disponível');

        }else if($roles->first()->name == 'Franquia'){
            abort('403', 'Página não disponível');

        }else if($roles->first()->name == 'Cliente' && $user->id != $nota->user_id){
            abort('403', 'Página não disponível');
        }

        $message = '';
        $nota_nome = $nota->data_nota_formatada;
        $path_nota = 'notas/'.$nota->user_id;

        try {
            DB::beginTransaction();

            $nota->delete();

            if(\Storage::exists($path_nota)) {
                \Storage::delete($path_nota.'/'.$nota->path_nota);
            }


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
            $request->session()->flash('message.content', 'A Nota registrada em <code class="highlighter-rouge">'. $nota_nome .'</code> foi excluída com sucesso');
        }

        return redirect()->route('nota.index');
    }



    public function download(Nota $nota){

        if(Gate::denies('view_nota')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $roles = $user->roles;

        $data = [
            'user_id' => $user->id,
            'role' => $roles->first()->name,
            'franquia_id' => $user->franquia->id ?? null,
        ];

        $nota = Nota::where(function($query) use ($data){

            if ($data['role'] == 'Cliente') {
                $query->where('user_id', $data['user_id']);

            } else if (($data['role'] == 'Franquia') && ($data['franquia_id'])) {
                $query->where('franquia_id', $data['franquia_id']);

            } else if($data['role'] == 'Gestor') {
                return null;

            } else {
                $query->where('franquia_id', '-0');
            }
        })
        ->where('id', $nota->id)
        ->first();

        if($nota){
            return \Storage::download('notas/'. $nota->user_id . '/' . $nota->path_nota);

        }else{
            abort('403', 'Página não disponível');
        }

    }

}
