
<?php
    require('head.php'); 
  $xml=simplexml_load_file("data.xml")
  ?>
    <div class="col-lg-8 mx-auto">
      <p class="sub_text"><b><font class="drag"><?php echo $xml->title. ""?></font></p></b>
      <p class="text-muted small mb-4 mb-lg-0"><?php echo $xml->subtitle. ""?></p><hr>
    <?php
    require_once("dbconfig.php");

    if (isset($_GET["date"]))
    {
        $date = $_GET["date"];
    }

    if (isset($_GET["id"]))
    {
        $id = $_GET["id"];
    }

    if (isset($id))
    {
        $sql = "select id, title, content, date, hit, writer, password from board where id=" . $id;
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
    }
    ?>

   

<body>
<article class="boardArticle">
    <h3><b>게시판 글작성</b></h3>
    <div id="boardWrite">
        <form action="./write_update.php" method="post">
            <?php
            if(isset($id)) {
                echo '<input type="hidden" name="id" value="' . $id . '">';
            }
            ?>
          
            <?php
            if(isset($id)) {
              ?>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">작성자</span>
                </div>
                <input readonly type="writer" class="form-control" placeholder="닉네임" value="<?php
                  echo $row["writer"];
                  ?>" name="writer" id="writer" aria-describedby="basic-addon1">
              </div>  
              <?php
            } else { ?>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">작성자</span>
                </div>
                <input type="writer" class="form-control" placeholder="닉네임" value="<?php
                  // Sets user IP address
                  $ip =  $_SERVER['REMOTE_ADDR'];
                  // Sets user IP address with last subnet replaced by 'x'
                  $ip = preg_replace('~(\d+)\.(\d+)\.(\d+)\.(\d+)~', "$1.$2.$3.XXX", $ip);
                  // Displays user IP address as altered.
                  echo $ip;
                  ?>" name="writer" id="writer" aria-describedby="basic-addon1">
              </div>
                     
              <?php } ?>
           
                    
                <td class="password"><div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">비밀번호</span>
                </div>
                <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-describedby="basic-addon1">
              </div>
                                             
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">제목</span>
                </div>
                <input type="title" class="form-control" placeholder="Title" name="title" id="title" aria-describedby="basic-addon1"/>
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">내용</label>
                <textarea class="form-control" name="content" id="content" rows="3"></textarea>
              </div>             
              <div class="btnSet">
                  <button type="submit" class="btnSubmit btn"><?php echo isset($id)?'수정':'작성'?></button>
                  <a href="./list.php?date=<?php echo $row['date'] ?>" class="btnList btn">뒤로가기</a>
              </div>
        </form>
    </div>
</article>
</body>

<?php
    require('footer.php'); 
?>
</html>

