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
class Genix_Author extends Widget_Base
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
        return 'tg-author';
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
        return __('Gerow Author', 'genixcore');
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

        // author_group
        $this->start_controls_section(
            'tg_author_group',
            [
                'label' => esc_html__('About Author', 'genixcore'),
            ]
        );

        $this->add_control(
            'author_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Author Image', 'genixcore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'tg_title',
            [
                'label' => esc_html__('Name', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Mark Stranger', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_desc',
            [
                'label' => esc_html__('Designation', 'genixcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('CEO, Gerow Finance', 'genixcore'),
            ]
        );


        $this->add_control(
            'author_sign',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => esc_html__('Author Signature', 'genixcore'),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'sign',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->add_control(
            'tg_title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'genixcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => esc_html__('H1', 'genixcore'),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2' => [
                        'title' => esc_html__('H2', 'genixcore'),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3' => [
                        'title' => esc_html__('H3', 'genixcore'),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4' => [
                        'title' => esc_html__('H4', 'genixcore'),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5' => [
                        'title' => esc_html__('H5', 'genixcore'),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6' => [
                        'title' => esc_html__('H6', 'genixcore'),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'tg_align',
            [
                'label' => esc_html__('Alignment', 'genixcore'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'genixcore'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'genixcore'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'genixcore'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
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

        $this->add_render_attribute('title_args', 'class', 'title');

        if (!empty($settings['author_image']['url'])) {
            $genix_author_image_url = !empty($settings['author_image']['id']) ? wp_get_attachment_image_url($settings['author_image']['id'], $settings['thumbnail_size']) : $settings['author_image']['url'];
            $genix_author_image_alt = get_post_meta($settings['author_image']["id"], "_wp_attachment_image_alt", true);
        }

        if (!empty($settings['author_sign']['url'])) {
            $genix_sign_image_url = !empty($settings['author_sign']['id']) ? wp_get_attachment_image_url($settings['author_sign']['id'], $settings['sign_size']) : $settings['author_sign']['url'];
            $genix_sign_image_alt = get_post_meta($settings['author_sign']["id"], "_wp_attachment_image_alt", true);
        }

?>


        <div class="about-author-info">
            <?php if (!empty($genix_author_image_url)) : ?>
                <div class="thumb">
                    <img src="<?php echo esc_url($genix_author_image_url); ?>" alt="<?php echo esc_attr($genix_author_image_alt); ?>">
                </div>
            <?php endif; ?>
            <div class="content">
                <?php
                if (!empty($settings['tg_title'])) :
                    printf(
                        '<%1$s %2$s>%3$s</%1$s>',
                        tag_escape($settings['tg_title_tag']),
                        $this->get_render_attribute_string('title_args'),
                        genix_kses($settings['tg_title'])
                    );
                endif;
                ?>
                <?php if (!empty($settings['tg_desc'])) : ?>
                    <span><?php echo esc_html($settings['tg_desc']) ?></span>
                <?php endif; ?>
            </div>

            <?php if (!empty($genix_sign_image_url)) : ?>
                <div class="signature">
                    <img src="<?php echo esc_url($genix_sign_image_url); ?>" alt="<?php echo esc_attr($genix_sign_image_alt); ?>">
                </div>
            <?php endif; ?>

        </div>

<?php
    }
}

$widgets_manager->register(new Genix_Author());
