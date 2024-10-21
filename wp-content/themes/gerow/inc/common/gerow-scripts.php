<?php

/**
 * gerow_scripts description
 * @return [type] [description]
 */
function gerow_scripts() {


    /**
     * ALL CSS FILES
    */
    wp_enqueue_style( 'gerow-fonts', gerow_fonts_url(), array(), '1.0.0' );
    if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', GEROW_THEME_CSS_DIR.'bootstrap.rtl.min.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', GEROW_THEME_CSS_DIR.'bootstrap.min.css', array() );
    }
    wp_enqueue_style( 'gerow-animate', GEROW_THEME_CSS_DIR . 'animate.min.css', [] );
    wp_enqueue_style( 'magnific-popup', GEROW_THEME_CSS_DIR . 'magnific-popup.css', [] );
    wp_enqueue_style( 'font-awesome-free', GEROW_THEME_CSS_DIR . 'fontawesome-all.min.css', [] );
    wp_enqueue_style( 'flaticon', GEROW_THEME_CSS_DIR . 'flaticon.css', [] );
    wp_enqueue_style( 'odometer', GEROW_THEME_CSS_DIR . 'odometer.css', [] );
    wp_enqueue_style( 'jarallax', GEROW_THEME_CSS_DIR . 'jarallax.css', [] );
    wp_enqueue_style( 'swiper-bundle', GEROW_THEME_CSS_DIR . 'swiper-bundle.min.css', [] );
    wp_enqueue_style( 'slick', GEROW_THEME_CSS_DIR . 'slick.css', [] );
    wp_enqueue_style( 'aos', GEROW_THEME_CSS_DIR . 'aos.css', [] );
    wp_enqueue_style( 'gerow-default', GEROW_THEME_CSS_DIR . 'default.css', [] );
    wp_enqueue_style( 'gerow-core', GEROW_THEME_CSS_DIR . 'gerow-core.css', [] );
    wp_enqueue_style( 'gerow-unit', GEROW_THEME_CSS_DIR . 'gerow-unit.css', [] );
    wp_enqueue_style( 'gerow-style', get_stylesheet_uri() );
    wp_enqueue_style( 'gerow-responsive', GEROW_THEME_CSS_DIR . 'responsive.css', [] );


    // ALL JS FILES
    wp_enqueue_script( 'bootstrap-bundle', GEROW_THEME_JS_DIR . 'bootstrap.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'isotope', GEROW_THEME_JS_DIR . 'isotope.pkgd.min.js', ['imagesloaded'], '', true);
    wp_enqueue_script( 'magnific-popup', GEROW_THEME_JS_DIR . 'jquery.magnific-popup.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'odometer', GEROW_THEME_JS_DIR . 'jquery.odometer.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'appear', GEROW_THEME_JS_DIR . 'jquery.appear.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'gsap', GEROW_THEME_JS_DIR . 'gsap.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'scrollTrigger', GEROW_THEME_JS_DIR . 'scrollTrigger.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'splitText', GEROW_THEME_JS_DIR . 'splitText.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'gsap-animation', GEROW_THEME_JS_DIR . 'gsap-animation.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jarallax', GEROW_THEME_JS_DIR . 'jarallax.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'parallaxScroll', GEROW_THEME_JS_DIR . 'jquery.parallaxScroll.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'particles', GEROW_THEME_JS_DIR . 'particles.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'easypiechart', GEROW_THEME_JS_DIR . 'jquery.easypiechart.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'inview', GEROW_THEME_JS_DIR . 'jquery.inview.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'swiper', GEROW_THEME_JS_DIR . 'swiper-bundle.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'slick', GEROW_THEME_JS_DIR . 'slick.min.js', [ 'jquery' ], '', false );
    wp_enqueue_script( 'aos', GEROW_THEME_JS_DIR . 'aos.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'wow', GEROW_THEME_JS_DIR . 'wow.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'gerow-main', GEROW_THEME_JS_DIR . 'main.js', [ 'jquery' ], false, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'gerow_scripts' );

/*
Register Fonts
*/
function gerow_fonts_url() {
    $font_url = '';

    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
    */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'gerow' ) ) {
        $font_url = add_query_arg( 'family', 'Plus+Jakarta+Sans:ital,wght@0,200,300,400,500,600,1,200,1,300,1,400,1,500,1,600|Urbanist:ital,wght@0,300,400,500,600,700,800;1,300,1,400,1,500,1,600,1,700,1,800' , "//fonts.googleapis.com/css");
    }
    return $font_url;
}