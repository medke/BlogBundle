<?php

namespace MyApp\BlogBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert ;
use MyApp\BlogBundle\Entity\Article ;

use Doctrine\ORM\Mapping as ORM;

/**
 * MyApp\BlogBundle\Entity\Comments
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MyApp\BlogBundle\Entity\CommentsRepository")
 */
class Comments
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $user
     *
     * @ORM\Column(name="user", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\MinLength(3)
     * @Assert\MaxLength(16)
     */
    private $user;
    
     /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=50)
     *
     * 
     * 
     */
    private $email;

    /**
     * @var text $content
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var datetime $creation_date
     *
     * @ORM\Column(name="creation_date", type="datetime" )
     * @Assert\Datetime();
     */
    private $creation_date;
    
    /**
     * @ORM\ManyToOne(targetEntity="MyApp\BlogBundle\Entity\Article",inversedBy="MyApp\BlogBundle\Entity\Comments")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;

    public function __construct() {
        $this->creation_date= new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param string $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return string 
     */
    public function getUser()
    {
        return $this->user;
    }
    
    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set creation_date
     *
     * @param datetime $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creation_date = $creationDate;
    }

    /**
     * Get creation_date
     *
     * @return datetime 
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }


    /**
     * Set article
     *
     * @param Article $article
     */
    public function setArticle($article)
    {
        $this->article = $article;
    }

    /**
     * Get article
     *
     * @return Article 
     */
    public function getArticle()
    {
        return $this->article;
    }    
}