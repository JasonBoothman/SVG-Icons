<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 /**
 * SVG Icons module control panel file
 *
 * @author Jason Boothman <jason.boothman@gmail.com>
 * @copyright 2021 Jason Boothman
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */

class Svg_icons_mcp {

    public $folder_path;
    public $ee_version;
    public $config_variable_set;

    public function __construct()
	{
        $this->folder_path = ee()->config->item('svg_icons_folder');
        $this->config_variable_set = (ee()->config->item('svg_icons_folder')) ? TRUE : FALSE;
        $this->ee_version = APP_VER;

        $this->includeStyles();
        $this->makeSidebar();
    }

    public function getIcons($folder_path, $dir, $icon_set_data = [], $traverse = TRUE) {
        $files		= preg_grep('~\.(svg)$~', scandir($dir));
        $folders	= scandir($dir);

        $icon_set_label = ($folder_path == $dir) ? '/' : rtrim(str_replace($folder_path, '', $dir), '/');

        $icon_set = [];
        $icon_set['label'] = $icon_set_label;

        $icons = [];
        if (count($files) > 0)
		{
			foreach ($files as $file)
			{
                if(is_dir($file)) continue;

                $icon = [];
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				$filename = pathinfo($file, PATHINFO_FILENAME);
				if($extension = 'svg') {
                    $icon['code'] = file_get_contents($dir.$filename.'.svg');
                    $icon['filename'] = $filename;
                }

                array_push($icons, $icon);
            }

            $icon_set['icons'] = $icons;
            array_push($icon_set_data, $icon_set);
        }

        if ($traverse) {
            foreach($folders as $key => $value) {
                $new_dir = realpath($dir.'/'.$value) . '/';

                if (self::isValidIconsDirectory($dir, $new_dir, $value)) {
                    $icon_set_data = self::getIcons($folder_path, $new_dir, $icon_set_data, $traverse);
                }
            }
        }

        return $icon_set_data;
    }

	public function index()
	{
        $data['cp_title'] = lang('svg_icons_mcp_title');

        $data['config_variable_set'] = $this->config_variable_set;
        $data['folders'] = self::getFolders();

        $view = ee('View')->make('svg_icons:index');

        return $view->render($data);
    }

    public function icons() {
        $directory = $_GET['directory'];
        $full_directory = $this->folder_path . $_GET['directory'] . '/';

        if ($directory == 'root') {
            $data['icon_sets'] = self::getIcons($this->folder_path, $this->folder_path,$icon_set_data = [],FALSE);
        } else {
            $data['icon_sets'] = self::getIcons($this->folder_path, $full_directory);
        }

        $view = ee('View')->make('svg_icons:icons');

        return $view->render($data);
    }

	public function includeStyles()
	{
        $cp_style = file_get_contents( PATH_THIRD . '/svg_icons/css/helper.css');

        if ($this->ee_version < 6) {
            $cp_style .= file_get_contents( PATH_THIRD . '/svg_icons/css/ee5.css');
        }

		//add the css to the header
		ee()->cp->add_to_head('<style>'.$cp_style.'</style>');
    }

    /**
     * Build sidebar.
     */
    public function makeSidebar() {
        $sidebar = ee('CP/Sidebar')->make();

        $sidebar->addHeader(lang('svg_icons_mcp_home'), $this->generateUrl());

        if ($folders = self::getFolders()){
            $list = $sidebar->addHeader('Folders')
                ->addFolderList('folders');

            foreach($folders as $folder) {
                $item = $list->addItem(
                    $folder['label'],
                    $folder['url']
                );

                if (isset($_GET['directory']) && $_GET['directory'] == $folder['location']) {
                    $item->isActive();
                }

                $item->cannotEdit();
                $item->cannotRemove();
            }
        }

        $sidebar->addHeader('Instructions', 'https://www.google.com')
            ->urlIsExternal($external = TRUE);
    }

    public function generateUrl($page = '', array $params = []) {
        $path = 'addons/settings/svg_icons' . $page;

        return ee('CP/URL')->make($path, $params);
    }

    public function isValidIconsDirectory($current, $new, $folder) {
        if (is_dir($new) && $folder !== "." && $folder !== ".." && $new !== $current) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getFolders() {
        $data['config'] = ee()->config->item('svg_icons_folder') ? TRUE : FALSE;
        $data['cp_title'] = lang('svg_icons_mcp_title');

        $svg_folders = [];

        if (ee()->config->item('svg_icons_folder')) {
            $files		= preg_grep('~\.(svg)$~', scandir($this->folder_path));
            $folders	= scandir($this->folder_path);

            // There are files in the root directory, let's add a link
            if ($files) {
                $svg_folder['label'] = lang('svg_icons_mcp_root');
                $svg_folder['url'] = $this->generateUrl('/icons&directory=root');
                $svg_folder['location'] = '/';

                array_push($svg_folders, $svg_folder);
            }

            foreach($folders as $key => $value) {
                $new_dir = realpath($this->folder_path.'/'.$value) . '/';
                $location = rtrim(str_replace($this->folder_path, '', $new_dir), '/');
                $label = str_replace('-', ' ', $location);
                $label = ucwords(strtolower($label));
                $svg_folder = [];

                if (self::isValidIconsDirectory($this->folder_path, $new_dir, $value)) {
                    $svg_folder['label'] = $label;
                    $svg_folder['url'] = $this->generateUrl('/icons&directory=' . $location);
                    $svg_folder['location'] = $location;

                    array_push($svg_folders, $svg_folder);
                }
            }
        }

        return $svg_folders;
    }

}
// END CLASS

/* End of file mcp.svg_icons.php */
/* Location: ./system/user/addons/svg_icons/mcp.svg_icons.php */