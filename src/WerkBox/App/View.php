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
class View
{
    public function templateDirectory($newTemplateDir = null)
    {
        static $templateDir = '';
        
        if (is_null($newTemplateDir)) {
            return $templateDir;
        } else {
            $templateDir = $newTemplateDir;
        }
    }
    
    public function templateExtension($newTemplateExt = null)
    {
        static $templateExt = 'phtml';
        
        if (is_null($newTemplateExt)) {
            return $templateExt;
        } else {
            $templateExt = $newTemplateExt;
        }
    }
    
    public function compose($template)
    {
        ob_start();
        include $template;
        $view = ob_get_contents();
        ob_end_clean();
        
        return $view;
    }
}
