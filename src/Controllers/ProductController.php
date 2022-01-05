<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

use App\Controllers\BaseController;
use App\Models\Admin;
use App\Models\Banner;
use App\Models\BannerType;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductImage;

class ProductController extends BaseController
{

    static private $user;

    public function __construct(ContainerInterface $container)
    {
        // if(!isset(static::$user))
        //     static::$user = new \App\Models\User($container);
        parent::__construct($container);
    }

    public function getProducts(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {
            return view($response, 'admin.products.list-product', compact('user'));
        } else {
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }





    public function getProductsTable(Request $request, Response $response, $args)
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

            $arr_products_tot = Product::where('name', 'LIKE', '%' . $query . '%')->get();
            $arr_products = Product::where('name', 'LIKE', '%' . $query . '%')
                ->skip($params['start'])->take($params['length'])->get();

            foreach ($arr_products as $product) {

                $string_actions =  '<a href="' . siteUrl("admin/products/edit/") .  $product->id . '" onclick="toogleEditModal(' . $product->id . ')"><i class="simple-icon-pencil"></i> Editar</a><br>' .
                    '<a href="#" onclick="deleteProducts(' . $product->id . ')"><i class="simple-icon-trash"></i> Eliminar</a><br>' .
                    '<a href="' . siteUrl("admin/products/image-sort/") .  $product->id . '" onclick="toogleEditModal(' . $product->id . ')"><i class="simple-icon-picture"></i> Ordenar Imágenes</a><br>';

                if ($product->active == 1) {
                    $string_switch = "<input checked=\"checked\" type=\"checkbox\" class=\"iswitch iswitch-primary \"  id=\"check-" . $product->id . "\" onclick=\"javascript:productosactivar(" . $product->id . ");\" >";
                } else {
                    $string_switch = "<input type=\"checkbox\" class=\"iswitch iswitch-primary \"  id=\"check-" . $product->id . "\" onclick=\"javascript:productosactivar(" . $product->id . ");\" >";
                }

                $array['data'][] = array(
                    siteUrl($product->images->first()->path),
                    $string_switch,
                    $product->name,
                    $product->category->name,
                    $product->brand->name,
                    $string_actions,
                );
            }
            $array['recordsTotal'] = $arr_products_tot->count();
            $array['recordsFiltered'] = $arr_products_tot->count();
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

    public function getAddProducts(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {
            //$categories = Category::orderBy('name')->get();
            return view($response, 'admin.products.add-product', compact('user'));
        } else {
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }
    public function getSelectCategory(Request $request, Response $response, $args)
    {
        $user = Admin::where('id', $_SESSION['adm_user'])->first();
        $params = $request->getQueryParams();
        $array = array(
            'results' => array()
        );
        if ($user->role == 1) {
            if (isset($params['q'])) {
                $arr_contracts = Category::where('name', 'LIKE', '%' . $params['q'] . '%')->orderBy('name', 'ASC')->get();
            } else {
                $arr_contracts = Category::all();
            }

            foreach ($arr_contracts as $contract) {
                $array['results'][] = array(
                    'id' => $contract->id,
                    'text' => $contract->name
                );
            }
        }
        $payload = json_encode($array);
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }

    public function postAddProducts(Request $request, Response $response, $args)
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
                $new_product = Product::create([
                    'brand_id' => $params['brand'], // POR PRIMER PARAMETRO SE PASA EL VALOR QUE FIGURA EN LA BASE DE DATOS, COMO SEGUNDO LO QUE LLEGA EN EL FORM
                    'category_id' => $params['category'],
                    'name' => $params['name'],
                    'price' => $params['price'],
                    'currency' => $params['currency'],
                    'bonus' => $params['bonus'],
                    'shipping_weight' => $params['shipping_weight'],
                    'shipping_height' => $params['shipping_height'],
                    'shipping_width' => $params['shipping_width'],
                    'shipping_length' => $params['shipping_length'],
                    'weight' => $params['weight'],
                    'dimention' => $params['dimention'],
                    'description' => $params['description']
                ]);
                $images = ProductImage::where('product_id', $params['idTemporal'])->update(
                    [
                        'product_id' => $new_product->id  // Y AL PRODUCT_ID ACTUALIZADO CON EL ID TEMPORAL DENTRO SE LO VINCULA CON EL ID DEL PRODUCTO
                    ]
                );
            }
            $payload = json_encode($new_product);
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

    public function getEditProducts(Request $request, Response $response, $args)
    {
        //  CORROBORA SESION USUARIO 

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {

            $product = Product::where('id', $args['id'])->first();
            $categories = Category::orderBy('name')->get();

            return view($response, 'admin.products.edit-product', compact('user', 'product', 'categories'));
        } else {
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }


    public function postEditProducts(Request $request, Response $response, $args)
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
                $product = Product::where('id', $args['id'])->first();
                $product->update([
                    'brand_id' => $params['brand'], // POR PRIMER PARAMETRO SE PASA EL VALOR QUE FIGURA EN LA BASE DE DATOS, COMO SEGUNDO LO QUE LLEGA EN EL FORM
                    'category_id' => $params['category'],
                    'name' => $params['name'],
                    'price' => $params['price'],
                    'currency' => $params['currency'],
                    'bonus' => $params['bonus'],
                    'weight' => $params['weight'],
                    'dimention' => $params['dimention'],
                    'description' => $params['description']
                ]);
                $images = ProductImage::where('product_id', $params['idTemporal'])->update(
                    [
                        'product_id' => $product->id  // Y AL PRODUCT_ID ACTUALIZADO CON EL ID TEMPORAL DENTRO SE LO VINCULA CON EL ID DEL PRODUCTO
                    ]
                );
            };
            $payload = json_encode($product);
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



    public function postActiveProducts(Request $request, Response $response, $args)
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
                $new_user = Product::where('id', $params['id_product'])->update([
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

    public function deleteProducts(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if (isset($args) && $user->role == 1) {

            if (isset($args['id'])) {
                $product = Product::where('id', intval($args['id']))->first();
                $product->delete();

                $payload = json_encode($product);
                $response->getBody()->write($payload);

                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(201);
            }
        } else {
            $payload = json_encode($user);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }
    }


    //
    //SECCIÓN DE IMÁGENES
    //


    public function postAddImages(Request $request, Response $response, $args)
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

            if (count($uploadedFiles) > 0) {
                $productImage = $uploadedFiles['file'];
                if ($productImage->getError() === UPLOAD_ERR_OK) {
                    $filename = moveUploadedFile($directory, $productImage);
                    ProductImage::create([
                        'product_id' => $args['id'],
                        'path' => 'images/' . $filename,
                        'size' => $productImage->getSize()
                    ]);
                }
            }

            $arr = array(
                'success' => true,
                'payload' => 'My message'
            );
            $payload = json_encode($arr);
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


    public function getSortImages(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {

            $product = Product::where('id', $args['id'])->first();

            return view($response, 'admin.products.image-sort', compact('user', 'product'));
        } else {
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }

    public function postSortImages(Request $request, Response $response, $args)
    {
        $params = $request->getParsedBody();




        $user = Admin::where('id', $_SESSION['adm_user'])->first();
        if ($user) {

            foreach ($params['images'] as $img_order => $imageid) {
                ProductImage::where('id', $imageid)->update([
                    'img_order' => $img_order
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



    //
    //SECCIÓN DE CATEGORIAS
    //


    public function getCategory(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {
            return view($response, 'admin.categories.list-category', compact('user'));
        } else {
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }

    public function getCategoryTable(Request $request, Response $response, $args)
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

            $arr_category_tot = Category::where('name', 'LIKE', '%' . $query . '%')->get();
            $arr_category = Category::where('name', 'LIKE', '%' . $query . '%')
                ->skip($params['start'])->take($params['length'])->get();

            foreach ($arr_category as $category) {

                $string_actions =  '<a href="' . siteUrl("admin/categories/edit/") .  $category->id . '" onclick="toogleEditModal(' . $category->id . ')"><i class="simple-icon-pencil"></i> Editar</a><br>' .
                    '<a href="#" onclick="deleteProducts(' . $category->id . ')"><i class="simple-icon-trash"></i> Eliminar</a><br>';


                $array['data'][] = array(
                    siteUrl($category->banner),
                    $category->name,
                    $string_actions
                );
            }
            $array['recordsTotal'] = $arr_category_tot->count();
            $array['recordsFiltered'] = $arr_category_tot->count();
        }

        $payload = json_encode($array);
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }


    public function getAddCategory(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {

            return view($response, 'admin.categories.add-category ', compact('user'));
        } else {
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }



    public function getEditCategory(Request $request, Response $response, $args)
    {
        //  CORROBORA SESION USUARIO 

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {

            $product = Category::where('id', $args['id'])->first();

            return view($response, 'admin.categories.edit-category', compact('user', 'product'));
        } else {
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }

    public function postEditCategory(Request $request, Response $response, $args)
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
                $category = Category::where('id', $args['id'])->first();
                $category->update([
                    'name' => $params['name'], // POR PRIMER PARAMETRO SE PASA EL VALOR QUE FIGURA EN LA BASE DE DATOS, COMO SEGUNDO LO QUE LLEGA EN EL FORM
                ]);
            };
            if (count($uploadedFiles) > 0) {
                $categoryImage = $uploadedFiles['category-file'];
                if ($categoryImage->getError() === UPLOAD_ERR_OK) {
                    $filename = moveUploadedFile($directory, $categoryImage);
                    $category->update([
                        'banner' => 'images/' . $filename
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


    public function postAddCategory(Request $request, Response $response, $args)
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
                $new_category = Category::create([
                    'name' => $params['category-name'], // POR PRIMER PARAMETRO SE PASA EL VALOR QUE FIGURA EN LA BASE DE DATOS, COMO SEGUNDO LO QUE LLEGA EN EL FORM

                ]);

                if (count($uploadedFiles) > 0) {
                    $categoryImage = $uploadedFiles['category-file'];
                    if ($categoryImage->getError() === UPLOAD_ERR_OK) {
                        $filename = moveUploadedFile($directory, $categoryImage);
                        $new_category->update([
                            'banner' => 'images/' . $filename
                        ]);
                    }
                }

                $payload = json_encode($new_category);
                $response->getBody()->write($payload);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(201);
            }
        } else {
            $payload = json_encode($params);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }
    }
    public function deleteCategory(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if (isset($args) && $user->role == 1) {

            if (isset($args['id'])) {
                $product = Category::where('id', intval($args['id']))->first();
                $product->delete();

                $payload = json_encode($product);
                $response->getBody()->write($payload);

                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(201);
            }
        } else {
            $payload = json_encode($user);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }
    }

    //
    //SECCIÓN DE MARCAS
    //


    public function getBrand(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {
            return view($response, 'admin.brands.list-brand', compact('user'));
        } else {
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }


    public function getBrandTable(Request $request, Response $response, $args)
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

            $arr_brand_tot = Brand::where('name', 'LIKE', '%' . $query . '%')->get();
            $arr_brand = Brand::where('name', 'LIKE', '%' . $query . '%')
                ->skip($params['start'])->take($params['length'])->get();

            foreach ($arr_brand as $brand) {

                $string_actions =  '<a href="' . siteUrl("admin/brands/edit/") .  $brand->id . '" onclick="toogleEditModal(' . $brand->id . ')"><i class="simple-icon-pencil"></i> Editar</a><br>' .
                    '<a href="#" onclick="deleteProducts(' . $brand->id . ')"><i class="simple-icon-trash"></i> Eliminar</a><br>';


                $array['data'][] = array(
                    siteUrl($brand->image),
                    $brand->name,
                    $string_actions
                );
            }
            $array['recordsTotal'] = $arr_brand_tot->count();
            $array['recordsFiltered'] = $arr_brand_tot->count();
        }

        $payload = json_encode($array);
        $response->getBody()->write($payload);

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }

    public function getAddBrand(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {

            return view($response, 'admin.brands.add-brand ', compact('user'));
        } else {
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }

    public function getEditBrand(Request $request, Response $response, $args)
    {
        //  CORROBORA SESION USUARIO 

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if ($user->role == 1 || $user->role == 2) {

            $brand = Brand::where('id', $args['id'])->first();

            return view($response, 'admin.brands.edit-brand', compact('user', 'brand'));
        } else {
            return $response->withHeader('Location', siteUrl('/'))->withStatus(302);
        }
    }

    public function postAddBrand(Request $request, Response $response, $args)
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
                $new_brand = Brand::create([
                    'name' => $params['brand-name'], // POR PRIMER PARAMETRO SE PASA EL VALOR QUE FIGURA EN LA BASE DE DATOS, COMO SEGUNDO LO QUE LLEGA EN EL FORM
                ]);

                if (count($uploadedFiles) > 0) {
                    $brandImage = $uploadedFiles['brand-file'];
                    if ($brandImage->getError() === UPLOAD_ERR_OK) {
                        $filename = moveUploadedFile($directory, $brandImage);
                        $new_brand->update([
                            'image' => 'images/' . $filename
                        ]);
                    }
                }

                $payload = json_encode($new_brand);
                $response->getBody()->write($payload);
                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(201);
            }
        } else {
            $payload = json_encode($params);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }
    }

    public function postEditBrand(Request $request, Response $response, $args)
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
                $brand = Brand::where('id', $args['id'])->first();
                $brand->update([
                    'name' => $params['name'], // POR PRIMER PARAMETRO SE PASA EL VALOR QUE FIGURA EN LA BASE DE DATOS, COMO SEGUNDO LO QUE LLEGA EN EL FORM
                ]);
            };
            if (count($uploadedFiles) > 0) {
                $brandImage = $uploadedFiles['brand-file'];
                if ($brandImage->getError() === UPLOAD_ERR_OK) {
                    $filename = moveUploadedFile($directory, $brandImage);
                    $brand->update([
                        'image' => 'images/' . $filename
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

    public function deleteBrand(Request $request, Response $response, $args)
    {

        if (isset($_SESSION['adm_user'])) {
            $user = Admin::where('id', $_SESSION['adm_user'])->first();
        }

        if (isset($args) && $user->role == 1) {

            if (isset($args['id'])) {
                $product = Brand::where('id', intval($args['id']))->first();
                $product->delete();

                $payload = json_encode($product);
                $response->getBody()->write($payload);

                return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(201);
            }
        } else {
            $payload = json_encode($user);
            $response->getBody()->write($payload);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }
    }

    public function getSelectBrand(Request $request, Response $response, $args)
    {
        $user = Admin::where('id', $_SESSION['adm_user'])->first();
        $params = $request->getQueryParams();
        $array = array(
            'results' => array()
        );
        if ($user->role == 1) {
            if (isset($params['q'])) {
                $arr_contracts = Brand::where('name', 'LIKE', '%' . $params['q'] . '%')->orderBy('name', 'ASC')->get();
            } else {
                $arr_contracts = Brand::all();
            }

            foreach ($arr_contracts as $contract) {
                $array['results'][] = array(
                    'id' => $contract->id,
                    'text' => $contract->name
                );
            }
        }

        $payload = json_encode($array);
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }


    public function postActiveBrand(Request $request, Response $response, $args)
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
                $new_user = Brand::where('id', $params['id_banner'])->update([
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
}
