<?php

/**
 * This is the model class for table "{{ad_options}}".
 *
 * The followings are the available columns in table '{{ad_options}}':
 * @property integer $optionID
 * @property string $option_name
 * @property string $option_value
 * @property boolean $auto_load
 * @property string $option_group
 */
class Options extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{ad_options}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('option_name', 'required'),
			array('option_name, option_group', 'length', 'max'=>200),
			array('option_value, auto_load', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('optionID, option_name, option_value, auto_load, option_group', 'safe', 'on'=>'search'),
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
			'optionID' => 'Option',
			'option_name' => 'Option Name',
			'option_value' => 'Option Value',
			'auto_load' => 'Auto Load',
			'option_group' => 'Option Group',
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

		$criteria->compare('optionID',$this->optionID);
		$criteria->compare('option_name',$this->option_name,true);
		$criteria->compare('option_value',$this->option_value,true);
		$criteria->compare('auto_load',$this->auto_load);
		$criteria->compare('option_group',$this->option_group,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public function getOptions($option, $rule=null){           
           
            $sql = "SELECT DISTINCT  \"option_value\"
                      FROM 
                     tbl_ad_options
                     WHERE 
                    \"option_name\" = '{$option}'";
                       
            $rows = Yii::app()->db->createCommand($sql)->queryAll();   
          
            $res = array_filter(explode(":", $rows[0]["option_value"]));
            if(count($res)>1) return $res;
            
            return $res[0];
        }
        public function getGroupWiseOptions($option, $program=null, $rule=null){           
           
            $sql = "SELECT DISTINCT  \"option_value\"
                      FROM 
                     tbl_ad_options
                     WHERE 
                   
                    \"option_group\" = '{$program}' 
                    ";
                       
            $rows = Yii::app()->db->createCommand($sql)->queryAll();   
          
            $res = array_filter(explode(":", $rows[0]["option_value"]));
            if(count($res)>1) return $res;
            
            return $res[0];
        }
        public function getControllerOptions($option, $rules=null){          
           
            $sql = "SELECT DISTINCT  \"option_value\"
                      FROM 
                     tbl_ad_options
                     WHERE 
                    \"option_name\" = '{$option}'";
            
            $rows = Yii::app()->db->createCommand($sql)->queryAll();  
            $arr = array();
            $j = 0;
            
            $cap = $rows[0]["option_value"];
            
            $arr = array_filter(explode(":", $cap));          
          
            $capabilities = array();
            
            foreach($arr as $k=>$v) {
                if(preg_match("/\b$rules\b/i", $v)) {
                    $capabilities = array_filter(explode(",", $v));                
                }
            }     
            
            $functions = array();
            $functions = array_filter(explode(":", $capabilities[1]));
            $allfunctions = array();
            
            for($i=0; $i<count($functions); $i++){               
            $sql = "SELECT DISTINCT  \"option_value\"
                     FROM 
                     tbl_ad_options
                     WHERE 
                    \"option_name\" = '{$functions[$i]}'";            
            $rows = Yii::app()->db->createCommand($sql)->queryAll();              
            $allfunctions = array_merge($allfunctions,array_filter(explode(":", $rows[0]["option_value"])));
            }
           
            return $allfunctions;
        }
        public function getControllerInterfaceOptions($option, $rules=null){           
           
            $sql = "SELECT DISTINCT  \"option_value\"
                      FROM 
                     tbl_ad_options
                     WHERE 
                    \"option_name\" = '{$option}'";
            
            $rows = Yii::app()->db->createCommand($sql)->queryAll();  
            $arr = array();
            $j = 0;
            
            $cap = $rows[0]["option_value"];
            
            $arr = array_filter(explode(":", $cap));          
          
            $capabilities = array();
            
            foreach($arr as $k=>$v) {
                if(preg_match("/\b$rules\b/i", $v)) {
                    $capabilities = array_filter(explode(",", $v));                
                }
            }     
            
            $functions = array();
            $functions = array_filter(explode(":", $capabilities[1]));
           
            // echo var_dump($functions); exit();
            return $functions;
        }
        public function getOptionGroupWise($group = null){
            
          
             if($group)
                $sql="SELECT * FROM  tbl_ad_options WHERE option_group='{$group}' ORDER BY \"optionID\" "; 
             else
                 $sql="SELECT * FROM  tbl_ad_options ORDER BY optionID"; 
                 
             $optionData = Yii::app()->db->createCommand($sql)->queryAll();
             
             $rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
             $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count
             
             return new CSqlDataProvider($sql, array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
                            'id' => 'optionID',
                            'keyField' => 'optionID', 
                            'totalItemCount' => $count,

                            //if the command above use PDO parameters
                            //'params'=>array(
                            //':param'=>$param,
                            //),


                            'sort' => array(
                                'attributes' => array(
                                    'optionID','option_name'
                                ),
                               /* 'defaultOrder' => array(
                                    'c_moduleCode' => CSort::SORT_ASC, //default sort value
                                ),*/
                          ),
                            'pagination' => array(
                                'pageSize' => 100,
                            ),
                        ));
           
    
        }
        public static function getModuleRegistrationList($programmeCode,$resultTerm,$resultYear,$batchName,$moduleCode){

            $sql= "SELECT   
                      t.\"studentID\", 
                      \"moduleCode\",
                      m.reg_attendence, 
                      m.\"reg_classTest\", 
                      m.reg_midterm,   
                      m.\"moduleRegistrationID\", 
                      m.\"offeredModuleID\", 
                      tbl_u_exammarks.emr_mark
                    FROM 
                      public.tbl_q_termadmission t, 
                      public.tbl_h_offeredmodule o, 
                      public.tbl_s_moduleregistration m, 
                      public.tbl_u_exammarks
                    WHERE 
                      t.\"termAdmissionID\" = m.\"termAdmissionID\" AND
                      m.\"offeredModuleID\" = o.\"offeredModuleID\" AND
                      m.\"moduleRegistrationID\" = tbl_u_exammarks.\"moduleRegistrationID\" AND
                      o.ofm_term = {$resultTerm} AND 
                      o.ofm_year = {$resultYear} AND 
                      o.\"batchName\" = {$batchName} AND 
                      o.\"programmeCode\" = '{$programmeCode}' AND 
                      o.\"moduleCode\" ='{$moduleCode}'
                      ORDER BY t.\"studentID\"";      
         // echo $sql; exit();
           return new  CSqlDataProvider($sql, array(
                    'id'=>'id',
                    //'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'studentID',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
        }
        public static function getTermAdmissionList($studentID){

            $sql= "SELECT \"termAdmissionID\",\"sectionName\", \"batchName\",               
                       tra_term, tra_year, tra_date, \"tra_finalExamRegistred\", 
                      \"tra_finalExamRegDate\"
                  FROM tbl_q_termadmission
                  WHERE \"studentID\"='{$studentID}'";      
         // echo $sql; exit();
           return new  CSqlDataProvider($sql, array(
                    'id'=>'id',
                    //'totalItemCount'=>$count,
                     'sort'=>array(
                        'attributes'=>array(
                             'termAdmissionID',
                        ),
                    ),
                    'pagination'=>array(
                        'pageSize'=>30000,
                    ),
                ));
        }
        public function search6($departmentID, $userType)
        {
            
            $criteria=new CDbCriteria;
                    
                        
                        $criteria->select=array(
                        't."termAdmissionID"',
                         't."sectionName"',
                         't."batchName"',
                         't."batchName"',
                         't.tra_term',
                         't.tra_year',
                         't.tra_date',
                         't."tra_finalExamRegistred"',                         
                         't."tra_finalExamRegDate"'                      
                            );
                        $criteria->join .="JOIN {{j_person}} AS p ON p.\"personID\" = t.\"personID\" ";
                        $criteria->join .="JOIN {{m_employee}} AS e ON p.\"personID\" = e.\"employeeID\" ";
                        
                         //$criteria->params=array(':dptCode'=>$deptCode,);
                        $criteria->order="per_name asc";
                    
                        return new CActiveDataProvider($this, array(
                                'criteria'=>$criteria,'pagination'=>array('pageSize'=>300,)
                        )
                    );
                    
        }
            
            
          
        public static function getTermAdmissionDetailList($tID){

                     $sql="SELECT m.\"moduleRegistrationID\", m.\"offeredModuleID\",o.\"moduleCode\", m.reg_attendence, m.\"reg_classTest\", m.reg_midterm, f.emr_mark, f.emr_absent
                    FROM 
                      public.tbl_s_moduleregistration m, 
                      public.tbl_u_exammarks f, 
                      public.tbl_h_offeredmodule o
                    WHERE 
                      m.\"moduleRegistrationID\" = f.\"moduleRegistrationID\" AND
                      m.\"offeredModuleID\" = o.\"offeredModuleID\" AND
                      m.\"termAdmissionID\" = '{$tID}'";     
                 // echo $sql; exit();
                   return new  CSqlDataProvider($sql, array(
                            'id'=>'id',
                            //'totalItemCount'=>$count,
                             'sort'=>array(
                                'attributes'=>array(
                                     'moduleRegistrationID',
                                ),
                            ),
                            'pagination'=>array(
                                'pageSize'=>30000,
                            ),
                        ));
                }
        /**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Options the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
