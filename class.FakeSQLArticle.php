<?php
// Database class
require_once 'class.Database.php';

/**
 * FakeSQLArticle - generate fake articles and save it in your database
 * @author Dawid Ciosek
 * @link blog.dawidciosek.pl
 * @version 1.0.0
 */

class FakeSQLArticle extends Database
{
	/**
	 * Information variable
	 */
	private $message;
	/**
	 * Fake news variable
	 */
	private $fakeNews;
	/**
	 * Names variable
	 */
	private $names;
	/**
	 * Number of article variable
	 */
	private $number;
	/**
	 * Length of article variable
	 */
	private $length;
	/**
	 * Table name variable
	 */
	private $table;
	/**
	 * Name of title column variable
	 */
	private $titleColumn;
	/**
	 * Name of article column variable
	 */
	private $articleColumn;
	/**
	 * Name of author column variable
	 */
	private $authorColumn;
	/**
	 * Name of date column variable
	 */
	private $dateColumn;

	/**
	 * This method set a number of article
	 * @var int $number - Number of article
	 */
	public function numberOfArticle($number) {
		$this->number = $number;
		return $this;
	}
	/**
	 * This method set lenth single article
	 * @var int $length
	 */
	public function lengthSingleArticle($length) {
		$this->length = $length;
		return $this;
	}
	/**
	 * This method set table to add articles
	 * @var str $table
	 */
	public function tableName($table) {
		$this->table = $table;
		return $this;
	}
	/**
	 * This method set column name for title
	 * @var str $titleColumn
	 */
	public function titleColumn($titleColumn) {
		$this->title = $titleColumn;
		return $this;
	}
	/**
	 * This method set column name for articles
	 * @var str $articleColumn
	 */
	public function articleColumn($articleColumn) {
		$this->article = $articleColumn;
		return $this;
	}
	/**
	 * This method set column name for author
	 * @var str $authorCoumn
	 */
	public function authorColumn($authorColumn) {
		$this->author = $authorColumn;
		return $this;
	}
	/**
	 * This method set column name for date
	 * @var str $dateColumn
	 */
	public function dateColumn($dateColumn) {
		$this->dateColumn = $dateColumn;
		return $this;
	}
	/**
	 * This is execute method. It adds to the database the given data portion
	 * @return str $this->message - information about corretly generated fake news
	 */
	public function executeFaker() {
		for ($i=0; $i < $this->number; $i++) {
			$this->fakeNews = file('texts.txt');
			$this->names = file('names.txt'); # Names from: https://gist.github.com/subodhghulaxe/8148971
			$this->titleColumn = file('titles.txt');
			$randTitle = $this->titleColumn[array_rand($this->titleColumn)];
			//var_dump($this->title);
			$dateTime = mt_rand(1, time());
			$randDate = date("Y-m-d H:i:s", $dateTime);
			$randfakeNews = $this->fakeNews[array_rand($this->fakeNews)]; # Random fake fakeNews
			$cut = substr($randfakeNews, 0, $this->length); # Cut fake fakeNews
			# Random name from array
			$randName = $this->names[array_rand($this->names)];
			$queryFaker = $this->db->prepare("INSERT INTO `".$this->table."` (`".$this->title."`, `".$this->article."`, `".$this->author."`, `".$this->dateColumn."`) VALUES (:title, :article, :author, :dateTime)");
			$queryFaker->bindValue(':title', $randTitle, PDO::PARAM_STR);
			$queryFaker->bindValue(':article', $cut, PDO::PARAM_STR);
			$queryFaker->bindValue(':author', $randName, PDO::PARAM_STR);
			$queryFaker->bindValue(':dateTime', $randDate, PDO::PARAM_STR);
			if (!$queryFaker->execute()) {
				print_r ($queryFaker->errorInfo());
			} else {
				$this->message = 'The fake news was generated correctly.';
			}
		}
		return print($this->message);
	}

	/**
	 * It`s special method. This method clears your table with article.
	 * Use only when you want to clear the table from the code level.
	 * This way you do not have to enter phpmyadmin to execute the TRUNCATE query
	 */
	public function clearFaker() {
		$queryFaker = $this->db->prepare("TRUNCATE TABLE `".$this->table."`"); 
		if (!$queryFaker->execute()) {
			print_r ($queryFaker->errorInfo());
		}
	}
}