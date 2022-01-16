<?php

function cptui_register_my_cpts()
{

    /**
     * Post Type: Flats.
     */

    $labels = [
        "name" => __("Flats", "twentyeleven"),
        "singular_name" => __("Flat", "twentyeleven"),
        "menu_name" => __("Flats", "twentyeleven"),
        "all_items" => __("All Flats", "twentyeleven"),
        "add_new" => __("Add new", "twentyeleven"),
        "add_new_item" => __("Add new Flat", "twentyeleven"),
        "edit_item" => __("Edit Flat", "twentyeleven"),
        "new_item" => __("New Flat", "twentyeleven"),
        "view_item" => __("View Flat", "twentyeleven"),
        "view_items" => __("View Flats", "twentyeleven"),
        "search_items" => __("Search Flats", "twentyeleven"),
        "not_found" => __("No Flats found", "twentyeleven"),
        "not_found_in_trash" => __("No Flats found in trash", "twentyeleven"),
        "parent" => __("Parent Flat:", "twentyeleven"),
        "featured_image" => __("Featured image for this Flat", "twentyeleven"),
        "set_featured_image" => __("Set featured image for this Flat", "twentyeleven"),
        "remove_featured_image" => __("Remove featured image for this Flat", "twentyeleven"),
        "use_featured_image" => __("Use as featured image for this Flat", "twentyeleven"),
        "archives" => __("Flat archives", "twentyeleven"),
        "insert_into_item" => __("Insert into Flat", "twentyeleven"),
        "uploaded_to_this_item" => __("Upload to this Flat", "twentyeleven"),
        "filter_items_list" => __("Filter Flats list", "twentyeleven"),
        "items_list_navigation" => __("Flats list navigation", "twentyeleven"),
        "items_list" => __("Flats list", "twentyeleven"),
        "attributes" => __("Flats attributes", "twentyeleven"),
        "name_admin_bar" => __("Flat", "twentyeleven"),
        "item_published" => __("Flat published", "twentyeleven"),
        "item_published_privately" => __("Flat published privately.", "twentyeleven"),
        "item_reverted_to_draft" => __("Flat reverted to draft.", "twentyeleven"),
        "item_scheduled" => __("Flat scheduled", "twentyeleven"),
        "item_updated" => __("Flat updated.", "twentyeleven"),
        "parent_item_colon" => __("Parent Flat:", "twentyeleven"),
    ];

    $args = [
        "label" => __("Flats", "twentyeleven"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "flats", "with_front" => true ],
        "query_var" => true,
        "menu_position" => 5,
        "supports" => [ "title", "revisions" ],
        "show_in_graphql" => false,
    ];

    register_post_type("flats", $args);

    /**
     * Post Type: Parking lots.
     */

    $labels = [
        "name" => __("Parking lots", "twentyeleven"),
        "singular_name" => __("Parking lot", "twentyeleven"),
        "menu_name" => __("Parking lots", "twentyeleven"),
        "all_items" => __("All Parking lots", "twentyeleven"),
        "add_new" => __("Add new", "twentyeleven"),
        "add_new_item" => __("Add new Parking lot", "twentyeleven"),
        "edit_item" => __("Edit Parking lot", "twentyeleven"),
        "new_item" => __("New Parking lot", "twentyeleven"),
        "view_item" => __("View Parking lot", "twentyeleven"),
        "view_items" => __("View Parking lots", "twentyeleven"),
        "search_items" => __("Search Parking lots", "twentyeleven"),
        "not_found" => __("No Parking lots found", "twentyeleven"),
        "not_found_in_trash" => __("No Parking lots found in trash", "twentyeleven"),
        "parent" => __("Parent Parking lot:", "twentyeleven"),
        "featured_image" => __("Featured image for this Parking lot", "twentyeleven"),
        "set_featured_image" => __("Set featured image for this Parking lot", "twentyeleven"),
        "remove_featured_image" => __("Remove featured image for this Parking lot", "twentyeleven"),
        "use_featured_image" => __("Use as featured image for this Parking lot", "twentyeleven"),
        "archives" => __("Parking lot archives", "twentyeleven"),
        "insert_into_item" => __("Insert into Parking lot", "twentyeleven"),
        "uploaded_to_this_item" => __("Upload to this Parking lot", "twentyeleven"),
        "filter_items_list" => __("Filter Parking lots list", "twentyeleven"),
        "items_list_navigation" => __("Parking lots list navigation", "twentyeleven"),
        "items_list" => __("Parking lots list", "twentyeleven"),
        "attributes" => __("Parking lots attributes", "twentyeleven"),
        "name_admin_bar" => __("Parking lot", "twentyeleven"),
        "item_published" => __("Parking lot published", "twentyeleven"),
        "item_published_privately" => __("Parking lot published privately.", "twentyeleven"),
        "item_reverted_to_draft" => __("Parking lot reverted to draft.", "twentyeleven"),
        "item_scheduled" => __("Parking lot scheduled", "twentyeleven"),
        "item_updated" => __("Parking lot updated.", "twentyeleven"),
        "parent_item_colon" => __("Parent Parking lot:", "twentyeleven"),
    ];

    $args = [
        "label" => __("Parking lots", "twentyeleven"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => "edit.php?post_type=flats",
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "parking_lots", "with_front" => true ],
        "query_var" => true,
        "menu_position" => 6,
        "supports" => [ "title", "revisions" ],
        "show_in_graphql" => false,
    ];

    register_post_type("parking_lots", $args);
}

add_action('init', 'cptui_register_my_cpts');
