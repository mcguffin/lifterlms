<?php
/**
 * Add, Customize, and Manage LifterLMS Forms Post Table Columns
 *
 * @since [version]
 * @version [version]
 */

defined( 'ABSPATH' ) || exit;

/**
 * LLMS_Admin_Post_Table_Forms
 *
 * @since [version]
 */
class LLMS_Admin_Post_Table_Forms {

	/**
	 * Constructor
	 *
	 * @since [version]
	 *
	 * @return  void
	 */
	public function __construct() {

		add_filter( 'manage_llms_form_posts_columns', array( $this, 'add_columns' ), 10, 1 );
		add_filter( 'bulk_actions-edit-llms_form', array( $this, 'manage_bulk_actions' ), 10, 1 );
		add_filter( 'post_row_actions', array( $this, 'manage_post_row_actions' ), 10, 2 );

		add_action( 'manage_llms_form_posts_custom_column', array( $this, 'manage_columns' ), 10, 2 );

	}

	/**
	 * Add Custom Columns
	 *
	 * @since [version]
	 *
	 * @param array $columns Array of default columns.
	 * @return array
	 */
	public function add_columns( $columns ) {

		if ( apply_filters( 'llms_forms_disable_post_table_cb', true ) ) {
			unset( $columns['cb'] );
		}

		return llms_assoc_array_insert( $columns, 'title', 'location', __( 'Location', 'lifterlms' ) );

	}

	/**
	 * Manage available bulk actions.
	 *
	 * @since [version]
	 *
	 * @param array $actions Array of actions.
	 * @return array
	 */
	public function manage_bulk_actions( $actions ) {
		unset( $actions['edit'] );
		return $actions;
	}

	/**
	 * Manage content of custom columns
	 *
	 * @since [version]
	 *
	 * @param string $column Table column name.
	 * @param int    $post_id WP Post ID of the form for the current row.
	 * @return void
	 */
	public function manage_columns( $column, $post_id ) {

		if ( 'location' === $column ) {
			$locs = LLMS_Forms::instance()->get_locations();
			$loc  = get_post_meta( $post_id, '_llms_form_location', true );

			if ( isset( $locs[ $loc ] ) ) {
				printf( '<strong>%1$s</strong><br><em>%2$s</em>', $locs[ $loc ]['name'], $locs[ $loc ]['description'] );
			} else {
				echo $loc;
			}
		}

	}


	/**
	 * Manage available bulk actions.
	 *
	 * @since [version]
	 *
	 * @param array $actions Array of actions.
	 * @return array
	 */
	public function manage_post_row_actions( $actions, $post ) {

		if ( 'llms_form' === $post->post_type ) {

			unset( $actions['inline hide-if-no-js'] );

		}

		return $actions;
	}

}
return new LLMS_Admin_Post_Table_Forms();
