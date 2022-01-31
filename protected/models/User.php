<?php

/**
 * This is the model class for table "{{y_user}}".
 *
 * The followings are the available columns in table '{{y_user}}':
 * @property integer $personID
 * @property string $usr_password
 * @property string $loginID
 * @property string $usr_role
 * @property boolean $usr_active
 *
 * The followings are the available model relations:
 * @property JPerson $person
 */
class User extends CActiveRecord
{
    
    
    
        public $per_name;
        public $per_email;
        public $per_bloodGroup;
        public $per_mobile;
    
    
    
        public $departmentID;
        
       // public $loginID;
        public $dpt_name;
        
        public $usr_password;
        public $usr_newPassword;
        public $confirmPassword;
        
        public $uPersonID;
        public $uLoginID;
        public $u_active;
       
        public $u_password;
        public $u_role;
        public $u_type;
        public $u_name;
        public $u_email;
        public $u_mobile;
        public $u_bloodGroup;
        public $u_dptID;
        public $u_dptCode;
        public $u_dptName;
        public $u_otp; 
        public $u_otpExpire;
        public $u_resetToken;
        public $u_resetTokenExpire; 
	public $u_lastLoginIP;
	public $u_lastLoingMAC;
	public $u_lastLoginAt;
        




        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{y_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                    array('usr_password,usr_newPassword,confirmPassword ', 'length', 'min'=>8),
                    
			array('personID, usr_password, usr_newPassword, loginID, confirmPassword', 'required'),
			array('personID', 'numerical', 'integerOnly'=>true),
			array('usr_password, loginID', 'length', 'max'=>200),
			array('usr_role', 'length', 'max'=>50),
			array('usr_active, usr_opt, usr_optExpire, usr_createdOn, usr_lastLoginAt, usr_resetToken, usr_resetToken, usr_resetTokenExpire, usr_lastLoginIP, usr_lastLoingMAC, usr_loginLog, u_type, u_active', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('personID, loginID, usr_role, usr_active', 'safe', 'on'=>'search'),
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
			'person' => array(self::BELONGS_TO, 'JPerson', 'personID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
                    'loginID'=>'Login ID',
			'personID' => 'User ID',
			'per_name' => 'Name',
			'per_email' => 'Email',
                    'per_bloodGroup' => 'Blood Group',
                    'per_mobile' => 'Mobile',
                    'usr_role'=>'Role',
                    'usr_password'=>'Current Password',
                    'usr_newPassword'=>'New Password',
                    'confirmPassword'=>'Confirm Password',
                    
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

                $criteria->select=array(
                    'concat_ws(\' \',p."per_title",  p."per_firstName", p."per_lastName") as per_name',
                    'p."per_email"',
                    'p."per_mobile"',
                    'p."per_bloodGroup"',
                    'p."ex_per_ref"',
                    'd."departmentID"',
                    'd."dpt_code"',
                    'd."dpt_name"',
                    't.*'
                    );
                
                $criteria->join.=" JOIN {{j_person}} AS p ON p.\"personID\" = t.\"personID\"";
                $criteria->join.=" JOIN {{n_faculty}} AS f ON f.\"facultyID\" = t.\"personID\"";
                $criteria->join.=" JOIN {{b_department}} AS d ON d.\"departmentID\" = f.\"departmentID\"";
                $criteria->order= 'd."departmentID" , p."per_firstName"';

                $criteria->compare('usr_role',$this->usr_role);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

       
       
       public function search6($departmentID, $userType)
	{
		
		$criteria=new CDbCriteria;
                
                if($userType == 0){
                    
                    $criteria->select=array(
                    't."personID"',
                     't."loginID"',
                        'concat( p."per_firstName",\' \', p."per_lastName") as per_name',
                       
                        't.usr_role', 
                        't.usr_active'
                        );
                    $criteria->join .="JOIN {{j_person}} AS p ON p.\"personID\" = t.\"personID\" ";
                    $criteria->join .="JOIN {{m_employee}} AS e ON p.\"personID\" = e.\"employeeID\" ";
                    
                     //$criteria->params=array(':dptCode'=>$deptCode,);
                    $criteria->order="per_name asc";
                    
                   
                }
                else
                {
                    $criteria->select=array(
                    't."personID"',
                     't."loginID"',
                        'concat( p."per_firstName",\' \', p."per_lastName") as per_name',
                      
                        't.usr_role', 
                        't.usr_active'
                        );
                   $criteria->join .="JOIN {{j_person}} AS p ON p.\"personID\" = t.\"personID\" ";
                    $criteria->join .="JOIN {{n_faculty}} AS e ON p.\"personID\" = e.\"facultyID\" ";
                    $criteria->condition='e."departmentID" = :departmentID';
                     $criteria->params=array(':departmentID'=>$departmentID,);
                    $criteria->order="per_name asc";
                }
                
                    return new CActiveDataProvider($this, array(
                            'criteria'=>$criteria,'pagination'=>array('pageSize'=>300,)
                    )
                );
                
	}
        
        
        public function actionGetStatusList()
        {
            echo CJSON::encode(Editable::source(Status::model()->findAll(), 'loginID', 'usr_role')); 
        }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
