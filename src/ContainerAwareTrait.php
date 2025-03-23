<?php
/**
 * Container aware trait.
 *
 * @package   Cedaro\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

declare ( strict_types = 1 );

namespace Plugin;

/**
 * Container aware trait.
 *
 * @package Cedaro\WP\Plugin
 */
trait ContainerAwareTrait {
	/**
	 * Container instance.
	 *
	 * @var ContainerInterface
	 */
	protected $container;

	/**
	 * Enable access to the DI container by plugin consumers.
	 *
	 * @return ContainerInterface
	 */
	public function get_container(): ContainerInterface {
		return $this->container;
	}

	/**
	 * Set the container.
	 *
	 * @param  ContainerInterface $container Dependency injection container.
	 * @throws \InvalidArgumentException when no container is provided that implements ContainerInterface.
	 * @return $this
	 */
	public function set_container( ContainerInterface $container ): self {
		$this->container = $container;
		return $this;
	}
}
