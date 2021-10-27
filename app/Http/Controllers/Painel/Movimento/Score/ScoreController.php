<?php

namespace App\Http\Controllers\Painel\Movimento\Score;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Promocao;
use App\Models\Ponto;
use App\Models\Bilhete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Movimento\Nota\CreateRequest;
use App\Http\Requests\Movimento\Nota\UpdateRequest;
use Image;
use Carbon\Carbon;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class ScoreController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        if(Gate::denies('view_score')){
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

        $clientes = User::join('notas','users.id','=','notas.user_id')
                        ->where('notas.status', 'A')
                        ->where(function($query) use ($data){
                            if ($data['role'] == 'Cliente') {
                                $query->where('notas.user_id', $data['user_id']);

                            } else if (($data['role'] == 'Franquia') && ($data['franquia_id'])) {
                                $query->where('notas.franquia_id', $data['franquia_id']);

                            } else if($data['role'] == 'Gestor') {
                                return null;

                            } else {
                                $query->where('notas.franquia_id', '-0');
                            }
                        })
                        ->join('promocaos','notas.promocao_id','=','promocaos.id')
                        ->select('promocaos.id as promocao_id', 'promocaos.nome as promocao_nome', 'users.id as user_id', 'users.name as user_nome', 'users.end_cidade as user_cidade', 'users.end_uf as user_uf')
                        ->groupBy('promocaos.id', 'promocaos.nome', 'users.id', 'users.name', 'users.end_cidade', 'users.end_uf')
                        ->orderBy('promocaos.nome')
                        ->orderBy('users.name')
                        ->paginate(300);

        $scores = [];
        $cont = 0;
        foreach($clientes as $cliente){

            $user_cliente = User::where('id', $cliente->user_id)->first();

            $promocao = Promocao::where('id', $cliente->promocao_id)->first();

            $qtd_pontos = Ponto::whereIn('nota_id',$user_cliente->notas->where('promocao_id', $cliente->promocao_id)->where('status', 'A')->pluck('id'))
                                 ->sum('quantidade');

            $qtd_bilhetes = $user_cliente->bilhetes->where('promocao_id',$cliente->promocao_id)
                                                    ->count();

            $status_bilhetes = $user_cliente->bilhetes->where('promocao_id',$cliente->promocao_id);

            $bilhete_premiado = '---';

            if(count($status_bilhetes) > 0) {
                if($status_bilhetes->where('status', 'S')->count() > 0) {
                    $bilhete_premiado = 'PREMIADO';

                }else if($status_bilhetes->whereNotNull('data_encerramento')->count() > 0){
                    $bilhete_premiado = 'Não foi desta vez';

                }
            }


            $scores[$cont]['promocao'] = $promocao;
            $scores[$cont]['promocao_nome'] = $cliente->promocao_nome;
            $scores[$cont]['promocao_status'] = $promocao->status_descricao;
            $scores[$cont]['bilhete_premiado'] = $bilhete_premiado;
            $scores[$cont]['cliente'] = $user_cliente;
            $scores[$cont]['cliente_nome'] = $cliente->user_nome;
            $scores[$cont]['cliente_cidade'] = $cliente->user_cidade;
            $scores[$cont]['cliente_uf'] = $cliente->user_uf;
            $scores[$cont]['qtd_pontos'] = $qtd_pontos;
            $scores[$cont]['qtd_bilhetes'] = $qtd_bilhetes;
            $cont++;
        }

        $score_promocaos =  Bilhete::join('promocaos', 'bilhetes.promocao_id', 'promocaos.id')
                                    ->groupBy('promocaos.nome')
                                    ->select('promocaos.nome', DB::raw('count(bilhetes.numero_sorte) as qtd_bilhetes'))
                                    ->get();


        $scores= $this->paginate($scores, $clientes->perPage(), $clientes->currentPage(), $clientes->getOptions(), $clientes->total());//

        return view('painel.movimento.score.index', compact('user', 'scores', 'score_promocaos'));
    }



    public function show(Promocao $promocao, User $cliente, Request $request)
    {
        if(Gate::denies('view_score')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $roles = $user->roles;

        if($roles->first()->name == 'Cliente' && $user->id != $cliente->id){
            abort('403', 'Página não disponível');

        } else if($roles->first()->name == 'Franquia'
                   && (!$user->franquia
                   || !in_array($user->franquia->id, $cliente->notas->where('status', 'A')->pluck('franquia_id')->toArray())) ){
            abort('403', 'Página não disponível');
        }

        $pontos = Ponto::whereIn('nota_id',$cliente->notas->where('promocao_id', $promocao->id)->where('status', 'A')->pluck('id'))
                        ->get();

        $bilhetes = $cliente->bilhetes->where('promocao_id',$promocao->id);

        $nome_cliente = $cliente->name;

        return view('painel.movimento.score.show', compact('user', 'pontos', 'bilhetes', 'promocao', 'nome_cliente'));
    }



    public function paginate($items, $perPage = 1, $page = null, $options = [], $total)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage(1, $perPage), $total, $perPage, $page, $options);
    } //$items->count()

}
