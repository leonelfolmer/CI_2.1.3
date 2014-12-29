<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
| 	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['scaffolding_trigger'] = 'scaffolding';
|
| This route lets you set a "secret" word that will trigger the
| scaffolding feature for added security. Note: Scaffolding must be
| enabled in the controller in which you intend to use it.   The reserved 
| routes must come before any wildcard or regular expression routes.
|
*/

$route['default_controller'] = "principal";
$route['scaffolding_trigger'] = "";

// normal, sem otimização (SEO)
// categoria
$route['categoria/(.+)$'] = "artigos/categoria/$1";

// detalhe
$route['^detalhe/(.+)$'] = "artigos/detalhe/$1";

//$route['404_override'] = 'help/show404';





/*
| -------------------------------------------------------------------------
| SEO, otimização dinâmica
| -------------------------------------------------------------------------
*/

// alterar perfil tem que vir antes das demais rotas, em controller/usuario/perfil.php
// na função alterar/comentar: se não for o id do usuário logado redireciona .... 
//$route['usuario/perfil/alterar/(:any)'] = "usuario/perfil/alterar/$4";


// para otimizar os detalhes ex: www.exemplo.com.br/teste1/artigo-azul
//$route['(teste1|teste2|teste3)/(:any)'] 	= "artigos/detalhe/$2";

// para otimizar as categorias ex: www.exemplo.com.br/azul
//$route['(:any)'] 							= "artigos/categoria/$1";
// fim do teste

// area ... tem que mapear todos os links (obrigatório)
//$route['principal'] 						= "principal";

//$route['usuario/aut'] 					= "usuario/aut";
//$route['usuario/aut/login'] 				= "usuario/aut/login";
//$route['usuario/aut/logout'] 				= "usuario/aut/logout";
//$route['usuario/area'] 					= "usuario/area";
//$route['usuario/perfil'] 					= "usuario/perfil";
//$route['usuario/perfil/gravar_usuario'] 	= "usuario/perfil/gravar_usuario";


// na view o link que se ser neste formato: base_url()."$item->categoria_url/". $item->url
// onde "categoria_url" na formatação atual é "url" as tabelas não foram mudadas (ambiguidade)
// sendo obrigatória a mudança da mesma em artigo e categorias.
 









/* End of file routes.php */
/* Location: ./system/application/config/routes.php */