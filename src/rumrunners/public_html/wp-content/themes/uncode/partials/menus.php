<?php

function uncode_center_nav_menu_items($items, $args) {
	if ( $args->theme_location == 'primary') {
		if (is_array($items) || is_object($items)) {
			global $logo_html;
			$menu_items = array();
			foreach ($items as $key => $item) {
				if ($item->menu_item_parent == 0) $menu_items[] = $key;
			}
			$new_item_array = array();
			$new_item = new stdClass;
			$new_item->ID = 0;
			$new_item->db_id = 0;
			$new_item->menu_item_parent = 0;
			$new_item->url = '';
			$new_item->title = $logo_html;
			$new_item->menu_order = 0;
			$new_item->object_id = 0;
			$new_item->description = '';
			$new_item->attr_title = '';
			$new_item->button = '';
			$new_item->megamenu = '';
			$new_item->logo = true;
			$new_item->classes = 'mobile-hidden tablet-hidden';
			$new_item_array[] = $new_item;
			$get_position = floor(count($menu_items) / 2) - 1;
			array_splice($items, $menu_items[$get_position], 0, $new_item_array);
		}
	}

	return $items;
}

/*****************
*
*   MENU BUILDER
*
******************/

if (!class_exists('unmenu')) {
	class unmenu
	{

		public $html;

		function __construct($type, $param)
		{
			global $LOGO, $metabox_data, $post, $menutype, $adaptive_images, $adaptive_images_async, $ai_width;

			$general_style = ot_get_option( '_uncode_general_style');
			$stylemain = ot_get_option( '_uncode_primary_menu_style');
			if ($stylemain === '') $stylemain = $general_style;

			$type = ($type == '') ? 'hmenu-right' : $type;
			$vertical = (strpos($type, 'vmenu') !== false || $type === 'menu-overlay' || $type === 'menu-overlay-center') ? true : false;

			$social_html = $social_html_inner = $secondary_menu_html = $social_icon = $search = $main_absolute = $sub_absolute = $main_transparent = $sub_transparent = $stylemainback = $stylesecback = $mainborders = $main_width = $menu_bloginfo = $vmenu_position = '';

			$logoDiv = '<a href="'.esc_url( home_url( get_current_blog_id(), '/' ) ).'" class="navbar-brand" data-minheight="'.(($LOGO->logo_min == "") ? "20" : esc_attr($LOGO->logo_min)).'">';
			$logoDivInner = '';

			$logo_height = (isset($LOGO->logo_height)) ? $LOGO->logo_height: '20';
			$logo_height = preg_replace('/[^0-9.]+/', '', $logo_height);
			$logo_hide = '';

			if (isset($LOGO->logo_id)) {
				if (!is_array($LOGO->logo_id)) $LOGO->logo_id = array($LOGO->logo_id);
				foreach ($LOGO->logo_id as $key => $value) {
					$logo_alt = get_post_meta($value, '_wp_attachment_image_alt', true);
					if ( empty($logo_alt) ) $logo_alt = 'logo';
					$logo_info = uncode_get_media_info($value);
					$media_metavalues = (isset($logo_info->metadata)) ? unserialize($logo_info->metadata) : '';
					if (!empty($logo_info)) {
						if (count($LOGO->logo_id) === 2) {
							if ($key === 0 && $stylemain === 'light') $logo_hide = '';
							else if ($key === 1 && $stylemain === 'dark') $logo_hide = '';
							else $logo_hide = 'display:none;';
							$logoSkinClass = $key === 0 ? ' logo-light' : ' logo-dark';
						} else $logoSkinClass = ' logo-skinnable';
						if ($logo_info->post_mime_type === 'oembed/svg') {
							$media_code = $logo_info->post_content;
							$logo_ratio = $media_metavalues['width'] / $media_metavalues['height'];
							$media_code = preg_replace('#\s(id)="([^"]+)"#', ' $1="$2-' .rand() .'"', $media_code);
							$media_code = preg_replace('#\s(xmlns)="([^"]+)"#', '', $media_code);
							$media_code = preg_replace('#\s(xmlns:svg)="([^"]+)"#', '', $media_code);
							$media_code = preg_replace('#\s(xmlns:xlink)="([^"]+)"#', '', $media_code);
							if ($logo_info->animated_svg) {
								$logoSkinClass = '';
								preg_match('/(id)=("[^"]*")/i', $media_code, $id_attr);
								if (isset($id_attr[2])) {
									$id_icon = str_replace('"', '', $id_attr[2]);
								} else {
									$id_icon = 'icon-' . big_rand();
									$media_code = preg_replace('/<svg/', '<svg id="' . $id_icon . '"', $media_code);
								}
								$icon_time = (isset($logo_info->animated_svg_time) && $logo_info->animated_svg_time !== '') ? $logo_info->animated_svg_time : 100;
								$media_code .= "<script>new Vivus('".$id_icon."', {type: 'delayed', pathTimingFunction: Vivus.EASE_OUT, animTimingFunction: Vivus.LINEAR, duration: ".$icon_time."});</script>";
							}
							if ($menutype === 'menu-overlay' || $menutype === 'menu-overlay-center' || $type === 'offcanvas_head') {
								$vmenu_position = ot_get_option('_uncode_vmenu_position');
								if ($vmenu_position === 'left') $media_code = str_replace('<svg ', '<svg alt="'.$logo_alt.'" preserveAspectRatio="xMaxYMin" ', $media_code);
								else $media_code = str_replace('<svg ', '<svg alt="'.$logo_alt.'" preserveAspectRatio="xMinYMin" ', $media_code);
							} else if ($vertical) {
								$vmenu_position = ot_get_option('_uncode_vmenu_position');
								if ($vmenu_position === 'right') $media_code = str_replace('<svg ', '<svg alt="'.$logo_alt.'" preserveAspectRatio="xMaxYMin" ', $media_code);
								else $media_code = str_replace('<svg ', '<svg alt="'.$logo_alt.'" preserveAspectRatio="xMinYMin" ', $media_code);
							} else {
								if ($menutype === 'hmenu-center-split') $media_code = str_replace('<svg ', '<svg alt="'.$logo_alt.'" preserveAspectRatio="xMidYMid" ', $media_code);
								else $media_code = str_replace('<svg ', '<svg alt="'.$logo_alt.'" preserveAspectRatio="xMinYMin" ', $media_code);
							}
							$logoDivInner .= '<div class="html-code'.$logoSkinClass.'" data-maxheight="'.$logo_height.'" style="height: '.$logo_height.'px;'.$logo_hide.'">';
							$logoDivInner .= '<canvas class="logo-canvas" height="'.round($logo_height).'" width="'.round($logo_ratio * $logo_height) .'"></canvas>';
							$logoDivInner .= $media_code . '</div>' ;
						} else if ($logo_info->post_mime_type === 'oembed/html') {
							$logoDivInner .= '<h2 class="text-logo h3'.$logoSkinClass.'" data-maxheight="'.$logo_height.'" style="font-size:'.$logo_height.'px;'.$logo_hide.'">' . esc_html($logo_info->post_content) . '</h2>' ;
						} else {
							$logo_metavalues = unserialize($logo_info->metadata);
							if (empty($logo_metavalues)) {
								$logo_metavalues['width'] = $logo_metavalues['height'] = 1;
							}

							$logoDivInner .= '<div class="logo-image'.$logoSkinClass.'" data-maxheight="'.$logo_height.'" style="height: '.$logo_height.'px;'.$logo_hide.'">';
							if ($logo_info->post_mime_type === 'image/svg+xml') {
								if ($logo_info->animated_svg) {
									if (isset($logo_metavalues['width']) && $logo_metavalues['width'] !== '1') $icon_width = ' style="width:'.$logo_metavalues['width'].'px"';
									else $icon_width = '';
									$id_icon = 'icon-' . big_rand();
									$icon_time = (isset($logo_info->animated_svg_time) && $logo_info->animated_svg_time !== '') ? $logo_info->animated_svg_time : 100;
									$logoDivInner .= '<div id="'.$id_icon.'"'.$icon_width.' class="icon-media"></div>';
									$logoDivInner .= "<script>new Vivus('".$id_icon."', {type: 'delayed', pathTimingFunction: Vivus.EASE_OUT, animTimingFunction: Vivus.LINEAR, duration: ".$icon_time.", file: '".$logo_info->guid."'});</script>";
								}
								$logoDivInner .= '<img src="'.$logo_info->guid.'" alt="logo" width="'.round($logo_metavalues['width']).'" height="'.round($logo_metavalues['height']).'" class="img-responsive" />';
							} else {
								$logo_resized = uncode_resize_image($logo_info->guid, $logo_info->path, $logo_metavalues['width'], $logo_metavalues['height'], 'null', $logo_height, false, 'height');
								$single_width = $logo_resized['single_width'];
								$logo_class = ' class="img-responsive"';
								$logo_data = '';
								if ($adaptive_images === 'on' && $adaptive_images_async === 'on') {
									$logo_class = ' class="img-responsive adaptive-async"';
									$logo_data = ' data-uniqueid="'.$value.'-'.big_rand().'" data-guid="'.$logo_info->guid.'" data-path="'.$logo_info->path.'" data-width="'.$media_metavalues['width'].'" data-height="'.$media_metavalues['height'].'" data-singlew="'.$single_width.'" data-singleh="null" data-crop="" data-fixed="height"';
								}
								$logoDivInner .= '<img src="'.$logo_resized['url'].'" alt="'.$logo_alt.'" width="'.round($logo_resized['width']).'" height="'.round($logo_resized['height']).'"'.$logo_class.$logo_data.' />';
							}
							$logoDivInner .= '</div>';
						}
					}
				}
			}
			if ($logoDivInner === '') $logoDivInner .= '<h2 class="text-logo h3 logo-skinnable" data-maxheight="'.$logo_height.'" style="font-size:'.$logo_height.'px;">' . esc_html(get_bloginfo( 'name','display' )) . '</h2>';
			$logoDiv .= $logoDivInner;
			$logoDiv .= '</a>';
			$socials = ot_get_option( '_uncode_social_list');
			$boxed = ot_get_option( '_uncode_boxed');
			$menu_bloginfo = ot_get_option( '_uncode_menu_bloginfo');

			$post_type = isset( $post->post_type ) ? $post->post_type : 'post';
			if (is_archive() || is_home()) $post_type .= '_index';
			if (is_404()) $post_type = '404';
			if (is_search()) $post_type = 'search_index';

			$theme_locations = get_nav_menu_locations();

			if (isset($metabox_data['_uncode_specific_menu'][0]) && $metabox_data['_uncode_specific_menu'][0] !== '') {
				$primary_menu = $metabox_data['_uncode_specific_menu'][0];
			} else {
				$menu_generic = ot_get_option( '_uncode_'.$post_type.'_menu');
				if ($menu_generic !== '') {
					$primary_menu = $menu_generic;
				} else {
					$primary_menu = '';
					if (isset($theme_locations['primary'])) {
						$menu_obj = get_term( $theme_locations['primary'], 'nav_menu' );
						if (isset($menu_obj->name)) $primary_menu = $menu_obj->name;
					}
				}
			}

			if (isset($metabox_data['_uncode_specific_menu_width'][0]) && $metabox_data['_uncode_specific_menu_width'][0] !== '') {
				if ($metabox_data['_uncode_specific_menu_width'][0] === 'full') $menu_full_width = true;
			} else {
				$menu_generic_width = ot_get_option( '_uncode_'.$post_type.'_menu_width');
				if ($menu_generic_width === 'full') $menu_full_width = true;
				else
				{
					$menu_full = ot_get_option( '_uncode_menu_full');
					$menu_full_width = ($menu_full !== 'on') ? false : true;
				}
			}
			if (!isset($menu_full_width)) $menu_full_width = false;

			$get_menu_hide = ot_get_option( (wp_is_mobile() ? '_uncode_menu_hide_mobile' : '_uncode_menu_hide') );
			$menu_hide = ($get_menu_hide === 'on')  ? ' menu-hide' : '';
			$menu_sticky = (ot_get_option( (wp_is_mobile() ? '_uncode_menu_sticky_mobile' : '_uncode_menu_sticky')) === 'on') ? ' menu-sticky' : (($get_menu_hide === 'on') ? ' menu-hide-only' : '');
			$menu_no_arrow = (ot_get_option( '_uncode_menu_no_arrows') === 'on')  ? ' menu-no-arrows' : '';
			if ($type === 'vmenu') {
				$menu_hide .= '-vertical';
				$menu_sticky .= '-vertical';
			}

			$effects = '';
			$menu_shrink = (ot_get_option( '_uncode_menu_shrink' ) === 'on' && $type !== 'hmenu-center') ? ' menu-shrink' : '';
			$effects .= ($menu_hide !== '') ? $menu_hide : '';

			if ($boxed === 'on') {
				$effects .= ' limit-width';
			} else {
				if (!$menu_full_width) $main_width = ' limit-width';
			}

			$has_shadows = ot_get_option( '_uncode_menu_shadows') == 'on' ? true : false;
			$has_borders = ot_get_option( '_uncode_menu_borders') == 'on' ? true : false;
			$remove_shadow = (isset($metabox_data['_uncode_specific_menu_no_shadow'][0]) && $metabox_data['_uncode_specific_menu_no_shadow'][0] === 'on') ? true : false;
			$menushadows = $has_shadows ?  ' menu-shadows' : '';
			$menushadows .= $remove_shadow ?  ' force-no-shadows' : '';
			$menuborders = $has_borders ? (($vertical) ? ' vmenu-borders' : ' menu-borders') : ' menu-no-borders';

			$stylemainsubmenu = ot_get_option( '_uncode_primary_submenu_style');
			if ($stylemainsubmenu === '') $stylemainsubmenu = $stylemain;

			$stylesecmenu = ot_get_option( '_uncode_secondary_menu_style');
			if ($stylesecmenu === '') $stylesecmenu = $general_style;

			$transpmainheader = ot_get_option('_uncode_menu_bg_alpha_' . $stylemain);

			$stylemainback = ot_get_option('_uncode_menu_bg_color_' . $stylemain);
			$stylemainback = ($stylemainback === '') ? ' style-' . $stylemain . '-bg' : ' style-' . $stylemainback . '-bg';

			if ($type === 'menu-overlay' || $type === 'menu-overlay-center') {
				$styleoverlay = ot_get_option( '_uncode_overlay_menu_style');
				$stylemainmenu = ' menu-' . $styleoverlay . ' submenu-' . $styleoverlay;
				$buttonstyle_primary = 'mobile-menu-button-' . $styleoverlay;
			} else {
				$stylemainmenu = ' menu-' . $stylemain . ' submenu-' . ($vertical ? $stylemain : $stylemainsubmenu);
				$buttonstyle_primary = 'mobile-menu-button-' . $stylemain;
			}

			$stylemainbackfull = $stylemainback. $menuborders . $menushadows;
			$stylemainback = '';
			$menushadows = '';

			$stylemaincombo = ' menu-primary' . $stylemainmenu;

			$stylesecback = ot_get_option('_uncode_secmenu_bg_color_' . $stylesecmenu);
			$stylesecback = ($stylesecback === '') ? ' style-' . $stylesecmenu . '-bg' : ' style-' . $stylesecback . '-bg';
			$stylesubstylemenu = ' menu-' . $stylesecmenu . ' submenu-' . $stylesecmenu;
			$stylesecbackfull = '';
			$stylesecback = $stylesecback;

			$stylesubcombo = ' menu-secondary' . $stylesubstylemenu;

			if ($transpmainheader !== '100') {
				$remove_transparency = false;
				if (isset($metabox_data['_uncode_specific_menu_opaque'][0]) && $metabox_data['_uncode_specific_menu_opaque'][0] === 'on') {
					$remove_transparency = true;
				} else {
					$get_remove_transparency = ot_get_option( '_uncode_'.$post_type.'_menu_opaque');
					if ($get_remove_transparency === 'on') $remove_transparency = true;
				}

				if (!$remove_transparency) {
					$stylemaincombo .= ' menu-transparent';
					if (!($vertical && $type !== 'offcanvas_head') || $type === 'menu-overlay-center') $stylemaincombo .= ' menu-add-padding';
					$main_absolute = ' menu-absolute';
				}
			}

			$stylemaincombo .= ' style-' . $stylemain . '-original';

			$woo_icon = $woo_icon_mobile = $woo_cart_class = '';
			if ( class_exists( 'WooCommerce' ) ) {
				$woo_cart = ot_get_option('_uncode_woocommerce_cart');
				$woo_icon = ot_get_option('_uncode_woocommerce_cart_icon');
				if ($woo_cart === 'on' && $woo_icon !== '') {
					$woo_cart_mobile = ot_get_option('_uncode_woocommerce_cart_mobile');
					if ($type === 'menu-overlay' || $type === 'menu-overlay-center' || $type === 'offcanvas_head' || $type === 'vmenu-offcanvas') $woo_cart_desktop = ot_get_option('_uncode_woocommerce_cart_desktop');
					else $woo_cart_desktop = '';
					if ($woo_cart_mobile === 'on' || $woo_cart_desktop === 'on') {
						if ($woo_cart_mobile === 'on' && $woo_cart_desktop !== 'on') {
							$woo_cart_class_mobile = 'desktop-hidden ';
							$woo_cart_class = 'mobile-hidden tablet-hidden ';
						} else if ($woo_cart_mobile !== 'on' && $woo_cart_desktop === 'on') {
							$woo_cart_class = 'desktop-hidden ';
							$woo_cart_class_mobile = 'mobile-hidden tablet-hidden ';
						} else {
							$woo_cart_class = 'hidden ';
							$woo_cart_class_mobile = '';
						}
						global $woocommerce;
						$checkout_url = $woocommerce->cart->get_cart_url();
						$tot_articles = $woocommerce->cart->cart_contents_count;
						$icon_badge = (( $tot_articles !== 0 ) ? '<span class="badge">'.$tot_articles.'</span>' : '<span class="badge" style="display: none;"></span>');
						$woo_icon_mobile = '<a class="'.$woo_cart_class_mobile.'mobile-shopping-cart" href="'.$checkout_url.'"><span class="cart-icon-container"><i class="'.$woo_icon.'"></i>'.$icon_badge.'</span></a>';
					}
					if ($woo_cart_class === 'hidden') $woo_icon = '';
					else {
						if ($type == 'offcanvas_head' && $woo_cart_class === '') $woo_cart_class = 'hidden ';
						$woo_icon = uncode_add_cart_in_menu($woo_icon, $woo_cart_class);
					}
				} else $woo_icon = '';
			}

			$search_active = ot_get_option( '_uncode_menu_search');
			$socials_active = ot_get_option( '_uncode_menu_socials');

			if (!empty($socials) && $socials_active === 'on') {
				foreach ($socials as $social) {
					if (isset($social['_uncode_menu_hidden']) && $social['_uncode_menu_hidden'] === 'on' || $social['_uncode_social'] === '') continue;
					$social_html_inner .= '<li class="menu-item-link social-icon tablet-hidden mobile-hidden '.$social['_uncode_social_unique_id'].'"><a href="'.$social['_uncode_link'].'" target="_blank"><i class="'.$social['_uncode_social'].'"></i></a></li>';
				}
			}

			if ($socials_active === 'on' || $search_active === 'on' || $woo_icon !== '' || $woo_icon_mobile !== '' || $social_html_inner !== '') {

				$search_inner = '';

				if ($type === 'menu-overlay-center' && $param === 'menu-overlay-center') {
					$search_inner .= '';
				} else {

					if ($socials_active === 'on' && strpos($type, 'vmenu') === false && $type !== 'hmenu-center-split') {
						if ($param === 'menu-overlay-center' && $vmenu_position === 'right') $search_inner .= '';
						else $search_inner .= $social_html_inner;
					}

					if ($search_active === 'on') {
						$search_inner .= '<li class="menu-item-link search-icon style-'.$stylemain.' dropdown">';
						$search_inner .= 	'<a href="#"'.(!$vertical ? ' class="trigger-overlay search-icon" data-area="search" data-container="box-container"' : '').'>
													<i class="fa fa-search3"></i>';
						if (!$vertical)
							$search_inner .= 		'<span class="desktop-hidden">';
							$search_inner .= 		'<span>' .esc_html__('Search','uncode') . '</span>';
						if (!$vertical)
							$search_inner .=		'</span>';
						$search_inner .=			'<i class="fa fa-angle-down fa-dropdown'.(!$vertical ? ' desktop-hidden' : '').'"></i>
													</a>
													<ul role="menu" class="drop-menu'.(!$vertical ? ' desktop-hidden' : '').'">
														<li>
															<form class="search" method="get" action="'. get_home_url(get_current_blog_id(),'/') .'">
																<input type="search" class="search-field no-livesearch" placeholder="'.esc_html__('Search…','uncode').'" value="" name="s" title="Search for:" />
															</form>
														</li>
													</ul>';
						$search_inner .= 	'</li>';
					}

					if ($param === 'menu-overlay-center' && $vmenu_position === 'right') {
						if ($socials_active === 'on' && strpos($type, 'vmenu') === false && $type !== 'hmenu-center-split')
							$search_inner .= $social_html_inner;
					}

				}

				$search_inner .= $woo_icon;

				if ($search_inner !== '') {

						if ($vertical) $search .= '<div class="menu-accordion">';
						$search .= '<ul class="menu-smart'.(is_rtl() ? ' sm-rtl' : '').' sm'.($vertical ? ' sm-vertical' : ' menu-icons').'">';
						$search .= $search_inner;
						$search .= '</ul>';
						if ($vertical) $search .= '</div>';

				}

			}


			if (!empty($socials) && strpos($type, 'vmenu') !== false) {

				$social_html .= '<div class="nav navbar-nav navbar-social"><ul class="menu-smart'.(is_rtl() ? ' sm-rtl' : '').' sm menu-social mobile-hidden tablet-hidden">';
				$social_html .= $social_html_inner;
				$social_html .= '</ul></div>';
			}

			$no_secondary = ot_get_option('_uncode_menu_no_secondary');

			$secondary_menu = '';
			if ($no_secondary !== 'on' && isset($theme_locations['secondary'])) {
				$menu_obj = get_term( $theme_locations['secondary'], 'nav_menu' );
				if (isset($menu_obj->name)) $secondary_menu = $menu_obj->name;
				$secondary_menu_html = wp_nav_menu(
														array(
																"menu"              => $secondary_menu,
																"theme_location"    => "secondary",
																"container"         => "div",
																"walker"            => new wp_bootstrap_navwalker(),
																'fallback_cb'    => false,
																"container_class"   => "navbar-topmenu navbar-nav-last",
																"menu_class"        => "menu-smart".(is_rtl() ? ' sm-rtl' : '')." menu-mini sm",
																"echo"            => 0
															)
														);

				if ($menu_bloginfo !== '' || ($secondary_menu_html !== '' && !empty($secondary_menu_html)))
					$secondary_menu_html = '<div class="top-menu mobile-hidden tablet-hidden navbar'.$stylesubcombo.$stylesecbackfull.$stylesecback.'">
																		<div class="row-menu'.$main_width.'">
																			<div class="row-menu-inner">
																				<div class="col-lg-0 middle">
																					<div class="menu-bloginfo">
																						<div class="menu-bloginfo-inner style-'.$stylesecmenu.'">
																							'.$menu_bloginfo.'
																						</div>
																					</div>
																				</div>
																				<div class="col-lg-12 menu-horizontal">
																					'.$secondary_menu_html.'
																				</div>
																			</div>
																		</div>
																	</div>';
			}

			switch ($type) {

				/**
				 * Horizontal menus
				 * */
				case 'hmenu-right':
				case 'hmenu-left':
				case 'hmenu-justify':
					$this->html = '<div class="menu-wrapper'.$menu_shrink.$menu_sticky.$menu_no_arrow.'">
													'.($no_secondary !== 'on' ? $secondary_menu_html : '').'
													<header id="masthead" class="navbar'.$stylemaincombo.$main_absolute.' menu-with-logo">
														<div class="menu-container'.$effects.$stylemainbackfull.'">
															<div class="row-menu'.$main_width.'">
																<div class="row-menu-inner'.$stylemainback.'">
																	<div id="logo-container-mobile" class="col-lg-0 logo-container middle">
																		<div id="main-logo" class="navbar-header style-'.$stylemain.'">
																			'.$logoDiv.'
																		</div>
																		<div class="mmb-container">'.$woo_icon_mobile.'<div class="mobile-menu-button '.$buttonstyle_primary.' lines-button x2"><span class="lines"></span></div></div>
																	</div>
																	<div class="col-lg-12 main-menu-container middle">
																		<div class="menu-horizontal">
																			<div class="menu-horizontal-inner">
																				'.wp_nav_menu( array(
																					"menu"              => $primary_menu,
																					"theme_location"    => "primary",
																					"container"         => "div",
																					"container_class"   => "nav navbar-nav navbar-main " . (($search !== '' || $type === 'hmenu-justify') ? 'navbar-nav-first' : 'navbar-nav-last') ,
																					"menu_class"        => "menu-primary-inner menu-smart".(is_rtl() ? ' sm-rtl' : '')." sm",
																					"fallback_cb"       => "wp_bootstrap_navwalker::fallback",
																					"walker"            => new wp_bootstrap_navwalker(),
																					"echo"            => 0)
																				).(($search !== '' || $type === 'hmenu-justify') ? '<div class="nav navbar-nav navbar-nav-last">'.$search.'</div>' : '');
						if ($no_secondary !== 'on')
							$this->html .=						'<div class="desktop-hidden">
														 							'.wp_nav_menu( array(
															 							"menu"              => $secondary_menu,
															 							"theme_location"    => "secondary",
															 							"container"         => "div",
																						"container_class"   => "menu-accordion",
															 							"menu_class"        => "menu-smart".(is_rtl() ? ' sm-rtl' : '')." sm sm-vertical mobile-secondary-menu",
															 							'fallback_cb'    => false,
															 							"walker"            => new wp_bootstrap_navwalker(),
															 							"echo"            => 0)
															 						).
															 					'</div>';
						$this->html .=						'</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</header>
												</div>';
					break;

				/**
				 * Center menu
				 * */
				case 'hmenu-center':
					$this->html = '<div class="menu-wrapper'.$menu_sticky.$menu_no_arrow.' style-'.$stylemain.'-original">'.
													($no_secondary !== 'on' ? $secondary_menu_html : '').
													'<div class="navbar menu-secondary'.$stylemaincombo.$main_absolute.'">
														<div class="menu-container-mobile '.$effects.$stylemainbackfull.'">
															<div class="row-menu style-'.$stylemain.'-bg">
																<div class="row-menu-inner">
																	<div id="logo-container-mobile" class="col-lg-0 logo-container">
																		<div id="main-logo" class="navbar-header style-'.$stylemain.'">
																			'.$logoDiv.'
																		</div>
																	</div>
																</div>
																<div class="mmb-container">'.$woo_icon_mobile.'<div class="mobile-menu-button '.$buttonstyle_primary.' lines-button x2"><span class="lines"></span></div></div>
															</div>
														</div>
													</div>
													<header id="masthead" class="navbar'.$stylemaincombo.'">
														<div class="menu-container'.$effects.$stylemainbackfull.'">
															<div class="row-menu'.$main_width.'">
																<div class="row-menu-inner'.$stylemainback.'">
																	<div class="col-lg-12 main-menu-container middle">
																		<div class="menu-horizontal">
																			<div class="menu-horizontal-inner">
																				'.wp_nav_menu( array(
																					"menu"              => $primary_menu,
																					"theme_location"    => "primary",
																					"container"         => "div",
																					"container_class"   => "nav navbar-nav navbar-main " . ($search !== '' ? 'navbar-nav-first' : 'navbar-nav-last') ,
																					"menu_class"        => "menu-primary-inner menu-smart".(is_rtl() ? ' sm-rtl' : '')." sm",
																					"fallback_cb"       => "wp_bootstrap_navwalker::fallback",
																					"walker"            => new wp_bootstrap_navwalker(),
																					"echo"            => 0)
																				).($search !== '' ? '<div class="nav navbar-nav navbar-nav-last">'.$search.'</div>' : '');
					if ($no_secondary !== 'on')
							$this->html .=						'<div class="desktop-hidden">
														 							'.wp_nav_menu( array(
															 							"menu"              => $secondary_menu,
															 							"theme_location"    => "secondary",
															 							"container"         => "div",
																						"container_class"   => "menu-accordion",
															 							"menu_class"        => "menu-smart".(is_rtl() ? ' sm-rtl' : '')." sm sm-vertical mobile-secondary-menu",
															 							'fallback_cb'    => false,
															 							"walker"            => new wp_bootstrap_navwalker(),
															 							"echo"            => 0)
															 						).
															 					'</div>';
						$this->html .=						'</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</header>
												</div>';
					break;

				case 'hmenu-center-split':
					global $logo_html;
					$logo_html = '<div class="logo-container megamenu-diff middle">
													<div id="main-logo" class="navbar-header style-'.$stylemain.'">
														'.$logoDiv.'
													</div>
													<div class="mmb-container"><div class="mobile-menu-button '.$buttonstyle_primary.' lines-button x2"><span class="lines"></span></div></div>
												</div>';
					add_filter('wp_nav_menu_objects', 'uncode_center_nav_menu_items', 10, 2);
					$this->html = '<div class="menu-wrapper'.$menu_shrink.$menu_sticky.$menu_no_arrow.'">
													'.($no_secondary !== 'on' ? $secondary_menu_html : '').'
													<header id="masthead" class="navbar'.$stylemaincombo.$main_absolute.' menu-with-logo">
														<div class="menu-container'.$effects.$stylemainbackfull.'">
															<div class="row-menu'.$main_width.'">
																<div class="row-menu-inner'.$stylemainback.'">
																	<div id="logo-container-mobile" class="col-lg-0 logo-container megamenu-diff desktop-hidden">
																		<div class="navbar-header style-'.$stylemain.'">
																			'.$logoDiv.'
																		</div>
																		<div class="mmb-container">'.$woo_icon_mobile.'<div class="mobile-menu-button '.$buttonstyle_primary.' lines-button x2"><span class="lines"></span></div></div>
																	</div>
																	<div class="col-lg-12 main-menu-container middle">
																		<div class="menu-horizontal">
																			<div class="menu-horizontal-inner">';
						if ($social_html_inner !== '')
							$this->html .=						'<div class="nav navbar-nav navbar-nav-first">
																					<ul class="menu-smart'.(is_rtl() ? ' sm-rtl' : '').' sm menu-icons mobile-hidden tablet-hidden">
																						'.$social_html_inner.'
																					</ul>
																				</div>';
							$this->html .=						wp_nav_menu( array(
																					"menu"              => $primary_menu,
																					"theme_location"    => "primary",
																					"container"         => "div",
																					"container_class"   => "nav navbar-nav navbar-main",
																					"menu_class"        => "menu-primary-inner menu-smart".(is_rtl() ? ' sm-rtl' : '')." sm",
																					"fallback_cb"       => "wp_bootstrap_navwalker::fallback",
																					"walker"            => new wp_bootstrap_navwalker(),
																					"echo"            => 0)
																				);

						if ($search !== '')
							$this->html .=						'<div class="nav navbar-nav navbar-nav-last">'.$search.'</div>';

						if ($no_secondary !== 'on')
							$this->html .=						'<div class="desktop-hidden">
														 							'.wp_nav_menu( array(
															 							"menu"              => $secondary_menu,
															 							"theme_location"    => "secondary",
															 							"container"         => "div",
																						"container_class"   => "menu-accordion",
															 							"menu_class"        => "menu-smart".(is_rtl() ? ' sm-rtl' : '')." sm sm-vertical mobile-secondary-menu",
															 							'fallback_cb'    => false,
															 							"walker"            => new wp_bootstrap_navwalker(),
															 							"echo"            => 0)
															 						).
															 					'</div>';
						$this->html .=						'</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</header>
												</div>';
					break;

				case 'offcanvas_head':
					$this->html = '<div class="menu-wrapper'.$menu_shrink.$menu_sticky.'">
													<div id="masthead" class="navbar'.$stylemaincombo.$main_absolute.' menu-with-logo">
														<div class="menu-container'.$effects.$stylemainbackfull.'">
															<div class="row-menu row-offcanvas'.$main_width.'">
																<div class="row-menu-inner row-brand menu-horizontal-inner'.$stylemainback.'">';

					if ($param == 'menu-overlay-center' && $search !== '')
						$this->html .= 				'<div class="nav navbar-nav navbar-nav-first">
																		'.$search.'
																	</div>';
					$this->html .= 					'<div id="logo-container-mobile" class="col-lg-0 logo-container middle">
																		<div id="main-logo" class="navbar-header style-'.$stylemain.'">
																			'.$logoDiv.'
																		</div>
																	</div>
																	<div class="mmb-container">'.$woo_icon_mobile.'<div class="'.(($param == 'menu-overlay' || $param == 'menu-overlay-center') ? 'mobile-menu-button menu-button-overlay no-toggle' : 'mobile-menu-button menu-button-offcanvas').' '.$buttonstyle_primary.' lines-button x2 trigger-overlay" '.(($param == 'menu-overlay' || $param == 'menu-overlay-center') ? 'data-area="menu" data-container="main-container"' : '').'><span class="lines"></span></div></div>
																</div>
															</div>
														</div>
													</div>
												</div>';
					break;

				/**
				 * Overlay menu
				 * */
				case 'menu-overlay':
				case 'menu-overlay-center':
					$overlay_animation = ot_get_option( '_uncode_menu_overlay_animation');
					if ($overlay_animation === '' || $overlay_animation === '3d') $overlay_animation = 'contentscale';
					$this->html =	'<div class="overlay overlay-'.$overlay_animation.' style-'.$styleoverlay.'-bg overlay-menu" data-area="menu" data-container="main-container">
													<div class="main-header">
														<div class="vmenu-container menu-container style-'.$styleoverlay.$menu_no_arrow.$stylemaincombo.'">
															<div class="row row-parent">
																<div class="row-inner">
																	<div class="menu-sidebar main-menu-container">
																		<div class="navbar-main">
																			<div class="menu-sidebar-inner">
																				'.wp_nav_menu( array(
														 							"menu"              => $primary_menu,
														 							"theme_location"    => "primary",
														 							"container"         => "div",
																					"container_class"   => "menu-accordion",
														 							"menu_class"        => "menu-primary-inner menu-smart".(is_rtl() ? ' sm-rtl' : '')." sm sm-vertical",
														 							"fallback_cb"       => "wp_bootstrap_navwalker::fallback",
														 							"walker"            => new wp_bootstrap_navwalker(),
														 							"echo"            => 0)
														 						);
					if ($search !== '' && ($type === 'menu-overlay' || $type === 'menu-overlay-center'))
						$this->html .= $search;

					if ($no_secondary !== 'on')
							$this->html .= 						wp_nav_menu( array(
														 							"menu"              => $secondary_menu,
														 							"theme_location"    => "secondary",
														 							"container"         => "div",
														 							"items_wrap"      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
																					"container_class"   => "menu-accordion",
														 							"menu_class"        => "menu-smart".(is_rtl() ? ' sm-rtl' : '')." sm sm-vertical",
														 							'fallback_cb'    => false,
														 							"walker"            => new wp_bootstrap_navwalker(),
														 							"echo"            => 0)
														 						);
						$this->html .= 						'</div>
																		</div>
												 					</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="mmb-container mmb-container-overlay mobile-hidden tablet-hidden"><div class="mobile-menu-button menu-button-overlay '.$buttonstyle_primary.' lines-button x2 overlay-close" data-area="menu" data-container="main-container"><span class="lines"></span></div></div>';
					break;

				/**
				 * Vertical menus
				 * */
				default:
					$footer_copyright = ot_get_option('_uncode_footer_copyright');
					$footer_text_content = '';
					if ($footer_copyright !== 'off') {
						$footer_text_content .= '<p>&copy; '.date("Y").' '.get_bloginfo('name') . ' <span style="white-space:nowrap;">' . esc_html__('All rights reserved','uncode') . '</span></p>';
					}

					$footer_text = ot_get_option('_uncode_footer_text');
					if ($footer_text !== '') {
						$footer_text_content .= uncode_remove_wpautop($footer_text);
					}
					$this->html = '<div class="main-header">
													<div id="masthead" class="masthead-vertical'.$menu_sticky.'">
														<div class="vmenu-container menu-container '.str_replace(' menu-transparent', '', $stylemaincombo).$stylemainbackfull.$menu_no_arrow.$menu_hide.'">
															<div class="row row-parent'.$stylemainback.'">';
					if ($menutype !== 'vmenu-offcanvas')
						$this->html .= 			'<div class="row-inner restrict row-brand">
																	<div id="logo-container-mobile" class="col-lg-12 logo-container">
																		<div class="style-'.$stylemain.'">
																			'.$logoDiv.'
																		</div>
																		<div class="mmb-container">'.$woo_icon_mobile.'<div class="mobile-menu-button '.$buttonstyle_primary.' lines-button x2"><span class="lines"></span></div></div>
																	</div>
																</div>';

					$this->html .= 				'<div class="row-inner expand">
																	<div class="main-menu-container">
																		<div class="row-inner expand">
																			<div class="menu-sidebar navbar-main">
																				<div class="menu-sidebar-inner">
																					'.wp_nav_menu( array(
															 							"menu"              => $primary_menu,
															 							"theme_location"    => "primary",
															 							"container"         => "div",
																						"container_class"   => "menu-accordion",
															 							"menu_class"        => "menu-primary-inner menu-smart".(is_rtl() ? ' sm-rtl' : '')." sm sm-vertical",
															 							"fallback_cb"       => "wp_bootstrap_navwalker::fallback",
															 							"walker"            => new wp_bootstrap_navwalker(),
															 							"echo"            => 0)
															 						).'
														 						</div>
													 						</div>
													 					</div>';
					if ($no_secondary !== 'on' || $social_html !== '' || $search !== '' || $footer_text_content !== '') {

						$secondary_menu_html = $search;

						if ($no_secondary !== 'on') {
							$secondary_menu_nav = wp_nav_menu( array(
													 							"menu"              => $secondary_menu,
													 							"theme_location"    => "secondary",
													 							"container"         => "div",
													 							"items_wrap"      	=> '<ul id="%1$s" class="%2$s">%3$s</ul>',
																				"container_class"   => "menu-accordion",
													 							"menu_class"        => "menu-smart".(is_rtl() ? ' sm-rtl' : '')." sm sm-vertical",
													 							'fallback_cb'    		=> false,
													 							"walker"            => new wp_bootstrap_navwalker(),
													 							"echo"            	=> 0)
													 						);
							if ($secondary_menu_nav !== '')
								$secondary_menu_html .= $secondary_menu_nav;
						}

						if ($social_html !== '')
							$secondary_menu_html .= $social_html;

						if ($footer_text_content !== '')
							$secondary_menu_html .= '<div class="mobile-hidden tablet-hidden vmenu-footer style-'.$stylemain.'">' . $footer_text_content . '</div>';

						if ($secondary_menu_html !== '')
							$this->html .=				'<div class="row-inner restrict">
													 						<div class="menu-sidebar">
													 							<div class="menu-sidebar-inner">
																					'.$secondary_menu_html.'
																				</div>
																			</div>
																		</div>';

					}

					$this->html .= 					'</div>
																</div>
															</div>
														</div>
													</div>
												</div>';
				break;
			}
		}
	}
}

?>