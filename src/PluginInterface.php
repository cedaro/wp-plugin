<?php
/**
 * Plugin interface.
 *
 * @package   Cedaro\WP\Plugin
 * @author    John P. Bloch
 * @author    Brady Vercher
 * @link      https://github.com/johnpbloch/wordpress-dev
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace Plugin;

/**
 * Plugin interface.
 *
 * @package Cedaro\WP\Plugin
 */
interface PluginInterface {
	/**
	 * Retrieve the relative path to the main plugin file from the main plugin
	 * directory.
	 *
	 * @return string
	 */
	public function get_basename();

	/**
	 * Retrieve the plugin directory.
	 *
	 * @return string
	 */
	public function get_directory();

	/**
	 * Retrieve the path to a file in the plugin.
	 *
	 * @param  string $path Optional. Path relative to the plugin root.
	 * @return string
	 */
	public function get_path( $path = '' );

	/**
	 * Retrieve the absolute path for the main plugin file.
	 *
	 * @return string
	 */
	public function get_file();

	/**
	 * Retrieve the plugin identifier.
	 *
	 * @return string
	 */
	public function get_slug();

	/**
	 * Retrieve the URL for a file in the plugin.
	 *
	 * @param  string $path Optional. Path relative to the plugin root.
	 * @return string
	 */
	public function get_url( $path = '' );

	/**
	 * Register hooks for the plugin.
	 *
	 * @param HookProviderInterface $provider Hook provider.
	 */
	public function register_hooks( HookProviderInterface $provider );
}
