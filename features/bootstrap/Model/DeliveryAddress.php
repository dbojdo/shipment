<?php
/**
 * File DeliveryAddress.php
 * Created at: 2014-12-30 10-06
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\Shipment\Feature\Model;

use JMS\Serializer\Annotation as JMS;
use Webit\Addressing\Model\CountryInterface;
use Webit\Shipment\Address\DeliveryAddressInterface;

class DeliveryAddress implements DeliveryAddressInterface
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
     * @var string
     * @JMS\Type("string")
     */
    private $contactPerson;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $contactPhoneNo;

    /**
     * @var string
     * @JMS\Type("string")
     */
    private $contactEmail;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @return mixed
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * @param mixed $postCode
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

    /**
     * @return mixed
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * @param mixed $contactPerson
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;
    }

    /**
     * @return mixed
     */
    public function getContactPhoneNo()
    {
        return $this->contactPhoneNo;
    }

    /**
     * @param mixed $contactPhoneNo
     */
    public function setContactPhoneNo($contactPhoneNo)
    {
        $this->contactPhoneNo = $contactPhoneNo;
    }

    /**
     * @return mixed
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * @param mixed $contactEmail
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;
    }
}
