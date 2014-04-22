<?php
if( !class_exists('CI_Portfolio_Widget ') ):
class CI_Portfolio_Widget extends WP_Widget {

	function CI_Portfolio_Widget(){
		$widget_ops = array('description' => __('Displays a single Portfolio item', 'ci_theme'));
		$control_ops = array('width' => 300, 'height' => 400);
		parent::WP_Widget(false, $name='-= CI Portfolio =-', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance) {
		global $post;
		$old_post = $post;
				
		extract($args);
		$ci_title = apply_filters( 'widget_title', empty( $instance['ci_title'] ) ? '' : $instance['ci_title'], $instance, $this->id_base );
		$ci_post_id = $instance['ci_post_id'];

		$post = get_post($ci_post_id);

		echo $before_widget;
		echo '<div class="ci_widget_portfolio">';

		if($post)
		{
			setup_postdata($post);
			
			if ($ci_title) 
				echo $before_title . $ci_title . $after_title;
			else 
				echo $before_title . '<a href="'.get_permalink().'">'. get_the_title() . '</a>' . $after_title;

			echo '<a href="'.get_permalink().'">'.get_the_post_thumbnail().'</a>';
			the_excerpt();
		}

		echo "</div>";
		echo $after_widget;

		$post = $old_post;
		setup_postdata($post);
	}
	
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['ci_title'] = stripslashes($new_instance['ci_title']);
		$instance['ci_post_id'] = intval($new_instance['ci_post_id']);
		return $instance;
	}
	 
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array('ci_post_id' => 0, 'ci_title'=>'') );
		$ci_post_id = intval($instance['ci_post_id']);
		$ci_title = htmlspecialchars($instance['ci_title']);
		echo '<p><label for="'.$this->get_field_id('ci_title').'">' . __('Title (leave empty to use the portfolio\'s title):', 'ci_theme') . '</label><input id="' . $this->get_field_id('ci_title') . '" name="' . $this->get_field_name('ci_title') . '" type="text" value="' . esc_attr($ci_title) . '" class="widefat" /></p>';
		echo '<p><label for="'.$this->get_field_id('ci_post_id').'">'.__('Portfolio item to show:', 'ci_theme').'</label></p>';
		wp_dropdown_posts( array(
			'post_type' => 'portfolio',
			'selected' => $ci_post_id,
			'id' => $this->get_field_id('ci_post_id')
		), $this->get_field_name('ci_post_id'));
	}

} // class

register_widget('CI_Portfolio_Widget');

endif; // !class_exists
?>
