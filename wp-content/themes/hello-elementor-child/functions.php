<?php
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
function enqueue_scripts(){
    wp_enqueue_script('core_js', get_stylesheet_directory_uri() . '/js/core.js', array( 'jquery' ),'', true);
    wp_enqueue_script('episode_filter_js', get_stylesheet_directory_uri() . '/js/episode-filter.js', array( 'jquery' ),'', true);
    wp_enqueue_script('episode_sort_js', get_stylesheet_directory_uri() . '/js/episode-sort.js', array( 'jquery' ),'', true);
}

add_action( 'elementor/query/most_popular_episode', 'most_popular_episode' );
function most_popular_episode( $query ){
    $query->set('meta_key', 'most_popular');
    $query->set('meta_value', true);
}

add_action( 'elementor/query/remaining_popular_episodes', 'remaining_popular_episodes' );
function remaining_popular_episodes( $query ){
    $meta_query = array(
        array(
            'key' => 'most_popular',
            'value' => true,
            'compare' => '!=' 
        ),
        array(
            'key' => 'is_popular',
            'value' => true
        )
    );
    
    $query->set('meta_query', $meta_query);
}


function get_filtered_post_ids( $request ){
    $response = new stdClass();
    $response->filtered_posts = array();

    //$keyword = $request["keyword"]; //string
    $host_ids = $request["hosts"]; //arrayy[int] 
    $tag_slugs = $request["tags"]; //array[string] 

    $args = array(
        "post_type" => "post",
        "numberposts" => -1,
        "post_status" => "publish"
    );
    $posts = get_posts( $args );

    foreach( $posts as $post ){
        $passed = array( "hosts" => false, "tags" => false );
        //check query in title and excerpt
        /*if( $keyword ){
            if( stripos( $post->post_title, $keyword ) !== false ) $passed["keyword"] = true;
            else if( stripos( $post->post_excerpt, $keyword ) !== false ) $passed["keyword"] = true;
            else if( stripos( $post->post_content, $keyword ) !== false ) $passed["keyword"] = true;
        }else $passed["keyword"] = true;*/
        //check hosts
        if( $host_ids ){
            foreach( $host_ids as $host ){
                $post_hosts = get_field( 'hosts', $post->ID );
                if( $host =='' || in_array( $host, $post_hosts ) ) $passed["hosts"] = true;
            }
        }else $passed["hosts"] = true;
        //check tags
        if( $tag_slugs ){
            foreach( $tag_slugs as $tag ){
                if( $tag == '' || has_tag( $tag, $post->ID ) ) $passed["tags"] = true;
            }
        }else $passed["tags"] = true;

        if( !in_array( false, $passed ) ) array_push( $response->filtered_posts, $post->ID );
    }
    return $response;
}

function get_sorted_post_ids( $request ){
    $response = new stdClass();
    
    $args_date_asc = array(
        "numberposts" => -1,
        "orderby" => "date",
        "order" => "ASC",
        "fields" => "ids"
    );

    $args_date_desc = array(
        "numberposts" => -1,
        "orderby" => "date",
        "order" => "DESC",
        "fields" => "ids"
    );

    $args_popular = array(
        "numberposts" => -1,
        "orderby" => "date",
        "order" => "DESC",
        "meta_key" => "is_popular", 
        "meta_value" => true,
        "fields" => "ids"
    );

    $args_not_popular = array(
        "numberposts" => -1,
        "orderby" => "date",
        "order" => "DESC",
        "meta_key" => "is_popular", 
        "meta_value" => 0,
        "fields" => "ids"
    );

    $date_ascesing_posts = get_posts( $args_date_asc );
    $date_descending_posts = get_posts( $args_date_desc );
    $popular_posts = get_posts( $args_popular );
    $not_popular_posts = get_posts( $args_not_popular );

    if( $popular_posts == null || count( $popular_posts ) == 0 ) $popular_posts = $not_popular_posts;
    else if( $not_popular_posts != null ) {
        foreach( $not_popular_posts as $not_popular_post )array_push( $popular_posts, $not_popular_post );
    }
    $response->date_asc = $date_ascesing_posts;
    $response->date_desc = $date_descending_posts;
    $response->popularity = $popular_posts;

    return json_encode( $response );
}

add_action('rest_api_init', 'register_routes');
function register_routes(){
    $args = array(
        "methods" => "GET", 
        "callback" => "get_filtered_post_ids"
    );
    register_rest_route("post-filter/v1", "do-filter", $args);

    $args = array(
        "methods" => "GET",
        "callback" => "get_sorted_post_ids"
    );
    register_rest_route("post-sort/v1", "get-sorted-ids", $args);
}

//Create dropdown checkbox menu with topic tags

add_filter('elementor_pro/forms/field_types', function ($types) {
    $types['topic_tags'] = "Topic Tags";
    return $types;
});

add_filter('elementor_pro/forms/render/item/topic_tags', function ($item, $item_index, $instance) {
    $tags_options = array();
    $tags = get_tags();

    $field_options = [];

    foreach ($tags as $tag) {
        $field_options[] = $tag->name . "|" . $tag->name;
    }

    $item['field_options'] = implode("\n", $field_options);
    $item['field_type'] = "checkbox";

    return $item;
},99,3);

//TODO: Create dropdown checkbox menu with hosts

//Add Google Analytics
add_action('wp_head', 'google_analytics');
function google_analytics(){
    echo "
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src='https://www.googletagmanager.com/gtag/js?id=G-SDJZKC07ZZ'></script>
    <script>
      console.log('Hello google analytics');
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-SDJZKC07ZZ');
    </script>
    ";
}
