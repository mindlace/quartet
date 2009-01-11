<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html>
	<head>
		<title>neuinput</title>
		<meta name="viewport" content="width=device-width; user-scalable=no" />
		 
		<style type="text/css">
		
		body {margin: 0; padding: 0;}
		
	  .container {
        position: absolute;
        width: 100%;
    }

    body[orient="profile"] .container {
        height: 416px;
    }
    
    body[orient="landscape"] .container {
        height: 268px;
    }
    
	 input { display:none; }
	 .key { min-width: 10px; min-height: 9px; margin: -1px; float: left; border: 1px solid white;  }
	 
	 body[orient="profile"] .key { padding: 2px; width: 7px; height: 15px; }
	 body[orient="landscape"] .key { width: 10px; height: 4px; }
	 
	 <?php for ($i=0; $i<42; $i++) {
	   $hx = dechex($i);
     $color = str_pad($hx, 6, $hx, STR_PAD_LEFT);
	   //for ($c=0; $c < (6 / count($hx)); $c++) {
	   //  $color .= $hx;
	   //}
	   print "#key$i { background-color: #$color; }\n";
	 }?>
	</style>
    <script type="application/x-javascript">
    
    addEventListener("load", function()
    {
        setTimeout(updateLayout, 0);
    }, false);

    var currentWidth = 0;
    
    function updateLayout()
    {
        if (window.innerWidth != currentWidth)
        {
            currentWidth = window.innerWidth;
            viewport.width

            var orient = currentWidth == 320 ? "profile" : "landscape";
            document.body.setAttribute("orient", orient);
            setTimeout(function()
            {
                window.scrollTo(0, 1);
            }, 100);            
        }
    }

    setInterval(updateLayout, 400);
    </script>
	</head> 
	<body>

	 <form method="post" action="" class="container">
	   <input id="melody" type="text"></input>
	   <?php for ($i=0; $i<42; $i++) {
	     print "<div id='key$i' class='key'></div>";
	   } ?>
	 </form>
	</body>
</html>
