<?php
namespace Cedaro\WP\Plugin\Test;

class AbstractHookProviderTest extends \PHPUnit\Framework\TestCase {
	public function test_implements_interfaces() {
		$provider = $this->get_mock_provider();
		$this->assertInstanceOf( '\Cedaro\WP\Plugin\HookProviderInterface', $provider );
		$this->assertInstanceOf( '\Cedaro\WP\Plugin\PluginAwareInterface', $provider );
	}

	protected function get_mock_provider() {
		return $this->getMockBuilder( '\Cedaro\WP\Plugin\AbstractHookProvider' )
			->getMockForAbstractClass();
	}
}
