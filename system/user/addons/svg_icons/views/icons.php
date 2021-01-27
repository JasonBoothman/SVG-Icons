<?php
    foreach ($icon_sets as $icon_set) {
?>
    <div class="panel svg-icons-panel">
        <div class="panel-heading">
            <div class="title-bar title-bar--large">
                <h3 class="title-bar__title">
                    <?= $icon_set['label'] ?>
                </h3>
            </div>
        </div>
        <div class="panel-body">
            <div class="svg-icons">
                <?php
                    foreach ($icon_set['icons'] as $icon) {
                ?>
                        <div class="svg-icon" data-label="<?= $icon['filename'] ?>">
                            <div class="actions">
                                <a href="" class="button button--secondary copy-data" data-type="tag"><?= lang('svg_icons_icons_button_tag') ?></a>
                                <a href="" class="button button--secondary copy-data" data-type="code"><?= lang('svg_icons_icons_button_code') ?></a>
                            </div>
                            <div class="svg">
                                <?=$icon['code']?>
                            </div>
                            <textarea class="tag-data">{exp:rd_svg_icons:icon name="<?= $icon['filename'] ?>" path="<?= $icon_set['label'] ?>"}</textarea>
                            <textarea class="code-data"><?=$icon['code']?></textarea>
                            <div class="filename"><?= $icon['filename'] ?></div>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
<?php
    }
?>