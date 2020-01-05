<?php

namespace App\Http\Controllers\API;

use App\Models\API\PostToken;
use App\User;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Shop\ShopOwner;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostTokenController extends Controller
{

    /**
     * Login to get token
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    public function GetToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Shop' => ['required', 'int'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');
    
        if(!Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]))
            abort(403, 'Login Faild.');

        $user = User::where('email', $request->input('email'))->first();
        if(!$this->IsPermitShop($user, intval($request->input('Shop'))))
            abort(403, 'Shop not allow.');

        $token = Hash::make($request->input('email') . Carbon::now()->toDateTimeString());
        // Generate token by hash email and timestamp
        PostToken::create([
            'Token' => $token,
            'Timeup' => Carbon::now()->addWeek(),
            'Shop' => intval($request->input('Shop'))
        ]);

        return $token;
    }

    /**
     * Check token valid.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    public function ValidToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Token' => ['required', 'string', 'max:64'],
            'Shop' => ['required', 'int']
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');
        
        $this->tokenTest($request->input('Token'), intval($request->input('Shop')) );

        return 'Valid Token';
    }

    /**
     * Check token.
     * 
     * @param string $token
     * @param int $Shop
     * @return void
     */
    protected function tokenTest($token, $Shop)
    {
        if($token == NULL)
            abort(403, 'Token lost!!!');
        
        $TokenEntity = PostToken::where('Token', $token)->first();

        if($TokenEntity == NULL)
            abort(403, 'Token not found.');

        if($TokenEntity->Shop != $Shop)
            abort(403, 'Token not allow.');

        if(Carbon::now() > $TokenEntity->Timeup)
            abort(403, 'Token token expired.');
    }

    /**
     * Check Permission
     * 
     * @param App\User $user
     * @param int $ShopId
     * @return boolean
     */
    protected function IsPermitShop($user, $ShopId)
    {
        if(!is_int($ShopId) || $user == NULL)
            return false;

        // dd(strval($user->id) . " " . strval($ShopId));
        if(ShopOwner::where('ShopId',$ShopId)->where('OwnerId', $user->id)->first() == NULL)
            return false;

        return true;
    }
}
