<?php
namespace GabyVeloz\ObjectOriented;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;


class Author implements \JsonSerializable {
	use ValidateUuid;

	/**
	 * Id for this author
	 * @var Uuid $authorId
	 */
	private $authorId;

	/**
	 * activation token for this Author
	 * @var string $authorActivationToken
	 */
	private $authorActivationToken;

	/**
	 * avatar for this author
	 * @var string $authorAvatarUrl
	 */
	private $authorAvatarUrl;

	/**
	 * email for this author
	 * @var string $authorEmail
	 */
	private $authorEmail;

	/**
	 * hash for this author
	 * @var string $authorHash
	 */
	private $authorHash;

	/**
	 * username for this author
	 * @var string $authorUsername
	 */
	private $authorUsername;
	/**
	 * @var string|null
	 */
	private $AuthorActivationToken;


	/**
	 * constructor for this Author
	 * @param string|Uuid $newAuthorId if of this Author or null if a new Author
	 * @param string $newAuthorActivationToken activation token to safe guard against malicious accounts
	 * @param string $newAuthorAvatarUrl string containing an avatar url or null
	 * @param string $newAuthorEmail string containing email
	 * @param string $newAuthorHash string containing a password hash
	 * @param string $newAuthorUsername string containing username
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 */


	public function __construct($newAuthorId, string $newAuthorActivationToken, ?string $newAuthorAvatarUrl,
										 string $newAuthorEmail, string $newAuthorHash, string $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		} //determine what exception type was thrown
		catch
		(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}


	/**
	 * accessor method for author id
	 * @return Uuid value of author id
	 */
	public function getAuthorId(): Uuid {
	return ($this->authorId);
}

	/**
	 * mutator method for author id
	 *
	 * @param Uuid|string $newAuthorId new value of author id
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if #newAuthorId is out of range
	 * @throws \TypeError if $newAuthorId is not a uuid or string
	 */
	public function setAuthorId($newAuthorId): void {
	try {
		$Uuid = self::validateUuid($newAuthorId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	// convert and store the author id
	$this->authorId = $Uuid;
}


	/**
	 * accessor method for author activation token
	 * @return string value of activations token
	 */
	public function getAuthorActivationToken(): ?string {
	return ($this->authorActivationToken);
}

	/**
	 * mutator method for author activation Token
	 * @param string $newAuthorActivationToken
	 * @throws \InvalidArgumentException if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 */
	public function setAuthorActivationToken(?string $newAuthorActivationToken): void {
/*
		try {
			$uuid = self::validateUuid($newAuthorActivationToken);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
*/

		// convert and store the author activation token
		$this->AuthorActivationToken = $newAuthorActivationToken;
	}

	/**
	 * accessor method for Author Avatar Url
	 */

	public function getAuthorAvatarUrl(): string {
		return ($this->authorAvatarUrl);
	}

	/**
	 * mutator method for author avatar url
	 */


	public function setAuthorAvatarUrl($newAuthorAvatarUrl): void {
		// verify the tweet content is secure
//takes avatar url & trims off spaces//

		$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_VALIDATE_URL, FILTER_FLAG_NO_ENCODE_QUOTES);


		// verify the avatarurl content will fit in the database
		if(strlen($newAuthorAvatarUrl) > 255) {
			throw(new \RangeException("avatar url too large"));
		}
	}


	/**
	 * accessor method for author email
	 */

	public function getAuthorEmail(): string {
		return ($this->authorEmail);
	}

	/**
	 * mutator method for author Email
	 */
	public function setAuthorEmail($newAuthorEmail): void {
		// verify the tweet content is secure
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("email needs content"));
		}

		// verify the tweet content will fit in the database
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException("email too large"));
		}
		// store the tweet content
		$this->authorEmail = $newAuthorEmail;
	}


	/**
	 * accessor method for author Hash
	 */

	public function getAuthorHash(): string {
		return ($this->authorHash);
	}

	/**
	 * mutator method for author Hash
	 */
	public function setAuthorHash(string $newAuthorHash): void {
		//enforce that the hash is properly formatted
		$newAuthorHash = trim($newAuthorHash);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("author password hash empty or insecure"));
		}
		//enforce the hash is really an Argon hash
		/*
		$authorHashInfo = password_get_info($newAuthorHash);
		if($authorHashInfo["algoName"] !== "argon2i") {
			throw(new \InvalidArgumentException("profile hash is not a valid hash"));

		}
		*/
		//enforce that the hash is exactly 97 characters.
		if(strlen($newAuthorHash) > 97) {
			throw(new \RangeException("email too large"));
		}
		//store the hash
		$this->authorHash = $newAuthorHash;

	}


	/**
	 * accessor method for author Username
	 */

	public function getAuthorUsername(): string {
		return ($this->authorUsername);
	}

	/**
	 * mutator method for author Username
	 */
	public function setAuthorUsername(string $newAuthorUsername): void {
		// verify the at handle is secure
		$newAuthorUsername = trim($newAuthorUsername);
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorUsername) === true) {
			throw(new \InvalidArgumentException("username is empty or insecure"));
		}
		// verify the at handle will fit in the database

		if(strlen($newAuthorUsername) > 32) {
			throw(new \RangeException("username is too large"));
		}

		// store the at handle
		$this->authorUsername = $newAuthorUsername;

	}
	/**
	 * inserts this Profile into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function insert(\PDO $pdo): void {

		// create query template
		$query = "INSERT INTO author(authorId, authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername) 
						VALUES (:authorId, :authorActivationToken, :authorAvatarUrl, :authorEmail, :authorHash, :authorUsername)";
		$statement = $pdo->prepare($query);
		$parameters = ["authorId" => $this->authorId->getBytes(), "authorActivationToken" => $this->authorActivationToken,
							"authorAvatarUrl" => $this->authorAvatarUrl, "authorEmail" => $this->authorEmail, "authorHash" => $this->authorHash,
							"authorUsername" => $this->authorUsername];
		$statement->execute($parameters);
	}

	/**
	 * deletes this Profile from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {

		// create query template

		$query = "DELETE FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template

		$parameters = ["authorId" => $this->authorId->getBytes()];
		$statement->execute($parameters);
	}
	/**
	 * updates this Profile from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 **/

	public function update(\PDO $pdo): void {

		// create query template
		$query = "UPDATE author 
						SET authorActivationToken = :authorActivationToken, authorAvatarUrl = :authorAvatarUrl, 
						authorEmail = :authorEmail, authorHash = :authorHash, authorUsername = :authorUsername, 
						WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template

		$parameters = ["authorId" => $this->authorId->getBytes(), "authorActivationToken" => $this->authorActivationToken,
							"authorAvatarUrl" => $this->authorAvatarUrl, "authorEmail" => $this->authorEmail,
							"authorHash" => $this->authorHash, "authorUsername" => $this->authorUsername];
		$statement->execute($parameters);
	}


	  // next example

	public static function getAuthorByAuthorId(\PDO $pdo, $authorId):?Author {
		// sanitize the author id before searching

		try {
			$authorId = self::validateUuid($authorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT authorId, authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername
 						FROM author 
 						WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		// bind the author id to the place holder in the template
		$parameters = ["authorId" => $authorId->getBytes()];
		$statement->execute($parameters);

		// grab the Author from mySQL
		try {
			$author = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {

				$author = new Author($row["authorId"], $row["authorActivationToken"], $row["authorAvatarUrl"],
											$row["authorEmail"],$row["authorHash"], $row["authorUsername"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		return ($author);

	}


	//next example

	/**
	 * gets all Authors
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Tweets found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllAuthors(\PDO $pdo) : \SPLFixedArray {
		// create query template
		$query = "SELECT authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername
 						FROM author";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of tweets
		$authors = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$author = new Author($row["authorId"], $row["authorActivationToken"], $row["authorAvatarUrl"],
											$row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
				$authors[$authors->key()] = $author;
				$authors->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($authors);
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize() {
		// TODO: Implement jsonSerialize() method.
	}
}
