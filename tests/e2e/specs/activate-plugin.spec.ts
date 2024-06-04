/**
 * WordPress dependencies
 */
const { test, expect } = require( '@wordpress/e2e-test-utils-playwright' );

test.describe( 'Plugin Activation', () => {
	test( 'should activate the plugin and validate its dashboard', async ( { admin, page } ) => {
		try {
			await admin.visitAdminPage( 'admin.php?page=continuous-integrations#/' );
			await expect(page.getByText('Welcome to React boilerplate for WordPress plugin\n')).toBeVisible();
		} catch (error) {
			console.error('Error during test execution:', error);
			throw error; // Re-throw the error to fail the test
		}
	} );

	test( 'Failed test', async ( { admin, page } ) => {
		try {
			await admin.visitAdminPage( 'admin.php?page=continuous-integrations#/' );
			await expect(page.getByText('Welcome to Vue')).toBeVisible();
		} catch (error) {
			console.error('Error during test execution:', error);
			throw error; // Re-throw the error to fail the test
		}
	} );
} );
