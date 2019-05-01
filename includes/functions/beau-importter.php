<?php

if (is_file(BEAU_PLUGIN_DIR . '/classes/class-msp-importer.php')) {
    include(BEAU_PLUGIN_DIR . '/classes/class-msp-importer.php');
}
if (!function_exists('beau_after_import_settings')) {

    function beau_after_import_settings($demo_active_import, $demo_directory_path) {
        reset($demo_active_import);

        //clean up default widget data

        $widgets = get_option('sidebars_widgets');
        foreach ($widgets as $key => $value) {
            $widgets[$key] = array();
        }
        update_option('sidebars_widgets', $widgets, true);

        // key
        $current_key = key($demo_active_import);
        /**
         * Setting Menu
         */
        // echo $demo_active_import[$current_key]['directory'];
        $wbc_menu_array = array('Store', 'Library','Classic','Hightlight','Author','Story','Publisher');
        if (isset($demo_active_import[$current_key]['directory']) &&
                !empty($demo_active_import[$current_key]['directory']) &&
                in_array($demo_active_import[$current_key]['directory'], $wbc_menu_array)) {
            $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
            $small_menu = get_term_by('name', 'Small menus', 'nav_menu');
            $mobile_menu = get_term_by('name', 'Main Menu', 'nav_menu');
            // echo "Menu";
            $menu_arr = array();
            if (isset($main_menu->term_id)) {
                $menu_arr['main-menu'] = $main_menu->term_id;
                $menu_arr['sticker-menu'] = $main_menu->term_id;
                // $menu_arr['mobile-menu'] = $main_menu->term_id;
                // set_theme_mod('nav_menu_locations', array(
                //     'main-menu' => $main_menu->term_id,
                //     'small-menu' => (isset($small_menu->term_id) ? $small_menu->term_id : $main_menu->term_id),
                //     'mobile-menu' => (isset($mobile_menu->term_id) ? $mobile_menu->term_id : $main_menu->term_id),
                //     'sticker-menu' => (isset($mobile_menu->term_id) ? $mobile_menu->term_id : $main_menu->term_id),
                //     )
                // );
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
        if (isset($demo_active_import[$current_key]['directory']) && !empty($demo_active_import[$current_key]['directory']) && array_key_exists($demo_active_import[$current_key]['directory'], $wbc_home_pages)) {
            $page = get_page_by_title($wbc_home_pages[$demo_active_import[$current_key]['directory']]);
            if (isset($page->ID)) {
                update_option('page_on_front', $page->ID);
                update_option('show_on_front', 'page');
            }
        }


        if (class_exists('WooCommerce')) {
            // Set WooCommerce Pages
            $shoppage = get_page_by_title('Shop');
            $cartpage = get_page_by_title('Cart');
            $checkoutpage = get_page_by_title('Checkout');
            $myaccountpage = get_page_by_title('My Account');
            if ($shoppage->ID) {
                update_option('woocommerce_shop_page_id', $shoppage->ID);
                // Shop Page
            }
            if ($cartpage->ID) {
                update_option('woocommerce_cart_page_id', $cartpage->ID);
                // Cart Page
            }
            if ($checkoutpage->ID) {
                update_option('woocommerce_checkout_page_id', $checkoutpage->ID);
                // Cart Page
            }
            if ($myaccountpage->ID) {
                update_option('woocommerce_myaccount_page_id', $myaccountpage->ID);
                // Cart Page
            }
        }

        /* *************************************************************************
         * Import slider(s) for the current demo being imported
         * *********************************************************************** */

		 
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

            if (isset($demo_active_import[$current_key]['directory']) && !empty($demo_active_import[$current_key]['directory']) && array_key_exists($demo_active_import[$current_key]['directory'], $wbc_sliders_array)) {
                $wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

                if (file_exists($demo_directory_path . $wbc_slider_import)) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost(true, true, $demo_directory_path . $wbc_slider_import);
                }
            }
        }
		
    }

    add_action('wbc_importer_after_content_import', 'beau_after_import_settings', 10, 2);
}
// End Setting Menu, Slider and Hompage
if (!function_exists('beautheme_demo_directory_path')) {

    function beautheme_demo_directory_path($demo_directory_path) {
        $demo_directory_path = BEAU_PLUGIN_DIR . '/demo-data/';
        return $demo_directory_path;
    }

    add_filter('wbc_importer_dir_path', 'beautheme_demo_directory_path');
}
