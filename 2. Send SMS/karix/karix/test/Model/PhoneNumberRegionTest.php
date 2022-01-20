<?php
/**
 * PhoneNumberRegionTest
 *
 * PHP version 5
 *
 * @category Class
 * @package  Karix
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * karix api
 *
 * Karix API lets you interact with the Karix platform using an omnichannel messaging API. It also allows you to query your account, set up webhooks and buy phone numbers.
 *
 * OpenAPI spec version: 2.0
 * Contact: support@karix.io
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: unset
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Please update the test case below to test the model.
 */

namespace Karix;

/**
 * PhoneNumberRegionTest Class Doc Comment
 *
 * @category    Class
 * @description Details about which region this number belongs to
 * @package     Karix
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class PhoneNumberRegionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Setup before running any test case
     */
    public static function setUpBeforeClass()
    {
    }

    /**
     * Setup before running each test case
     */
    public function setUp()
    {
    }

    /**
     * Clean up after running each test case
     */
    public function tearDown()
    {
    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass()
    {
    }

    /**
     * Test "PhoneNumberRegion"
     */
    public function testPhoneNumberRegion()
    {
    }

    /**
     * Test attribute "country"
     */
    public function testPropertyCountry()
    {
        $phone_number_region = new \Karix\Model\PhoneNumberRegion();
        $country = "US";
        
        $phone_number_region->setCountry($country);
        $this->assertEquals($country, $phone_number_region->getCountry());

    }

    /**
    * Helper to create a good example of model
    */
    public function getGoodExample()
    {
        $country = "US";
        
        return array(
            "country" => $country,
        );
    }

    /**
    * Test PhoneNumberRegion validation
    */
    public function testValidation()
    {
        $example = $this->getGoodExample();
        $phone_number_region = new \Karix\Model\PhoneNumberRegion($example);
        $this->assertTrue($phone_number_region->valid());
    }

}
