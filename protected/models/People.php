<?php

/**
 * This is the model class for table "people".
 *
 * The followings are the available columns in table 'people':
 * @property string $name
 * @property integer $age
 * @property string $gender
 * @property string $house
 * @property string $party
 * @property string $state
 * @property string $constituency
 * @property string $education
 * @property string $educationDetails
 * @property integer $debates
 * @property integer $bills
 * @property integer $questions
 * @property integer $attendance
 * @property string $nature
 * @property string $notes
 * @property string $termStart
 * @property string $termEnd
 * @property integer $viewCount
 */
class People extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return People the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'people';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, age, gender, house, party, state, constituency, education, educationDetails, debates, bills, questions, attendance, nature, notes, termStart, termEnd, viewCount', 'required'),
			array('age, debates, bills, questions, attendance, viewCount', 'numerical', 'integerOnly'=>true),
			array('name, party, state, constituency, termStart, termEnd', 'length', 'max'=>128),
			array('gender', 'length', 'max'=>1),
			array('house', 'length', 'max'=>25),
			array('education, educationDetails', 'length', 'max'=>256),
			array('nature', 'length', 'max'=>12),
			array('notes', 'length', 'max'=>512),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => 'Name',
			'age' => 'Age',
			'gender' => 'Gender',
			'house' => 'House',
			'party' => 'Party',
			'state' => 'State',
			'constituency' => 'Constituency',
			'education' => 'Education',
			'educationDetails' => 'Education Details',
			'debates' => 'Debates',
			'bills' => 'Bills',
			'questions' => 'Questions',
			'attendance' => 'Attendance',
			'nature' => 'Nature',
			'notes' => 'Notes',
			'termStart' => 'Term Start',
			'termEnd' => 'Term End',
			'viewCount' => 'View Count',
		);
	}


    public function search($query)
    {
        $criteria = new CDbCriteria;

        $searchFields = self::model()->getSearchFields();

        if($query != '')
        {
            $queryString = implode("%",explode(" ", $query));
            
            foreach($searchFields as $field)
                $criteria->addCondition("$field Like '%$queryString%'", "OR");
        }

        return $criteria;
    }

    public static function getSearchFields()
    {
        return array('name', 'house', 'state', 'party', 'education', 'educationDetails');;
    }

    public function stats($house = 0, $stat, $order = "ASC")
    {
        $criteria = new CDbCriteria;

        if($house != '' && $house != 0)
            $criteria->addCondition("house = '$house'");

        $criteria->order = "$stat DESC";

        return $criteria;
    }

    public static function populateKeywords()
    {
        $people = self::model()->findAll();
        $keywords = array();
        $fields = self::model()->getSearchFields();

        foreach($people as $p)
            foreach($fields as $f)
                if(strlen($p->$f) <= 20)
                    $keywords[] = $p->$f;

        $keywords = array_unique($keywords);

        foreach($keywords as $word)
        {
            $k = new Keyword();
            $k->keyword = $word;
            $k->save();
        }
    }

    public function getGenderText()
    {
        if($this->gender == "M")
            return "Male";
        else
            return "Female";
    }

    public function getExtraData()
    {
        $fields = self::getSearchFields();
        $result = array();

        foreach($fields as $f)
            $result[$f] = $this->$f;

        return $result;
    }

    public function getPRSLink()
    {
        return "http://www.prsindia.org/mptrack/" . implode("", explode(" ", str_replace(".", "", $this->name)));
    }

    public function getLinks()
    {
        return array(
            array(
                'url' => $this->getPRSLink(),
                'comment' => 'Link to PRS Profile',
            ),
        );
    }
}