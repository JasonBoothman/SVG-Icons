# SVG Icons
A better way to manage SVGs in your ExpressionEngine Templates.

![](https://img.shields.io/badge/ExpressionEngine-5-3784B0.svg)
![](https://img.shields.io/badge/ExpressionEngine-6-3784B0.svg)

SVGs have taken the web by storm, but they can add a considerable amount of code to your template, and can be a pain to manage. SVG Icons allows you to create an SVG repository you can access using simple template tags. Now you can add SVGs while keeping your template code nice and clean.

## Steps To Implement
1. Set Config Variable.
2. Upload SVGs.
3. Use the add-on.

### Set Config Variable

Set the `$config['svg_icons_folder']` config variable in system/user/config/config.php to the location you will be storing your SVGs.

**Example:** `$config['svg_icons_folder'] = $basePath .'/build/svgs/';`

### Upload SVGs
Add/Upload SVGs to the directory specified in the config variable.

*Note: The add-on does a recurisve traverse of the directory so you should be able to add as many sub directories as you would like to keep the SVGs organized.*

### Use the add-on
You should now be able to navigate the add-on in ExpressionEngine to view your SVG library.

Click the 'Tag' button to copy the template tag to the clipboard for pasting into your templates.
Example: `{exp:svg_icons:icon name='my-svg-name' path='path/to/svg'}`

Click the 'Code' button to copy the actual SVG code to the clipboard.
