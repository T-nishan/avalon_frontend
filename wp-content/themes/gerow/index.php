<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gerow
 */

get_header();

$blog_column_lg = is_active_sidebar('blog-sidebar') ? 'col-71' : 'col-12';

?>

<section class="blog-area pt-120 pb-120">
    <div class="container">
        <div class="inner-blog-wrap">
            <div class="row justify-content-center">
                <div class="<?php print esc_attr($blog_column_lg); ?>">
                    <div class="blog-item-wrap">
                        <?php
                        if (have_posts()) :
                            if (is_home() && !is_front_page()) :
                        ?>
                                <header>
                                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                                </header>
                            <?php
                            endif; ?>
                            <div class="row blog-masonry-active">
                                <?php
                                /* Start the Loop */
                                while (have_posts()) : the_post(); ?>
                                    <?php
                                    /*
                                * Include the Post-Type-specific template for the content.
                                * If you want to override this in a child theme, then include a file
                                * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                                */
                                    get_template_part('template-parts/content', get_post_format()); ?>
                                <?php
                                endwhile;
                                ?>
                            </div>
                            <nav class="pagination-wrap">
                                <?php gerow_pagination('<i class="fas fa-angle-double-left"></i>', '<i class="fas fa-angle-double-right"></i>', '', ['class' => 'page-link next']); ?>
                            </nav>
                        <?php
                        else :
                            get_template_part('template-parts/content', 'none');
                        endif;
                        ?>

                    </div>
                </div>

                <?php if (is_active_sidebar('blog-sidebar')) : ?>
                    <div class="col-29">
                        <aside class="blog-sidebar">
                            <?php get_sidebar(); ?>
                        </aside>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
