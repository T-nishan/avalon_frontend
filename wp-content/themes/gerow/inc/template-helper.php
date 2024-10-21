<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package gerow
 */


/**
 *
 * Gerow Header
 */

function gerow_check_header() {
    $gerow_header_style = function_exists( 'get_field' ) ? get_field( 'header_style' ) : NULL;
    $gerow_default_header_style = get_theme_mod( 'choose_default_header', 'header-style-1' );

    if ( $gerow_header_style == 'header-style-1' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-1' );
    }
    elseif ( $gerow_header_style == 'header-style-2' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-2' );
    }
    elseif ( $gerow_header_style == 'header-style-3' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-3' );
    }
    elseif ( $gerow_header_style == 'header-style-4' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-4' );
    }
    elseif ( $gerow_header_style == 'header-style-5' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-5' );
    }
    elseif ( $gerow_header_style == 'header-style-6' && empty($_GET['s']) ) {
        get_template_part( 'template-parts/header/header-6' );
    }
    else {
        /** Default Header Style **/
        if ( $gerow_default_header_style == 'header-style-2' ) {
            get_template_part( 'template-parts/header/header-2' );
        }
        elseif ( $gerow_default_header_style == 'header-style-3' ) {
            get_template_part( 'template-parts/header/header-3' );
        }
        elseif ( $gerow_default_header_style == 'header-style-4' ) {
            get_template_part( 'template-parts/header/header-4' );
        }
        elseif ( $gerow_default_header_style == 'header-style-5' ) {
            get_template_part( 'template-parts/header/header-5' );
        }
        elseif ( $gerow_default_header_style == 'header-style-6' ) {
            get_template_part( 'template-parts/header/header-6' );
        }
        else {
            get_template_part( 'template-parts/header/header-1' );
        }
    }

}
add_action( 'gerow_header_style', 'gerow_check_header', 10 );


/**
 * [gerow_header_lang description]
 * @return [type] [description]
 */
function gerow_header_lang_default() {
    $gerow_header_lang = get_theme_mod( 'gerow_header_lang', false );
    if ( $gerow_header_lang ): ?>

    <ul>
        <li><a href="javascript:void(0)" class="lang__btn"><?php print esc_html__( 'English', 'gerow' );?> <i class="fa-light fa-angle-down"></i></a>
        <?php do_action( 'gerow_language' );?>
        </li>
    </ul>

    <?php endif;?>
<?php
}

/**
 * [gerow_language_list description]
 * @return [type] [description]
 */
function _gerow_language( $mar ) {
    return $mar;
}
function gerow_language_list() {

    $mar = '';
    $languages = apply_filters( 'wpml_active_languages', NULL, 'orderby=id&order=desc' );
    if ( !empty( $languages ) ) {
        $mar = '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">';
        foreach ( $languages as $lan ) {
            $active = $lan['active'] == 1 ? 'active' : '';
            $mar .= '<a href="' . $lan['url'] . '" class="' . $active . '">' . $lan['translated_name'] . '</a>';
        }
        $mar .= '</div>';
    } else {
        //remove this code when send themeforest reviewer team
        $mar .= '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">';
        $mar .= '<a href="#" class="dropdown-item">' . esc_html__( '🇷🇺 Russia', 'gerow' ) . '</a>';
        $mar .= '<a href="#" class="dropdown-item">' . esc_html__( '🇮🇳 India', 'gerow' ) . '</a>';
        $mar .= '<a href="#" class="dropdown-item">' . esc_html__( '🇹🇷 Turkey', 'gerow' ) . '</a>';
        $mar .= '<a href="#" class="dropdown-item">' . esc_html__( '🇫🇷 France', 'gerow' ) . '</a>';
        $mar .= ' </div>';
    }
    print _gerow_language( $mar );
}
add_action( 'gerow_language', 'gerow_language_list' );


// Header Logo
function gerow_header_logo() { ?>
      <?php
        $gerow_logo_on = function_exists( 'get_field' ) ? get_field( 'is_enable_sec_logo' ) : NULL;
        $gerow_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
        $gerow_logo_black = get_template_directory_uri() . '/assets/img/logo/secondary_logo.png';

        $gerow_site_logo = get_theme_mod( 'logo', $gerow_logo );
        $gerow_secondary_logo = get_theme_mod( 'secondary_logo', $gerow_logo_black );
      ?>

      <?php if ( !empty( $gerow_logo_on ) ) : ?>
         <a class="secondary-logo" href="<?php print esc_url( home_url( '/' ) );?>">
             <img src="<?php print esc_url( $gerow_secondary_logo );?>" style="max-height: <?php echo get_theme_mod( 'logo_size_adjust', '29px' ); ?>" alt="<?php print esc_attr__( 'Logo', 'gerow' );?>" />
         </a>
      <?php else : ?>
         <a class="main-logo" href="<?php print esc_url( home_url( '/' ) );?>">
             <img src="<?php print esc_url( $gerow_site_logo );?>" style="max-height: <?php echo get_theme_mod( 'logo_size_adjust', '29px' ); ?>" alt="<?php print esc_attr__( 'Logo', 'gerow' );?>" />
         </a>
      <?php endif; ?>
   <?php
}

// Header Sticky Logo
function gerow_header_sticky_logo() {?>
    <?php
        $gerow_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
        $gerow_site_logo = get_theme_mod( 'logo', $gerow_logo );
    ?>
      <a class="sticky-logo" href="<?php print esc_url( home_url( '/' ) );?>">
          <img src="<?php print esc_url( $gerow_site_logo );?>" style="max-height: <?php echo get_theme_mod( 'logo_size_adjust', '29px' ); ?>" alt="<?php print esc_attr__( 'Logo', 'gerow' );?>" />
      </a>
    <?php
}

// Mobile Menu Logo
function gerow_mobile_logo() {

    $mobile_menu_logo = get_template_directory_uri() . '/assets/img/logo/logo.png';
    $mobile_logo = get_theme_mod('mobile_logo', $mobile_menu_logo);

    ?>

    <a class="main-logo" href="<?php print esc_url( home_url( '/' ) ); ?>">
        <img src="<?php print esc_url( $mobile_logo ); ?>" style="max-height: <?php echo get_theme_mod( 'logo_size_adjust', '29px' ); ?>" alt="<?php print esc_attr__( 'Logo', 'gerow' );?>" />
    </a>

<?php }


/**
 * [gerow_header_social_profiles description]
 * @return [type] [description]
 */
function gerow_header_social_profiles() {
    $gerow_header_fb_url = get_theme_mod( 'gerow_header_fb_url', __( '#', 'gerow' ) );
    $gerow_header_twitter_url = get_theme_mod( 'gerow_header_twitter_url', __( '#', 'gerow' ) );
    $gerow_header_linkedin_url = get_theme_mod( 'gerow_header_linkedin_url', __( '#', 'gerow' ) );
    ?>
    <ul>
        <?php if ( !empty( $gerow_header_fb_url ) ): ?>
          <li><a href="<?php print esc_url( $gerow_header_fb_url );?>"><span><i class="flaticon-facebook"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $gerow_header_twitter_url ) ): ?>
            <li><a href="<?php print esc_url( $gerow_header_twitter_url );?>"><span><i class="flaticon-twitter"></i></span></a></li>
        <?php endif;?>

        <?php if ( !empty( $gerow_header_linkedin_url ) ): ?>
            <li><a href="<?php print esc_url( $gerow_header_linkedin_url );?>"><span><i class="flaticon-linkedin"></i></span></a></li>
        <?php endif;?>
    </ul>

<?php
}

function gerow_footer_social_profiles() {
    $gerow_footer_fb_url = get_theme_mod( 'gerow_footer_fb_url', __( '#', 'gerow' ) );
    $gerow_footer_twitter_url = get_theme_mod( 'gerow_footer_twitter_url', __( '#', 'gerow' ) );
    $gerow_footer_vimeo_url = get_theme_mod( 'gerow_footer_vimeo_url', __( '#', 'gerow' ) );
    $gerow_footer_youtube_url = get_theme_mod( 'gerow_footer_youtube_url', __( '#', 'gerow' ) );
    ?>

        <ul>
        <?php if ( !empty( $gerow_footer_fb_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $gerow_footer_fb_url );?>">
                    <i class="fab fa-facebook-square"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $gerow_footer_twitter_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $gerow_footer_twitter_url );?>">
                    <i class="fab fa-twitter"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $gerow_footer_vimeo_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $gerow_footer_vimeo_url );?>">
                    <i class="fab fa-vimeo-v"></i>
                </a>
            </li>
        <?php endif;?>

        <?php if ( !empty( $gerow_footer_youtube_url ) ): ?>
            <li>
                <a href="<?php print esc_url( $gerow_footer_youtube_url );?>">
                    <i class="fab fa-youtube"></i>
                </a>
            </li>
        <?php endif;?>
        </ul>
<?php
}

/**
 * [gerow_mobile_social_profiles description]
 * @return [type] [description]
 */
function gerow_mobile_social_profiles() {
    $gerow_mobile_fb_url           = get_theme_mod('gerow_mobile_fb_url', __('#','gerow'));
    $gerow_mobile_twitter_url      = get_theme_mod('gerow_mobile_twitter_url', __('#','gerow'));
    $gerow_mobile_instagram_url    = get_theme_mod('gerow_mobile_instagram_url', __('#','gerow'));
    $gerow_mobile_linkedin_url     = get_theme_mod('gerow_mobile_linkedin_url', __('#','gerow'));
    $gerow_mobile_telegram_url      = get_theme_mod('gerow_mobile_telegram_url', __('#','gerow'));
    ?>

    <ul class="clearfix">
        <?php if (!empty($gerow_mobile_fb_url)): ?>
        <li class="facebook">
            <a href="<?php print esc_url($gerow_mobile_fb_url); ?>"><i class="fab fa-facebook-f"></i></a>
        </li>
        <?php endif; ?>

        <?php if (!empty($gerow_mobile_twitter_url)): ?>
        <li class="twitter">
            <a href="<?php print esc_url($gerow_mobile_twitter_url); ?>"><i class="fab fa-twitter"></i></a>
        </li>
        <?php endif; ?>

        <?php if (!empty($gerow_mobile_instagram_url)): ?>
        <li class="instagram">
            <a href="<?php print esc_url($gerow_mobile_instagram_url); ?>"><i class="fab fa-instagram"></i></a>
        </li>
        <?php endif; ?>

        <?php if (!empty($gerow_mobile_linkedin_url)): ?>
        <li class="linkedin">
            <a href="<?php print esc_url($gerow_mobile_linkedin_url); ?>"><i class="fab fa-linkedin-in"></i></a>
        </li>
        <?php endif; ?>

        <?php if (!empty($gerow_mobile_telegram_url)): ?>
        <li class="telegram">
            <a href="<?php print esc_url($gerow_mobile_telegram_url); ?>"><i class="fab fa-telegram-plane"></i></a>
        </li>
        <?php endif; ?>
    </ul>

<?php
}


/**
 * [gerow_header_menu description]
 * @return [type] [description]
 */
function gerow_header_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => 'navigation',
            'container'      => '',
            'fallback_cb'    => 'Gerow_Navwalker_Class::fallback',
            'walker'         => new Gerow_Navwalker_Class,
        ] );
    ?>
    <?php
}


/**
 * [gerow_hamburger_menu description]
 * @return [type] [description]
 */
function gerow_hamburger_menu() {
    ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'hamburger-menu',
            'menu_class'     => 'navigation',
            'container'      => '',
            'fallback_cb'    => 'Gerow_Navwalker_Class::fallback',
            'walker'         => new Gerow_Navwalker_Class,
        ] );
    ?>
    <?php
}

/**
 * [gerow_header_menu description]
 * @return [type] [description]
 */
function gerow_mobile_menu() { ?>
    <?php
        $gerow_menu = wp_nav_menu( [
            'theme_location' => 'main-menu',
            'menu_class'     => 'navigation',
            'container'      => '',
            'fallback_cb'    => false,
            'echo'           => false,
        ] );

    $gerow_menu = str_replace( "menu-item-has-children", "menu-item-has-children has-children", $gerow_menu );
        echo wp_kses_post( $gerow_menu );
    ?>
    <?php
}

/**
 * [gerow_blog_mobile_menu description]
 * @return [type] [description]
 */
function gerow_blog_mobile_menu() { ?>
    <?php
        $gerow_menu = wp_nav_menu( [
            'theme_location' => 'blog-menu',
            'menu_class'     => 'navigation',
            'container'      => '',
            'fallback_cb'    => false,
            'echo'           => false,
        ] );

    $gerow_menu = str_replace( "menu-item-has-children", "menu-item-has-children has-children", $gerow_menu );
        echo wp_kses_post( $gerow_menu );
    ?>
    <?php
}

/**
 * [gerow_search_menu description]
 * @return [type] [description]
 */
function gerow_header_search_menu() { ?>
    <?php
        wp_nav_menu( [
            'theme_location' => 'header-search-menu',
            'menu_class'     => '',
            'container'      => '',
            'fallback_cb'    => 'Gerow_Navwalker_Class::fallback',
            'walker'         => new Gerow_Navwalker_Class,
        ] );
    ?>
    <?php
}

/**
 * [gerow_footer_menu description]
 * @return [type] [description]
 */
function gerow_footer_menu() {
    wp_nav_menu( [
        'theme_location' => 'footer-menu',
        'menu_class'     => 'navigation',
        'container'      => '',
        'fallback_cb'    => 'Gerow_Navwalker_Class::fallback',
        'walker'         => new Gerow_Navwalker_Class,
    ] );
}


/**
 * [gerow_category_menu description]
 * @return [type] [description]
 */
function gerow_category_menu() {
    wp_nav_menu( [
        'theme_location' => 'category-menu',
        'menu_class'     => 'cat-submenu m-0',
        'container'      => '',
        'fallback_cb'    => 'Gerow_Navwalker_Class::fallback',
        'walker'         => new Gerow_Navwalker_Class,
    ] );
}

/**
 *
 * gerow footer
 */
add_action( 'gerow_footer_style', 'gerow_check_footer', 10 );

function gerow_check_footer() {

    $footer_show = 1;
    $is_footer = function_exists( 'get_field' ) ? get_field( 'is_it_invisible_footer') : '';
    if( !empty($_GET['s']) ) {
      $is_footer = null;
    }

    if ( empty( $is_footer ) && $footer_show == 1 ) {
        $gerow_footer_style = function_exists( 'get_field' ) ? get_field( 'footer_style' ) : NULL;
        $gerow_default_footer_style = get_theme_mod( 'choose_default_footer', 'footer-style-1' );

        get_template_part( 'template-parts/footer/footer-1' );

    }
}


// gerow_copyright_text
function gerow_copyright_text() {
   print get_theme_mod( 'gerow_copyright', esc_html__( 'Copyright © Gerow 2023. All Rights Reserved', 'gerow' ) );
}


/**
 *
 * pagination
 */
if ( !function_exists( 'gerow_pagination' ) ) {

    function _gerow_pagi_callback( $pagination ) {
        return $pagination;
    }

    //page navegation
    function gerow_pagination( $prev, $next, $pages, $args ) {
        global $wp_query, $wp_rewrite;
        $menu = '';
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;

            if ( !$pages ) {
                $pages = 1;
            }

        }

        $pagination = [
            'base'      => add_query_arg( 'paged', '%#%' ),
            'format'    => '',
            'total'     => $pages,
            'current'   => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type'      => 'array',
        ];

        //rewrite permalinks
        if ( $wp_rewrite->using_permalinks() ) {
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
        }

        if ( !empty( $wp_query->query_vars['s'] ) ) {
            $pagination['add_args'] = ['s' => get_query_var( 's' )];
        }

        $pagi = '';
        if ( paginate_links( $pagination ) != '' ) {
            $paginations = paginate_links( $pagination );
            $pagi .= '<ul class="pagination">';
            foreach ( $paginations as $key => $pg ) {
                $pagi .= '<li class="page-item">' . $pg . '</li>';
            }
            $pagi .= '</ul>';
        }

        print _gerow_pagi_callback( $pagi );
    }
}


// theme color
function gerow_custom_color() {

    // Primary Color
    $color_code = get_theme_mod( 'gerow_color_option', '#0055FF' );
    wp_enqueue_style( 'gerow-custom', GEROW_THEME_CSS_DIR . 'gerow-custom.css', [] );
    if ( $color_code != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tg-primary-color: " . $color_code . "}";
        $custom_css .= "html:root { --unit-primary-color: " . $color_code . "}";
        wp_add_inline_style( 'gerow-custom', $custom_css );
    }

    // Secondary Color
    $color_code2 = get_theme_mod( 'gerow_color_option2', '#00194C' );
    wp_enqueue_style( 'gerow-custom', GEROW_THEME_CSS_DIR . 'gerow-custom.css', [] );
    if ( $color_code2 != '' ) {
        $custom_css = '';
        $custom_css .= "html:root { --tg-secondary-color: " . $color_code2 . "}";
        $custom_css .= "html:root { --unit-secondary-color: " . $color_code2 . "}";
        wp_add_inline_style( 'gerow-custom', $custom_css );
    }

}
add_action( 'wp_enqueue_scripts', 'gerow_custom_color' );



// gerow_kses_intermediate
function gerow_kses_intermediate( $string = '' ) {
    return wp_kses( $string, gerow_get_allowed_html_tags( 'intermediate' ) );
}

function gerow_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = [
        'b'      => [],
        'i'      => [],
        'u'      => [],
        'em'     => [],
        'br'     => [],
        'abbr'   => [
            'title' => [],
        ],
        'span'   => [
            'class' => [],
        ],
        'strong' => [],
        'a'      => [
            'href'  => [],
            'title' => [],
            'class' => [],
            'id'    => [],
        ],
    ];

    if ($level === 'intermediate') {
        $allowed_html['a'] = [
            'href' => [],
            'title' => [],
            'class' => [],
            'id' => [],
        ];
        $allowed_html['div'] = [
            'class' => [],
            'id' => [],
        ];
        $allowed_html['img'] = [
            'src' => [],
            'class' => [],
            'alt' => [],
        ];
        $allowed_html['del'] = [
            'class' => [],
        ];
        $allowed_html['ins'] = [
            'class' => [],
        ];
        $allowed_html['bdi'] = [
            'class' => [],
        ];
        $allowed_html['i'] = [
            'class' => [],
            'data-rating-value' => [],
        ];
    }

    return $allowed_html;
}



// WP kses allowed tags
// ----------------------------------------------------------------------------------------
function gerow_kses($raw){

   $allowed_tags = array(
      'a'      => array(
         'class'   => array(),
         'href'    => array(),
         'rel'  => array(),
         'title'   => array(),
         'target' => array(),
      ),
      'abbr'   => array(
         'title' => array(),
      ),
      'b'    => array(),
      'blockquote'   => array(
         'cite' => array(),
      ),
      'cite'   => array(
         'title' => array(),
      ),
      'code'  => array(),
      'del'   => array(
         'datetime'   => array(),
         'title'      => array(),
      ),
      'dd'     => array(),
      'div'    => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'dl'   => array(),
      'dt'   => array(),
      'em'   => array(),
      'h1'   => array(),
      'h2'   => array(),
      'h3'   => array(),
      'h4'   => array(),
      'h5'   => array(),
      'h6'   => array(),
      'i'    => array(
        'class' => array(),
      ),
      'img'   => array(
         'alt'  => array(),
         'class'   => array(),
         'height' => array(),
         'src'  => array(),
         'width'   => array(),
      ),
      'li'   => array(
         'class' => array(),
      ),
      'ol'   => array(
         'class' => array(),
      ),
      'p'    => array(
         'class' => array(),
      ),
      'q'    => array(
         'cite'    => array(),
         'title'   => array(),
      ),
      'span'  => array(
         'class'   => array(),
         'title'   => array(),
         'style'   => array(),
      ),
      'iframe'   => array(
         'width'        => array(),
         'height'       => array(),
         'scrolling'    => array(),
         'frameborder'  => array(),
         'allow'        => array(),
         'src'          => array(),
      ),
      'strike'  => array(),
      'br'      => array(),
      'strong'    => array(),
      'data-wow-duration'   => array(),
      'data-wow-delay'   => array(),
      'data-wallpaper-options'  => array(),
      'data-stellar-background-ratio'   => array(),
      'ul'   => array(
         'class' => array(),
      ),
      'svg' => array(
           'class' => true,
           'aria-hidden' => true,
           'aria-labelledby' => true,
           'role' => true,
           'xmlns' => true,
           'width' => true,
           'height' => true,
           'viewbox' => true, // <= Must be lower case!
       ),
       'g'     => array( 'fill' => true ),
       'title' => array( 'title' => true ),
       'path'  => array( 'd' => true, 'fill' => true,  ),
      );

   if (function_exists('wp_kses')) { // WP is here
      $allowed = wp_kses($raw, $allowed_tags);
   } else {
      $allowed = $raw;
   }

   return $allowed;
}