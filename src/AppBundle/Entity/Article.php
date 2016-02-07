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
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Article
 * @package AppBundle\Entity
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="article")
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="articles")
     * @Serializer\MaxDepth(1)
     */
    protected $author;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="articles", cascade={"all"})
     * @ORM\JoinTable(name="article_tag")
     *
     * @Serializer\MaxDepth(2)
     */
    protected $tags;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="articles")
     * @Serializer\MaxDepth(1)
     */
    protected $category;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank)
     * @Assert\Url()
     */
    protected $coverImage;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min = 20,
     *      max = 128,
     *      minMessage = "Your title must be at least {{ limit }} characters long",
     *      maxMessage = "Your title cannot be longer than {{ limit }} characters"
     * )
     */
    protected $title;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min = 180,
     *      max = 255,
     *      minMessage = "Your introduction must be at least {{ limit }} characters long",
     *      maxMessage = "Your introduction cannot be longer than {{ limit }} characters"
     * )
     */
    protected $introduction;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    protected $body;

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
        $this->tags = new ArrayCollection();
    }

}
