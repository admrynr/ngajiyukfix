<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

        <style type="text/css">
            body{
            	text-align: center;
            	margin: 0 auto;
            	width: 650px;
            	font-family: 'Open Sans', sans-serif;
            	background-color: #e2e2e2;		      	
            	display: block;
            }
            ul{
            	margin:0;
            	padding: 0;
            }
            li{
            	display: inline-block;
            	text-decoration: unset;
            }
            a{
            	text-decoration: none;
            }
            p{
                margin: 15px 0;
            }

            h5{
            	color:#444;
                text-align:left;
                font-weight:400;
            }
            .text-center{
            	text-align: center
            }
            .main-bg-light{
            	background-color: #fafafa;
            }
            .title{
            	color: #444444;
            	font-size: 22px;
            	font-weight: bold;
            	margin-top: 10px;
            	margin-bottom: 10px;
            	padding-bottom: 0;
            	text-transform: uppercase;
            	display: inline-block;
            	line-height: 1;
            }
            table{
                margin-top:30px
            }
            table.top-0{
                margin-top:0px;
            }
            table.order-detail , .order-detail th , .order-detail td {
                border: 1px solid #ddd;
                border-collapse: collapse;
            }
            .order-detail th{
                font-size:16px;
                padding:15px;
                text-align:center;
            }
            .footer-social-icon tr td img{
                margin-left:5px;
                margin-right:5px;
            }

            .btn-solid {
                padding: 13px 29px;
                margin-bottom: 30px;
                color: #fff;
                letter-spacing: 0.05em;
                border: 2px solid #ff4c3b;
                background-image: linear-gradient(30deg, #ff4c3b 50%, transparent 50%);
                background-size: 850px;
                background-repeat: no-repeat;
                background-position: 0;
                -webkit-transition: background 300ms ease-in-out;
                transition: background 300ms ease-in-out;
            }

        </style>
    </head>
    <body style="margin: 40px auto;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" style="padding: 0px 30px 60px 30px;background-color: #fff; -webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);width: 100%;">
            <tbody>
                <tr>
                    <td>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" >
                            <tr>
                                <td>
                                    <img src="{{asset("images/bliomi-logo.png")}}" alt="" style=";margin-bottom: 30px;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{asset("assets-front/images/email-temp/success.png")}}" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h2 class="title">Verify Your Email Address</h2>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Dear, {{$name}}.</p>
                                    <p>Please confirm that you want to use this as your Bliomi account</p>
                                        <p>email address. Once it's done, you can start shopping!</p>
                                </td>
                            </tr>
                            <tr>
                                
                                <td>
                                    <div style="border-top:1px solid #777;height:1px;margin-top: 0px;margin-bottom: 30px;">
                                </td>
                            </tr>
                            <tr></tr>
                            <tr>
                                <td>
                                    <a class="btn btn-solid" href="{{$link}}">Verify Your Email</a>
                                </td>
                            </tr>
                        </table>                             
                        
                       
                    </td>
                </tr>
            </tbody>            
        </table>
        <table class="main-bg-light text-center top-0"  align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td style="padding: 30px;">
                                    <div>
                                        <h4 class="title" style="margin:0;text-align: center;">Follow us</h4>
                                    </div>
                                    <table border="0" cellpadding="0" cellspacing="0" class="footer-social-icon" align="center" class="text-center" style="margin-top:20px;">
                                        <tr>
                                            <td>
                                                <a href="#"><img src="{{asset("/assets-front/images/email-temp/facebook.png")}}" alt=""></a>
                                            </td>
                                            <td>
                                                <a href="#"><img src="{{asset("/assets-front/images/email-temp/youtube.png")}}" alt=""></a>
                                            </td>
                                            <td>
                                                <a href="#"><img src="{{asset("/assets-front/images/email-temp/twitter.png")}}" alt=""></a>
                                            </td>
                                        </tr>                                    
                                    </table>
                                    <div style="border-top: 1px solid #ddd; margin: 20px auto 0;"></div>
                                    <table  border="0" cellpadding="0" cellspacing="0" width="100%" style="margin: 20px auto 0;" >
                                        <tr>
                                            <td>
                                                <p style="font-size:13px; margin:0;">2017-18 powered by <a href="https://vantura.id" target="_blank">vantura.id</a></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
    </body>
</html>