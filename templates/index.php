<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- STYLES -->
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="jquery-ui.css">
        <!-- STYLES END -->

        <!-- JQUERY -->
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>

        <title>Index</title>
    </head>
    <body>

        <!-- NAVBAR START -->
        <div class="topnav" id="myTopnav">
          <a href="#home" class="active">Home</a>
          <a href="#news">News</a>
          <a href="#contact">Contact</a>
          <a href="#about">About</a>
          <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
        </div>
        <!-- NAVBAR END -->

        <!-- COVER PHOTO START -->
        <div class="cover-photo">
            <div id="cover-photo">
                <img id="cover-photo-img" src="images/cover-photo1.jpg" alt="">
            </div>
        </div>


        <div class="content">
            <div class="moving-zone">
                <div class="popup">
                    <div class="popup-content">
                        <div class="popup-text">
                            I'm a new kind of <b>popup</b>.<br/>
                            Move your <b>mouse</b> around !
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- COVER PHOTO END -->

    </body>

    <script type="text/javascript">
        /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
        function myFunction() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>

    <script type="text/javascript">
        var photoindex = 2;
        var lastIndex = 4;
        function changeCoverPhoto(){
            var coverphoto = $("#cover-photo-img");
            var coverphoto_wrapper = $("#cover-photo");
            coverphoto_wrapper.hide( "fade", { }, "slow" );
            coverphoto.attr("src", "images/cover-photo"+photoindex+".jpg");
            coverphoto_wrapper.show( "fade", {  }, "slow" );
            photoindex++;
            if( photoindex == lastIndex ){
                photoindex = 1;
            }
        }

        window.setInterval(function(){
            /// call your function here
            changeCoverPhoto();
        }, 5000);  // Change Interval here to test. For eg: 5000 for 5 sec
    </script>

    <script type="text/javascript">
    var moveForce = 30; // max popup movement in pixels
    var rotateForce = 20; // max popup rotation in deg

    $(document).mousemove(function(e) {
    var docX = $(document).width();
    var docY = $(document).height();

    var moveX = (e.pageX - docX/2) / (docX/2) * -moveForce;
    var moveY = (e.pageY - docY/2) / (docY/2) * -moveForce;

    var rotateY = (e.pageX / docX * rotateForce*2) - rotateForce;
    var rotateX = -((e.pageY / docY * rotateForce*2) - rotateForce);

    $('.popup')
    .css('left', moveX+'px')
    .css('top', moveY+'px')
    .css('transform', 'rotateX('+rotateX+'deg) rotateY('+rotateY+'deg)');
});
    </script>
</html>
