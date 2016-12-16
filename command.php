<?php

if ( ! class_exists( 'WP_CLI' ) ) {
	return;
}


class UBC_Multisite_Content_Search {

	/**
	 * Search for content within a list of sites
	 *
	 * ## OPTIONS
	 *
	 * [--sites]
	 * : Either a single site ID, a single domain name or a comma separated list of either
	 *
	 * [--verbose]
	 * : I heard you like logs in your logs?
	 * ---
	 *
	 * ## EXAMPLES
	 *
	 *     wp multisite-content-search search "Lorem Ipsum" --sites="123"
	 *     wp multisite-content-search "Lorem Ipsum" --sites=all --output=file
	 *
	 * @when after_wp_load
	 */

	public $verbose = false;
	public $url = 'ubccms-local.dev';
	public $prefix = false;
	public $output_file = false;

	function search( $args, $assoc_args ) {

		$verbose	= ( isset( $assoc_args['verbose'] ) ) ? $assoc_args['verbose'] : false;
		$dry_run 	= ( isset( $assoc_args['dry-run'] ) ) ? $assoc_args['dry-run'] : false;

		$url	 	= ( isset( $assoc_args['url'] ) ) ? $assoc_args['url'] : false;
		$prefix 	= ( isset( $assoc_args['prefix'] ) ) ? $assoc_args['prefix'] : false;
		$output 	= ( isset( $assoc_args['output'] ) ) ? $assoc_args['output'] : false;

		WP_CLI::success( print_r( array( $args, $assoc_args ), true ) );

	}/* migrate() */

}/* class UBC_Multisite_Content_Search */


// Register the command, only appropriate on a Multisite Install
WP_CLI::add_command( 'multisite-content-search', 'UBC_Multisite_Content_Search', array(
	'before_invoke' => function(){
		if ( ! is_multisite() ) {
			WP_CLI::error( 'This is not a multisite install.' );
		}
	},
) );
