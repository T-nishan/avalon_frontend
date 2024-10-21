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
class TG_IconBox extends Widget_Base
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
        return 'tg-iconbox';
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
        return __('Icon Box', 'genixcore');
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
            'tg_iconbox_group',
            [
                'label' => esc_html__('IconBox Group', 'genixcore'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        if (genix_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tg_icon',
                [
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

        $repeater->add_control(
            'tg_title',
            [
                'label' => esc_html__('Title', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Growing Business', 'genixcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tg_description',
            [
                'label' => esc_html__('Description', 'genixcore'),
                'description' => genix_get_allowed_html_desc('intermediate'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Finance helps you to convert into a strategic asset get.', 'genixcore'),
            ]
        );

        $this->add_control(
            'item_lists',
            [
                'label' => esc_html__('Item Box Lists', 'genixcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tg_title' => esc_html__('Growing Business', 'genixcore'),
                    ],
                    [
                        'tg_title' => esc_html__('Finance Investment', 'genixcore'),
                    ],
                    [
                        'tg_title' => esc_html__('Tax Advisory', 'genixcore'),
                    ],
                ],
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

?>

        <?php if ($settings['tg_design_style']  == 'layout-2') : ?>

            <div class="about-list-three">
                <ul class="list-wrap">
                    <?php foreach ($settings['item_lists'] as $item) : ?>
                        <li>
                            <?php if (!empty($item['tg_icon']) || !empty($item['tg_selected_icon']['value'])) : ?>
                                <div class="icon">
                                    <?php genix_render_icon($item, 'tg_icon', 'tg_selected_icon'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="content">
                                <h2 class="title"><?php echo genix_kses($item['tg_title']); ?></h2>
                                <?php if (!empty($item['tg_description'])) : ?>
                                    <p><?php echo genix_kses($item['tg_description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-3') : ?>

            <div class="row justify-content-center">
                <?php foreach ($settings['item_lists'] as $item) : ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="features-item-four">
                            <?php if (!empty($item['tg_icon']) || !empty($item['tg_selected_icon']['value'])) : ?>
                                <div class="features-icon-four">
                                    <?php genix_render_icon($item, 'tg_icon', 'tg_selected_icon'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="features-content-four">
                                <h4 class="title"><?php echo genix_kses($item['tg_title']); ?></h4>
                                <?php if (!empty($item['tg_description'])) : ?>
                                    <p><?php echo genix_kses($item['tg_description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-4') : ?>

            <div class="row justify-content-center">
                <?php foreach ($settings['item_lists'] as $item) : ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="features-item">
                            <div class="features-content">
                                <div class="content-top">
                                    <?php if (!empty($item['tg_icon']) || !empty($item['tg_selected_icon']['value'])) : ?>
                                        <div class="icon">
                                            <?php genix_render_icon($item, 'tg_icon', 'tg_selected_icon'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <h2 class="title"><?php echo genix_kses($item['tg_title']); ?></h2>
                                </div>
                                <?php if (!empty($item['tg_description'])) : ?>
                                    <p><?php echo genix_kses($item['tg_description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-5') : ?>

            <div class="services-details-list-two">
                <ul class="list-wrap">
                    <?php foreach ($settings['item_lists'] as $item) : ?>
                        <li>
                            <?php if (!empty($item['tg_icon']) || !empty($item['tg_selected_icon']['value'])) : ?>
                                <div class="icon">
                                    <?php genix_render_icon($item, 'tg_icon', 'tg_selected_icon'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="content">
                                <h5 class="title"><?php echo genix_kses($item['tg_title']); ?></h5>
                                <?php if (!empty($item['tg_description'])) : ?>
                                    <p><?php echo genix_kses($item['tg_description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        <?php else : ?>

            <div class="row justify-content-center">
                <?php foreach ($settings['item_lists'] as $item) : ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="features-item-two">
                            <?php if (!empty($item['tg_icon']) || !empty($item['tg_selected_icon']['value'])) : ?>
                                <div class="features-icon-two">
                                    <?php genix_render_icon($item, 'tg_icon', 'tg_selected_icon'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="features-content-two">
                                <h4 class="title"><?php echo genix_kses($item['tg_title']); ?></h4>
                                <?php if (!empty($item['tg_description'])) : ?>
                                    <p><?php echo genix_kses($item['tg_description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TG_IconBox());
