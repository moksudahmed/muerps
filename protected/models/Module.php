<?php
/**
 * This is the model class for table "{{module}}".
 *
 * The followings are the available columns in table '{{module}}':
 * @property string $moduleCode
 * @property integer $syllabusCode
 * @property string $mod_name
 * @property string $mod_shortName
 * @property double $mod_creditHour
 * @property string $mod_type
 * @property string $mod_labIncluded
 * @property string $mod_mejor
 * @property string $mod_group
 * @property integer $mod_sequence
 *
 * The followings are the available model relations:
 * @property Syllabus $syllabus
 * @property Offeredmodule[] $offeredmodules
 */
class Module extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Module the static model class
	 */
        
      //  public static $flag2;
        
      public $facultyID;

      public static function model($className=__CLASS__)
	{
            
                
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{e_module}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules($rules = array())
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
                 
                return array(
                    
			array('mod_sequence', 'numerical', 'integerOnly'=>true),
                   
                        array('moduleCode+syllabusCode', 'application.extensions.uniqueMultiColumnValidator'),

//                    array('moduleCode, mod_name, mod_shortName,mod_sequence, mod_creditHour,  mod_labIncluded, mod_type, mod_mejor','required'),
                        array('moduleCode, mod_name, mod_creditHour,  mod_labIncluded, mod_type, mod_mejor','required'),
                        array('moduleCode, mod_prerequisite', 'length', 'max'=>10),
			array('mod_name', 'length', 'max'=>200),
			//array('mod_type, mod_labIncluded, mod_mejor', 'length', 'max'=>1),
			
                        //array('mod_type', 'in', 'range'=>array('0', '1')),
                        //array('mod_creditHour', 'in', 'range'=>array('1', '1.5', '2', '2.5', '3', '3.5', '4')),
                        //array('mod_labIncluded', 'in', 'range'=>array('0', '1')),
                        //array('mod_mejor', 'in', 'range'=>array('0', '1')),
                    
                        array('mod_group', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('moduleCode, syllabusCode, mod_name, mod_shortName, mod_creditHour, mod_type, mod_labIncluded, mod_mejor, mod_group, mod_sequence', 'safe', 'on'=>'search'),
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
			'syllabus' => array(self::BELONGS_TO, 'Syllabus', 'syllabusCode'),
			'offeredmodules' => array(self::HAS_MANY, 'Offeredmodule', 'moduleCode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'moduleCode' => 'Course Code',
			'syllabusCode' => 'Syllabus Code',
			'mod_name' => 'Name',
			'mod_shortName' => 'Short Name',
			'mod_creditHour' => 'Credit',
			'mod_type' => 'Type',
			'mod_labIncluded' => 'Lab Included',
			'mod_mejor' => 'Mejor',
			'mod_group' => 'Group',
			'mod_sequence' => 'Sequence',
                        'mod_prerequisite' => 'Prerequisite',
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
                $criteria->condition="\"syllabusCode\"='{$id}'";
		/*$criteria->compare('moduleCode',$this->moduleCode,true);
		$criteria->compare('syllabusCode',$this->syllabusCode);
		$criteria->compare('mod_name',$this->mod_name,true);
		$criteria->compare('mod_shortName',$this->mod_shortName,true);
		//$criteria->compare('mod_creditHour',$this->mod_creditHour);
		$criteria->compare('mod_type',$this->mod_type,true);
		$criteria->compare('mod_labIncluded',$this->mod_labIncluded,true);
		$criteria->compare('mod_mejor',$this->mod_mejor,true);
		$criteria->compare('mod_group',$this->mod_group,true);
		$criteria->compare('mod_sequence',$this->mod_sequence);*/
                $criteria->order="mod_group,mod_sequence";                
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>100,)
		));
	}
}