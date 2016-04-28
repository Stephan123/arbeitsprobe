<?php
/**
 * Bootstrap
 *
 * + Routing zu Controller / Action
 * + ermitteln Typ der Suche
 * + Error Controller
 */

// Start Session
session_start();

// Aufruf Baustein 'start' , Erststart
\Flight::route('/', function()
{
    // Controller
    include_once('../src/Controller/start.php');
    $controller = new \controller\start('start', 'index');

    // Action
    $controller->index();
});

// Aufruf Baustein mit Controller / Action und Suchparameter
\Flight::route('/@controller/@action(/@searchTyp/@searchValue)',function($controller, $action, $searchTyp = false, $searchValue = false)
{
    if($searchTyp == false)
        $searchTyp = 'all';
    
    // ermitteln Pfade zu den CSV Dateien
    getCsvPath();

    // Controller
    $controllerString = "controller\\$controller";
    $controller = new $controllerString($controller, $action, $searchTyp, $searchValue);

    // Action
    $controller->$action();
});

// Mapping 'not found'
\Flight::map('notFound', function() {
    // \Flight::render('404', array());
    Flight::redirect('/start/index');
});

/**
 * speichern der Pfade zu den CSV Dateien
 *
 * @return array
 */
function getCsvPath()
{
    include_once('../app/config/csvPaths.php');

    \Flight::set('csvPaths',$csvPaths);

    return $csvPath;
}