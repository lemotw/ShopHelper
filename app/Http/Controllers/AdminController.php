<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Service\UserService;
use App\Service\ShopService;
use App\Service\Contracts\IUserService;
use App\Service\Contracts\IShopService;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    /**
     * Provide Admin index panel.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function AdminIndex()
    {
        return view('admin.index');
    }

    /**
     * Provide Shop all maintain panel.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ShopAllMaintain()
    {
        $ShopList = $this->ShopService->GetAllShop();
        return view('admin.shopall_row')->with(['ShopList'=>$ShopList, 'User'=>Auth::user()]);
    }

    /**
     * Provide user maintain page.
     * Filter admin.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function UserMaintain(Request $request)
    {
        $UserList = $this->UserService->GetAllUser()->filter(function ($value, $key){
            return $value->role != 'admin';
        });
        return view('admin.user_row')->with('UserList', $UserList);
    }

    /**
     * Provide User add page.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ShowUserAdd(Request $request)
    {
        return view('admin.user_add_panel');
    }

    /**
     * Dealing with User add Post request
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function UserAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'max:255'],
            'password-confirm' => ['required', 'string', 'max:255']
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       
       
        if($request->input('password') != $request->input('password-confirm'))
            abort(400, 'Password not same');

        $this->UserService->AddUser($request);
        return redirect(route('UserMaintain'));
    }

    /**
     * Delete User.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function UserDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'User' => ['required', 'integer'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       
 
        $this->UserService->DeleteUser($request->input('User'));
        return redirect(route('UserMaintain'));
    }

    /**
     * Provide shop maintain page.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ShopMaintain(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'User' => ['required', 'integer'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       

        $user = $this->UserService->GetUser($request->input('User'));
        $ShopList = $this->ShopService->GetAllOwnedShop($user->id);
        return view('admin.shop_row')->with(['ShopList'=>$ShopList, 'User'=>$user]);
    }

    /**
     * Provide Shop add page.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ShowShopAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'User' => ['required', 'integer'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       

        return view('admin.shop_add_panel')->with('UserId', $request->input('User'));
    }

    /**
     * Dealing with Shop add post request.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ShopAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'User' => ['required', 'integer'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       

        $User = $this->UserService->GetUser($request->input('User'));
        if($User == NULL)
            abort(404, 'User not found!!');

        $this->ShopService->AddShop($request);
        
        return redirect(route('ShopMaintain', ['User' => $User->id]));
    }

    /**
     * Delete Shop Realationship.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ShopDeleteOwn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Shop' => ['required', 'integer'],
            'User' => ['required', 'integer'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       

        $this->ShopService->DeleteOwnRealationship($request->input('Shop'), $request->input('User'));
        return redirect(route('ShopMaintain', ['User' => $request->input('User')]));
    }

    /**
     * Delete Shop
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ShopDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Shop' => ['required', 'integer'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       

        $this->ShopService->DeleteShop($request);
        return redirect(route('ShopAllMaintain'));
    }

    /**
     * Provide Shop edit page.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ShowShopEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Shop' => ['required', 'integer'],
            'User' => ['required', 'integer'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       
        
        $Shop = $this->ShopService->GetShop($request->input('Shop'));
        $User = $this->UserService->GetUser($request->input('User'));
        if($Shop == NULL)
            abort(404, 'Shop not found~');
        if($User == NULL)
            abort(404, 'User not found~');

        return view('admin.shop_edit_panel')->with( ['Shop'=>$Shop, 'User'=>$User] );
    }
    
    /**
     * Dealing with ShopDelete post request.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ShopEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'User' => ['required', 'integer'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       
 
        $this->ShopService->SaveShop($request);
        return redirect(route('ShopMaintain', ['User'=>$request->input('User')]));
    }

    /**
     * Provide Shop Own add page.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ShowShopAddOwn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'User' => ['required', 'integer'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       

        $ShopList = $this->ShopService->GetAllShop();
        return view('admin.shop_add_own_panel')->with( ['ShopList'=>$ShopList, 'UserId'=>$request->input('User')]);
    }

    /**
     * Dealing with Add Owner Post.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function AddOwn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'User' => ['required', 'integer'],
            'Shop' => ['required', 'integer'],
        ]);

        if($validator->fails())
            abort(400, 'Request does not meet specifications.');       
        
        $this->ShopService->AddOwnRealationship($request->input('Shop'), $request->input('User'));

        return redirect(route('ShopMaintain', ['User'=>$request->input('User')]));
    }

    public function __construct(IUserService $UserService, IShopService $ShopService)
    {
        $this->UserService = $UserService;
        $this->ShopService = $ShopService;
    }

    /**
     * Provide User info.
     * 
     * @var \App\Service\IUserService
     */
    protected $UserService;

    /**
     * Provide Shop info.
     * 
     * @var \App\Service\IShopService
     */
    protected $ShopService;
}