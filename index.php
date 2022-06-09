<?php
    require('head.php'); 
    require('./src/php-calendar/Calendar.php');

    use benhall14\phpCalendar\Calendar;
    
    $calendar = new Calendar();
    
  ?>
<div class="col-lg-8 mx-auto">
    <p class="sub_text"><b><?php echo $xml->title. ""?></p></b>
    <p class="text-muted small mb-4 mb-lg-0"><?php echo $xml->subtitle. ""?></p><hr>

    <body>
    <div class="row mx-auto">
        <?php echo $calendar->draw(date('Y-m-1'), ''); ?>
        <hr />    

    </div>
</div>
</body>
<?php
    require('footer.php'); 
?>
</html>