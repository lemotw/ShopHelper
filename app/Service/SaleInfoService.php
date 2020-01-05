<?php

namespace App\Service;

use App\Models\Shop\ShopOwner;
use App\Models\Pos\GoodList;
use App\Models\Pos\GoodCategory;
use App\Models\Pos\SaleList;
use App\Models\Pos\SaleDetail;
use App\Models\ViewModel\GoodSale;
use App\Models\ViewModel\SaleInfo;
use App\Models\ViewModel\SaleReport;
use App\Models\ViewModel\SaleStatistics;
use App\Models\ViewModel\SaleInvoice;
use App\Service\Contracts\ISaleInfoService;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SaleInfoService implements ISaleInfoService
{
    /**
     * GoodList
     * 
     * @var array
     */
    protected $AllGoodsList;

    /**
     * Get today SaleInfo with all Goods.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\Models\ViewModel\SaleInfo
     */
    public function GetTodaySale(Request $request)
    {
        $ShopId = $request->input('Shop');

        $Sales = SaleList::whereByPartition('date(`created_at`)', '=', date('Y-m-d'), $ShopId);
        
        return $this->statisticSales($Sales, new SaleInfo);
    }

    /**
     * Get SaleInfo during the period.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\Models\ViewModel\SaleInfo
     */
    public function GetBetweenSale(Request $request)
    {
        $ShopId = $request->input('Shop');

        if( $this->betweenTimeValidor($request->all())->fails() )
            abort(400, 'Request does not meet specifications.');

        $Sales = SaleList::whereBetweenByPartition('created_at', $request->input('Start_Time'), $request->input('End_Time'), $ShopId);
        
        return $this->statisticSales($Sales, new SaleInfo);
    }

    /**
     * Get today Good sale data.
     * 
     * @param int $id
     * @param int $ShopId
     * @return \App\Models\ViewModel\GoodSale
     */
    public function GetTodayGood($uid, $ShopId)
    {
        $Good = GoodList::find([
            'UID' => $uid, 
            'C_Branch' => $ShopId
        ]);
        if(!$this->IsPermitAccessShop($ShopId))
            abort(403, 'Unauthorized access.');
        
        $Sales = SaleList::whereByPartition('date(`created_at`)', '=', date('Y-m-d'), $ShopId);
        $saleinfo = $this->statisticSales($Sales, new SaleInfo);

        return $saleinfo->GetGoodRecord($Good);
    }

    /**
     * Get Good data during the period.
     * 
     * @param int $id
     * @param Illuminate\Support\Carbon $begin
     * @param Illuminate\Support\Carbon $end
     * @return \App\Models\ViewModel\GoodSale
     */
    public function GetBetweenGood($id, $begin, $end, $ShopId)
    {
        if( $this->betweenTimeValidor(['Start_Time' => $begin, 'End_Time' => $end])->fails() )
            abort(400, 'Request does not meet specifications.');

        $Good = GoodList::find([
            'UID' => $id, 
            'C_Branch' => $ShopId
        ]);

        $Sales = SaleList::whereBetweenByPartition('created_at', $begin, $end, $ShopId);
        $saleinfo = $this->statisticSales($Sales, new SaleInfo);

        return $saleinfo->GetGoodRecord($Good);
    }

    /**
     * Sale Report by time.
     * 
     * @param string $begin
     * @param string $end
     * @param int $ShopId
     * @return \App\Models\ViewModel\SaleReport
     */
    public function SaleReport($begin, $end, $ShopId)
    {
        $Sales = SaleList::whereBetweenByPartition('created_at', $begin, $end, $ShopId);

        $SaleReport = new SaleReport;
        $SaleReport->time = $begin . ' ~ ' . $end;
        $SaleReport->billing = $Sales->count();

        foreach($Sales as $salelist)
        {
            $SaleReport->sales += $salelist->SaleMt;
            
            if($salelist->Invoice != '')
                $SaleReport->invoice++;
        }

        return $SaleReport;
    }

    /**
     * Sale Statistic by time.
     * 
     * @param string $begin
     * @param string $end
     * @param int $ShopId
     * @return \App\Models\ViewModel\SaleStatistics
     */
    public function SaleStatistic($begin, $end, $ShopId)
    {
        $rt = [];
        $Sales = SaleList::whereBetweenByPartition('created_at', $begin, $end, $ShopId);

        foreach($Sales as $salelist)
        {
            if(!isset($rt[$salelist->created_at->toDateString()]))
            {
                $key = $salelist->created_at->toDateString();
                $rt[$key] = new SaleStatistics();
                $rt[$key]->date = $key;
                $rt[$key]->billing = 1;
                $rt[$key]->sale_count = $salelist->SaleDetail->count();
                $rt[$key]->sales = $salelist->SaleMt;
            }
            else
            {
                $key = $salelist->created_at->toDateString();
                $rt[$key]->billing++;
                $rt[$key]->sale_count += $salelist->SaleDetail->count();
                $rt[$key]->sales += $salelist->SaleMt;
            }
        }

        return $rt;
    }

    /**
     * Sale Invoice list by time.
     * 
     * @param string $begin
     * @param string $end
     * @param int $ShopId
     * @return \App\Models\ViewModel\SaleInvoice
     */
    public function SaleInvoice($begin, $end, $ShopId)
    {
        $rt = [];

        $Sales = SaleList::whereBetweenByPartition('created_at', $begin, $end, $ShopId)->filter(function($item){
            return $item->Invoice != NULL;
        });

        foreach($Sales as $salelist)
        {
            $saleinvoice = new SaleInvoice();

            $saleinvoice->date = $salelist->created_at->toDateTimeString();
            $saleinvoice->count = $salelist->SaleDetail->count();
            $saleinvoice->sales = $salelist->SaleMt;
            $saleinvoice->invoice = $salelist->Invoice;
            
            array_push($rt, $saleinvoice);
        }

        return $rt;
    }

    /**
     * Statistic sales.
     * 
     * @param Illuminate\Support\Collection $sales
     * @param App\Models\ViewModel\SaleInfo
     * 
     * @return App\Models\ViewModel\SaleInfo
     */
    protected function statisticSales($sales, $saleinfo)
    {
        foreach($sales as $sale)
            foreach($sale->SaleDetail as $detail)
                $saleinfo->AccumulateDetail($detail);

        return $saleinfo;
    }

    /**
     * Return a validator for between time.
     * 
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function betweenTimeValidor(array $data)
    {
        return Validator::make($data, [
            'Start_Time' => ['required', 'date', 'date_format:Y/m/d H:i:s'],
            'End_Time' => ['required', 'date', 'date_format:Y/m/d H:i:s'],
        ]);
    }

}

?>