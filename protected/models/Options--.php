<?php

/**
 * This is the model class for table "{{ad_options}}".
 *
 * The followings are the available columns in table '{{ad_options}}':
 * @property integer $option_id
 * @property string $option_name
 * @property string $option_value
 * @property boolean $auto_load
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
			array('option_name', 'length', 'max'=>200),
			array('option_value, auto_load', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('option_id, option_name, option_value, auto_load', 'safe', 'on'=>'search'),
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
			'option_id' => 'Option',
			'option_name' => 'Option Name',
			'option_value' => 'Option Value',
			'auto_load' => 'Auto Load',
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

		$criteria->compare('option_id',$this->option_id);
		$criteria->compare('option_name',$this->option_name,true);
		$criteria->compare('option_value',$this->option_value,true);
		$criteria->compare('auto_load',$this->auto_load);

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
            
            return $res[0];
        }
        
        public function getControllerOptions($option, $rule=null){           
            echo var_dump($option); 
            $sql = "SELECT DISTINCT  \"option_value\"
                      FROM 
                     tbl_ad_options
                     WHERE 
                    \"option_name\" = '{$option}'";
                       
            $rows = Yii::app()->db->createCommand($sql)->queryAll();            
            
            $res = array_filter(explode(":", $rows[0]["option_value"]));
            //echo $res[0]; exit();
            if(count($res)>0){self::getControllerOptions($res[0]);}
            //echo var_dump($res); 
            exit();
            return $res;
        }
        
        public function getOptionGroupWise($group = null){
            
            
             if($group)
                $sql="SELECT * FROM  tbl_ad_options WHERE option_group='{$group}' ORDER BY option_id"; 
             else
                 $sql="SELECT * FROM  tbl_ad_options ORDER BY option_id"; 
                 
             $optionData = Yii::app()->db->createCommand($sql)->queryAll();
             
             $rawData = Yii::app()->db->createCommand($sql); //or use ->queryAll(); in CArrayDataProvider
             $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM (' . $sql . ') as count_alias')->queryScalar(); //the count
             
             return new CSqlDataProvider($sql, array( //or $model=new CArrayDataProvider($rawData, array(... //using with querAll...
                            'id' => 'option_id',
                            'keyField' => 'option_id', 
                            'totalItemCount' => $count,

                            //if the command above use PDO parameters
                            //'params'=>array(
                            //':param'=>$param,
                            //),


                            'sort' => array(
                                'attributes' => array(
                                    'option_id','option_name'
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
