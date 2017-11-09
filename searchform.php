<!-- Search form -->
<h1>
<?php echo _ex( 'Search Form', 'search form heading', 'temperancetheme' ); ?>
</h1>
<form
	role="search"
	action="<?php echo esc_url( home_url( '/' ) ); ?>"
	method="get"
	accept-charset="utf-8">

	<label for="search-query" class="label">
	<?php
		_ex( 'Search for:', 'label for search field', 'temperancetheme' );
	?>
	</label>

	<input type="search" id="search-query" name="s" value="<?php echo get_search_query(); ?>"
		placeholder="<?php
		_ex(
			'e.g. a11y',
			'instructional text',
			'temperancetheme'
		);
		?>">

	<input
		type="submit"
		id="search-button"
		name="site-search-button"
		value="<?php
		_ex(
			'Search',
			'the act of submitting a search form',
			'temperancetheme'
		);
		?>">
</form>
<!-- /Search form -->

