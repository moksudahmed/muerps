<?php

/**
 * This is the model class for table "{{h_offeredmodule}}".
 *
 * The followings are the available columns in table '{{h_offeredmodule}}':
 * @property integer $offeredModuleID
 * @property string $moduleCode
 * @property string $syllabusCode
 * @property string $sectionName
 * @property integer $batchName
 * @property string $programmeCode
 * @property integer $facultyID
 * @property integer $ofm_term
 * @property integer $ofm_year
 * @property string $timeSlotCode
 * @property string $roomCode
 *
 * The followings are the available model relations:
 * @property NFaculty $faculty
 * @property EModule $moduleCode0
 * @property EModule $syllabusCode0
 * @property GSection $sectionName0
 * @property GSection $batchName0
 * @property GSection $programmeCode0
 * @property VTimeSlot $timeSlotCode0
 * @property WRoom $roomCode0
 * @property SModuleregistration[] $sModuleregistrations
 */
class Offeredmodule extends CActiveRecord
{
    
        public $per_name;
        public $fac_name;
        public $per_email;
        public $per_mobile;
        public $mod_name;
        public $mod_creditHour;
        public $mod_type;
	public $mod_labIncluded;
        public $mod_group;
        public $mod_prerequisite;
        public $ofm_approval;
        public $ofm_publish;
        public $ofm_maxCapacity;
        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{h_offeredmodule}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('moduleCode, sectionName, batchName, programmeCode, ofm_term, ofm_year', 'required'),
			array('batchName, facultyID, userID, ofm_term, ofm_year, ofm_maxCapacity', 'numerical', 'integerOnly'=>true),
			array('moduleCode,', 'length', 'max'=>30),
			array('syllabusCode', 'length', 'max'=>50),
			array('sectionName, ofm_publish', 'length', 'max'=>1),
			array('programmeCode, ofm_approval', 'length', 'max'=>3),
			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('offeredModuleID,ofm_approval, moduleCode, syllabusCode, sectionName, batchName, programmeCode, facultyID, userID, ofm_term, ofm_year, timeSlotCode, roomCode', 'safe', 'on'=>'search'),
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
			'faculty' => array(self::BELONGS_TO, 'NFaculty', 'facultyID'),
			'moduleCode0' => array(self::BELONGS_TO, 'EModule', 'moduleCode'),
			'syllabusCode0' => array(self::BELONGS_TO, 'EModule', 'syllabusCode'),
			'sectionName0' => array(self::BELONGS_TO, 'GSection', 'sectionName'),
			'batchName0' => array(self::BELONGS_TO, 'GSection', 'batchName'),
			'programmeCode0' => array(self::BELONGS_TO, 'GSection', 'programmeCode'),
			
			'sModuleregistrations' => array(self::HAS_MANY, 'SModuleregistration', 'offeredModuleID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'offeredModuleID' => 'Offered Module',
			'moduleCode' => 'Module Code',
			'syllabusCode' => 'Syllabus Code',
			'sectionName' => 'Section Name',
			'batchName' => 'Batch Name',
			'programmeCode' => 'Programme Code',
			'facultyID' => 'Faculty',
			'ofm_term' => 'Ofm Term',
			'ofm_year' => 'Ofm Year',
                        'ofm_approval'=>'Publish'
			
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
	 public function search($sylCode,$proCode,$batName,$secName)
	{
                    $sqlCount = "SELECT DISTINCT count(s.\"moduleCode\") "
                    ."FROM (Select * from {{e_module}} where \"syllabusCode\"='{$sylCode}') as s "
                    ." WHERE (\"moduleCode\") NOT IN"
                    ."(SELECT \"moduleCode\" FROM {{h_offeredModule}} where \"programmeCode\"='{$proCode}' and \"batchName\"={$batName} and \"sectionName\"='{$secName}')";
                
                    $sql = "SELECT DISTINCT s.*, s.\"moduleCode\" as ID "
                    ."FROM (Select * from {{e_module}} where \"syllabusCode\"='{$sylCode}' ) as s "
                    ." WHERE (\"moduleCode\") NOT IN"
                    ."(SELECT \"moduleCode\" FROM {{h_offeredModule}} where \"programmeCode\"='{$proCode}' and \"batchName\"={$batName} and \"sectionName\"='{$secName}') order by mod_group, mod_sequence";
            
               
                $count=Yii::app()->db->createCommand($sqlCount)->queryScalar();

                

                return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'mod_name','mod_sequence',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));
        }
        
        
        public function search2($proCode,$batName,$secName,$ofmTerm,$ofmYear)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

                $criteria->select=array(
                'm.*', 
                't.*',
                  
                
                );
              
                $criteria->join=" JOIN {{e_module}} AS m ON m.\"moduleCode\" = t.\"moduleCode\" AND m.\"syllabusCode\"=t.\"syllabusCode\"";
               
                $criteria->condition="t.\"programmeCode\"=:proCode and t.\"batchName\"=:batName and t.\"sectionName\"=:secName and t.ofm_term=:ofmTerm and t.ofm_year=:ofmYear";
                $criteria->params=array(':proCode'=>$proCode,':batName'=>$batName,':secName'=>$secName,':ofmTerm'=>$ofmTerm,':ofmYear'=>$ofmYear);
                $criteria->order="mod_group, mod_sequence";
  
                
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>300,)
		)
                );
                
                
                

	}
        
        public function search3($secName,$batName,$proCode)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
                
		$criteria=new CDbCriteria;

                $criteria->select=array(
                't.*', 
                'm.*',
                'concat (d.dpt_code,\' -- \',p.per_title,\' \', p."per_firstName",\' \', p."per_lastName") as per_name',    
                
                    'f."facultyID"'
                    
                );
              
                $criteria->join=" JOIN {{e_module}} AS m ON m.\"moduleCode\" = t.\"moduleCode\" AND m.\"syllabusCode\"=t.\"syllabusCode\"";
                $criteria->join .="LEFT JOIN {{n_faculty}} AS f ON f.\"facultyID\" = t.\"facultyID\" ";
                $criteria->join .="LEFT JOIN {{b_department}} AS d ON d.\"departmentID\" = f.\"departmentID\" ";
                $criteria->join .="LEFT JOIN {{j_person}} AS p ON p.\"personID\" = t.\"facultyID\" ";
               
               
               
                $criteria->condition="t.\"programmeCode\"='{$proCode}' and t.\"batchName\"={$batName} and t.\"sectionName\"='{$secName}' ";
                //$criteria->params=array(':batName'=>$batName,':secName'=>$secName);

                $criteria->order="t.ofm_year, t.ofm_term, m.mod_group, m.mod_name";
                
		
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>300,)
		)
                );
                
	}
        
        
        public function search4($proCode,$batName,$ofmTerm,$ofmYear)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

                $criteria->select=array(
                'm.*', 
                't.*',
                  
                
                );
              
                $criteria->join=" JOIN {{e_module}} AS m ON m.\"moduleCode\" = t.\"moduleCode\" AND m.\"syllabusCode\"=t.\"syllabusCode\"";
               
                $criteria->condition="t.\"programmeCode\"=:proCode and t.\"batchName\"=:batName and t.ofm_term=:ofmTerm and t.ofm_year=:ofmYear";
                $criteria->params=array(':proCode'=>$proCode,':batName'=>$batName,':ofmTerm'=>$ofmTerm,':ofmYear'=>$ofmYear);
                $criteria->order="\"sectionName\", mod_sequence";
  
                
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,'pagination'=>array('pageSize'=>300,)
		)
                );
                
                
                

	}
        
        
        public function search5($sylCode,$proCode,$batName)
	{
                    $sqlCount = "SELECT DISTINCT count(s.\"moduleCode\") "
                    ."FROM (Select * from {{e_module}} where \"syllabusCode\"='{$sylCode}') as s "
                    ." WHERE (\"moduleCode\") NOT IN"
                    ."(SELECT \"moduleCode\" FROM {{h_offeredModule}} where \"programmeCode\"='{$proCode}' and \"batchName\"={$batName} )";
                
                    $sql = "SELECT DISTINCT s.*, s.\"moduleCode\" as ID "
                    ."FROM (Select * from {{e_module}} where \"syllabusCode\"='{$sylCode}' ) as s "
                    ." WHERE (\"moduleCode\") NOT IN"
                    ."(SELECT \"moduleCode\" FROM {{h_offeredModule}} where \"programmeCode\"='{$proCode}' and \"batchName\"={$batName} ) order by mod_group, mod_sequence";
            
               
                $count=Yii::app()->db->createCommand($sqlCount)->queryScalar();

                

                return new CSqlDataProvider($sql, array(
                    'id'=>'id',
                    'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'mod_name','mod_sequence',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>300,
                    ),
                ));
        }
        
        
        public function search6($proCode,$ofmTerm,$ofmYear)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
                
		$criteria=new CDbCriteria;

                $criteria->select=array(
                't.*', 
                'm.*',
                'concat (p."per_firstName",\' \', p."per_lastName") as per_name',    
                'concat (u."per_firstName",\' \', u."per_lastName") as usr_name',
                    'p.per_email',
                    'p.per_mobile'
                    
                );
              
                $criteria->join=" JOIN {{e_module}} AS m ON m.\"moduleCode\" = t.\"moduleCode\" AND m.\"syllabusCode\"=t.\"syllabusCode\"";
                $criteria->join .="LEFT JOIN {{n_faculty}} AS f ON f.\"facultyID\" = t.\"facultyID\" ";
                //$criteria->join .="LEFT JOIN {{b_department}} AS d ON d.\"departmentID\" = f.\"departmentID\" ";
                $criteria->join .="LEFT JOIN {{j_person}} AS p ON p.\"personID\" = t.\"facultyID\" ";
                 $criteria->join .="LEFT JOIN {{j_person}} AS u ON u.\"personID\" = t.\"userID\" ";
               
               
               
                $criteria->condition="t.\"programmeCode\"=:proCode and t.ofm_term=:ofmTerm and t.ofm_year=:ofmYear ";
                $criteria->params=array(':proCode'=>$proCode,':ofmTerm'=>$ofmTerm,':ofmYear'=>$ofmYear);

                $criteria->order="t.\"batchName\", t.\"sectionName\", m.mod_group, per_name, m.mod_name";
                
		
                
                    return new CActiveDataProvider($this, array(
                            'criteria'=>$criteria,'pagination'=>array('pageSize'=>300,)
                    )
                );
                
	}
        
        public function lockAllResult($ofmTerm=null,$ofmYear=null,$programmeCode=null)
	{
                
         if($ofmTerm !=null && $ofmYear !=null && $programmeCode !=null){
                $sql = "UPDATE public.tbl_h_offeredmodule
                SET ofm_publish=true, ofm_approval=true   
                WHERE  \"ofm_term\" <={$ofmTerm} AND  \"ofm_year\" <={$ofmYear} AND 
                \"programmeCode\"= '{$programmeCode}'";          
         }
         elseif($ofmTerm !=null && $ofmYear !=null){
                $sql = "UPDATE public.tbl_h_offeredmodule
                SET ofm_publish=true, ofm_approval=true   
                WHERE  \"ofm_term\" <={$ofmTerm} AND  \"ofm_year\" <={$ofmYear}";
         }
        else{}
       
            $rows = Yii::app()->db->createCommand($sql)->queryAll();
            return $rows;    
        }

        public function lockResult($ofmTerm=null,$ofmYear=null,$programmeCode=null)
	{
                        
                if($ofmTerm !=null && $ofmYear !=null && $programmeCode !=null){
                        $sql = "UPDATE public.tbl_h_offeredmodule
                        SET ofm_publish=true, ofm_approval=true   
                        WHERE  \"ofm_term\" = {$ofmTerm} AND  \"ofm_year\" = {$ofmYear} AND 
                        \"programmeCode\"= '{$programmeCode}'";          
                }
                elseif($ofmTerm !=null && $ofmYear !=null){
                        $sql = "UPDATE public.tbl_h_offeredmodule
                        SET ofm_publish=true, ofm_approval=true   
                        WHERE  \"ofm_term\" = {$ofmTerm} AND  \"ofm_year\" = {$ofmYear}";
                }
                else{}
               
                $rows = Yii::app()->db->createCommand($sql)->queryAll();
                return $rows;    
        }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Offeredmodule the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
