<?php
namespace GabyVeloz\ObjectOriented;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;


class Author {
	use ValidateUuid;
//These are State Variables//

	private $authorId;

	private $authorActivationToken;

	private $authorAvatarUrl;

	private $authorEmail;

	private $authorHash;

	private $authorUsername;


	/**
	 * constructor method
	 */
	public function __construct($newAuthorId, $newAuthorActivationToken, $newAuthorAvatarUrl = null, $newAuthorEmail, $newAuthorHash, $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}


	/**
	 * accessor method for author id
	 */

	public function getAuthorId(): Uuid {
		return ($this->authorId);
	}

	/**
	 * mutator method for author id
	 */
	public function setAuthorId($newAuthorId): void {
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the author id
		$this->authorId = $uuid;
	}


	/**
	 * accessor method for author activation token
	 */

	public function getAuthorActivationToken(): Uuid {
		return ($this->authorActivationToken);
	}

	/**
	 * mutator method for author activation Token
	 */
	public function setAuthorActivationToken($newAuthorActivationToken): void {
		try {
			$uuid = self::validateUuid($newAuthorActivationToken);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the author activation token
		$this->authorActivationToken = $uuid;
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
}
