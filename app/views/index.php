<?php include_once '../app/views/header/indexheader.php' ?>
<?php include_once '../app/views/body.php' ?>

<div class="content">

    <div class="content-paragraph">
        <i class="fas fa-quote-left fa-2x fa-pull-left fa-border"></i>
        <p>
            Set on the peaceful Hotel Rooms of Plaza Alemania, the Hotel welcomes guests with a beautiful grand hall. Elegant rooms, boasts a private hot tub for guests to relax in.
        </p>
    </div>


    <div class="product">

        <?php $counter = 0; ?>
        <?php foreach( $data['roomtypes']->get() as $rt ): ?>
                <?php if( $counter % 3 == 0 ): ?>
                    <div class="product-row">
                <?php endif; ?>

                    <div class="product-column">
                      <div class="card">
                          <div class="product-image-wrapper">
                              <img class="product-image" src="<?php echo $data['roomtypes']->getImages($rt['id'], '800x532')[0]['directory']; ?>" alt="Mike" style="width:100%">
                          </div>
                        <div class="product-container">
                            <h2>
                                <a class="product-title" href="<?php echo Globals::baseUrl(); ?>/public/viewroom/<?php echo $rt['name'] ?>"><?php echo $rt['name'] ?></a>
                            </h2>
                          <p class="product-price">Php <?php echo number_format($rt['price'], 2, '.', ',') ?></p>

                          <div class="text ellipsis">
                              <p class="text-concat"><?php echo $rt['description'] ?></p>
                          </div>

                          <!-- <p>example@example.com</p> -->

                          <p>
                              <a href="<?php echo Globals::baseUrl(); ?>/public/customerreservation/<?php echo $rt['name'] ?>">
                                  <button class="product-container-button" type="button" name="button">Reserve now</button>
                              </a>
                          </p>
                        </div>
                      </div>
                    </div>


                <?php $counter++; ?>
                <?php if( $counter == 3 ): ?>
                    </div>
                    <?php break; ?>
                    <?php $counter=0; ?>
                <?php endif; ?>
        <?php endforeach; ?>

    </div>

    <a href="<?php echo Globals::baseUrl(); ?>/public/roomrates">
        <button class="product-container-button" type="button" name="button">View more</button>
    </a>


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
