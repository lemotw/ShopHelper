<?php
namespace App\Service\Contracts;

use Illuminate\Http\Request;

interface IGoodService
{
    /**
     * Add new Good.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\Models\Pos\GoodList
     */
    public function AddGood(Request $request);

    /**
     * Delete Good.
     * 
     * @param int $id
     * @return bool 
     */
    public function DeleteGood($id);

    /**
     * Update Good info.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\Models\Pos\GoodList
     */
    public function SaveGood(Request $request);

     /**
     * Add new Good Category.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\Models\Pos\GoodCategory
     */
    public function AddGoodCategory(Request $request);

    /**
     * Delete Good Category.
     * 
     * @param int $id
     * @return bool 
     */
    public function DeleteGoodCategory($id);

    /**
     * Update GoodCategory info.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\Models\Pos\GoodCategory
     */
    public function SaveGoodCategory(Request $request);
}
?>