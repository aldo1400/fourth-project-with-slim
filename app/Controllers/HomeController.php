<?php 
namespace App\Controllers;
// Esta linea no es necesaria por el uso de Base COntroller
use Slim\Views\Twig as View;

class HomeController extends Controller
{
   

    public function index($request,$response){

    //    var_dump($request->getParam('name')); Obtener parametros de un get  ?name
    $user=$this->db->table('users')->find(1);
    var_dump($user->email);
    die();
    return $this->view->render($response,'home.twig');
    }

    
}
