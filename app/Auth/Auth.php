<?php
namespace App\Auth;
use App\Models\User;

class Auth{
    
    public function user(){
        return User::find($_SESSION['user']);
    }
    public function check(){
        return isset($_SESSION['user']);
    }
    public function attempt($email,$password){
        // guardar el email del user
        
        $user=User::where('email',$email)->first();
        
        // si el susuario no existe
        
        if(!$user){
            return false;
        }

        // verficar el password de ese usuario

        if(password_verify($password,$user->password)){
            $_SESSION['user']=$user->id;
            return true;
        }
        
        return false;
        // colocar los datos del usuario logeado en variables de sesion


    }
}