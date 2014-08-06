# Prueba de Aptitud php #

## Configuracion ##


### .htaccess ###
Url mas agradables 

    ```
        <IfModule mod_rewrite.c>
            RewriteEngine On
           
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteRule ^(.*)$ index.php?/$1 [L,QSA]
        </IfModule>
    ```



### application/config/autoload.php ###

Carga de librerias y helpers que se utilizan

    ```
        $autoload['helper'] = array('url');
        
        $autoload['libraries'] = array('database');
    
    ```



### applications/config/hooks.phpp ###

Carga del autoloader de la libreria desarrollada para el ejemplo

    ```
        $hook['pre_system'][] = array('class' => 'Layout',
            'class' => 'InTouch_Autoloader',
            'function' => 'register',
            'filename' => 'autoloader.php',
            'filepath' => 'libraries/InTouch/'
        );
    ```


### application/config/pagination.php ###

Configuracion para darle el estilo del bootstrap



### application/config/routes.php ###

Definicion de rutas para los proyectos y el default controller


## Libreria / InTouch ##

### Autoloader ### 

Permite la carga de las librerias internas siguiendo la convencion del psr-0


### Unique ###

Es un objeto factorizable que crea instancias unicas

### Request ###

Captura los datos de la peticion ya sean por post get, put, delete y provee
unos metodos para poder acceder de forma directa con los metodos magicos


### Test/Controller ###

Controlador base del test actual, su principal funcion es setear el request para que este
disponible en los controladores hijos

### Test/Model ###

Define el comportamiento que heredan los modelos, como realiza la busqueda, validacion y actualizacion de los registros

### Ui/Box ###

Es un pequeño helper para cargar los box que se muestran en el diseño, carga sobre una pila de ejecucion las vistas que se mostraran cuando se llame al metodo display, permite manejar una prioridad para poder posicionar los bloques


## Tarea 1 ##

    archivos creados:
    application/controller/users.php
    application/model/user_model.php
    application/view/users/index.php
    application/view/users/form.php

## Tarea 2 ##

    archivos creados:
    application/controller/projects.php
    application/model/project_model.php
    application/view/projects/index.php
    application/view/projects/form.php

## Tarea 3 ##

    En el presente ejemplo creo un hash a partir del nombre de usuario + la contraseña, asumiendo que minimamente la contraseña deberia ir encriptada, se puede dar la posibilidad que las contaseñas se repitan, por ejemplo si el usuario a usa de contraseña 123456 y el usuario b usa de contraseña 123456, si bien ambas contraseñas estarian encriptadas si yo soy el usuario a puedo saber que b utiliza la misma contraseña sha1( 123456 ) == sha1( 123456 ) en cambio si creamos una combinacion con otro valor en este caso el nombre de usuario mas la contraseña el hash siempre va a ser distinto 
    sha1( a . 123456 ) <> sha1( b . 123456 ).

    Tambien se podria adopatar una hash con una semilla estatica.

## Tarea 4 ##
    
    $CI =& get_instance();
    
    // Creacion a modo de ejemplo los datos del usuario

    $CI->user = new stdClass();
    $CI->user->id = 1;  // o un metodo para devolver el valor que se deberia setear, 
                        // ya sea para un usuario de las sesion activa, o por algun filtro 

    // Generacion de consulta para:
    // devolver los proyectos del usuarios $CI->user->id
    // que finalicen  o hayan finalizado entre el 1 y el 15 de enero de 2013

    // utilizando el activerecord
    $CI->db
        ->select('*')
        ->from('projects')
        ->where('iduser', $CI->user->id)
        ->where('enddate >=', '2013-01-01')
        ->where('enddate <=', '2013-01-15')
        ->get()
        ->result(); 

    // Utilizando una consulta normal
    $CI->db
        ->query( 
            '   SELECT * 
                FROM projects 
                WHERE iduser = ? 
                AND ( enddate BETWEEN ? AND ? )
            ', $CI->user->id, '2013-01-01', '2013-01-15');

## Tarea 5 ##
    $CI =& get_instance();
    
    // Creacion a modo de ejemplo los datos del usuario

    $CI->user = new stdClass();
    $CI->user->id = 1;  // o un metodo para devolver el valor que se deberia setear, 
                        // ya sea para un usuario de las sesion activa, o por algun filtro 

    $CI‐>second_user = new stdClass();
    $CI‐>second_user->id = 2;

    // Generacion de consulta para:
    // devolver los proyectos del usuarios $CI->user->id
    // que finalicen  o hayan finalizado entre el 1 y el 15 de enero de 2013
    // - del usuario identificado por $CI‐>second_user‐>id y que se encuentren pendientes de finalizar

    // Utilizando una consulta normal
    $CI->db
        ->query('  
            (  
                SELECT * 
                FROM projects 
                WHERE iduser = ? 
                AND ( enddate BETWEEN ? AND ? )
            ) 
                UNION
            (
                SELECT * 
                FROM projects 
                WHERE iduser = ? 
                AND isfinished = 0
            )

        ', 
            $CI->user->id, 
            '2013-01-01', 
            '2013-01-15',
            $CI->second_user->id
        );

## Tarea 6 ##

    como primer paso por el caudal de usuario, trabajaria por lo menos 3 servidores vps, uno para el manejo de elementos estaticos ( imagens, scripts, css ), otro para el manejo de la base de datos, y otro para el manejo de la aplicacion. 

    Implementar un sistema de cache para evitar conexiones innecesarias para los datos mas solicitados. En casos complejos no suelo confiar demaciado en las aplicaciones que utilizan algunos sitios, en muchos casos se desperdician muchos recursos para hacer tareas sencillas. En ese caso analizaria la posibilidad de crear una tienda a medida enfocada y diagramada para el trabajo optimizado. Seguimiento de consultas y analisis, manejo de sesiones exclusivamente cuando se requieran.

    En un caso como una tienda el volumen de datos no es tan grande, lo que si puede afectar es si la tienda maneja estadisticas, por vista, click, etc. Separaria en distintas bases de datos las ventas de los productos, ya que los productos son consultdos desde la aplicacion, y las ventas serian los registros naturales que mas ocuparian en la base de datos