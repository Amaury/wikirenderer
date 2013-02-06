<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

use WikiRenderer\Block;

class Html extends Block
{
    public      $type   = 'html';
    protected   $isOpen = false;
    protected   $dktag  = 'html';

    public function open()
    {
        $this->isOpen = true;
        return '';
    }

    public function close()
    {
        $this->isOpen=false;
        return '';
    }

    public function getRenderedLine()
    {
        return '';
    }

    public function detect($string)
    {
        if ($this->isOpen) {
            if (preg_match('/(.*)<\/'.$this->dktag.'>\s*$/', $string, $m)) {
                $this->isOpen = false;
            }
            return true;
        } else {
            if (preg_match ('/^\s*<' . $this->dktag . '>(.*)/', $string, $m)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
