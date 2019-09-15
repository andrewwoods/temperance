
# Resources

This page is to help you learn more about how to create the theme that best
serves your project needs.  Each of these resources can be used to augment the
code. Think of it as a cookbook.

## WordPress Coding Standards

- [Accessibility Coding Standard](https://make.wordpress.org/core/handbook/best-practices/coding-standards/accessibility-coding-standards/)
- [PHP Coding Standard](https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/)
- [HTML Coding Standard](https://make.wordpress.org/core/handbook/best-practices/coding-standards/html/)
- [CSS Coding Standard](https://make.wordpress.org/core/handbook/best-practices/coding-standards/css/)
- [JavaScript Coding Standard](https://make.wordpress.org/core/handbook/best-practices/coding-standards/javascript/)

## Template Hierarchy

* [Visualize the WordPress Template Hierarchy](https://wphierarchy.com/)

## Theme Developers Handbook

* [Theme Basics](https://developer.wordpress.org/themes/basics/)
* [Template Files Section](https://developer.wordpress.org/themes/template-files-section/)
* [Theme Functionality](https://developer.wordpress.org/themes/functionality/)
* [Theme Options - The Customizer API](https://developer.wordpress.org/themes/customize-api/)
* [Theme Security](https://developer.wordpress.org/themes/theme-security/)
* [Advanced Theme Topics](https://developer.wordpress.org/themes/advanced-topics/)
* [Releasing Your Theme](https://developer.wordpress.org/themes/release/)
* [List of Template Tags](https://developer.wordpress.org/themes/references/list-of-template-tags/)
* [List of Conditional Tags](https://developer.wordpress.org/themes/references/list-of-conditional-tags/)

## The Title Tag

It's best practice to add theme support for the title-tag.
However, If you don't want to use *add\_theme\_supports* for *title-tag*, you can add this snippet to your functions.php

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


* Want to learn more about Favicons? Read [Understanding the Favicon](http://www.jonathantneal.com/blog/understand-the-favicon/)
* [Favicon Generator](http://www.favicomatic.com/) - Supports many sizes


