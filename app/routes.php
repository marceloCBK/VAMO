<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Blade::setContentTags('<%', '%>');

Route::post('entrar', function () {

    $user = Usuarios
        ::where('email_usr', Input::get('email_usr'))
        ->where('senha_usr', sha1(Input::get('senha_usr')))
        ->first();

    if($user->id_usr) {
        Auth::login($user);
        return Redirect::to('/inicio')
            ->with('flash_notice', 'Olá, '.$user->nome_usr.'! Você logou no VAMO!!!');
    }
    // authentication failure! lets go back to the login page
    return Redirect::to('entrar')
        ->with('flash_error', 'O login/senha está errado!')
        ->withinput();
});

Route::get('logout', function () {
    Auth::logout();
    return Redirect::to('/entrar')
        ->with('flash_notice', 'Voce saiu do sistema!');
});

Route::get      ('entrar'                       , array('uses' => 'ConteudoController@entrar'))->before('guest');
Route::get      ('/'                            , array('uses' => 'ConteudoController@Index'))->before('auth');
Route::get      ('inicio'                       , array('uses' => 'ConteudoController@Index'))->before('auth');

Route::get      ('produtos'                     , array('as' => 'produtos'            , 'uses' => 'ProdutosController@index'))->before('auth');
Route::get      ('produtos/inserir'             , array('as' => 'produtos.create'     , 'uses' => 'ProdutosController@create'))->before('auth');
Route::post     ('produtos'                     , array('as' => 'produtos.store'      , 'uses' => 'ProdutosController@store'))->before('auth');
Route::get      ('produtos/{param}'             , array('as' => 'produtos.show'       , 'uses' => 'ProdutosController@show'))->before('auth');
Route::get      ('produtos/{param}/editar'      , array('as' => 'produtos.edit'       , 'uses' => 'ProdutosController@edit'))->before('auth');
Route::put      ('produtos/{param}'             , array('as' => 'produtos.update'     , 'uses' => 'ProdutosController@update'))->before('auth');
Route::delete   ('produtos/{param}'             , array('as' => 'produtos.destroy'    , 'uses' => 'ProdutosController@destroy'))->before('auth');

Route::get      ('tipos'                         , array('as' => 'tipos'            , 'uses' => 'ProdutosTipoController@index'))->before('auth');
Route::get      ('tipos/inserir'                 , array('as' => 'tipos.create'     , 'uses' => 'ProdutosTipoController@create'))->before('auth');
Route::post     ('tipos'                         , array('as' => 'tipos.store'      , 'uses' => 'ProdutosTipoController@store'))->before('auth');
Route::get      ('tipos/{param}'                 , array('as' => 'tipos.show'       , 'uses' => 'ProdutosTipoController@show'))->before('auth');
Route::get      ('tipos/{param}/editar'          , array('as' => 'tipos.edit'       , 'uses' => 'ProdutosTipoController@edit'))->before('auth');
Route::put      ('tipos/{param}'                 , array('as' => 'tipos.update'     , 'uses' => 'ProdutosTipoController@update'))->before('auth');
Route::delete   ('tipos/{param}'                 , array('as' => 'tipos.destroy'    , 'uses' => 'ProdutosTipoController@destroy'))->before('auth');