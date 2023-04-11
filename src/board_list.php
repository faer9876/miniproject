<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."miniproject/src/common/db_common.php" );
    include_once( URL_DB );
    // $http_method = $_SERVER["REQUEST_METHOD"];

    if(array_key_exists("page_num",$_GET)){
        // $arr_get = $_GET;
        $page_num = $_GET["page_num"];
    }else{
        $page_num = 1;
    }


    $limit_num = 10;

    
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
    <title>게시판</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="common.css">
</head>
        
<div>
    <div id=nav>    
            <h3>
                Beom Lab.
            </h3>
            <nav>
                <ul>
                    <li id='l1'><a href="#" id=a1> 위젯 </a></li>
                    <li id='l2'><a href="#"> HOME </a></li>
                    <li id='l3'><a href="#"> 마이페이지 </a></li>
                </ul>
            </nav>
    </div>
        <nav class="navbar navbar-expand-lg bg-light" id=contain>
        <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">게시판 카테고리</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">자유게시판</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">리뷰게시판</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown link
            </a>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" id=ll1>Action</a></li>
            <li><a class="dropdown-item" href="#" id=ll2>Another action</a></li>
            <li><a class="dropdown-item" href="#" id=ll3>Something else here</a></li>
            </ul>
        </li>
        </ul>
    </div>
    </div>
    </nav>
<body class='p-3 mb-2 bg-light text-dark'.bg-success>
    <br>
    <br>
    <h1> 자유게시판</h1>
    <table class='table table-success table-striped'>
        <thead>
            <tr>
                <th>No.</th>
                <th>제목</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
        <?php
                foreach( $result_paging as $recode ){
                    ?>
                    <tr>
                        <td><?php echo $recode ["board_no"] ?></td>
                        <td><a href="http://localhost/miniproject/src/board_update.php?board_no=<?php echo $recode["board_no"] ?>"><?php echo $recode ["board_title"] ?></a></td>
                        <td><?php echo $recode ["board_writedate"] ?></td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
    </table>



    <div id=center>
    <?php
        if($page_num>=1 && $page_num<$max_page_num){
            ?>
            <a href="http://localhost/miniproject/src/board_list.php?page_num=3"><?php $max_page_num ?>-></a> <?php
        }?>
        <?php
            for($i=1;$i<=$max_page_num;$i++){
        ?>        
            <div id=AA>
                <?php if($page_num==$i){?>
                    <a href ='board_list.php?page_num=<?php echo $i ?>'class='btn btn-danger' id='a'><?php echo $i ?></a> <?php }else{ ?>
                    <a href ='board_list.php?page_num=<?php echo $i ?>'class='btn btn-dark' id='a'><?php echo $i ?></a>
                <?php }?>
            </div>
    <?php 
        }
    ?>
    <?php if($page_num>1){?>
            <a href="http://localhost/miniproject/src/board_list.php?page_num=1"><?php $max_num ?><-</a> <?php
        }?>
    
</div>
    
</body>
</div>
</html>
