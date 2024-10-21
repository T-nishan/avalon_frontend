<?php

namespace GenixCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Utils;
use \Elementor\Control_Media;

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
class Genix_Banner_Content extends Widget_Base
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
        return 'tg-content';
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
        return __('Banner Content', 'genixcore');
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

        // genix_section_title
        $this->start_controls_section(
            'genix_section_title',
            [
                'label' => esc_html__('Title & Content', 'genixcore'),
            ]
        );

        $this->add_control(
            'tg_sub_title',
            [
                'label' => esc_html__('Sub Title', 'genixcore'),
                'description' => genix_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Gerow Sub Title Here', 'genixcore'),
                'placeholder' => esc_html__('Type Heading Text', 'genixcore'),
                'label_block' => true,
                'condition' => [
                    'tg_design_style!' => ['layout-2', 'layout-4'],
                ]
            ]
        );

        $this->add_control(
            'tg_title',
            [
                'label' => esc_html__('Title', 'genixcore'),
                'description' => genix_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Gerow Title Here', 'genixcore'),
                'placeholder' => esc_html__('Type Heading Text', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_desc',
            [
                'label' => esc_html__('Description', 'genixcore'),
                'description' => genix_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Agilos helps you to convert your data into a strategic asset and top-notch business insights minddestmentor.', 'genixcore'),
                'label_block' => true,
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
            'genix_align',
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

        // tg_button_group
        $this->start_controls_section(
            'tg_button_group',
            [
                'label' => esc_html__('Button', 'genixcore'),
                'condition' => [
                    'tg_design_style' => ['layout-3', 'layout-4'],
                ]
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
                'default' => esc_html__('Discover More', 'genixcore'),
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

        // style tab here
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => esc_html__('Title / Content', 'genixcore'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Content Padding', 'genixcore'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tg-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .tg-content',
                'exclude' => [
                    'image'
                ]
            ]
        );

        // Title
        $this->add_control(
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Title', 'genixcore'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'genixcore'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Text Color', 'genixcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        // Subtitle
        $this->add_control(
            '_heading_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Subtitle', 'genixcore'),
                'separator' => 'before',
                'condition' => [
                    'tg_design_style!' => ['layout-2', 'layout-4'],
                ]
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'genixcore'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tg_design_style!' => ['layout-2', 'layout-4'],
                ]
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Text Color', 'genixcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'tg_design_style!' => ['layout-2', 'layout-4'],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub-title',
                'selector' => '{{WRAPPER}} .sub-title',
                'condition' => [
                    'tg_design_style!' => ['layout-2', 'layout-4'],
                ]
            ]
        );

        // description
        $this->add_control(
            '_content_description',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__('Description', 'genixcore'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => esc_html__('Bottom Spacing', 'genixcore'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .tg-content p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Text Color', 'genixcore'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tg-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description',
                'selector' => '{{WRAPPER}} .tg-content p',
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

        <?php if ($settings['tg_design_style'] == 'layout-2') :

            $this->add_render_attribute('title_args', 'class', 'title');
            $this->add_render_attribute('title_args', 'data-aos', 'fade-right');
            $this->add_render_attribute('title_args', 'data-aos-delay', '0');

        ?>

            <div class="banner-content-three tg-content">
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
                    <p data-aos="fade-right" data-aos-delay="300"><?php echo genix_kses($settings['tg_desc']); ?></p>
                <?php endif; ?>

            </div>

        <?php elseif ($settings['tg_design_style'] == 'layout-3') :

            $this->add_render_attribute('title_args', 'class', 'title');
            $this->add_render_attribute('title_args', 'data-aos', 'fade-up');
            $this->add_render_attribute('title_args', 'data-aos-delay', '200');

            // Link
            if (
                '2' == $settings['tg_btn_link_type']
            ) {
                $this->add_render_attribute('tg-button-arg', 'href', get_permalink($settings['tg_btn_page_link']));
                $this->add_render_attribute('tg-button-arg', 'target', '_self');
                $this->add_render_attribute('tg-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tg-button-arg', 'class', 'btn btn-three');
                $this->add_render_attribute('tg-button-arg', 'data-aos', 'fade-up');
                $this->add_render_attribute('tg-button-arg', 'data-aos-delay', '600');
            } else {
                if (!empty($settings['tg_btn_link']['url'])) {
                    $this->add_link_attributes('tg-button-arg', $settings['tg_btn_link']);
                    $this->add_render_attribute('tg-button-arg', 'class', 'btn btn-three');
                    $this->add_render_attribute('tg-button-arg', 'data-aos', 'fade-up');
                    $this->add_render_attribute('tg-button-arg', 'data-aos-delay', '600');
                }
            }

        ?>

            <div class="banner-content-four tg-content">
                <?php if (!empty($settings['tg_sub_title'])) : ?>
                    <span class="sub-title" data-aos="fade-up" data-aos-delay="0"><?php echo genix_kses($settings['tg_sub_title']); ?></span>
                <?php endif; ?>

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
                    <p data-aos="fade-up" data-aos-delay="400"><?php echo genix_kses($settings['tg_desc']); ?></p>
                <?php endif; ?>

                <?php if (!empty($settings['tg_button_show'])) : ?>
                    <a <?php echo $this->get_render_attribute_string('tg-button-arg'); ?>>
                        <?php echo $settings['tg_btn_text']; ?>
                    </a>
                <?php endif; ?>

            </div>


        <?php elseif ($settings['tg_design_style'] == 'layout-4') :

            $this->add_render_attribute('title_args', 'class', 'title');
            $this->add_render_attribute('title_args', 'data-aos', 'fade-right');
            $this->add_render_attribute('title_args', 'data-aos-delay', '0');

            // Link
            if (
                '2' == $settings['tg_btn_link_type']
            ) {
                $this->add_render_attribute('tg-button-arg', 'href', get_permalink($settings['tg_btn_page_link']));
                $this->add_render_attribute('tg-button-arg', 'target', '_self');
                $this->add_render_attribute('tg-button-arg', 'rel', 'nofollow');
                $this->add_render_attribute('tg-button-arg', 'class', 'btn btn-three');
                $this->add_render_attribute('tg-button-arg', 'data-aos', 'fade-right');
                $this->add_render_attribute('tg-button-arg', 'data-aos-delay', '600');
            } else {
                if (!empty($settings['tg_btn_link']['url'])) {
                    $this->add_link_attributes('tg-button-arg', $settings['tg_btn_link']);
                    $this->add_render_attribute('tg-button-arg', 'class', 'btn btn-three');
                    $this->add_render_attribute('tg-button-arg', 'data-aos', 'fade-right');
                    $this->add_render_attribute('tg-button-arg', 'data-aos-delay', '600');
                }
            }

        ?>

            <div class="banner-content-five tg-content">

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
                    <p data-aos="fade-right" data-aos-delay="300"><?php echo genix_kses($settings['tg_desc']); ?></p>
                <?php endif; ?>

                <?php if (!empty($settings['tg_button_show'])) : ?>
                    <a <?php echo $this->get_render_attribute_string('tg-button-arg'); ?>>
                        <?php echo $settings['tg_btn_text']; ?>
                    </a>
                <?php endif; ?>

            </div>

        <?php else :

            $this->add_render_attribute('title_args', 'class', 'title');
            $this->add_render_attribute('title_args', 'data-aos', 'fade-up');
            $this->add_render_attribute('title_args', 'data-aos-delay', '300');

        ?>

            <div class="banner-content-two tg-content">

                <?php if (!empty($settings['tg_sub_title'])) : ?>
                    <span class="sub-title" data-aos="fade-up" data-aos-delay="0"><?php echo genix_kses($settings['tg_sub_title']); ?></span>
                <?php endif; ?>

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
                    <p data-aos="fade-up" data-aos-delay="500"><?php echo genix_kses($settings['tg_desc']); ?></p>
                <?php endif; ?>

            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new Genix_Banner_Content());
