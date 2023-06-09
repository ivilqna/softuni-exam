<?php

/**
 * homes Enqueue
 */
function softuni_enqueue_scripts() {
	wp_enqueue_script( 'softuni-script', plugins_url( 'scripts/scripts.js', __FILE__ ), array( 'jquery' ), 1.1 );
	wp_localize_script( 'softuni-script', 'my_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

}
add_action( 'wp_enqueue_scripts', 'softuni_enqueue_scripts' );

/**
 * Functions takes care of the like of the home
 *
 * @return void
 */
function softuni_home_like() {
	$home_id = esc_attr( $_POST['home_id'] );

	$like_number = get_post_meta( $home_id, 'likes', true );

    if ( empty( $like_number ) ) {
        update_post_meta( $home_id, 'likes', 1 );
    } else {
        $like_number = $like_number + 1;
        update_post_meta( $home_id, 'likes', $like_number );
    }

    wp_die();
}
add_action( 'wp_ajax_nopriv_softuni_home_like', 'softuni_home_like' );
add_action( 'wp_ajax_softuni_home_like', 'softuni_home_like' );


/**
 * Display a single post term
 *
 * @param integer $post_id
 * @param [type] $taxonomy
 * @return void
 */
function softuni_display_single_term( $post_id, $taxonomy ) {

    if ( empty( $post_id ) || empty( $taxonomy ) ) {
        return;
    }

    $terms = get_the_terms( $post_id, $taxonomy );

    $output = '';
    if ( ! empty( $terms ) && is_array( $terms ) ) {
        foreach( $terms as $term ) {
            $output .= $term->name . ', ' ;
        }
    }

    return $output;
}

/**
 * Displays related homes from their category
 *
 * @param [type] $post_id
 * @return void
 */
function softuni_display_related_homes( $post_id ) {

}

/**
 * Displays other homes from this company
 *
 * @param [type] $post
 * @return void
 */
function softuni_display_other_homes_per_company( $home_id ) {
    if ( empty( $home_id ) ) {
        return;
    }

    $homes_args = array(
        'post_type'         => 'home',
        'post_status'       => 'publish',
        'orderby'           => 'name',
        'posts_per_page'    => 2,

        // set a taxonomy query
    );

    $homes_query = new WP_Query( $homes_args );

    // var_dump( $homes_query ); die();

    if ( ! empty( $homes_query ) ) {
        ?>
        <ul class="homes-listing">
            <?php foreach( $homes_query->posts as $home ) { ?>

            <?php // var_dump( $home ); ?>
            <li class="home-card">
                <div class="home-primary">
                    <h2 class="home-title"><a href="#"><?php echo $home->post_title; ?></a></h2>
                    <div class="home-meta">
                        <a class="meta-company" href="#">Company Awesome Ltd.</a>
                        <span class="meta-date">Posted 14 days ago</span>
                    </div>
                    <div class="home-details">
                        <span class="home-location">The Hague (The Netherlands)</span>
                        <span class="home-type">Contract staff</span>
                    </div>
                </div>
                    
                </li>
            <?php } ?>
		</ul>
    <?php
    }
}

/**
 * Displays the current user name if the user is logged in
 *
 * @return void
 */
function softuni_display_username() {
    $output = '';

    if ( is_user_logged_in() == true ) {
        $current_user = wp_get_current_user();
        $user_display_name = $current_user->data->display_name;
        $output = 'Hello, ' . $user_display_name . ', enjoy the article!';
    }

    return $output;
}
add_shortcode( 'display_username', 'softuni_display_username' );

function shortcode_user_avatar() {
    if(is_user_logged_in()) {
    global $current_user;
    wp_get_current_user();
    return get_avatar( $current_user -> ID, 120 );
    }
    else {
    // If not logged in then show default avatar. Change the URL to show your own default avatar
    return get_avatar( 'http://1.gravatar.com/avatar/ad524503a11cd5ca435acc9bb6523536?s=64', 120 );
    }
    }
    
    add_shortcode('display-user-avatar','shortcode_user_avatar');

    function name_shortcode() {
        return $_GET['name'];
    }
    add_shortcode( 'Name', 'name_shortcode' );

/**
 * It gets the content and counts the number of words
 *
 * @return void
 */
function softunit_display_post_word_count( $atts ) {
    $output = '';
    $word_count = 0;
    $post_id = '';

    $attributes = shortcode_atts( array(
		'post_id' => '',
	), $atts );

    if ( ! empty( $attributes['post_id'] ) ) {
        $post_id = $attributes['post_id'];

        $post = get_post( $attributes['post_id'] );
        if ( ! empty( $post ) ) {
            // @TODO: we have to strip the markup and Gutenberg items so we have a better result.
            $post_content = $post->post_content;
            $word_count = str_word_count( $post_content );
        }

    } else {
        $output = 'You must add a post_id as an attribute.';
    }

    if ( ! empty( $word_count ) ) {
        $output = 'The number of words for the Post ID ' . $post_id . ' is ' . $word_count;
    }

    return $output;
}
add_shortcode( 'display_post_word_count', 'softunit_display_post_word_count' );

function softuni_update_home_visit_count( $post_id = 0 ) {
    if ( empty( $post_id ) ) {
        return;
    }

    $visit_count = get_post_meta( $post_id, 'visits_count', true );

    if ( ! empty( $visit_count ) ) {
        $visit_count = $visit_count + 1;

        update_post_meta( $post_id, 'visits_count', $visit_count );
    } else {
        update_post_meta( $post_id, 'visits_count', 1 );
    }
}

// Old code from the initial sessions
 /**
  * Undocumented function
  *
  * @param [type] $title
  * @return void
  */
  function change_title_text( $title ) {

    var_dump( $title );

    return $title . ' 1st function' ;
}
// add_filter( 'the_title', 'change_title_text', 10 );


function change_title_again( $title ) {

    return $title . ' 2nd function';
}
// add_filter( 'the_title', 'change_title_again', 1 );

function change_title_for_the_third_time( $title ) {

    return $title . ' 3rd function';
}
// add_filter( 'the_title', 'change_title_for_the_third_time', 3 );

// @TODO: 
/**
 * Undocumented function
 *
 * @param [type] $content
 * @return void
 */

// post-template-default single single-post postid-5 single-format-standard logged-in admin-bar no-customize-support wp-embed-responsive
// post-template-default single single-post postid-5 single-format-standard logged-in admin-bar no-customize-support wp-embed-responsive my-custom-body-class


