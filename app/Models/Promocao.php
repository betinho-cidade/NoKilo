<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocao extends Model
{
    use HasFactory;


    public function getBreadcrumbAttribute()
    {
        $promocao = $this->id;

        $bread = '<a href="' . route('promocao.index') . '">Lista Promoções</a>';
        $bread .= ' > ';
        $bread .= '<a href="' . route('promocao.show', compact('promocao')) . '">' . $this->nome . '</a>';

        return $bread;
    }

    public function notas()
    {
        return $this->hasMany('App\Models\Nota');
    }

    public function bilhetes()
    {
        return $this->hasMany('App\Models\Bilhete');
    }

    public function getDataInicioFormatadaAttribute()
    {
        return ($this->data_inicio) ? date('d/m/Y', strtotime($this->data_inicio)) : '';
    }

    public function getDataInicioAjustadaAttribute()
    {
        return ($this->data_inicio) ? date('Y-m-d', strtotime($this->data_inicio)) : '';
    }

    public function getDataInicioOrdenacaoAttribute()
    {
        return ($this->data_inicio) ? date('YmdHis', strtotime($this->data_inicio)) : '';
    }

    public function getDataFimFormatadaAttribute()
    {
        return ($this->data_fim) ? date('d/m/Y', strtotime($this->data_fim)) : '';
    }

    public function getDataFimAjustadaAttribute()
    {
        return ($this->data_fim) ? date('Y-m-d', strtotime($this->data_fim)) : '';
    }

    public function getDataFimOrdenacaoAttribute()
    {
        return ($this->data_fim) ? date('YmdHis', strtotime($this->data_fim)) : '';
    }

    public function getStatusDescricaoAttribute()
    {
        $status = '';

        switch ($this->status) {

            case 'A': {
                    $status = 'Andamento';
                    break;
                }
            case 'F': {
                    $status = 'Finalizada';
                    break;
                }
            default: {
                    $status = '';
                    break;
                }
        }

        return $status;
    }

}

