<?php

use App\Models\Post;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Inserting Data
Route::get('/create',function (){
    $post=Post::create(['name'=>'My fisrt Post']);
    $tag1 =Tag::find(1);

    $post->tags()->save($tag1);
    $video=Video::create(['name'=>'video.mov']);

    $tag2=Tag::find(2);
    $video->tags()->save($tag2);

});
//Reading Data
Route::get('/read',function (){
    $post=Post::findorFail(1);
    foreach($post->tags as $tag)
    {
        echo $tag;
    }

});
//Updating Data
Route::get('/update',function (){
    $post=Post::findorFail(1);
    foreach($post->tags as $tag)
    {
       return $tag->whereName('php')->update(['name'=>'updated PHP']);
    }

});
Route::get('/update1',function (){
    $post=Post::findorFail(1);
    $tag=Tag::find(1);
    $post->tags()->save($tag);
});

Route::get('/update2',function (){
   $post=Post::findorFail(1);
    $tag=Tag::find(3);
    //$post->tags()->attach($tag);
    $post->tags()->sync([1]);

});
//Deleting Data
Route::get('/delete',function (){
    $post=Post::find(1);
    foreach ($post ->tags as $tag)
        {
            $tag->whereId(1)->delete();
        }
});


