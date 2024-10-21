<?php

namespace GenixCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Gerow Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Genix_FAQ extends Widget_Base
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
        return 'genix-faq';
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
        return __('FAQ', 'genixcore');
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
                ],
                'default' => 'layout-1',
            ]
        );

        $this->end_controls_section();

        // Accordion
        $this->start_controls_section(
            '_accordion',
            [
                'label' => esc_html__('Accordion', 'genixcore'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'accordion_title',
            [
                'label' => esc_html__('Accordion Title', 'genixcore'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Interdum et malesuada fames ac ante ipsum', 'genixcore'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'accordion_description',
            [
                'label' => esc_html__('Description', 'genixcore'),
                'description' => genix_get_allowed_html_desc('intermediate'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Ever find yourself staring at your computer screen a good consulting slogan to coind yourself sta your computer screen a good consulting slogan.', 'genixcore'),
            ]
        );

        $this->add_control(
            'accordions',
            [
                'label' => esc_html__('Repeater Accordion', 'genixcore'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'accordion_title' => esc_html__('Interdum et malesuada fames ac ante ipsum', 'genixcore'),
                    ],
                    [
                        'accordion_title' => esc_html__('Do you recommend any WordPress theme?', 'genixcore'),
                    ],
                    [
                        'accordion_title' => esc_html__('How to install Elementor Addons Plugin?', 'genixcore'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();


        // Style
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

            <div class="accordion-wrap-two">
                <div class="accordion" id="accordionExample">

                    <?php foreach ($settings['accordions'] as $index => $item) :
                        $collapsed = ($index == '0') ? '' : 'collapsed';
                        $aria_expanded = ($index == '0') ? "true" : "false";
                        $show = ($index == '0') ? "show" : "";
                    ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne-<?php echo esc_attr($index); ?>">
                                <button class="accordion-button <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>" aria-expanded="true" aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
                                    <?php echo esc_html($item['accordion_title']); ?>
                                </button>
                            </h2>
                            <div id="collapseOne-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="headingOne-<?php echo esc_attr($index); ?>" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p><?php echo genix_kses($item['accordion_description']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php else : ?>

            <div class="faq-content">
                <div class="accordion-wrap">
                    <div class="accordion" id="accordionExample">

                        <?php foreach ($settings['accordions'] as $index => $item) :
                            $collapsed = ($index == '0') ? '' : 'collapsed';
                            $aria_expanded = ($index == '0') ? "true" : "false";
                            $show = ($index == '0') ? "show" : "";
                        ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne-<?php echo esc_attr($index); ?>">
                                    <button class="accordion-button <?php echo esc_attr($collapsed); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo esc_attr($index); ?>" aria-expanded="true" aria-controls="collapseOne-<?php echo esc_attr($index); ?>">
                                        <?php echo esc_html($item['accordion_title']); ?>
                                    </button>
                                </h2>
                                <div id="collapseOne-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="headingOne-<?php echo esc_attr($index); ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p><?php echo genix_kses($item['accordion_description']); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        <?php endif; ?>
<?php
    }
}

$widgets_manager->register(new Genix_FAQ());
