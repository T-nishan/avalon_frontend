<?php
/**
 * GenixBGGradient control class
 *
 * @package GenixCore
 */
namespace Elementor;
namespace GenixCore\Elementor\Controls;

use Elementor\Group_Control_Base;
use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || die();

/**
 * Class Group_Control_GenixBGGradient
 * @package GenixCore\Elementor\Controls
 */
class Group_Control_GenixBGGradient extends Group_Control_Base {

    /**
     * Fields.
     *
     * Holds all the background control fields.
     *
     * @access protected
     * @static
     *
     * @var array Background control fields.
     */
    protected static $fields;

    /**
     * Get background control type.
     *
     * Retrieve the control type, in this case `text_color`.
     *
     * @since 1.0.0
     * @access public
     * @static
     *
     * @return string Control type.
     */
    public static function get_type() {
        return 'genixbggradient';
    }

    /**
     * Init fields.
     *
     * Initialize background control fields.
     *
     * @since 1.2.2
     * @access public
     *
     * @return array Control fields.
     */
    public function init_fields() {
        $fields = [];

        $fields['color_type'] = [
            'label' => _x( 'Select Color Type', 'Background Control', 'genixcore' ),
            'description' => _x( 'Gradient color not work editor mode. If you set gradient color please view the result live preview page.', 'Background Control', 'genixcore' ),
            'type' => Controls_Manager::CHOOSE,
            'label_block' => false,
            'render_type' => 'ui',
            'options' => [
                'classic' => [
                    'title' => _x( 'Solid', 'Color Control', 'genixcore' ),
                    'icon' => 'eicon-paint-brush',
                ],
                'gradient' => [
                    'title' => _x( 'Gradient', 'Color Control', 'genixcore' ),
                    'icon' => 'eicon-barcode',
                ],
            ],
            'default' => 'classic'
        ];

        $fields['color'] = [
            'label' => _x( 'Color', 'Background Control', 'genixcore' ),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'title' => _x( 'Start Color', 'Background Control', 'genixcore' ),
            'selectors' => [
                '{{SELECTOR}}' => 'background: {{VALUE}};',
            ],
            'condition' => [
                'color_type' => [ 'classic', 'gradient' ],
            ],
        ];

        $fields['color_stop'] = [
            'label' => _x( 'Location', 'Background Control', 'genixcore' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ '%' ],
            'default' => [
                'unit' => '%',
                'size' => 0,
            ],
            'render_type' => 'ui',
            'condition' => [
                'color_type' => [ 'gradient' ],
            ],
            'of_type' => 'gradient',
        ];

        $fields['color_b'] = [
            'label' => _x( 'Second Color', 'Background Control', 'genixcore' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#f2295b',
            'render_type' => 'ui',
            'condition' => [
                'color_type' => [ 'gradient' ],
            ],
            'of_type' => 'gradient',
        ];

        $fields['color_b_stop'] = [
            'label' => _x( 'Location', 'Background Control', 'genixcore' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ '%' ],
            'default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'render_type' => 'ui',
            'condition' => [
                'color_type' => [ 'gradient' ],
            ],
            'of_type' => 'gradient',
        ];

        $fields['gradient_type'] = [
            'label' => _x( 'Type', 'Background Control', 'genixcore' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'linear' => _x( 'Linear', 'Background Control', 'genixcore' ),
                'radial' => _x( 'Radial', 'Background Control', 'genixcore' ),
            ],
            'default' => 'linear',
            'render_type' => 'ui',
            'condition' => [
                'color_type' => [ 'gradient' ],
            ],
            'of_type' => 'gradient',
        ];

        $fields['gradient_angle'] = [
            'label' => _x( 'Angle', 'Background Control', 'genixcore' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'deg' ],
            'default' => [
                'unit' => 'deg',
                'size' => 180,
            ],
            'range' => [
                'deg' => [
                    'step' => 10,
                ],
            ],
            'selectors' => [
                '{{SELECTOR}}' => 'background-image: linear-gradient({{SIZE}}{{UNIT}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
            ],
            'condition' => [
                'color_type' => [ 'gradient' ],
                'gradient_type' => 'linear',
            ],
            'of_type' => 'gradient',
        ];

        $fields['gradient_position'] = [
            'label' => _x( 'Position', 'Background Control', 'genixcore' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'center center' => _x( 'Center Center', 'Background Control', 'genixcore' ),
                'center left' => _x( 'Center Left', 'Background Control', 'genixcore' ),
                'center right' => _x( 'Center Right', 'Background Control', 'genixcore' ),
                'top center' => _x( 'Top Center', 'Background Control', 'genixcore' ),
                'top left' => _x( 'Top Left', 'Background Control', 'genixcore' ),
                'top right' => _x( 'Top Right', 'Background Control', 'genixcore' ),
                'bottom center' => _x( 'Bottom Center', 'Background Control', 'genixcore' ),
                'bottom left' => _x( 'Bottom Left', 'Background Control', 'genixcore' ),
                'bottom right' => _x( 'Bottom Right', 'Background Control', 'genixcore' ),
            ],
            'default' => 'center center',
            'selectors' => [
                '{{SELECTOR}}' => 'background-image: radial-gradient(at {{VALUE}}, {{color.VALUE}} {{color_stop.SIZE}}{{color_stop.UNIT}}, {{color_b.VALUE}} {{color_b_stop.SIZE}}{{color_b_stop.UNIT}})',
            ],
            'condition' => [
                'color_type' => [ 'gradient' ],
                'gradient_type' => 'radial',
            ],
            'of_type' => 'gradient',
        ];

        return $fields;
    }

    /**
     * Get child default args.
     *
     * Retrieve the default arguments for all the child controls for a specific group
     * control.
     *
     * @since 1.2.2
     * @access protected
     *
     * @return array Default arguments for all the child controls.
     */
    protected function get_child_default_args() {
        return [
            'types' => [ 'classic', 'gradient' ],
        ];
    }

    /**
     * Filter fields.
     *
     * Filter which controls to display, using `include`, `exclude`, `condition`
     * and `of_type` arguments.
     *
     * @since 1.2.2
     * @access protected
     *
     * @return array Control fields.
     */
    protected function filter_fields() {
        $fields = parent::filter_fields();

        $args = $this->get_args();

        foreach ( $fields as &$field ) {
            if ( isset( $field['of_type'] ) && ! in_array( $field['of_type'], $args['types'] ) ) {
                unset( $field );
            }
        }

        return $fields;
    }

    /**
     * Get default options.
     *
     * Retrieve the default options of the background control. Used to return the
     * default options while initializing the background control.
     *
     * @since 1.9.0
     * @access protected
     *
     * @return array Default background control options.
     */
    protected function get_default_options() {
        return [
            'popover' => false,
        ];
    }
}
