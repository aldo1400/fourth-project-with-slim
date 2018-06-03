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
       
    }   

}
