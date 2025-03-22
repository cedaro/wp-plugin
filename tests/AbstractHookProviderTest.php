<?php
namespace Cedaro\WP\Plugin\Test;

class AbstractHookProviderTest extends \PHPUnit\Framework\TestCase {
	public function test_implements_interfaces() {
		$provider = $this->get_mock_provider();
		$this->assertInstanceOf( '\Plugin\HookProviderInterface', $provider );
		$this->assertInstanceOf( '\Plugin\PluginAwareInterface', $provider );
	}

	protected function get_mock_provider() {
		return $this->getMockBuilder( '\Plugin\AbstractHookProvider' )
			->getMockForAbstractClass();
	}
}
