<?php namespace Howlowck\DbManager;

class DbManager {
	public function __construct($schema, $db) {
		$this->schema = $schema;
		$this->db = $db;
	}

	/**
	 * Lists all the tables in the database
	 * @param  array $exclude excludes from the returned array
	 * @return array the tables in the database
	 */

	public function listTables(array $exclude = ['migrations']) {
		$tableNames = $this->schema->getConnection()->getDoctrineSchemaManager()->listTableNames();
		$result = array_exclude($tableNames, $exclude);
		return $result;
	}

	public function listColumns($table, array $exclude = null) {
		$columns = $this->db->connection()->getDoctrineSchemaManager()->listTableColumns($table);
		$columns = array_map(function ($column) {return $column->getName();}, $columns);
		$result = array_exclude($columns, $exclude);
		return $result;
	}

	public function getColumnType($table, $column) {
		return $this->db->getDoctrineColumn($table, $column)->getType()->getName();
	}
}