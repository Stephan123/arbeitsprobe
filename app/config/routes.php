<?php

// Start Session
session_start();

// Aufruf Baustein 'login' , Erststart
\Flight::route('/', function()
{
    // Controller
    include_once('../src/Controller/start.php');
    $controller = new \controller\start('start', 'index');

    // Startroutinen des Controller
    startController($controller, 'index');
});

// Aufruf Baustein, mit Anzeigesprache
\Flight::route('/@controller/@action(/*)',function($controller, $action)
{
    if($action == null)
        $action = 'index';

    // ermitteln der übergebenen Parameter
    $data = ermittelnStartParams();

    // Controller
    $controllerString = "controller\\$controller";
    $controller = new $controllerString($controller, $action);
    
    // Startroutinen des Controller
    startController($controller, $action, $data);
});

// Mapping 'not found'
\Flight::map('notFound', function() {
    // \Flight::render('404', array());
    Flight::redirect('/start/index');
});
    
/**
* Start des Controller und der Action
*
* @param $controller
* @param $action
*/
function startController($controller, $action = 'index', $data = null)
{
    if( (is_array($data)) and (count($data) > 0) )
        $controller->setData($data);

    $controller->$action();
}

/**
 * ermitteln Startparameter
 *
 * @return array
 */
function ermittelnStartParams()
{
    $request = \Flight::request();
    $params = array();

    if($request->method == 'POST'){
        $params = $_POST;
    }

    if($request->method == 'GET'){
        $url = $request->url;
        $url = ltrim($url,'/');
        $url = rtrim($url, '/');

        $splitUrl = explode('/',$url);

        if(isset($splitUrl[0]))
            unset($splitUrl[0]);
        if(isset($splitUrl[1]))
            unset($splitUrl[1]);

        $splitUrl = array_merge($splitUrl);

        $j=1;
        if(count($splitUrl) >= 2){

            $key = null;
            for($i = 0; $i < count($splitUrl); $i++){
                if($j % 2 == 0){
                    $params[$key] = $splitUrl[$i];
                    $key = null;
                }
                else{
                    $key = $splitUrl[$i];
                }

                $j++;
            }
        }
    }

    \Flight::set('params', $params);

    return;
}