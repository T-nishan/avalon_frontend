<?php

/**
 * Template part for displaying post btn
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package gerow
 */

$gerow_blog_btn = get_theme_mod('gerow_blog_btn', __('Read More', 'gerow'));
$gerow_blog_btn_switch = get_theme_mod('gerow_blog_btn_switch', true);

?>

<?php if (!empty($gerow_blog_btn_switch)) : ?>
    <div class="tg-blog-post-bottom">
        <a href="<?php the_permalink(); ?>" class="link-btn"><?php print esc_html($gerow_blog_btn); ?><i class="fas fa-arrow-right"></i></a>
    </div>
<?php endif; ?>