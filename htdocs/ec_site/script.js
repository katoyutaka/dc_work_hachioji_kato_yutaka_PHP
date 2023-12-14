

    // <script>
        
        $(document).ready(function(){

        // トップの自動でフェードする画像
        $('.fade').slick({
            autoplay: true, // 自動再生
            fade: true, // スライドをフェードイン・フェードアウト
            cssEase: 'linear',// アニメーション
            speed: 300, // フェードアニメーションの速度設定
            arrows:false,
            dots: true, // インジケーター
            infinite: true, // 無限ループするかどうか
            pauseOnHover:false,
            pauseOnFocus:false,
            pauseOnDotsHover:false,
        });

        // 横にスライドできる画像
        $('.slider').slick({
            autoplay: true, // 自動再生するかどうか
            autoplaySpeed: 800, // 自動再生する場合のスピード（ms単位）
            arrows: true, // 左右の矢印を表示するかどうか
            dots: false, // ページネーションを表示するかどうか
            infinite: true, // 無限ループするかどうか
            slidesToShow: 5, // 一度に表示するスライドの数
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


        //eye check
        document.addEventListener("DOMContentLoaded", function() {
            let eyeCheck = document.getElementById("eye_check");
            let passwordField = document.getElementById("password");

            eyeCheck.addEventListener("click", function() {
                let currentType = passwordField.getAttribute("type");

                if (currentType === "password") {
                    passwordField.setAttribute("type", "text");
                    eyeCheck.src = "img/eye1.png";

                } else {
                    passwordField.setAttribute("type", "password");
                    eyeCheck.src = "img/eye2.png";
                }
            });
        });


        //Cookie Consent
        document.addEventListener("DOMContentLoaded", function() {
            let cookieConsentButton = document.getElementById("cookieConsentButton");
            let cookieConsentBanner = document.getElementById("cookieConsentBanner");

        // 初期状態で、クッキーの同意があればバナーを非表示にする
        if (document.cookie.indexOf("cookieConsent=agree") !== -1) {
            cookieConsentBanner.style.display = "none";
        }

        cookieConsentButton.addEventListener("click", function() {
            // クッキーに同意したという情報を保存
            document.cookie = "cookieConsent=agree; path=/; max-age=" + 60 * 60 * 24 * 30;  // 30日間有効

            // バナーを非表示にする
            cookieConsentBanner.style.display = "none";
            });
        });
    // </script>
