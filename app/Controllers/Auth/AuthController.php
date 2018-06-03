<?php 
namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{
   
    public function getSignIn($request,$response){
        return $this->view->render($response,'auth/signin.twig');
    }
    
    public function postSignIn($request,$response){
        $auth=$this->auth->attempt(
            $request->getParam('email'),
            $request->getParam('password')
        );

        if(!$auth){
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }
        return $response->withRedirect($this->router->pathFor('home'));
    
    }
    
    public function getSignUp($request,$response){
        
        var_dump($request->getAttribute('csrf_value'));

        return $this->view->render($response,'auth/signup.twig');
    }

    public function  postSignUp($request,$response){
        
        $validation=$this->validator->validate($request,[
            'email'=>v::noWhiteSpace()->notEmpty()->email()->emailAvailable(),
            'name'=>v::notEmpty()->alpha(),
            'password'=>v::noWhiteSpace()->notEmpty(),
        ]);

        // para recuperar los datos del formulario , que luego se usar en OldInputMiddleware
// $_SESSION['old']=$request->getParams();

    if($validation->failed()){
        return $response->withRedirect($this->router->pathFor('auth.signup'));
    }

        $user=User::create([
            'email'=>$request->getParam('email'),
            'name'=>$request->getParam('name'),
            'password'=>password_hash($request->getParam('password'),PASSWORD_DEFAULT),
        ]);

        return $response->withRedirect($this->router->pathFor('home'));

    }

    
}
