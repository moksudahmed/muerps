<?php

/**
 * This is the model class for table "{{x_university}}".
 *
 * The followings are the available columns in table '{{x_university}}':
 * @property string $universityCode
 * @property string $uni_name
 * @property string $uni_address
 * @property string $uni_email
 * @property string $uni_webAddress
 * @property integer $uni_currentTerm
 * @property integer $uni_currentYear
 *
 * The followings are the available model relations:
 * @property ASchool[] $aSchools
 */
class University extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
    
        public $uni_admTerm;
        public $uni_admYear;

        public function tableName()
	{
		return '{{x_university}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('universityCode', 'required'),
			array('uni_currentTerm, uni_currentYear,uni_admTerm, uni_admYear', 'numerical', 'integerOnly'=>true),
			array('universityCode', 'length', 'max'=>20),
			array('uni_name, uni_email', 'length', 'max'=>200),
			array('uni_address, uni_webAddress', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('universityCode, uni_name, uni_address, uni_email, uni_webAddress, uni_currentTerm, uni_currentYear', 'safe', 'on'=>'search'),
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
			'aSchools' => array(self::HAS_MANY, 'ASchool', 'universityCode'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'universityCode' => 'University Code',
			'uni_name' => 'Uni Name',
			'uni_address' => 'Uni Address',
			'uni_email' => 'Uni Email',
			'uni_webAddress' => 'Uni Web Address',
			'uni_currentTerm' => 'Uni Current Term',
			'uni_currentYear' => 'Uni Current Year',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('universityCode',$this->universityCode,true);
		$criteria->compare('uni_name',$this->uni_name,true);
		$criteria->compare('uni_address',$this->uni_address,true);
		$criteria->compare('uni_email',$this->uni_email,true);
		$criteria->compare('uni_webAddress',$this->uni_webAddress,true);
		$criteria->compare('uni_currentTerm',$this->uni_currentTerm);
		$criteria->compare('uni_currentYear',$this->uni_currentYear);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return University the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
