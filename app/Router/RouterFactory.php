<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
        $router = new RouteList;
		$router->addRoute('Home', 'Home:default');
        $router->addRoute('About', 'About:default');
        $router->addRoute('News', 'News:default');
        $router->addRoute('edit', 'EditPage:default');
        return $router;
	}
}
