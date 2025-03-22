<?php
/**
 * Plugin factory.
 *
 * @package   Cedaro\WP\Plugin
 * @copyright Copyright (c) 2017 Cedaro, LLC
 * @license   MIT
 */

namespace Plugin;

/**
 * Plugin factory class.
 *
 * @package Cedaro\WP\Plugin
 */
class PluginFactory {
	/**
	 * Create a plugin instance.
	 *
	 * @param string $slug     Optional. Plugin slug.
	 * @param string $filename Optional. Absolute path to the main plugin file.
	 *                         This should be passed if the calling file is not
	 *                         the main plugin file.
	 * @return Plugin Plugin instance.
	 */
	public static function create( string $slug = '', string $filename = '' ): Plugin {
		$slug     = self::parse_slug( $slug );
		$filename = self::parse_filename( $filename );

		$builder = new PluginBuilder( new Plugin() );
		$builder = self::build( $builder, $slug, $filename );

		return $builder->build();
	}

	/**
	 * Create a plugin instance.
	 *
	 * @param Plugin $plugin   Plugin instance.
	 * @param string $slug     Optional. Plugin slug.
	 * @param string $filename Optional. Absolute path to the main plugin file.
	 *                         This should be passed if the calling file is not
	 *                         the main plugin file.
	 * @return Plugin Plugin instance.
	 */
	public static function create_with( Plugin $plugin, string $slug = '', string $filename = '' ): Plugin {
		$slug     = self::parse_slug( $slug );
		$filename = self::parse_filename( $filename );

		$builder = new PluginBuilder( $plugin );
		$builder = self::build( $builder, $slug, $filename );

		return $builder->build();
	}

	/**
	 * Set properties on the plugin instance.
	 *
	 * @since 1.0.0
	 *
	 * @param PluginBuilder $builder  Plugin builder instance.
	 * @param string        $slug     Plugin slug.
	 * @param string        $filename Absolute path to the main plugin file.
	 * @return PluginBuilder
	 */
	protected static function build( PluginBuilder $builder, string $slug, string $filename ): PluginBuilder {
		return $builder
			->set_basename( plugin_basename( $filename ) )
			->set_directory( plugin_dir_path( $filename ) )
			->set_file( $filename )
			->set_slug( $slug )
			->set_url( plugin_dir_url( $filename ) );
	}

	/**
	 * Determine the plugin slug.
	 *
	 * @since 1.0.0
	 *
	 * @param string $slug Optional. Plugin slug. Attempts to use the directory
	 *                     name of the plugin if empty.
	 * @return string
	 */
	protected static function parse_slug( string $slug = '' ): string {
		// Use the calling file as the main plugin file.
		if ( empty( $slug ) ) {
			$backtrace = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT, 1 );
			$filename  = $backtrace[0]['file'];
			$slug      = dirname( $filename );
		}

		return $slug;
	}

	/**
	 * Determine the path to the main plugin file.
	 *
	 * @since 1.0.0
	 *
	 * @param string $filename Optional. Absolute path to the main plugin file.
	 * @return string
	 */
	protected static function parse_filename( string $filename = '' ): string {
		// Use the calling file as the main plugin file.
		if ( empty( $filename ) ) {
			$backtrace = debug_backtrace( DEBUG_BACKTRACE_PROVIDE_OBJECT, 1 );
			$filename  = $backtrace[0]['file'];
		}

		return $filename;
	}
}
