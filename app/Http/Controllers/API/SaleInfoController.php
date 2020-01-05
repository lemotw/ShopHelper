<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;

use App\Models\Shop\ShopList;
use App\Models\API\PostToken;

use App\Service\SaleInfoCRUDService;
use App\Service\Contracts\ISaleInfoCRUDService;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaleInfoController extends Controller
{
    /**
     * Post SaleList.
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    public function PostSaleList(Request $request)
    {
        $TokenEntity = $this->tokenTest($request->input('Token'));

        if(!$this->CheckShop($TokenEntity->Shop))
            abort(403, 'Token Shop Permission problem.');

        if(!$this->SaleInfoCRUDService->postSaleList($request, $TokenEntity->Shop))
            abort(400, 'Request problem. Can not create SaleList.');
        
        return 'OK';
    }

    /**
     * Post SaleDetail.
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    public function PostSaleDetail(Request $request)
    {
        $TokenEntity = $this->tokenTest($request->input('Token'));

        if(!$this->CheckShop($TokenEntity->Shop))
            abort(403, 'Token Shop Permission problem.');

        if(!$this->SaleInfoCRUDService->postSaleDetail($request, $TokenEntity->Shop))
            abort(400, 'Request problem. Can not create SaleDetail.');
        
        return 'OK';
    }

    /**
     * Check token.
     * 
     * @param string $token
     * @return App\Models\API\PostToken
     */
    protected function tokenTest($token)
    {
        if($token == NULL)
            abort(403, 'Token lost!!!');
        
        $TokenEntity = PostToken::where('Token', $token)->first();

        if($TokenEntity== NULL)
            abort(403, 'Token not found.');

        if(Carbon::now() > $TokenEntity->Timeup)
            abort(403, 'Token expired.');

        return $TokenEntity;
    }

    /**
     * Check Shop id.
     * 
     * @param int $ShopId
     * @return void
     */
    protected function CheckShop($ShopId)
    {
        if(!is_int($ShopId))
            return false;

        $shop = ShopList::find($ShopId);
        if($shop == NULL)
            return false;
        
        return true;
    }

    /**
     * Inject service.
     * 
     * @param \App\Service\SaleInfoCRUDService $SaleInfoCRUDService
     * 
     * @return void
     */
    public function __construct(ISaleInfoCRUDService $SaleInfoCRUDService)
    {
        $this->SaleInfoCRUDService = $SaleInfoCRUDService;
    }

    /**
     * Provide Sales data CRUD Service.
     * 
     * @var \App\Service\SaleInfoCRUDService
     */
    protected $SaleInfoCRUDService;
}
