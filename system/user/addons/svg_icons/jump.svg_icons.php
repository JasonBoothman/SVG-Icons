<?php

 /**
 * Jump Menu for SVG Icons
 *
 * @author Jason Boothman <jason.boothman@gmail.com>
 * @copyright 2021 Jason Boothman
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

use EllisLab\ExpressionEngine\Service\JumpMenu\AbstractJumpMenu;
require_once(PATH_THIRD . 'svg_icons/mcp.svg_icons.php');

class Svg_icons_jump extends AbstractJumpMenu
{
    protected static $items = array(
        'viewSvgs' => array(
			'icon' => 'fa-eye',
			'command' => 'view svgs in',
			'command_title' => 'View <b>SVGs</b> in... <i>[folder]</i>',
			'dynamic' => true,
			'requires_keyword' => false,
			'target' => 'viewSvgs'
		),
    );

    public function viewSvgs($searchKeywords = array()) {
        $svg_icons_map = new Svg_icons_mcp;
        $folders = $svg_icons_map->getFolders();
        $svg_folders = array();
        $svg_folder = array();

        foreach($folders as $folder) {
            $svg_folder = array(
                'icon' => 'fa-eye',
                'command' => $folder['label'] . 'folder',
                'command_title' => '<b>' . ucwords($folder['label']) . '</b> folder',
                'dynamic' => false,
                'requires_keyword' => false,
                'target' => 'icons&directory=' . $folder['location']
            );

            array_push($svg_folders, $svg_folder);
        }

        return $svg_folders;
    }
}