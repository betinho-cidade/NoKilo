<?php

namespace App\Http\Controllers\Painel\Movimento\Report;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Image;
use Carbon\Carbon;


class ReportController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if(Gate::denies('view_report')){
            abort('403', 'Página não disponível');
            //return redirect()->back();
        }

        $user = Auth()->User();

        $franquias = Nota::select("promocao_id","franquia_id",
                                    DB::raw("COUNT(CASE WHEN status = 'P' THEN 1 END) AS pendente"),
                                    DB::raw("COUNT(CASE WHEN status = 'A' THEN 1 END) AS aprovada"),
                                    DB::raw("COUNT(CASE WHEN status = 'R' THEN 1 END) AS reprovada"))
                                    ->groupBy(['promocao_id', 'franquia_id'])
                                    ->get();

        return view('painel.movimento.report.index', compact('user', 'franquias'));
    }




}
