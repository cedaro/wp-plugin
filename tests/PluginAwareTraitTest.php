<?php
namespace Cedaro\WP\Plugin\Test;

use Plugin\Plugin;

class PluginAwareTraitTest extends \PHPUnit\Framework\TestCase {
	public function test_set_plugin() {
		$provider = $this->getMockForTrait( '\Plugin\PluginAwareTrait' );

		$class = new \ReflectionClass( $provider );
		$property = $class->getProperty( 'plugin' );
		$property->setAccessible( true );

		$plugin = new Plugin();
		$provider->set_plugin( $plugin );

		$this->assertSame( $plugin, $property->getValue( $provider ) );
	}
}
