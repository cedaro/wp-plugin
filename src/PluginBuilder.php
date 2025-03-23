<?php
/**
 * Plugin builder.
 *
 * @package   Cedaro\WP\Plugin
 * @copyright Copyright (c) 2025 Cedaro, LLC
 * @license   MIT
 */

declare ( strict_types = 1 );

namespace Plugin;

use ReflectionClass;

/**
 * Plugin builder class.
 */
final class PluginBuilder {
	/**
	 * Reflection class instance.
	 *
	 * @var ReflectionClass
	 */
	protected $class;

	/**
	 * Plugin instance.
	 *
	 * @var PluginInterface
	 */
	protected $plugin;

	/**
	 * Create a builder for a plugin.
	 *
	 * @param PluginInterface $plugin Plugin instance to build.
	 */
	public function __construct( PluginInterface $plugin ) {
		$this->plugin = $plugin;
		try {
			$this->class = new ReflectionClass( $plugin );
		// phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedCatch
		} catch ( \ReflectionException $e ) {
			// noop.
		}
	}

	/**
	 * Finalize the plugin build.
	 *
	 * @return PluginInterface
	 */
	public function build(): PluginInterface {
		return $this->plugin;
	}

	/**
	 * Set the plugin basename.
	 *
	 * @param string $basename Relative path from the main plugin directory.
	 * @return PluginBuilder
	 */
	public function set_basename( string $basename ): self {
		return $this->set( 'basename', $basename );
	}

	/**
	 * Set the plugin directory.
	 *
	 * @param string $directory Absolute path to the plugin directory.
	 * @return $this
	 */
	public function set_directory( string $directory ): self {
		return $this->set( 'directory', rtrim( $directory, '/' ) . '/' );
	}

	/**
	 * Set the path to the main plugin file.
	 *
	 * @param  string $file Absolute path to the main plugin file.
	 * @return $this
	 */
	public function set_file( string $file ): self {
		return $this->set( 'file', $file );
	}

	/**
	 * Set the slug.
	 *
	 * @param string $slug Slug.
	 * @return $this
	 */
	public function set_slug( string $slug ): self {
		return $this->set( 'slug', $slug );
	}

	/**
	 * Set the URL for plugin directory root.
	 *
	 * @param  string $url URL to the root of the plugin directory.
	 * @return $this
	 */
	public function set_url( string $url ): self {
		return $this->set( 'url', rtrim( $url, '/' ) . '/' );
	}

	/**
	 * Set a property on the plugin instance.
	 *
	 * Uses the reflection API to assign values to protected properties of the
	 * plugin instance to make the returned instance immutable.
	 *
	 * @param string $name  Property name.
	 * @param mixed  $value Property value.
	 * @return $this
	 */
	protected function set( $name, $value ): self {
		$property = $this->class->getProperty( $name );
		$property->setAccessible( true );
		$property->setValue( $this->plugin, $value );
		return $this;
	}
}
