<?php

use Bayfront\ArrayHelpers\Arr;
use Bayfront\StringHelpers\Str;
use Zttp\Zttp;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class Teamgate_Importer_Run
 *
 * Thats where we bring the plugin to life
 *
 * @package		TEAMGATEIM
 * @subpackage	Classes/Teamgate_Importer_Run
 * @author		Codesomelabs
 * @since		1.0.0
 */
class Teamgate_Importer_Run
{
	/**
	 * Our Teamgate_Importer_Run constructor
	 * to run the plugin logic.
	 *
	 * @since 1.0.0
	 */
	function __construct()
	{
		$this->add_hooks();
	}

	/**
	 * Registers all WordPress and plugin related hooks
	 *
	 * @access	private
	 * @since	1.0.0
	 * @return	void
	 */
	private function add_hooks()
	{
		add_action( 'plugin_action_links_' . TEAMGATEIM_PLUGIN_BASE, array( $this, 'add_plugin_action_link' ), 20 );
		add_action( 'admin_bar_menu', array( $this, 'add_admin_bar_menu_items' ), 100, 1 );

		add_filter( 'query_vars', [$this, 'set_query_vars'] );
		add_filter( 'manage_flats_posts_columns', [$this, 'set_flats_admin_columns'] );
		add_filter( 'manage_parking_lots_posts_columns', [$this, 'set_parking_lots_admin_columns'] );

		add_action( 'pre_get_posts', [$this, 'handle_import']);
		add_action( 'manage_flats_posts_custom_column', [$this, 'set_flats_admin_columns_data'], 10, 2);
		add_action( 'manage_parking_lots_posts_custom_column', [$this, 'set_parking_lots_admin_columns_data'], 10, 2);
	}

	/**
	* Adds action links to the plugin list table
	*
	* @access	public
	*
	* @param	array	$links An array of plugin action links.
	*
	* @return	array	An array of plugin action links.
	*@since	1.0.0
	*
	*/
	public function add_plugin_action_link( array $links ): array
	{
		$links['our_shop'] = sprintf( '<a href="%s" title="Custom Link" style="font-weight:700;">%s</a>', 'https://test.test', __( 'Custom Link', 'teamgate-importer' ) );

		return $links;
	}

	/**
	 * Add a new menu item to the WordPress topbar
	 *
	 * @access	public
	 * @since	1.0.0
	 *
	 * @param	object $admin_bar The WP_Admin_Bar object
	 *
	 * @return	void
	 */
	public function add_admin_bar_menu_items( $admin_bar )
	{
		$admin_bar->add_menu( array(
			'id'		=> 'teamgate-importer-id', // The ID of the node.
			'title'		=> __( 'Demo Menu Item', 'teamgate-importer' ), // The text that will be visible in the Toolbar. Including html tags is allowed.
			'parent'	=> false, // The ID of the parent node.
			'href'		=> '#', // The ‘href’ attribute for the link. If ‘href’ is not set the node will be a text node.
			'group'		=> false, // This will make the node a group (node) if set to ‘true’. Group nodes are not visible in the Toolbar, but nodes added to it are.
			'meta'		=> array(
				'title'		=> __( 'Demo Menu Item', 'teamgate-importer' ), // The title attribute. Will be set to the link or to a div containing a text node.
				'target'	=> '_blank', // The target attribute for the link. This will only be set if the ‘href’ argument is present.
				'class'		=> 'teamgate-importer-class', // The class attribute for the list item containing the link or text node.
				'html'		=> false, // The html used for the node.
				'rel'		=> false, // The rel attribute.
				'onclick'	=> false, // The onclick attribute for the link. This will only be set if the ‘href’ argument is present.
				'tabindex'	=> false, // The tabindex attribute. Will be set to the link or to a div containing a text node.
			),
		));

		$admin_bar->add_menu( array(
			'id'		=> 'teamgate-importer-sub-id',
			'title'		=> __( 'My sub menu title', 'teamgate-importer' ),
			'parent'	=> 'teamgate-importer-id',
			'href'		=> '#',
			'group'		=> false,
			'meta'		=> array(
				'title'		=> __( 'My sub menu title', 'teamgate-importer' ),
				'target'	=> '_blank',
				'class'		=> 'teamgate-importer-sub-class',
				'html'		=> false,
				'rel'		=> false,
				'onclick'	=> false,
				'tabindex'	=> false,
			),
		));

	}

	public function set_flats_admin_columns(array $columns): array
	{
		unset( $columns['date'] );
		$columns['status'] = __('Status', 'teamgate-importer');
		$columns['stage'] = __('Stage', 'teamgate-importer');
		$columns['building'] = __('Building', 'teamgate-importer');
		$columns['number'] = __('Number', 'teamgate-importer');
		$columns['price'] = __('Price', 'teamgate-importer');

		return $columns;
	}

	/**
	 * @param string $column
	 * @param int $post_id
	 *
	 * @return string
	 */
	public function set_flats_admin_columns_data(string $column, int $post_id): ?string
	{
		switch ($column)
		{
			case 'status':
				echo get_field('field_61e2a71bf8e1e', $post_id);
				break;
			case 'stage':
				echo get_field('field_61e2a620f8e14', $post_id);
				break;
			case 'building':
				echo get_field('field_61e2a66df8e15', $post_id);
				break;
			case 'number':
				echo get_field('field_61e2a67af8e16', $post_id);
				break;
			case 'price':
				echo number_format_i18n(get_field('field_61e2a702f8e1d', $post_id), 2);
				break;
		}

		return null;
	}

	public function set_parking_lots_admin_columns(array $columns): array
	{
		unset( $columns['date'] );
		$columns['status'] = __('Status', 'teamgate-importer');
		$columns['price'] = __('Price', 'teamgate-importer');

		return $columns;
	}

	/**
	 * @param string $column
	 * @param int $post_id
	 *
	 * @return string
	 */
	public function set_parking_lots_admin_columns_data(string $column, int $post_id): ?string
	{
		switch ($column)
		{
			case 'status':
				echo get_field('field_61e2b85442321', $post_id);
				break;
			case 'price':
				echo number_format_i18n(get_field('field_61e2b89d42322', $post_id), 2);
				break;
		}

		return null;
	}

	public function set_query_vars(array $vars): array
	{
		$vars[] = 'import_action';

		return $vars;
	}

	/**
	 * @param $wp_query
	 *
	 * @return void
	 */
	public function handle_import($wp_query)
	{
		if ( $wp_query->is_main_query() && ! is_admin() ) {
			if ($wp_query->get('import_action') === 'teamgate') {
				$response = Zttp::withHeaders([
					'X-App-Key' => 'xcdo2Y32CGZoxeZXlulaYzjZInEPrZpc1GGpe7ggD4I1YiN8QxWpm4CshG6MekoUqt0KpepqXxftTqrk',
					'X-Auth-Token' => '8d47747220250bba78aaffc60edcad6e3fea3bbd',
				])->get('https://api.teamgate.com/v4/products', [
					'limit' => 10000,
					'embed' => 'customFields',
				]);

				if (!$response->json() || empty($items = Arr::get($response->json(), 'data'))) {
					return;
				}

				foreach ($items as $item) {
					if ($post = $this->item_exist(Arr::get($item, 'id'))) {
						$this->update_post($post, $item);
					} else {
						$this->insert_post($item);
					}
				}
			}
		}
	}

	/**
	 * @param array $item
	 *
	 * @return void
	 */
	private function insert_post(array $item): void
	{
		$post_type = $this->get_post_type($item);

		if (!$post_type) {
			return;
		}

		$post_id = wp_insert_post([
			'post_title' => Arr::get($item, 'name'),
			'post_type' => $post_type,
			'post_status' => 'publish',
		]);

		$this->update_custom_fields(
			$post_type,
			$item,
			$post_id
		);
	}

	/**
	 * @param WP_Post $post
	 * @param array $item
	 *
	 * @return void
	 */
	private function update_post(WP_Post $post, array $item): void
	{
		$post_type = $this->get_post_type($item);

		$post_id = wp_insert_post([
			'ID' => $post->ID,
			'post_type' => $post_type,
			'post_title' => Arr::get($item, 'name'),
			'post_status' => 'publish',
		]);

		$this->update_custom_fields(
			$post_type,
			$item,
			$post_id
		);
	}

	/**
	 * @param int|null $external_id
	 *
	 * @return int|WP_Post
	 */
	private function item_exist(?int $external_id)
	{
		if (!$external_id) {
			return null;
		}

		$posts_query = new WP_Query([
			'numberposts'	=> 1,
			'post_type'		=> ['flats', 'parking_lots'],
			'meta_key'		=> 'id',
			'meta_value'	=> $external_id,
		]);

		if (!empty($posts_query->post_count) && is_array($posts = $posts_query->get_posts())) {
			return $posts[0];
		}

		return null;
	}

	/**
	 * @param array $item
	 *
	 * @return string|null
	 */
	private function get_post_type(array $item): ?string
	{
		$category_name = Arr::get($item, 'category.name');

		if ( Str::has($category_name, 'parkingai') ) {
			return 'parking_lots';
		} elseif (Str::has($category_name, 'etapas') && !Str::has($category_name, 'parkingai')) {
			return 'flats';
		}

		return null;
	}

	/**
	 * @param array $item
	 *
	 * @return int
	 */
	private function get_stage(array $item): ?int
	{
		$stage = preg_replace("/[^0-9]/", "", Arr::get($item, 'category.name'));

		if (!$stage) {
			return null;
		}

		return (int) $stage;
	}

	private function update_custom_fields(
		string $post_type,
		array $item,
		int $post_id
	): void {
		if ($post_type === 'flats') {
			$this->update_flats_fields($item, $post_id);
		}

		if ($post_type === 'parking_lots') {
			$this->update_parking_lot_fields($item, $post_id);
		}
	}

	private function update_flats_fields(array $item, int $post_id): void
	{
		update_field('field_61e28db4c5b2d', Arr::get($item, 'id'), $post_id);
		update_field('field_61e2a620f8e14', $this->get_stage($item), $post_id);
		update_field('field_61e2a702f8e1d', $this->get_formatted_price(Arr::get($item, 'prices.0.value')), $post_id);
		update_field(
			'field_61e2a71bf8e1e',
			$this->get_custom_field_by_id(
				Arr::get($item, 'customFields'),
				18
			),
			$post_id
		);
		update_field(
			'field_61e2a66df8e15',
			$this->get_custom_field_by_id(
				Arr::get($item, 'customFields'),
				20
			),
			$post_id
		);
		update_field(
			'field_61e2a67af8e16',
			$this->get_custom_field_by_id(
				Arr::get($item, 'customFields'),
				21
			),
			$post_id
		);
		update_field(
			'field_61e2a689f8e17',
			$this->get_custom_field_by_id(
				Arr::get($item, 'customFields'),
				22
			),
			$post_id
		);
		update_field(
			'field_61e2a693f8e18',
			$this->get_custom_field_by_id(
				Arr::get($item, 'customFields'),
				23
			),
			$post_id
		);
		update_field(
			'field_61e2a6d1f8e1a',
			$this->get_custom_field_by_id(
				Arr::get($item, 'customFields'),
				69
			),
			$post_id
		);
		update_field(
			'field_61e2a6e4f8e1b',
			$this->get_custom_field_by_id(
				Arr::get($item, 'customFields'),
				67
			),
			$post_id
		);
		update_field(
			'field_61e2a6f8f8e1c',
			$this->get_custom_field_by_id(
				Arr::get($item, 'customFields'),
				25
			),
			$post_id
		);
		update_field(
			'field_61e2a69cf8e19',
			$this->get_custom_field_by_id(
				Arr::get($item, 'customFields'),
				77
			),
			$post_id
		);
	}

	private function update_parking_lot_fields(array $item, int $post_id): void
	{
		update_field('field_61e28db4c5b2d', Arr::get($item, 'id'), $post_id);
		update_field('field_61e2b8394231f', $this->get_stage($item), $post_id);
		update_field('field_61e2b89d42322', $this->get_formatted_price(Arr::get($item, 'prices.0.value')), $post_id);

		update_field(
			'field_61e2b85442321',
			$this->get_custom_field_by_id(
				Arr::get($item, 'customFields'),
				18
			),
			$post_id
		);
		update_field(
			'field_61e2b84642320',
			$this->get_custom_field_by_id(
				Arr::get($item, 'customFields'),
				21
			),
			$post_id
		);
	}

	/**
	 * @param array $custom_fields
	 * @param int $id
	 *
	 * @return mixed|null
	 */
	private function get_custom_field_by_id(array $custom_fields, int $id)
	{
		$filtered_items = array_filter($custom_fields, fn($item) => Arr::get($item, 'id') === $id);
		$filtered_items = array_values($filtered_items);

		if (empty($filtered_items)) {
			return null;
		}

		return Arr::get($filtered_items[0], 'value');
	}

	/**
	 * @param string $rawPrice
	 *
	 * @return string
	 */
	private function get_formatted_price(string $rawPrice): string
	{
		// @TODO format price?

		return $rawPrice;
	}
}
