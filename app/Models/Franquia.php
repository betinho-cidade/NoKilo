<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Franquia extends Model
{
    use HasFactory;


    public function getBreadcrumbAttribute()
    {
        $franquia = $this->id;

        $bread = '<a href="' . route('franquia.index') . '">Lista Franquias</a>';
        $bread .= ' > ';
        $bread .= '<a href="' . route('franquia.show', compact('franquia')) . '">' . $this->nome . '</a>';

        return $bread;
    }

    public function notas()
    {
        return $this->hasMany('App\Models\Nota');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function getNomeResponsavelAttribute(){

        return ($this->user) ? $this->user->name : '---';
    }

}

