<?php class PaypalAnalytics_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'paypal_analytics', // Base ID
			__('Paypal Analytics', 'text_domain'), // Name
			array( 'description' => __( '...', 'text_domain' ), ) // Args
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
		$auth_token = $instance['auth_token'];
		$tracking_code = $instance['tracking_code'];

		echo $args['before_widget'];
		//if ( ! empty( $title ) )
		//	echo $args['before_title'] . $title . $args['after_title'];
		include 'paypal-received.php';
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
		$auth_token = $instance[ 'auth_token' ]; //B-qEV38GpAHyUrQv_-nNUW8Y_g8G6DbH9LJivVU7D1lkyPwViF5tRAxGdiO
		$tracking_code = $instance[ 'tracking_code' ]; //UA-XXXXX-1

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'auth_token' ); ?>"><?php _e( 'Paypal Authentication Token:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'auth_token' ); ?>" name="<?php echo $this->get_field_name( 'auth_token' ); ?>" type="text" value="<?php echo esc_attr( $auth_token ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'tracking_code' ); ?>"><?php _e( 'Google Analytics Tracking Code:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'tracking_code' ); ?>" name="<?php echo $this->get_field_name( 'tracking_code' ); ?>" type="text" value="<?php echo esc_attr( $tracking_code ); ?>">
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
		$instance['auth_token'] = ( ! empty( $new_instance['auth_token'] ) ) ? strip_tags( $new_instance['auth_token'] ) : '';
		$instance['tracking_code'] = ( ! empty( $new_instance['tracking_code'] ) ) ? strip_tags( $new_instance['tracking_code'] ) : '';
		
		return $instance;
	}
} ?>