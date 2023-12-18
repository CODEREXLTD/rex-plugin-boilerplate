/**
 * External dependencies
 */
import { render } from '@wordpress/element';

/**
 * Internal dependencies
 */
import App from './App';

// Import the stylesheet for the plugin.
import './style/tailwind.css';
import './style/main.scss';

// Render the App component into the DOM
const dynamicPricingElement = document.getElementById('{{the-plugin-name}}');

if (dynamicPricingElement) {
	render(<App />, dynamicPricingElement);
}
