<?php
/*
Plugin Name: Singular Widget
Description: Displays a content in the widget.
Author: Takayuki Miyauchi
Version: nightly
Author URI: https://miya.io/
Plugin URI: https://github.com/miya0001/singular-widget
*/

require_once( dirname( __FILE__ ) . '/vendor/autoload.php' );

add_action( 'init', function() {
	$plugin_slug = plugin_basename( __FILE__ );
	$gh_user = 'miya0001';
	$gh_repo = 'singular-widget';

	// Activate automatic update.
	new Miya\WP\GH_Auto_Updater( $plugin_slug, $gh_user, $gh_repo );
} );

class Singular_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array(
			'description' => 'Displays a post or a page.',
		);

		$control_ops = array('width' => 400, 'height' => 350);

		parent::__construct(
			false,
			'Page Widget',
			$widget_ops,
			$control_ops
		);
	}

	public function form($instance)
	{
		// outputs the options form on admin
		$postid = ( isset( $instance['postid'] ) ) ? $instance['postid'] : '';
		$pid = $this->get_field_id( 'postid' );
		$pf = $this->get_field_name( 'postid' );

		if ( empty( $instance['title'] ) ) {
			$instance['title'] = '';
		}

		echo '<p>';
		echo 'URL: ';
		echo "<br />";
		echo "<input type=\"text\" class=\"widefat\" id=\"{$pid}\" name=\"{$pf}\" value=\"{$postid}\" />";
		echo '</p>';
		echo sprintf(
			'<input id="%1$s" name="%2$s" type="hidden" value="%3$s">',
			esc_attr( $this->get_field_id( 'title' ) ),
			esc_attr( $this->get_field_name( 'title' ) ),
			esc_attr( $instance['title'] )
		);
	}

	public function update( $new_instance, $old_instance )
	{
		$pid = url_to_postid( $new_instance['postid'] );
		$p = get_post( $pid );
		$new_instance['title'] = $p->post_title;

		return $new_instance;
	}

	public function widget($args, $instance)
	{
		$pid = null;
		if ( isset( $instance['postid'] ) && preg_match( "/^[0-9]+$/", $instance['postid'] ) ) {
			$pid = $instance['postid'];
		} elseif ( isset( $instance['postid'] ) && $instance['postid'] ) {
			$pid = url_to_postid($instance['postid']);
		}

		if ( ! $pid ) {
			return '';
		}

		$p = get_post( $pid );

		echo $args['before_widget'];

		$class = array(
			$p->post_type . '-' . $pid,
			$p->post_type,
			'singular-widget'
		);

		$post_thumb = get_the_post_thumbnail( $pid, 'post-thumbnail' );
		$tpl = $this->template();

		$tpl = str_replace( '%post_title%', esc_html( $p->post_title ), $tpl );
		$tpl = str_replace( '%post_thumb%', $post_thumb, $tpl );
		$tpl = str_replace( '%post_url%', esc_url( get_permalink( $pid ) ), $tpl );
		$tpl = str_replace( '%post_excerpt%', esc_html( $p->post_excerpt ), $tpl );
		$tpl = str_replace( '%class%', join( ' ', $class ), $tpl );
		echo $tpl;
		echo $args['after_widget'];
	}

	private function template()
	{
		$html = '<section class="%class%"><div class="singular-widget-container">';
		$html .= '<div class="post-thumbnail"><a href="%post_url%">%post_thumb%</a></div>';
		$html .= '<div class="post-title"><a href="%post_url%">%post_title%</a></div>';
		$html .= '<div class="post-excerpt" style="font-size: 90%; color: #555555;">%post_excerpt%</div>';
		$html .= '</div></section>';

		return apply_filters( "singular_widget_template", $html );
	}
}

add_action( 'widgets_init', function() {
	return register_widget( 'Singular_Widget' );
} );
