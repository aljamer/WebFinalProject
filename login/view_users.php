<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css"> <!--css file link in bootstrap folder-->
    <title>View Users</title>
</head>
<style>
    .login-panel {
        margin-top: 150px;
    }
    .table {
        margin-top: 50px;

    }

</style>

<body>

<nav class="container">
    <div class="table-scrol">
        <h4 align="right" > <a class="btn btn-success btn-lg" href="admin_login.php">Log-out here</a>  </h4> 

        <?php
        if(isset($_GET['msg']))
        {
            if($_GET['msg'] == "emptytxt")
                {
                    ?>
                    <div class="alert alert-danger">
                        <?php 
                            echo"Fill up the form properly";
                        ?>

                    </div>
                    <?php
                }
            elseif($_GET['msg'] == "success")
                {
                    ?>
                    <div class="alert alert-success">
                        <?php 
                            echo"Item added successfully";
                        ?>

                    </div>
                    <?php
                }
            elseif($_GET['msg'] == "Updated")
                {
                    ?>
                    <div class="alert alert-success">
                        <?php 
                            echo"Item updated successfully";
                        ?>

                    </div>
                    <?php
                }
            elseif($_GET['msg'] == "added")
                {
                    ?>
                    <div class="alert alert-success">
                        <?php 
                            echo"Item added successfully";
                        ?>

                    </div>
                    <?php
                }            
             elseif($_GET['msg'] == "dupplicate")
                {
                    ?>
                    <div class="alert alert-danger">
                        <?php 
                            echo"Email dupplicate";
                        ?>

                    </div>
                    <?php
                }                   
            elseif ($_GET['msg'] == "deleted") 
                {
                    ?>
                    <div class="alert alert-danger">
                        <?php 
                            echo"Item deleted successfully";
                        ?>

                    </div>
                    <?php
                }
        }   
        ?>


    <h1 align="center">All the Users</h1>
<div class="table-responsive"><!--this is used for responsive display in mobile and other devices-->


    <table class="table table-bordered table-hover table-striped" style="table-layout: fixed">
        <thead>

        <tr>

            <th>User Id</th>
            <th>User Name</th>
            <th>User E-mail</th>
            <th>User Pass</th>
            <th>Action</th>
        </tr>
        </thead>

        <?php
        include("database/db_conection.php");
        $view_users_query="select * from users";//select query for viewing users.
        $run=mysqli_query($dbcon,$view_users_query);//here run the sql query.

        while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.
        {
            $user_id=$row['id'];
            $user_name=$row['user_name'];
            $user_email=$row['user_email'];
            $user_pass=$row['user_pass'];



        ?>

        <tr>
<!--here showing results in the table -->
            <td><?php echo $user_id;  ?></td>
            <td><?php echo $user_name;  ?></td>
            <td><?php echo $user_email;  ?></td>
            <td><?php echo $user_pass;  ?></td>
            <td>
                  <a href="view_users.php?edit=<?php echo $user_id ?>"><button class="btn btn-info">Edit</button></a>
                <a href="action.php?del=<?php echo $user_id ?>"><button class="btn btn-danger">Delete</button></a>
             
            </td>
            
        </tr>

        <?php } ?>

    </table>
        </div>
        
</div>
<div class="col-md-4 col-md-offset-4">

            <div style="  border-radius: 5px;
                             background-color: #f2f2f2;
                         padding: 20px;" class="panel-body">
                <form  role="form" method="post" action="action.php">

                    <?php 
                      require 'action.php';
                       ?>
                    <fieldset>
                        <input type="hidden" name="id" value="<?php echo $id1; ?>">
                        <div class="form-group">
                            <input class="form-control" type="text" value="<?php echo $user_name1; ?>" name="txtName" placeholder="User Name">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" value="<?php echo $user_email1; ?>" name="txtEmail" placeholder="User E-mail">       
                        </div>
                         <div class="form-group">
                            <input class="form-control" type="text" value="<?php echo $user_pass1; ?>" name="txtPass" placeholder="User Password">       
                        </div>
                        <div class="form-group">


                            <?php 
                          
                                if($update == false){   
                                     ?>
                                     <input class="btn btn-primary btn-md" type="submit" name="btnSubmit" value="Add new">
                                     <input class="btn btn-primary btn-md" type="reset" value="Clear">
                                     <?php 
                                }
                                elseif ($update == true){
                                    ?>
                                    <input class="btn btn-info btn-md" type="submit" name="btnUpdate" value="Update">
                                    <a href="view_users.php"> <input class="btn btn-info btn-md" type="button" value="Cancel"></a>
                                    <?php
                                }
                            ?>
   
                            
                        </div>
                    </fieldset>     
                </form>
            </div>

        </div>
</nav>

</body>

</html>
