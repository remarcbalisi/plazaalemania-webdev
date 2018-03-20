<?php include_once '../app/views/header/adminheader.php' ?>
<?php include_once '../app/views/adminbody.php' ?>

<div class="main">

  <!-- ADD ROOM TYPES -->
  <div class="add-room-types">
      <div class="container">
        <h3>Edit <?php echo $data['roomtype'][0]['name'] ?></h3>

        <?php if( !empty($data['status']) ): ?>
            <?php if( $data['status'] == 409 && $data['for_form'] == 'editroomtype' ): ?>
                <p style="color:red"><?=$data['message']?></p>
            <?php elseif( $data['status'] == 200 && $data['for_form'] == 'editroomtype' ): ?>
                <p style="color:green"><?=$data['message']?></p>
            <?php endif; ?>
        <?php endif; ?>

        <form method="POST" action="<?php echo Globals::baseUrl(); ?>/public/adminrooms/updateroomtype/<?php echo $data['roomtype'][0]['id'] ?>" enctype="multipart/form-data">
          <label for="room_name">Room Name</label>
          <input class="input" type="text" id="room_name" name="room_name" placeholder="Room name.." value="<?php echo $data['roomtype'][0]['name'] ?>">

          <label for="price">Price</label>
          <input class="input" type="number" id="price" name="price" placeholder="₱" value="<?php echo $data['roomtype'][0]['price'] ?>">

          <label for="max_person">Max Person</label>
          <input class="input" type="number" id="max_person" name="max_person" placeholder="Max Person" value="<?php echo $data['roomtype'][0]['max_person'] ?>">

          <label for="description">Description</label>
          <textarea class="input" id="description" name="description" placeholder="Write something.." style="height:200px" ><?php echo $data['roomtype'][0]['description'] ?></textarea>

          <label for="branch_id">Branch</label>
          <select class="input" id="branch_id" name="branch_id">
            <?php foreach( $data['branches'] as $b ): ?>
                <?php if( $data['roomtype'][0]['branch_id'] == $b['id'] ): ?>
                    <option value="<?php echo $b['id']; ?>" selected><?php echo $b['name']; ?></option>
                <?php else: ?>
                    <option value="<?php echo $b['id']; ?>"><?php echo $b['name']; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
          </select>

          <label>Select Image(s) to be updated</label>
          <br>
          <br>
          <?php foreach( $data['roomtypes']->getImages($data['roomtype'][0]['id'], 'original') as $key => $img ): ?>
              <input type="checkbox" name="room_img_delete<?php echo $key+1 ?>_<?php echo $key+1 ?>" value="">Delete this photo? <?php echo $img['image_name'] ; ?>
              <br>
              <img width="300px" src="<?php echo $img['directory'] ; ?>" alt="">
              <br>
              <input type="file" name="room_img<?php echo $key+1 ?>_<?php echo $key+1 ?>" value="">
              <input type="hidden" name="room_img_meta<?php echo $key+1 ?>_<?php echo $key+1 ?>" value="<?php echo $img['meta'] ?>">
              <br>
              <br>
          <?php endforeach; ?>
          <br>

          <label for="room_img1">Upload Image (Recommended: 800 x 532)</label>

          <div class="addimagegroup">
              <div id="imageinputfield">
                  <input type="file" name="room_img1" class="input" id="inputGroupFile1">
              </div>

              <input type="hidden" name="image_count" id="image_count" value="1">
              <i style="color:green;" class="fas fa-plus fa-sm"><a style="text-decoration:none;color:green" href="javascript:;" onclick="imagefield('add')">&nbsp;More</a></i> &nbsp;
              <i id="remove_img" style="color:red;text-decoration:none;display:none" class="fas fa-minus fa-sm"><a style="text-decoration:none;color:red" href="javascript:;" onclick="imagefield('remove')">&nbsp;Remove</a></i>
          </div>


          <br>

          <input class="input-button" type="submit" value="Update">
        </form>
      </div>
  </div>
  <!-- ADD ROOM TYPES END -->

</div>


<script type="text/javascript">
    var imagecount = 1;
    function imagefield(action){
        // inputGroupFile1
        var imagefield = $("#imageinputfield");

        if( action == 'add' ){
            imagecount++;
            console.log(imagecount);
            if( imagecount > 1 ){
                $("#remove_img").show();
            }
            else{
                $("#remove_img").hide();
            }
            imagefield.append(function(){
                to_string = "";
                to_string += '<input type="file" name="room_img'+imagecount+'" class="input" id="inputGroupFile'+imagecount+'" required>';
                return to_string;
            });
        }
        else{
            $("#inputGroupFile"+imagecount).remove();
            imagecount--;
            if( imagecount > 1 ){
                $("#remove_img").show();
            }
            else{
                $("#remove_img").hide();
            }

        }

        document.getElementById('image_count').value = imagecount;
    }
</script>
