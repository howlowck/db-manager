<?php namespace Howlowck\DbManager;

class DbFaker {
	public function __construct($dbmanager, $faker, $fakerSuggestions) {
		$this->dbmanager = $dbmanager;
		$this->faker = $faker;
		$this->fakerArray = $fakerSuggestions;
	}

	public function getFakeData($fakerType) {
		//If it has an open parentasis, we'll assume it's a function
		if (str_contains($fakerType, '(')) {
			$fakerMethod = $this->parseFakerMethod($fakerType);
			return call_user_func_array([$this->faker, $fakerMethod['name']], $fakerMethod['args']);
		}
		return $this->faker->$fakerType;
	}

	public function fakeData($tableName, $columnName, $fakerType = null) {

	}

	public function parseFakerMethod($fakerMethod) {
		// assuming method as such "method(arg1, arg2, ...)"
		$parentasisLoc = strpos($fakerMethod, '(');
		$args = substr($fakerMethod, $parentasisLoc + 1, -1);
		$args = explode(',', $args);
		$args = array_map(function($val) {
			if (is_numeric($val)) return (int) $val;
			return trim($val);
		}, $args);

		$method = camel_case(substr($fakerMethod, 0 , $parentasisLoc));
		$result = [
			'name' => $method,
			'args' => $args
		];
		return $result;
	}

	public function suggestFakerType($tableName, $columnName, $dataType) {
		$table = str_singular($tableName);
		$column = str_singular($columnName);

		if ($columnName == 'name' and array_key_exists($table, $this->fakerArray)) {
			return $this->fakerArray[$table];
		}

		if (array_key_exists($column, $this->fakerArray)) {
			return $this->fakerArray[$column];
		}

		if (array_key_exists($dataType, $this->fakerArray)) {
			return $this->fakerArray[$dataType];
		}

		return 'sentence';
	}
}