<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."miniproject/src/common/db_common.php" );
    define( "URL_HEADER", DOC_ROOT."miniproject/src/board_header.php" );
    include_once( URL_DB );
    // $http_method = $_SERVER["REQUEST_METHOD"];

    if(array_key_exists("page_num",$_GET)){
        // $arr_get = $_GET;
        $page_num = $_GET["page_num"];
    }else{
        $page_num = 1;
    }


    $limit_num = 10;


    
    //검색한 정보 테이블 전체 카운트 획득
    $result_cnt = select_board_info_cnt();

    // max page number
    $max_page_num = ceil((int)$result_cnt[0]["cnt"]/$limit_num);

    // offset
    $offset = ($page_num*$limit_num) - $limit_num;
    
    $arr_prepare = array(
                "limit_num"=> $limit_num
                ,"offset"=> $offset
    );
    // $result_paging = select_board_info_paging( $arr_prepare );
    // print_r($max_page_num);
    $board_list = select_board_info_paging($arr_prepare);

    if (isset($_POST['search_word'])&& !empty($_POST['search_word'])){
        $search_word=$_POST['search_word'];
        $search_arr=array("search_word" => $search_word);
        $board_list=search_board_info_no($search_arr);
    }else{
        $arr_prepare=array("limit_num"=>$limit_num,"offset"=>$offset);
        $board_list=select_board_info_paging($arr_prepare);
    }

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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">
</head>
<style>
/* customizable snowflake styling */
    .snowflake {
    color: #fff;
    font-size: 1em;
    font-family: Arial, sans-serif;
    text-shadow: 0 0 5px #000;
    }

@-webkit-keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@-webkit-keyframes snowflakes-shake{0%,100%{-webkit-transform:translateX(0);transform:translateX(0)}50%{-webkit-transform:translateX(80px);transform:translateX(80px)}}@keyframes snowflakes-fall{0%{top:-10%}100%{top:100%}}@keyframes snowflakes-shake{0%,100%{transform:translateX(0)}50%{transform:translateX(80px)}}.snowflake{position:fixed;top:-10%;z-index:9999;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;cursor:default;-webkit-animation-name:snowflakes-fall,snowflakes-shake;-webkit-animation-duration:10s,3s;-webkit-animation-timing-function:linear,ease-in-out;-webkit-animation-iteration-count:infinite,infinite;-webkit-animation-play-state:running,running;animation-name:snowflakes-fall,snowflakes-shake;animation-duration:10s,3s;animation-timing-function:linear,ease-in-out;animation-iteration-count:infinite,infinite;animation-play-state:running,running}.snowflake:nth-of-type(0){left:1%;-webkit-animation-delay:0s,0s;animation-delay:0s,0s}.snowflake:nth-of-type(1){left:10%;-webkit-animation-delay:1s,1s;animation-delay:1s,1s}.snowflake:nth-of-type(2){left:20%;-webkit-animation-delay:6s,.5s;animation-delay:6s,.5s}.snowflake:nth-of-type(3){left:30%;-webkit-animation-delay:4s,2s;animation-delay:4s,2s}.snowflake:nth-of-type(4){left:40%;-webkit-animation-delay:2s,2s;animation-delay:2s,2s}.snowflake:nth-of-type(5){left:50%;-webkit-animation-delay:8s,3s;animation-delay:8s,3s}.snowflake:nth-of-type(6){left:60%;-webkit-animation-delay:6s,2s;animation-delay:6s,2s}.snowflake:nth-of-type(7){left:70%;-webkit-animation-delay:2.5s,1s;animation-delay:2.5s,1s}.snowflake:nth-of-type(8){left:80%;-webkit-animation-delay:1s,0s;animation-delay:1s,0s}.snowflake:nth-of-type(9){left:90%;-webkit-animation-delay:3s,1.5s;animation-delay:3s,1.5s}.snowflake:nth-of-type(10){left:25%;-webkit-animation-delay:2s,0s;animation-delay:2s,0s}.snowflake:nth-of-type(11){left:65%;-webkit-animation-delay:4s,2.5s;animation-delay:4s,2.5s}
</style>
<div id="back">
<?php include_once( URL_HEADER );?>
    <div id=nav>    
            <h3>
                Beom Lab.
            </h3>
            <nav>
                <ul>
                    <li id='l1'><a href="#" id=a1> 위젯 </a></li>
                    <div class="snowflake">
                        ❅
                    </div>
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
    <button type="button" id="rg" class="btn btn-outline-dark"><a href="board_insert.php">글쓰기</a></button>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>제목</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            $pm=$page_num;
        ?>
        <?php
                foreach( $board_list as $recode ){
                    ?>
                    <tr>
                        <td><?php echo $recode ["board_no"] ?></td>
                        <td> <a href="http://localhost/miniproject/src/board_detail.php?board_no=<?php echo $recode["board_no"] ?>&page_num=<?php echo $page_num ?>"><?php echo $recode ["board_title"] ?></a></td>
                        <td><?php echo $recode ["board_writedate"] ?></td>
                    </tr>
            <?php
                }
            ?>
        </tbody>
    </table>


    <div id="center">
    <?php
        if($page_num>=1 && $page_num<$max_page_num){
            ?>
            <a href="http://localhost/miniproject/src/board_list.php?page_num=3"><?php $max_page_num ?>▶</a> <?php
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
            <a href="http://localhost/miniproject/src/board_list.php?page_num=1"><?php $max_num ?>◀</a> <?php
        }?>
    
    </div>
    
    <?php
    ?>
    <form method="post" action="board_search.php?$page_num=<?php echo $page_num?>">
        <input type="hidden" name="search">
        <label for="search">검색어</label>
        <input type="text" id="search" name="search_word" placeholder="찾을 내용">
        <button type="submit">검색</button>
    </form>

<?php 
		for($i = 0; $i < 9 ; $i++)
		{
	?>
			<div class="snowflake">★</div>
	<?php
		}
	?>
</body>

</div>
</html>
