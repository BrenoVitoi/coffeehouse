<?php
    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }
    // Redux help function    
    if(!function_exists('th_switch_redux_option')){
        function th_switch_redux_option(){
            $th_option_name = th_get_option_name();
            // Basic Settings
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Basic Settings', 'coffeehouse' ),
                'id'               => 'basic',
                'icon'             => 'el el-home'
            ) );
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'General', 'coffeehouse' ),
                'id'               => 'basic-general',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'       => 'th_header_page',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Header Page', 'coffeehouse' ),
                        'desc'     => esc_html__( 'Include Header content. Go to Header in admin menu to edit/create header content. Note this value default for all pages of your site, If have any page/single page display other content pehaps you are set specific header for it', 'coffeehouse' ),
                        //Must provide key => value pairs for select options
                        'options'  => th_list_post_type('th_header'),
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'th_footer_page',
                        'type'     => 'select',
                        'title'    => esc_html__( 'Footer Page', 'coffeehouse' ),
                        'desc'     => esc_html__( 'Include Footer content. Go to Footer in admin menu to edit/create footer content.  Note this value default for all pages of your site, If have any page/single page display other content pehaps you are set specific footer for it', 'coffeehouse' ),
                        //Must provide key => value pairs for select options
                        'options'  => th_list_post_type('th_footer'),
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'th_404_page',
                        'type'     => 'select',
                        'title'    => esc_html__( '404 Page', 'coffeehouse' ),
                        'desc'     => esc_html__( 'Include page to 404 page', 'coffeehouse' ),
                        //Must provide key => value pairs for select options
                        'options'  => th_list_post_type('th_mega_item'),
                        'default'  => ''
                    ),
                    array(
                        'id'       => 'th_404_page_style',
                        'type'     => 'select',
                        'title'    => esc_html__( '404 Style', 'coffeehouse' ),
                        'desc'     => esc_html__( 'Choose a style to display.', 'coffeehouse' ),
                        //Must provide key => value pairs for select options
                        'options'  => array(
                            ''           => esc_html__('Default','coffeehouse'),
                            'full-width' => esc_html__('FullWidth','coffeehouse'),
                        ),
                        'default'  => '',
                        'required' => array('th_404_page','not','')
                    ),
                )
            ) );
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Breadcumb', 'coffeehouse' ),
                'id'               => 'breadcumb-general',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'       => 'th_show_breadrumb',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Show BreadCrumb', 'coffeehouse' ),
                        'desc' => esc_html__( 'Look, it\'s on!', 'coffeehouse' ),
                        'default'  => false,
                    ),
                    array(
                        'id'          => 'th_bg_breadcrumb',
                        'type'        => 'background',
                        'title'       => esc_html__('Background Breadcrumb','coffeehouse'),
                        'desc'        => esc_html__( 'Custom background for breadcrumb.', 'coffeehouse' ),                        
                        'required'    => array('th_show_breadrumb','=',true),
                        'preview_media' => true,
                    ),
                    array(
                        'id'          => 'breadcrumb_text',
                        'type'        => 'typography',
                        'title'       => esc_html__('Breadcrumb text','coffeehouse'),
                        'required'    => array('th_show_breadrumb','=',true),
                        'desc'        => esc_html__( 'Custom font in breadcrumb.', 'coffeehouse' ),
                    ),
                    array(
                        'id'          => 'breadcrumb_text_hover',
                        'type'        => 'typography',
                        'title'       => esc_html__('Breadcrumb text hover','coffeehouse'),
                        'required'    => array('th_show_breadrumb','=',true),
                        'desc'        => esc_html__( 'Custom font when you hover in text of breadcrumb.', 'coffeehouse' ),
                    ),
                )
            ) );
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Preload', 'coffeehouse' ),
                'id'               => 'preload-general',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'       => 'show_preload',
                        'type'     => 'switch',
                        'title'    => esc_html__( 'Show Preload', 'coffeehouse' ),
                        'desc'     => esc_html__( 'Look, it\'s on!', 'coffeehouse' ),
                        'default'  => false,
                    ),
                    array(
                        'id'          => 'preload_bg',
                        'type'        => 'color_rgba',
                        'title'       => esc_html__('Background','coffeehouse'),
                        'desc'        => esc_html__( 'Change default body background.', 'coffeehouse' ),
                        'required'    => array('show_preload','=',true),
                    ),
                    array(
                        'id'          => 'preload_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Preload Style','coffeehouse'),
                        'default'     => '',
                        'options'     => array(
                            '' =>  esc_html__('Style 1','coffeehouse'),
                            'style2' =>  esc_html__('Style 2','coffeehouse'),
                            'style3' =>  esc_html__('Style 3','coffeehouse'),
                            'style4' =>  esc_html__('Style 4','coffeehouse'),
                            'style5' =>  esc_html__('Style 5','coffeehouse'),
                            'style6' =>  esc_html__('Style 6','coffeehouse'),
                            'style7' =>  esc_html__('Style 7','coffeehouse'),
                            'custom-image' =>  esc_html__('Custom image','coffeehouse'),
                        ),
                        'desc'        => esc_html__( 'Choose default style for your site.', 'coffeehouse' ),
                        'required'    => array('show_preload','=',true),
                    ),
                )
            ) );
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Other', 'coffeehouse' ),
                'id'               => 'other-general',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'        => 'show_scroll_top',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show scroll top button', 'coffeehouse'),
                        'desc'      => esc_html__('This allow you to show or hide scroll top button', 'coffeehouse'),
                        'default'   => false
                    ),
                    array(
                        'id'        => 'show_wishlist_notification',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show wishlist notification', 'coffeehouse'),
                        'desc'      => esc_html__('This allow you to show or hide wishlist notification when add to wishlist.', 'coffeehouse'),
                        'default'   => false
                    ),
                    array(
                        'id'        => 'show_too_panel',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show tool panel', 'coffeehouse'),
                        'desc'      => esc_html__('This allow you to show or hide tool panel.', 'coffeehouse'),
                        'default'   => false
                    ),
                    array(
                        'id'        => 'remove_style_content',
                        'type'      => 'switch',
                        'title'     => esc_html__('Remove style content', 'coffeehouse'),
                        'desc'      => esc_html__('Remove style tag in content.', 'coffeehouse'),
                        'default'   => false
                    ),
                    array(
                        'id'          => 'tool_panel_page',
                        'type'        => 'select',
                        'title'       => esc_html__( 'Choose tool panel page', 'coffeehouse' ),
                        'desc'        => esc_html__( 'Choose a mega page to display.', 'coffeehouse' ),
                        'options'     => th_list_post_type('th_mega_item'),
                        'required'   =>  array('show_too_panel','=',true),
                    ),
                    array(
                        'id'          => 'body_bg',
                        'type'        => 'color_rgba',
                        'title'       => esc_html__('Body Background','coffeehouse'),
                        'desc'        => esc_html__( 'Change default body background.', 'coffeehouse' ),
                    ),
                    array(
                        'id'          => 'main_color',
                        'type'        => 'color_rgba',
                        'title'       => esc_html__('Main color','coffeehouse'),
                        'desc'        => esc_html__( 'Change main color of your site.', 'coffeehouse' ),
                    ),
                    array(
                        'id'          => 'main_color2',
                        'type'        => 'color_rgba',
                        'title'       => esc_html__('Main color 2','coffeehouse'),
                        'desc'        => esc_html__( 'Change main color 2 of your site.', 'coffeehouse' ),
                    ),
                    array(
                        'id'          => 'th_page_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Page Style','coffeehouse'),
                        'default'     => '',
                        'options'     => array(
                            'page-content-df' =>  esc_html__('Default','coffeehouse'),
                            'page-content-box' =>  esc_html__('Page boxed','coffeehouse'),
                        ),
                        'desc'        => esc_html__( 'Choose default style for pages.', 'coffeehouse' ),
                    ),
                    array(
                        'id'          => 'container_width',
                        'type'        => 'text',
                        'title'       => esc_html__('Custom container width(px)','coffeehouse'),
                        'desc'        => esc_html__( 'You can custom width of container on your site. Default is 1200px.', 'coffeehouse' ),
                    ),
                )
            ) );
            // End Basic Settings

            // Blog & Post
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Blog & Post', 'coffeehouse' ),
                'id'               => 'blog-post',
                'icon'             => 'el el-website'
            ) );
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'General', 'coffeehouse' ),
                'id'               => 'blog-general',
                'subsection'       => true,
                'fields'           => array(                    
                    array(
                        'id'          => 'before_append_post',
                        'type'        => 'select',
                        'title'       => esc_html__('Append content before post/blog/archive page','coffeehouse'),
                        'options'     => th_list_post_type('th_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to before main content of post/blog/archive page.','coffeehouse'),
                    ),
                    array(
                        'id'          => 'after_append_post',
                        'type'        => 'select',
                        'title'       => esc_html__('Append content after post/blog/archive page','coffeehouse'),
                        'options'     => th_list_post_type('th_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to after main content of post/blog/archive page.','coffeehouse'),
                    ),
                    array(
                        'id'          => 'th_sidebar_position_blog',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar Blog','coffeehouse'),
                        'desc'        => esc_html__('Set sidebar position for your blog page. Left, Right, or No sidebar.','coffeehouse'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','coffeehouse'),
                            'left'  => esc_html__('Left','coffeehouse'),
                            'right' => esc_html__('Right','coffeehouse'),
                        ),
                        'default'     => 'right'
                    ),
                    array(
                        'id'          => 'th_sidebar_blog',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar select display in blog','coffeehouse'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('th_sidebar_position_blog','not','no'),
                            array('th_sidebar_position_blog','not',''),
                        ), 
                        'desc'        => esc_html__('Choose a sidebar to display.','coffeehouse'),
                    ),
                    array(
                        'id'          => 'blog_default_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Default style','coffeehouse'),
                        'desc'        =>esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => array(
                            'list'  => esc_html__('List','coffeehouse'),
                            'grid'  => esc_html__('Grid','coffeehouse'),
                        ),
                        'default'     => 'list',
                    ),
                    array(
                        'id'          => 'blog_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Blog pagination','coffeehouse'),
                        'desc'        => esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => array(
                            ''          => esc_html__('Default','coffeehouse'),
                            'load-more' =>esc_html__('Load more','coffeehouse'),
                        )
                    ),                    
                    array(
                        'id'          => 'blog_title',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show title','coffeehouse'),
                        'desc'        => 'Show/hide title on blog page.',
                        'default'     => true,
                    ),
                    array(
                        'id'          => 'blog_number_filter',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show number filter','coffeehouse'),
                        'desc'        => 'Show/hide number filter on blog page.',
                        'default'     => true,
                    ),
                    array(
                        'id'          => 'blog_number_filter_list',
                        'title'       => esc_html__('Add list number filter','coffeehouse'),
                        'type'        => 'repeater',
                        'desc'        => esc_html__('Add custom list number to filter on the blog page.','coffeehouse'),
                        'fields'    => array( 
                            array(
                                'id'       => 'title',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Title', 'coffeehouse' ),
                            ),
                            array(
                                'id'          => 'number',
                                'type'        => 'text',
                                'title'       => esc_html__('Number','coffeehouse'),
                            ),
                        ),
                        'required'   => array('blog_number_filter','not', false),
                    ),
                    array(
                        'id'          => 'blog_type_filter',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show type filter','coffeehouse'),
                        'desc'        => 'Show/hide type filter(list/grid) on blog page.',
                        'default'     => true,
                    ),
                )
            ) );
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'List Settings', 'coffeehouse' ),
                'id'               => 'blog-list',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'          => 'post_list_size',
                        'type'        => 'text',
                        'title'       => esc_html__('Custom list thumbnail size','coffeehouse'),
                        'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','coffeehouse')
                    ),
                    array(
                        'id'          => 'post_list_item_style',
                        'type'        => 'select',
                        'title'       => esc_html__('List item style','coffeehouse'),
                        'desc'        => esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => th_get_post_list_style()
                    ),
                )
            ) );
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Grid Settings', 'coffeehouse' ),
                'id'               => 'blog-grid',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'          => 'post_grid_column',
                        'type'        => 'select',
                        'title'       => esc_html__('Grid column','coffeehouse'),
                        'default'     => '3',
                        'desc'=>esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => array(
                            '2' => esc_html__('2 column','coffeehouse'),
                            '3' =>esc_html__('3 column','coffeehouse'),
                            '4' =>esc_html__('4 column','coffeehouse'),
                            '5' =>esc_html__('5 column','coffeehouse'),
                            '6' =>esc_html__('6 column','coffeehouse'),
                        )
                    ),
                    array(
                        'id'          => 'post_grid_size',
                        'type'        => 'text',
                        'title'       => esc_html__('Custom grid thumbnail size','coffeehouse'),
                        'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','coffeehouse')
                    ),
                    array(
                        'id'          => 'post_grid_excerpt',
                        'type'        => 'text',
                        'title'       => esc_html__('Grid Sub string excerpt','coffeehouse'),
                        'default'     => '80',
                        'desc'        => esc_html__('Enter number of character want to get from excerpt content. Default is 0(hidden). Example is 80. Note: This value only apply for items style can be show excerpt.','coffeehouse')
                    ),
                    array(
                        'id'          => 'post_grid_item_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Grid item style','coffeehouse'),
                        'desc'        =>esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => th_get_post_style()
                    ),
                    array(
                        'id'          => 'post_grid_type',
                        'type'        => 'select',
                        'title'       => esc_html__('Grid display','coffeehouse'),
                        'desc'        =>esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => array(
                            ''  => esc_html__('Default','coffeehouse'),
                            'list-masonry'  => esc_html__('Masonry','coffeehouse'),
                            )
                    ),
                )
            ) );
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Post detail Settings', 'coffeehouse' ),
                'id'               => 'blog-post-detail',
                'subsection'       => true,
                'fields'           => array(                    
                    array(
                        'id'          => 'th_sidebar_position_post',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar Single Post','coffeehouse'),
                        'desc'        => esc_html__('Set sidebar position for your post detail page. Left, Right, or No sidebar.','coffeehouse'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','coffeehouse'),
                            'left'  => esc_html__('Left','coffeehouse'),
                            'right' => esc_html__('Right','coffeehouse'),
                        ),
                        'default'  => 'right'
                    ),
                    array(
                        'id'          => 'th_sidebar_post',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar select display in single post','coffeehouse'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('th_sidebar_position_post','not','no'),
                            array('th_sidebar_position_post','not',''),
                        ),                   
                        'desc'        => esc_html__('Choose a sidebar to display.','coffeehouse'),
                        'default'     => 'blog-sidebar'
                    ),
                    array(
                        'id'          => 'post_single_thumbnail',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show thumbnail/media','coffeehouse'),
                        'desc'        => 'Show/hide thumbnail image, gallery, media on post detail.',
                        'default'     => true,
                    ),                
                    array(
                        'id'          => 'post_single_size',
                        'title'       => esc_html__('Custom single image size','coffeehouse'),
                        'type'        => 'text',
                        'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','coffeehouse'),
                        'required'    => array('post_single_thumbnail','=',true),
                    ),
                    array(
                        'id'          => 'post_single_meta',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show meta data','coffeehouse'),
                        'desc'        => esc_html__('Show/hide meta data(author, date, comments, categories, tags) on post detail.','coffeehouse'),
                        'default'     => true,
                    ),
                    array(
                        'id'          => 'post_single_author',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show author box','coffeehouse'),
                        'desc'        => 'Show/hide author box on post detail.',
                        'default'     => true,
                    ),
                    array(
                        'id'          => 'post_single_navigation',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show navigation post','coffeehouse'),
                        'desc'        => 'Show/hide navigation to next post or previous post on the post detail.',
                        'default'     => true,
                    ),
                    // Related section
                    array(
                        'id'          => 'post_single_related',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show related post','coffeehouse'),
                        'desc'        => 'Show/hide related post on the post detail.',
                        'default'     => true,
                    ),
                    array(
                        'id'          => 'post_single_related_title',
                        'type'        => 'text',
                        'title'       => esc_html__('Related title','coffeehouse'),
                        'desc'        => esc_html__('Enter title of related section.','coffeehouse'),
                        'required'    => array('post_single_related','=',true),
                    ),
                    array(
                        'id'          => 'post_single_related_number',
                        'type'        => 'text',
                        'title'       => esc_html__('Related number post','coffeehouse'),
                        'desc'        => esc_html__('Enter number of related post to display.','coffeehouse'),
                        'required'    => array('post_single_related','=',true),
                    ),
                    array(
                        'id'          => 'post_single_related_item',
                        'type'        => 'text',
                        'title'       => esc_html__('Related custom number item responsive','coffeehouse'),
                        'desc'        => esc_html__('Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.','coffeehouse'),
                        'required'    => array('post_single_related','=',true),
                    ),
                    array(
                        'id'          => 'post_single_related_item_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Related item style','coffeehouse'),
                        'desc'        =>esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => th_get_post_style(),
                        'required'    => array('post_single_related','=',true),
                    ),
                )
            ) );
            // Blog & Post

            // Layout Settings
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Layout Settings', 'coffeehouse' ),
                'id'               => 'layout',
                'icon'             => 'el el-indent-left',
                'fields'           => array(
                    array(
                        'id'          => 'th_sidebar_position_page',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar Page','coffeehouse'),
                        'desc'        => esc_html__('Set sidebar position for your default page. Left, Right, or No sidebar.','coffeehouse'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','coffeehouse'),
                            'left'  => esc_html__('Left','coffeehouse'),
                            'right' => esc_html__('Right','coffeehouse'),
                        ),
                        'default'     => 'no'
                    ),
                    array(
                        'id'          => 'th_sidebar_page',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar select display in page','coffeehouse'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('th_sidebar_position_page','not','no'),
                            array('th_sidebar_position_page','not',''),
                        ),
                        'desc'        => esc_html__('Choose a sidebar to display.','coffeehouse'),
                        'default'     => ''
                    ),
                    array(
                        'id'          => 'th_sidebar_position_page_archive',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar Position on Page Archives:','coffeehouse'),
                        'desc'        => esc_html__('Set sidebar position for your archives page(category/tag/author page...). Left, Right, or No sidebar.','coffeehouse'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','coffeehouse'),
                            'left'  => esc_html__('Left','coffeehouse'),
                            'right' => esc_html__('Right','coffeehouse'),
                        ),
                        'default'     => 'right'
                    ),
                    array(
                        'id'          => 'th_sidebar_page_archive',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar select display in page Archives','coffeehouse'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('th_sidebar_position_page_archive','not','no'),
                            array('th_sidebar_position_page_archive','not',''),
                        ),
                        'desc'        => esc_html__('Choose a sidebar to display.','coffeehouse'),
                        'default'     => 'blog-sidebar'
                    ),
                    array(
                        'id'          => 'th_sidebar_position_page_search',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar Position on search page:','coffeehouse'),
                        'desc'        => esc_html__('Set sidebar position for your search page. Left, Right, or No sidebar.','coffeehouse'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','coffeehouse'),
                            'left'  => esc_html__('Left','coffeehouse'),
                            'right' => esc_html__('Right','coffeehouse'),
                        )
                    ),
                    array(
                        'id'          => 'th_sidebar_page_search',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar select display in page Archives','coffeehouse'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('th_sidebar_position_page_search','not','no'),
                            array('th_sidebar_position_page_search','not',''),
                        ),
                        'desc'        => esc_html__('Choose a sidebar to display.','coffeehouse'),
                    ),              
                    array(
                        'id'          => 'th_add_sidebar',
                        'title'       => esc_html__('Add SideBar','coffeehouse'),
                        'type'        => 'repeater',
                        'default'     => '',
                        'fields'    => array( 
                            array(
                                'id'       => 'title',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Title', 'coffeehouse' ),
                            ),
                            array(
                                'id'          => 'widget_title_heading',
                                'type'        => 'select',
                                'title'       => esc_html__('Choose heading title widget','coffeehouse'),
                                'default'     => 'h3',
                                'options'     => array(
                                    'h1' => esc_html__('H1','coffeehouse'),
                                    'h2' => esc_html__('H2','coffeehouse'),
                                    'h3' => esc_html__('H3','coffeehouse'),
                                    'h4' => esc_html__('H4','coffeehouse'),
                                    'h5' => esc_html__('H5','coffeehouse'),
                                    'h6' => esc_html__('H6','coffeehouse'),
                                )
                            ),
                        ),
                    ),
                )
            ) );
            // End Layout Settings

            // Typography
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Typography', 'coffeehouse' ),
                'id'               => 'typography',
                'icon'             => 'el el-text-height',
                'fields'           => array(
                    array(
                        'id'          => 'th_custom_typography',
                        'title'       => esc_html__('Add Settings','coffeehouse'),
                        'type'        => 'repeater',
                        'default'     => '',
                        'fields'      => array(
                            array(
                                'id'          => 'typo_area',
                                'type'        => 'select',
                                'title'       => esc_html__('Choose Area to style','coffeehouse'),
                                'default'     => 'body',
                                'options'     => array(
                                    'body'      => esc_html__('Body','coffeehouse'),
                                    'header'    => esc_html__('Header','coffeehouse'),
                                    'main'      => esc_html__('Main Content','coffeehouse'),
                                    'widget'    => esc_html__('Widget','coffeehouse'),
                                    'footer'    => esc_html__('Footer','coffeehouse'),
                                    ),
                            ),
                            array(
                                'id'          => 'typo_heading',
                                'type'        => 'select',
                                'title'       => esc_html__('Choose heading Area','coffeehouse'),
                                'default'     => '',
                                'options'     => array(
                                    'value'     => esc_html__('All','coffeehouse'),
                                    'h1'        => esc_html__('H1','coffeehouse'),
                                    'h2'        => esc_html__('H2','coffeehouse'),
                                    'h3'        => esc_html__('H3','coffeehouse'),
                                    'h4'        =>esc_html__('H4','coffeehouse'),
                                    'h5'        =>esc_html__('H5','coffeehouse'),
                                    'h6'        =>esc_html__('H6','coffeehouse'),
                                    'a'         =>esc_html__('a','coffeehouse'),
                                    'p'         =>esc_html__('p','coffeehouse'),
                                    'span'      =>esc_html__('span','coffeehouse'),
                                    'i'         =>esc_html__('i','coffeehouse'),
                                    'quote'     =>esc_html__('quote','coffeehouse'),
                                    ),
                            ),
                            array(
                                'id'          => 'typography_style',
                                'title'       => esc_html__('Add Style','coffeehouse'),
                                'type'        => 'typography',
                            ),
                        ),
                    ),
                )
            ) );
            // End Typography

            // Shop
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Shop', 'coffeehouse' ),
                'id'               => 'shop',
                'icon'             => 'el el-shopping-cart'
            ) );
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'General', 'coffeehouse' ),
                'id'               => 'general-shop',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'          => 'th_sidebar_position_woo',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar Position WooCommerce page','coffeehouse'),
                        'desc'        => esc_html__('Set sidebar position for your WooCommerce page(Shop, Checkout, Cart, My Account, Product category/tag/taxonomy page...). Left, Right, or No sidebar.','coffeehouse'),
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','coffeehouse'),
                            'left'  => esc_html__('Left','coffeehouse'),
                            'right' => esc_html__('Right','coffeehouse'),
                        ),
                        'default'  => 'right'
                    ),
                    array(
                        'id'          => 'th_sidebar_woo',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar select WooCommerce page','coffeehouse'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('th_sidebar_position_woo','not','no'),
                            array('th_sidebar_position_woo','not',''),
                        ),
                        'desc'        => esc_html__('Choose one style of sidebar for WooCommerce page','coffeehouse'),
                        'default'  => 'blog-sidebar'
                    ),
                    array(
                        'id'          => 'shop_default_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Default style','coffeehouse'),
                        'desc'=>esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => array(                        
                            'grid'  => esc_html__('Grid','coffeehouse'),
                            'list'  => esc_html__('List','coffeehouse'),
                        ),
                        'default'  => 'grid'
                    ),
                    array(
                        'id'          => 'shop_gap_product',
                        'type'        => 'select',
                        'title'       => esc_html__('Gap Products','coffeehouse'),
                        'desc'=>esc_html__('Choose space. The space between the items on the shop page.','coffeehouse'),
                        'options'     => array(                        
                            ''          => esc_html__('Default','coffeehouse'),
                            'gap-0'     => esc_html__('0','coffeehouse'),
                            'gap-5'     => esc_html__('5px','coffeehouse'),
                            'gap-10'    => esc_html__('10px','coffeehouse'),
                            'gap-15'    => esc_html__('15px','coffeehouse'),
                            'gap-20'    => esc_html__('20px','coffeehouse'),
                            'gap-30'    => esc_html__('30px','coffeehouse'),
                            'gap-40'    => esc_html__('40px','coffeehouse'),
                            'gap-50'    => esc_html__('50px','coffeehouse'),
                        ),
                    ),
                    array(
                        'id'          => 'woo_shop_number',
                        'type'        => 'text',
                        'title'       => esc_html__('Product Number','coffeehouse'),
                        'default'     => '12',
                        'desc'        => esc_html__('Enter number product to display per page. Default is 12.','coffeehouse')
                    ),
                    array(
                        'id'          => 'sv_set_time_woo',
                        'type'        => 'text',
                        'title'       => esc_html__('Product new in(days)','coffeehouse'),
                        'desc'        => esc_html__('Enter number to set time for product is new. Unit day. Default is 30.','coffeehouse')
                    ),
                    array(
                        'id'          => 'shop_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Shop pagination','coffeehouse'),
                        'desc'=>esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => array(
                            ''          => esc_html__('Default','coffeehouse'),
                            'load-more' => esc_html__('Load more','coffeehouse'),
                        )
                    ),
                    array(
                        'id'          => 'shop_ajax',
                        'type'        => 'switch',
                        'title'       => esc_html__('Shop ajax','coffeehouse'),
                        'default'     => false,
                        'desc'        => esc_html__('Enable ajax process for your shop page.','coffeehouse'),
                        'default'     => false
                    ),
                    array(
                        'id'          => 'shop_thumb_animation',
                        'type'        => 'select',
                        'title'       => esc_html__('Thumbnail animation','coffeehouse'),
                        'desc'        => esc_html__('Choose a animation.','coffeehouse'),
                        'options'     => th_get_product_thumb_animation()
                    ),
                    array(
                        'id'          => 'shop_number_filter',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show number filter','coffeehouse'),
                        'desc'        => esc_html__('Show/hide number filter on shop page.','coffeehouse'),
                        'default'     => true,
                    ),
                    array(
                        'id'          => 'shop_number_filter_list',
                        'type'        => 'repeater',
                        'title'       => esc_html__('Add list number filter','coffeehouse'),
                        'desc'        => esc_html__('Add custom list number to filter on the shop page.','coffeehouse'),
                        'fields'      => array(
                            array(
                                'id'          => 'number',
                                'type'        => 'text',
                                'title'       => esc_html__('Number','coffeehouse'),                                
                            ),
                        ),
                        'required'   => array('shop_number_filter','not',false),
                        'default'  => ''
                    ),
                    array(
                        'id'          => 'shop_type_filter',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show type filter','coffeehouse'),
                        'desc'        => esc_html__('Show/hide type filter(list/grid) on shop page.','coffeehouse'),
                        'default'     => true,
                    ),
                )
            ) );
            
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'List Settings', 'coffeehouse' ),
                'id'               => 'list-shop',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'          => 'shop_list_size',
                        'type'        => 'text',
                        'title'       => esc_html__('Custom list thumbnail size','coffeehouse'),
                        'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','coffeehouse')
                    ),
                    array(
                        'id'          => 'shop_list_item_style',
                        'type'        => 'select',
                        'title'       => esc_html__('List item style','coffeehouse'),
                        'desc'        => esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => th_get_product_list_style()
                    ),
                )
            ) );

            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Grid Settings', 'coffeehouse' ),
                'id'               => 'grid-shop',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'          => 'shop_grid_column',
                        'type'        => 'select',
                        'title'       => esc_html__('Grid column','coffeehouse'),
                        'default'     => '3',
                        'desc'        => esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => array(
                            '2'     => esc_html__('2 column','coffeehouse'),
                            '3'     => esc_html__('3 column','coffeehouse'),
                            '4'     => esc_html__('4 column','coffeehouse'),
                            '5'     => esc_html__('5 column','coffeehouse'),
                            '6'     => esc_html__('6 column','coffeehouse'),
                            '7'     => esc_html__('7 column','coffeehouse'),
                            '8'     => esc_html__('8 column','coffeehouse'),
                            '9'     => esc_html__('9 column','coffeehouse'),
                            '10'    => esc_html__('10 column','coffeehouse'),
                        )
                    ),
                    array(
                        'id'          => 'shop_grid_size',
                        'type'        => 'text',
                        'title'       => esc_html__('Custom grid thumbnail size','coffeehouse'),
                        'desc'        => esc_html__('Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','coffeehouse')
                    ),
                    array(
                        'id'          => 'shop_grid_item_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Grid item style','coffeehouse'),
                        'desc'        => esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => th_get_product_style()
                    ),
                    array(
                        'id'          => 'shop_grid_type',
                        'type'        => 'select',
                        'title'       => esc_html__('Grid display','coffeehouse'),
                        'desc'        => esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => array(
                            ''              => esc_html__('Default','coffeehouse'),
                            'list-masonry'  => esc_html__('Masonry','coffeehouse'),
                        )
                    ),
                )
            ) );

            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Advanced', 'coffeehouse' ),
                'id'               => 'advanced-shop',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'          => 'cart_page_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Cart display','coffeehouse'),
                        'desc'        => esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => array(
                            ''          => esc_html__('Default','coffeehouse'),
                            'style2'    => esc_html__('Style 2','coffeehouse'),
                        )
                    ),
                    array(
                        'id'          => 'checkout_page_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Checkout display','coffeehouse'),
                        'desc'        => esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => array(
                            ''          => esc_html__('Default','coffeehouse'),
                            'style2'    => esc_html__('Style 2','coffeehouse'),
                        )
                    ),
                    array(
                        'id'          => 'th_header_page_woo',
                        'type'        => 'select',
                        'title'       => esc_html__( 'Header WooCommerce Page', 'coffeehouse' ),
                        'desc'        => esc_html__( 'Include Header content. Go to Header in admin menu to edit/create header content. Note this value default for all pages of your site, If have any page/single page display other content pehaps you are set specific header for it', 'coffeehouse' ),
                        'options'     => th_list_post_type('th_header')
                    ),
                    array(
                        'id'          => 'th_footer_page_woo',
                        'type'        => 'select',
                        'title'       => esc_html__( 'Footer WooCommerce Page', 'coffeehouse' ),
                        'desc'        => esc_html__( 'Include Footer content. Go to Footer in admin menu to edit/create footer content.  Note this value default for all pages of your site, If have any page/single page display other content pehaps you are set specific footer for it', 'coffeehouse' ),
                        'options'     => th_list_post_type('th_footer')
                    ),
                    array(
                        'id'          => 'before_append_woo',
                        'type'        => 'select',
                        'title'       => esc_html__('Append content before WooCommerce page','coffeehouse'),
                        'options'     => th_list_post_type('th_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to before main content of page/post.','coffeehouse'),
                    ),
                    array(
                        'id'          => 'after_append_woo',
                        'type'        => 'select',
                        'title'       => esc_html__('Append content after WooCommerce page','coffeehouse'),
                        'options'     => th_list_post_type('th_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to after main content of page/post.','coffeehouse'),
                    ),
                )
            ) );
            // End Shop

            // Product
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Product', 'coffeehouse' ),
                'id'               => 'product',
                'icon'             => 'el el-briefcase'
            ) );
            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'General', 'coffeehouse' ),
                'id'               => 'general-product',
                'subsection'       => true,
                'fields'           => array(
                    array(
                        'id'          => 'product_single_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Product style','coffeehouse'),
                        'desc'        => esc_html__('Choose style display for product single','coffeehouse'),
                        'default'         => '',
                        'options'     => array(
                            ''              => esc_html__('Style 1','coffeehouse'),
                            'default-woo'   => esc_html__('Default WooCommerce','coffeehouse'),
                        ),
                    ),
                    array(
                        'id'          => 'sv_sidebar_position_woo_single',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar Position WooCommerce Single','coffeehouse'),
                        'desc'        => esc_html__('Left, or Right, or Center','coffeehouse'),
                        'default'         => 'no',
                        'options'     => array(
                            'no'    => esc_html__('No Sidebar','coffeehouse'),
                            'left'  => esc_html__('Left','coffeehouse'),
                            'right' => esc_html__('Right','coffeehouse'),
                        ),
                    ),
                    array(
                        'id'          => 'sv_sidebar_woo_single',
                        'type'        => 'select',
                        'title'       => esc_html__('Sidebar select WooCommerce Single','coffeehouse'),
                        'data'        => 'sidebars',
                        'required'    => array(
                            array('sv_sidebar_position_woo_single','not','no'),
                            array('sv_sidebar_position_woo_single','not',''),
                        ),
                        'desc'        => esc_html__('Choose one style of sidebar for WooCommerce page','coffeehouse'),
                    ),
                    array(
                        'id'          => 'product_image_zoom',
                        'type'        => 'select',
                        'title'       => esc_html__('Image zoom','coffeehouse'),
                        'desc'        => esc_html__('Choose a style to display','coffeehouse'),
                        'options'     => array(
                            ''              => esc_html__('None','coffeehouse'),
                            'zoom-style1'   => esc_html__('Zoom 1','coffeehouse'),
                            'zoom-style2'   => esc_html__('Zoom 2','coffeehouse'),
                            'zoom-style3'   => esc_html__('Zoom 3','coffeehouse'),
                            'zoom-style4'   => esc_html__('Zoom 4','coffeehouse'),
                        )
                    ),
                    array(
                        'id'          => 'product_tab_detail',
                        'type'        => 'select',
                        'title'       => esc_html__('Product tab style','coffeehouse'),
                        'desc'        => esc_html__('Choose a style to display','coffeehouse'),
                        'options'     => array(
                            'tab-normal'=> esc_html__("Normal", 'coffeehouse'),
                            'tab-style2'=> esc_html__("Tab style 2", 'coffeehouse'),
                        )
                    ),
                    array(
                        'id'          => 'show_excerpt',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show Excerpt','coffeehouse'),
                        'default'     => true
                    ),
                )
            ) );

            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Extra display', 'coffeehouse' ),
                'id'               => 'display-product',
                'subsection'       => true,
                'fields'           => array(
                   array(
                        'id'          => 'show_latest',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show latest products','coffeehouse'),
                        'default'     => true
                    ),
                    array(
                        'id'          => 'show_upsell',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show upsell products','coffeehouse'),
                        'default'     => true
                    ),
                    array(
                        'id'          => 'show_related',
                        'type'        => 'switch',
                        'title'       => esc_html__('Show related products','coffeehouse'),
                        'section'     => 'option_product',
                        'default'     => true
                    ),
                    array(
                        'id'          => 'show_single_number',
                        'type'        => 'slider',
                        'title'       => esc_html__('Show Single Number','coffeehouse'),
                        'min'         => '1',
                        'max'         => '100',
                        'step'        => '1',
                        'default'     => '6'
                    ),
                    array(
                        'id'          => 'show_single_size',
                        'type'        => 'text',
                        'title'       => esc_html__('Show Single Size','coffeehouse'),
                        'desc'        => esc_html__('Custom size for related,upsell products. Enter size thumbnail to crop. [width]x[height]. Example is 300x300.','coffeehouse'),
                    ),
                    array(
                        'id'          => 'show_single_itemres',
                        'type'        => 'text',
                        'title'       => esc_html__('Custom item devices','coffeehouse'),
                        'desc'        => esc_html__('Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.','coffeehouse'),
                    ),
                    array(
                        'id'          => 'show_single_item_style',
                        'type'        => 'select',
                        'title'       => esc_html__('Single item style','coffeehouse'),
                        'desc'        => esc_html__('Choose a style to active display','coffeehouse'),
                        'options'     => th_get_product_style()
                    ),
                )
            ) );

            Redux::setSection( $th_option_name, array(
                'title'            => esc_html__( 'Advanced', 'coffeehouse' ),
                'id'               => 'advanced-product',
                'subsection'       => true,
                'fields'           => array(
                   array(
                        'id'          => 'before_append_woo_single',
                        'type'        => 'select',
                        'title'       => esc_html__('Append content before product page','coffeehouse'),
                        'options'     => th_list_post_type('th_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to before main content of page/post.','coffeehouse'),
                    ),
                    array(
                        'id'          => 'before_append_tab',
                        'type'        => 'select',
                        'title'       => esc_html__('Append content before product tab','coffeehouse'),
                        'options'     => th_list_post_type('th_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to before product tab.','coffeehouse'),
                    ),
                    array(
                        'id'          => 'after_append_tab',
                        'type'        => 'select',
                        'title'       => esc_html__('Append content after product tab','coffeehouse'),
                        'options'     => th_list_post_type('th_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to before product tab.','coffeehouse'),
                    ),
                    array(
                        'id'          => 'after_append_woo_single',
                        'type'        => 'select',
                        'title'       => esc_html__('Append content after product page','coffeehouse'),
                        'options'     => th_list_post_type('th_mega_item'),
                        'desc'        => esc_html__('Choose a mega page content append to after main content of page/post.','coffeehouse'),
                    ),
                )
            ) );
            // End Product
        }
    }
    // End Redux help function
    // This is your option name where all the Redux data is stored.

    $th_option_name = th_get_option_name();

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $th_option_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Theme Options', 'coffeehouse' ),
        'page_title'           => esc_html__( 'Theme Options', 'coffeehouse' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyBFxhycc63fWy_uk126zW8KPtkD3Bay0jI',
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
        'dev_mode'             => true,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => 59,//29
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
        'menu_icon'            => get_template_directory_uri().'/assets/admin/image/thlogo.png',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_options_object' => false,
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

        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
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
    Redux::setArgs( $th_option_name, $args );

    /*
     * ---> END ARGUMENTS
     */    
    
    th_switch_redux_option();


