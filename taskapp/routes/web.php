<?php
$router->get('/', function () use ($router) {
    return $router->app->version();
});
    $router->group(['prefix' => 'api'], function () use ($router) {
            $router->post('/save-registrasi', 'RegistrasiController@save_registrasi');
            $router->post('/login', 'AuthController@login');
            $router->get('/checkToken', 'RegistrasiController@checkToken');
            #$router->get('/dasboard', 'AplikasiController@index');
            $router->get('/dasboard', 'TaskController@index');
            $router->group(['middleware' => 'auth'], function () use ($router) {
                #User
                $router->post('/logout', 'AuthController@logout');
                $router->get('/listuser', 'AuthController@index');
                $router->get('/getuser/{id}', 'AuthController@getuser');
                $router->put('/edituser/{id}', 'AuthController@edituser');
                $router->post('/hapususer/{id}', 'AuthController@hapus');

		##Create Task
                $router->post('/tasks', 'TaskController@create');
                $router->get('/tasks', 'TaskController@index');
                $router->get('/tasks/{id}', 'TaskController@gettask');
                $router->put('/tasks/{id}', 'TaskController@edittask');
                $router->post('/tasks/{id}', 'TaskController@hapus');
            });
});
