<?php
/**
 * @file PelecardHttpRequestTest class - tests PelecardHttpRequest class.
 */
namespace Pelecard;

use PHPUnit\Framework\TestCase;
use Pelecard\PelecardHttpRequest;

class PelecardHttpRequestTest extends TestCase {

    /**
     * Tests getConfig static method with wrong $clientConfig types
     *
     * @dataProvider provideWrongConfig
     * @covers Pelecard\PelecardHttpRequest::getConfig
     */
    public function testGetConfigWithWrongConfig($config) {
        // default config
        $defaults = [
            'base_uri' => PelecardHttpRequest::GATEWAY_BASE_URI,
            'headers' => ['Content-Type' => 'application/json'],
            'connect_timeout' => PelecardHttpRequest::CONNECTION_TIMEOUT,
            'timeout' => PelecardHttpRequest::REQUEST_TIMEOUT,
        ];

        $beforeConfig = PelecardHttpRequest::getConfig();
        $this->assertJsonStringEqualsJsonString(json_encode($defaults), json_encode($beforeConfig));

        // check that provided config is invalid because not array
        $this->assertFalse(is_array($config));

        // overwrite config with user values
        PelecardHttpRequest::$clientConfig = $config;
        $afterConfig = PelecardHttpRequest::getConfig();

        // check that overwritten config didn't change
        $this->assertJsonStringEqualsJsonString(json_encode($defaults), json_encode($afterConfig));
    }

    /**
     * Tests getConfig static method with correct $clientConfig data
     *
     * @dataProvider provideCorrectConfig
     * @covers Pelecard\PelecardHttpRequest::getConfig
     */
    public function testGetConfigWithCorrectConfig($config) {
        // default config
        $defaults = [
            'base_uri' => PelecardHttpRequest::GATEWAY_BASE_URI,
            'headers' => ['Content-Type' => 'application/json'],
            'connect_timeout' => PelecardHttpRequest::CONNECTION_TIMEOUT,
            'timeout' => PelecardHttpRequest::REQUEST_TIMEOUT,
        ];

        $beforeConfig = PelecardHttpRequest::getConfig();
        $this->assertJsonStringEqualsJsonString(json_encode($defaults), json_encode($beforeConfig));

        // check that provided config is valid
        $this->assertTrue(is_array($config));

        // overwrite config with user values
        PelecardHttpRequest::$clientConfig = $config;
        $afterConfig = PelecardHttpRequest::getConfig();

        // check that overwritten config did change
        $this->assertJsonStringNotEqualsJsonString(json_encode($defaults), json_encode($afterConfig));

        // check static values
        $this->assertArrayHasKey('base_uri', $afterConfig);
        $this->assertArrayHasKey('headers', $afterConfig);
        $this->assertEquals(PelecardHttpRequest::GATEWAY_BASE_URI, $afterConfig['base_uri']);
        $this->assertEquals(['Content-Type' => 'application/json'], $afterConfig['headers']);

        // check user values
        foreach ($config as $optionName => $optionValue) {
            if (!in_array($optionName, ['base_uri', 'headers'])) {
                // value should be overwritten
                $this->assertArrayHasKey($optionName, $afterConfig);
                $this->assertEquals($optionValue, $afterConfig[$optionName]);
            }
        }
    }

    public function provideWrongConfig() {
        return [
            [null],
            [1],
            ['foo'],
            ['bar'],
            [new \DateTime()],
            [new \StdClass()],
        ];
    }

    public function provideCorrectConfig() {
        return [
            [
                [
                    'connect_timeout' => 50,
                    'timeout' => 50,
                    'base_uri' => 'newbase/api',
                    'headers' => ['Content-Type' => 'application/json'],
                ],
            ],
        ];
    }
}
