<?php
/**
 * File SenderAddress.php
 * Created at: 2014-12-30 10-37
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Feature\Model;

use JMS\Serializer\Annotation as JMS;
use Webit\Addressing\Model\CountryInterface;
use Webit\Shipment\Address\SenderAddressInterface;

class SenderAddress implements SenderAddressInterface
{
    /**
     * @var string
     * @JMS\Type("string")
     */
    private $name;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $address;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $post;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $postCode;

    /**
     * @var CountryInterface
     */
    private $country;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param string $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return string
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * @param string $postCode
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;
    }

    /**
     * @return CountryInterface
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param CountryInterface $country
     */
    public function setCountry(CountryInterface $country = null)
    {
        $this->country = $country;
    }


}