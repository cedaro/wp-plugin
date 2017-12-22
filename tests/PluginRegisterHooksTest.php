<?php
namespace Cedaro\WP\Plugin\Test;

use Cedaro\WP\Plugin\Plugin;

class PluginRegisterHooksTest extends \PHPUnit\Framework\TestCase {
	public function test_register_hooks() {
		$plugin = new Plugin();
		$provider = $this->get_mock_provider();

		$class = new \ReflectionClass( $provider );
		$property = $class->getProperty( 'plugin' );
		$property->setAccessible( true );

		$provider->expects( $this->exactly( 1 ) )->method( 'register_hooks' );

		$plugin->register_hooks( $provider );

		$this->assertSame( $plugin, $property->getValue( $provider ) );
	}

	protected function get_mock_provider() {
		return $this->getMockBuilder( '\Cedaro\WP\Plugin\AbstractHookProvider' )
			->getMockForAbstractClass();
	}
}
