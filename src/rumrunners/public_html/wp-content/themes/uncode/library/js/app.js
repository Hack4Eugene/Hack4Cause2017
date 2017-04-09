

/* ----------------------------------------------------------
 * Uncode App
 * ---------------------------------------------------------- */

(function($) {
	"use strict";
	var UNCODE = window.UNCODE || {};
	window.UNCODE = UNCODE;

UNCODE.utils = function() {
	$('.btn-tooltip').tooltip();
	$('a').hover(function() {
		$(this).attr('data-title', $(this).attr('title'));
		$(this).removeAttr('title');
	}, function() {
		$(this).attr('title', $(this).attr('data-title'));
	});
	$('.counter').counterUp({
		delay: 10,
		time: 1500
	});
	$('[data-countdown]').each(function() {
		var $this = $(this),
			finalDate = $(this).data('countdown');
		$this.countdown(finalDate, function(event) {
			$this.html(event.strftime('%D <small>' + SiteParameters.days + '</small> %H <small>' + SiteParameters.hours + '</small> %M <small>' + SiteParameters.minutes + '</small> %S <small>' + SiteParameters.seconds + '</small>'));
		});
	});
	var share_button_top = new Share(".share-button", {
		ui: {
			flyout: "top center",
			button_font: false,
			button_text: '',
			icon_font: false
		},
	});
	$(document).on('click', '.uncode-dot-irecommendthis', function() {
		var link = $(this),
			linkCounter = link.find('span.likes-counter');
		if (link.hasClass('active')) return false;
		var id = $(this).attr('id'),
			suffix = link.find('.dot-irecommendthis-suffix').text();
		$.post(dot_irecommendthis.ajaxurl, {
			action: 'uncode-dot-irecommendthis',
			recommend_id: id,
			suffix: suffix
		}, function(data) {
			var counter = $(data).text();
			linkCounter.html(counter);
			link.addClass('active').attr('title', 'You already recommended this');
		});
		return false;
	});

	this.get_scroll_offset = function() {

		var scroll_offset = 0;

		if ($('.menu-hide').length || $('.menu-hide-vertical').length) {
			if (UNCODE.bodyTop > UNCODE.wheight / 2) {
				UNCODE.hideMenu(100);
			}
		}

		UNCODE.scrolling = true;

		if (($('.menu-sticky').length && !$('.menu-hide').length) || ($('.menu-sticky-vertical').length && !$('.menu-hide-vertical').length)) {
			scroll_offset += UNCODE.menuMobileHeight;
		}

		scroll_offset += UNCODE.bodyBorder;

		return scroll_offset;
	}

	$('a[href*="#"]').click(function(e) {

		var hash = (e.currentTarget).hash,
		is_scrolltop = $(e.currentTarget).hasClass('scroll-top') ? true : false,
		anchor = '';
		if ($(e.currentTarget).data('toggle') == 'tab' || $(e.currentTarget).data('toggle') == 'collapse') return;
		if ($(e.currentTarget).hasClass('woocommerce-review-link')) {
			e.preventDefault();
			if (!$('#tab-reviews').is(':visible')) {
				$('a[href="#tab-reviews"]').trigger('click');
			}
			var calc_scroll = $('.wootabs .tab-content').offset().top;
			calc_scroll -= UNCODE.get_scroll_offset();

			var bodyTop = document.documentElement['scrollTop'] || document.body['scrollTop'],
				delta = bodyTop - calc_scroll,
				scrollSpeed = Math.abs(delta) / 2;
			if (scrollSpeed < 1000) scrollSpeed = 1000;

			setTimeout(function(){
				$('html, body').animate({
						scrollTop: calc_scroll
					}, scrollSpeed, 'easeInOutCubic', function() {
						UNCODE.scrolling = false;
					}
				);
			}, 200);
			return;
		}
		if (hash != undefined) {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var anchor = $(hash);
	      anchor = anchor.length ? anchor : this.hash.slice(1);
	    }
		}

		if (is_scrolltop || anchor != '') {
			if (is_scrolltop) {
				e.preventDefault();
				var bodyTop = document.documentElement['scrollTop'] || document.body['scrollTop'],
				scrollSpeed = Math.abs(bodyTop) / 2;
				if (scrollSpeed < 1000) scrollSpeed = 1000;
				$('html, body').animate({
					scrollTop: 0
				}, scrollSpeed, 'easeInOutCubic', function() {
					UNCODE.scrolling = false;
				});
			} else {
				var scrollSection = (typeof anchor === 'string') ? $('[data-name=' + anchor + ']') : anchor;
				$.each($('.menu-container .menu-item > a, .widget_nav_menu .menu-smart .menu-item > a'), function(index, val) {
					var get_href = $(val).attr('href');
					if (get_href.substring(get_href.indexOf('#')+1) == anchor) $(val).parent().addClass('active');
					else $(val).parent().removeClass('active');
				});
				if (scrollSection.length) {
					e.preventDefault();

					if (UNCODE.menuOpened) {
						if (UNCODE.wwidth < UNCODE.mediaQuery) window.dispatchEvent(UNCODE.menuMobileTriggerEvent);
						else $('.overlay-close').trigger('click');
					}

					var calc_scroll = scrollSection.offset().top;
					calc_scroll -= UNCODE.get_scroll_offset();

					var bodyTop = document.documentElement['scrollTop'] || document.body['scrollTop'],
						delta = bodyTop - calc_scroll,
						scrollSpeed = Math.abs(delta) / 2;
					if (scrollSpeed < 1000) scrollSpeed = 1000;

					$('html, body').animate({
						scrollTop: calc_scroll
					}, scrollSpeed, 'easeInOutCubic', function() {
						UNCODE.scrolling = false;
					});
				}
			}
		}
	});
	$('.header-scrolldown').on('click', function(event) {
		event.preventDefault();
		var pageHeader = $(event.target).closest('#page-header'),
			pageHeaderTop = pageHeader.offset().top,
			pageHeaderHeight = pageHeader.outerHeight(),
			scrollSpeed = Math.abs(pageHeaderTop + pageHeaderHeight) / 2;
		if (scrollSpeed < 1000) scrollSpeed = 1000;
		var calc_scroll = pageHeaderTop + pageHeaderHeight;
		calc_scroll -= UNCODE.get_scroll_offset();

		$('html, body').animate({
				scrollTop: calc_scroll
			}, scrollSpeed, 'easeInOutCubic', function() {
			UNCODE.scrolling = false;
		});

	});
	// TAB DATA-API
	// ============
	$(document).on('click.bs.tab.data-api', '[data-toggle="tab"], [data-toggle="pill"]', function(e) {
		e.preventDefault()
		$(this).tab('show');
		setTimeout(function() {
			window.dispatchEvent(UNCODE.boxEvent);
		}, 300);
	});
	// COLLAPSE DATA-API
	// =================
	$(document).on('click.bs.collapse.data-api', '[data-toggle="collapse"]', function(e) {
		var $this = $(this),
			href
		var target = $this.attr('data-target') || e.preventDefault() || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '') //strip for ie7
		var $target = $(target)
		var data = $target.data('bs.collapse')
		var option = data ? 'toggle' : $this.data()
		var parent = $this.attr('data-parent')
		var $parent = parent && $(parent)
		var $title = $(this).parent()
		if ($parent) {
			$parent.find('[data-toggle="collapse"][data-parent="' + parent + '"]').not($this).addClass('collapsed')
			if ($title.hasClass('active')) {
				$title.removeClass('active');
			} else {
				$parent.find('.panel-title').removeClass('active')
				$title[!$target.hasClass('in') ? 'addClass' : 'removeClass']('active')
			}
		}
		$this[$target.hasClass('in') ? 'addClass' : 'removeClass']('collapsed')
	});
	// FitText
	// =================
	window.uncode_textfill = function(el, loaded) {
		if (el == undefined) el = $('body');
		$.each($('.bigtext', el), function(index, val) {
			$(val).bigtext({
				minfontsize: 24
			});
			if (!$(val).parent().hasClass('blocks-animation') && !$(val).hasClass('animate_when_almost_visible')) $(val).css({
				opacity: 1
			});
			setTimeout(function() {
				if ($(val).find('.animate_when_almost_visible').length != 0) {
					$(val).css({opacity: 1});
				}
			}, 400);
		});
	}
	window.uncode_textfill();

	// Colomun hover effect
	// =================
	$(document).on('mouseenter', '.col-link', function(e) {
		var uncol = $(e.target).prev('.uncol'),
		el = uncol.find('.column-background');
		if (el) {
			$('.btn-container .btn', uncol).toggleClass('active');
			var elOverlay = $(el[0]).find('.block-bg-overlay');
			if (elOverlay.length) {
				var getOpacity = $(elOverlay).css('opacity');
				if (getOpacity != 1) {
					getOpacity = Math.round(getOpacity * 100) / 100;
					var newOpacity = getOpacity + .1;
					$(elOverlay).data('data-opacity', getOpacity);
					$(elOverlay).css('opacity', newOpacity);
				}
			}
		}
	}).on('mouseleave', '.col-link', function(e) {
		var uncol = $(e.target).prev('.uncol'),
		el = uncol.find('.column-background');
		$('.btn-container .btn', uncol).toggleClass('active');
		if (el) {
			var elOverlay = $(el[0]).find('.block-bg-overlay');
			if (elOverlay.length) {
				var getOpacity = $(elOverlay).data('data-opacity');
				$(elOverlay).css('opacity', getOpacity);
			}
		}
	});

	// REVSLIDER API
	// ============
	$(window).on("load", function() {
		$('.rev_slider_wrapper').each(function(){
			var $this = jQuery(this),
   		id_array = $this.attr("id").split("_"),
   		id = id_array[2];
   		if (id != undefined && id != '') {
				$.globalEval('revapi'+id+'.bind("revolution.slide.onloaded",function (e, data) { if (jQuery(e.currentTarget).closest(".header-revslider").length) { var style = jQuery(e.currentTarget).find("li").eq(0).attr("data-skin"), scrolltop = jQuery(document).scrollTop(); if (style != undefined) UNCODE.switchColorsMenu(scrolltop, style);}})');
				$.globalEval('revapi'+id+'.bind("revolution.slide.onchange",function (e,data) { if (jQuery(e.currentTarget).closest(".header-revslider").length) { var style = jQuery(e.currentTarget).find("li").eq(data.slideIndex - 1).attr("data-skin"), scrolltop = jQuery(document).scrollTop(); if (style != undefined) UNCODE.switchColorsMenu(scrolltop, style);}})');
   		}
		});
	});
	// Admin bar
	// ============
	$(window).resize(function() {
		if ($('html').hasClass('admin-mode')) {
			var getAdminBar = $('#wpadminbar');
			if (getAdminBar.length) {
				if (getAdminBar.css('position') !== 'hidden') {
					var getAdminBarHeight = getAdminBar.height();
					if (getAdminBar.css('position') === 'fixed') {
						$('html').css({'margin-top':getAdminBarHeight + 'px','padding-top': UNCODE.bodyBorder+'px'});
						$('.body-borders .top-border').css({'margin-top':getAdminBarHeight+'px'});
					} else {
						$('html').css({'padding-top':UNCODE.bodyBorder + 'px','margin-top':'0px'});
						$('.body-borders .top-border').css({'margin-top':'0px'});
					}
				}
			}
		}
	});
	// Facebook
	// ===========
 	this.fb_timeout = undefined;
	$(window).resize(function() {
		$('.facebook-object').each(function(index, el) {
			var el = $(el),
			parentWidth = el.closest('.tmb').width();
			el.width(parentWidth);
		});
		if (this.fb_timeout == undefined) {
			if ($('.facebook-object').length) {
				window.clearTimeout(this.fb_timeout);
				this.fb_timeout = window.setTimeout(function(msg) {
	      	window.dispatchEvent(UNCODE.boxEvent);
	    	}, 1000);
			}
		}
	});
}

UNCODE.menuSystem = function() {

	function menuMobile() {
		var $mobileToggleButton = $('.mobile-menu-button'),
			$box,
			$el,
			elHeight,
			check,
			animating = false,
			stickyMobile = false;
		UNCODE.menuOpened = false;
			//browserToolbar = 56;
		$mobileToggleButton.on('click', function(event) {
			var btn = this;
			if ($(btn).hasClass('overlay-close')) return;
			event.preventDefault();
			if (UNCODE.wwidth < UNCODE.mediaQuery) {
				$box = $(this).closest('.box-container').find('.main-menu-container'),
					$el = $(this).closest('.box-container').find('.menu-horizontal-inner:not(.row-brand), .menu-sidebar-inner');
				if (UNCODE.isMobile && $('.menu-wrapper.menu-sticky, .menu-wrapper.menu-hide-only, .main-header .menu-sticky-vertical, .main-header .menu-hide-only-vertical').length) {
					stickyMobile = true;
					elHeight = window.innerHeight - UNCODE.menuMobileHeight - (UNCODE.bodyBorder * 2) - UNCODE.adminBarHeight + 1;
				} else {
					elHeight = 0;
					$.each($el, function(index, val) {
						elHeight += $(val).outerHeight();
					});
				}
				var open = function() {
					if (!animating) {
						animating = true;
						UNCODE.menuOpened = true;
						if ($('body[class*="vmenu-"], body.hmenu-center').length && ($('.menu-hide, .menu-sticky').length)) {
							$('.main-header > .vmenu-container').css({position:'fixed', top: ($('.menu-container').outerHeight() + UNCODE.bodyBorder + UNCODE.adminBarHeight) + 'px'});
							$('.menu-container:not(.sticky-element):not(.isotope-filters)').css({position:'fixed'});
						}
						if ($('body.hmenu-center').length && ($('.menu-hide, .menu-sticky').length)) {
							$('.menu-container:not(.sticky-element):not(.isotope-filters)').css({position:'fixed', top: (UNCODE.menuMobileHeight + UNCODE.bodyBorder + UNCODE.adminBarHeight) + 'px'});
						}
						btn.classList.add('close');
						$box.addClass('open-items');
						$box.animate({
							height: elHeight
						}, 600, "easeInOutCirc", function() {
							animating = false;
							if (!stickyMobile) $box.css('height', 'auto');
						});
					}
				};

				var close = function() {
					if (!animating) {
						animating = true;
						UNCODE.menuOpened = false;
						btn.classList.remove('close');
						btn.classList.add('closing');
						$box.addClass('close');
						setTimeout(function() {
							$box.removeClass('close');
							$box.removeClass('open-items');
							btn.classList.remove('closing');
						}, 500);
						$box.animate({
							height: 0
						}, {
							duration: 600,
							easing: "easeInOutCirc",
							complete: function(elements) {
								$(elements).css('height', '');
								animating = false;
								if ($('body[class*="vmenu-"]').length) $('.main-header > .vmenu-container').css('position','relative');
							}
						});
					}
				};
				check = (!UNCODE.menuOpened) ? open() : close();
			}
		});
		window.addEventListener('menuMobileTrigged', function(e) {
			$mobileToggleButton.trigger('click');
		});
		window.addEventListener("resize", function() {
			if ($(window).width() < UNCODE.mediaQuery) {
				if (UNCODE.isMobile) {
					var $box = $('.box-container .main-menu-container'),
						$el = $('.box-container .menu-horizontal-inner, .box-container .menu-sidebar-inner');
					if ($($box).length && $($box).hasClass('open-items') && $($box).css('height') != 'auto') {
						if ($('.menu-wrapper.menu-sticky, .menu-wrapper.menu-hide-only').length) {
							elHeight = 0;
							$.each($el, function(index, val) {
								elHeight += $(val).outerHeight();
							});
							elHeight = window.innerHeight - $('.menu-wrapper.menu-sticky .menu-wrapper.menu-sticky .menu-container .row-menu-inner, .menu-wrapper.menu-hide-only .menu-wrapper.menu-sticky .menu-container .row-menu-inner').height() - (UNCODE.bodyBorder * 2) + 1;
							$($box).css('height', elHeight + 'px');
						}
					}
				}
			} else {
				$('.menu-hide-vertical').removeAttr('style');
				$('.menu-container-mobile').removeAttr('style');
				$('.vmenu-container.menu-container').removeAttr('style');
			}
		});
	};

	function menuOffCanvas() {
		$('.menu-primary .menu-button-offcanvas').click(function(event) {
			if ($(window).width() > UNCODE.mediaQuery) {
				if ($(event.currentTarget).hasClass('close')) {
					$(event.currentTarget).removeClass('close');
					$(event.currentTarget).addClass('closing');
					setTimeout(function() {
						$(event.currentTarget).removeClass('closing');
					}, 500);
				} else $(event.currentTarget).addClass('close');
			}
			$('body').toggleClass('off-opened');
		});
	};
	function menuSmart() {
		if ($('[class*="menu-smart"]').length > 0) {
			$('[class*="menu-smart"]').smartmenus({
				subIndicators: false,
				subIndicatorsPos: 'append',
				subMenusMinWidth: '13em',
				subIndicatorsText: '',
				showTimeout: 50,
				hideTimeout: 50,
				showFunction: function($ul, complete) {
					$ul.fadeIn(0, 'linear', complete);
				},
				hideFunction: function($ul, complete) {
					var fixIE = $('html.ie').length;
					if (fixIE) {
						var $rowParent = $($ul).closest('.main-menu-container');
						$rowParent.height('auto');
					}
					$ul.fadeOut(0, 'linear', complete);
				},
				collapsibleShowFunction: function($ul, complete) {
					$ul.slideDown(400, 'easeInOutCirc', function() {
				12});
				},
				collapsibleHideFunction: function($ul, complete) {
					$ul.slideUp(200, 'easeInOutCirc', complete);
				},
				hideOnClick: true
			});
		}
	};
	function menuOverlay() {
		if ($('.overlay-sequential, .menu-mobile-animated').length > 0) {
			$('.overlay-sequential .menu-smart > li, .menu-sticky .menu-container .menu-smart > li, .menu-hide.menu-container .menu-smart > li, .vmenu-container .menu-smart > li').each(function(index, el) {
				var transDelay = (index / 20) + 0.1;
				$(this)[0].setAttribute('style', '-webkit-transition-delay:' + transDelay + 's; -moz-transition-delay:' + transDelay + 's; -ms-transition-delay:' + transDelay + 's; -o-transition-delay:' + transDelay + 's; transition-delay:' + transDelay + 's');
			});
		}
	};
	//menuMobileButton();
	menuMobile();
	menuOffCanvas();
	menuSmart();
	menuOverlay();
};

UNCODE.okvideo = function() {
	var BLANK_GIF = "data:image/gif;base64,R0lGODlhAQABAPABAP///wAAACH5BAEKAAAALAAAAAABAAEAAAICRAEAOw%3D%3D";
	$.okvideo = function(options) {
		// if the option var was just a string, turn it into an object
		if (typeof options !== 'object') options = {
			'video': options
		};
		var base = this;
		// kick things off
		base.init = function() {
			base.options = $.extend({}, $.okvideo.options, options);
			// support older versions of okvideo
			if (base.options.video === null) base.options.video = base.options.source;
			base.setOptions();
			var target = base.options.target || $('body');
			var position = target[0] == $('body')[0] ? 'fixed' : 'absolute';
			var zIndex = base.options.controls === 3 ? -999 : "auto";
			if ($('#okplayer-' + base.options.id).length == 0) { //base.options.id = String(Math.round(Math.random() * 100000));
				var mask = '<div id="okplayer-mask-' + base.options.id + '" style="position:' + position + ';left:0;top:0;overflow:hidden;z-index:-998;height:100%;width:100%;"></div>';
				if (OKEvents.utils.isMobile()) {
					target.append('<div id="okplayer-' + base.options.id + '" style="position:' + position + ';left:0;top:0;overflow:hidden;z-index:' + zIndex + ';height:100%;width:100%;"></div>');
				} else {
					if (base.options.controls === 3) {
						target.append(mask)
					}
					if (base.options.adproof === 1) {
						target.append('<div id="okplayer-' + base.options.id + '" style="position:' + position + ';left:-10%;top:-10%;overflow:hidden;z-index:' + zIndex + ';height:120%;width:120%;"></div>');
					} else {
						target.append('<div id="okplayer-' + base.options.id + '" style="position:' + position + ';left:0;top:0;overflow:hidden;z-index:' + zIndex + ';height:100%;width:100%;"></div>');
					}
				}
				$("#okplayer-mask-" + base.options.id).css("background-image", "url(" + BLANK_GIF + ")");
				if (base.options.playlist.list === null) {
					if (base.options.video.provider === 'youtube') {
						base.loadYouTubeAPI();
					} else if (base.options.video.provider === 'vimeo') {
						base.options.volume /= 100;
						base.loadVimeoAPI();
					}
				} else {
					base.loadYouTubeAPI();
				}
			}
		};
		// clean the options
		base.setOptions = function() {
			// exchange 'true' for '1' and 'false' for 3
			for (var key in this.options) {
				if (this.options[key] === true) this.options[key] = 1;
				if (this.options[key] === false) this.options[key] = 3;
			}
			if (base.options.playlist.list === null) {
				base.options.video = base.determineProvider();
			}
			// pass options to the window
			$(window).data('okoptions-' + base.options.id, base.options);
		};
		// insert js into the head and exectue a callback function
		base.insertJS = function(src, callback){
      var tag = document.createElement('script');
      if (callback){
        if (tag.readyState){  //IE
          tag.onreadystatechange = function(){
            if (tag.readyState === "loaded" ||
                tag.readyState === "complete"){
              tag.onreadystatechange = null;
              callback();
            }
          };
        } else {
          tag.onload = function() {
            callback();
          };
        }
      }
      tag.src = src;
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    };
		// load the youtube api
		base.loadYouTubeAPI = function(callback) {
			base.insertJS('https://www.youtube.com/player_api');
		};
		base.loadYouTubePlaylist = function() {
			player.loadPlaylist(base.options.playlist.list, base.options.playlist.index, base.options.playlist.startSeconds, base.options.playlist.suggestedQuality);
		};
		// load the vimeo api by replacing the div with an iframe and loading js
		base.loadVimeoAPI = function() {
			var source = '//player.vimeo.com/video/' + base.options.video.id + '?api=1&title=0&byline=0&portrait=0&playbar=0&loop=' + base.options.loop + '&autoplay=' + (base.options.autoplay === 1 ? 1 : 0) + '&player_id=okplayer-' + base.options.id,
			jIframe = $('<iframe data-src="'+source+'" frameborder="0" id="okplayer-' + base.options.id +'" style="visibility: hidden;" class="vimeo-background" />');
			$(window).data('okoptions-' + base.options.id).jobject = jIframe;
			$('#okplayer-' + base.options.id).replaceWith(jIframe[0]);
			base.insertJS('//origin-assets.vimeo.com/js/froogaloop2.min.js', function() {
				vimeoPlayerReady(base.options.id);
			});
		};
		// is it from youtube or vimeo?
		base.determineProvider = function() {
			var a = document.createElement('a');
			a.href = base.options.video;
			if (/youtube.com/.test(base.options.video) || /youtu.be/.test(base.options.video)) {
				var videoid = a.href.split('/')[3].toString();
				var query = videoid.substring(videoid.indexOf('?') + 1);
				if (query != '') {
					var vars = query.split('&');
					for (var i = 0; i < vars.length; i++) {
						var pair = vars[i].split('=');
						if (pair[0] == 'v') {
							videoid = pair[1];
						}
					}
				}
				return {
					"provider": "youtube",
					"id": videoid
				};
			} else if (/vimeo.com/.test(base.options.video)) {
				return {
					"provider": "vimeo",
					"id": (a.href.split('/')[3].toString()).split('#')[0],
				};
			} else if (/[-A-Za-z0-9_]+/.test(base.options.video)) {
				var id = new String(base.options.video.match(/[-A-Za-z0-9_]+/));
				if (id.length == 11) {
					return {
						"provider": "youtube",
						"id": id.toString()
					};
				} else {
					for (var i = 0; i < base.options.video.length; i++) {
						if (typeof parseInt(base.options.video[i]) !== "number") {
							throw 'not vimeo but thought it was for a sec';
						}
					}
					return {
						"provider": "vimeo",
						"id": base.options.video
					};
				}
			} else {
				throw "OKVideo: Invalid video source";
			}
		};
		base.init();
	};
	$.okvideo.options = {
		id: null,
		source: null, // Deprecate dis l8r
		video: null,
		playlist: { // eat ur heart out @brokyo
			list: null,
			index: 0,
			startSeconds: 0,
			suggestedQuality: "default" // options: small, medium, large, hd720, hd1080, highres, default
		},
		disableKeyControl: 1,
		captions: 0,
		loop: 1,
		hd: 1,
		volume: 0,
		adproof: false,
		unstarted: null,
		onFinished: null,
		onReady: null,
		onPlay: null,
		onPause: null,
		buffering: null,
		controls: false,
		autoplay: true,
		annotations: true,
		cued: null
	};
	$.fn.okvideo = function(options) {
		options.target = this;
		return this.each(function() {
			(new $.okvideo(options));
		});
	};

	$(".no-touch .uncode-video-container.video").each(function(index, el) {
		var $this = $(this),
			url = $this.attr('data-video'),
			id = $this.attr('data-id'),
			cloned = $this.closest('.owl-item');
		if (!cloned.hasClass('cloned') || cloned.length == 0) {
			$this.okvideo({
				id: id,
				source: url.split('#')[0],
				time: ((url).indexOf("#") > -1) ? (url).substring((url).indexOf('#') + 1) : null,
				autoplay: 1,
				controls: 0,
				volume: 0,
				adproof: 0,
				caller: $this,
				hd: 1,
				onReady: function(player) {
					var getPlayer = player.c || player,
					getContainer = $(getPlayer).closest('.background-element');
					if (getContainer.length) {
						UNCODE.initVideoComponent(getContainer[0], '.uncode-video-container.video');
					}
				}
			});
		}
	});
	$(".no-touch .background-video-shortcode").each(function(index, el) {
		var video_id = $(this).attr('id');
		if (typeof MediaElement === "function") {
			new MediaElement(video_id, {
				startVolume: 0,
				loop: true,
				success: function(mediaElement, domObject) {
					domObject.volume = 0;
					$(mediaElement).data('started', false);
					mediaElement.addEventListener('timeupdate', function(e) {
						if (!$(e.target).data('started')) {
							$(mediaElement).data('started', true);
							$(mediaElement).closest('.uncode-video-container').css('opacity', '1');
						}
					});
					if (!UNCODE.isMobile) {
						setTimeout(function() {
							UNCODE.initVideoComponent(document.body, '.uncode-video-container.video, .uncode-video-container.self-video');
						}, 100);
					}
					mediaElement.play();
				},
				// fires when a problem is detected
				error: function() {}
			});
		}
	});
};

UNCODE.disableHoverScroll = function() {

    if (!UNCODE.isMobile) {
        var body = document.body,
        timer;

        window.addEventListener('scroll', function() {
            clearTimeout(timer);
            if (body.classList)  {
                if (!body.classList.contains('disable-hover')) {
                    body.classList.add('disable-hover')
                }

                timer = setTimeout(function() {
                    body.classList.remove('disable-hover')
                }, 300);
            }
        }, false);
    }
};


UNCODE.isotopeLayout = function() {
	if ($('.isotope-layout').length > 0) {
		var isotopeContainersArray = [],
			typeGridArray = [],
			layoutGridArray = [],
			screenLgArray = [],
			screenMdArray = [],
			screenSmArray = [],
			transitionDuration = [],
			$filterItems = [],
			$filters = $('.isotope-filters'),
			$itemSelector = '.tmb',
			$items,
			itemMargin,
			correctionFactor = 0,
			firstLoad = true,
			isOriginLeft = $('body').hasClass('rtl') ? false : true;
		$('[class*="isotope-container"]').each(function() {
			var isoData = $(this).data(),
			$data_lg,
			$data_md,
			$data_sm;
			if (isoData.lg !== undefined) $data_lg = $(this).attr('data-lg');
			else $data_lg = '1000';
			if (isoData.md !== undefined) $data_md = $(this).attr('data-md');
			else $data_md = '600';
			if (isoData.sm !== undefined) $data_sm = $(this).attr('data-sm');
			else $data_sm = '480';
			screenLgArray.push($data_lg);
			screenMdArray.push($data_md);
			screenSmArray.push($data_sm);
			transitionDuration.push($('.t-inside.animate_when_almost_visible', this).length > 0 ? 0 : '0.5s');
			if (isoData.type == 'metro') typeGridArray.push(true);
			else typeGridArray.push(false);
			if (isoData.layout !== undefined) layoutGridArray.push(isoData.layout);
			else layoutGridArray.push('masonry');
			isotopeContainersArray.push($(this));
		});
		var colWidth = function(index) {
				$(isotopeContainersArray[index]).width('');
				var isPx = $(isotopeContainersArray[index]).parent().hasClass('px-gutter'),
					widthAvailable = $(isotopeContainersArray[index]).width(),
					columnNum = 12,
					columnWidth = 0;

				if (isPx) {
					columnWidth = Math.ceil(widthAvailable / columnNum);
					$(isotopeContainersArray[index]).width(columnNum * Math.ceil(columnWidth));
				} else {
					columnWidth = ($('html.firefox').length) ? Math.floor(widthAvailable / columnNum) : widthAvailable / columnNum;
				}
				$items = $(isotopeContainersArray[index]).find('.tmb:not(.tmb-carousel)');
				itemMargin = parseInt($(isotopeContainersArray[index]).find('.t-inside').css("margin-top"));
				for (var i = 0, len = $items.length; i < len; i++) {
					var $item = $($items[i]),
						multiplier_w = $item.attr('class').match(/tmb-iso-w(\d{0,2})/),
						multiplier_h = $item.attr('class').match(/tmb-iso-h(\d{0,2})/);

					if (widthAvailable >= screenMdArray[index] && widthAvailable < screenLgArray[index]) {
						if (multiplier_w != null && multiplier_w[1] !== undefined) {
							switch (parseInt(multiplier_w[1])) {
								case (5):
								case (4):
								case (3):
									if (typeGridArray[index]) multiplier_h[1] = (6 * multiplier_h[1]) / multiplier_w[1];
									multiplier_w[1] = 6;
									break;
								case (2):
								case (1):
									if (typeGridArray[index]) multiplier_h[1] = (3 * multiplier_h[1]) / multiplier_w[1];
									multiplier_w[1] = 3;
									break;
								default:
									if (typeGridArray[index]) multiplier_h[1] = (12 * multiplier_h[1]) / multiplier_w[1];
									multiplier_w[1] = 12;
									break;
							}
						}
					} else if (widthAvailable >= screenSmArray[index] && widthAvailable < screenMdArray[index]) {
						if (multiplier_w != null && multiplier_w[1] !== undefined) {
							switch (parseInt(multiplier_w[1])) {
								case (5):
								case (4):
								case (3):
								case (2):
								case (1):
									if (typeGridArray[index]) multiplier_h[1] = (6 * multiplier_h[1]) / multiplier_w[1];
									multiplier_w[1] = 6;
									break;
								default:
									if (typeGridArray[index]) multiplier_h[1] = (12 * multiplier_h[1]) / multiplier_w[1];
									multiplier_w[1] = 12;
									break;
							}
						}
					} else if (widthAvailable < screenSmArray[index]) {
						if (multiplier_w != null && multiplier_w[1] !== undefined) {
							//if (typeGridArray[index]) multiplier_h[1] = (12 * multiplier_h[1]) / multiplier_w[1];
							multiplier_w[1] = 12;
							if (typeGridArray[index]) multiplier_h[1] = 12;
						}
					}
					var width = multiplier_w ? (columnWidth * multiplier_w[1]) : columnWidth,
						height = multiplier_h ? Math['ceil']((2 * Math.ceil(columnWidth / 2)) * multiplier_h[1]) - itemMargin : columnWidth;

					if (width >= widthAvailable) {
						$item.css({
							width: widthAvailable
						});
						if (typeGridArray[index]) {
							$item.children().add($item.find('.backimg')).css({
								height: height
							});
						}
					} else {
						$item.css({
							width: width
						});
						if (typeGridArray[index]) {
							$item.children().add($item.find('.backimg')).css({
								height: height
							});
						}
					}
				}
				return columnWidth;
			},
			init_isotope = function() {
				for (var i = 0, len = isotopeContainersArray.length; i < len; i++) {
					var isotopeSystem = $(isotopeContainersArray[i]).closest($('.isotope-system')),
						isotopeId = isotopeSystem.attr('id'),
						$layoutMode = layoutGridArray[i];
					$(isotopeContainersArray[i]).isotope({
						//resizable: true,
						itemSelector: $itemSelector,
						layoutMode: $layoutMode,
						transitionDuration: transitionDuration[i],
						masonry: {
							columnWidth: colWidth(i)
						},
						vertical: {
							horizontalAlignment: 0.5,
						},
						sortBy: 'original-order',
						isOriginLeft: isOriginLeft
					}).on('layoutComplete', onLayout($(isotopeContainersArray[i]), 0));
					if ($(isotopeContainersArray[i]).hasClass('isotope-infinite')) {
						$(isotopeContainersArray[i]).infinitescroll({
								navSelector: '#' + isotopeId + ' .loadmore-button', // selector for the pagination container
								nextSelector: '#' + isotopeId + ' .loadmore-button a', // selector for the NEXT link (to page 2)
								itemSelector: '#' + isotopeId + ' .isotope-layout .tmb, #' + isotopeId + ' .isotope-filters li', // selector for all items you'll retrieve
								animate: false,
								behavior: 'local',
								debug: false,
								loading: {
									selector: '#' + isotopeId + '.isotope-system .isotope-footer-inner',
									speed: 0,
									finished: undefined,
									msg: $('#' + isotopeId + ' .loadmore-button'),
								},
								errorCallback: function() {
									var isotope_system = $(this).closest('.isotope-system');
									$('.loading-button', isotope_system).hide();
									$('.loadmore-button', isotope_system).attr('style', 'display:none !important');
								}
							},
							// append the new items to isotope on the infinitescroll callback function.
							function(newElements, opts) {
								var $isotope = $(this),
									isotopeId = $isotope.closest('.isotope-system').attr('id'),
									filters = new Array(),
									$loading_button = $isotope.closest('.isotope-system').find('.loading-button'),
									$infinite_button = $isotope.closest('.isotope-system').find('.loadmore-button'),
									$numPages = $('a', $infinite_button).data('pages'),
									delay = 300;
								$('a', $infinite_button).html($('a', $infinite_button).data('label'));
								$infinite_button.show();
								$loading_button.hide();
								if ( $numPages != undefined && opts.state.currPage == $numPages) $infinite_button.hide();
								$('> li', $isotope).remove();
								$.each($(newElements), function(index, val) {
									if ($(val).is("li")) {
										filters.push($(val)[0]);
									}
								});
								newElements = newElements.filter(function(x) {
									return filters.indexOf(x) < 0
								});
								$.each($(filters), function(index, val) {
									if ($('#' + isotopeId + ' a[data-filter="' + $('a', val).attr('data-filter') + '"]').length == 0) $('#' + isotopeId + ' .isotope-filters ul').append($(val));
								});
								$isotope.isotope('reloadItems', onLayout($isotope, newElements.length));
							});
						if ($(isotopeContainersArray[i]).hasClass('isotope-infinite-button')) {
							var $infinite_isotope = $(isotopeContainersArray[i]),
								$infinite_button = $infinite_isotope.closest('.isotope-system').find('.loadmore-button a');
							$infinite_isotope.infinitescroll('pause');
							$infinite_button.on('click', function(event) {
								event.preventDefault();
								var $infinite_system = $(event.target).closest('.isotope-system'),
								$infinite_isotope = $infinite_system.find('.isotope-container'),
								isotopeId = $infinite_system.attr('id');
								$(event.currentTarget).html('Loading…');
								$infinite_isotope.infinitescroll('resume');
								$infinite_isotope.infinitescroll('retrieve');
								$infinite_isotope.infinitescroll('pause');
							});
						}
					}
				}
			},
			onLayout = function(isotopeObj, startIndex) {
				isotopeObj.css('opacity', 1);
				isotopeObj.closest('.isotope-system').find('.isotope-footer').css('opacity', 1);
				setTimeout(function() {
					window.dispatchEvent(UNCODE.boxEvent);
					UNCODE.adaptive();
					$(isotopeObj).find('audio,video').each(function() {
						$(this).mediaelementplayer({
 							pauseOtherPlayers: false,
						});
					});
					if ($(isotopeObj).find('.nested-carousel').length) {
						UNCODE.carousel($(isotopeObj).find('.nested-carousel'));
						setTimeout(function() {
							boxAnimation($('.tmb', isotopeObj), startIndex, true, isotopeObj);
						}, 200);
					} else {
						boxAnimation($('.tmb', isotopeObj), startIndex, true, isotopeObj);
					}
				}, 100);
			},
			boxAnimation = function(items, startIndex, sequential, container) {
				var $allItems = items.length - startIndex,
					showed = 0,
					index = 0;
				if (container.closest('.owl-item').length == 1) return false;
				$.each(items, function(index, val) {
					var elInner = $('> .t-inside', val);
					if (val[0]) val = val[0];
					if (elInner.hasClass('animate_when_almost_visible') && !elInner.hasClass('force-anim')) {
						new Waypoint({
							element: val,
							handler: function() {
								var element = $('> .t-inside', this.element),
									parent = $(this.element),
									currentIndex = parent.index();
								var delay = (!sequential) ? index : ((startIndex !== 0) ? currentIndex - $allItems : currentIndex),
									delayAttr = parseInt(element.attr('data-delay'));
								if (isNaN(delayAttr)) delayAttr = 100;
								delay -= showed;
								var objTimeout = setTimeout(function() {
									element.removeClass('zoom-reverse').addClass('start_animation');
									showed = parent.index();
								}, delay * delayAttr)
								parent.data('objTimeout', objTimeout);
								this.destroy();
							},
							offset: '100%'
						})
					} else {
						if (elInner.hasClass('force-anim')) {
							elInner.addClass('start_animation');
						} else {
							elInner.css('opacity', 1);
						}
					}
					index++;
				});
			};
		if ($('.isotope-pagination').length > 0) {
			$('.isotope-system').on('click', '.pagination a', function(evt) {
				evt.preventDefault();
				var filterContainer = $(this).closest('.isotope-system').find('.isotope-filters'),
				container = $(this).closest('.isotope-system'),
				calc_scroll = container.closest('.uncol').offset().top - (!filterContainer.hasClass('with-bg') ? filterContainer.outerHeight(true) - $('.filter-show-all a', filterContainer).height() : 0);
				calc_scroll -= UNCODE.get_scroll_offset();

				var bodyTop = document.documentElement['scrollTop'] || document.body['scrollTop'],
					delta = bodyTop - calc_scroll,
					scrollSpeed = Math.abs(delta) / 2;
				if (scrollSpeed < 1000) scrollSpeed = 1000;

				$('html, body').animate({
					scrollTop: calc_scroll
				},{
					easing: 'easeInOutQuad',
					duration: scrollSpeed,
					complete: function(){
						UNCODE.scrolling = false;
					}
				});
				loadIsotope($(this));
				evt.preventDefault();
			});
		}
		$filters.on('click', 'a', function(evt) {
			var $filter = $(this),
				filterContainer = $filter.closest('.isotope-filters'),
				filterValue = $filter.attr('data-filter'),
				container = $filter.closest('.isotope-system').find($('.isotope-layout')),
				transitionDuration = container.data().isotope.options.transitionDuration,
				delay = 300,
				filterItems = [];
			if (!$filter.hasClass('active')) {
				/** Scroll top with filtering */
				if (filterContainer.hasClass('filter-scroll')) {
					var calc_scroll = container.closest('.uncol').offset().top - (!filterContainer.hasClass('with-bg') ? filterContainer.outerHeight(true) - $('.filter-show-all a', filterContainer).height() : 0);
					calc_scroll -= UNCODE.get_scroll_offset();

					var bodyTop = document.documentElement['scrollTop'] || document.body['scrollTop'],
						delta = bodyTop - calc_scroll,
						scrollSpeed = Math.abs(delta) / 2;
					if (scrollSpeed < 1000) scrollSpeed = 1000;

					$('html, body').animate({
						scrollTop: calc_scroll
					}, scrollSpeed, 'easeInOutQuad');
				}
				if (filterValue !== undefined) {
					$.each($('> .tmb > .t-inside', container), function(index, val) {
						var parent = $(val).parent(),
							objTimeout = parent.data('objTimeout');
						if (objTimeout) {
							$(val).removeClass('zoom-reverse').removeClass('start_animation')
							clearTimeout(objTimeout);
						}
						if (transitionDuration == 0) {
							if ($(val).hasClass('animate_when_almost_visible')) {
								$(val).addClass('zoom-reverse').removeClass('start_animation');
							} else {
								$(val).addClass('animate_when_almost_visible zoom-reverse zoom-anim force-anim');
							}
						}
					});
					setTimeout(function() {
						container.isotope({
							filter: function() {
								var block = $(this),
								filterable = (filterValue == '*') || block.hasClass(filterValue),
								lightboxElements = $('[data-lbox^=ilightbox]', block);
								if (filterable) {
									if (lightboxElements.length) {
										lightboxElements.removeClass('lb-disabled');
										container.data('lbox', $(lightboxElements[0]).data('lbox'));
									}
									filterItems.push(block);
								} else {
									if (lightboxElements.length) lightboxElements.addClass('lb-disabled');
								}
								return filterable;
							}
						});
						$('.t-inside.zoom-reverse', container).removeClass('zoom-reverse');
					}, delay);
					/** once filtered - start **/
					container.isotope('once', 'arrangeComplete', function() {
						var getLightbox = UNCODE.lightboxArray[container.data('lbox')];
						if (typeof getLightbox === 'object') getLightbox.refresh();
						if (transitionDuration == 0) {
							setTimeout(function() {
								boxAnimation(filterItems, 0, false, container);
							}, 100);
						}
					});
					/** once filtered - end **/
				} else {
					$.each($('> .tmb > .t-inside', container), function(index, val) {
						var parent = $(val).parent(),
							objTimeout = parent.data('objTimeout');
						if (objTimeout) {
							$(val).removeClass('zoom-reverse').removeClass('start_animation')
							clearTimeout(objTimeout);
						}
						if (transitionDuration == 0) {
							if ($(val).hasClass('animate_when_almost_visible')) {
								$(val).addClass('zoom-reverse').removeClass('start_animation');
							} else {
								$(val).addClass('animate_when_almost_visible zoom-reverse zoom-anim force-anim');
							}
						}
					});
					container.parent().addClass('isotope-loading');
					loadIsotope($filter);
				}
			}
			evt.preventDefault();
		});
		$(window).on("popstate", function(e) {
			if (e.originalEvent.state === null) return;
			var params = {};
			if (location.search) {
				var parts = location.search.substring(1).split('&');
				for (var i = 0; i < parts.length; i++) {
					var nv = parts[i].split('=');
					if (!nv[0]) continue;
					params[nv[0]] = nv[1] || true;
				}
			}
			if (params.id === undefined) {
				$.each($('.isotope-system'), function(index, val) {
					loadIsotope($(val));
				});
			} else loadIsotope($('#' + params.id));
		});

		var loadIsotope = function($href) {
			var href = ($href.is("a") ? $href.attr('href') : location),
				isotopeSystem = ($href.is("a") ? $href.closest($('.isotope-system')) : $href),
				isotopeWrapper = isotopeSystem.find($('.isotope-wrapper')),
				isotopeFooter = isotopeSystem.find($('.isotope-footer-inner')),
				isotopeContainer = isotopeSystem.find($('.isotope-layout')),
				isotopeId = isotopeSystem.attr('id');
			if ($href.is("a")) history.pushState({
				myIsotope: true
			}, document.title, href);
			$.ajax({
				url: href
			}).done(function(data) {
				var $resultItems = $(data).find('#' + isotopeId + ' .isotope-layout').html(),
					$resultPagination = $(data).find('#' + isotopeId + ' .pagination');
				isotopeWrapper.addClass('isotope-reloaded');
				setTimeout(function() {
					isotopeWrapper.removeClass('isotope-loading');
					isotopeWrapper.removeClass('isotope-reloaded');
				}, 500);
				$.each($('> .tmb > .t-inside', isotopeContainer), function(index, val) {
					var parent = $(val).parent(),
						objTimeout = parent.data('objTimeout');
					if (objTimeout) {
						$(val).removeClass('zoom-reverse').removeClass('start_animation')
						clearTimeout(objTimeout);
					}
					if ($(val).hasClass('animate_when_almost_visible')) {
						$(val).addClass('zoom-reverse').removeClass('start_animation');
					} else {
						$(val).addClass('animate_when_almost_visible zoom-reverse zoom-in force-anim');
					}
				});
				setTimeout(function() {
					if (isotopeContainer.data('isotope')) {
						isotopeContainer.html($resultItems).isotope('reloadItems', onLayout(isotopeContainer, 0));
						UNCODE.adaptive();
						var getLightbox = UNCODE.lightboxArray['ilightbox_' + isotopeContainer.closest('.isotope-system').attr('id')];
						if (typeof getLightbox === 'object') getLightbox.refresh();
					}
				}, 300);
				$('.pagination', isotopeFooter).remove();
				isotopeFooter.append($resultPagination);
			});
		};
		$filters.each(function(i, buttonGroup) {
			var $buttonGroup = $(buttonGroup);
			$buttonGroup.on('click', 'a', function() {
				$buttonGroup.find('.active').removeClass('active');
				$(this).addClass('active');
			});
		});
		window.addEventListener('boxResized', function(e) {
			$.each($('.isotope-layout'), function(index, val) {
				var $layoutMode = ($(this).data('layout'));
				if ($layoutMode === undefined) $layoutMode = 'masonry';
				if ($(this).data('isotope')) {
					$(this).isotope({
						itemSelector: $itemSelector,
						layoutMode: $layoutMode,
						transitionDuration: transitionDuration[index],
						masonry: {
							columnWidth: colWidth(index)
						},
						vertical: {
							horizontalAlignment: 0.5,
						},
						sortBy: 'original-order',
						isOriginLeft: isOriginLeft
					});
					$(this).isotope('unbindResize');
				}
				$(this).find('.mejs-video,.mejs-audio').each(function() {
					$(this).trigger('resize');
				});
			});
		}, false);
		init_isotope();
	};
}

UNCODE.lightbox = function() {
	UNCODE.lightboxArray = {};
	setTimeout(function() {
		var groupsArr = {};
		$('[data-lbox^=ilightbox]:not(.lb-disabled)').each(function() {
			var group = this.getAttribute("data-lbox"),
				values = $(this).data();
			groupsArr[group] = values;
		});
		for (var i in groupsArr) {
			var skin = groupsArr[i].skin || 'black',
				path = groupsArr[i].dir || 'horizontal',
				thumbs = !groupsArr[i].notmb || false,
				arrows = !groupsArr[i].noarr || false,
				social = groupsArr[i].social || false,
				deeplink = groupsArr[i].deep || false,
				counter = $('[data-lbox="' + i + '"]:not(.lb-disabled)').length;
			if (social) social = {
				facebook: true,
				twitter: true,
				googleplus: true,
				reddit: true,
				digg: true,
				delicious: true
			};
			UNCODE.lightboxArray[i] = $('[data-lbox="' + i + '"]:not(.lb-disabled)').iLightBox({
				skin: skin,
				path: path,
				linkId: deeplink,
				infinite: false,
				//fullViewPort: 'fit',
				smartRecognition: false,
				fullAlone: false,
				maxScale: 1,
				minScale: .02,
				//fullStretchTypes: 'flash, video',
				overlay: {
					opacity: .94
				},
				controls: {
					arrows: (counter > 1 ? arrows : false),
					fullscreen: true,
					thumbnail: thumbs,
					slideshow: (counter > 1 ? true : false)
				},
				show: {
					speed: 200
				},
				hide: {
					speed: 200
				},
				social: {
					start: false,
					buttons: social
				},
				caption: {
					start: false
				},
				styles: {
					nextOpacity: 1,
					nextScale: 1,
					prevOpacity: 1,
					prevScale: 1
				},
				effects: {
					switchSpeed: 400
				},
				slideshow: {
					pauseTime: 5000
				},
				thumbnails: {
					maxWidth: 60,
					maxHeight: 60,
					activeOpacity: .2
				},
				html5video: {
					preload: true
				}
			});
		};
	}, 100);
};

UNCODE.backVideo = function() {
	$(function() {
		$.each($('.background-video-shortcode'), function() {
			var video_id = $(this).attr('id');
			if (typeof MediaElement === "function") {
				new MediaElement(video_id, {
					startVolume: 0,
					loop: true,
					success: function(mediaElement, domObject) {
						mediaElement.play();
						$(mediaElement).closest('.uncode-video-container').css('opacity','1');
						domObject.volume = 0;
					},
					// fires when a problem is detected
					error: function() {}
				});
			}
		});
	});
};

UNCODE.carousel = function(container) {
	var $owlSelector = $('.owl-carousel-container > [class*="owl-carousel"]', container),
		values = {},
		tempTimeStamp,
		currentIndex,
		$owlInsideEqual = [];
	$owlSelector.each(function() {
		var itemID = $(this).attr('id'),
			$elSelector = $(('#' + itemID).toString());
		values['id'] = itemID;
		values['items'] = 1;
		values['columns'] = 3;
		values['fade'] = false;
		values['nav'] = false;
		values['navmobile'] = false;
		values['navskin'] = 'light';
		values['navspeed'] = 400;
		values['dots'] = false;
		values['dotsmobile'] = false;
		values['loop'] = false;
		values['autoplay'] = false;
		values['timeout'] = 3000;
		values['autoheight'] = false;
		values['margin'] = 0;
		values['lg'] = 1;
		values['md'] = 1;
		values['sm'] = 1;
		$.each($(this).data(), function(i, v) {
			values[i] = v;
		});

		if ($(this).closest('.uncode-slider').length) {
			values['navskin'] = '';
			values['navmobile'] = false;
			values['dotsmobile'] = true;
		} else {
			values['navskin'] = ' style-'+values['navskin']+' style-override';
		}

		/** Initialized */
		$elSelector.on('initialized.owl.carousel', function(event) {

			var thiis = $(event.currentTarget),
				// get the time from the data method
				time = thiis.data("timer-id");
			if (time) {
				clearTimeout(time);
			}
			thiis.addClass('showControls');
			var new_time = setTimeout(function() {
				thiis.closest('.owl-carousel-container').removeClass('owl-carousel-loading');
				if (thiis.hasClass('owl-height-equal')) setItemsHeight(event.currentTarget);
				if (!UNCODE.isMobile && !$elSelector.closest('.header-wrapper').length) navHover($elSelector.parent());
				if (thiis.closest('.unequal, .unexpand').length) {
					var rowParent = thiis.closest('.row-parent');
					UNCODE.setRowHeight(rowParent[0], true);
				}
			}, 350);
			// save the new time
			thiis.data("timer-id", new_time);

			var scrolltop = $(document).scrollTop();
			$(event.currentTarget).closest('.uncode-slider').find('video').removeAttr('poster');

			//if (!UNCODE.isMobile) {
				/** fix autoplay when visible **/
				if ($(event.currentTarget).data('autoplay')) {
					$(event.currentTarget).trigger('stop.autoplay.owl');
				}
				var carouselInView = new Waypoint.Inview({
				  element: $(event.currentTarget)[0],
				  enter: function(direction) {
				    var el = $(this.element);
						if (el.data('autoplay')) {
							el.trigger('play.owl.autoplay');
							el.data('stopped','false');
						}
				  },
				  exited: function() {
				    if ($(this.element).data('autoplay')) {
							$(this.element).trigger('stop.owl.autoplay');
							$(this.element).data('stopped','true');
						}
				  }
				});
			//}

			if (!$(event.currentTarget).closest('.isotope-system').length) {
				setTimeout(function() {
					animate_thumb($('.t-inside', el), event);
				}, 400);
			}

			var currentItem = $(event.currentTarget).find("> .owl-stage-outer > .owl-stage > .owl-item")[event.item.index],
			currentIndex = $(currentItem).attr('data-index');

			$.each($('.owl-item:not(.active) .start_animation', $(event.target)), function(index, val) {
				if ($(val).closest('.uncode-slider').length) {
					$(val).removeClass('start_animation');
				}
			});

			$.each($('.owl-item:not(.active)', event.currentTarget), function(index, val) {
				if ($(val).attr('data-index') != currentIndex) {
					$('.start_animation:not(.t-inside)', val).removeClass('start_animation');
				}
				if ($(val).attr('data-index') == currentIndex) {
					$('.animate_when_almost_visible:not(.t-inside)', val).addClass('start_animation');
				}
			});

			if ($(event.currentTarget).closest('.uncode-slider').length) {
				var el = $(event.currentTarget).closest('.row-parent')[0];
				if ($(el).data('imgready')) {
					firstLoaded(el, event);
				} else {
					el.addEventListener("imgLoaded", function(el) {
						firstLoaded(el.target, event);
					}, false);
				}
				var transHeight = $('.hmenu .menu-transparent.menu-primary .menu-container').height() - UNCODE.bodyBorder;
				if (transHeight != null) {
					setTimeout(function() {
						$(event.currentTarget).closest('.uncode-slider').find('.owl-prev, .owl-next').css('paddingTop', transHeight / 2 + 'px');
					}, 100);
				}
			} else {
				var el = $(event.currentTarget);
				el.closest('.uncode-slider').addClass('slider-loaded');
			}

			setTimeout(function() {
				window.uncode_textfill(thiis);
				if ($(event.currentTarget).closest('.uncode-slider').length) {
					if ($(event.currentTarget).data('autoplay')) pauseOnHover(event.currentTarget);
				}
			}, 500);

			if ($(event.currentTarget).closest('.unequal').length) {
				$owlInsideEqual.push($(event.currentTarget).closest('.row-parent'));
			}

		});

		/** Resizing */
		$elSelector.on('resized.owl.carousel', function(event) {
			if ($(this).closest('.nested-carousel').length) {
				setTimeout(function() {
					window.dispatchEvent(UNCODE.boxEvent);
				}, 200);
			}
			if ($(event.currentTarget).hasClass('owl-height-equal')) setItemsHeight(event.currentTarget);
		});

		/** Change */
		$elSelector.on('change.owl.carousel', function(event) {
			if (!UNCODE.isMobile) UNCODE.owlStopVideo(event.currentTarget);
		});

		/** Changed */
		$elSelector.on('changed.owl.carousel', function(event) {
			if (tempTimeStamp != event.timeStamp) {
				var scrolltop = $(document).scrollTop();
				var currentItem = $(event.currentTarget).find("> .owl-stage-outer > .owl-stage > .owl-item")[(event.item.index != null) ? event.item.index : 0];
				if ($(event.currentTarget).closest('.row-slider').length) {
					if (currentItem == undefined) {
						currentItem = $(event.currentTarget).children()[0];
					}
					if ($(currentItem).closest('#page-header').length) {
						if ($('.row-container > .row > .row-inner > div > .style-dark', currentItem).closest('.uncode-slider').length) {
							UNCODE.switchColorsMenu(scrolltop, 'dark');
						} else if ($('.row-container > .row > .row-inner > div > .style-light', currentItem).closest('.uncode-slider').length) {
							UNCODE.switchColorsMenu(scrolltop, 'light');
						}
					}
				}
			}
			tempTimeStamp = event.timeStamp;
		});

		$elSelector.on('translate.owl.carousel', function(event) {
			if (UNCODE.isMobile) {
				$(event.currentTarget).addClass('owl-translating');
			}
		});

		/** Translated */
		$elSelector.on('translated.owl.carousel', function(event) {

			var currentItem = $(event.currentTarget).find("> .owl-stage-outer > .owl-stage > .owl-item")[event.item.index],
				currentIndex = $(currentItem).attr('data-index');

			if (!UNCODE.isMobile) {
				UNCODE.owlPlayVideo(event.currentTarget);
			}

			setTimeout(function() {
				var lastDelayElems = animate_elems($('.owl-item.active', event.currentTarget));
				var lastDelayThumb = animate_thumb($('.owl-item.active .t-inside', event.currentTarget), event);
				if ($(event.currentTarget).closest('.uncode-slider').length && $(event.currentTarget).data('autoplay')) {
					if (lastDelayElems == undefined) lastDelayElems = 0;
					if (lastDelayThumb == undefined) lastDelayThumb = 0;
					var maxDelay = Math.max(lastDelayElems, lastDelayThumb);
					$(event.currentTarget).trigger('stop.owl.autoplay');
					setTimeout(function() {
						if (!$(event.currentTarget).hasClass('owl-mouseenter') && $(event.currentTarget).data('stopped') != 'true') $(event.currentTarget).trigger('play.owl.autoplay');
					}, maxDelay);
				}
			}, 200);

			$.each($('.owl-item:not(.active) .start_animation', $(event.target)), function(index, val) {
				if ($(val).closest('.uncode-slider').length) {
					$(val).removeClass('start_animation');
				}
			});

			$.each($('.owl-item:not(.active)', event.currentTarget), function(index, val) {
				if ($(val).attr('data-index') != currentIndex) {
					$('.start_animation:not(.t-inside)', val).removeClass('start_animation');
				}
				if ($(val).attr('data-index') == currentIndex) {
					$('.animate_when_almost_visible:not(.t-inside)', val).addClass('start_animation');
				}
			});

			if (UNCODE.isMobile) {
				$(event.currentTarget).removeClass('owl-translating');
			}

			// } else {
			// 	$(event.currentTarget).removeClass('owl-translating');
			// }
		});

		/** Init carousel */
		$elSelector.owlCarousel({
			items: values['items'],
			animateOut: (values['fade'] == true) ? 'fadeOut' : null,
			nav: values['nav'],
			dots: values['dots'],
			loop: values['loop'],
			margin: 0,
			video: true,
			autoWidth: false,
			autoplay: false,
			autoplayTimeout: values['timeout'],
			autoplaySpeed: values['navspeed'],
			autoplayHoverPause: $(this).closest('.uncode-slider').length ? false : true,
			autoHeight: ($(this).hasClass('owl-height-equal') || $(this).hasClass('owl-height-auto')) ? true : values['autoheight'],
			rtl: $('body').hasClass('rtl') ? true : false,
			fluidSpeed: true,
			navSpeed: values['navspeed'],
			navClass: [ 'owl-prev'+values['navskin'], 'owl-next'+values['navskin'] ],
			navText: ['<div class="owl-nav-container btn-default btn-hover-nobg"><i class="fa fa-fw fa-angle-left"></i></div>', '<div class="owl-nav-container btn-default btn-hover-nobg"><i class="fa fa-fw fa-angle-right"></i></div>'],
			navContainer: values['nav'] ? $elSelector : false,
			responsiveClass: true,
			responsiveBaseElement: '.box-container',
			responsive: {
				0: {
					items: values['sm'],
					nav: values['navmobile'],
					dots: values['dotsmobile']
				},
				480: {
					items: values['sm'],
					nav: values['navmobile'],
					dots: values['dotsmobile']
				},
				570: {
					items: values['md'],
					nav: values['navmobile'],
					dots: values['dotsmobile']
				},
				960: {
					items: values['lg']
				}
			},
		});

		setTimeout(function() {
			for (var i = $owlInsideEqual.length - 1; i >= 0; i--) {
				UNCODE.setRowHeight($owlInsideEqual[i]);
			};
		}, 300);
	});

	function firstLoaded(el, event) {
		var el = $(el),
		uncode_slider = el.find('.uncode-slider');
		el.find('.owl-carousel').css('opacity', 1);
		uncode_slider.addClass('slider-loaded');
		window.uncode_textfill(el.find('.owl-item.active'));
		//if (!UNCODE.isMobile) {
			setTimeout(function() {
				var lastDelayElems = animate_elems(el.find('.owl-item.active'));
				var lastDelayThumb = animate_thumb(el.find('.owl-item.active .t-inside'), event);
				if (uncode_slider.length && el.find('.owl-carousel').data('autoplay')) {
					if (lastDelayElems == undefined) lastDelayElems = 0;
					if (lastDelayThumb == undefined) lastDelayThumb = 0;
					var maxDelay = Math.max(lastDelayElems, lastDelayThumb);
					$('> .owl-carousel', uncode_slider).trigger('stop.owl.autoplay');
					setTimeout(function() {
						$('> .owl-carousel', uncode_slider).trigger('play.owl.autoplay');
					}, maxDelay);
				}
			}, 500);
		//}
	}

	function navHover(el) {
		var $owlCont = el,
			$owlPrev = $owlCont.find('.owl-prev'),
			$owlNext = $owlCont.find('.owl-next'),
			$owlDots = $owlCont.find('.owl-dots-inside .owl-dots'),
			$owlPagination = $owlCont.next(),
			owlPrevW = $owlPrev.outerWidth(),
			owlNextW = $owlNext.outerWidth(),
			owlDotsH = $owlDots.innerHeight(),
			owlTime = 400,
			owlNested = $owlCont.parent().parent().hasClass('nested-carousel');
		$owlPrev.css("margin-left", -owlPrevW);
		$owlNext.css("margin-right", -owlNextW);
		if (!owlNested) $owlDots.css("bottom", -owlDotsH);
		$owlCont.mouseenter(function() {
			owlNested = $owlCont.parent().parent().hasClass('nested-carousel');
			$owlPrev.css({
				marginLeft: 0
			});
			$owlNext.css({
				marginRight: 0
			});
			if (!owlNested) {
				$owlDots.css({
					opacity: 1,
					bottom: 0
				});
			}
		}).mouseleave(function() {
			owlNested = $owlCont.parent().parent().hasClass('nested-carousel');
			$owlPrev.css({
				marginLeft: -owlPrevW
			});
			$owlNext.css({
				marginRight: -owlNextW
			});
			if (!owlNested) {
				$owlDots.css({
					opacity: 1,
					bottom: -owlDotsH
				});
			}
		});
	};

	function animate_elems($this) {
		var lastDelay;
		$.each($('.animate_when_almost_visible:not(.t-inside)', $this), function(index, val) {
			var element = $(val),
				delayAttr = element.attr('data-delay');
			if (delayAttr == undefined) delayAttr = 0;
			setTimeout(function() {
				element.addClass('start_animation');
			}, delayAttr);
			lastDelay = delayAttr;
		});
		return lastDelay;
	}

	function animate_thumb(items, event) {
		var lastDelay,
		itemIndex,
		tempIndex = ($(event.currentTarget).data('tempIndex') == undefined) ? $('.owl-item.active', event.currentTarget).first().index() : $(event.currentTarget).data('tempIndex'),
		numActives = $('.owl-item.active', event.currentTarget).length;
		$(event.currentTarget).data('tempIndex', event.item.index);
			$.each(items, function(index, val) {
				var parent = $(val).closest('.owl-item');
				if (!$(val).hasClass('start_animation')) {
					if (parent.hasClass('active')) {
						var thumbInView = new Waypoint.Inview({
						  element: val,
						  enter: function(direction) {
						    var element = $(this.element),
									delayAttr = parseInt(element.attr('data-delay')),
									itemIndex = element.closest('.owl-item').index() + 1,
									diffItem = Math.abs(itemIndex - tempIndex) - 1;
								if (itemIndex > tempIndex) {
									$(event.currentTarget).data('tempIndex', itemIndex);
								}
								if (isNaN(delayAttr)) delayAttr = 100;
								$('.owl-item.cloned[data-index="'+(element.closest('.owl-item').data('index'))+'"] .t-inside', event.currentTarget).addClass('start_animation');
								var objTimeout = setTimeout(function() {
									element.addClass('start_animation');
								}, diffItem * delayAttr);
								lastDelay = diffItem * delayAttr;
								parent.data('objTimeout', objTimeout);
								this.destroy();
						  }
						});
					}
				}
			});
			return lastDelay;
		}

	function setItemsHeight(item) {
		$.each($('.owl-item', item), function(index, val) {
			var availableThumbHeight = $('.t-inside', $(val)).height(),
			innerThumbHeight = $('.t-entry-text-tc', $(val)).outerHeight(),
			difference = availableThumbHeight - innerThumbHeight;
			if ($('.tmb-content-under', val).length) {
				var visualPart = $('.t-entry-visual', val);
				if (visualPart.length) {
					difference -= $('.t-entry-visual', val).height();
				}
			}
			$('.t-entry > *:last-child', val).css( 'transform', 'translateY('+difference+'px)' );
		});
	}

	function pauseOnHover(slider) {
		$('.owl-dots, .owl-prev, .owl-next', slider).on({
	    mouseenter: function () {
	    	$(slider).addClass('owl-mouseenter');
	    	$(slider).trigger('stop.owl.autoplay');
	    },
	    mouseleave: function () {
	    	$(slider).removeClass('owl-mouseenter')
	      $(slider).trigger('play.owl.autoplay');
	    }
		});
	}
};

UNCODE.owlPlayVideo = function(carousel) {
	var player, iframe;
	$('.owl-item.active .uncode-video-container', carousel).each(function(index, val) {
		var content = $(val).html();
		if (content == '') {
			var getCloned = $('.owl-item:not(.active) .uncode-video-container[data-id="'+$(this).attr('data-id')+'"]').children().first().clone();
			$(val).append(getCloned);
		}
		if ($(this).attr('data-provider') == 'vimeo') {
			iframe = $(this).find('iframe');
			player = $f(iframe[0]);
			player.api('play');
		} else if ($(this).attr('data-provider') == 'youtube') {
			if (youtubePlayers[$(this).attr('data-id')] != undefined) youtubePlayers[$(this).attr('data-id')].playVideo();
		} else {
			var player = $(this).find('video');
			if (player.length) {
				$(this).find('video')[0].volume = 0;
				$(this).find('video')[0].play();
				$(val).css('opacity', 1);
			}
		}
	});
};

UNCODE.owlStopVideo = function(carousel) {
	$('.owl-item .uncode-video-container', carousel).each(function(index, val) {
		var player, iframe;
		if ($(this).attr('data-provider') == 'vimeo') {
			iframe = $(this).find('iframe');
			player = $f(iframe[0]);
			player.api('pause');
		} else if ($(this).attr('data-provider') == 'youtube') {
			if (youtubePlayers[$(this).attr('data-id')] != undefined) youtubePlayers[$(this).attr('data-id')].pauseVideo();
		} else {
			var player = $(this).find('video');
			if (player.length) {
				$(this).find('video')[0].volume = 0;
				$(this).find('video')[0].play();
			}
		}
	});
};

UNCODE.animations = function() {
	//if (!UNCODE.isMobile) {
		$.each($('.header-content-inner'), function(index, val) {
			var element = $(val),
				transition = '';
			if (element.hasClass('top-t-bottom')) transition = 'top-t-bottom';
			if (element.hasClass('bottom-t-top')) transition = 'bottom-t-top';
			if (element.hasClass('left-t-right')) transition = 'left-t-right';
			if (element.hasClass('right-t-left')) transition = 'right-t-left';
			if (element.hasClass('zoom-in')) transition = 'zoom-in';
			if (element.hasClass('zoom-out')) transition = 'zoom-out';
			if (element.hasClass('alpha-anim')) transition = 'alpha-anim';
			if (transition != '') {
				$(val).removeClass(transition);
				var container = element,
					containerDelay = container.attr('data-delay'),
					containerSpeed = container.attr('data-speed'),
					items = $('.header-title > *, .post-info', container);
				$.each(items, function(index, val) {
					var element = $(val),
						//speedAttr = (containerSpeed == undefined) ? containerSpeed : '',
						delayAttr = (containerDelay != undefined) ? containerDelay : 400;
					if (!element.hasClass('animate_when_almost_visible')) {
						delayAttr = Number(delayAttr) + (400 * index);
						if (containerSpeed != undefined) element.attr('data-speed', containerSpeed);
						element.addClass(transition + ' animate_when_almost_visible').attr('data-delay', delayAttr);
					}
				});
				container.css('opacity', 1);
			}
		});
	//}

	if (!window.waypoint_animation) {
		window.waypoint_animation = function() {
			$.each($('.animate_when_almost_visible:not(.start_animation):not(.t-inside), .tmb-media .animate_when_almost_visible:not(.start_animation)'), function(index, val) {
				var run = true;
				if ($(val).closest('.owl-carousel').length > 0) run = false;
				if (run) {
					new Waypoint({
						element: val,
						handler: function() {
							var element = $(this.element),
								index = element.index(),
								delayAttr = element.attr('data-delay');
							if (delayAttr == undefined) delayAttr = 0;
							setTimeout(function() {
								element.addClass('start_animation');
							}, delayAttr);
							this.destroy();
						},
						offset: '90%'
					});
				}
			});
		}
	}
	setTimeout(function() {
		window.waypoint_animation();
	}, 100);
}

UNCODE.tapHover = function() {

    var $el = $('html.touch .tmb:not(.tmb-no-double-tap) .t-entry-visual-cont > a'), //.length //html.touch a.btn
        elClass = "hover";

    $el.on("click", function(e) { // cambia click con touch start 'touchstart'
        var link = $(this);
        if (link.hasClass(elClass)) {
            return true;
        } else {
            link.addClass("hover");
            $el.not(this).removeClass(elClass);
            e.preventDefault();
            return false;
        }
    });
};


UNCODE.onePage = function(isMobile) {
	var current = 0,
		last = 0,
		lastScrollTop = 0,
		forceScroll = false,
		lastScrolled = 0,
		isSectionscroller = ($('.main-onepage').length) ? true : false,
		getOffset = (($('.menu-sticky .menu-container:not(.menu-hide)').length && ($(window).width() > UNCODE.mediaQuery)) ? $('.menu-sticky .menu-container:not(.menu-hide)').outerHeight() : 0);

	function init_onepage() {
		if (isSectionscroller && !isMobile) {
			$("<ul class='onepage-pagination'></ul>").prependTo("body");
		}
		last = $('.onepage-section').length - 1;
		$.each($('div[data-parent=true]'), function(index, val) {
			$(this).attr('data-section', index);
			if (isMobile) return;
			var sectionDown = new Waypoint({
				element: val,
				handler: function(direction) {
					if (direction == 'down') {
						changeMenuActive(this.element, index);
					}
				},
				offset: 1 + getOffset
			});
			var sectionUp = new Waypoint({
				element: val,
				handler: function(direction) {
					if (direction == 'up') {
						changeMenuActive(this.element, index);
					}
				},
				offset: -1 + getOffset
			});

			if (isSectionscroller) {
				var label;
				if ($(this).attr('data-label') != undefined) label = $(this).attr('data-label');
				else label = '';
				var getName = $(this).attr('data-name');
				if (getName == undefined) getName = index;
				if (label != '') {
					label = '<span class="cd-label style-accent-bg border-accent-color">' + label + '</span>';
					$('ul.onepage-pagination').append("<li><a class='one-dot-link' data-index='" + (index) + "' href='#" + (getName) + "'><span class='cd-dot-cont'><span class='cd-dot'></span></span>"+label+"</a></li>");
				}
			}
		});

		if (isSectionscroller) {
			$.each($('ul.onepage-pagination li'), function(index, val) {
				var $this = $(val);
				$this.on('click', function(evt) {
					var el = $('a', evt.currentTarget);
					current = lastScrolled = parseInt(el.attr('data-index'));
					lastScrolled += 1;
					scrollBody(current);
				});
			});
			var goToSection = parseInt((window.location.hash).replace(/[^\d.]/g, ''));
			if (isNaN(goToSection) && window.location.hash != undefined && window.location.hash != '') {
				goToSection = String(window.location.hash).replace(/^#/, "");
				goToSection = Number($('[data-name=' + goToSection + ']').attr('data-section'));
			}

			if (typeof goToSection === 'number' && !isNaN(goToSection)) {
				current = lastScrolled = goToSection;
				setTimeout(function() {
					scrollBody(goToSection);
				}, 500);
			}
		}

	}

	function changeMenuActive(section, index) {
		current = lastScrolled = parseInt($(section).attr('data-section'));
		if (isSectionscroller) {
			var newSection = $('.onepage-pagination li a[data-index=' + index + ']');
			if (newSection.length) {
				$('ul.onepage-pagination li a').removeClass('is-selected');
				newSection.addClass('is-selected');
			}
		}
		var getName = $('[data-section=' + index + ']').attr('data-name');
		if (getName != undefined) {
			$.each($('.menu-container .menu-item > a, .widget_nav_menu .menu-smart .menu-item > a'), function(i, val) {
				var get_href = $(val).attr('href');
				if (get_href != undefined && get_href.substring(get_href.indexOf('#')+1) == getName) {
					$(val).closest('ul').find('.active').removeClass('active');
					$(val).parent().addClass('active');
				}
			});
		}
	}

	if (isSectionscroller) {
		$(window).on('scroll', function() {
			var bodyTop = document.documentElement['scrollTop'] || document.body['scrollTop'];
			if (bodyTop == 0) {
				$('ul.onepage-pagination li a').removeClass('is-selected');
				$('.onepage-pagination li a[data-index=0]').addClass('is-selected');
				var getName = $('[data-section=0]').attr('data-name');
				if (getName != undefined) {
					$.each($('.menu-container .menu-item > a'), function(i, val) {
						var get_href = $(val).attr('href');
						if (get_href != undefined && get_href.substring(get_href.indexOf('#')+1) == getName) {
							$(val).closest('ul').find('.active').removeClass('active');
							$(val).parent().addClass('active');
						}
					});
				}
			} else if ((window.innerHeight + bodyTop) >= $('.box-container').height()) {
				var lastSection = $('.onepage-pagination li a[data-index="' + last +'"]');
				if (lastSection.length) {
					$('ul.onepage-pagination li a').removeClass('is-selected');
					lastSection.addClass('is-selected');
				}
			}
		});

		var scrollBody = function(index) {
			$('ul.onepage-pagination li a').removeClass('is-selected');
			$('.onepage-pagination li a[data-index=' + index + ']').addClass('is-selected');
			var body = $("html, body"),
			bodyTop = document.documentElement['scrollTop'] || document.body['scrollTop'],
			delta = bodyTop - $('[data-section=' + index + ']').offset().top,
			scrollTo = $('[data-section=' + index + ']').offset().top;
			scrollTo -= UNCODE.get_scroll_offset();
			if (index != 0) {
				UNCODE.scrolling = true;
			}
			body.animate({
				scrollTop: (delta > 0) ? scrollTo - 0.1 : scrollTo
			}, Math.abs(delta) / 2, 'easeInOutQuad', function() {
				setTimeout(function(){
					UNCODE.scrolling = false;
				}, 100);
			});
		};
	}

	init_onepage();
};

UNCODE.stickyElements = function() {
	if (!UNCODE.isMobile) {
		setTimeout(function() {
			if ($('.sticky-element').length) {
				var getRowPadding = $('.sticky-element.sticky-sidebar').closest('.row-parent').css("padding-top"),
					sideOffset = (getRowPadding != undefined) ? parseInt(getRowPadding.replace("px", "")) : 0;
				sideOffset += UNCODE.bodyBorder;
				if (UNCODE.adminBarHeight > 0) sideOffset += UNCODE.adminBarHeight;
				if ($('.menu-sticky .menu-container:not(.menu-hide)').length) {
					if ($('.menu-shrink').length) {
						sideOffset += $('.navbar-brand').data('minheight') + 36;
					} else sideOffset += ($('body.hmenu-center').length ? $('#masthead .menu-container').outerHeight() : parseInt(UNCODE.menuMobileHeight));
				}
				if ($(window).width() > UNCODE.mediaQuery) {
					$(".sticky-element").stick_in_parent({
						sticky_class: 'is_stucked',
						offset_top: sideOffset,
						bottoming: true,
						inner_scrolling: false
					});
				}
				$(window).on('resize', function(event) {
					if ($(window).width() > UNCODE.mediaQuery) {
						$(".sticky-element").stick_in_parent({
							sticky_class: 'is_stucked',
							offset_top: sideOffset,
							bottoming: true,
							inner_scrolling: false
						});
					} else {
						$(".sticky-element").trigger("sticky_kit:detach");
					}
				});
			}
		}, 1000);
	}
};

UNCODE.scrollEnance = function() {
  //
  // SmoothScroll for websites v1.4.4 (Balazs Galambosi)
  // http://www.smoothscroll.net/
  //
  // Licensed under the terms of the MIT license.
  //
  // You may use it in your theme if you credit me.
  // It is also free to use on any individual website.
  //
  // Exception:
  // The only restriction is to not publish any
  // extension for browsers or native application
  // without getting a written permission first.
  //
  UNCODE.navigating = false;
  (function () {

  // Scroll Variables (tweakable)
  var defaultOptions = {

      // Scrolling Core
      frameRate        : 150, // [Hz]
      animationTime    : 500, // [ms]
      stepSize         : 100, // [px]

      // Pulse (less tweakable)
      // ratio of "tail" to "acceleration"
      pulseAlgorithm   : true,
      pulseScale       : 4,
      pulseNormalize   : 1,

      // Acceleration
      accelerationDelta : 50,  // 50
      accelerationMax   : 3,   // 3

      // Keyboard Settings
      keyboardSupport   : true,  // option
      arrowScroll       : 50,    // [px]

      // Other
      touchpadSupport   : false, // ignore touchpad by default
      fixedBackground   : true,
      excluded          : ''
  };

  var options = defaultOptions;


  // Other Variables
  var isExcluded = false;
  var isFrame = false;
  var direction = { x: 0, y: 0 };
  var initDone  = false;
  var root = document.documentElement;
  var activeElement;
  var observer;
  var refreshSize;
  var deltaBuffer = [];
  var isMac = /^Mac/.test(navigator.platform);

  var key = { left: 37, up: 38, right: 39, down: 40, spacebar: 32,
              pageup: 33, pagedown: 34, end: 35, home: 36 };
  var arrowKeys = { 37: 1, 38: 1, 39: 1, 40: 1 };

  /***********************************************
   * INITIALIZE
   ***********************************************/

  /**
   * Tests if smooth scrolling is allowed. Shuts down everything if not.
   */
  function initTest() {
      if (options.keyboardSupport) {
          addEvent('keydown', keydown);
      }
  }

  /**
   * Sets up scrolls array, determines if frames are involved.
   */
  function init() {

      if (initDone || !document.body) return;

      initDone = true;

      var body = document.body;
      var html = document.documentElement;
      var windowHeight = window.innerHeight;
      var scrollHeight = body.scrollHeight;

      // check compat mode for root element
      root = (document.compatMode.indexOf('CSS') >= 0) ? html : body;
      activeElement = body;

      initTest();

      // Checks if this script is running in a frame
      if (top != self) {
          isFrame = true;
      }

      /**
       * Please duplicate this radar for a Safari fix!
       * rdar://22376037
       * https://openradar.appspot.com/radar?id=4965070979203072
       *
       * Only applies to Safari now, Chrome fixed it in v45:
       * This fixes a bug where the areas left and right to
       * the content does not trigger the onmousewheel event
       * on some pages. e.g.: html, body { height: 100% }
       */
      else if (scrollHeight > windowHeight &&
              (body.offsetHeight <= windowHeight ||
               html.offsetHeight <= windowHeight)) {

          var fullPageElem = document.createElement('div');
          fullPageElem.style.cssText = 'position:absolute; z-index:-10000; ' +
                                       'top:0; left:0; right:0; height:' +
                                        root.scrollHeight + 'px';
          document.body.appendChild(fullPageElem);

          // DOM changed (throttled) to fix height
          var pendingRefresh;
          refreshSize = function () {
              if (pendingRefresh) return; // could also be: clearTimeout(pendingRefresh);
              pendingRefresh = setTimeout(function () {
                  if (isExcluded) return; // could be running after cleanup
                  fullPageElem.style.height = '0';
                  fullPageElem.style.height = root.scrollHeight + 'px';
                  pendingRefresh = null;
              }, 500); // act rarely to stay fast
          };

          setTimeout(refreshSize, 10);

          addEvent('resize', refreshSize);

          // TODO: attributeFilter?
          var config = {
              attributes: true,
              childList: true,
              characterData: false
              // subtree: true
          };

          observer = new MutationObserver(refreshSize);
          observer.observe(body, config);

          if (root.offsetHeight <= windowHeight) {
              var clearfix = document.createElement('div');
              clearfix.style.clear = 'both';
              body.appendChild(clearfix);
          }
      }

      // disable fixed background
      if (!options.fixedBackground && !isExcluded) {
          body.style.backgroundAttachment = 'scroll';
          html.style.backgroundAttachment = 'scroll';
      }
  }

  /**
   * Removes event listeners and other traces left on the page.
   */
  function cleanup() {
      observer && observer.disconnect();
      removeEvent(wheelEvent, wheel);
      removeEvent('mousedown', mousedown);
      removeEvent('keydown', keydown);
      removeEvent('resize', refreshSize);
      removeEvent('load', init);
  }


  /************************************************
   * SCROLLING
   ************************************************/

  var que = [];
  var pending = false;
  var lastScroll = Date.now();

  /**
   * Pushes scroll actions to the scrolling queue.
   */
  function scrollArray(elem, left, top) {

      directionCheck(left, top);

      if (options.accelerationMax != 1) {
          var now = Date.now();
          var elapsed = now - lastScroll;
          if (elapsed < options.accelerationDelta) {
              var factor = (1 + (50 / elapsed)) / 2;
              if (factor > 1) {
                  factor = Math.min(factor, options.accelerationMax);
                  left *= factor;
                  top  *= factor;
              }
          }
          lastScroll = Date.now();
      }

      // push a scroll command
      que.push({
          x: left,
          y: top,
          lastX: (left < 0) ? 0.99 : -0.99,
          lastY: (top  < 0) ? 0.99 : -0.99,
          start: Date.now()
      });

      // don't act if there's a pending queue
      if (pending) {
          return;
      }

      var scrollWindow = (elem === document.body);

      var step = function (time) {

          var now = Date.now();
          var scrollX = 0;
          var scrollY = 0;

          for (var i = 0; i < que.length; i++) {

              var item = que[i];
              var elapsed  = now - item.start;
              var finished = (elapsed >= options.animationTime);

              // scroll position: [0, 1]
              var position = (finished) ? 1 : elapsed / options.animationTime;

              // easing [optional]
              if (options.pulseAlgorithm) {
                  position = pulse(position);
              }

              // only need the difference
              var x = (item.x * position - item.lastX) >> 0;
              var y = (item.y * position - item.lastY) >> 0;

              // add this to the total scrolling
              scrollX += x;
              scrollY += y;

              // update last values
              item.lastX += x;
              item.lastY += y;

              // delete and step back if it's over
              if (finished) {
                  que.splice(i, 1); i--;
              }
          }

          // scroll left and top
          if (scrollWindow) {
              window.scrollBy(scrollX, scrollY);
          }
          else {
              if (scrollX) elem.scrollLeft += scrollX;
              if (scrollY) elem.scrollTop  += scrollY;
          }

          // clean up if there's nothing left to do
          if (!left && !top) {
              que = [];
          }

          if (que.length) {
              requestFrame(step, elem, (1000 / options.frameRate + 1));
          } else {
              pending = false;
          }
      };

      // start a new queue of actions
      requestFrame(step, elem, 0);
      pending = true;
  }


  /***********************************************
   * EVENTS
   ***********************************************/

  /**
   * Mouse wheel handler.
   * @param {Object} event
   */
  function wheel(event) {

      if (!initDone) {
          init();
      }

      var target = event.target;
      var overflowing = overflowingAncestor(target);

      // use default if there's no overflowing
      // element or default action is prevented
      // or it's a zooming event with CTRL
      if (!overflowing || event.defaultPrevented || event.ctrlKey) {
          return true;
      }

      // leave embedded content alone (flash & pdf)
      if (isNodeName(activeElement, 'embed') ||
         (isNodeName(target, 'embed') && /\.pdf/i.test(target.src)) ||
          isNodeName(activeElement, 'object') ||
          target.shadowRoot) {
          return true;
      }

      var deltaX = -event.wheelDeltaX || event.deltaX || 0;
      var deltaY = -event.wheelDeltaY || event.deltaY || 0;

      if (isMac) {
          if (event.wheelDeltaX && isDivisible(event.wheelDeltaX, 120)) {
              deltaX = -120 * (event.wheelDeltaX / Math.abs(event.wheelDeltaX));
          }
          if (event.wheelDeltaY && isDivisible(event.wheelDeltaY, 120)) {
              deltaY = -120 * (event.wheelDeltaY / Math.abs(event.wheelDeltaY));
          }
      }

      // use wheelDelta if deltaX/Y is not available
      if (!deltaX && !deltaY) {
          deltaY = -event.wheelDelta || 0;
      }

      // line based scrolling (Firefox mostly)
      if (event.deltaMode === 1) {
          deltaX *= 40;
          deltaY *= 40;
      }

      // check if it's a touchpad scroll that should be ignored
      if (!options.touchpadSupport && isTouchpad(deltaY)) {
          return true;
      }

      // scale by step size
      // delta is 120 most of the time
      // synaptics seems to send 1 sometimes
      if (Math.abs(deltaX) > 1.2) {
          deltaX *= options.stepSize / 120;
      }
      if (Math.abs(deltaY) > 1.2) {
          deltaY *= options.stepSize / 120;
      }

      scrollArray(overflowing, deltaX, deltaY);

      if (Math.abs(deltaX) > 10 && !UNCODE.navigating) {
        if (deltaX > 0) {
          UNCODE.navigating = true;
          window.history.forward();
        } else {
          UNCODE.navigating = true;
          window.history.back();
        }
      } else event.preventDefault();
      scheduleClearCache();
  }

  /**
   * Keydown event handler.
   * @param {Object} event
   */
  function keydown(event) {

      var target   = event.target;
      var modifier = event.ctrlKey || event.altKey || event.metaKey ||
                    (event.shiftKey && event.keyCode !== key.spacebar);

      // our own tracked active element could've been removed from the DOM
      if (!document.body.contains(activeElement)) {
          activeElement = document.activeElement;
      }

      // do nothing if user is editing text
      // or using a modifier key (except shift)
      // or in a dropdown
      // or inside interactive elements
      var inputNodeNames = /^(textarea|select|embed|object)$/i;
      var buttonTypes = /^(button|submit|radio|checkbox|file|color|image)$/i;
      if ( event.defaultPrevented ||
           inputNodeNames.test(target.nodeName) ||
           isNodeName(target, 'input') && !buttonTypes.test(target.type) ||
           isNodeName(activeElement, 'video') ||
           isInsideYoutubeVideo(event) ||
           target.isContentEditable ||
           modifier ) {
        return true;
      }

      // [spacebar] should trigger button press, leave it alone
      if ((isNodeName(target, 'button') ||
           isNodeName(target, 'input') && buttonTypes.test(target.type)) &&
          event.keyCode === key.spacebar) {
        return true;
      }

      // [arrwow keys] on radio buttons should be left alone
      if (isNodeName(target, 'input') && target.type == 'radio' &&
          arrowKeys[event.keyCode])  {
        return true;
      }

      var shift, x = 0, y = 0;
      var elem = overflowingAncestor(activeElement);
      var clientHeight = elem.clientHeight;

      if (elem == document.body) {
          clientHeight = window.innerHeight;
      }

      switch (event.keyCode) {
          case key.up:
              y = -options.arrowScroll;
              break;
          case key.down:
              y = options.arrowScroll;
              break;
          case key.spacebar: // (+ shift)
              shift = event.shiftKey ? 1 : -1;
              y = -shift * clientHeight * 0.9;
              break;
          case key.pageup:
              y = -clientHeight * 0.9;
              break;
          case key.pagedown:
              y = clientHeight * 0.9;
              break;
          case key.home:
              y = -elem.scrollTop;
              break;
          case key.end:
              var damt = elem.scrollHeight - elem.scrollTop - clientHeight;
              y = (damt > 0) ? damt+10 : 0;
              break;
          case key.left:
              x = -options.arrowScroll;
              break;
          case key.right:
              x = options.arrowScroll;
              break;
          default:
              return true; // a key we don't care about
      }

      scrollArray(elem, x, y);
      event.preventDefault();
      scheduleClearCache();
  }

  /**
   * Mousedown event only for updating activeElement
   */
  function mousedown(event) {
      activeElement = event.target;
  }


  /***********************************************
   * OVERFLOW
   ***********************************************/

  var uniqueID = (function () {
      var i = 0;
      return function (el) {
          return el.uniqueID || (el.uniqueID = i++);
      };
  })();

  var cache = {}; // cleared out after a scrolling session
  var clearCacheTimer;

  //setInterval(function () { cache = {}; }, 10 * 1000);

  function scheduleClearCache() {
      clearTimeout(clearCacheTimer);
      clearCacheTimer = setInterval(function () { cache = {}; }, 1*1000);
  }

  function setCache(elems, overflowing) {
      for (var i = elems.length; i--;)
          cache[uniqueID(elems[i])] = overflowing;
      return overflowing;
  }

  //  (body)                (root)
  //         | hidden | visible | scroll |  auto  |
  // hidden  |   no   |    no   |   YES  |   YES  |
  // visible |   no   |   YES   |   YES  |   YES  |
  // scroll  |   no   |   YES   |   YES  |   YES  |
  // auto    |   no   |   YES   |   YES  |   YES  |

  function overflowingAncestor(el) {
      var elems = [];
      var body = document.body;
      var rootScrollHeight = root.scrollHeight;
      do {
          var cached = cache[uniqueID(el)];
          if (cached) {
              return setCache(elems, cached);
          }
          elems.push(el);
          if (rootScrollHeight === el.scrollHeight) {
              var topOverflowsNotHidden = overflowNotHidden(root) && overflowNotHidden(body);
              var isOverflowCSS = topOverflowsNotHidden || overflowAutoOrScroll(root);
              if (isFrame && isContentOverflowing(root) ||
                 !isFrame && isOverflowCSS) {
                  return setCache(elems, getScrollRoot());
              }
          } else if (isContentOverflowing(el) && overflowAutoOrScroll(el)) {
              return setCache(elems, el);
          }
      } while (el = el.parentElement);
  }

  function isContentOverflowing(el) {
      return (el.clientHeight + 10 < el.scrollHeight);
  }

  // typically for <body> and <html>
  function overflowNotHidden(el) {
      var overflow = getComputedStyle(el, '').getPropertyValue('overflow-y');
      return (overflow !== 'hidden');
  }

  // for all other elements
  function overflowAutoOrScroll(el) {
      var overflow = getComputedStyle(el, '').getPropertyValue('overflow-y');
      return (overflow === 'scroll' || overflow === 'auto');
  }


  /***********************************************
   * HELPERS
   ***********************************************/

  function addEvent(type, fn) {
      window.addEventListener(type, fn, false);
  }

  function removeEvent(type, fn) {
      window.removeEventListener(type, fn, false);
  }

  function isNodeName(el, tag) {
      return (el.nodeName||'').toLowerCase() === tag.toLowerCase();
  }

  function directionCheck(x, y) {
      x = (x > 0) ? 1 : -1;
      y = (y > 0) ? 1 : -1;
      if (direction.x !== x || direction.y !== y) {
          direction.x = x;
          direction.y = y;
          que = [];
          lastScroll = 0;
      }
  }

  var deltaBufferTimer;

  if (window.localStorage && localStorage.SS_deltaBuffer) {
      deltaBuffer = localStorage.SS_deltaBuffer.split(',');
  }

  function isTouchpad(deltaY) {
      if (!deltaY) return;
      if (!deltaBuffer.length) {
          deltaBuffer = [deltaY, deltaY, deltaY];
      }
      deltaY = Math.abs(deltaY);
      deltaBuffer.push(deltaY);
      deltaBuffer.shift();
      clearTimeout(deltaBufferTimer);
      deltaBufferTimer = setTimeout(function () {
          if (window.localStorage) {
              localStorage.SS_deltaBuffer = deltaBuffer.join(',');
          }
      }, 1000);
      return !allDeltasDivisableBy(120) && !allDeltasDivisableBy(100);
  }

  function isDivisible(n, divisor) {
      return (Math.floor(n / divisor) == n / divisor);
  }

  function allDeltasDivisableBy(divisor) {
      return (isDivisible(deltaBuffer[0], divisor) &&
              isDivisible(deltaBuffer[1], divisor) &&
              isDivisible(deltaBuffer[2], divisor));
  }

  function isInsideYoutubeVideo(event) {
      var elem = event.target;
      var isControl = false;
      if (document.URL.indexOf ('www.youtube.com/watch') != -1) {
          do {
              isControl = (elem.classList &&
                           elem.classList.contains('html5-video-controls'));
              if (isControl) break;
          } while (elem = elem.parentNode);
      }
      return isControl;
  }

  var requestFrame = (function () {
        return (window.requestAnimationFrame       ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame    ||
                function (callback, element, delay) {
                   window.setTimeout(callback, delay || (1000/60));
               });
  })();

  var MutationObserver = (window.MutationObserver ||
                          window.WebKitMutationObserver ||
                          window.MozMutationObserver);

  var getScrollRoot = (function() {
    var SCROLL_ROOT;
    return function() {
      if (!SCROLL_ROOT) {
        var dummy = document.createElement('div');
        dummy.style.cssText = 'height:10000px;width:1px;';
        document.body.appendChild(dummy);
        var bodyScrollTop  = document.body.scrollTop;
        var docElScrollTop = document.documentElement.scrollTop;
        window.scrollBy(0, 3);
        if (document.body.scrollTop != bodyScrollTop)
          (SCROLL_ROOT = document.body);
        else
          (SCROLL_ROOT = document.documentElement);
        window.scrollBy(0, -3);
        document.body.removeChild(dummy);
      }
      return SCROLL_ROOT;
    };
  })();


  /***********************************************
   * PULSE (by Michael Herf)
   ***********************************************/

  /**
   * Viscous fluid with a pulse for part and decay for the rest.
   * - Applies a fixed force over an interval (a damped acceleration), and
   * - Lets the exponential bleed away the velocity over a longer interval
   * - Michael Herf, http://stereopsis.com/stopping/
   */
  function pulse_(x) {
      var val, start, expx;
      // test
      x = x * options.pulseScale;
      if (x < 1) { // acceleartion
          val = x - (1 - Math.exp(-x));
      } else {     // tail
          // the previous animation ended here:
          start = Math.exp(-1);
          // simple viscous drag
          x -= 1;
          expx = 1 - Math.exp(-x);
          val = start + (expx * (1 - start));
      }
      return val * options.pulseNormalize;
  }

  function pulse(x) {
      if (x >= 1) return 1;
      if (x <= 0) return 0;

      if (options.pulseNormalize == 1) {
          options.pulseNormalize /= pulse_(1);
      }
      return pulse_(x);
  }


  /***********************************************
   * FIRST RUN
   ***********************************************/

  var userAgent = window.navigator.userAgent;
  var isEdge    = /Edge/.test(userAgent); // thank you MS
  var isChrome  = /chrome/i.test(userAgent) && !isEdge;
  var isSafari  = /safari/i.test(userAgent) && !isEdge;
  var isMobile  = /mobile/i.test(userAgent);
  var isIEWin7  = /Windows NT 6.1/i.test(userAgent) && /rv:11/i.test(userAgent);
  var isEnabledForBrowser = (isChrome || isSafari || isIEWin7) && !isMobile;

  var wheelEvent;
  if ('onwheel' in document.createElement('div'))
      wheelEvent = 'wheel';
  else if ('onmousewheel' in document.createElement('div'))
      wheelEvent = 'mousewheel';

  if (wheelEvent && isEnabledForBrowser) {
      addEvent(wheelEvent, wheel);
      addEvent('mousedown', mousedown);
      addEvent('load', init);
  }


  /***********************************************
   * PUBLIC INTERFACE
   ***********************************************/

  function SmoothScroll(optionsToSet) {
      for (var key in optionsToSet)
          if (defaultOptions.hasOwnProperty(key))
              options[key] = optionsToSet[key];
  }
  SmoothScroll.destroy = cleanup;

  if (window.SmoothScrollOptions) // async API
      SmoothScroll(window.SmoothScrollOptions);

  if (typeof define === 'function' && define.amd)
      define(function() {
          return SmoothScroll;
      });
  else if ('object' == typeof exports)
      module.exports = SmoothScroll;
  else
      window.SmoothScroll = SmoothScroll;

  })();
};

UNCODE.twentytwenty = function() {

  if (!$('.twentytwenty-container').length) return;

  // jquery.event.move
  //
  // 1.3.6
  //
  // Stephen Band
  //
  // Triggers 'movestart', 'move' and 'moveend' events after
  // mousemoves following a mousedown cross a distance threshold,
  // similar to the native 'dragstart', 'drag' and 'dragend' events.
  // Move events are throttled to animation frames. Move event objects
  // have the properties:
  //
  // pageX:
  // pageY:   Page coordinates of pointer.
  // startX:
  // startY:  Page coordinates of pointer at movestart.
  // distX:
  // distY:  Distance the pointer has moved since movestart.
  // deltaX:
  // deltaY:  Distance the finger has moved since last event.
  // velocityX:
  // velocityY:  Average velocity over last few events.


  (function (module) {
    if (typeof define === 'function' && define.amd) {
      // AMD. Register as an anonymous module.
      define(['jquery'], module);
    } else {
      // Browser globals
      module(jQuery);
    }
  })(function(jQuery, undefined){

    var // Number of pixels a pressed pointer travels before movestart
        // event is fired.
        threshold = 6,

        add = jQuery.event.add,

        remove = jQuery.event.remove,

        // Just sugar, so we can have arguments in the same order as
        // add and remove.
        trigger = function(node, type, data) {
          jQuery.event.trigger(type, data, node);
        },

        // Shim for requestAnimationFrame, falling back to timer. See:
        // see http://paulirish.com/2011/requestanimationframe-for-smart-animating/
        requestFrame = (function(){
          return (
            window.requestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function(fn, element){
              return window.setTimeout(function(){
                fn();
              }, 25);
            }
          );
        })(),

        ignoreTags = {
          textarea: true,
          input: true,
          select: true,
          button: true
        },

        mouseevents = {
          move: 'mousemove',
          cancel: 'mouseup dragstart',
          end: 'mouseup'
        },

        touchevents = {
          move: 'touchmove',
          cancel: 'touchend',
          end: 'touchend'
        };


    // Constructors

    function Timer(fn){
      var callback = fn,
          active = false,
          running = false;

      function trigger(time) {
        if (active){
          callback();
          requestFrame(trigger);
          running = true;
          active = false;
        }
        else {
          running = false;
        }
      }

      this.kick = function(fn) {
        active = true;
        if (!running) { trigger(); }
      };

      this.end = function(fn) {
        var cb = callback;

        if (!fn) { return; }

        // If the timer is not running, simply call the end callback.
        if (!running) {
          fn();
        }
        // If the timer is running, and has been kicked lately, then
        // queue up the current callback and the end callback, otherwise
        // just the end callback.
        else {
          callback = active ?
            function(){ cb(); fn(); } :
            fn ;

          active = true;
        }
      };
    }


    // Functions

    function returnTrue() {
      return true;
    }

    function returnFalse() {
      return false;
    }

    function preventDefault(e) {
      e.preventDefault();
    }

    function preventIgnoreTags(e) {
      // Don't prevent interaction with form elements.
      if (ignoreTags[ e.target.tagName.toLowerCase() ]) { return; }

      e.preventDefault();
    }

    function isLeftButton(e) {
      // Ignore mousedowns on any button other than the left (or primary)
      // mouse button, or when a modifier key is pressed.
      return (e.which === 1 && !e.ctrlKey && !e.altKey);
    }

    function identifiedTouch(touchList, id) {
      var i, l;

      if (touchList.identifiedTouch) {
        return touchList.identifiedTouch(id);
      }

      // touchList.identifiedTouch() does not exist in
      // webkit yet… we must do the search ourselves...

      i = -1;
      l = touchList.length;

      while (++i < l) {
        if (touchList[i].identifier === id) {
          return touchList[i];
        }
      }
    }

    function changedTouch(e, event) {
      var touch = identifiedTouch(e.changedTouches, event.identifier);

      // This isn't the touch you're looking for.
      if (!touch) { return; }

      // Chrome Android (at least) includes touches that have not
      // changed in e.changedTouches. That's a bit annoying. Check
      // that this touch has changed.
      if (touch.pageX === event.pageX && touch.pageY === event.pageY) { return; }

      return touch;
    }


    // Handlers that decide when the first movestart is triggered

    function mousedown(e){
      var data;

      if (!isLeftButton(e)) { return; }

      data = {
        target: e.target,
        startX: e.pageX,
        startY: e.pageY,
        timeStamp: e.timeStamp
      };

      add(document, mouseevents.move, mousemove, data);
      add(document, mouseevents.cancel, mouseend, data);
    }

    function mousemove(e){
      var data = e.data;

      checkThreshold(e, data, e, removeMouse);
    }

    function mouseend(e) {
      removeMouse();
    }

    function removeMouse() {
      remove(document, mouseevents.move, mousemove);
      remove(document, mouseevents.cancel, mouseend);
    }

    function touchstart(e) {
      var touch, template;

      // Don't get in the way of interaction with form elements.
      if (ignoreTags[ e.target.tagName.toLowerCase() ]) { return; }

      touch = e.changedTouches[0];

      // iOS live updates the touch objects whereas Android gives us copies.
      // That means we can't trust the touchstart object to stay the same,
      // so we must copy the data. This object acts as a template for
      // movestart, move and moveend event objects.
      template = {
        target: touch.target,
        startX: touch.pageX,
        startY: touch.pageY,
        timeStamp: e.timeStamp,
        identifier: touch.identifier
      };

      // Use the touch identifier as a namespace, so that we can later
      // remove handlers pertaining only to this touch.
      add(document, touchevents.move + '.' + touch.identifier, touchmove, template);
      add(document, touchevents.cancel + '.' + touch.identifier, touchend, template);
    }

    function touchmove(e){
      var data = e.data,
          touch = changedTouch(e, data);

      if (!touch) { return; }

      checkThreshold(e, data, touch, removeTouch);
    }

    function touchend(e) {
      var template = e.data,
          touch = identifiedTouch(e.changedTouches, template.identifier);

      if (!touch) { return; }

      removeTouch(template.identifier);
    }

    function removeTouch(identifier) {
      remove(document, '.' + identifier, touchmove);
      remove(document, '.' + identifier, touchend);
    }


    // Logic for deciding when to trigger a movestart.

    function checkThreshold(e, template, touch, fn) {
      var distX = touch.pageX - template.startX,
          distY = touch.pageY - template.startY;

      // Do nothing if the threshold has not been crossed.
      if ((distX * distX) + (distY * distY) < (threshold * threshold)) { return; }

      triggerStart(e, template, touch, distX, distY, fn);
    }

    function handled() {
      // this._handled should return false once, and after return true.
      this._handled = returnTrue;
      return false;
    }

    function flagAsHandled(e) {
      e._handled();
    }

    function triggerStart(e, template, touch, distX, distY, fn) {
      var node = template.target,
          touches, time;

      touches = e.targetTouches;
      time = e.timeStamp - template.timeStamp;

      // Create a movestart object with some special properties that
      // are passed only to the movestart handlers.
      template.type = 'movestart';
      template.distX = distX;
      template.distY = distY;
      template.deltaX = distX;
      template.deltaY = distY;
      template.pageX = touch.pageX;
      template.pageY = touch.pageY;
      template.velocityX = distX / time;
      template.velocityY = distY / time;
      template.targetTouches = touches;
      template.finger = touches ?
        touches.length :
        1 ;

      // The _handled method is fired to tell the default movestart
      // handler that one of the move events is bound.
      template._handled = handled;

      // Pass the touchmove event so it can be prevented if or when
      // movestart is handled.
      template._preventTouchmoveDefault = function() {
        e.preventDefault();
      };

      // Trigger the movestart event.
      trigger(template.target, template);

      // Unbind handlers that tracked the touch or mouse up till now.
      fn(template.identifier);
    }


    // Handlers that control what happens following a movestart

    function activeMousemove(e) {
      var timer = e.data.timer;

      e.data.touch = e;
      e.data.timeStamp = e.timeStamp;
      timer.kick();
    }

    function activeMouseend(e) {
      var event = e.data.event,
          timer = e.data.timer;

      removeActiveMouse();

      endEvent(event, timer, function() {
        // Unbind the click suppressor, waiting until after mouseup
        // has been handled.
        setTimeout(function(){
          remove(event.target, 'click', returnFalse);
        }, 0);
      });
    }

    function removeActiveMouse(event) {
      remove(document, mouseevents.move, activeMousemove);
      remove(document, mouseevents.end, activeMouseend);
    }

    function activeTouchmove(e) {
      var event = e.data.event,
          timer = e.data.timer,
          touch = changedTouch(e, event);

      if (!touch) { return; }

      // Stop the interface from gesturing
      e.preventDefault();

      event.targetTouches = e.targetTouches;
      e.data.touch = touch;
      e.data.timeStamp = e.timeStamp;
      timer.kick();
    }

    function activeTouchend(e) {
      var event = e.data.event,
          timer = e.data.timer,
          touch = identifiedTouch(e.changedTouches, event.identifier);

      // This isn't the touch you're looking for.
      if (!touch) { return; }

      removeActiveTouch(event);
      endEvent(event, timer);
    }

    function removeActiveTouch(event) {
      remove(document, '.' + event.identifier, activeTouchmove);
      remove(document, '.' + event.identifier, activeTouchend);
    }


    // Logic for triggering move and moveend events

    function updateEvent(event, touch, timeStamp, timer) {
      var time = timeStamp - event.timeStamp;

      event.type = 'move';
      event.distX =  touch.pageX - event.startX;
      event.distY =  touch.pageY - event.startY;
      event.deltaX = touch.pageX - event.pageX;
      event.deltaY = touch.pageY - event.pageY;

      // Average the velocity of the last few events using a decay
      // curve to even out spurious jumps in values.
      event.velocityX = 0.3 * event.velocityX + 0.7 * event.deltaX / time;
      event.velocityY = 0.3 * event.velocityY + 0.7 * event.deltaY / time;
      event.pageX =  touch.pageX;
      event.pageY =  touch.pageY;
    }

    function endEvent(event, timer, fn) {
      timer.end(function(){
        event.type = 'moveend';

        trigger(event.target, event);

        return fn && fn();
      });
    }


    // jQuery special event definition

    function setup(data, namespaces, eventHandle) {
      // Stop the node from being dragged
      //add(this, 'dragstart.move drag.move', preventDefault);

      // Prevent text selection and touch interface scrolling
      //add(this, 'mousedown.move', preventIgnoreTags);

      // Tell movestart default handler that we've handled this
      add(this, 'movestart.move', flagAsHandled);

      // Don't bind to the DOM. For speed.
      return true;
    }

    function teardown(namespaces) {
      remove(this, 'dragstart drag', preventDefault);
      remove(this, 'mousedown touchstart', preventIgnoreTags);
      remove(this, 'movestart', flagAsHandled);

      // Don't bind to the DOM. For speed.
      return true;
    }

    function addMethod(handleObj) {
      // We're not interested in preventing defaults for handlers that
      // come from internal move or moveend bindings
      if (handleObj.namespace === "move" || handleObj.namespace === "moveend") {
        return;
      }

      // Stop the node from being dragged
      add(this, 'dragstart.' + handleObj.guid + ' drag.' + handleObj.guid, preventDefault, undefined, handleObj.selector);

      // Prevent text selection and touch interface scrolling
      add(this, 'mousedown.' + handleObj.guid, preventIgnoreTags, undefined, handleObj.selector);
    }

    function removeMethod(handleObj) {
      if (handleObj.namespace === "move" || handleObj.namespace === "moveend") {
        return;
      }

      remove(this, 'dragstart.' + handleObj.guid + ' drag.' + handleObj.guid);
      remove(this, 'mousedown.' + handleObj.guid);
    }

    jQuery.event.special.movestart = {
      setup: setup,
      teardown: teardown,
      add: addMethod,
      remove: removeMethod,

      _default: function(e) {
        var event, data;

        // If no move events were bound to any ancestors of this
        // target, high tail it out of here.
        if (!e._handled()) { return; }

        function update(time) {
          updateEvent(event, data.touch, data.timeStamp);
          trigger(e.target, event);
        }

        event = {
          target: e.target,
          startX: e.startX,
          startY: e.startY,
          pageX: e.pageX,
          pageY: e.pageY,
          distX: e.distX,
          distY: e.distY,
          deltaX: e.deltaX,
          deltaY: e.deltaY,
          velocityX: e.velocityX,
          velocityY: e.velocityY,
          timeStamp: e.timeStamp,
          identifier: e.identifier,
          targetTouches: e.targetTouches,
          finger: e.finger
        };

        data = {
          event: event,
          timer: new Timer(update),
          touch: undefined,
          timeStamp: undefined
        };

        if (e.identifier === undefined) {
          // We're dealing with a mouse
          // Stop clicks from propagating during a move
          add(e.target, 'click', returnFalse);
          add(document, mouseevents.move, activeMousemove, data);
          add(document, mouseevents.end, activeMouseend, data);
        }
        else {
          // We're dealing with a touch. Stop touchmove doing
          // anything defaulty.
          e._preventTouchmoveDefault();
          add(document, touchevents.move + '.' + e.identifier, activeTouchmove, data);
          add(document, touchevents.end + '.' + e.identifier, activeTouchend, data);
        }
      }
    };

    jQuery.event.special.move = {
      setup: function() {
        // Bind a noop to movestart. Why? It's the movestart
        // setup that decides whether other move events are fired.
        add(this, 'movestart.move', jQuery.noop);
      },

      teardown: function() {
        remove(this, 'movestart.move', jQuery.noop);
      }
    };

    jQuery.event.special.moveend = {
      setup: function() {
        // Bind a noop to movestart. Why? It's the movestart
        // setup that decides whether other move events are fired.
        add(this, 'movestart.moveend', jQuery.noop);
      },

      teardown: function() {
        remove(this, 'movestart.moveend', jQuery.noop);
      }
    };

    add(document, 'mousedown.move', mousedown);
    add(document, 'touchstart.move', touchstart);

    // Make jQuery copy touch event properties over to the jQuery event
    // object, if they are not already listed. But only do the ones we
    // really need. IE7/8 do not have Array#indexOf(), but nor do they
    // have touch events, so let's assume we can ignore them.
    if (typeof Array.prototype.indexOf === 'function') {
      (function(jQuery, undefined){
        var props = ["changedTouches", "targetTouches"],
            l = props.length;

        while (l--) {
          if (jQuery.event.props.indexOf(props[l]) === -1) {
            jQuery.event.props.push(props[l]);
          }
        }
      })(jQuery);
    };
  });

  $.fn.twentytwenty = function(options) {
    var options = $.extend({default_offset_pct: 0.5, orientation: 'horizontal'}, options);
    return this.each(function() {

      var sliderPct = options.default_offset_pct;
      var container = $(this);
      var sliderOrientation = options.orientation;
      var beforeDirection = (sliderOrientation === 'vertical') ? 'down' : 'left';
      var afterDirection = (sliderOrientation === 'vertical') ? 'up' : 'right';

      container.wrap("<div class='twentytwenty-wrapper twentytwenty-" + sliderOrientation + "'></div>");
      container.append("<div class='twentytwenty-overlay'></div>");
      var beforeImg = container.find("img:first");
      var afterImg = container.find("img:last");
      container.append("<div class='twentytwenty-handle style-accent-bg border-accent-color'></div>");
      var slider = container.find(".twentytwenty-handle");
      slider.append("<span class='twentytwenty-" + beforeDirection + "-arrow'></span>");
      slider.append("<span class='twentytwenty-" + afterDirection + "-arrow'></span>");
      container.addClass("twentytwenty-container");
      beforeImg.addClass("twentytwenty-before");
      afterImg.addClass("twentytwenty-after");

      var overlay = container.find(".twentytwenty-overlay");
      overlay.append("<div class='twentytwenty-before-label'></div>");
      overlay.append("<div class='twentytwenty-after-label'></div>");

      var calcOffset = function(dimensionPct) {
        var w = beforeImg.width();
        var h = beforeImg.height();
        return {
          w: w+"px",
          h: h+"px",
          cw: (dimensionPct*w)+"px",
          ch: (dimensionPct*h)+"px"
        };
      };

      var adjustContainer = function(offset) {
      	if (sliderOrientation === 'vertical') {
      	  beforeImg.css("clip", "rect(0,"+offset.w+","+offset.ch+",0)");
      	}
      	else {
          beforeImg.css("clip", "rect(0,"+offset.cw+","+offset.h+",0)");
    	}
        container.css("height", offset.h);
      };

      var adjustSlider = function(pct) {
        var offset = calcOffset(pct);
        slider.css((sliderOrientation==="vertical") ? "top" : "left", (sliderOrientation==="vertical") ? offset.ch : offset.cw);
        adjustContainer(offset);
      }

      $(window).on("resize.twentytwenty", function(e) {
        adjustSlider(sliderPct);
      });

      var offsetX = 0,
      offsetY = 0,
      imgWidth = 0,
      imgHeight = 0;

      slider.on("movestart", function(e) {
        if (((e.distX > e.distY && e.distX < -e.distY) || (e.distX < e.distY && e.distX > -e.distY)) && sliderOrientation !== 'vertical') {
          e.preventDefault();
        }
        else if (((e.distX < e.distY && e.distX < -e.distY) || (e.distX > e.distY && e.distX > -e.distY)) && sliderOrientation === 'vertical') {
          e.preventDefault();
        }
        container.addClass("active");
        offsetX = container.offset().left;
        offsetY = container.offset().top;
        imgWidth = beforeImg.width();
        imgHeight = beforeImg.height();
      });

      slider.on("moveend", function(e) {
        container.removeClass("active");
      });

      slider.on("move", function(e) {
        if (container.hasClass("active")) {
          sliderPct = (sliderOrientation === 'vertical') ? (e.pageY-offsetY)/imgHeight : (e.pageX-offsetX)/imgWidth;
          if (sliderPct < 0) {
            sliderPct = 0;
          }
          if (sliderPct > 1) {
            sliderPct = 1;
          }
          adjustSlider(sliderPct);
        }
      });

      container.find("img").on("mousedown", function(event) {
        event.preventDefault();
      });

      $(window).trigger("resize.twentytwenty");
    });
  };

  $('.twentytwenty-container').twentytwenty();

}

	UNCODE.init = function() {
		UNCODE.utils();
		UNCODE.menuSystem();
		UNCODE.okvideo();
		UNCODE.tapHover();
		UNCODE.isotopeLayout();
		UNCODE.lightbox();
		UNCODE.backVideo();
		UNCODE.carousel($('body'));
		UNCODE.animations();
		UNCODE.stickyElements();
		UNCODE.twentytwenty();
		UNCODE.disableHoverScroll();
		UNCODE.onePage(UNCODE.isMobile);
		if ($('body.smooth-scroller').length) {
			setTimeout(function(){
				UNCODE.scrollEnance();
			}, 300);
		}
	}
	UNCODE.init();
})(jQuery);

