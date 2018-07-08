<?php

/**
 * This file is part of the Cf Helper package.
 *
 * (c) Gilles Miraillet <g.miraillet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP Version 7
 *
 * @category Library
 * @package  Gmllt\CfHelper\Test
 * @author   Gilles Miraillet <g.miraillet@gmail.com>
 * @license  GNU General Public License v3.0
 * @link     https://gitlab.com/gmllt/cf-helper
 */

namespace Gmllt\CFHeller\Test;

use Gmllt\CfHelper\CfHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class CfHelperTest
 *
 * @category Library
 * @package  Gmllt\CfHelper\Test
 * @author   Gilles Miraillet <g.miraillet@gmail.com>
 * @license  GNU General Public License v3.0
 * @link     https://gitlab.com/gmllt/cf-helper
 */
class CfHelperTest extends TestCase
{

    /**
     * Custom envs for test
     *
     * @var array
     */
    public $customEnvs = [];

    /**
     * VCAP_APPLICATION values
     *
     * @var array
     */
    public $vcap_application = [
        "instance_id" => "fe98dc76ba549876543210abcd1234",
        "instance_index" => 0,
        "port" => 61857,
        "application_id" => "application_id",
        "application_name" => "styx-james",
        "application_uris" => ["my-app.example.com"],
        "application_version" => "ab12cd34-5678-abcd-0123-abcdef987654",
        "cf_api" => "cf_api",
        "host" => "0.0.0.0",
        "limits" => [
            "mem" => 512,
            "disk" => 1024,
            "fds" => 16384,
        ],
        "name" => "my-app",
        "space_id" => "space_id",
        "space_name" => "space_name",
        "start" => "2013-08-12 00:05:29 +0000",
        "started_at" => "2013-08-12 00:05:29 +0000",
        "started_at_timestamp" => "1376265929",
        "state_timestamp" => "1376265929",
        "uris" => ["my-app.example.com"],
        "users" => null,
        "version" => "ab1 2cd34-5678-abcd-0123-abcdef987654",
    ];

    /**
     * VCAP_SERVICES values
     *
     * @var array
     */
    public $vcap_services = [
        "elephantsql" => [
            [
                "name" => "elephantsql-c6c60",
                "label" => "elephantsql",
                "tags" => [
                    "postgres",
                    "postgresql",
                    "relational",
                ],
                "plan" => "turtle",
                "credentials" => [
                    "uri" => "postgres://exampleuser:examplepass@babar.elephantsql.com:5432/exampleuser",
                ],
            ],
        ],
        "sendgrid" => [
            [
                "name" => "mysendgrid",
                "label" => "sendgrid",
                "tags" => [
                    "smtp",
                ],
                "plan" => "free",
                "credentials" => [
                    "hostname" => "smtp.sendgrid.net",
                    "username" => "QvsXMbJ3rK",
                    "password" => "HCHMOYluTv",
                ],
            ],
        ],
    ];

    /**
     * Set Up function
     *
     * @return void
     */
    public function setUp()
    {
/* The :void return type declaration that should be here would cause a BC issue */
        $this->customEnvs = [
            "CF_INSTANCE_ADDR" => "CF_INSTANCE_ADDR",
            "CF_INSTANCE_GUID" => "CF_INSTANCE_GUID",
            "CF_INSTANCE_INDEX" => "CF_INSTANCE_INDEX",
            "CF_INSTANCE_IP" => "CF_INSTANCE_IP",
            "CF_INSTANCE_INTERNAL_IP" => "CF_INSTANCE_INTERNAL_IP",
            "CF_INSTANCE_PORT" => "CF_INSTANCE_PORT",
            "CF_INSTANCE_PORTS" => "CF_INSTANCE_PORTS",
            "DATABASE_URL" => "DATABASE_URL",
            "HOME" => "HOME",
            "LANG" => "LANG",
            "MEMORY_LIMIT" => "MEMORY_LIMIT",
            "PORT" => "PORT",
            "PWD" => "PWD",
            "TMPDIR" => "TMPDIR",
            "USER" => "USER",
            "VCAP_APP_PORT" => "VCAP_APP_PORT",
            "VCAP_APPLICATION" => json_encode($this->vcap_application),
            "VCAP_SERVICES" => json_encode($this->vcap_services),
        ];

        // Set envs
        foreach ($this->customEnvs as $key => $constant) {
            $_ENV[$key] = $constant;
        }
    }

    /**
     * Test CfHelper::getEnv()
     *
     * @throws \Exception
     *
     * @return void
     */
    public function testGetEnv()
    {
        $envKey = CfHelper::CF_INSTANCE_ADDR;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::CF_INSTANCE_GUID;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::CF_INSTANCE_INDEX;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::CF_INSTANCE_IP;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::CF_INSTANCE_INTERNAL_IP;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::CF_INSTANCE_PORT;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::CF_INSTANCE_PORTS;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::DATABASE_URL;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::HOME;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::LANG;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::MEMORY_LIMIT;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::PORT;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::PWD;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::TMPDIR;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::USER;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::VCAP_APP_PORT;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::VCAP_APPLICATION;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);

        $envKey = CfHelper::VCAP_SERVICES;
        $env = CfHelper::getEnv($envKey);
        $this->assertInternalType('string', $env);
        $this->assertEquals($this->customEnvs[$envKey], $env);
    }

    /**
     * Test CfHelper::getEnv()
     *
     * @expectedException        \Exception
     * @expectedExceptionMessage Environment variable 'foobar' not found.
     * @expectedExceptionCode    404
     *
     * @return void
     */
    public function testGetEnvException()
    {
        CfHelper::getEnv('foobar');
    }

    /**
     * Test CfHelper::getVcapApplication
     *
     * @throws \Exception
     * @return void
     */
    public function testGetVcapApplication()
    {
        $attribute = "instance_id";
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = "instance_index";
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = "port";
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = CfHelper::VCAP_APPLICATION_ID;
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = CfHelper::VCAP_APPLICATION_NAME;
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = CfHelper::VCAP_APPLICATION_URIS;
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = CfHelper::VCAP_APPLICATION_VERSION;
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = CfHelper::VCAP_APPLICATION_CF_API;
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = CfHelper::VCAP_APPLICATION_HOST;
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = CfHelper::VCAP_APPLICATION_LIMITS;
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = "name";
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = CfHelper::VCAP_APPLICATION_SPACE_ID;
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = CfHelper::VCAP_APPLICATION_SPACE_NAME;
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = CfHelper::VCAP_APPLICATION_START;
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = CfHelper::VCAP_APPLICATION_STARTED_AT;
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = CfHelper::VCAP_APPLICATION_STARTED_AT_TIMESTAMP;
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = CfHelper::VCAP_APPLICATION_STATE_TIMESTAMP;
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = "uris";
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = CfHelper::VCAP_APPLICATION_USERS;
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);

        $attribute = "version";
        $vcap_app = CfHelper::getVcapApplication($attribute);
        $this->assertEquals($vcap_app, $this->vcap_application[$attribute]);
    }

    /**
     * Test CfHelper::getVcapApplication()
     *
     * @expectedException        \Exception
     * @expectedExceptionMessage No attribute 'foobar' found in VCAP_APPLICATION.
     * @expectedExceptionCode    404
     *
     * @return void
     */
    public function testGetVcapApplicationException()
    {
        CfHelper::getVcapApplication('foobar');
    }

    /**
     * Test CfHelper::getServiceInstances()
     *
     * @throws \Exception
     * @return void
     */
    public function testGetServiceInstances()
    {
        $broker = "elephantsql";
        $services = CfHelper::getServiceInstances($broker);
        $this->assertEquals($services, $this->vcap_services[$broker]);

        $broker = "sendgrid";
        $services = CfHelper::getServiceInstances($broker);
        $this->assertEquals($services, $this->vcap_services[$broker]);
    }

    /**
     * Test CfHelper::getService()
     *
     * @throws \Exception
     * @return void
     */
    public function testGetService()
    {
        $broker = "elephantsql";
        $instance = "elephantsql-c6c60";
        $service = CfHelper::getService($broker, $instance);
        $this->assertEquals($service, $this->vcap_services[$broker][0]);

        $broker = "sendgrid";
        $instance = "mysendgrid";
        $service = CfHelper::getService($broker, $instance);
        $this->assertEquals($service, $this->vcap_services[$broker][0]);
    }

    /**
     * Test CfHelper::getService()
     *
     * @expectedException        \Exception
     * @expectedExceptionMessage No service 'foobar' found.
     * @expectedExceptionCode    404
     *
     * @return void
     */
    public function testGetServiceException()
    {
        CfHelper::getService('elephantsql', 'foobar');
    }

    /**
     * Test CfHelper::getCredentials()
     *
     * @throws \Exception
     * @return void
     */
    public function testGetCredentials()
    {
        $broker = "elephantsql";
        $instance = "elephantsql-c6c60";
        $service = CfHelper::getCredentials($broker, $instance);
        $this->assertEquals(
            $service,
            $this->vcap_services[$broker][0]['credentials']
        );

        $broker = "sendgrid";
        $instance = "mysendgrid";
        $service = CfHelper::getCredentials($broker, $instance);
        $this->assertEquals(
            $service,
            $this->vcap_services[$broker][0]['credentials']
        );
    }

    /**
     * Test CfHelper::get()
     *
     * @throws \Exception
     *
     * @return void
     */
    public function testGet()
    {
        $broker = "elephantsql";
        $instance = "elephantsql-c6c60";
        $credential = "uri";
        $cred = CfHelper::get($broker, $instance, $credential);
        $this->assertEquals(
            $this->vcap_services[$broker][0]['credentials'][$credential],
            $cred
        );


        $broker = "sendgrid";
        $instance = "mysendgrid";
        $credential = "hostname";
        $cred = CfHelper::get($broker, $instance, $credential);
        $this->assertEquals(
            $this->vcap_services[$broker][0]['credentials'][$credential],
            $cred
        );

        $broker = "sendgrid";
        $instance = "mysendgrid";
        $credential = "username";
        $cred = CfHelper::get($broker, $instance, $credential);
        $this->assertEquals(
            $this->vcap_services[$broker][0]['credentials'][$credential],
            $cred
        );

        $broker = "sendgrid";
        $instance = "mysendgrid";
        $credential = "password";
        $cred = CfHelper::get($broker, $instance, $credential);
        $this->assertEquals(
            $this->vcap_services[$broker][0]['credentials'][$credential],
            $cred
        );
    }

    /**
     * Test CfHelper::get()
     *
     * @expectedException        \Exception
     * @expectedExceptionMessage No credential 'foobar' found.
     * @expectedExceptionCode    404
     *
     * @return void
     */
    public function testGetException()
    {
        CfHelper::get('elephantsql', "elephantsql-c6c60", "foobar");
    }
}
