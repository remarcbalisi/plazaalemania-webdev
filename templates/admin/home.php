<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- STYLES -->
        <link rel="stylesheet" href="css/style2.css">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <!-- STYLES END -->

        <!-- JQUERY -->
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.js"></script>

        <title>Admin - Login</title>
    </head>
    <body>

        <!-- NAVBAR START -->
        <ul class="sidenav">
          <li><a class="active" href="#home">Dashboard</a></li>
          <li><a href="#news">Users</a></li>
          <li><a href="#contact">Rooms</a></li>
          <li><a href="#about">Logout</a></li>
        </ul>
        <!-- NAVBAR END -->

        <div class="content">
          <h2>Transactions</h2>
            <table>
              <tr>
                <th>Company</th>
                <th>Contact</th>
                <th>Country</th>
              </tr>
              <tr>
                <td>Alfreds Futterkiste</td>
                <td>Maria Anders</td>
                <td>Germany</td>
              </tr>
              <tr>
                <td>Centro comercial Moctezuma</td>
                <td>Francisco Chang</td>
                <td>Mexico</td>
              </tr>
              <tr>
                <td>Ernst Handel</td>
                <td>Roland Mendel</td>
                <td>Austria</td>
              </tr>
              <tr>
                <td>Island Trading</td>
                <td>Helen Bennett</td>
                <td>UK</td>
              </tr>
              <tr>
                <td>Laughing Bacchus Winecellars</td>
                <td>Yoshi Tannamuri</td>
                <td>Canada</td>
              </tr>
              <tr>
                <td>Magazzini Alimentari Riuniti</td>
                <td>Giovanni Rovelli</td>
                <td>Italy</td>
              </tr>
            </table>
        </div>


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

    </body>
</html>
