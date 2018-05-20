<?php 
namespace App\Controllers;
// Esta linea no es necesaria por el uso de Base COntroller
use Slim\Views\Twig as View;
use App\Models\User; 

class HomeController extends Controller
{
   

    public function index($request,$response){

    //    var_dump($request->getParam('name')); Obtener parametros de un get  ?name
    User::create([
        'name'=>'Alex Garret',
        'email'=>'billy@codecourse',
        'password'=>'123',
    ]);
    return $this->view->render($response,'home.twig');
    }

    
}
