<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
 * SVG Icons module front end file
 *
 * @author Jason Boothman <jason.boothman@gmail.com>
 * @copyright 2021 Jason Boothman
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

class Svg_icons {

	public $return_data = "";

	public function icon()
	{
		$folder_path    = ee()->config->item('svg_icons_folder');
		$pFilename 	    = ee()->TMPL->fetch_param('name');
        $pPath		    = ee()->TMPL->fetch_param('path');
        $aPath          = ee()->TMPL->fetch_param('absolute_path');

        if ($aPath != '') {
            $icon_path = $aPath . '/';
        } else {
            if ($pPath != '' || $pPath != '/') {
                $icon_path = $folder_path . $pPath . '/';
            } else {
                $icon_path = $folder_path;
            }
        }

		$svg_path = $icon_path . $pFilename . '.svg';

		$contents = @file_get_contents($svg_path);

		if (!empty($contents)) {
			return $contents;
		} else {
			return '';
		}
	}
}
// END CLASS

/* End of file mod.svg_icons.php */
/* Location: ./system/user/addons/svg_icons/mod.svg_icons.php */