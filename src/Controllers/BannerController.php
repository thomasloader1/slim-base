<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

use App\Controllers\BaseController;
use App\Models\Admin;
use App\Models\Banner;
use App\Models\BannerType;

class BannerController extends BaseController
{

    static private $user;

    public function __construct(ContainerInterface $container)
    {
        // if(!isset(static::$user))
        //     static::$user = new \App\Models\User($container);
        parent::__construct($container);
    }

    public function getBanners(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {
            return view($response, 'admin.banners.list-banner', compact('user'));
        } else {
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }

    public function getSortBanners(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {
            $banners = Banner::where('active', 1)
                ->orderBy('order', 'asc')
                ->get();

            return view($response, 'admin.banners.sort-banner', compact('user', 'banners'));
        } else {
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }




    public function getBannersTable(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        $params = $request->getQueryParams();

        $array = array(
            'draw' => $params['draw'],
            'recordsTotal' => 0,
            'recordsFiltered' => 0,
            'data' => array()
        );

        if ($user->role == 1) {
            $query = $params['search']['value'];

            $arr_banners_tot = Banner::where('name', 'LIKE', '%' . $query . '%')->get();
            $arr_banners = Banner::where('name', 'LIKE', '%' . $query . '%')
                ->orderBy('order', 'asc')
                ->skip($params['start'])->take($params['length'])->get();

            foreach ($arr_banners as $banner) {

                $string_actions =  '<a href="'.siteUrl("admin/banners/edit/").  $banner->id.'" onclick="toogleEditModal(' . $banner->id . ')"><i class="simple-icon-pencil"></i> Editar</a><br>' .
                    '<a href="#" onclick="deleteBanner(' . $banner->id . ')"><i class="simple-icon-trash"></i> Eliminar</a><br>';

                if ($banner->active == 1) {
                    $string_switch = "<input checked=\"checked\" type=\"checkbox\" class=\"iswitch iswitch-primary \"  id=\"check-" . $banner->id . "\" onclick=\"javascript:productosactivar(" . $banner->id . ");\" >";
                } else {
                    $string_switch = "<input type=\"checkbox\" class=\"iswitch iswitch-primary \"  id=\"check-" . $banner->id . "\" onclick=\"javascript:productosactivar(" . $banner->id . ");\" >";
                }

                $array['data'][] = array(
                    siteUrl($banner->path_background),
                    $string_switch,
                    $banner->name,
                    $banner->type_details->name,
                    $string_actions,
                );
            }
            $array['recordsTotal'] = $arr_banners_tot->count();
            $array['recordsFiltered'] = $arr_banners_tot->count();
        }

        $payload = json_encode($array);
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }

    public function postSortBanners(Request $request, Response $response, $args)
    {
        $params = $request->getParsedBody();

        $user = Admin::where('id', $_SESSION['adm_user'])->first();
        if ($user) {

            foreach ($params['banners'] as $order => $banner_id) {
                Banner::where('id', $banner_id)->update([
                    'order' => $order
                ]);
            }

            $payload = json_encode($params);
            $response->getBody()->write($payload);

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
        } else {
            $payload = json_encode($params);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }
    }

    public function getAddBanners(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {
            $banner_types = BannerType::orderBy('name')->get();
            return view($response, 'admin.banners.add-banner', compact('user', 'banner_types'));
        } else {
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }

    public function postAddBanners(Request $request, Response $response, $args)
    {
        $directory = $this->container->get('upload_directory');
        //   RECOLECTAR DATOS Y GUARDARLOS EN LA VARIABLE PARAMS
        $params = $request->getParsedBody();
        $uploadedFiles = $request->getUploadedFiles();





        //  CORROBORA SESION USUARIO 
        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {

            // INYECTAR DATOS DE PARAMS EN LA BASE

            if (count($params) > 0) {
                $new_user = Banner::create([
                    'type' => $params['banner-type'], // POR PRIMER PARAMETRO SE PASA EL VALOR QUE FIGURA EN LA BASE DE DATOS, COMO SEGUNDO LO QUE LLEGA EN EL FORM
                    'name' => $params['banner-name'],
                    'banner_title' => $params['banner-title'],
                    'banner_description' => $params['banner-description']
                ]);
            }
            if (count($uploadedFiles) > 0) {
                $bannerImage = $uploadedFiles['banner-file'];
                if ($bannerImage->getError() === UPLOAD_ERR_OK) {
                    $filename = moveUploadedFile($directory, $bannerImage);
                    $new_user->update([
                        'path_background' => 'images/' . $filename
                    ]);
                }
            }

            $payload = json_encode($params);
            $response->getBody()->write($payload);

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
        } else {
            $payload = json_encode($params);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }
    }



    public function getEditBanners(Request $request, Response $response, $args)
    { 
        //  CORROBORA SESION USUARIO 

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {
            $banner_types = BannerType::orderBy('name')->get();

            $banner= Banner::where('id', $args['id'])->first();

            return view($response, 'admin.banners.edit.banner', compact('user', 'banner' ,'banner_types'));
        } else {
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }


    public function postEditBanners(Request $request, Response $response, $args)
    {
        $directory = $this->container->get('upload_directory');
        //   RECOLECTAR DATOS Y GUARDARLOS EN LA VARIABLE PARAMS
        $params = $request->getParsedBody();
        $uploadedFiles = $request->getUploadedFiles();





        //  CORROBORA SESION USUARIO 
        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {

            // INYECTAR DATOS DE PARAMS EN LA BASE

            if (count($params) > 0) {
                $banner= Banner::where('id', $args['id'])->first();
                $banner->update([
                    'type' => $params['banner-type'], // POR PRIMER PARAMETRO SE PASA EL VALOR QUE FIGURA EN LA BASE DE DATOS, COMO SEGUNDO LO QUE LLEGA EN EL FORM
                    'name' => $params['banner-name'],
                    'banner_title' => $params['banner-title'],
                    'banner_description' => $params['banner-description']
                ]);
            };
            if (count($uploadedFiles) > 0) {
                $bannerImage = $uploadedFiles['banner-file'];
                if ($bannerImage->getError() === UPLOAD_ERR_OK) {
                    $filename = moveUploadedFile($directory, $bannerImage);
                    $banner->update([
                        'path_background' => 'images/' . $filename
                    ]);
                }
            }

            $payload = json_encode($params);
            $response->getBody()->write($payload);

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
        } else {
            $payload = json_encode($params);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }
    }



    public function postActiveBanners(Request $request, Response $response, $args)
    {
        $directory = $this->container->get('upload_directory');
        //   RECOLECTAR DATOS Y GUARDARLOS EN LA VARIABLE PARAMS
        $params = $request->getParsedBody();
        $uploadedFiles = $request->getUploadedFiles();

        //  CORROBORA SESION USUARIO 
        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {

            // INYECTAR DATOS DE PARAMS EN LA BASE

            if (count($params) > 0) {
                $new_user = Banner::where('id', $params['id_banner'])->update([
                    'active' => $params['status'], // POR PRIMER PARAMETRO SE PASA EL VALOR QUE FIGURA EN LA BASE DE DATOS, COMO SEGUNDO LO QUE LLEGA EN EL FORM
                ]);
            }

            $payload = json_encode($params);
            $response->getBody()->write($payload);

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
        } else {
            $payload = json_encode($params);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }
    }

    public function deleteBanners(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($args && $user->role == 1) {

            if (isset($args['id'])) {
                $banner = Banner::where('id', $args['id'])->first();

                $banner->delete();
            } else {
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
        } else {
            $payload = json_encode($user);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }
    }

    // public function postUserUpdate(Request $request, Response $response, $args) {
    //     $params = $request->getParsedBody();

    //     if(isset($_SESSION['adm_user'])){
    //         $user = Admin::where('id',$_SESSION['adm_user'])->first();
    //     }

    //     if($user->role == 1){

    //         $user_edit = Admin::where('id',$params['modal-edit-user-id'])->first();
    //         $user_edit->update([
    //             'name'=>$params['modal-edit-user-name'],
    //             'username'=>$params['modal-edit-user-username'],

    //         ]);

    //         if(isset($params['modal-edit-user-pass']) && strlen($params['modal-edit-user-pass'])>0){
    //             $user_edit->update([
    //                 'password'=>password_hash($params['modal-edit-user-pass'],PASSWORD_DEFAULT)
    //             ]);
    //         }

    //         if(isset($params['resend-data'])&&$params['resend-data']=="on"){
    //             $new_user = $user_edit;
    //             $new_pass = $params['modal-edit-user-pass'];
    //             $subject = 'Confirmación de cuenta';
    //             $body = fetchView('mails.welcome',compact('new_user','new_pass'));
    //             $result_mail = sendMail($params['modal-edit-user-email'],$params['modal-edit-user-name'],$body,$subject);
    //             $params['result_mail'] = $result_mail;
    //         }

    //         $payload = json_encode($params);
    //         $response->getBody()->write($payload);

    //         return $response
    //             ->withHeader('Content-Type', 'application/json')
    //             ->withStatus(201);
    //     }else{
    //         return $response->withHeader('Location', '/recibos/admin')->withStatus(302);
    //     }
    // }
}
