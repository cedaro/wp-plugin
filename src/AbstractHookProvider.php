<?php
/**
 * Base hook provider.
 *
 * @package   Cedaro\WP\Plugin
 * @copyright Copyright (c) 2017 Cedaro, LLC
 * @license   MIT
 */

namespace Cedaro\WP\Plugin;

/**
 * Base hook provider class.
 *
 * @package Cedaro\WP\Plugin
 */
abstract class AbstractHookProvider implements HookProviderInterface, PluginAwareInterface {

	use HooksTrait, PluginAwareTrait;

	/**
	 * Registers hooks for the plugin.
	 */
	abstract public function register_hooks();
}
