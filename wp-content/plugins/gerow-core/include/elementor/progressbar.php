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
class TG_Progressbar extends Widget_Base
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
        return 'tg-progressbar';
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
        return __('Progressbar', 'genixcore');
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
            'genix_design_style',
            [
                'label' => esc_html__('Select Layout', 'genixcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'genixcore'),
                    'layout-2' => esc_html__('Layout 2', 'genixcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // _tg_progressbar
        $this->start_controls_section(
            '_tg_progressbar',
            [
                'label' => esc_html__('Progressbar', 'genixcore'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'progress_title',
            [
                'label' => esc_html__('Title', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Consulting', 'genixcore'),
                'placeholder' => esc_html__('Type Title', 'genixcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'progress_percentage',
            [
                'label' => esc_html__('Percentage', 'genixcore'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .progress-bar' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tg_progress_list',
            [
                'label' => esc_html__('Progress Lists', 'genixcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'progress_title' => esc_html__('Consulting', 'genixcore'),
                    ],
                    [
                        'progress_title' => esc_html__('Investment', 'genixcore'),
                    ],
                    [
                        'progress_title' => esc_html__('Business', 'genixcore'),
                    ],
                ],
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


        <?php if ($settings['genix_design_style'] === 'layout-2') : ?>

            <script>
                jQuery(document).ready(function($) {

                    /*===========================================
                        =          easyPieChart Active       =
                    =============================================*/
                    function easyPieChart() {
                        $('.circle-item').on('inview', function(event, isInView) {
                            if (isInView) {
                                $('.chart').easyPieChart({
                                    scaleLength: 0,
                                    lineWidth: 10,
                                    trackWidth: 10,
                                    size: 160,
                                    rotate: 360,
                                    animate: 3000,
                                    trackColor: '#2A3E66',
                                    barColor: '#0055FF',
                                });
                            }
                        });
                    }
                    easyPieChart();

                });
            </script>

            <div class="choose-circle-wrap">
                <?php foreach ($settings['tg_progress_list'] as $item) : ?>
                    <div class="circle-item">
                        <div class="chart" data-percent="<?php echo esc_attr($item['progress_percentage']['size']); ?>">
                            <div class="circle-content">
                                <span class="percentage"><?php echo esc_attr($item['progress_percentage']['size']); ?>%</span>
                                <p><?php echo esc_html($item['progress_title']) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php else : ?>

            <div class="progress-wrap">
                <?php foreach ($settings['tg_progress_list'] as $key => $item) : ?>
                    <div class="progress-item">
                        <h6 class="title"><?php echo esc_html($item['progress_title']) ?></h6>
                        <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo esc_attr($item['progress_percentage']['size']); ?>" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar wow slideInLeft" data-wow-delay=".<?php echo esc_html($key) + 1; ?>s" style="width: <?php echo esc_attr($item['progress_percentage']['size']); ?>%">
                                <span><?php echo esc_attr($item['progress_percentage']['size']); ?>%</span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TG_Progressbar());
