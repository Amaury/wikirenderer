<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

use WikiRenderer\Block;

class SyntaxHighlight extends Block
{

    public      $type       = 'syntaxhighlight';
    protected   $_openTag   = '<pre><code>';
    protected   $_closeTag  = '</code></pre>';
    protected   $isOpen     = false;
    protected   $dktag      = 'code';

    public function open()
    {
        $this->isOpen = true;
        return $this->_openTag;
    }

    public function close()
    {
        $this->isOpen = false;
        return $this->_closeTag;
    }

    public function getRenderedLine()
    {
        return htmlspecialchars ($this->_detectMatch);
    }

    public function detect($string)
    {
        if ($this->isOpen) {
            if (preg_match ('/(.*)<\/' . $this->dktag . '>\s*$/', $string, $m)) {
                $this->_detectMatch = $m[1];
                $this->isOpen = false;
            }else{
                $this->_detectMatch = $string;
            }
            return true;
        } else {
            if (preg_match ('/^\s*<' . $this->dktag . '( \w+)?>(.*)/', $string, $m)) {
                if (preg_match ('/(.*)<\/' . $this->dktag . '>\s*$/', $m[2], $m2)) {
                    $this->_closeNow = true;
                    $this->_detectMatch = $m2[1];
                } else {
                    $this->_closeNow = false;
                    $this->_detectMatch = $m[2];
                }
                if (isset ($m[1]) && $m[1] != '') {
                    $this->_openTag = '<pre><code class="language-' . trim ($m[1]) . '">';
                } else {
                    $this->_openTag = '<pre><code>';
                }
                return true;
            } else {
                return false;
            }
        }
    }
}
