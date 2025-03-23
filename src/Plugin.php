<?php
/**
 * Generic plugin implementation.
 *
 * @package   Cedaro\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

declare ( strict_types = 1 );

namespace Plugin;

/**
 * Main plugin class.
 *
 * @package Cedaro\WP\Plugin
 */
class Plugin extends AbstractPlugin {

	use ContainerAwareTrait;
}
