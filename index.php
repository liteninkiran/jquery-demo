<!DOCTYPE html>
<html>

    <head>

        <script type="text/javascript" src="jquery-3.5.1.min.js"></script>

        <title>AJAX</title>

        <style>

            body
            {
                font-family: calibri;
            }

            table, td, th
            {
                border: 1px solid black;
                padding: 10px;
            }

            table
            {
                width: 100%;
                border-collapse: collapse;
            }

            .container
            {
                width: 50%;
                margin: auto;
                margin-top: 40px;
            }

        </style>

    </head>

    <body>

<?php 

        // Create Connection
        $conn = mysqli_connect('localhost', 'root', '', 'ajaxtest');

        $query = 'SELECT * FROM users';

        // Get Result
        $result = mysqli_query($conn, $query);

        // Fetch Data
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

        <div class="container">

            <form action="" method="POST">

                <table>
                    
                    <thead>
                        
                        <tr>
                            <th width="30"><input type="checkbox" name="select-all" id="checkbox-all"></th>
                            <th>ID</th>
                            <th>Name</th>
                        </tr>

                    </thead>

                    <tbody>
<?php
                        foreach($users as $user)
                        {
?>
                            <tr>
                                <td style="text-align: center;"><input type="checkbox" name="select[]" value="<?= $user['name']; ?>" id="checkbox-<?= $user['id']; ?>" class="checkbox"></td>
                                <td><?= $user['id']; ?></td>
                                <td><?= $user['name']; ?></td>
                            </tr>
<?php
                        }
?>
                    </tbody>

                </table>

                <input type="submit" name="submit" value="Submit" style="margin-top: 20px; height: 40px; width: 100px; float: right;">

            </form>
            
        </div>


<?php

        if($_POST)
        {
            if(isset($_POST['select']))
            {
                $selected = $_POST['select'];

                echo '<h1>Selected Users</h1>';

                echo '<ul>';

                foreach($selected as $s)
                {
                    echo '<li>' . $s . '</li>';
                }


                echo '</ul>';
            }
        }


?>

        <script>

            $(document).ready(function()
            {
                $('#checkbox-all').click(function()
                {
                    var checkboxes = $('.checkbox');

                    for (i = 0; i < checkboxes.length; i++)
                    {
                        checkboxes[i].checked = this.checked;
                    }
                })
            });

        </script>

    </body>

</html>

