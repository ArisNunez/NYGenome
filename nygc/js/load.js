var carouselLoaded = false;

function imgLoaded(img, bg, slide){
	var wrapper = img.nodeName == 'image' ? img.parentNode.parentNode : img.parentNode,
		firstChild = img.nodeName == 'image'? img.parentNode : img;
		
	if(bg){
		var bg = document.createElement('div'),
			src = img.nodeName == 'image' ? img.href.baseVal : img.src;
		bg.className = 'bg';
		wrapper.insertBefore(bg, firstChild);
		bg.style.backgroundImage='url('+src+')';
		bg.style.opacity='0';
	};
	if(wrapper.className.indexOf('loaded') == -1){
		wrapper.className += wrapper.className ? ' loaded' : 'loaded';
		if(bg){
			setTimeout(function(){
				bg.style.opacity='1';
			},10);
		};
	};
	
	if(slide && !carouselLoaded){
		var slidesWrapper = wrapper.parentNode,
			totalSlides = slidesWrapper.children.length,
			totalLoaded = 0;
			for (var i = 0; i < totalSlides; i++) {
			    if (slidesWrapper.children[i].className.indexOf('loaded') > -1) {
			      totalLoaded++;
			    };
			};
		if(totalLoaded == totalSlides){
			carouselLoaded = true;
			if(typeof site !== 'undefined'){
				site.home.heroCarousel.init();
			};
		};
	};
};

var vidDur,
	videoReady = false;

function videoLoaded(video){
	videoReady = true;
	vidDur = video.duration;
};