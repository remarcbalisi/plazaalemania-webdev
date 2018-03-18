<?php include_once '../app/views/header/adminheader.php' ?>
<?php include_once '../app/views/adminbody.php' ?>

<div class="main">
  <h2>Rooms</h2>

  <!-- ROOM TYPES TABLE -->
    <input type="text" id="roomtypeinput" onkeyup="myFunction()" placeholder="Search for room types.." title="Type in a name">

    <table id="roomtypetable">
      <tr class="header">
        <th style="width:60%;">Room Type</th>
        <th style="width:40%;">No. of Rooms</th>
      </tr>
      <tr>
        <td>Alfreds Futterkiste</td>
        <td>Germany</td>
      </tr>
      <tr>
        <td>Berglunds snabbkop</td>
        <td>Sweden</td>
      </tr>
      <tr>
        <td>Island Trading</td>
        <td>UK</td>
      </tr>
      <tr>
        <td>Koniglich Essen</td>
        <td>Germany</td>
      </tr>
      <tr>
        <td>Laughing Bacchus Winecellars</td>
        <td>Canada</td>
      </tr>
      <tr>
        <td>Magazzini Alimentari Riuniti</td>
        <td>Italy</td>
      </tr>
      <tr>
        <td>North/South</td>
        <td>UK</td>
      </tr>
      <tr>
        <td>Paris specialites</td>
        <td>France</td>
      </tr>
    </table>
  <!-- ROOM TYPES TABLE END -->


  <!-- ADD ROOM TYPES -->
  <div class="add-room-types">
      <div class="container">
        <h3>Add New Room Type</h3>
        <form action="/action_page.php">
          <label for="room_name">Room Name</label>
          <input class="input" type="text" id="room_name" name="room_name" placeholder="Room name..">

          <label for="price">Price</label>
          <input class="input" type="number" id="price" name="price" placeholder="₱">

          <label for="max_person">Max Person</label>
          <input class="input" type="number" id="max_person" name="max_person" placeholder="Max Person">

          <label for="description">Description</label>
          <textarea class="input" id="description" name="description" placeholder="Write something.." style="height:200px"></textarea>

          <label for="branch">Branch</label>
          <select class="input" id="branch" name="branch">
            <?php foreach( $data['branches'] as $b ): ?>
                <option value="<?php echo $b['id']; ?>"><?php echo $b['name']; ?></option>
            <?php endforeach; ?>
          </select>

          <input class="input-button" type="submit" value="Submit">
        </form>
      </div>
  </div>
  <!-- ADD ROOM TYPES END -->

</div>



<script>
function myFunction() {
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
