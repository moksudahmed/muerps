<?php

/**
 * This is the model class for table "{{department}}".
 * * -update --ron--14-05-2013-
 * The followings are the available columns in table '{{department}}':
 * @property string $dpt_code
 * @property string $dpt_name
 * @property string $dpt_location
 * @property string $dpt_contactNo
 * @property string $dpt_email
 * @property string $dpt_remarks
 * @property integer $dpt_head
 * @property string $dpt_headStatus
 * @property integer $departmentID
 * @property integer $schoolID
 *
 * The followings are the available model relations:
 * @property Faculty $dptHead
 * @property School $school
 * @property Faculty[] $faculties
 * @property Programme[] $programmes
 */
class Department extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Department the static model class
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
		return '{{b_department}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
                        array('dpt_head, schoolID, dpt_contactNo', 'numerical', 'integerOnly'=>true),
                    
			array('dpt_code', 'length', 'max'=>10),
                        array('dpt_code, dpt_name', 'unique', ),
			array('dpt_name, dpt_email', 'length', 'max'=>100),
			array('dpt_location', 'length', 'max'=>350),
			array('dpt_contactNo', 'length', 'max'=>15),
			array('dpt_headStatus', 'length', 'max'=>14),
			array('dpt_remarks, dpt_location', 'safe'),
                    
                        array('dpt_code, dpt_name', 'required'),
                        array('dpt_code, dpt_name', 'unique'),
                        array('dpt_headStatus', 'in', 'range'=>array('Head', 'Head in Charge')),
                        array('dpt_email', 'email'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('dpt_code, dpt_name, departmentID, schoolID', 'safe', 'on'=>'search'),
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
			'dptHead' => array(self::BELONGS_TO, 'Faculty', 'dpt_head'),
			'school' => array(self::BELONGS_TO, 'School', 'schoolID'),
			'faculties' => array(self::HAS_MANY, 'Faculty', 'departmentID'),
			'programmes' => array(self::HAS_MANY, 'Programme', 'departmentID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dpt_code' => 'Code',
			'dpt_name' => 'Name',
			'dpt_location' => 'Location',
			'dpt_contactNo' => 'Contact No',
			'dpt_email' => 'Email',
			'dpt_remarks' => 'Remarks',
			'dpt_head' => 'Head',
			'dpt_headStatus' => 'Head Status',
			'departmentID' => 'DepartmentID',
			'schoolID' => 'SchoolID',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->condition="\"schoolID\"={$id}";
                
		$criteria->compare('dpt_code',$this->dpt_code,true);
		$criteria->compare('dpt_name',$this->dpt_name,true);
		
		$criteria->compare('departmentID',$this->departmentID);
		$criteria->compare('schoolID',$this->schoolID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public static function getDepartment($controller,$view)
        {
            $dpt=  array();
           /* $data2 = array(
            'Student Informatoin'=>$controller->renderPartial('_list',null,true,true),
            'Readmission'=>'content for panel 2',
            // panel 3 contains the content rendered by a partial view
            //'panel 3'=>$this->renderPartial('_form_1',null,true),
            'Batch Transfer'=>array('panel 4.1'=>'content for panel 4.1','panel 4.2'=>'content for panel 4.2',)    
            );*/
        
            
            
            
            foreach (Department::model()->findAll() as $key) {
                $dpt[$key->dpt_name]=$controller->renderPartial($view,array('departmentID'=>$key->departmentID,'dpt_code'=>$key->dpt_code),true,true);
               //echo $key->dpt_code; 
            
            }
            
            
            return $dpt;    
        } 
}