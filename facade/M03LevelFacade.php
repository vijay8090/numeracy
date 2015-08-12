<?php
namespace com\numeracy\facade; 
    include_once '../util/DbUtil.php';
    include_once '../util/CommonUtil.php';
    //bo includes
    include_once '../bo/M03LevelBO.php';

    // dao includes
    include_once '../dao/M03LevelDao.php';

    // Util
    use com\numeracy\util\DbUtil;
    use com\numeracy\util\CommonUtil;

    use com\numeracy\BO\M03LevelBO;
    use com\numeracy\Dao\M03LevelDao;
class M03LevelFacade {

public function create($data) {
    $result = false;
    $obj = new M03LevelBO ();
    $obj->import($data);
    $pdo = DbUtil::connect ();
    $dao = new M03LevelDao ( $pdo );
    $result = $dao->create ( $obj );
    DbUtil::disconnect ();
    
    return $result;
    }

public function update($data) {
    $result = false;
    $pdo = DbUtil::connect ();
    $dao = new M03LevelDao ( $pdo );
    // create new category object
    $obj = new M03LevelBO ();
    // get id from request
    if (property_exists ( $data, 'id' ))
    $obj->setM03Levelid ( $data->id );
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
    $dao = new M03LevelDao ( $pdo );
    $result = $dao->delete ( $ids );
    DbUtil::disconnect ();
    return $result;
    }

public function getAll() {
    $pdo = DbUtil::connect ();
    $dao = new M03LevelDao ( $pdo );
    $objArray = $dao->getAll();
    DbUtil::disconnect ();
    return CommonUtil::objArrayToJson ( $objArray );
    }
}
?>