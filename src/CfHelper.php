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
 * @package  Gmllt\CfHelper
 * @author   Gilles Miraillet <g.miraillet@gmail.com>
 * @license  GNU General Public License v3.0
 * @link     https://gitlab.com/gmllt/cf-helper
 */

namespace Gmllt\CfHelper;

/**
 * Class CfHelper simplifies interaction with cloudfoundry environment variables.
 *
 * @category Library
 * @package  Gmllt\CfHelper
 * @author   Gilles Miraillet <g.miraillet@gmail.com>
 * @license  GNU General Public License v3.0
 * @link     https://gitlab.com/gmllt/cf-helper
 */
abstract class CfHelper
{

    /**
     * The CF_INSTANCE_IP and CF_INSTANCE_PORT of the app instance in the format
     * IP:PORT.
     *
     * Example : CF_INSTANCE_ADDR=1.2.3.4:5678
     *
     * @var string
     */
    const CF_INSTANCE_ADDR = "CF_INSTANCE_ADDR";

    /**
     * The UUID of the particular instance of the app.
     *
     * Example : CF_INSTANCE_GUID=41653aa4-3a3a-486a-4431-ef258b39f042
     *
     * @var string
     */
    const CF_INSTANCE_GUID = "CF_INSTANCE_GUID";

    /**
     * The index numbder of the app instance.
     *
     * Example: CF_INSTANCE_INDEX=0
     *
     * @var string
     */
    const CF_INSTANCE_INDEX = "CF_INSTANCE_INDEX";

    /**
     * The external IP address of the host running the app instance.
     *
     * Example: CF_INSTANCE_IP=1.2.3.4
     *
     * @var string
     */
    const CF_INSTANCE_IP = "CF_INSTANCE_IP";

    /**
     * The internal IP address of the container running the app instance.
     *
     * Example: CF_INSTANCE_INTERNAL_IP=5.6.7.8
     *
     * @var string
     */
    const CF_INSTANCE_INTERNAL_IP = "CF_INSTANCE_INTERNAL_IP";

    /**
     * The external, or host-side, port corresponding to the internal, or
     * container-side, port with value PORT. This value is generally different from
     * the PORT of the app instance.
     *
     * Example: CF_INSTANCE_PORT=61045
     *
     * @var string
     */
    const CF_INSTANCE_PORT = "CF_INSTANCE_PORT";

    /**
     * The list of mappings between internal, or container-side, and external, or
     * host-side, ports allocated to the instance’s container. Not all of the
     * internal ports are necessarily available for the application to bind to, as
     * some of them may be used by system-provided services that also run inside the
     * container. These internal and external values may differ.
     *
     * Example:
     * CF_INSTANCE_PORTS=[{external:61045,internal:8080},{external:61046,internal:2222}]
     *
     * @var string
     */
    const CF_INSTANCE_PORTS = "CF_INSTANCE_PORTS";

    /**
     * At runtime, CF creates a DATABASE_URL environment variable for every app
     * based on the VCAP_SERVICES environment variable.
     *
     * CF uses the structure of the VCAP_SERVICES environment variable to populate
     * DATABASE_URL. CF recognizes any service containing a JSON object with the
     * following form as a candidate for DATABASE_URL and uses the first candidate
     * it finds.
     *
     * {
     * "some-service": [
     * {
     * "credentials": {
     * "uri": "SOME-DATABASE-URL"
     * }
     * }
     * ]
     * }
     *
     * For example, consider the following VCAP_SERVICES:
     *
     * VCAP_SERVICES =
     * {
     * "elephantsql": [
     * {
     * "name": "elephantsql-c6c60",
     * "label": "elephantsql",
     * "credentials": {
     * "uri":
     * "postgres://exampleuser:examplepass@babar.elephantsql.com:5432/exampledb"
     * }
     * }
     * ]
     * }
     *
     * Based on this VCAP_SERVICES, CF creates the following DATABASE_URL
     * environment variable:
     *
     * DATABASE_URL =
     * postgres://exampleuser:examplepass@babar.elephantsql.com:5432/exampledb
     *
     * @var string
     */
    const DATABASE_URL = "DATABASE_URL";

    /**
     * Root folder for the deployed application.
     *
     * Example: HOME=/home/vcap/app
     *
     * @var string
     */
    const HOME = "HOME";

    /**
     * LANG is required by buildpacks to ensure consistent script load order.
     *
     * Example: LANG=en_US.UTF-8
     *
     * @var string
     */
    const LANG = "LANG";

    /**
     * The maximum amount of memory that each instance of the application can
     * consume. You specify this value in an application manifest or with the cf CLI
     * when pushing an application. The value is limited by space and org quotas.
     *
     * If an instance exceeds the maximum limit, it will be restarted. If Cloud
     * Foundry is asked to restart an instance too frequently, the instance will
     * instead be terminated.
     *
     * Example: MEMORY_LIMIT=512M
     *
     * @var string
     */
    const MEMORY_LIMIT = "MEMORY_LIMIT";

    /**
     * The port on which the app should listen for requests. The Cloud Foundry
     * runtime allocates a port dynamically for each instance of the application, so
     * code that obtains or uses the app port should refer to it using the PORT
     * environment variable.
     *
     * Example: PORT=8080
     *
     * @var string
     */
    const PORT = "PORT";

    /**
     * Identifies the present working directory, where the buildpack that processed
     * the application ran.
     *
     * Example: PWD=/home/vcap/app
     *
     * @var string
     */
    const PWD = "PWD";

    /**
     * Directory location where temporary and staging files are stored.
     *
     * Example: TMPDIR=/home/vcap/tmp
     *
     * @var string
     */
    const TMPDIR = "TMPDIR";

    /**
     * The user account under which the application runs.
     *
     * Example: USER=vcap
     *
     * @var string
     */
    const USER = "USER";

    /**
     * Deprecated name for the PORT variable defined above.
     *
     * @var        string
     * @deprecated
     */
    const VCAP_APP_PORT = "VCAP_APP_PORT";

    /**
     * This variable contains the associated attributes for a deployed application.
     * Results are returned in JSON format.
     *
     * The following example shows how to set the VCAP_APPLICATION environment
     * variable:
     *
     * VCAP_APPLICATION={"instance_id":"fe98dc76ba549876543210abcd1234",
     * "instance_index":0,"host":"0.0.0.0","port":61857,"started_at":"2013-08-12
     * 00:05:29 +0000","started_at_timestamp":1376265929,"start":"2013-08-12
     * 00:05:29
     * +0000","state_timestamp":1376265929,"limits":{"mem":512,"disk":1024,"fds":16384}
     * ,"application_version":"ab12cd34-5678-abcd-0123-abcdef987654","application_name"
     * :"styx-james","application_uris":["my-app.example.com"],"version":"ab1
     * 2cd34-5678-abcd-0123-abcdef987654","name":"my-app","uris":["my-app.example.com"]
     * ,"users":null}
     *
     * @var string
     */
    const VCAP_APPLICATION = "VCAP_APPLICATION";

    /**
     * For bindable services, Cloud Foundry adds connection details to the
     * VCAP_SERVICES environment variable when you restart your application, after
     * binding a service instance to your application.
     *
     * The results are returned as a JSON document that contains an object for each
     * service for which one or more instances are bound to the application. The
     * service object contains a child object for each service instance of that
     * service that is bound to the application. The attributes that describe a
     * bound service are defined in the table below.
     *
     *
     * To see the value of VCAP_SERVICES for an application pushed to Cloud Foundry,
     * see View Environment Variable Values.
     *
     * The example below shows the value of VCAP_SERVICES for bound instances of
     * several services available in the Pivotal Web Services Marketplace.
     *
     * VCAP_SERVICES=
     * {
     * "elephantsql": [
     * {
     * "name": "elephantsql-c6c60",
     * "label": "elephantsql",
     * "tags": [
     * "postgres",
     * "postgresql",
     * "relational"
     * ],
     * "plan": "turtle",
     * "credentials": {
     * "uri":
     * "postgres://exampleuser:examplepass@babar.elephantsql.com:5432/exampleuser"
     * }
     * }
     * ],
     * "sendgrid": [
     * {
     * "name": "mysendgrid",
     * "label": "sendgrid",
     * "tags": [
     * "smtp"
     * ],
     * "plan": "free",
     * "credentials": {
     * "hostname": "smtp.sendgrid.net",
     * "username": "QvsXMbJ3rK",
     * "password": "HCHMOYluTv"
     * }
     * }
     * ]
     * }
     *
     * @var string
     */
    const VCAP_SERVICES = "VCAP_SERVICES";

    /**
     * VCAP_APPLICATION attribute.
     *
     * GUID identifying the application.
     *
     * @var string
     */
    const VCAP_APPLICATION_ID = "application_id";

    /**
     * VCAP_APPLICATION attribute.
     *
     * The name assigned to the application when it was pushed.
     *
     * @var string
     */
    const VCAP_APPLICATION_NAME = "application_name";

    /**
     * VCAP_APPLICATION attribute.
     *
     * The URIs assigned to the application.
     *
     * @var string
     */
    const VCAP_APPLICATION_URIS = "application_uris";

    /**
     * VCAP_APPLICATION attribute.
     *
     *GUID identifying a version of the application. Each time an application is pushed or restarted, this value is updated.
     *
     * @var string
     */
    const VCAP_APPLICATION_VERSION = "application_version";

    /**
     * VCAP_APPLICATION attribute.
     *
     * The API endpoint you targeted when you logged into the cf CLI.
     *
     * @var string
     */
    const VCAP_APPLICATION_CF_API = "cf_api";

    /**
     * VCAP_APPLICATION attribute.
     *
     * Deprecated. IP address of the application instance.
     *
     * @var        string
     * @deprecated
     */
    const VCAP_APPLICATION_HOST = "host";

    /**
     * VCAP_APPLICATION attribute.
     *
     * The limits to disk space, number of files, and memory permitted to the app.
     * Memory and disk space limits are supplied when the application is deployed,
     * either on the command line or in the application manifest. The number of
     * files allowed is operator-defined.
     *
     * @var string
     */
    const VCAP_APPLICATION_LIMITS = "limits";

    /**
     * VCAP_APPLICATION attribute.
     *
     * GUID identifying the application’s space.
     *
     * @var string
     */
    const VCAP_APPLICATION_SPACE_ID = "space_id";

    /**
     * VCAP_APPLICATION attribute.
     *
     * Human-readable name of the space where the app is deployed.
     *
     * @var string
     */
    const VCAP_APPLICATION_SPACE_NAME = "space_name";

    /**
     * VCAP_APPLICATION attribute.
     *
     * Human-readable timestamp for the time the instance was started. Not provided
     * on Diego Cells.
     *
     * @var string
     */
    const VCAP_APPLICATION_START = "start";

    /**
     * VCAP_APPLICATION attribute.
     *
     * Identical to start. Not provided on Diego Cells.
     *
     * @var string
     */
    const VCAP_APPLICATION_STARTED_AT = "started_at";

    /**
     * VCAP_APPLICATION attribute.
     *
     * Unix epoch timestamp for the time the instance was started. Not provided on
     * Diego Cells.
     *
     * @var string
     */
    const VCAP_APPLICATION_STARTED_AT_TIMESTAMP = "started_at_timestamp";

    /**
     * VCAP_APPLICATION attribute.
     *
     * Identical to started_at_timestamp. Not provided on Diego Cells.
     *
     * @var string
     */
    const VCAP_APPLICATION_STATE_TIMESTAMP = "state_timestamp";

    /**
     * VCAP_APPLICATION attribute.
     *
     * Deprecated. Not provided on Diego Cells.
     *
     * @var        string
     * @deprecated
     */
    const VCAP_APPLICATION_USERS = "users";

    /**
     * VCAP_SERVICES attribute.
     *
     * The name assigned to the service instance by the user.
     *
     * @var string
     */
    const VCAP_SERVICES_NAME = "name";

    /**
     * VCAP_SERVICES attribute.
     *
     * The name of the service offering.
     *
     * @var string
     */

    const VCAP_SERVICES_LABEL = "label";

    /**
     * VCAP_SERVICES attribute.
     *
     * An array of strings an app can use to identify a service instance.
     *
     * @var string
     */

    const VCAP_SERVICES_TAGS = "tags";

    /**
     * VCAP_SERVICES attribute.
     *
     * The service plan selected when the service instance was created.
     *
     * @var string
     */

    const VCAP_SERVICES_PLAN = "plan";

    /**
     * VCAP_SERVICES attribute.
     *
     * A JSON object containing the service-specific credentials needed to access
     * the service instance.
     *
     * @var string
     */

    const VCAP_SERVICES_CREDENTIALS = "credentials";


    /**
     * Get environment variable by name
     *
     * @param string $name environment variable name
     *
     * @throws \Exception
     * @return string environment variable contents
     */
    public static function getEnv(string $name): string
    {
        if (!isset($_ENV[$name])) {
            throw new \Exception("Environment variable '$name' not found.", 404);
        }
        return $_ENV[$name];
    }

    /**
     * Get VCAP_APPLICATION attribute by name
     *
     * @param string $attribute attribute name
     *
     * @return mixed attribute contents
     * @throws \Exception
     */
    public static function getVcapApplication(string $attribute)
    {
        $application = static::getEnv(static::VCAP_APPLICATION);
        $json = json_decode($application, true);
        if (null === $json) {
            throw new \Exception("Error decoding " . static::VCAP_APPLICATION . ".");
        }
        if (!array_key_exists($attribute, $json)) {
            throw new \Exception(
                "No attribute '$attribute' found in " . static::VCAP_APPLICATION . ".",
                404
            );
        }
        return $json[$attribute];
    }

    /**
     * Get services by service broker name
     *
     * @param string $brokerName service broker name
     *
     * @return array services instances
     * @throws \Exception
     */
    public static function getServiceInstances(string $brokerName): array
    {
        $services = static::getEnv(static::VCAP_SERVICES);
        $json = json_decode($services, true);
        if (null === $json) {
            throw new \Exception("Error decoding " . static::VCAP_SERVICES . ".");
        }
        if (!array_key_exists($brokerName, $json)) {
            throw new \Exception(
                "No services '$brokerName' found in " . static::VCAP_SERVICES . ".",
                404
            );
        }
        return $json[$brokerName];
    }

    /**
     * Get service by instance name and service broker name
     *
     * @param string $brokerName   service broker name
     * @param string $instanceName instance name
     *
     * @return array founded service
     * @throws \Exception
     */
    public static function getService(
        string $brokerName,
        string $instanceName
    ): array {
        $services = static::getServiceInstances($brokerName);
        $foundedService = null;
        foreach ($services as $service) {
            if (array_key_exists(
                static::VCAP_SERVICES_NAME,
                $service
            ) && $service[static::VCAP_SERVICES_NAME] == $instanceName
            ) {
                $foundedService = $service;
                break;
            }
        }
        if (null === $foundedService) {
            throw new \Exception("No service '$instanceName' found.", 404);
        }
        return $foundedService;
    }

    /**
     * Get credentials by instance name and service broker name
     *
     * @param string $brokerName   service broker name
     * @param string $instanceName service instance name
     *
     * @return array credentials
     * @throws \Exception
     */
    public static function getCredentials(
        string $brokerName,
        string $instanceName
    ): array {
        $service = static::getService($brokerName, $instanceName);
        if (!array_key_exists(static::VCAP_SERVICES_CREDENTIALS, $service)) {
            throw new \Exception(
                "No credentials found in service '$instanceName' declaration.",
                500
            );
        }
        return $service[static::VCAP_SERVICES_CREDENTIALS];
    }

    /**
     * Get credential by name, instance name and service broker name
     *
     * @param string $brokerName   service broker name
     * @param string $instanceName instance name
     * @param string $credential   credential name
     *
     * @return mixed
     * @throws \Exception
     */
    public static function get(
        string $brokerName,
        string $instanceName,
        string $credential
    ) {
        $credentials = static::getCredentials($brokerName, $instanceName);
        if (!array_key_exists($credential, $credentials)) {
            throw new \Exception("No credential '$credential' found.", 404);
        }
        return $credentials[$credential];
    }
}
