<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package gerow
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <?php wp_body_open(); ?>


    <?php
        $gerow_preloader = get_theme_mod('gerow_preloader', false);
        $gerow_backtotop = get_theme_mod('gerow_backtotop', false);
    ?>


    <?php if (!empty($gerow_preloader)) : ?>
        <!-- preloader -->
        <div id="preloader">
            <div id="loading-center">
                <div class="loader">
                    <div class="loader-outter"></div>
                    <div class="loader-inner"></div>
                </div>
            </div>
        </div>
        <!-- preloader-end -->
    <?php endif; ?>


    <?php if (!empty($gerow_backtotop)) : ?>
        <!-- Scroll-top -->
        <button class="scroll-top scroll-to-target" data-target="html">
            <i class="fas fa-angle-up"></i>
        </button>
        <!-- Scroll-top-end-->
    <?php endif; ?>


    <?php do_action('gerow_header_style'); ?>

    <!-- main-area -->
    <main class="main-area fix">

        <?php do_action('gerow_before_main_content'); ?>