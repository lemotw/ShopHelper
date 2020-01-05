<?php 

namespace App\Models\Pos;

use App\Models\Attribute\HasPartition;
use App\Models\Attribute\HasCompositePrimaryKey;
use App\Models\Exception\QueryInvalidStringException;
use App\Models\Exception\QueryInvalidOperatorException;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodCategory extends Model
{
    use SoftDeletes;
    use HasPartition;
    use HasCompositePrimaryKey;

    protected $table = 'GoodCategory';
    static protected $tableAccess = 'GoodCategory';

    /* SaleList Scheme
        string(256) 'UID'       unique
        int         'C_Branch'  fk -> T'ShopList'.id
        string(64)  'Wstation'  val-> Machine ID
        DateTime    'AccDate'   val-> Trade Day
        string(32)  'Invoice'   val-> 發票號碼
        string(16)  'Compid'    val-> 統一編號
        string(16)  'Carrier'   val-> 載具號碼
        int         'SaleMt'    val-> Sales Sum
        string(16)  'Member'    val-> Member Id
        string(16)  'Salesman'  val-> Salesman Id
        DateTime    'TimeInsert'val-> Insert time

        Create, Update timestamps
        soft delete
    */

    protected $fillable = [ 'UID', 'C_Branch', 'Name', 'ShortName' ];
    protected $dates = ['deleted_at'];
    protected $primaryKey = ['UID', 'C_Branch'];
    public $incrementing = false;

    public function Good()
    {
        return $this->hasMany('App\Models\Pos\GoodList', 'CategoryID', 'UID')->where('C_Branch', $this->C_Branch);
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
            'C_Branch' => $this->C_Branch,
            'Name' => $this->Name,
            'ShortName' => $this->ShortName
        ];
    }
}