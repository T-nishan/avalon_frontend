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
class TG_Testimonial extends Widget_Base
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
        return 'testimonial';
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
        return __('Testimonial', 'genixcore');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Review Bg
        $this->start_controls_section(
            '__testimonial_image',
            [
                'label' => esc_html__('Testimonial Images', 'genixcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tg_design_style' => ['layout-2', 'layout-3'],
                ]
            ]
        );

        $this->add_control(
            'testimonial_image',
            [
                'label' => esc_html__('Image', 'genixcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'testimonial_icon',
            [
                'label' => esc_html__('Quote Icon', 'genixcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'tg_design_style' => 'layout-3',
                ]
            ]
        );

        $this->add_control(
            'testimonial_shape',
            [
                'label' => esc_html__('Image Shape', 'genixcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'tg_design_style' => 'layout-3',
                ]
            ]
        );

        $this->add_control(
            'testimonial_bg',
            [
                'label' => esc_html__('Background', 'genixcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'tg_design_style' => 'layout-2',
                ]
            ]
        );

        $this->end_controls_section();

        // Review group
        $this->start_controls_section(
            'review_list',
            [
                'label' => esc_html__('Testimonial List', 'genixcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'review_content',
            [
                'label' => esc_html__('Review Content', 'genixcore'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('“ Morem ipsum dolor sit amet, consectetur adipiscing elita florai sum dolor sit amet, consecteture.Borem ipsum dolor sit amet, consectetur.', 'genixcore'),
                'placeholder' => esc_html__('Type your review content here', 'genixcore'),
            ]
        );

        $repeater->add_control(
            'reviewer_image',
            [
                'label' => esc_html__('Reviewer Image', 'genixcore'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'reviewer_image_size',
                'default' => 'full',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $repeater->add_control(
            'reviewer_name',
            [
                'label' => esc_html__('Reviewer Name', 'genixcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Mr.Robey Alexa', 'genixcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'reviewer_designation',
            [
                'label' => esc_html__('Reviewer Designation', 'genixcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('CEO, Gerow Agency', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__('Review List', 'genixcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' =>  $repeater->get_controls(),
                'default' => [
                    [
                        'reviewer_name' => esc_html__('Mr.Robey Alexa', 'genixcore'),
                    ],
                    [
                        'reviewer_name' => esc_html__('Samuel Peters', 'genixcore'),
                    ],
                    [
                        'reviewer_name' => esc_html__('Robert Fox', 'genixcore'),
                    ],

                ],
                'title_field' => '{{{ reviewer_name }}}',
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

            <script>
                jQuery(document).ready(function($) {

                    /*=============================================
                        =          Data Background               =
                    =============================================*/
                    $("[data-background]").each(function() {
                        $(this).css("background-image", "url(" + $(this).attr("data-background") + ")")
                    });

                    /*=============================================
                        =    		testimonial Active		      =
                    =============================================*/
                    $('.testimonial-active-three').slick({
                        dots: false,
                        infinite: true,
                        speed: 1000,
                        autoplay: true,
                        fade: true,
                        arrows: true,
                        prevArrow: '<button type="button" class="slick-prev"><i class="flaticon-right-arrow"></i></button>',
                        nextArrow: '<button type="button" class="slick-next"><i class="flaticon-right-arrow"></i></button>',
                        appendArrows: ".testimonial-nav-three",
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    infinite: true,
                                }
                            },
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 767,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            },
                            {
                                breakpoint: 575,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            },
                        ]
                    });

                });
            </script>
            <section class="testimonial-area-three">
                <div class="row g-0 align-items-end">
                    <?php if (!empty($settings['testimonial_image']['url'])) : ?>
                        <div class="col-37">
                            <div class="testimonial-img-three">
                                <img src="<?php echo esc_url($settings['testimonial_image']['url']) ?>" alt="<?php echo esc_attr__('img', 'genixcore') ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-63">
                        <div class="testimonial-item-wrap-three" data-background="<?php echo esc_url($settings['testimonial_bg']['url']) ?>">
                            <div class="testimonial-active-three">
                                <?php foreach ($settings['reviews_list'] as $item) : ?>
                                    <div class="testimonial-item-three">
                                        <div class="testimonial-content-three">
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <?php if (!empty($item['review_content'])) : ?>
                                                <p><?php echo esc_html($item['review_content']); ?></p>
                                            <?php endif; ?>
                                            <div class="testimonial-info">
                                                <?php if (!empty($item['reviewer_name'])) : ?>
                                                    <h2 class="title"><?php echo genix_kses($item['reviewer_name']); ?></h2>
                                                <?php endif; ?>
                                                <?php if (!empty($item['reviewer_designation'])) : ?>
                                                    <span><?php echo genix_kses($item['reviewer_designation']); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="testimonial-nav-three"></div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ($settings['tg_design_style']  == 'layout-3') : ?>

            <script>
                jQuery(document).ready(function($) {

                    /*===========================================
                        =    		testimonial Active		  =
                    =============================================*/
                    $('.testimonial-active-four').slick({
                        dots: false,
                        infinite: true,
                        speed: 1000,
                        autoplay: true,
                        arrows: true,
                        prevArrow: '<button type="button" class="slick-prev"><i class="flaticon-right-arrow"></i></button>',
                        nextArrow: '<button type="button" class="slick-next"><i class="flaticon-right-arrow"></i></button>',
                        appendArrows: ".testimonial-nav-four",
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    infinite: true,
                                }
                            },
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 767,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            },
                            {
                                breakpoint: 575,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            },
                        ]
                    });

                });
            </script>

            <div class="row align-items-center justify-content-center">
                <?php if (!empty($settings['testimonial_image']['url'])) : ?>
                    <div class="col-lg-5 col-md-8">
                        <div class="testimonial-img-four">

                            <img src="<?php echo esc_url($settings['testimonial_image']['url']) ?>" alt="<?php echo esc_attr__('img', 'genixcore') ?>">

                            <?php if (!empty($settings['testimonial_icon']['url'])) : ?>
                                <div class="icon">
                                    <img src="<?php echo esc_url($settings['testimonial_icon']['url']) ?>" alt="<?php echo esc_attr__('img', 'genixcore') ?>">
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($settings['testimonial_shape']['url'])) : ?>
                                <img src="<?php echo esc_url($settings['testimonial_shape']['url']) ?>" alt="<?php echo esc_attr__('img', 'genixcore') ?>" class="shape">
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-lg-7">
                    <div class="testimonial-item-wrap-four">
                        <div class="testimonial-active-four">
                            <?php foreach ($settings['reviews_list'] as $item) : ?>
                                <div class="testimonial-item-four">
                                    <div class="testimonial-content-four">
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <?php if (!empty($item['review_content'])) : ?>
                                            <p><?php echo esc_html($item['review_content']); ?></p>
                                        <?php endif; ?>
                                        <div class="testimonial-info">
                                            <?php if (!empty($item['reviewer_name'])) : ?>
                                                <h2 class="title"><?php echo genix_kses($item['reviewer_name']); ?></h2>
                                            <?php endif; ?>
                                            <?php if (!empty($item['reviewer_designation'])) : ?>
                                                <span><?php echo genix_kses($item['reviewer_designation']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="testimonial-nav-four"></div>
                    </div>
                </div>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-4') : ?>

            <script>
                jQuery(document).ready(function($) {

                    /*===========================================
                        =    		testimonial Active		  =
                    =============================================*/
                    $('.testimonial-active-five').slick({
                        dots: false,
                        infinite: true,
                        speed: 1000,
                        autoplay: true,
                        arrows: true,
                        prevArrow: '<button type="button" class="slick-prev"><i class="flaticon-right-arrow"></i></button>',
                        nextArrow: '<button type="button" class="slick-next"><i class="flaticon-right-arrow"></i></button>',
                        appendArrows: ".testimonial-nav-five",
                        vertical: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    infinite: true,
                                }
                            },
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 767,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            },
                            {
                                breakpoint: 575,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            },
                        ]
                    });

                });
            </script>

            <div class="testimonial-item-wrap-five testimonial-content-five">
                <div class="testimonial-active-five">
                    <?php foreach ($settings['reviews_list'] as $item) :
                        if (!empty($item['reviewer_image']['url'])) {
                            $tg_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url($item['reviewer_image']['id'], $item['reviewer_image_size_size']) : $item['reviewer_image']['url'];
                            $tg_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                    ?>
                        <div class="testimonial-item">
                            <div class="testimonial-content">
                                <div class="content-top">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="testimonial-quote">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/quote.svg" alt="Quote Icon">
                                    </div>
                                </div>
                                <?php if (!empty($item['review_content'])) : ?>
                                    <p><?php echo esc_html($item['review_content']); ?></p>
                                <?php endif; ?>

                                <div class="testimonial-avatar">
                                    <?php if (!empty($item['reviewer_image'])) : ?>
                                        <div class="avatar-thumb">
                                            <img src="<?php echo esc_url($tg_reviewer_image); ?>" alt="<?php echo esc_url($tg_reviewer_image_alt); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="avatar-info">
                                        <?php if (!empty($item['reviewer_name'])) : ?>
                                            <h2 class="title"><?php echo genix_kses($item['reviewer_name']); ?></h2>
                                        <?php endif; ?>
                                        <?php if (!empty($item['reviewer_designation'])) : ?>
                                            <span><?php echo genix_kses($item['reviewer_designation']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="testimonial-nav-five"></div>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-5') : ?>

            <script>
                jQuery(document).ready(function($) {

                    /*===========================================
                        =    		Brand Active		      =
                    =============================================*/
                    $('.testimonial-active').slick({
                        dots: false,
                        infinite: true,
                        speed: 1000,
                        autoplay: true,
                        fade: true,
                        arrows: true,
                        prevArrow: '<button type="button" class="slick-prev"><i class="flaticon-right-arrow"></i></button>',
                        nextArrow: '<button type="button" class="slick-next"><i class="flaticon-right-arrow"></i></button>',
                        appendArrows: ".testimonial-nav",
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    infinite: true,
                                }
                            },
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 767,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            },
                            {
                                breakpoint: 575,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            },
                        ]
                    });

                });
            </script>

            <div class="testimonial-item-wrap">
                <div class="testimonial-active">
                    <?php foreach ($settings['reviews_list'] as $item) : ?>
                        <div class="testimonial-item">
                            <div class="testimonial-content">
                                <div class="content-top">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <div class="testimonial-quote">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/quote.svg" alt="Quote Icon">
                                    </div>
                                </div>
                                <?php if (!empty($item['review_content'])) : ?>
                                    <p><?php echo esc_html($item['review_content']); ?></p>
                                <?php endif; ?>
                                <div class="testimonial-info">
                                    <?php if (!empty($item['reviewer_name'])) : ?>
                                        <h2 class="title"><?php echo genix_kses($item['reviewer_name']); ?></h2>
                                    <?php endif; ?>
                                    <?php if (!empty($item['reviewer_designation'])) : ?>
                                        <span><?php echo genix_kses($item['reviewer_designation']); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="testimonial-nav"></div>
            </div>

        <?php else : ?>

            <script>
                jQuery(document).ready(function($) {

                    /*=============================================
                        =    		testimonial Active		=
                    =============================================*/
                    $('.testimonial-active-two').slick({
                        dots: false,
                        infinite: true,
                        speed: 1000,
                        autoplay: true,
                        arrows: true,
                        prevArrow: '<button type="button" class="slick-prev"><i class="flaticon-right-arrow"></i></button>',
                        nextArrow: '<button type="button" class="slick-next"><i class="flaticon-right-arrow"></i></button>',
                        appendArrows: ".testimonial-nav-two",
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        responsive: [{
                                breakpoint: 1200,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 1,
                                    infinite: true,
                                }
                            },
                            {
                                breakpoint: 992,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 767,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            },
                            {
                                breakpoint: 575,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                }
                            },
                        ]
                    });

                });
            </script>

            <div class="testimonial-item-wrap-two">
                <div class="row testimonial-active-two">
                    <?php foreach ($settings['reviews_list'] as $item) :
                        if (!empty($item['reviewer_image']['url'])) {
                            $tg_reviewer_image = !empty($item['reviewer_image']['id']) ? wp_get_attachment_image_url($item['reviewer_image']['id'], $item['reviewer_image_size_size']) : $item['reviewer_image']['url'];
                            $tg_reviewer_image_alt = get_post_meta($item["reviewer_image"]["id"], "_wp_attachment_image_alt", true);
                        }
                    ?>
                        <div class="col-lg-6">
                            <div class="testimonial-item-two">
                                <div class="testimonial-content-two">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <?php if (!empty($item['review_content'])) : ?>
                                        <p><?php echo esc_html($item['review_content']); ?></p>
                                    <?php endif; ?>
                                    <div class="testimonial-avatar">

                                        <?php if (!empty($item['reviewer_image'])) : ?>
                                            <div class="avatar-thumb">
                                                <img src="<?php echo esc_url($tg_reviewer_image); ?>" alt="<?php echo esc_url($tg_reviewer_image_alt); ?>">
                                            </div>
                                        <?php endif; ?>

                                        <div class="avatar-info">
                                            <?php if (!empty($item['reviewer_name'])) : ?>
                                                <h2 class="title"><?php echo genix_kses($item['reviewer_name']); ?></h2>
                                            <?php endif; ?>
                                            <?php if (!empty($item['reviewer_designation'])) : ?>
                                                <span><?php echo genix_kses($item['reviewer_designation']); ?></span>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="testimonial-nav-two"></div>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TG_Testimonial());
