/**
 * Internal dependencies
 */
import HomePage from '../pages/Home';
import SettingsPage from "../pages/Settings";

const routes = [
	{
		path: '/',
		element: HomePage,
	},
	{
		path: '/settings',
		element: SettingsPage,
	}
];

export default routes;
