<?php
/**
 * Database class. Class extends after PDO class
 * @author Dawid Ciosek
 * @link blog.dawidciosek.pl
 */
class Database extends PDO {
	protected $db;
	private $host = 'localhost';
	private $dbName = 'tests';
	private $user = 'root';
	private $pass = '';

	public function __construct() {
		try {
			$db = new PDO('mysql:host='.$this->host.'; dbname='.$this->dbName.'', ''.$this->user.'', ''.$this->pass.'');
			$db->exec('SET CHARACTER SET utf8');;
			$this->db = $db;
		} catch (Exception $error) {
			print_r ('Error in line: '.__LINE__.': '.$error->getMessage().'');
		}
		return $db;
	}
}