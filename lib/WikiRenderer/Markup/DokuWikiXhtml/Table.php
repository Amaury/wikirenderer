<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

use WikiRenderer\Block;

class Table extends Block
{
    public      $type       = 'table';
    protected   $regexp     = "/^\s*(\||\^)(.*)/";
    protected   $_openTag   = '<table>';
    protected   $_closeTag  = '</table>';
    protected   $_colcount  = 0;

    public function open()
    {
        $this->engine->getConfig()->defaultTextLineContainer = '\WikiRenderer\Markup\DokuWikiXhtml\TableRow';
        return $this->_openTag;
    }

    public function close()
    {
        $this->engine->getConfig()->defaultTextLineContainer = '\WikiRenderer\HtmlTextLine';
        return $this->_closeTag;
    }

    public function getRenderedLine()
    {
        return $this->engine->inlineParser->parse ($this->_detectMatch[1] . $this->_detectMatch[2]);
    }

}