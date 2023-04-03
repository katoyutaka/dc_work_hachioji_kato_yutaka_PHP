


$(document).ready(function(){

    // トップの自動でフェードする画像
    $('.fade').slick({
        autoplay: true, // 自動再生
        fade: true, // スライドをフェードイン・フェードアウト
        cssEase: 'linear',// アニメーション
        speed: 600, // フェードアニメーションの速度設定
        arrows:false,
        dots: true, // インジケーター
        infinite: true, // 無限ループするかどうか
        // transform: rotate(90),
    });

    // 横にスライドできる画像
    $('.slider').slick({
        autoplay: true, // 自動再生するかどうか
        autoplaySpeed: 3000, // 自動再生する場合のスピード（ms単位）
        arrows: false, // 左右の矢印を表示するかどうか
        dots: false, // ページネーションを表示するかどうか
        infinite: true, // 無限ループするかどうか
        slidesToShow: 4, // 一度に表示するスライドの数
        slidesToScroll: 1 // スライドを1つスクロールするときの数
    });

});

    // 左右からフェードインする画像
    $(function () { $(window).scroll(function () {
        const windowHeight = $(window).height(); 
        const scroll = $(window).scrollTop(); 
        $('.right_left1').each(function () { 
            const targetPosition = $(this).offset().top; 
            if (scroll > targetPosition - windowHeight + 100) { 
                $(this).addClass("is-fadein"); } }); 
        });
    });

    $(function () { $(window).scroll(function () {
        const windowHeight = $(window).height(); 
        const scroll = $(window).scrollTop(); 
        $('.right_left2').each(function () { 
            const targetPosition = $(this).offset().top; 
            if (scroll > targetPosition - windowHeight + 100) { 
                $(this).addClass("is-fadein"); } }); 
        });
    });

    $(function () { $(window).scroll(function () {
        const windowHeight = $(window).height(); 
        const scroll = $(window).scrollTop(); 
        $('.right_left3').each(function () { 
            const targetPosition = $(this).offset().top; 
            if (scroll > targetPosition - windowHeight + 100) { 
                $(this).addClass("is-fadein"); } }); 
        });
    });

    $(function () { $(window).scroll(function () {
        const windowHeight = $(window).height(); 
        const scroll = $(window).scrollTop(); 
        $('.right_left4').each(function () { 
            const targetPosition = $(this).offset().top; 
            if (scroll > targetPosition - windowHeight + 100) { 
                $(this).addClass("is-fadein"); } }); 
        });
    });