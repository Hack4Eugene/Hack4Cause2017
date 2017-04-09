/*
----------------------------------------------------------
[Table of contents]

#Skins-General
#Skins-Buttons
#Skins-Alerts
#Skins-Menus
#Skins-Thumbs

----------------------------------------------------------
*/
/*
----------------------------------------------------------

#Skins-General

----------------------------------------------------------
*/
/* #GENERAL */
body {
  font-weight: 400;
  font-family: <?php echo esc_html($font_family_base); ?>;
}
body,
.row-inner div[class*=col-lg-] {
  font-size: 14px;
}
::selection {
  background: <?php echo esc_html($color_primary); ?>;
  color: #fff !important;
}
::-moz-selection {
  background: <?php echo esc_html($color_primary); ?>;
  color: #fff !important;
}
/* #Font-ui-fixed */
.font-ui-fixed,
.post-info,
.widget-container .widget-title,
#comments .comments-title,
#respond .comments-title,
#comments #reply-title,
#respond #reply-title,
.uncode-share h6,
.woocommerce div.product .wootabs .tab-pane:not(.tab-vcomposer) .product-tab-title,
.woocommerce #content div.product .wootabs .tab-pane:not(.tab-vcomposer) .product-tab-title,
.woocommerce #reviews .woocomments .woocomments-title,
.woocommerce .products.related .related-title,
.woocommerce #review_form #respond #reply-title {
  font-family: <?php echo esc_html($font_family_ui); ?>;
  font-weight: <?php echo esc_html($ui_font_weight); ?>;
  letter-spacing: 0.05em;
  text-transform: uppercase;
  font-size: 12px;
}
.font-ui,
.plan .plan-title > h3,
.plan .plan-price .price,
#main-logo .text-logo,
.isotope-filters ul.menu-smart > li > span > a,
.comment-content .comment-reply-link span,
.comment-content .comment-reply-link {
  font-family: <?php echo esc_html($font_family_ui); ?>;
  font-weight: <?php echo esc_html($ui_font_weight); ?>;
  letter-spacing: 0.05em;
  text-transform: uppercase;
}
/* #Body-color-light */
.style-light {
  color: <?php echo esc_html($color_text); ?>;
}
/* #Body-color-dark */
.style-dark {
  color: <?php echo esc_html($color_text_inverted); ?>;
}
/* #Divider-break */
hr.separator-break {
  width: 90px;
  border-top-width: 2px;
}
hr.separator-break.separator-accent {
  border-color: <?php echo esc_html($color_primary); ?> !important;
}
/* #Paragraph-color */
/* #Link-color */
.style-dark .link,
.style-dark.style-override .link,
.style-light .style-dark .link,
.style-dark a,
.style-dark.style-override a,
.style-light .style-dark a,
.style-dark input[type=checkbox]:checked:before,
.style-dark.style-override input[type=checkbox]:checked:before,
.style-light .style-dark input[type=checkbox]:checked:before {
  color: <?php echo esc_html($color_heading_inverted); ?>;
}
.style-light .link,
.style-light.style-override .link,
.style-dark .style-light .link,
.style-light a,
.style-light.style-override a,
.style-dark .style-light a,
.style-light input[type=checkbox]:checked:before,
.style-light.style-override input[type=checkbox]:checked:before,
.style-dark .style-light input[type=checkbox]:checked:before {
  color: <?php echo esc_html($color_heading); ?>;
}
/* #Link-color-hover */
.style-dark .link-hover,
.style-dark.style-override .link-hover,
.style-light .style-dark .link-hover,
.style-dark a:not(.btn-text-skin):hover,
.style-dark.style-override a:not(.btn-text-skin):hover,
.style-light .style-dark a:not(.btn-text-skin):hover,
.style-dark a:not(.btn-text-skin):focus,
.style-dark.style-override a:not(.btn-text-skin):focus,
.style-light .style-dark a:not(.btn-text-skin):focus,
.style-dark a.active,
.style-dark.style-override a.active,
.style-light .style-dark a.active,
.style-dark .tmb .t-entry-text .t-entry-title a:hover,
.style-dark.style-override .tmb .t-entry-text .t-entry-title a:hover,
.style-light .style-dark .tmb .t-entry-text .t-entry-title a:hover,
.style-dark .tmb .t-entry-text .t-entry-title a:focus,
.style-dark.style-override .tmb .t-entry-text .t-entry-title a:focus,
.style-light .style-dark .tmb .t-entry-text .t-entry-title a:focus,
.style-dark .tmb .t-entry p.t-entry-comments .extras a:hover i,
.style-dark.style-override .tmb .t-entry p.t-entry-comments .extras a:hover i,
.style-light .style-dark .tmb .t-entry p.t-entry-comments .extras a:hover i,
.style-dark .tmb .t-entry p.t-entry-comments .extras a.active i,
.style-dark.style-override .tmb .t-entry p.t-entry-comments .extras a.active i,
.style-light .style-dark .tmb .t-entry p.t-entry-comments .extras a.active i,
.style-dark .tmb .t-entry p.t-entry-comments .extras a:focus i,
.style-dark.style-override .tmb .t-entry p.t-entry-comments .extras a:focus i,
.style-light .style-dark .tmb .t-entry p.t-entry-comments .extras a:focus i,
.style-dark .widget_nav_menu li.active > a,
.style-dark.style-override .widget_nav_menu li.active > a,
.style-light .style-dark .widget_nav_menu li.active > a,
.style-dark div[class*=sharer-].share-button label:hover,
.style-dark.style-override div[class*=sharer-].share-button label:hover,
.style-light .style-dark div[class*=sharer-].share-button label:hover,
.style-dark div[class*=sharer-].share-button label:focus,
.style-dark.style-override div[class*=sharer-].share-button label:focus,
.style-light .style-dark div[class*=sharer-].share-button label:focus {
  color: <?php echo esc_html($color_primary); ?>;
}
.style-light .link-hover,
.style-light.style-override .link-hover,
.style-dark .style-light .link-hover,
.style-light a:not(.btn-text-skin):hover,
.style-light.style-override a:not(.btn-text-skin):hover,
.style-dark .style-light a:not(.btn-text-skin):hover,
.style-light a:not(.btn-text-skin):focus,
.style-light.style-override a:not(.btn-text-skin):focus,
.style-dark .style-light a:not(.btn-text-skin):focus,
.style-light a.active,
.style-light.style-override a.active,
.style-dark .style-light a.active,
.style-light .tmb .t-entry-text .t-entry-title a:hover,
.style-light.style-override .tmb .t-entry-text .t-entry-title a:hover,
.style-dark .style-light .tmb .t-entry-text .t-entry-title a:hover,
.style-light .tmb .t-entry-text .t-entry-title a:focus,
.style-light.style-override .tmb .t-entry-text .t-entry-title a:focus,
.style-dark .style-light .tmb .t-entry-text .t-entry-title a:focus,
.style-light .tmb .t-entry p.t-entry-comments .extras a:hover i,
.style-light.style-override .tmb .t-entry p.t-entry-comments .extras a:hover i,
.style-dark .style-light .tmb .t-entry p.t-entry-comments .extras a:hover i,
.style-light .tmb .t-entry p.t-entry-comments .extras a.active i,
.style-light.style-override .tmb .t-entry p.t-entry-comments .extras a.active i,
.style-dark .style-light .tmb .t-entry p.t-entry-comments .extras a.active i,
.style-light .tmb .t-entry p.t-entry-comments .extras a:focus i,
.style-light.style-override .tmb .t-entry p.t-entry-comments .extras a:focus i,
.style-dark .style-light .tmb .t-entry p.t-entry-comments .extras a:focus i,
.style-light .widget_nav_menu li.active > a,
.style-light.style-override .widget_nav_menu li.active > a,
.style-dark .style-light .widget_nav_menu li.active > a,
.style-light div[class*=sharer-].share-button label:hover,
.style-light.style-override div[class*=sharer-].share-button label:hover,
.style-dark .style-light div[class*=sharer-].share-button label:hover,
.style-light div[class*=sharer-].share-button label:focus,
.style-light.style-override div[class*=sharer-].share-button label:focus,
.style-dark .style-light div[class*=sharer-].share-button label:focus {
  color: <?php echo esc_html($color_primary); ?>;
}
/* #Link-color-background */
.style-dark .link-bg,
.style-dark.style-override .link-bg,
.style-light .style-dark .link-bg,
.style-dark input[type=radio]:checked:before,
.style-dark.style-override input[type=radio]:checked:before,
.style-light .style-dark input[type=radio]:checked:before {
  background-color: <?php echo esc_html($color_primary); ?>;
}
.style-light .link-bg,
.style-light.style-override .link-bg,
.style-dark .style-light .link-bg,
.style-light input[type=radio]:checked:before,
.style-light.style-override input[type=radio]:checked:before,
.style-dark .style-light input[type=radio]:checked:before {
  background-color: <?php echo esc_html($color_primary); ?>;
}
.style-dark .text-default-color,
.style-light .style-dark .text-default-color {
  color: <?php echo esc_html($color_heading_inverted); ?>;
}
.style-light .text-default-color,
.style-dark .style-light .text-default-color {
  color: <?php echo esc_html($color_heading); ?>;
}
.color-accent-border,
blockquote {
  border-color: <?php echo esc_html($color_primary); ?>;
}
.color-accent-background,
mark,
.mejs-controls .mejs-time-rail .mejs-time-loaded,
.woocommerce span.onsale,
.widget_price_filter .ui-slider .ui-slider-range,
.uncode-cart .badge,
.mobile-shopping-cart .badge {
  background-color: <?php echo esc_html($color_primary); ?>;
}
.color-accent-color,
.wpcf7 .wpcf7-mail-sent-ok,
.wpcf7 .wpcf7-validation-errors,
.wpcf7 span.wpcf7-not-valid-tip,
.nav-tabs > li.active > a,
.panel-title.active > a,
.panel-title.active > a span:after,
.plan-accent.plan .plan-title > h3,
.plan-accent.plan .plan-price .price {
  color: <?php echo esc_html($color_primary); ?> !important;
}
/* #Heading-style */
.headings-style,
h1,
h2,
h3,
h4,
h5,
h6,
.tmb .t-entry .t-entry-cat,
.tmb .t-entry .t-entry-title,
.tmb-woocommerce.tmb .t-entry-visual .add-to-cart-overlay a,
.author-details-data .author-heading span,
.vc_progress_bar .vc_progress_label,
.vc_pie_chart .vc_pie_chart_value,
ul.dwls_search_results .daves-wordpress-live-search_title .search-title,
.woocommerce div.product span.price,
.woocommerce #content div.product span.price,
.woocommerce div.product p.price,
.woocommerce #content div.product p.price,
.woocommerce div.product form.cart .group_table .price,
.woocommerce #content div.product form.cart .group_table .price,
.woocommerce div.product form.cart .group_table .price *,
.woocommerce #content div.product form.cart .group_table .price *,
span.price,
p.price,
p .thank-you {
  font-weight: <?php echo esc_html($heading_font_weight); ?>;
  font-family: <?php echo esc_html($font_family_headings); ?>;
}
/* #Headings-color */
.style-dark .headings-color,
.style-light .style-dark .headings-color,
.style-dark h1,
.style-light .style-dark h1,
.style-dark h2,
.style-light .style-dark h2,
.style-dark h3,
.style-light .style-dark h3,
.style-dark h4,
.style-light .style-dark h4,
.style-dark h5,
.style-light .style-dark h5,
.style-dark h6,
.style-light .style-dark h6,
.style-dark p b,
.style-light .style-dark p b,
.style-dark p strong,
.style-light .style-dark p strong,
.style-dark dl dt,
.style-light .style-dark dl dt,
.style-dark blockquote p,
.style-light .style-dark blockquote p,
.style-dark table thead,
.style-light .style-dark table thead,
.style-dark form p,
.style-light .style-dark form p,
.style-dark .panel-title > a span:after,
.style-light .style-dark .panel-title > a span:after,
.style-dark .plan .plan-price .price,
.style-light .style-dark .plan .plan-price .price,
.style-dark .detail-label,
.style-light .style-dark .detail-label,
.style-dark .countdown,
.style-light .style-dark .countdown,
.style-dark .counter,
.style-light .style-dark .counter,
.style-dark .counter-suffix,
.style-light .style-dark .counter-suffix,
.style-dark .counter-prefix,
.style-light .style-dark .counter-prefix,
.style-dark .header-wrapper .header-scrolldown i,
.style-light .style-dark .header-wrapper .header-scrolldown i,
.style-dark .header-wrapper .header-content-inner blockquote.pullquote p:first-child,
.style-light .style-dark .header-wrapper .header-content-inner blockquote.pullquote p:first-child,
.style-dark .header-main-container .post-info,
.style-light .style-dark .header-main-container .post-info,
.style-dark .header-main-container .post-info a,
.style-light .style-dark .header-main-container .post-info a,
.style-dark .widget-container.widget_recent_comments li:before,
.style-light .style-dark .widget-container.widget_recent_comments li:before,
.style-dark .widget-container.widget_recent_entries li:before,
.style-light .style-dark .widget-container.widget_recent_entries li:before,
.style-dark .widget-container.widget_pages li:before,
.style-light .style-dark .widget-container.widget_pages li:before,
.style-dark .widget-container.widget_top_rated_products li:before,
.style-light .style-dark .widget-container.widget_top_rated_products li:before,
.style-dark .widget-container.widget_recent_reviews li:before,
.style-light .style-dark .widget-container.widget_recent_reviews li:before,
.style-dark .widget-container.widget_latest_tweets_widget .tweet-text:before,
.style-light .style-dark .widget-container.widget_latest_tweets_widget .tweet-text:before,
.style-dark .widget-container.widget_latest_tweets .tweet-text:before,
.style-light .style-dark .widget-container.widget_latest_tweets .tweet-text:before,
.style-dark .comment-content .comment-author a,
.style-light .style-dark .comment-content .comment-author a,
.style-dark .comment-content .comment-author span,
.style-light .style-dark .comment-content .comment-author span,
.style-dark .author-details-data .author-name a,
.style-light .style-dark .author-details-data .author-name a,
.style-dark div[class*=sharer-].share-button label,
.style-light .style-dark div[class*=sharer-].share-button label,
.style-dark .share-button.share-inline .social.top li,
.style-light .style-dark .share-button.share-inline .social.top li,
.style-dark .vc_progress_bar .vc_progress_label,
.style-light .style-dark .vc_progress_bar .vc_progress_label,
.style-dark .vc_pie_chart .vc_pie_chart_value,
.style-light .style-dark .vc_pie_chart .vc_pie_chart_value,
.style-dark ul.dwls_search_results .daves-wordpress-live-search_title .search-title,
.style-light .style-dark ul.dwls_search_results .daves-wordpress-live-search_title .search-title,
.style-dark ul.dwls_search_results .daves-wordpress-live-search_author,
.style-light .style-dark ul.dwls_search_results .daves-wordpress-live-search_author,
.style-dark .woocommerce nav.woocommerce-pagination ul li a,
.style-light .style-dark .woocommerce nav.woocommerce-pagination ul li a,
.style-dark .woocommerce #content nav.woocommerce-pagination ul li a,
.style-light .style-dark .woocommerce #content nav.woocommerce-pagination ul li a,
.style-dark .woocommerce nav.woocommerce-pagination ul li span,
.style-light .style-dark .woocommerce nav.woocommerce-pagination ul li span,
.style-dark .woocommerce #content nav.woocommerce-pagination ul li span,
.style-light .style-dark .woocommerce #content nav.woocommerce-pagination ul li span,
.style-dark .woocommerce table.cart a.remove,
.style-light .style-dark .woocommerce table.cart a.remove,
.style-dark .woocommerce #content table.cart a.remove,
.style-light .style-dark .woocommerce #content table.cart a.remove,
.style-dark .woocommerce ul.cart_list li .amount,
.style-light .style-dark .woocommerce ul.cart_list li .amount,
.style-dark .woocommerce ul.product_list_widget li .amount,
.style-light .style-dark .woocommerce ul.product_list_widget li .amount,
.style-dark .woocommerce ul.cart_list li a,
.style-light .style-dark .woocommerce ul.cart_list li a,
.style-dark .woocommerce ul.product_list_widget li a,
.style-light .style-dark .woocommerce ul.product_list_widget li a,
.style-dark .woocommerce ul.cart_list li .h2,
.style-light .style-dark .woocommerce ul.cart_list li .h2,
.style-dark .woocommerce ul.product_list_widget li .h2,
.style-light .style-dark .woocommerce ul.product_list_widget li .h2,
.style-dark .woocommerce.widget_shopping_cart .total,
.style-light .style-dark .woocommerce.widget_shopping_cart .total,
.style-dark .woocommerce .widget_shopping_cart .total,
.style-light .style-dark .woocommerce .widget_shopping_cart .total,
.style-dark .woocommerce .cart-collaterals .cart_totals table th,
.style-light .style-dark .woocommerce .cart-collaterals .cart_totals table th,
.style-dark .woocommerce .cart-collaterals .cart_totals .order-total .amount,
.style-light .style-dark .woocommerce .cart-collaterals .cart_totals .order-total .amount,
.style-dark .woocommerce .order_details li strong,
.style-light .style-dark .woocommerce .order_details li strong,
.style-dark .star-rating,
.style-light .style-dark .star-rating,
.style-dark span.price,
.style-light .style-dark span.price,
.style-dark p.price,
.style-light .style-dark p.price,
.style-dark table.shop_attributes th,
.style-light .style-dark table.shop_attributes th,
.style-dark td.product-name a,
.style-light .style-dark td.product-name a,
.style-dark p .thank-you,
.style-light .style-dark p .thank-you,
.style-dark .form-row label,
.style-light .style-dark .form-row label,
.style-dark .row-message,
.style-light .style-dark .row-message,
.style-dark .order-details tfoot tr:last-child,
.style-light .style-dark .order-details tfoot tr:last-child,
.style-dark #order_review tfoot tr:last-child,
.style-light .style-dark #order_review tfoot tr:last-child,
.style-dark table.variations label,
.style-light .style-dark table.variations label {
  color: <?php echo esc_html($color_heading_inverted); ?>;
}
.style-light .headings-color,
.style-dark .style-light .headings-color,
.style-light h1,
.style-dark .style-light h1,
.style-light h2,
.style-dark .style-light h2,
.style-light h3,
.style-dark .style-light h3,
.style-light h4,
.style-dark .style-light h4,
.style-light h5,
.style-dark .style-light h5,
.style-light h6,
.style-dark .style-light h6,
.style-light p b,
.style-dark .style-light p b,
.style-light p strong,
.style-dark .style-light p strong,
.style-light dl dt,
.style-dark .style-light dl dt,
.style-light blockquote p,
.style-dark .style-light blockquote p,
.style-light table thead,
.style-dark .style-light table thead,
.style-light form p,
.style-dark .style-light form p,
.style-light .panel-title > a span:after,
.style-dark .style-light .panel-title > a span:after,
.style-light .plan .plan-price .price,
.style-dark .style-light .plan .plan-price .price,
.style-light .detail-label,
.style-dark .style-light .detail-label,
.style-light .countdown,
.style-dark .style-light .countdown,
.style-light .counter,
.style-dark .style-light .counter,
.style-light .counter-suffix,
.style-dark .style-light .counter-suffix,
.style-light .counter-prefix,
.style-dark .style-light .counter-prefix,
.style-light .header-wrapper .header-scrolldown i,
.style-dark .style-light .header-wrapper .header-scrolldown i,
.style-light .header-wrapper .header-content-inner blockquote.pullquote p:first-child,
.style-dark .style-light .header-wrapper .header-content-inner blockquote.pullquote p:first-child,
.style-light .header-main-container .post-info,
.style-dark .style-light .header-main-container .post-info,
.style-light .header-main-container .post-info a,
.style-dark .style-light .header-main-container .post-info a,
.style-light .widget-container.widget_recent_comments li:before,
.style-dark .style-light .widget-container.widget_recent_comments li:before,
.style-light .widget-container.widget_recent_entries li:before,
.style-dark .style-light .widget-container.widget_recent_entries li:before,
.style-light .widget-container.widget_pages li:before,
.style-dark .style-light .widget-container.widget_pages li:before,
.style-light .widget-container.widget_top_rated_products li:before,
.style-dark .style-light .widget-container.widget_top_rated_products li:before,
.style-light .widget-container.widget_recent_reviews li:before,
.style-dark .style-light .widget-container.widget_recent_reviews li:before,
.style-light .widget-container.widget_latest_tweets_widget .tweet-text:before,
.style-dark .style-light .widget-container.widget_latest_tweets_widget .tweet-text:before,
.style-light .widget-container.widget_latest_tweets .tweet-text:before,
.style-dark .style-light .widget-container.widget_latest_tweets .tweet-text:before,
.style-light .comment-content .comment-author a,
.style-dark .style-light .comment-content .comment-author a,
.style-light .comment-content .comment-author span,
.style-dark .style-light .comment-content .comment-author span,
.style-light .author-details-data .author-name a,
.style-dark .style-light .author-details-data .author-name a,
.style-light div[class*=sharer-].share-button label,
.style-dark .style-light div[class*=sharer-].share-button label,
.style-light .share-button.share-inline .social.top li,
.style-dark .style-light .share-button.share-inline .social.top li,
.style-light .vc_progress_bar .vc_progress_label,
.style-dark .style-light .vc_progress_bar .vc_progress_label,
.style-light .vc_pie_chart .vc_pie_chart_value,
.style-dark .style-light .vc_pie_chart .vc_pie_chart_value,
.style-light ul.dwls_search_results .daves-wordpress-live-search_title .search-title,
.style-dark .style-light ul.dwls_search_results .daves-wordpress-live-search_title .search-title,
.style-light ul.dwls_search_results .daves-wordpress-live-search_author,
.style-dark .style-light ul.dwls_search_results .daves-wordpress-live-search_author,
.style-light .woocommerce nav.woocommerce-pagination ul li a,
.style-dark .style-light .woocommerce nav.woocommerce-pagination ul li a,
.style-light .woocommerce #content nav.woocommerce-pagination ul li a,
.style-dark .style-light .woocommerce #content nav.woocommerce-pagination ul li a,
.style-light .woocommerce nav.woocommerce-pagination ul li span,
.style-dark .style-light .woocommerce nav.woocommerce-pagination ul li span,
.style-light .woocommerce #content nav.woocommerce-pagination ul li span,
.style-dark .style-light .woocommerce #content nav.woocommerce-pagination ul li span,
.style-light .woocommerce table.cart a.remove,
.style-dark .style-light .woocommerce table.cart a.remove,
.style-light .woocommerce #content table.cart a.remove,
.style-dark .style-light .woocommerce #content table.cart a.remove,
.style-light .woocommerce ul.cart_list li .amount,
.style-dark .style-light .woocommerce ul.cart_list li .amount,
.style-light .woocommerce ul.product_list_widget li .amount,
.style-dark .style-light .woocommerce ul.product_list_widget li .amount,
.style-light .woocommerce ul.cart_list li a,
.style-dark .style-light .woocommerce ul.cart_list li a,
.style-light .woocommerce ul.product_list_widget li a,
.style-dark .style-light .woocommerce ul.product_list_widget li a,
.style-light .woocommerce ul.cart_list li .h2,
.style-dark .style-light .woocommerce ul.cart_list li .h2,
.style-light .woocommerce ul.product_list_widget li .h2,
.style-dark .style-light .woocommerce ul.product_list_widget li .h2,
.style-light .woocommerce.widget_shopping_cart .total,
.style-dark .style-light .woocommerce.widget_shopping_cart .total,
.style-light .woocommerce .widget_shopping_cart .total,
.style-dark .style-light .woocommerce .widget_shopping_cart .total,
.style-light .woocommerce .cart-collaterals .cart_totals table th,
.style-dark .style-light .woocommerce .cart-collaterals .cart_totals table th,
.style-light .woocommerce .cart-collaterals .cart_totals .order-total .amount,
.style-dark .style-light .woocommerce .cart-collaterals .cart_totals .order-total .amount,
.style-light .woocommerce .order_details li strong,
.style-dark .style-light .woocommerce .order_details li strong,
.style-light .star-rating,
.style-dark .style-light .star-rating,
.style-light span.price,
.style-dark .style-light span.price,
.style-light p.price,
.style-dark .style-light p.price,
.style-light table.shop_attributes th,
.style-dark .style-light table.shop_attributes th,
.style-light td.product-name a,
.style-dark .style-light td.product-name a,
.style-light p .thank-you,
.style-dark .style-light p .thank-you,
.style-light .form-row label,
.style-dark .style-light .form-row label,
.style-light .row-message,
.style-dark .style-light .row-message,
.style-light .order-details tfoot tr:last-child,
.style-dark .style-light .order-details tfoot tr:last-child,
.style-light #order_review tfoot tr:last-child,
.style-dark .style-light #order_review tfoot tr:last-child,
.style-light table.variations label,
.style-dark .style-light table.variations label {
  color: <?php echo esc_html($color_heading); ?>;
}
/* #Button-style */
.buttons-style,
input[type="submit"],
input[type="reset"],
input[type="button"],
button[type="submit"],
.btn,
.btn-link,
.nav-tabs,
.panel-title > a span,
.search_footer,
.wc-forward,
.wc-forward a {
  font-weight: <?php echo esc_html($btn_font_weight); ?> !important;
  font-family: <?php echo esc_html($font_family_btn); ?> !important;
  letter-spacing: 0.1em;
  text-transform: <?php echo esc_html($btn_text_transform); ?>;
}
/* #Button-weight */
.buttons-weight,
.woocommerce span.onsale,
.woocommerce span.soldout,
.woocommerce .quantity .plus,
.woocommerce #content .quantity .plus,
.woocommerce .quantity .minus,
.woocommerce #content .quantity .minus,
.woocommerce table.cart a.remove,
.woocommerce #content table.cart a.remove,
.uncode-cart .btn {
  font-weight: <?php echo esc_html($btn_font_weight); ?> !important;
}
/* #Font-Serif */
.serif-family,
.post-content .post-media blockquote.pullquote p:first-child,
.tmb-entry-title-serif.tmb .t-entry .t-entry-title,
.isotope-system .isotope-container .tmb .regular-text .pullquote p:first-child,
.isotope-system .isotope-container .tmb .fluid-object.tweet .twitter-footer span {
  font-family: Georgia, "Times New Roman", Times, serif;
}
/* #UI-border-width */
.ui-br-w,
input:focus,
textarea:focus,
select:focus,
input[type="submit"],
input[type="reset"],
input[type="button"],
button[type="submit"],
.select2-container .select2-choice {
  border-width: 1px;
}
/* #UI-border-color */
.style-dark .ui-br,
.style-dark.style-override .ui-br,
.style-light .style-dark .ui-br,
.style-dark hr,
.style-dark.style-override hr,
.style-light .style-dark hr,
.style-dark pre,
.style-dark.style-override pre,
.style-light .style-dark pre,
.style-dark table,
.style-dark.style-override table,
.style-light .style-dark table,
.style-dark table td,
.style-dark.style-override table td,
.style-light .style-dark table td,
.style-dark table th,
.style-dark.style-override table th,
.style-light .style-dark table th,
.style-dark input,
.style-dark.style-override input,
.style-light .style-dark input,
.style-dark textarea,
.style-dark.style-override textarea,
.style-light .style-dark textarea,
.style-dark select,
.style-dark.style-override select,
.style-light .style-dark select,
.style-dark .seldiv,
.style-dark.style-override .seldiv,
.style-light .style-dark .seldiv,
.style-dark .select2-choice,
.style-dark.style-override .select2-choice,
.style-light .style-dark .select2-choice,
.style-dark .seldiv:before,
.style-dark.style-override .seldiv:before,
.style-light .style-dark .seldiv:before,
.style-dark .nav-tabs,
.style-dark.style-override .nav-tabs,
.style-light .style-dark .nav-tabs,
.style-dark .nav-tabs > li.active > a,
.style-dark.style-override .nav-tabs > li.active > a,
.style-light .style-dark .nav-tabs > li.active > a,
.style-dark .vertical-tab-menu .nav-tabs,
.style-dark.style-override .vertical-tab-menu .nav-tabs,
.style-light .style-dark .vertical-tab-menu .nav-tabs,
.style-dark .tab-content.vertical,
.style-dark.style-override .tab-content.vertical,
.style-light .style-dark .tab-content.vertical,
.style-dark .panel,
.style-dark.style-override .panel,
.style-light .style-dark .panel,
.style-dark .panel-group .panel-heading + .panel-collapse .panel-body,
.style-dark.style-override .panel-group .panel-heading + .panel-collapse .panel-body,
.style-light .style-dark .panel-group .panel-heading + .panel-collapse .panel-body,
.style-dark .divider:before,
.style-dark.style-override .divider:before,
.style-light .style-dark .divider:before,
.style-dark .divider:after,
.style-dark.style-override .divider:after,
.style-light .style-dark .divider:after,
.style-dark .plan,
.style-dark.style-override .plan,
.style-light .style-dark .plan,
.style-dark .plan .plan-title,
.style-dark.style-override .plan .plan-title,
.style-light .style-dark .plan .plan-title,
.style-dark .plan .item-list > li,
.style-dark.style-override .plan .item-list > li,
.style-light .style-dark .plan .item-list > li,
.style-dark .plan .plan-button,
.style-dark.style-override .plan .plan-button,
.style-light .style-dark .plan .plan-button,
.style-dark .uncode-single-media-wrapper.img-thumbnail:not(.single-advanced),
.style-dark.style-override .uncode-single-media-wrapper.img-thumbnail:not(.single-advanced),
.style-light .style-dark .uncode-single-media-wrapper.img-thumbnail:not(.single-advanced),
.style-dark .post-share,
.style-dark.style-override .post-share,
.style-light .style-dark .post-share,
.style-dark .widget-container .widget-title,
.style-dark.style-override .widget-container .widget-title,
.style-light .style-dark .widget-container .widget-title,
.style-dark .widget-container .tagcloud a,
.style-dark.style-override .widget-container .tagcloud a,
.style-light .style-dark .widget-container .tagcloud a,
.style-dark #comments .comment-list .comments-list:first-child,
.style-dark.style-override #comments .comment-list .comments-list:first-child,
.style-light .style-dark #comments .comment-list .comments-list:first-child,
.style-dark #respond .comment-list .comments-list:first-child,
.style-dark.style-override #respond .comment-list .comments-list:first-child,
.style-light .style-dark #respond .comment-list .comments-list:first-child,
.style-dark #comments .comments-list .comment-content,
.style-dark.style-override #comments .comments-list .comment-content,
.style-light .style-dark #comments .comments-list .comment-content,
.style-dark #respond .comments-list .comment-content,
.style-dark.style-override #respond .comments-list .comment-content,
.style-light .style-dark #respond .comments-list .comment-content,
.style-dark .author-details,
.style-dark.style-override .author-details,
.style-light .style-dark .author-details,
.style-dark ul.dwls_search_results,
.style-dark.style-override ul.dwls_search_results,
.style-light .style-dark ul.dwls_search_results,
.style-dark ul.dwls_search_results li,
.style-dark.style-override ul.dwls_search_results li,
.style-light .style-dark ul.dwls_search_results li,
.style-dark .woocommerce .woocommerce-breadcrumb,
.style-dark.style-override .woocommerce .woocommerce-breadcrumb,
.style-light .style-dark .woocommerce .woocommerce-breadcrumb,
.style-dark .woocommerce nav.woocommerce-pagination,
.style-dark.style-override .woocommerce nav.woocommerce-pagination,
.style-light .style-dark .woocommerce nav.woocommerce-pagination,
.style-dark .woocommerce #content nav.woocommerce-pagination,
.style-dark.style-override .woocommerce #content nav.woocommerce-pagination,
.style-light .style-dark .woocommerce #content nav.woocommerce-pagination,
.style-dark .woocommerce nav.woocommerce-pagination ul li span.current,
.style-dark.style-override .woocommerce nav.woocommerce-pagination ul li span.current,
.style-light .style-dark .woocommerce nav.woocommerce-pagination ul li span.current,
.style-dark .woocommerce #content nav.woocommerce-pagination ul li span.current,
.style-dark.style-override .woocommerce #content nav.woocommerce-pagination ul li span.current,
.style-light .style-dark .woocommerce #content nav.woocommerce-pagination ul li span.current,
.style-dark .woocommerce nav.woocommerce-pagination ul li a:hover,
.style-dark.style-override .woocommerce nav.woocommerce-pagination ul li a:hover,
.style-light .style-dark .woocommerce nav.woocommerce-pagination ul li a:hover,
.style-dark .woocommerce #content nav.woocommerce-pagination ul li a:hover,
.style-dark.style-override .woocommerce #content nav.woocommerce-pagination ul li a:hover,
.style-light .style-dark .woocommerce #content nav.woocommerce-pagination ul li a:hover,
.style-dark .woocommerce nav.woocommerce-pagination ul li a:focus,
.style-dark.style-override .woocommerce nav.woocommerce-pagination ul li a:focus,
.style-light .style-dark .woocommerce nav.woocommerce-pagination ul li a:focus,
.style-dark .woocommerce #content nav.woocommerce-pagination ul li a:focus,
.style-dark.style-override .woocommerce #content nav.woocommerce-pagination ul li a:focus,
.style-light .style-dark .woocommerce #content nav.woocommerce-pagination ul li a:focus,
.style-dark .woocommerce #reviews #review_form_wrapper,
.style-dark.style-override .woocommerce #reviews #review_form_wrapper,
.style-light .style-dark .woocommerce #reviews #review_form_wrapper,
.style-dark .woocommerce ul.cart_list li,
.style-dark.style-override .woocommerce ul.cart_list li,
.style-light .style-dark .woocommerce ul.cart_list li,
.style-dark .woocommerce ul.product_list_widget li,
.style-dark.style-override .woocommerce ul.product_list_widget li,
.style-light .style-dark .woocommerce ul.product_list_widget li,
.style-dark .woocommerce.widget_shopping_cart .total,
.style-dark.style-override .woocommerce.widget_shopping_cart .total,
.style-light .style-dark .woocommerce.widget_shopping_cart .total,
.style-dark .woocommerce .widget_shopping_cart .total,
.style-dark.style-override .woocommerce .widget_shopping_cart .total,
.style-light .style-dark .woocommerce .widget_shopping_cart .total,
.style-dark .woocommerce.widget_shopping_cart .buttons,
.style-dark.style-override .woocommerce.widget_shopping_cart .buttons,
.style-light .style-dark .woocommerce.widget_shopping_cart .buttons,
.style-dark .woocommerce .widget_shopping_cart .buttons,
.style-dark.style-override .woocommerce .widget_shopping_cart .buttons,
.style-light .style-dark .woocommerce .widget_shopping_cart .buttons,
.style-dark .woocommerce .cart-collaterals .cart_totals tr td,
.style-dark.style-override .woocommerce .cart-collaterals .cart_totals tr td,
.style-light .style-dark .woocommerce .cart-collaterals .cart_totals tr td,
.style-dark .woocommerce .cart-collaterals .cart_totals tr th,
.style-dark.style-override .woocommerce .cart-collaterals .cart_totals tr th,
.style-light .style-dark .woocommerce .cart-collaterals .cart_totals tr th,
.style-dark .woocommerce form.login,
.style-dark.style-override .woocommerce form.login,
.style-light .style-dark .woocommerce form.login,
.style-dark .woocommerce form.checkout_coupon,
.style-dark.style-override .woocommerce form.checkout_coupon,
.style-light .style-dark .woocommerce form.checkout_coupon,
.style-dark .woocommerce form.register,
.style-dark.style-override .woocommerce form.register,
.style-light .style-dark .woocommerce form.register,
.style-dark .woocommerce #payment,
.style-dark.style-override .woocommerce #payment,
.style-light .style-dark .woocommerce #payment,
.style-dark .woocommerce #payment ul.payment_methods,
.style-dark.style-override .woocommerce #payment ul.payment_methods,
.style-light .style-dark .woocommerce #payment ul.payment_methods,
.style-dark .woocommerce .order_details li,
.style-dark.style-override .woocommerce .order_details li,
.style-light .style-dark .woocommerce .order_details li,
.style-dark .woocommerce .woocommerce-MyAccount-navigation li,
.style-dark.style-override .woocommerce .woocommerce-MyAccount-navigation li,
.style-light .style-dark .woocommerce .woocommerce-MyAccount-navigation li,
.style-dark .woocommerce .addresses,
.style-dark.style-override .woocommerce .addresses,
.style-light .style-dark .woocommerce .addresses,
.style-dark .wootabs .tab-content,
.style-dark.style-override .wootabs .tab-content,
.style-light .style-dark .wootabs .tab-content,
.style-dark .myaccount-cont,
.style-dark.style-override .myaccount-cont,
.style-light .style-dark .myaccount-cont,
.style-dark .price_slider_wrapper .ui-widget-content,
.style-dark.style-override .price_slider_wrapper .ui-widget-content,
.style-light .style-dark .price_slider_wrapper .ui-widget-content,
.style-dark .widget_price_filter .ui-slider .ui-slider-handle,
.style-dark.style-override .widget_price_filter .ui-slider .ui-slider-handle,
.style-light .style-dark .widget_price_filter .ui-slider .ui-slider-handle,
.style-dark .row-related,
.style-dark.style-override .row-related,
.style-light .style-dark .row-related,
.style-dark form.woocommerce-shipping-calculator button,
.style-dark.style-override form.woocommerce-shipping-calculator button,
.style-light .style-dark form.woocommerce-shipping-calculator button,
.style-dark form.cart button,
.style-dark.style-override form.cart button,
.style-light .style-dark form.cart button {
  border-color: rgba(255, 255, 255, 0.25);
}
.style-light .ui-br,
.style-light.style-override .ui-br,
.style-dark .style-light .ui-br,
.style-light hr,
.style-light.style-override hr,
.style-dark .style-light hr,
.style-light pre,
.style-light.style-override pre,
.style-dark .style-light pre,
.style-light table,
.style-light.style-override table,
.style-dark .style-light table,
.style-light table td,
.style-light.style-override table td,
.style-dark .style-light table td,
.style-light table th,
.style-light.style-override table th,
.style-dark .style-light table th,
.style-light input,
.style-light.style-override input,
.style-dark .style-light input,
.style-light textarea,
.style-light.style-override textarea,
.style-dark .style-light textarea,
.style-light select,
.style-light.style-override select,
.style-dark .style-light select,
.style-light .seldiv,
.style-light.style-override .seldiv,
.style-dark .style-light .seldiv,
.style-light .select2-choice,
.style-light.style-override .select2-choice,
.style-dark .style-light .select2-choice,
.style-light .seldiv:before,
.style-light.style-override .seldiv:before,
.style-dark .style-light .seldiv:before,
.style-light .nav-tabs,
.style-light.style-override .nav-tabs,
.style-dark .style-light .nav-tabs,
.style-light .nav-tabs > li.active > a,
.style-light.style-override .nav-tabs > li.active > a,
.style-dark .style-light .nav-tabs > li.active > a,
.style-light .vertical-tab-menu .nav-tabs,
.style-light.style-override .vertical-tab-menu .nav-tabs,
.style-dark .style-light .vertical-tab-menu .nav-tabs,
.style-light .tab-content.vertical,
.style-light.style-override .tab-content.vertical,
.style-dark .style-light .tab-content.vertical,
.style-light .panel,
.style-light.style-override .panel,
.style-dark .style-light .panel,
.style-light .panel-group .panel-heading + .panel-collapse .panel-body,
.style-light.style-override .panel-group .panel-heading + .panel-collapse .panel-body,
.style-dark .style-light .panel-group .panel-heading + .panel-collapse .panel-body,
.style-light .divider:before,
.style-light.style-override .divider:before,
.style-dark .style-light .divider:before,
.style-light .divider:after,
.style-light.style-override .divider:after,
.style-dark .style-light .divider:after,
.style-light .plan,
.style-light.style-override .plan,
.style-dark .style-light .plan,
.style-light .plan .plan-title,
.style-light.style-override .plan .plan-title,
.style-dark .style-light .plan .plan-title,
.style-light .plan .item-list > li,
.style-light.style-override .plan .item-list > li,
.style-dark .style-light .plan .item-list > li,
.style-light .plan .plan-button,
.style-light.style-override .plan .plan-button,
.style-dark .style-light .plan .plan-button,
.style-light .uncode-single-media-wrapper.img-thumbnail:not(.single-advanced),
.style-light.style-override .uncode-single-media-wrapper.img-thumbnail:not(.single-advanced),
.style-dark .style-light .uncode-single-media-wrapper.img-thumbnail:not(.single-advanced),
.style-light .post-share,
.style-light.style-override .post-share,
.style-dark .style-light .post-share,
.style-light .widget-container .widget-title,
.style-light.style-override .widget-container .widget-title,
.style-dark .style-light .widget-container .widget-title,
.style-light .widget-container .tagcloud a,
.style-light.style-override .widget-container .tagcloud a,
.style-dark .style-light .widget-container .tagcloud a,
.style-light #comments .comment-list .comments-list:first-child,
.style-light.style-override #comments .comment-list .comments-list:first-child,
.style-dark .style-light #comments .comment-list .comments-list:first-child,
.style-light #respond .comment-list .comments-list:first-child,
.style-light.style-override #respond .comment-list .comments-list:first-child,
.style-dark .style-light #respond .comment-list .comments-list:first-child,
.style-light #comments .comments-list .comment-content,
.style-light.style-override #comments .comments-list .comment-content,
.style-dark .style-light #comments .comments-list .comment-content,
.style-light #respond .comments-list .comment-content,
.style-light.style-override #respond .comments-list .comment-content,
.style-dark .style-light #respond .comments-list .comment-content,
.style-light .author-details,
.style-light.style-override .author-details,
.style-dark .style-light .author-details,
.style-light ul.dwls_search_results,
.style-light.style-override ul.dwls_search_results,
.style-dark .style-light ul.dwls_search_results,
.style-light ul.dwls_search_results li,
.style-light.style-override ul.dwls_search_results li,
.style-dark .style-light ul.dwls_search_results li,
.style-light .woocommerce .woocommerce-breadcrumb,
.style-light.style-override .woocommerce .woocommerce-breadcrumb,
.style-dark .style-light .woocommerce .woocommerce-breadcrumb,
.style-light .woocommerce nav.woocommerce-pagination,
.style-light.style-override .woocommerce nav.woocommerce-pagination,
.style-dark .style-light .woocommerce nav.woocommerce-pagination,
.style-light .woocommerce #content nav.woocommerce-pagination,
.style-light.style-override .woocommerce #content nav.woocommerce-pagination,
.style-dark .style-light .woocommerce #content nav.woocommerce-pagination,
.style-light .woocommerce nav.woocommerce-pagination ul li span.current,
.style-light.style-override .woocommerce nav.woocommerce-pagination ul li span.current,
.style-dark .style-light .woocommerce nav.woocommerce-pagination ul li span.current,
.style-light .woocommerce #content nav.woocommerce-pagination ul li span.current,
.style-light.style-override .woocommerce #content nav.woocommerce-pagination ul li span.current,
.style-dark .style-light .woocommerce #content nav.woocommerce-pagination ul li span.current,
.style-light .woocommerce nav.woocommerce-pagination ul li a:hover,
.style-light.style-override .woocommerce nav.woocommerce-pagination ul li a:hover,
.style-dark .style-light .woocommerce nav.woocommerce-pagination ul li a:hover,
.style-light .woocommerce #content nav.woocommerce-pagination ul li a:hover,
.style-light.style-override .woocommerce #content nav.woocommerce-pagination ul li a:hover,
.style-dark .style-light .woocommerce #content nav.woocommerce-pagination ul li a:hover,
.style-light .woocommerce nav.woocommerce-pagination ul li a:focus,
.style-light.style-override .woocommerce nav.woocommerce-pagination ul li a:focus,
.style-dark .style-light .woocommerce nav.woocommerce-pagination ul li a:focus,
.style-light .woocommerce #content nav.woocommerce-pagination ul li a:focus,
.style-light.style-override .woocommerce #content nav.woocommerce-pagination ul li a:focus,
.style-dark .style-light .woocommerce #content nav.woocommerce-pagination ul li a:focus,
.style-light .woocommerce #reviews #review_form_wrapper,
.style-light.style-override .woocommerce #reviews #review_form_wrapper,
.style-dark .style-light .woocommerce #reviews #review_form_wrapper,
.style-light .woocommerce ul.cart_list li,
.style-light.style-override .woocommerce ul.cart_list li,
.style-dark .style-light .woocommerce ul.cart_list li,
.style-light .woocommerce ul.product_list_widget li,
.style-light.style-override .woocommerce ul.product_list_widget li,
.style-dark .style-light .woocommerce ul.product_list_widget li,
.style-light .woocommerce.widget_shopping_cart .total,
.style-light.style-override .woocommerce.widget_shopping_cart .total,
.style-dark .style-light .woocommerce.widget_shopping_cart .total,
.style-light .woocommerce .widget_shopping_cart .total,
.style-light.style-override .woocommerce .widget_shopping_cart .total,
.style-dark .style-light .woocommerce .widget_shopping_cart .total,
.style-light .woocommerce.widget_shopping_cart .buttons,
.style-light.style-override .woocommerce.widget_shopping_cart .buttons,
.style-dark .style-light .woocommerce.widget_shopping_cart .buttons,
.style-light .woocommerce .widget_shopping_cart .buttons,
.style-light.style-override .woocommerce .widget_shopping_cart .buttons,
.style-dark .style-light .woocommerce .widget_shopping_cart .buttons,
.style-light .woocommerce .cart-collaterals .cart_totals tr td,
.style-light.style-override .woocommerce .cart-collaterals .cart_totals tr td,
.style-dark .style-light .woocommerce .cart-collaterals .cart_totals tr td,
.style-light .woocommerce .cart-collaterals .cart_totals tr th,
.style-light.style-override .woocommerce .cart-collaterals .cart_totals tr th,
.style-dark .style-light .woocommerce .cart-collaterals .cart_totals tr th,
.style-light .woocommerce form.login,
.style-light.style-override .woocommerce form.login,
.style-dark .style-light .woocommerce form.login,
.style-light .woocommerce form.checkout_coupon,
.style-light.style-override .woocommerce form.checkout_coupon,
.style-dark .style-light .woocommerce form.checkout_coupon,
.style-light .woocommerce form.register,
.style-light.style-override .woocommerce form.register,
.style-dark .style-light .woocommerce form.register,
.style-light .woocommerce #payment,
.style-light.style-override .woocommerce #payment,
.style-dark .style-light .woocommerce #payment,
.style-light .woocommerce #payment ul.payment_methods,
.style-light.style-override .woocommerce #payment ul.payment_methods,
.style-dark .style-light .woocommerce #payment ul.payment_methods,
.style-light .woocommerce .order_details li,
.style-light.style-override .woocommerce .order_details li,
.style-dark .style-light .woocommerce .order_details li,
.style-light .woocommerce .woocommerce-MyAccount-navigation li,
.style-light.style-override .woocommerce .woocommerce-MyAccount-navigation li,
.style-dark .style-light .woocommerce .woocommerce-MyAccount-navigation li,
.style-light .woocommerce .addresses,
.style-light.style-override .woocommerce .addresses,
.style-dark .style-light .woocommerce .addresses,
.style-light .wootabs .tab-content,
.style-light.style-override .wootabs .tab-content,
.style-dark .style-light .wootabs .tab-content,
.style-light .myaccount-cont,
.style-light.style-override .myaccount-cont,
.style-dark .style-light .myaccount-cont,
.style-light .price_slider_wrapper .ui-widget-content,
.style-light.style-override .price_slider_wrapper .ui-widget-content,
.style-dark .style-light .price_slider_wrapper .ui-widget-content,
.style-light .widget_price_filter .ui-slider .ui-slider-handle,
.style-light.style-override .widget_price_filter .ui-slider .ui-slider-handle,
.style-dark .style-light .widget_price_filter .ui-slider .ui-slider-handle,
.style-light .row-related,
.style-light.style-override .row-related,
.style-dark .style-light .row-related,
.style-light form.woocommerce-shipping-calculator button,
.style-light.style-override form.woocommerce-shipping-calculator button,
.style-dark .style-light form.woocommerce-shipping-calculator button,
.style-light form.cart button,
.style-light.style-override form.cart button,
.style-dark .style-light form.cart button {
  border-color: #eaeaea;
}
/* #UI-border-color-accent */
.ui-br-accent,
.nav-tabs > li.active > a,
.tabs-left > li.active > a {
  border-color: <?php echo esc_html($color_primary); ?> !important;
}
/* break */
.style-dark .ui-br-break,
.style-dark.style-override .ui-br-break,
.style-light .style-dark .ui-br-break,
.style-dark hr.separator-break,
.style-dark.style-override hr.separator-break,
.style-light .style-dark hr.separator-break {
  border-color: #fff;
}
.style-light .ui-br-break,
.style-light.style-override .ui-br-break,
.style-dark .style-light .ui-br-break,
.style-light hr.separator-break,
.style-light.style-override hr.separator-break,
.style-dark .style-light hr.separator-break {
  border-color: #eaeaea;
}
/* #UI-border-headings-color */
.style-dark .ui-br-headings,
.style-dark.style-override .ui-br-headings,
.style-light .style-dark .ui-br-headings,
.style-dark .header-content hr,
.style-dark.style-override .header-content hr,
.style-light .style-dark .header-content hr {
  border-color: #fff;
}
.style-light .ui-br-headings,
.style-light.style-override .ui-br-headings,
.style-dark .style-light .ui-br-headings,
.style-light .header-content hr,
.style-light.style-override .header-content hr,
.style-dark .style-light .header-content hr {
  border-color: <?php echo esc_html($color_heading); ?>;
}
/* #UI-background-color */
.style-dark .ui-bg,
.style-dark.style-override .ui-bg,
.style-light .style-dark .ui-bg,
.style-dark code,
.style-dark.style-override code,
.style-light .style-dark code,
.style-dark kbd,
.style-dark.style-override kbd,
.style-light .style-dark kbd,
.style-dark pre,
.style-dark.style-override pre,
.style-light .style-dark pre,
.style-dark samp,
.style-dark.style-override samp,
.style-light .style-dark samp,
.style-dark input[type="submit"],
.style-dark.style-override input[type="submit"],
.style-light .style-dark input[type="submit"],
.style-dark input[type="reset"],
.style-dark.style-override input[type="reset"],
.style-light .style-dark input[type="reset"],
.style-dark input[type="button"],
.style-dark.style-override input[type="button"],
.style-light .style-dark input[type="button"],
.style-dark button[type="submit"],
.style-dark.style-override button[type="submit"],
.style-light .style-dark button[type="submit"],
.style-dark .divider .divider-icon,
.style-dark.style-override .divider .divider-icon,
.style-light .style-dark .divider .divider-icon,
.style-dark .woocommerce nav.woocommerce-pagination ul li span.current,
.style-dark.style-override .woocommerce nav.woocommerce-pagination ul li span.current,
.style-light .style-dark .woocommerce nav.woocommerce-pagination ul li span.current,
.style-dark .woocommerce #content nav.woocommerce-pagination ul li span.current,
.style-dark.style-override .woocommerce #content nav.woocommerce-pagination ul li span.current,
.style-light .style-dark .woocommerce #content nav.woocommerce-pagination ul li span.current,
.style-dark .woocommerce nav.woocommerce-pagination ul li a:hover,
.style-dark.style-override .woocommerce nav.woocommerce-pagination ul li a:hover,
.style-light .style-dark .woocommerce nav.woocommerce-pagination ul li a:hover,
.style-dark .woocommerce #content nav.woocommerce-pagination ul li a:hover,
.style-dark.style-override .woocommerce #content nav.woocommerce-pagination ul li a:hover,
.style-light .style-dark .woocommerce #content nav.woocommerce-pagination ul li a:hover,
.style-dark .woocommerce nav.woocommerce-pagination ul li a:focus,
.style-dark.style-override .woocommerce nav.woocommerce-pagination ul li a:focus,
.style-light .style-dark .woocommerce nav.woocommerce-pagination ul li a:focus,
.style-dark .woocommerce #content nav.woocommerce-pagination ul li a:focus,
.style-dark.style-override .woocommerce #content nav.woocommerce-pagination ul li a:focus,
.style-light .style-dark .woocommerce #content nav.woocommerce-pagination ul li a:focus,
.style-dark .woocommerce .quantity .plus,
.style-dark.style-override .woocommerce .quantity .plus,
.style-light .style-dark .woocommerce .quantity .plus,
.style-dark .woocommerce #content .quantity .plus,
.style-dark.style-override .woocommerce #content .quantity .plus,
.style-light .style-dark .woocommerce #content .quantity .plus,
.style-dark .woocommerce .quantity .minus,
.style-dark.style-override .woocommerce .quantity .minus,
.style-light .style-dark .woocommerce .quantity .minus,
.style-dark .woocommerce #content .quantity .minus,
.style-dark.style-override .woocommerce #content .quantity .minus,
.style-light .style-dark .woocommerce #content .quantity .minus,
.style-dark .woocommerce #payment .place-order,
.style-dark.style-override .woocommerce #payment .place-order,
.style-light .style-dark .woocommerce #payment .place-order,
.style-dark .price_slider_wrapper .ui-widget-content,
.style-dark.style-override .price_slider_wrapper .ui-widget-content,
.style-light .style-dark .price_slider_wrapper .ui-widget-content,
.style-dark .widget_price_filter .ui-slider .ui-slider-handle,
.style-dark.style-override .widget_price_filter .ui-slider .ui-slider-handle,
.style-light .style-dark .widget_price_filter .ui-slider .ui-slider-handle {
  background-color: #191b1e;
}
.style-light .ui-bg,
.style-light.style-override .ui-bg,
.style-dark .style-light .ui-bg,
.style-light code,
.style-light.style-override code,
.style-dark .style-light code,
.style-light kbd,
.style-light.style-override kbd,
.style-dark .style-light kbd,
.style-light pre,
.style-light.style-override pre,
.style-dark .style-light pre,
.style-light samp,
.style-light.style-override samp,
.style-dark .style-light samp,
.style-light input[type="submit"],
.style-light.style-override input[type="submit"],
.style-dark .style-light input[type="submit"],
.style-light input[type="reset"],
.style-light.style-override input[type="reset"],
.style-dark .style-light input[type="reset"],
.style-light input[type="button"],
.style-light.style-override input[type="button"],
.style-dark .style-light input[type="button"],
.style-light button[type="submit"],
.style-light.style-override button[type="submit"],
.style-dark .style-light button[type="submit"],
.style-light .divider .divider-icon,
.style-light.style-override .divider .divider-icon,
.style-dark .style-light .divider .divider-icon,
.style-light .woocommerce nav.woocommerce-pagination ul li span.current,
.style-light.style-override .woocommerce nav.woocommerce-pagination ul li span.current,
.style-dark .style-light .woocommerce nav.woocommerce-pagination ul li span.current,
.style-light .woocommerce #content nav.woocommerce-pagination ul li span.current,
.style-light.style-override .woocommerce #content nav.woocommerce-pagination ul li span.current,
.style-dark .style-light .woocommerce #content nav.woocommerce-pagination ul li span.current,
.style-light .woocommerce nav.woocommerce-pagination ul li a:hover,
.style-light.style-override .woocommerce nav.woocommerce-pagination ul li a:hover,
.style-dark .style-light .woocommerce nav.woocommerce-pagination ul li a:hover,
.style-light .woocommerce #content nav.woocommerce-pagination ul li a:hover,
.style-light.style-override .woocommerce #content nav.woocommerce-pagination ul li a:hover,
.style-dark .style-light .woocommerce #content nav.woocommerce-pagination ul li a:hover,
.style-light .woocommerce nav.woocommerce-pagination ul li a:focus,
.style-light.style-override .woocommerce nav.woocommerce-pagination ul li a:focus,
.style-dark .style-light .woocommerce nav.woocommerce-pagination ul li a:focus,
.style-light .woocommerce #content nav.woocommerce-pagination ul li a:focus,
.style-light.style-override .woocommerce #content nav.woocommerce-pagination ul li a:focus,
.style-dark .style-light .woocommerce #content nav.woocommerce-pagination ul li a:focus,
.style-light .woocommerce .quantity .plus,
.style-light.style-override .woocommerce .quantity .plus,
.style-dark .style-light .woocommerce .quantity .plus,
.style-light .woocommerce #content .quantity .plus,
.style-light.style-override .woocommerce #content .quantity .plus,
.style-dark .style-light .woocommerce #content .quantity .plus,
.style-light .woocommerce .quantity .minus,
.style-light.style-override .woocommerce .quantity .minus,
.style-dark .style-light .woocommerce .quantity .minus,
.style-light .woocommerce #content .quantity .minus,
.style-light.style-override .woocommerce #content .quantity .minus,
.style-dark .style-light .woocommerce #content .quantity .minus,
.style-light .woocommerce #payment .place-order,
.style-light.style-override .woocommerce #payment .place-order,
.style-dark .style-light .woocommerce #payment .place-order,
.style-light .price_slider_wrapper .ui-widget-content,
.style-light.style-override .price_slider_wrapper .ui-widget-content,
.style-dark .style-light .price_slider_wrapper .ui-widget-content,
.style-light .widget_price_filter .ui-slider .ui-slider-handle,
.style-light.style-override .widget_price_filter .ui-slider .ui-slider-handle,
.style-dark .style-light .widget_price_filter .ui-slider .ui-slider-handle {
  background-color: #f7f7f7;
}
/* #UI-background-color-alpha */
.style-dark .ui-bg-alpha,
.style-dark.style-override .ui-bg-alpha,
.style-light .style-dark .ui-bg-alpha,
.style-dark input,
.style-dark.style-override input,
.style-light .style-dark input,
.style-dark textarea,
.style-dark.style-override textarea,
.style-light .style-dark textarea,
.style-dark select,
.style-dark.style-override select,
.style-light .style-dark select,
.style-dark .seldiv,
.style-dark.style-override .seldiv,
.style-light .style-dark .seldiv,
.style-dark .select2-choice,
.style-dark.style-override .select2-choice,
.style-light .style-dark .select2-choice,
.style-dark .plan,
.style-dark.style-override .plan,
.style-light .style-dark .plan {
  background-color: rgba(26, 27, 28, 0.5);
}
.style-light .ui-bg-alpha,
.style-light.style-override .ui-bg-alpha,
.style-dark .style-light .ui-bg-alpha,
.style-light input,
.style-light.style-override input,
.style-dark .style-light input,
.style-light textarea,
.style-light.style-override textarea,
.style-dark .style-light textarea,
.style-light select,
.style-light.style-override select,
.style-dark .style-light select,
.style-light .seldiv,
.style-light.style-override .seldiv,
.style-dark .style-light .seldiv,
.style-light .select2-choice,
.style-light.style-override .select2-choice,
.style-dark .style-light .select2-choice,
.style-light .plan,
.style-light.style-override .plan,
.style-dark .style-light .plan {
  background-color: #ffffff;
}
.style-dark .ui-bg-alpha-pricing-tables,
.style-dark.style-override .ui-bg-alpha-pricing-tables,
.style-light .style-dark .ui-bg-alpha-pricing-tables {
  background-color: rgba(20, 22, 24, 0.5);
}
.style-light .ui-bg-alpha-pricing-tables,
.style-light.style-override .ui-bg-alpha-pricing-tables,
.style-dark .style-light .ui-bg-alpha-pricing-tables {
  background-color: #ffffff;
}
.style-dark .ui-bg-alpha-progress-bar,
.style-dark.style-override .ui-bg-alpha-progress-bar,
.style-light .style-dark .ui-bg-alpha-progress-bar,
.style-dark .vc_progress_bar .vc_single_bar:not(.style-override),
.style-dark.style-override .vc_progress_bar .vc_single_bar:not(.style-override),
.style-light .style-dark .vc_progress_bar .vc_single_bar:not(.style-override) {
  background-color: rgba(255, 255, 255, 0.2);
}
.style-light .ui-bg-alpha-progress-bar,
.style-light.style-override .ui-bg-alpha-progress-bar,
.style-dark .style-light .ui-bg-alpha-progress-bar,
.style-light .vc_progress_bar .vc_single_bar:not(.style-override),
.style-light.style-override .vc_progress_bar .vc_single_bar:not(.style-override),
.style-dark .style-light .vc_progress_bar .vc_single_bar:not(.style-override) {
  background-color: rgba(119, 119, 119, 0.1);
}
.style-dark .ui-text-alpha-progress-bar,
.style-dark.style-override .ui-text-alpha-progress-bar,
.style-light .style-dark .ui-text-alpha-progress-bar,
.style-dark .vc_pie_chart_back,
.style-dark.style-override .vc_pie_chart_back,
.style-light .style-dark .vc_pie_chart_back {
  color: rgba(255, 255, 255, 0.2);
}
.style-light .ui-text-alpha-progress-bar,
.style-light.style-override .ui-text-alpha-progress-bar,
.style-dark .style-light .ui-text-alpha-progress-bar,
.style-light .vc_pie_chart_back,
.style-light.style-override .vc_pie_chart_back,
.style-dark .style-light .vc_pie_chart_back {
  color: rgba(119, 119, 119, 0.1);
}
.style-dark .ui-bg-dots,
.style-dark.style-override .ui-bg-dots,
.style-light .style-dark .ui-bg-dots,
.style-dark .owl-dots-outside .owl-dots .owl-dot span,
.style-dark.style-override .owl-dots-outside .owl-dots .owl-dot span,
.style-light .style-dark .owl-dots-outside .owl-dots .owl-dot span {
  background-color: rgba(247, 247, 247, 0.75);
}
.style-light .ui-bg-dots,
.style-light.style-override .ui-bg-dots,
.style-dark .style-light .ui-bg-dots,
.style-light .owl-dots-outside .owl-dots .owl-dot span,
.style-light.style-override .owl-dots-outside .owl-dots .owl-dot span,
.style-dark .style-light .owl-dots-outside .owl-dots .owl-dot span {
  background-color: rgba(25, 27, 30, 0.25);
}
/* #UI-background-color */
/* #UI-background-color-active */
/* #UI-link-color */
.style-dark .ui-link,
.style-dark.style-override .ui-link,
.style-light .style-dark .ui-link,
.style-dark .nav-tabs > li > a,
.style-dark.style-override .nav-tabs > li > a,
.style-light .style-dark .nav-tabs > li > a,
.style-dark .panel-title > a,
.style-dark.style-override .panel-title > a,
.style-light .style-dark .panel-title > a,
.style-dark .widget-container a,
.style-dark.style-override .widget-container a,
.style-light .style-dark .widget-container a,
.style-dark .woocommerce .woocommerce-breadcrumb a,
.style-dark.style-override .woocommerce .woocommerce-breadcrumb a,
.style-light .style-dark .woocommerce .woocommerce-breadcrumb a,
.style-dark .woocommerce .woocommerce-review-link,
.style-dark.style-override .woocommerce .woocommerce-review-link,
.style-light .style-dark .woocommerce .woocommerce-review-link {
  color: #fff;
}
.style-dark .ui-link:hover,
.style-dark.style-override .ui-link:hover,
.style-light .style-dark .ui-link:hover,
.style-dark .ui-link:focus,
.style-dark.style-override .ui-link:focus,
.style-light .style-dark .ui-link:focus,
.style-dark .nav-tabs > li > a:hover,
.style-dark.style-override .nav-tabs > li > a:hover,
.style-light .style-dark .nav-tabs > li > a:hover,
.style-dark .nav-tabs > li > a:focus,
.style-dark.style-override .nav-tabs > li > a:focus,
.style-light .style-dark .nav-tabs > li > a:focus,
.style-dark .panel-title > a:hover,
.style-dark.style-override .panel-title > a:hover,
.style-light .style-dark .panel-title > a:hover,
.style-dark .panel-title > a:focus,
.style-dark.style-override .panel-title > a:focus,
.style-light .style-dark .panel-title > a:focus,
.style-dark .widget-container a:hover,
.style-dark.style-override .widget-container a:hover,
.style-light .style-dark .widget-container a:hover,
.style-dark .widget-container a:focus,
.style-dark.style-override .widget-container a:focus,
.style-light .style-dark .widget-container a:focus,
.style-dark .woocommerce .woocommerce-breadcrumb a:hover,
.style-dark.style-override .woocommerce .woocommerce-breadcrumb a:hover,
.style-light .style-dark .woocommerce .woocommerce-breadcrumb a:hover,
.style-dark .woocommerce .woocommerce-breadcrumb a:focus,
.style-dark.style-override .woocommerce .woocommerce-breadcrumb a:focus,
.style-light .style-dark .woocommerce .woocommerce-breadcrumb a:focus,
.style-dark .woocommerce .woocommerce-review-link:hover,
.style-dark.style-override .woocommerce .woocommerce-review-link:hover,
.style-light .style-dark .woocommerce .woocommerce-review-link:hover,
.style-dark .woocommerce .woocommerce-review-link:focus,
.style-dark.style-override .woocommerce .woocommerce-review-link:focus,
.style-light .style-dark .woocommerce .woocommerce-review-link:focus {
  color: <?php echo esc_html($color_primary); ?>;
}
.style-light .ui-link,
.style-light.style-override .ui-link,
.style-dark .style-light .ui-link,
.style-light .nav-tabs > li > a,
.style-light.style-override .nav-tabs > li > a,
.style-dark .style-light .nav-tabs > li > a,
.style-light .panel-title > a,
.style-light.style-override .panel-title > a,
.style-dark .style-light .panel-title > a,
.style-light .widget-container a,
.style-light.style-override .widget-container a,
.style-dark .style-light .widget-container a,
.style-light .woocommerce .woocommerce-breadcrumb a,
.style-light.style-override .woocommerce .woocommerce-breadcrumb a,
.style-dark .style-light .woocommerce .woocommerce-breadcrumb a,
.style-light .woocommerce .woocommerce-review-link,
.style-light.style-override .woocommerce .woocommerce-review-link,
.style-dark .style-light .woocommerce .woocommerce-review-link {
  color: <?php echo esc_html($color_heading); ?>;
}
.style-light .ui-link:hover,
.style-light.style-override .ui-link:hover,
.style-dark .style-light .ui-link:hover,
.style-light .ui-link:focus,
.style-light.style-override .ui-link:focus,
.style-dark .style-light .ui-link:focus,
.style-light .nav-tabs > li > a:hover,
.style-light.style-override .nav-tabs > li > a:hover,
.style-dark .style-light .nav-tabs > li > a:hover,
.style-light .nav-tabs > li > a:focus,
.style-light.style-override .nav-tabs > li > a:focus,
.style-dark .style-light .nav-tabs > li > a:focus,
.style-light .panel-title > a:hover,
.style-light.style-override .panel-title > a:hover,
.style-dark .style-light .panel-title > a:hover,
.style-light .panel-title > a:focus,
.style-light.style-override .panel-title > a:focus,
.style-dark .style-light .panel-title > a:focus,
.style-light .widget-container a:hover,
.style-light.style-override .widget-container a:hover,
.style-dark .style-light .widget-container a:hover,
.style-light .widget-container a:focus,
.style-light.style-override .widget-container a:focus,
.style-dark .style-light .widget-container a:focus,
.style-light .woocommerce .woocommerce-breadcrumb a:hover,
.style-light.style-override .woocommerce .woocommerce-breadcrumb a:hover,
.style-dark .style-light .woocommerce .woocommerce-breadcrumb a:hover,
.style-light .woocommerce .woocommerce-breadcrumb a:focus,
.style-light.style-override .woocommerce .woocommerce-breadcrumb a:focus,
.style-dark .style-light .woocommerce .woocommerce-breadcrumb a:focus,
.style-light .woocommerce .woocommerce-review-link:hover,
.style-light.style-override .woocommerce .woocommerce-review-link:hover,
.style-dark .style-light .woocommerce .woocommerce-review-link:hover,
.style-light .woocommerce .woocommerce-review-link:focus,
.style-light.style-override .woocommerce .woocommerce-review-link:focus,
.style-dark .style-light .woocommerce .woocommerce-review-link:focus {
  color: <?php echo esc_html($color_primary); ?>;
}
/* #UI-link-color-text */
.style-dark .ui-text,
.style-dark.style-override .ui-text,
.style-light .style-dark .ui-text,
.style-dark .breadcrumb,
.style-dark.style-override .breadcrumb,
.style-light .style-dark .breadcrumb,
.style-dark .post-info,
.style-dark.style-override .post-info,
.style-light .style-dark .post-info {
  color: #999;
}
.style-light .ui-text,
.style-light.style-override .ui-text,
.style-dark .style-light .ui-text,
.style-light .breadcrumb,
.style-light.style-override .breadcrumb,
.style-dark .style-light .breadcrumb,
.style-light .post-info,
.style-light.style-override .post-info,
.style-dark .style-light .post-info {
  color: #999;
}
.style-dark .ui-link-text,
.style-dark.style-override .ui-link-text,
.style-light .style-dark .ui-link-text,
.style-dark .breadcrumb > li a,
.style-dark.style-override .breadcrumb > li a,
.style-light .style-dark .breadcrumb > li a,
.style-dark .post-info a,
.style-dark.style-override .post-info a,
.style-light .style-dark .post-info a {
  color: #999;
}
.style-dark .ui-link-text:hover,
.style-dark.style-override .ui-link-text:hover,
.style-light .style-dark .ui-link-text:hover,
.style-dark .ui-link-text:focus,
.style-dark.style-override .ui-link-text:focus,
.style-light .style-dark .ui-link-text:focus,
.style-dark .breadcrumb > li a:hover,
.style-dark.style-override .breadcrumb > li a:hover,
.style-light .style-dark .breadcrumb > li a:hover,
.style-dark .breadcrumb > li a:focus,
.style-dark.style-override .breadcrumb > li a:focus,
.style-light .style-dark .breadcrumb > li a:focus,
.style-dark .post-info a:hover,
.style-dark.style-override .post-info a:hover,
.style-light .style-dark .post-info a:hover,
.style-dark .post-info a:focus,
.style-dark.style-override .post-info a:focus,
.style-light .style-dark .post-info a:focus {
  color: <?php echo esc_html($color_primary); ?>;
}
.style-light .ui-link-text,
.style-light.style-override .ui-link-text,
.style-dark .style-light .ui-link-text,
.style-light .breadcrumb > li a,
.style-light.style-override .breadcrumb > li a,
.style-dark .style-light .breadcrumb > li a,
.style-light .post-info a,
.style-light.style-override .post-info a,
.style-dark .style-light .post-info a {
  color: #999;
}
.style-light .ui-link-text:hover,
.style-light.style-override .ui-link-text:hover,
.style-dark .style-light .ui-link-text:hover,
.style-light .ui-link-text:focus,
.style-light.style-override .ui-link-text:focus,
.style-dark .style-light .ui-link-text:focus,
.style-light .breadcrumb > li a:hover,
.style-light.style-override .breadcrumb > li a:hover,
.style-dark .style-light .breadcrumb > li a:hover,
.style-light .breadcrumb > li a:focus,
.style-light.style-override .breadcrumb > li a:focus,
.style-dark .style-light .breadcrumb > li a:focus,
.style-light .post-info a:hover,
.style-light.style-override .post-info a:hover,
.style-dark .style-light .post-info a:hover,
.style-light .post-info a:focus,
.style-light.style-override .post-info a:focus,
.style-dark .style-light .post-info a:focus {
  color: <?php echo esc_html($color_primary); ?>;
}
/* #Pre-and-code */
.style-dark .ui-inverted,
.style-dark.style-override .ui-inverted,
.style-light .style-dark .ui-inverted {
  color: #191b1e;
  background-color: #f7f7f7;
}
.style-light .ui-inverted,
.style-light.style-override .ui-inverted,
.style-dark .style-light .ui-inverted {
  color: #f7f7f7;
  background-color: #191b1e;
}
/* #Button-social-color */
.style-dark .btn-social,
.style-dark.style-override .btn-social,
.style-light .style-dark .btn-social {
  color: #fff !important;
}
.style-light .btn-social,
.style-light.style-override .btn-social,
.style-dark .style-light .btn-social {
  color: <?php echo esc_html($color_text); ?> !important;
}
/* #Button-skins */
.style-light .btn-default,
.style-dark .style-light.style-override .btn-default,
.style-dark .style-light .btn-default {
  color: #fff !important;
  background-color: <?php echo esc_html($color_heading); ?> !important;
  border-color: <?php echo esc_html($color_heading); ?> !important;
}
.style-light .btn-default:not(.btn-hover-nobg):hover,
.style-dark .style-light.style-override .btn-default:not(.btn-hover-nobg):hover,
.style-dark .style-light .btn-default:not(.btn-hover-nobg):hover,
.style-light .btn-default.active,
.style-dark .style-light.style-override .btn-default.active,
.style-dark .style-light .btn-default.active {
  color: <?php echo esc_html($color_heading); ?> !important;
  background-color: transparent !important;
  border-color: <?php echo esc_html($color_heading); ?> !important;
}
.style-light .btn-default.btn-outline,
.style-dark .style-light.style-override .btn-default.btn-outline,
.style-dark .style-light .btn-default.btn-outline {
  color: <?php echo esc_html($color_heading); ?> !important;
  background-color: transparent !important;
  border-color: <?php echo esc_html($color_heading); ?> !important;
}
.style-light .btn-default.btn-outline:hover,
.style-dark .style-light.style-override .btn-default.btn-outline:hover,
.style-dark .style-light .btn-default.btn-outline:hover,
.style-light .btn-default.btn-outline.active,
.style-dark .style-light.style-override .btn-default.btn-outline.active,
.style-dark .style-light .btn-default.btn-outline.active {
  color: #fff !important;
  background-color: <?php echo esc_html($color_heading); ?> !important;
  border-color: <?php echo esc_html($color_heading); ?> !important;
}
.style-dark .btn-default,
.style-light .style-dark.style-override .btn-default,
.style-light .style-dark .btn-default {
  color: <?php echo esc_html($color_heading); ?> !important;
  background-color: #fff !important;
  border-color: #fff !important;
}
.style-dark .btn-default:not(.btn-hover-nobg):hover,
.style-light .style-dark.style-override .btn-default:not(.btn-hover-nobg):hover,
.style-light .style-dark .btn-default:not(.btn-hover-nobg):hover,
.style-dark .btn-default.active,
.style-light .style-dark.style-override .btn-default.active,
.style-light .style-dark .btn-default.active {
  color: #fff !important;
  background-color: transparent !important;
  border-color: #fff !important;
}
.style-dark .btn-default.btn-outline,
.style-light .style-dark.style-override .btn-default.btn-outline,
.style-light .style-dark .btn-default.btn-outline {
  color: #fff !important;
  background-color: transparent !important;
  border-color: #fff !important;
}
.style-dark .btn-default.btn-outline:hover,
.style-light .style-dark.style-override .btn-default.btn-outline:hover,
.style-light .style-dark .btn-default.btn-outline:hover,
.style-dark .btn-default.btn-outline.active,
.style-light .style-dark.style-override .btn-default.btn-outline.active,
.style-light .style-dark .btn-default.btn-outline.active {
  color: <?php echo esc_html($color_heading); ?> !important;
  background-color: #fff !important;
  border-color: #fff !important;
}
@media (min-width: 960px) {
  .overlay.style-light-bg {
    background-color: rgba(255, 255, 255, 0.95) !important;
  }
  .overlay.style-dark-bg {
    background-color: rgba(20, 22, 24, 0.95) !important;
  }
}
/* #Form-focus-color */
.style-dark input:not([type='submit']):not([type='button']):not([type='number']):not([type='checkbox']):not([type='radio']):focus,
.style-dark textarea:focus,
.style-dark.style-override input:not([type='submit']):not([type='button']):not([type='number']):not([type='checkbox']):not([type='radio']):focus,
.style-dark.style-override textarea:focus,
.style-light .style-dark input:not([type='submit']):not([type='button']):not([type='number']):not([type='checkbox']):not([type='radio']):focus,
.style-light .style-dark textarea:focus {
  border-color: <?php echo esc_html($color_primary); ?>;
}
.style-light input:not([type='submit']):not([type='button']):not([type='number']):not([type='checkbox']):not([type='radio']):focus,
.style-light textarea:focus,
.style-light.style-override input:not([type='submit']):not([type='button']):not([type='number']):not([type='checkbox']):not([type='radio']):focus,
.style-light.style-override textarea:focus,
.style-dark .style-light input:not([type='submit']):not([type='button']):not([type='number']):not([type='checkbox']):not([type='radio']):focus,
.style-dark .style-light textarea:focus {
  border-color: <?php echo esc_html($color_primary); ?>;
}
/* #ui-form-placeholder */
.style-dark .ui-form-placeholder,
.style-dark.style-override .ui-form-placeholder,
.style-light .style-dark .ui-form-placeholder {
  color: <?php echo esc_html($color_text_inverted); ?>;
  text-transform: capitalize;
}
.style-light .ui-form-placeholder,
.style-light.style-override .ui-form-placeholder,
.style-dark .style-light .ui-form-placeholder {
  color: <?php echo esc_html($color_text); ?>;
  text-transform: capitalize;
}
/* #Form-inset-shadow */
.shadow-inset-form,
input,
textarea,
select,
.seldiv,
.select2-choice {
  -webkit-box-shadow: inset 0 2px 1px rgba(0, 0, 0, 0.025);
  -moz-box-shadow: inset 0 2px 1px rgba(0, 0, 0, 0.025);
  box-shadow: inset 0 2px 1px rgba(0, 0, 0, 0.025);
}
/* #Form-xl */
.style-dark .uncode-live-search input.form-xl,
.style-dark.style-override .uncode-live-search input.form-xl,
.style-light .style-dark .uncode-live-search input.form-xl {
  -webkit-box-shadow: 0px 0px 0px 6px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 0px 0px 0px 6px rgba(0, 0, 0, 0.2);
  box-shadow: 0px 0px 0px 6px rgba(0, 0, 0, 0.2);
}
.style-light .uncode-live-search input.form-xl,
.style-light.style-override .uncode-live-search input.form-xl,
.style-dark .style-light .uncode-live-search input.form-xl {
  -webkit-box-shadow: 0px 0px 0px 6px rgba(255, 255, 255, 0.2);
  -moz-box-shadow: 0px 0px 0px 6px rgba(255, 255, 255, 0.2);
  box-shadow: 0px 0px 0px 6px rgba(255, 255, 255, 0.2);
}
/* #UI-transition-normal */
.ui-transition-normal,
input,
button,
select,
textarea,
.img-thumbnail {
  -webkit-transition: color 400ms cubic-bezier(0.785, 0.135, 0.15, 0.86), background-color 400ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
  -moz-transition: color 400ms cubic-bezier(0.785, 0.135, 0.15, 0.86), background-color 400ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
  -o-transition: color 400ms cubic-bezier(0.785, 0.135, 0.15, 0.86), background-color 400ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
  transition: color 400ms cubic-bezier(0.785, 0.135, 0.15, 0.86), background-color 400ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
}
/*  */
.ui-transition-slow {
  -webkit-transition: color 600ms cubic-bezier(0.785, 0.135, 0.15, 0.86), background-color 600ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
  -moz-transition: color 600ms cubic-bezier(0.785, 0.135, 0.15, 0.86), background-color 600ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
  -o-transition: color 600ms cubic-bezier(0.785, 0.135, 0.15, 0.86), background-color 600ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
  transition: color 600ms cubic-bezier(0.785, 0.135, 0.15, 0.86), background-color 600ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
}
.ui-transition-fast,
.main-wrapper a {
  -webkit-transition: color 200ms cubic-bezier(0.785, 0.135, 0.15, 0.86), background-color 200ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
  -moz-transition: color 200ms cubic-bezier(0.785, 0.135, 0.15, 0.86), background-color 200ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
  -o-transition: color 200ms cubic-bezier(0.785, 0.135, 0.15, 0.86), background-color 200ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
  transition: color 200ms cubic-bezier(0.785, 0.135, 0.15, 0.86), background-color 200ms cubic-bezier(0.785, 0.135, 0.15, 0.86);
}
/* #Cart dropdown */
.submenu-light ul.uncode-cart-dropdown a,
.submenu-light ul.uncode-cart-dropdown span {
  color: <?php echo esc_html($color_menu_text); ?>;
}
.submenu-dark ul.uncode-cart-dropdown a,
.submenu-dark ul.uncode-cart-dropdown span {
  color: <?php echo esc_html($color_menu_text_inverted); ?>;
}
/* #Woo Headings */
.headings-style-woo,
.woocommerce .your_cart,
.woocommerce .cart-collaterals .shipping_calculator h2,
.woocommerce .cart-collaterals .cart_totals h2,
.woocommerce .cart-collaterals .cart_totals .order-total .amount,
.woocommerce .checkout h3,
.woocommerce .order-details h3,
.woocommerce .order-details tfoot tr:last-child,
.woocommerce .woo-thank-you h2,
.woocommerce .woo-thank-you h3,
.woocommerce #order_review tfoot tr:last-child,
.woocommerce .address h3 {
  font-size: 17px;
  line-height: 1.2;
  margin: 27px 0 0;
}
.row-breadcrumb.row-breadcrumb-light .breadcrumb-title {
  color: #999;
}
.row-breadcrumb.row-breadcrumb-dark .breadcrumb-title {
  color: #999;
}
.row-navigation.row-navigation-light {
  outline-color: #eaeaea;
  background-color: #f7f7f7;
}
.row-navigation.row-navigation-light .btn-disable-hover {
  color: #999;
}
.row-navigation.row-navigation-dark {
  outline-color: #303133;
  background-color: #191b1e;
}
.row-navigation.row-navigation-dark .btn-disable-hover {
  color: #999;
}
.style-dark .wp-caption-text,
.style-dark.style-override .wp-caption-text,
.style-light .style-dark .wp-caption-text {
  color: <?php echo esc_html($color_text_inverted); ?>;
}
.style-light .wp-caption-text,
.style-light.style-override .wp-caption-text,
.style-dark .style-light .wp-caption-text {
  color: <?php echo esc_html($color_text); ?>;
}
/*
----------------------------------------------------------

#Skins-Buttons

----------------------------------------------------------
*/
.btn-dark {
  color: #fff !important;
  background-color: #000 !important;
  border-color: #000 !important;
}
.btn-dark:not(.btn-hover-nobg):hover,
.btn-dark.active {
  color: #000 !important;
  background-color: transparent !important;
  border-color: #000 !important;
}
.btn-dark.btn-outline {
  color: #000 !important;
  background-color: transparent !important;
  border-color: #000 !important;
}
.btn-dark.btn-outline:hover,
.btn-dark.btn-outline.active {
  color: #fff !important;
  background-color: #000 !important;
  border-color: #000 !important;
}
.btn-light {
  color: #000 !important;
  background-color: #fff !important;
  border-color: #fff !important;
}
.btn-light:not(.btn-hover-nobg):hover,
.btn-light.active {
  color: #fff !important;
  background-color: transparent !important;
  border-color: #fff !important;
}
.btn-light.btn-outline {
  color: #fff !important;
  background-color: transparent !important;
  border-color: #fff !important;
}
.btn-light.btn-outline:hover,
.btn-light.btn-outline.active {
  color: #000 !important;
  background-color: #fff !important;
  border-color: #fff !important;
}
.btn-success {
  color: #fff !important;
  background-color: #28DE72 !important;
  border-color: #28DE72 !important;
}
.btn-success:not(.btn-hover-nobg):hover,
.btn-success.active {
  color: #28DE72 !important;
  background-color: transparent !important;
  border-color: #28DE72 !important;
}
.btn-success.btn-outline {
  color: #28DE72 !important;
  background-color: transparent !important;
  border-color: #28DE72 !important;
}
.btn-success.btn-outline:hover,
.btn-success.btn-outline.active {
  color: #fff !important;
  background-color: #28DE72 !important;
  border-color: #28DE72 !important;
}
.btn-info {
  color: #fff !important;
  background-color: <?php echo esc_html($color_primary); ?> !important;
  border-color: <?php echo esc_html($color_primary); ?> !important;
}
.btn-info:not(.btn-hover-nobg):hover,
.btn-info.active {
  color: <?php echo esc_html($color_primary); ?> !important;
  background-color: transparent !important;
  border-color: <?php echo esc_html($color_primary); ?> !important;
}
.btn-info.btn-outline {
  color: <?php echo esc_html($color_primary); ?> !important;
  background-color: transparent !important;
  border-color: <?php echo esc_html($color_primary); ?> !important;
}
.btn-info.btn-outline:hover,
.btn-info.btn-outline.active {
  color: #fff !important;
  background-color: <?php echo esc_html($color_primary); ?> !important;
  border-color: <?php echo esc_html($color_primary); ?> !important;
}
.btn-warning {
  color: #fff !important;
  background-color: #FFC42E !important;
  border-color: #FFC42E !important;
}
.btn-warning:not(.btn-hover-nobg):hover,
.btn-warning.active {
  color: #FFC42E !important;
  background-color: transparent !important;
  border-color: #FFC42E !important;
}
.btn-warning.btn-outline {
  color: #FFC42E !important;
  background-color: transparent !important;
  border-color: #FFC42E !important;
}
.btn-warning.btn-outline:hover,
.btn-warning.btn-outline.active {
  color: #fff !important;
  background-color: #FFC42E !important;
  border-color: #FFC42E !important;
}
.btn-danger {
  color: #fff !important;
  background-color: #FF3100 !important;
  border-color: #FF3100 !important;
}
.btn-danger:not(.btn-hover-nobg):hover,
.btn-danger.active {
  color: #FF3100 !important;
  background-color: transparent !important;
  border-color: #FF3100 !important;
}
.btn-danger.btn-outline {
  color: #FF3100 !important;
  background-color: transparent !important;
  border-color: #FF3100 !important;
}
.btn-danger.btn-outline:hover,
.btn-danger.btn-outline.active {
  color: #fff !important;
  background-color: #FF3100 !important;
  border-color: #FF3100 !important;
}
/*
----------------------------------------------------------

#Skins-Menus: Font Family & Weights

----------------------------------------------------------
*/
/* #Font-family-menu */
.font-family-menu,
.menu-container ul.menu-smart a {
  font-family: <?php echo esc_html($font_family_menu); ?>;
}
@media (max-width: 959px) {
  .menu-primary ul.menu-smart a {
    font-family: <?php echo esc_html($font_family_menu); ?>;
    font-weight: <?php echo esc_html($menu_font_weight); ?>;
  }
}
/* #Font-size-menu */
.font-size-menu,
.menu-container ul.menu-smart > li > a,
.menu-smart > li > a > div > div > div.btn,
.uncode-cart .buttons a {
  font-size: 12px;
}
@media (min-width: 960px) {
  .font-size-menu,
  .menu-container ul.menu-smart > li > a,
  .menu-smart > li > a > div > div > div.btn,
  .uncode-cart .buttons a {
    font-size: <?php echo esc_html($menu_font_size); ?>px;
  }
  .font-size-submenu,
  .menu-horizontal ul ul a,
  .vmenu-container ul ul a,
  .uncode-cart .cart-desc {
    font-size: <?php echo esc_html($submenu_font_size); ?>px;
  }
}
@media (max-width: 959px) {
  .font-size-menu-mobile,
  .menu-container:not(.isotope-filters) ul.menu-smart a {
    font-size: <?php echo esc_html($menu_mobile_font_size); ?>px !important;
  }
}
/* #Font-weight-menu */
.font-weight-menu,
.menu-container ul.menu-smart > li > a,
.menu-container ul.menu-smart li.dropdown > a,
.menu-container ul.menu-smart li.mega-menu > a,
.menu-smart i.fa-dropdown,
.vmenu-container a {
  font-weight: <?php echo esc_html($menu_font_weight); ?>;
  letter-spacing: 0.05em;
}
@media (max-width: 959px) {
  .font-weight-menu,
  .menu-container ul.menu-smart > li > a,
  .menu-container ul.menu-smart li.dropdown > a,
  .menu-container ul.menu-smart li.mega-menu > a,
  .menu-smart i.fa-dropdown,
  .vmenu-container a {
    font-weight: 600;
  }
}
/*
----------------------------------------------------------

#Skins-Menus: Colors

----------------------------------------------------------
*/
/* Menu colors */
.menu-light p {
  color: <?php echo esc_html($color_menu_text); ?>;
}
.menu-light .menu-smart a {
  color: <?php echo esc_html($color_menu_text); ?>;
}
.menu-light .menu-smart a:hover,
.menu-light .menu-smart a:focus {
  color: <?php echo esc_html($color_menu_text_hover); ?>;
}
.isotope-filters .menu-light .menu-smart a:hover,
.isotope-filters .menu-light .menu-smart a:focus {
  color: <?php echo esc_html($color_menu_text_hover_static); ?>;
}
.menu-light .mobile-shopping-cart {
  color: <?php echo esc_html($color_logo); ?>;
}
.menu-dark p {
  color: <?php echo esc_html($color_menu_text_inverted); ?>;
}
.menu-dark .menu-smart a {
  color: <?php echo esc_html($color_menu_text_inverted); ?>;
}
.menu-dark .menu-smart a:hover,
.menu-dark .menu-smart a:focus {
  color: <?php echo esc_html($color_menu_text_inverted_hover); ?>;
}
.isotope-filters .menu-dark .menu-smart a:hover,
.isotope-filters .menu-dark .menu-smart a:focus {
  color: <?php echo esc_html($color_menu_text_inverted_hover_static); ?>;
}
.menu-dark .mobile-shopping-cart {
  color: <?php echo esc_html($color_logo_inverted); ?>;
}
@media (min-width: 960px) {
  .style-light-override:not(.is_stuck).menu-transparent .menu-horizontal-inner > .nav > .menu-smart > li > a {
    color: <?php echo esc_html($color_menu_text); ?> !important;
  }
  .style-light-override:not(.is_stuck).menu-transparent .menu-horizontal-inner > .nav > .menu-smart > li > a:hover,
  .style-light-override:not(.is_stuck).menu-transparent .menu-horizontal-inner > .nav > .menu-smart > li > a:focus {
    color: <?php echo esc_html($color_menu_text_hover); ?> !important;
  }
  .style-light-override:not(.is_stuck).menu-transparent .mobile-shopping-cart {
    color: <?php echo esc_html($color_menu_text); ?> !important;
  }
  .style-dark-override:not(.is_stuck).menu-transparent .menu-horizontal-inner > .nav > .menu-smart > li > a {
    color: <?php echo esc_html($color_menu_text_inverted); ?> !important;
  }
  .style-dark-override:not(.is_stuck).menu-transparent .menu-horizontal-inner > .nav > .menu-smart > li > a:hover,
  .style-dark-override:not(.is_stuck).menu-transparent .menu-horizontal-inner > .nav > .menu-smart > li > a:focus {
    color: <?php echo esc_html($color_menu_text_inverted_hover); ?> !important;
  }
  .style-dark-override:not(.is_stuck).menu-transparent .mobile-shopping-cart {
    color: <?php echo esc_html($color_menu_text_inverted); ?> !important;
  }
}
/* Menu colors active */
.menu-light .menu-smart > li.active > a,
.menu-light .menu-smart > li a.active,
.menu-light .menu-smart > li.current-menu-ancestor > a {
  color: <?php echo esc_html($color_menu_text_hover); ?>;
}
.isotope-filters .menu-light .menu-smart > li.active > a,
.isotope-filters .menu-light .menu-smart > li a.active,
.isotope-filters .menu-light .menu-smart > li.current-menu-ancestor > a {
  color: <?php echo esc_html($color_menu_text_hover_static); ?>;
}
.menu-dark .menu-smart > li.active > a,
.menu-dark .menu-smart > li a.active,
.menu-dark .menu-smart > li.current-menu-ancestor > a {
  color: <?php echo esc_html($color_menu_text_inverted_hover); ?>;
}
.isotope-filters .menu-dark .menu-smart > li.active > a,
.isotope-filters .menu-dark .menu-smart > li a.active,
.isotope-filters .menu-dark .menu-smart > li.current-menu-ancestor > a {
  color: <?php echo esc_html($color_menu_text_inverted_hover_static); ?>;
}
@media (min-width: 960px) {
  .style-light-override:not(.is_stuck).menu-transparent .menu-horizontal-inner > .nav > .menu-smart > li.active > a,
  .style-light-override:not(.is_stuck).menu-transparent .menu-horizontal-inner > .nav > .menu-smart > li a.active,
  .style-light-override:not(.is_stuck).menu-transparent .menu-horizontal-inner > .nav > .menu-smart > li.current-menu-parent > a,
  .style-light-override:not(.is_stuck).menu-transparent .menu-horizontal-inner > .nav > .menu-smart > li.current-menu-ancestor > a {
    color: <?php echo esc_html($color_menu_text_hover); ?> !important;
  }
  .style-dark-override:not(.is_stuck).menu-transparent .menu-horizontal-inner > .nav > .menu-smart > li.active > a,
  .style-dark-override:not(.is_stuck).menu-transparent .menu-horizontal-inner > .nav > .menu-smart > li a.active,
  .style-dark-override:not(.is_stuck).menu-transparent .menu-horizontal-inner > .nav > .menu-smart > li.current-menu-parent > a,
  .style-dark-override:not(.is_stuck).menu-transparent .menu-horizontal-inner > .nav > .menu-smart > li.current-menu-ancestor > a {
    color: <?php echo esc_html($color_menu_text_inverted_hover); ?> !important;
  }
}
/* Menu submenu colors */
.submenu-light .menu-smart ul a {
  color: <?php echo esc_html($color_menu_text); ?>;
}
@media (min-width: 960px) {
  body[class*=hmenu-] .submenu-light .menu-smart ul a:hover,
  body[class*=hmenu-] .submenu-light .menu-smart ul a:focus {
    color: <?php echo esc_html($color_menu_text_hover); ?>;
    background-color: rgba(0, 0, 0, 0.03);
  }
}
.submenu-dark .menu-smart ul a {
  color: <?php echo esc_html($color_menu_text_inverted); ?>;
}
@media (min-width: 960px) {
  body[class*=hmenu-] .submenu-dark .menu-smart ul a:hover,
  body[class*=hmenu-] .submenu-dark .menu-smart ul a:focus {
    color: <?php echo esc_html($color_menu_text_inverted_hover); ?>;
    background-color: rgba(255, 255, 255, 0.03);
  }
}
@media (max-width: 959px) {
  .submenu-light .menu-smart a {
    color: <?php echo esc_html($color_menu_text); ?>;
  }
  .submenu-light .menu-smart a:hover,
  .submenu-light .menu-smart a:focus {
    color: <?php echo esc_html($color_menu_text_hover); ?>;
  }
  .submenu-dark .menu-smart a {
    color: <?php echo esc_html($color_menu_text_inverted); ?>;
  }
  .submenu-dark .menu-smart a:hover,
  .submenu-dark .menu-smart a:focus {
    color: <?php echo esc_html($color_menu_text_inverted_hover); ?>;
  }
}
/* Menu submenu colors active*/
.submenu-light .menu-smart ul li.current-menu-parent > a,
.submenu-light .menu-smart ul li.active > a {
  color: <?php echo esc_html($color_menu_text_hover); ?>;
}
.submenu-dark .menu-smart ul li.current-menu-parent > a,
.submenu-dark .menu-smart ul li.active > a {
  color: <?php echo esc_html($color_menu_text_inverted_hover); ?>;
}
@media (max-width: 959px) {
  .submenu-light .menu-smart li.active > a,
  .submenu-light .menu-smart li.current-menu-ancestor > a {
    color: <?php echo esc_html($color_menu_text_hover); ?>;
  }
  .submenu-dark .menu-smart li.active > a,
  .submenu-dark .menu-smart li.current-menu-ancestor > a {
    color: <?php echo esc_html($color_menu_text_inverted_hover); ?>;
  }
}
/* Menu megamenu title colors */
@media (min-width: 960px) {
  .submenu-light .menu-horizontal .menu-smart > .mega-menu .mega-menu-inner > li > a {
    color: <?php echo esc_html($color_menu_text); ?>;
  }
  .submenu-dark .menu-horizontal .menu-smart > .mega-menu .mega-menu-inner > li > a {
    color: <?php echo esc_html($color_menu_text_inverted); ?>;
  }
}
/* Menu colors mobile */
@media (max-width: 959px) {
  .submenu-light .menu-smart a {
    color: <?php echo esc_html($color_menu_text); ?>;
  }
  .submenu-dark .menu-smart a {
    color: <?php echo esc_html($color_menu_text_inverted); ?>;
  }
}
/*
----------------------------------------------------------

#Skins-Menus: Borders

----------------------------------------------------------
*/
/* Menu borders colors */
.menu-light .menu-smart,
.menu-light .menu-smart li,
.submenu-light .menu-smart ul,
.menu-smart.submenu-light li ul li,
.menu-light .menu-accordion-dividers,
.menu-light .menu-borders,
.menu-light.vmenu-borders,
.menu-light .main-menu-container {
  border-color: <?php echo esc_html($color_menu_border_light); ?>;
}
.menu-dark .menu-smart,
.menu-dark .menu-smart li,
.submenu-dark .menu-smart ul,
.menu-smart.submenu-dark li ul li,
.menu-dark .menu-accordion-dividers,
.menu-dark .menu-borders,
.menu-dark.vmenu-borders,
.menu-dark .main-menu-container {
  border-color: <?php echo esc_html($color_menu_border_dark); ?>;
}
/* Submenu borders colors */
.submenu-light .menu-smart li ul li {
  border-color: <?php echo esc_html($color_submenu_border_light); ?>;
}
.submenu-dark .menu-smart li ul li {
  border-color: <?php echo esc_html($color_submenu_border_dark); ?>;
}
@media (max-width: 959px) {
  .menu-light .row-brand,
  .menu-light .row-menu .row-menu-inner {
    border-bottom: 1px solid <?php echo esc_html($color_menu_border_light); ?>;
  }
  .submenu-light .menu-smart,
  .submenu-light .menu-smart li {
    border-color: <?php echo esc_html($color_submenu_border_light); ?>;
  }
  .menu-dark .row-brand,
  .menu-dark .row-menu .row-menu-inner {
    border-bottom: 1px solid <?php echo esc_html($color_menu_border_dark); ?>;
  }
  .submenu-dark .menu-smart,
  .submenu-dark .menu-smart li {
    border-color: <?php echo esc_html($color_submenu_border_dark); ?>;
  }
}
/* Menu transparent borders colors */
@media (min-width: 960px) {
  .menu-transparent.menu-light .menu-borders,
  .menu-transparent.menu-light .menu-smart,
  .menu-transparent.menu-light .menu-smart > li,
  .menu-transparent.menu-light .navbar-nav-last > *:first-child {
    border-color: <?php echo esc_html($color_menu_border_light); ?>;
  }
  .menu-transparent.menu-dark .menu-borders,
  .menu-transparent.menu-dark .menu-smart,
  .menu-transparent.menu-dark .menu-smart > li,
  .menu-transparent.menu-dark .navbar-nav-last > *:first-child {
    border-color: <?php echo esc_html($color_menu_border_dark); ?>;
  }
  .style-light-override:not(.is_stuck).menu-transparent .menu-borders,
  .style-light-override:not(.is_stuck).menu-transparent .menu-smart,
  .style-light-override:not(.is_stuck).menu-transparent .menu-smart > li,
  .style-light-override:not(.is_stuck).menu-transparent .navbar-nav-last > *:first-child {
    border-color: <?php echo esc_html($color_menu_border_light_transparent); ?> !important;
  }
  .style-dark-override:not(.is_stuck).menu-transparent .menu-borders,
  .style-dark-override:not(.is_stuck).menu-transparent .menu-smart,
  .style-dark-override:not(.is_stuck).menu-transparent .menu-smart > li,
  .style-dark-override:not(.is_stuck).menu-transparent .navbar-nav-last > *:first-child {
    border-color: <?php echo esc_html($color_menu_border_dark_transparent); ?> !important;
  }
  .menu-light .navbar-nav-last > *:first-child {
    border-color: <?php echo esc_html($color_menu_border_light); ?>;
  }
  .menu-dark .navbar-nav-last > *:first-child {
    border-color: <?php echo esc_html($color_menu_border_dark); ?>;
  }
  /** fix menu overlay **/
  .menu-overlay .menu-transparent:not(.is_stuck).menu-transparent .menu-borders {
    border: none;
  }
}
/* Submenu borders transparent  */
@media (min-width: 960px) {
  .submenu-transparent.submenu-light .menu-smart ul,
  .submenu-transparent.submenu-light .menu-smart li ul li {
    border-color: <?php echo esc_html($color_submenu_border_light); ?>;
  }
  .submenu-transparent.submenu-dark .menu-smart ul,
  .submenu-transparent.submenu-dark .menu-smart li ul li {
    border-color: <?php echo esc_html($color_submenu_border_dark); ?>;
  }
}
/*
----------------------------------------------------------

#Skins-Menus: Backgrounds

----------------------------------------------------------
*/
/* Menu backgrounds colors */
.main-header .style-light-bg,
.menu-wrapper .style-light-bg {
  background-color: <?php echo esc_html(((strpos($color_menu_background_light, 'background') === false) ? $color_menu_background_light : 'initial; ' . substr($color_menu_background_light, 0, -1))); ?>;
}
.main-header .style-dark-bg,
.menu-wrapper .style-dark-bg {
  background-color: <?php echo esc_html(((strpos($color_menu_background_dark, 'background') === false) ? $color_menu_background_dark : 'initial; ' . substr($color_menu_background_dark, 0, -1))); ?>;
}
/* Menu submenu backgrounds colors */
.submenu-light .menu-horizontal .menu-smart ul {
  background-color: <?php echo esc_html(((strpos($color_submenu_background_light, 'background') === false) ? $color_submenu_background_light : 'initial; ' . $color_submenu_background_light)); ?>;
}
.submenu-dark .menu-horizontal .menu-smart ul {
  background-color: <?php echo esc_html(((strpos($color_submenu_background_dark, 'background') === false) ? $color_submenu_background_dark : 'initial; ' . $color_submenu_background_dark)); ?>;
}
/* Menu submenu mobile backgrounds colors */
@media (max-width: 959px) {
  .submenu-light .menu-smart,
  .submenu-light .menu-sidebar-inner,
  .submenu-light .main-menu-container {
    background-color: <?php echo esc_html(((strpos($color_submenu_background_light, 'background') === false) ? $color_submenu_background_light : 'initial; ' . $color_submenu_background_light)); ?>;
  }
  .submenu-dark .menu-smart,
  .submenu-dark .menu-sidebar-inner,
  .submenu-dark .main-menu-container {
    background-color: <?php echo esc_html(((strpos($color_submenu_background_dark, 'background') === false) ? $color_submenu_background_dark : 'initial; ' . $color_submenu_background_dark)); ?>;
  }
}
/* Menu transparent backgrounds colors */
@media (min-width: 960px) {
  body:not(.menu-overlay):not(.hmenu-center) .menu-wrapper:not(.no-header) .menu-transparent:not(.is_stuck).menu-transparent.style-light-original {
    opacity: 0;
  }
  .menu-wrapper:not(.no-header) .menu-transparent:not(.is_stuck).menu-transparent.style-light-original > * {
    background: transparent;
    background-color: <?php echo esc_html($color_menu_background_alpha_light); ?>;
  }
  body:not(.menu-overlay):not(.hmenu-center) .menu-wrapper:not(.no-header) .menu-transparent:not(.is_stuck).menu-transparent.style-dark-original {
    opacity: 0;
  }
  .menu-wrapper:not(.no-header) .menu-transparent:not(.is_stuck).menu-transparent.style-dark-original > * {
    background: transparent;
    background-color: <?php echo esc_html($color_menu_background_alpha_dark); ?>;
  }
}
/*
----------------------------------------------------------

#Skins-Menus: Scroll Arrows

----------------------------------------------------------
*/
/* Menu scroll arrows */
.submenu-light .menu-smart span.scroll-up,
.submenu-light .menu-smart span.scroll-down {
  border-color: <?php echo esc_html($color_menu_border_light); ?>;
  background-color: <?php echo esc_html(((strpos($color_menu_background_light, 'background') === false) ? $color_menu_background_light : 'initial; ' . substr($color_menu_background_light, 0, -1))); ?>;
}
.submenu-dark .menu-smart span.scroll-up,
.submenu-dark .menu-smart span.scroll-down {
  border-color: <?php echo esc_html($color_menu_border_dark); ?>;
  background-color: <?php echo esc_html(((strpos($color_menu_background_dark, 'background') === false) ? $color_menu_background_dark : 'initial; ' . substr($color_menu_background_dark, 0, -1))); ?>;
}
.submenu-light .menu-smart span.scroll-up-arrow,
.submenu-light .menu-smart span.scroll-down-arrow {
  border-color: transparent transparent <?php echo esc_html($color_menu_border_light); ?> transparent !important;
}
.submenu-dark .menu-smart span.scroll-up-arrow,
.submenu-dark .menu-smart span.scroll-down-arrow {
  border-color: transparent transparent <?php echo esc_html($color_menu_border_dark); ?> transparent !important;
}
.submenu-light .menu-smart span.scroll-down-arrow {
  border-color: <?php echo esc_html($color_menu_border_light); ?> transparent transparent transparent !important;
}
.submenu-dark .menu-smart span.scroll-down-arrow {
  border-color: <?php echo esc_html($color_menu_border_dark); ?> transparent transparent transparent !important;
}
/*
----------------------------------------------------------

#Skins-Menus: Toggle

----------------------------------------------------------
*/
/* Menu mobile toggle */
.mobile-menu-button-dark .lines,
.mobile-menu-button-dark .lines:before,
.mobile-menu-button-dark .lines:after {
  background: <?php echo esc_html($color_menu_text_inverted); ?>;
}
.mobile-menu-button-light .lines,
.mobile-menu-button-light .lines:before,
.mobile-menu-button-light .lines:after {
  background: <?php echo esc_html($color_menu_text); ?>;
}
@media (min-width: 960px) {
  .style-light-override:not(.is_stuck).menu-transparent .lines,
  .style-light-override:not(.is_stuck).menu-transparent .lines:before,
  .style-light-override:not(.is_stuck).menu-transparent .lines:after {
    background: <?php echo esc_html($color_menu_text); ?>;
  }
  .style-dark-override:not(.is_stuck).menu-transparent .lines,
  .style-dark-override:not(.is_stuck).menu-transparent .lines:before,
  .style-dark-override:not(.is_stuck).menu-transparent .lines:after {
    background: <?php echo esc_html($color_menu_text_inverted); ?>;
  }
}
/*
----------------------------------------------------------

#Skins-Menus: Shadows

----------------------------------------------------------
*/
/* Menu shadows */
@media (min-width: 960px) {
  .menu-horizontal .menu-smart ul {
    -webkit-box-shadow: 0 4px 10px -10px rgba(0, 0, 0, 0.6);
    -moz-box-shadow: 0 4px 10px -10px rgba(0, 0, 0, 0.6);
    box-shadow: 0 4px 10px -10px rgba(0, 0, 0, 0.6);
  }
}
@media (min-width: 960px) {
  .menu-shadows {
    -webkit-box-shadow: 0 4px 10px -10px rgba(0, 0, 0, 0.6);
    -moz-box-shadow: 0 4px 10px -10px rgba(0, 0, 0, 0.6);
    box-shadow: 0 4px 10px -10px rgba(0, 0, 0, 0.6);
  }
  body[class*=vmenu-] .menu-shadows {
    -webkit-box-shadow: 0 0px 7px -1px rgba(0, 0, 0, 0.1);
    -moz-box-shadow: 0 0px 7px -1px rgba(0, 0, 0, 0.1);
    box-shadow: 0 0px 7px -1px rgba(0, 0, 0, 0.1);
  }
}
@media (min-width: 960px) {
  .menu-primary:not(.is_stuck) .menu-shadows.force-no-shadows {
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
  }
  body[class*=hmenu-] .menu-primary.is_stuck .menu-container {
    -webkit-box-shadow: 0 4px 10px -10px rgba(0, 0, 0, 0.6);
    -moz-box-shadow: 0 4px 10px -10px rgba(0, 0, 0, 0.6);
    box-shadow: 0 4px 10px -10px rgba(0, 0, 0, 0.6);
  }
}
/* #Menu-mobile-colors */
/* Menu Accordion */
.submenu-light .menu-accordion .menu-smart ul {
  background-color: <?php echo esc_html(((strpos($color_menu_background_light, 'background') === false) ? $color_menu_background_light : 'initial; ' . substr($color_menu_background_light, 0, -1))); ?>;
}
.submenu-dark .menu-accordion .menu-smart ul {
  background-color: <?php echo esc_html(((strpos($color_menu_background_dark, 'background') === false) ? $color_menu_background_dark : 'initial; ' . substr($color_menu_background_dark, 0, -1))); ?>;
}
/* Menu Overlay */
.menu-overlay .menu-accordion .menu-smart ul {
  background-color: transparent !important;
}
@media (min-width: 960px) {
  .menu-overlay .menu-dark.submenu-light .menu-smart ul a {
    color: <?php echo esc_html($color_menu_text_inverted); ?>;
  }
  .menu-overlay .menu-dark.submenu-light .menu-smart ul a:hover,
  .menu-overlay .menu-dark.submenu-light .menu-smart ul a:focus {
    color: <?php echo esc_html($color_menu_text_inverted_hover); ?>;
  }
}
@media (min-width: 960px) {
  .menu-overlay .menu-light.submenu-dark .menu-smart ul a {
    color: <?php echo esc_html($color_menu_text); ?>;
  }
  .menu-overlay .menu-light.submenu-dark .menu-smart ul a:hover,
  .menu-overlay .menu-light.submenu-dark .menu-smart ul a:focus {
    color: <?php echo esc_html($color_menu_text_hover); ?>;
  }
}
/* Logo */
.style-light .navbar-brand .logo-skinnable {
  color: <?php echo esc_html($color_logo); ?>;
}
.style-light .navbar-brand .logo-skinnable > * {
  color: <?php echo esc_html($color_logo); ?>;
}
.style-light .navbar-brand .logo-skinnable svg * {
  fill: <?php echo esc_html($color_logo); ?>;
}
.style-dark .navbar-brand .logo-skinnable {
  color: <?php echo esc_html($color_logo_inverted); ?>;
}
.style-dark .navbar-brand .logo-skinnable > * {
  color: <?php echo esc_html($color_logo_inverted); ?>;
}
.style-dark .navbar-brand .logo-skinnable svg * {
  fill: <?php echo esc_html($color_logo_inverted); ?>;
}
@media (min-width: 960px) {
  .style-light-override:not(.is_stuck).menu-transparent .navbar-brand .logo-skinnable {
    color: <?php echo esc_html($color_logo); ?>;
  }
  .style-light-override:not(.is_stuck).menu-transparent .navbar-brand .logo-skinnable > * {
    color: <?php echo esc_html($color_logo); ?>;
  }
  .style-light-override:not(.is_stuck).menu-transparent .navbar-brand .logo-skinnable svg * {
    fill: <?php echo esc_html($color_logo); ?>;
  }
  .style-dark-override:not(.is_stuck).menu-transparent .navbar-brand .logo-skinnable {
    color: <?php echo esc_html($color_logo_inverted); ?>;
  }
  .style-dark-override:not(.is_stuck).menu-transparent .navbar-brand .logo-skinnable > * {
    color: <?php echo esc_html($color_logo_inverted); ?>;
  }
  .style-dark-override:not(.is_stuck).menu-transparent .navbar-brand .logo-skinnable svg * {
    fill: <?php echo esc_html($color_logo_inverted); ?>;
  }
  .style-light-override:not(.is_stuck).menu-transparent .navbar-brand .logo-dark {
    display: none !important;
  }
  .style-light-override:not(.is_stuck).menu-transparent .navbar-brand .logo-light {
    display: block !important;
  }
  .style-dark-override:not(.is_stuck).menu-transparent .navbar-brand .logo-dark {
    display: block !important;
  }
  .style-dark-override:not(.is_stuck).menu-transparent .navbar-brand .logo-light {
    display: none !important;
  }
}
/* SubMenu Cart */
.submenu-light .menu-accordion .menu-smart .uncode-cart li {
  border-color: <?php echo esc_html($color_menu_border_light); ?>;
}
.submenu-dark .menu-accordion .menu-smart .uncode-cart li {
  border-color: <?php echo esc_html($color_menu_border_dark); ?>;
}
/* #Menu-vertical */
/*
----------------------------------------------------------

#Skins-Thumbs

----------------------------------------------------------
*/
/* #Thumbs text overlay color */
.tmb-light.tmb-color-overlay-text,
.tmb-light.tmb .t-entry-visual *,
.tmb-light.tmb .t-entry-visual a,
.tmb-light.tmb .t-entry-visual .t-entry-title a,
.tmb-light.tmb .t-entry-visual .t-entry-meta span {
  color: #fff;
}
.tmb-dark.tmb-color-overlay-text,
.tmb-dark.tmb .t-entry-visual *,
.tmb-dark.tmb .t-entry-visual a,
.tmb-dark.tmb .t-entry-visual .t-entry-title a,
.tmb-dark.tmb .t-entry-visual .t-entry-meta span {
  color: <?php echo esc_html($color_heading); ?>;
}
/* #Thumbs title color */
.tmb-light.tmb-color-title,
.tmb-light.tmb .t-entry-text .t-entry-title a,
.tmb-light.tmb .t-entry-text .t-entry-title,
.tmb-light.tmb-content-under.tmb .t-entry p.t-entry-meta span,
.tmb-light.tmb-content-under.tmb .t-entry p.t-entry-meta a:not(:hover) {
  color: <?php echo esc_html($color_heading); ?>;
}
.tmb-dark.tmb-color-title,
.tmb-dark.tmb .t-entry-text .t-entry-title a,
.tmb-dark.tmb .t-entry-text .t-entry-title,
.tmb-dark.tmb-content-under.tmb .t-entry p.t-entry-meta span,
.tmb-dark.tmb-content-under.tmb .t-entry p.t-entry-meta a:not(:hover) {
  color: #fff;
}
/* #Thumbs text color */
.tmb-light.tmb-color-text,
.tmb-light.tmb .t-entry-text,
.tmb-light.tmb .t-entry-text p,
.tmb-light.tmb .t-entry p.t-entry-comments .extras a,
.tmb-light.tmb-woocommerce.tmb .t-entry .t-entry-category a,
.tmb-light.tmb-woocommerce.tmb .t-entry .t-entry-category .cat-comma {
  color: <?php echo esc_html($color_text); ?>;
}
.tmb-dark.tmb-color-text,
.tmb-dark.tmb .t-entry-text,
.tmb-dark.tmb .t-entry-text p,
.tmb-dark.tmb .t-entry p.t-entry-comments .extras a,
.tmb-dark.tmb-woocommerce.tmb .t-entry .t-entry-category a,
.tmb-dark.tmb-woocommerce.tmb .t-entry .t-entry-category .cat-comma {
  color: #fff;
}
/* #Thumbs hr color */
.tmb-light.tmb-color-hr,
.tmb-light.el-text hr.separator-reduced,
.tmb-light.tmb .t-entry-visual hr,
.tmb-light.tmb .t-entry-text hr {
  border-color: #eaeaea;
}
.tmb-dark.tmb-color-hr,
.tmb-dark.el-text hr.separator-reduced,
.tmb-dark.tmb .t-entry-visual hr,
.tmb-dark.tmb .t-entry-text hr {
  border-color: rgba(255, 255, 255, 0.25);
}
/* #Thumbs hr color */
.tmb-light.tmb-color-a,
.tmb-light.tmb-content-under.tmb .t-entry p.t-entry-author a:not(:hover) span {
  color: <?php echo esc_html($color_heading); ?>;
}
.tmb-dark.tmb-color-a,
.tmb-dark.tmb-content-under.tmb .t-entry p.t-entry-author a:not(:hover) span {
  color: #fff;
}
/* #Thumbs background color */
.tmb-light.tmb-color-addcart,
.tmb-light.tmb-woocommerce.tmb .t-entry-visual .add-to-cart-overlay a {
  background-color: #262729;
}
.tmb-dark.tmb-color-addcart,
.tmb-dark.tmb-woocommerce.tmb .t-entry-visual .add-to-cart-overlay a {
  background-color: #fff;
}
/* #Thumbs background color */
/* #Thumbs overlay */
/* #Thumbs overlay gradient*/
.tmb.tmb-light.tmb-overlay-gradient-bottom .t-entry-visual .t-entry-visual-overlay-in {
  background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB2aWV3Qm94PSIwIDAgMSAxIiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJub25lIj48bGluZWFyR3JhZGllbnQgaWQ9Imxlc3NoYXQtZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMTAwJSIgeDI9IjAlIiB5Mj0iMCUiPjxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9InJnYigwLCAwLCAwKSIgc3RvcC1vcGFjaXR5PSIwLjc1Ii8+PHN0b3Agb2Zmc2V0PSI1MCUiIHN0b3AtY29sb3I9InJnYigwLDAsMCkiIHN0b3Atb3BhY2l0eT0iMCIvPjwvbGluZWFyR3JhZGllbnQ+PHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNsZXNzaGF0LWdlbmVyYXRlZCkiIC8+PC9zdmc+);
  background-image: -webkit-linear-gradient(bottom, rgba(0, 0, 0, 0.75) 0%, transparent 50%);
  background-image: -moz-linear-gradient(bottom, rgba(0, 0, 0, 0.75) 0%, transparent 50%);
  background-image: -o-linear-gradient(bottom, rgba(0, 0, 0, 0.75) 0%, transparent 50%);
  background-image: linear-gradient(to top, rgba(0, 0, 0, 0.75) 0%, transparent 50%);
}
.tmb.tmb-dark.tmb-overlay-gradient-bottom .t-entry-visual .t-entry-visual-overlay-in {
  background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB2aWV3Qm94PSIwIDAgMSAxIiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJub25lIj48bGluZWFyR3JhZGllbnQgaWQ9Imxlc3NoYXQtZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMTAwJSIgeDI9IjAlIiB5Mj0iMCUiPjxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9InJnYigyNTUsIDI1NSwgMjU1KSIgc3RvcC1vcGFjaXR5PSIwLjUiLz48c3RvcCBvZmZzZXQ9IjUwJSIgc3RvcC1jb2xvcj0icmdiKDAsMCwwKSIgc3RvcC1vcGFjaXR5PSIwIi8+PC9saW5lYXJHcmFkaWVudD48cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2xlc3NoYXQtZ2VuZXJhdGVkKSIgLz48L3N2Zz4=);
  background-image: -webkit-linear-gradient(bottom, rgba(255, 255, 255, 0.5) 0%, transparent 50%);
  background-image: -moz-linear-gradient(bottom, rgba(255, 255, 255, 0.5) 0%, transparent 50%);
  background-image: -o-linear-gradient(bottom, rgba(255, 255, 255, 0.5) 0%, transparent 50%);
  background-image: linear-gradient(to top, rgba(255, 255, 255, 0.5) 0%, transparent 50%);
}
.tmb.tmb-light.tmb-overlay-gradient-top .t-entry-visual .t-entry-visual-overlay-in {
  background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB2aWV3Qm94PSIwIDAgMSAxIiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJub25lIj48bGluZWFyR3JhZGllbnQgaWQ9Imxlc3NoYXQtZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPjxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9InJnYigwLCAwLCAwKSIgc3RvcC1vcGFjaXR5PSIwLjc1Ii8+PHN0b3Agb2Zmc2V0PSI1MCUiIHN0b3AtY29sb3I9InJnYigwLDAsMCkiIHN0b3Atb3BhY2l0eT0iMCIvPjwvbGluZWFyR3JhZGllbnQ+PHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNsZXNzaGF0LWdlbmVyYXRlZCkiIC8+PC9zdmc+);
  background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0.75) 0%, transparent 50%);
  background-image: -moz-linear-gradient(top, rgba(0, 0, 0, 0.75) 0%, transparent 50%);
  background-image: -o-linear-gradient(top, rgba(0, 0, 0, 0.75) 0%, transparent 50%);
  background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.75) 0%, transparent 50%);
}
.tmb.tmb-dark.tmb-overlay-gradient-top .t-entry-visual .t-entry-visual-overlay-in {
  background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB2aWV3Qm94PSIwIDAgMSAxIiBwcmVzZXJ2ZUFzcGVjdFJhdGlvPSJub25lIj48bGluZWFyR3JhZGllbnQgaWQ9Imxlc3NoYXQtZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPjxzdG9wIG9mZnNldD0iMCUiIHN0b3AtY29sb3I9InJnYigyNTUsIDI1NSwgMjU1KSIgc3RvcC1vcGFjaXR5PSIwLjUiLz48c3RvcCBvZmZzZXQ9IjUwJSIgc3RvcC1jb2xvcj0icmdiKDAsMCwwKSIgc3RvcC1vcGFjaXR5PSIwIi8+PC9saW5lYXJHcmFkaWVudD48cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2xlc3NoYXQtZ2VuZXJhdGVkKSIgLz48L3N2Zz4=);
  background-image: -webkit-linear-gradient(top, rgba(255, 255, 255, 0.5) 0%, transparent 50%);
  background-image: -moz-linear-gradient(top, rgba(255, 255, 255, 0.5) 0%, transparent 50%);
  background-image: -o-linear-gradient(top, rgba(255, 255, 255, 0.5) 0%, transparent 50%);
  background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.5) 0%, transparent 50%);
}
/* #Thumbs elements border width*/
.tmb-border-width {
  border-width: 1px;
}
.tmb-border-reduced-width,
.el-text hr.separator-reduced {
  border-width: 2px;
}
/* #Thumbs shadow */
.tmb-with-shadow,
.tmb-shadowed:not(.tmb-no-bg):not(.tmb-media-shadowed).tmb > .t-inside,
.tmb-shadowed.tmb-no-bg.tmb-media-first.tmb > .t-inside .t-entry-visual,
.tmb-media-shadowed.tmb .t-entry-visual,
.uncode-single-media-wrapper.tmb-shadow {
  -webkit-box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.05);
  -moz-box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.05);
  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.05);
}
/* #Thumbs border */
.tmb-light.tmb-border,
.tmb-light.tmb-bordered:not(.tmb-no-bg):not(.tmb-media-shadowed).tmb > .t-inside,
.tmb-light.tmb-bordered.tmb-no-bg.tmb-media-first.tmb > .t-inside .t-entry-visual {
  border: 1px solid #eaeaea;
}
.tmb-dark.tmb-border,
.tmb-dark.tmb-bordered:not(.tmb-no-bg):not(.tmb-media-shadowed).tmb > .t-inside,
.tmb-dark.tmb-bordered.tmb-no-bg.tmb-media-first.tmb > .t-inside .t-entry-visual {
  border: 1px solid #7a7d82;
}
.tmb-light.tmb-border-under {
  border-color: #eaeaea;
}
.tmb-dark.tmb-border-under {
  border-color: #fff;
}
.post-media .tmb-light .regular-text p,
.post-media .tmb-light .regular-text a,
.post-media .tmb-light .regular-text * {
  color: <?php echo esc_html($color_heading); ?>;
}
.post-media .tmb-dark .regular-text p,
.post-media .tmb-dark .regular-text a,
.post-media .tmb-dark .regular-text * {
  color: #fff;
}
