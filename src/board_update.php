<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."miniproject/src/common/db_common.php" );
    include_once( URL_DB );
    $http_method = $_SERVER["REQUEST_METHOD"];//GET,POST 값 가져옴

    if(array_key_exists("page_num",$_GET)){
        // $arr_get = $_GET;
        $page_num = $_GET["page_num"];
    }else{
        $page_num = 1;
    }

    $limit_num = 10;

    // get 체크
    if($http_method === "GET"){
        $board_no=1;
        if(array_key_exists("board_no",$_GET)){
            // $arr_get = $_GET;
            $board_no = $_GET["board_no"];
        }
        $result_info = select_board_info_no( $board_no );
    }// 밑은 POST일 때
    else{
        $arr_post=$_POST;
        $arr_info=array(
                "board_no"=>$arr_post["board_no"]
                ,"board_title"=>$arr_post["board_title"]
                ,"board_contents"=>$arr_post["board_contents"]
        );

        // update 
        $result_cnt=update_board_info_no($arr_info);

        //select
        // $result_info = select_board_info_no( $arr_post["board_no"] ); //0412 del

        header( "Location:board_detail.php?board_no=".$arr_post["board_no"] );
        exit(); //  redirect 34행에서 탈출해서 이후 소스코드 실행필요x  
    }
    
    //게시판 정보 테이블 전체 카운트 획득
    $result_cnt = select_board_info_cnt();

    // max page number
    $max_page_num = ceil((int)$result_cnt[0]["cnt"]/$limit_num);

    // offset
    $offset = ($page_num*$limit_num) - $limit_num;

    $arr_prepare = array(
                "limit_num"=> $limit_num
                ,"offset"=> $offset
    );
    $result_paging = select_board_info_paging( $arr_prepare );
    // print_r($max_page_num);
?>
    <!DOCTYPE html>
    <html lang="ko">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="common2.css">
        <title>게시판 수정</title>
        <style>
         * {
            margin: 0 auto;
        }

        body {
            width:1500px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            height: 100vh;
        
        }

        form {
            display: flex;
            flex-wrap: wrap;
            width: 70vw;
            height: 90vh;
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 5px;
            text-align: center;
            margin: 0 auto;
            background-image: url("보노보노.gif");
            background-size:cover;
        }

        #bno,
        #title {
            width: 100%;
        }

        input {
            margin-top: 10px;
            width: 100%;
        }

        h1 {
            text-align: center;
            font-size: 50px;
            position: relative;
            padding-left: 10vw;
            padding-right: 10vw;
            width: 100%;
        }

        button {
            margin-top: 10px;
            margin-left: 5px;
        }

        a {
            text-decoration: none;
            color: white;
        }

        label {
            font-weight:bold;
            width: 100%;
        }
        #bno,#title,#contents{
            font-weight:bold;
            border:none;
            background-color:rgba(0, 0, 0, 0.1);
        }
        </style>
    </head>
    <body>
        <form method="post" action="board_update.php">
        <h1>게시판 수정</h1>
        <br>
            <label for="bno" id="con2">게시글 번호 </label><br>
            <input type="text" name="board_no" id="bno" value="<?php echo $result_info["board_no"]?> "readonly>
            <br>
            <label for="title" id="con3">게시글 제목 </label><br>
            <input type="text" name="board_title" id="title" value="<?php echo $result_info['board_title']?>">
            <br>
            <label for="contents" id="con4">게시글 내용  </label><br>
            <input type="text" name="board_contents" id="contents" value="<?php echo $result_info['board_contents']?>">
            <br>
            <br>
            <div id="con">
                <button type="submit" class="btn btn-dark">수정</button>
        <button type="submit" id="ma" class="btn btn-dark">
            <?php if($result_info["board_no"]>=1 && $result_info["board_no"]<=10){ ?>
                <a href="http://localhost/miniproject/src/board_list.php?page_num=1"><?php } 
                else if($result_info["board_no"]>=10 && $result_info["board_no"]<=20){ ?>
                <a href="http://localhost/miniproject/src/board_list.php?page_num=2"><?php } 
                else if($result_info["board_no"]>=21 && $result_info["board_no"]<=25){ ?>
                <a href="http://localhost/miniproject/src/board_list.php?page_num=3"><?php } ?>리스트</a>
        </button>
            </div>

        </form>
    </body>
    </html>