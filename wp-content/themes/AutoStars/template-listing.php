<?php
/*
Template Name: Listing
*/
get_header();
wp_enqueue_script('imic_search_filter');
global $imic_options;
//Get Page Banner Type
if(is_home()) { $id = get_option('page_for_posts'); }
else { $id = get_the_ID(); }
$page_header = get_post_meta($id,'imic_pages_Choose_slider_display',true);
if($page_header==3) {
    get_template_part( 'pages', 'flex' );
}
elseif($page_header==4) {
    get_template_part( 'pages', 'nivo' );
}
elseif($page_header==5) {
    get_template_part( 'pages', 'revolution' );
}
elseif($page_header==1||$page_header==2) {
    get_template_part( 'pages', 'banner' );
}
else {
    //get_template_part( 'pages', 'banner' );
}
if(is_plugin_active("imithemes-listing/listing.php")) {
$listing_page_url = imic_get_template_url('template-dashboard.php');
$pageSidebar2 = get_post_meta(get_the_ID(),'imic_select_sidebar_from_list', true);
if(!empty($pageSidebar2)&&is_active_sidebar($pageSidebar2)) {
$class2 = 9;  
}else{
$class2 = 12;  
}
$listing_type = get_post_meta($id,'imic_default_listing_type',true);
$active_listing = ($listing_type=='list')?'active':'';
$active_grid = ($listing_type=='grid')?'active':'';
$vehicle_switch = get_post_meta($id,'imic_home_vehicle_switch',true);
$parallax_switch = get_post_meta($id,'imic_home_third_parallax_section',true);
$pricing_switch = get_post_meta($id,'imic_home_pricing_switch',true);
$posts_page = get_option('posts_per_page');
$qrs = imic_queryToArray($_SERVER['QUERY_STRING']);
?>
<!-- Actions bar -->
    <div class="actions-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 search-actions">
                    <ul class="utility-icons tools-bar">
                        <li><a href="#"><i class="fa fa-star-o"></i></a>
                            <div class="tool-box">
                                <div class="tool-box-head">
                                <?php if(is_user_logged_in()) { ?>
                                    <a href="<?php echo esc_url(add_query_arg('saved',1,$listing_page_url)); ?>" class="basic-link pull-right"><?php _e('View all','framework'); ?></a><?php } ?>
                                    <h5><?php _e('Saved yachts','framework'); ?></h5>
                                </div>
                                <div class="tool-box-in">
                                    <ul class="saved-cars-box listing tool-car-listing">
                                    <?php if((!isset($_SESSION['saved_vehicle_id1']))&&(!isset($_SESSION['saved_vehicle_id2']))&&(!isset($_SESSION['saved_vehicle_id3']))) { if ( is_user_logged_in() ) {
                                        $user_id = get_current_user_id( );
                                        $user_info_id = get_user_meta($user_id,'imic_user_info_id',true);
                                        $saved_cars = get_post_meta($user_info_id,'imic_user_saved_cars',true);
                                        if(!empty($saved_cars)) {
                                            $total = 0;
                                            $highlighted_specs = (isset($imic_options['highlighted_specs']))?$imic_options['highlighted_specs']:'';
                                            $unique_specs = $imic_options['unique_specs'];  
                                            foreach($saved_cars as $car) {
                                                $new_highlighted_specs = imic_filter_lang_specs_admin($highlighted_specs, $car[0]); 
                                                $highlighted_specs = $new_highlighted_specs;
                                                $specifications = get_post_meta($car[0],'feat_data',true);
                                                $unique_value = imic_vehicle_price($car[0],$unique_specs,$specifications);
                                                $highlight_value = imic_vehicle_title($car[0],$highlighted_specs,$specifications);
                                            echo '<li>
                                            <div class="checkb"><input id="saved-'.esc_attr($car[0]).'" value="0" type="checkbox" class="compare-check"></div>
                                            <div class="imageb"><a href="'.esc_url(get_permalink($car[0])).'">'.get_the_post_thumbnail($car[0]).'</a></div>
                                            <div class="textb">
                                                <a href="'.esc_url(get_permalink($car[0])).'">'.$highlight_value.'</a>
                                                <span class="price">'.$unique_value.'</span>
                                            </div>
                                            <div rel="specific-saved-ad" class="delete delete-box-saved"><div class="specific-id" style="display:none;"><span class="saved-id">'.esc_attr($car[0]).'</span></div><a href="#"><i class="icon-delete"></i></a></div>
                                        </li>';
                                        if($total++==2) { break; } }
                                        }
                                        else { echo '<li class="blank">'.__('No Saved Yachts yet','framework').'</li>'; }
                                    } }
                                    if(!empty($_SESSION['saved_vehicle_id1'])) {
                                    $highlighted_specs = $imic_options['highlighted_specs'];
                                    $new_highlighted_specs = imic_filter_lang_specs_admin($highlighted_specs, $_SESSION['saved_vehicle_id1']);
                                    $highlighted_specs = $new_highlighted_specs;
                                    $unique_specs = $imic_options['unique_specs'];
                                    $specifications = get_post_meta($_SESSION['saved_vehicle_id1'],'feat_data',true);
                                    $unique_value = imic_vehicle_price($_SESSION['saved_vehicle_id1'],$unique_specs,$specifications);
                                    $highlight_value = imic_vehicle_title($_SESSION['saved_vehicle_id1'],$highlighted_specs,$specifications); ?>
                                        <li>
                                            <div class="checkb"><input value="0" id="saved-<?php echo esc_attr($_SESSION["saved_vehicle_id1"]); ?>" class="compare-check" type="checkbox"></div>
                                            <div class="imageb"><a href="<?php echo esc_url(get_permalink($_SESSION['saved_vehicle_id1'])); ?>"><?php echo get_the_post_thumbnail($_SESSION['saved_vehicle_id1']); ?></a></div>
                                            <div class="textb">
                                                <a href="<?php echo esc_url(get_permalink($_SESSION['saved_vehicle_id1'])); ?>"><?php echo esc_attr($highlight_value); ?></a>
                                                <span class="price"><?php echo esc_attr($unique_value); ?></span>
                                            </div>
                                            <div id="one" class="delete session-save-car"><a href="#"><i class="icon-delete"></i></a></div>
                                        </li><?php } if(!empty($_SESSION['saved_vehicle_id2'])) {
                                            $highlighted_specs = $imic_options['highlighted_specs'];
                                            $new_highlighted_specs = imic_filter_lang_specs_admin($highlighted_specs, $_SESSION['saved_vehicle_id2']);
                                            $highlighted_specs = $new_highlighted_specs;
                                    $unique_specs = $imic_options['unique_specs'];
                                    $specifications = get_post_meta($_SESSION['saved_vehicle_id2'],'feat_data',true);
                                    $unique_value = imic_vehicle_price($_SESSION['saved_vehicle_id2'],$unique_specs,$specifications);
                                    $highlight_value = imic_vehicle_title($_SESSION['saved_vehicle_id2'],$highlighted_specs,$specifications); ?>
                                        <li>
                                            <div class="checkb"><input value="0" id="saved-<?php echo esc_attr($_SESSION["saved_vehicle_id2"]); ?>" class="compare-check" type="checkbox"></div>
                                            <div class="imageb"><a href="<?php echo esc_url(get_permalink($_SESSION['saved_vehicle_id2'])); ?>"><?php echo get_the_post_thumbnail($_SESSION['saved_vehicle_id2']); ?></a></div>
                                            <div class="textb">
                                                <a href="<?php echo esc_url(get_permalink($_SESSION['saved_vehicle_id2'])); ?>"><?php echo esc_attr($highlight_value); ?></a>
                                                <span class="price"><?php echo esc_attr($unique_value); ?></span>
                                            </div>
                                            <div id="two" class="delete session-save-car"><a href="#"><i class="icon-delete"></i></a></div>
                                        </li><?php } if(!empty($_SESSION['saved_vehicle_id3'])) {
                                            $highlighted_specs = $imic_options['highlighted_specs'];
                                            $new_highlighted_specs = imic_filter_lang_specs_admin($highlighted_specs, $_SESSION['saved_vehicle_id3']);
                                            $highlighted_specs = $new_highlighted_specs;
                                    $unique_specs = $imic_options['unique_specs'];
                                    $specifications = get_post_meta($_SESSION['saved_vehicle_id3'],'feat_data',true);
                                    $unique_value = imic_vehicle_price($_SESSION['saved_vehicle_id3'],$unique_specs,$specifications);
                                    $highlight_value = imic_vehicle_title($_SESSION['saved_vehicle_id3'],$highlighted_specs,$specifications); ?>
                                        <li>
                                            <div class="checkb"><input value="0" id="saved-<?php echo esc_attr($_SESSION["saved_vehicle_id3"]); ?>" class="compare-check" type="checkbox"></div>
                                            <div class="imageb"><a href="<?php echo esc_url(get_permalink($_SESSION['saved_vehicle_id3'])); ?>"><?php echo get_the_post_thumbnail($_SESSION['saved_vehicle_id3']); ?></a></div>
                                            <div class="textb">
                                                <a href="<?php echo esc_url(get_permalink($_SESSION['saved_vehicle_id3'])); ?>"><?php echo esc_attr($highlight_value); ?></a>
                                                <span class="price"><?php echo esc_attr($unique_value); ?></span>
                                            </div>
                                            <div id="three" class="delete session-save-car"><a href="#"><i class="icon-delete"></i></a></div>
                                        </li><?php } if(!empty($_SESSION['saved_vehicle_id1'])&&!empty($_SESSION['saved_vehicle_id2'])&&!empty($_SESSION['saved_vehicle_id3'])) {
                                            echo '<li>'.__('Please login/register to add more','framework').'</li>';
                                        } if(empty($_SESSION['saved_vehicle_id1'])&&empty($_SESSION['saved_vehicle_id2'])&&empty($_SESSION['saved_vehicle_id3'])&&empty($saved_cars)&&(!is_user_logged_in())) {
                                        echo '<li class="blank">'.__('No Saved Yachts yet','framework').'</li>'; } ?>
                                        
                                    </ul>
                                </div>
                                <div class="tool-box-foot">
                                    <?php if ( !is_user_logged_in() ) { ?><a href="#" data-target="#PaymentModal" data-toggle="modal" class="btn btn-xs btn-primary pull-right"><?php _e('Signin/Join','framework'); ?></a><?php } if((!empty($_SESSION['saved_vehicle_id1'])||!empty($_SESSION['saved_vehicle_id2'])||!empty($_SESSION['saved_vehicle_id3']))&&(is_user_logged_in())) { echo '<a href="#" rel="popup-save" class="btn btn-xs btn-primary pull-right save-car"><div class="vehicle-details-access" style="display:none;"><span class="vehicle-id">unsaved</span></div>Save</a>'; } ?>
                                    <a href="<?php echo esc_url(imic_get_template_url("template-compare.php")); ?>" class="btn btn-xs btn-info compare-in-box" disabled><?php _e('Compare','framework'); ?>()</a>
                                </div>
                            </div>
                        </li>
                        <li><a href="#"><i class="fa fa-folder-o"></i></a>
                            <div class="tool-box">
                                <div class="tool-box-head">
                                <?php
                                    $user_id = get_current_user_id( );
                                        $user_info_id = get_user_meta($user_id,'imic_user_info_id',true);
                                        $search_cars = get_post_meta($user_info_id,'imic_user_saved_search',true);
                                 if(is_user_logged_in()&&!empty($search_cars)) { ?>
                                    <a href="<?php echo esc_url(add_query_arg('search',1,$listing_page_url)); ?>" class="basic-link pull-right"><?php _e('View all','framework'); ?></a><?php } ?>
                                    <h5><?php _e('Saved searches','framework'); ?></h5>
                                </div>
                                <div class="tool-box-in">
                                    <ul id="search-saved" class="listing tool-search-listing">
                                    <?php if((!isset($_SESSION['search_page1']))&&(!isset($_SESSION['search_page2']))&&(!isset($_SESSION['search_page3']))) { if ( is_user_logged_in() ) {
                                        
                                        if(!empty($search_cars)) {
                                            $total = 0;
                                            foreach($search_cars as $search) {
                                                $res = preg_replace("/[^a-zA-Z]/", "", $search[0]);
                                            echo '<li>
                                            <div class="link"><a href="'.esc_url($search[2]).'">'.esc_attr($search[0]).'</a></div>
                                            <div id="specific-search-ad" class="delete delete-box-search"><div class="specific-id" style="display:none;"><span class="search-id">'.esc_attr($res).'</span></div><a href="#"><i class="icon-delete"></i></a></div>
                                        </li>'; if($total++==3) { break; } }
                                        }
                                    else {
                                        echo '<li id="blank-search">
                                            <div class="link">'.__('No Saved Searches Yet','framework').'</div>
                                        </li>';
                                    }
                                    }
                                    }
                                    if(!empty($_SESSION['search_page1'])) {
                                        $values = $_SESSION['search_page1']; ?>
                                        <li>
                                            <div class="link"><a href="<?php echo esc_url($values[1]); ?>"><?php echo esc_attr($values[0]); ?></a></div>
                                            <div id="four" class="delete session-save-car"><a href="#"><i class="icon-delete"></i></a></div>
                                        </li><?php } if(!empty($_SESSION['search_page2'])) {
                                                $values = $_SESSION['search_page2']; ?>
                                        <li>
                                            <div class="link"><a href="<?php echo esc_url($values[1]); ?>"><?php echo esc_attr($values[0]); ?></a></div>
                                            <div id="four" class="delete session-save-car"><a href="#"><i class="icon-delete"></i></a></div>
                                        </li><?php } if(!empty($_SESSION['search_page3'])) {
                                                $values = $_SESSION['search_page3']; ?>
                                        <li>
                                            <div class="link"><a href="<?php echo esc_url($values[1]); ?>"><?php echo esc_attr($values[0]); ?></a></div>
                                            <div id="four" class="delete session-save-car"><a href="#"><i class="icon-delete"></i></a></div>
                                        </li><?php } else { '<li>'.__('No saved searches yet','framework').'</li>'; } if(!empty($_SESSION['search_page1'])&&!empty($_SESSION['search_page2'])&&!empty($_SESSION['search_page3'])) { echo '<li>'.__('Please login/register to add more','framework').'</li>'; }
                                        if(empty($_SESSION['search_page1'])&&empty($_SESSION['search_page2'])&&empty($_SESSION['search_page3'])&&empty($search_cars)&&(!is_user_logged_in())) {
                                        echo '<li id="blank-search">
                                            <div class="link">'.__('No Saved Searches Yet','framework').'</div>
                                        </li>'; } ?>
                                    </ul>
                                </div>
                                <div class="tool-box-foot">
                                <?php if ( !is_user_logged_in() ) { ?><a href="#" data-target="#PaymentModal" data-toggle="modal" class="btn btn-xs btn-primary pull-right"><?php _e('Signin/Join','framework'); ?></a><?php } if((!empty($_SESSION['search_page1']))||(!empty($_SESSION['search_page2']))||(!empty($_SESSION['search_page3']))&&(is_user_logged_in())) { echo '<a href="#" id="popup-search" class="btn btn-xs btn-primary pull-right save-search"><div class="vehicle-details-access" style="display:none;"><span class="vehicle-id">unsaved</span></div>Save</a>'; } ?>
                                </div>
                            </div>
                        </li>
                        <li><a href="#"><i class="fa fa-clock-o"></i></a>
                            <div class="tool-box">
                                <div class="tool-box-head">
                                    <h5><?php _e('Recently viewed yachts','framework'); ?></h5>
                                </div>
                                <div class="tool-box-in">
                                    <ul id="viewed-cars-listbox" class="listing tool-car-listing">
                                    <li id="blank-viewed">
                                    <div class="textb">
                                                <?php echo _e('You do not have any viewed listings yet','framework'); ?>
                                    </div>
                                    </li>
                                        <?php 
                                    if(!empty($_SESSION['viewed_vehicle_id1'])) {
                                    $highlighted_specs = $imic_options['highlighted_specs'];
                                    $new_highlighted_specs = imic_filter_lang_specs_admin($highlighted_specs, $_SESSION['viewed_vehicle_id1']);
                                    $highlighted_specs = $new_highlighted_specs;
                                    $unique_specs = $imic_options['unique_specs'];
                                    $specifications = get_post_meta($_SESSION['viewed_vehicle_id1'],'feat_data',true);
                                    $unique_value = imic_vehicle_price($_SESSION['viewed_vehicle_id1'],$unique_specs,$specifications);
                                    $highlight_value = imic_vehicle_title($_SESSION['viewed_vehicle_id1'],$highlighted_specs,$specifications); ?>
                                    
                                        <li>
                                            <div class="checkb"><input value="0" id="view-<?php echo esc_attr($_SESSION["viewed_vehicle_id1"]); ?>" class="compare-viewed" type="checkbox"></div>
                                            <div class="imageb"><a href="<?php echo esc_url(get_permalink($_SESSION['viewed_vehicle_id1'])); ?>"><?php echo get_the_post_thumbnail($_SESSION['viewed_vehicle_id1']); ?></a></div>
                                            <div class="textb">
                                                <a href="<?php echo esc_url(get_permalink($_SESSION['viewed_vehicle_id1'])); ?>"><?php echo esc_attr($highlight_value); ?></a>
                                                <span class="price"><?php echo esc_attr($unique_value); ?></span>
                                            </div>
                                            <div id="seven" class="delete session-save-car"><a href="#"><i class="icon-delete"></i></a></div>
                                        </li><?php } if(!empty($_SESSION['viewed_vehicle_id2'])) {
                                            $highlighted_specs = $imic_options['highlighted_specs'];
                                            $new_highlighted_specs = imic_filter_lang_specs_admin($highlighted_specs, $_SESSION['viewed_vehicle_id2']);
                                            $highlighted_specs = $new_highlighted_specs;
                                    $unique_specs = $imic_options['unique_specs'];
                                    $specifications = get_post_meta($_SESSION['viewed_vehicle_id2'],'feat_data',true);
                                    $unique_value = imic_vehicle_price($_SESSION['viewed_vehicle_id2'],$unique_specs,$specifications);
                                    $highlight_value = imic_vehicle_title($_SESSION['viewed_vehicle_id2'],$highlighted_specs,$specifications); ?>
                                        <li>
                                            <div class="checkb"><input value="0" id="view-<?php echo esc_attr($_SESSION["viewed_vehicle_id2"]); ?>" class="compare-viewed" type="checkbox"></div>
                                            <div class="imageb"><a href="<?php echo esc_url(get_permalink($_SESSION['viewed_vehicle_id2'])); ?>"><?php echo get_the_post_thumbnail($_SESSION['viewed_vehicle_id2']); ?></a></div>
                                            <div class="textb">
                                                <a href="<?php echo esc_url(get_permalink($_SESSION['viewed_vehicle_id2'])); ?>"><?php echo esc_attr($highlight_value); ?></a>
                                                <span class="price"><?php echo esc_attr($unique_value); ?></span>
                                            </div>
                                            <div id="eight" class="delete session-save-car"><a href="#"><i class="icon-delete"></i></a></div>
                                        </li><?php } if(!empty($_SESSION['viewed_vehicle_id3'])) {
                                            $highlighted_specs = $imic_options['highlighted_specs'];
                                            $new_highlighted_specs = imic_filter_lang_specs_admin($highlighted_specs, $_SESSION['viewed_vehicle_id3']);
                                            $highlighted_specs = $new_highlighted_specs;
                                    $unique_specs = $imic_options['unique_specs'];
                                    $specifications = get_post_meta($_SESSION['viewed_vehicle_id3'],'feat_data',true);
                                    $unique_value = imic_vehicle_price($_SESSION['viewed_vehicle_id3'],$unique_specs,$specifications);
                                    $highlight_value = imic_vehicle_title($_SESSION['viewed_vehicle_id3'],$highlighted_specs,$specifications); ?>
                                        <li>
                                            <div class="checkb"><input value="0" id="view-<?php echo esc_attr($_SESSION["viewed_vehicle_id3"]); ?>" class="compare-viewed" type="checkbox"></div>
                                            <div class="imageb"><a href="<?php echo esc_url(get_permalink($_SESSION['viewed_vehicle_id3'])); ?>"><?php echo get_the_post_thumbnail($_SESSION['viewed_vehicle_id3']); ?></a></div>
                                            <div class="textb">
                                                <a href="<?php echo esc_url(get_permalink($_SESSION['viewed_vehicle_id3'])); ?>"><?php echo esc_attr($highlight_value); ?></a>
                                                <span class="price"><?php echo esc_attr($unique_value); ?></span>
                                            </div>
                                            <div id="nine" class="delete session-save-car"><a href="#"><i class="icon-delete"></i></a></div>
                                        </li><?php } ?>
                                    </ul>
                                </div>
                                <div class="tool-box-foot">
                                    <a href="<?php echo imic_get_template_url("template-compare.php"); ?>" class="btn btn-xs btn-info compare-viewed-box" disabled><?php _e('Compare','framework'); ?>()</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 col-sm-9">
                    <div class="btn-group pull-right results-sorter">
                        <button type="button" class="btn btn-default listing-sort-btn"><?php _e('Sort by','framework'); ?></button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <span class="caret"></span>
                          <span class="sr-only"><?php _e('Toggle Dropdown','framework'); ?></span>
                        </button>
                        <?php $sorting_specs = get_post_meta(get_the_ID(),'imic_sort_by_specification',false); ?>   
                        <ul class="dropdown-menu sorter">
                        <?php foreach($sorting_specs as $sort) { ?>
                            <li class="sort-para"><div style="display:none;"><span class="price-var"><?php echo esc_attr("int_".imic_the_slug($sort)); ?></span><span class="price-val"><?php echo esc_attr(1000000000); ?></span><span class="price-order"><?php _e('DESC','framework'); ?></span></div><a href="javascript:void(0);"><?php echo get_the_title($sort); _e(' (High to Low)','framework'); ?></a></li>
                            <li class="sort-para"><div style="display:none;"><span class="price-var"><?php echo esc_attr("int_".imic_the_slug($sort)); ?></span><span class="price-val"><?php echo esc_attr(1000000000); ?></span><span class="price-order"><?php _e('ASC','framework'); ?></span></div><a href="javascript:void(0);"><?php echo get_the_title($sort); _e(' (Low to Hight)','framework'); ?></a></li>
                        <?php } ?>
                        </ul>
                    </div>
                    
                    <div class="toggle-view view-count-choice pull-right">
                        <label><?php _e('Show','framework'); ?></label>
                        <div id="quick-paginate" class="btn-group">
                            <a href="#" class="btn btn-default">10</a>
                            <a href="#" class="btn btn-default">20</a>
                            <a href="#" class="btn btn-default">50</a>
                        </div>
                    </div>
                    
                    <div class="toggle-view view-format-choice pull-right" style="display:none;">
                        <label><?php _e('View','framework'); ?></label>
                        <div class="btn-group">
                            <a href="#" class="btn btn-default <?php echo esc_attr($active_listing); ?>" id="results-list-view"><i class="fa fa-th-list"></i></a>
                            <a href="#" class="btn btn-default <?php echo esc_attr($active_grid); ?>" id="results-grid-view"><i class="fa fa-th"></i></a>
                        </div>
                    </div>
                    <!-- Small Screens Filters Toggle Button -->
                    <button class="btn btn-default visible-xs" id="Show-Filters"><?php _e('Search Filters','framework'); ?></button> 
                </div>
            </div>
            
        </div>
    </div>
<!-- Start Body Content -->
    <div class="main" role="main">
        <div id="content" class="content full">
            <div class="container">
            <?php
            $filters_type = (isset($imic_options['filters_type']))?$imic_options['filters_type']:'';
            if(is_plugin_active("imi-classifieds/imi-classified.php")) 
            {
                
                $selected_cat = get_query_var('list-cat');
                $data_page = ($filters_type==1)?'yes':'';
                $list_termss = array();
                if($selected_cat) 
                {
                    $category_ids = get_term_by('slug', $selected_cat, 'listing-category');
                    $term_ids = $category_ids->term_id;
                    $parent = get_ancestors( $term_ids, 'listing-category' );
                    foreach($parent as $parents)
                    {
                        $list_term = get_term_by('id', $parents, 'listing-category');
                        $list_termss[] = $list_term->slug;
                    }
                    $list_termss[] = $selected_cat; 
                }
                $listing_cats = get_terms('listing-category',array('parent' => 0,'number' => 10,'hide_empty' => false));
                if(!empty($listing_cats))
                {
                    echo '<div class="row parent-category-row">';
                    echo '<div class="col-md-3 col-sm-3 act-cat" id="list-1">';
                    echo '<label>'.__('Select Category').'</label>';
                    echo '<select data-page="'.$data_page.'" data-empty="true" name="list-cat" class="form-control selectpicker get-child-cat">';
                    echo '<option value="" selected disabled>'.__('Select','framework').'</option>';
                    $this_cat = $act = '';
                    foreach($listing_cats as $cat)
                    {
                        $term_children = get_terms('listing-category',array('parent' => $cat->term_id));
                        $disabled = (empty($term_children))?'blank':'';
                        if($this_cat!="selected"&&$act!=1)
                        {
                            $cat_id = (in_array($cat->slug,$list_termss))?$cat->term_id:'';
                            $counter = (in_array($cat->slug,$list_termss))?1:0;
                        }
                        $this_cat = (in_array($cat->slug,$list_termss))?'selected':'';
                        if($this_cat=="selected") { $act = 1; }
                        echo '<option '.$this_cat.' data-val="'.$disabled.'" value="'.$cat->slug.'">'.$cat->name.'</option>';
                    }
                    echo '</select>';
                    echo '</div>';
                    if(get_query_var('list-cat'))
                    {
                        while(($counter<=count($list_termss))&&($cat_id!=''))
                        {
                            $meet = 0;
                            $listing_cats = get_terms('listing-category',array('parent' => $cat_id));
                            if(!empty($listing_cats))
                            {
                                echo '<div class="col-md-3 col-sm-3 act-cat" id="list-'.($counter+1).'">';
                                echo '<label>'.__('Select Category').'</label>';
                                echo '<select data-page="'.$data_page.'" data-empty="true" name="list-cat" class="form-control selectpicker get-child-cat">';
                                echo '<option value="" selected disabled>'.__('Select','framework').'</option>';
                                $this_cat = $act = '';
                                foreach($listing_cats as $cat)
                                {
                                    $term_children = get_term_children($cat->term_id, 'listing-category');
                                    $disabled = (empty($term_children))?'blank':'';
                                    if($this_cat!="selected"&&$act!=1)
                                    {
                                        $cat_id = (in_array($cat->slug,$list_termss))?$cat->term_id:'';
                                    }
                                    $this_cat = (in_array($cat->slug,$list_termss))?'selected':'';
                                    if($this_cat=="selected") { $act = 1; }
                                    echo '<option '.$this_cat.' data-val="'.$disabled.'" value="'.$cat->slug.'">'.$cat->name.'</option>';
                                }
                                echo '</select>';
                                echo '</div>'; 
                            }
                            $counter++;
                        }
                    }
                    echo '<div class="col-md-3 col-sm-3 loading-fields" id="loading-field" style="display:none;"><label>'.__('Select Category','framework').'</label><input class="form-control" type="text" value="'.__('Loading...','framework').'"></div></div>';
                }
            }?>
            <?php 
                $post_author_id = get_post_field( 'post_author', get_the_ID() );
                $userFirstName = get_the_author_meta('first_name', $post_author_id);
                $userLastName = get_the_author_meta('last_name', $post_author_id);
                $user_data = get_userdata(intval($post_author_id));
                $userName = $user_data->display_name;
            ?>
            
            <div class="row">
            <div class="col-md-12">
            <ul class="search-tabs nav nav-pills" id="search-tab">
            <?php if(!empty($qrs)) { foreach($qrs as $key=>$value) {
                if(!get_query_var($key)&&$key!="order"&&$key!="pg"&&$key!="pagin"&&$key!="list-cat") {
                if($value!='') {
            echo '<li id="'.urldecode($key).'"><a href="javascript:void(0);">'.urldecode($value).' <i class="fa fa-times"></i></a></li>';
                } }
            } } ?>
            </ul>
            </div></div>
                <div class="row" id="listing-with-filter">
                    <!-- Search Filters -->
                    <?php $class_list = 12;
                    $search_filters = $list_terms_ids = $list_terms_slug = array();
                    $search_filter_custom = get_option('imic_classifieds');
                    if((get_query_var('list-cat'))&&(!empty($search_filter_custom)))
                    {
                        $category_slug = get_term_by('slug', get_query_var('list-cat'), 'listing-category');
                        $term_id = $category_slug->term_id;
                        $parents = get_ancestors( $term_id, 'listing-category' );
                        $list_terms = array();
                        foreach($parents as $parent)
                        {
                            $list_term = get_term_by('id', $parent, 'listing-category');
                            $list_terms_slug[] = $list_term->slug;
                            $list_terms_ids[] = $list_term->term_id;
                        }
                        $search_filter_custom = get_option('imic_classifieds');
                    if(!empty($search_filter_custom))
                    {
                    foreach($search_filter_custom as $key=>$value)
                    {
                        if($key==$term_id)
                        {
                            $filters = $value['filter'];
                            if($filters!='')
                            {
                                $search_filters = explode(',',$filters);
                            }
                            break;
                        }
                        else
                        {
                            foreach($list_terms_ids as $id)
                            {
                                if($key==$id)
                                {
                                    $filters = $value['filter'];
                                    if($filters!='')
                                    {
                                        $search_filters = explode(',',$filters);
                                    }
                                    break;
                                }
                            }
                        }
                    }
                    }
                    }
                    else
                    { 
                    $search_filters = (isset($imic_options['search_filter_listing']))?$imic_options['search_filter_listing']:array();
                    }
                                if(!empty($search_filters)) { ?>
                    <div class="col-md-3 search-filters" id="Search-Filters">
                        <div class="filters-sidebar">
                            <h3><?php _e('Refine Search','framework'); ?></h3>
                            <div class="accordion" id="toggleArea">
                                <?php $series = 1;
                                                                $new_search_filters = imic_filter_lang_specs($search_filters);
                                                                $numeric_specs_type = (isset($imic_options['integer_specs_type']))?$imic_options['integer_specs_type']:0;
                                foreach($new_search_filters as $filter) {
                                $integer = get_post_meta($filter,'imic_plugin_spec_char_type',true);
                                $tabs = get_post_meta($filter,'specifications_value',true);
                                $value_label = get_post_meta($filter, 'imic_plugin_value_label', true);
                                $spec_slug = imic_the_slug($filter);
                                if($integer==0) {
                                    $slug = $spec_slug;
                                    $comparision = "";
                                 }
                                elseif($integer==1) {
                                    if($numeric_specs_type==0)
                                    {
                                        $slug = "int_".$spec_slug;
                                        $comparision = "<span>".__("Less Than ","framework").'</span>';
                                    }
                                    else
                                    {
                                        $slug = "range_".$spec_slug;
                                        $comparision = '';
                                        $min_val = get_post_meta($filter, 'imic_plugin_range_min_value', true);
                                        $max_val = get_post_meta($filter, 'imic_plugin_range_max_value', true);
                                        $steps = get_post_meta($filter, 'imic_plugin_range_steps', true);
                                        $min_val = ($min_val!='')?$min_val:0;
                                        $max_val = ($max_val!='')?$max_val:100000;
                                        $steps = ($steps!='')?$steps:1000;
                                    }
                                }
                                else {
                                    $slug = "char_".$spec_slug;
                                    $comparision = '';
                                }
                                $get_child_filter = (imic_get_child_values_status($tabs)==1)?'get-child-filter':'';
                                $slider_range_step = (isset($imic_options['range_steps']))?$imic_options['range_steps']:100;
                                ?>
                                <!-- Filter by Make -->
                                <div class="accordion-group panel">
                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseTwo-<?php echo esc_attr($series); ?>"><?php echo get_the_title($filter); ?><i class="fa fa-angle-down"></i> </a> </div>
                                    <div id="collapseTwo-<?php echo esc_attr($series); ?>" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            <ul data-ids="<?php echo 'fieldfltr-'.($filter+2648); ?>" id="<?php echo esc_attr($slug); ?>" class="filter-options-list list-group search-fields">
                                            <?php if($integer==1&&$numeric_specs_type==1) { ?>
                                            <li><b><?php echo esc_attr($value_label); ?> <span class="left"><?php echo esc_attr($min_val); ?></span> - 
<span class="right"><?php echo esc_attr($max_val); ?></span></b> <input id="ex2" type="text" class="span2" value="" data-slider-min="<?php echo esc_attr($min_val); ?>" data-slider-max="<?php echo esc_attr($max_val); ?>" data-slider-step="<?php echo esc_attr($steps); ?>" data-slider-value="[<?php echo esc_attr($min_val); ?>,<?php echo esc_attr($max_val); ?>]" data-imic-start="" data-imic-end=""/>
<br />
<!--<span class="left">0</span> - 
<span class="right">10000</span>-->
<a data-range="0-10000" class="range-val btn-primary btn-sm btn"><?php _e('Filter', 'framework'); ?></a></li>
                                            <?php } else { 
                                                                                        foreach($tabs as $tab) {
                                                if($series==1) { $prefix = ''; } else { $prefix = ''; }
                                                if($integer==0) {
                                                    $specification = "feat_data"; }
                                                else {
                                                    $specification = $slug; }
                                                $total_cars = imic_count_cars_by_specification($specification,$tab['imic_plugin_specification_values'], get_query_var('list-cat')); ?>
                                                <li class="list-group-item"><span class="badge"><?php echo esc_attr($total_cars); ?></span><?php echo $comparision; ?><a class="<?php echo $get_child_filter; ?>" href="#"><?php echo esc_attr($prefix.$tab['imic_plugin_specification_values']); ?></a></li>
                                            <?php } } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php if(imic_get_child_values_status($tabs)==1) {
                                    $child_label = get_post_meta($filter,'imic_plugin_sub_field_label',true);
                                            echo '<div id="fieldfltr-'.(($filter*111)+2648).'">';
                                            echo '<div class="accordion-group panel">
                                    <div class="accordion-heading togglize"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#" href="#collapseTwo-sub'.esc_attr($series).'">'.$child_label.'<i class="fa fa-angle-down"></i> </a> </div>
                                    <div id="collapseTwo-sub'.esc_attr($series).'" class="accordion-body collapse">
                                        <div class="accordion-inner">
                                            <ul id="sub-'.esc_attr($slug).'" class="filter-options-list list-group search-fields">';
                                            echo '<li>'.__('Select ', 'framework').get_the_title($filter).'</li>';
                                            echo '</ul>
                                        </div>
                                    </div>
                                </div>';
                                        echo '</div>';
                                    
                                } ?>
                                <?php $series++; } ?>
                            </div>
                            <?php }
                    if(!empty($search_filters)) {
                        
                    }
                    else
                    {
                        echo ' <div class="col-md-3 search-filters">
                        <div class="filters-sidebar">';
                    }
                        $list_tags = array();
                        $tag = '';
                        $term_slug = get_query_var('list-cat');
                        if($term_slug!='')
                        {
                            $listing_tags = get_terms('yachts-tag',array('hide_empty'=>true));
                            foreach($listing_tags as $tag)
                            {
                                $tag_description = get_option("taxonomy_".$tag->term_id."_metas");
                                $tag_descriptions = explode(',',$tag_description['cats']);
                                if (in_array($term_slug,$tag_descriptions))
                                {
                                    $list_tags[] = $tag->slug;
                                }
                                else
                                {
                                    foreach($list_terms_slug as $slug_c)
                                    {
                                        if (in_array($slug_c,$tag_descriptions))
                                        {
                                            $list_tags[] = $tag->slug;
                                            break;
                                        }
                                    }
                                }
                            }
                        } ?>
                            
                                            <?php if(!empty($list_tags))
                                            {
                                                echo '<h3>'.__('Deep Search','framework').'</h3>
                                                <div class="widget_tag_cloud matched-tags-list">';
                                            foreach($list_tags as $tab) 
                                            {
                                                $tag_name = get_term_by('slug', $tab, 'yachts-tag');
                                                echo '<a href="javascript:void(0);" class="">'.$tag_name->name.'</a>';
                                            } 
                                            echo '</div><br/>';
                                            }
                                            else
                                            {
                                                //echo '<a href="javascript:void(0);">'.__('Tags not found, search using filters or category.','framework').'</li>';
                                            }?>
                                
                                <!-- End Toggle -->
                            <a href="#" id="reset-filters-search" class="btn-default btn-sm btn" style="display: block; margin: 5px;"><i class="fa fa-refresh"></i> <?php _e('Reset search','framework'); ?></a>
                            <a id="" href="#" class="btn-default btn-sm btn" data-target="#searchmodal" data-toggle="modal" style="display: block; margin: 5px;"><div class="vehicle-details-access" style="display:none;"><span class="vehicle-id"><?php echo esc_attr(get_the_ID()); ?></span></div><i class="fa fa-folder-o"></i> <?php _e('Save search','framework'); ?></a>
                            <!-- <a id="saved-search" href="#" class="btn-primary btn-sm btn" data-target="#searchmodal" data-toggle="modal" style="display: block; margin: 5px;"><div class="vehicle-details-access" style="display:none;"><span class="vehicle-id"><?php echo esc_attr(get_the_ID()); ?></span></div><i class="fa fa-folder-o"></i> <?php _e('Save search','framework'); ?></a> -->
                            <a href="#" data-toggle="modal" class="btn-primary btn-sm btn" data-target="#alertModal" title="<?php echo esc_attr_e('Yacht Alerts','framework'); ?>" style="display: block; margin: 5px;"><i class="fa icon-alarm-clock"></i> <?php echo esc_attr_e('Yacht Alerts','framework'); ?></a>
                    <?php $class_list = 9;
                        echo ' </div>
                        </div>';
                    ?>

                    <!-- Listing Results -->
                    <div class="col-md-<?php echo esc_attr($class_list); ?> results-container">
                        <div class="results-container-in">
                            <div class="waiting" style="display:none;">
                                <div class="spinner">
                                    <div class="rect1"></div>
                                    <div class="rect2"></div>
                                    <div class="rect3"></div>
                                    <div class="rect4"></div>
                                    <div class="rect5"></div>
                                </div>
                            </div>
                            <div id="results-holder" class="results-<?php echo esc_attr($listing_type); ?>-view">
                                <?php $paged = (get_query_var('paged'))?get_query_var('paged'):''; $arrays = $term_array = array(); 
                                $value = $pagin = $offset = $have_int = $off = ''; $count = 1; 
if(!empty($qrs)) 
{ 
    foreach($qrs as $key=>$value)
  {
    if(!get_query_var($key)&&$key!="lang") 
    {
    $count = count($arrays);
        if(($value=="ASC")||($value=="DESC")) 
        {
            $order = $value;
        } 
        elseif($key=="pg") 
        {
            $posts_page = $value;
            $off = $value;
        }
        elseif($key=="paged") 
        {
            $paged = $value;
            $posts_page = get_option('posts_per_page');
        }
        elseif($key=='specification-search')
        {
            $sval = explode('%20', $value);
            foreach($sval as $val)
            {
                $arrays[$count+1] = array(
                    'key' => 'feat_data',
                    'value' =>  urldecode($val),
                    'compare' => 'LIKE'
                    );
                    $count++;
            }
        }
        else 
        {
            if (strpos($key,'int_') !== false||strpos($key,'range_') !== false) {
            if(strpos($key,'range_') !== false)
            {
                $new_val = explode("-", $value);
                $value = $new_val[1];
                $pm_value = $new_val[0];
                $key = explode("_", $key);
                $key = "int_".$key[1];
                $arrays[$count++] = array(
                    'key' => $key,
                    'value' =>  $pm_value,
                    'compare' => '>=',
                                        'type' => 'numeric'
                    );
            }
            $arrays[$count] = array(
                    'key' => $key,
                    'value' =>  $value,
                    'compare' => '<=',
                                        'type' => 'numeric'
                    );
                    $have_int = 1;
        }
                elseif ((strpos($key,'char_') !== false)||(strpos($key,'child_') !== false)) 
                {
                    $value = str_replace('%20', ' ', $value);
                    $arrays[$count] = array(
                        'key' => $key,
                        'value' =>  $value,
                        'compare' => '=',
                    );
                } 
                else 
                {
                            $sval_arr = str_replace('%20', ' ', $value);
                    $arrays[$count] = array(
                        'key' => 'feat_data',
                        'value' =>  serialize(strval(urldecode($sval_arr))),
                        'compare' => 'LIKE'
                    ); 
                }
            }
            $count++; 
        }
        elseif($key=="list-cat")
        { 
            $term_array[0] = array(
                'taxonomy' => 'listing-category',
                'field' => 'slug',
                'terms' => $value,
                'operator' => 'IN');
        } 
   
   } 
   
   } 
    $arrays[$count++] = array('key'=>'imic_plugin_ad_payment_status','value'=>'1','compare'=>'=');
    $arrays[$count++] = array('key'=>'imic_plugin_listing_end_dt','value'=>date('Y-m-d'),'compare'=>'>=');
    if($paged==1) { $offset = $off; 
    }
    elseif($paged>1) { $offs = $paged-1; $offset = $off+($posts_page*$offs);
    }   
    $logged_user_pin = ''; 
    global $current_user;         
    $user_id = get_current_user_id( );
                                        $logged_user = get_user_meta($user_id,'imic_user_info_id',true);

                                        $loggedUserFirstName = $current_user->user_firstname;
                                        $loggedUserLastName = $current_user->user_lastname;
                                        $loggedUserName = get_the_author_meta( 'display_name', $user_id );
                                        if(!empty($loggedUserFirstName) || !empty($loggedUserLastName)) {
                                            $loggedUserName = $loggedUserFirstName .' '. $loggedUserLastName; 
                                        }
                                        $loggedUserEmail = $current_user->user_email;

                                        $logged_user_pin = get_post_meta($logged_user,'imic_user_zip_code',true);
                                        $badges_type = (isset($imic_options['badges_type']))?$imic_options['badges_type']:'0';
                                        $specification_type = (isset($imic_options['short_specifications']))?$imic_options['short_specifications']:'0';
                                        if($badges_type=="0")
                                        {
                                            $badge_ids = (isset($imic_options['badge_specs']))?$imic_options['badge_specs']:array();
                                        }
                                        else
                                        {
                                            $badge_ids = array();
                                        }
                                        $img_src = '';
                                        $additional_specs = (isset($imic_options['additional_specs']))?$imic_options['additional_specs']:'';
                                        if($specification_type==0)
                                        {
                                            $detailed_specs = (isset($imic_options['specification_list']))?$imic_options['specification_list']:array();
                                        }
                                        else
                                        {
                                            $detailed_specs = array();
                                        }
                                        $detailed_specs = imic_filter_lang_specs($detailed_specs);
                                        $category_rail = (isset($imic_options['category_rail']))?$imic_options['category_rail']:'0';
                                        $additional_specs_all = get_post_meta($additional_specs,'specifications_value',true);
                                        $highlighted_specs = (isset($imic_options['highlighted_specs']))?$imic_options['highlighted_specs']:array();
                                        $unique_specs = (isset($imic_options['unique_specs']))?$imic_options['unique_specs']:'';
                                        if($have_int==1)
                                        {   
                                            $args_cars = array ('post_type'=>'yachts','orderby' => 'meta_value_num','order' => $order,'tax_query'=>$term_array,'meta_query' => $arrays,'posts_per_page'=>$posts_page,'post_status'=>'publish','offset'=>$offset);
$cars_listing = new WP_Query( $args_cars ); 
                                        }
                                        else
                                        {
                                            $args_cars = array ('post_type'=>'yachts','order' => $order,'tax_query'=>$term_array,'meta_query' => $arrays,'posts_per_page'=>$posts_page,'post_status'=>'publish','offset'=>$offset);
$cars_listing = new WP_Query( $args_cars ); 
                                        }
                                    if ( $cars_listing->have_posts() ) :
                                        while ( $cars_listing->have_posts() ) : 
                                            $cars_listing->the_post();
                                        if(is_plugin_active("imi-classifieds/imi-classified.php")) 
                                        {
                                            $badge_ids = imic_classified_badge_specs(get_the_ID(), $badge_ids);
                                            $detailed_specs = imic_classified_short_specs(get_the_ID(), $detailed_specs);
                                        }
                                        $badge_ids = imic_filter_lang_specs($badge_ids);
                                        $new_highlighted_specs = imic_filter_lang_specs_admin($highlighted_specs, get_the_ID());
                                        $highlighted_specs = $new_highlighted_specs;
                                        $saved_car_user = array();
                                        $post_author_id = get_post_field( 'post_author', get_the_ID() );
                                        $user_info_id = get_user_meta($post_author_id,'imic_user_info_id',true);
                                        $car_pin = get_post_meta($user_info_id,'imic_user_lat_long',true);
                                        if(!empty($car_pin)) { $car_pin = explode(',',$car_pin); $lat = $car_pin[0]; $long = $car_pin[1]; }
                                        else { $lat = 0; $long = 0; }
                                        $author_role = get_option('blogname');
                                        if(!empty($user_info_id)) {
                                        $term_list = wp_get_post_terms($user_info_id, 'user-role', array("fields" => "names"));
                                        if(!empty($term_list)) {
                                        $author_role = $term_list[0]; }
                                        else { $author_role = get_option('blogname'); }
                                        }
                                        $save1 = (isset($_SESSION['saved_vehicle_id1']))?$_SESSION['saved_vehicle_id1']:'';
                                        $save2 = (isset($_SESSION['saved_vehicle_id2']))?$_SESSION['saved_vehicle_id2']:'';
                                        $save3 = (isset($_SESSION['saved_vehicle_id3']))?$_SESSION['saved_vehicle_id3']:'';
                                        $specifications = get_post_meta(get_the_ID(),'feat_data',true);
                                        $unique_value = imic_vehicle_price(get_the_ID(),$unique_specs,$specifications);
                                        $highlight_value = imic_vehicle_title(get_the_ID(),$highlighted_specs,$specifications);
                                        $highlight_value = ($highlight_value=='')?get_the_title():$highlight_value;
                                        $details_value = imic_vehicle_all_specs(get_the_ID(),$detailed_specs,$specifications);
                                        $badges = imic_vehicle_all_specs(get_the_ID(),$badge_ids,$specifications);
                                        $video = get_post_meta(get_the_ID(),'imic_plugin_video_url',true);
                                        $user_id = get_current_user_id( );
                                        $current_user_info_id = get_user_meta($user_id,'imic_user_info_id',true);
                                        if($current_user_info_id!='') {
                                        $saved_car_user = get_post_meta($current_user_info_id,'imic_user_saved_cars',true); }
                                        if((empty($saved_car_user))||($current_user_info_id=='')||($saved_car_user=='')) { $saved_car_user = array($save1, $save2, $save3); }
                                        $save_icon = (imic_value_search_multi_array(get_the_ID(),$saved_car_user))?'fa-star':'fa-star-o';
                                        $save_icon_disable = (imic_value_search_multi_array(get_the_ID(),$saved_car_user))?'disabled':'';
                                        ?>
                                        <!-- Result Item -->
                                        <div class="result-item format-standard" style="position: relative;">
                                            <?php 
                                                $specification_data_type = (isset($imic_options['specification_fields_type']))?$imic_options['specification_fields_type']:"0";
                                                foreach($search_filters as $featured) {
                                                    $field_type = get_post_meta($featured,'imic_plugin_spec_char_type',true);
                                                    $value_label = get_post_meta($featured,'imic_plugin_value_label',true);
                                                    $label_position = get_post_meta($featured,'imic_plugin_lable_position',true);
                                                    $badge_slug = imic_the_slug($featured);
                                                    $this_specification = get_post_meta(get_the_ID(), 'feat_data', true);
                                                    if($specification_data_type=="0")
                                                    {
                                                        $spec_key = array_search($featured, $this_specification['sch_title']);
                                                        $second_key = array_search($featured*111, $this_specification['sch_title']);
                                                    }
                                                    else
                                                    {
                                                        $spec_key = $second_key = '';
                                                    }
                                                    $id = get_the_ID();
                                                    $feat_val = get_post_meta($id,'int_'.$badge_slug,true);
                                                    if (get_the_title($featured) == 'Status') {
                                                        if(is_int($spec_key)) { 
                                                            $child_val = '';
                                                            if(is_int($second_key)) 
                                                            { 
                                                                $child_val = ' '.$this_specification['start_time'][$second_key]; 
                                                            }
                                                            $spec_feat_val = $this_specification['start_time'][$spec_key];
                                                            if($spec_feat_val!='')
                                                            {
                                                                if($label_position==0) {
                                                                    $status = $value_label.$this_specification['start_time'][$spec_key].$child_val; 
                                                                }
                                                                else {
                                                                    $status = $this_specification['start_time'][$spec_key].$child_val.$value_label;
                                                                } 
                                                            } 
                                                        }
                                                    ?>

                                                    <div class="result-item-image"><?php if(has_post_thumbnail()) { ?>
                                                        <!-- <a href="#" class="media-box"><?php the_post_thumbnail('600x400'); ?></a> -->
                                                        <?php if(is_user_logged_in()) { 
                                                        ?>
                                                        <a href="<?php echo esc_url(get_permalink()); ?>" class="media-box"><?php the_post_thumbnail('600x400'); ?></a>
                                                        <?php 
                                                         } elseif(!is_user_logged_in() &&  $status == 'Bank Owned') {
                                                        ?>
                                                        <a href="#" data-toggle="modal" data-target="#GuestModal" class="media-box"><?php the_post_thumbnail('600x400'); ?></a>                                              
                                                        <?php 
                                                         } elseif(!is_user_logged_in() && $status == 'Private Sale') {
                                                        ?>
                                                        <a href="#" data-toggle="modal" data-target="#GuestModal" class="media-box"><?php the_post_thumbnail('600x400'); ?></a>                                              
                                                        <?php } else { ?>
                                                        <a href="<?php echo esc_url(get_permalink()); ?>" class="media-box"><?php the_post_thumbnail('600x400'); ?></a>
                                                        <?php } } ?>
                                                        <?php $start = 0; 
                                                            $badge_position = array('vehicle-age','premium-listing','third-listing','fourth-listing');
                                                            if(!empty($badges)) {
                                                            foreach($badges as $badge):
                                                                $badge_class = ($start==0)?'default':'success';
                                                                echo '<span class="label label-'.esc_attr($badge_class).' '.esc_attr($badge_position[$start]).'">'.esc_attr($badge).'</span>';
                                                            $start++; if($start>3) { break; }
                                                            endforeach; } ?>
                                                        
                                                    </div>
                                                <div class="result-item-in" style="display:none;">
                                                    <!-- <input type="hidden" name="permalink" id="permalink" value="<?php echo esc_url(get_permalink()); ?>"> -->
                                                   <?php if(is_user_logged_in()) { 
                                                        ?>
                                                        <h4 class="result-item-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr($highlight_value); ?></a>
                                                        <?php 
                                                         } elseif(!is_user_logged_in() &&  $status == 'Bank Owned') {
                                                        ?>
                                                        <h4 class="result-item-title"><a href="#" data-toggle="modal" data-target="#GuestModal"><?php echo esc_attr($highlight_value); ?></a>                                              

                                                        <?php 
                                                         } elseif(!is_user_logged_in() && $status == 'Private Sale') {
                                                        ?>
                                                        <h4 class="result-item-title"><a href="#" data-toggle="modal" data-target="#GuestModal"><?php echo esc_attr($highlight_value); ?></a>                                              
                                                        <?php } else { ?>
                                                            <h4 class="result-item-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr($highlight_value); ?></a>
                                                        <?php
                                                        }?> 
                                                        <?php 
                                                        if($category_rail=="1"&&is_plugin_active("imi-classifieds/imi-classified.php"))
                                                        {
                                                            echo imic_get_cats_list(get_the_ID(), "dropdown");
                                                        }
                                                        ?></h4>
                                                        <?php } 
                                                    } ?>
                                                </div>

                                             <div class="result-item-features">
                                                    <ul class="inline">
                                                    <?php if(!empty($details_value)) {
                                                        $i=0;
                                                        foreach($details_value as $detail) {
                                                            if(!empty($detail) && $i < 2 ) {
                                                                echo '<li>'.strtoupper($detail).' |</li>'; 
                                                            } elseif ($i == 2) {
                                                                echo '<li>'.strtoupper($detail).'</li>'; 
                                                            } elseif ($i > 2) {
                                                                echo '<li style="display:block;">'.ucfirst($detail).'</li>'; 
                                                            } 
                                                        $i++;
                                                    } } ?>
                                                    </ul>
                                                </div>
                                            <div class="result-item-view-buttons" style="position: absolute; bottom: 0; right: 0;">
                                                <?php if($video!='') { ?>
                                                <a href="<?php echo esc_attr($video); ?>" data-rel="prettyPhoto"><i class="fa fa-play"></i> <?php _e('View video','framework'); ?></a><?php } ?>
                                                <!-- <a href="<?php echo esc_url(get_permalink()); ?>"><i class="fa fa-plus"></i> <?php _e('View details','framework'); ?></a> -->
                                                <?php if(is_user_logged_in()) { 
                                                ?>
                                                <a href="<?php echo esc_url(get_permalink()); ?>"><i class="fa fa-plus"></i> </a>
                                                <?php 
                                                 } elseif(!is_user_logged_in() &&  $status == 'Bank Owned') {
                                                ?>
                                                <a href="#" data-toggle="modal" data-target="#GuestModal"><i class="fa fa-plus"></i> </a>                                              
                                                <?php 
                                                 } elseif(!is_user_logged_in() && $status == 'Private Sale') {
                                                ?>
                                                <a href="#" data-toggle="modal" data-target="#GuestModal"><i class="fa fa-plus"></i></a>                                              
                                                <?php } else { ?>
                                                <a href="<?php echo esc_url(get_permalink()); ?>"><i class="fa fa-plus"></i> </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <?php endwhile; else: ?>
                                        <div class="text-align-center error-404">
                    <hr class="sm">
                    <p><strong><?php echo esc_attr_e('Sorry - No listing found for this criteria.','framework'); ?></strong></p>
                    <p><?php echo esc_attr_e('Please search again with different filters.','framework'); ?></p>
                    <script> //jQuery('#noresultsModal').modal('show');</script>
                </div>
                
                                        <?php endif; 
                                        echo '<div class="clearfix"></div>'; 
                                        $paged = ($paged==0)?1:$paged; 
                                        imic_listing_pagination("page-".$paged, $cars_listing->max_num_pages, $paged); 
                                        wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- End Body Content -->
<!-- YACHT ALERTS POPUP -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4><?php echo esc_attr_e('YACHT ALERTS','framework'); ?></h4>
            </div>
            <div class="modal-body">
                <p><?php echo esc_attr_e('We are the first to know when listings hit the market, and you can be too when you subscribe to our Yacht Alert. By filling out the form below, you will receive information on specific yachts matching your criteria that are just hitting the market; that puts you ahead of other buyers. We search industry listings, bank foreclosure inventory, boat shows, web sites, trade publications, and our professional networks for yachts that may not even be listed yet to find your ideal vessel. It is easy to use, always current, and you can input as much search criteria, as you like.','framework'); ?></p>
                <form class="enquiry-vehicle">
                <input type="hidden" name="email_content" value="enquiry_form">
                <input type="hidden" name="Subject" id="subject" value="Yacht Alerts Request">
                <input type="hidden" name="Vehicle_ID" value="<?php echo esc_attr(get_the_ID()); ?>">
                <p><?php echo esc_attr_e('PERSONAL INFORMATION','framework'); ?></p>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <?php if(is_user_logged_in()) { ?>
                            <input type="text" name="Name" class="form-control" placeholder="<?php echo esc_attr_e('Full Name','framework'); ?>" value="<?php echo esc_attr($loggedUserName); ?>">
                         <?php } else { ?>
                            <input type="text" name="Name" class="form-control" placeholder="<?php echo esc_attr_e('Full Name','framework'); ?>">
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                 <?php if(is_user_logged_in()) { ?>
                                    <input type="text" name="Email" class="form-control" placeholder="<?php echo esc_attr_e('Email','framework'); ?>" value="<?php echo esc_attr($loggedUserEmail); ?>">
                                 <?php } else { ?>
                                 <input type="email" name="Email" class="form-control" placeholder="<?php echo esc_attr_e('Email','framework'); ?>">
                                 <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <?php if(is_user_logged_in()) { ?>
                                    <input type="text" name="Phone" class="form-control" placeholder="<?php echo esc_attr_e('Phone','framework'); ?>" value="<?php echo get_post_meta($logged_user,'imic_user_telephone',true); ?>">
                                 <?php } else { ?>
                                <input type="text" name="Phone" class="form-control" placeholder="<?php echo esc_attr_e('Phone','framework'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <p><?php echo esc_attr_e('YACHT INFORMATION','framework'); ?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Make" class="form-control" placeholder="<?php echo esc_attr_e('Make','framework'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Model" class="form-control" placeholder="<?php echo esc_attr_e('Model','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Size" class="form-control" placeholder="<?php echo esc_attr_e('Size','framework'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Year" class="form-control" placeholder="<?php echo esc_attr_e('Year','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Engine" class="form-control" placeholder="<?php echo esc_attr_e('Engine','framework'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Budget" class="form-control" placeholder="<?php echo esc_attr_e('Budget','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary pull-right" value="<?php echo esc_attr_e('Subscribe','framework'); ?>">
                    <label class="btn-block"><?php echo esc_attr_e('Preferred Contact','framework'); ?></label>
                    <label class="checkbox-inline"><input name="Preferred Contact Email" value="yes" type="checkbox"> <?php echo esc_attr_e('Email','framework'); ?></label>
                    <label class="checkbox-inline"><input name="Preferred Contact Phone" value="yes" type="checkbox"> <?php echo esc_attr_e('Phone','framework'); ?></label>
                    <div class="message"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="noresultsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4><?php echo esc_attr_e('YACHT ALERTS','framework'); ?></h4>
            </div>
            <div class="modal-body">
                <p><?php echo esc_attr_e('Sorry we couldnt find the yacht you are looking for within this inventory. However, we are the first to know when listings hit the market, and you can be too when you subscribe to our Yacht Alert. By filling out the form below, you will receive information on specific yachts matching your criteria that are just hitting the market; that puts you ahead of other buyers. We search industry listings, bank foreclosure inventory, boat shows, web sites, trade publications, and our professional networks for yachts that may not even be listed yet to find your ideal vessel. It is easy to use, always current, and you can input as much search criteria as you like.','framework'); ?></p>
                <form class="enquiry-vehicle">
                <input type="hidden" name="email_content" value="enquiry_form">
                <input type="hidden" name="Subject" id="subject" value="Yacht Alerts Request">
                <input type="hidden" name="Vehicle_ID" value="<?php echo esc_attr(get_the_ID()); ?>">
                <p><?php echo esc_attr_e('PERSONAL INFORMATION','framework'); ?></p>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <?php if(is_user_logged_in()) { ?>
                            <input type="text" name="Name" class="form-control" placeholder="<?php echo esc_attr_e('Full Name','framework'); ?>" value="<?php echo esc_attr($loggedUserName); ?>">
                         <?php } else { ?>
                            <input type="text" name="Name" class="form-control" placeholder="<?php echo esc_attr_e('Full Name','framework'); ?>">
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                 <?php if(is_user_logged_in()) { ?>
                                    <input type="text" name="Email" class="form-control" placeholder="<?php echo esc_attr_e('Email','framework'); ?>" value="<?php echo esc_attr($loggedUserEmail); ?>">
                                 <?php } else { ?>
                                 <input type="email" name="Email" class="form-control" placeholder="<?php echo esc_attr_e('Email','framework'); ?>">
                                 <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <?php if(is_user_logged_in()) { ?>
                                    <input type="text" name="Phone" class="form-control" placeholder="<?php echo esc_attr_e('Phone','framework'); ?>" value="<?php echo get_post_meta($logged_user,'imic_user_telephone',true); ?>">
                                 <?php } else { ?>
                                <input type="text" name="Phone" class="form-control" placeholder="<?php echo esc_attr_e('Phone','framework'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <p><?php echo esc_attr_e('YACHT INFORMATION','framework'); ?></p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                        <input type="text" name="brand" class="form-control" placeholder="<?php echo esc_attr_e('Make','framework'); ?>" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                        <input type="text" name="model" class="form-control" placeholder="<?php echo esc_attr_e('Model','framework'); ?>" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                        <input type="text" name="range_size" class="form-control" placeholder="<?php echo esc_attr_e('Size','framework'); ?>" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                        <input type="text" name="builder-year" class="form-control" placeholder="<?php echo esc_attr_e('Year','framework'); ?>" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                        <input type="text" name="engine-brand" class="form-control" placeholder="<?php echo esc_attr_e('Engine','framework'); ?>" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                        <input type="text" name="Budget" class="form-control" placeholder="<?php echo esc_attr_e('Budget','framework'); ?>">
                                    </div>
                                </div>
                            </div>
                    <input type="submit" class="btn btn-primary pull-right" value="<?php echo esc_attr_e('Subscribe','framework'); ?>">
                    <label class="btn-block"><?php echo esc_attr_e('Preferred Contact','framework'); ?></label>
                    <label class="checkbox-inline"><input name="Preferred Contact Email" value="yes" type="checkbox"> <?php echo esc_attr_e('Email','framework'); ?></label>
                    <label class="checkbox-inline"><input name="Preferred Contact Phone" value="yes" type="checkbox"> <?php echo esc_attr_e('Phone','framework'); ?></label>
                    <div class="message"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- TRADE YACHT POPUP -->
<div class="modal fade" id="tradeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4><?php echo esc_attr_e('TRADE A YACHT','framework'); ?></h4>
            </div>
            <div class="modal-body">
                <p><?php echo esc_attr_e('Complete the form below so that we can start helping you trade your Yacht!','framework'); ?></p>
                <form class="enquiry-vehicle">
                <input type="hidden" name="email_content" value="enquiry_form">
                <input type="hidden" name="Subject" id="subject" value="Yacht Trade Request">
                <input type="hidden" name="Vehicle_ID" value="<?php echo esc_attr(get_the_ID()); ?>">
                <p><?php echo esc_attr_e('PERSONAL INFORMATION','framework'); ?></p>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <?php if(is_user_logged_in()) { ?>
                            <input type="text" name="Name" class="form-control" placeholder="<?php echo esc_attr_e('Full Name','framework'); ?>" value="<?php echo esc_attr($loggedUserName); ?>">
                         <?php } else { ?>
                            <input type="text" name="Name" class="form-control" placeholder="<?php echo esc_attr_e('Full Name','framework'); ?>">
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                 <?php if(is_user_logged_in()) { ?>
                                    <input type="text" name="Email" class="form-control" placeholder="<?php echo esc_attr_e('Email','framework'); ?>" value="<?php echo esc_attr($loggedUserEmail); ?>">
                                 <?php } else { ?>
                                 <input type="email" name="Email" class="form-control" placeholder="<?php echo esc_attr_e('Email','framework'); ?>">
                                 <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <?php if(is_user_logged_in()) { ?>
                                    <input type="text" name="Phone" class="form-control" placeholder="<?php echo esc_attr_e('Phone','framework'); ?>" value="<?php echo get_post_meta($logged_user,'imic_user_telephone',true); ?>">
                                 <?php } else { ?>
                                <input type="text" name="Phone" class="form-control" placeholder="<?php echo esc_attr_e('Phone','framework'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <p><?php echo esc_attr_e('YACHT INFORMATION','framework'); ?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Make" class="form-control" placeholder="<?php echo esc_attr_e('Make','framework'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Model" class="form-control" placeholder="<?php echo esc_attr_e('Model','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Size" class="form-control" placeholder="<?php echo esc_attr_e('Size','framework'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Year" class="form-control" placeholder="<?php echo esc_attr_e('Year','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Engine" class="form-control" placeholder="<?php echo esc_attr_e('Engine','framework'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="EngineHours" class="form-control" placeholder="<?php echo esc_attr_e('Engine Hours','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="email" name="Location" class="form-control" placeholder="<?php echo esc_attr_e('Slip Location','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary pull-right" value="<?php echo esc_attr_e('Submit','framework'); ?>">
                    <label class="btn-block"><?php echo esc_attr_e('Preferred Contact','framework'); ?></label>
                    <label class="checkbox-inline"><input name="Preferred Contact Email" value="yes" type="checkbox"> <?php echo esc_attr_e('Email','framework'); ?></label>
                    <label class="checkbox-inline"><input name="Preferred Contact Phone" value="yes" type="checkbox"> <?php echo esc_attr_e('Phone','framework'); ?></label>
                    <div class="message"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- SELL YACHT POPUP -->
<div class="modal fade" id="sellModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4><?php echo esc_attr_e('SELL YOUR YACHT','framework'); ?></h4>
            </div>
            <div class="modal-body">
                <p><?php echo esc_attr_e('Complete the form below so that we can start helping you sell your Yacht!','framework'); ?></p>
                <form class="enquiry-vehicle">
                <input type="hidden" name="email_content" value="enquiry_form">
                <input type="hidden" name="Subject" id="subject" value="Yacht Sell Request">
                <input type="hidden" name="Vehicle_ID" value="<?php echo esc_attr(get_the_ID()); ?>">
                <p><?php echo esc_attr_e('PERSONAL INFORMATION','framework'); ?></p>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <?php if(is_user_logged_in()) { ?>
                            <input type="text" name="Name" class="form-control" placeholder="<?php echo esc_attr_e('Full Name','framework'); ?>" value="<?php echo esc_attr($loggedUserName); ?>">
                         <?php } else { ?>
                            <input type="text" name="Name" class="form-control" placeholder="<?php echo esc_attr_e('Full Name','framework'); ?>">
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                 <?php if(is_user_logged_in()) { ?>
                                    <input type="text" name="Email" class="form-control" placeholder="<?php echo esc_attr_e('Email','framework'); ?>" value="<?php echo esc_attr($loggedUserEmail); ?>">
                                 <?php } else { ?>
                                 <input type="email" name="Email" class="form-control" placeholder="<?php echo esc_attr_e('Email','framework'); ?>">
                                 <?php } ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <?php if(is_user_logged_in()) { ?>
                                    <input type="text" name="Phone" class="form-control" placeholder="<?php echo esc_attr_e('Phone','framework'); ?>" value="<?php echo get_post_meta($logged_user,'imic_user_telephone',true); ?>">
                                 <?php } else { ?>
                                <input type="text" name="Phone" class="form-control" placeholder="<?php echo esc_attr_e('Phone','framework'); ?>">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <p><?php echo esc_attr_e('YACHT INFORMATION','framework'); ?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Make" class="form-control" placeholder="<?php echo esc_attr_e('Make','framework'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Model" class="form-control" placeholder="<?php echo esc_attr_e('Model','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Size" class="form-control" placeholder="<?php echo esc_attr_e('Size','framework'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Year" class="form-control" placeholder="<?php echo esc_attr_e('Year','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Engine" class="form-control" placeholder="<?php echo esc_attr_e('Engine','framework'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="EngineHours" class="form-control" placeholder="<?php echo esc_attr_e('Engine Hours','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="email" name="Location" class="form-control" placeholder="<?php echo esc_attr_e('Slip Location','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary pull-right" value="<?php echo esc_attr_e('Submit','framework'); ?>">
                    <label class="btn-block"><?php echo esc_attr_e('Preferred Contact','framework'); ?></label>
                    <label class="checkbox-inline"><input name="Preferred Contact Email" value="yes" type="checkbox"> <?php echo esc_attr_e('Email','framework'); ?></label>
                    <label class="checkbox-inline"><input name="Preferred Contact Phone" value="yes" type="checkbox"> <?php echo esc_attr_e('Phone','framework'); ?></label>
                    <div class="message"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="main" role="main">
        <div id="content" class="content full">
            <div class="container">
                <div class="text-align-center error-404">
                    <h1 class="huge"><?php echo esc_attr_e('Sorry','framework'); ?></h1>
                    <hr class="sm">
                    <p><strong><?php echo esc_attr_e('Sorry - Plugin not active','framework'); ?></strong></p>
                    <p><?php echo esc_attr_e('Please install and activate required plugins of theme.','framework'); ?></p>
                </div>
            </div>
        </div>
    </div>
<?php } get_footer(); ?>