<?php

if (!defined('SVG_ICONS_NAME')) {
    define('SVG_ICONS_NAME', 'SVG Icons');
    define('SVG_ICONS_CLASS_NAME', 'Svg_icons');
    define('SVG_ICONS_VERSION', '1.0.0');
}

return array(
	'author'      		=> 'Jason Boothman',
	'author_url'  		=> 'http://github.com/JasonBoothman',
	'docs_url'			=> 'http://github.com/JasonBoothman/SVG-Icons',
	'name'        		=> SVG_ICONS_NAME,
	'description' 		=> 'A better way to manage SVGs in your ExpressionEngine Templates.',
	'version'     		=> SVG_ICONS_VERSION,
	'namespace'   		=> 'JasonBoothman\SVGIcons',
	'settings_exist'	=> TRUE
);