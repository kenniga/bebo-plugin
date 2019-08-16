<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if( !class_exists( 'ReduxFramework' ) ) {
        if (file_exists( BEAU_PLUGIN_DIR. '/libs/ReduxCore/framework.php')) {
            require_once( BEAU_PLUGIN_DIR. '/libs/ReduxCore/framework.php' );
        }
    }
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // var_dump($mailchimp_list);

    $beau_option_perpage = array();
    // global $beau_perpage_global;
    for($i=-1; $i<=50; $i++){
      $beau_option_perpage[] = $i;
    }

    //Columns
    $beau_column = array();
    for($i=1; $i<=6; $i++){
        $beau_column[$i] = $i;
    }

    $mailchimp_list = array();

    //Header array
    $custom_header = array(
        'default' => 'Header default menu on top',
        'menuhumberger' => 'Header only menu humberger',
    );

    //Footer array
    $custom_footer = array(
        'default'       => 'Footer default',
        'home7'         => 'Footer home 7',
    );

    //Archive page
    $beau_archive = array(
        'default'                       => 'Default',
        'one-column-full'               => 'One column full',
        'one-column-leftsidebar'        => 'One column left sidebar',
        'one-column-rightsidebar'       => 'One column right sidebar',
        'two-columns-leftsidebar'       => 'Two columns left sidebar',
        'two-columns-rightsidebar'      => 'Two columns right sidebar',
        'three-columns-rightsidebar'    => 'Three columns right sidebar',
        'three-columns-masory'          => 'Three columns masory',
        'three-columns-full'            => 'Three columns full',
    );

    //Get all page
    $allPage = array();
    $args = array(
        'sort_order' => 'asc',
        'sort_column' => 'post_title',
        'post_type' => 'page',
        'post_status' => 'publish'
    );
    $pages = get_pages($args);
    wp_reset_postdata();
    foreach ($pages as $page) {
        $allPage[$page->post_name] = $page->post_title;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "beau_option";


    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => false,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'beau-theme-setting' ),
        'page_title'           => __( 'Theme Options', 'beau-theme-setting' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.beautheme.com/bebo-store/',
        'title' => __( 'Documentation', 'bebostore' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'http://support.beautheme.com/',
        'title' => __( 'Support', 'bebostore' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/beautheme',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/beautheme2014',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://behance.net/beautheme',
        'title' => 'Find us on behance',
        'icon'  => 'el el-behance'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://dribbble.com/beauvn',
        'title' => 'Find us on dribbble',
        'icon'  => 'el el-dribbble'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        //$args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'bebostore' ), $v );
    } else {
        //$args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'bebostore' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>Thanks for used our theme <a href="http://beautheme.com" target="_blank  ">Beau Theme</a>.</p>', 'bebostore' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'bebostore' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'bebostore' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'bebostore' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'bebostore' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'bebostore' );
    Redux::setHelpSidebar( $opt_name, $content );



    // -> START General option
    Redux::setSection( $opt_name, array(
        'title'            => __( 'General setting', 'bebostore' ),
        'id'               => 'general',
        'desc'             => __( 'These are something setting for all page!', 'bebostore' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-cogs',
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'General options', 'bebostore' ),
        'id'               => 'general-options',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
             array(
                'id'       => 'logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Upload logo', 'bebostore' ),
                'subtitle' => __( 'Upload any image using the WordPress native uploader', 'bebostore' ),
                'default'  => array( 'url' => 'http://s.wordpress.org/style/images/codeispoetry.png' ),
            ),
             array(
                'id'       => 'logo-mobile',
                'type'     => 'media',
                'url'      => true,
                'title'    => __( 'Upload logo for mobile', 'bebostore' ),
                'subtitle' => __( 'Upload any image using the WordPress native uploader', 'bebostore' ),
                'default'  => array( 'url' => 'http://s.wordpress.org/style/images/codeispoetry.png' ),
            ),
            array(
                'id'       => 'admin-email',
                'type'     => 'text',
                'title'    => __( 'Admin email', 'bebostore' ),
                'placeholder'=>'support@beautheme.com'
            ),
            array(
                'id'      => 'author-page',
                'type'    => 'select',
                'title'   => __( 'Your author page', 'bebostore' ),
                'desc'    => __( 'Chose your author page for author fillter.', 'bebostore' ),
                'options' => $allPage,
            ),
            array(
                'id'        => 'author-sort',
                'type'      => 'button_set',
                'title'     => __( 'Author book group by', 'bebostore' ),
                'options'   => array(
                    '0'     => __( 'First name', 'bebostore' ),
                    '1'     => __( 'Last name', 'bebostore' ),
                ),
                'default'   => '0'
            ),
            array(
                'id'       => 'hotline',
                'type'     => 'text',
                'title'    => __( 'Hotline', 'bebostore' ),
                'placeholder'=>''
            ),
            array(
                'id'        => 'disable_search',
                'type'      => 'button_set',
                'title'     => __( 'Disable search', 'bebostore' ),
                'options'   => array(
                    '1'     => 'No',
                    '2'     => 'Yes',
                ),
                'default'   => '1'
            ),
            array(
                'id'        => 'enable_back_to_top',
                'type'      => 'button_set',
                'title'     => __( 'Enable back to top', 'bebostore' ),
                'options'   => array(
                    '1'     => 'No',
                    '2'     => 'Yes',
                ),
                'default'   => '1'
            ),
            array(
                'id'        => 'enable_author_ajax',
                'type'      => 'button_set',
                'title'     => __( 'Enable single page', 'bebostore' ),
                'options'   => array(
                    '1'     => 'No',
                    '2'     => 'Yes',
                ),
                'default'   => '2',
                'desc'    => __( 'Default using ajax quick view detail author', 'bebostore' ),
            ),
            array(
                'id'        => 'disable_3d',
                'type'      => 'button_set',
                'title'     => __( 'Disable 3d flip book', 'bebostore' ),
                'options'   => array(
                    '1'     => 'No',
                    '2'     => 'Yes',
                ),
                'default'   => '1'
            ),
        )
    ) );
    // -> START blog option
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Shop setting', 'bebostore' ),
        'id'               => 'shop',
        'customizer_width' => '500px',
        'icon'             => 'el el-shopping-cart',
    ) );
    // Chon kieu trang archive
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Page shop options', 'bebostore' ),
        'id'               => 'shop-options',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'style-shop',
                'type'     => 'select',
                'title'    => __( 'Select style Shop', 'bebostore' ),
                'subtitle' => __( 'Chose your style of shop page.</br>(If choose Full Grid please select display 5 column in shop page.)', 'bebostore' ),
                'options'  => array( 'shop-style-1' => 'Full Grid', 'shop-style-2' => 'Shop List'),
                'default'  => 'shop-style-1',
            ),
            array(
                'id'       => 'style-shop-details',
                'type'     => 'select',
                'title'    => __( 'Select style Shop details', 'bebostore' ),
                'subtitle' => __( 'Chose your style of shop details.</br>(If choose Full Grid please select display 5 column in shop page.)', 'bebostore' ),
                'options'  => array( 'shop-style-1' => 'Full Grid', 'shop-style-2' => 'Shop List', 'shop-style-3' => 'Shop special'),
                'default'  => 'shop-style-1',
            ),

            array(
                'id'       => 'flip-book',
                'type'     => 'button_set',
                'title'    => __( 'Show flip book?', 'bebostore' ),
                'subtitle' => __( 'Do you want to show flip book in details product?', 'bebostore' ),
                'options'  => array(
                    'Yes' => 'Yes',
                    'No' => 'No'
                ),
            ),


            array(
                'id'        => 'enabled-cart-header',
                'type'      => 'button_set',
                'title'     => __( 'Show cart on header', 'bebostore' ),
                'options'   => array(
                    '1'     => 'No',
                    '2'     => 'Yes',
                ),
                'default'   => '2'
            ),
        )
    ) );

    // Chon kieu trang archive
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Woocommerce details product options', 'bebostore' ),
        'id'               => 'woocommerce-options',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'        => 'enabled-wishlist',
                'type'      => 'button_set',
                'title'     => __( 'Enabled wishlist', 'bebostore' ),
                'options'   => array(
                    '1'     => 'No',
                    '2'     => 'Yes',
                ),
                'default'   => '2'
            ),

            array(
                'id'        => 'enabled-show-price',
                'type'      => 'button_set',
                'title'     => __( 'Show price product', 'bebostore' ),
                'options'   => array(
                    '1'     => 'No',
                    '2'     => 'Yes',
                ),
                'default'   => '2'
            ),

            array(
                'id'        => 'enabled-add-to-cart',
                'type'      => 'button_set',
                'title'     => __( 'Show add to cart', 'bebostore' ),
                'options'   => array(
                    '1'     => 'No',
                    '2'     => 'Yes',
                ),
                'default'   => '2'
            ),
        )
    ) );

    // -> START blog option
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blog setting', 'bebostore' ),
        'id'               => 'blog',
        'customizer_width' => '500px',
        'icon'             => 'el el-blogger',
    ) );

// Chon kieu trang archive
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Blogs options', 'bebostore' ),
        'id'               => 'blog-options',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'archive-type',
                'type'     => 'select',
                'title'    => __( 'Select Option', 'bebostore' ),
                'subtitle' => __( 'Chose your default type of archive blog page', 'bebostore' ),
                // 'desc'     => __( 'We have ? blog archive type', 'bebostore' ),
                //Must provide ke array(
                'options'  => $beau_archive,
                'default'  => '1'
            ),
            array(
                'id'       => 'single-page',
                'type'     => 'select',
                'title'    => __( 'Chose single type', 'bebostore' ),
                'subtitle' => __( 'Chose your custom single', 'bebostore' ),
                // 'desc'     => __( 'We have ? blog archive type', 'bebostore' ),
                //Must provide key => value pairs for select options
                'options'  => array('detail' => 'Default none sidebar', 'detailsidebar' =>'Content with sidebar'),
            ),
        )
    ) );

//Social setting
// -> START blog option
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Social setting', 'bebostore' ),
        'id'               => 'social',
        'customizer_width' => '500px',
        'icon'             => 'el el-thumbs-up',
    ) );



    Redux::setSection( $opt_name, array(
        'title'            => __( 'Social link', 'bebostore' ),
        'id'               => 'social-link',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'beau-facebook',
                'type'     => 'text',
                'title'    => __( 'Your facebook url', 'bebostore' ),
            ),
            array(
                'id'       => 'beau-twitter',
                'type'     => 'text',
                'title'    => __( 'Your twitter url', 'bebostore' ),
            ),
            array(
                'id'       => 'beau-google-plus',
                'type'     => 'text',
                'title'    => __( 'Your google plus url', 'bebostore' ),
            ),
            array(
                'id'       => 'beau-pinterest',
                'type'     => 'text',
                'title'    => __( 'Your pinterest url', 'bebostore' ),
            ),
            array(
                'id'       => 'beau-linkedin',
                'type'     => 'text',
                'title'    => __( 'Your linkedin url', 'bebostore' ),
            ),
            array(
                'id'       => 'beau-instagram',
                'type'     => 'text',
                'title'    => __( 'Your instagram url', 'bebostore' ),
            ),
            array(
                'id'       => 'beau-github',
                'type'     => 'text',
                'title'    => __( 'Your github url', 'bebostore' ),
            ),
            array(
                'id'       => 'beau-behance',
                'type'     => 'text',
                'title'    => __( 'Your behance url', 'bebostore' ),
            ),
            array(
                'id'       => 'beau-tumblr',
                'type'     => 'text',
                'title'    => __( 'Your tumblr url', 'bebostore' ),
            ),
            array(
                'id'       => 'beau-soundcloud',
                'type'     => 'text',
                'title'    => __( 'Your soundcloud url', 'bebostore' ),
            ),
            array(
                'id'       => 'beau-dribbble',
                'type'     => 'text',
                'title'    => __( 'Your dribbble url', 'bebostore' ),
            ),
            array(
                'id'       => 'beau-rss',
                'type'     => 'text',
                'title'    => __( 'Your rss url', 'bebostore' ),
            ),

        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => __( 'Social to show', 'bebostore' ),
        'id'               => 'social-link-show',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'show-social-link',
                'type'     => 'select',
                'multi'    => true,
                'title'    => __( 'Social to show', 'bebostore' ),
                'subtitle' => __( 'Select your social link you want to show', 'bebostore' ),
                'desc'     => __( 'Chose your social you want to show in your website.', 'bebostore' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    'facebook'      => 'Facebook',
                    'twitter'       => 'Twitter',
                    'google-plus'   => 'Google Plus',
                    'pinterest'     => 'Pinterest',
                    'linkedin'      => 'Linked in',
                    'instagram'     => 'Instagram',
                    'github'        => 'GitHub',
                    'behance'       => 'Behance',
                    'tumblr'        => 'Tumblr',
                    'soundcloud'    => 'Sound cloud',
                    'dribbble'      => 'Dribbble',
                    'rss'           => 'Rss',
                ),
                'default'  => array( 'facebook', 'twitter','google-plus' )
            ),

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Social API', 'bebostore' ),
        'id'               => 'social-api',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'            => 'google_map_api',
                'type'          => 'text',
                'title'         => esc_html__( 'Google map api Key', 'bebostore' ),
                'description'   => esc_html__('You can get it on developer google page','bebostore')
            ),
            array(
                'id'       => 'twitter-api',
                'type'     => 'text',
                'title'    => __( 'Your twitter API', 'bebostore' ),
            ),
            array(
                'id'       => 'twitter-user',
                'type'     => 'text',
                'title'    => __( 'Your twitter user', 'bebostore' ),
            ),
            array(
                'id'       => 'instagram-user',
                'type'     => 'text',
                'title'    => __( 'Your instagram user', 'bebostore' ),
            ),
            array(
                'id'       => 'facebook-api',
                'type'     => 'text',
                'title'    => __( 'Your facebook API', 'bebostore' ),
            ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'            => __( 'Typo setting', 'bebostore' ),
        'id'               => 'typo',
        'customizer_width' => '500px',
        'icon'             => 'el el-font',
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Your custom typo', 'bebostore' ),
        'id'               => 'typo-custom',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'body-text',
                'type'     => 'typography',
                'title'    => __( 'Change Element Font Times New Roman -> ', 'bebostore' ),
                // 'compiler' => array('body *'),
                'output'   => array('.form-subcribe .subcribe-form-view .title-subcribe strong,.book-info span.book-price,.subcribe-half .subcribe-message-title .subcribe-title,.sc-woocategory .category-name, .sc-single-book .book-info span.book-name,header.header-two .nav-right .list-right-nav li,header.header-two .search-navigation-full .search form input,.box-meet-author .author-info .desc-name .name-author,.book-search-head,.section-blog-detail .blogs-detail .news-title,.section-blog-detail .nav-detail .next-back,.book-about-author .about-post-author span.author-name,.book-comment-form .comment-reply-title,.book-contact .book-form-contact .book-address .book-place-name,.blog-items .news-description .news-title,.testimonial-message,.testimonial-author .author-name,.slogan-text,.fillter-alphabeta ul li,.left-full .list-full-categories .items-category a span.cat-title,.list-name-author .list-author-name li a,.hot-author .author-name,.service-item .service-title,.shopping-cart .shop_table tbody tr td.product-price ,.book-cover-description .book-cover-descirption .book-description,.list-store .item-store .store-title,.shopping-cart .shop_table tbody tr td.product-subtotal, .shopping-cart .shop_table tfoot span'),
                'subtitle' => __( 'Specify the body font properties.', 'bebostore' ),
                'google'   => false,
                'fonts'    => array(
                    'goudy-heavyface' => 'Goudy Heavy Face'
                )
            ),
            array(
                'id'       => 'body-text-merriweather',
                'type'     => 'typography',
                'title'    => __( 'Change Element Font Merriweather -> ', 'bebostore' ),
                // 'compiler' => array('body *'),
                'output'   => array('body,.title-box,.list-blog .blog-item .title-blog,.right-sidebar .sidebar-widget ul li,.woocommerce-MyAccount-navigation li a,.woocommerce-account header.entry-title, footer .footer-widget .widget-body,.sc-product-slider .book-info span.book-name,.form-subcribe .subcribe-form-view .txt-subcrible-text,.list-blog .blog-item .blog-timeup,.book-bestseller .book-description .book-description-content .book-desc,.box-check-out .title-box-checkout,.woocommerce .book-item-detail span.book-desc,#main-navigation .menu-item a, #main-navigation .menu-item .mega-menu-link, #main-navigation li a, #main-navigation li .mega-menu-link, #mega-menu-wrap-main-menu .menu-item a, #mega-menu-wrap-main-menu .menu-item .mega-menu-link, #mega-menu-wrap-main-menu li a, #mega-menu-wrap-main-menu li .mega-menu-link,.right-detail .book-desc-detail .box-detail-desc,.box-meet-author .author-info .desc-name .desc-author,.section-blog-detail .blogs-detail .news-content,.book-about-author .about-post-author span.author-desc,.comment-list .title-comment span,.comment-list .comment .comment-body,.book-contact .book-form-contact .book-address .book-contact-add,.book-contact .book-form-contact .contact-content,.book-contact .book-form-contact .book-contact-form .txt-contact, .book-contact .book-form-contact .book-contact-form .txt-message,.blog-items .news-description .short-desc,.our-team .details-team .person-team .info-person .job,.full-layout .with-widget ul li .book-best-right .name-best .b-price,.subcribe-half .subcribe-message-title .subcribe-message,.hot-author .author-desc,.book-today-hightlight.big-hightlight .book-info .book-desc,.service-item .service-desc,.categories-description, .shopping-cart .shop_table tbody .product-info-name a'),
                'subtitle' => __( 'Specify the body font properties.', 'bebostore' ),
                'google'   => false,
                'fonts'    => array(
                    'Work Sans' => 'Work Sans'
                )
            ),
            array(
                'id'       => 'body-text-lato',
                'type'     => 'typography',
                'title'    => __( 'Change Element Font Lato -> ', 'bebostore' ),
                // 'compiler' => array('body *'),
                'output'   => array('.form-subcribe .subcribe-form-view .title-subcribe span,.shopping-cart .shop_table thead tr th, .woo-login form label, .tagged_as,.book-bestseller .book-description .book-description-content .book-tags a,.book-info span.book-author,header.header-two .search-navigation-full .search form button,.woocommerce .book-item-detail span.sku_wrapper,.woocommerce .book-item-detail span.book-quanlity,.woocommerce .book-item-detail span.by-book,.woocommerce .book-item-detail .tagged_as,.woocommerce .book-item-detail .social-share li.title-social,.list-menu-tap li,.box-meet-author .author-info .desc-name .year-author,.left-detail ul li, .woocommerce-MyAccount-navigation .menu-item a, .woocommerce-MyAccount-navigation .menu-item .mega-menu-link, .woocommerce-MyAccount-navigation li .mega-menu-link,.section-blog-detail .blogs-detail .news-dateup,.section-blog-detail .blogs-detail .news-content blockquote,.blog-items .news-description .news-dateup,.header-two #main-navigation .menu-item a,.testimonial-author .author-job,.list-name-author .title-alpha,.left-full .list-full-categories .items-category a span.cat-num,.full-layout .with-widget .name-widget,.service-fitem .text-service,.hot-author .author-tags,.book-today-hightlight.big-hightlight .book-info .book-tags,.breadthums-navigation .navigation-listcat .title-subcat,.archive .breadthums-navigation .woocommerce-ordering .position-sort .pull-left,.archive #product-sidebar .sidebar-widget h2,.pagging ul li .page-numbers,.archive .shop-left-bar .shop-list ul li .book-item-shop span.onsale,.header-page .title-page,.list-store .item-store .store-address,.shopping-cart .title-page,.shopping-cart .shop_table tbody .product-info-name span'),
                'subtitle' => __( 'Specify the body font properties.', 'bebostore' ),
                'fonts'    => array(
                    'Korina' => 'Korina'
                )
            ),
            array(
                'id'       => 'h1-element',
                'type'     => 'typography',
                'title'    => __( 'H1 element', 'bebostore' ),
                'subtitle' => __( 'Specify the h1 font properties.', 'bebostore' ),
                'output'    => array('h1'),
                // 'compiler' => array('h1'),
                'google'   => true,
            ),
            array(
                'id'       => 'h2-element',
                'type'     => 'typography',
                'title'    => __( 'H2 element', 'bebostore' ),
                'subtitle' => __( 'Specify the h2 font properties.', 'bebostore' ),
                'compiler' => array('h2'),
                'output' => array('h2'),
                'google'   => true,
            ),
            array(
                'id'       => 'h3-element',
                'type'     => 'typography',
                'title'    => __( 'H3 element', 'bebostore' ),
                'subtitle' => __( 'Specify the h3 font properties.', 'bebostore' ),
                // 'compiler' => array('h3'),
                'output' => array('h3'),
                'google'   => true,
            ),
            array(
                'id'       => 'h4-element',
                'type'     => 'typography',
                'title'    => __( 'H4 element', 'bebostore' ),
                'subtitle' => __( 'Specify the h4 font properties.', 'bebostore' ),
                // 'compiler' => array('h4'),
                'output'   => array('h4'),
                'google'   => true,
            ),
            array(
                'id'       => 'h5-element',
                'type'     => 'typography',
                'title'    => __( 'H5 element', 'bebostore' ),
                'subtitle' => __( 'Specify the h5 font properties.', 'bebostore' ),
                // 'compiler' => array('h5'),
                'output'   => array('h5'),
                'google'   => true,
            ),
            array(
                'id'       => 'h6-element',
                'type'     => 'typography',
                'title'    => __( 'H6 element', 'bebostore' ),
                'subtitle' => __( 'Specify the h6 font properties.', 'bebostore' ),
                // 'compiler' => array('h6'),
                'output' => array('h6'),
                'google'   => true,
            ),
        )
    ) );

    // -> START Styling option
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Button options','beautheme' ),
        'id'               => 'styling',
        'desc'             => __( 'These are something setting for Styling options!','beautheme' ),
        'customizer_width' => '400px',
        'icon'             => 'el el-cogs',
    ) );

    // -> START Custom header option
    Redux::setSection( $opt_name, array(
        'title'             => __( 'Button background orange color','beautheme' ),
        'id'                => 'button-color',
        'subsection'        => true,
        'customizer_width'  => '450px',
        'fields'            => array(
            array(
                'id'       => 'text-button',
                'type'     => 'typography',
                'title'    => __( 'Text button style','beautheme' ),
                // 'compiler' => array('button *'),
                'output'   => array('button,input[type="button"],input[type="submit"],.woocommerce div.product form.cart .button,header.header-two .search-navigation-full .search form button,.shopping-cart .shop_table tfoot .checkout-button,.shopping-cart #payment #place_order,.shopping-cart .shop_table tbody tr td.product-add-to-cart a,.woo-login form input.button,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.book-contact .book-form-contact button,.book-contact .book-form-contact input[type="button"],.book-contact .book-form-contact input[type="submit"]'),
                'subtitle' => __( 'Specify the button font properties.','beautheme' ),
                'google'   => true,
            ),
            array(
                'id'       => 'text-button-hover',
                'type'     => 'color',
                'title'    => __( 'Text button color (hover)','beautheme' ),
                // 'compiler' => array('button *'),
                'transparent' => false,
                'output'   => array('color' => 'button:hover,input[type="button"]:hover,input[type="submit"]:hover,.woocommerce div.product form.cart .button:hover,header.header-two .search-navigation-full .search form button:hover,.shopping-cart .shop_table tfoot .checkout-button:hover,.shopping-cart #payment #place_order:hover,.shopping-cart .shop_table tbody tr td.product-add-to-cart a:hover,.woo-login form input.button:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.book-contact .book-form-contact button:hover,.book-contact .book-form-contact input[type="button"]:hover,.book-contact .book-form-contact input[type="submit"]:hover'),
            ),
            array(
                'id'       => 'background-button',
                'type'     => 'color_rgba',
                'title'    => __( 'Background button color','beautheme' ),
                // 'compiler' => array('button *'),
                'output'   => array('background-color' => 'button,input[type="button"],input[type="submit"],.woocommerce div.product form.cart .button,header.header-two .search-navigation-full .search form button,.shopping-cart .shop_table tfoot .checkout-button,.shopping-cart #payment #place_order,.shopping-cart .shop_table tbody tr td.product-add-to-cart a,.woo-login form input.button,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.book-contact .book-form-contact button,.book-contact .book-form-contact input[type="button"],.book-contact .book-form-contact input[type="submit"]'),
                'important' => true,
            ),
            array(
                'id'       => 'background-button-hover',
                'type'     => 'color_rgba',
                'title'    => __( 'Background button color (Hover)','beautheme' ),
                // 'compiler' => array('button *'),
                'output'   => array('background-color' => 'button:hover,input[type="button"]:hover,input[type="submit"]:hover,.woocommerce div.product form.cart .button:hover,header.header-two .search-navigation-full .search form button:hover,.shopping-cart .shop_table tfoot .checkout-button:hover,.shopping-cart #payment #place_order:hover,.shopping-cart .shop_table tbody tr td.product-add-to-cart a:hover,.woo-login form input.button:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.book-contact .book-form-contact button:hover,.book-contact .book-form-contact input[type="button"]:hover,.book-contact .book-form-contact input[type="submit"]:hover'),
                'important' => true,
            ),
            array(
                'id'       => 'border-button',
                'type'     => 'border',
                'title'    => __('Border button', 'beautheme'),
                'output'   => array('button,input[type="button"],input[type="submit"],.woocommerce div.product form.cart .button,header.header-two .search-navigation-full .search form button,.shopping-cart .shop_table tfoot .checkout-button,.shopping-cart #payment #place_order,.shopping-cart .shop_table tbody tr td.product-add-to-cart a,.woo-login form input.button,.woocommerce #respond input#submit,.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.book-contact .book-form-contact button,.book-contact .book-form-contact input[type="button"],.book-contact .book-form-contact input[type="submit"]'),
                'desc'     => __('This is the description field, again good for additional info.', 'beautheme'),
            ),
            array(
                'id'       => 'border-button-hover',
                'type'     => 'color',
                'title'    => __( 'Border button color (Hover)','beautheme' ),
                'output'   => array('border-color' => 'button:hover,input[type="button"]:hover,input[type="submit"]:hover,.woocommerce div.product form.cart .button:hover,header.header-two .search-navigation-full .search form button:hover,.shopping-cart .shop_table tfoot .checkout-button:hover,.shopping-cart #payment #place_order:hover,.shopping-cart .shop_table tbody tr td.product-add-to-cart a:hover,.woo-login form input.button:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.book-contact .book-form-contact button:hover,.book-contact .book-form-contact input[type="button"]:hover,.book-contact .book-form-contact input[type="submit"]:hover'),
                'important' => true,
            ),
        )
    ) );

    // -> START Custom header option
    Redux::setSection( $opt_name, array(
        'title'             => __( 'Button background white color','beautheme' ),
        'id'                => 'button-white-color',
        'subsection'        => true,
        'customizer_width'  => '450px',
        'fields'            => array(
            array(
                'id'       => 'text-button-white',
                'type'     => 'typography',
                'title'    => __( 'Text button style','beautheme' ),
                // 'compiler' => array('button *'),
                'output'   => array('.form-subcribe .subcribe-form-view .book-button,.book-comment-form .comment-form .form-submit .submit,#reviews #review_form_wrapper #review_form .comment-respond .form-submit #submit,.book-button-active'),
                'subtitle' => __( 'Specify the button font properties.','beautheme' ),
                'google'   => true,
            ),
            array(
                'id'       => 'text-button-hover-white',
                'type'     => 'color',
                'title'    => __( 'Text button color (hover)','beautheme' ),
                // 'compiler' => array('button *'),
                'transparent' => false,
                'output'   => array('color' => '.form-subcribe .subcribe-form-view .book-button:hover,.book-comment-form .comment-form .form-submit .submit:hover,#reviews #review_form_wrapper #review_form .comment-respond .form-submit #submit:hover,.book-button-active:hover'),
            ),
            array(
                'id'       => 'background-button-white',
                'type'     => 'color_rgba',
                'title'    => __( 'Background button color','beautheme' ),
                // 'compiler' => array('button *'),
                'output'   => array('background-color' => '.form-subcribe .subcribe-form-view .book-button,.book-comment-form .comment-form .form-submit .submit,#reviews #review_form_wrapper #review_form .comment-respond .form-submit #submit,.book-button-active'),
                'important' => true,
            ),
            array(
                'id'       => 'background-button-hover-white',
                'type'     => 'color_rgba',
                'title'    => __( 'Background button color (Hover)','beautheme' ),
                // 'compiler' => array('button *'),
                'output'   => array('background-color' => '.form-subcribe .subcribe-form-view .book-button:hover,.book-comment-form .comment-form .form-submit .submit:hover,#reviews #review_form_wrapper #review_form .comment-respond .form-submit #submit:hover,.book-button-active:hover'),
                'important' => true,
            ),
            array(
                'id'       => 'border-button-white',
                'type'     => 'border',
                'title'    => __('Border button', 'beautheme'),
                'subtitle' => __('Only color validation can be done on this field type', 'beautheme'),
                'output'   => array('.form-subcribe .subcribe-form-view .book-button,.book-comment-form .comment-form .form-submit .submit,#reviews #review_form_wrapper #review_form .comment-respond .form-submit #submit,.book-button-active'),
                'desc'     => __('This is the description field, again good for additional info.', 'beautheme'),
            ),
            array(
                'id'       => 'border-button-hover-white',
                'type'     => 'color',
                'title'    => __( 'Border button color (Hover)','beautheme' ),
                // 'compiler' => array('button *'),
                'output'   => array('border-color' => '.form-subcribe .subcribe-form-view .book-button:hover,.book-comment-form .comment-form .form-submit .submit:hover,#reviews #review_form_wrapper #review_form .comment-respond .form-submit #submit:hover,.book-button-active:hover'),
                'important' => true,
            ),
        )
    ) );

    // Your header and footer custom
    Redux::setSection( $opt_name, array(
        'title'            => __( 'Header & footer', 'bebostore' ),
        'id'               => 'headerfooter',
        'customizer_width' => '500px',
        'icon'             => 'el el-magic',
    ) );

    Redux::setSection( $opt_name, array(
        'title'             => __( 'Custom header', 'bebostore' ),
        'id'                => 'headerfooter-header',
        'subsection'        => true,
        'customizer_width'  => '450px',
        'fields'            => array(
            array(
                'id'       => 'header-type',
                'type'     => 'select',
                'title'    => __( 'Chose your header type', 'bebostore' ),
                'subtitle' => __( 'Chose your header want to show', 'bebostore' ),
                'options'  => $custom_header,
            ),
            array(
                'id'       => 'is-header-top',
                'type'     => 'checkbox',
                'title'    => __('Remove Header Top?', 'bebostore'), 
                'subtitle' => __('Check if you want to remove top header', 'bebostore'),
                'default'  => '1'// 1 = on | 0 = off
            ),
            array(
                'id'        => 'header-text-color',
                'type'      => 'color_rgba',
                'title'     => __( 'Header Text Color', 'bebostore' ),
                'subtitle'  => __( 'Gives you the RGBA color.', 'bebostore' ),
                // 'compiler' => array('.header'),
                'output' => array(
                    'header','header.header-one',
                    'header.header-two',
                    '.menu-stick #main-navigation .menu-item > a',
                    '#main-navigation .menu-item.menu-item-has-children:after',
                    '.header-bottom .woocomerce-cart .be',
                    '.navbar-nav .nav-link'
                ),
                'mode'      => 'color',
                //'validate' => 'colorrgba',
            ),

            array(
                'id'        => 'header-bg',
                'type'      => 'color_rgba',
                'title'     => __( 'Header background Color', 'bebostore' ),
                'subtitle'  => __( 'Gives you the RGBA color.', 'bebostore' ),
                // 'compiler' => array('.header'),
                'output' => array(
                    'header',
                    'header.header-one',
                    'header.header-two',
                    'nav.navbar'
                ),
                'mode'      => 'background',
                //'validate' => 'colorrgba',
            ),

            array(
                'id'        => 'header-bg-top',
                'type'      => 'color_rgba',
                'title'     => __( 'Top Header background Color', 'bebostore' ),
                'subtitle'  => __( 'Gives you the RGBA color.', 'bebostore' ),
                // 'compiler' => array('.header'),
                'output' => array(
                    '.header-top'
                ),
                'mode'      => 'background',
                //'validate' => 'colorrgba',
            ),
            array(
                'id'        => 'header-top-text-color',
                'type'      => 'color_rgba',
                'title'     => __( 'Top Header Text Color', 'bebostore' ),
                'subtitle'  => __( 'Gives you the RGBA color.', 'bebostore' ),
                // 'compiler' => array('.header'),
                'output' => array(
                    '#small-navigation .menu-item a',
                    '#small-navigation .account-settings a'
                ),
                'mode'      => 'color',
                //'validate' => 'colorrgba',
            ),

            array(
                'id'        => 'header-dropdown-color',
                'type'      => 'color_rgba',
                'title'     => __( 'Header dropdown BG Color', 'bebostore' ),
                'subtitle'  => __( 'Gives you the RGBA color.', 'bebostore' ),
                // 'compiler' => array('#main-navigation .menu-item .sub-menu .menu-item', '#main-navigation .menu-item .sub-menu .menu-item:hover', '#main-navigation .menu-item .sub-menu.current-menu-item'),
                'output' => array(
                    '#main-navigation .menu-item .sub-menu .menu-item',
                    '#main-navigation .menu-item .sub-menu .menu-item:hover',
                    '#main-navigation .menu-item .sub-menu.current-menu-item'
                ),
                'mode'      => 'background',
                //'validate' => 'colorrgba',
            ),
            array(
                'id'        => 'header-fixed',
                'type'      => 'button_set',
                'title'     => __( 'Header fixed', 'bebostore' ),
                // 'subtitle' => __( 'No validation can be done on this field type', 'bebostore' ),
                // 'desc'     => __( 'This is the description field, again good for additional info.', 'bebostore' ),
                //Must provide key => value pairs for radio options
                'options'   => array(
                    '1'     => 'No',
                    '2'     => 'Yes',
                ),
                'default'   => '2'
            ),

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'             => __( 'Custom footer', 'bebostore' ),
        'id'                => 'headerfooter-footer',
        'subsection'        => true,
        'customizer_width'  => '450px',
        'fields'            => array(
            array(
                'id'        => 'footer-type',
                'type'      => 'select',
                'title'     => __( 'Select Option', 'bebostore' ),
                'subtitle'  => __( 'Chose your default type of archive blog page', 'bebostore' ),
                'options'   => $custom_footer,
            ),
            array(
                'id'        => 'footer-text',
                'type'      => 'color_rgba',
                'title'     => __( 'Footer Text Color', 'bebostore' ),
                'subtitle'  => __( 'Gives you the RGBA color.', 'bebostore' ),
                // 'compiler' => array('footer'),
                'output'   => array(
                    'footer', 'footer .footer-widget .widget-title',
                    'footer .footer-widget .widget-body .menu li a',
                    'footer .footer-widget .widget-body',
                    '.book-info span.book-name a',
                    'footer .footer-widget .widget-body .book-info .book-price',
                    '.widget-footer .list-social a'
                ),
                'mode'      => 'color',
            ),
            array(
                'id'        => 'footer-bg',
                'type'      => 'color_rgba',
                'title'     => __( 'Footer background Color', 'bebostore' ),
                'subtitle'  => __( 'Gives you the RGBA color.', 'bebostore' ),
                // 'compiler' => array('footer'),
                'output'   => array( 'footer' ),
                'mode'      => 'background',
                //'validate' => 'colorrgba',
            ),
            array(
                'id'        => 'footer-bottom-bg',
                'type'      => 'color_rgba',
                'title'     => __( 'Footer bottom Color', 'bebostore' ),
                'subtitle'  => __( 'Gives you the RGBA color.', 'bebostore' ),
                // 'compiler' => array('.bottom-footer'),
                'output'   => array( 'footer .bottom-footer' ),
                'mode'      => 'background',
            ),
            array(
                'id'        => 'footer-bottom-text',
                'type'      => 'color_rgba',
                'title'     => __( 'Footer bottom Text Color', 'bebostore' ),
                'subtitle'  => __( 'Gives you the RGBA color.', 'bebostore' ),
                // 'compiler' => array('.bottom-footer'),
                'output'   => array( 'footer .bottom-footer .copyright' ),
                'mode'      => 'color',
            ),
            array(
                'id'        => 'link-payment',
                'type'      => 'select',
                'multi'     => true,
                'title'     => __( 'Shipping & Payment', 'bebostore' ),
                'subtitle'  => __( 'Select your payment for your page', 'bebostore' ),
                'desc'      => __( 'Chose your payment for your footer page.', 'bebostore' ),
                //Must provide key => value pairs for radio options
                'options'   => array(
                    'mastercard'        => 'Master card',
                    'paypal'            => 'Paypal',
                    'visa'              => 'Visa',
                    'dhl'               => 'DHL',
                    'american-express'  => 'American Express',
                    'fedex'             => 'FedEx',
                ),
                'default'  => array()
            ),
            array(
                'id'       => 'footer-widget-number',
                'type'     => 'select',
                'title'    => __( 'Chose footer columns', 'bebostore' ),
                'subtitle' => __( 'Chose your custom widget number you want to show', 'bebostore' ),
                // 'desc'     => __( 'We have ? blog archive type', 'bebostore' ),
                //Must provide key => value pairs for select options
                'options'  => $beau_column,
                // 'default'  => '5'
            ),
            array(
                'id'       => 'enable-gotop',
                'type'     => 'button_set',
                'title'    => __( 'Enable go top button', 'bebostore' ),
                // 'subtitle' => __( 'No validation can be done on this field type', 'bebostore' ),
                // 'desc'     => __( 'This is the description field, again good for additional info.', 'bebostore' ),
                //Must provide key => value pairs for radio options
                'options'  => array(
                    '1'    => 'No',
                    '2'    => 'Yes',
                ),
                'default'  => '2'
            ),
             array(
                'id'       => 'store-footer-text',
                'type'     => 'editor',
                'title'    => __( 'Custom footer', 'bebostore' ),
                'subtitle' => __( 'Use any of the features of WordPress editor inside your panel!', 'bebostore' ),
                'default'  => 'Custom text for footer.',
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Your link for payment', 'bebostore' ),
        'id'               => 'headerfooter-footer-link',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'store-mastercard',
                'type'     => 'text',
                'title'    => __( 'Your Mastercard page', 'bebostore' ),
                'default'  => '#',
            ),
            array(
                'id'       => 'store-paypal',
                'type'     => 'text',
                'title'    => __( 'Your paypal link', 'bebostore' ),
                'default'  => '#',
            ),
            array(
                'id'       => 'store-visa',
                'type'     => 'text',
                'title'    => __( 'Your visa payment', 'bebostore' ),
                'default'  => '#',
            ),
            array(
                'id'       => 'store-dhl',
                'type'     => 'text',
                'title'    => __( 'Your dhl page', 'bebostore' ),
                'default'  => '#',
            ),
            array(
                'id'       => 'store-american-express',
                'type'     => 'text',
                'title'    => __( 'American Express link', 'bebostore' ),
                'default'  => '#',
            ),
            array(
                'id'       => 'store-fedex',
                'type'     => 'text',
                'title'    => __( 'FedEx link', 'bebostore' ),
                'default'  => '#',
            ),
        )
    ) );
