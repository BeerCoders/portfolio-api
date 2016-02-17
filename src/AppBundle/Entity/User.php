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
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    protected $roles;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(groups={"Profile"})
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(groups={"Profile"})
     */
    protected $surname;

    /**
     * @var \DateTime $birth
     *
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     * @Assert\NotBlank(groups={"Registration", "Profile"})
     */
    protected $birth;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(groups={"Profile"})
     * @Assert\Url()
     */
    protected $avatar;

    /**
     * @var ArrayCollection|Article[]
     * @ORM\OneToMany(targetEntity="Article", mappedBy="author")
     *
     * @Serializer\MaxDepth(2)
     */
    protected $articles;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    public function __construct()
    {
        parent::__construct();
        $this->articles = new ArrayCollection();
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
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
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
