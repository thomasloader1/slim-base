<?php 
namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

use App\Controllers\BaseController;
use App\Models\Admin;

class AuthController extends BaseController{

    public function __construct(ContainerInterface $container){
        
        parent::__construct($container);
        
    }

    public function getAdminLogIn(Request $request, Response $response, $args) {
        if(isset($_SESSION['adm_user'])){
            $user = Admin::where('id',$_SESSION['adm_user'])->first();
        }else{
            $user = null;
        }
        
        return view($response,'admin.login',compact('user'));
    }

    public function postAdminLogIn(Request $request, Response $response, $args) {
        $params = $request->getParsedBody();
        $loged = false;
        if(isset($_SESSION['adm_user'])){
            $loged = true;
        }
        if(!$loged){
            $name = $params['name'];
            $password = $params['password'];
    
            $att = $this->attemptAdmin($name,$password);
            if($att > 0){
                if($att == 2){
                    return $response->withHeader('Location', siteUrl('/admin'))->withStatus(302);
                }else{

                    return $response->withHeader('Location', siteUrl('/admin'))->withStatus(302);
                }
            }else{
                return $response->withHeader('Location', '/admin/login')->withStatus(302);
            }
        }else{
            return $response->withHeader('Location', '/admin')->withStatus(302);
        }
    }

    public function getAdminLogOut(Request $request, Response $response, $args) {
        unset($_SESSION['adm_user']);
        unset($_SESSION['user']);
        unset($_SESSION['role']);

        return $response->withHeader('Location', '/recibos/login')->withStatus(302);
    }
    

    public function attemptAdmin($name,$password){
        
        $user = Admin::where('email',$name)->orWhere('username',$name)->first();
        
        if (!$user){
            
            return 0;
        }

        if(password_verify($password,$user->password)){
            $_SESSION['adm_user'] = $user->id;
            $_SESSION['role'] = $user->role;
            return 1;
        }
        return 0;
    }
}