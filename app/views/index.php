<?php include_once '../app/views/header/indexheader.php' ?>
<?php include_once '../app/views/body.php' ?>

<div class="content">

    <div class="product">
        <div class="product-row">
          <div class="product-column">
            <div class="card">
                <div class="product-image-wrapper">
                    <img class="product-image" src="<?php echo Globals::baseUrl(); ?>/public/img/coverphotos/cover-photo1.jpg" alt="Mike" style="width:100%">
                </div>
              <div class="product-container">
                  <h2>
                      <a class="product-title" href="#">Coral Room</a>
                  </h2>
                <p class="product-price">Php 700.00</p>
                <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                <p>example@example.com</p>
                <p><button class="product-container-button">Reserve Now</button></p>
              </div>
            </div>
          </div>

          <div class="product-column">
            <div class="card">
                <div class="product-image-wrapper">
                    <img class="product-image" src="<?php echo Globals::baseUrl(); ?>/public/img/coverphotos/cover-photo1.jpg" alt="Mike" style="width:100%">
                </div>
              <div class="product-container">
                  <h2>
                      <a class="product-title" href="#">Onyx Room</a>
                  </h2>
                <p class="product-price">Php 1000.00</p>
                <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                <p>example@example.com</p>
                <p><button class="product-container-button">Reserve Now</button></p>
              </div>
            </div>
          </div>
          <div class="product-column">
            <div class="card">
                <div class="product-image-wrapper">
                    <img class="product-image" src="<?php echo Globals::baseUrl(); ?>/public/img/coverphotos/cover-photo1.jpg" alt="Mike" style="width:100%">
                </div>
              <div class="product-container">
                  <h2>
                      <a class="product-title" href="#">Sapphire Room</a>
                  </h2>
                <p class="product-price">Php 1500.00</p>
                <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                <p>example@example.com</p>
                <p><button class="product-container-button">Reserve Now</button></p>
              </div>
            </div>
          </div>
        </div>

        <div class="product-row">
          <div class="product-column">
            <div class="card">
                <div class="product-image-wrapper">
                    <img class="product-image" src="<?php echo Globals::baseUrl(); ?>/public/img/coverphotos/cover-photo1.jpg" alt="Mike" style="width:100%">
                </div>
              <div class="product-container">
                <h2>
                    <a class="product-title" href="#">Coral Room</a>
                </h2>
                <p class="product-price">Php 700.00</p>
                <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                <p>example@example.com</p>
                <p><button class="product-container-button">Reserve Now</button></p>
              </div>
            </div>
          </div>

          <div class="product-column">
            <div class="card">

                <div class="product-image-wrapper">
                    <img class="product-image" src="<?php echo Globals::baseUrl(); ?>/public/img/coverphotos/cover-photo1.jpg" alt="Mike" style="width:100%">
                </div>

              <div class="product-container">
                  <h2>
                      <a class="product-title" href="#">Onyx Room</a>
                  </h2>
                <p class="product-price">Php 1000.00</p>
                <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                <p>example@example.com</p>
                <p><button class="product-container-button">Reserve Now</button></p>
              </div>
            </div>
          </div>
          <div class="product-column">
            <div class="card">
                <div class="product-image-wrapper">
                    <img class="product-image" src="<?php echo Globals::baseUrl(); ?>/public/img/coverphotos/cover-photo1.jpg" alt="Mike" style="width:100%">
                </div>
              <div class="product-container">
                <h2>
                    <a class="product-title" href="#">Sapphire Room</a>
                </h2>
                <p class="product-price">Php 1500.00</p>
                <p>Some text that describes me lorem ipsum ipsum lorem.</p>
                <p>example@example.com</p>
                <p><button class="product-container-button">Reserve Now</button></p>
              </div>
            </div>
          </div>
        </div>

    </div>

</div>

<script type="text/javascript">
    var photoindex = 2;
    var lastIndex = 4;
    function changeCoverPhoto(){
        var coverphoto = $("#cover-photo-img");
        var coverphoto_wrapper = $("#cover-photo-wrapper");
        coverphoto_wrapper.hide( "slide", { }, "slow" );
        coverphoto.attr("src", "<?php echo Globals::baseUrl(); ?>/public/img/coverphotos/cover-photo"+photoindex+".jpg");
        coverphoto_wrapper.show( "fade", {  }, "fast" );
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
