<?php

if ( !class_exists( 'DahzExtender_Widget' ) ) {

	Class DahzExtender_Widget {
		
		public $path = '';

		function __construct() {

			add_action( 'widgets_init', array( $this, 'dahz_load_widget' ) );

			add_action( 'dahzextender_module_widget_init', array( $this, 'dahz_framework_widget_init' ) );

		}

		public function dahz_framework_widget_init( $path ) {
			
			$this->path = $path;
			
		}

		function dahz_load_widget() {

			if( class_exists( 'WC_Widget' ) ){
				
				include( $this->path . '/class-dahz-framework-widget-product-category.php' );
				
				register_widget( 'Dahz_Framework_Widget_Product_Category' );
				
			}

		}

	}

	new DahzExtender_Widget();

}
