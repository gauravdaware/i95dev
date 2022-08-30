<?php


namespace Jiva\CustomerDetails\Model\Data;

use Jiva\CustomerDetails\Api\Data\CustomerInfoInterface;

class CustomerInfo extends \Magento\Framework\Api\AbstractExtensibleObject implements CustomerInfoInterface
{

    /**
     * Get customerinfo_id
     * @return string|null
     */
    public function getCustomerinfoId()
    {
        return $this->_get(self::CUSTOMERINFO_ID);
    }

    /**
     * Set customerinfo_id
     * @param string $customerinfoId
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     */
    public function setCustomerinfoId($customerinfoId)
    {
        return $this->setData(self::CUSTOMERINFO_ID, $customerinfoId);
    }

    /**
     * Get FirstName
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->_get(self::FIRSTNAME);
    }

    /**
     * Set FirstName
     * @param string $firstName
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     */
    public function setFirstName($firstName)
    {
        return $this->setData(self::FIRSTNAME, $firstName);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Jiva\CustomerDetails\Api\Data\CustomerInfoExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Jiva\CustomerDetails\Api\Data\CustomerInfoExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get LastName
     * @return string|null
     */
    public function getLastName()
    {
        return $this->_get(self::LASTNAME);
    }

    /**
     * Set LastName
     * @param string $lastName
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     */
    public function setLastName($lastName)
    {
        return $this->setData(self::LASTNAME, $lastName);
    }

    /**
     * Get Email
     * @return string|null
     */
    public function getEmail()
    {
        return $this->_get(self::EMAIL);
    }

    /**
     * Set Email
     * @param string $email
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get DateOfBirth
     * @return string|null
     */
    public function getDateOfBirth()
    {
        return $this->_get(self::DATEOFBIRTH);
    }

    /**
     * Set DateOfBirth
     * @param string $dateOfBirth
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     */
    public function setDateOfBirth($dateOfBirth)
    {
        return $this->setData(self::DATEOFBIRTH, $dateOfBirth);
    }

    /**
     * Get Photo
     * @return string|null
     */
    public function getPhoto()
    {
        return $this->_get(self::PHOTO);
    }

    /**
     * Set Photo
     * @param string $photo
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     */
    public function setPhoto($photo)
    {
        return $this->setData(self::PHOTO, $photo);
    }

    /**
     * Get Gender
     * @return string|null
     */
    public function getGender()
    {
        return $this->_get(self::GENDER);
    }

    /**
     * Set Gender
     * @param string $gender
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     */
    public function setGender($gender)
    {
        return $this->setData(self::GENDER, $gender);
    }
}
