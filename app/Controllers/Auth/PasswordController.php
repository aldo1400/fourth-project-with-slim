<?php 
namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v;

class PasswordController extends Controller
{
   public function getChangePassword($request,$response){
        return $this->view->render($response,'auth/password/change.twig');
   } 

   public function postChangePassword($request,$response){
    
    // primero debemos verificar si la persona ha llenado el formulario
    $validation=$this->validator->validate($request,[
            'password_old'=>v::noWhiteSpace()->notEmpty()->matchesPassword($this->auth->user()->password),
            'password'=>v::noWhiteSpace()->notEmpty(),

        ]);    
    

    // si no ha llenado

    if($validation->failed())
    {
        return $response->withRedirect($this->router->pathFor('auth.password.change'));

    }

    $this->auth->user()->setPassword($request->getParam('password'));

    // flash message

    $this->flash->addMessage('info','Your password has changed');

    return $response->withRedirect($this->router->pathFor('home'));
    
    }
}
