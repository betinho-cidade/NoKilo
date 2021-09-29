<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bilhete extends Model
{
    use HasFactory;


    // public function getBreadcrumbAttribute()
    // {
    //     $nota = $this->id;

    //     $bread = '<a href="' . route('nota.index') . '">Lista Franquias</a>';
    //     $bread .= ' > ';
    //     $bread .= '<a href="' . route('nota.show', compact('nota')) . '">' . $this->path_nota . '</a>';

    //     return $bread;
    // }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function promocao()
    {
        return $this->belongsTo('App\Models\Promocao');
    }

    public function getDataCriacaoFormatadaAttribute()
    {
        return ($this->created_at) ? date('d/m/Y', strtotime($this->created_at)) : '';
    }

    public function getDataEncerramentoFormatadaAttribute()
    {
        return ($this->data_encerramento) ? date('d/m/Y', strtotime($this->data_encerramento)) : '---';
    }

    public function getStatusDescricaoAttribute()
    {
        $status = '';

        switch ($this->status) {

            case 'P': {
                    $status = 'Participando';
                    break;
                }
            case 'S': {
                    $status = 'PREMIADO';
                    break;
                }
            case 'N': {
                    $status = 'Não Sorteado';
                    break;
                }
            default: {
                    $status = '';
                    break;
                }
        }

        return $status;
    }


    public function getNumeroSorteFormatadoAttribute()
    {
        return ($this->numero_sorte) ? substr($this->numero_sorte, -5) : '---';
    }


}

