<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostToken extends Model
{
    use SoftDeletes;

    protected $table = 'PostToken';

    /* ShopList Scheme
        bigint  'id'        pk  ->  auto increment
        strint  'Token'     val ->  Token string
        datetime'Timeup'    val ->  timeup 

        Create, Update timestamps
        soft delete
    */
    protected $fillable = ['Token', 'Timeup', 'Shop'];
    protected $hidden = ['id'];
    protected $dates = ['deleted_at', 'Timeup'];

    public function ShopList()
    {
        return $this->hasMany('App\Models\Shop\ShopList', 'id', 'Shop');
    }
}