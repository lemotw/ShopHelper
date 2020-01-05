<?php

namespace App\Service\Contracts;

use Illuminate\Http\Request;

interface IUserService
{

    /**
     * Add new user.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\User
     */
    public function AddUser(Request $request);

    /**
     * Delete user.
     * 
     * @param int $id
     * @return bool 
     */
    public function DeleteUser($id);

    /**
     * Update user info.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\User
     */
    public function SaveUser(Request $request);
    
    /**
     * Get All User.
     * 
     * @return Illuminate\Support\Collection
     */
    public function GetAllUser();

    /**
     * Get Certail User profile by user id.
     * 
     * @param int $id
     * @return App\User
     */
    public function GetUser($id);

    /**
     * Get Admin User.
     * 
     * @return Illuminate\Support\Collection
     */
    public function GetAllAdmin();

    /**
     * Get ShopHolders.
     * 
     * @return Illuminate\Support\Collection
     */
    public function GetAllShopHolder();

    /**
     * Reset User Password, will sent mail to reset.
     * 
     * @param string $email
     * @return bool
     */
    public function ResetPassword($email);

}

?>