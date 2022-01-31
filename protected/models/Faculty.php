<?php


/**
 * This is the model class for table "{{faculty}}".
 * * -update --ron--13-05-2013-
 * The followings are the available columns in table '{{faculty}}':
 * @property integer $facultyID
 * @property string $fac_designation
 * @property string $fac_position
 * @property string $fac_joining
 * @property string $fac_leave
 * @property string $fac_loginName
 * @property string $fac_password
 * @property string $fac_accessLevel
 * @property integer $departmentID
 *
 * The followings are the available model relations:
 * @property Batch[] $batches
 * @property Department[] $departments
 * @property Person $faculty
 * @property Department $department
 * @property Moduleregistration[] $moduleregistrations
 * @property Offeredmodule[] $offeredmodules
 * @property School[] $schools
 */
class Faculty extends CActiveRecord
{
    
    
    public $personID;
        public $per_name;
        public $per_title;
        public $per_firstName;
        public $per_lastName;
        public $per_gender;
        public $per_dateofBirth;
        public $per_bloodGroup;
        public $per_nationality;
        public $per_fathersName;
        public $per_mothersName;
 
        public $per_parmanentAddress;
        public $per_postCode;
        public $per_telephone;
        public $per_mobile;
        public $per_email;
        public $per_presentAddress;
        public $per_maritulStatus;
        public $per_spouseName;
        public $per_personalStatment;
        public $per_criminalConviction;
        public $per_convictionDetails;
        public $ex_per_image;
        public $dpt_code;
		
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Faculty the static model class
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
		return '{{n_faculty}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('facultyID, departmentID', 'numerical', 'integerOnly'=>true),
                    
			array('fac_designation', 'length', 'max'=>100),
			array('fac_position', 'length', 'max'=>100),
			array('fac_loginName', 'length', 'max'=>50),
			
			array('fac_accessLevel', 'length', 'max'=>1),
			
                        //array('fac_joining, fac_leave', 'length', 'max'=>10),
                        array(' departmentID, fac_joining', 'required'),
                        //array('fac_accessLevel', 'in', 'range'=>array('0','1','2','3')),
                        //array('fac_designation', 'in', 'range'=>array('Teachers Assistant','Lecturer','Senior Lecturer','Assistant Professor','Associate Professor','Professor')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('facultyID, fac_designation, fac_position, fac_joining, fac_loginName, fac_accessLevel, departmentID', 'safe', 'on'=>'search'),
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
			'batches' => array(self::HAS_MANY, 'Batch', 'bat_advisor'),
			'departments' => array(self::HAS_MANY, 'Department', 'dpt_head'),
			'faculty' => array(self::BELONGS_TO, 'Person', 'facultyID'),
			'department' => array(self::BELONGS_TO, 'Department', 'departmentID'),
			'moduleregistrations' => array(self::HAS_MANY, 'Moduleregistration', 'facultyID'),
			'offeredmodules' => array(self::HAS_MANY, 'Offeredmodule', 'facultyID'),
			'schools' => array(self::HAS_MANY, 'School', 'sch_dean'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'facultyID' => 'FacultyID',
			'fac_designation' => 'Designation',
			'fac_position' => 'Position',
			'fac_joining' => 'Joining',
			'fac_leave' => 'Leave',
			'fac_loginName' => 'Login Name',
			'fac_password' => 'Password',
			'fac_accessLevel' => 'Access Level',
			'departmentID' => 'DepartmentID',
                        'per_title' => 'Title',
                        'per_firstName' => 'First Name',
                        'per_lastName' => 'Last Name',
                        'per_bloodGroup' => 'Blood Group',
                        'per_mobile' => 'Mobile',
                        'per_email' => 'Email',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($dptId)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->select=array(
                    't.*', 
                    'p."personID"',
                    //'p.*',
                    'concat_ws(\' \',p."per_title",  p."per_firstName", p."per_lastName") as per_name',
                    'p."per_title"',
                    'p."per_firstName"',
                    'p."per_lastName"',
                    'p."per_gender"',
                    'p."per_bloodGroup"',
                    'p."per_firstName"',
                    'p."per_mobile"',
                    'p."per_email"',
                    'p."ex_per_image"'
            );
              
                
                $criteria->join.=" JOIN {{j_person}} AS p ON p.\"personID\" = t.\"facultyID\"";
                $criteria->condition="t.\"departmentID\"=:dptId and t.ex_fac_active='1'";
                $criteria->params=array(':dptId'=>$dptId);
                $criteria->order= "p.\"per_firstName\"";
        
                
		$criteria->compare('facultyID',$this->facultyID);
                
		$criteria->compare('fac_designation',$this->fac_designation,true);
		
		$criteria->compare('fac_joining',$this->fac_joining,true);
		
		$criteria->compare('fac_loginName',$this->fac_loginName,true);
		
		$criteria->compare('fac_accessLevel',$this->fac_accessLevel,true);
		
                $criteria->compare('departmentID',$this->departmentID);

                $criteria->compare('per_email',$this->per_email,true);
                $criteria->compare('per_firstName',$this->per_firstName,true);
                $criteria->compare('per_lastName',$this->per_lastName,true);
                $criteria->compare('per_title',$this->per_title,true);
                $criteria->compare('per_bloodGroup',$this->per_bloodGroup,true);
                $criteria->compare('per_mobile',$this->per_mobile,true);
                $criteria->compare('per_name',$this->per_name,true);
                
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public static function courseTakenByFaculty($proCode,$term, $year)
        {
            $sql = "SELECT per_name as id, fac_designation, 
                   \"programmeCode\", \"batchName\",\"sectionName\", ofm_term, ofm_year, publish_result, 
                   \"moduleCode\", mod_name, \"mod_creditHour\"
                      FROM vw_course_taken_by_faculty
                    WHERE
                    ofm_term={$term} AND ofm_year={$year} AND
                    \"programmeCode\" ='{$proCode}'                   
                    ";
             return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    //'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                              'batchName','ofm_term', 'ofm_year',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));
        }
}