var site = {
	$window: $(window),
	$html: $('html'),
	$body: $('body'),
	ww: $(window).width(),
	platform: function(){
		var self = this,
			navUA = navigator.userAgent.toLowerCase();

		$.support.touch = 'ontouchend' in document;
		var svgSupport = (window.SVGAngle) ? true : false,
			svgSupportAlt = (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1")) ? true : false,
			ff3x = (/gecko/i.test(navUA) && /rv:1.9/i.test(navUA)) ? true : false;
			
			self.touch = $.support.touch ? true : false;
			self.ltie9 = $.support.leadingWhitespace ? false : true;
			self.lteie9 = typeof window.atob === 'undefined' ? true : false;

		if (!svgSupport || !svgSupportAlt || self.lteie9 || ff3x){
			self.$html.addClass('no_svg');
		};

		if(self.touch){
			self.$html.addClass('touch');
		} else {
			self.$html.addClass('mouse');
		};
		
		if(self.lteie9){
			self.$html.addClass('ie ie9');
		};

		if(self.ltie9){
			self.$html.addClass('ie suck-mode');
		};
	},
	header: {
		init: function(){
			var self = this;
			self.search.init();
			self.mobileNav.init();
			if(site.ww <= 640){
				self.mobileSubNav.init();
			};
		},
		mobileNav: {
			init: function(){
				var self = this;
				self.$hamburger = $('#Hamburger, #FixedHamburger');
				self.$mobileNav = $('#MobileNav');
				self.$menuItems = $('#MobileNav ul').children();
				self.$back = $();
				self.addUI();
				self.bindHandlers();
				self.open = false;
			},
			addUI: function(){
				var self = this;
				self.$menuItems.each(function(){
					var $t = $(this),
						$sub = $t.find('.sub-menu'),
						title = $t.children('a').text();
						
					if($sub.length){
						$('<div class="toggle"/>').insertBefore($sub);
						$t.addClass('sub-trigger').children('a').attr('href','javascript:void(0)');
						var $back = $('<li class="heading"><span>'+title+'</span><div class="toggle"/></li>').prependTo($sub);
						self.$back = self.$back.add($back);
					};
				});
				self.$triggers = $('.sub-trigger');
			},
			bindHandlers: function(){
				var self = this
					
				self.$hamburger.on('click',function(){
					if(!site.$body.hasClass('aside')){
						if($('#Home').length){
							site.home.heroCarousel.$carousel.easyFader('pause');
							site.home.$membersCarousel.easyFader('pause');
						};
						site.$body.addClass('aside');
						self.open = true;
					} else {
						site.$body.removeClass('aside');
						self.open = false;
						if($('#Home').length){
							site.home.heroCarousel.$carousel.easyFader('resume');
							site.home.$membersCarousel.easyFader('resume');
						};
					};
				});
				
				site.$window.resize(function(){
					if(self.open){
						site.$body.removeClass('aside');
					};
				});
				
				self.$triggers.on('click',function(e){
					var $t = $(this);
					if(!$t.hasClass('open')){
						$t.addClass('open');
					} else {
						$t.removeClass('open');
					};
				});
				
				site.$body.on('touchmove', function(e){
					if(self.open){
						e.preventDefault();
					};
				});
				
				self.$mobileNav.find('.sub-menu a').on('click',function(e){
					var href = this.href;
					e.preventDefault();
					site.$body.removeClass('aside');
					var delay = setTimeout(function(){
						window.location = href;
					},200);
				});
			}
		},
		mobileSubNav: {
			init: function(){
				var self = this;
				
				self.$subnav = $('#SubNav');
				self.$slider = self.$subnav.find('ul');
				self.sliderW = self.$slider.width();
				self.swipe = false;
				self.sliderOffset = parseInt(self.$slider.css('left'));
				self.maxSliderOffset = site.ww - self.sliderW;
				
				self.prePos();
				self.bindHandlers();
			},
			bindHandlers: function(){
				var self = this;
				
				site.$window.resize(function(){
					site.ww = site.$window.width();
					self.sliderW = self.$slider.width();
					self.maxSliderOffset = site.ww - self.sliderW;
					//self.prePos();
				});
				
				site.$body.bind('touchmove',function(e){
					$target = $(e.target);
					if($target.closest('.sub-nav').length){
						e.preventDefault();
					};
				});
				
				self.$slider.find('li').bind('mousedown touchstart',function(e){
					if(site.touch){
						e = self.getEvent(e);
					} else {
						e.preventDefault();
					};

					self.swipe = true;
					self.startX = e.pageX;
				});
				
				site.$body.bind('mousemove touchmove',function(e){
					if(self.swipe){
						if(self.sliderW <= site.ww){
							self.menuSwipe = false;
							return false;
						};
						
						if(site.touch){
							e = self.getEvent(e);
						};
						
						var posX = e.pageX,
							relX = posX - self.startX,
							moveX = self.sliderOffset + relX;
							
						self.$subnav.removeClass('max-left max-right');
							
						if(moveX > self.maxSliderOffset && moveX < 20){
							self.$slider.css('left',moveX+'px');
						} else if(moveX <= self.maxSliderOffset){
							self.$subnav.addClass('max-right');
							self.$slider.css('left',self.maxSliderOffset+'px');
						} else if(moveX >= 20){
							self.$subnav.addClass('max-left');
							self.$slider.css('left','20px');
						}
					};
				});
				
				site.$window.bind('mouseup touchend',function(e){
					if(self.swipe){
						if(site.touch){
							e = self.getEvent(e);
						};
						
						self.sliderOffset = parseInt(self.$slider.css('left'));
						self.swipe = false;
					};	
				});
			},
			getEvent: function(e){
				var eData = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
				
				return eData;
			},
			prePos: function(){
				var self = this;
				
				self.$active = self.$slider.find('.current-menu-item');
				
					if(self.$active.index() > 0){
				
					var activeW = self.$active.width()/2,
						activeOffset = self.$active.offset().left + activeW,
						centerPos = (site.ww/2) + 35,
						diff = activeOffset - centerPos;
					
					self.$subnav.removeClass('max-left max-right');
					
					if(diff < self.maxSliderOffset*-1){
						self.$slider.css('left','-'+diff+'px');
					} else {
						self.$subnav.addClass('max-right');
						self.$slider.css('left',self.maxSliderOffset+'px');
					};
					self.sliderOffset = parseInt(self.$slider.css('left'));
				
				}
			}
		},
		search: {
			open: false,
			init: function(){
				var self = this;
				self.$searchButton = $('#SearchButton');
				self.$searchWrapper = self.$searchButton.closest('.search');
				self.$form = self.$searchWrapper.find('form');
				self.$input = self.$form.find('input');
				self.bindHandlers();
			},
			bindHandlers: function(){
				var self = this;
				
				self.$searchButton.on('click',function(e){
					var $t = $(this);
					if(!self.$searchWrapper.hasClass('open')){
						self.open = true;
						self.$searchWrapper.addClass('open');
						self.$input.focus();
					} else if(self.$searchWrapper.hasClass('open') && e.target == this){
						self.open = false;
						self.$searchWrapper.removeClass('open');
						self.$input.blur();
					};
				});
				
				$('body').on('click',function(e){
					var $target = $(e.target);
					if(!$target.closest(self.$searchWrapper).length && $target[0] != self.$searchWrapper[0] && self.open){
						self.$searchWrapper.removeClass('open');
						self.$form[0].reset();
					};
				});	
			},
			submit: function(){
				var self = this;
			}
		}
	},
	home: {
		init: function(){
			var self = this;
			
			self.$membersCarousel = $('#MembersCarousel');
			
			if(!self.heroCarousel.initialized && carouselLoaded){
				self.heroCarousel.init();
			};
			
			self.$membersCarousel.easyFader({
				effect: 'carousel',
				autoCycle: true,
				slideDur: 1800,
				effectDur: 900,
				includeMargin: true
			});
			
			if(site.touch){
				site.helpers.bindSwipe(self.$membersCarousel);
			};
			
			self.quotes.init();
		},
		heroCarousel: {
			initialized: false,
			zone: null,
			init: function(){
				var self = this;
				
				self.$carousel = $('#HomeCarousel');
				self.$caption = self.$carousel.find('.caption');
				
				self.$carousel.easyFader({
					slideDur: 6E3,
					effectDur: 1100,
					effect: 'carousel',
					onChangeStart: function(){
						self.$caption.removeClass('show');
					},
					onChangeEnd: function($slide){
						self.renderCaptions($slide);
					}
				});
				
				self.$carousel.addClass('loaded');
				self.renderCaptions(self.$carousel.find('.slide').eq(0));
				if(site.touch){
					site.helpers.bindSwipe(self.$carousel);
				};
				
				self.initialized = true;
			},
			renderCaptions: function($slide){
				var self = this;
					captionData = $slide.attr('data-slide');
					captionJSON = captionData ? $.parseJSON(captionData) : false;

				if(captionJSON){
					self.$caption.find('h2').html(captionJSON.title);
					self.$caption.attr('href',captionJSON.href).find('.read-more').html(captionJSON.linkTitle);
					if(captionJSON.title){
						self.$caption
							.removeClass(self.zone)
							.addClass('show '+captionJSON.zone)
							.parent()
							.removeClass('left right center')
							.addClass(captionJSON.position);
					};
					self.zone = captionJSON.zone;
				};
			}
		},
		quotes: {
			init: function(){
				var self = this;
			
				self.$quotes = $('#Quotes');
				self.$quotes.easyFader({
					effectDur: 1200
				});
			}
		}
	},
	events: {
		filter: 'all',
		init: function(){
			var self = this;
			self.$eventsList = $('#EventsList');
			self.$featuredEvent = $('#FeaturedEvent');
			self.$filters = $('#EventFilters');
			self.$loadMore = $('#LoadMore');
			
			self.showOnLoad = self.$eventsList.attr('data-category') || 'all';
			
			if(self.$featuredEvent.length){
				self.$featuredEvent.mixitup({
					layoutMode: 'list',
					effects: ['fade'],
					filterSelector: '.kunkalabs'
				});
			};
			
			self.$eventsList.mixitup({
				layoutMode: 'list',
				effects: ['fade'],
				minHeight: 260,
				showOnLoad: self.showOnLoad,
				onMixLoad: function(){
					self.findVisible();
				},
				onMixEnd: function(config){
					self.findVisible();
					self.filter = config.filter;
				}
			});
			
			self.filter = self.showOnLoad;
			
			if(self.$filters.length && !site.touch){
				self.filtersAffixed = false;
				self.affixFilters();
			};
			
			if(self.$loadMore.length){
				self.ajaxPosts.init();
			};
		},
		affixFilters: function(){
			var self = this;
			
			self.getFiltersPos();
			
			self.scrollPosY = site.$window.scrollTop();
			self.checkScroll();
			
			site.$window.resize(function(){
				if(!self.filtersAffixed){
					self.getFiltersPos();
				};
			});
			
			site.$window.scroll(function(){
				self.scrollPosY = site.$window.scrollTop();
				self.checkScroll();
			});
		},
		checkScroll: function(){
			var self = this,
				$topList = $('.events-list').first();
			
			if(self.scrollPosY >= self.filtersPosY){
				var filtersHeight = self.$filters.height();
				
				$topList.css('margin-top',filtersHeight+'px');
				
				site.$body.addClass('affix-filters');
				self.filtersAffixed = true;
			} else if(self.scrollPosY < self.filtersPosY && self.filtersAffixed) {
				site.$body.removeClass('affix-filters');
				$topList.removeAttr('style');
				self.filtersAffixed = false;
			};
		},
		getFiltersPos: function(){
			var self = this;
			
			self.filtersPosY = self.$filters.offset().top;
			
		},
		findVisible: function(){
			var self = this;
			self.$eventsList.find('.mix').removeClass('visible').filter(':visible').addClass('visible');
		},
		ajaxPosts: {
			page: 1,
			loading: false,
			startdate: false,
			datePickerOpen: false,
			init: function(){
				var self = this;
				
				self.$loadMore = $('#LoadMore');
				self.$datePicker = $('#DatePicker');
				self.$pickADate = $('#PickADate');
				self.$showingFrom = $('#ShowingFrom');
				self.$startDate = $('#StartDate');
				
				self.bindHandlers();
			},
			bindHandlers: function(){
				var self = this;
				
				self.$loadMore.on('click',function(){
					var query = {
						action: 'nygc_ajax_posts',
						type: self.$loadMore.hasClass('past') ? 'past' : 'upcoming',
						number_of_posts: 10,
						paged: self.page + 1,
						post_type: self.$loadMore.attr('data-posttype') || 'events',
						category: self.$loadMore.attr('data-cat') || site.events.filter,
						nonce: nygcAjaxPosts.ajaxNonce
					};
					
					if(self.startdate)query.startdate = self.startdate;
					
					site.events.$eventsList.addClass('loading-more');
					
					self.requestEvents(query);
				});
				
				self.$pickADate.on('click',function(e){
					if(!self.datePickerOpen){
						self.datePickerOpen = true;
						self.$datePicker.fadeIn();
					} else if(e.target == this){
						self.datePickerOpen = false;
						self.$datePicker.fadeOut();
					};
				});
				
				site.$body.on('click',function(e){
					if(
						self.datePickerOpen && 
						!$(e.target).closest('.pick-a-date').length && 
						!$(e.target).closest('.ui-datepicker-header').length
					){
						self.datePickerOpen = false;
						self.$datePicker.fadeOut();
					};
				})
				
				self.$datePicker.datepicker({
					onSelect: function(date, datePicker){
						var stashFilter = site.events.filter,
							dateObj = new Date(date),
							val = dateObj.yyyymmdd(),
							monthNames = [ "January", "February", "March", "April", "May", "June",
							    "July", "August", "September", "October", "November", "December" ],
							selected = monthNames[dateObj.getMonth()]+' '+dateObj.getDate()+', '+datePicker.selectedYear;
							
						self.datePickerOpen = false;
						self.$datePicker.fadeOut();
					
						self.startdate = val;
						self.page = 1;
						
						var query = {
							action: 'nygc_ajax_posts',
							startdate: self.startdate,
							type: 'upcoming',
							number_of_posts: 10,
							paged: self.page,
							post_type: 'events',
							category: 'all',
							nonce: nygcAjaxPosts.ajaxNonce
						};
						
						site.events.$eventsList[0].config.onMixEnd = function(config){
							site.events.filter = stashFilter;
							site.events.$eventsList.find('.mix').remove();
							site.events.$eventsList.mixitup('remix');
							self.$showingFrom.find('span').text(selected);
							self.$showingFrom.slideDown();
						
							self.requestEvents(query);
							
							site.events.$eventsList[0].config.onMixEnd = function(config){
								site.events.findVisible();
								site.events.filter = config.filter;
							};
						};
					
						site.events.$eventsList.mixitup('filter','none');
						site.events.$featuredEvent.mixitup('filter','none');
						self.$showingFrom.slideUp();
						
						site.events.$eventsList.addClass('loading-from-date');
					}
				});
			},
			requestEvents: function(query){
				var self = this;
				if(!self.loading && !$(this).hasClass('no-more')){
					self.loading = true;
					$.post(nygcAjaxPosts.ajaxURL, query, function(response){
						if(response){
							$.each(response,function(){
								if(this.type == 'blog'){
									var blogPost = this;
									
									$('<a href="'+blogPost.permalink+'" class="block-link mix event"> \
										<div class="image align-'+blogPost.imageAlign+'"> \
											'+blogPost.image+' \
										</div> \
										<div class="content"> \
											<h5>'+blogPost.categoryName+'</h5> \
											<h3>'+blogPost.title+'</h3> \
											<div class="event-meta"> \
												<time>'+blogPost.date+'</time> \
												<div class="read-more">Learn more</div> \
											</div> \
										</div> \
									</a> ').appendTo(site.events.$eventsList);
									
								} else {	
									var eventPost = this;
						
									eventPost.image = eventPost.image ? '<img src="'+eventPost.image+'" onload="imgLoaded(this, true)"/>' : '';
									eventPost.series = eventPost.series ? '<h5 class="series">'+eventPost.series+'</h5>' : '';
									
									eventPost.categoryName = eventPost.categoryName ? '<h5>'+eventPost.categoryName+'</h5>' : '';
						
									$('<a href="'+eventPost.permalink+'" class="mix event '+eventPost.categorySlug+'"> \
										<div class="image align-'+eventPost.imageAlign+'"> \
											'+eventPost.image+' \
											<div class="date"> \
												<span>'+eventPost.date1+'</span> \
												<span class="lrg">'+eventPost.date2+'</span> \
											</div> \
										</div> \
										<div class="content"> \
											'+eventPost.categoryName+' \
											'+eventPost.series+' \
											<h3>'+eventPost.title+'</h3> \
											<div class="event-meta"> \
												<p>'+eventPost.location+'</p> \
												<time>'+eventPost.time+'</time> \
												<div class="read-more">Learn more</div> \
											</div> \
										</div> \
									</a> ').appendTo(site.events.$eventsList);
								
								}

							});
					
							site.events.$eventsList.mixitup('remix',site.events.filter);
							self.page++;
						
							if(response.length < query.number_of_posts){
								self.noMore(query.type, query.post_type);
							};
						
						} else {
							self.noMore(query.type, query.post_type);
						};
						
						self.loading = false;
						
						site.events.$eventsList.removeClass('loading-more loading-from-date');
				
					}, 'json');
				};
			},
			noMore: function(type, postType){
				var self = this;
				
				if(postType == 'events'){
					verbage = type == 'upcoming' ? 'No More Upcoming Events' : 'No Older Events';
				} else{
					verbage = 'No Older Posts';
				};	
				
				self.$loadMore.addClass('no-more').find('span').text(verbage);
			}
		}
	},
	contactForm: {
		sending: false,
		init: function(){
			var self = this;
			
			self.$contactForm = $('#ContactForm');
			self.$checkSequencing = $('#CheckSequencing');
			self.$seqOps = $('#SequencingOptions');
			self.$checkOther = $('#CheckOther');
			self.$otherReason = $('#OtherReason');
			self.$submit = $('#Submit');
			self.$thankYou = $('#ThankYou');
			self.$reasons = $('#Reasons');
			self.$sendCopyTo = $('#SendCopyTo');
			
			self.bindHandlers();
			self.validationInit();
		},
		bindHandlers: function(){
			var self = this;
			
			self.$checkOther.on('change',function(){
				var $t = $(this);
				if($t.is(':checked')){
					self.$otherReason.addClass('show');
				} else {
					self.$otherReason.removeClass('show');
				};
			});
			
			self.$checkSequencing.on('change',function(){
				var $t = $(this);
				if($t.is(':checked')){
					self.$seqOps.addClass('show');
				} else {
					self.$seqOps.removeClass('show');
				};
			});
			
			self.$submit.on('click',function(){
				if(!self.sending){
					self.submit();
				};
			});
		},
		getEmails: function(){
			var self = this,
				emailList = '';
				
			self.$reasons.find('input').each(function(i){
				var $t = $(this);
				if($t.is(':checked')){
					var recipient = $t.attr('data-copyto'),
						emails[] = recipients.split(",");

						for (var i = 0; i < emails.length; i++) {
				          email = emails[i] + '@nygenome.org';
				        }
						//email = recipient+'@nygenome.org';
					
					if(emailList.indexOf(recipient) < 0){	
						emailList += recipient.length ? ', '+email : '';
					};
				};
			});
			
			emailList = emailList.substring(2);
			
			return emailList;
		},
		rules: {
			'input_12.3': {
				required: true
			},
			'input_12.6': {
				required: true
			},
			'input_2': {
				required: true
			},
			'input_3': {
				required: true,
				email: true
			},
			'input_4': {
				required: true
			},
			'input_8': {
				required: true
			}
		},
		validationInit: function(){
			var self = this;
			self.$contactForm.validate({
				invalidHandler: function(e, validator){
					var errors = validator.numberOfInvalids();
				},
				errorClass: 'invalid',
				errorElement: 'label',
				errorPlacement: function(error, element){
					var $field = $(element).closest('.field');
					$(error).appendTo($field);
				},
				rules: self.rules 
			});
		},
		validate: function(){
			var self = this;
			return self.$contactForm.valid();
		},
		submit: function(){
			var self = this,
				emailList = self.getEmails();
			
			self.$sendCopyTo.val(emailList);
				
			var formData = self.$contactForm.serialize();
		
			if(self.validate()){
				self.sending = true;
				
				if(typeof _gaq !== 'undefined'){
					site.analytics.events.formSubmission(formData);
				};
				
				self.$contactForm.addClass('loading');
				
				var formTop = self.$contactForm.offset().top;
				
				
				
				$.ajax({
					type: "POST",
				    url: self.$contactForm.attr('data-action'),
				    data: formData,
				    success: function(){
						$('body, html').animate({
							scrollTop: formTop-200
						}, 300, function(){
							self.$contactForm.fadeOut('slow',function(){
								self.$thankYou.fadeIn();
							});
						});
						self.$contactForm[0].reset;
				    }
				});
			};
		}
	},
	helpers: {
		highlightActive: function(){
			var obj = typeof peopleGroup === 'undefined' ? blogPost : peopleGroup,
				name = obj.name,
				$linkNames = $('#SubNav').find('span');
				
			$linkNames.each(function(){
				if(this.innerHTML == name){
					$(this).closest('li').addClass('current-menu-item');
				};
			});
		},
		bindSwipe: function($el){
			
			var swipe = false,
				swipeX = false,
				startX,
				startY,
				endX,
				endY,
				travelX,
				firstE = false,
				getEvent = function(e){
					var eData = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
					return eData;
				};

			$el.on('touchstart',function(e){
				swipe = true;
				e = getEvent(e);
				startX = e.pageX;
				startY = e.pageY;
			});

			site.$body.on('touchmove',function(e){
				if(swipe){
					
					var newE = getEvent(e);
					
					endX = newE.pageX;
					if(!firstE){
						endY = newE.pageY;
						firstE = true;
						travelY = endY - startY;
						travelX = endX - startX;
						travelY = - travelY > 0 ? -travelY : travelY;
						travelX = - travelX > 0 ? -travelX : travelX;
						angle = travelY/travelX;
						if(angle < 1){
							e.preventDefault();
							swipeX = true;
						};
					};
				};
			});

			site.$body.on('touchend',function(e){
				if(swipeX){
					swipe = false,
					swipeX = false,
					travelX = endX - startX;
					if(travelX > 15){
						$el.easyFader('changeSlides','prev');
					} else if(travelX < 15){
						$el.easyFader('changeSlides','next');
					};
				}
				firstE = false;
			});
		}
	},
	analytics: {
		init: function(){
			var self = this;
			
			if(!site.mobileLinks.active){
				self.bindHandlers();
			};
		},
		events: {
			carouselClick: function(caption){
				var href = caption.href,
					title = $(caption).find('h2').text();
					
				_gaq.push(['_trackEvent', 'Home Page Slide', 'Click', title]); 
				
                setTimeout('document.location = "' + href + '"', 100);
			},
			ctaClick: function(cta){
				var href = cta.href,
					title = $(cta).find('h3').text();
					
				_gaq.push(['_trackEvent', 'CTA', 'Click', title]); 
				
                setTimeout('document.location = "' + href + '"', 100);  
			},
			formSubmission: function(data){
				_gaq.push(['_trackEvent', 'Contact Form', 'Submission', data]); 
			},
			videoPlay: function(src){
				_gaq.push(['_trackEvent', 'Video', 'Play', src]); 
			},
			timelineClick: function(link){
				var href = link.href,
					$entry = $(link).closest('.entry'),
					title = $entry.find('h3').text().replace(/\s{2,}/g, ' ');
					
				_gaq.push(['_trackEvent', 'Timeline Entry', 'Click', title]); 

				setTimeout('document.location = "' + href + '"', 100);
			},
			search: function(form){
				var query = form.children[0].value;
				
				if(typeof _gaq !== 'undefined'){
					_gaq.push(['_trackEvent', 'Search', 'Submission', query]); 
					setTimeout(function(){
						form.submit();	
					}, 100);
				} else {
					form.submit();
				};
                
				return false;
			}
		},
		bindHandlers: function(){
			var self = this;
		
			$('.caption').on('click',function(e){
				e.preventDefault();
				self.events.carouselClick(this);
				return false;
			});
		
			$('.cta').on('click',function(e){
				e.preventDefault();
				self.events.ctaClick(this);
				return false;
			});
			
			$('#Timeline article.entry a').on('click', function(e){
				e.preventDefault();
				self.events.timelineClick(this);
				return false;
			});
		}
	},
	mobileLinks: {
		active: false,
		init: function(){
			var self = this;
			
			self.active = true;
			self.$links = $();
			
			self.$links = self.$links.add('.block-link');
			
			self.$links.each(function(){
				var $t = $(this),
					$btn = $();
				
				$t.on('click',function(e){
					e.preventDefault();
					return false;
				});
				
				if($t.find('.read-more').length){
					$btn = $t.find('.read-more');
				} else if($t.find('.btn').length){
					$btn = $t.find('.btn');
				};
			
				$btn.on('click',function(){
					if(typeof _gaq !== 'undefined' && ($t.hasClass('cta') || $t.hasClass('caption'))){
						if($t.hasClass('cta')){
							site.analytics.events.ctaClick($t[0]);
						} else if($t.hasClass('caption')){
							site.analytics.events.carouselClick($t[0]);
						};	
					} else {
						window.location = $t.attr('href');
					};
				});
			});
		}
	}
};

site.Video = function(){
	this.playing = false;
};

site.Video.prototype = {
	constructor: site.Video,
	instances: [],
	init: function($video){
		var self = this;
		
		self.$video = $video;
		self.id = $video.find('video')[0].id;
		self.$playPause = self.$video.find('.play-pause');
		self.$overlay = self.$video.find('.overlay');
		self.$poster = self.$video.find('.image');
		self.$caption = self.$video.find('.caption');
		self.$scrubber = self.$video.find('.total');
		self.$buffered = self.$video.find('.buffered');
		self.$current = self.$video.find('.current');
		self.$elapsed = self.$video.find('.elapsed');
		self.$dur = self.$video.find('.dur');
		self.$fullscreen = self.$video.find('.full-screen');
		self.$volume = self.$video.find('.volume');
		self.$volScrubber = self.$volume.find('.sensor');
		self.player = null;
		
		$.getScript(nygc.templateURL+'/js/video.dev.min.js',function(){
			videojs(self.id,{
				controls: false
			}).ready(function(){
				self.$video.removeClass('loading');
				self.player = this;
				self.bindHandlers();
			});	
		});
	},
	bindHandlers: function(){
		var self = this,
			drag = false;
		
		self.$overlay.add(self.$playPause).on('click',function(){
			if(!self.playing){
				self.play();
			} else {
				self.pause();
			};
		});
		
		self.$video.on('mousemove',function(){
			if(self.playing){
				clearInterval(self.timeout);
				self.$video.addClass('show-controls');
				self.hideControls();
			};
		});
		
		self.player.on('loadedmetadata',function(){
			self.renderTime();
			self.renderVol();
		});
		
		self.player.on('ended',function(){
			self.pause();
			self.$video.removeClass('video-mode show-controls');
		});
		
		self.$fullscreen.on('click',function(){
			self.player.requestFullScreen();
		});
		
		self.$scrubber.on({
			click: function(e){
				var width = self.$scrubber.width(),
					percent = (e.originalEvent.offsetX || e.pageX-self.$scrubber.offset().left) / width;
					
				self.seek(percent);
			},
			mousedown: function(e){
				e.originalEvent.preventDefault();
				drag = true;
				site.$window.on('mouseup.scrub', function(){
					drag = false;
					site.$window.off('mouseup.scrub');
				});
			},
			mousemove: function(e){
				if(drag){
					var width = self.$scrubber.width(),
						percent = (e.originalEvent.offsetX || e.pageX-self.$scrubber.offset().left) / width;
						
					percent = percent > 1 ? 1 : (percent < 0 ? 0 : percent);

					self.seek(percent);
				};
			}
		});
		
		self.$volScrubber.on({
			click: function(e){
				self.parseVol(e);
			},
			mousedown: function(e){
				e.originalEvent.preventDefault();
				drag = true;
				site.$window.on('mouseup.scrub', function(){
					drag = false;
					site.$window.off('mouseup.scrub');
				});
			},
			mousemove: function(e){
				if(drag){
					self.parseVol(e);
				};
			}
		});
	},
	parseVol: function(e){
		var self = this,
			width = 40,
			click = (e.originalEvent.offsetX || e.pageX-self.$volScrubber.offset().left) - 18,
			cleanClick = click < 0 ? 0 : click > 40 ? 40 : click,
			percent = cleanClick / width;
			
		self.player.volume(percent);
		self.renderVol(percent);
	},
	play: function(){
		var self = this,
			src = self.player.currentSrc();
		
		$.each(self.instances,function(){
			this.pause();
		});
		
		self.$video.addClass('video-mode playing show-controls');
		self.playing = true;
		self.player.play();
		self.loop = setInterval(function(){
			self.renderTime();
		},1000 / 60);
		self.renderVol();
		
		self.hideControls();

		site.analytics.events.videoPlay(src);
	},
	pause: function(){
		var self = this;
		
		self.$video.removeClass('playing');
		clearInterval(self.timeout);
		clearInterval(self.loop);
		self.$video.addClass('show-controls');
		self.playing = false;
		self.player.pause();
	},
	hideControls: function(){
		var self = this;
		
		self.timeout = setTimeout(function(){
			self.$video.removeClass('show-controls');
		},3000);
	},
	renderTime: function(){
		var self = this;
		
		self.playbackData = {
			duration: vidDur || self.player.duration(),
			totalTime: self.formatTime(vidDur),
			currentTime: self.formatTime(self.player.currentTime()),
			currentPercent: (self.player.currentTime() / vidDur) * 100,
			bufferedPercent: (self.player.buffered().end(0) / vidDur) * 100
		};
		
		self.$dur.text(self.playbackData.totalTime);
		self.$elapsed.text(self.playbackData.currentTime);
		self.$buffered.css('width',self.playbackData.bufferedPercent+'%');
		self.$current.css('width',self.playbackData.currentPercent+'%');
		
	},
	renderVol: function(percent){
		var self = this,
			volume = percent || self.player.volume(),
			sixth = 1/6;
			$bars = self.$volume.find('.bar');
			
			
		self.$volume.removeClass('mute');
		$bars.removeClass('on');

		switch(true){
			case(volume == 0):
				self.$volume.addClass('mute');
				break;
			case(volume < sixth):
				$bars.slice(0,1).addClass('on');
				break;
			case(volume < 2*sixth):
				$bars.slice(0,2).addClass('on');
				break;
			case(volume < 3*sixth):
				$bars.slice(0,3).addClass('on');
				break;
			case(volume < 4*sixth):
				$bars.slice(0,4).addClass('on');
				break;
			case(volume < 5*sixth):
				$bars.slice(0,5).addClass('on');
				break;
			default:	
				$bars.slice(0,6).addClass('on');
		};
	},
	seek: function(percent){
		var self = this,
			seekTo = vidDur * percent;
			
		self.player.currentTime(seekTo);
		self.renderTime();
	},
	formatTime: function(timeDecimalValue, ms){
	    var hours = Math.floor(timeDecimalValue / 60 / 60),
	    	minutes = Math.floor((timeDecimalValue / 60) % 60),
	   		seconds = Math.floor(timeDecimalValue % 60),
			millisecs = ms ? (timeDecimalValue - Math.floor(timeDecimalValue)).toFixed(3) * 1000 : false,
	   		theTime = (hours < 1 ? "" : (hours + ":")) + (minutes < 10 ? ("0" + minutes) : minutes) + ":" + (seconds < 10 ? "0" + seconds : seconds) + (millisecs ? ('.'+millisecs) : "");
	    
		return theTime;
	}
};
	
	

$(function(){
	
	FastClick.attach(document.body);
	
	// PLATFORM DETECT
	
	site.platform();
	
	// HEADER
	
	site.header.init();
	
	// HOME
	
	if($('#Home').length){
		site.home.init();
	};
	
	// SINGLE PEOPLE
	
	if($('#SinglePerson').length || $('#SinglePost').length){
		site.helpers.highlightActive();
	};
	
	// FILTERED EVENTS/BLOG
	
	if($('#EventsList').length){
		site.events.init();
	};
	
	// CONTACT FORM
	
	if($('#ContactForm').length){
		site.contactForm.init();
	};
	
	// MOBILE LINKS
	
	if(site.touch){
		site.mobileLinks.init();
	};
	
	// ANALYTICS
	
	if(typeof _gaq !== 'undefined'){
		site.analytics.init();
	};
	
	// VIDEO
	
	if($('#Video').length){
		var video = new site.Video;
		
		video.init($('#Video'));
	};
	
	if($('#Timeline').length){
		$('#Timeline div.video').each(function(){
			var video = new site.Video;
			
			site.Video.prototype.instances.push(video);
			video.init($(this));
		});
	};
	
});	

Date.prototype.yyyymmdd = function() {
	var yyyy = this.getFullYear().toString(),
		mm = (this.getMonth()+1).toString(),
		dd  = this.getDate().toString();
   return yyyy + (mm[1]?mm:"0"+mm[0]) + (dd[1]?dd:"0"+dd[0]);
};