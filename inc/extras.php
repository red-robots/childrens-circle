<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bellaworks
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bellaworks_body_classes( $classes ) {
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
add_filter( 'body_class', 'bellaworks_body_classes' );

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
            $social[$k] = array('link'=>$value,'icon'=>$icon);
        }
    }
    return $social;
}


/* NEWS => Get Next Entries */
/* Get Faculty Details via Ajax */
add_action( 'wp_ajax_nopriv_get_the_next_entries', 'get_the_next_entries' );
add_action( 'wp_ajax_get_the_next_entries', 'get_the_next_entries' );
function get_the_next_entries() {
    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $paged = ($_POST['pg']) ? $_POST['pg'] + 1 : 1;
        $posttype = ($_POST['posttype']) ? $_POST['posttype'] : '';
        $perpage = ($_POST['perpage']) ? $_POST['perpage'] : 3;
        $orderbyArr = ($_POST['orderby']) ? $_POST['orderby'] : '';

        $args = array(
            'posts_per_page'   => $perpage,
            'post_type'        => $posttype,
            'post_status'      => 'publish',
            'paged'            => $paged
        );
        $posts = get_posts($args);
        $total = ($posts) ? count($posts): 0;
        $is_last_batch = ($total<$perpage) ? true : "";

        $result = next_entries_result($posttype,$paged,$perpage,$orderbyArr);
        if($result) {
            $response['content'] = $result;
            $response['next_page'] = $paged + 1;
            $response['last_batch'] = $is_last_batch;
        } else {
            $response['content'] = false;
        }
        echo json_encode($response);
    }
    else {
        header("Location: ".$_SERVER["HTTP_REFERER"]);
    }
    die();
}

function next_entries_result($posttype='post',$paged=1,$perpage=10,$orderbyArr=null) {
    $output = '';
    $args = array(
        'posts_per_page'   => $perpage,
        'post_type'        => $posttype,
        'post_status'      => 'publish',
        'paged'            => $paged
    );
    if($orderbyArr) {
        $args['orderby'] = $orderbyArr['orderby'];
        $args['order'] = $orderbyArr['order'];
    }
    $placeholder = get_bloginfo("template_url") . "/images/square.png";
    $posts = new WP_Query($args);
    ob_start();
    if ( $posts->have_posts() ) { ?>
        
        <?php while ( $posts->have_posts() ) : $posts->the_post();
            $postId = get_the_ID();
            $thumbId = get_post_thumbnail_id($postId);
            $image = wp_get_attachment_image_src($thumbId,'medium_large');
            $style = ($image) ? ' style="background-image:url('.$image[0].')"':'';
            $content = get_the_content();
            if($content) {
                $content = strip_shortcodes($content);
                $content = strip_tags($content);
                $content = shortenText($content, 90, " ", "...");
            }
            $postdate = get_the_date('m/d/Y');
            $pagelink = get_the_permalink();
            $show_thumbnail = array('post');
        ?>
        <article data-pid="<?php the_ID() ?>" class="post-item">
            <div class="inner cf">
                <?php if (in_array($posttype, $show_thumbnail)) { ?>
                    <div class="postdate"><span><?php echo $postdate ?></span></div>
                    <div class="thumb <?php echo ($image) ? 'hasimage':'noimage'; ?>"<?php echo $style ?>>
                        <a href="<?php echo $pagelink ?>"><img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" /></a>
                    </div>
                <?php } else { ?>
                    <div class="postdate"><a href="<?php echo $pagelink ?>"><?php echo $postdate ?></a></div>
                <?php } ?>

                <div class="text">
                    <h2 class="ptitle"><a href="<?php echo $pagelink ?>"><?php echo get_the_title(); ?></a></h2>
                    <div class="excerpt"><?php echo $content; ?></div>
                </div>
            </div>
        </article>
        <?php endwhile; wp_reset_postdata(); ?>

    <?php } 
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

