<?php
/**
 * Created by Sublime Text 2.
 * User: thanhhiep992
 * Date: 12/08/15
 * Time: 10:20 AM
 */
if(!function_exists('th_change_required')){
    function th_change_required($condition){
        if(is_string($condition)){            
            $requireds = array();
            $conditions = explode(',', $condition);
            foreach ($conditions as $key => $value) {
                $value = str_replace('(on)', '(1)', $value);
                $value = str_replace('(off)', '(0)', $value);
                $value = str_replace(')', '', $value);
                $value = str_replace('is', '=', $value);
                $value = str_replace('(', ':', $value);
                $requireds[] = explode(':', $value);
            }
            $condition = $requireds;
        }
        return $condition;
    }
}
if(!function_exists('th_fix_type_redux')){
    function th_fix_type_redux($settings){
        switch ($settings['type']) {
            case 'checkbox':
                if(isset($settings['choices'])){
                    $vals = $settings['choices'];
                    $new_vals = array();
                    foreach ($vals as $val) {
                        $new_vals[$val['value']] = $val['label'];
                    }
                    $settings['options'] = $new_vals;
                    unset($settings['choices']); 
                }
                break;
            case 'select':
                if(isset($settings['choices'])){
                    $vals = $settings['choices'];
                    $new_vals = array();
                    foreach ($vals as $val) {
                        if(isset($val['label'])) $new_vals[$val['value']] = $val['label'];
                    }
                    $settings['options'] = $new_vals;
                    unset($settings['choices']); 
                }
                break;

            case 'on-off':
                $settings['type'] = 'switch';
                if(isset($settings['std'])){
                    if($settings['std'] == 'on') $settings['default'] = true;
                    else $settings['default'] = false;
                    unset($settings['std']);
                }
                break;

            case 'colorpicker-opacity':
                $settings['type'] = 'color_rgba';
                break;

            case 'upload':
                $settings['type'] = 'media';
                break;

            case 'background':
                if(!isset($settings['preview_media'])) $settings['preview_media'] = true;
                break;

            case 'sidebar-select':
                $settings['type'] = 'select';
                $settings['data'] = 'sidebars';
                break;

            case 'post_types':
                $settings['type'] = 'select';
                $settings['data'] = 'post_types';
                break;

            case 'numeric-slider':
                $settings['type'] = 'slider';
                $data = $settings['min_max_step'];
                $data = explode(',', $data);
                $settings['min'] = (int)$data[0];
                $settings['max'] = (int)$data[1];
                $settings['step'] = (int)$data[2];
                unset($settings['min_max_step']);
                break;

            case 'list-item':
                $settings['type'] = 'repeater';
                $data = $settings['settings'];

                foreach ($data as $item_key => $item_field) {
                    $data[$item_key] = th_fix_type_redux($item_field);
                }
                $title_df = array(array(
                    'id'       => 'title',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Title', 'coffeehouse' ),
                ));
                $settings['fields'] = array_merge($title_df,$data);
                unset($settings['settings']);
                break;
            
            default:
                
                break;
        }
        // change title
        if(isset($settings['label'])){
            $settings['title'] = $settings['label'];
            unset($settings['label']);
        } 
        // change default
        if(isset($settings['std'])){
            $settings['default'] = $settings['std'];
            unset($settings['std']);
        }

        // change require
        if(isset($settings['condition'])){
            $settings['required'] = th_change_required($settings['condition']);
            unset($settings['condition']);
        }

        return $settings;
    }
}

if(class_exists('Redux')){
    $th_option_name = th_get_option_name();
    add_filter("redux/metaboxes/".$th_option_name."/boxes", "th_custom_meta_boxes");
}
else add_action('admin_init', 'th_custom_meta_boxes');
if(!function_exists('th_register_metabox')){
    function th_register_metabox($settings){
        foreach ($settings as $key => $setting) {
            if(is_array($setting['fields'])){
                $new_options = [];
                foreach ($setting['fields'] as $keyf => $field) {                    
                    $stemp = th_fix_type_redux($field);
                    if($field['type'] == 'tab'){
                        $tab_id = $field['id'];
                        $new_options[$tab_id] = array_merge($new_options,$stemp);
                        if(!isset($new_options[$tab_id]['icon'])) $new_options[$tab_id]['icon'] = '';
                    }
                    else{
                        if(!isset($tab_id)) $tab_id = 0;
                        $new_options[$tab_id]['fields'][] = $stemp;
                    }
                }
            }
            if(isset($new_options['title'])) $new_options['icon'] = '';
            unset($new_options['type']);
            $new_options2 = array();
            foreach ($new_options as $key2 => $value) {
                $new_options2[] = $new_options[$key2];
            }
            $settings[$key]['post_types'] = $settings[$key]['pages'];
            $settings[$key]['position'] = $settings[$key]['context'];
            $settings[$key]['sections'] = $new_options2;
            unset($settings[$key]['fields']);
            unset($settings[$key]['pages']);
            unset($settings[$key]['context']);
        }
        return $settings;
    }
}
if(!function_exists('th_custom_meta_boxes')){
    function th_custom_meta_boxes(){
        //Format content
        $format_metabox = array(
            'id'        => 'block_format_content',
            'title'     => esc_html__('Format Settings', 'coffeehouse'),
            'desc'      => '',
            'pages'     => array('post'),
            'context'   => 'normal',
            'priority'  => 'high',
            'fields'    => array(                
                array(
                    'id'        => 'format_image',
                    'label'     => esc_html__('Upload Image', 'coffeehouse'),
                    'type'      => 'upload',
                    'desc'      => esc_html__('Choose image from media.','coffeehouse'),
                ),
                array(
                    'id'        => 'format_gallery',
                    'label'     => esc_html__('Add Gallery', 'coffeehouse'),
                    'type'      => 'Gallery',
                    'desc'      => esc_html__('Choose images from media.','coffeehouse'),
                ),
                array(
                    'id'        => 'format_media',
                    'label'     => esc_html__('Link Media', 'coffeehouse'),
                    'type'      => 'text',
                    'desc'      => esc_html__('Enter media url(Youtube, Vimeo, SoundCloud ...).','coffeehouse'),
                ),
            ),
        );
        // SideBar
        $page_settings = array(
            'id'        => 'th_sidebar_option',
            'title'     => esc_html__('Page Settings','coffeehouse'),
            'pages'     => array( 'page','post','product'),
            'context'   => 'normal',
            'priority'  => 'low',
            'fields'    => array(
                // General tab
                array(
                    'id'        => 'page_general',
                    'type'      => 'tab',
                    'label'     => esc_html__('General Settings','coffeehouse')
                ),
                array(
                    'id'        => 'th_header_page',
                    'label'     => esc_html__('Choose page header','coffeehouse'),
                    'type'      => 'select',
                    'default'   => '',
                    'choices'   => th_list_post_type('th_header',false,true),
                    'desc'      => esc_html__('Include Header content. Go to Header page in admin menu to edit/create header content. Default is value of Theme Option.','coffeehouse'),
                ),
                array(
                    'id'         => 'th_footer_page',
                    'label'      => esc_html__('Choose page footer','coffeehouse'),
                    'type'       => 'select',
                    'default'   => '',
                    'choices'    => th_list_post_type('th_footer',false,true),
                    'desc'       => esc_html__('Include Footer content. Go to Footer page in admin menu to edit/create footer content. Default is value of Theme Option.','coffeehouse'),
                ),
                array(
                    'id'         => 'th_sidebar_position',
                    'label'      => esc_html__('Sidebar position ','coffeehouse'),
                    'type'       => 'select',
                    'choices'    => array(
                        array(
                            'label' => esc_html__('--Select--','coffeehouse'),
                            'value' => '',
                        ),
                        array(
                            'label' => esc_html__('No Sidebar','coffeehouse'),
                            'value' => 'no'
                        ),
                        array(
                            'label' => esc_html__('Left sidebar','coffeehouse'),
                            'value' => 'left'
                        ),
                        array(
                            'label' => esc_html__('Right sidebar','coffeehouse'),
                            'value' => 'right'
                        ),
                    ),
                    'desc'      => esc_html__('Choose sidebar position for current page/post(Left,Right or No Sidebar).','coffeehouse'),
                ),
                array(
                    'id'        => 'th_select_sidebar',
                    'label'     => esc_html__('Selects sidebar','coffeehouse'),
                    'type'      => 'sidebar-select',
                    'condition' => 'th_sidebar_position:not(no),th_sidebar_position:not()',
                    'desc'      => esc_html__('Choose a sidebar to display.','coffeehouse'),
                ),
                array(
                    'id'          => 'before_append',
                    'label'       => esc_html__('Append content before','coffeehouse'),
                    'type'        => 'select',                    
                    'default'   => '',
                    'choices'     => th_list_post_type('th_mega_item',false,true),
                    'desc'        => esc_html__('Choose a mega page content append to before main content of page/post.','coffeehouse'),
                ),
                array(
                    'id'          => 'after_append',
                    'label'       => esc_html__('Append content after','coffeehouse'),
                    'type'        => 'select',
                    'default'   => '',
                    'choices'     => th_list_post_type('th_mega_item',false,true),
                    'desc'        => esc_html__('Choose a mega page content append to after main content of page/post.','coffeehouse'),
                ),
                array(
                    'id'          => 'show_title_page',
                    'label'       => esc_html__('Show title', 'coffeehouse'),
                    'type'        => 'on-off',
                    'std'         => 'on',
                    'desc'        => esc_html__('Show/hide title of page.','coffeehouse'),
                ),
                array(
                    'id' => 'post_single_page_share',
                    'label' => esc_html__('Show Share Box', 'coffeehouse'),
                    'type' => 'select',
                    'std'   => '',
                    'choices'     => array(
                        array(
                            'label'=>esc_html__('--Theme Option--','coffeehouse'),
                            'value'=>'',
                        ),
                        array(
                            'label'=>esc_html__('On','coffeehouse'),
                            'value'=>'1'
                        ),
                        array(
                            'label'=>esc_html__('Off','coffeehouse'),
                            'value'=>'0'
                        ),
                    ),
                    'desc'        => esc_html__( 'You can show/hide share box independent on this page. ', 'coffeehouse' ),
                ),
                // End general tab
                // Custom color
                array(
                    'id'        => 'page_color',
                    'type'      => 'tab',
                    'label'     => esc_html__('Custom color','coffeehouse')
                ),
                array(
                    'id'          => 'body_bg',
                    'label'       => esc_html__('Body Background','coffeehouse'),
                    'type'        => 'colorpicker-opacity',
                    'desc'        => esc_html__( 'Change body background of page.', 'coffeehouse' ),
                ),
                array(
                    'id'          => 'main_color',
                    'label'       => esc_html__('Main color','coffeehouse'),
                    'type'        => 'colorpicker-opacity',
                    'desc'        => esc_html__( 'Change main color of this page.', 'coffeehouse' ),
                ),
                array(
                    'id'          => 'main_color2',
                    'label'       => esc_html__('Main color 2','coffeehouse'),
                    'type'        => 'colorpicker-opacity',
                    'desc'        => esc_html__( 'Change main color 2 of this page.', 'coffeehouse' ),
                ),
                // End Custom color
                // Display & Style tab
                array(
                    'id'        => 'page_layout',
                    'type'      => 'tab',
                    'label'     => esc_html__('Display & Style','coffeehouse')
                ),
                array(
                    'id'          => 'th_page_style',
                    'label'       => esc_html__('Page Style','coffeehouse'),
                    'type'        => 'select',
                    'std'         => '',
                    'choices'     => array(
                        array(
                            'label' =>  esc_html__('Default','coffeehouse'),
                            'value' =>  'page-content-df',
                        ),
                        array(
                            'label' =>  esc_html__('Page boxed','coffeehouse'),
                            'value' =>  'page-content-box'
                        ),
                    ),
                    'desc'        => esc_html__( 'Choose default style for page.', 'coffeehouse' ),
                ),
                array(
                    'id'          => 'container_width',
                    'label'       => esc_html__('Custom container width(px)','coffeehouse'),
                    'type'        => 'text',
                    'desc'        => esc_html__( 'You can custom width of page container. Default is 1200px.', 'coffeehouse' ),
                ),                
                
                // End Display & Style tab               
            )
        );
        
        $product_settings = array(
            'id' => 'block_product_settings',
            'title' => esc_html__('Product Settings', 'coffeehouse'),
            'desc' => '',
            'pages' => array('product'),
            'context' => 'normal',
            'priority' => 'low',
            'fields' => array(    
                // Begin Product Settings
                array(
                    'id'        => 'block_product_custom_tab',
                    'type'      => 'tab',
                    'label'     => esc_html__('General Settings','coffeehouse')
                ),             
                array(
                    'id'          => 'before_append_tab',
                    'label'       => esc_html__('Append content before product tab','coffeehouse'),
                    'type'        => 'select',
                    'choices'     => th_list_post_type('th_mega_item',false,true),
                    'desc'        => esc_html__('Choose a mega page content append to before product tab.','coffeehouse'),
                ),
                array(
                    'id'          => 'after_append_tab',
                    'label'       => esc_html__('Append content after product tab','coffeehouse'),
                    'type'        => 'select',
                    'choices'     => th_list_post_type('th_mega_item',false,true),
                    'desc'        => esc_html__('Choose a mega page content append to before product tab.','coffeehouse'),
                ),
                array(
                    'id'          => 'product_tab_detail',
                    'label'       => esc_html__('Product Tab Style','coffeehouse'),
                    'type'        => 'select',
                    'choices'     => array(                                                    
                        array(
                            'value'=> 'tab-normal',
                            'label'=> esc_html__("Normal", 'coffeehouse'),
                        ),
                        array(
                            'value'=> 'tab-style2',
                            'label'=> esc_html__("Tab style 2", 'coffeehouse'),
                        ),
                    )
                ),
                array(
                    'id'          => 'th_product_tab_data',
                    'label'       => esc_html__('Add Custom Tab','coffeehouse'),
                    'type'        => 'list-item',
                    'settings'    => array(
                        array(
                            'id'    => 'tab_content',
                            'label' => esc_html__('Content', 'coffeehouse'),
                            'type'  => 'textarea',
                            'std'   => '',
                        ),
                        array(
                            'id'            => 'priority',
                            'label'         => esc_html__('Priority (Default 40)', 'coffeehouse'),
                            'type'          => 'numeric-slider',
                            'min_max_step'  => '1,50,1',
                            'std'           => '40',
                            'desc'          => esc_html__('Choose priority value to re-order custom tab position.','coffeehouse'),
                        ),
                    )
                ),
            ),
        );
        $product_type = array(
            'id' => 'product_trendding',
            'title' => esc_html__('Product Type', 'coffeehouse'),
            'desc' => '',
            'pages' => array('product'),
            'context' => 'side',
            'priority' => 'low',
            'fields' => array(                
                array(
                    'id'    => 'trending_product',
                    'label' => esc_html__('Product Trending', 'coffeehouse'),
                    'type'        => 'on-off',
                    'std'         => 'off',
                    'desc'        => esc_html__( 'Set trending for current product.', 'coffeehouse' ),
                ),
                array(
                    'id'    => 'product_thumb_hover',
                    'label' => esc_html__('Product hover image', 'coffeehouse'),
                    'type'  => 'upload',
                    'desc'        => esc_html__( 'Product thumbnail 2. Some hover animation of thumbnail show back image. Default return main product thumbnail.', 'coffeehouse' ),
                ),
            ),
        );        
        if(class_exists('Redux')){
            $metaboxes = th_register_metabox([$format_metabox,$page_settings,$product_settings,$product_type]);
            return $metaboxes;
        }
    }
}
?>