<?php

class Trainer extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(column="firstname", type="string", length=30, nullable=true)
     */
    protected $firstname;

    /**
     *
     * @var string
     * @Column(column="surname", type="string", length=30, nullable=true)
     */
    protected $surname;

    /**
     *
     * @var string
     * @Column(column="qualification", type="string", length=30, nullable=true)
     */
    protected $qualification;

    /**
     *
     * @var string
     * @Column(column="speciality", type="string", length=30, nullable=true)
     */
    protected $speciality;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field firstname
     *
     * @param string $firstname
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Method to set the value of field surname
     *
     * @param string $surname
     * @return $this
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Method to set the value of field qualification
     *
     * @param string $qualification
     * @return $this
     */
    public function setQualification($qualification)
    {
        $this->qualification = $qualification;

        return $this;
    }

    /**
     * Method to set the value of field speciality
     *
     * @param string $speciality
     * @return $this
     */
    public function setSpeciality($speciality)
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Returns the value of field surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Returns the value of field qualification
     *
     * @return string
     */
    public function getQualification()
    {
        return $this->qualification;
    }

    /**
     * Returns the value of field speciality
     *
     * @return string
     */
    public function getSpeciality()
    {
        return $this->speciality;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("personaltraining");
        $this->setSource("trainer");
        $this->hasMany('id', 'Booking', 'trainerid', ['alias' => 'Booking']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'trainer';
    }
	
	  /**
		* Returns full name of member.
     *
     * @return string
     */
		public function __toString()
    {
        $fullname = $this->firstname ." ". $this->surname;
		return $fullname;
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Trainer[]|Trainer|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Trainer|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
