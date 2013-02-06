<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

use WikiRenderer\Block;

class Para extends Block
{
    public      $type       = 'para';
    protected   $_openTag   = '<p>';
    protected   $_closeTag  = '</p>';

    public function detect($string)
    {
        if ($string == '') {
            return false;
        }
        if (preg_match ("/^\s+[\*\-\=\|\^>;<=~]/",$string)) {
            return false;
        }
        if (preg_match ("/^\s*((\*\*|[^\*\-\=\|\^>;<=~]).*)/",$string, $m)) {
            $this->_detectMatch = array ($m[1], $m[1]);
            return true;
        }
        return false;
    }
}
