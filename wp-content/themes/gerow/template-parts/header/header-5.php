<?php

/**
 * Template part for displaying header layout one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gerow
 */

// Header Settings
$gerow_show_sticky_header = get_theme_mod('gerow_show_sticky_header', false);
$sticky_header = $gerow_show_sticky_header ? 'sticky-header' : 'sticky-default';
$sticky_height = $gerow_show_sticky_header ? '' : 'd-none';

$menu_padding = has_nav_menu('main-menu') ? 'gerow-menu-has-showing' : 'gerow-menu-not-showing';

// Header Button
$gerow_show_header_button = get_theme_mod('gerow_show_header_button', false);
$gerow_header_btn_text = get_theme_mod('gerow_header_btn_text', __('Get a Quote', 'gerow'));
$gerow_header_btn_url = get_theme_mod('gerow_header_btn_url', __('#', 'gerow'));

// Mobile Menu
$gerow_show_mobile_search = get_theme_mod('gerow_show_mobile_search', false);
$gerow_show_mobile_social = get_theme_mod('gerow_show_mobile_social', false);


?>


<!-- header-area -->
<header class="header-style-five transparent-header">
    <div id="sticky-header" class="menu-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="menu-wrap">
                        <nav class="menu-nav">
                            <div class="logo">
                                <?php gerow_header_logo(); ?>
                            </div>
                            <div class="navbar-wrap main-menu d-none d-lg-flex">
                                <?php gerow_header_menu(); ?>
                            </div>
                            <div class="header-action">
                                <ul class="list-wrap">
                                    <?php if (!empty($gerow_show_header_button)) : ?>
                                        <li class="header-btn">
                                            <a href="<?php echo esc_url($gerow_header_btn_url) ?>" class="btn btn-two"><?php echo esc_html($gerow_header_btn_text); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php if (has_nav_menu('main-menu')) { ?>
                                <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                            <?php } ?>
                        </nav>
                    </div>

                    <!-- Mobile Menu  -->
                    <div class="mobile-menu">
                        <nav class="menu-box">
                            <div class="close-btn"><i class="fas fa-times"></i></div>
                            <div class="nav-logo">
                                <?php gerow_mobile_logo(); ?>
                            </div>

                            <?php if (!empty($gerow_show_mobile_search)) : ?>
                                <div class="mobile-search">
                                    <form method="get" action="<?php print esc_url(home_url('/')); ?>">
                                        <input type="text" name="s" value="<?php print esc_attr(get_search_query()) ?>" placeholder="<?php print esc_attr__('Search here...', 'gerow'); ?>">
                                        <button><i class="flaticon-search"></i></button>
                                    </form>
                                </div>
                            <?php endif; ?>

                            <div class="menu-outer">
                                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                            </div>
                            <?php if (!empty($gerow_show_mobile_social)) : ?>
                                <div class="social-links">
                                    <?php gerow_mobile_social_profiles(); ?>
                                </div>
                            <?php endif; ?>
                        </nav>
                    </div>
                    <div class="menu-backdrop"></div>
                    <!-- End Mobile Menu -->

                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-area-end -->