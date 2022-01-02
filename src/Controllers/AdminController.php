<?php 
namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

use App\Controllers\BaseController;
use App\Models\Admin;

use \Carbon\Carbon;


class AdminController extends BaseController{

    public function __construct(ContainerInterface $container){
        parent::__construct($container);
    }

    public function getIndex(Request $request, Response $response, $args) {
        
        if(isset($_SESSION['adm_user'])){
            $user = Admin::where('id',$_SESSION['adm_user'])->first();
            
            return view($response,'admin.dashboard',compact('user'));
        }else{
            return $response->withHeader('Location', 'admin/login')->withStatus(302);
        }
    }
    
    public function getAccount(Request $request, Response $response, $args){

        if(isset($_SESSION['adm_user'])){
            $user = Admin::where('id',$_SESSION['adm_user'])->first();
        }

        return view($response,'admin.account',compact('user'));
    }
    
    public function getProducts(Request $request, Response $response, $args){

        if(isset($_SESSION['adm_user'])){
            $user = Admin::where('id',$_SESSION['adm_user'])->first();
        }

        return view($response,'admin.products',compact('user'));
    }
    
    
    public function postAccountUpdate(Request $request, Response $response, $args) {
        $params = $request->getParsedBody();

        if(isset($_SESSION['adm_user'])){
            $user = Admin::where('id',$_SESSION['adm_user'])->first();
        }

        if($user){

            if(isset($params['user-pass']) && strlen($params['user-pass'])>0){
                $user->update([
                    'password'=>password_hash($params['user-pass'],PASSWORD_DEFAULT)
                ]);
                
            }
            if(isset($params['user-email'])){
                $user->update([
                    'email'=>$params['user-email']
                ]);
            }
            if($user->role==1){
                $user->update([
                    'name'=>$params['user-name']
                ]);
            }
            $payload = json_encode($params);
            $response->getBody()->write($payload);

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
        }else{
            return $response->withHeader('Location', '/recibos/admin')->withStatus(302);
        }
    }
    
    

    public function getKPI(Request $request, Response $response, $args) {
        
        if(isset($_SESSION['adm_user'])){
            $user = Admin::where('id',$_SESSION['adm_user'])->first();
        }
        $params = $request->getQueryParams();

        $data_final = array();
        
        
        $payload = json_encode($data_final);
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}