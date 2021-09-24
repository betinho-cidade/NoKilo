<?php

namespace App\Http\Controllers\Painel\Cadastro\Promocao;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Promocao;
use App\Models\Bilhete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cadastro\Promocao\CreateRequest;
use App\Http\Requests\Cadastro\Promocao\UpdateRequest;
use Carbon\Carbon;
use App\Mail\SendPremiado;
use Illuminate\Support\Facades\Mail;

class PromocaoController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_promocao')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $promocaos_AD = Promocao::where('status','A')
                                ->get();


        $promocaos_FN = Promocao::where('status','F')
                                ->get();


        return view('painel.cadastro.promocao.index', compact('user', 'promocaos_AD', 'promocaos_FN'));
    }



    public function create()
    {
        if(Gate::denies('create_promocao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();


        return view('painel.cadastro.promocao.create', compact('user'));
    }



    public function store(CreateRequest $request)
    {
        if(Gate::denies('create_promocao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $promocao = new Promocao();

            $promocao->nome = $request->nome;
            $promocao->observacao = $request->observacao;
            $promocao->data_inicio = $request->data_inicio;
            $promocao->data_fim = $request->data_fim;
            $promocao->status = $request->situacao;
            $promocao->pontuacao = $request->pontuacao;

            $promocao->save();

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
            $request->session()->flash('message.content', 'A Promoção <code class="highlighter-rouge">'. $request->nome .'</code> foi criada com sucesso');
        }

        return redirect()->route('promocao.index');
    }



    public function show(Promocao $promocao)
    {

        if(Gate::denies('edit_promocao')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $bilhetes = $promocao->bilhetes;


        return view('painel.cadastro.promocao.show', compact('user', 'promocao', 'bilhetes'));
    }



    public function update(UpdateRequest $request, Promocao $promocao)
    {
        if(Gate::denies('edit_promocao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        try {

            DB::beginTransaction();

            $promocao->nome = $request->nome;
            $promocao->observacao = $request->observacao;
            $promocao->data_inicio = $request->data_inicio;
            $promocao->data_fim = $request->data_fim;
            $promocao->status = $request->situacao;
            $promocao->pontuacao = $request->pontuacao;

            $promocao->save();

            if($promocao->status == 'F'){

                $promocao->data_fim = ($promocao->data_fim) ? $promocao->data_fim : Carbon::now();
                $promocao->save();

                Bilhete::where('promocao_id', $promocao->id)
                        ->whereNull('data_encerramento')
                        ->update([
                            'data_encerramento' => Carbon::now()
                        ]);

                Bilhete::where('promocao_id', $promocao->id)
                        ->where('status', 'P')
                        ->update([
                            'status' => 'N'
                        ]);
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
            $request->session()->flash('message.content', 'A Promoção <code class="highlighter-rouge">'. $promocao->nome .'</code> foi alterada com sucesso');
        }

        return redirect()->route('promocao.index');
    }



    public function destroy(Promocao $promocao, Request $request)
    {
        if(Gate::denies('delete_promocao')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';
        $promocao_nome = $promocao->nome;

        try {
            DB::beginTransaction();

            $promocao->delete();

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
            $request->session()->flash('message.content', 'A Promoção <code class="highlighter-rouge">'. $promocao_nome .'</code> foi excluída com sucesso');
        }

        return redirect()->route('promocao.index');
    }


    public function bilhete_premiado(Promocao $promocao, Bilhete $bilhete, Request $request){

        if(Gate::denies('bilhete_premiado')){
            abort('403', 'Página não disponível');
        }

        $user = Auth()->User();

        $message = '';

        if($promocao->status == 'F'){
            $message = 'Não foi possível PREMIAR o bilhete, pois a promoção "'.strToUpper($promocao->nome).'" já foi finalizada';
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('promocao.show', compact('promocao'));
        }

        try {
            DB::beginTransaction();

            $bilhete->status = 'S';

            $bilhete->save();

            DB::commit();

            try{
                Mail::to($bilhete->user->email)->send(new SendPremiado($bilhete));
            } catch(Exception $ex)
            {}

        } catch (Exception $ex){

            DB::rollBack();

            $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. ".$ex->getMessage();
        }

        if ($message && $message !='') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);
        } else {
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'O Bilhete <code class="highlighter-rouge">'. $bilhete->numero_sorte .'</code> foi marcado como PREMIADO');
        }

        return redirect()->route('promocao.show', compact('promocao'));

    }

}
