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
class TG_Advanced_Tab extends Widget_Base
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
        return 'pricing-tab';
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
        return __('Pricing Tab', 'genixcore');
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

        // ADVANCE TAB
        $this->start_controls_section(
            '_section_price_tabs',
            [
                'label' => esc_html__('Pricing Tabs', 'genixcore'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'monthly_text',
            [
                'label' => esc_html__('Monthly', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Monthly', 'genixcore'),
                'dynamic' => [
                    'active' => true
                ],
            ]
        );

        $this->add_control(
            'yearly_text',
            [
                'label' => esc_html__('Yearly', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Yearly', 'genixcore'),
                'dynamic' => [
                    'active' => true
                ],
            ]
        );

        $this->end_controls_section();

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
                    =    		pricing Active  	   =
                =============================================*/
                $(".pricing-tab-switcher, .tab-btn").on("click", function() {
                    $(".pricing-tab-switcher, .tab-btn").toggleClass("active"),
                        $(".pricing-tab").toggleClass("seleceted"),
                        $(".pricing-price, .pricing-price-two").toggleClass("change-subs-duration");
                });

            });
        </script>
        <div class="pricing-item-wrap">
            <div class="pricing-tab">
                <span class="tab-btn monthly_tab_title"><?php echo esc_html($settings['monthly_text']) ?></span>
                <span class="pricing-tab-switcher"></span>
                <span class="tab-btn annual_tab_title"><?php echo esc_html($settings['yearly_text']) ?></span>
            </div>
        </div>

<?php
    }
}
$widgets_manager->register(new TG_Advanced_Tab());
