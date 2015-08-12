<?php
namespace com\numeracy\facade; 
    include_once '../util/DbUtil.php';
    include_once '../util/CommonUtil.php';
    //bo includes
    include_once '../bo/M14LoginBO.php';

    // dao includes
    include_once '../dao/M14LoginDao.php';

    // Util
    use com\numeracy\util\DbUtil;
    use com\numeracy\util\CommonUtil;

    use com\numeracy\BO\M14LoginBO;
    use com\numeracy\Dao\M14LoginDao;
class M14LoginFacade {

public function create($data) {
    $result = false;
    $obj = new M14LoginBO ();
    $obj->import($data);
    $pdo = DbUtil::connect ();
    $dao = new M14LoginDao ( $pdo );
    $result = $dao->create ( $obj );
    DbUtil::disconnect ();
    
    return $result;
    }

public function update($data) {
    $result = false;
    $pdo = DbUtil::connect ();
    $dao = new M14LoginDao ( $pdo );
    // create new category object
    $obj = new M14LoginBO ();
    // get id from request
    if (property_exists ( $data, 'id' ))
    $obj->setM14Loginid ( $data->id );
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
    $dao = new M14LoginDao ( $pdo );
    $result = $dao->delete ( $ids );
    DbUtil::disconnect ();
    return $result;
    }

public function getAll() {
    $pdo = DbUtil::connect ();
    $dao = new M14LoginDao ( $pdo );
    $objArray = $dao->getAll();
    DbUtil::disconnect ();
    return CommonUtil::objArrayToJson ( $objArray );
    }
}
?>
