<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

use WikiRenderer\TagXhtml;

class Link extends TagXhtml {
    protected   $name       = 'a';
    public      $beginTag   = '[[';
    public      $endTag     = ']]';
    protected   $attribute  = array ('href','$$');
    public      $separators = array ('|');

    public function getContent()
    {
        $cntattr = count($this->attribute);
        $cnt = ($this->separatorCount + 1 > $cntattr ? $cntattr : $this->separatorCount + 1);
        list ($href, $label) = $this->config->processLink ($this->wikiContentArr[0], $this->name);
        if ($cnt == 1 ) {
            return '<a href="' . htmlspecialchars (trim ($href)) . '">' . htmlspecialchars ($label) . '</a>';
        } else {
            $this->wikiContentArr[0] = $href;
            return parent::getContent();
        }
    }
}