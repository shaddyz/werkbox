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

namespace WerkBox\Text\Creole;

/**
 * @package WerkBox\Text
 * @subpackage Creole
 */
class LineBreak
{
    public static function consume(&$text)
    {
        if ('\\\\' != substr($text, 0, 2)) {
            return null;
        }
        
        $text = substr($text, 2);
        return new self();
    }
    
    public function __construct($text = null)
    {
    }
    
    public function toHtml()
    {
        return '<br/>' . "\n";
    }
}
