<?php
/**
 * dokuwiki syntax to xhtml
 *
 * @package WikiRenderer
 * @subpackage rules
 * @author Laurent Jouanneau
 * @copyright 2008-2012 Laurent Jouanneau
 * @link http://wikirenderer.jelix.org
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public 2.1
 * License as published by the Free Software Foundation.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * Refactored for composer by Vadim Babaev
 *
 * @example:
 *
 * $text = 'some**bold**text';
 *
 * $dokuConfig = new \WikiRender\Markup\DokuWikiToXhtml();
 * $renderer = new \WikiRender\Render($dokuConfig);
 * print $renderer->render($text);
 */

namespace WikiRenderer\Markup;

use WikiRenderer\Config;
use WikiRenderer\TagXhtml as WikiTagXhtml;
use WikiRenderer\Block as WikiRendererBloc;

use WikiRenderer\Tag as WikiTag;
use WikiRenderer\Markup\DokuWikiXhtml\Tag as DokuWikiTag;

class DokuWikiToXhtml  extends Config
{

    public $defaultTextLineContainer = '\WikiRenderer\HtmlTextLine';

    public $textLineContainers = array (
        '\WikiRenderer\HtmlTextLine' => array (
            '\WikiRenderer\Markup\DokuWikiXhtml\Strong',
            '\WikiRenderer\Markup\DokuWikiXhtml\Emphasis',
            '\WikiRenderer\Markup\DokuWikiXhtml\Underlined',
            '\WikiRenderer\Markup\DokuWikiXhtml\Monospaced',
            '\WikiRenderer\Markup\DokuWikiXhtml\Subscript',
            '\WikiRenderer\Markup\DokuWikiXhtml\Superscript',
            '\WikiRenderer\Markup\DokuWikiXhtml\Del',
            '\WikiRenderer\Markup\DokuWikiXhtml\Link',
            '\WikiRenderer\Markup\DokuWikiXhtml\FootNote',
            '\WikiRenderer\Markup\DokuWikiXhtml\Image',
            '\WikiRenderer\Markup\DokuWikiXhtml\NoWikiInline',
        ),
        '\WikiRenderer\Markup\DokuWikiXhtml\TableRow' => array (
            '\WikiRenderer\Markup\DokuWikiXhtml\Strong',
            '\WikiRenderer\Markup\DokuWikiXhtml\Emphasis',
            '\WikiRenderer\Markup\DokuWikiXhtml\Underlined',
            '\WikiRenderer\Markup\DokuWikiXhtml\Monospaced',
            '\WikiRenderer\Markup\DokuWikiXhtml\Subscript',
            '\WikiRenderer\Markup\DokuWikiXhtml\Superscript',
            '\WikiRenderer\Markup\DokuWikiXhtml\Del',
            '\WikiRenderer\Markup\DokuWikiXhtml\Link',
            '\WikiRenderer\Markup\DokuWikiXhtml\FootNote',
            '\WikiRenderer\Markup\DokuWikiXhtml\Image',
            '\WikiRenderer\Markup\DokuWikiXhtml\NoWikiInline',
        )
    );

    /**
     * liste des balises de type bloc reconnus par WikiRenderer.
     */
    public $blocktags = array (
        '\WikiRenderer\Markup\DokuWikiXhtml\Title',
        '\WikiRenderer\Markup\DokuWikiXhtml\ListBlock',
        '\WikiRenderer\Markup\DokuWikiXhtml\Blockquote',
        '\WikiRenderer\Markup\DokuWikiXhtml\Table',
        '\WikiRenderer\Markup\DokuWikiXhtml\Pre',
        '\WikiRenderer\Markup\DokuWikiXhtml\SyntaxHighlight',
        '\WikiRenderer\Markup\DokuWikiXhtml\File',
        '\WikiRenderer\Markup\DokuWikiXhtml\NoWiki',
        '\WikiRenderer\Markup\DokuWikiXhtml\Html',
        '\WikiRenderer\Markup\DokuWikiXhtml\Php',
        '\WikiRenderer\Markup\DokuWikiXhtml\Para',
    );


    public $simpletags = array("\\\\"=>"");

    public $escapeChar = '';

    public $sectionLevel= array();

    public $footnotes = array();

    public $footnotesId='';

    public $footnotesTemplate = '<div class="footnotes"><h4>Notes</h4>%s</div>';

    public $startHeaderNumber = 1; // top level header will be <h1> if you set to 1, <h2> if it is 2 etc..

    /**
     * called before the parsing
     */
    public function onStart($text)
    {
        $this->sectionLevel = array();
        $this->footnotesId = rand(0,30000);
        $this->footnotes = array();
        return $text;
    }

    /**
     * called after the parsing
     */
    public function onParse($finalTexte)
    {
        $finalTexte .= str_repeat ('</div>', count ($this->sectionLevel));
        if (count ($this->footnotes)) {
            $footnotes = implode ("\n", $this->footnotes);
            $finalTexte .= str_replace ('%s', $footnotes, $this->footnotesTemplate);
        }
        return $finalTexte;
    }

    public function processLink($url, $tagName='')
    {
        $label = $url;
        if (strlen ($label) > 40) {
            $label = substr ($label, 0, 40) . '(..)';
        }
  
        if (strpos ($url, 'javascript:') !== false) { // for security reason
            $url='#';
        }
        return array($url, $label);
    }
}
