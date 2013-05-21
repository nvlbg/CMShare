<!doctype html>
<html>
<head>
	<title><?php echo $title; ?></title>
        <style>
            #success {
               border: 1px solid #888;
               padding: 20px 60px;
               font-size: 30px;
               margin: 100px auto;
               background-image: -webkit-gradient(linear, left top, left bottom, from(#DDDDDD), to(#CACACA) repeat scroll 0 0 transparen);
               background: -webkit-linear-gradient(center top , #DDDDDD, #CACACA) repeat scroll 0 0 transparent;
               background: -moz-linear-gradient(center top , #DDDDDD, #CACACA) repeat scroll 0 0 transparent;
               background: -o-linear-gradient(center top , #DDDDDD, #CACACA) repeat scroll 0 0 transparent;
               background: -ms-linear-gradient(center top , #DDDDDD, #CACACA) repeat scroll 0 0 transparent;
               background: linear-gradient(center top , #DDDDDD, #CACACA) repeat scroll 0 0 transparent;
               background-color: #CDCDCD;
               width: 600px;
               text-align: center;
               font-family: "Myriad Pro", "Myriad", "Times New Roman", Tahoma, arial;
               -webkit-border-radius: 8px;
               -moz-border-radius: 8px;
               border-radius: 8px;
               -webkit-box-shadow: 0 0 4px #999;
               -moz-box-shadow: 0 0 4px #999;
               box-shadow: 0 0 4px #999;
               text-shadow: 1px 1px 0 #AAA;
            }
        </style>
</head>
<body>
    <p id="success"><?php echo $message; ?></p>
</body>
</html>
