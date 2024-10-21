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
class TG_ProjectInfo extends Widget_Base
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
        return 'project-info';
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
        return __('Project Info', 'genixcore');
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

        // _tg_info_list
        $this->start_controls_section(
            '_tg_info_list',
            [
                'label' => esc_html__('Info List', 'genixcore'),
            ]
        );

        $this->add_control(
            'project_title',
            [
                'label' => esc_html__('Info Title', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Project Information', 'genixcore'),
                'placeholder' => esc_html__('Type list text', 'genixcore'),
                'label_block' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'repeater_title',
            [
                'label' => esc_html__('Title', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => wp_kses_post('<span>Client:</span>Rebeca', 'genixcore'),
                'placeholder' => esc_html__('Type list text', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'item_lists',
            [
                'label' => esc_html__('Item Lists', 'genixcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'repeater_title' => wp_kses_post('<span>Client:</span>Rebeca', 'genixcore'),
                    ],
                    [
                        'repeater_title' => wp_kses_post('<span>Date:</span>17 March, 2023', 'genixcore'),
                    ],
                    [
                        'repeater_title' => wp_kses_post('<span>Category:</span>Modern', 'genixcore'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // _tg_list
        $this->start_controls_section(
            '_tg_social_list',
            [
                'label' => esc_html__('Social List', 'genixcore'),
            ]
        );

        $this->add_control(
            'social_title',
            [
                'label' => esc_html__('Title', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Share:', 'genixcore'),
                'placeholder' => esc_html__('Type list text', 'genixcore'),
                'label_block' => true,
            ]
        );

        $social = new \Elementor\Repeater();

        if (genix_is_elementor_version('<', '2.6.0')) {
            $social->add_control(
                'tg_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-star',
                ]
            );
        } else {
            $social->add_control(
                'tg_selected_icon',
                [
                    'show_label' => false,
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

        $social->add_control(
            'tg_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__('URL', 'genixcore'),
                'default' => esc_html__('#', 'genixcore'),
                'placeholder' => esc_html__('Type url here', 'genixcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'social_lists',
            [
                'label' => esc_html__('Item Lists', 'genixcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $social->get_controls(),
                'default' => [
                    [
                        'tg_url' => esc_html__('#', 'genixcore'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // STYLE TAB
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

        <div class="project-details-info">
            <?php if (!empty($settings['project_title'])) : ?>
                <h4 class="title"><?php echo genix_kses($settings['project_title']); ?></h4>
            <?php endif; ?>
            <ul class="list-wrap">
                <?php foreach ($settings['item_lists'] as $item) : ?>
                    <li><?php echo genix_kses($item['repeater_title']); ?></li>
                <?php endforeach; ?>
                <li class="social">
                    <?php if (!empty($settings['social_title'])) : ?>
                        <span><?php echo genix_kses($settings['social_title']); ?></span>
                    <?php endif; ?>
                    <ul class="list-wrap">
                        <?php foreach ($settings['social_lists'] as $item) : ?>
                            <li><a href="<?php echo esc_url($item['tg_url']); ?>"><?php genix_render_icon($item, 'tg_icon', 'tg_selected_icon'); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>

<?php
    }
}

$widgets_manager->register(new TG_ProjectInfo());
