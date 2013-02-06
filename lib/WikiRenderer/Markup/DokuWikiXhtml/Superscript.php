<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

class Superscript extends Tag
{
    protected   $name       = 'sup';
    public      $beginTag   = '<sup>';
    public      $endTag     = '</sup>';
}