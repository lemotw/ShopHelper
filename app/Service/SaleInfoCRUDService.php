<?php

namespace App\Service;

use App\Models\Pos\GoodList;
use App\Models\Pos\GoodCategory;
use App\Models\Pos\SaleList;
use App\Models\Pos\SaleDetail;
use App\Service\Contracts\ISaleInfoCRUDService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleInfoCRUDService implements ISaleInfoCRUDService
{
    /**
     * New SaleInfo.
     * 
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function postSaleList(Request $request, $Shop)
    {
        if( $this->SaleListValidator($request->all())->fails())
            abort(400, 'Request does not meet specifications.');
        $arr = $request->only($this->SaleListNeed());
        $arr['C_Branch'] = $Shop;

        $new = SaleList::create( $arr );
        if($new == null)
            return false;

        return true;
    }

    /**
     * New SaleDetail.
     * 
     * @param Illuminate\Http\Request $request
     * @return bool
     */
    public function postSaleDetail(Request $request, $Shop)
    {
        if( $this->SaleDetailValidator($request->all())->fails() )
            abort(400, 'Request does not meet specifications.');
        $arr = $request->only($this->SaleDetailNeed());
        $arr['C_Branch'] = $Shop;
        // dd($arr);
        $new = SaleDetail::create($arr);
        if($new == null)
            return false;

        return true;
    }

    /**
     * Validate the SaleList request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function SaleListValidator(array $data)
    {
        return Validator::make($data, [
            'UID' => ['required', 'string', 'max:256'],
            'Wstation' => ['required', 'string', 'max:64'],
            'AccDate' => ['required', 'date', 'date_format:Y/m/d'],
            'Invoice' => ['string', 'max:32'],
            'Compid' => ['string', 'max:16'],
            'Carrier' => ['string', 'max:16'],
            'SaleMt' => ['required', 'integer'],
            'Member' => ['string', 'max:16'],
            'Salesman' => ['string', 'max:16'],
            'TimeInsert' => ['required', 'date', 'date_format:Y/m/d H:i:s']
        ]);
    }

    /**
     * SaleList needs column.
     *
     * @return array
     */
    protected function SaleListNeed()
    {
        return [
            'UID', 'C_Branch', 'Wstation',
            'AccDate', 'Invoice', 'Compid',
            'Carrier', 'SaleMt', 'Member',
            'Salesman', 'TimeInsert'
        ];
    }

    /**
     * Validate the SaleDetail request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function SaleDetailValidator(array $data)
    {
        return Validator::make($data, [
            'UID' => ['required', 'string', 'max:256'],
            'PID' => ['required', 'string', 'max:256'],
            'rsn' => ['required', 'string', 'max:32'],
            'scode' => ['required', 'string', 'max:32'],
            'sname' => ['required', 'string', 'max:256'],
            'unitprice' => ['required', 'integer'],
            'saleqty' => ['required', 'integer'],
            'subtotal' => ['required', 'integer']
        ]);
    }

    /**
     * SaleDetail needs column.
     *
     * @return array
     */
    protected function SaleDetailNeed()
    {
        return [
            'UID', 'PID', 'C_Branch',
            'rsn', 'scode', 'sname', 'unitprice',
            'saleqty', 'subtotal'
        ];
    }
}

?>