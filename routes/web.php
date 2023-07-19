<?php 

use Lib\Route;

Route::get('/',function(){
    echo "Hola desde la pagina principal";
});
Route::get('/contact',function(){
    echo "Hola desde la pagina contacto";
});
Route::get('/about',function(){
    echo "Hola desde la pagina acerca de";
});

// cuando colocamos : lo que sigue despues de cursos es un dato variable
//con esto recuperamos dos valores ejemplo /php/programacion
//Route::get('/cursos/:slug/:categoria',function(){

Route::get('/cursos/:slug',function($slug){
    echo "El curso es: $slug";


});



Route::dispatch();