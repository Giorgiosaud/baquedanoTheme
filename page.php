<?php
get_header();

while ( have_posts() ) : the_post();
the_content();
	// If comments are open or we have at least one comment, load up the comment template.

endwhile; // End of the loop.
?>
<?php
get_footer();
?>
