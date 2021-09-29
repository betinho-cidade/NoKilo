<?php

namespace App\Http\Controllers\Painel\Cadastro\Cliente;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Membro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Cadastro\Cliente\UpdateRequest;
use Image;



class ClienteController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function show(User $user)
    {

        if(Gate::denies('view_cliente')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user_logado = Auth()->User();

        if($user->id != $user_logado->id){
            abort('403', 'Página não disponível');
        }

        return view('painel.cadastro.cliente.show', compact('user'));
    }



    public function update(UpdateRequest $request, User $user)
    {

        if(Gate::denies('edit_cliente')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user_logado = Auth()->User();

        if($user->id != $user_logado->id){
            abort('403', 'Página não disponível');
        }

        $message = '';

        try {

            DB::beginTransaction();

            $user->name = $request->nome;
            $user->cpf = $request->cpf;
            $user->celular = $request->celular;
            $user->data_nascimento = $request->data_nascimento;
            $user->end_cep = $request->end_cep;
            $user->end_cidade = $request->end_cidade;
            $user->end_uf = $request->end_uf;
            $user->end_logradouro = $request->end_logradouro;
            $user->end_numero = $request->end_numero;
            $user->end_bairro = $request->end_bairro;
            $user->end_complemento = $request->end_complemento;
            $user->email = $request->email;

            if($request->password){
                $user->password = bcrypt($request->password);
            }

            $user->save();

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
            $request->session()->flash('message.content', 'Seus dados foram atualizados com sucesso');
        }

        return redirect()->route('painel');
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
