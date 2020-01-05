<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopList extends Model
{
    use SoftDeletes;

    protected $table = 'ShopList';

    /* ShopList Scheme
        bigint  'id'        pk  ->  auto increment
        strint  'name'      val ->  Shop name
        string  'db_name'   val ->  Database name to manipulate

        Create, Update timestamps
        soft delete
    */
    protected $fillable = ['name'];
    protected $hidden = ['id'];
    protected $dates = ['deleted_at'];

    public function OwnerMap() {
        return $this->belongsToMany('App\Models\Shop\ShopOwner', 'id');
    }

    /**
     * Turn into array with fillable.
     * 
     * @return array
     */
    public function ToArray()
    {
        return ['name' => $this->name];
    }

}