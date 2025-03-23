<?php
/**
 * Container aware plugin implementation.
 *
 * @package   Cedaro\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

declare ( strict_types = 1 );

namespace Plugin;

/**
 * Container aware plugin class.
 *
 * @package Cedaro\WP\Plugin
 */
class ContainerAwarePlugin extends AbstractPlugin {

	use ContainerAwareTrait;
}
