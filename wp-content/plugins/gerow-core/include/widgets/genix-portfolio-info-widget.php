<?php
	/**
	 * GenixCore Project Info Widget
	 *
	 *
	 * @author 		ThemeGenix
	 * @category 	Widgets
	 * @package 	GenixCore/Widgets
	 * @version 	1.0.0
	 * @extends 	WP_Widget
	 */
	add_action('widgets_init', 'genix_project_info_widget');
	function genix_project_info_widget() {
		register_widget('genix_project_info_widget');
	}


	class genix_project_info_widget  extends WP_Widget{

		public function __construct(){
			parent::__construct('genix_project_info_widget',esc_html__('Genix Project Info','genixcore'),array(
				'description' => esc_html__('Genix Project Info Widget','genixcore'),
			));
		}

		public function widget($args,$instance){
			extract($args);
			extract($instance);
		 	print $before_widget;

		 	if ( ! empty( $title ) ) {
				print $before_title . apply_filters( 'widget_title', $title ) . $after_title;
			}
		?>


			<div class="sidebar_info_widget">
                <div class="genix_sidebar_info">
                   <ul class="sidebar__contact__info">

                    <?php
                    $project_info_repeater = function_exists('get_field') ? get_field('project_info_repeater') : '';
                    if( have_rows('project_info_repeater') ):
                        while( have_rows('project_info_repeater') ) : the_row();
                        $project_info_label = get_sub_field('project_info_label');
                        $project_info_name = get_sub_field('project_info_name');
                    ?>

                        <li><span><?php echo wp_kses_post($project_info_label); ?> : </span> <?php echo wp_kses_post($project_info_name); ?></li>

                        <?php endwhile; ?>

                    <?php else : ?>
                        <p>Please add your project info list from project post.</p>
                    <?php endif; ?>


			      </ul>
                </div>
            </div>


	    	<?php print $after_widget; ?>

		<?php
		}


		/**
		 * widget function.
		 *
		 * @see WP_Widget
		 * @access public
		 * @param array $instance
		 * @return void
		 */
		public function form($instance){
			$title  = isset($instance['title'])? $instance['title']:'';
			$genix_form_shortcode  = isset($instance['genix_form_shortcode'])? $instance['genix_form_shortcode']:'';
			?>
			<p>
				<label for="title"><?php esc_html_e('Title:','genixcore'); ?></label>
			</p>
			<input type="text" id="<?php print esc_attr($this->get_field_id('title')); ?>"  class="widefat" name="<?php print esc_attr($this->get_field_name('title')); ?>" value="<?php print esc_attr($title); ?>">

			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance = array();
			$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			return $instance;
		}
	}