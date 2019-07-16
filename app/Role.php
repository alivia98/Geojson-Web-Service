<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    protected $fillable = [
        'role_name'
    ];

    public function roles()
    {
        return $this->hasOne('App\Role');
    }
}
