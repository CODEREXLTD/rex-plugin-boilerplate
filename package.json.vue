{
  "name": "{{the-plugin-name}}",
  "version": "1.0.0",
  "description": "",
  "main": "index.js",
  "author": "",
  "license": "ISC",
  "scripts": {
    "env:start": "wp-env start",
    "env:clean": "wp-env clean",
    "env:destroy": "wp-env destroy",
    "env:start:coverage": "wp-env start -- --xdebug=profile,trace,debug",
    "env:stop": "wp-env stop",
    "dev": "node src/env/development_mode.js && vite",
    "watch": "npm run dev",
    "build": "node src/env/production_mode.js && vite build",
    "production": "npm run build",
	"build:plugin-zip": "bash ./bin/build-plugin-zip.sh",
    "test:php": "wp-env run phpunit 'phpunit -c /var/www/html/wp-content/plugins/{{the-plugin-name}}/phpunit.xml.dist --verbose'",
    "test:watch": "npm run composer test:watch",
    "composer": "wp-env run cli --env-cwd=wp-content/plugins/{{the-plugin-name}} composer",
	"test:e2e": "wp-scripts test-playwright --config tests/e2e/playwright.config.ts",
	"test:e2e:playwright": "npm run test:e2e",
	"test:e2e:playwright:ui": "wp-scripts test-playwright --ui --config tests/e2e/playwright.config.ts",
	"test:e2e:watch": "npm run test:e2e -- --watch"
  },
  "dependencies": {
    "@wordpress/components": "^25.10.0",
    "@wordpress/hooks": "^3.1.1",
    "autoprefixer": "^10",
    "tailwindcss": "^3",
    "vite-plugin-live-reload": "^3.0.1",
    "vue": "^3.2.20",
    "vue-router": "^4.0.11"
  },
  "devDependencies": {
    "@babel/plugin-syntax-dynamic-import": "^7.8.3",
    "@babel/preset-env": "^7.14.7",
    "@playwright/test": "^1.39.0",
    "@vitejs/plugin-vue": "^3.1.0",
    "@vue/compiler-sfc": "^3.2.20",
    "@wordpress/api-fetch": "^6.41.0",
    "@wordpress/e2e-test-utils-playwright": "^0.12.0",
    "@wordpress/e2e-tests": "^7.15.0",
    "@wordpress/env": "^5.16.0",
    "@wordpress/prettier-config": "^3.1.0",
    "@wordpress/scripts": "^26.15.0",
    "babel-eslint": "^10.1.0",
    "babel-plugin-component": "^1.1.1",
    "babel-plugin-import": "^1.13.3",
    "cross-env": "^7.0.3",
    "grunt": "^1.5.3",
    "grunt-contrib-clean": "^1.0.0",
    "grunt-contrib-compress": "^1.6.0",
    "grunt-contrib-concat": "^1.0.1",
    "grunt-contrib-copy": "^1.0.0",
    "grunt-contrib-watch": "^1.1.0",
    "grunt-run": "^0.8.0",
    "grunt-wp-readme-to-markdown": "^2.0.1",
    "grunt-wpvue-i18n": "^1.0.0",
    "postcss": "^8.3.5",
    "prettier": "^3.0.3",
    "resolve-url-loader": "^5.0.0",
    "rollup-plugin-copy": "^3.4.0",
    "sass": "^1.35.1",
    "sass-loader": "^10",
    "vite": "^3.1.0",
    "vite-plugin-sass": "^0.1.0",
    "vue-cli-plugin-tailwind": "~3.0.0",
    "vue-loader": "^16.3.0",
    "vue-template-compiler": "^2.6.14"
  }
}
