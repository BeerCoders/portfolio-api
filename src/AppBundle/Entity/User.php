<?php
/**
 * This file is part of the rest-api package.
 *
 * (c) Rafał Lorenz <vardius@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class User
 * @package AppBundle\Entity
 * @author Rafał Lorenz <vardius@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="users")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose()
     */
    protected $id;

    /**
     * @Serializer\Expose()
     */
    protected $roles;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(groups={"Profile"})
     * @Serializer\Expose()
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(groups={"Profile"})
     * @Serializer\Expose()
     */
    protected $surname;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(groups={"Profile"})
     * @Serializer\Expose()
     */
    protected $title;

    /**
     * @var \DateTime $birth
     *
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime()
     * @Assert\NotBlank(groups={"Registration", "Profile"})
     * @Serializer\Expose()
     */
    protected $birth;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(groups={"Profile"})
     * @Serializer\Expose()
     */
    protected $location;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(groups={"Profile"})
     * @Serializer\Expose()
     */
    protected $description;

    /**
     * @var ArrayCollection|Article[]
     * @ORM\OneToMany(targetEntity="Article", mappedBy="author")
     *
     * @Serializer\MaxDepth(2)
     * @Serializer\Expose()
     */
    protected $articles;

    /**
     * @var ArrayCollection|Job[]
     * @ORM\OneToMany(targetEntity="Job", mappedBy="user", cascade={"remove"})
     * @Serializer\Expose()
     */
    protected $jobs;

    /**
     * @var ArrayCollection|Skill[]
     * @ORM\OneToMany(targetEntity="Skill", mappedBy="user", cascade={"remove"})
     * @Serializer\Expose()
     */
    protected $skills;

    /**
     * @var ArrayCollection|SocialMedia[]
     *
     * @ORM\OneToMany(targetEntity="SocialMedia", mappedBy="user", cascade={"remove"})
     * @Serializer\Expose()
     */
    protected $socialMedias;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     */
    protected $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     * @Serializer\Expose()
     */
    protected $updated;

    public function __construct()
    {
        parent::__construct();
        $this->articles = new ArrayCollection();
        $this->jobs = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->socialMedias = new ArrayCollection();
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        parent::setEmail($email);
        $this->setUsername($email);
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getBirth()
    {
        return $this->birth;
    }

    /**
     * @param \DateTime $birth
     * @return User
     */
    public function setBirth($birth)
    {
        $this->birth = $birth;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return User
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return User
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return ArrayCollection|Article[]
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @return ArrayCollection|Job[]
     */
    public function getJobs()
    {
        return $this->jobs;
    }

    /**
     * @param Job $job
     * @return $this
     */
    public function addJob(Job $job)
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs->add($job);
        }

        return $this;
    }

    /**
     * @param Job $job
     * @return $this
     */
    public function removeJob(Job $job)
    {
        $this->jobs->removeElement($job);

        return $this;
    }

    /**
     * @return ArrayCollection|Skill[]
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param Skill $skill
     * @return $this
     */
    public function addSkill(Skill $skill)
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
        }

        return $this;
    }

    /**
     * @param Skill $skill
     * @return $this
     */
    public function removeSkill(Skill $skill)
    {
        $this->skills->removeElement($skill);

        return $this;
    }

    /**
     * @return ArrayCollection|SocialMedia[]
     */
    public function getSocialMedias()
    {
        return $this->socialMedias;
    }

    /**
     * @param SocialMedia $media
     * @return $this
     */
    public function addSocialMedia(SocialMedia $media)
    {
        if (!$this->socialMedias->contains($media)) {
            $this->socialMedias->add($media);
        }

        return $this;
    }

    /**
     * @param SocialMedia $media
     * @return $this
     */
    public function removeSocialMedia(SocialMedia $media)
    {
        $this->socialMedias->removeElement($media);

        return $this;
    }

    /**
     * @param Article $article
     * @return User
     */
    public function addArticle(Article $article)
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
        }
        return $this;
    }

    /**
     * @param Article $article
     * @return User
     */
    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     * @return User
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     * @return User
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }

    /**
     * @return string
     * @Serializer\VirtualProperty
     */
    public function getFullName()
    {
        if (!$this->name && !$this->surname) {
            return $this->getUsername();
        }

        return $this->name . ' ' . $this->surname;
    }
}
