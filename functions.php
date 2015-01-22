<?php

function material_setup() {

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	//post thumbnail
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 800, 510, true );
	add_image_size( 'image', 800, 510, true );

	// Navigation
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' )
	) );

	// Set content-width
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 800;

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// post format
	add_theme_support( 'post-formats', array(
		'video', 'quote', 'gallery'
	) );

	
}

add_action( 'after_setup_theme', 'material_setup' );

// Load font
function load_fonts() {
            wp_register_style('et-googleFonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,200,100&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext');
            wp_enqueue_style( 'et-googleFonts');
        }
    add_action('wp_print_styles', 'load_fonts');


function material_scripts() {

	// Add stylesheet.
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.2' );
	wp_enqueue_style( 'material', get_template_directory_uri() . '/css/material.css', array(), '' );

	// Load our main stylesheet.
	wp_enqueue_style( 'material-style', get_stylesheet_uri() );

	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	wp_enqueue_script( 'material_bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'material_flexslider', get_template_directory_uri().'/js/flexslider.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'material_global', get_template_directory_uri().'/js/global.js', array('jquery'), '', true  );
	wp_enqueue_script( 'material-script', get_template_directory_uri() . '/js/material.js', array( 'jquery' ), '20141212', true );
	wp_enqueue_script( 'ripples-script', get_template_directory_uri() . '/js/ripples.js', array( 'jquery' ), '20141212', true );
	
}
add_action( 'wp_enqueue_scripts', 'material_scripts' );

/* Add featured image as background image to post navigation elements. */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );


/*    Google Analytics    */
add_action('wp_footer', 'add_googleanalytics');
function add_googleanalytics() { 
// Place the code you get from Google Analytics here
} 

// Flexslider function for format-gallery
function material_flexslider($size) {

	if ( is_page()) :
		$attachment_parent = $post->ID;
	else : 
		$attachment_parent = get_the_ID();
	endif;

	if($images = get_posts(array(
		'post_parent'    => $attachment_parent,
		'post_type'      => 'attachment',
		'numberposts'    => -1, // show all
		'post_status'    => null,
		'post_mime_type' => 'image',
                'orderby'        => 'menu_order',
                'order'           => 'ASC',
	))) { ?>
	
		<div class="flexslider">
		
			<ul class="slides">
	
				<?php foreach($images as $image) { 
					$attimg = wp_get_attachment_image($image->ID,'image'); ?>
					
					<li>
						<?php echo $attimg; ?>
						<?php if ( !empty($image->post_excerpt)) : ?>
						
							<div class="flexslider-caption">
								<p><?php echo $image->post_excerpt ?></p>
							</div>
							
						<?php endif; ?>
					</li>
					
				<?php }; ?>
		
			</ul>
			
		</div><?php
		
	}
}

add_action('get_header', 'my_filter_head');
function my_filter_head() {
remove_action('wp_head', '_admin_bar_bump_cb');
}

add_filter('next_posts_link_attributes','posts_link_attributes_1');
add_filter('previous_posts_link_attributes','posts_link_attributes_2');
function posts_link_attributes_1() {
  return 'class="btn btn-info btn-fab btn-raised mdi-hardware-keyboard-arrow-right"';
}
function posts_link_attributes_2() {
	return 'class="btn btn-info btn-fab btn-raised mdi-hardware-keyboard-arrow-left"';
}

add_filter( 'comment_form_defaults', 'my_comment_defaults');
 
function my_comment_defaults($defaults) {
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
 
	$defaults = array(
		'fields'        	   => array(
		'author' => '<div class="form-group"><label for="author" class="control-label">' . __( 'Name' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . '<input id="author" name="author" class="form-control" placeholder="your name" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
		'email' => '<div form-group><label for="email" class="control-label">' . __( 'Email' )  . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' . '<input id="email" name="email" class="form-control" placeholder="email@address.co.uk" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>'
                ),
		'comment_field' => '<div class="form-group"><label for="comment" class="control-label">' . _x( 'Comment', 'noun' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"  class="form-control" placeholder="your comment"></textarea></div>',
 
		'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
 
		'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
 
		'comment_notes_before' => '<fieldset>',
 
		'comment_notes_after'  => '</fieldset>',
 
		'id_form'              => 'commentform',
 
		'id_submit'            => 'submit',
 
		'title_reply'          => __( 'Leave a Comment' ),
 
		'title_reply_to'       => __( 'Leave a Reply %s' ),
 
		'cancel_reply_link'    => __( 'Cancel reply' ),
 
		'label_submit'         => __( 'Comment' ),

		'class_submit'		   => __('btn btn-primary'),
 
                );
 
    return $defaults;
}

// Hoffman comment function
if ( ! function_exists( 'material_comment' ) ) :
function material_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
	
		<?php __( 'Pingback:', 'hoffman' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'hoffman' ), '<span class="edit-link">', '</span>' ); ?>
		
	</li>
	<?php
			break;
		default :
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	
		<div id="comment-<?php comment_ID(); ?>" class="comment">
		
			<?php echo get_avatar( $comment, 150 ); ?>
			
			<?php 
				static $comment_number; $comment_number ++;
				$comment_number = str_pad($comment_number, 2, '0', STR_PAD_LEFT);
			?>
			
			<?php if ( $comment->user_id === $post->post_author ) { echo '<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '" title="' . __('Comment by post author','hoffman') . '" class="by-post-author"> ' . __( '', 'hoffman' ) . '</a>'; } ?>
			
			<div class="comment-inner">
			
				<div class="comment-header">
											
					<h4><?php echo get_comment_author_link(); ?> <span><?php _e('says:','hoffman') ?></span></h4>
				
				</div>
	
				<div class="comment-content post-content">
				
					<?php if ( '0' == $comment->comment_approved ) : ?>
					
						<p class="comment-awaiting-moderation"><?php __( 'Your comment is awaiting moderation.', 'hoffman' ); ?></p>
						
					<?php endif; ?>
				
					<?php comment_text(); ?>
					
				</div><!-- /comment-content -->
				
				<div class="comment-actions">
				
					<div class="fleft">
					
						<p class="comment-date"><a class="comment-date-link" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>" title="<?php echo get_comment_date() . ' at ' . get_comment_time(); ?>"><?php echo get_comment_date() . '<span> &mdash; ' . get_comment_time() . '</span>'; ?></a></p>
					
					</div>
				
					<div class="fright">
				
						<?php edit_comment_link( __( 'Edit', 'hoffman' ), '<p class="comment-edit">', '</p>' ); ?>
						
						<?php 
							comment_reply_link( array_merge( $args, 
							array( 
								'reply_text' 	=>  	__( 'Reply', 'hoffman' ), 
								'depth'			=> 		$depth, 
								'max_depth' 	=> 		$args['max_depth'],
								'before'		=>		'<p class="comment-reply">',
								'after'			=>		'</p>'
								) 
							) ); 
						?>
					
					</div> <!-- /fright -->
					
					<div class="clear"></div>
									
				</div> <!-- /comment-actions -->
			
			</div> <!-- /comment-inner -->
			
		</div><!-- /comment-## -->
				
	<?php
		break;
	endswitch;
}
endif;

//Read more link 
add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link() {
return '<p><a class="more-link btn btn-info" href="' . get_permalink() . '">Read More</a></p>';
}




