<?php

namespace OffreBundle\Entity;


use AuthBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;



/**
 * @ORM\Entity
 * @ORM\Table(name="offre")
 */
class Offre
{


    /**
     * @ORM\Column(name="idOffre", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idOffre;
    /**
     * @ORM\Column(name="titleOffre", type="string", length=255, nullable=true)
     */
    protected $titleOffre;
    /**
     * @ORM\Column(name="descriptionOffre", type="string", length=1000, nullable=true)
     */
    protected $descriptionOffre;
    /**
     * @ORM\Column(name="experienceOffre",type="integer")
     */
    protected $experienceOffre;
    /**
     * @ORM\Column(name="salaireOffre",type="integer")
     */
    protected $salaireOffre;
    /**
     * @ORM\Column(name="technologiesOffre", type="string", length=255, nullable=true)
     */
    protected $technologiesOffre;
    /**
     * @ORM\Column(name="langageOffre", type="string", length=255, nullable=true)
     */
    protected $langageOffre;
    /**
     * @ORM\Column(name="LocationOffre", type="string", length=255, nullable=true)
     */
    protected $LocationOffre;
    /**
     * @ORM\Column(name="dateOffre",type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    protected  $dateOffre;
    /**
     * @ORM\Column(name="typeOffre", type="string", length=255, nullable=true)
     */
    protected $typeOffre;
    /**
     * @ORM\ManyToOne(targetEntity="AuthBundle\Entity\User")
     * @ORM\JoinColumn(name="entreprise_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
    /**
     * @return mixed
     */
    public function getIdOffre()
    {
        return $this->idOffre;
    }

    /**
     * @param mixed $idOffre
     */
    public function setIdOffre($idOffre)
    {
        $this->idOffre = $idOffre;
    }

    /**
     * @return mixed
     */
    public function getTitleOffre()
    {
        return $this->titleOffre;
    }

    /**
     * @param mixed $titleOffre
     */
    public function setTitleOffre($titleOffre)
    {
        $this->titleOffre = $titleOffre;
    }

    /**
     * @return mixed
     */
    public function getDescriptionOffre()
    {
        return $this->descriptionOffre;
    }

    /**
     * @param mixed $descriptionOffre
     */
    public function setDescriptionOffre($descriptionOffre)
    {
        $this->descriptionOffre = $descriptionOffre;
    }

    /**
     * @return mixed
     */
    public function getExperienceOffre()
    {
        return $this->experienceOffre;
    }

    /**
     * @param mixed $experienceOffre
     */
    public function setExperienceOffre($experienceOffre)
    {
        $this->experienceOffre = $experienceOffre;
    }

    /**
     * @return mixed
     */
    public function getSalaireOffre()
    {
        return $this->salaireOffre;
    }

    /**
     * @param mixed $salaireOffre
     */
    public function setSalaireOffre($salaireOffre)
    {
        $this->salaireOffre = $salaireOffre;
    }

    /**
     * @return mixed
     */
    public function getTechnologiesOffre()
    {
        return $this->technologiesOffre;
    }

    /**
     * @param mixed $technologiesOffre
     */
    public function setTechnologiesOffre($technologiesOffre)
    {
        $this->technologiesOffre = $technologiesOffre;
    }

    /**
     * @return mixed
     */
    public function getLangageOffre()
    {
        return $this->langageOffre;
    }

    /**
     * @param mixed $langageOffre
     */
    public function setLangageOffre($langageOffre)
    {
        $this->langageOffre = $langageOffre;
    }

    /**
     * @return mixed
     */
    public function getLocationOffre()
    {
        return $this->LocationOffre;
    }

    /**
     * @param mixed $LocationOffre
     */
    public function setLocationOffre($LocationOffre)
    {
        $this->LocationOffre = $LocationOffre;
    }

    /**
     * @return mixed
     */
    public function getDateOffre()
    {
        return $this->dateOffre;
    }

    /**
     * @param mixed $dateOffre
     */
    public function setDateOffre($dateOffre)
    {
        $this->dateOffre = $dateOffre;
    }

    /**
     * @return mixed
     */
    public function getTypeOffre()
    {
        return $this->typeOffre;
    }

    /**
     * @param mixed $typeOffre
     */
    public function setTypeOffre($typeOffre)
    {
        $this->typeOffre = $typeOffre;
    }

    public function  __construct()
    {
        $this->dateOffre = new \DateTime('now');
    }
}