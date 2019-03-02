<?php 
/*
 Plugin Name: VW Photography Pro Posttype
 lugin URI: https://www.vwthemes.com/
 Description: Creating new post type for VW Photography Pro Theme.
 Author: VW Themes
 Version: 1.3
 Author URI: https://www.vwthemes.com/
*/

define( 'VW_PHOTOGRAPHY_PRO_POSTTYPE_VERSION', '1.0' );
add_action( 'init', 'projectcategory');
add_action( 'init', 'vw_photography_pro_posttype_create_post_type' );

function vw_photography_pro_posttype_create_post_type() {
  register_post_type( 'project',
    array(
      'labels' => array(
        'name' => __( 'Project','vw-photography-pro-posttype' ),
        'singular_name' => __( 'Project','vw-photography-pro-posttype' )
      ),
      'capability_type' => 'post',
      'menu_icon'  => 'dashicons-portfolio',
      'public' => true,
      'supports' => array(
        'title',
        'editor',
        'thumbnail'
      )
    )
  );
  register_post_type( 'testimonials',
    array(
  		'labels' => array(
  			'name' => __( 'Testimonials','vw-photography-pro-posttype' ),
  			'singular_name' => __( 'Testimonials','vw-photography-pro-posttype' )
  		),
  		'capability_type' => 'post',
  		'menu_icon'  => 'dashicons-businessman',
  		'public' => true,
  		'supports' => array(
  			'title',
  			'editor',
  			'thumbnail'
  		)
		)
	);
  register_post_type( 'team',
    array(
      'labels' => array(
        'name' => __( 'Our Team','vw-photography-pro-posttype' ),
        'singular_name' => __( 'Our Team','vw-photography-pro-posttype' )
      ),
        'capability_type' => 'post',
        'menu_icon'  => 'dashicons-businessman',
        'public' => true,
        'supports' => array( 
          'title',
          'editor',
          'thumbnail'
      )
    )
  );
}

/*--------------- Project section ----------------*/
function projectcategory() {
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name'              => __( 'Project Category', 'vw-photography-pro-posttype' ),
    'singular_name'     => __( 'Project Category', 'vw-photography-pro-posttype' ),
    'search_items'      => __( 'Search Ccats', 'vw-photography-pro-posttype' ),
    'all_items'         => __( 'All Project Category', 'vw-photography-pro-posttype' ),
    'parent_item'       => __( 'Parent Project Category', 'vw-photography-pro-posttype' ),
    'parent_item_colon' => __( 'Parent Project Category:', 'vw-photography-pro-posttype' ),
    'edit_item'         => __( 'Edit Project Category', 'vw-photography-pro-posttype' ),
    'update_item'       => __( 'Update Project Category', 'vw-photography-pro-posttype' ),
    'add_new_item'      => __( 'Add New Project Category', 'vw-photography-pro-posttype' ),
    'new_item_name'     => __( 'New Project Category Name', 'vw-photography-pro-posttype' ),
    'menu_name'         => __( 'Project Category', 'vw-photography-pro-posttype' ),
  );
  $args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'project-category' ),
  );
  register_taxonomy( 'projectcategory', array( 'project' ), $args );
}
/* Adds a meta box to the project editing screen */
function vw_photography_pro_posttype_bn_project_meta_box() {
  add_meta_box( 'vw-photography-pro-posttype-project-meta', __( 'Enter Details', 'vw-photography-pro-posttype' ), 'vw_photography_pro_posttype_bn_project_meta_callback', 'project', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'vw_photography_pro_posttype_bn_project_meta_box');
}
/* Adds a meta box for custom post */
function vw_photography_pro_posttype_bn_project_meta_callback( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'vw_project_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );
  //date details
  if(!empty($bn_stored_meta['vw_project_date'][0])){
    $bn_vw_project_date = $bn_stored_meta['vw_project_date'][0];
  }
  else{
    $bn_vw_project_date = '';
  }

  if(!empty($bn_stored_meta['vw_project_time'][0])){
    $bn_vw_project_time = $bn_stored_meta['vw_project_time'][0];
  }
  else{
    $bn_vw_project_time = '';
  }

  if(!empty($bn_stored_meta['vw_project_Camera'][0])){
    $bn_vw_project_Camera = $bn_stored_meta['vw_project_Camera'][0];
  }
  else{
    $bn_vw_project_Camera = '';
  }

  ?>
  <div id="portfolios_custom_stuff">
    <table id="list">
      <tbody id="the-list" data-wp-lists="list:meta">
        <tr id="meta-1">
          <td class="left">
            <?php esc_html_e( 'Date', 'vw-photography-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="vw_project_date" id="vw_project_date" value="<?php echo esc_attr( $bn_vw_project_date ); ?>" />
          </td>
        </tr>
        <tr id="meta-2">
          <td class="left">
            <?php esc_html_e( 'Time', 'vw-photography-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="vw_project_time" id="vw_project_time" value="<?php echo esc_attr( $bn_vw_project_time ); ?>" />
          </td>
        </tr>
        <tr id="meta-1">
          <td class="left">
            <?php esc_html_e( 'Camera', 'vw-photography-pro-posttype' )?>
          </td>
          <td class="left" >
            <input type="text" name="vw_project_Camera" id="vw_project_Camera" value="<?php echo esc_attr( $bn_vw_project_Camera ); ?>" />
          </td>
        </tr>
        <tr id="meta-1">
          <td class="left">
            <?php esc_html_e( 'Remove Sidebar', 'vw-photography-pro-posttype' )?>
          </td>
          <td class="left" >
            <?php $vw_project_sidebar=get_post_meta($post->ID, "vw_project_sidebar", true); 
            if($vw_project_sidebar ==1){?>
              <input type="checkbox" name="vw_project_sidebar" id="vw_project_sidebar" checked="checked" value="true" />
            <?php } else { ?>
              <input type="checkbox" name="vw_project_sidebar" id="vw_project_sidebar" value="true" />
             <?php }?>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <?php
}

/* Saves the custom meta input */
function vw_photography_pro_posttype_bn_meta_project_save( $post_id ) {
  if (!isset($_POST['vw_project_meta_nonce']) || !wp_verify_nonce($_POST['vw_project_meta_nonce'], basename(__FILE__))) {
    return;
  }

  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return;
  }

   // Save desig.
  if( isset( $_POST[ 'vw_project_date' ] ) ) {
    update_post_meta( $post_id, 'vw_project_date', esc_html($_POST[ 'vw_project_date']) );
  }

  if( isset( $_POST[ 'vw_project_time' ] ) ) {
    update_post_meta( $post_id, 'vw_project_time', esc_html($_POST[ 'vw_project_time']) );
  }

  if( isset( $_POST[ 'vw_project_Camera' ] ) ) {
    update_post_meta( $post_id, 'vw_project_Camera', esc_html($_POST[ 'vw_project_Camera']) );
  }
  if( isset( $_POST[ 'vw_project_sidebar' ] )) {
      update_post_meta( $post_id, 'vw_project_sidebar', esc_attr(1));
  }else{
    update_post_meta( $post_id, 'vw_project_sidebar', esc_attr(0));
  }
}

add_action( 'save_post', 'vw_photography_pro_posttype_bn_meta_project_save' );

/*----------------------Testimonial section ----------------------*/
/* Adds a meta box to the Testimonial editing screen */
function vw_photography_pro_posttype_bn_testimonial_meta_box() {
	add_meta_box( 'vw-photography-pro-posttype-testimonial-meta', __( 'Enter Details', 'vw-photography-pro-posttype' ), 'vw_photography_pro_posttype_bn_testimonial_meta_callback', 'testimonials', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'vw_photography_pro_posttype_bn_testimonial_meta_box');
}
/* Adds a meta box for custom post */
function vw_photography_pro_posttype_bn_testimonial_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'vw_photography_pro_posttype_posttype_testimonial_meta_nonce' );
  $bn_stored_meta = get_post_meta( $post->ID );
  if(!empty($bn_stored_meta['vw_photography_pro_posttype_testimonial_desigstory'][0]))
      $bn_vw_photography_pro_posttype_testimonial_desigstory = $bn_stored_meta['vw_photography_pro_posttype_testimonial_desigstory'][0];
    else
      $bn_vw_photography_pro_posttype_testimonial_desigstory = '';
	?>
	<div id="testimonials_custom_stuff">
		<table id="list">
			<tbody id="the-list" data-wp-lists="list:meta">
				<tr id="meta-1">
					<td class="left">
						<?php _e( 'Designation', 'vw-photography-pro-posttype' )?>
					</td>
					<td class="left" >
						<input type="text" name="vw_photography_pro_posttype_testimonial_desigstory" id="vw_photography_pro_posttype_testimonial_desigstory" value="<?php echo esc_attr( $bn_vw_photography_pro_posttype_testimonial_desigstory ); ?>" />
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php
}

/* Saves the custom meta input */
function vw_photography_pro_posttype_bn_metadesig_save( $post_id ) {
	if (!isset($_POST['vw_photography_pro_posttype_posttype_testimonial_meta_nonce']) || !wp_verify_nonce($_POST['vw_photography_pro_posttype_posttype_testimonial_meta_nonce'], basename(__FILE__))) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	// Save desig.
	if( isset( $_POST[ 'vw_photography_pro_posttype_testimonial_desigstory' ] ) ) {
		update_post_meta( $post_id, 'vw_photography_pro_posttype_testimonial_desigstory', sanitize_text_field($_POST[ 'vw_photography_pro_posttype_testimonial_desigstory']) );
	}
}

add_action( 'save_post', 'vw_photography_pro_posttype_bn_metadesig_save' );

/*------------------------- Team Section-----------------------------*/
/* Adds a meta box for Designation */
function vw_photography_pro_posttype_bn_team_meta() {
    add_meta_box( 'vw_photography_pro_posttype_bn_meta', __( 'Enter Details','vw-photography-pro-posttype' ), 'vw_photography_pro_posttype_ex_bn_meta_callback', 'team', 'normal', 'high' );
}
// Hook things in for admin
if (is_admin()){
    add_action('admin_menu', 'vw_photography_pro_posttype_bn_team_meta');
}
/* Adds a meta box for custom post */
function vw_photography_pro_posttype_ex_bn_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'vw_photography_pro_posttype_bn_nonce' );
    $bn_stored_meta = get_post_meta( $post->ID );

    //Email details
    if(!empty($bn_stored_meta['meta-desig'][0]))
      $bn_meta_desig = $bn_stored_meta['meta-desig'][0];
    else
      $bn_meta_desig = '';

    //Phone details
    if(!empty($bn_stored_meta['meta-call'][0]))
      $bn_meta_call = $bn_stored_meta['meta-call'][0];
    else
      $bn_meta_call = '';

    //facebook details
    if(!empty($bn_stored_meta['meta-facebookurl'][0]))
      $bn_meta_facebookurl = $bn_stored_meta['meta-facebookurl'][0];
    else
      $bn_meta_facebookurl = '';

    //linkdenurl details
    if(!empty($bn_stored_meta['meta-linkdenurl'][0]))
      $bn_meta_linkdenurl = $bn_stored_meta['meta-linkdenurl'][0];
    else
      $bn_meta_linkdenurl = '';

    //twitterurl details
    if(!empty($bn_stored_meta['meta-twitterurl'][0]))
      $bn_meta_twitterurl = $bn_stored_meta['meta-twitterurl'][0];
    else
      $bn_meta_twitterurl = '';

    //twitterurl details
    if(!empty($bn_stored_meta['meta-googleplusurl'][0]))
      $bn_meta_googleplusurl = $bn_stored_meta['meta-googleplusurl'][0];
    else
      $bn_meta_googleplusurl = '';

    //twitterurl details
    if(!empty($bn_stored_meta['meta-designation'][0]))
      $bn_meta_designation = $bn_stored_meta['meta-designation'][0];
    else
      $bn_meta_designation = '';

    ?>
    <div id="agent_custom_stuff">
        <table id="list-table">         
            <tbody id="the-list" data-wp-lists="list:meta">
                <tr id="meta-1">
                    <td class="left">
                        <?php esc_html_e( 'Email', 'vw-photography-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="meta-desig" id="meta-desig" value="<?php echo esc_attr($bn_meta_desig); ?>" />
                    </td>
                </tr>
                <tr id="meta-2">
                    <td class="left">
                        <?php esc_html_e( 'Phone Number', 'vw-photography-pro-posttype' )?>
                    </td>
                    <td class="left" >
                        <input type="text" name="meta-call" id="meta-call" value="<?php echo esc_attr($bn_meta_call); ?>" />
                    </td>
                </tr>
                <tr id="meta-3">
                  <td class="left">
                    <?php esc_html_e( 'Facebook Url', 'vw-photography-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-facebookurl" id="meta-facebookurl" value="<?php echo esc_url($bn_meta_facebookurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-4">
                  <td class="left">
                    <?php esc_html_e( 'Linkedin URL', 'vw-photography-pro-posttype' )?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-linkdenurl" id="meta-linkdenurl" value="<?php echo esc_url($bn_meta_linkdenurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-5">
                  <td class="left">
                    <?php esc_html_e( 'Twitter Url', 'vw-photography-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-twitterurl" id="meta-twitterurl" value="<?php echo esc_url( $bn_meta_twitterurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-6">
                  <td class="left">
                    <?php esc_html_e( 'GooglePlus URL', 'vw-photography-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="url" name="meta-googleplusurl" id="meta-googleplusurl" value="<?php echo esc_url($bn_meta_googleplusurl); ?>" />
                  </td>
                </tr>
                <tr id="meta-7">
                  <td class="left">
                    <?php esc_html_e( 'Designation', 'vw-photography-pro-posttype' ); ?>
                  </td>
                  <td class="left" >
                    <input type="text" name="meta-designation" id="meta-designation" value="<?php echo esc_attr($bn_meta_designation); ?>" />
                  </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
}
/* Saves the custom Designation meta input */
function vw_photography_pro_posttype_ex_bn_metadesig_save( $post_id ) {
    if( isset( $_POST[ 'meta-desig' ] ) ) {
        update_post_meta( $post_id, 'meta-desig', esc_html($_POST[ 'meta-desig' ]) );
    }
    if( isset( $_POST[ 'meta-call' ] ) ) {
        update_post_meta( $post_id, 'meta-call', esc_html($_POST[ 'meta-call' ]) );
    }
    // Save facebookurl
    if( isset( $_POST[ 'meta-facebookurl' ] ) ) {
        update_post_meta( $post_id, 'meta-facebookurl', esc_url($_POST[ 'meta-facebookurl' ]) );
    }
    // Save linkdenurl
    if( isset( $_POST[ 'meta-linkdenurl' ] ) ) {
        update_post_meta( $post_id, 'meta-linkdenurl', esc_url($_POST[ 'meta-linkdenurl' ]) );
    }
    if( isset( $_POST[ 'meta-twitterurl' ] ) ) {
        update_post_meta( $post_id, 'meta-twitterurl', esc_url($_POST[ 'meta-twitterurl' ]) );
    }
    // Save googleplusurl
    if( isset( $_POST[ 'meta-googleplusurl' ] ) ) {
        update_post_meta( $post_id, 'meta-googleplusurl', esc_url($_POST[ 'meta-googleplusurl' ]) );
    }
    // Save designation
    if( isset( $_POST[ 'meta-designation' ] ) ) {
        update_post_meta( $post_id, 'meta-designation', esc_html($_POST[ 'meta-designation' ]) );
    }
}
add_action( 'save_post', 'vw_photography_pro_posttype_ex_bn_metadesig_save' );

add_action( 'save_post', 'bn_meta_save' );
/* Saves the custom meta input */
function bn_meta_save( $post_id ) {
  if( isset( $_POST[ 'vw_photography_pro_posttype_team_featured' ] )) {
      update_post_meta( $post_id, 'vw_photography_pro_posttype_team_featured', esc_attr(1));
  }else{
    update_post_meta( $post_id, 'vw_photography_pro_posttype_team_featured', esc_attr(0));
  }
}
/*------------------------ Team Shortcode --------------------------*/
function vw_photography_pro_posttype_team_func( $atts ) {
    $team = ''; 
    $team = '<div id="team"  class="row">';
      $new = new WP_Query( array( 'post_type' => 'team') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $facebookurl = get_post_meta($post_id,'meta-facebookurl',true);
          $linkedin = get_post_meta($post_id,'meta-linkdenurl',true);
          $twitter = get_post_meta($post_id,'meta-twitterurl',true);
          $googleplus = get_post_meta($post_id,'meta-googleplusurl',true);

          $team .= ' <div class="col-lg-3 col-md-3 team_col ">
            <div class="team_inner media">';
             if (has_post_thumbnail()){
              $team .= '<img class="w-100" src="'.esc_url($url).'">
              <a class="read-more font-weight-bold btn btn-primary theme_button" href="'.get_the_permalink().'">'.get_the_title().'</a>
              <div class="media__body">
                <div class="media_body_inner">
                  <h4 class="teamtitle"><a  href="'.get_the_permalink().'">'.get_the_title().'</a></h4>
                  <div class="socialbox mt-3">';
                        if($facebookurl != '' || $linkedin != '' || $twitter != '' || $googleplus != ''){?>
                          <?php if($facebookurl != ''){
                            $team .= '<a class="mr-1" href="'.esc_url($facebookurl).'" target="_blank"><i class="fab fa-facebook-f"></i></a>';
                           } if($twitter != ''){
                            $team .= '<a class="" href="'.esc_url($twitter).'" target="_blank"><i class="fab fa-twitter"></i></a>';                          
                           } if($linkedin != ''){
                           $team .= ' <a class="mr-1" href="'.esc_url($linkedin).'" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
                          }if($googleplus != ''){
                            $team .= '<a class="" href="'.esc_url($googleplus).'" target="_blank"><i class="fab fa-google-plus-g"></i></a>';
                          }
                        }
                  $team .= '</div>      
                </div>
              </div>
            </div>
          </div>';
              }
          $k++;         
        endwhile; 
        wp_reset_postdata();
      else :
        $team = '<div id="team" class="team_wrap col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','vw-photography-pro-posttype').'</h2></div>';
      endif;
    $team .= '</div>';
    return $team;
}
add_shortcode( 'vw-photography-pro-team', 'vw_photography_pro_posttype_team_func' );

/*------------------- Testimonial Shortcode -------------------------*/
function vw_photography_pro_posttype_testimonials_func( $atts ) {
    $testimonial = ''; 
    $testimonial = '<div id="testimonials"><div class="row inner-test-bg">';
      $new = new WP_Query( array( 'post_type' => 'testimonials') );
      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium' );
          $url = $thumb['0'];
          $excerpt = vw_photography_pro_string_limit_words(get_the_excerpt(),25);
          $designation = get_post_meta($post_id,'vw_photography_pro_posttype_testimonial_desigstory',true);

          $testimonial .= '<div class="col-md-6 ">
          <div class="test">
                <div class="testimonial_box mb-3" >
                  <div class="content_box w-100">
                    <div class="short_text pb-3"><blockquote>'.$excerpt.'</blockquote></div>
                  </div>                  
                </div>
                <ul class="testimonial_auther row m-0">
                  <li class="testimonial-box col-md-8">
                    <h4 class="testimonial_name"><a href="'.get_the_permalink().'">'.get_the_title().'</a> <cite>'.esc_html($designation).'</cite></h4>
                  </li>
                  <li class="textimonial-img">';
                    if (has_post_thumbnail()){
                    $testimonial.= '<img src="'.esc_url($url).'">';
                    }
                  $testimonial .= '</li>
                </ul>
              </div>
            </div>
              <div class="clearfix"></div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
      else :
        $testimonial = '<div id="testimonial" class="testimonial_wrap col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','vw-photography-pro-posttype').'</h2></div>';
      endif;
    $testimonial .= '</div></div>';
    return $testimonial;
}
add_shortcode( 'vw-photography-pro-testimonials', 'vw_photography_pro_posttype_testimonials_func' );

/*---------------- Project Shortcode ---------------------*/
function vw_photography_pro_posttype_project_func( $atts, $cat_name ) {
    $project = ''; 
    $cat_name = isset( $atts['cat_name'] ) ? esc_html( $atts['cat_name'] ) : '';
    $project = '<div id="our_work" class="row inner-test-bg">';
      $new = new WP_Query( array( 
        'post_type' => 'project',
        'projectcategory'=> $cat_name,
      ) );

      if ( $new->have_posts() ) :
        $k=1;
        while ($new->have_posts()) : $new->the_post();
          $post_id = get_the_ID();
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large' );
          $url = $thumb['0'];
          $excerpt = vw_photography_pro_string_limit_words(get_the_excerpt(),20);
          $date = get_post_meta($post_id,'vw_project_date',true);
          $time = get_post_meta($post_id,'vw_project_time',true);
          $project .= '<div class="col-md-6 col-sm-6 mt-4">
            <div class="box">
              <div class="project-image">';
                if (has_post_thumbnail()){
                  $project.= '<img src="'.esc_url($url).'">';
                  }
                $project .='<div class="image_overlay"></div>
              </div>
              <div class="over-layer">
                  <div class="project_content">
                    <h4 class="title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h4>
                    <div class="project_meta">
                      <div>'.esc_html($date).'</div>
                      <div>'.esc_html($time).'</div>
                    </div>
                  </div>
               </div>
            </div>
          </div>
          <div class="clearfix"></div>';
          $k++;         
        endwhile; 
        wp_reset_postdata();
        $project.= '</div>';
      else :
        $project = '<div id="our_work" class="col-md-3 mt-3 mb-4"><h2 class="center">'.__('Not Found','vw-photography-pro-posttype').'</h2></div>';
      endif;
      $project.= '</div>';
    return $project;
}
add_shortcode( 'vw-photography-pro-project', 'vw_photography_pro_posttype_project_func' );

// Adding an image upload option in custom Taxonom
if( ! class_exists( 'Showcase_Taxonomy_Images' ) ) {
  class Showcase_Taxonomy_Images {
    
    public function __construct() {
     //
    }

    /**
     * Initialize the class and start calling our hooks and filters
     */
     public function init() {
     // Image actions
     add_action( 'projectcategory_add_form_fields', array( $this, 'add_category_image' ), 10, 2 );
     add_action( 'created_projectcategory', array( $this, 'save_category_image' ), 10, 2 );
     add_action( 'projectcategory_edit_form_fields', array( $this, 'update_category_image' ), 10, 2 );
     add_action( 'edited_projectcategory', array( $this, 'updated_category_image' ), 10, 2 );
     add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
     add_action( 'admin_footer', array( $this, 'add_script' ) );
   }

   public function load_media() {
     if( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] != 'projectcategory' ) {
       return;
     }
     wp_enqueue_media();
   }
  
   /**
    * Add a form field in the new category page
    * @since 1.0.0
    */
  
   public function add_category_image( $taxonomy ) { ?>
     <div class="form-field term-group">
       <label for="showcase-taxonomy-image-id"><?php _e( 'Image', 'showcase' ); ?></label>
       <input type="hidden" id="showcase-taxonomy-image-id" name="showcase-taxonomy-image-id" class="custom_media_url" value="">
       <div id="category-image-wrapper"></div>
       <p>
         <input type="button" class="button button-secondary showcase_tax_media_button" id="showcase_tax_media_button" name="showcase_tax_media_button" value="<?php _e( 'Add Image', 'showcase' ); ?>" />
         <input type="button" class="button button-secondary showcase_tax_media_remove" id="showcase_tax_media_remove" name="showcase_tax_media_remove" value="<?php _e( 'Remove Image', 'showcase' ); ?>" />
       </p>
     </div>
   <?php }

   /**
    * Save the form field
    * @since 1.0.0
    */
   public function save_category_image( $term_id, $tt_id ) {
     if( isset( $_POST['showcase-taxonomy-image-id'] ) && '' !== $_POST['showcase-taxonomy-image-id'] ){
       add_term_meta( $term_id, 'showcase-taxonomy-image-id', absint( $_POST['showcase-taxonomy-image-id'] ), true );
     }
    }

    /**
     * Edit the form field
     * @since 1.0.0
     */
    public function update_category_image( $term, $taxonomy ) { ?>
      <tr class="form-field term-group-wrap">
        <th scope="row">
          <label for="showcase-taxonomy-image-id"><?php _e( 'Image', 'showcase' ); ?></label>
        </th>
        <td>
          <?php $image_id = get_term_meta( $term->term_id, 'showcase-taxonomy-image-id', true ); ?>
          <input type="hidden" id="showcase-taxonomy-image-id" name="showcase-taxonomy-image-id" value="<?php echo esc_attr( $image_id ); ?>">
          <div id="category-image-wrapper">
            <?php if( $image_id ) { ?>
              <?php echo wp_get_attachment_image( $image_id, 'thumbnail' ); ?>
            <?php } ?>
          </div>
          <p>
            <input type="button" class="button button-secondary showcase_tax_media_button" id="showcase_tax_media_button" name="showcase_tax_media_button" value="<?php _e( 'Add Image', 'showcase' ); ?>" />
            <input type="button" class="button button-secondary showcase_tax_media_remove" id="showcase_tax_media_remove" name="showcase_tax_media_remove" value="<?php _e( 'Remove Image', 'showcase' ); ?>" />
          </p>
        </td>
      </tr>
   <?php }

   /**
    * Update the form field value
    * @since 1.0.0
    */
   public function updated_category_image( $term_id, $tt_id ) {
     if( isset( $_POST['showcase-taxonomy-image-id'] ) && '' !== $_POST['showcase-taxonomy-image-id'] ){
       update_term_meta( $term_id, 'showcase-taxonomy-image-id', absint( $_POST['showcase-taxonomy-image-id'] ) );
     } else {
       update_term_meta( $term_id, 'showcase-taxonomy-image-id', '' );
     }
   }
 
   /**
    * Enqueue styles and scripts
    * @since 1.0.0
    */
   public function add_script() {
     if( ! isset( $_GET['taxonomy'] ) || $_GET['taxonomy'] != 'projectcategory' ) {
       return;
     } ?>
     <script> jQuery(document).ready( function($) {
       _wpMediaViewsL10n.insertIntoPost = '<?php _e( "Insert", "showcase" ); ?>';
       function ct_media_upload(button_class) {
         var _custom_media = true, _orig_send_attachment = wp.media.editor.send.attachment;
         $('body').on('click', button_class, function(e) {
           var button_id = '#'+$(this).attr('id');
           var send_attachment_bkp = wp.media.editor.send.attachment;
           var button = $(button_id);
           _custom_media = true;
           wp.media.editor.send.attachment = function(props, attachment){
             if( _custom_media ) {
               $('#showcase-taxonomy-image-id').val(attachment.id);
               $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
               $( '#category-image-wrapper .custom_media_image' ).attr( 'src',attachment.url ).css( 'display','block' );
             } else {
               return _orig_send_attachment.apply( button_id, [props, attachment] );
             }
           }
           wp.media.editor.open(button); return false;
         });
       }
       ct_media_upload('.showcase_tax_media_button.button');
       $('body').on('click','.showcase_tax_media_remove',function(){
         $('#showcase-taxonomy-image-id').val('');
         $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
       });
       // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
       $(document).ajaxComplete(function(event, xhr, settings) {
         var queryStringArr = settings.data.split('&');
         if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
           var xml = xhr.responseXML;
           $response = $(xml).find('term_id').text();
           if($response!=""){
             // Clear the thumb image
             $('#category-image-wrapper').html('');
           }
          }
        });
      });
    </script>
   <?php }
  }
$Showcase_Taxonomy_Images = new Showcase_Taxonomy_Images();
$Showcase_Taxonomy_Images->init(); }