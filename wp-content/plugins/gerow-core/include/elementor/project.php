<?php

namespace GenixCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Gerow Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TG_Project extends Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'project-list';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('Project', 'genixcore');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'genix-icon';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['genixcore'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['genixcore'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {

        // layout Panel
        $this->start_controls_section(
            'tg_layout',
            [
                'label' => esc_html__('Design Layout', 'genixcore'),
            ]
        );
        $this->add_control(
            'tg_design_style',
            [
                'label' => esc_html__('Select Layout', 'genixcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'genixcore'),
                    'layout-2' => esc_html__('Layout 2', 'genixcore'),
                    'layout-3' => esc_html__('Layout 3', 'genixcore'),
                    'layout-4' => esc_html__('Layout 4', 'genixcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Service group
        $this->start_controls_section(
            'tg_project',
            [
                'label' => esc_html__('Project List', 'genixcore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'genixcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'select_post',
            [
                'label' => __('Select a Post', 'genixcore'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'default' => 'none',
                'options' => $this->get_all_projects(),
            ]
        );

        $repeater->add_control(
            'tg_project_col',
            [
                'label' => esc_html__('Select Post Columns', 'tpcore'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    '4' => '3 Columns',
                    '3' => '4 Columns',
                    '6' => '2 columns',
                ],
                'default' => '4',
            ]
        );

        $this->add_control(
            'tg_project_list',
            [
                'label' => esc_html__('Project List', 'genixcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        // TAB_STYLE
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'genixcore'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_transform',
            [
                'label' => esc_html__('Text Transform', 'genixcore'),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('None', 'genixcore'),
                    'uppercase' => esc_html__('UPPERCASE', 'genixcore'),
                    'lowercase' => esc_html__('lowercase', 'genixcore'),
                    'capitalize' => esc_html__('Capitalize', 'genixcore'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'text-transform: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    // Get All Projects
    public function get_all_projects()
    {

        $wp_query = get_posts([
            'post_type' => 'project',
            'orderby' => 'date',
            'posts_per_page' => -1,
        ]);

        $options = ['none' => 'None'];
        foreach ($wp_query as $projects) {
            $options[$projects->ID] = $projects->post_name;
        }

        return $options;
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

?>

        <?php if ($settings['tg_design_style'] == 'layout-2') : ?>

            <div class="row">
                <?php foreach ($settings['tg_project_list'] as $items) :

                    $md_class =  ($items['tg_project_col'] == 3) ? '3' : (($items['tg_project_col'] == 6) ? '6' : '4');

                ?>

                    <?php
                    $args = new \WP_Query(array(
                        'post_type' => 'project',
                        'post_status' => 'publish',
                        'post__in' => [
                            $items['select_post']
                        ]
                    ));

                    /* Start the Loop */
                    while ($args->have_posts()) : $args->the_post(); ?>
                        <div class="col-lg-<?php echo esc_attr($md_class) ?> col-sm-6">
                            <div class="project-item-three">
                                <div class="project-thumb-three">
                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), ''); ?>" alt="<?php echo esc_attr__('Image', 'genixcore') ?>"></a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>

                <?php endforeach; ?>
            </div>


        <?php elseif ($settings['tg_design_style'] == 'layout-3') : ?>

            <div class="row justify-content-center">
                <?php foreach ($settings['tg_project_list'] as $items) :

                    $md_class =  ($items['tg_project_col'] == 3) ? '3' : (($items['tg_project_col'] == 6) ? '6' : '4');

                ?>

                    <?php
                    $args = new \WP_Query(array(
                        'post_type' => 'project',
                        'post_status' => 'publish',
                        'post__in' => [
                            $items['select_post']
                        ]
                    ));

                    /* Start the Loop */
                    while ($args->have_posts()) : $args->the_post();
                        global $post;
                        $categories = get_the_terms($post->ID, 'project-cat');
                    ?>
                        <div class="col-lg-<?php echo esc_attr($md_class) ?> col-md-6">
                            <div class="project-item-four">
                                <div class="project-thumb-four">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), ''); ?>" alt="<?php echo esc_attr__('Image', 'genixcore') ?>">
                                    <div class="project-link"><a href="<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/plus_icon.svg" alt="<?php echo esc_attr__('Icon', 'genixcore') ?>"></a></div>
                                </div>
                                <div class="project-content-four">
                                    <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <span><?php echo esc_html($categories[0]->name); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>

                <?php endforeach; ?>
            </div>

        <?php elseif ($settings['tg_design_style'] == 'layout-4') : ?>

            <script>
                jQuery(document).ready(function($) {

                    /*===========================================
                        =         Project Active           =
                    =============================================*/
                    if (jQuery(".project-active").length > 0) {
                        let courses = new Swiper(".project-active", {
                            slidesPerView: 1,
                            spaceBetween: 30,
                            loop: true,
                            autoplay: false,
                            breakpoints: {
                                500: {
                                    slidesPerView: 2,
                                    spaceBetween: 20,
                                },
                                768: {
                                    slidesPerView: 2.5,
                                    spaceBetween: 20,
                                },
                                992: {
                                    slidesPerView: 3.5,
                                    spaceBetween: 20,
                                },
                                1200: {
                                    slidesPerView: 3.5,
                                    spaceBetween: 20,
                                },
                                1500: {
                                    slidesPerView: 4,
                                    spaceBetween: 24,
                                },
                            },
                            // If we need pagination
                            pagination: {
                                el: ".project-swiper-pagination",
                                clickable: true,
                            },

                            // Navigation arrows
                            navigation: {
                                nextEl: ".swiper-button-next",
                                prevEl: ".swiper-button-prev",
                            },

                            // And if we need scrollbar
                            scrollbar: {
                                el: ".swiper-scrollbar",
                            },
                        });
                    }

                });
            </script>

            <div class="project-item-wrap">
                <div class="row">
                    <div class="col-12">
                        <div class="swiper-container project-active">
                            <div class="swiper-wrapper">
                                <?php foreach ($settings['tg_project_list'] as $items) : ?>

                                    <?php
                                    $args = new \WP_Query(array(
                                        'post_type' => 'project',
                                        'post_status' => 'publish',
                                        'post__in' => [
                                            $items['select_post']
                                        ]
                                    ));

                                    /* Start the Loop */
                                    while ($args->have_posts()) : $args->the_post();
                                        global $post;
                                        $categories = get_the_terms($post->ID, 'project-cat');
                                    ?>
                                        <div class="swiper-slide">
                                            <div class="project-item">
                                                <div class="project-thumb">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), ''); ?>" alt="<?php echo esc_attr__('Image', 'genixcore') ?>">
                                                    </a>
                                                </div>
                                                <div class="project-content">
                                                    <a href="<?php print esc_url(get_category_link($categories[0]->term_id)); ?>" class="tag"><?php echo esc_html($categories[0]->name); ?></a>
                                                    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                                    <a href="<?php the_permalink(); ?>" class="link-arrow"><i class="flaticon-right-arrow"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile;
                                    wp_reset_postdata(); ?>

                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else : ?>

            <div class="row justify-content-center">
                <?php foreach ($settings['tg_project_list'] as $items) :

                    $md_class =  ($items['tg_project_col'] == 3) ? '3' : (($items['tg_project_col'] == 6) ? '6' : '4');

                ?>

                    <?php
                    $args = new \WP_Query(array(
                        'post_type' => 'project',
                        'post_status' => 'publish',
                        'post__in' => [
                            $items['select_post']
                        ]
                    ));

                    /* Start the Loop */
                    while ($args->have_posts()) : $args->the_post();
                        global $post;
                        $categories = get_the_terms($post->ID, 'project-cat');
                    ?>
                        <div class="col-lg-<?php echo esc_attr($md_class) ?> col-md-6">
                            <div class="project-item-two">
                                <div class="project-thumb-two">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), ''); ?>" alt="<?php echo esc_attr__('Image', 'genixcore') ?>">
                                </div>
                                <div class="project-content-two">
                                    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <span><?php echo esc_html($categories[0]->name); ?></span>
                                    <a href="<?php the_permalink(); ?>" class="link-btn"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>

                <?php endforeach; ?>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TG_Project());
