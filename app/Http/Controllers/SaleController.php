<?php

namespace App\Http\Controllers;

use App\Service\SaleInfoService;
use App\Service\SaleInfoCRUDService;
use App\Service\Contracts\ISaleInfoService;
use App\Service\Contracts\ISaleInfoCRUDService;
use App\Models\Shop\ShopOwner;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{

    /**
     * ShopHolder index page
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ShopHolderIndex(Request $request)
    {
        $Owners = ShopOwner::where('OwnerId', Auth::user()->id)->get();
        return view('shopholder.index')->with('Owners', $Owners);
    }

    /**
     * Deal with Sale index page.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function SaleIndex(Request $request)
    {
        if(!$this->checkPermission($request->input('Shop')))
            abort(403, 'Unauthorized access.');
        
        Cookie::queue('Shop', $request->input('Shop'), 60000);

        return view('sale.saleindex')->with('ShopId', $request->input('Shop'));
    }

    /**
     * Get today sale data and pass to sale_row template.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function TodaySale(Request $request)
    {
        if(!$this->checkPermission($request->input('Shop')))
            abort(403, 'Unauthorized access.');

        $SaleInfo = $this->SaleInfoService->GetTodaySale($request);
        $SaleInfo->title = '今日銷售情形';
        $SaleInfo->describe = '各商品今日銷售情形，及營業額。';

        return view('sale.sale_row')->with(['SaleInfo'=>$SaleInfo, 'Shop'=>$request->input('Shop')]);
    }

    /**
     * Get between sale data and pass to sale_row template.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function BetweenSale(Request $request)
    {
        if(!$this->checkPermission($request->input('Shop')))
            abort(403, 'Unauthorized access.');

        $SaleInfo = $this->SaleInfoService->GetBetweenSale($request);
        $SaleInfo->title = '區間銷售情形';
        $SaleInfo->describe = '各商品銷售情形，及銷售額。';

        return view('sale.sale_row')->with(['SaleInfo'=>$SaleInfo, 'Shop'=>$request->input('Shop')]);
    }

    /**
     * Get Good Sale data.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function TodayGoodSale(Request $request)
    {
        if(!$this->checkPermission($request->input('Shop')))
            abort(403, 'Unauthorized access.');

        $validator = Validator::make($request->all(), [
            'Good_UID' => ['required', 'string', 'max:256'],
            'Shop' => ['required', 'integer']
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');
            
        $SaleInfo = $this->SaleInfoService->GetTodayGood($request->input('Good_UID'), $request->input('Shop'));
        return view('sale.sale_row')->with('SaleInfo', $SaleInfo);
    }

    /**
     * Get good sale data and pass to sale_row template between Time select.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function BetweenGoodSale(Request $request)
    {
        if(!$this->checkPermission($request->input('Shop')))
            abort(403, 'Unauthorized access.');

        $validator = Validator::make($request->all(), [
            'Good_UID' => ['required', 'string', 'max:256'],
            'Shop' => ['required', 'integer'],
            'Start_Time' => ['required', 'date', 'date_format:Y/m/d H:i:s'],
            'End_Time' => ['required', 'date', 'date_format:Y/m/d H:i:s'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');
            
        $SaleInfo = $this->SaleInfoService->GetBetweenGood(
            $request->input('Good_UID'),
            $request->input('Start_Time'),
            $request->input('End_Time'),
            $request->input('Shop')
        );
        return view('sale.sale_row')->with('SaleInfo', $SaleInfo);
    }

    /**
     * Show today the Sale Report.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function TodaySaleReport(Request $request)
    {
        if(!$this->checkPermission($request->input('Shop')))
            abort(403, 'Unauthorized access.');

        $validator = Validator::make($request->all(), [
            'Shop' => ['required', 'integer'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       

        $begin = Carbon::now()->toDateString();
        $end = Carbon::now()->addDay()->toDateString();

        $SaleReport= $this->SaleInfoService->SaleReport($begin, $end, $request->input('Shop'));
        $SaleReport->title = '銷售簡報';
        $SaleReport->describe = '該店家修售資訊之簡報。';

        return view('sale.salereport_row')->with(['SaleReport'=> $SaleReport, 'Shop'=> $request->input('Shop')]);
    }

    /**
     * Show between sale report and pass to sale_row template.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function BetweenSaleReport(Request $request)
    {
        if(!$this->checkPermission($request->input('Shop')))
            abort(403, 'Unauthorized access.');

        $validator = Validator::make($request->all(), [
            'Shop' => ['required', 'integer'],
            'Start_Time' => ['required', 'date', 'date_format:Y/m/d H:i:s'],
            'End_Time' => ['required', 'date', 'date_format:Y/m/d H:i:s'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       

        $SaleReport= $this->SaleInfoService->SaleReport($request->input('Start_Time'), $request->input('End_Time'), $request->input('Shop'));
        $SaleReport->title = '銷售簡報';
        $SaleReport->describe = '該店家修售資訊之簡報。';

        return view('sale.salereport_row')->with(['SaleReport'=> $SaleReport, 'Shop'=> $request->input('Shop')]);
    }

    /**
     * Show today the Sale Statistic.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function TodaySaleStatistic(Request $request)
    {
        if(!$this->checkPermission($request->input('Shop')))
            abort(403, 'Unauthorized access.');

        $validator = Validator::make($request->all(), [
            'Shop' => ['required', 'integer'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       

        $begin = Carbon::now()->toDateString();
        $end = Carbon::now()->addDay()->toDateString();

        $SaleStatistic= $this->SaleInfoService->SaleStatistic($begin, $end, $request->input('Shop'));
        return view('sale.salestatistics_row')->with(['SaleStatistic'=> $SaleStatistic, 'Shop'=> $request->input('Shop')]);
    }

    /**
     * Show between sale statistic and pass to sale_row template.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function BetweenSaleStatistic(Request $request)
    {
        if(!$this->checkPermission($request->input('Shop')))
            abort(403, 'Unauthorized access.');

        $validator = Validator::make($request->all(), [
            'Shop' => ['required', 'integer'],
            'Start_Time' => ['required', 'date', 'date_format:Y/m/d H:i:s'],
            'End_Time' => ['required', 'date', 'date_format:Y/m/d H:i:s'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       

        $SaleStatistic = $this->SaleInfoService->SaleStatistic($request->input('Start_Time'), $request->input('End_Time'), $request->input('Shop'));
        return view('sale.salestatistics_row')->with(['SaleStatistic'=> $SaleStatistic, 'Shop'=> $request->input('Shop')]);
    }

    /**
     * Show today the Sale Invoice list.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function TodaySaleInvoice(Request $request)
    {
        if(!$this->checkPermission($request->input('Shop')))
            abort(403, 'Unauthorized access.');

        $validator = Validator::make($request->all(), [
            'Shop' => ['required', 'integer'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       

        $begin = Carbon::now()->toDateString();
        $end = Carbon::now()->addDay()->toDateString();

        $SaleInvoice= $this->SaleInfoService->SaleInvoice($begin, $end, $request->input('Shop'));
        return view('sale.saleinvoice_row')->with(['SaleInvoice'=> $SaleInvoice, 'Shop'=> $request->input('Shop')]);
    }

    /**
     * Show between sale invoice list and pass to sale_row template.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function BetweenSaleInvoice(Request $request)
    {
        if(!$this->checkPermission($request->input('Shop')))
            abort(403, 'Unauthorized access.');

        $validator = Validator::make($request->all(), [
            'Shop' => ['required', 'integer'],
            'Start_Time' => ['required', 'date', 'date_format:Y/m/d H:i:s'],
            'End_Time' => ['required', 'date', 'date_format:Y/m/d H:i:s'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       

        $SaleInvoice = $this->SaleInfoService->SaleInvoice($request->input('Start_Time'), $request->input('End_Time'), $request->input('Shop'));
        return view('sale.saleinvoice_row')->with(['SaleInvoice'=> $SaleInvoice, 'Shop'=> $request->input('Shop')]);
    }

    /**
     * Check user permission.
     * 
     * @param int $Shop
     * @return bool
     */
    protected function checkPermission($Shop)
    {
        if(!Auth::check())
            return false;

        if(!ShopOwner::where('ShopId',$Shop)->where('OwnerId', Auth::user()->id)->first())
            return false;

        return true;
    }


    /**
     * Inject service.
     * 
     * @param \App\Service\SaleInfoService $SaleInfoService
     * @param \App\Service\SaleInfoCRUDService $SaleInfoCRUDService
     * 
     * @return void
     */
    public function __construct(ISaleInfoService $SaleInfoService)
    {
        $this->SaleInfoService = $SaleInfoService;
    }

    /**
     * Provide Sales info.
     * 
     * @var \App\Service\SaleInfoService
     */
    protected $SaleInfoService;
}
