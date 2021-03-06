<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Interfaces\Member;
use Illuminate\Support\Facades\Auth;
class User extends Authenticatable implements Member 
{
    use Notifiable;

    protected $fillable = [
        'postal_code', 'province','card_id', 'sub_area', 'road', 'area', 'lane', 'last_name', 'email', 'password', 'first_name', 'role_id', 'address', 'tel_home', 'tel_mobile', 'house_no', 'village_no'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function login($user){
        Auth::login($user);
    }
    public function logout(){
        Auth::logout();
    }
    public function register($user){
       return $this->create($user);
    }
   
    public function getRole()
    {
        return $this->hasOne("App\Role", "id", "role_id");
    }

    public function updateProfile($user)
    {
        $this->where("id", $user->id)->update($user);
    }

    public function upgradeAccount($roleId){
        $this->update(["role_id" => $roleId]);
    }

}
