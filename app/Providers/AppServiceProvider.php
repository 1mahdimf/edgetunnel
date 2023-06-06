<?php

namespace App\Providers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Response::macro('success', function ($type, $body, $data = null) {
            $response = array('success' => true);
            $response['type'] = $type;
            $response['body'] = $body;
            if (!empty($data)) {
                $response['data'] =  $data;
            }

            return json_decode(json_encode($response));
        });

        Response::macro('error', function ($type, $body, $data = null) {
            $response = array('success' => false);
            $response['type'] = $type;
            $response['body'] = $body;
            if (!empty($data)) {
                $response['data'] = $data;
            }
            return json_decode(json_encode($response));
        });

        Response::macro('jsonSuccess', function ($type, $body, $data = null) {
            return Response::json( Response::success($type, $body, $data));
        });

        Response::macro('jsonError', function ($type, $body, $data = null) {
            return Response::json( Response::success($type, $body, $data),400);
        });

       
    }
}
