
# Resources

This page is to help you learn more about how to create the theme that best serves your project needs.
Each of these resources can be used to augment the code. Think of it as a cookbook 




## The Title Tag

If you're not running WordPress version 4.1 or newer, or you don't want to use *add_theme_supports title-tag*
, you can add this snippet to your functions.php

```php
<?php
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function theme_slug_render_title() {
	?><title><?php wp_title( ' | ', true, 'right' ); ?></title><?php
	}
	add_action( 'wp_head', 'theme_slug_render_title' );
}
?>
```

## Favicons

Want to learn more about Favicons? Read 
[Understanding the Favicon](http://www.jonathantneal.com/blog/understand-the-favicon/) 



