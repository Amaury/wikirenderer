<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

class Del extends Tag
{
    protected   $name       = 'del';
    public      $beginTag   = '<del>';
    public      $endTag     = '</del>';

    public function getContent()
    {
        return '';
    }
}
