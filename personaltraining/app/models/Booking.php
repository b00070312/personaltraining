<?php

class Booking extends \Phalcon\Mvc\Model
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
     * @Column(column="bookingdate", type="string", nullable=true)
     */
    protected $bookingdate;

    /**
     *
     * @var string
     * @Column(column="starttime", type="string", nullable=true)
     */
    protected $starttime;

    /**
     *
     * @var string
     * @Column(column="endtime", type="string", nullable=true)
     */
    protected $endtime;

    /**
     *
     * @var integer
     * @Column(column="memberid", type="integer", length=11, nullable=true)
     */
    protected $memberid;

    /**
     *
     * @var integer
     * @Column(column="trainerid", type="integer", length=11, nullable=true)
     */
    protected $trainerid;

    /**
     *
     * @var double
     * @Column(column="fee", type="double", length=18, nullable=true)
     */
    protected $fee;

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
     * Method to set the value of field bookingdate
     *
     * @param string $bookingdate
     * @return $this
     */
    public function setBookingdate($bookingdate)
    {
        $this->bookingdate = $bookingdate;

        return $this;
    }

    /**
     * Method to set the value of field starttime
     *
     * @param string $starttime
     * @return $this
     */
    public function setStarttime($starttime)
    {
        $this->starttime = $starttime;

        return $this;
    }

    /**
     * Method to set the value of field endtime
     *
     * @param string $endtime
     * @return $this
     */
    public function setEndtime($endtime)
    {
        $this->endtime = $endtime;

        return $this;
    }

    /**
     * Method to set the value of field memberid
     *
     * @param integer $memberid
     * @return $this
     */
    public function setMemberid($memberid)
    {
        $this->memberid = $memberid;

        return $this;
    }

    /**
     * Method to set the value of field trainerid
     *
     * @param integer $trainerid
     * @return $this
     */
    public function setTrainerid($trainerid)
    {
        $this->trainerid = $trainerid;

        return $this;
    }

    /**
     * Method to set the value of field fee
     *
     * @param double $fee
     * @return $this
     */
    public function setFee($fee)
    {
        $this->fee = $fee;

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
     * Returns the value of field bookingdate
     *
     * @return string
     */
    public function getBookingdate()
    {
        return $this->bookingdate;
    }

    /**
     * Returns the value of field starttime
     *
     * @return string
     */
    public function getStarttime()
    {
        return $this->starttime;
    }

    /**
     * Returns the value of field endtime
     *
     * @return string
     */
    public function getEndtime()
    {
        return $this->endtime;
    }

    /**
     * Returns the value of field memberid
     *
     * @return integer
     */
    public function getMemberid()
    {
        return $this->memberid;
    }

    /**
     * Returns the value of field trainerid
     *
     * @return integer
     */
    public function getTrainerid()
    {
        return $this->trainerid;
    }

    /**
     * Returns the value of field fee
     *
     * @return double
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("personaltraining");
        $this->setSource("booking");
        $this->belongsTo('memberid', '\Member', 'id', ['alias' => 'Member']);
        $this->belongsTo('trainerid', '\Trainer', 'id', ['alias' => 'Trainer']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'booking';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Booking[]|Booking|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Booking|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
