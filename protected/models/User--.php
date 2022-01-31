<?php

/**
 * This is the model class for table "{{y_user}}".
 *
 * The followings are the available columns in table '{{y_user}}':
 * @property integer $userID
 * @property string $usr_password
 * @property string $usr_name
 * @property string $usr_title
 * @property string $usr_role
 * @property boolean $usr_active
 *
 * The followings are the available model relations:
 * @property JPerson $user
 */
class User extends CActiveRecord
{
    
     public $per_name;
        public $per_email;
        public $per_bloodGroup;
        public $per_mobile;
        public $usr_role;
        public $test;
        public $usr_active;
        public $departmentID;
        public $fac_loginName;
        public $usr_newPassword;
        public $usr_confirmPassword;
        public $dpt_name;
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
			array('userID', 'numerical', 'integerOnly'=>true),
			
                        array('usr_newPassword , usr_confirmPassword', 'length', 'min'=>8),
                    array('usr_password, usr_role,', 'required'),
			array('usr_name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('usreID, usr_password, usr_name, usr_role', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'JPerson', 'userID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'userID' => 'User ID',
			'per_name' => 'Name',
			'per_email' => 'Email',
                    'per_bloodGroup' => 'Blood Group',
                    'per_mobile' => 'Mobile',
                    'usr_role'=>'Role',
                    'usr_newPassword'=>'New Password',
                    'usr_confirmPassword'=>'Confirm Password'
                    
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
                
                $criteria->join.=" JOIN {{j_person}} AS p ON p.\"personID\" = t.\"userID\"";
                $criteria->join.=" JOIN {{n_faculty}} AS f ON f.\"facultyID\" = t.\"userID\"";
                $criteria->join.=" JOIN {{b_department}} AS d ON d.\"departmentID\" = f.\"departmentID\"";
                $criteria->order= 'd."departmentID" , p."per_firstName"';

                $criteria->compare('usr_role',$this->usr_role);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
