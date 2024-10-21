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

// Header Top
$gerow_show_header_top = get_theme_mod('gerow_show_header_top', false);
$gerow_header_location = get_theme_mod('gerow_header_location', __('256 Avenue, Mark Street, Newyork City', 'gerow'));
$gerow_header_email_text = get_theme_mod('gerow_header_email_text', __('gerow@gmail.com', 'gerow'));
$gerow_header_phone_text = get_theme_mod('gerow_header_phone_text', __('+123 8989 444', 'gerow'));

$gerow_show_header_social = get_theme_mod('gerow_show_header_social', false);
$gerow_header_fb = get_theme_mod('gerow_header_fb', __('#', 'gerow'));
$gerow_header_twitter = get_theme_mod('gerow_header_twitter', __('#', 'gerow'));
$gerow_header_instagram = get_theme_mod('gerow_header_instagram', __('#', 'gerow'));
$gerow_header_pinterest = get_theme_mod('gerow_header_pinterest', __('#', 'gerow'));

// Header Search
$gerow_show_header_search = get_theme_mod('gerow_show_header_search', false);

// Header Button
$gerow_show_header_button = get_theme_mod('gerow_show_header_button', false);
$gerow_header_btn_text = get_theme_mod('gerow_header_btn_text', __('Get a Quote', 'gerow'));
$gerow_header_btn_url = get_theme_mod('gerow_header_btn_url', __('#', 'gerow'));

// Mobile Menu
$gerow_show_mobile_search = get_theme_mod('gerow_show_mobile_search', false);
$gerow_show_mobile_social = get_theme_mod('gerow_show_mobile_social', false);


?>


<!-- header-area -->
<div id="header-fixed-height" class="<?php echo esc_attr($sticky_height) ?>"></div>
<header class="header-style-six">

    <?php if (!empty($gerow_show_header_top)) : ?>
        <div class="heder-top-wrap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="header-top-left">
                            <ul class="list-wrap">
                                <?php if (!empty($gerow_header_location)) : ?>
                                    <li><i class="flaticon-location"></i><?php echo esc_html($gerow_header_location); ?></li>
                                <?php endif; ?>
                                <?php if (!empty($gerow_header_email_text)) : ?>
                                    <li><i class="flaticon-mail"></i><a href="mailto:<?php echo esc_attr($gerow_header_email_text); ?>"><?php echo esc_html($gerow_header_email_text); ?></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="header-top-right">
                            <?php if (!empty($gerow_header_phone_text)) : ?>
                                <div class="header-contact">
                                    <a href="tel:<?php echo esc_attr($gerow_header_phone_text); ?>"><i class="flaticon-phone-call"></i><?php echo esc_html($gerow_header_phone_text); ?></a>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($gerow_show_header_social)) : ?>
                                <div class="header-social">
                                    <ul class="list-wrap">

                                        <?php if (!empty($gerow_header_fb)) : ?>
                                            <li><a href="<?php echo esc_url($gerow_header_fb); ?>"><i class="fab fa-facebook-f"></i></a></li>
                                        <?php endif; ?>

                                        <?php if (!empty($gerow_header_twitter)) : ?>
                                            <li><a href="<?php echo esc_url($gerow_header_twitter); ?>"><i class="fab fa-twitter"></i></a></li>
                                        <?php endif; ?>

                                        <?php if (!empty($gerow_header_instagram)) : ?>
                                            <li><a href="<?php echo esc_url($gerow_header_instagram); ?>"><i class="fab fa-instagram"></i></a></li>
                                        <?php endif; ?>

                                        <?php if (!empty($gerow_header_pinterest)) : ?>
                                            <li><a href="<?php echo esc_url($gerow_header_pinterest); ?>"><i class="fab fa-pinterest-p"></i></a></li>
                                        <?php endif; ?>

                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div id="<?php echo esc_attr($sticky_header); ?>" class="menu-area <?php echo esc_attr($menu_padding) ?>">
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
                            <div class="header-action d-none d-md-block">
                                <ul class="list-wrap">

                                    <?php if (!empty($gerow_show_header_search)) : ?>
                                        <li class="header-search">
                                            <a href="javascript:void(0)" class="search-open-btn"><i class="flaticon-search"></i></a>
                                        </li>
                                    <?php endif; ?>

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

    <?php if (!empty($gerow_show_header_search)) : ?>
        <!-- header-search -->
        <div class="search__popup">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="search__wrapper">
                            <div class="search__close">
                                <button type="button" class="search-close-btn">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17 1L1 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M1 1L17 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                            <div class="search__form">
                                <form method="get" action="<?php print esc_url(home_url('/')); ?>">
                                    <div class="search__input">
                                        <input class="search-input-field" type="text" name="s" value="<?php print esc_attr(get_search_query()) ?>" placeholder="<?php print esc_attr__('Type keywords here', 'gerow'); ?>">
                                        <span class="search-focus-border"></span>
                                        <button>
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.55 18.1C14.272 18.1 18.1 14.272 18.1 9.55C18.1 4.82797 14.272 1 9.55 1C4.82797 1 1 4.82797 1 9.55C1 14.272 4.82797 18.1 9.55 18.1Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M19.0002 19.0002L17.2002 17.2002" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-popup-overlay"></div>
        <!-- header-search-end -->
    <?php endif; ?>

</header>
<!-- header-area-end -->