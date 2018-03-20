<?php include_once '../app/views/header/adminheader.php' ?>
<?php include_once '../app/views/adminbody.php' ?>

<div class="main">
  <h2>Rooms</h2>

  <!-- ROOM TYPES TABLE -->
  <?php if( !empty($data['status']) ): ?>
      <?php if( $data['status'] == 409 && $data['for_form'] == 'deleteroomtype' ): ?>
          <p style="color:red"><?=$data['message']?></p>
      <?php elseif( $data['status'] == 200 && $data['for_form'] == 'deleteroomtype' ): ?>
          <p style="color:green"><?=$data['message']?></p>
      <?php endif; ?>
  <?php endif; ?>

    <input type="text" id="roomtypeinput" onkeyup="roomtypeinputkeyup()" placeholder="Search for room types.." title="Type in a name">

    <table id="roomtypetable">
      <tr class="header">
        <th style="width:60%;">Room Type</th>
        <th style="width:40%;">No. of Rooms</th>
        <th style="width:40%;">Action</th>
      </tr>
      <?php foreach( $data['roomtypes']->get() as $rt ): ?>
          <tr>
            <td><?php echo $rt['name']; ?></td>
            <td><?php echo count($data['roomtypes']->rooms($rt['id'])); ?></td>
            <td>
                <a href="#"><i class="fas fa-search fa-sm"></i></a>
                <a style="color:orange" href="<?php echo Globals::baseUrl(); ?>/public/adminrooms/editroomtype/<?php echo $rt['id'] ?>"><i class="fas fa-pencil-alt fa-sm"></i></a>
                <a style="color:red" href="javascript:;" onclick="deletepopup('<?php echo $rt['id']; ?>', 'show');">
                    <i class="fas fa-trash fa-sm"></i>
                </a>
                <div class="popup">
                    <span class="popuptext" id="deletepopup-<?php echo $rt['id']; ?>">
                        Are you sure?<br>
                        <a class="yes" href="<?php echo Globals::baseUrl(); ?>/public/adminrooms/deleteroomtype/<?php echo $rt['id'] ?>">Yes</a>
                        <a class="no" href="javascript:;" onclick="deletepopup('<?php echo $rt['id']; ?>', 'hide');">No</a>
                    </span>
                </div>

            </td>
          </tr>
      <?php endforeach; ?>

        <?php if( empty($data['roomtypes']->get()) ): ?>
            <tr>
                <td>No Room types yet..</td>
                <td></td>
                <td></td>
            </tr>
        <?php endif; ?>

    </table>
  <!-- ROOM TYPES TABLE END -->

 <!-- ADD ROOM -->

 <div class="add-room-types">
     <div class="container">
       <h3>Add New Room</h3>

       <?php if( !empty($data['status']) ): ?>
           <?php if( $data['status'] == 409 && $data['for_form'] == 'addroom' ): ?>
               <p style="color:red"><?=$data['message']?></p>
           <?php elseif( $data['status'] == 200 && $data['for_form'] == 'addroom' ): ?>
               <p style="color:green"><?=$data['message']?></p>
           <?php endif; ?>
       <?php endif; ?>

       <form method="POST" action="<?php echo Globals::baseUrl(); ?>/public/adminrooms/addroom">
         <label for="room_no">Room Number</label>
         <input class="input" type="text" id="room_no" name="room_no" placeholder="Room number..">


         <label for="room_type_id">Room Type</label>
         <select class="input" id="room_type_id" name="room_type_id">
           <?php foreach( $data['roomtypes']->get() as $rt ): ?>
               <option value="<?php echo $rt['id']; ?>"><?php echo $rt['name']; ?></option>
           <?php endforeach; ?>
         </select>

         <input class="input-button" type="submit" value="Add">
       </form>
     </div>
 </div>
 <!-- ADD ROOM END -->


  <!-- ADD ROOM TYPES -->
  <div class="add-room-types">
      <div class="container">
        <h3>Add New Room Type</h3>

        <?php if( !empty($data['status']) ): ?>
            <?php if( $data['status'] == 409 && $data['for_form'] == 'addroomtype' ): ?>
                <p style="color:red"><?=$data['message']?></p>
            <?php elseif( $data['status'] == 200 && $data['for_form'] == 'addroomtype' ): ?>
                <p style="color:green"><?=$data['message']?></p>
            <?php endif; ?>
        <?php endif; ?>

        <form method="POST" action="<?php echo Globals::baseUrl(); ?>/public/adminrooms/addroomtype" enctype="multipart/form-data">
          <label for="room_name">Room Name</label>
          <input class="input" type="text" id="room_name" name="room_name" placeholder="Room name..">

          <label for="price">Price</label>
          <input class="input" type="number" id="price" name="price" placeholder="₱">

          <label for="max_person">Max Person</label>
          <input class="input" type="number" id="max_person" name="max_person" placeholder="Max Person">

          <label for="description">Description</label>
          <textarea class="input" id="description" name="description" placeholder="Write something.." style="height:200px"></textarea>

          <label for="branch_id">Branch</label>
          <select class="input" id="branch_id" name="branch_id">
            <?php foreach( $data['branches'] as $b ): ?>
                <option value="<?php echo $b['id']; ?>"><?php echo $b['name']; ?></option>
            <?php endforeach; ?>
          </select>

          <label for="room_img1">Upload Image (Recommended: 800 x 532)</label>

          <div class="addimagegroup">
              <div id="imageinputfield">
                  <input type="file" name="room_img1" class="input" id="inputGroupFile1" required>
              </div>

              <input type="hidden" name="image_count" id="image_count" value="1">
              <i style="color:green;" class="fas fa-plus fa-sm"><a style="text-decoration:none;color:green" href="javascript:;" onclick="imagefield('add')">&nbsp;More</a></i> &nbsp;
              <i id="remove_img" style="color:red;text-decoration:none;display:none" class="fas fa-minus fa-sm"><a style="text-decoration:none;color:red" href="javascript:;" onclick="imagefield('remove')">&nbsp;Remove</a></i>
          </div>


          <br>

          <input class="input-button" type="submit" value="Add">
        </form>
      </div>
  </div>
  <!-- ADD ROOM TYPES END -->

</div>



<script>
    function roomtypeinputkeyup() {
      var input, filter, table, tr, td, i;
      input = document.getElementById("roomtypeinput");
      filter = input.value.toUpperCase();
      table = document.getElementById("roomtypetable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
</script>

<script>
    // When the user clicks on div, open the popup
    function deletepopup(id, action) {
        var popup = document.getElementById("deletepopup-"+id);
        if( action == "hide" ){
            popup.classList.remove("show");
            popup.classList.add(action);
        }
        else{
            popup.classList.toggle(action);
        }

    }
</script>

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
