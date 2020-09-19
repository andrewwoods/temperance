<?php
/*
 * Display this template when content is unavailable
 */
?>
<article id="post-not-found" class="hentry clearfix">
    <header class="article-header">
		<h1><?php
            _e(
				'Oops, Post Not Found!',
				'text-domain'
			);
		?></h1>
    </header>

    <section class="entry-content">
		<p><?php
            _e(
				'Sorry. There is no content available',
				'text-domain'
			);
        ?></p>
    </section>

    <footer class="article-footer">
		<p><?php
            _e(
				'This is the error message in the page.php template.',
				'text-domain'
			);
        ?></p>
    </footer>

</article>

