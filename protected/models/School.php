<?php

/**
 * -update --ron--14-05-2013-
 * This is the model class for table "{{school}}".
 *
 * The followings are the available columns in table '{{school}}':
 * @property string $sch_code
 * @property string $sch_name
 * @property string $sch_remarks
 * @property integer $sch_dean
 * @property string $sch_deanStatus
 * @property integer $schoolID
 *
 * The followings are the available model relations:
 * @property Department[] $departments
 * @property Faculty $schDean
 */
class School extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return School the static model class
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
		return '{{a_school}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
                        array('sch_code, sch_name', 'required'),
			array('sch_code, sch_name', 'unique'),
			
                        array('sch_code', 'length', 'max'=>10),
			array('sch_name', 'length', 'max'=>100),
                        
                    array('sch_dean', 'numerical', 'integerOnly'=>true),
			array('sch_deanStatus', 'length', 'max'=>14),
			array('sch_remarks', 'safe'),
                    
                        array('sch_deanStatus', 'in', 'range'=>array('Dean', 'Dean in Charge')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('sch_code, sch_name,sch_deanStatus, schoolID', 'safe', 'on'=>'search'),
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
			'departments' => array(self::HAS_MANY, 'Department', 'schoolID'),
			'schDean' => array(self::BELONGS_TO, 'Faculty', 'sch_dean'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sch_code' => 'Code',
			'sch_name' => 'Name',
			'sch_remarks' => 'Remarks',
			'sch_dean' => 'Dean',
			'sch_deanStatus' => 'Dean Status',
			'schoolID' => 'School Id',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('sch_code',$this->sch_code,true);
		$criteria->compare('sch_name',$this->sch_name,true);
                $criteria->compare('sch_remarks',$this->sch_remarks,true);
		$criteria->compare('sch_deanStatus',$this->sch_deanStatus,true);
		
		$criteria->compare('schoolID',$this->schoolID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        //code of abir ...........
        
        public static function SchoolReport()
        {
            $aColumns = array('sch_code','sch_name','sch_remarks');
				
            /* Indexed column (used for fast and accurate table cardinality) */
            $sIndexColumn = 'schooID';
		
            /* DB table to use */
            $sTable = "tbl_a_school";
		
		/* Database connection information */
                $gaSql['user']       = Yii::app()->params['dbuser'];
		$gaSql['password']   = Yii::app()->params['dbpassword'];
		$gaSql['db']         = Yii::app()->params['dbname'];
		$gaSql['server']     = Yii::app()->params['dbsever'];
                $gaSql['port']       =Yii::app()->params['port'];
		
		/* REMOVE THIS LINE (it just includes my SQL connection user/pass) */
		//include( $_SERVER['DOCUMENT_ROOT']."/datatables/mysql.php" );
		
		
		/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
		* no need to edit below this line
		*/
		
		
		/*
		 * MySQL connection
		*/
		if($_SERVER['HTTP_HOST'] != 'localhost'){
                    if ( ! $gaSql['link'] = pgsql_connect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) )
                    {
                        fatal_error( 'Could not open connection to server' );
                    }
                    if ( ! pgsql_select_db( $gaSql['db'], $gaSql['link'] ) )
                    {
			fatal_error( 'Could not select database ' );
                    } 
		}
		/*
		 * Paging
		*/
		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
                    $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".intval( $_GET['iDisplayLength'] );
		}
		/*
		 * Ordering
		*/
		$sOrder = "";
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
							($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
				}
			}
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}
		
		/*
		 * Filtering
		* NOTE this does not match the built-in DataTables filtering which does it
		* word by word on any field. It's possible to do here, but concerned about efficiency
		* on very large tables, and MySQL's regex functionality is very limited
		*/
		$sWhere = "";
		if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
				{
					$sWhere .= "`".$aColumns[$i]."` LIKE '%".pgsql_real_escape_string( $_GET['sSearch'] )."%' OR ";
				}
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		
		/* Individual column filtering */
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
			{
				if ( $sWhere == "" )
				{
					$sWhere = "WHERE ";
				}
				else
				{
					$sWhere .= " AND ";
				}
				$sWhere .= "`".$aColumns[$i]."` LIKE '%".pgsql_real_escape_string($_GET['sSearch_'.$i])."%' ";
			}
		}
		
		/*
		 * SQL queries
		* Get data to display
		*/
		
		
		$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
		";
		//echo $sQuery;exit;
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sQuery);
		$rResult = $command->queryAll();
		/* Data set length after filtering */
		$sQuery = "
		SELECT FOUND_ROWS()
		";
		
		$iFilteredTotal = $count=  self::model()->count();
		/* Total data set length */
		$sQuery = "SELECT COUNT(`".$sIndexColumn."`)FROM   $sTable";
		$count=self::model()->count();
                $iTotal = $count;
		/*
		* Output
                */
		$output = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
			);
			foreach ($rResult as $aRow)
			{
                            $row = array();
                            for ( $i=0 ; $i<count($aColumns) ; $i++ )
                            {
				if ( $aColumns[$i] != ' ')
				{
                                    /* General output */
                                    $row[] = $aRow[ $aColumns[$i] ];
				}
                            }
                            $output['aaData'][] = $row;
			}
				//print_r($output);
			return $output;
		
        }
        
        
}