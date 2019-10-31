<?php
/*
 * Display this template when content is unavailable
 */
?>
<article id="post-not-found" class="hentry clearfix">
    <header class="article-header">
    <h1>
    <?php
        _e(
			"Sorry. That content is not avaialble.",
			'text-domain'
        );
    ?>
    </h1>
    </header>

    <section class="entry-content">
    <p>
    <?php
        _e(
			'Try your search again.',
			'text-domain'
        ); ?>
    </p>
    </section>

    <footer class="article-footer">
    <p>
    <?php
     _e(
		'Try these tips to improve your search',
		'text-domain'
     );
    ?>
    </p>
    </footer>

</article>

