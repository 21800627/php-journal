<!-- 
Github : ChangMun00
이 소스는 깃허브에 있는 소스입니다 :)
이 주석을 지우지 말아주세요
CDN 사용안내 : https://notice.winsub.kr/view.php?id=5
-->
<!DOCTYPE html>
 <?php
$xml=simplexml_load_file("data.xml")
?>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="설명">
  <meta name="author" content="<?php echo $xml->name. ""?>">
  <title><?php echo $xml->title. ""?></title>
  <!--bootstrap css-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel='stylesheet' type='text/css' href="https://cdn.winsub.kr/default.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
  <!--calendar css-->
  <link rel="stylesheet" href="css/calendar.css">
  <link rel="stylesheet" href="css/theme.css">
</head>
<body id="page-top">
  <nav class="navbar navbar-expand-lg navbar-light bg-light" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><b><?php echo $xml->name. ""?></b></a>
    </div>
  </nav>

<div class="container">
