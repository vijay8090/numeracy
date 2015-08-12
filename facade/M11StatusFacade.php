<?php
namespace com\numeracy\facade; 
    include_once '../util/DbUtil.php';
    include_once '../util/CommonUtil.php';
    //bo includes
    include_once '../bo/M11StatusBO.php';

    // dao includes
    include_once '../dao/M11StatusDao.php';

    // Util
    use com\numeracy\util\DbUtil;
    use com\numeracy\util\CommonUtil;

    use com\numeracy\BO\M11StatusBO;
    use com\numeracy\Dao\M11StatusDao;
class M11StatusFacade {

public function create($data) {
    $result = false;
    $obj = new M11StatusBO ();
    $obj->import($data);
    $pdo = DbUtil::connect ();
    $dao = new M11StatusDao ( $pdo );
    $result = $dao->create ( $obj );
    DbUtil::disconnect ();
    
    return $result;
    }

public function update($data) {
    $result = false;
    $pdo = DbUtil::connect ();
    $dao = new M11StatusDao ( $pdo );
    // create new category object
    $obj = new M11StatusBO ();
    // get id from request
    if (property_exists ( $data, 'id' ))
    $obj->setM11Statusid ( $data->id );
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
    $dao = new M11StatusDao ( $pdo );
    $result = $dao->delete ( $ids );
    DbUtil::disconnect ();
    return $result;
    }

public function getAll() {
    $pdo = DbUtil::connect ();
    $dao = new M11StatusDao ( $pdo );
    $objArray = $dao->getAll();
    DbUtil::disconnect ();
    return CommonUtil::objArrayToJson ( $objArray );
    }
}
?>