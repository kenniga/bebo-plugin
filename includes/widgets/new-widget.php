<?php
class sf_product_category_Widget extends WP_Widget {

	/**
	 * Setup widget: Name, base ID
	 */
	function __construct() {
		$tpwidget_options = array(
			'classname' => 'sf_product_category_widget', //ID của widget
			'description' => __('This show list of Sebodo Category Widget','bebostore')
		);
		parent::__construct('sf_product_category_widget', 'Sebodo Category Widget', $tpwidget_options);
	}

	/**
	 * Create option for widget
	 */
	function form( $instance ) {

		$default = array(
			'title' => __('Title','bebostore'),
			'booknumber' => '',
		);

		$instance = wp_parse_args( (array) $instance, $default);

		$title = esc_attr( $instance['title'] );
		$category_ids = esc_attr( $instance['category_ids'] );

		//Show options for admin panel
		echo "<p>".__("Title", 'bebostore')."<input type='text' class='widefat' name='".$this->get_field_name('title')."' value='".$title."' /></p>";
		echo "<p>".__("Product Categories",'bebostore')."<input type='text' class='widefat' name='".$this->get_field_name('category_ids')."' value='".$category_ids."'></p>";
	}

	/**
	 * save widget form
	 */

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['category_ids'] = strip_tags($new_instance['category_ids']);
	}

	/**
	 * Show widget
	 */

	function widget( $args, $instance ) {

		extract( $args );
		$title 	 = apply_filters( 'widget_title', $instance['title'] );
		$booknumber = $instance['booknumber'];

    ob_start();

    $category_ids = ! empty( $instance['category_ids'] ) ? $instance['category_ids'] : $this->settings['category_ids']['std'];

    $category_ids = explode( ',', $category_ids );

    $this->widget_start( $args, $instance );

    $category_html = '';

    foreach( $category_ids as $key => $category_id ) {

      $category = get_term_by( 'slug', $category_id, 'product_cat' );

      if( $category ){

        $category_url = get_term_link( $category->term_id );

        $image_id  = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );

        $category_image = wp_get_attachment_image( $image_id, 'medium' );

        $category_html .= sprintf(
          '
          <li class="dont know">
            <a href="%1$s">
              %2$s
              <span>
                <h4>%3$s</h4>
              </span>
            </a>
          </li>
          ',
          esc_url( $category_url ),
          $category_image ,
          esc_html( $category->name )
        );

      }

    }

    echo sprintf(
      '
      <ul>
        %1$s
      </ul>
      ',
      $category_html

    );

    $this->widget_end( $args );

    $content = ob_get_clean();

    echo( $content );

    $this->cache_widget( $args, $content );
	}
}

/*
 * Create widget item
 */
add_action( 'widgets_init', 'sf_product_category_widget' );
function sf_product_category_widget() {
	register_widget('sf_product_category_Widget');
}
