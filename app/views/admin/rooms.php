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
