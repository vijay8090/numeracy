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
include_once '../bo/M05LessonBO.php';
include_once '../bo/M12QuestionBO.php';
include_once '../bo/M13AnswerBO.php';

// dao includes
include_once '../dao/M02CategoryDao.php';
include_once '../dao/M03LevelDao.php';
include_once '../dao/M11StatusDao.php';
include_once '../dao/M04ChapterDao.php';
include_once '../dao/M05LessonDao.php';
include_once '../dao/M12QuestionDao.php';
include_once '../dao/M13AnswerDao.php';

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

// Lesson
use com\numeracy\BO\M05LessonBO;
use com\numeracy\Dao\M05LessonDao;

// Question
use com\numeracy\BO\M12QuestionBO;
use com\numeracy\Dao\M12QuestionDao;

// Answer
use com\numeracy\BO\M13AnswerBO;
use com\numeracy\Dao\M13AnswerDao;

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
	
	
	/*****************************************Lesson Operation start*************************************************************/
	
	
	/**
	 *
	 * @param unknown $data
	 */
	public function createNewLesson($data) {
		$result = false;
	
	
		$obj = new M05LessonBO();
	
		$obj->import($data);
	
		$pdo = DbUtil::connect ();
	
		$dao = new M05LessonDao( $pdo );
	
		$result = $dao->create ( $obj );
	
		DbUtil::disconnect ();
	
		return $result;
	}
	/**
	 *
	 * @param unknown $data
	 */
	public function updateLesson($data) {
		$result = false;
	
		$pdo = DbUtil::connect ();
	
		$dao = new M05LessonDao ( $pdo );
	
		// create new category object
		$obj = new M05LessonBO();
	
		// get id from request
		if (property_exists ( $data, 'id' ))
			$obj->setm05lessonid( $data->id );
			
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
	public function deleteLesson($data) {
		$result = false;
	
		$idstr = $data->ids;
	
		$ids = explode ( ",", $idstr );
	
		$pdo = DbUtil::connect ();
	
		$dao = new M05LessonDao ( $pdo );
	
		$result = $dao->delete ( $ids );
	
		DbUtil::disconnect ();
	
		return $result;
	}
	
	/**
	 *
	 */
	public function getAllLesson() {
	
		$pdo = DbUtil::connect ();
	
		$dao = new M05LessonDao ( $pdo );
	
		$objArray = $dao->getAll();
	
		DbUtil::disconnect ();
	
		return  CommonUtil::objArrayToJson ( $objArray );
	}
	
	
	/*****************************************Lesson Operation  end *************************************************************/
	
	
	/*****************************************Question Operation start*************************************************************/
	
	
	/**
	 *
	 * @param unknown $data
	 */
	public function createNewQuestion($data) {
		$result = false;
	
	
		$obj = new M12QuestionBO();
	
		$obj->import($data);
	
		$pdo = DbUtil::connect ();
	
		$dao = new M12QuestionDao( $pdo );
	
		$result = $dao->create ( $obj );
	
		DbUtil::disconnect ();
	
		return $result;
	}
	/**
	 *
	 * @param unknown $data
	 */
	public function updateQuestion($data) {
		$result = false;
	
		$pdo = DbUtil::connect ();
	
		$dao = new M12QuestionDao ( $pdo );
	
		// create new category object
		$obj = new M12QuestionBO();
	
		// get id from request
		if (property_exists ( $data, 'id' ))
			$obj->setm12questionid( $data->id );
			
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
	public function deleteQuestion($data) {
		$result = false;
	
		$idstr = $data->ids;
	
		$ids = explode ( ",", $idstr );
	
		$pdo = DbUtil::connect ();
	
		$dao = new M12QuestionDao ( $pdo );
	
		$result = $dao->delete ( $ids );
	
		DbUtil::disconnect ();
	
		return $result;
	}
	
	/**
	 *
	 */
	public function getAllQuestion() {
	
		$pdo = DbUtil::connect ();
	
		$dao = new M12QuestionDao ( $pdo );
	
		$objArray = $dao->getAll();
	
		DbUtil::disconnect ();
	
		return  CommonUtil::objArrayToJson ( $objArray );
	}
	
	
	/*****************************************Question Operation  end *************************************************************/
	
	
	/*****************************************Answer Operation start*************************************************************/
	
	
	/**
	 *
	 * @param unknown $data
	 */
	public function createNewAnswer($data) {
		$result = false;
	
	
		$obj = new M13AnswerBO();
	
		$obj->import($data);
	
		$pdo = DbUtil::connect ();
	
		$dao = new M13AnswerDao( $pdo );
	
		$result = $dao->create ( $obj );
	
		DbUtil::disconnect ();
	
		return $result;
	}
	/**
	 *
	 * @param unknown $data
	 */
	public function updateAnswer($data) {
		$result = false;
	
		$pdo = DbUtil::connect ();
	
		$dao = new M13AnswerDao ( $pdo );
	
		// create new category object
		$obj = new M13AnswerBO();
	
		// get id from request
		if (property_exists ( $data, 'id' ))
			$obj->setm13answerid( $data->id );
			
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
	public function deleteAnswer($data) {
		$result = false;
	
		$idstr = $data->ids;
	
		$ids = explode ( ",", $idstr );
	
		$pdo = DbUtil::connect ();
	
		$dao = new M13AnswerDao ( $pdo );
	
		$result = $dao->delete ( $ids );
	
		DbUtil::disconnect ();
	
		return $result;
	}
	
	/**
	 *
	 */
	public function getAllAnswer() {
	
		$pdo = DbUtil::connect ();
	
		$dao = new M13AnswerDao ( $pdo );
	
		$objArray = $dao->getAll();
	
		DbUtil::disconnect ();
	
		return  CommonUtil::objArrayToJson ( $objArray );
	}
	
	
	/*****************************************Answer Operation  end *************************************************************/
	
	
	
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