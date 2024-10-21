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
class TG_ServicesSidebar extends Widget_Base
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
        return 'tg-services-sidebar';
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
        return __('Services Sidebar', 'genixcore');
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
                'label' => esc_html__('Widget Layout', 'genixcore'),
            ]
        );

        $this->add_control(
            'tg_design_style',
            [
                'label' => esc_html__('Select Widget', 'genixcore'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Services List', 'genixcore'),
                    'layout-2' => esc_html__('Brochure Download', 'genixcore'),
                    'layout-3' => esc_html__('Contact Number', 'genixcore'),
                    'layout-4' => esc_html__('Quote Form', 'genixcore'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Widget Group
        $this->start_controls_section(
            '__tg_widget_group',
            [
                'label' => esc_html__('Widget Group', 'genixcore'),
            ]
        );

        $this->add_control(
            'widget_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__('Title', 'genixcore'),
                'default' => esc_html__('Our Services', 'genixcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'show_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'genixcore'),
                'description' => esc_html__('Leave blank or enter -1 for all.', 'genixcore'),
                'type' => Controls_Manager::NUMBER,
                'default' => '5',
                'condition' => [
                    'tg_design_style' => 'layout-1'
                ]
            ]
        );

        $this->add_control(
            'tg_description',
            [
                'label' => esc_html__('Description', 'genixcore'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('when an unknown printer took ga lley offer typey anddey.', 'genixcore'),
                'condition' => [
                    'tg_design_style' => 'layout-2'
                ]
            ]
        );

        $this->add_control(
            'widget_phone',
            [
                'label' => esc_html__('Phone Number', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('+91 705 2101 786', 'genixcore'),
                'condition' => [
                    'tg_design_style' => 'layout-3'
                ]
            ]
        );

        $this->add_control(
            'quote_shortcode',
            [
                'label' => __('Short Code', 'genixcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__('[Add your short code]', 'genixcore'),
                'label_block' => true,
                'default' => __('', 'genixcore'),
                'condition' => [
                    'tg_design_style' => 'layout-4'
                ]
            ]
        );

        $this->end_controls_section();

        // Button Group
        $this->start_controls_section(
            '__tg_button_group',
            [
                'label' => esc_html__('Download Button', 'genixcore'),
                'condition' => [
                    'tg_design_style' => 'layout-2'
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'button_text',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__('Button Text', 'genixcore'),
                'default' => esc_html__('PDF. Download', 'genixcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'download_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => esc_html__('Download File URL', 'genixcore'),
                'default' => esc_html__('#', 'genixcore'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'item_lists',
            [
                'label' => esc_html__('Button Lists', 'genixcore'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'button_text' => esc_html__('PDF. Download', 'genixcore'),
                    ],
                    [
                        'button_text' => esc_html__('DOC. Download', 'genixcore'),
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

            <div class="services-widget">
                <?php if(!empty($settings['widget_title'])) : ?>
                    <h4 class="sw-title"><?php echo esc_html($settings['widget_title']); ?></h4>
                <?php endif; ?>
                <div class="services-brochure-wrap">
                    <?php if(!empty($settings['tg_description'])) : ?>
                        <p><?php echo genix_kses($settings['tg_description']); ?></p>
                    <?php endif; ?>

                    <?php foreach ($settings['item_lists'] as $item) : ?>
                        <a href="<?php echo esc_url($item['download_url']) ?>" target="_blank" download class="download-btn"><i class="far fa-file-pdf"></i><?php echo genix_kses($item['button_text']); ?></a>
                    <?php endforeach; ?>

                </div>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-3') : ?>

            <div class="services-widget services-sidebar-contact">
                <?php if(!empty($settings['widget_title'])) : ?>
                    <h4 class="title"><?php echo esc_html($settings['widget_title']); ?></h4>
                <?php endif; ?>
                <a href="tel:<?php echo esc_attr($settings['widget_phone']); ?>"><i class="flaticon-phone-call"></i> <?php echo esc_html($settings['widget_phone']); ?></a>
            </div>

        <?php elseif ($settings['tg_design_style']  == 'layout-4') : ?>

            <div class="services-widget">
                <?php if(!empty($settings['widget_title'])) : ?>
                    <h4 class="sw-title"><?php echo esc_html($settings['widget_title']); ?></h4>
                <?php endif; ?>
                <?php echo do_shortcode($settings['quote_shortcode']); ?>
            </div>

        <?php else : ?>

            <div class="services-widget">
                <?php if(!empty($settings['widget_title'])) : ?>
                    <h4 class="sw-title"><?php echo esc_html($settings['widget_title']); ?></h4>
                <?php endif; ?>
                <div class="services-cat-list">
                    <ul class="list-wrap">
                        <?php
                        $args = new \WP_Query(array(
                            'post_type' => 'services',
                            'post_status' => 'publish',
                            'orderby' => 'date',
                            'posts_per_page' => $settings['show_per_page'],
                        ));

                        /* Start the Loop */
                        while ($args->have_posts()) : $args->the_post();
                        ?>
                            <li>
                                <a href="<?php the_permalink(); ?>">
                                    <span><?php the_title(); ?></span>
                                    <i class="flaticon-right-arrow"></i>
                                </a>
                            </li>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </ul>
                </div>
            </div>

        <?php endif; ?>

<?php
    }
}

$widgets_manager->register(new TG_ServicesSidebar());
