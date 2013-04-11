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
class Page
{
    protected $paragraphs = array();
    
    public function __construct($text)
    {
        // normalize the text
        $text = preg_replace('~^(\xEF\xBB\xBF|\x1A)~', '', $text);
        $text = ltrim($text);
        $text = str_replace(array("\r\n", "\r"), "\n", $text);
        
        $paragraphTypes = array(
            'PreformattedBlock',
            'BlankParagraph',
            'Heading',
            'HorizontalRule',
            'UnorderedList',
            'OrderedList',
            'Table',
            'TextParagraph',
        );
        
        $done = false;
        while (!$done and '' != $text) {
            $done = true;
            foreach ($paragraphTypes as $paragraphType) {
                $paragraphType = '\Creole\\' . $paragraphType;
                if (!is_null($paragraph = $paragraphType::consume($text))) {
                    $this->paragraphs[] = $paragraph;
                    $j = 0;
                    while (isset($text[$j]) and "\n" == $text[$j]) {
                        $j++;
                    }
                    $text = substr($text, $j);
                    $done = false;
                }
            }
        }
    }
    
    public function toHtml()
    {
        $html = '';
        foreach ($this->paragraphs as $paragraph) {
            $html .= $paragraph->toHtml();
        }
        return $html;
    }
}
