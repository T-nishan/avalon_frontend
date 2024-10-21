<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package gerow
 */

get_header();

$blog_column_lg = is_active_sidebar('blog-sidebar') ? 'col-71' : 'col-12';

?>

<div class="blog-area pt-120 pb-120">
    <div class="container">
        <div class="inner-blog-wrap">
            <div class="row justify-content-center">
                <div class="<?php print esc_attr($blog_column_lg); ?>">
                    <div class="blog-item-wrap">
                        <?php
                        if (have_posts()) :
                        ?>
                            <div class="result-bar page-header d-none">
                                <h1 class="page-title"><?php esc_html_e('Search Results For:', 'gerow'); ?> <?php print get_search_query(); ?></h1>
                            </div>
                            <div class="row blog-masonry-active">
                                <?php
                                while (have_posts()) : the_post();
                                    get_template_part('template-parts/content', 'search');
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
</div>

<?php
get_footer();
