<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/', 'Espaceagent::index');
$routes->get('/', 'Espaceadmin::index');
$routes->get('/', 'Espacesuperadmin::index');
$routes->get('/', 'PdfController::index');
$routes->group('espaceagent', function($routes) {
    $routes->get('evaluation', 'EvaluationController::index');
    $routes->post('evaluation/start', 'EvaluationController::startEvaluation');
    $routes->post('evaluation/agree-objective', 'EvaluationController::agreeObjective');
	$routes->get('evaluation/self-appraisal/(:num)', 'EvaluationController::selfAppraisal/$1');
    $routes->post('evaluation/submit-self-appraisal', 'EvaluationController::submitSelfAppraisal');
    $routes->get('evaluation/sign-off/(:num)', 'EvaluationController::signOff/$1');
    $routes->post('evaluation/submit-sign-off', 'EvaluationController::submitSignOff');
    $routes->get('bonus', 'BonusController::employeeBonus');
});

$routes->group('espaceadmin', function($routes) {
    $routes->get('evaluation', 'EvaluationController::index');
    $routes->post('evaluation/change-manager', 'EvaluationController::changeManager');
    $routes->get('evaluation/view/(:num)', 'EvaluationController::viewEvaluation/$1');
    $routes->get('evaluation/managers', 'EvaluationController::getManagers');
    $routes->get('bonus/configure', 'BonusController::configure');
    $routes->post('bonus/save-configuration', 'BonusController::saveConfiguration');

});

$routes->group('espacerespo', function($routes) {
    $routes->get('evaluation', 'EvaluationController::index');
    $routes->get('evaluation/set-objectives/(:num)', 'EvaluationController::setObjectives/$1');
    $routes->post('evaluation/submit-objectives', 'EvaluationController::submitObjectives');
	$routes->get('evaluation/objective-evaluation/(:num)', 'EvaluationController::objectiveEvaluation/$1');
    $routes->post('evaluation/submit-objective-evaluation', 'EvaluationController::submitObjectiveEvaluation');
    $routes->get('evaluation/sign-off/(:num)', 'EvaluationController::signOff/$1');
    $routes->post('evaluation/submit-sign-off', 'EvaluationController::submitSignOff');
    $routes->get('bonus/managerReport', 'BonusController::managerReport');
});
// $routes->post('/evaluation/start', 'EvaluationController::startEvaluation');
// $routes->post('/evaluation/submit-objectives', 'EvaluationController::submitObjectives');
// $routes->post('/evaluation/submit-agreement', 'EvaluationController::submitAgreement');
// $routes->post('/evaluation/sign-off', 'EvaluationController::signOff');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
