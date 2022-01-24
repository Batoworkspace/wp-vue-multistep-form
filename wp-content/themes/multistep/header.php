<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package multistep
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		
		<!-- Theme name root -->
		<script>
			const themeName = '<?php echo get_current_theme(); ?>'
			const themeString = document.createElement('span')
			themeString.id = 'theme-name'
			themeString.innerHTML = themeName
			themeString.style.display = 'none'

			const pageWrapElement = document.querySelector('#page')
			if (pageWrapElement) {
				pageWrapElement.before(themeString)
			}
		</script>
