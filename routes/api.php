<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// error_log("queriendo abrir");
// error_log(__dir__.'\controller\usuario_controller.php');
// error_log ("fin");



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/usuarios', function (Request $request) {
//     return $request->user();
// });

include_once(app_path() . '\routes\api_grupos.php');
include_once(app_path() . '\routes\api_grupos_base.php');

include_once(app_path() . '\routes\api_geo_paises_base.php');

include_once(app_path() . '\routes\api_usuarios.php');
include_once(app_path() . '\routes\api_usuarios_base.php');


include_once(app_path() . '\routes\api_menu_base.php');

include_once(app_path() . '\routes\api_blogs_base.php');
include_once(app_path() . '\routes\api_blogs.php');

include_once(app_path() . '\routes\api_sendmail.php');



include_once(app_path() . '\routes\api_buscar.php');

include_once(app_path() . '\routes\api_login.php');



// Route::get('products', function () {
//     return response(Product::all(),200);
// });

// Route::get('products/{product}', function ($productId) {
//     return response(Product::find($productId), 200);
// });


// Route::post('products', function(Request $request) {
//    $resp = Product::create($request->all());
//     return $resp;

// });

// Route::put('products/{product}', function(Request $request, $productId) {
//     $product = Product::findOrFail($productId);
//     $product->update($request->all());
//     return $product;
// });

// Route::delete('products/{product}',function($productId) {
//     Product::find($productId)->delete();

//     return 204;

// });
?>
