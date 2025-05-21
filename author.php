<?php get_header(); ?>

<section class="single--team position-relative">
    <div class="container">
        <div class="wrapper">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-12">
					<div class="img position-relative">
    					<?php
    					$author_id = get_the_author_meta('ID');
    					$profile_picture = get_user_meta($author_id, 'simple_local_avatar', true); // Adjust if needed

    					// If the profile picture is stored as an array (some plugins do this)
    					if (is_array($profile_picture) && isset($profile_picture['full'])) {
        					$profile_picture = $profile_picture['full']; // Get the full image URL
    					}

    					// Fallback to Gravatar if no custom profile picture is set
    					if (!$profile_picture) {
        					$profile_picture = get_avatar_url($author_id, ['size' => 800]);
    					}
    					?>
    					<img src="<?php echo esc_url($profile_picture); ?>" alt="<?php echo esc_attr(get_the_author()); ?>">
					</div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="inner">
                        <h1><?php echo get_the_author(); ?></h1>
                        <h5><?php echo get_the_author_meta('wpseo_job_title'); ?></h5>
                        <div class="bio">
                            <?php echo wpautop(get_the_author_meta('description')); ?>
                        </div>
                        <hr>
                        <ul>
    						<li>
        					<a href="mailto:<?php echo esc_attr(get_the_author_meta('email')); ?>">
            					<i class="fa fa-envelope"></i> <?php echo esc_html(get_the_author_meta('email')); ?>
        					</a>
    						</li>

    						<?php $author_phone = get_the_author_meta('author_phone'); ?>
    						<?php if (!empty($author_phone)) : ?>
        						<li>
            						<a href="tel:<?php echo esc_attr($author_phone); ?>">
                						<i class="fa fa-phone"></i> <?php echo esc_html($author_phone); ?>
            						</a>
        						</li>
    						<?php endif; ?>
						</ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.author-profile {
    padding: 60px 0;
    background: #fff;
    border-radius: 20px;
    margin: 20px;
}

.author-image-container {
    width: 100%;
    height: 600px;
    overflow: hidden;
    border-radius: 10px;
}

.author-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.author-bio {
    margin: 30px 0;
}

.contact-info a {
    color: #000;
    text-decoration: none;
}
</style>

<section class="explore padd-lg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between">
                    <h2><?= ICL_LANGUAGE_CODE === 'en' ? 'Latest posts' : 'Articles récents' ?></h2>
                </div>
            </div>
        </div>
        <div class="row row-cols-md-2 row-cols-lg-3 row-cols-1 mt-5">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="col">
                    <a href="<?php the_permalink(); ?>" class="card">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('full', array('class' => 'card-img-top')); ?>
                        <?php endif; ?>
                        <div class="card-body">
                            <div class="date"><?php echo get_the_date('M d, Y'); ?></div>
                            <h3><?php the_title(); ?></h3>
                            <div class="shortIntro">
                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            </div>
                            <hr/>
                            <p class="btn-link"><?= ICL_LANGUAGE_CODE === 'en' ? 'Read More' : 'Lire la suite' ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/arrow-right-grey.svg">
                            </p>
                        </div>
                    </a>
                </div>
            <?php endwhile; endif; ?>
        </div>
        <div class="row mt-4">
            <div class="col text-center">
                <?php wpbeginner_numeric_posts_nav(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>