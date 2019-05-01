<?php
// if (is_file(BEAU_PLUGIN_DIR . '/classes/class-msp-importer.php')) {
//     include(BEAU_PLUGIN_DIR . '/classes/class-msp-importer.php');
// }

    function ocdi_import_files() {
        $demo_directory_path = BEAU_PLUGIN_DIR . '/demo-data/';
        $directories = glob($demo_directory_path . '/*' , GLOB_ONLYDIR);
		
        foreach ($directories as $dir_) {
            $import_arr[] = array(
                'import_file_name'          => basename($dir_),
                'categories'                => array( 'BeboStore' ),
                'local_import_file'         => $dir_ . '/content.xml',
                'local_import_widget_file'  => $dir_ . '/widgets.json',
                'import_preview_image_url'  => plugin_dir_url( $dir_  . '/screen-image.png' )  . 'screen-image.png',
                'local_import_redux'        => array(
                    array(
                        'file_path'   => $dir_ . '/theme-options.json',
                        'option_name' => 'beau_option',
                    ),
                ),
            );
        }
        return $import_arr;
    }
    add_filter( 'pt-ocdi/import_files', 'ocdi_import_files', 100, 20 );

    function after_import( $selected_import ) {
        $demo_directory_path = BEAU_PLUGIN_DIR . '/demo-data/';

        /**
         * Setting Menu
         */        
        $wbc_menu_array = array('Store', 'Library','Classic','Hightlight','Author','Story','Publisher');
        
        if (in_array($selected_import['import_file_name'], $wbc_menu_array)){
            $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
            $small_menu = get_term_by('name', 'Small menus', 'nav_menu');
            $mobile_menu = get_term_by('name', 'Main Menu', 'nav_menu');
            $menu_arr = array();
            if (isset($main_menu->term_id)) {
                $menu_arr['main-menu'] = $main_menu->term_id;
                $menu_arr['sticker-menu'] = $main_menu->term_id;
            }
            if (isset($small_menu->term_id)) {
                $menu_arr['small-menu'] = $small_menu->term_id;
            }
            if (isset($mobile_menu->term_id)) {
                $menu_arr['mobile-menu'] = $mobile_menu->term_id;
            }
            if (count($menu_arr)){
                set_theme_mod('nav_menu_locations', $menu_arr);
            }
        }


        /**
         * Setting Home Page
         */
        $wbc_home_pages = array(
            'Store' => 'Homepage 07',
            'Library' => 'Homepage 06',
            'Classic' => 'Homepage 01',
            'Hightlight' => 'Home hightlight',
            'Author' => 'Home author',
            'Story' => 'Home story',
            'Publisher' => 'Home publisher',
        );
        // if (array_key_exists($selected_import['import_file_name'], $wbc_menu_array)) {
            $page = get_page_by_title($wbc_home_pages[$selected_import['import_file_name']]);
            if (isset($page->ID)) {
                update_option('page_on_front', $page->ID);
                update_option('show_on_front', 'page');
            }
        // }


        /**
         * Setting WooCommerce
         */
        if (class_exists('WooCommerce')) {
            // Set WooCommerce Pages
            $shoppage = get_page_by_title('Shop');
            $cartpage = get_page_by_title('Cart');
            $checkoutpage = get_page_by_title('Checkout');
            $myaccountpage = get_page_by_title('My Account');
            if ($shoppage->ID && (get_option( 'woocommerce_shop_page_id' ) == '' || get_option( 'woocommerce_shop_page_id' ) == null)) {
                update_option('woocommerce_shop_page_id', $shoppage->ID);
                // Shop Page
            }
            if ($cartpage->ID && (get_option( 'woocommerce_cart_page_id' ) == '' || get_option( 'woocommerce_cart_page_id' ) == null)) {
                update_option('woocommerce_cart_page_id', $cartpage->ID);
                // Cart Page
            }
            if ($checkoutpage->ID && (get_option( 'woocommerce_checkout_page_id' ) == '' || get_option( 'woocommerce_checkout_page_id' ) == null)) {
                update_option('woocommerce_checkout_page_id', $checkoutpage->ID);
                // Cart Page
            }
            if ($myaccountpage->ID && (get_option( 'woocommerce_myaccount_page_id' ) == '' || get_option( 'woocommerce_myaccount_page_id' ) == null)) {
                update_option('woocommerce_myaccount_page_id', $myaccountpage->ID);
                // Cart Page
            }
        }
        
        
        /**
         * Import slider(s) for the current demo being imported
         */

		 
        if (class_exists('RevSlider')) {
            $wbc_sliders_array = array(
                'Store' => 'slide-home-7.zip', //Set slider zip name
                'Library' => 'slide-home-06.zip', //Set slider zip name
                'Classic' => 'slide-home-1.zip', //Set slider zip name
                'Hightlight' => 'slide-home-2.zip', //Set slider zip name
                'Author' => 'slide-home-4.zip', //Set slider zip name
                'Story' => 'slide-home-3.zip', //Set slider zip name
                'Publisher' => 'slide-home-05.zip', //Set slider zip name
            );

            // if (array_key_exists($selected_import['import_file_name'], $wbc_sliders_array)) {
                $wbc_slider_import = $selected_import['import_file_name'] . '/' . $wbc_sliders_array[$selected_import['import_file_name']];

                if (file_exists($demo_directory_path . $wbc_slider_import)) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost(true, true, $demo_directory_path . $wbc_slider_import);
                    echo 'Slider processed';
                }
            // }
        }
    }
    add_action( 'pt-ocdi/after_import', 'after_import', 10, 2 );
