<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

class Monospaced extends Tag
{
    protected   $name       = 'code';
    public      $beginTag   = '\'\'';
    public      $endTag     = '\'\'';
}