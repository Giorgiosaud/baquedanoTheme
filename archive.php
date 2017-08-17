<?php
get_header();?>
<div class="container top" id="slider">
</div>
<?php
while ( have_posts() ) : the_post();

// If comments are open or we have at least one comment, load up the comment template.

?>

<!--content Section Start Here -->
<div id="content">
	<div class="container">
		<div class="row form-group">
			<div class="col-xs-12 col-md-3">
			<div class="container-fluid">
				<?php the_post_thumbnail('full');?>
			</div>
			</div>
			<div class="col-xs-12 col-md-9">
				<a href="<?php the_permalink()?>"><h3><?php the_title()?></h3></a>
					<?php the_excerpt(); ?>
					<a href="<?php the_permalink()?> " class="quote">VER MÁS</a>
			</div>
		</div>
		<!-- </div> -->
	</div>

	
	<?php endwhile; // End of the loop.
	 if ( function_exists('wp_bootstrap_pagination') )
    wp_bootstrap_pagination();
	?>

</div>



<?php
get_footer();
?>
