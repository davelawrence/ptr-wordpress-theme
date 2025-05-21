<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Peter_Thompson
 */
?>

<?php 
    // function to create an excerpt with the property description
    function descriptionExcerpt($description) {
        if (strlen($description) < 200) {
            return $description;
        } else {
            $new = wordwrap($description, 200);
            $new = explode("\n", $new);
            $new = $new[0] . '...';

            return $new;
        }
    }
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<?php
if ( is_singular() ) {
    echo "\n<!-- POST TYPE: " . get_post_type() . " -->\n";
}
if ( is_archive() && get_query_var('post_type') ) {
    echo "\n<!-- ARCHIVE PT: " . implode( ',', (array) get_query_var('post_type') ) . " -->\n";
}
?>


<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/assets/css/owl.theme.default.min.css">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<section class="header" data-aos="fade-down" data-aos-delay="700">
	<div class="navbar-area py-0">
		<div class="main-nav">
			<div class="bigger-container spr position-relative g-0">
				<nav class="navbar navbar-expand-lg navbar-light">
					<a class="navbar-brand d-lg-none" href="<?php echo home_url();?>">
						<img src="<?php the_field('logo','option');?>" alt="logo">
					</a> 
					<span class="d-lg-none mebox d-flex align-items-center  ms-auto me-3">
                        <div class="spr">
                           <?php echo do_shortcode('[wpml_language_selector_footer]');?>
                        </div>
                        <div>
                            <div class="filter-search-header-icon searchbtn"></div>
                        </div>
                    </span>
					<button class="navbar-toggler menu-icon" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class=""></span>
						<span class=""></span>
						<span class=""></span>
					</button>
					<div class="collapse navbar-collapse for-mobile-menu" id="navbarSupportedContent">
						<ul class="navbar-nav logo p-0 me-auto d-none d-lg-block">
							<li class="nav-item">
								<a href="<?php echo home_url();?>" class="nav-link"><img src="<?php the_field('logo','option');?>" alt="logo"></a>
							</li>
						</ul>
						<?php
						wp_nav_menu( array(
							'container'=> false,
							'menu_class'=> false, 
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'menu_class'        => 'navbar-nav middle mx-auto',
							'list_item_class'  => 'nav-item',
							'link_class'   => 'nav-link '
						) );
						?>
						<ul class="navbar-nav d-none d-md-none d-lg-flex rt ms-auto justify-content-end">
							<li class="nav-item">
								<?php echo do_shortcode('[wpml_language_selector_footer]');?>
							</li>
							<li class="nav-item">
								<div class="filter-search-header-icon searchbtn"></div>
							</li>
						</ul>
					</div>
				</nav>
				<div class="formstyle">
  					<form 
    					role="search" 
    					method="get" 
    					class="subscribe-form" 
    					action="<?php echo esc_url( get_post_type_archive_link('properties') ); ?>"
  					>
    				<input type="hidden" name="search">
    				<input 
      					class="form-control" 
      					type="search"
      					placeholder="<?= ICL_LANGUAGE_CODE==='en'?'Search for properties':'Recherche de propriétés' ?>"
      					name="q"
      					title="<?= ICL_LANGUAGE_CODE==='en'?'Search for:':'Rechercher :'?>"
   					/>
    				<input type="submit" class="btn-default" value="<?= ICL_LANGUAGE_CODE==='en'?'Search':'Rechercher' ?>" />
  					</form>
					</div>
			</div>
		</div>
	</div>
</section>