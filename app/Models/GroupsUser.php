<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupsUser extends Model
{
    public $timestamps = false;

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function group(){
        return $this->hasOne(Group::class,'id','group_id');
    }
}
