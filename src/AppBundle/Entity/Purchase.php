<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Purchase
 *
 * @ORM\Table(name="purchase")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PurchaseRepository")
 */
class Purchase
{
    /**
     * @var int
     *
     * @ORM\Column(name="pur_oid", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pur_created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var float
     *
     * @ORM\Column(name="pur_total_price", type="float")
     */
    private $totalPrice;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Purchase
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set totalPrice
     *
     * @param float $totalPrice
     *
     * @return Purchase
     */
    public function setTotalPrice($totalPrice)
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    /**
     * Get totalPrice
     *
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->totalPrice;
    }
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="purchases")
     * @ORM\JoinColumn(name="usr_oid", referencedColumnName="usr_oid")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity="Product")
     * @ORM\JoinTable(name="npp_nn_pur_pro",
     *      joinColumns={@ORM\JoinColumn(name="pur_oid", referencedColumnName="pur_oid")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="pro_oid", referencedColumnName="pro_oid")}
     *      )
     */
    private $products;


    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();        
    }
}

