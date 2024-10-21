<?php

namespace GenixCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;

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
class TG_Fact extends Widget_Base
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
        return 'genix-fact';
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
        return __('Fact', 'genixcore');
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

        // Fact group
        $this->start_controls_section(
            'tg_fact',
            [
                'label' => esc_html__('Fact List', 'genixcore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'genixcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tg_design_style!' => ['layout-2', 'layout-5']
                ]
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
            'tg_fact_number',
            [
                'label' => esc_html__('Number', 'genixcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('235', 'genixcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tg_fact_number_cap',
            [
                'label' => esc_html__('Caption', 'genixcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('K', 'genixcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tg_fact_desc',
            [
                'label' => esc_html__('Fact Description', 'genixcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Best Award', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_fact_list',
            [
                'label' => esc_html__('Fact Lists', 'genixcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tg_fact_number' => esc_html__('235', 'genixcore'),
                        'tg_fact_desc' => esc_html__('Best Award', 'genixcore'),
                    ],
                    [
                        'tg_fact_number' => esc_html__('98', 'genixcore'),
                        'tg_fact_desc' => esc_html__('Happy Clients', 'genixcore'),
                    ],
                    [
                        'tg_fact_number' => esc_html__('458', 'genixcore'),
                        'tg_fact_desc' => esc_html__('Experienced', 'genixcore'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // Fact group 02
        $this->start_controls_section(
            'tg_fact2',
            [
                'label' => esc_html__('Fact List', 'genixcore'),
                'description' => esc_html__('Control all the style settings from Style tab', 'genixcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'tg_design_style' => ['layout-2', 'layout-5']
                ]
            ]
        );

        $repeater2 = new \Elementor\Repeater();

        $repeater2->add_control(
            'tg_fact_number2',
            [
                'label' => esc_html__('Number', 'genixcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('95', 'genixcore'),
                'label_block' => true,
            ]
        );

        $repeater2->add_control(
            'tg_fact_number_cap2',
            [
                'label' => esc_html__('Caption', 'genixcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('K', 'genixcore'),
                'label_block' => true,
            ]
        );

        $repeater2->add_control(
            'tg_fact_desc2',
            [
                'label' => esc_html__('Fact Description', 'genixcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Success Rate', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tg_fact_list2',
            [
                'label' => esc_html__('Fact Lists', 'genixcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater2->get_controls(),
                'default' => [
                    [
                        'tg_fact_number2' => esc_html__('95', 'genixcore'),
                        'tg_fact_desc2' => esc_html__('Success Rate', 'genixcore'),
                    ],
                    [
                        'tg_fact_number2' => esc_html__('55', 'genixcore'),
                        'tg_fact_desc2' => esc_html__('Complete Projects', 'genixcore'),
                    ],
                    [
                        'tg_fact_number2' => esc_html__('25', 'genixcore'),
                        'tg_fact_desc2' => esc_html__('Satisfied Clients', 'genixcore'),
                    ],
                ],
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

        <script>
            jQuery(document).ready(function($) {

                /*===========================================
                    =    		Odometer Active  	       =
                =============================================*/
                $('.odometer').appear(function(e) {
                    var odo = $(".odometer");
                    odo.each(function() {
                        var countNumber = $(this).attr("data-count");
                        $(this).html(countNumber);
                    });
                });

            });
        </script>

        <?php if ($settings['tg_design_style']  == 'layout-2') : ?>

            <div class="counter-item-wrap">
                <div class="row justify-content-center">
                    <?php foreach ($settings['tg_fact_list2'] as $item) : ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="counter-item-two">
                                <h2 class="count"><span class="odometer" data-count="<?php echo genix_kses($item['tg_fact_number2']); ?>"></span><?php echo esc_html($item['tg_fact_number_cap2']) ?></h2>
                                <?php if (!empty($item['tg_fact_desc2'])) : ?>
                                    <p><?php echo genix_kses($item['tg_fact_desc2']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-3') : ?>

            <div class="about-success-wrap">
                <ul class="list-wrap">
                    <?php foreach ($settings['tg_fact_list'] as $item) : ?>
                        <li>
                            <?php if (!empty($item['tg_icon']) || !empty($item['tg_selected_icon']['value'])) : ?>
                                <div class="icon">
                                    <?php genix_render_icon($item, 'tg_icon', 'tg_selected_icon'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="content">
                                <h2 class="count"><span class="odometer" data-count="<?php echo genix_kses($item['tg_fact_number']); ?>"></span><?php echo esc_html($item['tg_fact_number_cap']) ?></h2>
                                <?php if (!empty($item['tg_fact_desc'])) : ?>
                                    <p><?php echo genix_kses($item['tg_fact_desc']); ?></p>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-4') : ?>

            <div class="row justify-content-center">
                <?php foreach ($settings['tg_fact_list'] as $item) : ?>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="counter-item-three">
                            <?php if (!empty($item['tg_icon']) || !empty($item['tg_selected_icon']['value'])) : ?>
                                <div class="counter-icon">
                                    <?php genix_render_icon($item, 'tg_icon', 'tg_selected_icon'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="counter-content">
                                <h2 class="count"><span class="odometer" data-count="<?php echo genix_kses($item['tg_fact_number']); ?>"></span><?php echo esc_html($item['tg_fact_number_cap']) ?></h2>
                                <?php if (!empty($item['tg_fact_desc'])) : ?>
                                    <p><?php echo genix_kses($item['tg_fact_desc']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


        <?php elseif ($settings['tg_design_style']  == 'layout-5') : ?>

            <div class="row justify-content-center">
                <?php foreach ($settings['tg_fact_list2'] as $item) : ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="counter-item">
                            <h2 class="count"><span class="odometer" data-count="<?php echo genix_kses($item['tg_fact_number2']); ?>"></span><?php echo esc_html($item['tg_fact_number_cap2']) ?></h2>
                            <?php if (!empty($item['tg_fact_desc2'])) : ?>
                                <p><?php echo genix_kses($item['tg_fact_desc2']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        <?php else : ?>

            <div class="overview-content">
                <div class="content-bottom">
                    <ul class="list-wrap">
                        <?php foreach ($settings['tg_fact_list'] as $item) : ?>
                            <li>
                                <?php if (!empty($item['tg_icon']) || !empty($item['tg_selected_icon']['value'])) : ?>
                                    <div class="icon">
                                        <?php genix_render_icon($item, 'tg_icon', 'tg_selected_icon'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="content">
                                    <h2 class="count"><span class="odometer" data-count="<?php echo genix_kses($item['tg_fact_number']); ?>"></span><?php echo esc_html($item['tg_fact_number_cap']) ?></h2>
                                    <?php if (!empty($item['tg_fact_desc'])) : ?>
                                        <p><?php echo genix_kses($item['tg_fact_desc']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TG_Fact());
