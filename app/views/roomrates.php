<?php include_once '../app/views/header/indexwithoutsliderheader.php' ?>
<?php include_once '../app/views/bodywithoutslider.php' ?>

<div class="content">

    <style media="screen">
        .product{
            margin-top: 4% !important;
        }
    </style>

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
                                <a class="product-title" href="#"><?php echo $rt['name'] ?></a>
                            </h2>
                          <p class="product-price">Php <?php echo number_format($rt['price'], 2, '.', ',') ?></p>

                          <div class="text ellipsis">
                              <p class="text-concat"><?php echo $rt['description'] ?></p>
                          </div>

                          <!-- <p>example@example.com</p> -->
                          <p><button class="product-container-button">Reserve Now</button></p>
                        </div>
                      </div>
                    </div>


                <?php $counter++; ?>
                <?php if( $counter == 3 ): ?>
                    </div>
                    <?php $counter=0; ?>
                <?php endif; ?>
        <?php endforeach; ?>

    </div>

</div>


<script type="text/javascript">

    $("#room-rates-nav").attr("class", "active");
    $("#home-nav").attr("class", "");
    $("#contact-us-nav").attr("class", "");

</script>
