<?php
/*
Template Name: Family Tree
*/
 //get_header();
 
$main_array	=	new stdClass();
$main_array->children[]	=	(object) get_tree(get_post_meta(get_the_ID(), 'family_head', true),get_the_ID());
$json	=	 json_encode($main_array);
//print_r($main_array); 
//print_r($json);die;
//wp_enqueue_script("jquery");
$dir = plugins_url().'/family-tree/';
?>

<!DOCTYPE html>

<!-- Mirrored from www.chehebar.com/new/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Aug 2014 11:36:50 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- for IE 9 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<title><?php echo $post->post_title;?> | <?php echo get_bloginfo('name');?></title>

<meta name=description content=""/>
<meta name=keywords content=""/>
<meta name=author content="Laura Baffari"/>
<meta name=robots content="index, follow"/>
<meta name=revisit_after content=14days />
<meta charset=UTF-8>

<link rel="stylesheet" type="text/css" href="<?php echo home_url('wp-content/plugins/family-tree/css/style.css')?>" />
<script type='text/javascript'>
/* <![CDATA[ */
var plugin_url = {"pluginurl":"<?php echo $dir;?>","json_file_url":"<?php echo $dir;?>family_data\/family_<?php echo $post->ID?>.json"};
/* ]]> */
</script>
<script type="text/javascript" src="<?php echo home_url('wp-content/plugins/family-tree/js/jquery.min.js')?>"></script>


<script type="text/javascript" src="<?php echo home_url('wp-content/plugins/family-tree/js/modernizr-2.6.2.min.js')?>"></script>
<script type="text/javascript" src="<?php echo home_url('wp-content/plugins/family-tree/libs/js/jquery.cookie.js')?>"></script>
<script type="text/javascript" src="<?php echo home_url('wp-content/plugins/family-tree/js/jquery.tap.min.js')?>"></script>
<script type="text/javascript" src="<?php echo home_url('wp-content/plugins/family-tree/js/jquery.mousewheel.js')?>"></script>
<script type="text/javascript" src="<?php echo home_url('wp-content/plugins/family-tree/js/jquery.panzoom.min.js')?>"></script>
 

<script type="text/javascript" src="<?php echo home_url('wp-content/plugins/family-tree/js/chehebar.js')?>"></script>



</head>

<body>
	<?php
		if(!validate_family(get_the_ID())){
			wp_die($post->post_title.' formation is not completed yet.<br/> Please try agin later.');
		}
	?>
<div id="hidden_data" style="display:none;"><div id="name-origin" class="center-h">
	<div class="text white grey-text scaledown"><p><?php echo wordwrap(strip_tags($post->post_content,'<br> <i>'),50,'<br>');?></p>
</div><div class="button icon-pin"><div class="icon white-text icon-name-origin"></div><div class="icon grey-text icon-leaves"></div>
</div></div></div>
<!--[if lte IE 8]>	
    <p id="update-browser">
	    <br/><img src="img/chehebar-logo.gif"><br/> <br/> <br/> 
	    You are using an <strong>outdated</strong> browser.<br/> 
	    Please <a href="http://browsehappy.com/">upgrade your browser</a><br/>
	    or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a><br/>
	    to improve your experience.
	</p>
<![endif]-->

<svg class="svg-graphic" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" version="1.1">
    <g><clipPath id="hexagonal-mask"><polygon points="280,0 0,165 0,485 280,650 560,485 560,165" /></clipPath></g> 
</svg>

<!-- Site Container -->
<div id="site-container">

	<!-- Intro -->
	<div id="intro">
		<div class="animation center-v center-h">						
			<div class="shape hexpink end-position paused"><img src="<?php echo home_url('wp-content/plugins/family-tree/img/hex-pink.png')?>"/></div>
			<div class="shape circleblu start-position paused"><div class="css-shape circle blu"></div></div>	
			<div class="logo-intro"><img src="<?php echo home_url('wp-content/plugins/family-tree/img/logo-intro.png')?>"/></div>			
		</div>
	</div>

	<!-- Container -->
	<div id="st-container" class="st-container">
	
		<!-- Member Info -->
		<div class="member-info member-info-out">
			<div class="button close-button"><span class="close"><div class="icon icon-close-outline"></div></span></div>
			<div class="member-content">
			</div>		
		</div>
			
		 
		<!-- Zoom Controls -->
		<div id="zoom-panel" class="member-out hidden-top">
			<ul>
				<li class="home">		
					<div class="button white"><span class="back"><a href="<?php echo home_url();?>">&#65513;
</a></span></div>
				</li>
				<li class="zoom-in-button">		
					<div class="button white cl-effect-2"><span class="plus"><div class="icon icon-plus-rounded-outline"></div></span></div>
				</li>
				<li class="zoom-out-button">	
					<div class="button white cl-effect-2"><span class="minus"><div class="icon icon-minus-rounded-outline"></div></span></div>
				</li>
				<li class="reset-button">	
					<div class="button white cl-effect-2"><span class="reset"><div class="icon icon-reset-outline"></div></span></div>
				</li>
			</ul>
		</div>
		
		<!-- Scroll to zoom Tooltip -->
		<div id="scroll-to-zoom" class="white scaledown">
			<ul>
				<li class="text">SCROLL TO ZOOM</li>
				<li class="icon icon-mouse-outline"></li>
			<ul>
		</div>
			
		<!-- Main Tree Window -->
		<div id="main-window">				
				
				<!-- Family Tree Container -->
				<div id="focal">	
					<div id="tree-container" class="parent">	
						<div id="tree">
						</div>	
					</div>	
				</div>	<!-- Tree Container end -->				
				
		</div> <!-- Main Tree Window end -->
		
	 
		 
			
	 
		<!-- end login window-->
		
		 
		
	</div><!-- Container end -->
	
	 

</div><!-- Site Container end -->

 

 
<div id="loading" class="visuallyhidden"></div>

 

</body>

<!-- Mirrored from www.chehebar.com/new/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Aug 2014 11:37:00 GMT -->
</html>
<?php
 //get_footer();
?>