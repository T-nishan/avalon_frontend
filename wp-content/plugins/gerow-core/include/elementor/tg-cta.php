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
class TG_CTA extends Widget_Base
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
        return 'tg-cta';
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
        return __('CTA', 'genixcore');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // _tg_text
        $this->start_controls_section(
            '_tg_phone_text',
            [
                'label' => esc_html__('Phone', 'genixcore'),
            ]
        );

        $this->add_control(
            'tg_phone_title',
            [
                'label' => esc_html__('Title', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Call For More Info', 'genixcore'),
                'placeholder' => esc_html__('Type Text Here', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_phone_number',
            [
                'label' => esc_html__('Phone Number', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('+123 8989 444', 'genixcore'),
                'placeholder' => esc_html__('Type Text Here', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // _tg_title
        $this->start_controls_section(
            '_tg_title_text',
            [
                'label' => esc_html__('Title', 'genixcore'),
            ]
        );

        $this->add_control(
            'tg_title',
            [
                'label' => esc_html__('Title', 'genixcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Let’s Request a Schedule For Free Consultation', 'genixcore'),
                'placeholder' => esc_html__('Type Text Here', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // tg_button_group
        $this->start_controls_section(
            'tg_button_group',
            [
                'label' => esc_html__('Button', 'genixcore'),
            ]
        );

        $this->add_control(
            'tg_button_show',
            [
                'label' => esc_html__('Show Button', 'genixcore'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'genixcore'),
                'label_off' => esc_html__('Hide', 'genixcore'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'tg_btn_text',
            [
                'label' => esc_html__('Button Text', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button Text', 'genixcore'),
                'title' => esc_html__('Enter button text', 'genixcore'),
                'label_block' => true,
                'condition' => [
                    'tg_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tg_btn_link_type',
            [
                'label' => esc_html__('Button Link Type', 'genixcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Custom Link',
                    '2' => 'Internal Page',
                ],
                'default' => '1',
                'label_block' => true,
                'condition' => [
                    'tg_button_show' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'tg_btn_link',
            [
                'label' => esc_html__('Button link', 'genixcore'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'genixcore'),
                'show_external' => false,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'condition' => [
                    'tg_btn_link_type' => '1',
                    'tg_button_show' => 'yes'
                ],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'tg_btn_page_link',
            [
                'label' => esc_html__('Select Button Page', 'genixcore'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => genix_get_all_pages(),
                'condition' => [
                    'tg_btn_link_type' => '2',
                    'tg_button_show' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // Style Tab
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

        <?php if ($settings['tg_design_style']  == 'layout-2') :

            // Link
            if ('2' == $settings['tg_btn_link_type']) {
                $this->add_render_attribute('tg-button-arg', 'href', get_permalink($settings['tg_btn_page_link']));
                $this->add_render_attribute('tg-button-arg', 'target', '_self');
                $this->add_render_attribute('tg-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tg-button-arg', 'class', 'btn btn-three');
            } else {
                if (!empty($settings['tg_btn_link']['url'])) {
                    $this->add_link_attributes('tg-button-arg', $settings['tg_btn_link']);
                    $this->add_render_attribute('tg-button-arg', 'class', 'btn btn-three');
                }
            }

        ?>

            <div class="cta-inner-wrap-two">
                <div class="row align-items-center">
                    <div class="col-lg-9">
                        <div class="cta-content">
                            <div class="cta-info-wrap">
                                <div class="icon">
                                    <i class="flaticon-phone-call"></i>
                                </div>
                                <div class="content">
                                    <?php if (!empty($settings['tg_phone_title'])) : ?>
                                        <span><?php echo genix_kses($settings['tg_phone_title']); ?></span>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tg_phone_number'])) : ?>
                                        <a href="tel:<?php echo esc_attr($settings['tg_phone_number']); ?>"><?php echo genix_kses($settings['tg_phone_number']); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php if (!empty($settings['tg_title'])) : ?>
                                <h2 class="title"><?php echo genix_kses($settings['tg_title']); ?></h2>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if (!empty($settings['tg_button_show'])) : ?>
                        <div class="col-lg-3">
                            <div class="cta-btn text-end">
                                <a <?php echo $this->get_render_attribute_string('tg-button-arg'); ?>>
                                    <?php echo $settings['tg_btn_text']; ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-3') :

            // Link
            if ('2' == $settings['tg_btn_link_type']) {
                $this->add_render_attribute('tg-button-arg', 'href', get_permalink($settings['tg_btn_page_link']));
                $this->add_render_attribute('tg-button-arg', 'target', '_self');
                $this->add_render_attribute('tg-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tg-button-arg', 'class', 'btn btn-three');
            } else {
                if (!empty($settings['tg_btn_link']['url'])) {
                    $this->add_link_attributes('tg-button-arg', $settings['tg_btn_link']);
                    $this->add_render_attribute('tg-button-arg', 'class', 'btn btn-three');
                }
            }

        ?>

            <div class="cta-inner-wrap-three">
                <div class="row align-items-center">
                    <div class="col-lg-9">
                        <div class="cta-content">
                            <div class="cta-info-wrap cta-info-wrap-two">
                                <div class="icon">
                                    <i class="flaticon-phone-call"></i>
                                </div>
                                <div class="content">
                                    <?php if (!empty($settings['tg_phone_title'])) : ?>
                                        <span><?php echo genix_kses($settings['tg_phone_title']); ?></span>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tg_phone_number'])) : ?>
                                        <a href="tel:<?php echo esc_attr($settings['tg_phone_number']); ?>"><?php echo genix_kses($settings['tg_phone_number']); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php if (!empty($settings['tg_title'])) : ?>
                                <h2 class="title"><?php echo genix_kses($settings['tg_title']); ?></h2>
                            <?php endif; ?>

                        </div>
                    </div>

                    <?php if (!empty($settings['tg_button_show'])) : ?>
                        <div class="col-lg-3">
                            <div class="cta-btn text-end">
                                <a <?php echo $this->get_render_attribute_string('tg-button-arg'); ?>>
                                    <?php echo $settings['tg_btn_text']; ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-4') :

            // Link
            if ('2' == $settings['tg_btn_link_type']) {
                $this->add_render_attribute('tg-button-arg', 'href', get_permalink($settings['tg_btn_page_link']));
                $this->add_render_attribute('tg-button-arg', 'target', '_self');
                $this->add_render_attribute('tg-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tg-button-arg', 'class', 'btn');
            } else {
                if (!empty($settings['tg_btn_link']['url'])) {
                    $this->add_link_attributes('tg-button-arg', $settings['tg_btn_link']);
                    $this->add_render_attribute('tg-button-arg', 'class', 'btn');
                }
            }
        ?>

            <div class="row align-items-center">

                <?php if (!empty($settings['tg_title'])) : ?>
                    <div class="col-lg-5">
                        <div class="request-content tg-heading-subheading animation-style2">
                            <h2 class="title tg-element-title"><?php echo genix_kses($settings['tg_title']); ?></h2>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-lg-7">
                    <div class="request-content-right">
                        <div class="request-contact">
                            <div class="icon">
                                <i class="flaticon-phone-call"></i>
                            </div>
                            <div class="content">
                                <?php if (!empty($settings['tg_phone_title'])) : ?>
                                    <span><?php echo genix_kses($settings['tg_phone_title']); ?></span>
                                <?php endif; ?>

                                <?php if (!empty($settings['tg_phone_number'])) : ?>
                                    <a href="tel:<?php echo esc_attr($settings['tg_phone_number']); ?>"><?php echo genix_kses($settings['tg_phone_number']); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if (!empty($settings['tg_button_show'])) : ?>
                            <div class="request-btn">
                                <a <?php echo $this->get_render_attribute_string('tg-button-arg'); ?>>
                                    <?php echo $settings['tg_btn_text']; ?>
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        <?php else :

            // Link
            if ('2' == $settings['tg_btn_link_type']) {
                $this->add_render_attribute('tg-button-arg', 'href', get_permalink($settings['tg_btn_page_link']));
                $this->add_render_attribute('tg-button-arg', 'target', '_self');
                $this->add_render_attribute('tg-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tg-button-arg', 'class', 'btn');
            } else {
                if (!empty($settings['tg_btn_link']['url'])) {
                    $this->add_link_attributes('tg-button-arg', $settings['tg_btn_link']);
                    $this->add_render_attribute('tg-button-arg', 'class', 'btn');
                }
            }
        ?>

            <div class="cta-inner-wrap">
                <div class="row align-items-center">
                    <div class="col-lg-9">
                        <div class="cta-content">
                            <div class="cta-info-wrap">
                                <div class="icon">
                                    <i class="flaticon-phone-call"></i>
                                </div>
                                <div class="content">
                                    <?php if (!empty($settings['tg_phone_title'])) : ?>
                                        <span><?php echo genix_kses($settings['tg_phone_title']); ?></span>
                                    <?php endif; ?>

                                    <?php if (!empty($settings['tg_phone_number'])) : ?>
                                        <a href="tel:<?php echo esc_attr($settings['tg_phone_number']); ?>"><?php echo genix_kses($settings['tg_phone_number']); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if (!empty($settings['tg_title'])) : ?>
                                <h2 class="title"><?php echo genix_kses($settings['tg_title']); ?></h2>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php if (!empty($settings['tg_button_show'])) : ?>
                        <div class="col-lg-3">
                            <div class="cta-btn text-end">
                                <a <?php echo $this->get_render_attribute_string('tg-button-arg'); ?>>
                                    <?php echo $settings['tg_btn_text']; ?>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TG_CTA());
