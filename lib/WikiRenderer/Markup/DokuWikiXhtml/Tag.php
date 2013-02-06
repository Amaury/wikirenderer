<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

use WikiRenderer\TagXhtml;

class Tag extends TagXhtml
{
    protected function _findWikiWord($string)
    {
        if (preg_match_all ('/([a-z]+\:(?:\/\/)?\w+[^\s]*)/', $string, $m, PREG_SET_ORDER |PREG_OFFSET_CAPTURE)) {
            $str = '';
            $begin = 0;

            foreach ($m as $match) {
                $len = ($match[0][1]) - $begin;
                $str .= substr ($string, $begin, $len);
                $begin = $match[0][1] + strlen ($match[0][0]);
                list ($href, $label) = $this->config->processLink ($match[2][0], $this->name);
                $str .= '<a href="' . htmlspecialchars ($href) . '">' . htmlspecialchars ($label) . '</a>';
            }
            if ($begin < strlen ($string)) {
                $str.= substr ($string, $begin);
            }
        return $str;
        } else {
            return $string;
        }
    }
}