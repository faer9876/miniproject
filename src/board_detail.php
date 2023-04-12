<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."miniproject/src/common/db_common.php" );
    include_once( URL_DB );

    // request param
    $arr_get=$_GET;
    // get info from db
    $result_info = select_board_info_no($arr_get["board_no"]);


?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" href="common4.css">
</head>
<body>
    <div>
        <p id="p1">게시글 번호</p><p><?php echo $result_info["board_no"]?></p>
        <p id="p2">작성일</p><p><?php echo $result_info["board_writedate"]?></p>
        <p id="p3">게시글 제목</p><p><?php echo $result_info["board_title"]?></p>
        <p id="p4">게시글 내용</p><p id="pt1"><?php echo $result_info["board_contents"]?></p>
    </div>

    <button type="button">
        <a href="board_update.php?board_no=<?php echo $result_info["board_no"]?>">
            수정
        </a>
    </button>
    <button type="button">
        <a href="board_list.php?board=<?php echo $result_info["board_no"]?>">
            취소
        </a>
    </button>
    <button type="button">
        <a href="board_list.php?board=<?php echo $result_info["board_no"]?>">
            리스트
        </a>
    <button type="button">
        <a href="board_delete.php?board_no=<?php echo $result_info["board_no"]?>">
            삭제
        </a>
    </button>
</button>
</body>
</html>