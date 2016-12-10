<?php
/*
|--------------------------------------------------------------------------
| Eilander Builder Config
|--------------------------------------------------------------------------
|
|
*/
return [
    /*
    |--------------------------------------------------------------------------
    | Destination paths
    |--------------------------------------------------------------------------
    |
    | Here you can define the paths for generated code.
    |
    */
    'generator'=> [
        'rootNamespace'  => 'Modules/[module]',
        'rootPath'       => 'modules/[module]',
        'controller'     => [
          'api'          => 'Http/Controllers/Api/V1/',
          'base'         => 'Http/Controllers/',
        ],
        'route'          => app_path().'/Modules/[module]/Http/routes.php',
        'binding'        => [
          'provider'     => app_path().'/Modules/[module]/Providers/RepositoryServiceProvider.php',
          'gateway'      => app_path().'/Modules/[module]/Providers/GatewayServiceProvider.php',
        ],
        'eloquent'       => [
          'providers'    => 'Providers/',
          'interface'    => 'Repositories/Eloquent/Contracts/',
          'repository'   => 'Repositories/Eloquent/',
          'entity'       => 'Entities/Eloquent/',
          'validation'   => 'Validators/',
          'presenter'    => 'Presenters/',
          'transformer'  => 'Transformers/',
          'ginterface'   => 'Gateways/Eloquent/Contracts/',
          'gateway'      => 'Gateways/Eloquent/',
        ],
    ],
];
