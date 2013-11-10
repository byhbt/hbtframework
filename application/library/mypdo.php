<?php
/**
 * Extend PDO class for more re-usable
 */

class MyPDO
{
	protected static $conn,
			         $stmt,
					 $db_host, $db_name, $db_user, $db_pass;

	protected $lastSQL = '';

	public function __construct($db_host, $db_name, $db_user, $db_pass) {
		$this->connect($db_host, $db_name, $db_user, $db_pass);
	}

	public function connect($db_host, $db_name, $db_user, $db_pass) {
		try {
			self::$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
			self::$conn->setAttribute(PDO::CASE_NATURAL, PDO::ERRMODE_EXCEPTION); //Make it configable
		} catch (Exception $e) {
			die("ERROR: " . $e->getMessage() . "<br />");
		}
	}

	/**
	*
	*
	* @access
	* @param
	* @return
	*/
	public function query($strSQL = NULL, $fields = array()) {
		try {
			self::$stmt = self::$conn->prepare($strSQL);
			self::$stmt->execute($fields);

			$this->lastSQL = $strSQL;

			return self::$stmt;
		} catch (PDOException $e) {
			die("Error!: " . $e->getMessage() . "<br/>");
		}
	}

	public function select($table, $fields = "*", $condition = '', $param = null) {
		$sql = "SELECT ".$fields." FROM " . $table;

		if (!empty($condition)){
			$sql .= " WHERE ". $condition;
		}

		return $this->query($sql, $param)->fetchAll();
	}

	public function insert($table, $data) {
		if(!empty($data)) {
			$fields = $values = $var_fields = '';
			$insert_data = array();

			foreach ($data as $key => $value) {
				$fields .= ($fields) ? ", $key" : "$key";
				$values .= ($values) ? ", '$value'" : "'$value'";
				$var_fields .= ($var_fields) ? ", :$key" : ":$key";
				$insert_data[':'.$key] = $value;
			}

			self::$stmt = self::$conn->prepare("INSERT INTO $table ($fields) VALUES ($var_fields)");

			return self::$stmt->execute($insert_data);
		}
	}


	public function update($table, $data, $where, $param) {
		if (sizeof($data) > 0) {
			$fields = "";

			foreach($data as $key => $value) {
				$fields .= $fields ? ", $key = :$key" : " $key = :$key";
			}

			//Prepare where data!!
			$where = ($where) ? " WHERE $where " : NULL;
			$query = "UPDATE $table SET $fields $where";

			self::$stmt = self::$conn->prepare($query);
			return self::$stmt->execute($param);
		}
	}

	public function delete($table, $conditions, $data) {
		self::$stmt = self::$conn->prepare("DELETE FROM $table WHERE $conditions");
		$result = self::$stmt->execute($data);

		return $result;
	}

	public function get_field($query = NULL, $field = array()) {
		return self::query($query, $field)->fetchColumn[0];
	}

	public function get_last_sql(){
		return $this->lastSQL;
	}

	public function get_last_id(){
		return self::$conn->lastInsertId();
	}
}
