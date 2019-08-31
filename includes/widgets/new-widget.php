<?php
class Dahz_Framework_Widget_Product_Category extends WP_Widget {

	/**
	 * Setup widget: Name, base ID
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce de-widget widget_product_category';
			$this->widget_description = esc_html__( 'Display a list of product categories from your store.', 'pabu' );
			$this->widget_id          = 'dahz_woocommerce_product_category';
			$this->widget_name        = esc_html__( 'Dahz - Product Category', 'pabu' );
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'std'   => esc_html__( 'Product Categories', 'pabu' ),
					'label' => esc_html__( 'Title', 'pabu' ),
				),
				'category_ids' => array(
					'type'  => 'text',
					'std'   => esc_html__( '', 'pabu' ),
					'label' => esc_html__( 'Category slug(s). Separated by comma (,)', 'pabu' ),
				),
				'display_as' => array(
					'type'  => 'select',
					'std'   => 'logo',
					'label' => esc_html__( 'Display as', 'pabu' ),
					'options' => array(
						'style_1' => esc_html__( 'Style 1', 'pabu' ),
						'style_2' => esc_html__( 'Style 2', 'pabu' ),
					),
				),
			);

			parent::__construct();
	}

	/**
	 * Show widget
	 */

	public function widget( $args, $instance ) {

		if ( $this->get_cached_widget( $args ) ) {
      return;
    }

    ob_start();

    $category_ids = ! empty( $instance['category_ids'] ) ? $instance['category_ids'] : $this->settings['category_ids']['std'];
    $display_as   = ! empty( $instance['display_as'] ) ? $instance['display_as'] : $this->settings['display_as']['std'];

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
      <ul data-display="%1$s">
        %2$s
      </ul>
      ',
      esc_attr( $display_as ),
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
add_action( 'widgets_init', 'dahz_woocommerce_product_category' );
function dahz_woocommerce_product_category() {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		register_widget('dahz_woocommerce_product_category');
	}
}
