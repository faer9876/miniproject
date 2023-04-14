<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."miniproject/src/common/db_common.php" );
    define( "URL_HEADER", DOC_ROOT."miniproject/src/board_header.php" );
    include_once( URL_DB );

    // request param
    $arr_get=$_GET;
    // get info from db
    $result_info = select_board_info_no($arr_get["board_no"]);

    $current_page_num=$_GET["page_num"];

?>
    <!DOCTYPE html>
    <html lang="ko">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="common2.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Tilt+Prism&display=swap" rel="stylesheet">
        <title>게시판 보기</title>
        <link rel="stylesheet" href="common2.css">
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
</head>
<body>
<?php include_once( URL_HEADER );?>
<table class="table table-striped table-hover">
        <thead>
            <tr>
                <td>게시글 번호<p><?php echo $result_info["board_no"]?></p></td>
            </tr>
            <tr>
                <td>작성일<p><?php echo $result_info["board_writedate"]?></p></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td id="sub">게시글 제목<p><?php echo $result_info["board_title"]?></p></td>
            </tr>
            <tr>
                <td>게시글 내용<p id="info"><?php echo $result_info["board_contents"]?></p></td>
            </tr>
        </tbody>
    </table>
    <div id="container">
    <button type="button" class="btn btn-outline-dark">
        <a href="board_update.php?board_no=<?php echo $result_info["board_no"]?>">
            수정
        </a>

    </button>
    <button type="button" class="btn btn-outline-dark">
        <a href="board_list.php?board=<?php echo $result_info["board_no"]?>">
            취소
        </a>
    </button>
    <button class="btn btn-outline-dark">
                <a href="http://localhost/miniproject/src/board_list.php?page_num=<?php echo $current_page_num?>">리스트</a>
            </button>
    <button type="button" class="btn btn-outline-dark" id="w">
        <a href="board_delete.php?board_no=<?php echo $result_info["board_no"]?>">
            삭제
        </a>
    </button>
    </div>
    <?php 
		for($i = 0; $i < 9 ; $i++)
		{
	?>
			<div class="snowflake">★</div>
	<?php
		}
	?>
</body>
</html>