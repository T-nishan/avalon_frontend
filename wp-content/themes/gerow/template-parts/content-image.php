<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gerow
 */

$gerow_show_blog_share = get_theme_mod('gerow_show_blog_share', false);
$gerow_post_tags_width = $gerow_show_blog_share ? 'col-md-7' : 'col-12';

?>
<?php if (is_single()) : ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-item-two blog-details-wrap format-image'); ?>>

        <?php if (has_post_thumbnail()) : ?>
            <div class="blog-details-thumb">
                <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
            </div>
        <?php endif; ?>

        <div class="blog-details-content">

            <!-- blog meta -->
            <div class="blog-meta-three">
                <?php get_template_part('template-parts/blog/blog-meta'); ?>
            </div>

            <div class="post-text">
                <?php the_content(); ?>
                <?php
                wp_link_pages([
                    'before'      => '<div class="page-links">' . esc_html__('Pages:', 'gerow'),
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ]);
                ?>
            </div>

            <?php if (!empty(get_the_tags())) : ?>
                <div class="blog-details-bottom">

                    <div class="row">
                        <div class="<?php echo esc_attr($gerow_post_tags_width); ?>">
                            <?php print gerow_get_tag(); ?>
                        </div>
                        <?php if (!empty($gerow_show_blog_share)) : ?>
                            <div class="col-md-5">
                                <div class="blog-details-social text-md-end">
                                    <h5 class="social-title"><?php echo esc_html__('Social Share :', 'gerow') ?></h5>
                                    <?php gerow_social_share(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endif; ?>

        </div>
    </article>

<?php else : ?>

    <div class="col-md-6 grid-item">
        <article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-item-two format-image'); ?>>

            <?php if (has_post_thumbnail()) : ?>
                <div class="blog-post-thumb-two">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
                    </a>

                    <?php $categories = get_the_category();
                    if (!empty($categories)) {
                        echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="tag tag-two">' . esc_html($categories[0]->name) . '</a>';
                    }
                    ?>
                </div>
            <?php endif; ?>

            <div class="blog-post-content-two">

                <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                <p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), 12, ''); ?></p>

                <!-- blog meta -->
                <div class="blog-meta">
                    <?php get_template_part('template-parts/blog/blog-meta'); ?>
                </div>

            </div>

        </article>
    </div>

<?php endif; ?>