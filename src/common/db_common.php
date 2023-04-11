<?php
    function db_conn( &$param_conn ){
        $host     = "localhost"; //host
        $user     = "root"; //user
        $pass     = "root506"; //password
        $db_name  = "board"; //db name
        $charset  = "utf8mb4"; //charset
        $dns      = "mysql:host=".$host.";dbname=".$db_name.";charset=".$charset;
        $pdo_option   = array(
            PDO::ATTR_EMULATE_PREPARES    => false //DB의 prepared statement 기능을 사용하도록 설정
            ,PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION //PDO Exception을 Thorws 하도록 설정
            ,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // 연상배열로 Fetch를 하도록 설정  
        );

        try{
        $param_conn = new PDO( $dns, $user, $pass, $pdo_option );
        }catch( PDOException $e){
            $param_conn = null;  
            throw new PDOException( $e->getMessage() );
        }
    }



    function select_board_info_paging( &$param_arr ){
        $sql =
        " SELECT " 
        ." board_no "
        ." , board_title "
        ." , board_writedate "
        ." FROM board_info "
        ." WHERE " 
        ." board_del_fg='0' "
        ." ORDER  BY " 
        ." board_no ASC "
        ." LIMIT :limit_num OFFSET :offset "
        ;      
        
    $arr_prepare = array(
                    ":limit_num"  => $param_arr["limit_num"]
                    ,":offset"    => $param_arr["offset"]
                    );    

        $conn = null;
        try{
            db_conn( $conn );
            $stmt = $conn->prepare( $sql );
            $stmt->execute( $arr_prepare );
            $result = $stmt->fetchAll();
        }catch( Exception $e ){
            return $e->getMessage();
        }
        finally{
            $conn=null;
        }
        return $result;

    }


    function select_board_info_cnt(){
        $sql =
            " SELECT "
            ."       count(*) cnt "
            ." FROM "
            ."       board_info "
            ." where "
            ."       board_del_fg = '0' "
            ;

            $arr_prepare=array();
            $conn=null;

            try{
                db_conn( $conn );
                $stmt = $conn->prepare( $sql );
                $stmt->execute( $arr_prepare );
                $result = $stmt->fetchAll();
            }catch( Exception $e ){
                return $e->getMessage();
            }
            finally{
                $conn=null;
            }
            return $result;
    }



    /*-------------------------------
    정보 보여주는 함수 작성
    함수명 : select_board_info_no
    기능   : 게시판 특정 게시글 정보 검색
    리턴값 : Array $result
    ----------------------------------*/

    function select_board_info_no(&$param_no){
        $sql =
        " SELECT " 
        ." board_no "
        ." , board_title "
        ." , board_contents "
        ." FROM "
        ."  board_info "
        ." WHERE " 
        ."  board_no = :board_no"
        ;      
        
    $arr_prepare = array(
                    ":board_no" => $param_no
                    );    

        $conn = null;
        try{
            db_conn( $conn );
            $stmt = $conn->prepare( $sql );
            $stmt->execute( $arr_prepare );
            $result = $stmt->fetchAll();
        }catch( Exception $e ){
            return $e->getMessage();
        }
        finally{
            $conn=null;
        }
        return $result[0]; //result는 원래 2차원 배열인데 pk로 가져와서 한개 밖에 필요 없으므로 0 넣어주면 됨. 

    }
    /*-------------------------------
    업데이트 하는 함수 // 영향받은 행이 넘어옴
    함수명 : update_board_info_no
    기능   : 게시판 특정 게시글 정보 검색
    리턴값 : $result_cnt/ERRMSG   INT/STRING
    ----------------------------------*/
    function update_board_info_no(&$param_arr){
        $sql =
        " UPDATE "
        ."  board_info "
        ." SET "
        ."  board_title = :board_title "
        ."  ,board_contents = :board_contents "
        ." WHERE "
        ."  board_no = :board_no "
        ;
    

    $arr_prepare = array(
                        ":board_title" => $param_arr["board_title"]
                        ,":board_contents" => $param_arr["board_contents"]
                        ,":board_no" => $param_arr["board_no"]
                        );
    $conn = null;
    try{
        db_conn( $conn ); // pdo object 셋
        $conn->beginTransaction(); // transaction 시작
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare );
        $result_cnt = $stmt->rowCount();
        $conn->commit();
    }catch( Exception $e ){
        $conn->rollback();
        return $e->getMessage();
    }
    finally{
        $conn=null;
    }
    return $result_cnt;

    }

    $arr=array(
        "board_no"=>1
        ,"board_title"=>"test1"
        ,"board_contents"=>"testtest1"
    );
    // echo update_board_info_no($arr);




    //todo test start
    // $param=0;
    // print_r(select_board_info_no($param));
    //todo test end


?>