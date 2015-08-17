<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PublicContoller@index');

Route::controllers([
      'diary'   =>    'DiaryController'
  ]);

post('markdown', function(){
  return Markdown::convertToHtml(Input::get('blog'));
});

get('markdown', function(){
  $text = '<form action="" method="post"><textarea name="blog"></textarea>
  <input type="hidden" name="_token" value="'.csrf_token().'"/>
  <input type="submit" name="submit" value="Make Markdown"/>

  </form>';
  return $text;
});


get('login', function(){
  return view('login', [
    'pageInfo'=>['pageLogo'=>'diary','siteTitle'=>'Login', 'pageHeading'=>'User Login', 'pageHeadingSlogan'=>'Here the place to authentication']
    ]);
});

Route::get('logout', 'LoginController@logout');

Route::get('login/facebook', 'LoginController@facebookLogin');
Route::get('login/github', 'LoginController@githubLogin');
Route::get('login/google', 'LoginController@googleLogin');
Route::get('login/twitter', 'LoginController@twitterLogin');

Route::get('callback/facebook', 'LoginController@callbackFacebook');
Route::get('callback/github', 'LoginController@callbackGithub');
Route::get('callback/google', 'LoginController@callbackGoogle');
Route::get('callback/twitter', 'LoginController@callbackTwitter');
