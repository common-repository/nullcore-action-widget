<?php

/*
Plugin Name: NullCore Action Widget
Plugin URI: http://www.nullcore.nl/239/nullcore-action-widget/
Description: Adds a widget to your sidebar with an action hook.
Version: 1.0
Author: Giovanni Wassen
Author URI: http://www.nullcore.nl/
*/

/*  Copyright 2010  Giovanni Wassen  (email : extatix@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// register widget
add_action('widgets_init', create_function('', 'return register_widget("NullCore_Action_Widget");'));

// the widget
class NullCore_Action_Widget extends WP_Widget {

	function NullCore_Action_Widget() {
		$widget_ops = array('classname' => 'nullcoreactionwidget', 'description' => __( "Add a custom action hook to your widget areas") );
		$this->WP_Widget('actionwidget', __('NullCore Action Widget'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		
		$title = apply_filters('widget_title', $instance['title']);
				
		echo $before_widget;
		echo $before_title . $title . $after_title;
		do_action($instance['action']);
		echo $after_widget;
	}

	function form( $instance ) {
	
	$instance = wp_parse_args( (array)$instance, array(
			'title' 				=> __('Action Widget', 'nullcore'), 
			'action' 				=> __('test_hook', 'nullcore'),
			) );
		?>
		<p><label for="<?php echo $this->get_field_id('title') ?>"><?php _e('Title:', 'nullcore') ?></label><br />
		<input type="text" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" size="33" value="<?php echo strip_tags($instance['title']) ?>" />
		</p>
		<p><label for="<?php echo $this->get_field_id('action') ?>"><?php _e('Action Hook:', 'nullcore') ?></label><br />
		<input type="text" id="<?php echo $this->get_field_id('action') ?>" name="<?php echo $this->get_field_name('action') ?>" size="33" value="<?php echo strip_tags($instance['action']) ?>" />
		</p>
		<?php
		
	}

	function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			
			$instance['title'] = strip_tags($new_instance['title']);
			$instance['action'] = strip_tags($new_instance['action']);
			
			return $instance;

	}

}