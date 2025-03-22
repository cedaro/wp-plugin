<?php
/**
 * Container aware trait.
 *
 * @package   Cedaro\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace Plugin;

/**
 * Container aware trait.
 *
 * @package Cedaro\WP\Plugin
 */
trait ContainerAwareTrait {
	/**
	 * Enable access to the DI container by plugin consumers.
	 *
	 * @return ContainerInterface
	 */
	public function get_container() {
		return $this->container;
	}

	/**
	 * Set the container.
	 *
	 * @param  ContainerInterface $container Dependency injection container.
	 * @throws \InvalidArgumentException when no container is provided that implements ContainerInterface.
	 * @return $this
	 */
	public function set_container( ContainerInterface $container ) {
		$this->container = $container;
		return $this;
	}
}
