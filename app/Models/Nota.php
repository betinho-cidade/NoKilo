<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Nota extends Model
{
    use HasFactory;


    public function getBreadcrumbAttribute()
    {
        $nota = $this->id;

        $bread = '<a href="' . route('nota.index') . '">Lista Franquias</a>';
        $bread .= ' > ';
        $bread .= '<a href="' . route('nota.show', compact('nota')) . '">' . $this->path_nota . '</a>';

        return $bread;
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function promocao()
    {
        return $this->belongsTo('App\Models\Promocao');
    }

    public function franquia()
    {
        return $this->belongsTo('App\Models\Franquia');
    }

    public function pontos()
    {
        return $this->hasMany('App\Models\Ponto');
    }

    public function getDataNotaFormatadaAttribute()
    {
        return ($this->data_nota) ? date('d/m/Y', strtotime($this->data_nota)) : '---';
    }

    public function getDataNotaAjustadaAttribute()
    {
        return ($this->data_nota) ? date('Y-m-d', strtotime($this->data_nota)) : '';
    }

    public function getDataNotaOrdenacaoAttribute()
    {
        return ($this->data_nota) ? date('YmdHis', strtotime($this->data_nota)) : '';
    }

    public function getDataCriacaoFormatadaAttribute()
    {
        return ($this->created_at) ? date('d/m/Y', strtotime($this->created_at)) : '';
    }

    public function getStatusDescricaoAttribute()
    {
        $status = '';

        switch ($this->status) {

            case 'P': {
                    $status = 'Pendente';
                    break;
                }
            case 'A': {
                    $status = 'Aprovada';
                    break;
                }
            case 'R': {
                    $status = 'Reprovada';
                    break;
                }
            default: {
                    $status = '';
                    break;
                }
        }

        return $status;
    }

    public function getValorNotaAttribute(){

        return ($this->valor) ? 'R$ ' . number_format($this->valor, 2, ",", ".") : '---';
    }

    public function getMotivoReprovacaoResumidaAttribute(){

        return ($this->motivo_reprovacao) ? Str::limit($this->motivo_reprovacao, 50, '...') : '...';
    }

}

