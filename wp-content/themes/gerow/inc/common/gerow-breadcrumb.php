<?php

/**
 * Breadcrumbs for Gerow Theme.
 *
 * @package     gerow
 * @author      ThemeDox
 * @copyright   Copyright (c) 2023, ThemeDox
 * @link        https://www.themedox.com
 * @since       gerow 1.0.0
 */


function gerow_breadcrumb_func()
{
    global $post;
    $breadcrumb_class = '';
    $breadcrumb_show = 1;

    if (is_front_page() && is_home()) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'gerow'));
        $breadcrumb_class = 'home_front_page';
    } elseif (is_front_page()) {
        $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'gerow'));
        $breadcrumb_show = 0;
    } elseif (is_home()) {
        if (get_option('page_for_posts')) {
            $title = get_the_title(get_option('page_for_posts'));
        }
    } elseif (is_single() && 'post' == get_post_type()) {
        $title = get_the_title();
        $breadcrumb_class = 'details-breadcrumb';
    } elseif (is_search()) {
        $title = esc_html__('Search Results for : ', 'gerow') . get_search_query();
    } elseif (is_404()) {
        $title = esc_html__('Page not Found', 'gerow');
    } elseif (is_archive()) {
        $title = get_the_archive_title();
    } else {
        $title = get_the_title();
    }

    $_id = get_the_ID();

    if (is_single() && 'product' == get_post_type()) {
        $_id = $post->ID;
    } elseif (is_home() && get_option('page_for_posts')) {
        $_id = get_option('page_for_posts');
    }

    $is_breadcrumb = function_exists('get_field') ? get_field('is_it_invisible_breadcrumb', $_id) : '';
    if (!empty($_GET['s'])) {
        $is_breadcrumb = null;
    }

    if (empty($is_breadcrumb) && $breadcrumb_show == 1) {
        // get_theme_mod
        $breadcrumb_hide_default = get_theme_mod('breadcrumb_hide_default', true);
        $breadcrumb_info_switch = get_theme_mod('breadcrumb_info_switch', false);

        // Background Image
        $bg_img_from_page = function_exists('get_field') ? get_field('breadcrumb_background_image', $_id) : '';
        $hide_bg_img = function_exists('get_field') ? get_field('hide_breadcrumb_background_image', $_id) : '';

        // get_theme_mod
        $bg_img = get_theme_mod('breadcrumb_bg_img');

        if ($hide_bg_img && empty($_GET['s'])) {
            $bg_img = '';
        } else {
            $bg_img = !empty($bg_img_from_page) ? $bg_img_from_page['url'] : $bg_img;
        }
    ?>

        <?php if (!empty($breadcrumb_hide_default)) : ?>
            <!-- breadcrumb-area -->
            <section class="breadcrumb-area breadcrumb-bg <?php print esc_attr($breadcrumb_class); ?>" data-background="<?php print esc_attr($bg_img); ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb-content">
                                <h2 class="title"><?php echo wp_kses_post($title); ?></h2>

                                <?php if (!empty($breadcrumb_info_switch)) : ?>
                                    <nav aria-label="breadcrumb" class="breadcrumb">
                                        <?php if (function_exists('bcn_display')) {
                                            bcn_display();
                                        } ?>
                                    </nav>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->
        <?php endif; ?>

<?php
    }
}

add_action('gerow_before_main_content', 'gerow_breadcrumb_func');