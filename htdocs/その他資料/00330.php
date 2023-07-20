<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>

<script type="text/javascript">
        $(document).ready(function(){
            $('.slider').bxSlider({
                autoplay: true, // 自動再生するかどうか
                autoplaySpeed: 2000, // 自動再生する場合のスピード（ms単位）
                arrows: false, // 左右の矢印を表示するかどうか
                dots: true, // ページネーションを表示するかどうか
                infinite: true, // 無限ループするかどうか
                slidesToShow: 2, // 一度に表示するスライドの数
                slidesToScroll: 1 // スライドを1つスクロールするときの数
            });
        });
</script>
<style>
    .slider img{
        max-width: 100px;
    }

    .slider{
        width: 200px;
        background-color: red;

    }
</style>

</head>

<body>
<div class="slider">
  <div><img src="img/jewery4.jpg" alt=""></div>
  <div><img src="img/jewery5.jpg" alt=""></div>
  <div><img src="img/jewery6.jpg" alt=""></div>
</body>
</html>