<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

class FootNote extends Tag
{
    protected   $name       = 'footnote';
    public      $beginTag   = '((';
    public      $endTag     = '))';

    public function getContent()
    {
        $number     = count ($this->config->footnotes) + 1;
        $id         = 'footnote-' . $this->config->footnotesId . '-' . $number;
        $this->config->footnotes[] =
            "<p>[<a href=\"#rev-$id\" name=\"$id\" id=\"$id\">$number</a>] " . $this->contents[0] . '</p>';

        return "<span class=\"footnote-ref\">[<a href=\"#$id\" name=\"rev-$id\" id=\"rev-$id\">$number</a>]</span>";
    }
}