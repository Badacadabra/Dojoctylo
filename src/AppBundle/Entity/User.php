<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=20, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sign_up_date", type="date")
     */
    private $signUpDate;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_logins", type="integer")
     */
    private $nbLogins;

    /**
     * @var int
     *
     * @ORM\Column(name="training_time", type="integer")
     */
    private $trainingTime;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_godsons", type="smallint")
     */
    private $nbGodsons;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set signUpDate
     *
     * @param \DateTime $signUpDate
     *
     * @return User
     */
    public function setSignUpDate($signUpDate)
    {
        $this->signUpDate = $signUpDate;

        return $this;
    }

    /**
     * Get signUpDate
     *
     * @return \DateTime
     */
    public function getSignUpDate()
    {
        return $this->signUpDate;
    }

    /**
     * Set nbLogins
     *
     * @param integer $nbLogins
     *
     * @return User
     */
    public function setNbLogins($nbLogins)
    {
        $this->nbLogins = $nbLogins;

        return $this;
    }

    /**
     * Get nbLogins
     *
     * @return int
     */
    public function getNbLogins()
    {
        return $this->nbLogins;
    }

    /**
     * Set trainingTime
     *
     * @param integer $trainingTime
     *
     * @return User
     */
    public function setTrainingTime($trainingTime)
    {
        $this->trainingTime = $trainingTime;

        return $this;
    }

    /**
     * Get trainingTime
     *
     * @return int
     */
    public function getTrainingTime()
    {
        return $this->trainingTime;
    }

    /**
     * Set nbGodsons
     *
     * @param integer $nbGodsons
     *
     * @return User
     */
    public function setNbGodsons($nbGodsons)
    {
        $this->nbGodsons = $nbGodsons;

        return $this;
    }

    /**
     * Get nbGodsons
     *
     * @return int
     */
    public function getNbGodsons()
    {
        return $this->nbGodsons;
    }
}

