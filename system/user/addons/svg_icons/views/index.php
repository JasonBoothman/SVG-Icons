<h2><?= $cp_title ?></h2>
<p><?=lang('svg_icons_module_description');?></p>
<?php
    if ($config_variable_set) {
?>
        <div class="svg-icons-config">Config Variable: <span class="valid">Set</span></div>
        <div class="table-responsive table-responsive--collapsible">
            <table cellspacing="0">
                <thead>
                    <tr>
                        <th><?= lang('svg_icons_index_folder_name') ?></th>
                        <th><?= lang('svg_icons_index_location') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($folders as $folder) {
                    ?>
                            <tr>
                                <td><a href="<?= $folder['url'] ?>"><?= $folder['label'] ?></a></td>
                                <td><?= $folder['location'] ?></td>
                            </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
<?php
    } else {
?>
    <div class="svg-icons-config">Config Variable: <span class="invalid">Not Set</span></div>
<?php
    }
?>
