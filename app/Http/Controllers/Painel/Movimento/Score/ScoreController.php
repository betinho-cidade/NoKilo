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


class ScoreController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
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
                                $query->where('user_id', $data['user_id']);

                            } else if (($data['role'] == 'Franquia') && ($data['franquia_id'])) {
                                $query->where('franquia_id', $data['franquia_id']);

                            } else if($data['role'] == 'Gestor') {
                                return null;

                            } else {
                                $query->where('franquia_id', '-0');
                            }
                        })
                        ->join('promocaos','notas.promocao_id','=','promocaos.id')
                        ->select('promocaos.id as promocao_id', 'promocaos.nome as promocao_nome', 'users.id as user_id', 'users.name as user_nome')
                        ->groupBy('promocaos.id', 'promocaos.nome', 'users.id', 'users.name')
                        ->orderBy('promocaos.nome')
                        ->orderBy('users.name')
                        ->get();

        $scores = [];
        $cont = 0;
        foreach($clientes as $cliente){

            $user = User::where('id', $cliente->user_id)->first();

            $promocao = Promocao::where('id', $cliente->promocao_id)->first();

            $qtd_pontos = Ponto::whereIn('nota_id',$user->notas->where('promocao_id', $cliente->promocao_id)->where('status', 'A')->pluck('id'))
                                 ->sum('quantidade');

            $qtd_bilhetes = $user->bilhetes->where('promocao_id',$cliente->promocao_id)
                                    ->count();

            $status_bilhetes = $user->bilhetes->where('promocao_id',$cliente->promocao_id)
                                               ->whereNotNull('data_sorteio');

            $bilhete_premiado = (count($status_bilhetes) > 0) ? (($status_bilhetes->where('status', 'S')->count() > 0) ? 'PREMIADO' : 'Não foi desta vez') : '---';

            $scores[$cont]['promocao'] = $promocao;
            $scores[$cont]['promocao_nome'] = $cliente->promocao_nome;
            $scores[$cont]['promocao_status'] = $promocao->status_descricao;
            $scores[$cont]['bilhete_premiado'] = $bilhete_premiado;
            $scores[$cont]['cliente'] = $user;
            $scores[$cont]['cliente_nome'] = $cliente->user_nome;
            $scores[$cont]['qtd_pontos'] = $qtd_pontos;
            $scores[$cont]['qtd_bilhetes'] = $qtd_bilhetes;
            $cont++;
        }

        return view('painel.movimento.score.index', compact('user', 'scores'));
    }


}
