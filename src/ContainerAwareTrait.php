<?php
/**
 * Container aware trait.
 *
 * Container implementation courtesy of Slim 3.
 *
 * @package   Cedaro\WP\Plugin
 * @link      https://github.com/slimphp/Slim/blob/e80b0f8b4d23e165783e8bf241b31c35272b0e28/Slim/App.php
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace Cedaro\WP\Plugin;

use Psr\Container\ContainerInterface;

/**
 * Container aware trait.
 *
 * @package Cedaro\WP\Plugin
 */
trait ContainerAwareTrait {
	/**
	 * Container.
	 *
	 * @var ContainerInterface
	 */
	protected $container;

	/**
	 * Proxy access to container services.
	 *
	 * @param  string $name Service name.
	 * @return mixed
	 */
	public function __get( $name ) {
		return $this->container->get( $name );
	}

	/**
	 * Whether a container service exists.
	 *
	 * @param  string $name Service name.
	 * @return bool
	 */
	public function __isset( $name ) {
		return $this->container->has( $name );
	}

	/**
	 * Calling a non-existant method on the class checks to see if there's an
	 * item in the container that is callable and if so, calls it.
	 *
	 * @param  string $method Method name.
	 * @param  array  $args   Method arguments.
	 * @return mixed
	 */
	public function __call( $method, $args ) {
		if ( $this->container->has( $method ) ) {
			$object = $this->container->get( $method );
			if ( is_callable( $object ) ) {
				return call_user_func_array( $object, $args );
			}
		}
	}

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
	 * @throws InvalidArgumentException when no container is provided that implements ContainerInterface.
	 * @return $this
	 */
	public function set_container( $container ) {
		if ( ! $container instanceof ContainerInterface ) {
			throw new \InvalidArgumentException( 'Expected a ContainerInterface.' );
		}

		$this->container = $container;
		return $this;
	}
}
