<?php

namespace App\Service;

use App\Http\User;
use App\Models\Shop\ShopList;
use App\Models\Shop\ShopOwner;
use App\Service\Contracts\IShopService;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopService implements IShopService
{
    /**
     * Add new Shop.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\Models\Shop\ShopList
     */
    public function AddShop(Request $request)
    {
        if($this->ShopListValidator($request->all())->fails())
            abort(400, 'Request does not meet specifications.');       

        $Shop = ShopList::create( $request->only($this->ShopListNeed()) );
        $User = User::find($request->input('User'));

        if($User->role != 'admin')
            $this->AddOwnRealationship($Shop->id, $request->input('User'));

        $this->updatePartition();

        return $Shop;
    }

    /**
     * Delete Shop.
     * 
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function DeleteShop(Request $request)
    {
        $shop = $this->GetShop($request->input('Shop'));
        $ownlist = ShopOwner::where('ShopId', $request->input('Shop'))->get();
        foreach($ownlist as $own)
            $own->delete();

        if($shop != NULL);
            $shop->delete();
    }

    /**
     * Update Shop Name.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\Models\Shop\ShopList
     */
    public function SaveShop(Request $request)
    {
        $shop = $this->GetShop($request->input('id'));
        if($shop == null)
            abort(404, 'ShopList not found!');

        if( $this->ShopListValidator($request->all())->fails() )
            abort(400, 'Request does not meet specifications.');       

        $shop->update($request->only($this->ShopListNeed()));

        return $shop;
    }

    /**
     * Get Shop.
     * 
     * @param int $id
     * @return \App\Models\Shop\ShopList
     */
    public function GetShop($id)
    {
        $validator = Validator::make(['User' => $id], [
            'User' => ['required', 'integer'],
        ]);

        if($validator->fails())
            return NULL;

        return ShopList::find($id);
    }

    /**
     * Get all Shop.
     * 
     * @return Illuminate\Support\Collection
     */
    public function GetAllShop()
    {
        return ShopList::all();
    }

    /**
     * Add Shop Owner
     * 
     * @param int ShopId
     * @param int UserId
     * @return \App\Models\Shop\ShopOwner
     */
    public function AddOwnRealationship($ShopId, $UserId)
    {
        if( $this->ShopOwnerValidator([
            'ShopId' => $ShopId,
            'OwnerId' => $UserId,
        ])->fails() )
            abort(400, 'Request does not meet specifications.');       

        $Owner = ShopOwner::where('ShopId', $ShopId)->where('OwnerId', $UserId)->first();
        if($Owner != NULL)
            return NULL;

        return ShopOwner::create([
            'ShopId' => $ShopId,
            'OwnerId' => $UserId,
        ]);
    }

    /**
     * Delete Shop Owner
     * 
     * @param int ShopId
     * @param int UserId
     * @return void
     */
    public function DeleteOwnRealationship($ShopId, $UserId)
    {
        $own = ShopOwner::where('ShopId', $ShopId)->where('OwnerId', $UserId)->first();
        if($own != NULL)
            $own->delete();
    }

    /**
     * Get all User owned shop.
     * 
     * @param int id
     * @return Illuminate\Support\Collection
     */
    public function GetAllOwnedShop($id)
    {
        $validator = Validator::make(['User' => $id], [
            'User' => ['required', 'integer'],
        ]);

        if($validator->fails())
            return NULL;

        return ShopOwner::where('OwnerId', $id)->orderBy('ShopId', 'asc')->get();
    }

    /**
     * Shop Need array.
     * 
     * @param void
     * @return array
     */
    public function ShopListNeed()
    {
        return [
            'name'
        ];
    }

    /**
     * ShopOwner Need array.
     * 
     * @param void
     * @return array
     */
    public function ShopOwnerNeed()
    {
        return [
            'ShopId', 'OwnerId'
        ];
    }

    /**
     * Get a validator for ShopList.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function ShopListValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Get a validator for ShopOwner.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function ShopOwnerValidator(array $data)
    {
        return Validator::make($data, [
            'ShopId' => ['required', 'integer'],
            'OwnerId' => ['required', 'integer'],
        ]);
    }

    /**
     * Alter table to add partition.
     * 
     * @return void
     */
    protected function updatePartition()
    {
        $ShopNumber = DB::select('SELECT COUNT(*) as total FROM `ShopList`')[0]->total;

        if($ShopNumber > 0)
        {
            DB::unprepared('ALTER TABLE SaleList PARTITION BY HASH(C_Branch) PARTITIONS '.strval($ShopNumber));
            DB::unprepared('ALTER TABLE SaleDetail PARTITION BY HASH(C_Branch) PARTITIONS '.strval($ShopNumber));
            DB::unprepared('ALTER TABLE GoodList PARTITION BY HASH(C_Branch) PARTITIONS '.strval($ShopNumber));
            DB::unprepared('ALTER TABLE GoodCategory PARTITION BY HASH(C_Branch) PARTITIONS '.strval($ShopNumber));
        }
    }
}

?>