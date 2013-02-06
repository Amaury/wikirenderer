<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

use WikiRenderer\Block;

class Macro extends Block
{
    public      $type       = 'macro';
    protected   $regexp     = "/^\s*~~[^~]*~~\s*$/";
    protected   $_closeNow  = true;

    public function getRenderedLine()
    {
        return '';
    }
}