// using "jQuery" here instead of the dollar sign will protect against conflicts with other libraries like MooTools
jQuery(document).ready(function() {

    //Set default Jacked ease
    Jacked.setEase("Expo.easeOut");
	Jacked.setDuration(500);
    Jacked.setEngines({
        firefox: true,
        opera: true,
        safari: true,
		ios: true
    });
    jQuery.easing.def = "easeOutExpo";
    jQuery.ezio();

});

// plugin structure used so we can use the "$" sign safely
 (function($) {

    //main vars
    var mainContainer;
	var scrollTop;
	var win;
	var contWidth;
	var prevContWidth;
	var isMobile;
	var isIE8;
	var isIE;
	
	//Pages
	var logo;
	var logoMarginTop;
    var homePage;
	var animateSkills = false;
	var skillsHaveAnimated = false;
	var sglCont;
	var mediaCont;
	var txtCont;
	var pHeading;
	var pSubHeading;
	var pPara;
	var pLink;
	var curPortFig = null;
	var winH;
	var blurW;
	var blurC;
	var isBlog;
	var curMenuItem;
	var menuBg;
	var menuLeft;
	var menuClicked = null;


    // class constructor / "init" function
    $.ezio = function() {
		
		
		
        // write values to global vars, setup the plugin, etc.
        browser = Jacked.getBrowser();
        isMobile = (Jacked.getMobile() == null) ? false : true;
		isBlog = $('body').hasClass('blog') ? true : false;
		isIE8 = Jacked.getIE();
		
		isIE = browser == 'ie' ? true : false;
		
		//conditional compilation
		var isIE10 = false;
		/*@cc_on
			if (/^10/.test(@_jscript_version)) {
				isIE10 = true;
			}
		@*/
		if(isIE10) isIE = true;
		
		
		if(isMobile){
		  $('html').addClass('mobile');	
		}


		
		//Save DOM elements
		win = $(window);
		//$("html,body").scrollTop(100).scrollTop(0);
		//$("html,body").animate({ scrollTop: 0 }, "slow");
		//$(document).scrollTop();
		$.scrollTo(10, 10);
		$.scrollTo(1, 10);
		homePage = $('#home');

		mainContainer = $('.container');
        contWidth = mainContainer.width();
		prevContWidth = contWidth;
		
		//handle window events
		$(window).resize(function() {						  
             handleWindowResize();
		});
		handleWindowResize();
		

		//Init
		initSite();
		initMenu();
		initParallax();
		initInputFields();
		initContactForm();
		initNewsletter();;
		initSectionBackgrounds();
		initTabs();
		initPortfolio();
		initSocialIcons();
		initSkills();
		//initTxtFx();
		initFlexSlider();
		scaleIframes();
		initAccordion();
		
		

    }
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //TEXT FX
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
	function initSite(){
		
		if(document.readyState === "complete"){
			loadBgImage();
			
		}
		else{
			
			window.onload = function() {
			    loadBgImage();
				resizeFigHover();
				
			}
			
		}
		
	}
	
	
	function loadBgImage() {

        var img = $("<img />").attr("src", $('html').css('background-image').split('"')[1]);
		logo = $('#home .logo');
		logoMarginTop = parseInt(logo.css('margin-top'), 10);
		logo.css('margin-top', '-1000px');
		
		
		if($(img)[0].complete){

			$('.preloader.main').add('.homeFade').fadeOut(1000);
			logo.animate({ 'margin-top': logoMarginTop }, 1000);
			$('#home').add($('.mainnav')).add($('.blur')).css({'opacity' : 0,'visibility': 'visible'}).animate({ opacity: 1 }, 1000);
			
			initTxtFx();

			
		}
		else{
		   img.load(bgLoaded);
		}
		

    }
	
	function bgLoaded(event) {
		event.stopPropagation();
		$('.preloader.main').fadeOut(1000);
		$('.homeFade').delay(200).fadeOut(1000);
		logo.animate({ 'margin-top': logoMarginTop }, 1000);
		$('#home').add($('.mainnav')).add($('.blur')).css({'opacity' : 0,'visibility': 'visible'}).animate({ opacity: 1 }, 1000);
		
		initTxtFx();
	}
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //TEXT FX
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
	function initTxtFx(){
		
		if($('.slogan').length){
			var slogan = $('.slogan');
			var txt = slogan.attr('data-text');
			
			slogan.shuffleLetters({
				"text": txt
			});
		}
		
		
	}
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //ACCORDION
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    function initAccordion() {

        if ($('.acc').length) {
			
			//var accordion;
			
			$('.acc').each(function(i) {
									
				var ac = $(this);
				var openSection = parseInt(ac.attr('data-open'), 10);
				var as = ac.find('.acc-section');
				var h = ac.find('h4');
				var activeS = null;
				var activeH = null;
				
				//collapse all content
				as.css('display', 'none');
				
				//click
			    h.click(function() {
					
					var c = $(this);
					var s = c.parent().find('.acc-section');
					
					if(!c.hasClass('acc-selected')){
						
						if(activeS){
							activeH.removeClass('acc-selected');
							activeS.slideUp();
						}
						
						c.addClass('acc-selected');
						s.slideDown();
						activeS = s;
						activeH = c;
					}
					else{
						
						c.removeClass('acc-selected');
						s.slideUp();
						activeS = null;
						activeH = null;
						
					}
					
				});
				
				
				if(openSection > 0){
				   openSection -= 1;
				   ac.find('h4').eq(openSection).click();
				}
				
				
				
			});

        }

    }
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //SOCIAL ICONS
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    function initSocialIcons() {
		
		$(".socialIcons.text li").each(function() {
				
				var l = $(this);
				var a = l.find('a');
				var u = a.attr('href');
				var t = a.attr('target');
				
				a.click(function(e) {
				   e.preventDefault();
				});
				
				l.click(function() {
				   window.open(u, t);
				});
				
		});
		
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //MENU
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    function initPortfolio() {
		
		sglCont = $(".portfolioSingle");
	    mediaCont = sglCont.find('.twothird');
	    txtCont = sglCont.find('.onethird').not('nav');

		
		var curSingle = 0;
		var figSelected = null;
		var curPortfolio;
		var curPortfolioTotal;
		
		var sep = $("<div />").addClass('separator dotted').appendTo(txtCont);
		pHeading = $("<h3 />").appendTo(txtCont);
		pSubHeading = $("<h4 />").appendTo(txtCont);
		sep = $("<div />").addClass('separator dotted').appendTo(txtCont);
		pPara = $("<p />").appendTo(txtCont);
		pLink = $("<a />").addClass('button small reverted').appendTo(txtCont);
		
		
		setFigHover();
		
		$("#portfolio figure").each(function(i) {
				
				var fig = $(this);
				

				//Portfolio single
				fig.click(function() {
								   
                    var f = $(this);
					curPortFig = f;
					if(figSelected) figSelected.removeClass('selected');
					f.addClass('selected');
					figSelected = f;
					curSingle = i;
					curPortfolio = f.parent().parent();
					curPortfolioTotal = curPortfolio.find('figure').length;
					
					//$.scrollTo(curPortFig, 500, {offset: -60});
					loadPortfolioSingle(f);
					
				});

		});
		
		//single navigation
		var closeBtn = $(".portfolioSingle nav .close");
		var nextBtn = $(".portfolioSingle nav .next");
		var prevBtn = $(".portfolioSingle nav .prev");
		
		closeBtn.click(function() {
			sglCont.slideUp(500, function() {
				if(sglCont.find('iframe').length){
					mediaCont.html('');
				}
			});
			
			if(figSelected){
				figSelected.removeClass('selected');
				figSelected = null;
			}
			
			$.scrollTo(sglCont.parent().parent(), 500, {offset: 0});
		});
		
		nextBtn.click(function() {		   
				curSingle = (curSingle < curPortfolioTotal-1) ? curSingle = curSingle+1 : curSingle = 0;
				loadPortfolioSingle(curPortfolio.find('figure').eq(curSingle));
				
				if(figSelected) figSelected.removeClass('selected');
					curPortfolio.find('figure').eq(curSingle).addClass('selected');
					figSelected = curPortfolio.find('figure').eq(curSingle);
		});
		
		prevBtn.click(function() {		   
				curSingle = (curSingle > 0) ? curSingle = curSingle-1 : curSingle = curPortfolioTotal-1;
				loadPortfolioSingle(curPortfolio.find('figure').eq(curSingle));
				
				if(figSelected) figSelected.removeClass('selected');
					curPortfolio.find('figure').eq(curSingle).addClass('selected');
					figSelected = curPortfolio.find('figure').eq(curSingle);
		});
		
		
	};
	
	function setFigHover(){
		
		if(document.readyState === "complete"){
			resizeFigHover();
		}
		else{
			
			/*
			window.onload = function() {
			    resizeFigHover();
			}
			*/
			
		}
		
		
		
	}
	
	function resizeFigHover(){
		
		$("#portfolio figure").each(function(i) {
				
				var fig = $(this);
				var img = fig.find('img');
				var cont = fig.parent();
				var cap = fig.find('figcaption');
				var hh = cap.find('h4').height()/2;
				var lh = cap.height()/2;
				var diffH = lh-hh;
				var cw = fig.width();
                

				var ow = fig.width();
				var oh = fig.height();

				var ratio = ow/oh;
				
				var rh = cw/ratio;
				
		        if(!isIE8){
					cap.css({
						width: cw-20+'px',
						paddingTop: (rh-20)/2-hh+1+'px',
						paddingBottom: (rh-20)/2-hh-diffH-19+'px',
						marginTop: '10px',
						marginLeft: '10px'
					}).removeClass('hidden');
				}
				else{
					cap.css({
						width: cw+'px',
						paddingTop: (rh)/2-lh+8+'px',
						paddingBottom: (rh)/2-lh+'px'
					});
				}
				
		});
		
	}
	
	
	function emptySinglePortfolio(){
		
		
		$('<div class="one sPreloader row"><div class="preloader"></div></div>').insertAfter(curPortFig.parent());
		
		mediaCont.add(txtCont).css('opacity', 0);
		sglCont.addClass('hidden');
		
		
		
		
		//remove previous
		if(sglCont.find('img').length){
			sglCont.find('img').remove();
		}
		if(sglCont.find('iframe').length){
			mediaCont.html('');
		}
		if(sglCont.find('.flexslider').length){
			mediaCont.html('');
		}
					
	}
	
	function loadPortfolioSingle(itm){
		
		var f = itm;
		
		
		var media = f.attr('data-largeMedia');
		var flexAr = media.split(',');
		var type = f.attr('data-mediaType');
		pHeading.html(f.attr('data-largeTitle'));
		pSubHeading.html(f.attr('data-subTitle'));
		pPara.html(f.attr('data-largeDesc'));
		
		if(f.attr('data-link') != ''){
			pLink.css('display','inline-block');
			pLink.html(f.attr('data-link'));
			pLink.attr('href', f.attr('data-url')).attr('target', f.attr('data-target'))
		}
		else{
			pLink.css('display','none');
		}


		if(type == 'image'){
			
			if(flexAr.length > 1){
				loadFlexSlider(flexAr, mediaCont);
			}
			else{
		       loadPortfolioImage(media, mediaCont);
			}
		}
		else if(type == 'youtube'){
			var htm = '<iframe width="640" height="359" src="http://www.youtube.com/embed/' + media + '?hd=1&amp;wmode=opaque&amp;showinfo=0" frameborder="0" allowfullscreen ></iframe>';
			emptySinglePortfolio();
			mediaCont.html(htm);
			scaleIframes();
			$('.sPreloader').remove();
			
			if(!isMobile || contWidth>= 768){
				sglCont.insertAfter(curPortFig.parent()).removeClass('hidden').slideDown();
			}
			else{
				sglCont.insertAfter(curPortFig).removeClass('hidden').slideDown();	
			}
			
			mediaCont.add(txtCont).animate({ opacity: 1 }, 1000);
			$.scrollTo(curPortFig, 500, {offset: -60});
		}
		else if(type == 'vimeo'){
			var htm = '<iframe width="640" height="360" src="http://player.vimeo.com/video/' + media +'" frameborder="0" allowfullscreen ></iframe>';
			emptySinglePortfolio();
			mediaCont.html(htm);
			scaleIframes();
			$('.sPreloader').remove();
			if(!isMobile || contWidth>= 768){
				sglCont.insertAfter(curPortFig.parent()).removeClass('hidden').slideDown();
			}
			else{
				sglCont.insertAfter(curPortFig).removeClass('hidden').slideDown();	
			}
			mediaCont.add(txtCont).animate({ opacity: 1 }, 1000);
			$.scrollTo(curPortFig, 500, {offset: -60});
		}
		
	}
	
	
	function loadPortfolioImage(path, cont) {
        emptySinglePortfolio();
        var img = $("<img />").addClass('scaletofit').appendTo(cont);
        img.attr("src", path);
		
		if($(img)[0].complete){
			img.appendTo(cont);
			$('.sPreloader').remove();

			if(!isMobile || contWidth>= 768){
				sglCont.insertAfter(curPortFig.parent()).removeClass('hidden').slideDown();
			}
			else{
				sglCont.insertAfter(curPortFig).removeClass('hidden').slideDown();	
			}
			mediaCont.add(txtCont).animate({ opacity: 1 }, 1000);
			$.scrollTo(curPortFig, 500, {offset: -60, delay: 1000});
			
		}
		else{
			$.scrollTo('.sPreloader', 500, {offset: -170});
		    img.load(portfolioImgLoaded);
		}
		

    }
	
	function portfolioImgLoaded(event) {
		event.stopPropagation();
		$('.sPreloader').remove();
		if(!isMobile || contWidth>= 768){
				sglCont.insertAfter(curPortFig.parent()).removeClass('hidden').slideDown();
			}
			else{
				sglCont.insertAfter(curPortFig).removeClass('hidden').slideDown();	
			}
		mediaCont.css('opacity', 0).add(txtCont).animate({ opacity: 1 }, 1000);
		$.scrollTo(curPortFig, 500, {offset: -60});
	}
	
	function loadFlexSlider(ar, cont) {
		
		var fCont = $('<div/>').addClass('flexslider arrowvisible').attr('data-arrows', true).attr('data-thumbnail', false);
		var fList = $('<ul/>').addClass('slides').appendTo(fCont);
	
		for(var i=0;i<ar.length;i++){
			 var li = $('<li/>').appendTo(fList);
			 var img = $('<img/>').attr('src', ar[i]).appendTo(li);
		}
	    emptySinglePortfolio();
		fCont.appendTo(cont);
		
		$('.sPreloader').remove();
		if(!isMobile || contWidth>= 768){
				sglCont.insertAfter(curPortFig.parent()).removeClass('hidden').slideDown();
			}
			else{
				sglCont.insertAfter(curPortFig).removeClass('hidden').slideDown();	
			}
		mediaCont.add(txtCont).animate({ opacity: 1 }, 1000);
		initFlexSlider();
		$.scrollTo(curPortFig, 500, {offset: -60});

    }
	
	
	
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //MENU
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    function initMenu() {
		
		var menu = $('.mainnav');
		var menuList = $('.mainnav .menu ul');
		var dropDown = $(".mainnav .menu select");
		var menuHasAnimated = false;
		menuBg = $('.menuBg');
		var firstMenuItem = menuList.find('li a.selected').parent();
		var isMenuFirstItem = (firstMenuItem == menuList.find('li').first()) ? true : false;
		curMenuItem = firstMenuItem;
		var firstPos = firstMenuItem.position();
		menuLeft = parseInt(menuList.css('margin-left'), 10);
		
		var scrollBtn = $('.scrollBtn');
		var scrollTxt = $('.scrollTxt span');
		var scrollTarget = scrollBtn.attr('data-targetSection')
		
		winH = win.height();
		scrollTop = $(window).scrollTop();
		handleBlur();

		menu.localScroll(800);
		
		
		//home button
		scrollBtn.add(scrollTxt).click(function() {
				$.scrollTo(scrollTarget, 1000);				 
		});
		
		scrollTxt.mouseover(function() {
		  scrollBtn.addClass('over');
		}).mouseout(function() {
		  scrollBtn.removeClass('over');
		});
		
		//menu bg
		menuBg.css({
		    'height': 53+'px',
			'width': firstMenuItem.width()+'px',
			'left': isMenuFirstItem ? firstPos.left+menuLeft+'px' : firstPos.left+menuLeft+10+'px'
		});

		
		
		//check if deeplinking value
		var tag = window.location.href.split('#')[1];
		if(tag){
			tag = '#'+tag;
			$(window).load(function() {
				$.scrollTo(tag, 10);
			});
		}


        // Populate dropdown with menu items
        $(".mainnav .menu a").each(function(i) {

            var el = $(this);
			var li = el.parent();
			li.attr('num', i);
			
			var pos = li.position();
            var optSub = el.parents('ul');
            var len = optSub.length;
            var subMenuDash = '&#45;';
            var dash = Array(len).join(subMenuDash);

            $("<option />", {
                "value": el.attr("href"),
                "html": dash + el.text()
                }).appendTo(dropDown);
			
			el.click(function() {
				//menuClicked = $(this);				  
			});
			
			
			
        });
		


        dropDown.change(function() {
			if($(this).find("option:selected").val().split('html').length < 2){
			   $.scrollTo($(this).find("option:selected").val(), 1000);
			}
			else{
				window.open($(this).find("option:selected").val(), '_self');
			}
        });
		

		

		//menu scroll
		
			$(window).scroll(function() {
				
				if(!isBlog){
					
					updateMenuHighlight();
					handleBlur();
										  
					scrollTop = $(window).scrollTop();
					winH = win.height();

					if(scrollTop>= winH){
						
						
						menu.css({
							position: 'fixed',
							top: 0,
							left: 0,
							width: '100%'
						});
	
			
					}
					else{
						
						menu.css({
							position: 'fixed',
							top: winH-scrollTop
						});
						
					}
					
				}
				else{
					sortMenuBg();
				}
				
			});
			
			
			//var curPage = $('.mainnav a').eq(i).attr('href').split('#')[1];
		    var curAddress = window.location.href.split('#')[1];
			
			if(curAddress){	
               win.scrollTop(0);
			   setTimeout(function(){
				  $.scrollTo('#'+curAddress, 1000, {offset: 0});
				},300);	
			   
			}
			

	


    }
	
	/////////////////////////////////////////////////////////////////////////////
	//MENU HIGHLIGHT WHEN PAGE SCROLL
	/////////////////////////////////////////////////////////////////////////////
	function updateMenuHighlight(){
		
		var topRange = 400;
		var contentTop		=	[];
		var contentBottom	=	[];
		var content	=	[];
		var winTop	=	$(window).scrollTop();
		var rangeTop	=	400;
		var rangeBottom	=	400;

		$('.mainnav a').each(function(){
			if($(this).attr('href').split('#')[0] == ""){
				content.push( $( $(this).attr('href') ) );
				contentTop.push( $( $(this).attr('href') ).offset().top );
				contentBottom.push( $( $(this).attr('href') ).offset().top + $( $(this).attr('href') ).height() );
			}
		})

		$.each( contentTop, function(i){

			if ( winTop > contentTop[i] - rangeTop && winTop < contentBottom[i] - rangeBottom ){
				
				//check for and animate skills

				if(content[i].find('.progresscircles').length && !animateSkills && !isIE8){
				   	animateSkills = true;
				    initSkills();
				}
				
				if(content[i].find('.progressbars').length && !skillsHaveAnimated){
					
				   skillsHaveAnimated = true;	
				   initProgressBars();
				}
				
				
					
				//highlight menu
				$('.mainnav a').removeClass('selected').eq(i).addClass('selected');
				
				
				//bg anim
				curMenuItem = $('.mainnav a').eq(i).parent();
				sortMenuBg();
				

				
			}

		})
		
		
		
	}
	
	function sortMenuBg(){
		
		var pos = curMenuItem.position();
				
		if(pos.left != 0){
		
			menuBg.stop().animate({ 
			'width': curMenuItem.width()+'px',
			'left': contWidth >= 1000 ? pos.left+menuLeft+10+'px' : pos.left+menuLeft+'px'
			}, 500);
		}
		else{
		
			menuBg.stop().animate({ 
			'width': curMenuItem.width()+'px',
			'left': pos.left+menuLeft+'px'
			}, 500);
			
		}
		//win.scroll();
		
	}
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //TABS
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    function initTabs() {

        //check if tabs exists
        if ($('.tabs').length) {

            var coolTabs = $(".tabs");
            var auto = coolTabs.attr('data-autoPlay') == "true" ? true: false;
            var delay = parseInt(coolTabs.attr('data-autoDelay'), 10);

            coolTabs.tabs({
                show: function(event, ui) {
                    var lastOpenedPanel = $(this).data("lastOpenedPanel");
                    if (!$(this).data("topPositionTab")) {
                        $(this).data("topPositionTab", $(ui.panel).position().top)
                        }
                    // do crossfade of tabs
                    $(ui.panel).hide().css('z-index', 2).fadeIn(300, function() {
                        $(this).css('z-index', '');
                        if (lastOpenedPanel) {
                            lastOpenedPanel.toggleClass("ui-tabs-hide").hide();
                        }
                    });

                    $(this).data("lastOpenedPanel", $(ui.panel));
                }
            });

            if (auto) {
                coolTabs.tabs('rotate', delay);
            }

            }
			

    }
	
	
	
	function textWidth(txt, fontSize, isHtml) {
		
        var html_calc;
		
		if(isHtml){
			html_calc = $('<span>' + txt.html() + '</span>');
		}
		else{
			html_calc = $('<span>' + txt + '</span>');
		}
        html_calc.css('font-size', fontSize + 'px').hide();
        html_calc.prependTo('body');
        var width = html_calc.width();
        html_calc.remove();
        return width;
    }
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //BACKGROUND PATTERNS
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
	function initSectionBackgrounds(){
		
		$('.wrapper').each(function(){
									
			var w = $(this);
			var db = w.attr('data-pattern');
			
			if(db && db != ""){
			   
			   w.css({
					backgroundImage: 'url(' + db + ')',
					backgroundRepeat: 'repeat'
				});
			}
									 
		});
		
		$('.footerPattern').each(function(){
									
			var w = $(this);
			var db = w.attr('data-pattern');
			
			if(db && db != ""){
			   
			   w.css({
					backgroundImage: 'url(' + db + ')',
					backgroundRepeat: 'repeat'
				});
			}
									 
		});
		
	}
	
	
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //MAKE IFRAMES RESPONSIVE
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    function scaleIframes() {

        if ($('.scaleframe').length) {

			$('.scaleframe').fitVids();

        }

    }

	
	/////////////////////////////////////////////////////////////////////////////
	//Init parallax
	/////////////////////////////////////////////////////////////////////////////
	
	function initParallax(){

        //.parallax(xPosition, speedFactor, outerHeight) options:
        //xPosition - Horizontal position of the element
        //inertia - speed to move relative to vertical scroll. Example: 0.1 is one tenth the speed of scrolling, 2 is twice the speed of scrolling
        //outerHeight (true/false) - Whether or not jQuery should use it's outerHeight option to determine when a section is in the viewport
		
		//No parallax on mobile
		if(!isMobile){
			$('#about .wrapper.footer').parallax("50%", 0.1);
		    $('#portfolio .wrapper.footer').parallax("50%", 0.1);
		}
		else{
			$('#about .wrapper.footer').addClass('.bgscroll');
			$('#portfolio .wrapper.footer').addClass('.bgscroll');
			
		}
		
	}
	
	
	
	/////////////////////////////////////////////////////////////////////////////
	//Init skills
	/////////////////////////////////////////////////////////////////////////////
	
	function initProgressBars(){
		
		if ($('.progressbars').length) {
			
			$('.progressbars').each(function() {
									   
				var s = $(this);
				
				s.find('.over').each(function(i) {
											  
					var o = $(this);
					var pct = o.attr('data-percentage');

					
					o.delay(200*(i+1)).animate({
							width: pct+'%'
						}, 2000
					);
					
				});
									
			});
			
		}
		
	}
	

	/////////////////////////////////////////////////////////////////////////////
	//Init skills
	/////////////////////////////////////////////////////////////////////////////
	
	function initSkills(){
		
		if ($('.progresscircles').length) {
			
			$('.progresscircles').find('svg').remove();
			
			$('.progresscircles').each(function(i) {
									   
				var s = $(this);
				var contWidth = s.width();
				var arc = s.find('.arc');
				arc.attr('id', 'arc'+i);
				
				var amount = arc.attr('data-percent');
				var strkw = arc.attr('data-stokewidth');
				var sign = arc.attr('data-sign');
				var fontSize = arc.attr('data-fontSize');
				var circleColor = arc.attr('data-circleColor');
				var strokeColor = arc.attr('data-strokeColor');
				var textColor = arc.attr('data-textColor');
				var circleSize = arc.attr('data-size');
				
				var fullSize = parseInt(circleSize, 10)+parseInt(strkw, 10);

				var interval;
				

                //Create raphael object
				var r = Raphael('arc'+i, fullSize, fullSize);
				
				//draw inner circle
				r.circle(fullSize/2, fullSize/2, circleSize/2).attr({ stroke: 'none', fill:  circleColor });
	
				//add text to inner circle
				var title = r.text(fullSize/2, fullSize/2, 0+sign).attr({
					font: fontSize+'px Oswald',
					
					'font-weight': '300',
					
					fill: textColor
				}).toFront();
				
				
				r.customAttributes.arc = function (xloc, yloc, value, total, R) {
					
					
					var alpha = 360 / total * value,
						a = (90 - alpha) * Math.PI / 180,
						x = xloc + R * Math.cos(a),
						y = yloc - R * Math.sin(a),
						path;
					if (total == value) {
						path = [
							["M", xloc, yloc - R],
							["A", R, R, 0, 1, 1, xloc - 0.01, yloc - R]
						];
					} else {
						path = [
							["M", xloc, yloc - R],
							["A", R, R, 0, +(alpha > 180), 1, x, y]
						];
					}
					return {
						path: path
					};
				};
				
				//make an arc at 150,150 with a radius of 110 that grows from 0 to 40 of 100 with a bounce
				var my_arc = r.path().attr({
					"stroke": strokeColor,
					"stroke-width": strkw,
					arc: [fullSize/2, fullSize/2, 0, 100, circleSize/2]
				});
				
				
				var anim = Raphael.animation({
					arc: [fullSize/2, fullSize/2, amount, 100, circleSize/2]
				}, 1500, "easeInOut");
				
				eve.on("raphael.anim.frame.*", onAnimate);
				

				function onAnimate() {
					var howMuch = my_arc.attr("arc");
					title.attr("text", Math.floor(howMuch[2]) + sign);
				}
				
				if(animateSkills || isIE8){
					my_arc.animate(anim.delay(i*200));
				}
				
				
				
				
			});
			
		}
		
	}
	
	
	
	
	
	function rgb2hex(rgb) {
		rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
		function hex(x) {
			return ("0" + parseInt(x).toString(16)).slice(-2);
		}
		return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
	}
	

	

	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //FLEX SLIDER
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    function initFlexSlider() {

        if ($('.flexslider').length) {
			
			
			var s = $('.flexslider');
			var useArrows = s.attr('data-arrows') == 'true' ? true : false;
			var useThumbs = s.attr('data-thumbnail') == 'true' ? true : false;


            s.flexslider({
                animation: "slide",
                video: false,
                directionNav: useArrows,
				controlNav: useThumbs,
				pauseOnAction: true,
                pauseOnHover: true,
				slideshow: false,
                start: function(slider) {
                    //$('body').removeClass('loading');
                    }
            });

        }

    }
	

	/////////////////////////////////////////////////////////////////////////////////////////////////////////
    //CONTACT FORM - INPUT FIELDS - NEWSLETTER
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
	
    function initNewsletter() {

        $('.mailchimp').submit(function() {

                var action = $(this).attr('action');
                var values = $(this).serialize();
				
				$.post(action, values, function(data) {
												
						$('.mailchimp input[type=submit]').fadeOut(500, function () {
						  $('.mcresult').hide().html(data).fadeIn();
						  setTimeout(resetMailchimp,5000);
						});
                        
						
                 });

                return false;

            });

    }
	
	function resetMailchimp(){
		
		$('.mcresult').html('');
		$('.mailchimp input[type=submit]').fadeIn(500);
		
		$('.mailchimp input[type=text]').each(function() {
													  
				var ipt = $(this);
				ipt.hide().val(ipt.attr('oValue')).fadeIn();
		});
		
	}
	
	function initInputFields(){
		
            var curVal;
			
			
			$('input[type=text]').each(function() {
					var ipt = $(this);
					ipt.attr('oValue', ipt.val());
					
					ipt.focus(function() {
						curVal = ipt.val();
						
						if(curVal == ipt.attr('oValue')){
						   ipt.val('');
						}
						
						ipt.parent().addClass('focus');
						
					});
					
					ipt.blur(function() {
						if (ipt.val() == '') {
							ipt.val(curVal);
						}
						ipt.parent().removeClass('focus');
					});
					
			});
			
			$('textarea').each(function() {
										
					var ipt = $(this);
					ipt.attr('oValue', ipt.val());
					
					ipt.focus(function() {
						curVal = ipt.val();
						
						if(curVal == ipt.attr('oValue')){
						   ipt.val('');
						}
						
					});
					
					ipt.blur(function() {
						if (ipt.val() == '') {
							ipt.val(curVal);
						}
					});
					
			});
			
		
	}

    function initContactForm() {



            $('#contactform').submit(function() {


                var action = $(this).attr('action');
                var values = $(this).serialize();

                $('#contactform #submit').attr('disabled', 'disabled').after('<img src="images/contact/ajax-loader.gif" class="loader" />');


                $("#message").slideUp(750, function() {

                    $('#message').hide();

                    $.post(action, values, function(data) {
                        $('#message').html(data);
                        $('#message').slideDown('slow');
                        $('#contactform img.loader').fadeOut('fast', function() {
                            $(this).remove()
                            });
                        $('#contactform #submit').removeAttr('disabled');
                        if (data.match('success') != null){
                            //$('#contactform').slideUp('slow');
						}

                    });

                });

                return false;

            });

      

    }
	
	/////////////////////////////////////////////////////////////////////////////
	//handleBlur
	/////////////////////////////////////////////////////////////////////////////
	function handleBlur(){
		
        scrollTop = $(window).scrollTop();
		winH = win.height();
		var winW = win.width(); 
		blurW = $('.blur');
		blurC = $('.blur .blr');
		var blurO = $('.blur .overlay');
		
		if(isMobile){
			blurC.add(blurO).removeClass('container').css('width', '100%');
		}
		
		blurW.css('top', scrollTop+'px');
		blurC.add(blurO).css({
			'top': winH-scrollTop+'px',
			'margin-left': Math.floor(-blurC.width()/2)
		});
		
		
		
		if(scrollTop>= winH || isBlog){
	
					
			blurC.add(blurO).css({
				left: winW/2+'px',			 
				'top': 0+'px'
			});
			

		}
		else if(!isMobile && !isBlog){
			
			
			blurC.add(blurO).css({
				left: winW/2+'px',
				'top': winH-scrollTop+'px'
			});
		
	
		}
		
		

		
	}
	
	
    /////////////////////////////////////////////////////////////////////////////
	//handleWindowResize
	/////////////////////////////////////////////////////////////////////////////
	function handleWindowResize(){
        

		contWidth = mainContainer.width();
		handleBlur();
		win.scroll();
		

		if (contWidth != prevContWidth) {
			
			prevContWidth = contWidth;
			setFigHover();
			sortMenuBg();
			
			//small hack for menu bg
			if(isBlog){
			   win.scrollTop(100);
			   $.scrollTo(0, 500, {offset: 0});
			}
			else{
			   win.scrollTop(0);
			}
			
		}
		
	}
	

		

    /////////////////////////////////
    //End document


})(jQuery);