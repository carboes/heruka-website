<?php class HomeItem_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'homeitem', // Base ID
			__('HomeItem', 'text_domain'), // Name
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
		echo '<a href="'.get_permalink( (int)$instance['postid'] ).'">';
		echo get_the_post_thumbnail( (int)$instance['postid'], 'thumb-large' );
		echo '<div class="text-outer"><div class="text">';
		if ( ! empty( $title ) ) {
			//echo $args['before_title'] . $title . $args['after_title'];
			echo '<h5>' . $title . '</h5>';
		}
		echo '<p>'.$instance['description'].'</p>';
		echo '</div></div>';
		//echo '<a href="'.get_permalink( (int)$instance['postid'] ).'" class="more-info">Find out more</a>';
		echo '</a>';
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
			<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'description:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" type="text" value="<?php echo esc_attr( $instance['description'] ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'postid' ); ?>"><?php _e( 'postid:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'postid' ); ?>" name="<?php echo $this->get_field_name( 'postid' ); ?>" type="text" value="<?php echo esc_attr( $instance['postid'] ); ?>">
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
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['postid'] = ( ! empty( $new_instance['postid'] ) ) ? strip_tags( $new_instance['postid'] ) : '';
		return $instance;
	}
} ?>