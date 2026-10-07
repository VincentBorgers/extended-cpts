<?php
declare( strict_types=1 );

namespace ExtCPTs\Tests\Admin;

use ExtCPTs\Tests\Admin;

class Dashboard extends Admin {

	public function testGlanceItemsSkipAPostTypeThatIsNoLongerRegistered(): void {

		wp_set_current_user( 1 );
		unregister_post_type( 'hello' );

		$items = implode( '', apply_filters( 'dashboard_glance_items', array() ) );

		self::assertStringNotContainsString( 'cpt-hello-count', $items );
		self::assertStringContainsString( 'cpt-person-count', $items );

	}

	public function testGlanceItemsSkipATaxonomyThatIsNoLongerRegistered(): void {

		register_extended_taxonomy( 'glance_tax', 'hello', array(
			'dashboard_glance' => true,
		) );

		wp_set_current_user( 1 );
		unregister_taxonomy( 'glance_tax' );

		$items = implode( '', apply_filters( 'dashboard_glance_items', array() ) );

		self::assertStringNotContainsString( 'taxo-glance_tax-count', $items );
		self::assertStringContainsString( 'cpt-hello-count', $items );

	}

}
