<?php

/**
 * * -update --ron--13-05-2013-
 * This is the model class for table "{{academichistory}}".
 *
 * The followings are the available columns in table '{{academichistory}}':
 * @property integer $academicHistoryID
 * @property string $ach_degree
 * @property string $ach_group
 * @property string $ach_institution
 * @property string $ach_board
 * @property integer $ach_passingYear
 * @property double $ach_result
 * @property string $ach_remarks
 * @property integer $personID
 *
 * The followings are the available model relations:
 * @property Person $person
 */
class AcademicHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AcademicHistory the static model class
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
		return '{{k_academichistory}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('academicHistoryID, ach_passingYear, personID', 'numerical', 'integerOnly'=>true),
			//array('ach_result', 'numerical'),
			array('ach_degree, ach_institution', 'length', 'max'=>50),
			array('ach_group, ach_board', 'length', 'max'=>100),
                        array('ach_degree, ach_group, ach_institution, ach_board, ach_passingYear, ach_result' , 'required'),
                        array('ach_remarks', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('academicHistoryID, ach_degree, ach_group, ach_institution, ach_board, ach_passingYear, ach_result, personID', 'safe', 'on'=>'search'),
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
			'person' => array(self::BELONGS_TO, 'Person', 'personID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'academicHistoryID' => 'AcademicHistoryID',
			'ach_degree' => 'Degree',
			'ach_group' => 'Group',
			'ach_institution' => 'Institution',
			'ach_board' => 'Board',
			'ach_passingYear' => 'Passing Year',
			'ach_result' => 'Result',
			'ach_remarks' => 'Remarks',
			'personID' => 'PersonID',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($personID)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
                $criteria->condition="t.\"personID\"=:personID";
                $criteria->params=array(':personID'=>$personID);
		$criteria->compare('academicHistoryID',$this->academicHistoryID);
		$criteria->compare('ach_degree',$this->ach_degree,true);
		$criteria->compare('ach_group',$this->ach_group,true);
		$criteria->compare('ach_institution',$this->ach_institution,true);
		$criteria->compare('ach_board',$this->ach_board,true);
		$criteria->compare('ach_passingYear',$this->ach_passingYear);
		$criteria->compare('ach_result',$this->ach_result);
		
		$criteria->compare('personID',$this->personID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
    public static function searchInstitution($type=null)
    {
        if($type =='0')
            $sql ="SELECT DISTINCT ach_institution       
                   FROM tbl_k_academichistory
                   WHERE ach_degree='S.S.C.' OR ach_degree='DAKHIL' OR ach_degree='GCE O-Level'";       
        else if($type =='1')
            $sql ="SELECT DISTINCT ach_institution       
                   FROM tbl_k_academichistory
                   WHERE ach_degree='H.S.C.' OR ach_degree='ALIM' OR ach_degree='GCE A-Level' OR ach_degree='Diploma'";       
        else if($type =='2')
            $sql ="SELECT DISTINCT ach_institution       
                   FROM tbl_k_academichistory
                   WHERE ach_degree='Graduation'";       
        else
            $sql ="SELECT DISTINCT ach_institution       
                   FROM tbl_k_academichistory
                   WHERE ach_degree='Post Graduation'";               
       $list= Yii::app()->db->createCommand($sql)->query();
 
       $rs= array();
       
        foreach($list as $item){
    
           $rs[]=$item['ach_institution'];

        }
       
        return $rs;
    }
        
}