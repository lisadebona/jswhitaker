<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package jspine
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function jspine_body_classes( $classes ) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    if ( is_front_page() || is_home() ) {
        $classes[] = 'homepage';
    } else {
        $classes[] = 'subpage';
    }

    $browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
    $classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));

    return $classes;
}
add_filter( 'body_class', 'jspine_body_classes' );

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}


function add_query_vars_filter( $vars ) {
  $vars[] = "pg";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


function shortenText($string, $limit, $break=".", $pad="...") {
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  // is $break present between $limit and the end of the string?
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
    if($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }

  return $string;
}

/* Fixed Gravity Form Conflict Js */
add_filter("gform_init_scripts_footer", "init_scripts");
function init_scripts() {
    return true;
}

function get_page_id_by_template($fileName) {
    $page_id = 0;
    if($fileName) {
        $pages = get_pages(array(
            'post_type' => 'page',
            'meta_key' => '_wp_page_template',
            'meta_value' => $fileName.'.php'
        ));

        if($pages) {
            $row = $pages[0];
            $page_id = $row->ID;
        }
    }
    return $page_id;
}

function string_cleaner($str) {
    if($str) {
        $str = str_replace(' ', '', $str); 
        $str = preg_replace('/\s+/', '', $str);
        $str = preg_replace('/[^A-Za-z0-9\-]/', '', $str);
        $str = strtolower($str);
        $str = trim($str);
        return $str;
    }
}

function format_phone_number($string) {
    if(empty($string)) return '';
    $append = '';
    if (strpos($string, '+') !== false) {
        $append = '+';
    }
    $string = preg_replace("/[^0-9]/", "", $string );
    $string = preg_replace('/\s+/', '', $string);
    return $append.$string;
}

function get_instagram_setup() {
    global $wpdb;
    $result = $wpdb->get_row( "SELECT option_value FROM $wpdb->options WHERE option_name = 'sb_instagram_settings'" );
    if($result) {
        $option = ($result->option_value) ? @unserialize($result->option_value) : false;
    } else {
        $option = '';
    }
    return $option;
}

function extract_emails_from($string){
  preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
  return $matches[0];
}

function email_obfuscator($string) {
    $output = '';
    if($string) {
        $emails_matched = ($string) ? extract_emails_from($string) : '';
        if($emails_matched) {
            foreach($emails_matched as $em) {
                $encrypted = antispambot($em,1);
                $replace = 'mailto:'.$em;
                $new_mailto = 'mailto:'.$encrypted;
                $string = str_replace($replace, $new_mailto, $string);
                $rep2 = $em.'</a>';
                $new2 = antispambot($em).'</a>';
                $string = str_replace($rep2, $new2, $string);
            }
        }
        $output = apply_filters('the_content',$string);
    }
    return $output;
}

function get_social_links() {
    $social_types = array(
        'facebook'  => 'fab fa-facebook-square',
        'twitter'   => 'fab fa-twitter-square',
        'instagram' => 'fab fa-instagram',
        'snapchat'  => 'fab fa-snapchat-ghost',
        'youtube'   => 'fab fa-youtube'
    );
    $social = array();
    foreach($social_types as $k=>$icon) {
        $value = get_field($k,'option');
        if($value) {
            $social[$k] = array('link'=>$value,'icon'=>$icon,'name'=>$k);
        }
    }
    return $social;
}


function accordion_items( $atts ) {
    $services = get_field('services');
    $content = '';
    ob_start();
    if($services) { ?>
        <div class="accordion-wrapper cf">
            <div class="accaction"><a id="collapseAll" data-status="close" href="#">Collapse All</a></div>
        <?php $i=1; foreach($services as $svc) {
            $title = $svc['title'];
            $text = $svc['description'];
            //$open = ($i==1) ? ' open':'';
            $default = ($i==1) ? ' style="display:block"':'';
            if($title && $text) { ?>
                <div id="acc<?php echo $i;?>" class="acc-item"<?php echo $default ?>>
                    <div class="acctitle"><h3><?php echo $title ?> <span class="iconplus"><i class="fas fa-plus"></i></span></h3></div>
                    <div class="acctext"<?php echo $default ?>><?php echo $text; ?></div>
                </div>
            <?php $i++; }
        } ?>

        </div>

    <?php }
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}
add_shortcode( 'services_items', 'accordion_items' );


function copy_site_reviews() {
    global $wpdb;
    $new_posts = array();
    $results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}richreviews", OBJECT );
    if($results) {
        foreach($results as $row) {
            // $date_time = $row->date_time;
            // $author = $row->reviewer_name;
            // $email = $row->reviewer_email;
            // $title = $row->review_title;
            // $rating = $row->review_rating;
            // $review_text = $row->review_text;
            $ip = $row->reviewer_ip;
            if( !is_ip_exists($ip) ) {
                $new_id = insert_site_reviews($row);
                $new_posts[] = $new_id;
            }
        }
    }
    return $new_posts;
}

function insert_site_reviews($row) {
    global $wpdb;
    $date_time = $row->date_time;
    $author = ($row->reviewer_name) ? $row->reviewer_name:'Anonymous';
    $email = ($row->reviewer_email) ? $row->reviewer_email : '';
    $title = ($row->review_title) ? $row->review_title : '';
    $rating = $row->review_rating;
    $review_text = $row->review_text;

    $post_name = ($title) ? sanitize_title($title) : '';
    $posts_table = $wpdb->prefix . "posts";

    $meta_ids = array();
    $wpdb->insert( 
        $posts_table, 
        array( 
            'post_author' => 1, 
            'post_date' => $date_time,
            'post_date_gmt'=> $date_time,
            'post_title'=>$title,
            'post_content'=> $review_text,
            'post_status'=>'publish',
            'comment_status'=> 'closed',
            'post_name'=>$post_name,
            'post_type'=>'site-review'
        )
    );
    $new_id = $wpdb->insert_id;
    if($new_id) {
        $guid = get_site_url() . '/?post_type=site-review&#038;p=' . $new_id;
        $wpdb->update( 
            $posts_table,
            array( 
                'guid' => $guid,  
            ), 
            array( 'ID' => $new_id )
        );
        $meta_ids = insert_reviews_to_meta($new_id,$row);
    }
    return ($new_id && $meta_ids) ? array('post_id'=>$new_id,'meta_ids'=>$meta_ids) : '';
}

function insert_reviews_to_meta($postId,$row) {
    global $wpdb;
    $metaIds = array();
    $date_time = $row->date_time;
    $author = $row->reviewer_name;
    $email = $row->reviewer_email;
    $title = ($row->review_title) ? $row->review_title : '';
    $rating = $row->review_rating;
    $review_text = $row->review_text;
    $ip = $row->reviewer_ip;

    $meta_table = $wpdb->prefix . "postmeta";
    $jsonData = array(
            'author'=> $author,
            'avatar'=>'http://0.gravatar.com/avatar/cf87acab77d8e313ee18d3694bf9fb93?s=96&d=mm&r=g',
            'email'=>$email,
            'rating'=>$rating
        );
    $jsonEncode = json_encode($jsonData);
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
    $review_id = $postId . substr(str_shuffle($str_result), 0, 31); 

    $meta_keys = array(
            '_assigned_to'=>'',
            '_author'=>$author,
            '_avatar'=>'http://0.gravatar.com/avatar/cf87acab77d8e313ee18d3694bf9fb93?s=96&d=mm&r=g',
            '_content'=>$review_text,
            '_custom'=>'a:0:{}',
            '_date'=>$date_time,
            '_email'=>$email,
            '_ip_address'=>$ip,
            '_pinned'=>'',
            '_rating'=>$rating,
            '_response'=>'',
            '_review_id'=>$review_id,
            '_review_type'=> 'local',
            '_title'=>$title,
            '_url'=>'',
            '_json'=> $jsonEncode,
            '_edit_last'=> 1,
            '_edit_lock'=> ''
        );
    foreach($meta_keys as $key => $val) {
        $wpdb->insert( 
            $meta_table, 
            array( 
                'post_id'  => $postId, 
                'meta_key' => $key,
                'meta_value' => $val
            )
        );
        $metaNewId = $wpdb->insert_id;
        if($metaNewId) {
            $metaIds[] = $metaNewId;
        }
    }
    return $metaIds;
}

function is_ip_exists($ip) {
    global $wpdb;
    $ip = preg_replace('/\s+/', '', $ip);
    $results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key='_ip_address' AND meta_value='".$ip."'", OBJECT );
    return ($results) ? true : false;
}

