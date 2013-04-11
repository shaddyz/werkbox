<?php

namespace Creole;

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
