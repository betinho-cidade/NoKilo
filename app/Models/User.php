<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'privacidade',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getDataAlteracaoAttribute()
    {
        return date('d/m/Y H:i:s', strtotime($this->updated_at));
    }


    public function getPerfilIdAttribute()
    {
        $perfil = $this->rolesAll();

        return $perfil->first()->id;
    }


    public function getPerfilAttribute()
    {
        $perfil = $this->rolesAll();

        return $perfil->first()->name;
    }


    public function getSituacaoAttribute()
    {
        $situacao = $this->rolesAll()
            ->withPivot('status');

        return $situacao->first()->pivot;
    }


    public function getDataNascimentoAjustadaAttribute()
    {
        return ($this->data_nascimento) ? date('Y-m-d', strtotime($this->data_nascimento)): '';
    }


    public function franquia()
    {
        return $this->hasOne('App\Models\Franquia');
    }


    public function notas()
    {
        return $this->hasMany('App\Models\Nota');
    }

    public function bilhetes()
    {
        return $this->hasMany('App\Models\Bilhete');
    }

    public function getTermoPrivacidadeAttribute()
    {
        return ($this->privacidade && $this->privacidade == 'S') ? 'Sim' : '-';
    }

    public function getMarketingAttribute()
    {
        return ($this->lgpd && $this->lgpd == 'S') ? 'Sim' : '-';
    }

    public function rolesAll()
    {
        return $this->belongsToMany('App\Models\Role')
                    ->withTimestamps();
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')
            ->withPivot('status')
            ->wherePivot('status', 'A')
            ->withTimestamps();
    }


    public function hasPermission(Permission $permission)
    {

        return $this->hasAnyRoles($permission->roles);
    }


    public function hasAnyRoles($roles)
    {

        if (is_array($roles) || is_object($roles)) {

            $return = false;
            foreach ($roles as $role) {

                if ($this->roles->contains('name', $role->name)) {
                    $return = true;
                    continue;
                }
            }
            return $return;
        }

        return $this->roles->contains('name', $roles);
    }
}
