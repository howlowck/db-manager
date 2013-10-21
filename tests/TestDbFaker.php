<?php

use Mockery as m;
use Howlowck\DbManager\DbFaker;

class TestDbFaker extends PHPUnit_Framework_TestCase {
	public function setUp() {
		$this->dbmanager = m::mock('Howlowck\DbManager\DbManager');
		$this->faker = m::mock('Faker\Factory');
		$fakerArray = array(
			// Table Name
			'address' => 'address',
			'user' => 'userName',
			'company' => 'company',
			'person' => 'name',
			'student' => 'name',
			// Column Name
			'first_name' => 'firstName',
			'last_name' => 'lastName',
			'surname' => 'lastName',
			'username' => 'userName',
			'full_name' => 'name',
			'street' => 'streetAddress',
			'zip' => 'postcode',
			'zip_code' => 'postcode',
			'city' => 'city',
			'email' => 'email',
			'website' => 'url',
			'url' => 'url',
			'phone' => 'phoneNumber',
			'uid' => 'uuid',
			// Data Type
			'string' => 'sentence',
			'text' => 'text',
			'datetime' => 'dateTimeThisMonth',
			'integer' => 'randomDigitNotNull'
		);
		$this->dbfaker = new DbFaker($this->dbmanager, $this->faker, $fakerArray);
	}
	public function tearDown() {
		m::close();
	}
	public function testSuggestFakerType() {
		$expected = 'firstName';
		$actual = $this->dbfaker->suggestFakerType('users', 'first_name', 'string');
		$this->assertEquals($expected, $actual);
		$expected = 'userName';
		$actual = $this->dbfaker->suggestFakerType('users', 'name', 'string');
		$this->assertEquals($expected, $actual);
		$expected = 'streetAddress';
		$actual = $this->dbfaker->suggestFakerType('addresses', 'street', 'string');
		$this->assertEquals($expected, $actual);
	}
	public function testParseFakerMethod() {
		$expected = [
			'name' => 'randomNumber',
			'args' => [1, 100]
		];
		$actual = $this->dbfaker->parseFakerMethod('randomNumber(1, 100)');
		$this->assertEquals($expected, $actual);
	}
}


