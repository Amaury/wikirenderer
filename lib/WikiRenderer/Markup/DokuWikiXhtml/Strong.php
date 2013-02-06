<?php
namespace WikiRenderer\Markup\DokuWikiXhtml;

class Strong extends Tag {
    protected   $name       = 'strong';
    public      $beginTag   = '**';
    public      $endTag     = '**';
    protected   $additionnalAttributes = array();
}