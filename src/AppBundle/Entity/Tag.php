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
 * Class Tag
 * @package AppBundle\Entity
 * @author Szymon Kunowski <szymon.kunowski@gmail.com>
 *
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min = 1,
     *      max = 50,
     *      minMessage = "Your name must be at least {{ limit }} characters long",
     *      maxMessage = "Your name cannot be longer than {{ limit }} characters"
     * )
     */
    protected $name;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="Article", inversedBy="tags", cascade={"all"})
     * @ORM\JoinTable(name="article_tag")
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

    }

}
