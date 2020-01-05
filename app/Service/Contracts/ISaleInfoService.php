<?php

namespace App\Service\Contracts;

use Illuminate\Http\Request;

interface ISaleInfoService
{

    /**
     * Get today SaleInfo with all Goods.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\Models\ViewModel\SaleInfo
     */
    public function GetTodaySale(Request $request);

    /**
     * Get SaleInfo during the period.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\Models\ViewModel\SaleInfo
     */
    public function GetBetweenSale(Request $request);

    /**
     * Get today Good sale data.
     * 
     * @param int $id
     * @return \App\Models\ViewModel\GoodSale
     */
    public function GetTodayGood($id, $ShopId);

    /**
     * Get Good data during the period.
     * 
     * @param int $id
     * @param Illuminate\Support\Carbon $begin
     * @param Illuminate\Support\Carbon $end
     * @return \App\Models\ViewModel\GoodSale
     */
    public function GetBetweenGood($id, $begin, $end, $ShopId);

    /**
     * Get All Sale List
     * 
     * @return Illuminate\Support\Collection
     */
    // public function GetAllSaleList();
}

?>