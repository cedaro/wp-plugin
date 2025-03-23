<?php
/**
 * Basic implementation of PluginAwareInterface.
 *
 * @package   Cedaro\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

declare ( strict_types = 1 );

namespace Plugin;

/**
 * Plugin aware trait.
 *
 * @package Cedaro\WP\Plugin
 */
trait PluginAwareTrait {
	/**
	 * Main plugin instance.
	 *
	 * @var PluginInterface
	 */
	protected $plugin;

	/**
	 * Set the main plugin instance.
	 *
	 * @param  PluginInterface $plugin Main plugin instance.
	 * @return $this
	 */
	public function set_plugin( PluginInterface $plugin ): self {
		$this->plugin = $plugin;
		return $this;
	}
}
