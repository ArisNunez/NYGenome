<?php
	
if(get_field('colors','options')){
	while(has_sub_field('colors','options')):
$zone_name = '.zone-'.strtolower(preg_replace('/\s+/', "-", trim(preg_replace('/[^A-Za-z]/', " ", get_sub_field('site_zone')))));
$color_1 = get_sub_field('primary_color');

//Lighter
$color_2 = adjust_color($color_1, 0.9, 1.1);

//Darker
$color_3 = adjust_color($color_1, 0.9, 0.9);

//Darker Still
$color_4 = adjust_color($color_1, 0.8, 0.8);

?>

/* <?php echo $zone_name; ?> */

<?php echo $zone_name; ?> .sub-nav,
<?php echo $zone_name; ?> .btn,
a<?php echo $zone_name; ?>.cta .btn,
<?php echo $zone_name; ?>.btn,
a<?php echo $zone_name; ?>.btn,
footer <?php echo $zone_name; ?>.btn,
.mouse .header aside <?php echo $zone_name; ?>.btn:hover,
body<?php echo $zone_name; ?> .header aside <?php echo $zone_name; ?>.btn{
	background: <?php echo $color_1; ?>;
	color: #fff;
}

<?php echo $zone_name; ?> .sub-nav:after{
	box-shadow: inset -55px 0px 40px -20px <?php echo $color_1; ?>;
}

<?php echo $zone_name; ?> .sub-nav:before{
	box-shadow: inset 55px 0px 40px -20px <?php echo $color_1; ?>;
}

<?php echo $zone_name; ?> .wysiwyg li:before{
	border-left-color: <?php echo $color_1; ?>;
}

<?php if ($zone_name == '.zone-support-us'):?>
/*.zone-support-us .banner{
	background: <?php //echo $color_1; ?>;
	color: #fff;
}*/

.mouse .zone-support-us .support-us .detail:not(.cta):hover .content,
.mouse .zone-support-us .support-us .detail:not(.cta):hover .content:after{
	background: <?php echo $color_2; ?>;
}

.mouse .zone-support-us .support-us .detail:hover .image:after{
	border-bottom-color: <?php echo $color_2; ?>;
}


<?php elseif( $zone_name == '.zone-news'): ?>

.news-summary a<?php echo $zone_name; ?>.blog{
	background-color: <?php echo $color_3; ?>;
}

.news-summary a<?php echo $zone_name; ?>:hover{
	background-color: <?php echo $color_1; ?>;
}

.news-summary a<?php echo $zone_name; ?>.blog:hover{
	background-color: <?php echo $color_4; ?>;
}

<?php endif; ?>


<?php echo $zone_name; ?> .header .current-page-ancestor span,
<?php echo $zone_name; ?> .header .current-menu-item span,
.header <?php echo $zone_name; ?>:hover span,
<?php echo $zone_name; ?> h5,
a<?php echo $zone_name; ?>.sidebar-feature h5,
<?php echo $zone_name; ?> .read-more,
.wysiwyg p a<?php echo $zone_name; ?>.read-more,
a<?php echo $zone_name; ?>.sidebar-feature .read-more,
<?php echo $zone_name; ?> .page > .wysiwyg blockquote p,
<?php echo $zone_name; ?> .wysiwyg p a,
<?php echo $zone_name; ?> .wysiwyg li a,
<?php echo $zone_name; ?> .wysiwyg ol li:before,
<?php echo $zone_name; ?> .pick-a-date > span,
<?php echo $zone_name; ?> .ui-datepicker-header a span,
<?php echo $zone_name; ?> .ui-datepicker-current-day a,
<?php echo $zone_name; ?> label span,
<?php echo $zone_name; ?> h3 a{
	color: <?php echo $color_1; ?>;
}

.header <?php echo $zone_name; ?>:hover span:after{
	border-color: <?php echo $color_1; ?>;
}

.mouse <?php echo $zone_name; ?> a.feature:hover .content,
.mouse a<?php echo $zone_name; ?>.feature:hover .content,
.mouse <?php echo $zone_name; ?>.statement:hover,
.mouse <?php echo $zone_name; ?> .back-to:hover,
.mouse .carousel .caption<?php echo $zone_name; ?>:hover,
.mouse <?php echo $zone_name; ?> a.sidebar-feature:hover,
.mouse .page a<?php echo $zone_name; ?>.sidebar-feature:hover,
.mouse <?php echo $zone_name; ?> .cta:hover,
.mouse a<?php echo $zone_name; ?>.cta:hover,
.mouse <?php echo $zone_name; ?> .events-list .event:hover,
.mouse <?php echo $zone_name; ?>.events-list .event:hover,
<?php echo $zone_name; ?> .checkbox label:after,
.mouse .support-us <?php echo $zone_name; ?>.detail.cta:hover .content,
.mouse .support-us <?php echo $zone_name; ?>.detail.cta:hover .content:after,
.news-summary a<?php echo $zone_name; ?>{
	border-color: <?php echo $color_2; ?>;
	background-color: <?php echo $color_2; ?>;
}

.mouse <?php echo $zone_name; ?> a.feature:hover .content:first-child:after,
.mouse a<?php echo $zone_name; ?>.feature:hover .content:first-child:after,
.mouse <?php echo $zone_name; ?> a.feature:hover .content:before,
.mouse a<?php echo $zone_name; ?>.feature:hover .content:before{
	border-left-color: <?php echo $color_2; ?>;
}

.mouse <?php echo $zone_name; ?> a.feature:hover .content:last-child:after,
.mouse a<?php echo $zone_name; ?>.feature:hover .content:last-child:after{
	border-right-color: <?php echo $color_2; ?>;
}

.mouse a<?php echo $zone_name; ?>.sidebar-feature:hover .image:after{
	border-top-color: <?php echo $color_2; ?>;
}

<?php echo $zone_name; ?>.cta .overlay,
.mouse <?php echo $zone_name; ?> .people-grid .person:hover .content,
<?php echo $zone_name; ?> .people-grid h3,
<?php echo $zone_name; ?> .members .overlay,
<?php echo $zone_name; ?> .load-more,
<?php echo $zone_name; ?> h5.featured-event,
.mouse #Home <?php echo $zone_name; ?>.events-list .event:hover{
	background: <?php echo $color_1; ?>;
}

.mouse <?php echo $zone_name; ?> .overview a.intro:hover,
<?php echo $zone_name; ?> .dropdown li.focus{
	background: <?php echo $color_2; ?>;
}

.mouse <?php echo $zone_name; ?> .overview a.intro:hover .image:before{
	border-left-color: <?php echo $color_2; ?>;
}

<?php echo $zone_name; ?> .overview .sub-pages a{
	background: <?php echo $color_1; ?>;
	border-color: <?php echo $color_1; ?>;
}

<?php echo $zone_name; ?> .overview .sub-pages a:nth-of-type(1),
.mouse <?php echo $zone_name; ?> .overview .hero-sub-page:hover{
	background: <?php echo $color_4; ?>;
	border-top-color: <?php echo $color_4; ?>;
}

.mouse <?php echo $zone_name; ?> .overview .hero-sub-page:hover .image:before{
	border-right-color: <?php echo $color_4; ?>;
}

<?php echo $zone_name; ?> .overview .sub-pages a:nth-of-type(2),
.mouse <?php echo $zone_name; ?> .load-more:hover{
	background: <?php echo $color_3; ?>;
	border-top-color: <?php echo $color_3; ?>;
}

<?php echo $zone_name; ?> .overview .sub-pages a:nth-of-type(4){
	background: <?php echo $color_2; ?>;
	border-top-color: <?php echo $color_2; ?>;
}

.mouse <?php echo $zone_name; ?> .overview .sub-pages a:hover .read-more{
	color: <?php echo $color_1; ?>;
}

.mouse <?php echo $zone_name; ?> .events-list a.event:hover h5.series,
.mouse <?php echo $zone_name; ?>.events-list a.event:hover h5.series,
.mouse <?php echo $zone_name; ?> .events-list .event:hover h5.featured-event{
	color: <?php echo $color_2; ?> !important;
}

<?php echo $zone_name; ?> .form input[type=text]:focus,
<?php echo $zone_name; ?> .form textarea:focus,
<?php echo $zone_name; ?> .dropdown.focus,
<?php echo $zone_name; ?> .dropdown.focus div,
<?php echo $zone_name; ?> .checkbox input:focus ~ label:before{
	border-color: <?php echo $color_2; ?>;
}

<?php echo $zone_name; ?> .supporters .content li a{
	color: <?php echo $color_3; ?>
}

<?php echo $zone_name; ?> .timeline .year span,
<?php echo $zone_name; ?> .timeline .year span:after,
<?php echo $zone_name; ?> .timeline .track-down:after,
<?php echo $zone_name; ?> .timeline .track-up:before,
<?php echo $zone_name; ?> .timeline .marker{
	background: <?php echo $color_1; ?>
}
	
<?php endwhile;
}; ?>

/* NEUTRALIZE ON HOVER */

.mouse a:hover h5,
.mouse .overview .hero-sub-page:hover .read-more{
	color: #fff !important;
}

.mouse a:hover .btn{
	background: rgba(0,0,0,.8);
}
