<?php class Newsletter_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'newsletter', // Base ID
			__('Newsletter', 'text_domain'), // Name
			array( 'description' => __( 'iContact Widget', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		?>
			<?php include 'newsletter-content.php'; ?>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'successurl' ); ?>"><?php _e( 'Success URL:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'successurl' ); ?>" name="<?php echo $this->get_field_name( 'successurl' ); ?>" type="text" value="<?php echo esc_attr( $instance['successurl'] ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'errorurl' ); ?>"><?php _e( 'Error URL:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'errorurl' ); ?>" name="<?php echo $this->get_field_name( 'errorurl' ); ?>" type="text" value="<?php echo esc_attr( $instance['errorurl'] ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['successurl'] = ( ! empty( $new_instance['successurl'] ) ) ? strip_tags( $new_instance['successurl'] ) : '';
		$instance['errorurl'] = ( ! empty( $new_instance['errorurl'] ) ) ? strip_tags( $new_instance['errorurl'] ) : '';
		return $instance;
	}
} ?>