<?php
namespace Cedaro\WP\Plugin\Test;

use Cedaro\WP\Plugin\Test\Framework\TestCase;
use Cedaro\WP\Plugin\Test\Framework\Mock\HookProvider;

class HooksTraitTest extends TestCase {
	public function test_filters_added() {
		$provider = $this->get_mock_provider();

		$provider->expects( $this->exactly( 1 ) )
			->method( 'add_filter' )
			->will( $this->returnCallback( function( $hook, $method, $priority, $arg_count ) {
				TestCase::assertSame( 'the_title', $hook );
				TestCase::assertSame( 10, $priority );
				TestCase::assertSame( 1, $arg_count );
			} ) );

		$provider->register_filters();
	}

	public function test_actions_added() {
		$provider = $this->get_mock_provider();

		$provider->expects( $this->exactly( 1 ) )
			->method( 'add_filter' )
			->will( $this->returnCallback( function( $hook, $method, $priority, $arg_count ) {
				TestCase::assertSame( 'template_redirect', $hook );
				TestCase::assertSame( 10, $priority );
				TestCase::assertSame( 1, $arg_count );
			} ) );

		$provider->register_actions();
	}

	protected function get_mock_provider() {
		$mock = $this->getMockBuilder( HookProvider::class )
			->onlyMethods( [ 'add_filter' ] )
			->getMock();

		$mock->method( 'add_filter' )->willReturn( true );

		return $mock;
	}
}
