<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;


class PainelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if(Gate::denies('view_painel')){
            return redirect()->route('logout');
        }

        $user = Auth()->User();

        //$search_tools = 'Teste';

        return view('painel.index', compact('user'));
        //return redirect()->route('resultado.index');
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
