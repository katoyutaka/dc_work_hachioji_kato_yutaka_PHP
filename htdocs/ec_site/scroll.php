<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<style>

body{ 
font-size: 5rem; 
margin: 0 auto; 
position: relative; 
} 

.under-area{ 
height: 100vh; 
color: white; 
text-align: center; 
}

.under-area::before{ 
content: ""; 
position: fixed;
top: 0; left: 0; 
width: 100%; 
height: 100vh; 
z-index: -1; 
background-image: url("img/jewery4.jpg"); 
background-size: cover; background-repeat: no-repeat; 
} 

.over-area{ 
position: relative; 
z-index: 1; 
width: 100%; 
height: 100vh; 
text-align: center; 
padding-top: 200px; 
background: #ddd; 
}

</style>

</head>
<body>
<div class="under-area">Scroll↓</div> <div class="over-area">Hello</div>
</body>
</html>
