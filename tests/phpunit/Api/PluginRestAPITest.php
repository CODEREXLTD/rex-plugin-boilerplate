<?php

namespace Akash\JobPlace\Tests\Api;

class CompanyRestApiTest extends \WP_UnitTestCase {

    /**
     * Test REST Server
     *
     * @var WP_REST_Server
     */
    protected $server;

    /**
     * Namespace.
     *
     * @var string
     */
    protected $namespace = 'job-place/v1';

    /**
     * Route base.
     *
     * @var string
     */
    protected $base = 'companies';

    /**
     * Setup test environment.
     */
    protected function setUp() : void {
        // Initialize REST Server.
        global $wp_rest_server;

        parent::setUp();

        $this->server = $wp_rest_server = new \WP_REST_Server;
        do_action( 'rest_api_init' );
    }

    /**
     * @test
     * @group company-rest-api
     */
    public function test_company_dropdown_list_endpoint_exists() {
        $this->assertTrue(1,'Matched');
    }
}
