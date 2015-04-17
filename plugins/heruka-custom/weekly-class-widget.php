<?php class WeeklyClass_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'weekly_classes', // Base ID
			__('Weekly Classes', 'text_domain'), // Name
			array( 'description' => __( 'Widget displaying weekly classes by location or weekday', 'text_domain' ), ) // Args
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
		$location = $instance['location'];
		$weekday = $instance['weekday'];
		$map = $instance['map'];
		$accordion = $instance['accordion'];
		$note = $instance['note'];

		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'];
			if ($accordion) {
				echo '<a href="/meditation-classes/">';
			}
			echo $title;
			if ($accordion) {
				echo '</a>';
			}
			echo $args['after_title'];
		}
		if ($weekday && $location) {
    		echo '<div class="show-classes"><a class="show-weekday selected" href="#">Weekday</a><a class="show-location" href="#">Location</a></div>';
  		}

		if( $weekday AND $weekday == '1' ) {
			include 'class-weekday.php';
		}
		if( $location AND $location == '1' ) {
			include 'class-location.php';
		}

		if ($weekday && $location) {
    		echo '<div class="find-out-more"><a href="/meditation-classes/">Find out more about weekly classes ></a></div>';
  		}

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
		$location = esc_attr($instance['location']);
		$weekday = esc_attr($instance['weekday']);
		$map = esc_attr($instance['map']);
		$accordion = esc_attr($instance['accordion']);
		$note = esc_attr($instance['note']);
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('location'); ?>" name="<?php echo $this->get_field_name('location'); ?>" type="checkbox" value="1" <?php checked( '1', $location ); ?> />
			<label for="<?php echo $this->get_field_id('location'); ?>">Show locations</label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('weekday'); ?>" name="<?php echo $this->get_field_name('weekday'); ?>" type="checkbox" value="1" <?php checked( '1', $weekday ); ?> />
			<label for="<?php echo $this->get_field_id('weekday'); ?>">Show weekdays</label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('map'); ?>" name="<?php echo $this->get_field_name('map'); ?>" type="checkbox" value="1" <?php checked( '1', $map ); ?> />
			<label for="<?php echo $this->get_field_id('map'); ?>">Show map</label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('accordion'); ?>" name="<?php echo $this->get_field_name('accordion'); ?>" type="checkbox" value="1" <?php checked( '1', $accordion ); ?> />
			<label for="<?php echo $this->get_field_id('accordion'); ?>">Accordion</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'note' ); ?>">Note:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'note' ); ?>" name="<?php echo $this->get_field_name( 'note' ); ?>" type="text" value="<?php echo esc_attr( $note ); ?>">
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
		$instance['location'] = strip_tags($new_instance['location']);
		$instance['weekday'] = strip_tags($new_instance['weekday']);
		$instance['map'] = strip_tags($new_instance['map']);
		$instance['accordion'] = strip_tags($new_instance['accordion']);
		$instance['note'] = $new_instance['note'];
		return $instance;
	}
} ?>