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
class TG_InfoBox extends Widget_Base
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
        return 'team-info';
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
        return __('Team Info', 'genixcore');
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

        $repeater = new \Elementor\Repeater();

        if (genix_is_elementor_version('<', '2.6.0')) {
            $repeater->add_control(
                'tg_icon',
                [
                    'show_label' => false,
                    'type' => Controls_Manager::ICON,
                    'label_block' => true,
                    'default' => 'fa fa-envelope',
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
                        'value' => 'fas fa-envelope',
                        'library' => 'solid',
                    ],
                ]
            );
        }

        $repeater->add_control(
            'repeater_title',
            [
                'label' => esc_html__('Title', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('+123 8989 444', 'genixcore'),
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
                        'repeater_title' => esc_html__('+123 8989 444', 'genixcore'),
                    ],
                    [
                        'repeater_title' => esc_html__('info@gmail.com', 'genixcore'),
                    ],
                    [
                        'repeater_title' => esc_html__('256 Avenue, Mark Street, Newyork City', 'genixcore'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // _tg_button
        $this->start_controls_section(
            '_tg_btn_section',
            [
                'label' => esc_html__('Button', 'genixcore'),
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Contact With Me', 'genixcore'),
                'title' => esc_html__('Enter button text', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'btn_url',
            [
                'label' => esc_html__('Button URL', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('#', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'share_text',
            [
                'label' => esc_html__('Share Text', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Share', 'genixcore'),
                'title' => esc_html__('Enter button text', 'genixcore'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'share_url',
            [
                'label' => esc_html__('Share URL', 'genixcore'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('#', 'genixcore'),
                'label_block' => true,
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

        <div class="team-details-info">
            <ul class="list-wrap">
                <?php foreach ($settings['item_lists'] as $item) : ?>
                    <li>
                        <?php if (!empty($item['tg_icon']) || !empty($item['tg_selected_icon']['value'])) : ?>
                            <?php genix_render_icon($item, 'tg_icon', 'tg_selected_icon'); ?>
                        <?php endif; ?>
                        <?php echo genix_kses($item['repeater_title']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="td-info-bottom">

                <?php if (!empty($settings['btn_url'])) : ?>
                    <a href="<?php echo esc_url($settings['btn_url']); ?>" class="btn btn-three"><?php echo esc_html($settings['btn_text']); ?></a>
                <?php endif; ?>

                <?php if (!empty($settings['share_url'])) : ?>
                    <a href="<?php echo esc_url($settings['share_url']); ?>" class="share-btn">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/share.svg" alt="<?php echo esc_attr__('Icon', 'genixcore') ?>"><?php echo esc_html($settings['share_text']); ?>
                    </a>
                <?php endif; ?>

            </div>
        </div>

<?php
    }
}

$widgets_manager->register(new TG_InfoBox());
