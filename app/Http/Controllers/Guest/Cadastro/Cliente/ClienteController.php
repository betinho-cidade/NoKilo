<?php

namespace App\Http\Controllers\Guest\Cadastro\Cliente;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Guest\Cadastro\Cliente\CreateRequest;
use Image;
use App\Mail\SendCadastro;
use Illuminate\Support\Facades\Mail;



class ClienteController extends Controller
{


    public function create(Request $request)
    {
        Auth()->logout();

        return view('guest.cadastro.cliente.create');
    }


    public function store(CreateRequest $request)
    {

        $message = '';

        try {

            DB::beginTransaction();

            $usuario = new User();

            $usuario->name = $request->nome;
            $usuario->cpf = $request->cpf;
            $usuario->celular = $request->celular;
            $usuario->data_nascimento = $request->data_nascimento;
            $usuario->end_cep = $request->end_cep;
            $usuario->end_cidade = $request->end_cidade;
            $usuario->end_uf = $request->end_uf;
            $usuario->end_logradouro = $request->end_logradouro;
            $usuario->end_numero = $request->end_numero;
            $usuario->end_bairro = $request->end_bairro;
            $usuario->end_complemento = $request->end_complemento;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password);

            $usuario->save();

            $perfil = Role::where('name', 'Cliente')->first('id');

            $usuario->rolesAll()->attach($perfil);

            $status = $usuario->rolesAll()
                              ->withPivot(['status'])
                              ->first()
                              ->pivot;

            $status['status'] = 'A';
            $status->save();

            DB::commit();

            try{
                Mail::to($usuario->email)->send(new SendCadastro($usuario));
            } catch(Exception $ex)
            {}

        } catch (Exception $ex){

            DB::rollBack();

            $message = "Erro desconhecido, por gentileza, entre em contato com o administrador. " . $ex->getMessage();
        }

        if ($message && $message !='') {
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', $message);

            return redirect()->route('cliente.create')->withInput();

        } else {
            $request->session()->flash('message.token', $request->_token);
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', '<code class="highlighter-rouge">'. strtoupper($request->nome) .'</code>, seu cadastro foi criado com sucesso');
        }

        return redirect()->route('cliente.bemvindo', ['token' => $request->_token]);
    }


    public function bemvindo(Request $request)
    {

        if($request->token && session()->has('message.token') && ($request->token === session('message.token'))){

            return view('guest.cadastro.cliente.bemvindo');

        } else{

            Auth()->logout();
            return redirect()->route('login');
        }
    }


    public function js_viacep_new(Request $request)
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
