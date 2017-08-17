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
<div class="container top" id="slider">
</div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<img src="<?php the_post_thumbnail_url( 'full' );?>" alt="Main image">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="breadcrumbs-box">
					<ul class="clearfix">

						<li>
							<a href="#">Proyectos</a>
						</li>
						<li>
							<?php the_title()?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container">	

		<?php the_content(); ?>
	</div>
<?php endwhile; // End of the loop.
?>
</div>



<?php
get_footer();
?>
