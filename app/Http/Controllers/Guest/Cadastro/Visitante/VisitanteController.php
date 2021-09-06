<?php

namespace App\Http\Controllers\Guest\Cadastro\Visitante;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
use App\Models\SituacaoMembro;
use App\Models\HistoricoSituacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Guest\Visitante\CreateRequest;
use Image;
use Carbon\Carbon;


class VisitanteController extends Controller
{

    public function create()
    {
        return view('guest.cadastro.visitante.create');
    }



    public function store(CreateRequest $request)
    {

        $message = '';

        try {

            DB::beginTransaction();

            $membro = new Membro();

            $membro->nome = $request->nome;
            $membro->email = $request->email_membro;
            $membro->cpf = $request->cpf;
            $membro->sexo = $request->sexo;
            $membro->celular = $request->celular;
            $membro->data_nascimento = $request->data_nascimento;
            $membro->naturalidade = $request->naturalidade;
            $membro->status = 'I';
            $membro->conjuge = $request->conjuge;
            $membro->data_casamento = $request->data_casamento;
            $membro->profissao = $request->profissao;
            $membro->nome_pai = $request->nome_pai;
            $membro->nome_mae = $request->nome_mae;
            $membro->end_cep = $request->end_cep;
            $membro->end_cidade = $request->end_cidade;
            $membro->end_uf = $request->end_uf;
            $membro->end_logradouro = $request->end_logradouro;
            $membro->end_numero = $request->end_numero;
            $membro->end_bairro = $request->end_bairro;
            $membro->end_complemento = $request->end_complemento;
            $membro->estado_civil = $request->estado_civil;
            $membro->escolaridade = $request->escolaridade;
            $membro->tipo_membro = 'NM';
            $membro->data_batismo = $request->data_batismo;
            $membro->pastor_batismo = $request->pastor_batismo;
            $membro->igreja_batismo = $request->igreja_batismo;
            $membro->data_profissao_fe = $request->data_profissao_fe;
            $membro->pastor_profissao_fe = $request->pastor_profissao_fe;
            $membro->igreja_profissao_fe = $request->igreja_profissao_fe;
            $membro->aptidao = $request->aptidao;
            $membro->is_pastor = 'N';
            $membro->is_disciplina = 'N';

            $membro->save();

            $situacao_membro = SituacaoMembro::where('nome', 'Cadastro Site')->first();

            if($situacao_membro) {
                $historico_situacao = new HistoricoSituacao();

                $historico_situacao->membro_id = $membro->id;
                $historico_situacao->situacao_membro_id = $situacao_membro->id;
                $historico_situacao->data_inicio = Carbon::now();
                $historico_situacao->comentario = 'Cadastro realizado pelo Site';

                $historico_situacao->save();
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
            $request->session()->flash('message.content', 'A solicitação de cadastro foi criada com sucesso');
        }

        return view('guest.cadastro.visitante.bemvindo');
    }


    public function js_viacep(Request $request)
    {

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
