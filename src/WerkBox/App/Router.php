<?php
/**
 * This file is part of WerkBox.
 *
 * WerkBox is free software; you can redistribute it and/or modify it under the terms of version 3 of the GNU General
 * Public License as published by the Free Software Foundation.
 *
 * WerkBox is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program. If not, see
 * <http://www.gnu.org/licenses/>.
 *
 * @copyright 2012 Shaddy Zeineddine
 * @license http://www.gnu.org/licenses/gpl.txt GPL v3
 * @link https://github.com/shaddyz/werkbox
 */

namespace WerkBox\App;

/**
 * @package WerkBox\App
 */
class Router
{
    protected $routes = array();
    protected $defaultRoute = null;
    
    public function addRoute($pattern, $destination)
    {
        $this->routes[$pattern] = $destination;
    }
    
    public function addDefaultRoute($destination)
    {
        $this->defaultRoute = $destination;
    }
    
    public function route($source)
    {
        foreach ($this->routes as $pattern => $destination) {
            if (preg_match($pattern, $source)) {
                return $destination;
            }
        }
        
        return $this->defaultRoute;
    }
}
