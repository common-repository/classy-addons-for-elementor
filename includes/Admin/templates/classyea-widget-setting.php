<div class="classyea-from-wrap tab_wrap">
    <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <div class="heading-enable-disable">
            <button type="button" class="classyea_btn_en classyea-enable-disable classyea-btn-enable"><?php _e("Enable All", "classyea"); ?></button>
            <button type="button" class="classyea_btn_disable classyea-enable-disable classyea-btn-disable"><?php _e("Disable All", "classyea"); ?></button>
        </div>
        <h2 class="classyea-element-title"><?php _e("Widget List", "classyea"); ?></h2>
        <?php wp_nonce_field("classyea_option_setting_nonce"); ?>
        <table class="form-table " role="presentation" id="classyea-widget">
            <tbody>
                <?php
                $enabled_widget    =  get_option('classyea_enable_widget', true);

                foreach ($classyea_module_list as $widget_name => $widget_title) {

                    if (!is_array($enabled_widget) && 'disabled' !== $enabled_widget) {
                        $checked = true;
                    } elseif (!is_array($enabled_widget) && 'disabled' === $enabled_widget) {
                        $checked = false;
                    } else {
                        $checked = in_array($widget_name, $enabled_widget) || isset($enabled_widget[$widget_name]);
                    }

                    $classy_demolink = (isset($classyea_elements_demo_link[$widget_name])) ? $classyea_elements_demo_link[$widget_name] : '#';
                ?>
                    <tr valign="top" class="classyea-widget-item">
                        <th scope="row"><?php _e($widget_title, 'classyea') ?> 
                        <div class="classyea-tooltip-demo">
                            <i class="eicon-device-desktop"></i>
                            <div class="classyea-tooltip-text">
                                <a href="<?php echo esc_url($classy_demolink); ?>" class="classyea-tooltip-content" target="_blank">
                                <?php _e("Demo","classyea");?> &nbsp;</a>
                            </div>
                        </div>
                        </th>
                        <td>
                            <fieldset>
                                <label for="<?php echo esc_attr($widget_name); ?>" class="classyea-switch">
                                    <input type="checkbox" class="classyea_checksingle" id="<?php echo esc_attr($widget_name); ?>" name="classyea_enable_widget[]" value="<?php echo esc_attr($widget_name); ?>" <?php checked( $checked, 1 ); ?>>
                                    <span class="classyea-slider classyea-round"></span>
                                </label>
                            </fieldset>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <input type="hidden" name="action" value="classyea_setting_admin_page">
        <p>
            <?php submit_button('Save Changes'); ?>
        </p>
    </form>
</div>