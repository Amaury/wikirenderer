<?php

namespace WikiRenderer\Markup\DokuWikiXhtml;

class File extends SyntaxHighlight
{
    public      $type       = 'filesyntaxhighlight';
    protected   $_openTag   = '<pre class="file-content">';
    protected   $_closeTag  = '</pre>';
    protected   $dktag      = 'file';
}