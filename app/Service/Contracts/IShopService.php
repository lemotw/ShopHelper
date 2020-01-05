<?php

namespace App\Service\Contracts;

use Illuminate\Http\Request;

interface IShopService
{
    /**
     * Add new Shop.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\Models\Shop\ShopList
     */
    public function AddShop(Request $request);

    /**
     * Delete Shop.
     * 
     * @param Illuminate\Http\Request $request
     * @return bool 
     */
    public function DeleteShop(Request $request);

    /**
     * Update Shop Name.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\Models\Shop\ShopList
     */
    public function SaveShop(Request $request);

    /**
     * Get Shop.
     * 
     * @param int $id
     * @return \App\Models\Shop\ShopList
     */
    public function GetShop($id);

    /**
     * Get all Shop.
     * 
     * @return Illuminate\Support\Collection
     */
    public function GetAllShop();
 
    /**
     * Add Shop Owner
     * 
     * @param int ShopId
     * @param int UserId
     * @return \App\Models\Shop\ShopOwner
     */
    public function AddOwnRealationship($ShopId, $UserId);

    /**
     * Get all User owned shop.
     * 
     * @param int id
     * @return Illuminate\Support\Collection
     */
    public function GetAllOwnedShop($id);

}

?>