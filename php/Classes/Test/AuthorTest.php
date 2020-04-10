<?php
namespace GabyVeloz\ObjectOriented\Test;

use GabyVeloz\ObjectOriented\{Author};
//hack! -added for practice
require_once(dirname(__DIR__) . "/Test/DataDesignTest.php");
// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");


class AuthorTest extends DataDesignTest {

	private $VALID_ACTIVATION_TOKEN;//later
	private $VALID_AVATAR_URL = "https://www.uuidgenerator.net/version4";
	private $VALID_AUTHOR_EMAIL = "gabrielaveloz@yahoo.com";
	private $VALID_AUTHOR_HASH;//later
	private $VALID_USERNAME = "gveloz";

	public function setUp() : void {
		parent::setUp();
		$password = "lalala";
		$this->VALID_AUTHOR_HASH = password_hash("mypassword", PASSWORD_ARGON2ID, ["time_cost" => 9]);
		$this->VALID_ACTIVATION_TOKEN = bin2hex(random_bytes(16));
	}

	public function testInsertValidAuthor() :void{
		//this will get count of author records in b befor test is ran.
		$numRows = $this->getConnection()->getRowCount("author");

		//insert ab author record in db
		$authorId = generateUuidV4()->toString();
		$author = new Author($authorId, $this->VALID_ACTIVATION_TOKEN, $this->VALID_AVATAR_URL, $this->VALID_AUTHOR_HASH, $this->VALID_AUTHOR_EMAIL, $this->VALID_USERNAME);
		$author->insert($this->getPDO());

		//check count of author records in the db after the insert
		$numRows = $this->getConnection()->getRowCount("author");
		self::assertEquals($numRows + 1, $numRowsAfterInsert);


		//get a copy of the record we inserted and validate the values
		//make sure the values that went in the record are the same ones that come out.

	}
	/*
	public function testUpdateValidAuthor() :void{

	}
	public function tesDeletetValidAuthor() :void{

	}
	public function testGetValidAuthorByAuthorId() :void{

	}
	public function tesDeletetValidAuthors() :void{

	}
	*/


}
