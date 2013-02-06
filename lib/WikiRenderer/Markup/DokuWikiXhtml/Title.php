<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

use WikiRenderer\Block;

class Title extends Block
{
    public      $type       = 'title';
    protected   $regexp     = "/^\s*(\={1,6})([^=]*)(\={1,6})\s*$/";
    protected   $_closeNow  = true;

    public function getRenderedLine()
    {
        $level = strlen ($this->_detectMatch[1]);

        $conf = $this->engine->getConfig();

        $output='';
        if (count ($conf->sectionLevel)) {
            $last = end ($conf->sectionLevel);
            if ($last < $level) {
                while ($last = end($conf->sectionLevel) && $last <= $level) {
                    $output .= '</div>';
                    array_pop ($conf->sectionLevel);
                }
            } elseif ($last > $level) {

            } else {
                array_pop ($conf->sectionLevel);
                $output .=  '</div>';
            }
        }

        $conf->sectionLevel[] = $level;
        $h = 6 - $level + $conf->startHeaderNumber;
        if ($h > 5) {
            $h = 5;
        } elseif ($h < 1) {
            $h = 1;
        }
        return $output . '<div><h' . $h . '>' . $this->_renderInlineTag(trim($this->_detectMatch[2])).'</h' . $h . '>';
    }
}