<?php
/**
 * Hooks trait.
 *
 * Allows protected and private methods to be used as hook callbacks.
 *
 * @package   Cedaro\WP\Plugin
 * @author    John P. Bloch
 * @author    Brady Vercher
 * @link      https://github.com/johnpbloch/wordpress-dev
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

declare ( strict_types = 1 );

namespace Plugin;

/**
 * Hooks trait.
 *
 * @package Cedaro\WP\Plugin
 * @author  John P. Bloch
 * @license MIT
 * @link    https://github.com/johnpbloch/wordpress-dev/blob/master/src/Hooks.php
 */
trait HooksTrait {
	/**
	 * Internal property to track closures attached to WordPress hooks.
	 *
	 * @var array<string, \Closure>
	 */
	protected $filter_map = [];

	/**
	 * Add a WordPress filter.
	 *
	 * @param  string   $hook
	 * @param  callable $method
	 * @param  int      $priority
	 * @param  int      $arg_count
	 * @return bool true
	 */
	protected function add_filter( string $hook, $method, int $priority = 10, int $arg_count = 1 ): bool {
		return add_filter(
			$hook,
			$this->map_filter( $this->get_wp_filter_id( $hook, $method, $priority ), $method, $arg_count ),
			$priority,
			$arg_count
		);
	}

	/**
	 * Add a WordPress action.
	 *
	 * This is an alias of add_filter().
	 *
	 * @param  string   $hook
	 * @param  callable $method
	 * @param  int      $priority
	 * @param  int      $arg_count
	 * @return bool true
	 */
	protected function add_action( string $hook, $method, int $priority = 10, int $arg_count = 1 ): bool {
		return $this->add_filter( $hook, $method, $priority, $arg_count );
	}

	/**
	 * Remove a WordPress filter.
	 *
	 * @param  string   $hook
	 * @param  callable $method
	 * @param  int      $priority
	 * @param  int      $arg_count
	 * @return bool Whether the function existed before it was removed.
	 */
	protected function remove_filter( string $hook, $method, int $priority = 10, int $arg_count = 1 ): bool {
		return remove_filter(
			$hook,
			$this->map_filter( $this->get_wp_filter_id( $hook, $method, $priority ), $method, $arg_count ),
			$priority
		);
	}

	/**
	 * Remove a WordPress action.
	 *
	 * This is an alias of remove_filter().
	 *
	 * @param  string   $hook
	 * @param  callable $method
	 * @param  int      $priority
	 * @param  int      $arg_count
	 * @return bool Whether the function is removed.
	 */
	protected function remove_action( string $hook, $method, int $priority = 10, int $arg_count = 1 ): bool {
		return $this->remove_filter( $hook, $method, $priority, $arg_count );
	}

	/**
	 * Get a unique ID for a hook based on the internal method, hook, and priority.
	 *
	 * @param  string $hook
	 * @param  string $method
	 * @param  int    $priority
	 * @return string
	 */
	protected function get_wp_filter_id( string $hook, $method, int $priority ): string {
		return _wp_filter_build_unique_id( $hook, [ $this, $method ], $priority );
	}

	/**
	 * Map a filter to a closure that inherits the class' internal scope.
	 *
	 * This allows hooks to use protected and private methods.
	 *
	 * @param  string $id
	 * @param  string $method
	 * @param  int    $arg_count
	 * @return \Closure The callable actually attached to a WP hook
	 */
	protected function map_filter( string $id, string $method, int $arg_count ) {
		if ( empty( $this->filter_map[ $id ] ) ) {
			$this->filter_map[ $id ] = function () use ( $method, $arg_count ) {
				return call_user_func_array( [ $this, $method ], array_slice( func_get_args(), 0, $arg_count ) );
			};
		}

		return $this->filter_map[ $id ];
	}
}
