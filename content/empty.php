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
				'temperancetheme'
			);
		?></h1>
    </header>

    <section class="entry-content">
		<p><?php
            _e(
				'Sorry. There is not content available',
				'temperancetheme'
			);
        ?></p>
    </section>

    <footer class="article-footer">
		<p><?php
            _e(
				'This is the error message in the page.php template.',
				'temperancetheme'
			);
        ?></p>
    </footer>

</article>

