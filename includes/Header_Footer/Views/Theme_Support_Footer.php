<?php do_action( 'classyea/template/before_footer' ); ?>
<div class="classyea-template-content-markup classyea-template-content-footer classyea-template-content-theme-support">
<?php
	$template_id = ClassyEa\Helper\Header_Footer\Activator::template_ids();
	echo classyea_render_elementor_content( $template_id[1] );
?>
</div>
<?php do_action( 'classyea/template/after_footer' ); ?>
<?php wp_footer(); ?>

</body>
</html>
