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
namespace App\Suports\ManualRoute;


use Illuminate\Routing\Router;

class AbstractRoute
{
   /**
     * @var Router
     */
    private $route;


    /**
     * AbstractRoute constructor.
     * @param Router $route
     */
    function __construct(Router $route)
    {

        $this->route = $route;
    }

    /**
     * @param $controller
     * @param $pattern
     * @param $verb
     * @param $route
     * @param $prefix
     * @return Router
     */
    public function register($controller, $route, $pattern="" , $method="index", $verb="rs", $prefix ='api')
    {
        switch ($verb):
            case 'post':
                $this->post($controller,$pattern,$route,$prefix, $method);
                break;
            case 'put':
                $this->put($controller,$pattern,$route,$prefix, $method);
                break;
            case 'delete':
                $this->delete($controller,$pattern,$route,$prefix, $method);
                break;
            case 'any':
                $this->any($controller,$pattern,$route,$prefix, $method);
                break;
            case 'rs':
                $this->resources($controller,$pattern,$route,$prefix);
                break;
            default:
                $this->get($controller,$pattern,$route,$prefix, $method);
                break;
        endswitch;

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
