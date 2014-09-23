<?php
/*
Plugin Name: Family Tree
*/

require_once('includes/custom-posttype.php');
require_once('includes/custom-meta-box.php');

register_activation_hook(__FILE__, 'ft_install');
function ft_install() {
global $wpdb;
    $post_if = $wpdb->get_var("SELECT count(post_title) FROM $wpdb->posts WHERE post_title like 'Parent/Child' AND post_type='ft_relation_type'");
    if($post_if < 1){
        $my_page = array(
        'post_title' => 'Parent/Child',
        'post_content' => 'This is for Parent - Child relationship',
        'post_status' => 'publish',
        'post_type' => 'ft_relation_type' 
        );

        $post_id = wp_insert_post($my_page);
    }

    $post_if = $wpdb->get_var("SELECT count(post_title) FROM $wpdb->posts WHERE post_title like 'Married' AND post_type='ft_relation_type'");
    if($post_if < 1){
        $my_page = array(
        'post_title' => 'Married',
        'post_content' => 'This is for Husbane - Wife relationship',
        'post_status' => 'publish',
        'post_type' => 'ft_relation_type' 
        );

        $post_id = wp_insert_post($my_page);
    }


    $post_if = $wpdb->get_var("SELECT count(post_title) FROM $wpdb->posts WHERE post_title like 'Husband' AND post_type='ft_roles'");
    if($post_if < 1){
        $my_page = array(
        'post_title' => 'Husband',
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'ft_roles' 
        );

        $post_id = wp_insert_post($my_page);
    }

    $post_if = $wpdb->get_var("SELECT count(post_title) FROM $wpdb->posts WHERE post_title like 'Wife' AND post_type='ft_roles'");
    if($post_if < 1){
         $my_page = array(
        'post_title' => 'Wife',
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'ft_roles' 
        );

        $post_id = wp_insert_post($my_page);
    }

    $post_if = $wpdb->get_var("SELECT count(post_title) FROM $wpdb->posts WHERE post_title like 'Son' AND post_type='ft_roles'");
    if($post_if < 1){
        $my_page = array(
        'post_title' => 'Son',
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'ft_roles' 
        );

        $post_id = wp_insert_post($my_page);
    }
 
 $post_if = $wpdb->get_var("SELECT count(post_title) FROM $wpdb->posts WHERE post_title like 'Father' AND post_type='ft_roles'");
    if($post_if < 1){
        $my_page = array(
        'post_title' => 'Father',
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'ft_roles' 
        );

        $post_id = wp_insert_post($my_page);
    }
    
 
 $post_if = $wpdb->get_var("SELECT count(post_title) FROM $wpdb->posts WHERE post_title like 'Daughter' AND post_type='ft_roles'");
    if($post_if < 1){
        $my_page = array(
        'post_title' => 'Daughter',
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'ft_roles' 
        );

        $post_id = wp_insert_post($my_page);
    }
    
 


}

/*
*
*/
/************************************************************************************************************
*							ADDING CUSTOM FIELDS TO USER PROFILE
*************************************************************************************************************/
add_action( 'show_user_profile', 'ft_link_add_to_user_profile_page' );
add_action( 'edit_user_profile', 'ft_link_add_to_user_profile_page' );

function ft_link_add_to_user_profile_page( $user ) { ?>
	<h3>Family Tree</h3>
	<table class="form-table">
		<tr>
			<td>
				Click <a href="edit.php?post_type=family_tree&author=<?php echo $_REQUEST['user_id']?>">here</a> to go to your Family Tree.
			</td>
		</tr>
	</table>
<?php }
/***********************************************************************************************************
*						END OF ADDING CUSTOM FIELDS TO USER PROFILE
***********************************************************************************************************/

function get_member_name($member_id){
    return get_the_title($member_id);
}

function get_role_title($role_id){
    return get_the_title($role_id);
}

add_filter('single_template', 'ft_template');

function ft_template($single) {
    global $wp_query, $post;

/* Checks for single template by post type */
if ($post->post_type == "family_tree"){
 
    if(file_exists(plugin_dir_path(__FILE__). '/includes/ft_template.php'))
        return plugin_dir_path(__FILE__) . '/includes/ft_template.php';
}
    return $single;
}

function get_member_merried_to_name($member_id,$sex){
    global $wpdb;
    $married_id = get_page_by_title( 'Married','','ft_relation_type' );
    if($sex=="F"){
    $args = array(
            'post_type' => 'ft_relation',
            'posts_per_page'=>1,
            'order' => 'ASC',
            'orderby' => 'post_title',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'     => 'member2',
                    'value'   => $member_id,
                    'type'    => 'numeric',
                    'compare' => '=',
                ),
                array(
                    'key'     => 'relation_type',
                    'value'   => $married_id->ID,
                    'type'    => 'numeric',
                    'compare' => '=',
                ),
            ),
        );
}else{
    $args = array(
            'post_type' => 'ft_relation',
            'posts_per_page'=>1,
            'order' => 'ASC',
            'orderby' => 'post_title',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'     => 'member1',
                    'value'   => $member_id,
                    'type'    => 'numeric',
                    'compare' => '=',
                ),
                array(
                    'key'     => 'relation_type',
                    'value'   => $married_id->ID,
                    'type'    => 'numeric',
                    'compare' => '=',
                ),
            ),
        );
}
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) :
            
            while ( $the_query->have_posts() ) : $the_query->the_post(); 
                    
                     if($sex=="F"){
                        return  '<br>with '.get_member_name(get_post_meta(get_the_ID(),'member1',true));
                     }else{
                        return  '<br>with '.get_member_name(get_post_meta(get_the_ID(),'member2',true));
                     }
            endwhile; 
            wp_reset_postdata(); 
        else:
            return '';    
        endif;
}

add_action( 'before_delete_post', 'ft_update_json' );
function ft_update_json( $postid ){

    // We check if the global post type isn't ours and just return
    global $post_type;   
    if ( $post_type != 'ft_relation' ) return;
 
    write_family_json_file(get_post_meta($postid,'family_tree',true));
}
add_action('publish_to_trash', 'ft_update_json');
add_action('draft_to_trash',   'ft_update_json');
add_action('future_to_trash',  'ft_update_json');

/*******************************************************************************************************************
*                               CREATE FAMILY
********************************************************************************************************************/

function get_tree($head_id,$family_id){
    $aa     = array();
    if($head_id){
        $married_id = get_page_by_title( 'Married','','ft_relation_type' );
        $parent_child_id = get_page_by_title( 'Parent/Child','','ft_relation_type' );
        

        $level_array    =   array($married_id->ID,$parent_child_id->ID);
        $aa['name'] =   get_post_meta($head_id,'member_first_name',true);
        $aa['id'] =   ($head_id);
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($head_id), 'thumbnail' );
        $url = $thumb['0'];
        $aa['surname'] =  get_post_meta($head_id,'member_last_name',true);
        $aa['photo']    =   $url;
        $aa['id_family'] = $family_id;
        $aa['sex'] =   get_post_meta($head_id,'member_sex',true);

        foreach ($level_array as $key => $value) {
            $args = array(
            'post_type' => 'ft_relation',
            'posts_per_page'=>-1,
            'order' => 'ASC',
            'orderby' => 'post_title',
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'     => 'member1',
                    'value'   => $head_id,
                    'type'    => 'numeric',
                    'compare' => '=',
                ),
                array(
                    'key'     => 'relation_type',
                    'value'   => $value,
                    'type'    => 'numeric',
                    'compare' => '=',
                ),
            ),
        );
        $the_query = new WP_Query( $args );
        
 
        if ( $the_query->have_posts() ) :
            
            while ( $the_query->have_posts() ) : $the_query->the_post(); 
                if($value==$married_id->ID){
                     
                    $aaa = new stdClass(); 

                    $aaa->id =   get_post_meta(get_the_ID(),'member2',true);
                    $aaa->name =   get_post_meta(get_post_meta(get_the_ID(),'member2',true),'member_first_name',true);
                    $aa['sex'] =   get_post_meta(get_post_meta(get_the_ID(),'member2',true),'member_sex',true);
                    $aaa->surname =    get_post_meta(get_post_meta(get_the_ID(),'member2',true),'member_last_name',true);
                    $aaa->id_family = $family_id;
                    $aaa->locked = "N";
                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_post_meta(get_the_ID(),'member2',true)), 'thumbnail' );
                    $url = $thumb['0'];
                    $aaa->photo    =   $url;
                    $aa['spouse'][] = $aaa;

                }
                else{
                    $aa['children'][] = (object) get_tree(get_post_meta(get_the_ID(),'member2',true),$family_id);
                }
            endwhile; 
            wp_reset_postdata(); 
        endif;
        }
       
        return $aa;
    }
    else{
        return $aa;
    }

}

/*******************************************************************************************************************
*                               END OF CREATE FAMILY
********************************************************************************************************************/

function validate_family($family_id){
    $family_head    =   get_post_meta($family_id, 'family_head', true);
    if($family_head){

        $member2    =   get_member_merried_to_name($family_head,get_post_meta($family_head,'member_sex',true));
         wp_reset_postdata(); 
        if(trim($member2)!=''){
            return true;
        }
        return false;
    }
    return false;
}
add_action( 'pre_get_posts', 'filter_ft_listing_by_author' );

function filter_ft_listing_by_author( $wp_query_obj ) 
{
    // Front end, do nothing
    if( !is_admin() )
        return;

    global $current_user, $pagenow;
    get_currentuserinfo();

    // http://php.net/manual/en/function.is-a.php
    if( !is_a( $current_user, 'WP_User') )
        return;

    // Not the correct screen, bail out
    if( 'edit.php' != $pagenow )
        return;
 
    
    // If the user is not administrator, filter the post listing
    if( !current_user_can( 'delete_plugins' ) )
        $wp_query_obj->set('author', $current_user->ID );
}

add_action('pre_get_posts','ml_restrict_media_library');

function ml_restrict_media_library( $wp_query_obj ) {
    global $current_user, $pagenow;
    if( !is_a( $current_user, 'WP_User') )
    return;
    if( 'admin-ajax.php' != $pagenow || $_REQUEST['action'] != 'query-attachments' )
    return;
    if( !current_user_can('manage_media_library') )
    $wp_query_obj->set('author', $current_user->ID );
    return;
}
 
/****************************************************************************************************************
*                                                       FAMILY LISTING
**************************************************************************************************************/
add_shortcode("family_listing","family_listing");

function family_listing(){
    $args = array(
        'post_type' => 'family_tree',
        'posts_per_page'=>-1,
        'order' => 'ASC',
        'orderby' => 'post_title'
    );
    $the_query = new WP_Query( $args );
    
    $return='';
    if ( $the_query->have_posts() ) :
        $return .='<ul>';
        while ( $the_query->have_posts() ) : $the_query->the_post(); 
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );
            $url = $thumb['0'];
            $return .='<li>';
            /*if(trim($url)!=''){
                echo'<img src="'.$url.'" />';
            }*/
            $return .='<a href="'.get_permalink().'">'.get_the_title().'</a></li>';
        endwhile;
         wp_reset_postdata(); 
         $return .='</ul>';
    endif;
    return $return;
}

add_action("wp_ajax_get_member_info", "get_member_info");
add_action("wp_ajax_nopriv_get_member_info", "get_member_info");

function get_member_info(){

    global $wpdb;
    $member_id  =   $_REQUEST['id'];

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
    die;
}
 
/****************************************************************************************************************
*                                                       FAMILY LISTING END
**************************************************************************************************************/

?>