<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

class Subscript extends Tag
{
    protected $name     = 'sub';
    public $beginTag    = '<sub>';
    public $endTag      = '</sub>';
}