<?php

/**
 * GenixCore Sidebar Posts Image
 *
 *
 * @author 		ThemeGenix
 * @category 	Widgets
 * @package 	GenixCore/Widgets
 * @version 	1.0.0
 * @extends 	WP_Widget
 */

class Genix_Post_Sidebar_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct('genix-latest-posts', 'Gerow Sidebar Posts', array(
            'description'    => 'Latest Blog Post Widget by ThemeGenix'
        ));
    }


    public function widget($args, $instance)
    {
        extract($args);
        extract($instance);

        echo $before_widget;
        if ($instance['title']) :
            echo $before_title; ?>
            <?php echo apply_filters('widget_title', $instance['title']); ?>
            <?php echo $after_title; ?>
        <?php endif; ?>

        <div class="rc-post-wrap">
            <?php
            $q = new WP_Query(array(
                'post_type'     => 'post',
                'posts_per_page' => ($instance['count']) ? $instance['count'] : '3',
                'order'            => ($instance['posts_order']) ? $instance['posts_order'] : 'DESC',
                'orderby' => 'date'
            ));

            if ($q->have_posts()) :
                while ($q->have_posts()) : $q->the_post();
            ?>

                    <div class="rc-post-item">

                        <?php if (has_post_thumbnail()) : ?>
                            <div class="thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php print esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="img">
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="content">
                            <span class="date">
                                <i class="far fa-calendar"></i><?php the_time(get_option('date_format')); ?>
                            </span>
                            <h5 class="title"><a href="<?php the_permalink(); ?>"><?php print wp_trim_words(get_the_title(), 6, ''); ?></a></h5>
                        </div>
                    </div>

            <?php endwhile;
            endif;
            wp_reset_query(); ?>
        </div>

        <?php echo $after_widget; ?>

    <?php
    }



    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $count = !empty($instance['count']) ? $instance['count'] : esc_html__('3', 'genixcore');
        $posts_order = !empty($instance['posts_order']) ? $instance['posts_order'] : esc_html__('DESC', 'genixcore');
        $choose_style = !empty($instance['choose_style']) ? $instance['choose_style'] : esc_html__('style_1', 'genixcore');
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
            <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('count'); ?>">How many posts you want to show ?</label>
            <input type="number" name="<?php echo $this->get_field_name('count'); ?>" id="<?php echo $this->get_field_id('count'); ?>" value="<?php echo esc_attr($count); ?>" class="widefat">
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('posts_order'); ?>">Posts Order</label>
            <select name="<?php echo $this->get_field_name('posts_order'); ?>" id="<?php echo $this->get_field_id('posts_order'); ?>" class="widefat">
                <option value="" disabled="disabled">Select Post Order</option>
                <option value="ASC" <?php if ($posts_order === 'ASC') {
                                        echo 'selected="selected"';
                                    } ?>>ASC</option>
                <option value="DESC" <?php if ($posts_order === 'DESC') {
                                            echo 'selected="selected"';
                                        } ?>>DESC</option>
            </select>
        </p>

<?php }
}

add_action('widgets_init', function () {
    register_widget('Genix_Post_Sidebar_Widget');
});
