<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>


<script type="text/javascript">
    $(document).ready(function(){
  $('.slider').slick({
    autoplay: true, // 自動再生するかどうか
    autoplaySpeed: 2000, // 自動再生する場合のスピード（ms単位）
    arrows: false, // 左右の矢印を表示するかどうか
    dots: false, // ページネーションを表示するかどうか
    infinite: true, // 無限ループするかどうか
    slidesToShow: 3, // 一度に表示するスライドの数
    slidesToScroll: 1 // スライドを1つスクロールするときの数
  });
});

</script>

<style>

.slider img{
max-width:200px;
}

.slider{
width:600px;
}

</style>
</head>
<body>

<div class="slider">
<div><img src="img/jewery4.jpg" alt=""></div>
  <div><img src="img/jewery5.jpg" alt=""></div>
  <div><img src="img/jewery6.jpg" alt=""></div>
  <div><img src="img/jewery1.jpg" alt=""></div>
  <div><img src="img/jewery3.jpg" alt=""></div>
</div>
</body>
</html>