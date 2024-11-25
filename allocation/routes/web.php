<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'api/v1'], function() use($router){

    $router->get('/get-template/{allocationType}', 'AllocationsController@getTemplate');
    $router->get('/allocations', 'AllocationsController@listOfAllocations');
    $router->get('/allocations/{allocationType}', 'AllocationsController@index');
    $router->get('/allocations-totals/{allocationType}', 'AllocationsController@getTotalsForBarSection');
    $router->get('/allocations-by-school-year/{allocationType}/{schoolYearId}', 'AllocationsController@getAllocationBySchoolYear');
    $router->get('/allocations-by-status/{allocationType}', 'AllocationsController@getAllocationsByStatus');
    $router->get('/search-by-school/{allocationType}', 'AllocationsController@searchBySchoolName');
    $router->get('/filter-allocation/{allocationType}', 'AllocationsController@filterAllocation');
    $router->post('/allocations', 'AllocationsController@create');
    $router->get('/allocations-show/{id}', 'AllocationsController@show');
    $router->put('/allocations/{id}', 'AllocationsController@update');
    $router->delete('/allocations/{id}', 'AllocationsController@destroy');

});
