<?php

namespace App\Models\ViewModel;

use App\Models\Pos\GoodList;
use App\Models\Pos\SaleDetail;

class SaleInfo
{
    /**
     * The attributes of sales.
     *
     * @var int
     */
    public $total = 0;

    /**
     * Title for page.
     *
     * @var string
     */
    public $title = '';

    /**
     * Describe for page.
     *
     * @var string
     */
    public $describe = '';

    /**
     * Array of SaleDetail volume.
     *
     * @var array
     */
    public $List;

    /**
     * Constructor
     * 
     * @return void
     */
    function __construct()
    {
        $this->List = [];
    }

    /**
     * Accumulate SaleDetail
     * 
     * @param App\Models\Pos\SaleDetail
     * @return void
     */
    public function AccumulateDetail(SaleDetail $detail)
    {
        //flag true -> in List then iterate to find and accumulate.
        $flag = $this->FoundList(function($key, $item) use($detail){
            if($item->scode == $detail->scode)
            {
                $this->List[$key]->saleqty += $detail->saleqty;
                $this->List[$key]->subtotal += $detail->subtotal;
                return true;
            }
            return false;
        });

        //flag false -> not in List need push
        if(!$flag)
            array_push($this->List, $detail);
    }

    /**
     * Get certain Good record.
     * 
     * @param App\Models\Pos\GoodList
     * @return App\Models\Pos\SaleDetail
     */
    public function GetGoodRecord(GoodList $good)
    {
        foreach($this->List as $key => $item)
        {
            if($item->scode == $good->UID)
                return $this->List[$key];
        }

        return false;
    }

    /**
     * Iterate execute param function if always false return false, else true.
     * 
     * @param function $closure_function
     * @return bool
     */
    protected function FoundList($closure_function)
    {
        $found_flag = false;
        foreach($this->List as $key => $item)
        {
            if($closure_function($key, $item))
                return true;
        }

        return false;
    }

}