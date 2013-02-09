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
 */
namespace WikiRenderer\Markup\DokuHtml;

/**
 * traite les signes de type paragraphe
 */
use WikiRenderer\Block;

class Para extends Block
{
    public $type = 'para';
    protected $_openTag = '<p>';
    protected $_closeTag = '</p>';

    public function detect($string, $inBlock = false)
    {
        if ($string == '')
            return false;
        if (preg_match("/^\s+[\*\-\=\|\^>;<=~]/", $string))
            return false;
        if (preg_match("/^\s*((\*\*|[^\*\-\=\|\^>;<=~]).*)/", $string, $m)) {
            $this->_detectMatch = array($m[1], $m[1]);
            return true;
        }
        return false;
    }
}

