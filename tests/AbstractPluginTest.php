<?php
namespace Cedaro\WP\Plugin\Test;

use Plugin\PluginBuilder;

class AbstractPluginTest extends \PHPUnit\Framework\TestCase {
	public function test_implements_plugin_interface() {
		$plugin = $this->get_mock_builder()->build();
		$this->assertInstanceOf( '\Plugin\PluginInterface', $plugin );
	}

	public function test_basename_accessor() {
		$basename = 'plugin/plugin.php';
		$plugin = $this->get_mock_builder()->set_basename( $basename )->build();
		$this->assertInstanceOf( get_class( $plugin ), $plugin );
		$this->assertSame( $basename, $plugin->get_basename() );
	}

	public function test_directory_accessor() {
		$plugin = $this->get_mock_builder()->set_directory( '/wp-content/plugins' )->build();
		$this->assertInstanceOf( get_class( $plugin ), $plugin );
		$this->assertSame( '/wp-content/plugins/', $plugin->get_directory() );

		// Test with trailing slash.
		$plugin = $this->get_mock_builder()->set_directory( '/wp-content/plugins/' )->build();
		$this->assertSame( '/wp-content/plugins/', $plugin->get_directory() );
	}

	public function test_file_accessor() {
		$file = '/wp-content/plugins/plugin/plugin.php';
		$plugin = $this->get_mock_builder()->set_file( $file )->build();
		$this->assertInstanceOf( get_class( $plugin ), $plugin );
		$this->assertSame( $file, $plugin->get_file() );
	}

	public function test_path_accessor() {
		$plugin = $this->get_mock_builder()->set_directory( '/wp-content/plugins' )->build();
		$this->assertInstanceOf( get_class( $plugin ), $plugin );
		$this->assertSame( '/wp-content/plugins/name', $plugin->get_path( 'name' ) );
		$this->assertSame( '/wp-content/plugins/name', $plugin->get_path( '/name' ) );
	}

	public function test_slug_accessor() {
		$slug = 'crate';
		$plugin = $this->get_mock_builder()->set_slug( $slug )->build();
		$this->assertInstanceOf( get_class( $plugin ), $plugin );
		$this->assertSame( $slug, $plugin->get_slug() );
	}

	public function test_url_accessor() {
		$url = 'https://example.com/wp-content/plugins/plugin';
		$plugin = $this->get_mock_builder()->set_url( $url )->build();
		$this->assertInstanceOf( get_class( $plugin ), $plugin );
		$this->assertSame( $url . '/', $plugin->get_url() );

		// Test with trailing slash.
		$url = 'https://example.com/wp-content/plugins/plugin/';
		$plugin = $this->get_mock_builder()->set_url( $url )->build();
		$this->assertSame( $url, $plugin->get_url() );
	}

	protected function get_mock_builder() {
		$plugin = $this->getMockBuilder( '\Plugin\AbstractPlugin' )
			->getMockForAbstractClass();

		return new PluginBuilder( $plugin );
	}
}
