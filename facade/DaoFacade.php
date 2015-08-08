<?php

namespace com\numeracy\facade;

// Util includes
include_once '../util/DbUtil.php';
include_once '../util/CommonUtil.php';

//bo includes

include_once '../bo/M02CategoryBO.php';
include_once '../bo/M03LevelBO.php';
include_once '../bo/M11StatusBO.php';
include_once '../bo/M04ChapterBO.php';

// dao includes
include_once '../dao/M02CategoryDao.php';
include_once '../dao/M03LevelDao.php';
include_once '../dao/M11StatusDao.php';
include_once '../dao/M04ChapterDao.php';
// Util
use com\numeracy\util\DbUtil;
use com\numeracy\util\CommonUtil;

// Category
use com\numeracy\BO\M02CategoryBO;
use com\numeracy\Dao\M02CategoryDao;

// Level
use com\numeracy\BO\M03LevelBO;
use com\numeracy\Dao\M03LevelDao;

// Status
use com\numeracy\BO\M11StatusBO;
use com\numeracy\Dao\M11StatusDao;

// Chapter
use com\numeracy\BO\M04ChapterBO;
use com\numeracy\Dao\M04ChapterDao;

class DaoFacade {
	
	
	/* public function import(MyObject $object)
	{
		foreach (get_object_vars($object) as $key => $value) {
			$this->$key = $value;
		}
	} */
	
	/**
	 * 
	 * @param unknown $data
	 */
	public function createNewCategory($data) {
		$result = false;
		
		
		$obj = new M02CategoryBO ();
		
		$obj->import($data);
		
		$pdo = DbUtil::connect ();
		
		$dao = new M02CategoryDao ( $pdo );
		
		$result = $dao->create ( $obj );
		
		DbUtil::disconnect ();
		
		return $result;
	}
	/**
	 * 
	 * @param unknown $data
	 */
	public function updateCategory($data) {
		$result = false;
		
		$pdo = DbUtil::connect ();
		
		$dao = new M02CategoryDao ( $pdo );
		
		// create new category object
		$obj = new M02CategoryBO ();
		
		// get id from request
		if (property_exists ( $data, 'id' ))
			$obj->setM02categoryid ( $data->id );
			
			// get the persistance obj from db
		$obj = $dao->getById ( $obj );
		
		$obj->import($data);
		
		
		$result = $dao->update ( $obj );
		
		DbUtil::disconnect ();
		
		return $result;
	}
	
	/**
	 * 
	 * @param unknown $data
	 */
	public function deleteCategory($data) {
		$result = false;
		
		$idstr = $data->ids;
		
		$ids = explode ( ",", $idstr );
		
		$pdo = DbUtil::connect ();
		
		$dao = new M02CategoryDao ( $pdo );
		
		$result = $dao->delete ( $ids );
		
		DbUtil::disconnect ();
		
		return $result;
	}
	
	/**
	 * 
	 */
	public function getAllCategory() {
		
		$pdo = DbUtil::connect ();
		
		$dao = new M02CategoryDao ( $pdo );
		
		$objArray = $dao->getAll();
		
		DbUtil::disconnect ();
		
		return  CommonUtil::objArrayToJson ( $objArray );
	}
	
	
	/*****************************************File Operation start*************************************************************/
	
	
	/*****************************************File Operation  end *************************************************************/
	
	
	/*****************************************level Operation start*************************************************************/
	
	
	/**
	 *
	 * @param unknown $data
	 */
	public function createNewLevel($data) {
		$result = false;
	
	
		$obj = new M03LevelBO();
	
		$obj->import($data);
	
		$pdo = DbUtil::connect ();
	
		$dao = new M03LevelDao( $pdo );
	
		$result = $dao->create ( $obj );
	
		DbUtil::disconnect ();
	
		return $result;
	}
	/**
	 *
	 * @param unknown $data
	 */
	public function updateLevel($data) {
		$result = false;
	
		$pdo = DbUtil::connect ();
	
		$dao = new M03LevelDao ( $pdo );
	
		// create new category object
		$obj = new M03LevelBO();
	
		// get id from request
		if (property_exists ( $data, 'id' ))
			$obj->setM03levelid( $data->id );
			
		// get the persistance obj from db
		$obj = $dao->getById ( $obj );
	
		$obj->import($data);
	
	
		$result = $dao->update ( $obj );
	
		DbUtil::disconnect ();
	
		return $result;
	}
	
	/**
	 *
	 * @param unknown $data
	 */
	public function deleteLevel($data) {
		$result = false;
	
		$idstr = $data->ids;
	
		$ids = explode ( ",", $idstr );
	
		$pdo = DbUtil::connect ();
	
		$dao = new M03LevelDao ( $pdo );
	
		$result = $dao->delete ( $ids );
	
		DbUtil::disconnect ();
	
		return $result;
	}
	
	/**
	 *
	 */
	public function getAllLevel() {
	
		$pdo = DbUtil::connect ();
	
		$dao = new M03LevelDao ( $pdo );
	
		$objArray = $dao->getAll();
	
		DbUtil::disconnect ();
	
		return  CommonUtil::objArrayToJson ( $objArray );
	}
	
	
	/*****************************************level Operation  end *************************************************************/
	
	
	/*****************************************Chapter Operation start*************************************************************/
	
	
	/**
	 *
	 * @param unknown $data
	 */
	public function createNewChapter($data) {
		$result = false;
	
	
		$obj = new M04ChapterBO();
	
		$obj->import($data);
	
		$pdo = DbUtil::connect ();
	
		$dao = new M04ChapterDao( $pdo );
	
		$result = $dao->create ( $obj );
	
		DbUtil::disconnect ();
	
		return $result;
	}
	/**
	 *
	 * @param unknown $data
	 */
	public function updateChapter($data) {
		$result = false;
	
		$pdo = DbUtil::connect ();
	
		$dao = new M04ChapterDao( $pdo );
	
		// create new category object
		$obj = new M04ChapterBO();
	
		// get id from request
		if (property_exists ( $data, 'id' ))
			$obj->setM04chapterid( $data->id );
			
		// get the persistance obj from db
		$obj = $dao->getById ( $obj );
	
		$obj->import($data);
	
	
		$result = $dao->update ( $obj );
	
		DbUtil::disconnect ();
	
		return $result;
	}
	
	/**
	 *
	 * @param unknown $data
	 */
	public function deleteChapter($data) {
		$result = false;
	
		$idstr = $data->ids;
	
		$ids = explode ( ",", $idstr );
	
		$pdo = DbUtil::connect ();
	
		$dao = new M04ChapterDao( $pdo );
	
		$result = $dao->delete ( $ids );
	
		DbUtil::disconnect ();
	
		return $result;
	}
	
	/**
	 *
	 */
	public function getAllChapter() {
	
		$pdo = DbUtil::connect ();
	
		$dao = new M04ChapterDao( $pdo );
	
		$objArray = $dao->getAll();
	
		DbUtil::disconnect ();
	
		return  CommonUtil::objArrayToJson ( $objArray );
	}
	
	
	/*****************************************Chapter Operation  end *************************************************************/
	
	
	
	/*****************************************status Operation start*************************************************************/
	
	public function getAllStatus() {
	
		$pdo = DbUtil::connect ();
	
		$dao = new M11StatusDao( $pdo );
	
		$objArray = $dao->getAll();
	
		DbUtil::disconnect ();
	
		return  CommonUtil::objArrayToJson ( $objArray );
	}
	
	/*****************************************status Operation end*************************************************************/
	
}

?>