<?php

/************************************************************************************************************
*                           ADDING CUSTOM FIELDS TO FAMILY MEMEBER RELATION
*************************************************************************************************************/
add_action( 'add_meta_boxes', 'ft_meta_box_add' );
function ft_meta_box_add()
{
    add_meta_box( 'ft_member_relation_box', 'Relationship', 'ft_member_relation_box', 'ft_relation', 'normal', 'high' );
    add_meta_box( 'ft_family_head_box', 'Select Family Head', 'ft_family_head_box', 'family_tree', 'side', 'high' );
    add_meta_box( 'ft_family_member_box', 'Member Data', 'ft_family_member_box', 'family_member', 'normal', 'high' );
}

function ft_family_member_box($post){
	// Add an nonce field so we can check for it later.
    wp_nonce_field( 'family_member_box', 'family_member_box_nonce' );
     $member_sex=get_post_meta($post->ID,'member_sex',true);
     $member_first_name=get_post_meta($post->ID,'member_first_name',true);
     $member_last_name=get_post_meta($post->ID,'member_last_name',true);
     $member_marry_date=get_post_meta($post->ID,'member_marry_date',true);
     $member_address=get_post_meta($post->ID,'member_address',true);
     $member_death_on=get_post_meta($post->ID,'member_death_on',true);
     $member_birth_date=get_post_meta($post->ID,'member_birth_date',true);
    ?>
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo plugins_url( 'family-tree/css/jsDatePick_ltr.min.css' )?>" />
    <script type="text/javascript" src="<?php echo plugins_url( 'family-tree/js/jsDatePick.full.1.3.js' )?>"></script>
    <script type="text/javascript">
    window.onload = function(){
        new JsDatePick({
            useMode:2,
            target:"member_birth_date",
            dateFormat:"%d-%M-%Y",
            limitToToday:true
            /*selectedDate:{                This is an example of what the full configuration offers.
                day:5,                      For full documentation about these settings please see the full version of the code.
                month:9,
                year:2006
            },
            yearsRange:[1978,2020],
            
            cellColorScheme:"beige",
            dateFormat:"%m-%d-%Y",
            imgPath:"img/",
            weekStartDay:1*/
        });
         new JsDatePick({
            useMode:2,
            target:"member_marry_date",
            dateFormat:"%d-%M-%Y",
            limitToToday:true 
        });
        new JsDatePick({
                useMode:2,
                target:"member_death_on",
                dateFormat:"%d-%M-%Y",
                limitToToday:true 
            });
        };
</script>
    <dl>
    	
    	<dt>First name</dt>
    	<dd>
    		<input name="member_first_name" value="<?php echo $member_first_name?>">
	    </dd>

	    <dt>Last name</dt>
    	<dd>
    		<input name="member_last_name" value="<?php echo $member_last_name?>">
	    </dd>

	    <dt>Sex</dt>
    	<dd>
    		<select name="member_sex">
    			<option value="M" <?php selected( $member_sex, "M" ); ?>>Male</option>
    			<option value="F" <?php selected( $member_sex, "F" ); ?>>Female</option>
    		</select>
	    </dd>

	    <dt>Birth Date</dt>
    	<dd>
    		<input name="member_birth_date" id="member_birth_date" value="<?php echo $member_birth_date?>">
	    </dd>

	    <dt>Marrige Date</dt>
    	<dd>
    		<input name="member_marry_date" id="member_marry_date" value="<?php echo $member_marry_date?>">
	    </dd>
	    <dt>Address</dt>
    	<dd>
    		<input name="member_address" value="<?php echo $member_address?>"><small>(eg: Mansarovar, Jaipur, Rajasthan)</small>
	    </dd>

	    <dt>Death On</dt>
    	<dd>
    		<input name="member_death_on" id="member_death_on" value="<?php echo $member_death_on?>">
	    </dd>

	</dl>
    	<?php
}
add_action( 'save_post', 'family_member_save_meta_box_data' );

function family_member_save_meta_box_data( $post_id){
	 /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['family_member_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['family_member_box_nonce'], 'family_member_box' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */
    
 

    // Sanitize user input.
    update_post_meta($post_id,'member_sex',$_POST['member_sex']); 
    update_post_meta($post_id,'member_first_name',$_POST['member_first_name']); 
    update_post_meta($post_id,'member_last_name',$_POST['member_last_name']);
    update_post_meta($post_id,'member_marry_date',$_POST['member_marry_date']);
    update_post_meta($post_id,'member_address',$_POST['member_address']);
    update_post_meta($post_id,'member_death_on',$_POST['member_death_on']);  
    update_post_meta($post_id,'member_birth_date',$_POST['member_birth_date']);  

    global  $wpdb;
    global $current_user;
    get_currentuserinfo();
    $user_id = $current_user->ID;
    $ft = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_author = $user_id AND post_status IN('publish','pending') AND post_type = 'family_tree'");
    write_family_json_file($ft);
}
function ft_family_head_box($post)
{
    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'family_head_box', 'family_head_box_nonce' );

    $family_head=get_post_meta($post->ID,'family_head',true);
 ?>
 <dl><dt>&nbsp;</dt><dd>
    <?php
        global $current_user, $pagenow;
        get_currentuserinfo();
        $args = array(
            'post_type' => 'family_member',
            'posts_per_page'=>-1,
            'order' => 'ASC',
            'author'=> $current_user->ID,
            'orderby' => 'post_title'
        );
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) :
        echo'<select name="family_head"><option vale="">- Select Family Head -</option>';
         while ( $the_query->have_posts() ) : $the_query->the_post(); 
           echo '<option value="'.get_the_ID().'" '.selected($family_head,get_the_ID(),false).'>'.get_the_title().'</option>';
         endwhile; 
         echo'</select>';
        wp_reset_postdata(); 
    else:
        echo'<small><strong>Click <a href="post-new.php?post_type=family_member">here</a> to create Head of family</strong></small>';    
    endif;
        ?>
    </dd>
    <dl><?php   
}
function family_head_save_meta_box_data( $post_id ) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['family_head_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['family_head_box_nonce'], 'family_head_box' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */
    
 

    // Sanitize user input.
    update_post_meta($post_id,'family_head',$_POST['family_head']);     
    
    write_family_json_file($post_id);

}
add_action( 'save_post', 'family_head_save_meta_box_data' );

function ft_member_relation_box($post)
{
    global $current_user, $pagenow;
        get_currentuserinfo();

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'ft_meta_box', 'ft_meta_box_nonce' );
 
    $family_tree=get_post_meta($post->ID,'family_tree',true);
    $member1=get_post_meta($post->ID,'member1',true);
    $member2=get_post_meta($post->ID,'member2',true);
    $relation_type=get_post_meta($post->ID,'relation_type',true);
    $member1_role=get_post_meta($post->ID,'member1_role',true);
    $member2_role=get_post_meta($post->ID,'member2_role',true);
?>
    <dl><dt>Select Family</dt><dd>
    <?php
        $args = array(
            'post_type' => 'family_tree',
            'posts_per_page'=>-1,
            'order' => 'ASC',
            'author' => $current_user->ID,
            'orderby' => 'post_title'
        );
    $the_query = new WP_Query( $args );
    
    if ( $the_query->have_posts() ) :
        echo'<select name="family_tree">';
         while ( $the_query->have_posts() ) : $the_query->the_post(); 
           echo '<option value="'.get_the_ID().'" '.selected($family_tree,get_the_ID(),false).'>'.get_the_title().'</option>';
         endwhile; 
         echo'</select>';
        wp_reset_postdata(); 
    endif;
        ?>
    </dd>
    
        <dt>Select Member 1</dt><dd>
        <?php
        $args = array(
            'post_type' => 'family_member',
            'posts_per_page'=>-1,
            'order' => 'ASC',
            'author' => $current_user->ID,
            'orderby' => 'post_title'
        );
    $the_query = new WP_Query( $args );
    
    if ( $the_query->have_posts() ) :
        echo'<select name="member1">';
         while ( $the_query->have_posts() ) : $the_query->the_post(); 
           echo '<option value="'.get_the_ID().'" '.selected($member1,get_the_ID(),false).'>'.get_the_title().'</option>';
         endwhile; 
         echo'</select>';
        wp_reset_postdata(); 
    endif;
        ?></dd>
        <dt>Select Member 2</dt><dd>
    <?php
        $args = array(
            'post_type' => 'family_member',
            'posts_per_page'=>-1,
            'order' => 'ASC',
            'author' => $current_user->ID,
            'orderby' => 'post_title'
        );
    $the_query = new WP_Query( $args );
    
    if ( $the_query->have_posts() ) :
        echo'<select name="member2">';
         while ( $the_query->have_posts() ) : $the_query->the_post(); 
           echo '<option value="'.get_the_ID().'" '.selected($member2,get_the_ID(),false).'>'.get_the_title().'</option>';
         endwhile; 
         echo'</select>';
        wp_reset_postdata(); 
    endif;
        ?>
    </dd>
        <dt>Select Relation Type</dt><dd>
    <?php
        $args = array(
            'post_type' => 'ft_relation_type',
            'posts_per_page'=>-1,
            'order' => 'ASC',
            'orderby' => 'post_title'
        );
    $the_query = new WP_Query( $args );
    
    if ( $the_query->have_posts() ) :
        echo'<select name="relation_type">';
         while ( $the_query->have_posts() ) : $the_query->the_post(); 
           echo '<option value="'.get_the_ID().'" '.selected($relation_type,get_the_ID(),false).'>'.get_the_title().'</option>';
         endwhile; 
         echo'</select>';
        wp_reset_postdata(); 
    endif;
        ?>
    </dd>
        <dt>Select Member 1 Role</dt><dd>
    <?php
        $args = array(
            'post_type' => 'ft_roles',
            'posts_per_page'=>-1,
            'order' => 'ASC',
            'orderby' => 'post_title'
        );
    $the_query = new WP_Query( $args );
    
    if ( $the_query->have_posts() ) :
        echo'<select name="member1_role">';
         while ( $the_query->have_posts() ) : $the_query->the_post(); 
           echo '<option value="'.get_the_ID().'" '.selected($member1_role,get_the_ID(),false).'>'.get_the_title().'</option>';
         endwhile; 
         echo'</select>';
        wp_reset_postdata(); 
    endif;
        ?>
    </dd>
        <dt>Select Member 2 Role</dt><dd>
    <?php
        $args = array(
            'post_type' => 'ft_roles',
            'posts_per_page'=>-1,
            'order' => 'ASC',
            'orderby' => 'post_title'
        );
    $the_query = new WP_Query( $args );
    
    if ( $the_query->have_posts() ) :
        echo'<select name="member2_role">';
         while ( $the_query->have_posts() ) : $the_query->the_post(); 
           echo '<option value="'.get_the_ID().'" '.selected($member2_role,get_the_ID(),false).'>'.get_the_title().'</option>';
         endwhile; 
         echo'</select>';
        wp_reset_postdata(); 
    endif;
        ?>
    </dd>
    </dl>
<?php   
}

function ft_save_meta_box_data( $post_id ) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['ft_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['ft_meta_box_nonce'], 'ft_meta_box' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */
    
 

    // Sanitize user input.
    update_post_meta($post_id,'family_tree',$_POST['family_tree']);
    update_post_meta($post_id,'member1',$_POST['member1']);
    update_post_meta($post_id,'member2',$_POST['member2']);
    update_post_meta($post_id,'relation_type',$_POST['relation_type']);
    update_post_meta($post_id,'member1_role',$_POST['member1_role']);
    update_post_meta($post_id,'member2_role',$_POST['member2_role']);
    
    $my_post = array(
        'ID'           => $post_id,
        'post_title' => ft_get_member_name($_POST['member1']) . ' is ' .ft_get_role_title($_POST['member1_role']) . ' of ' . ft_get_member_name($_POST['member2'])
    );

        // unhook this function so it doesn't loop infinitely
        remove_action('save_post', 'ft_save_meta_box_data');
    
        // update the post, which calls save_post again
         wp_update_post( $my_post );

        // re-hook this function
        add_action('save_post', 'ft_save_meta_box_data');
    
    	write_family_json_file($_POST['family_tree']);

 

}
add_action( 'save_post', 'ft_save_meta_box_data' );

function write_family_json_file($family_id){
	/*   create file for family json*/
    $main_array->children[] =   (object) ft_get_tree(get_post_meta($family_id, 'family_head', true),get_the_ID());
    $json   =    json_encode($main_array);
    $file = dirname(dirname(__FILE__)) . '/your-main-php-file.php';
    $dir = plugin_dir_path($file); 
    $filename = $dir.'/family_data/family_'.$family_id.'.json';
    $somecontent =$json;

    // Let's make sure the file exists and is writable first.
    

        // In our example we're opening $filename in append mode.
        // The file pointer is at the bottom of the file hence
        // that's where $somecontent will go when we fwrite() it.
        if (!$handle = fopen($filename, 'w+')) {
             echo "Cannot open file ($filename)";
             die;
        }

        // Write $somecontent to our opened file.
        if (fwrite($handle, $somecontent) === FALSE) {
            echo "Cannot write to file ($filename)";
            die;
        }

        

        fclose($handle);
}
/************************************************************************************************************
*                           END OF ADDING CUSTOM FIELDS TO FAMILY MEMEBER RELATION
*************************************************************************************************************/
?>