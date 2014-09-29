<?php
add_action('init', 'ft_init');

function ft_init(){
    $labels = array(
    'name'               => _x( 'Family Tree', 'post type general name' ),
    'singular_name'      => _x( 'Family Tree', 'post type singular name' ),
    'add_new'            => __( 'Add Your Family Tree' ),
    'add_new_item'       => __( 'Add Your Family Tree' ),
    'edit_item'          => __( 'Edit Your Family Tree Name' ),
    'search_items'       => __( 'Search Your Family Tree' ),
    'not_found'          => __( 'No Family Tree found' ),
    'not_found_in_trash' => __( 'No Family Tree found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Family Tree'
  );

  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our Family Tree',
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'show_in_admin_bar'=>true,
    'rewrite' => true,
    'menu_position' => 5,
    'menu_icon' => plugins_url( '../img/ft220.png', __FILE__),
    'supports'      => array( 'title','editor','thumbnail'),
    'has_archive'   => false,
    'capabilities' => array(
        'edit_post' => 'edit_family_tree',
        'edit_posts' => 'edit_family_trees',
        'edit_others_posts' => 'edit_other_family_trees',
        'publish_posts' => 'publish_family_trees',
        'read_post' => 'read_family_tree',
        'read_private_posts' => 'read_private_family_trees',
        'delete_post' => 'delete_family_tree',
        'edit_published_posts' => 'edit_published_family_trees'
    ),
 
  );
  register_post_type( 'family_tree', $args ); 

  $labels = array(
    'name'               => _x( 'Family Members', 'post type general name' ),
    'singular_name'      => _x( 'Family Members', 'post type singular name' ),
    'all_items'          => __( 'All Family Members' ),
    'search_items'       => __( 'Search Family Members' ),
    'not_found'          => __( 'No Family Members found' ),
    'not_found_in_trash' => __( 'No Family Members found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Family Members'
  );
     
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our Family Members',
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'menu_position' => 5,
    'menu_icon' => plugins_url( '../img/ft220.png', __FILE__),
    'supports'      => array( 'title','editor','thumbnail'),
    'has_archive'   => false,
    'capabilities' => array(
        'edit_post' => 'edit_family_member',
        'edit_posts' => 'edit_family_members',
        'edit_others_posts' => 'edit_other_family_members',
        'publish_posts' => 'publish_family_members',
        'read_post' => 'read_family_member',
        'read_private_posts' => 'read_private_family_members',
        'delete_post' => 'delete_family_member'
    ),
     
  );
  register_post_type( 'family_member', $args ); 


  $labels = array(
    'name'               => _x( 'Member Relation', 'post type general name' ),
    'singular_name'      => _x( 'Member Relation', 'post type singular name' ),
    'all_items'          => __( 'All Member Relation' ),
    'search_items'       => __( 'Search Member Relation' ),
    'not_found'          => __( 'No Member Relation found' ),
    'not_found_in_trash' => __( 'No Member Relation found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Member Relation'
  );
     
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our Member Relation',
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'menu_position' => 5,
    'menu_icon' => plugins_url( '../img/ft220.png', __FILE__),
    'supports'      => array(''),
    'has_archive'   => false,
    'capabilities' => array(
        'edit_post' => 'edit_family_member_relation',
        'edit_posts' => 'edit_family_member_relations',
        'edit_others_posts' => 'edit_other_family_member_relations',
        'publish_posts' => 'publish_family_member_relations',
        'read_post' => 'read_family_member_relation',
        'read_private_posts' => 'read_private_family_member_relations',
        'delete_post' => 'delete_family_member_relation'
    ),
     
  );
  register_post_type( 'ft_relation', $args ); 


  $labels = array(
    'name'               => _x( 'Member Role', 'post type general name' ),
    'singular_name'      => _x( 'Member Role', 'post type singular name' ),
    'all_items'          => __( 'All Member Role' ),
    'search_items'       => __( 'Search Member Role' ),
    'not_found'          => __( 'No Member Role found' ),
    'not_found_in_trash' => __( 'No Member Role found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Member Role'
  );
     
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our Member Role',
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'menu_position' => 5,
    'menu_icon' => plugins_url( '../img/ft220.png', __FILE__),
    'supports'      => array('title'),
    'has_archive'   => false,
    'capabilities' => array(
        'edit_post' => 'edit_family_member_role',
        'edit_posts' => 'edit_family_member_roles',
        'edit_others_posts' => 'edit_other_family_member_roles',
        'publish_posts' => 'publish_family_member_roles',
        'read_post' => 'read_family_member_role',
        'read_private_posts' => 'read_private_family_member_roles',
        'delete_post' => 'delete_family_member_role'
    ),
     
  );
  register_post_type( 'ft_roles', $args ); 

    $labels = array(
    'name'               => _x( 'Relationship Type', 'post type general name' ),
    'singular_name'      => _x( 'Relationship Type', 'post type singular name' ),
    'all_items'          => __( 'All Relationship Type' ),
    'search_items'       => __( 'Search Relationship Type' ),
    'not_found'          => __( 'No Relationship Type found' ),
    'not_found_in_trash' => __( 'No Relationship Type found in the Trash' ), 
    'parent_item_colon'  => '',
    'menu_name'          => 'Relationship Type'
  );
     
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our Relationship Type',
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'menu_position' => 5,
    'menu_icon' => plugins_url( '../img/ft220.png', __FILE__),
    'supports'      => array('title'),
    'has_archive'   => false,
    'capabilities' => array(
        'edit_post' => 'edit_family_relation_type',
        'edit_posts' => 'edit_family_relation_types',
        'edit_others_posts' => 'edit_other_family_relation_types',
        'publish_posts' => 'publish_family_relation_types',
        'read_post' => 'read_family_relation_type',
        'read_private_posts' => 'read_private_family_relation_types',
        'delete_post' => 'delete_family_relation_type'
    ),
     
  );
  register_post_type( 'ft_relation_type', $args ); 
   
}
 

function add_family_tree_caps() {
    // gets the administrator role
    $admins = get_role( 'administrator' );

    $admins->add_cap( 'edit_family_tree' ); 
    $admins->add_cap( 'edit_family_trees' ); 
    $admins->add_cap( 'edit_other_family_trees' ); 
    $admins->add_cap( 'publish_family_trees' ); 
    $admins->add_cap( 'read_family_tree' ); 
    $admins->add_cap( 'read_private_family_trees' ); 
    $admins->add_cap( 'delete_family_tree' );
    $admins->add_cap( 'edit_published_family_tree' ); 
    

    $admins->add_cap( 'edit_family_member' ); 
    $admins->add_cap( 'edit_family_members' ); 
    $admins->add_cap( 'edit_other_family_members' ); 
    $admins->add_cap( 'publish_family_members' ); 
    $admins->add_cap( 'read_family_member' ); 
    $admins->add_cap( 'read_private_family_members' ); 
    $admins->add_cap( 'delete_family_member' ); 

      $admins->add_cap( 'edit_family_member_relation' ); 
    $admins->add_cap( 'edit_family_member_relations' ); 
    $admins->add_cap( 'edit_other_family_member_relations' ); 
    $admins->add_cap( 'publish_family_member_relations' ); 
    $admins->add_cap( 'read_family_member_relation' ); 
    $admins->add_cap( 'read_private_family_member_relations' ); 
    $admins->add_cap( 'delete_family_member_relation' ); 

    $admins->add_cap( 'edit_family_member_role' ); 
    $admins->add_cap( 'edit_family_member_roles' ); 
    $admins->add_cap( 'edit_other_family_member_roles' ); 
    $admins->add_cap( 'publish_family_member_roles' ); 
    $admins->add_cap( 'read_family_member_role' ); 
    $admins->add_cap( 'read_private_family_member_roles' ); 
    $admins->add_cap( 'delete_family_member_role' );



    $subscriber = get_role( 'subscriber' );

    $subscriber->add_cap( 'edit_family_tree' ); 
    $subscriber->add_cap( 'edit_family_trees' ); 
    $subscriber->add_cap( 'edit_other_family_trees' );
     $subscriber->add_cap('upload_files'); 
    //$subscriber->add_cap( 'publish_family_trees' ); 
    $subscriber->add_cap( 'read_family_tree' ); 
    $subscriber->add_cap( 'read_private_family_trees' ); 
    $subscriber->add_cap( 'delete_family_tree' ); 
    $subscriber->add_cap( 'edit_published_family_tree' );

    $subscriber->add_cap( 'edit_family_member' ); 
    $subscriber->add_cap( 'edit_family_members' ); 
    $subscriber->add_cap( 'edit_other_family_members' ); 
    $subscriber->add_cap( 'publish_family_members' ); 
    $subscriber->add_cap( 'read_family_member' ); 
    $subscriber->add_cap( 'read_private_family_members' ); 
    $subscriber->add_cap( 'delete_family_member' ); 

    $subscriber->add_cap( 'edit_family_member_relation' ); 
    $subscriber->add_cap( 'edit_family_member_relations' ); 
    $subscriber->add_cap( 'edit_other_family_member_relations' ); 
    $subscriber->add_cap( 'publish_family_member_relations' ); 
    $subscriber->add_cap( 'read_family_member_relation' ); 
    $subscriber->add_cap( 'read_private_family_member_relations' ); 
    $subscriber->add_cap( 'delete_family_member_relation' ); 

    global  $wpdb;
    global $current_user,$typenow;
    get_currentuserinfo();
    $user_id = $current_user->ID;
    $count = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->posts WHERE post_author = $user_id AND post_status IN('publish','pending') AND post_type = 'family_tree'");
    if($count > 0 && $typenow=='family_tree'){
        add_action('admin_footer','ft_hide_links');
    } 
}
add_action( 'admin_init', 'add_family_tree_caps');

function ft_hide_links(){
    $typenow='family_tree';
     $href='post-new.php?post_type='.$typenow;
    ?>
    <script>
        jQuery(document).ready(function() {
            jQuery('.add-new-h2').remove();
            jQuery('[href$="<?php echo $href;?>"]').remove();
        });
    
    </script>
    <?php
}
?>