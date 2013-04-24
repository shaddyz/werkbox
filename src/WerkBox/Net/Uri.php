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

namespace WerkBox\Net;

/**
 * @package WerkBox\Net
 */
class Uri
{
    protected $uri;
    
    protected $parts = null;
    
    public function __construct($uri)
    {
        if (filter_var($value, \FILTER_VALIDATE_URL)) {
            throw new Exception(sprintf('Malformed URI "%s"', $uri));
        }
        
        $this->uri = $uri;
    }
    
    public function __toString()
    {
        return $this->uri;
    }
    
    public function getPart($key)
    {
        // "lazy load" the uri parts
        if (is_null($this->parts)) {
            $this->parts = parse_url($uri);
        }
        
        if (isset($this->parts[$key])) {
            return $this->parts[$key];
        } else {
            return '';
        }
    }
    
    public static function getCurrent()
    {
        $uriScheme = (!empty($_SERVER['HTTPS']) and 'off' !== $_SERVER['HTTPS']) ? 'https://' : 'http://';
        $hostName  = $_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
        $queryString = $_SERVER['QUERY_STRING'] ? '?' . $_SERVER['QUERY_STRING'] : '';
        $uri = $uriScheme . $hostName . $_SERVER['REQUEST_URI'];
        
        return new self($uri);
    }
}
