<?php
    require('head.php'); 
  ?>
<div class="col-lg-8 mx-auto">
    <p class="sub_text"><b><?php echo $xml->title. ""?></p></b>
    <p class="text-muted small mb-4 mb-lg-0"><?php echo $xml->subtitle. ""?></p><hr>

    <body>
<?php
require_once("dbconfig.php");

define("ONE_PAGE_POSTS", 5);
define("ONE_SECTION", 5);
$date = $_GET["date"];

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
$searchCategory = "";
$subString = "";
if (isset($_GET["searchCategory"])) {
    $searchCategory = $_GET["searchCategory"];
    $subString .= '&amp;searchCategory=' . $searchCategory;
}

if (isset($_GET["searchText"])) {
    $searchText = $_GET["searchText"];
    $subString .= '&amp;searchText=' . $searchText;
}

$isValidSearchOption = isset($searchCategory) && isset($searchText);
$searchSql = "";
if ($isValidSearchOption) {
    $searchSql = ' where ' . $searchCategory . ' like "%' . $searchText . '%"';
}

$sql = "select count(*) as cnt from board" . $searchSql;
$result = $db->query($sql);
$row = $result->fetch_assoc();

$allPost = $row["cnt"];
$allPage = ceil($allPost / ONE_PAGE_POSTS);

$isOutOfBound = (1>$page) && $page > $allPage;
if ($isOutOfBound) {
    ?>
    <script>
        alert("page does not exist");
        history.go(-1);
    </script>
    <?php
    exit;
}

$currentSection = ceil($page / ONE_SECTION);
$allSection = ceil($allPage / ONE_SECTION);
$firstPage = ($currentSection * ONE_SECTION)  - (ONE_SECTION -1);

$lastPage = ($currentSection == $allSection) ? $allPage : $currentSection * ONE_SECTION;
$prevPage = ($currentSection - 1) * ONE_SECTION;
$nextPage = (($currentSection + 1) * ONE_SECTION) - (ONE_SECTION - 1);

$paging = "<ul class='pagination'>";

if($page != 1) {
    $paging .= '<li class="page-item page_start"><a class="page-link" href="./list.php?page=1' . $subString . '">first</a></li>';
}
if($currentSection != 1) {
    $paging .= '<li class="page-item page_prev"><a class="page-link" href="./list.php?page=' . $prevPage . $subString . '">prev</a></li>';
}

for($i = $firstPage; $i <= $lastPage; $i++) {
    if($i == $page) {
        $current_page .= '<p class="text-muted small mb-4 mb-lg-0">지금은' . $i . '번 페이지입니다</p>';
    } else {
        $paging .= '<li class="page-item"><a class="page-link" href="./list.php?page=' . $i . $subString . '">' . $i . '</a></li>';

    }
}

if($currentSection != $allSection) {
    $paging .= '<li class="page-item page_next"><a class="page-link" href="./list.php?page=' . $nextPage . $subString . '">next</a></li>';

}

if($page != $allPage) {
    $paging .= '<li class="page-item page_end"><a class="page-link" href="./list.php?page=' . $allPage . $subString . '">last</a></li>';

}
$paging .= '</ul>' . $current_page;

$currentLimit = (ONE_PAGE_POSTS * $page) - ONE_PAGE_POSTS;
$sqlLimit = ' limit ' . $currentLimit . ', ' . ONE_PAGE_POSTS;

$sql = 'select * from board ' . $searchSql . 'where DATE_FORMAT(date, "%Y-%m-%d") = Date("' . $date . '") order by id desc' . $sqlLimit;
$result = $db->query($sql);

?>
    <div class="row mx-auto">
        <div class="searchBox">
            <form action="./list.php" method="get">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <select name="searchCategory" class="form-control">
                            <option <?php echo $searchCategory=='title'?'selected="selected"':null?> value="title">제목</option>
                            <option <?php echo $searchCategory=='content'?'selected="selected"':null?> value="content">내용</option>
                            <option <?php echo $searchCategory=='writer'?'selected="selected"':null?> value="writer">작성자</option>
                        </select>
                    </div>
                    <input type="text" class="form-control" placeholder="검색어" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">
                </div>
            </form>
        </div>
        <div id="boardList">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" class="no">번호</th>
                <th scope="col" class="title">제목</th>
                <th scope="col" class="author">작성자</th>
                <th scope="col" class="date">날짜</th>
                <th scope="col" class="hit">조회수</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $result->fetch_assoc())
            {
                $datetime = explode(' ', $row['date']);
                $date = $datetime[0];
                $time = $datetime[1];
                if ($date == Date('yyyy-MM-dd')) {
                    $row['date'] = $time;
                } else {
                    $row['date'] = $date;
                }
                ?>
                <tr>
                    <td class="no"><?php echo $row['id']?></td>
                    <td class="title"><a href="./view.php?id=<?php echo $row['id'] ?>&date=<?php echo $row['date'] ?>"><?php echo $row['title']?></a></td>
                    <td class="author"><?php echo $row['writer']?></td>
                    <td class="date"><?php echo $row['date']?></td>
                    <td class="hit"><?php echo $row['hit']?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <div class="paging my-3">
        <?php echo $paging ?>
        </div>
        <a  role="button" href="./"  class="btn btn-secondary">달력으로 돌아가기</a>
        <a  role="button" href="write.php" class="btn btn-primary" style="float:right">글쓰기</a>
    </div>
    </div>
</body>
<?php
    require('footer.php'); 
?>
</html>