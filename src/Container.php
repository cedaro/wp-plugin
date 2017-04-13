<?php
/**
 * Container.
 *
 * @package   Cedaro\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace Cedaro\WP\Plugin;

use Psr\Container\ContainerInterface;
use Pimple\Container as Pimple;

/**
 * Container class.
 *
 * Extends Pimple to satisfy the ContainerInterface.
 *
 * @package Cedaro\WP\Plugin
 */
class Container extends Pimple implements ContainerInterface {
	/**
	 * Finds an entry of the container by its identifier and returns it.
	 *
	 * @param  string $id Identifier of the entry to look for.
	 * @return mixed Entry.
	 */
	public function get( $id ) {
		return $this->offsetGet( $id );
	}

	/**
	 * Whether the container has an entry for the given identifier.
	 *
	 * @param  string $id Identifier of the entry to look for.
	 * @return bool
	 */
	public function has( $id ) {
		return $this->offsetExists( $id );
	}
}
