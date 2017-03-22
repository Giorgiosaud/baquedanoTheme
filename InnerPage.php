<?php
/*
Template Name: Pagina Interna

 */
get_header();
while ( have_posts() ) : the_post();

// If comments are open or we have at least one comment, load up the comment template.

?>

<!--content Section Start Here -->
<div id="content">
	<div id="slider" class="banner-container parallax" style="background:url(<?php the_post_thumbnail_url( 'full' );?>) no-repeat 0 0" >
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h3><?php the_title()?></h3>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="breadcrumbs-box">
					<ul class="clearfix">
						<li>
							<a href="#">inicio</a>
						</li>
						<li>
							<?php the_title()?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<?php the_content(); ?>
	<?php endwhile; // End of the loop.
	?>
</div>



<?php
get_footer();
?>
