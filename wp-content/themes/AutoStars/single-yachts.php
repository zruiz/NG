<?php 
get_header();
global $imic_options;
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
$pageSidebar2 = get_post_meta(get_the_ID(),'imic_select_featured_from_list', true);
$pageSidebar = get_post_meta(get_the_ID(),'imic_select_sidebar_from_list', true);
$sidebar_column = get_post_meta(get_the_ID(),'imic_sidebar_columns_layout',true);
if(!empty($pageSidebar)&&is_active_sidebar($pageSidebar)) {
$left_col = 12-$sidebar_column;
$class = $left_col;  
}else{
$class = 12;  
}
$list_slugs = array();
$blog_masonry = 2;
$post_author_id = get_post_field( 'post_author', get_the_ID() );
$this_user = get_user_meta($post_author_id,'imic_user_info_id',true);
$add = get_post_meta($this_user,'imic_user_zip_code',true);
$highlighted_specs = (isset($imic_options['highlighted_specs']))?$imic_options['highlighted_specs']:'';
$new_highlighted_specs = imic_filter_lang_specs_admin($highlighted_specs, get_the_ID());
$highlighted_specs = $new_highlighted_specs;
$unique_specs = $imic_options['unique_specs'];
$specifications = get_post_meta(get_the_ID(),'feat_data',true);	
$unique_value = imic_vehicle_price(get_the_ID(),$unique_specs,$specifications);
$currency_value = imic_vehicle_currency(get_the_ID(),'1604',$specifications);
$highlight_value = imic_vehicle_title(get_the_ID(),$highlighted_specs,$specifications);
$video = get_post_meta(get_the_ID(),'imic_plugin_video_url',true);
$featured_specifications = (isset($imic_options['side_specifications']))?$imic_options['side_specifications']:array();
$normal_specifications = (isset($imic_options['normal_specifications']))?$imic_options['normal_specifications']:array();
$normal_specification = array();
$related_specifications = (isset($imic_options['related_specifications']))?$imic_options['related_specifications']:array();
$browse_specification_switch = get_post_meta(get_the_ID(),'imic_browse_by_specification_switch',true);
$browse_listing = imic_get_template_url("template-listing.php");
$download_pdf = get_post_meta(get_the_ID(),'imic_plugin_car_manual',true);
$plan = get_post_meta(get_the_ID(),'imic_plugin_car_plan',true);
$plan_premium = get_post_meta($plan,'imic_pricing_premium_badge',true);
$userFirstName = get_the_author_meta('first_name', $post_author_id);
$userLastName = get_the_author_meta('last_name', $post_author_id);
$user_data = get_userdata(intval($post_author_id));
$userName = $user_data->display_name;
if(!empty($userFirstName) || !empty($userLastName)) {
	$userName = ucfirst($userFirstName) .' '. ucfirst($userLastName); 
}
$userEmail = $user_data->user_email;
$user = (isset($userName)) ? get_user_by('slug', $userName) : ''; 
$user_info_id = get_user_meta($user->ID,'imic_user_info_id',true);
$userTitle = get_post_meta($this_user,'imic_user_company_tagline',true);
$userPhone = get_post_meta($this_user,'imic_user_telephone',true);

if($browse_specification_switch==1) {
get_template_part('bar','one'); 
} elseif($browse_specification_switch==2) {
get_template_part('bar','two');
} elseif($browse_specification_switch==3) { 
get_template_part('bar','saved');
}
if($browse_specification_switch==4)
{
	get_template_part('bar', 'category');
} else { }
$vehicle_status = get_post_meta(get_the_ID(),'imic_plugin_ad_payment_status',true);
if($vehicle_status!=1) {
	echo '<div class="main" role="main">
    	<div id="content" class="content full">
        	<div class="container"><div class="row"><p>'.__('Yacht might be sold or not active','framework').'</p></div></div></div></div>';
} else {
$save1 = (isset($_SESSION['saved_vehicle_id1']))?$_SESSION['saved_vehicle_id1']:'';
$save2 = (isset($_SESSION['saved_vehicle_id2']))?$_SESSION['saved_vehicle_id2']:'';
$save3 = (isset($_SESSION['saved_vehicle_id3']))?$_SESSION['saved_vehicle_id3']:'';
global $current_user;
$user_id = get_current_user_id( );
$current_user_info_id = get_user_meta($user_id,'imic_user_info_id',true);
if($current_user_info_id!='') {
$saved_car_user = get_post_meta($current_user_info_id,'imic_user_saved_cars',true); }
if((empty($saved_car_user))||($current_user_info_id=='')||($saved_car_user=='')) { $saved_car_user = array($save1, $save2, $save3); }
$save_icon = (imic_value_search_multi_array(get_the_ID(),$saved_car_user))?'fa-star':'fa-star-o';
$save_icon_disable = (imic_value_search_multi_array(get_the_ID(),$saved_car_user))?'disabled':'';
$enquiry_form1 = (isset($imic_options['enquiry_form1']))?$imic_options['enquiry_form1']:'0';
$editor_form1 = (isset($imic_options['enquiry_form1_editor']))?$imic_options['enquiry_form1_editor']:'';
$enquiry_form2 = (isset($imic_options['enquiry_form2']))?$imic_options['enquiry_form2']:'0';
$editor_form2 = (isset($imic_options['enquiry_form2_editor']))?$imic_options['enquiry_form2_editor']:'';
$enquiry_form3 = (isset($imic_options['enquiry_form3']))?$imic_options['enquiry_form3']:'0';
$editor_form3 = (isset($imic_options['enquiry_form3_editor']))?$imic_options['enquiry_form3_editor']:'';
$classified_data = get_option('imic_classifieds');
$classified_data = (!empty($classified_data))?$classified_data:array();
$listing_details = (isset($imic_options['listing_details']))?$imic_options['listing_details']:0;
$specification_data_type = (isset($imic_options['specification_fields_type']))?$imic_options['specification_fields_type']:"0";

$loggedUserFirstName = $current_user->user_firstname;
$loggedUserLastName = $current_user->user_lastname;
$loggedUserName = get_the_author_meta( 'display_name', $user_id );
if(!empty($loggedUserFirstName) || !empty($loggedUserLastName)) {
	$loggedUserName = $loggedUserFirstName .' '. $loggedUserLastName; 
}
$loggedUserEmail = $current_user->user_email;
?>


<!-- Start Body Content -->
  	<div class="main" role="main">
    	<div id="content" class="content full">
        	<div class="container">
            	<!-- Vehicle Details -->
                <article class="single-vehicle-details">
                	<div class="single-listing-actions">
                        <div class="btn-group pull-right" role="group">
                            <a href="#" data-toggle="modal" data-target="#infoModal" class="btn btn-default" title="<?php echo esc_attr_e('The Purchasing Process','framework'); ?>"><i class="fa fa-info"></i> <span><?php echo esc_attr_e('The Purchasing Process','framework'); ?></span></a><?php } if($enquiry_form2!=2) { ?>
                            <a href="#" data-toggle="modal" data-target="#financingModal" class="btn btn-default" title="<?php echo esc_attr_e('Financing','framework'); ?>"><i class="fa fa-dollar"></i> <span><?php echo esc_attr_e('Financing','framework'); ?></span></a><?php } if($enquiry_form3!=2) { ?>
                            <a href="#" data-toggle="modal" data-target="#surveyorModal" class="btn btn-default" title="<?php echo esc_attr_e('Find A Surveyor','framework'); ?>"><i class="fa fa-search"></i> <span><?php echo esc_attr_e('Find A Surveyor','framework'); ?></span></a>
                            <a href="#" data-toggle="modal" data-target="#conversionModal" class="btn btn-default" title="<?php echo esc_attr_e('Electrical Conversion','framework'); ?>"><i class="fa fa-power-off"></i> <span><?php echo esc_attr_e('Electrical Conversion','framework'); ?></span></a><?php } if($enquiry_form3!=2) { ?>
                            <a href="#" data-toggle="modal" data-target="#shippingModal" class="btn btn-default" title="<?php echo esc_attr_e('Shipping','framework'); ?>"><i class="fa fa-anchor"></i> <span><?php echo esc_attr_e('Shipping','framework'); ?></span></a>
                            <?php } if($download_pdf!='') { ?>
                            <a href="<?php echo IMIC_THEME_PATH; ?>/download/download.php?file=<?php echo esc_url($download_pdf); ?>" class="btn btn-default" title="<?php echo esc_attr_e('Download Manual','framework'); ?>"><i class="fa fa-book"></i> <span><?php echo esc_attr_e('Download Manual','framework'); ?></span></a><?php } ?>
                            <!-- <a <?php echo esc_attr($save_icon_disable); ?> href="#" rel="popup-save" class="btn btn-default save-car" title="<?php echo esc_attr_e('Save this listing','framework'); ?>"><i class="fa <?php echo esc_attr($save_icon); ?>"></i> <span><?php echo esc_attr_e('Save this listing','framework'); ?></span><div class="vehicle-details-access" style="display:none;"><span class="vehicle-id"><?php echo esc_attr(get_the_ID()); ?></span></div></a><?php if($enquiry_form1!=2) { ?> -->
                            <a href="javascript:void(0)" onclick="window.print();" class="btn btn-default" title="<?php echo esc_attr_e('Print','framework'); ?>"><i class="fa fa-print"></i> <span><?php echo esc_attr_e('Print','framework'); ?></span></a>
                        </div>
                    </div>
                	<div class="row head-title">
	                    <div class="single-vehicle-title col-md-10">
	                    <?php if($plan_premium==1) { ?>
	                        <span class="badge-premium-listing"><?php echo esc_attr_e('Premium listing','framework'); ?></span><?php } ?>
	                        <h2 class="post-title"><?php echo esc_attr($highlight_value); ?></h2>
	                    </div>
	                    <?php 
	                    $currency_symbol = '';
	                    if (strpos($currency_value, 'USD') !== false ) { 
	                    	$currency_symbol = '$';
	                    } elseif (strpos($currency_value, 'EUR') !== false )  {
	                    	$currency_symbol = '€';
	                    } elseif (strpos($currency_value, 'GBP') !== false )  $currency_symbol = '£'; 
	                    ?>
	                    <div class="btn btn-info price col-md-2"><?php echo $currency_symbol.' '.esc_attr($unique_value); ?></div>
	                </div>
                    <div class="row">
                    	<div class="col-md-4">
                    		<div class="row">
				                <div class="icon-actions" style="margin-top:80px;">
				                    <div class="col-lg-12 col-md-12 col-sm-12 cust-counter">
				                         <a href="#" data-toggle="modal" data-target="#alertModal" title="<?php echo esc_attr_e('Yacht Alerts','framework'); ?>">
				                            <div class="fact-ico" style="border-radius: 65px;"><i class="fa icon-alarm-clock fa-3x" style="margin-top: 10px;"><span style="margin-bottom: 10px; padding:0;"><?php echo esc_attr_e('Yacht Alerts','framework'); ?></span></i></div>
				                            <div class="clearfix"></div>                           
				                        </a>
				                    </div>
				                    <div class="col-lg-12 col-md-12 col-sm-12 cust-counter">
				                        <a href="#" data-toggle="modal" data-target="#tradeModal" title="<?php echo esc_attr_e('Trade a Yacht','framework'); ?>">
				                            <div class="fact-ico" style="border-radius: 65px;"> <i class="fa fa-file-o fa-3x" style="margin-top: 20px;"><span><?php echo esc_attr_e('Trade A Yacht','framework'); ?></span></i> </div>
				                            <div class="clearfix"></div>
				                        </a>
				                    </div>
				                    <div class="col-lg-12 col-md-12 col-sm-12 cust-counter">
				                        <a href="#" data-toggle="modal" data-target="#sellModal" title="<?php echo esc_attr_e('Sell Your Yacht','framework'); ?>">
				                            <div class="fact-ico" style="border-radius: 65px;"> <i class="fa fa-dollar fa-3x" style="margin-top: 20px;"><span><?php echo esc_attr_e('Sell Your Yacht','framework'); ?></span></i></div>
				                            <div class="clearfix"></div>
				                            <h4></h4>
				                        </a>
				                    </div>
				                </div>
				            </div>
                        <?php if((!empty($featured_specifications))&&($listing_details==0)) { ?>
                            <div class="sidebar-widget widget" style="display:none;">
                                <ul class="list-group">
                                <?php 	
																$new_featured_specifications = imic_filter_lang_specs($featured_specifications);
																foreach($new_featured_specifications as $featured) 
																{
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
																	$feat_val = get_post_meta($id,'int_'.$badge_slug,true);
																	if($field_type==1&&$feat_val!='') 
																	{
																		if($label_position==0) 
																		{
																			echo '<li class="list-group-item"> <span class="badge">'.get_the_title($featured).'</span> '.$value_label.$feat_val.'</li>'; 
																		}
																		else 
																		{
																			echo '<li class="list-group-item"> <span class="badge">'.get_the_title($featured).'</span> '.get_post_meta($id,'int_'.$badge_slug,true).$value_label.'</li>'; 
																		}
																	} 
																	else 
																	{
																		if(is_int($spec_key)) 
																		{
																			$child_val = '';
																			if(is_int($second_key)) 
																			{ 
																				$child_val = ' '.$this_specification['start_time'][$second_key]; 
																			}
																			$spec_feat_val = $this_specification['start_time'][$spec_key];
																			if($spec_feat_val!='')
																			{
																				if($label_position==0) 
																				{
																					echo '<li class="list-group-item"> <span class="badge">'.get_the_title($featured).'</span> '.$value_label.$this_specification['start_time'][$spec_key].$child_val.'</li>'; 
																				}
																				else 
																				{
																					echo '<li class="list-group-item"> <span class="badge">'.get_the_title($featured).'</span> '.$this_specification['start_time'][$spec_key].$child_val.$value_label.'</li>'; 
																				} 
																			} 
																		}
																		else
																		{
																			$spec_slug = imic_the_slug($featured);
																			$spec_val_char = get_post_meta(get_the_ID(), 'char_'.$spec_slug, true);
																			$spec_val_char_child = get_post_meta(get_the_ID(), 'child_'.$spec_slug, true);
																			if($spec_val_char!=''&&$spec_val_char!="Select")
																			{
																				if($label_position==0) 
																				{
																					echo '<li class="list-group-item"> <span class="badge">'.get_the_title($featured).'</span> '.$value_label.$spec_val_char.' '.$spec_val_char_child.'</li>'; 
																				}
																				else 
																				{
																					echo '<li class="list-group-item"> <span class="badge">'.get_the_title($featured).'</span> '.$spec_val_char.' '.$spec_val_char_child.$value_label.'</li>'; 
																				} 
																			}
																		}
																	}
																} ?>
                                </ul>
                            </div><?php } else { 
								$args_terms = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
								$this_terms = wp_get_post_terms(get_the_ID(),'listing-category',$args_terms);
								$get_val_term = '';
								foreach($this_terms as $term)
								{ 
									$list_slugs[] = $term->slug;
									if(array_key_exists($term->term_id, $classified_data))
									{ 
										if($classified_data[$term->term_id]['featured']!='')
										{
											$get_val_term = $term->term_id;
											break;
										}
									}
								}
								if(!empty($get_val_term))
								{ 
								$featured_specifications = $classified_data[$get_val_term]['featured'];
								$featured_specifications = explode(',', $featured_specifications);
								$normal_specification = $classified_data[$get_val_term]['detailed'];
								$normal_specification = explode(',', $normal_specification);
								?>
                            <div class="sidebar-widget widget">
                                <ul class="list-group">
                                <?php foreach($featured_specifications as $featured) {
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
										$feat_val = get_post_meta($id,'int_'.$badge_slug,true);
										if($field_type==1&&$feat_val!='') {
										if($label_position==0) {
										echo '<li class="list-group-item"> <span class="badge">'.get_the_title($featured).'</span> '.$value_label.get_post_meta($id,'int_'.$badge_slug,true).'</li>'; }
										else {
										echo '<li class="list-group-item"> <span class="badge">'.get_the_title($featured).'</span> '.get_post_meta($id,'int_'.$badge_slug,true).$value_label.'</li>'; }
									} else {
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
										echo '<li class="list-group-item"> <span class="badge">'.get_the_title($featured).'</span> '.$value_label.$this_specification['start_time'][$spec_key].$child_val.'</li>'; }
										else {
										echo '<li class="list-group-item"> <span class="badge">'.get_the_title($featured).'</span> '.$this_specification['start_time'][$spec_key].$child_val.$value_label.'</li>'; } } } } ?>
                                    
                              	<?php } ?>
                                </ul>
                            </div><?php } }
							dynamic_sidebar($pageSidebar2); ?>
                        </div>
                        <div class="col-md-8">
                            <div class="single-listing-images">
                            
                            	<div class="listing-slider">
                                    <div id="listing-images" class="flexslider format-gallery" >
                                    <?php $cars_images = get_post_meta(get_the_ID(),'imic_plugin_vehicle_images',false);
									  if(empty($cars_images)) 
									  { 
										  $attachments = get_attached_media( 'image', get_the_ID() );
										  if(!empty($attachments))
										  {
											  $cars_images = array();
											  foreach($attachments as $attachment)
											  {
												  $cars_images[] = $attachment->ID;
											  }
										  }
									  }?>
                                      <ul class="slides">
                                      	<?php foreach($cars_images as $car_image) { 
											$image = wp_get_attachment_image_src($car_image,'1000x800','');
											$image_full = wp_get_attachment_image_src($car_image,'full','');
										?>
                                        <?php if(isset($imic_options['switch_lightbox']) && $imic_options['switch_lightbox']== 0){
											$Lightbox_init = '<li class="media-box" style="height:450px;">';
											//$Lightbox_init = '<li class="media-box" style="height:450px;"><a class="slide-link" href="' .esc_url($image_full[0]). '" data-rel="prettyPhoto[grouped]">';
										}elseif(isset($imic_options['switch_lightbox']) && $imic_options['switch_lightbox']== 1){
											$Lightbox_init = '<li class="media-box" style="height:450px;"><a href="' .esc_url($image_full[0]). '" class="magnific-gallery-image hidden-sm hidden-xs">';
										}
										echo $Lightbox_init; ?><img src="<?php echo esc_url($image[0]); ?>" alt=""></li>
								  <?php } ?>
                                      </ul>
                                    </div>
                                    <?php 
									if(count($cars_images)>1) { ?>
                                    <div class="additional-images">
                                    <div id="listing-thumbs" class="flexslider">
                                      <ul class="slides">
                                      <?php $start = 1; foreach($cars_images as $car_image) { 
											$image = wp_get_attachment_image_src($car_image,'400x400','');
											$image_full = wp_get_attachment_image_src($car_image,'full','');
											if($video!=''&&$start==1) {
												if(isset($imic_options['switch_lightbox']) && $imic_options['switch_lightbox']== 0){
											$Lightbox_init = '<li class="format-video"><a href="' .esc_url($video). '" data-rel="prettyPhoto[grouped]" class="media-box">';
										}elseif(isset($imic_options['switch_lightbox']) && $imic_options['switch_lightbox']== 1){
											$Lightbox_init = '<li class="format-video"><a href="' .esc_url($video). '" class="magnific-video media-box">';
										}
										echo $Lightbox_init;
											echo '<img src="'.esc_url($image[0]).'" alt=""></a></li>'; } else { ?>
									<li style="height:150px;"> <a href="<?php echo esc_url($image_full[0]); ?>" class="media-box"><img src="<?php echo esc_url($image[0]); ?>" alt="" height="150px;"></a> </li>
								  <?php } $start++; } ?>
                                      </ul>
                                    </div></div><?php } ?>
                                  </div>
                            
                            
                            
                            </div>
                      	</div>
                   	</div>
                 	<div class="spacer-50">
                 		<div class="single-listing-actions">
                        	<div class="btn-group pull-right" role="group">
                        		<a href="#" data-toggle="modal" data-target="#brochureModal" class="btn btn-default" title="<?php echo esc_attr_e('Request A Brochure','framework'); ?>"><i class="fa fa-book"></i> <span><?php echo esc_attr_e('Request A Brochure','framework'); ?></span></a>
                 				<a <?php echo esc_attr($save_icon_disable); ?> href="#" rel="popup-save" class="btn btn-default save-car" title="<?php echo esc_attr_e('Save this listing','framework'); ?>"><i class="fa <?php echo esc_attr($save_icon); ?>"></i> <span><?php echo esc_attr_e('Save this listing','framework'); ?></span><div class="vehicle-details-access" style="display:none;"><span class="vehicle-id"><?php echo esc_attr(get_the_ID()); ?></span></div></a>
                 			</div>
                 		</div>	
                 	</div>
                    <div class="row">
                    	<!-- Vehicle Details Sidebar -->
                        <div class="col-md-4 vehicle-details-sidebar sidebar">
                        	<!-- <p><h3 class="widgettitle">Meet Your Broker</h3></p> -->
                        	<div class="col-md-11 col-sm-4 vehicle-enquiry-foot">
                        		<div class="grid-item-inner" style="width:276px !important; margin:0 auto;">
                        			<?php $default_image = (isset($imic_options['default_dealer_image']))?$imic_options['default_dealer_image']:array('url'=>''); ?>
		                            <a data-toggle="modal" data-target="" href="#" class="media-box"> <?php if(has_post_thumbnail($this_user)) { echo get_the_post_thumbnail($this_user,'600x400'); } else { ?><img src="<?php echo esc_url($default_image['url']); ?>" alt=""><?php } ?></a>
		                            <div class="grid-content">
		                            	<div class="post-title">
			                                <h5>
			                                	<?php echo esc_attr($userName); ?>
			                                </h5>
			                                <p><?php echo esc_attr($userTitle); ?></p>
			                            </div>
		                                <span class="vehicle-enquiry-foot-ico"><i class="mobile fa fa-mobile"></i><?php echo esc_attr($userPhone); ?></span>
	                                    <span class="vehicle-enquiry-foot-ico"><i class="mail fa fa-envelope-o"></i><?php echo esc_attr($userEmail); ?></span>
	                                    <!-- <span class="vehicle-enquiry-foot-ico"><i class="mail fa fa-envelope-o"></i><a href="<?php echo esc_url(get_author_posts_url($post_author_id)); ?>"><?php echo esc_attr($userEmail); ?></a></span> -->
			                        </div>
			                        <div class="grid-content">
			                        	<input type="button" data-toggle="modal" data-target="#offerModal" class="btn btn-primary" value="Make An Offer">
			                        </div>
		                        </div>
                             </div>
                             <?php dynamic_sidebar($pageSidebar); ?>
                        </div>
                    	<div class="col-md-8">
                            <div class="tabs vehicle-details-tabs">
                                <ul class="nav nav-tabs">
                                <?php $count = 1;
								$tab_data1 = get_post_meta(get_the_ID(),'imic_tab_area1',true);
								$tab_data2 = get_post_meta(get_the_ID(),'imic_tab_area2',true);
								$tab_data3 = get_post_meta(get_the_ID(),'imic_tab_area3',true);
								$tab_data4 = get_post_meta(get_the_ID(),'imic_tab_area4',true);
								$tabs = (isset($imic_options['details_tab']))?$imic_options['details_tab']:array();
								foreach($tabs as $tab) {
									$active_class = ($count==1)?"active":"";
									if(($tab['property_description']=="[tab-area1]")&&($tab_data1!='')) { ?>
                                    <li class="<?php echo esc_attr($active_class); ?>"> <a data-toggle="tab" href="#tab-<?php echo esc_attr($count); ?>"><?php echo esc_attr($tab['title']); ?></a></li>
                                    <?php }
									elseif(($tab['property_description']=="[tab-area2]")&&($tab_data2!='')) { ?>
                                    <li class="<?php echo esc_attr($active_class); ?>"> <a data-toggle="tab" href="#tab-<?php echo esc_attr($count); ?>"><?php echo esc_attr($tab['title']); ?></a></li>
                                    <?php }
									elseif(($tab['property_description']=="[tab-area3]")&&($tab_data3!='')) { ?>
                                    <li class="<?php echo esc_attr($active_class); ?>"> <a data-toggle="tab" href="#tab-<?php echo esc_attr($count); ?>"><?php echo esc_attr($tab['title']); ?></a></li>
                                    <?php }
									elseif(($tab['property_description']=="[tab-area4]")&&($tab_data4!='')) { ?>
                                    <li class="<?php echo esc_attr($active_class); ?>"> <a data-toggle="tab" href="#tab-<?php echo esc_attr($count); ?>"><?php echo esc_attr($tab['title']); ?></a></li>
                                    <?php } elseif(($tab['property_description']!="[tab-area1]")&&($tab['property_description']!="[tab-area2]")&&($tab['property_description']!="[tab-area3]")&&($tab['property_description']!="[tab-area4]")) { ?>
                                    <li class="<?php echo esc_attr($active_class); ?>"> <a data-toggle="tab" href="#tab-<?php echo esc_attr($count); ?>"><?php echo esc_attr($tab['title']); ?></a></li>
                                <?php } $count++; } ?>
                                </ul>
                                <div class="tab-content">
                                <?php $start = 1;
								foreach($tabs as $tab) {
									$active = ($start==1)?"active in":""; ?>
                                <div id="tab-<?php echo esc_attr($start); ?>" class="tab-pane fade <?php echo esc_attr($active); ?>" style="display:<?php echo ($tab['property_description']=="[location]")?"block":"" ?>">
                                <?php //$tab_content = $tab['imic_plugin_tab_content']; ?>
                                <?php if ( $tab['property_description']=='[content]' ) {
									if(have_posts()):while(have_posts()):the_post(); 
										the_content();
									endwhile; endif;
										}
										elseif( $tab['property_description']=="[specifications]") {
											if(!empty($normal_specifications)&&($listing_details==0)) {
											echo '<table class="table-specifications table table-striped table-hover">
                                                            <tbody>';
											$new_normal_specifications = imic_filter_lang_specs($normal_specifications);
											$brand = '';
											$model = '';
											$size = '';
											$year = '';
											$engine_brand = '';
											$location = '';
											foreach($new_normal_specifications as $normal) {

									$field_type = get_post_meta($normal,'imic_plugin_spec_char_type',true);
									$value_labels = get_post_meta($normal,'imic_plugin_value_label',true);
										$label_positions = get_post_meta($normal,'imic_plugin_lable_position',true);
										$badge_slug = imic_the_slug($normal);
										$this_specification = get_post_meta(get_the_ID(), 'feat_data', true);
									if($field_type==1) {
										if (get_the_title($normal) == 'Size')
											$size = get_post_meta($id,'int_'.$badge_slug,true).$value_labels;
										if (get_the_title($normal) == 'Builder Year')
											$year = $value_labels.get_post_meta($id,'int_'.$badge_slug,true);
										if($label_positions==0) {
											echo '<tr>
                                                            		<td>'.get_the_title($normal).'</td>
                                                            		<td>'.$value_labels.get_post_meta($id,'int_'.$badge_slug,true).'</td>
                                                            	</tr>'; }
										else {
											echo '<tr>
                                                            		<td>'.get_the_title($normal).'</td>
                                                            		<td>'.get_post_meta($id,'int_'.$badge_slug,true).$value_labels.'</td>
                                                            	</tr>'; }
									} else {

										if($specification_data_type=="0")
										{
											$spec_key = array_search($normal, $this_specification['sch_title']);
											$second_key = array_search($featured*111, $this_specification['sch_title']);
										}
										else
										{
											$spec_key = $second_key = '';
										}
										if(is_int($spec_key)) 
										{
											$child_val = '';
											if(is_int($second_key)) 
											{ 
												$child_val = ' '.$this_specification['start_time'][$second_key]; 
											}
											$value_this = $this_specification['start_time'][$spec_key];
											if (get_the_title($normal) == 'Brand')
												$brand = $value_labels.$value_this.$child_val;
											if (get_the_title($normal) == 'Model')
												$model = $value_labels.$value_this.$child_val;
											if (get_the_title($normal) == 'Engine Brand')
												$engine_brand = $value_labels.$value_this.$child_val;
												
											if($value_this!="select") 
											{
												if($label_positions==0) 
												{
													echo '<tr>
                        		<td>'.get_the_title($normal).'</td>
                         		<td>'.$value_labels.$value_this.$child_val.'</td>
                       		</tr>'; 
												}
												else 
												{
													echo '<tr>
                        	<td>'.get_the_title($normal).'</td>
                  				<td>'.$value_this.$child_val.$value_labels.'</td>
                       		</tr>'; 
												} 
											} 
										}
										else
										{
											$feat_slug_char = imic_the_slug($normal);
											$spec_key_val = get_post_meta(get_the_ID(), 'char_'.$feat_slug_char, true);
											$spec_key_val_child = get_post_meta(get_the_ID(), 'child_'.$feat_slug_char, true);
											if (get_the_title($normal) == 'Location')
												$location = $value_labels.$spec_key_val;
											if($spec_key_val!="select") 
											{
												if($label_positions==0) 
												{
													echo '<tr>
                        		<td>'.get_the_title($normal).'</td>
                         		<td>'.$value_labels.$spec_key_val.'</td>
                       		</tr>'; 
													if($spec_key_val_child!='')
													{
														$child_label = get_post_meta($normal, 'imic_plugin_sub_field_label', true);
														echo '<tr>
                        		<td>'.$child_label.'</td>
                         		<td>'.$spec_key_val_child.'</td>
                       		</tr>'; 
													}
												}
												else 
												{
													echo '<tr>
                        	<td>'.get_the_title($normal).'</td>
                  				<td>'.$spec_key_val.$value_labels.'</td>
                       		</tr>'; 
													if($spec_key_val_child!='')
													{
														$child_label = get_post_meta($normal, 'imic_plugin_sub_field_label', true);
														echo '<tr>
                        		<td>'.$child_label.'</td>
                         		<td>'.$spec_key_val_child.'</td>
                       		</tr>'; 
													}
												} 
											} 
										}
										} ?>
                                    
                              	<?php }
										echo '</tbody></table>'; } 
										else
										{
											echo '<table class="table-specifications table table-striped table-hover">
                                                            <tbody>';
											if(!empty($normal_specification))
											{
											foreach($normal_specification as $normal) {
									$field_type = get_post_meta($normal,'imic_plugin_spec_char_type',true);
									$value_labels = get_post_meta($normal,'imic_plugin_value_label',true);
										$label_positions = get_post_meta($normal,'imic_plugin_lable_position',true);
										$badge_slug = imic_the_slug($normal);
										$this_specification = get_post_meta(get_the_ID(), 'feat_data', true);
									if($field_type==1) {
										
										if($label_positions==0) {
											echo '<tr>
                                                            		<td>'.get_the_title($normal).'</td>
                                                            		<td>'.$value_labels.get_post_meta($id,'int_'.$badge_slug,true).'</td>
                                                            	</tr>'; }
										else {
											echo '<tr>
                                                            		<td>'.get_the_title($normal).'</td>
                                                            		<td>'.get_post_meta($id,'int_'.$badge_slug,true).$value_labels.'</td>
                                                            	</tr>'; }
									} else {

										if($specification_data_type=="0")
										{
											$spec_key = array_search($normal, $this_specification['sch_title']);
										}
										else
										{
											$spec_key = '';
										}
										if(is_int($spec_key)) {
										$value_this = $this_specification['start_time'][$spec_key];
										if($value_this!="select") {
										if($label_positions==0) {
											echo '<tr>
                                                            		<td>'.get_the_title($normal).'</td>
                                                            		<td>'.$value_labels.$value_this.'</td>
                                                            	</tr>'; }
										else {
											echo '<tr>
                                                            		<td>'.get_the_title($normal).'</td>
                                                            		<td>'.$value_this.$value_labels.'</td>
                                                            	</tr>'; } } } } ?>
                                    
                              	<?php } }
										echo '</tbody></table>';
										} }
										elseif( $tab['property_description']=="[features]") {
											echo '<ul class="add-features-list">';
											$features = get_the_terms(get_the_ID(),'yachts-tag');
											if(!empty($features))
											{
												$new_features = imic_filter_lang_specs($features);
												foreach($new_features as $feature) {
                                        	echo '<li>'.$feature->name.'</li>';
											}
											}
                                        	echo '</ul>';
										}
										elseif( $tab['property_description']=="[location]") {
											echo esc_attr($location);
											//echo do_shortcode('[gmap address="'.$add.'"]');
										}
										elseif(($tab['property_description']=="[tab-area1]")&&($tab_data1!='')) {
											echo do_shortcode($tab_data1);
										}
										elseif(($tab['property_description']=="[tab-area2]")&&($tab_data2!='')) {
											echo do_shortcode($tab_data2);
										}
										elseif(($tab['property_description']=="[tab-area3]")&&($tab_data3!='')) {
											echo do_shortcode($tab_data3);
										}
										elseif(($tab['property_description']=="[tab-area4]")&&($tab_data4!='')) {
											echo do_shortcode($tab_data4);
										}
										else {
											
											echo do_shortcode($tab['property_description']);
										}
										 ?>
                                </div>
                                <?php $start++; } ?>
                    		</div></div>
                            <div class="spacer-50"></div>
                            <!-- Recently Listed Vehicles -->
                            
                            
                                <?php $related_args = array();
									if(!empty($related_specifications)) {
										$this_specification = get_post_meta(get_the_ID(), 'feat_data', true);
										$related_args = imic_vehicle_all_specs(get_the_ID(),$related_specifications,$this_specification);
									} ?>
                                
                                <?php $current_car = get_the_ID(); 
								$arrays = array(); 
								$taxonomy_array = array();
								$value = $pagin = $offset = $off = ''; 
								$count = 1; 
								if(!empty($related_args)) 
								{ 
									foreach($related_args as $key=>$value)
									{
										if (strpos($key,'int') !== false) 
										{
											$arrays[$count] = array(
													'key' => $key,
													'value' =>  $value,
													'compare' => '<=',
													'type' => 'numeric'
													);
										} 
										else 
										{
											$arrays[$count] = array(
													'key' => 'feat_data',
													'value' =>  $value,
													'compare' => 'LIKE'
													);
													$count++; 
										} 
								   } 
   
   								}
								else
								{
									$taxonomy_array[0] = array(
									'taxonomy' => 'listing-category',
									'field' => 'slug',
									'terms' => $list_slugs,
									'operator' => 'IN');
								} 
   $arrays[$count+1] = array('key'=>'imic_plugin_ad_payment_status','value'=>'1','compare'=>'=');
	$logged_user_pin = '';			
	$user_id = get_current_user_id( );
										$logged_user = get_user_meta($user_id,'imic_user_info_id',true);
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
										if($specification_type==0)
										{
											$detailed_specs = (isset($imic_options['vehicle_specs']))?$imic_options['vehicle_specs']:array();
										
										}
										else
										{
											$detailed_specs = array();
										}
										$detailed_specs = imic_filter_lang_specs($detailed_specs);
										$category_rail = (isset($imic_options['category_rail']))?$imic_options['category_rail']:'0';
										$additional_specs = (isset($imic_options['additional_specs']))?$imic_options['additional_specs']:'';
										$additional_specs_all = get_post_meta($additional_specs,'specifications_value',true);
										$highlighted_specs = (isset($imic_options['highlighted_specs']))?$imic_options['highlighted_specs']:array();
										$unique_specs = $imic_options['unique_specs'];	
										$args_cars = array('post_type'=>'yachts','tax_query'=>$taxonomy_array,'posts_per_page'=>10,'post_status'=>'publish', 'post__not_in'=>array($current_car));
									$cars_listing = new WP_Query( $args_cars );
									if ( $cars_listing->have_posts() ) :
									if(isset($imic_options['enable_rtl']) && $imic_options['enable_rtl']== 1){ $DIR = 'data-rtl="rtl"';} else { $DIR = 'data-rtl="ltr"'; }
									echo '<section class="listing-block recent-vehicles">
                                <div class="listing-header">
                                    <h3>'.__('Related Listings','framework').'</h3>
                                </div>
                                <div class="listing-container">
                                    <div class="carousel-wrapper">
                                        <div class="row">
                                            <ul class="owl-carousel carousel-fw" id="vehicle-slider" data-columns="3" data-autoplay="" data-pagination="yes" data-arrows="no" data-single-item="no" data-items-desktop="3" data-items-desktop-small="3" data-items-tablet="2" data-items-mobile="1" '.$DIR.'>';
									while ( $cars_listing->have_posts() ) :	
									$cars_listing->the_post();
										$additional_spec_slug = imic_the_slug($additional_specs);
										if(is_plugin_active("imi-classifieds/imi-classified.php")) 
										{
											$badge_ids = imic_classified_badge_specs(get_the_ID(), $badge_ids);
											$detailed_specs = imic_classified_short_specs(get_the_ID(), $detailed_specs);
										}
										$badge_ids = imic_filter_lang_specs($badge_ids);
										$car_author = get_post_field( 'post_author', get_the_ID() );
										$user_info_id = get_user_meta($car_author,'imic_user_info_id',true);
										$author_role = get_option('blogname');
										if(!empty($user_info_id)) {
										$term_list = wp_get_post_terms($user_info_id, 'user-role', array("fields" => "names"));
										if(!empty($term_list)) {
										$author_role = $term_list[0]; }
										else { $author_role = get_option('blogname'); }
										}
										$specifications = get_post_meta(get_the_ID(),'feat_data',true);
										$new_highlighted_specs = imic_filter_lang_specs_admin($highlighted_specs, get_the_ID());
										$highlighted_specs = $new_highlighted_specs;
										$unique_value = imic_vehicle_price(get_the_ID(),$unique_specs,$specifications);
										$highlight_value = imic_vehicle_title(get_the_ID(),$highlighted_specs,$specifications);
										$details_value = imic_vehicle_all_specs(get_the_ID(),$detailed_specs,$specifications);
										if(!empty($additional_specs)) {
										if($imic_options['specification_fields_type']=="0")
											{
												$image_key = array_search($additional_specs, $specifications['sch_title']);
												$additional_specs_value = $specifications['start_time'][$image_key];
											}
											else
											{
												 $img_char = imic_the_slug($additional_specs);
												 $additional_specs_value = get_post_meta(get_the_ID(), 'char_'.$img_char, true);
											}
										$this_key = find_car_with_position($additional_specs_all,$additional_specs_value);
										$img_src = $additional_specs_all[$this_key]['imic_plugin_spec_image']; }
										$badges = imic_vehicle_all_specs(get_the_ID(),$badge_ids,$specifications);
										?>
                                    <li class="item">
                                        <div class="vehicle-block format-standard">
                                        <?php if(has_post_thumbnail()) { ?>
                                            <a href="<?php echo esc_url(get_permalink()); ?>" class="media-box"><?php the_post_thumbnail('210x210'); ?></a><?php } ?>
                                            <div class="vehicle-block-content">
                                            <?php $start = 1; 
													$badge_position = array('vehicle-age','premium-listing','third-listing','fourth-listing');
													foreach($badges as $badge):
														$badge_class = ($start==1)?'default':'success';
														echo '<span class="label label-'.esc_attr($badge_class).' '.esc_attr($badge_position[$start-1]).'">'.esc_attr($badge).'</span>';
													$start++;
													endforeach; ?>
                                                <h5 class="vehicle-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr($highlight_value); ?></a></h5>
                                                <span class="vehicle-meta"><?php foreach($details_value as $value) { echo esc_attr($value).', '; } ?> <?php echo esc_attr_e('by','framework'); ?> <abbr class="user-type" title="Listed by <?php echo esc_attr($author_role); ?>"><?php echo esc_attr($author_role); ?></abbr></span>
                                                <?php if($img_src!='') { ?>
                                                <a href="<?php echo esc_url(add_query_arg($additional_spec_slug, $additional_specs_all[$this_key]['imic_plugin_specification_values'],$browse_listing)); ?>" title="<?php echo esc_attr_e('View all ','framework'); echo esc_attr($additional_specs_all[$this_key]['imic_plugin_specification_values']); ?>" class="vehicle-body-type"><img src="<?php echo esc_attr($additional_specs_all[$this_key]['imic_plugin_spec_image']); ?>" alt=""></a><?php } ?>
                                                <span class="vehicle-cost"><?php echo esc_attr(number_format($unique_value)); ?></span>
                                                <?php 
												if($category_rail=="1"&&is_plugin_active("imi-classifieds/imi-classified.php"))
												{
													echo imic_get_cats_list(get_the_ID(), "list");
												}
												?>
                                            </div>
                                        </div>
                                    </li>
                                    <?php endwhile; ?>
                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        
                            </section>
                                    <?php endif; wp_reset_postdata(); ?>
                                                    
                       	</div>
                    </div>
                </article>
                <div class="clearfix"></div>
            </div>
        </div>
   	</div>
    <!-- End Body Content -->
<!-- REQUEST MORE INFO POPUP -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4><?php echo esc_attr_e('The Purchasing Process','framework'); ?></h4>
            </div>
            <div class="modal-body">
            <?php if($enquiry_form1==0) { ?>
            	<div class="tabs">
	              <ul class="nav nav-tabs">
	                <li class="active"> <a data-toggle="tab" href="#tab7"> <?php echo esc_attr_e('The Purchasing Process','framework'); ?> </a> </li>
	                <li> <a data-toggle="tab" href="#tab8"> <?php echo esc_attr_e('Offer and Survey','framework'); ?> </a> </li>
	                <li> <a data-toggle="tab" href="#tab9"> <?php echo esc_attr_e('Closing and Importation','framework'); ?> </a> </li>
	              </ul>
	              <div class="tab-content">
	                <div class="tab-pane active" id="tab7">
	                	<p style="margin: 10px 0 18px 0;"><?php echo esc_attr_e('Purchasing a Yacht is a step by step process that if followed carrefully will be swift and efficient and will guaranty you legal protection all the way through closing. We are using Documentation agents, maritime attorneys, custom brokers and marine surveyors to ensure all our deals are easy for our customers and that the only requirement will be to enjoy your new Yacht!','framework'); ?></p>
	                	<!-- <p><?php echo esc_attr_e('Complete the form below so that we can start helping you sell your Yacht!','framework'); ?></p> -->
	                	<form class="enquiry-vehicle">
			                <input type="hidden" name="email_content" value="enquiry_form">
							<input type="hidden" name="Subject" id="subject" value="The Selling/Purchasing Process">
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
			                                <input type="text" name="Engine" class="form-control" placeholder="<?php echo esc_attr_e('Engine Brand','framework'); ?>">
			                            </div>
			                        </div>
			                        <div class="col-md-6">
			                            <div class="input-group">
			                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
			                                <input type="text" name="Location" class="form-control" placeholder="<?php echo esc_attr_e('Yacht Location','framework'); ?>">
			                            </div>
			                        </div>
			                    </div>
			        
			             		<input type="submit" class="btn btn-primary pull-right" value="<?php echo esc_attr_e('Submit Info','framework'); ?>">
			                    <label class="btn-block"><?php echo esc_attr_e('Preferred Contact','framework'); ?></label>
			                    <label class="checkbox-inline"><input name="Preferred Contact Email" value="yes" type="checkbox"> <?php echo esc_attr_e('Email','framework'); ?></label>
			                    <label class="checkbox-inline"><input name="Preferred Contact Phone" value="yes" type="checkbox"> <?php echo esc_attr_e('Phone','framework'); ?></label>
			                    <div class="message"></div>
			                </form>
	                </div>
                	<div class="tab-pane" id="tab8">
                		<p style="margin: 10px 0 18px 0;"><?php echo esc_attr_e('Once you have determined and found the yacht you are looking for we will present a written offer to the yacht owner and negotiate an agreeable purchase price. Our contracts are FYBA or MYBA contracts to ensure a standard and protected legal process. Once your offer is accepted a deposit must be held into an escrow account ( this can be either our escrow account or a third party legally recognized escrow account) and survey can be organized at this moment.','framework'); ?></p>
                		<p><?php echo esc_attr_e('Surveying the yacht you are purchasing is the most important process, we are helping you organize this step by offering our help in finding suitable surveyors as well as shipyard for haul out in the area where the yacht is based. A typical survey will include, a hull survey including out of the water and running gear survey. It will also include a interior and systems check survey completed with a mechanical survey and sea trial to determine the engine worthiness and eventual issues that need to be adressed before closing the deal.','framework'); ?></p>
                	</div>
                	<div class="tab-pane" id="tab9">
                		<p style="margin: 10px 0 18px 0;"><?php echo esc_attr_e('Once the yacht passed survey and all details have been negotiated, meaning if during the survey we found items that need to be fixed and paid for we will have the opportunity to condition our acceptance upon these contengencies…Then we will start the closing process. Closing will be orchestrated either by a Maritime Attorney you will hire or directly with us. Some distinctions will need to be discussed for ownership and sales taxes. We have many different scenario we can suggest and will alsways look for the best suitable solution. Typically closing will take 2 to 3 weeks on standard oversea closings and sometime more in some circumstances with banks involved. Once the ownership transfer is legal all funds disbursed and yacht under your care we will be able to ship and import the yacht wherever you wish to call her Home.','framework'); ?></p>
                		<p><?php echo esc_attr_e('Our Shipping Brokers will be able to find the right logistical solutions and working hand in hand with our custom brokers we will organize all the legal requirements for your yacht importation. Typically in USA if you are importaing a yacht from a foreign country, you will have a choice between using a foreign flag and running your yacht in US waters under a Cruising License or pay the importation Duties ( 1,5% of yacht value and shipping cost). Having a “Duty Paid” vessel in USA will allow you to sell and Charter your yacht in USA to any residents or non-resident customer. Having a yacht under a cruising License will only allow you to sell or your yacht “while in US waters” to a NON-US resident customer. This last point is under debate between several Yacht Broker Association and US congress to be able to pay the duty at closing and still allow a US resident to purchase a “Duty Not Paid” Yacht while in US waters…We will be the first to let you know if course!','framework'); ?></p>
                	</div>
                 </div>
            	</div>
            	<?php } elseif($enquiry_form1==1) { echo do_shortcode($editor_form1); } ?>
           	</div>
        </div>
    </div>
</div>
<!-- BOOK TEST DRIVE POPUP -->
<div class="modal fade" id="testdriveModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4><?php echo esc_attr_e('Book a test drive','framework'); ?></h4>
            </div>
            <div class="modal-body">
            <?php if($enquiry_form2==0) { ?>
            	<p><?php echo esc_attr_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Donec vel mauris quam.','framework'); ?></p>
                <form class="enquiry-vehicle">
                <input type="hidden" name="email_content" value="enquiry_form">
				<input type="hidden" name="Subject" id="subject" value="Book a test drive">
                <input type="hidden" name="Vehicle_ID" value="<?php echo esc_attr(get_the_ID()); ?>">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" name="Name" class="form-control" placeholder="<?php echo esc_attr_e('Full Name','framework'); ?>">
                    </div>
                    <div class="row">
                    	<div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="Email" class="form-control" placeholder="<?php echo esc_attr_e('Email','framework'); ?>">
                            </div>
                      	</div>
                    	<div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" name="Phone" class="form-control" placeholder="<?php echo esc_attr_e('Phone','framework'); ?>">
                            </div>
                      	</div>
                   	</div>
                    <div class="row">
                    	<div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="Preferred Date" id="datepicker" class="form-control" placeholder="<?php echo esc_attr_e('Preferred Date','framework'); ?>">
                            </div>
                      	</div>
                    	<div class="col-md-6">
                            <div class="input-group input-append bootstrap-timepicker">
                                <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                                <input type="text" name="Preferred Time" id="timepicker" class="form-control" placeholder="<?php echo esc_attr_e('Preferred time','framework'); ?>">
                            </div>
                      	</div>
                   	</div>
             		<input type="submit" class="btn btn-primary pull-right" value="<?php echo esc_attr_e('Schedule Now','framework'); ?>">
                    <label class="btn-block"><?php echo esc_attr_e('Preferred Contact','framework'); ?></label>
                    <label class="checkbox-inline"><input name="Preferred Contact Email" value="yes" type="checkbox"> <?php echo esc_attr_e('Email','framework'); ?></label>
                    <label class="checkbox-inline"><input name="Preferred Contact Phone" value="yes" type="checkbox"> <?php echo esc_attr_e('Phone','framework'); ?></label>
                    <div class="message"></div>
                </form><?php } elseif($enquiry_form2==1) { echo do_shortcode($editor_form2); } ?>
           	</div>
        </div>
    </div>
</div>
<!-- FINANCING POPUP -->
<div class="modal fade" id="financingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4><?php echo esc_attr_e('Financing','framework'); ?></h4>
            </div>
            <div class="modal-body">
            <?php if($enquiry_form3==0) { ?>
            	<p><?php echo esc_attr_e('We can help you finance your yacht anywhere in the world with almost no nationality, flag, or cruising area restrictions. The loan calculator is offered as a courtesy to help you simulate your payments. This doesn’t constitute an official offer.','framework'); ?></p>
                <form class="enquiry-vehicle">
                <input type="hidden" name="email_content" value="enquiry_form">
				<input type="hidden" name="Subject" id="subject" value="<?php echo esc_attr_e('Financing','framework'); ?>">
                <input type="hidden" name="Vehicle_ID" value="<?php echo esc_attr(get_the_ID()); ?>">
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
                   	<div class="row">
                    	<div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                <input type="text" name="Loan" class="form-control" placeholder="<?php echo esc_attr_e('Loan Amount','framework'); ?>">
                            </div>
                      	</div>
                    	<div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" name="Location" class="form-control" placeholder="<?php echo esc_attr_e('Yacht Location','framework'); ?>">
                            </div>
                      	</div>
                   	</div>
                    <textarea class="form-control" name="Additional Comments" placeholder="<?php echo esc_attr_e('Message','framework'); ?>"></textarea>
             		<input type="submit" class="btn btn-primary pull-right" value="<?php echo esc_attr_e('Submit','framework'); ?>">
                    <div class="clearfix"></div>
                    <div class="message"></div>
                </form><?php } elseif($enquiry_form3==1) { echo do_shortcode($editor_form3); } ?>
           	</div>
        </div>
    </div>
</div>
<!-- SURVEYOR POPUP -->
<div class="modal fade" id="surveyorModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4><?php echo esc_attr_e('Find A Surveyor','framework'); ?></h4>
            </div>
            <div class="modal-body">
            <?php if($enquiry_form3==0) { ?>
            	<p><?php echo esc_attr_e('A through survey is the key to successful purchases. We have carefully put together a list of surveyors, licensed engineers, mechanics, and captains for your yacht survey anywhere in Europe, USA and Caribbean.','framework'); ?></p>
                <form class="enquiry-vehicle">
                <input type="hidden" name="email_content" value="enquiry_form">
				<input type="hidden" name="Subject" id="subject" value="<?php echo esc_attr_e('Financing','framework'); ?>">
                <input type="hidden" name="Vehicle_ID" value="<?php echo esc_attr(get_the_ID()); ?>">
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
                   	<div class="row">
                    	<div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Brand" class="form-control" placeholder="<?php echo esc_attr_e('Yacht Brand','framework'); ?>">
                            </div>
                      	</div>
                    	<div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Engine" class="form-control" placeholder="<?php echo esc_attr_e('Engine Brand','framework'); ?>">
                            </div>
                      	</div>
                   	</div>
                   	<div class="row">
                    	<div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" name="Location" class="form-control" placeholder="<?php echo esc_attr_e('Yacht Location','framework'); ?>">
                            </div>
                      	</div>
                     </div>
                    <textarea class="form-control" name="Additional Comments" placeholder="<?php echo esc_attr_e('Message','framework'); ?>"></textarea>
             		<input type="submit" class="btn btn-primary pull-right" value="<?php echo esc_attr_e('Submit','framework'); ?>">
                    <div class="clearfix"></div>
                    <div class="message"></div>
                </form><?php } elseif($enquiry_form3==1) { echo do_shortcode($editor_form3); } ?>
           	</div>
        </div>
    </div>
</div>
<!-- CONVERSION POPUP -->
<div class="modal fade" id="conversionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4><?php echo esc_attr_e('Electrical Conversion','framework'); ?></h4>
            </div>
            <div class="modal-body">
            <?php if($enquiry_form3==0) { ?>
            	<p><?php echo esc_attr_e('In some cases and depending on where you will keep your yacht, an electrical conversion may be necessary to connect your yacht to a dock. Our licensed and insured Electrical Conversion Specialists will be able to give you advices and prices as soon as you send your request. Please fill up the information below.','framework'); ?></p>
                <form class="enquiry-vehicle">
                <input type="hidden" name="email_content" value="enquiry_form">
				<input type="hidden" name="Subject" id="subject" value="<?php echo esc_attr_e('Electrical Conversion','framework'); ?>">
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
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" name="Location" class="form-control" placeholder="<?php echo esc_attr_e('Location','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <textarea class="form-control" name="Additional Comments" placeholder="<?php echo esc_attr_e('Message','framework'); ?>"></textarea>
             		<input type="submit" class="btn btn-primary pull-right" value="<?php echo esc_attr_e('Submit','framework'); ?>">
                    <div class="clearfix"></div>
                    <div class="message"></div>
                </form><?php } elseif($enquiry_form3==1) { echo do_shortcode($editor_form3); } ?>
           	</div>
        </div>
    </div>
</div>
<!-- SHIPPING POPUP -->
<div class="modal fade" id="shippingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4><?php echo esc_attr_e('Shipping','framework'); ?></h4>
            </div>
            <div class="modal-body">
            <?php if($enquiry_form3==0) { ?>
            	<p><?php echo esc_attr_e('From Sydney to Dubai, and Genoa to Panama, we have logistical solutions for your yacht transport needs at discounted rates. Please make sure we have all the yacht information correctly filled up as well as your personal information’s to get back to you in a timely manner.','framework'); ?></p>
                <form class="enquiry-vehicle">
                <input type="hidden" name="email_content" value="enquiry_form">
				<input type="hidden" name="Subject" id="subject" value="<?php echo esc_attr_e('Shipping','framework'); ?>">
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
                                <input type="text" name="Brand" class="form-control" placeholder="<?php echo esc_attr_e('Brand','framework'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Size" class="form-control" placeholder="<?php echo esc_attr_e('Size','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Departure" class="form-control" placeholder="<?php echo esc_attr_e('Desired Departure Area','framework'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Arrival" class="form-control" placeholder="<?php echo esc_attr_e('Desired Arrival Area','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <textarea class="form-control" name="Additional Comments" placeholder="<?php echo esc_attr_e('Message','framework'); ?>"></textarea>
             		<input type="submit" class="btn btn-primary pull-right" value="<?php echo esc_attr_e('Submit','framework'); ?>">
                    <div class="clearfix"></div>
                    <div class="message"></div>
                </form><?php } elseif($enquiry_form3==1) { echo do_shortcode($editor_form3); } ?>
           	</div>
        </div>
    </div>
</div>
<!-- MAKE AN OFFER POPUP -->
<div class="modal fade" id="offerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4><?php echo esc_attr_e('Make an offer','framework'); ?></h4>
            </div>
            <div class="modal-body">
            <?php if($enquiry_form3==0) { ?>
            	<p><?php echo esc_attr_e('Ready to make an offer and/or discuss all details with a broker? Please fill up the form below and we will contact you right away!','framework'); ?></p>
                <form class="enquiry-vehicle">
                <input type="hidden" name="email_content" value="enquiry_form">
				<input type="hidden" name="Subject" id="subject" value="<?php echo esc_attr_e('Offer was submitted successfully','framework'); ?>">
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
                    <div class="row">
                    	<div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                <input type="text" name="Offered Price" class="form-control" placeholder="<?php echo esc_attr_e('Offered Price','framework'); ?>">
                            </div>
                      	</div>
                    	<div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                <select name="Financing Required" type="text" class="form-control selectpicker">
                                	<option value="no" selected><?php echo esc_attr_e('Financing required?','framework'); ?></option>
                                	<option value="yes"><?php echo esc_attr_e('Yes','framework'); ?></option>
                                	<option value="no"><?php echo esc_attr_e('No','framework'); ?></option>
                                </select>
                            </div>
                      	</div>
                   	</div>
                   	<p><?php echo esc_attr_e('YACHT INFORMATION','framework'); ?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Make" class="form-control" placeholder="<?php echo esc_attr_e('Make','framework'); ?>" value="<?php echo esc_attr($brand); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Model" class="form-control" placeholder="<?php echo esc_attr_e('Model','framework'); ?>" value="<?php echo esc_attr($model); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Size" class="form-control" placeholder="<?php echo esc_attr_e('Size','framework'); ?>" value="<?php echo esc_attr($size); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Year" class="form-control" placeholder="<?php echo esc_attr_e('Year','framework'); ?>" value="<?php echo esc_attr($year); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Engine" class="form-control" placeholder="<?php echo esc_attr_e('Engine Brand','framework'); ?>" value="<?php echo esc_attr($engine_brand); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" name="Location" class="form-control" placeholder="<?php echo esc_attr_e('Location','framework'); ?>" value="<?php echo esc_attr($location); ?>">
                            </div>
                        </div>
                    </div>
                    <textarea class="form-control" name="Additional Comments" placeholder="<?php echo esc_attr_e('Additional comments','framework'); ?>"></textarea>
             		<input type="submit" class="btn btn-primary pull-right" value="<?php echo esc_attr_e('Submit','framework'); ?>">
                    <div class="clearfix"></div>
                    <div class="message"></div>
                </form><?php } elseif($enquiry_form3==1) { echo do_shortcode($editor_form3); } ?>
           	</div>
        </div>
    </div>
</div>
<!-- REQUEST BROCHURE POPUP -->
<div class="modal fade" id="brochureModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4><?php echo esc_attr_e('Request A Brochure','framework'); ?></h4>
            </div>
            <div class="modal-body">
            <?php if($enquiry_form3==0) { ?>
            	<p><?php echo esc_attr_e('Thank you for your request, we will be sending you a full brochure for this yacht shortly, please include all necessary informations below.','framework'); ?></p>
                <form class="enquiry-vehicle">
                <input type="hidden" name="email_content" value="enquiry_form">
				<input type="hidden" name="Subject" id="subject" value="<?php echo esc_attr_e('Request a Brochure','framework'); ?>">
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
                   	<!-- <p><?php echo esc_attr_e('YACHT INFORMATION','framework'); ?></p>
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
                                <input type="text" name="Engine" class="form-control" placeholder="<?php echo esc_attr_e('Engine Brand','framework'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" name="Location" class="form-control" placeholder="<?php echo esc_attr_e('Location','framework'); ?>">
                            </div>
                        </div>
                    </div> -->
                    <textarea class="form-control" name="Additional Comments" placeholder="<?php echo esc_attr_e('Message','framework'); ?>"></textarea>
             		<input type="submit" class="btn btn-primary pull-right" value="<?php echo esc_attr_e('Submit','framework'); ?>">
                    <div class="clearfix"></div>
                    <div class="message"></div>
                </form><?php } elseif($enquiry_form3==1) { echo do_shortcode($editor_form3); } ?>
           	</div>
        </div>
    </div>
</div>
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
                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                <input type="text" name="Budget" class="form-control" placeholder="<?php echo esc_attr_e('Budget','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Layout" class="form-control" placeholder="<?php echo esc_attr_e('Layout/Staterooms','framework'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-list"></i></span>
                                <input type="text" name="Requests" class="form-control" placeholder="<?php echo esc_attr_e('Other requests','framework'); ?>">
                            </div>
                        </div>
                    </div> -->
                    <textarea class="form-control" name="Additional Comments" placeholder="<?php echo esc_attr_e('Message','framework'); ?>"></textarea>
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
                <p><?php echo esc_attr_e('We can take your yacht on trade or simply find a yacht for sale that would take your yacht as part exchange. Please fill up the information requested below and we will get back to you with a market evaluation and proposition.','framework'); ?></p>
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
                                <input type="text" name="Engine" class="form-control" placeholder="<?php echo esc_attr_e('Engine Brand','framework'); ?>">
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
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" name="Location" class="form-control" placeholder="<?php echo esc_attr_e('Location','framework'); ?>">
                            </div>
                        </div>
                    </div>
                    <textarea class="form-control" name="Additional Comments" placeholder="<?php echo esc_attr_e('Message','framework'); ?>"></textarea>
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
            	<div class="tabs">
	              <ul class="nav nav-tabs">
	                <li class="active"> <a data-toggle="tab" href="#tab4"> <?php echo esc_attr_e('Sell Your Yacht','framework'); ?> </a> </li>
	                <li> <a data-toggle="tab" href="#tab5"> <?php echo esc_attr_e('Our Method','framework'); ?> </a> </li>
	                <li> <a data-toggle="tab" href="#tab6"> <?php echo esc_attr_e('Why Us?','framework'); ?> </a> </li>
	              </ul>
	              <div class="tab-content">
	                <div class="tab-pane active" id="tab4">	                	
		                <p style="margin: 10px 0 18px 0;"><?php echo esc_attr_e('Complete the form below so that we can start helping you sell your Yacht!','framework'); ?></p>
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
		                                <input type="text" name="Engine" class="form-control" placeholder="<?php echo esc_attr_e('Engine Brand','framework'); ?>">
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
		                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
		                                <input type="text" name="Location" class="form-control" placeholder="<?php echo esc_attr_e('Location','framework'); ?>">
		                            </div>
		                        </div>
		                    </div>
		                    <textarea class="form-control" name="Additional Comments" placeholder="<?php echo esc_attr_e('Message','framework'); ?>"></textarea>
		                    <input type="submit" class="btn btn-primary pull-right" value="<?php echo esc_attr_e('Submit','framework'); ?>">
		                    <label class="btn-block"><?php echo esc_attr_e('Preferred Contact','framework'); ?></label>
		                    <label class="checkbox-inline"><input name="Preferred Contact Email" value="yes" type="checkbox"> <?php echo esc_attr_e('Email','framework'); ?></label>
		                    <label class="checkbox-inline"><input name="Preferred Contact Phone" value="yes" type="checkbox"> <?php echo esc_attr_e('Phone','framework'); ?></label>
		                    <div class="message"></div>
		                </form>
	            	</div>
					<div class="tab-pane" id="tab5">
						<p style="margin: 10px 0 18px 0;"><?php echo esc_attr_e('Free Evaluation & Market Analysis','framework'); ?></p>
                		<p><?php echo esc_attr_e('Selling your yacht starts when we appraise her. We speak with you openly about the market and how to maximize sale potential. We look at current trends in the market to determine the right asking price for your yacht, and suggest any small upgrades or improvements you can make to move it quickly. If you do not have the right contractors, we have a large network of yacht professionals we can refer. We are able to handle it all for you, so you do not need to invest more time than you have, on getting your boat ready to show. And we will do all this, for free!','framework'); ?></p>
                		<p style="margin: 10px 0 18px 0;"><?php echo esc_attr_e('Marketing Strategy','framework'); ?></p>
                		<p style="margin: 10px 0 18px 0;"><?php echo esc_attr_e('Once your yacht is listed and ready to show, we look at where your boat is most likely to sell and focus on that market. We consider price, geography, brand presence, and demographics to ensure your yacht is put in front of the right potential buyers. We have exclusive access to the Worldwide MLS, an international yacht sales platform, and listing your yacht on all major websites is part of our marketing strategy.','framework'); ?></p>
                		<p style="margin: 10px 0 18px 0;"><?php echo esc_attr_e('Closing the Deal','framework'); ?></p>
			            <p style="margin: 10px 0 18px 0;"><?php echo esc_attr_e('When your yacht has a potential buyer, we are there to support and guide you through all of the negotiations. From making a counteroffer and negotiating post survey cash adjustments to navigating international tax law and yacht flagging, we work with documentation agencies and maritime attorneys to guide you through all the legal process. We have years of experience closing deals.','framework'); ?></p>
					</div>
					<div class="tab-pane" id="tab6">
						<p style="margin: 10px 0 18px 0;"><?php echo esc_attr_e('There are several advantages to using a broker: market exposure and knowledge, brokerage contracts and maritime attorney support, saving time by pre-qualifying clients and handling showings, specific knowledge on financing, insurance, exporting, and flagging regulations, and general knowledge of boats and brand awareness to get the buyer the right boat are only a few.','framework'); ?></p>
						<p style="margin: 10px 0 18px 0;"><?php echo esc_attr_e('We have exclusive access to the Worldwide MLS and other sites that are inaccessible to those selling by owner. And those listing sites that are available to non-brokers, are often priced so high that it doesn’t make sense to join to list only one vessel. Additionally, we know how to price and present a boat so that it will get the most traction. We know the market and how your yacht will play into it.','framework'); ?></p>
						<p style="margin: 10px 0 18px 0;"><?php echo esc_attr_e('It also takes time and attention to detail to show a yacht. We show up early to ensure she is ready to show and handle all those details that make your yacht showing pristine. We personally greet your potential buyers at the docks, highlighting your yacht’s best features and answer any questions they may have. We are available to do this around the clock to meet your potential buyer’s needs so that you can spend your time the way you want to.','framework'); ?></p>
						<p style="margin: 10px 0 18px 0;"><?php echo esc_attr_e('Finally, brokers protect you and your sale. We filter for spam and screen potential and qualified buyers so that you don’t waste your time. We guide you through negotiations so you get a fair price, and with a multilingual staff, we ensure there are no miscommunications along the way. Whether we are representing the buyer, the seller, or both, our escrow account protects all of your assets until you pass survey and the vessel is accepted. And when it comes time to close, we ensure your money is received quickly and where you want it, all while handling the transfer of the yacht.','framework'); ?></p>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
</div>
<?php //Session for recently viewed cars
if(!isset($_SESSION['viewed_vehicle_id1'])) {
		$_SESSION['viewed_vehicle_id1'] = get_the_ID();
	} 
	elseif(!isset($_SESSION['viewed_vehicle_id2'])) {
		if($_SESSION['viewed_vehicle_id1']!=get_the_ID()) {
		$_SESSION['viewed_vehicle_id2'] = get_the_ID(); }
	}
	elseif(!isset($_SESSION['viewed_vehicle_id3'])) {
		if($_SESSION['viewed_vehicle_id1']!=get_the_ID()&&$_SESSION['viewed_vehicle_id2']!=get_the_ID()) {
		$_SESSION['viewed_vehicle_id3'] = get_the_ID(); }
	}
	else {
		unset($_SESSION['viewed_vehicle_id1']);
		if($_SESSION['viewed_vehicle_id2']!=get_the_ID()&&$_SESSION['viewed_vehicle_id3']!=get_the_ID()) {
		$_SESSION['viewed_vehicle_id1'] = get_the_ID();	}
}
} //End of status view ?>
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
<?php } 
if(is_plugin_active("imi-classifieds/imi-classified.php"))
{
	imic_viewed_listing(get_the_ID());
}
get_footer(); ?>