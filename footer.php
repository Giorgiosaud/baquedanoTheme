<!--footer Section Start Here -->
<footer id="footer">
	<!--contact-us-container Start Here -->
	<div class="contact-us-container">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 animate-effect">
					<div class="box">
						<em class="location-svg"><img src="<?= get_template_directory_uri()?>/assets/svg/05.svg" alt="" class="svg"/></em>
						<?= get_option('direccion')?>
					</div>

					<div class="box call">
						<em class="fa fa-phone"></em>
						<strong><?= get_option('telefono')?></strong>
						<span><a href="mailto:<?= get_option('email')?>"><?= get_option('email')?></a></span>
					</div>

					<div class="box last">
						<ul class="clearfix">
							<?php if(get_option('facebook_link')!='#'):?>
								<li>

									<a href="<?= get_option('facebook_link')?>" target="_blank"><i class="fa fa-facebook"></i></a>
								</li>
							<?php endif; ?>
							<?php if(get_option('twitter_link')!='#'):?>
								<li>

									<a href="<?= get_option('twitter_link')?>" target="_blank"><i class="fa fa-twitter"></i></a>
								</li>
							<?php endif; ?>
							<?php if(get_option('google_link')!='#'):?>
								<li>

									<a href="<?= get_option('google_link')?>" target="_blank"><i class="fa fa-google-plus"></i></a>
								</li>
							<?php endif; ?>

						</ul>
					</div>

					<div class="box last">
						<a href="#" class="contact-us">CONTÁCTANOS</a>
					</div>
				</div>
			</div>
		</div>
		<div class="primary-header">
			<div class="container">
				<div class="row">
					<div class="col-sm-5 left-header">
						<span></span>
					</div>
					<div class="col-sm-7 right-header">
						<ul>
							<li>Diseño:
								<a href="http://www.zonapro.us"><i></i> zonapro.us</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--contact-us-container End Here -->


</footer>
<!--footer Section End Here -->

</div>
<!--Wrapper Section End Here -->

<?php wp_footer(); ?>
</body>
</html>
