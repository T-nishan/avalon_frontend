<?php

namespace GenixCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Control_Media;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Gerow Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TG_ServicesBox extends Widget_Base
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
        return 'tg-servicesBox';
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
        return __('Services Box', 'genixcore');
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
                    'layout-5' => esc_html__('Layout 5', 'genixcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Style_group
        $this->start_controls_section(
            'tg_servicesBox_group',
            [
                'label' => esc_html__('Services Group', 'genixcore'),
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
                'options' => $this->get_all_services(),
            ]
        );

        if (genix_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tg_icon',
                [
                    'label' => esc_html__('Upload Icon', 'genixcore'),
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                ]
            );
        } else {
            $repeater->add_control(
                'tg_selected_icon',
                [
                    'label' => esc_html__('Upload Icon', 'genixcore'),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                ]
            );
        }

        $repeater->add_control(
            'tg_image',
            [
                'label' => esc_html__('Upload Shape', 'genixcore'),
                'description' => esc_html__('This shape only for Style 1', 'genixcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Short Description', 'genixcore'),
                'description' => esc_html__('This Field for short Description', 'genixcore'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'genixcore'),
                'description' => esc_html__('This Button only for Style 2, 3 & 4', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('See Details', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_post_list',
            [
                'label' => esc_html__('All Post List', 'genixcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();

        // Style TAB
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


    // Get All Services
    public function get_all_services()
    {

        $wp_query = get_posts([
            'post_type' => 'services',
            'orderby' => 'date',
            'posts_per_page' => -1,
        ]);

        $options = ['none' => 'None'];
        foreach ($wp_query as $services) {
            $options[$services->ID] = $services->post_name;
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

        <?php if ($settings['tg_design_style']  == 'layout-2') : ?>

            <div class="features-item-wrap-two">
                <div class="row justify-content-center">
                    <?php foreach ($settings['tg_post_list'] as $items) : ?>

                        <?php
                        $args = new \WP_Query(array(
                            'post_type' => 'services',
                            'post_status' => 'publish',
                            'post__in' => [
                                $items['select_post']
                            ]
                        ));

                        /* Start the Loop */
                        while ($args->have_posts()) : $args->the_post();
                        ?>
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="features-item-three">

                                    <?php if (!empty($items['tg_icon']) || !empty($items['tg_selected_icon']['value'])) : ?>
                                        <div class="features-icon-three">
                                            <?php genix_render_icon($items, 'tg_icon', 'tg_selected_icon'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="features-content-three">
                                        <h2 class="title"><?php the_title(); ?></h2>
                                        <?php if (!empty($items['description'])) : ?>
                                            <p><?php echo genix_kses($items['description']); ?></p>
                                        <?php endif; ?>
                                        <?php if (!empty($items['button_text'])) : ?>
                                            <a href="<?php the_permalink(); ?>" class="link-btn">
                                                <?php echo esc_html($items['button_text']) ?>
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/right-arrow.svg" alt="<?php echo esc_attr__('Icon', 'genixcore') ?>">
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>

                    <?php endforeach; ?>
                </div>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-3') : ?>

            <div class="row justify-content-center">
                <?php foreach ($settings['tg_post_list'] as $items) : ?>

                    <?php
                    $args = new \WP_Query(array(
                        'post_type' => 'services',
                        'post_status' => 'publish',
                        'post__in' => [
                            $items['select_post']
                        ]
                    ));

                    /* Start the Loop */
                    while ($args->have_posts()) : $args->the_post();
                    ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-10">
                            <div class="services-item-three">
                                <div class="services-thumb-three">
                                    <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), ''); ?>" alt="<?php echo esc_attr__('Image', 'genixcore') ?>"></a>
                                </div>
                                <div class="services-content-three">

                                    <?php if (!empty($items['tg_icon']) || !empty($items['tg_selected_icon']['value'])) : ?>
                                        <div class="services-icon">
                                            <?php genix_render_icon($items, 'tg_icon', 'tg_selected_icon'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

                                    <?php if (!empty($items['description'])) : ?>
                                        <p><?php echo genix_kses($items['description']); ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty($items['tg_icon']) || !empty($items['tg_selected_icon']['value'])) : ?>
                                        <div class="overlay-icon">
                                            <?php genix_render_icon($items, 'tg_icon', 'tg_selected_icon'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>

                <?php endforeach; ?>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-4') : ?>

            <div class="row justify-content-center">
                <?php foreach ($settings['tg_post_list'] as $items) : ?>

                    <?php
                    $args = new \WP_Query(array(
                        'post_type' => 'services',
                        'post_status' => 'publish',
                        'post__in' => [
                            $items['select_post']
                        ]
                    ));

                    /* Start the Loop */
                    while ($args->have_posts()) : $args->the_post();
                    ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="services-item-four">
                                <?php if (!empty($items['tg_icon']) || !empty($items['tg_selected_icon']['value'])) : ?>
                                    <div class="services-icon-four">
                                        <?php genix_render_icon($items, 'tg_icon', 'tg_selected_icon'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="services-content-four">
                                    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                                    <?php if (!empty($items['description'])) : ?>
                                        <p><?php echo genix_kses($items['description']); ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty($items['button_text'])) : ?>
                                        <a href="<?php the_permalink(); ?>" class="btn transparent-btn-two"><?php echo esc_html($items['button_text']) ?></a>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>

                <?php endforeach; ?>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-5') : ?>

            <script>
                jQuery(document).ready(function($) {

                    /*=============================================
                        =    		services Active		      =
                    =============================================*/
                    $('.services-active').slick({
                        dots: true,
                        infinite: true,
                        speed: 1000,
                        autoplay: true,
                        arrows: false,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 3,
                                    slidesToScroll: 1,
                                    infinite: true,
                                }
                            },
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 767,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    arrows: false,
                                }
                            },
                            {
                                breakpoint: 575,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    arrows: false,
                                }
                            },
                        ]
                    });

                });
            </script>

            <div class="row services-active">
                <?php foreach ($settings['tg_post_list'] as $items) : ?>

                    <?php
                    $args = new \WP_Query(array(
                        'post_type' => 'services',
                        'post_status' => 'publish',
                        'post__in' => [
                            $items['select_post']
                        ]
                    ));

                    /* Start the Loop */
                    while ($args->have_posts()) : $args->the_post();
                    ?>
                        <div class="col-lg-4">
                            <div class="services-item">
                                <div class="services-content">
                                    <div class="content-top">
                                        <?php if (!empty($items['tg_icon']) || !empty($items['tg_selected_icon']['value'])) : ?>
                                            <div class="icon">
                                                <?php genix_render_icon($items, 'tg_icon', 'tg_selected_icon'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <h2 class="title"><?php the_title(); ?></h2>
                                    </div>
                                    <div class="services-thumb">
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), ''); ?>" alt="<?php echo esc_attr__('Image', 'genixcore') ?>">
                                        <?php if (!empty($items['button_text'])) : ?>
                                            <a href="<?php the_permalink(); ?>" class="btn transparent-btn"><?php echo esc_html($items['button_text']) ?></a>
                                        <?php endif; ?>
                                    </div>
                                    <ul class="list-wrap">
                                        <?php echo wp_kses_post($items['description']); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>

                <?php endforeach; ?>
            </div>

        <?php else : ?>

            <div class="row justify-content-center">
                <?php foreach ($settings['tg_post_list'] as $items) : ?>

                    <?php
                    $args = new \WP_Query(array(
                        'post_type' => 'services',
                        'post_status' => 'publish',
                        'post__in' => [
                            $items['select_post']
                        ]
                    ));

                    /* Start the Loop */
                    while ($args->have_posts()) : $args->the_post();
                    ?>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-8">
                            <div class="services-item-two">
                                <div class="services-thumb-two">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), ''); ?>" alt="<?php echo esc_attr__('Image', 'genixcore') ?>">

                                    <?php if (!empty($items['tg_image']['url'])) : ?>
                                        <div class="item-shape">
                                            <img src="<?php echo esc_url($items['tg_image']['url']) ?>" alt="<?php echo esc_attr__('Shape', 'genixcore') ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="services-content-two">
                                    <?php if (!empty($items['tg_icon']) || !empty($items['tg_selected_icon']['value'])) : ?>
                                        <div class="icon">
                                            <?php genix_render_icon($items, 'tg_icon', 'tg_selected_icon'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <?php if (!empty($items['description'])) : ?>
                                        <p><?php echo genix_kses($items['description']); ?></p>
                                    <?php endif; ?>
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

$widgets_manager->register(new TG_ServicesBox());
