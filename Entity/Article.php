<?php

namespace MyApp\BlogBundle\Entity;
use MyApp\BlogBundle\Entity\Comments ;

use \Doctrine\Common\Collections\ArrayCollection;


use Doctrine\ORM\Mapping as ORM;

/**
 * MyApp\BlogBundle\Entity\Article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MyApp\BlogBundle\Entity\ArticleRepository")
 */
class Article
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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var text $content
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var datetime $creation_date
     *
     * @ORM\Column(name="creation_date", type="datetime")
     */
    private $creation_date;
    
    /**
     * @var string $categorie
     *
     * @ORM\Column(name="categorie", type="string")
     */
    private $categorie;
  
     /**
     * @ORM\OneToMany(targetEntity="MyApp\BlogBundle\Entity\Comments",mappedBy="article")
     * 
     */
     protected $comments ;




     public function __construct() {
        
        $this->creation_date =new \DateTime();
        $this->comments =new ArrayCollection() ;
        
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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
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
     * Set categorie
     *
     * @param string  $categorie
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * Get categorie
     *
     * @return string 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }



    /**
     * Get comments
     *
     * @return Comments 
     */
    public function getComments()
    {
        return $this->comments;
    }    

    /**
     * Add comments
     *
     * @param MyApp\BlogBundle\Entity\Comments $comments
     */
    public function addComments(\MyApp\BlogBundle\Entity\Comments $comments)
    {
        $this->comments[] = $comments;
    }
}