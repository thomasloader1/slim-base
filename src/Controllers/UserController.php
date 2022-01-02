<?php 
namespace App\Controllers;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

use App\Controllers\BaseController;
use App\Models\Admin;
use App\Models\Employee;

class UserController extends BaseController{

    static private $user;

    public function __construct(ContainerInterface $container){
        // if(!isset(static::$user))
        //     static::$user = new \App\Models\User($container);
        parent::__construct($container);
        
    }

    public function getUsers(Request $request, Response $response, $args){
        
        if(isset($_SESSION['adm_user'])){
            $user = Admin::where('id',$_SESSION['adm_user'])->first();
        }

        if($user->role == 1){
            return view($response,'admin.users',compact('user'));
        }else{
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }

    public function postUser(Request $request, Response $response, $args){
        $params = $request->getParsedBody();
        
        if(isset($_SESSION['adm_user'])){
            $user = Admin::where('id',$_SESSION['adm_user'])->first();
        }

        if($user->role == 1){
            
            if(count($params)>0){
                $new_user = Admin::create([
                    'name'=>$params['modal-add-user-name'],
                    'username'=>$params['modal-add-user-username'],
                    'email'=>$params['modal-add-user-email'],
                    'password'=>password_hash($params['modal-add-user-pass'],PASSWORD_DEFAULT),
                    'role' => $params['modal-add-user-role']
                ]);
            }

            $new_pass = $params['modal-add-user-pass'];
            $subject = 'Confirmación de cuenta';
            $body = fetchView('mails.welcome',compact('new_user','new_pass'));
            $result_mail = sendMail($params['modal-add-user-email'],$params['modal-add-user-name'],$body,$subject);
            $params['result_mail'] = $result_mail;
            $payload = json_encode($params);
            $response->getBody()->write($payload);

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
            return view($response,'admin.users',compact('user'));
        }else{
            return $response->withHeader('Location', '/recibos/')->withStatus(302);
        }
    }

    public function getUsersTable(Request $request, Response $response, $args) {
        
        if(isset($_SESSION['adm_user'])){
            $user = Admin::where('id',$_SESSION['adm_user'])->first();
        }
        
        $params = $request->getQueryParams();

        $array = array(
            'draw'=> $params['draw'],
            'recordsTotal'=> 0,
            'recordsFiltered'=> 0,
            'data'=> array()
        );

        if($user->role == 1){
            $query = $params['search']['value'];

            $arr_users_tot = Admin::where('name', 'LIKE', '%'.$query.'%')->orWhere('email', 'LIKE', '%'.$query.'%')->orWhere('username', 'LIKE', '%'.$query.'%')->get();
            $arr_users = Admin::where('name', 'LIKE', '%'.$query.'%')->orWhere('email', 'LIKE', '%'.$query.'%')
                            ->orderBy('name','asc')
                            ->skip($params['start'])->take($params['length'])->get();
            
            foreach($arr_users as $user){
                switch ($user->role) {
                    case 1:
                        $role = 'Administrador';
                        break;
                    case 2:
                        $role = 'Editor';
                        break;
                    case 3:
                        $role = 'Ventas';
                        break;
                    case 4:
                        $role = 'Ventas MercadoLibre';
                        break;
                    case 5:
                        $role = 'Ventas Web';
                        break;
                    
                    default:
                    $role = '';
                        break;
                }

                $array['data'][] = array(
                    $user->email,
                    $user->name,
                    $role,
                    '<a href="#" onclick="toogleEditModal('.$user->id.')"><i class="simple-icon-pencil"></i> Editar</a><br>'.
                    '<a href="#" onclick="deleteUser('.$user->id.')"><i class="simple-icon-trash"></i> Eliminar</a><br>',
                );
            }
            $array['recordsTotal'] = $arr_users_tot->count();
            $array['recordsFiltered'] = $arr_users_tot->count();
        }
        
        $payload = json_encode($array);
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }

    public function getUserModalEdit(Request $request, Response $response, $args) {
        $params = $request->getQueryParams();
        
        if(isset($_SESSION['adm_user'])){
            $user = Admin::where('id',$_SESSION['adm_user'])->first();
        }
        
        if($user->role == 1){
            if(isset($params['id'])){
                $user_edit = Admin::where('id',$params['id'])->first();
            }else{
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(401);
            }
            
            return view($response,'admin.components.modals.edit-user',compact('user_edit','user'));
        }else{
            $payload = json_encode($user);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }
    }

    public function deleteUser(Request $request, Response $response, $args) {
        
        if(isset($_SESSION['adm_user'])){
            $user = Admin::where('id',$_SESSION['adm_user'])->first();
        }
        
        if($args && $user->role==1){
            
            if(isset($args['id'])){
                $user = Admin::where('id',$args['id'])->first();
                
                $user->delete();
            }else{
                $payload = json_encode($args);
                $response->getBody()->write($payload);
    
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(402);
            }
            
            $payload = json_encode($args);
            $response->getBody()->write($payload);

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
        }else{
            $payload = json_encode($user);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }
    }

    public function postUserUpdate(Request $request, Response $response, $args) {
        $params = $request->getParsedBody();
        
        if(isset($_SESSION['adm_user'])){
            $user = Admin::where('id',$_SESSION['adm_user'])->first();
        }
        
        if($user->role == 1){

            $user_edit = Admin::where('id',$params['modal-edit-user-id'])->first();
            $user_edit->update([
                'name'=>$params['modal-edit-user-name'],
                'username'=>$params['modal-edit-user-username'],

            ]);

            if(isset($params['modal-edit-user-pass']) && strlen($params['modal-edit-user-pass'])>0){
                $user_edit->update([
                    'password'=>password_hash($params['modal-edit-user-pass'],PASSWORD_DEFAULT)
                ]);
            }
            
            if(isset($params['resend-data'])&&$params['resend-data']=="on"){
                $new_user = $user_edit;
                $new_pass = $params['modal-edit-user-pass'];
                $subject = 'Confirmación de cuenta';
                $body = fetchView('mails.welcome',compact('new_user','new_pass'));
                $result_mail = sendMail($params['modal-edit-user-email'],$params['modal-edit-user-name'],$body,$subject);
                $params['result_mail'] = $result_mail;
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
}