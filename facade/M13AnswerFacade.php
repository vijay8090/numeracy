<?php
namespace com\numeracy\facade; 
    include_once '../util/DbUtil.php';
    include_once '../util/CommonUtil.php';
    //bo includes
    include_once '../bo/M13AnswerBO.php';

    // dao includes
    include_once '../dao/M13AnswerDao.php';

    // Util
    use com\numeracy\util\DbUtil;
    use com\numeracy\util\CommonUtil;

    use com\numeracy\BO\M13AnswerBO;
    use com\numeracy\Dao\M13AnswerDao;
class M13AnswerFacade {

public function create($data) {
    $result = false;
    $obj = new M13AnswerBO ();
    $obj->import($data);
    $pdo = DbUtil::connect ();
    $dao = new M13AnswerDao ( $pdo );
    $result = $dao->create ( $obj );
    DbUtil::disconnect ();
    
    return $result;
    }

public function update($data) {
    $result = false;
    $pdo = DbUtil::connect ();
    $dao = new M13AnswerDao ( $pdo );
    // create new category object
    $obj = new M13AnswerBO ();
    // get id from request
    if (property_exists ( $data, 'id' ))
    $obj->setM13Answerid ( $data->id );
    // get the persistance obj from db
    $obj = $dao->getById ( $obj );
    $obj->import($data);
    $result = $dao->update ( $obj );
    DbUtil::disconnect ();
    return $result;
}

public function delete($data) {
    $result = false;
    $idstr = $data->ids;
    $ids = explode ( ",", $idstr );
    $pdo = DbUtil::connect ();
    $dao = new M13AnswerDao ( $pdo );
    $result = $dao->delete ( $ids );
    DbUtil::disconnect ();
    return $result;
    }

public function getAll() {
    $pdo = DbUtil::connect ();
    $dao = new M13AnswerDao ( $pdo );
    $objArray = $dao->getAll();
    DbUtil::disconnect ();
    return CommonUtil::objArrayToJson ( $objArray );
    }
}
?>