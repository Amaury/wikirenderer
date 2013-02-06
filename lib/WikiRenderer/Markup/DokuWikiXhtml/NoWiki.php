<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

class NoWiki extends SyntaxHighlight
{
    public      $type       = 'nowikisyntaxhighlight';
    protected   $_openTag   = '<pre>';
    protected   $_closeTag  = '</pre>';
    protected   $dktag      = 'nowiki';
}