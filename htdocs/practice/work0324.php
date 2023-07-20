<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Cookie-Footer-Test</title>

    <style>
        .cookie-consent {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 12px;
            color: #fff;
            background: rgba(0,0,0,.7);
            padding: 1.2em;
            box-sizing: border-box;
        }
        .cookie-consent.is-show {
            visibility: visible;
        }
        .policy-link, :link, :visited, :hover {
            color: rgb(0, 136, 255);
            font-size: 15px;
            text-decoration: none;
        }
        .cookie-agree {
            color: #fff;
            background: dodgerblue;
            padding: .5em 1.5em;
            margin-left: 20px;
        }
        .cookie-agree:hover{
            cursor: pointer;
        }
        /* ゆっくり消える */
        .cc-hide1 {
            display: none;
        }
        @keyframes hide {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
                visibility: hidden;
            }
        }
      </style>
      
      <script type='text/javascript'>
        (function() {
            console.log('即時関数');

            // DOM-Elementを取得しておく
            const cookieConsent = document.querySelector('.cookie-consent');
            const cookieAgree = document.querySelector('.cookie-agree');

            // Cookieを拒否した時用のFlag
            const rejectFlag = sessionStorage.getItem('rejectFlag');
            console.log({rejectFlag});

            const cookieData = document.cookie;
            console.log({cookieData});

            // CookieをSetしているかどうかを判定するためのFlag
            let cookieSetFlag = false;

            // 綺麗に分割するために「'; '」(セミコロン&半角スペース)で区切る！
            const cookieDataList = cookieData.split('; ');
            console.log({cookieDataList});

            for (const cookie of cookieDataList) {
                const cookieSplit = cookie.split('=');
                console.log({cookieSplit});

                if (cookieSplit[0] === 'robotama-cookie') cookieSetFlag = true;
                console.log({cookieSetFlag});
            }

            // Cookieの有効期限（日）をSetする
            const expire = 31;

            // 1. Yes Cookie-Set-Function => 引数は有効期限(日)
            function SetCookie(expire){
                const current = new Date();
                expire = current.getTime() + expire * 24 * 3600 * 1000;

                // CookieにDataをSetする
                document.cookie = `robotama-cookie=robotama-read; expire=${expire}`;
            }

            // 2. Cookieを拒否したときに、Cookieをすべて削除するFunction
            function DeleteAllCookie(){
                const maxAgeZero = 'max-age=0';

                for (const cookie of cookieDataList) {
                    const cookieSplit = cookie.split('=');

                    document.cookie = `${cookieSplit[0]}=; ${maxAgeZero}`;
                }
            }

            // 3. Popup表示のFunction
            function PopupDisplay(){
                cookieConsent.classList.add('is-show');
            }

            if (cookieSetFlag) {
                console.log('cookieSetFlagが立っている！Cookie同意済みUser');
            } else {
                if (rejectFlag) {
                    console.log('rejectFlagが立っている！Cookie-拒否User');
                } else {
                    console.log('2つのFlagが立っていない！初回Access-Userか、有効期限切れUser');
                    PopupDisplay();
                }
            }

            // Cookie同意ボタンにイベントを追加する
            cookieAgree.addEventListener('click', ()=> {
                cookieConsent.classList.add('cc-hide1');
                SetCookie(expire);
            });
            
        });
           

     </script>
      
</head>
<body>

    <div class="cookie-consent">
        <div class="cookie-text">
            当サイトではCookieを使用します。Cookieの使用に関する詳細は
            <span class="policy-link">
                <a href="https://masanyon.com/privacy-policy/" target="_blank" >「プライバシーポリシー」</a>
            </span>
            をご覧ください。
            <br>
            クッキーを受け入れるか拒否するか選択してください。
        </div>
        <div class="cookie-agree">同意する</div>

    </div>

        
</body>
</html>