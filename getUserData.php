<?php
require_once( '../../../wp-load.php' );
global $wpdb;
$member_id	=	$_REQUEST['id'];

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($member_id), 'full' );
$url = $thumb['0'];

$my_postid = $member_id;
$content_post = get_post($my_postid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
 
				if(trim($url)!=''){
					echo'<div class="image"><img width="320" src="'.$url.'"></div>';
				}
				echo'<div class="name pink-text">'.get_post_meta($member_id,'member_first_name',true).' '.get_post_meta($member_id,'member_last_name',true).'</div>
				<div class="info">';
if(trim(get_post_meta($member_id,'member_birth_date',true))!=''){
				echo'<div class="birth">
						<span class="button black circle"><div class="icon icon-stroller2"></div></span><br>
												<span class="text">'.get_post_meta($member_id,'member_birth_date',true).'</span>
					</div>';
				}

if(trim(get_post_meta($member_id,'member_marry_date',true))!=''){
					echo'<div class="marriage">
						<span class="button black circle"><div class="icon icon-rings"></div></span><br>
						<span class="text">'.get_post_meta($member_id,'member_marry_date',true).''.get_member_merried_to_name($member_id,get_post_meta($member_id,'member_sex',true)).'</span>		
					</div>';
}

if(trim(get_post_meta($member_id,'member_address',true))!=''){
					echo'<div class="contacts">
						<span class="button black circle"><div class="icon icon-mail-outline"></div></span><br>
						<span class="text">'.get_post_meta($member_id,'member_address',true).'</span>						
					</div>';
}

if(trim(get_post_meta($member_id,'member_death_on',true))!=''){
					echo'<div class="death">
						<span class="button black circle"><div class="icon icon-cross"></div></span><br>
						<span class="text">'.get_post_meta($member_id,'member_death_on',true).'</span>						
					</div>';
}

if(trim($content)!=''){
					echo'<div class="more">
						<span class="button black circle"><div class="icon icon-text-outline"></div></span><br>
						<span class="text">'.$content.'</span>
					</div>';

} 			
					 
					
					
										 
										
				echo'</div>';
?>