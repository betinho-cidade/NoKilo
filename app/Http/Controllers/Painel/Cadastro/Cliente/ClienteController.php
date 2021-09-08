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

}
