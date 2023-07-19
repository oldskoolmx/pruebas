<?php 

namespace Lib;
class Route {
    // arreglo para almacenar todas las url validas
    private static $routes = [
      /*  'contact' => function(){

       },
       'about' => function(){

       },  */

     /*   'GET' => [
        'contact' => function(){

        },
        'about' => function(){
 
        },

        ],
        'POST' => [

        ] */

    ];

    public static function get($uri, $callback) {
        
        // para reemplazar la barra /
        // ejemplo '/contact/' => 'contact'
        // '/contact/prueba' => 'contact/prueba'
        $uri = trim($uri,'/');
        self::$routes['GET'][$uri] = $callback;    

    }

    public static function post($uri, $callback){
        $uri = trim($uri,'/');
        self::$routes['POST'][$uri] = $callback;    
    }

    // metodo para recuperar la url que mete el usuario
    public static function dispatch(){

        // para recuperar la url
        $uri = $_SERVER['REQUEST_URI'];
        $uri = trim($uri,'/');

        // para saber que metodo utilizamos para enviar variables
        $method = $_SERVER['REQUEST_METHOD'];

        // para buscar si existe una ruta definida 
        // para recorrer las routas get, accediendo al arreglo route[]
        foreach(self::$routes[$method] as $route => $callback) {
            // si la routa coincide con la uri, que ejecute el metodo callback
           // comento para utulizar expresiones regulares y creo otra funcion
            /*  if ($route == $uri){
                $callback();
                // para salir del foreach una vez que encuentre la funcion 
                return;
            }  */
            
            // para checar que tengo los : puntos 
            if(strpos($route,':') != false){

                // realiza una busqueda y sustiyuye una expresion regular
                //colocamos los () para generar un subpatron
                $route = preg_replace('#:[a-zA-Z]+#','([a-zA-Z]+)',$route);
              
              //si no se ejecuta esto se ejecuta la funcion callback
                /*  echo $route;
                return; */
                
            }
            // comparo la expresion regular con preg_match
            // si pongo estos comodines ^hola$ solo va a buscar la palabra completa de inicio a fin  hola
            // #hola# holaaaaaaa
            // coon la variable $matches vamos a recuperar esta expresion ([a-zA-Z]+)
            if(preg_match("#^$route$#",$uri,$matches)){

                //para generar un array apartir de otro array con un indice en este caso con el 1
                $param = array_slice($matches,1);
                // con json_encode por que es un arreglo
                //echo json_encode($param);

                    // ['a','b','c']
                // para desdoblar un array hay que hacer esto ...$param
                $callback(...$param);
                return;
            }
        }

        echo '<h1>404 Not Found</h1>';
        echo "<br>";
       /*  echo $uri;
        echo "<br>";
        echo $method; */
    }
}

