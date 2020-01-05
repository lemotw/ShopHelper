<?php

namespace App\Models\Pos;

use App\Models\Attribute\HasPartition;
use App\Models\Attribute\HasCompositePrimaryKey;
use App\Models\Exception\QueryInvalidStringException;
use App\Models\Exception\QueryInvalidOperatorException;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleDetail extends Model
{
    use SoftDeletes;
    use HasPartition;
    use HasCompositePrimaryKey;

    protected $table = 'SaleDetail';
    static protected $tableAccess = 'SaleDetail';

    /* SaleList Scheme
        string(256) 'UID'       unique
        string(256) 'PID'       fk -> T'SaleList'.UID
        int         'C_Branch'  fk -> T'ShopList'.id
        string(32)  'rsn'       val 銷售順序
        string(32)  'scode'     fk -> T'Good'
        int         'unitprice' val unitprice
        int         'saleqty'   val sale quantity
        int         'subtotal'  val sales sum
        Create, Update timestamps
        soft delete
    */

    protected $fillable = [
        'UID', 'PID', 'C_Branch', 'sname',
        'rsn', 'scode', 'unitprice',
        'saleqty', 'subtotal'
    ];
    protected $dates = ['deleted_at'];
    protected $primaryKey = ['UID', 'C_Branch'];
    public $incrementing = false;


    public function SaleInfo()
    {
        return $this->hasMany('App\Models\Pos\SaleList', 'UID', 'PID')->where('C_Branch', $this->C_Branch);
    }

    public function Good()
    {
        return $this->hasMany('App\Models\Pos\GoodList', 'UID', 'scode')->where('C_Branch', $this->C_Branch);
    }

    /**
     * Turn into array with fillable.
     * 
     * @return array
     */
    public function ToArray()
    {
        return [
            'UID' => $this->UID,
            'PID' => $this->PID,
            'C_Branch' => $this->C_Branch,
            'rsn' => $this->rsn,
            'scode' => $this->scode,
            'unitprice' => $this->unitprice,
            'saleqty' => $this->saleqty,
            'subtotal' => $this->subtotal,
        ];
    }
}