<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

use WikiRenderer\TagXhtml;

class NoWikiInline extends TagXhtml
{
    protected   $name       = 'nowiki';
    public      $beginTag   = '<nowiki>';
    public      $endTag     = '</nowiki>';
    public function getContent() {
        return '<div>' . htmlspecialchars ($this->wikiContentArr[0]) . '</div>';
    }
}