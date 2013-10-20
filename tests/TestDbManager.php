<?php

use Mockery as m;
use Howlowck\DbManager\DbManager;

class TestDbManager extends PHPUnit_Framework_TestCase {
	public function setUp() {
		$this->schema = m::mock('Illuminate\Database\Schema\Builder');
		$this->db = m::mock('Illuminate\Database\DatabaseManager');
		$this->dbmanager = new DbManager($this->schema, $this->db);
	}
	public function tearDown() {
		m::close();
	}
	public function testListTables() {
		$this->schema->shouldReceive('getConnection->getDoctrineSchemaManager->listTableNames')->once()->andReturn(['posts', 'migrations', 'users']);
		$expected = ['posts', 'users'];
		$actual = $this->dbmanager->listTables();
		$this->assertEquals($expected, $actual);
	}
	public function testListColumns() {
		$columns = array(
			m::mock('column', array('getName' => 'id')),
			m::mock('column', array('getName' => 'title')),
			m::mock('column', array('getName' => 'content')),
			m::mock('column', array('getName' => 'created_at')),
			m::mock('column', array('getName' => 'updated_at'))
		);
		$this->db->shouldReceive('connection->getDoctrineSchemaManager->listTableColumns')->with('posts')->once()->andReturn($columns);

		$expected = ['id', 'title', 'content'];
		$actual = $this->dbmanager->listColumns('posts', ['created_at', 'updated_at']);

		$this->assertEquals($expected, $actual);
	}
}