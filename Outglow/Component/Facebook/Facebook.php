<?php namespace Outglow\Component\Facebook;

/**
 * THE START OF A SMALL FACEBOOK SDK
 * WRAPPER
 * 
 * FEEL FREE TO USE / MODIFY ANY OF THIS
 * CODE FOR YOUR OWN PROJECTS
 * OPEN SOURCE / COMMERCIAL
 *
 * @author Harry Lawrence
 * @copyright Outglow Components 2012
 * @package Facebook
 * @version 1.0
 * @license The MIT License (MIT)
*/

class Facebook
{
	/**
	 * CREATE THE FACEBOOK SDK OBJECT
	 * @var Object
	*/
	private $facebookSdkObject;
	private $appId;
	private $secret;
	private $scope;
	private $redirectUri;

	/**
	 * STORE THE FACEBOOK EXTERNAL
	 * USERID
	 * @var String
	*/
	public $socialExternalId;

	/**
	 * - constructor
	 * ASSIGN TWO PROPERTIES AS NULL
	 * @return NULL
	*/
	public function __construct()
	{
		$this->facebookSdkObject = NULL;
		$this->socialExternalId  = NULL;
		$this->appId 			 = NULL;
		$this->secret 			 = NULL;
		$this->scope 			 = NULL;
		$this->redirectUri 		 = NULL;
	}

	/**
	 * - setAppId
	 * SETS THE APPID
	 * @param String
	 * @return bool
	 */
	public function setAppId($newAppId)
	{
		return $this->appId = $newAppId;
	}

	/**
	 * - setSecret
	 * SETS THE SECRET
	 * @param String
	 * @return bool
	 */
	public function setSecret($newSecret)
	{
		return $this->secret = $newSecret;
	}

	/**
	 * - setScope
	 * SETS THE SCOPE
	 * @param String
	 * @return bool
	 */
	public function setScope($newScope)
	{
		return $this->scope = $newScope;
	}

	/**
	 * - setRedirectUri
	 * SETS THE REDIRECTURI
	 * @param String
	 * @return bool
	 */
	public function setRedirectUri($newRedirectUri)
	{
		return $this->redirectUri = $newRedirectUri;
	}

	/**
	 * - setup
	 * CREATE THE FACEBOOK SDK OBJECT
	 * WITH THE NATIVE CREDENTIALS
	 * @param array
	 * @return bool
	 */
	public function setup($applicationCredentials = array())
	{
		return $this->facebookSdkObject = new SDK_Facebook($applicationCredentials);
	}

	/**
	 * - autoSetup
	 * CHECKS TO SEE IF PROPERTIES ARE SET
	 * IF SO LOADS IN ALL CREDENTIALS
	 * @return bool
	 */
	public function autoSetup()
	{
		$applicationCredentials = array();
		if (!is_null($this->appId)) {
			$applicationCredentials['appId'] = $this->appId;
		}
		if (!is_null($this->secret)) {
			$applicationCredentials['secret'] = $this->secret;
		}
		if (!is_null($this->scope)) {
			$applicationCredentials['scope'] = $this->scope;
		}
		if (!is_null($this->redirectUri)) {
			$applicationCredentials['redirectUri'] = $this->redirectUri;
		}
		return $this->facebookSdkObject = new SDK_Facebook($applicationCredentials);
	}

	/**
	 * -getLoginUrl
	 * RETURNS THE LOGIN URL TO
	 * ACCESS DATA FROM FACEBOOK
	 * @return String
	 */
	public function getLoginUrl()
	{
		return $this->facebookSdkObject->getLoginUrl();
	}

	/**
	 * - getLoggedInUserId
	 * RETURNS THE FACEBOOK
	 * EXTERNAL USERID
	 * @return String
	 */
	public function getLoggedInUserId()
	{
		$socialExternalId = $this->facebookSdkObject->getUser();
		if ($socialExternalId) {
			$this->socialExternalId = $socialExternalId;
			return $this->socialExternalId;
		}
		return NULL;
	}

	/**
	 * - getLoggdInUser
	 * RETURNS AN ARRAY OF DATA
	 * BROUGHT BACJ FROM FACEBOOK
	 * @return array
	 */
	public function getLoggedInUser()
	{
		return $this->facebookSdkObject->api('/me');
	}
}
	
?>