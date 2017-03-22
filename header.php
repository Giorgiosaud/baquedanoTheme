<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- link rel="shortcut icon" type="image/x-icon" href="favicon2.ico" -->
	<?php wp_head()?>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<!--Wrapper Section Start Here -->
		<div id="wrapper">
			<div id="pageloader" class="row m0">
				<div class="loader-item"><img src="<?= get_template_directory_uri()?>/assets/svg/grid.svg" alt="loading"></div>
			</div>
			<!--header Section Start Here -->
			<header id="header">
				<div class="primary-header">
					<div class="container">
						<div class="row">
							<div class="col-sm-5 left-header">
								<span></span>
							</div>
							<div class="col-sm-7 right-header">
								<ul>
									<li>
										<a href="mailto:<?= get_option('email')?>"><i class="fa fa-envelope-o"></i> <?= get_option('email')?></a>
									</li>
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
						</div>
					</div>
				</div>
				<div class="secondry-header">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-4">
								<?php baquedano_custom_logo() ?>
								<span class="num"></span>
							</div>
							<div class="col-xs-12 col-sm-8 menu-wrapper">
								<div class="button-wrapper">
									<button class="nav-button"></button>
								</div>
								<?php 
								$args=array(
									'menu'=>'Menu Principal',
									'theme_location'=>'menu_principal',
									'container'=>'nav',
									'container_class'=>'navigation'
									);
								wp_nav_menu($args);
								?>
								<a href="/contacto" class="quote"><?php _e('CONTACTO','baquedano')?></a>
							</div>

						</div>
					</div>
				</div>

			</header>
			<!--header Section End Here -->
