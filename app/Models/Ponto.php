<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ponto extends Model
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

    public function nota()
    {
        return $this->belongsTo('App\Models\Nota');
    }

    public function getDataCriacaoFormatadaAttribute()
    {
        return ($this->created_at) ? date('d/m/Y', strtotime($this->created_at)) : '';
    }

}

