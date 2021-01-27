<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
 * SVG Icons module install/update file
 *
 * @author Jason Boothman <jason.boothman@gmail.com>
 * @copyright 2021 Jason Boothman
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

class Svg_icons_upd {

    public $version;
    public $module_name;

    public function __construct()
    {
        $this->version = SVG_ICONS_VERSION;
        $this->module_name = SVG_ICONS_CLASS_NAME;
    }

	function install()
	{
		$data = array(
			'module_name'			=> $this->module_name ,
			'module_version'		=> $this->version,
			'has_cp_backend'		=> 'y',
			'has_publish_fields'	=> 'n'
		);

		ee()->db->insert('modules', $data);

		return TRUE;
	}

	function update($current = '')
	{
		if (version_compare($current, '1.0.0', '>='))
		{
			return FALSE;
		}

		return TRUE;
	}

	function uninstall()
	{
		ee()->db->delete('modules', array('module_name' => $this->module_name));

		return TRUE;
	}

}
// END CLASS

/* End of file upd.svg_icons.php */
/* Location: ./system/user/addons/svg_icons/upd.svg_icons.php */