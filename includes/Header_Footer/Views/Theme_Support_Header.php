<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php if ( ! current_theme_supports( 'title-tag' ) ) : ?>
		<title>
			<?php echo esc_html( wp_get_document_title() ); ?>
		</title>
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php do_action( 'classyea/template/before_header' ); ?>
<div class="classyea-template-content-markup classyea-template-content-header classyea-template-content-theme-support">
<?php
	$template_id = ClassyEa\Helper\Header_Footer\Activator::template_ids();
	echo classyea_render_elementor_content( $template_id[0] );
?>
</div>
<?php do_action( 'classyea/template/after_header' ); ?>
