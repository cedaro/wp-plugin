<?php
namespace Cedaro\WP\Plugin\Test;

class AbstractPluginTest extends \PHPUnit\Framework\TestCase {
	public function test_implements_plugin_interface() {
		$plugin = $this->get_mock_plugin();
		$this->assertInstanceOf( '\Cedaro\WP\Plugin\PluginInterface', $plugin );
	}

	public function test_basename_accessor_and_mutator() {
		$basename = 'plugin/plugin.php';
		$plugin = $this->get_mock_plugin()->set_basename( $basename );
		$this->assertInstanceOf( get_class( $plugin ), $plugin );
		$this->assertSame( $basename, $plugin->get_basename() );
	}

	public function test_directory_accessor_and_mutator() {
		$plugin = $this->get_mock_plugin()->set_directory( '/wp-content/plugins' );
		$this->assertInstanceOf( get_class( $plugin ), $plugin );
		$this->assertSame( '/wp-content/plugins/', $plugin->get_directory() );

		// Test with trailing slash.
		$plugin->set_directory( '/wp-content/plugins/' );
		$this->assertSame( '/wp-content/plugins/', $plugin->get_directory() );
	}

	public function test_file_accessor_and_mutator() {
		$file = '/wp-content/plugins/plugin/plugin.php';
		$plugin = $this->get_mock_plugin()->set_file( $file );
		$this->assertInstanceOf( get_class( $plugin ), $plugin );
		$this->assertSame( $file, $plugin->get_file() );
	}

	public function test_path_accessor() {
		$plugin = $this->get_mock_plugin()->set_directory( '/wp-content/plugins' );
		$this->assertInstanceOf( get_class( $plugin ), $plugin );
		$this->assertSame( '/wp-content/plugins/name', $plugin->get_path( 'name' ) );
		$this->assertSame( '/wp-content/plugins/name', $plugin->get_path( '/name' ) );
	}

	public function test_slug_accessor_and_mutator() {
		$slug = 'crate';
		$plugin = $this->get_mock_plugin()->set_slug( $slug );
		$this->assertInstanceOf( get_class( $plugin ), $plugin );
		$this->assertSame( $slug, $plugin->get_slug() );
	}

	public function test_url_accessor_and_mutator() {
		$url = 'https://example.com/wp-content/plugins/plugin';
		$plugin = $this->get_mock_plugin()->set_url( $url );
		$this->assertInstanceOf( get_class( $plugin ), $plugin );
		$this->assertSame( $url . '/', $plugin->get_url() );

		// Test with trailing slash.
		$url = 'https://example.com/wp-content/plugins/plugin/';
		$plugin->set_url( $url );
		$this->assertSame( $url, $plugin->get_url() );
	}

	protected function get_mock_plugin() {
		return $this->getMockBuilder( '\Cedaro\WP\Plugin\AbstractPlugin' )
			->getMockForAbstractClass();
	}
}
