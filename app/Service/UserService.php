<?php

namespace App\Service;

use App\User;
use App\Service\Contracts\IUserService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class UserService implements IUserService
{
    /**
     * Add new user.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\User|bool
     */
    public function AddUser(Request $request)
    {
        if($this->UserValidator($request->all())->fails())
            abort(400, 'Request does not meet specifications.');       

        return $this->createUser($request->all());
    }

    /**
     * Delete user.
     * 
     * @param int $id
     * @return bool 
     */
    public function DeleteUser($id)
    {
        $user = $this->GetUser($id);
        if($user == NULL)
            return false;

        $user->delete();
        return true;
    }

    /**
     * Update user info.
     * 
     * @param Illuminate\Http\Request $request
     * @return \App\User
     */
    public function SaveUser(Request $request)
    {
        $user = $this->GetUser($request->input('id'));
        
        if($user == null || $this->UserValidator($request->all())->fails())
            return false;

        $this->updateUser($request->all(), $user);

        return $user->save();
    }
 
    /**
     * Get All User.
     * 
     * @return Illuminate\Support\Collection
     */
    public function GetAllUser()
    {
        return User::all();
    }

    /**
     * Get Certail User profile by user id.
     * 
     * @param int $id
     * @return \App\User
     */
    public function GetUser($id)
    {
        $validator = Validator::make(['User' => $id], [
            'User' => ['required', 'integer'],
        ]);

        if($validator->fails())
            return NULL;

        return User::find($id);
    }

    /**
     * Get Admin User.
     * 
     * @return Illuminate\Support\Collection
     */
    public function GetAllAdmin()
    {
        return User::where('role', 'admin');
    }

    /**
     * Get ShopHolders.
     * 
     * @return Illuminate\Support\Collection
     */
    public function GetAllShopHolder()
    {
        return User::where('role', 'ShopHolder');
    }

    /**
     * Reset User Password, will sent mail to reset.
     * 
     * @param string $email
     * @return bool
     */
    public function ResetPassword($email)
    {
        return $this->broker()->sendResetLink(['email' => $email]);
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createUser(array $data)
    {
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
        ]);

        if($validator->fails())
            return NULL;

        if(User::whereNull('deleted_at')->where('email', $data['email'])->first() != NULL)
            return NULL;

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => 'ShopHolder',
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Update user instance after a valid registration.
     *
     * @param  array  $data
     * @param  \App\User
     * @return \App\User
     */
    protected function updateUser(array $data, User &$user)
    {
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->role = $data['role'];
        $user->password = $data['password'];
        return $user;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function UserValidator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }
}

?>