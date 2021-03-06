<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="http://sscol.jebal.comuv.com/css/font.css">
</head>
<body>
  <h2>Inspired by <a href="http://dribbble.com/shots/899672-Login-Form">this dribbble shot</a> made by <a href="http://dribbble.com/ionuss">Ionut Zamfir</a>.</h2>
  <div class="ribbon"></div>
  <div class="login">
  <h1>Let's get started.</h1>
  <p>This will be an amazing experience</p>
  <form action="login">
    <div class="input">
      <div class="blockinput">
        <i class="icon-envelope-alt"></i><input type="mail" placeholder="Email">
      </div>
      <div class="blockinput">
        <i class="icon-unlock"></i><input type="password" placeholder="Password">
      </div>
    </div>
    <button>Login</button>
  </form>
  </div>
  <hr>
  <h2>Another way to use the concept ...</h2>
  <div class="ribbon ior"></div>
  <div class="login io">
    <div class="press">CEO <span>Google</span></div>
    <img src="https://lh3.googleusercontent.com/-Y86IN-vEObo/AAAAAAAAAAI/AAAAAAACk4w/yvxY4GMx_8k/s120-c/photo.jpg" alt="ggIO">
    <h1>Lawrence Edward Page</h1>
    <p>CEO of Google</p>
  </div>
  <br><br>
</body>
</html>

<style type="text/css">
  body{
  background: #4E535B;
  font-family: 'Montserrat', Arial;
  font-size: 1em;
}
h2{
  text-align: center;
  color: #F1F2F4;
  text-shadow: 0 1px 0 #000;
}
a{
  text-decoration: none; color: #EC5C93; 
}
.ribbon{
  background: rgba(200,200,200,.5);
  width: 50px;
  height: 70px;
  margin: 0 auto;
  position: relative;
  top: 19px;
  border: 1px solid rgba(255,255,255,.3);
  border-top: 2px solid rgba(255,255,255,.5);
  border-bottom: 0;  
  border-radius: 5px 5px 0 0;
  box-shadow: 0 0 3px rgba(0,0,0,.7); 
}
.ribbon:before{
  content:"";
  display: block;
  width: 15px;
  height: 15px;
  background: #4E535B;
  border: 4px solid #cfd0d1;
  margin: 18px auto;
  box-shadow: inset 0 0 5px #000, 0 0 2px #000, 0 1px 1px 1px #A7A8AB;
  border-radius: 100%;
}
.login{
  background: #F1F2F4;
  border-bottom: 2px solid #C5C5C8;
  border-radius: 5px;
  text-align: center;
  color: #36383C;
  text-shadow: 0 1px 0 #FFF;
  max-width: 300px;
  margin: 0 auto;
  padding: 15px 40px 20px 40px;
  box-shadow: 0 0 3px #000;
}
.login:before{
  content:"";
  display: block;
  width: 70px;
  height: 4px;
  background: #4E535B;
  border-radius: 5px;
  border-bottom: 1px solid #FFFFFF;
  border-top: 2px solid #CBCBCD;
  margin: 0 auto;
}
h1{
  font-size: 1.6em;
  margin-top: 30px;
  margin-bottom: 10px;
}
p{
  font-family:'Helvetica Neue';
  font-weight: 300;
  color: #7B808A;
  margin-top: 0;
  margin-bottom: 30px;
}
.input{
  text-align: right;
  background: #E5E7E9;
  border-radius: 5px;
  overflow: hidden;
  box-shadow: inset 0 0 3px #65686E;
  border-bottom: 1px solid #FFF;
}
input{
  width: 260px;
  background: transparent;
  border: 0;
  line-height: 3.6em;
  box-sizing: border-box;
  color: #71747A;
  font-family:'Helvetica Neue';
  text-shadow: 0 1px 0 #FFF;
}
input:focus{
  outline: none;
}
.blockinput{
  border-bottom: 1px solid #BDBFC2;
  border-top: 1px solid #FFFFFF;
}
.blockinput:first-child{
  border-top: 0;
}
.blockinput:last-child{
  border-bottom: 0;
}
.blockinput i{
  padding-right: 10px;
  color: #B1B3B7;
  text-shadow: 0 1px 0 #FFF;
}
::-webkit-input-placeholder {
  color: #71747A;
  font-family:'Helvetica Neue';
  text-shadow: 0 1px 0 #FFF;
}
button{
  margin-top: 20px;
  display: block;
  width: 100%;
  line-height: 2em;
  background: rgba(114,212,202,1);
  border-radius: 5px;
  border:0;
  border-top: 1px solid #B2ECE6;
  box-shadow: 0 0 0 1px #46A294, 0 2px 2px #808389;
  color: #FFFFFF;
  font-size: 1.5em;
  text-shadow: 0 1px 2px #21756A;
}
button:hover{
 background: linear-gradient(to bottom, rgba(107,198,186,1) 0%,rgba(57,175,154,1) 100%);  
}
button:active{
  box-shadow: inset 0 0 5px #000;
  background: linear-gradient(to bottom, rgba(57,175,154,1) 0%,rgba(107,198,186,1) 100%); 
}

/* ### TEST PASS GOOGLE IO ### */

hr{
  border-top: 1px solid rgba(0,0,0,.5);
  border-bottom: 1px solid rgba(255,255,255,.5);
  border-left: 0;
  border-right: 0;
  margin-top: 30px;
}

.io{
  padding: 0;
  padding-bottom: 10px;
}
.press{
  background: #D73D32;
  height: 40px;
  margin-top: -7px;
  border-radius: 5px 5px 0 0;
  text-align: left;
  line-height: 40px;
  padding: 0 10px;
  color: #FFF;
  text-shadow: none;
}
.press span{
  float: right;
  font-family: Georgia;
}
.io:before{
  position: relative;
  top: 15px;
  border-top: 2px solid #E78B84;
  border-bottom: 1px solid #6C1E19;
}
.ior{
  position:relative;
  z-index: 1;
}
.io img{
  width: 150px;
  border-radius: 100%;
  border: 4px solid 
  margin-top: 10px;
  border: 4px solid #FFF;
  margin: 18px auto 0;
  box-shadow: 0 1px 1px 1px #A7A8AB;
}
.io h2{
  margin-top: 0;
}
.io p{
  font-size: 1.5em;
  margin-bottom: 5px;
}
  
</style>

