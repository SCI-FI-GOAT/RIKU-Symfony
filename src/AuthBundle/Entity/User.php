<?php

namespace AuthBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AuthBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
	/**
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(name="linkedin_id", type="string", length=255, nullable=true)
	 */
	private $linkedin_id;
    /**
     * @ORM\Column(name="company_img", type="string", length=255, nullable=true)
     */
    private $company_img;

    /**
     * @return mixed
     */
    public function getcompany_img()
    {
        return $this->company_img;
    }



    /**
     * @param mixed $company_img
     */
    public function setCompanyImg($company_img)
    {
        $this->company_img = $company_img;
    }

	private $linkedinAccessToken;

	/**
	 * @return integer
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getLinkedinId() {
		return $this->linkedin_id;
	}

	/**
	 * @param mixed $linkedin_id
	 */
	public function setLinkedinId( $linkedin_id ) {
		$this->linkedin_id = $linkedin_id;
	}



	/**
	 * @param string $linkedinAccessToken
	 * @return User
	 */
	public function setlinkedinAccessToken($linkedinAccessToken)
	{
		$this->linkedinAccessToken = $linkedinAccessToken;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getlinkedinAccessToken()
	{
		return $this->linkedinAccessToken;
	}
}

