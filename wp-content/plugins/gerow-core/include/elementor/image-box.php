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
class TG_ImageBox extends Widget_Base
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
        return 'genix-image';
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
        return __('Image Box', 'genixcore');
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
            'genix_layout',
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
                    'layout-6' => esc_html__('Layout 6', 'genixcore'),
                    'layout-7' => esc_html__('Layout 7', 'genixcore'),
                    'layout-8' => esc_html__('Layout 8', 'genixcore'),
                    'layout-9' => esc_html__('Layout 9', 'genixcore'),
                    'layout-10' => esc_html__('Layout 10', 'genixcore'),
                    'layout-11' => esc_html__('Layout 11', 'genixcore'),
                    'layout-12' => esc_html__('Layout 12', 'genixcore'),
                    'layout-13' => esc_html__('Layout 13', 'genixcore'),
                    'layout-14' => esc_html__('Layout 14', 'genixcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // _tg_image
        $this->start_controls_section(
            '_tg_image_section',
            [
                'label' => esc_html__('Image', 'genixcore'),
            ]
        );

        if (genix_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'tg_info_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                    'condition' => [
                        'tg_design_style' => ['layout-2', 'layout-4']
                    ]
                ]
            );
        } else {
            $this->add_control(
                'tg_info_selected_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition' => [
                        'tg_design_style' => ['layout-2', 'layout-4']
                    ]
                ]
            );
        }

        $this->add_control(
            'tg_image',
            [
                'label' => esc_html__('Choose Image', 'genixcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_image2',
            [
                'label' => esc_html__('Choose Image 02', 'genixcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tg_design_style!' => 'layout-14'
                ]
            ]
        );

        $this->add_control(
            'tg_image3',
            [
                'label' => esc_html__('Choose Image 03', 'genixcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tg_design_style' => ['layout-2', 'layout-3', 'layout-7', 'layout-9', 'layout-11']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tg_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();


        // _tg_video
        $this->start_controls_section(
            '_tg_video_section',
            [
                'label' => esc_html__('Video URL', 'genixcore'),
                'condition' => [
                    'tg_design_style' => 'layout-12'
                ]
            ]
        );

        $this->add_control(
            'image_video_url',
            [
                'label' => esc_html__('Video URL', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=6mkoGSqTqFI', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();


        // _tg_review
        $this->start_controls_section(
            '_tg_review_section',
            [
                'label' => esc_html__('Review', 'genixcore'),
                'condition' => [
                    'tg_design_style' => 'layout-14'
                ]
            ]
        );

        $this->add_control(
            'tg_star_img',
            [
                'label' => esc_html__('Choose Image', 'genixcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_total_rating',
            [
                'label' => esc_html__('Total Rating', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('15k', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_rating_text',
            [
                'label' => esc_html__('Rating Text', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => wp_kses_post('Positive <br> Review', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // _tg_shapes
        $this->start_controls_section(
            '_tg_images_shapes',
            [
                'label' => esc_html__('Shapes', 'genixcore'),
                'condition' => [
                    'tg_design_style' => ['layout-4', 'layout-5', 'layout-8', 'layout-10']
                ]
            ]
        );

        $this->add_control(
            'tg_shapes',
            [
                'label' => esc_html__('Choose Shapes', 'genixcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_shapes02',
            [
                'label' => esc_html__('Choose Shapes 02', 'genixcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'tg_shapes03',
            [
                'label' => esc_html__('Choose Shapes 03', 'genixcore'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'tg_design_style!' => ['layout-5', 'layout-8', 'layout-10']
                ]
            ]
        );

        $this->end_controls_section();

        // _tg_experience
        $this->start_controls_section(
            '_tg_experience',
            [
                'label' => esc_html__('Experience', 'genixcore'),
                'condition' => [
                    'tg_design_style' => ['layout-1', 'layout-6']
                ]
            ]
        );

        $this->add_control(
            'experience_year',
            [
                'label' => esc_html__('Experience Year', 'genixcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => wp_kses_post('25 <span>Years</span>', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'experience_text',
            [
                'label' => esc_html__('Experience Text', 'genixcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => wp_kses_post('Of Experience in This Finance Advisory Company.', 'genixcore'),
                'label_block' => true,
                'condition' => [
                    'tg_design_style!' => 'layout-6',
                ]
            ]
        );

        $this->end_controls_section();


        // Style
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

        if (!empty($settings['tg_image']['url'])) {
            $tg_image_url = !empty($settings['tg_image']['id']) ? wp_get_attachment_image_url($settings['tg_image']['id'], $settings['tg_image_size_size']) : $settings['tg_image']['url'];
            $tg_image_alt = get_post_meta($settings["tg_image"]["id"], "_wp_attachment_image_alt", true);
        }

        if (!empty($settings['tg_image2']['url'])) {
            $tg_image_url2 = !empty($settings['tg_image2']['id']) ? wp_get_attachment_image_url($settings['tg_image2']['id'], $settings['tg_image_size_size']) : $settings['tg_image2']['url'];
            $tg_image_alt2 = get_post_meta($settings["tg_image2"]["id"], "_wp_attachment_image_alt", true);
        }

        if (!empty($settings['tg_image3']['url'])) {
            $tg_image_url3 = !empty($settings['tg_image3']['id']) ? wp_get_attachment_image_url($settings['tg_image3']['id'], $settings['tg_image_size_size']) : $settings['tg_image3']['url'];
            $tg_image_alt3 = get_post_meta($settings["tg_image3"]["id"], "_wp_attachment_image_alt", true);
        }

?>

        <?php if ($settings['tg_design_style']  == 'layout-2') : ?>

            <div class="overview-img-wrap">
                <?php if (!empty($tg_image_url)) : ?>
                    <img src="<?php echo esc_url($tg_image_url); ?>" alt="<?php echo esc_attr($tg_image_alt); ?>">
                <?php endif; ?>

                <?php if (!empty($tg_image_url2)) : ?>
                    <img src="<?php echo esc_url($tg_image_url2); ?>" alt="<?php echo esc_attr($tg_image_alt2); ?>" data-parallax='{"x" : 50 }'>
                <?php endif; ?>

                <?php if (!empty($tg_image_url3)) : ?>
                    <img src="<?php echo esc_url($tg_image_url3); ?>" alt="<?php echo esc_attr($tg_image_alt3); ?>">
                <?php endif; ?>

                <?php if (!empty($settings['tg_info_icon']) || !empty($settings['tg_info_selected_icon']['value'])) : ?>
                    <div class="icon">
                        <?php genix_render_icon($settings, 'tg_info_icon', 'tg_info_selected_icon'); ?>
                    </div>
                <?php endif; ?>

            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-3') : ?>

            <div class="banner-img-three" data-aos="fade-left" data-aos-delay="300">
                <?php if (!empty($tg_image_url)) : ?>
                    <img src="<?php echo esc_url($tg_image_url); ?>" alt="<?php echo esc_attr($tg_image_alt); ?>" class="main-img">
                <?php endif; ?>

                <?php if (!empty($tg_image_url2)) : ?>
                    <img src="<?php echo esc_url($tg_image_url2); ?>" alt="<?php echo esc_attr($tg_image_alt2); ?>" class="img-two" data-parallax='{"y" : 100 }'>
                <?php endif; ?>

                <?php if (!empty($tg_image_url3)) : ?>
                    <img src="<?php echo esc_url($tg_image_url3); ?>" alt="<?php echo esc_attr($tg_image_alt3); ?>" class="img-three" data-parallax='{"x" : -100 }'>
                <?php endif; ?>

            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-4') : ?>

            <div class="about-img-wrap-four">
                <?php if (!empty($tg_image_url)) : ?>
                    <div class="mask-img-wrap">
                        <img src="<?php echo esc_url($tg_image_url); ?>" alt="<?php echo esc_attr($tg_image_alt); ?>">
                    </div>
                <?php endif; ?>

                <?php if (!empty($settings['tg_info_icon']) || !empty($settings['tg_info_selected_icon']['value'])) : ?>
                    <div class="icon">
                        <?php genix_render_icon($settings, 'tg_info_icon', 'tg_info_selected_icon'); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($tg_image_url2)) : ?>
                    <img src="<?php echo esc_url($tg_image_url2); ?>" alt="<?php echo esc_attr($tg_image_alt2); ?>" class="img-two">
                <?php endif; ?>

                <div class="about-shape-wrap-three">
                    <?php if (!empty($settings['tg_shapes']['url'])) : ?>
                        <img src="<?php echo esc_url($settings['tg_shapes']['url']); ?>" alt="<?php echo esc_attr__('Shape', 'genixcore') ?>">
                    <?php endif; ?>

                    <?php if (!empty($settings['tg_shapes02']['url'])) : ?>
                        <img src="<?php echo esc_url($settings['tg_shapes02']['url']); ?>" alt="<?php echo esc_attr__('Shape', 'genixcore') ?>">
                    <?php endif; ?>

                    <?php if (!empty($settings['tg_shapes03']['url'])) : ?>
                        <img src="<?php echo esc_url($settings['tg_shapes03']['url']); ?>" alt="<?php echo esc_attr__('Shape', 'genixcore') ?>">
                    <?php endif; ?>
                </div>

            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-5') : ?>

            <div class="overview-img-two">

                <?php if (!empty($tg_image_url)) : ?>
                    <div class="mask-img-two">
                        <img src="<?php echo esc_url($tg_image_url); ?>" alt="<?php echo esc_attr($tg_image_alt); ?>">
                    </div>
                <?php endif; ?>

                <?php if (!empty($tg_image_url2)) : ?>
                    <img src="<?php echo esc_url($tg_image_url2); ?>" alt="<?php echo esc_attr($tg_image_alt2); ?>" class="img-two" data-parallax='{"y" : 100 }'>
                <?php endif; ?>

                <div class="overview-shape-wrap">
                    <?php if (!empty($settings['tg_shapes']['url'])) : ?>
                        <img src="<?php echo esc_url($settings['tg_shapes']['url']); ?>" alt="<?php echo esc_attr__('Shape', 'genixcore') ?>">
                    <?php endif; ?>

                    <?php if (!empty($settings['tg_shapes02']['url'])) : ?>
                        <img src="<?php echo esc_url($settings['tg_shapes02']['url']); ?>" alt="<?php echo esc_attr__('Shape', 'genixcore') ?>">
                    <?php endif; ?>
                </div>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-6') : ?>

            <div class="about-img-wrap-five">
                <?php if (!empty($tg_image_url)) : ?>
                    <img src="<?php echo esc_url($tg_image_url); ?>" alt="<?php echo esc_attr($tg_image_alt); ?>">
                <?php endif; ?>

                <?php if (!empty($tg_image_url2)) : ?>
                    <img src="<?php echo esc_url($tg_image_url2); ?>" alt="<?php echo esc_attr($tg_image_alt2); ?>" data-parallax='{"y" : 100 }'>
                <?php endif; ?>

                <?php if (!empty($settings['experience_year'])) : ?>
                    <div class="experience-wrap">
                        <h2 class="title"><?php echo wp_kses_post($settings['experience_year']) ?></h2>
                    </div>
                <?php endif; ?>

            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-7') : ?>

            <div class="choose-img-two">
                <?php if (!empty($tg_image_url)) : ?>
                    <img src="<?php echo esc_url($tg_image_url); ?>" alt="<?php echo esc_attr($tg_image_alt); ?>">
                <?php endif; ?>

                <?php if (!empty($tg_image_url2)) : ?>
                    <img src="<?php echo esc_url($tg_image_url2); ?>" alt="<?php echo esc_attr($tg_image_alt2); ?>">
                <?php endif; ?>

                <?php if (!empty($tg_image_url3)) : ?>
                    <img src="<?php echo esc_url($tg_image_url3); ?>" alt="<?php echo esc_attr($tg_image_alt3); ?>">
                <?php endif; ?>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-8') : ?>

            <div class="banner-img-five">

                <?php if (!empty($tg_image_url)) : ?>
                    <img src="<?php echo esc_url($tg_image_url); ?>" alt="<?php echo esc_attr($tg_image_alt); ?>" class="main-img">
                <?php endif; ?>

                <?php if (!empty($tg_image_url2)) : ?>
                    <img src="<?php echo esc_url($tg_image_url2); ?>" alt="<?php echo esc_attr($tg_image_alt2); ?>" class="shape-one" data-aos="fade-up-left" data-aos-delay="600">
                <?php endif; ?>

                <?php if (!empty($settings['tg_shapes']['url'])) : ?>
                    <img src="<?php echo esc_url($settings['tg_shapes']['url']); ?>" alt="<?php echo esc_attr__('Shape', 'genixcore') ?>" class="shape-two">
                <?php endif; ?>

                <?php if (!empty($settings['tg_shapes02']['url'])) : ?>
                    <img src="<?php echo esc_url($settings['tg_shapes02']['url']); ?>" alt="<?php echo esc_attr__('Shape', 'genixcore') ?>" class="shape-three">
                <?php endif; ?>

            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-9') : ?>

            <div class="about-img-six">
                <?php if (!empty($tg_image_url)) : ?>
                    <img src="<?php echo esc_url($tg_image_url); ?>" alt="<?php echo esc_attr($tg_image_alt); ?>">
                <?php endif; ?>

                <?php if (!empty($tg_image_url2)) : ?>
                    <img src="<?php echo esc_url($tg_image_url2); ?>" alt="<?php echo esc_attr($tg_image_alt2); ?>">
                <?php endif; ?>

                <?php if (!empty($tg_image_url3)) : ?>
                    <img src="<?php echo esc_url($tg_image_url3); ?>" alt="<?php echo esc_attr($tg_image_alt3); ?>">
                <?php endif; ?>

            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-10') : ?>

            <div class="testimonial-img-five">

                <?php if (!empty($tg_image_url)) : ?>
                    <img src="<?php echo esc_url($tg_image_url); ?>" alt="<?php echo esc_attr($tg_image_alt); ?>">
                <?php endif; ?>

                <?php if (!empty($tg_image_url2)) : ?>
                    <img src="<?php echo esc_url($tg_image_url2); ?>" alt="<?php echo esc_attr($tg_image_alt2); ?>" class="shape-one">
                <?php endif; ?>

                <?php if (!empty($settings['tg_shapes']['url'])) : ?>
                    <img src="<?php echo esc_url($settings['tg_shapes']['url']); ?>" alt="<?php echo esc_attr__('Shape', 'genixcore') ?>" class="shape-two">
                <?php endif; ?>

                <?php if (!empty($settings['tg_shapes02']['url'])) : ?>
                    <img src="<?php echo esc_url($settings['tg_shapes02']['url']); ?>" alt="<?php echo esc_attr__('Shape', 'genixcore') ?>" class="shape-three">
                <?php endif; ?>

            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-11') : ?>

            <div class="about-img-wrap">
                <?php if (!empty($tg_image_url)) : ?>
                    <img src="<?php echo esc_url($tg_image_url); ?>" alt="<?php echo esc_attr($tg_image_alt); ?>" class="main-img">
                <?php endif; ?>

                <?php if (!empty($tg_image_url2)) : ?>
                    <img src="<?php echo esc_url($tg_image_url2); ?>" alt="<?php echo esc_attr($tg_image_alt2); ?>">
                <?php endif; ?>

                <?php if (!empty($tg_image_url3)) : ?>
                    <img src="<?php echo esc_url($tg_image_url3); ?>" alt="<?php echo esc_attr($tg_image_alt3); ?>">
                <?php endif; ?>

            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-12') : ?>

            <div class="about-img-two">
                <?php if (!empty($tg_image_url)) : ?>
                    <div class="main-img">
                        <img src="<?php echo esc_url($tg_image_url); ?>" alt="<?php echo esc_attr($tg_image_alt); ?>">

                        <?php if (!empty($settings['image_video_url'])) : ?>
                            <a href="<?php echo esc_url($settings['image_video_url']) ?>" class="play-btn popup-video"><i class="fas fa-play"></i></a>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

                <?php if (!empty($tg_image_url2)) : ?>
                    <img src="<?php echo esc_url($tg_image_url2); ?>" alt="<?php echo esc_attr($tg_image_alt2); ?>">
                <?php endif; ?>

            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-13') : ?>

            <div class="faq-img-wrap">
                <?php if (!empty($tg_image_url)) : ?>
                    <img src="<?php echo esc_url($tg_image_url); ?>" alt="<?php echo esc_attr($tg_image_alt); ?>">
                <?php endif; ?>

                <?php if (!empty($tg_image_url2)) : ?>
                    <img src="<?php echo esc_url($tg_image_url2); ?>" alt="<?php echo esc_attr($tg_image_alt2); ?>" data-parallax='{"y" : 100 }'>
                <?php endif; ?>

            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-14') : ?>

            <div class="testimonial-img">
                <?php if (!empty($tg_image_url)) : ?>
                    <img src="<?php echo esc_url($tg_image_url); ?>" alt="<?php echo esc_attr($tg_image_alt); ?>">
                <?php endif; ?>

                <div class="review-wrap">
                    <?php if (!empty($settings['tg_star_img']['url'])) : ?>
                        <img src="<?php echo esc_url($settings['tg_star_img']['url']); ?>" alt="<?php echo esc_attr__('Star', 'genixcore') ?>">
                    <?php endif; ?>

                    <div class="content">
                        <h2 class="title"><?php echo esc_html( $settings['tg_total_rating'] ) ?></h2>
                        <p><?php echo wp_kses_post( $settings['tg_rating_text'] ) ?></p>
                    </div>

                </div>

            </div>

        <?php else : ?>

            <div class="about-img-wrap-three">
                <?php if (!empty($tg_image_url)) : ?>
                    <img src="<?php echo esc_url($tg_image_url); ?>" alt="<?php echo esc_attr($tg_image_alt); ?>" data-aos="fade-down-right" data-aos-delay="0">
                <?php endif; ?>

                <?php if (!empty($tg_image_url2)) : ?>
                    <img src="<?php echo esc_url($tg_image_url2); ?>" alt="<?php echo esc_attr($tg_image_alt2); ?>" data-aos="fade-left" data-aos-delay="400">
                <?php endif; ?>

                <?php if (!empty($settings['experience_year'] || $settings['experience_text'])) : ?>
                    <div class="experience-wrap" data-aos="fade-up" data-aos-delay="300">
                        <?php if (!empty($settings['experience_year'])) : ?>
                            <h2 class="title"><?php echo wp_kses_post($settings['experience_year']) ?></h2>
                        <?php endif; ?>

                        <?php if (!empty($settings['experience_text'])) : ?>
                            <p><?php echo wp_kses_post($settings['experience_text']) ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TG_ImageBox());
