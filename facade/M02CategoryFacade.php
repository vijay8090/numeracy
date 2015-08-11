<?php
namespace com\numeracy\facade; 
    include_once '../util/DbUtil.php';
    include_once '../util/CommonUtil.php';
    //bo includes
    include_once '../bo/M02CategoryBO.php';

    // dao includes
    include_once '../dao/M02CategoryDao.php';

    // Util
    use com\numeracy\util\DbUtil;
    use com\numeracy\util\CommonUtil;

    use com\numeracy\BO\M02CategoryBO;
    use com\numeracy\Dao\M02CategoryDao;
class M02CategoryFacade {

public function create($data) {
    $result = false;
    $obj = new M02CategoryBO ();
    $obj->import($data);
    $pdo = DbUtil::connect ();
    $dao = new M02CategoryDao ( $pdo );
    $result = $dao->create ( $obj );
    DbUtil::disconnect ();
    
    return $result;
    }

public function update($data) {
    $result = false;
    $pdo = DbUtil::connect ();
    $dao = new M02CategoryDao ( $pdo );
    // create new category object
    $obj = new M02CategoryBO ();
    // get id from request
    if (property_exists ( $data, 'id' ))
    $obj->setM02Categoryid ( $data->id );
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
    $dao = new M02CategoryDao ( $pdo );
    $result = $dao->delete ( $ids );
    DbUtil::disconnect ();
    return $result;
    }

public function getAll() {
    $pdo = DbUtil::connect ();
    $dao = new M02CategoryDao ( $pdo );
    $objArray = $dao->getAll();
    DbUtil::disconnect ();
    return CommonUtil::objArrayToJson ( $objArray );
    }
}
?>