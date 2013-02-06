<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

use WikiRenderer\Block;

class Pre extends Block
{
    public      $type       = 'pre';
    protected   $_openTag   = '<pre>';
    protected   $_closeTag  = '</pre>';

    public function detect($string)
    {
        if ($string == '') {
            return false;
        }
        if (preg_match ("/^(\s{2,}[^\*\-\=\|\^>;<=~].*)/", $string)) {
            $this->_detectMatch = array ($string, $string);
            return true;
        }
        return false;
    }
}