<?php

add_action('widgets_init', 'mayosis_woo_product_tags');

function mayosis_woo_product_tags()
{
	register_widget('mayosis_woo_product_tags');
}

class mayosis_woo_product_tags extends WP_Widget {
	
	function __construct()
	{
		$widget_ops = array('classname' => 'mayosis_woo_product_tags', 'description' => esc_html__('Displays download item features. Used in Single Download Sidebar','mayosis-core') );
		$control_ops = array('id_base' => 'mayosis_woo_product_tags');
		parent::__construct('mayosis_woo_product_tags', esc_html__('Mayosis Woo Product Tag Widget','mayosis-core'), $widget_ops, $control_ops);
		
	}
	function widget($args, $instance)
	{
		extract($args);
	
		$title = $instance['title'];
		echo $before_widget;
		?>
		<?php global $wp_query;
		$postID = $wp_query->post->ID; ?>
		<div class="sidebar-theme">
		<div class="single-product-widget product--tag--widget">
			<h4 class="widget-title"><i class="zil zi-tag" aria-hidden="true"></i> <?php echo esc_html($title); ?> </h4>
			<div class="tag_widget_single">
			<?php $product_tags = get_the_term_list( get_the_ID(), 'product_tag', '<ul><li>', '</li><li>', '</li></ul>', _x(' ', '', 'mayosis-core' ), '' ); ?>
				<?php echo $product_tags; ?>
			</div>
	</div>
	</div>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		return $instance;
	}
	
	function form($instance)
	{
		$defaults = array('title' => esc_html__('Product Tags','mayosis-core') );
		$instance = wp_parse_args((array) $instance, $defaults); 
		 
?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title','mayosis-core');?>:</label>
			<input id="<?php echo esc_attr($this->get_field_id('title')); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
		</p>
		
		<?php }
	}
