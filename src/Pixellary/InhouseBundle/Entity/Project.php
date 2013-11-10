<?php

namespace Pixellary\InhouseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Project
 *
 * @ORM\Table(name="Project")
 * @ORM\Entity
 */
class Project
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="details", type="text", nullable=false)
     */
    private $details;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float", nullable=false)
     */
    private $total;

    /**
     * @var float
     *
     * @ORM\Column(name="paid", type="float", nullable=false)
     */
    private $paid;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="stage", type="string", length=50, nullable=false)
     */
    private $stage;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="thumb", type="string", length=255, nullable=true)
     *    
     */
    private $thumb;

    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Pixellary\InhouseBundle\Entity\Client
     *
     * @ORM\ManyToOne(targetEntity="Pixellary\InhouseBundle\Entity\Client")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     * })
     */
    private $client;



    /**
     * Set title
     *
     * @param string $title
     * @return Project
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
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
     * Set details
     *
     * @param string $details
     * @return Project
     */
    public function setDetails($details)
    {
        $this->details = $details;
    
        return $this;
    }

    /**
     * Get details
     *
     * @return string 
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return Project
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set paid
     *
     * @param float $paid
     * @return Project
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;
    
        return $this;
    }

    /**
     * Get paid
     *
     * @return float 
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Project
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set stage
     *
     * @param string $stage
     * @return Project
     */
    public function setStage($stage)
    {
        $this->stage = $stage;
    
        return $this;
    }

    /**
     * Get stage
     *
     * @return string 
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Project
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set thumb
     *
     * @param string $thumb
     * @return Project
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;
    
        return $this;
    }

    /**
     * Get thumb
     *
     * @return string 
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Project
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    
        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
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
     * Set client
     *
     * @param \Pixellary\InhouseBundle\Entity\Client $client
     * @return Project
     */
    public function setClient(\Pixellary\InhouseBundle\Entity\Client $client = null)
    {
        $this->client = $client;
    
        return $this;
    }

    /**
     * Get client
     *
     * @return \Pixellary\InhouseBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    function __toString(){
        return $this->title;
    }


    /**
     * Virtual getter that returns logo web path
     * @return string 
     */
    public function getThumbSrc() {
      //return $this->getWebPath();
      return $this->getUploadRootDir();
    }



    /* Handling uploads */

    public function getAbsolutePath($usuario = null) {
        return null === $this->thumb ? null : $this->getUploadRootDir($usuario) . '/' . $this->thumb;
    }

    public function getWebPath($usuario = null) {
        return null === $this->thumb ? null : $this->getUploadDir($usuario) . '/' . $this->thumb;
    }

    protected function getUploadRootDir($usuario = null) {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__ . '/../../../../web/' . $this->getUploadDir($usuario);
    }

    protected function getUploadDir($usuario = null) {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        if ($usuario)
            return 'uploads/images/' . $usuario;
        else
            return 'uploads/images';
    }

    public function upload($usuario = null) {
        // the file property can be empty if the field is not required
        if (null === $this->file) {
            return;
        }

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues
        // move takes the target directory and then the target filename to move to
        $this->file->move($this->getUploadRootDir($usuario), $this->file->getClientOriginalName());

        // set the path property to the filename where you'ved saved the file
        $this->thumb = $this->file->getClientOriginalName();
        
        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

}