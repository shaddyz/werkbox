<?php

namespace Creole;

class BlankParagraph
{
    protected $text;
    
    public static function consume(&$text)
    {
        if ($text[0] != ' ' and $text[0] != "\t") {
            return null;
        }
        
        $textLength = strlen($text);
        
        for ($i = 0; $i < $textLength; $i++) {
            if ($text[$i] != ' ' and $text[$i] != "\t") {
                break;
            }
        }
        
        $blankParagraph = new self(substr($text, 0, $i));
        $text = substr($text, $i);
        return $blankParagraph;
    }
    
    public function __construct($text)
    {
        $this->text = $text;
    }
    
    public function toHtml()
    {
        return '<p>' . $this->text . '</p>';
    }
}
