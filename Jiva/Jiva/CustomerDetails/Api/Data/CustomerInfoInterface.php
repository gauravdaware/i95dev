<?php


namespace Jiva\CustomerDetails\Api\Data;

interface CustomerInfoInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const FIRSTNAME = 'FirstName';
    const PHOTO = 'Photo';
    const LASTNAME = 'LastName';
    const EMAIL = 'Email';
    const GENDER = 'Gender';
    const CUSTOMERINFO_ID = 'customerinfo_id';
    const DATEOFBIRTH = 'DateOfBirth';

    /**
     * Get customerinfo_id
     * @return string|null
     */
    public function getCustomerinfoId();

    /**
     * Set customerinfo_id
     * @param string $customerinfoId
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     */
    public function setCustomerinfoId($customerinfoId);

    /**
     * Get FirstName
     * @return string|null
     */
    public function getFirstName();

    /**
     * Set FirstName
     * @param string $firstName
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     */
    public function setFirstName($firstName);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Jiva\CustomerDetails\Api\Data\CustomerInfoExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Jiva\CustomerDetails\Api\Data\CustomerInfoExtensionInterface $extensionAttributes
    );

    /**
     * Get LastName
     * @return string|null
     */
    public function getLastName();

    /**
     * Set LastName
     * @param string $lastName
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     */
    public function setLastName($lastName);

    /**
     * Get Email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set Email
     * @param string $email
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     */
    public function setEmail($email);

    /**
     * Get DateOfBirth
     * @return string|null
     */
    public function getDateOfBirth();

    /**
     * Set DateOfBirth
     * @param string $dateOfBirth
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     */
    public function setDateOfBirth($dateOfBirth);

    /**
     * Get Photo
     * @return string|null
     */
    public function getPhoto();

    /**
     * Set Photo
     * @param string $photo
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     */
    public function setPhoto($photo);

    /**
     * Get Gender
     * @return string|null
     */
    public function getGender();

    /**
     * Set Gender
     * @param string $gender
     * @return \Jiva\CustomerDetails\Api\Data\CustomerInfoInterface
     */
    public function setGender($gender);
}
