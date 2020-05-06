<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    public function user()
    {
      return $this->belongsTo('App\User');
    }
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id',
      'content',
    ];

    public static function getAll()
    {
      $microposts = Micropost::all()->sortByDesc('id');
      return $microposts;
    }

    public function micropostSave($params)
    {
      $isSave = $this->fill($params)->save();
      return $isSave;
    }
}
