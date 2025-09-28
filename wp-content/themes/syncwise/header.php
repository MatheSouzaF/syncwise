<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<meta name="format-detection" content="telephone=no">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap"
		rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.plyr.io/3.8.3/plyr.css" />

	<title><?php wp_title(); ?></title>

	<?php wp_head(); ?>

</head>

<body <?php body_class(""); ?>>

	<header class="header">
		<div class="wrapper">

			<div class="box-svg-header">
				<?php $svg_file = get_field('svg_logo', 'options');
				if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
					echo '<a href="' . esc_url(home_url('/')) . '">';
					echo '<i class="element">';
					echo file_get_contents($svg_file['url']);
					echo '</i>';
					echo '</a>';
				} ?>
			</div>
			<?php if (have_rows('links_menu', 'option')): ?>
				<ul class="main-menu">
					<?php while (have_rows('links_menu', 'option')):
						the_row();
						$title = get_sub_field('title_dropdown');
						?>
						<li class="menu-item">
							<?php
							$link = get_sub_field('title_dropdown', 'option');
							if ($link):
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self'; ?>
								<a class="" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
									<p class="tab-title blue-txt"><?php echo esc_html($link_title); ?></p>
								</a>
							<?php endif; ?>


							<div class="dropdown-menu">
								<div class="box-drowpdown">

									<?php
									if (have_rows('links_dropdown', 'option')):
										while (have_rows('links_dropdown', 'option')):
											the_row(); ?>
											<?php
											$link = get_sub_field('link_dropdown', 'option');
											if ($link):
												$link_url = $link['url'];
												$link_title = $link['title'];
												$link_target = $link['target'] ? $link['target'] : '_self'; ?>
												<a class="" href="<?php echo esc_url($link_url); ?>"
													target="<?php echo esc_attr($link_target); ?>">
													<ul>
														<li>
															<div class="box-svg">
																<?php $svg_file = get_sub_field('svg_link', 'option');
																if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
																	echo '<i class="element">';
																	echo file_get_contents($svg_file['url']);
																	echo '</i>';
																} ?>
															</div>

															<p class="grey-txt"><?php echo esc_html($link_title); ?></p>

														</li>
													</ul>
												</a>
											<?php endif; ?>
										<?php endwhile; ?>
									<?php endif; ?>
								</div>
							</div>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php endif; ?>


			<div class="buttons-menu">
				<?php
				$link = get_field('link_lest', 'options');
				if ($link):
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self'; ?>
					<a class="lest-talk btn-v1" href="<?php echo esc_url($link_url); ?>"
						target="<?php echo esc_attr($link_target); ?>">
						<p class=""><?php echo esc_html($link_title); ?></p>
					</a>
				<?php endif; ?>


				<?php
				$link = get_field('portal_login', 'options');
				if ($link):
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self'; ?>
					<a class="portal" href="<?php echo esc_url($link_url); ?>"
						target="<?php echo esc_attr($link_target); ?>">
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18" fill="none">
							<path
								d="M15 17C15 14.5454 11.866 12.5556 8 12.5556C4.13401 12.5556 1 14.5454 1 17M8 9.88889C5.58375 9.88889 3.625 7.89904 3.625 5.44444C3.625 2.98985 5.58375 1 8 1C10.4162 1 12.375 2.98985 12.375 5.44444C12.375 7.89904 10.4162 9.88889 8 9.88889Z"
								stroke="#04174F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
						<p class="blue-txt"><?php echo esc_html($link_title); ?></p>
					</a>
				<?php endif; ?>
			</div>
		</div>

	</header>
	<div class="menu-mobile">
		<?php
		$link = get_field('link_lest', 'options');
		if ($link):
			$link_url = $link['url'];
			$link_title = $link['title'];
			$link_target = $link['target'] ? $link['target'] : '_self'; ?>
			<a class="lest-talk-mobile" href="<?php echo esc_url($link_url); ?>"
				target="<?php echo esc_attr($link_target); ?>">
				<p class=""><?php echo esc_html($link_title); ?></p>
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<path d="M19 12L13 18M19 12L13 6M19 12L5 12" stroke="white" stroke-width="2" stroke-linecap="round"
						stroke-linejoin="round" />
				</svg>
			</a>
		<?php endif; ?>

		<nav class="box-navbar">

			<label for="menu-toggle" id="btn-active" class="navigation__menu-label">
				<span class="navigation__label-bar navigation__label-bar1 "></span>
				<span class="navigation__label-bar navigation__label-bar2"></span>
				<span class="navigation__label-bar navigation__label-bar3"></span>
			</label>
		</nav>
	</div>

	<ul class="sidebar">

		<div class="box-sidebar">
			<svg class="back-step-off" xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16"
				fill="none">
				<path d="M1 8L7.85714 1M1 8L7.85714 15M1 8L17 8" stroke="#838690" stroke-width="2"
					stroke-linecap="round" stroke-linejoin="round" />
			</svg>
			<div class="links-menu-mobile">
				<?php if (have_rows('links_menu', 'option')): ?>
					<?php while (have_rows('links_menu', 'option')):
						the_row(); ?>
						<div class="box-row-link-menu">
							<div class="box-tab-title">

								<?php $link = get_sub_field('title_dropdown', 'option'); ?>
								<?php if ($link): ?>
									<p class="tab-title blue-txt"><?php echo esc_html($link['title']); ?></p>
								<?php endif; ?>
							</div>

							<div class="box-links-menu-mobile">
								<svg class="back-step" xmlns="http://www.w3.org/2000/svg" width="18" height="16"
									viewBox="0 0 18 16" fill="none">
									<path d="M1 8L7.85714 1M1 8L7.85714 15M1 8L17 8" stroke="#838690" stroke-width="2"
										stroke-linecap="round" stroke-linejoin="round" />
								</svg>
								<?php
								$link = get_sub_field('title_dropdown', 'option');
								if ($link):
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self'; ?>
									<a class="link-tab-title" href="<?php echo esc_url($link_url); ?>"
										target="<?php echo esc_attr($link_target); ?>">
										<p class="tab-title blue-txt"><?php echo esc_html($link_title); ?></p>
									</a>
								<?php endif; ?>

								<?php if (have_rows('links_dropdown', 'option')): ?>
									<ul>
										<?php while (have_rows('links_dropdown', 'option')):
											the_row(); ?>
											<li>
												<div class="box-svg">
													<?php $svg_file = get_sub_field('svg_link', 'option');
													if ($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg') {
														echo '<i class="element">' . file_get_contents($svg_file['url']) . '</i>';
													} ?>
												</div>
												<?php
												$link = get_sub_field('link_dropdown', 'option');
												if ($link): ?>
													<a href="<?php echo esc_url($link['url']); ?>"
														target="<?php echo esc_attr($link['target'] ?: '_self'); ?>">
														<p class="blue-txt"><?php echo esc_html($link['title']); ?></p>
													</a>
												<?php endif; ?>
											</li>
										<?php endwhile; ?>
									</ul>
								<?php endif; ?>
							</div>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>

		<div class="box-sidebar buttons-footer-menu">
			<?php
			$link = get_field('portal_login', 'options');
			if ($link):
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self'; ?>
				<a class="portal" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewBox="0 0 16 18" fill="none">
						<path
							d="M15 17C15 14.5454 11.866 12.5556 8 12.5556C4.13401 12.5556 1 14.5454 1 17M8 9.88889C5.58375 9.88889 3.625 7.89904 3.625 5.44444C3.625 2.98985 5.58375 1 8 1C10.4162 1 12.375 2.98985 12.375 5.44444C12.375 7.89904 10.4162 9.88889 8 9.88889Z"
							stroke="#04174F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
					<p class="blue-txt"><?php echo esc_html($link_title); ?></p>
				</a>
			<?php endif; ?>
			<div class="box-close-btn">
				<?php
				$link = get_field('link_lest', 'options');
				if ($link):
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self'; ?>
					<a class="lest-talk-mobile" href="<?php echo esc_url($link_url); ?>"
						target="<?php echo esc_attr($link_target); ?>">
						<p class=""><?php echo esc_html($link_title); ?></p>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M19 12L13 18M19 12L13 6M19 12L5 12" stroke="white" stroke-width="2"
								stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</a>
				<?php endif; ?>

				<div class="box-svg">

					<svg class="close-sidebar" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
						viewBox="0 0 18 18" fill="none">
						<path d="M1.06958 1.07031L16.7549 16.7556" stroke="white" stroke-width="1.77083"
							stroke-linecap="round" />
						<path d="M1.06934 16.7559L16.7546 1.07056" stroke="white" stroke-width="1.77083"
							stroke-linecap="round" />
					</svg>
				</div>
			</div>
		</div>
	</ul>
	<main>