<?php

/**
 * ==============================================================================================================
 *
 * AutoRouteDbService: Classe para registro de rotas
 *
 * ----------------------------------------------------
 *
 * Created by Claudio Campos.
 * User: callcocam@gmail.com
 * https://www.sigasmart.com.br
 * ==============================================================================================================
 */
namespace App;


use Illuminate\Routing\Router;

class AutoRouteDbService
{
   /**
     * @var Router
     */
    private $route;
    /**
     * @var StoredRoute
     */
    private $storedRoute;


    /**
     * AbstractRoute constructor.
     * @param StoredRoute $storedRoute
     * @param Router $route
     */
    public function __construct(StoredRoute $storedRoute, Router $route)
    {

        $this->route = $route;
        $this->storedRoute = $storedRoute;
    }

    /**
     * @param string $assets
     * @return Router
     */
    public function register($assets='admin')
    {

        $stores = $this->storedRoute->findBy([
            'assets'=>$assets
        ])->get();

        if($stores):

            foreach ($stores as $stored):

                switch ($stored->verb):
                    case 'post':
                        $this->post($stored->controller,$stored->pattern,$stored->route,$stored->prefix, $stored->method);
                        break;
                    case 'put':
                        $this->put($stored->controller,$stored->pattern,$stored->route,$stored->prefix, $stored->method);
                        break;
                    case 'delete':
                        $this->delete($stored->controller,$stored->pattern,$stored->route,$stored->prefix, $stored->method);
                        break;
                    case 'any':
                        $this->any($stored->controller,$stored->pattern,$stored->route,$stored->prefix, $stored->method);
                        break;
                    case 'rs':
                        $this->resources($stored->controller,$stored->pattern,$stored->route,$stored->prefix);
                        break;
                    default:
                        $this->get($stored->controller,$stored->pattern,$stored->route,$stored->prefix, $stored->method);
                        break;
                endswitch;

            endforeach;

        endif;
        return $this->route;
    }


    private function resources($controller,$pattern,$route,$prefix){

        $this->route->resource($pattern, $controller)->names([
            'index'=>sprintf('%s.admin.%s.index',$prefix, $route),
            'create'=>sprintf('%s.admin.%s.create',$prefix, $route),
            'store'=>sprintf('%s.admin.%s.store',$prefix, $route),
            'show'=>sprintf('%s.admin.%s.show',$prefix, $route),
            'edit'=>sprintf('%s.admin.%s.edit',$prefix, $route),
            'update'=>sprintf('%s.admin.%s.update',$prefix, $route),
            'destroy'=>sprintf('%s.admin.%s.destroy',$prefix, $route),
        ]);


    }

    private function post($controller,$pattern,$route,$prefix, $method){
        $this->route->post($pattern, sprintf("%s@%s", $controller, $method))
            ->name(sprintf('%s.admin.%s.store',$prefix, $route));

    }
    private function put($controller,$pattern,$route,$prefix, $method){
        $this->route->put($pattern, sprintf("%s@%s", $controller, $method))
            ->name(sprintf("%s.%s",$prefix,$route));
    }
    private function delete($controller,$pattern,$route,$prefix, $method){
        $this->route->delete($pattern, sprintf("%s@%s", $controller, $method))
            ->name(sprintf("%s.%s",$prefix,$route));
    }
    private function any($controller,$pattern,$route,$prefix,$method){
        $this->route->any($pattern, sprintf("%s@%s", $controller, $method))
            ->name(sprintf("%s.%s",$prefix,$route));
    }
    private function get($controller,$pattern,$route,$prefix, $method){
        $this->route->get($pattern, sprintf("%s@%s", $controller, $method))
            ->name(sprintf("%s.%s",$route));
    }


}
