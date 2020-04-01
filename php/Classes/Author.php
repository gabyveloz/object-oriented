<?php
namespace GabyVeloz/ObjectOriented;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;


class Author {
	use ValidateUuid;

	private $authorId;

	private $authorActivationToken;

	private $authorAvatarUrl;

	private $authorEmail;

	private $authorHash;

	private $authorUsername;


	/**
	 * constructor method
	 */
	public function __construct($authorId, $authorActivationToken, $authorAvatarUrl = null, $authorEmail, $authorHash, $authorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToke($newAuthorActivationToken);
			$this->setAuthorAvatarUr($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}


	/**
	 * accessor method for author id
	 */

	public function getAuthorId() : Uuid {
		return($this->authorId);
	}

	/**
	 * mutator method for author id
	 */
	public function setAuthorId( $newAuthorId) : void {
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

	public function getAuthorActivationToken() : Uuid {
		return($this->authorActivationToken);
	}

	/**
	 * mutator method for author activation Token
	 */
	public function setAuthorActivationToken( $newAuthorActivationToken) : void {
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

	public function getAuthorAvatarUrl() : Uuid {
		return($this->authorAvatarUrl);
	}

	/**
	 * mutator method for author avatar url
	 */
	public function setAuthorAvatarUrl( $newAuthorAvatarUrl) : void {
		try {
			$uuid = self::validateUuid($newAuthorAvatarUrl);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the author avatar url
		$this->authorAvatarUrl = $uuid;
	}



	/**
	 * accessor method for author email
	 */

	public function getAuthorEmail() : Uuid {
		return($this->authorEmail);
	}

	/**
	 * mutator method for author Email
	 */
	public function setAuthorEmail( $newAuthorEmail) : void {
		try {
			$uuid = self::validateUuid($newAuthorEmail);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the author Email
		$this->authorEmail = $uuid;
	}



	/**
	 * accessor method for author Hash
	 */

	public function getAuthorHash() : Uuid {
		return($this->authorHash);
	}

	/**
	 * mutator method for author Hash
	 */
	public function setAuthorHash( $newAuthorHash) : void {
		try {
			$uuid = self::validateUuid($newAuthorHash);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the author Hash
		$this->authorHash = $uuid;
	}



	/**
	 * accessor method for author Username
	 */

	public function getAuthorUsername() : Uuid {
		return($this->authorUsername);
	}

	/**
	 * mutator method for author Username
	 */
	public function setAuthorUsername( $newAuthorUsername) : void {
		try {
			$uuid = self::validateUuid($newAuthorUsername);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the author Username
		$this->authorUsername = $uuid;
	}