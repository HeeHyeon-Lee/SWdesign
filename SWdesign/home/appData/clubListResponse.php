<?php
    include "db.php";
    header("Content-Type:application/json;charset=utf-8");

    $s = $_POST;
/////////////////////////////////////////////////////////////////////////////////////////////
    if(!$s){
        echo failed("Servers require post-data");
        exit;
    }

    $keyCheckArr = array();
    foreach($s as $key=>$val){
        array_push($keyCheckArr, $key);
    }

    if(!in_array("start", $keyCheckArr)) $s['start'] = 0;
    if(!in_array("limit", $keyCheckArr)) $s['limit'] = 9;
    if(!in_array("key", $keyCheckArr)) $s['key'] = null;
    if(!in_array("area", $keyCheckArr)) $s['area'] = null;
    if(!in_array("part", $keyCheckArr)) $s['part'] = null;
    if(!in_array("table", $keyCheckArr)){
        echo failed("[table] is necessary for servers.");
        exit;
    }



///////////////////////////////////////////////////////////////////////////////////////////////
    $query = "select c.*, count(m.memberIdx) as memberCnt from `club` as c, `clubmember` as m WHERE c.clubIdx = m.clubIdx";

    /* where절 */
    $where = "";
    $limit = "";
    if($s['key'] != null) $where .= " and (title like '%{$s['key']}%' or contents like '%{$s['key']}%' or description like '%{$s['key']}%')";

    if($s['area'] != null) $where .= " and (addr like '%{$s['area']}%')";

    if($s['part'] != null) $where .= " and (part = '{$s['part']}')";

    if($s['start'] != null && $s['limit'] != null) $limit = " limit {$s['start']}, {$s['limit']}";

    $query .= $where;
    $query .= " group by m.clubIdx";
    $num_res = mysqli_query($con, $query)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $query, mysqli_error($con)));

    $query .= $limit;


    //echo json_encode($query);

//////////////////////////////////////////////////////////////////////////////////////////////////


    $data_res = mysqli_query($con, $query)or die(failed("Something wrong while the server was sending a query to the database. \r\n you have to check the error and the query", $query, mysqli_error($con)));

    $i = 0;
    $returnArr = array();
    while($data = mysqli_fetch_array($data_res)){
        $tempArr = array();
        foreach($data as $key=>$val){
            $tempArr[$key] = $val;
            if(($key == "image" || $key == "8") && ($val==null && $val=="")) $tempArr[$key] = "noImage300by150.jpg";
        }
        $returnArr[$i] = $tempArr;
        $i++;
    }

    echo json_encode(array("num"=>mysqli_num_rows($num_res), "list"=>$returnArr, "success"=>true/*, "query"=>$query*/));

//////////////////////////////////////////////////////////////////////////////

    function failed($msg, $query="", $error=""){
        $arr = array("success"=>false, "message"=>$msg);

        if($error) $arr["error"] = $error;
        if($query) $arr["query"] = $query;
        return json_encode($arr);
    }
?>