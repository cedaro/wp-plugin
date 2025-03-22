<?php
/**
 * Common plugin functionality.
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
 * Base plugin class.
 *
 * @package Cedaro\WP\Plugin
 */
abstract class AbstractPlugin implements PluginInterface {
	/**
	 * Plugin basename.
	 *
	 * Ex: plugin-name/plugin-name.php
	 *
	 * @var string
	 */
	protected string $basename = '';

	/**
	 * Absolute path to the main plugin directory.
	 *
	 * @var string
	 */
	protected string $directory = '';

	/**
	 * Absolute path to the main plugin file.
	 *
	 * @var string
	 */
	protected string $file = '';

	/**
	 * Plugin identifier.
	 *
	 * @var string
	 */
	protected string $slug = '';

	/**
	 * URL to the main plugin directory.
	 *
	 * @var string
	 */
	protected string $url = '';

	/**
	 * Retrieve the absolute path for the main plugin file.
	 *
	 * @return string
	 */
	public function get_basename(): string {
		return $this->basename;
	}

	/**
	 * Retrieve the plugin directory.
	 *
	 * @return string
	 */
	public function get_directory(): string {
		return $this->directory;
	}

	/**
	 * Retrieve the path to a file in the plugin.
	 *
	 * @param  string $path Optional. Path relative to the plugin root.
	 * @return string
	 */
	public function get_path( string $path = '' ): string {
		return $this->directory . ltrim( $path, '/' );
	}

	/**
	 * Retrieve the absolute path for the main plugin file.
	 *
	 * @return string
	 */
	public function get_file(): string {
		return $this->file;
	}

	/**
	 * Retrieve the plugin identifier.
	 *
	 * @return string
	 */
	public function get_slug(): string {
		return $this->slug;
	}

	/**
	 * Retrieve the URL for a file in the plugin.
	 *
	 * @param  string $path Optional. Path relative to the plugin root.
	 * @return string
	 */
	public function get_url( string $path = '' ): string {
		return $this->url . ltrim( $path, '/' );
	}

	/**
	 * Register a hook provider.
	 *
	 * @param  HookProviderInterface $provider Hook provider.
	 * @return $this
	 */
	public function register_hooks( HookProviderInterface $provider ): self {
		if ( $provider instanceof PluginAwareInterface ) {
			$provider->set_plugin( $this );
		}

		$provider->register_hooks();
		return $this;
	}
}
