<?php

/**
 * This is the model class for table "{{aa_fees}}".
 *
 * The followings are the available columns in table '{{aa_fees}}':
 * @property integer $feesID
 * @property integer $fee_term
 * @property integer $fee_year
 * @property string $fee_category
 * @property string $fee_description
 * @property double $fee_amount
 *
 * The followings are the available model relations:
 * @property FBatch[] $tblFBatches
 * @property FBatch[] $fBatches
 */
class Fees extends CActiveRecord
{
    
        public $fee_startTerm;
        public $fee_endTerm;
        public $fee_startYear;
        public $fee_endYear;
        
        public $feesName;
        public $feesTitle;


        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{aa_fees}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fee_startTerm, fee_startYear,fee_endTerm, fee_endYear, fee_category, fee_amount', 'required'),
			array('fee_startTerm, fee_startYear,fee_endTerm, fee_endYear', 'numerical', 'integerOnly'=>true),
			array('fee_amount', 'numerical'),
			array('fee_category', 'length', 'max'=>50),
			array('fee_description', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('feesID, fee_term, fee_year, fee_category, fee_description, fee_amount', 'safe', 'on'=>'search'),
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
			'tblFBatches' => array(self::MANY_MANY, 'FBatch', '{{ac_batchfees}}(feesID, batchName)'),
			'fBatches' => array(self::HAS_MANY, 'FBatch', 'feesID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'feesID' => 'Fees',
			'fee_startTerm' => 'Fee start term',
			'fee_startYear' => 'Fee start year',
                    'fee_endTerm' => 'Fee end term',
			'fee_endYear' => 'Fee end year',
			'fee_category' => 'Fee Category',
			'fee_description' => 'Fee Description',
			'fee_amount' => 'Fee Amount',
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

		$criteria->compare('feesID',$this->feesID);
		
		$criteria->compare('fee_category',$this->fee_category,true);
		$criteria->compare('fee_description',$this->fee_description,true);
		$criteria->compare('fee_amount',$this->fee_amount);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Fees the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
