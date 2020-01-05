<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopOwner extends Model
{
    use SoftDeletes;

    protected $table = 'ShopOwner';

    /* ShopOwner Scheme
        bigint  'id'        pk  ->  auto increment
        bigint  'ShopId'    fk  ->  T'ShopList'
        bigint  'OwnerId'   fk  ->  T'User'

        Create, Update timestamps
        soft delete
    */
    protected $fillable = ['ShopId', 'OwnerId'];
    protected $hidden = ['id'];
    protected $dates = ['deleted_at'];

    public function Owner() {
        return $this->hasOne('App\User', 'id', 'OwnerId');
    }

    public function Shop() {
        return $this->hasOne('App\Models\Shop\ShopList', 'id', 'ShopId');
    }

    public function findOwner($ShopId, $UserId)
    {
        return $this->where('ShopId', $ShopId)->where('UserId', $UserId)->get();
    }

    /**
     * Turn into array with fillable.
     * 
     * @return array
     */
    public function ToArray()
    {
        return [
            'ShopId' => $this->ShopId,
            'OwnerId' => $this->OwnerId,
        ];
    }
}