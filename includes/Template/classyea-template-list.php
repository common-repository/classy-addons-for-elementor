<script type="text/template" id="tmpl-elementor-template-library-header-actions-classyea">
    <div id="elementor-template-library-header-sync" class="elementor-templates-modal__header__item">
        <i class="eicon-sync" aria-hidden="true" title="<?php esc_attr_e( 'Sync Templates', 'classyea' ); ?>"></i>
        <span class="elementor-screen-only"><?php echo esc_html__( 'Sync Templates', 'classyea' ); ?></span>
    </div>
</script>
<script type="text/template" id="tmpl-elementor-templates-modal__header__logo_classyea">
    <span class="elementor-templates-modal__header__logo__icon-wrapper">
        <img src="<?php echo esc_url( CLASSYEA_PLUGIN_URL . 'assets/images/icon.svg' ); ?>" style="height: 30px;" />
    </span>
    <span class="elementor-templates-modal__header__logo__title">{{{ title }}}</span>
</script>
<script type="text/template" id="tmpl-elementor-template-library-header-preview-classyea">
    <div id="elementor-template-library-header-preview-insert-wrapper" class="elementor-templates-modal__header__item">
        {{{ classyea_templates_lib.templates.layout.getTemplateActionButton( obj ) }}}
    </div>
</script>
<script type="text/template" id="tmpl-elementor-template-library-templates-classyea">
    <#
        var activeSource = classyea_templates_lib.templates.getFilter('source');
    #>
    <div id="elementor-template-library-toolbar">
        <# if ( 'classyea' === activeSource ) {
            var activeType = classyea_templates_lib.templates.getFilter('type');
            #>
            <div id="elementor-template-library-filter-toolbar-remote" class="elementor-template-library-filter-toolbar">
                <# if ( 'new_page' === activeType ) { #>
                    <div id="elementor-template-library-order">
                        <input type="radio" id="elementor-template-library-order-new" class="elementor-template-library-order-input" name="elementor-template-library-order" value="date">
                        <label for="elementor-template-library-order-new" class="elementor-template-library-order-label"><?php echo esc_html__( 'New', 'classyea' ); ?></label>
                        <input type="radio" id="elementor-template-library-order-trend" class="elementor-template-library-order-input" name="elementor-template-library-order" value="trendIndex">
                        <label for="elementor-template-library-order-trend" class="elementor-template-library-order-label"><?php echo esc_html__( 'Trend', 'classyea' ); ?></label>
                        <input type="radio" id="elementor-template-library-order-popular" class="elementor-template-library-order-input" name="elementor-template-library-order" value="popularityIndex">
                        <label for="elementor-template-library-order-popular" class="elementor-template-library-order-label"><?php echo esc_html__( 'Popular', 'classyea' ); ?></label>
                    </div>
                <# } else {
                    var config = classyea_templates_lib.templates.getConfig( activeType );
                    if ( config.categories ) { #>
                        <div id="elementor-template-library-filter">
                            <select id="elementor-template-library-filter-subtype" class="elementor-template-library-filter-select" data-elementor-filter="subtype">
                                <option></option>
                                <# config.categories.forEach( function( category ) {
                                    var selected = category === classyea_templates_lib.templates.getFilter( 'subtype' ) ? ' selected' : '';
                                    #>
                                    <option value="{{ category }}"{{{ selected }}}>{{{ category }}}</option>
                                <# } ); #>
                            </select>
                        </div>
                    <# }
                } #>
                <div id="elementor-template-library-my-favorites">
                    <# var checked = classyea_templates_lib.templates.getFilter( 'favorite' ) ? ' checked' : ''; #>
                    <input id="elementor-template-library-filter-my-favorites" type="checkbox"{{{ checked }}}>
                    <label id="elementor-template-library-filter-my-favorites-label" for="elementor-template-library-filter-my-favorites">
                        <i class="eicon" aria-hidden="true"></i>
                        <?php echo esc_html__( 'My Favorites', 'classyea' ); ?>
                    </label>
                </div>
            </div>
        <# } #>
        <div id="elementor-template-library-filter-text-wrapper">
            <label for="elementor-template-library-filter-text" class="elementor-screen-only"><?php echo esc_html__( 'Search Templates:', 'classyea' ); ?></label>
            <input id="elementor-template-library-filter-text" placeholder="<?php echo esc_attr__( 'Search', 'classyea' ); ?>">
            <i class="eicon-search"></i>
        </div>
    </div>
    <div id="elementor-template-library-templates-container"></div>
    <# if ( 'classyea' === activeSource ) { #>
        <div id="elementor-template-library-footer-banner">
            <img class="elementor-nerd-box-icon" src="<?php echo esc_url( CLASSYEA_PLUGIN_URL . 'assets/images/information.svg' ); ?>" />
            <div class="elementor-excerpt"><?php echo esc_html__( 'Stay tuned! More awesome templates coming real soon.', 'classyea' ); ?></div>
        </div>
    <# } #>
</script>
<script type="text/template" id="tmpl-elementor-template-library-template-classyea">
    <div class="elementor-template-library-template-body">
        <# if ( 'page' === type ) { #>
            <div class="elementor-template-library-template-screenshot" style="background-image: url({{ thumbnail }});"></div>
        <# } else { #>
            <img src="{{ thumbnail }}">
        <# } #>
        <div class="elementor-template-library-template-preview">
            <i class="eicon-zoom-in-bold" aria-hidden="true"></i>
        </div>
    </div>
    <div class="elementor-template-library-template-footer">
        {{{ classyea_templates_lib.templates.layout.getTemplateActionButton( obj ) }}}
        <div class="elementor-template-library-template-name">{{{ title }}} - {{{ type }}}</div>
        <div class="elementor-template-library-favorite">
            <input id="elementor-template-library-template-{{ template_id }}-favorite-input" class="elementor-template-library-template-favorite-input" type="checkbox"{{ favorite ? " checked" : "" }}>
            <label for="elementor-template-library-template-{{ template_id }}-favorite-input" class="elementor-template-library-template-favorite-label">
                <i class="eicon-heart-o" aria-hidden="true"></i>
                <span class="elementor-screen-only"><?php echo esc_html__( 'Favorite', 'classyea' ); ?></span>
            </label>
        </div>
    </div>
</script>