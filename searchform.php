<!-- Search form -->
<h1><?php echo _ex( 'Search Form', 'search form heading', 'temperancetheme' ); ?></h1>
<form role="search" action="/search/" method="get" accept-charset="utf-8">
	<label for="s" class="visually-hidden"><?php echo _ex('Search for:', 'label for search field', 'temperancetheme'); ?></label>
	<input type="search" id="s" name="s" value="" 
		placeholder="<?php echo _ex('Search this site', 'instructional text', 'temperancetheme'); ?>"> 
	<input type="submit" id="search-button" name="site-search-button" 
		value="<?php echo _ex( 'Search', 'the act of submitting a search form', 'temperancetheme' ); ?>"> 
</form>
<!-- /Search form -->

