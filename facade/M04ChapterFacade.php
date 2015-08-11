<?php
namespace com\numeracy\facade; 
    include_once '../util/DbUtil.php';
    include_once '../util/CommonUtil.php';
    //bo includes
    include_once '../bo/M04ChapterBO.php';

    // dao includes
    include_once '../dao/M04ChapterDao.php';

    // Util
    use com\numeracy\util\DbUtil;
    use com\numeracy\util\CommonUtil;

    use com\numeracy\BO\M04ChapterBO;
    use com\numeracy\Dao\M04ChapterDao;
class M04ChapterFacade {

public function create($data) {
    $result = false;
    $obj = new M04ChapterBO ();
    $obj->import($data);
    $pdo = DbUtil::connect ();
    $dao = new M04ChapterDao ( $pdo );
    $result = $dao->create ( $obj );
    DbUtil::disconnect ();
    
    return $result;
    }

public function update($data) {
    $result = false;
    $pdo = DbUtil::connect ();
    $dao = new M04ChapterDao ( $pdo );
    // create new category object
    $obj = new M04ChapterBO ();
    // get id from request
    if (property_exists ( $data, 'id' ))
    $obj->setM04Chapterid ( $data->id );
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
    $dao = new M04ChapterDao ( $pdo );
    $result = $dao->delete ( $ids );
    DbUtil::disconnect ();
    return $result;
    }

public function getAll() {
    $pdo = DbUtil::connect ();
    $dao = new M04ChapterDao ( $pdo );
    $objArray = $dao->getAll();
    DbUtil::disconnect ();
    return CommonUtil::objArrayToJson ( $objArray );
    }
}
?>