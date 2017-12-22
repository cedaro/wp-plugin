<?php
namespace Cedaro\WP\Plugin\Test;

use Cedaro\WP\Plugin\Plugin;

class PluginTest extends \PHPUnit\Framework\TestCase {
	public function test_implements_plugin_interface() {
		$plugin = new Plugin();
		$this->assertInstanceOf( '\Cedaro\WP\Plugin\PluginInterface', $plugin );
	}
}
