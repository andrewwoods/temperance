<!-- Search form -->
<h1>
<?php echo _ex( 'Search Form', 'search form heading', 'text-domain' ); ?>
</h1>
<form
	role="search"
	action="<?php echo esc_url( home_url( '/' ) ); ?>"
	method="get"
	accept-charset="utf-8">

	<label for="search-query" class="label">
	<?php
		_ex( 'Search for:', 'label for search field', 'text-domain' );
	?>
	</label>

	<input type="search" id="search-query" name="s" value="<?php echo get_search_query(); ?>"
		placeholder="<?php
		_ex(
			'e.g. a11y',
			'instructional text',
			'text-domain'
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
			'text-domain'
		);
		?>">
</form>
<!-- /Search form -->

