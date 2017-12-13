<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Npi
 *
 * @ORM\Table(name="npi_nn_pro_ing")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NpiRepository")
 */
class Npi
{
    /**
     * @var int
     *
     * @ORM\Column(name="npi_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="npi_amount", type="float")
     */
    private $amount;


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
     * Set amount
     *
     * @param integer $amount
     *
     * @return Npi
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }
    /**
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="pro_oid", referencedColumnName="pro_oid")
     */
    private $products;
    /**
     * @ORM\ManyToOne(targetEntity="Ingredient")
     * @ORM\JoinColumn(name="ing_oid", referencedColumnName="ing_oid")
     */
    private $ingrdients;
}

