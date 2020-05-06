<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function microposts()
    {
      return $this->hasMany('App\Micropost');
    }
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email', 
        'password',
        'admin_flg', 
    ];

    public function userSave($params)
    {
      $isRegist = $this->fill($params)->save();
      return $isRegist;
    }

    protected static function boot() 
    {
        parent::boot();
        static::deleting(function($model) {
            foreach ($model->microposts()->get() as $child) {
                $child->delete();
            }
        });
    }
}
