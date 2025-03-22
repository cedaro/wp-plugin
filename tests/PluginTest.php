<?php
namespace Cedaro\WP\Plugin\Test;

use Plugin\Plugin;

class PluginTest extends \PHPUnit\Framework\TestCase {
	public function test_implements_plugin_interface() {
		$plugin = new Plugin();
		$this->assertInstanceOf( '\Plugin\PluginInterface', $plugin );
	}
}
