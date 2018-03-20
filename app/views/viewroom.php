<?php include_once '../app/views/header/indexwithoutsliderheader.php' ?>
<?php include_once '../app/views/bodywithoutslider.php' ?>

<style>
body {
  font-family: Arial;
  margin: 0;
}

* {
  box-sizing: border-box;
}

img {
  vertical-align: middle;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
    margin-top: 3%;
}

/* Hide the images by default */
.mySlides {
  display: none;
  height: 350px;
  overflow-y: hidden;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}
</style>

<div class="content">
    <div class="container">
        <?php foreach( $data['roomtypes']->getImages($data['roomtype'][0]['id'], "800x532") as $img ): ?>
            <div class="mySlides">
              <img src="<?php echo $img['directory'] ?>" style="width:100%">
            </div>
        <?php endforeach; ?>




      <a class="prev" onclick="plusSlides(-1)">❮</a>
      <a class="next" onclick="plusSlides(1)">❯</a>

      <div class="caption-container">
        <p id="caption"></p>
      </div>

      <div class="row">
          <?php foreach( $data['roomtypes']->getImages($data['roomtype'][0]['id'], "370x305") as $key => $img ): ?>
              <div class="column">
                <img class="demo cursor" src="<?php echo $img['directory'] ?>" style="width:100%" onclick="currentSlide(<?php echo $key+1 ?>)" alt="<?php echo $data['roomtype'][0]['name'] ?>">
              </div>
          <?php endforeach; ?>


      </div>
    </div>


    <h1><?php echo $data['roomtype'][0]['name'] ?></h1>
    <h3>Php <?php echo number_format($data['roomtype'][0]['price'], 2, '.', ',') ?></h3>
    <p><?php echo $data['roomtype'][0]['description'] ?></p>
    <a href="<?php echo Globals::baseUrl(); ?>/public/customerreservation/<?php echo $data['roomtype'][0]['name'] ?>">
        <button class="product-container-button" type="button" name="button">Reserve now</button>
    </a>
</div>


<script type="text/javascript">

    $("#room-rates-nav").attr("class", "");
    $("#home-nav").attr("class", "");
    $("#contact-us-nav").attr("class", "");
    $("#room-name-nav").attr("class", "active");
    $("#room-name-nav").html(" | <?php echo $data['roomtype'][0]['name'] ?>");

</script>


<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      var i;
      var slides = document.getElementsByClassName("mySlides");
      var dots = document.getElementsByClassName("demo");
      var captionText = document.getElementById("caption");
      if (n > slides.length) {slideIndex = 1}
      if (n < 1) {slideIndex = slides.length}
      for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex-1].style.display = "block";
      dots[slideIndex-1].className += " active";
      captionText.innerHTML = dots[slideIndex-1].alt;
    }
</script>
