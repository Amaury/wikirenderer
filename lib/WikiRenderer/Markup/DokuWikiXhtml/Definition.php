<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

use WikiRenderer\Block;
/**
 * definition list
 */
class Definition extends Block {

    public      $type       = 'dfn';
    protected   $regexp     = "/^\s*;(.*) : (.*)/i";
    protected   $_openTag   = '<dl>';
    protected   $_closeTag  = '</dl>';

    public function getRenderedLine()
    {
        $dt=$this->_renderInlineTag($this->_detectMatch[1]);
        $dd=$this->_renderInlineTag($this->_detectMatch[2]);
        return "<dt>$dt</dt>\n<dd>$dd</dd>\n";
    }
}