<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
 * SVG Icons extension file
 *
 * @author Jason Boothman <jason.boothman@gmail.com>
 * @copyright 2021 Jason Boothman
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

class Svg_icons_ext {

	/**
	 * Constructor
	 *
	 * @param 	mixed	Settings array or empty string if none exist.
	 */
	public function __construct($settings = array())
	{
		// required extension properties
		$this->name				= lang('svg_icons_module_name');
		$this->version			= SVG_ICONS_VERSION;
		$this->description		= lang('svg_icons_module_description');
		$this->settings_exist	= 'y';
	}

	// ------------------------------------------------------

	/**
	 * Activate Extension
	 *
	 * @return void
	 */
	public function activate_extension()
	{
		 $this->_add_hook('cp_js_end', 10);
	}

	// ------------------------------------------------------

	/**
	 * Disable Extension
	 *
	 * @return void
	 */
	public function disable_extension()
	{
		ee()->db->where('class', __CLASS__);
		ee()->db->delete('extensions');
	}

	// ------------------------------------------------------

	/**
	 * Update Extension
	 *
	 * @param 	string	String value of current version
	 * @return 	mixed	void on update / FALSE if none
	 */
	public function update_extension($current = '')
	{
		if ($current === '' || $current === $this->version) {
            return false; // up-to-date
        }

		// update table row with current version
		ee()->db->where('class', __CLASS__);
		ee()->db->update('extensions', array('version' => $this->version));
	}

	// ------------------------------------------------------
    //
    /**
     * Method for cp_css_end hook
     *
     * Add custom CSS to every Control Panel page:
     *
     * @access     public
     * @param      array
     * @return     array
     */

	public function cp_js_end()
    {
		$helper_js_file = file_get_contents( PATH_THIRD . '/svg_icons/js/helper.js');

    	$other_js = [];

        //If another extension shares the same hook
		if (ee()->extensions->last_call !== false) {
			$other_js[] = ee()->extensions->last_call;
        }

        return implode('', $other_js) . $helper_js_file;
    }

	// --------------------------------------------------------------------

    /**
     * Add extension hook
     *
     * @access     private
     * @param      string
     * @param      integer
     * @return     void
     */
    private function _add_hook($name, $priority = 10)
    {
        ee()->db->insert('extensions',
            array(
                'class'    => __CLASS__,
                'method'   => $name,
                'hook'     => $name,
                'settings' => '',
                'priority' => $priority,
                'version'  => $this->version,
                'enabled'  => 'y'
            )
        );
    }

}