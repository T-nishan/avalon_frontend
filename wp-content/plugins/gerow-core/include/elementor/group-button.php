<?php

namespace GenixCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Gerow Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Group_Buttom extends Widget_Base
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
        return 'tg-group-btn';
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
        return __('Group Button', 'genixcore');
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

        $this->add_responsive_control(
            'tg_align',
            [
                'label' => esc_html__('Alignment', 'genixcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Left', 'genixcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'genixcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('Right', 'genixcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'flex-start',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .banner-btn' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        // _tg_video
        $this->start_controls_section(
            '_tg_video_section',
            [
                'label' => esc_html__('Video Button', 'genixcore'),
            ]
        );

        $this->add_control(
            'video_btn_text',
            [
                'label' => esc_html__('Button Text', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Watch The Video', 'genixcore'),
                'title' => esc_html__('Enter button text', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'video_url',
            [
                'label' => esc_html__('Video URL', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('https://www.youtube.com/watch?v=6mkoGSqTqFI', 'genixcore'),
                'label_block' => true,
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

        // Link
        if ('2' == $settings['tg_btn_link_type']) {
            $this->add_render_attribute('tg-button-arg', 'href', get_permalink($settings['tg_btn_page_link']));
            $this->add_render_attribute('tg-button-arg', 'target', '_self');
            $this->add_render_attribute('tg-button-arg', 'rel', 'nofollow');
            $this->add_render_attribute('tg-button-arg', 'class', 'btn');
            $this->add_render_attribute('tg-button-arg', 'data-aos', 'fade-right');
            $this->add_render_attribute('tg-button-arg', 'data-aos-delay', '700');
        } else {
            if (!empty($settings['tg_btn_link']['url'])) {
                $this->add_link_attributes('tg-button-arg', $settings['tg_btn_link']);
                $this->add_render_attribute('tg-button-arg', 'class', 'btn');
                $this->add_render_attribute('tg-button-arg', 'data-aos', 'fade-right');
                $this->add_render_attribute('tg-button-arg', 'data-aos-delay', '700');
            }
        }

?>

        <div class="banner-content-two">
            <div class="banner-btn">

                <?php if (!empty($settings['tg_button_show'])) : ?>
                    <a <?php echo $this->get_render_attribute_string('tg-button-arg'); ?>>
                        <?php echo $settings['tg_btn_text']; ?>
                    </a>
                <?php endif; ?>

                <?php if (!empty($settings['video_url'])) : ?>
                    <a href="<?php echo esc_url($settings['video_url']) ?>" class="play-btn popup-video" data-aos="fade-left" data-aos-delay="700"><i class="fas fa-play"></i> <span><?php echo esc_html($settings['video_btn_text']) ?></span></a>
                <?php endif; ?>

            </div>
        </div>

<?php
    }
}

$widgets_manager->register(new Group_Buttom());
