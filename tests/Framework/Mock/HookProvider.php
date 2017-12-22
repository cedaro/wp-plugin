<?php
namespace Cedaro\WP\Plugin\Test\Framework\Mock;

use Cedaro\WP\Plugin\AbstractHookProvider;

class HookProvider extends AbstractHookProvider {
	public function register_hooks() {

	}

	public function register_actions() {
		$this->add_action( 'template_redirect', 'template_redirect' );
	}

	public function template_redirect() {

	}

	public function register_filters() {
		$this->add_filter( 'the_title', 'get_title' );
	}

	public function get_title() {
		return 'Title';
	}
}
