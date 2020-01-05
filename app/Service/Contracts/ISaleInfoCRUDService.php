<?php

namespace App\Service\Contracts;

use Illuminate\Http\Request;

interface ISaleInfoCRUDService
{
    /**
     * New SaleInfo.
     * 
     * @param Illuminate\Http\Request $request
     * @param int $Shop
     * @return bool
     */
    public function postSaleList(Request $request, $Shop);

    /**
     * New SaleDetail.
     * 
     * @param Illuminate\Http\Request $request
     * @param int $Shop
     * @return bool
     */
    public function postSaleDetail(Request $request, $Shop);
}