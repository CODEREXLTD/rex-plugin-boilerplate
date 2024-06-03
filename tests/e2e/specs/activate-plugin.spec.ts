/**
 * WordPress dependencies
 */
const { test, expect } = require( '@wordpress/e2e-test-utils-playwright' );

const { activatePlugin, page } = require('@wordpress/e2e-test-utils');


test.describe( 'Plugin Activation', () => {
	test.beforeAll( async ( { requestUtils } ) => {
		await requestUtils.activatePlugin(
			'continuous-integrations'
		);
	} );

	test( 'should activate the plugin and validate its dashboard', async ( { admin, page } ) => {
		// Activate the plugin
		await admin.visitAdminPage( 'admin.php?page=continuous-integrations#/' );

		await expect(page.getByText('Welcome to React boilerplate for WordPress plugin\n')).toBeVisible();

	} );
} );
