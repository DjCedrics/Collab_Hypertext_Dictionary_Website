<?php
    include("session.php");

    if(isset($_POST['create_category'])){

        $category = mysqli_real_escape_string($db, $_POST['create_category_name']);

        $query = "INSERT INTO Category (categoryname) VALUES ('$category')";
        $data = mysqli_query ($db,$query)or die(mysqli_error($db));
    }

    if(isset($_POST['create_subcategory'])){

        $subcategory = mysqli_real_escape_string($db, $_POST['create_subcategory_name']);
        $catname = $_POST['parent_category'];
        //echo '<div class="alert alert-success" role="alert">'.$catname.'</div>';

        $query = "SELECT ID FROM Category WHERE categoryname='$catname'";
        $result = $db->query($query);

        $row = $result->fetch_assoc();
        $categoryID = $row["ID"];
              
        $query = "INSERT INTO Subcategory (c_id, subcategoryname) VALUES ($categoryID, '$subcategory')";
        $data = mysqli_query ($db,$query)or die(mysqli_error($db));
    }

    if(isset($_POST['change_subcategory']))
    {
        $parentname = $_POST['change_parent_name'];
        $subcategoryname = $_POST['change_subcategory_name'];
        
        $query = "SELECT * FROM Subcategory WHERE subcategoryname='$subcategoryname'";
        $result = $db->query($query);
        
        $row = $result->fetch_assoc();
        $sub_id = $row['sub_id'];
        
        $query = "SELECT * FROM Category WHERE categoryname='$parentname'";
        $result = $db->query($query);
        
        $row = $result->fetch_assoc();    
        $c_id = $row['ID'];
        
        $query = "UPDATE Subcategory SET c_id = '$c_id' WHERE sub_id = '$sub_id'";
        //$result = $db->query($query);
        $result = mysqli_query($db,$query)or die(mysqli_error($db));
        if ($result)
        {
            echo '<div class="alert alert-success" role="alert">Parent category of '.$sub_id.' is changed to '.$c_id.' successfully. </div>'; 
        }
    }

    /*if(isset($_POST['change_parent'])){

        $newParentID = mysqli_real_escape_string($db, $_POST['newID']);

    }*/
?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M:\Bilkent\CS353\Project\Frontend\AdminPanel</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button><a class="navbar-brand navbar-link" href="#">CaseSwitchers </a></div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li role="presentation"><a href="index.php">Home </a></li>
                    <li role="presentation"><a href="posts.php">Posts </a></li>
                    <li role="presentation"><a href="#">Categories </a></li>
                    <li role="presentation"><a href="#">Users </a></li>
                    <li role="presentation"></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        if(isset($_SESSION['admin']))
                        {
                            echo '<li role="presentation"><a href="adminpanel.php">Admin Panel </a></li>';
                        }
                        if(isset($_SESSION['login_user']))
                        {
                            echo '<li role="presentation"><a href="profile.php?id='.$login_id.'">Profile </a></li>';
                            echo '<li role="presentation"><a href="logout.php">Logout </a></li>';
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Admin Panel</h1></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-warning"><span>Total Posts: 12903</span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Comments: 45940</span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Categories: 23</span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total SubCategories: 53</span></li>
                            <li class="list-group-item list-group-item-warning"><span>Total Users: 65038</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <h4>Edit Post</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Post ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <label>Select Category</label>
                                <select>
                                    <optgroup label="This is a group">
                                        <option value="12" selected="">Blockchain</option>
                                        <option value="13">This is item 2</option>
                                        <option value="14">This is item 3</option>
                                    </optgroup>
                                </select>
                            </li>
                            <li class="list-group-item">
                                <label>Select Subcategory</label>
                                <select>
                                    <optgroup label="This is a group">
                                        <option value="13">This is item 2</option>
                                        <option value="12" selected="">Altcoins</option>
                                        <option value="14">This is item 3</option>
                                    </optgroup>
                                </select>
                            </li>
                            <li class="list-group-item">
                                <textarea class="input-lg">Put your post here</textarea>
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Delete Post</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Post ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Edit Comment</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Comment ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <textarea class="input-lg">Put your comment here</textarea>
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Delete Comment</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Comment ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Ban User</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>User ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <h4>Unban User</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>User ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                <form method="post" action="">
                    <div class="col-md-12">
                        <h4>Create Category</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Category Name</label>
                                <input type="text" name="create_category_name">
                            </li>
                            <li class="list-group-item">
                                <button name="create_category" class="btn btn-success" type="submit">Submit </button>
                            </li>
                        </ul>
                    </div>
                </form>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Delete Category</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Category ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <form method="post" action="">
                        <h4>Create Subcategory</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Select Category</label>
                                <select name="parent_category">
                                    <optgroup label="This is a group">
                                        <?php
                                            $query = "SELECT categoryname FROM Category";
                                            $result = $db->query($query);
                                            while($row = $result->fetch_assoc()){
                                                $name = $row['categoryname'];
                                                echo '<option name='.$name.' value='.$name.' style="color: black">'.$name.'</option>';
                                            }
                                            $parent_category = $name;
                                        ?>
                                    </optgroup>
                                </select>
                            </li>
                            <li class="list-group-item">
                                <label>Subcategory Name</label>
                                <input type="text" name="create_subcategory_name">
                            </li>
                            <li class="list-group-item">
                                <button name="create_subcategory" class="btn btn-success" type="submit">Submit </button>
                            </li>
                        </ul>
                    </form>
                    </div>
                    <div class="col-md-12">
                    <form method="post" action="">
                        <h4>Change Subcategory Parent</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>Select Category</label>
                                <select name="change_parent_name">
                                    <optgroup label="This is a group">
                                        <?php
                                            $query = "SELECT categoryname FROM Category";
                                            $result = $db->query($query);
                                            while($row = $result->fetch_assoc()){
                                                $name = $row['categoryname'];
                                                echo '<option value='.$name.' style="color: black">'.$name.'</option>';
                                            }
                                        ?>
                                    </optgroup>
                                </select>
                            </li>
                            <li class="list-group-item">
                                <label>Select Subcategory</label>
                                <select name="change_subcategory_name">
                                    <optgroup label="This is a group">
                                        <?php
                                            $query = "SELECT subcategoryname FROM Subcategory";
                                            $result = $db->query($query);
                                            while($row = $result->fetch_assoc()){
                                                $name = $row['subcategoryname'];
                                                echo '<option value='.$name.' style="color: black">'.$name.'</option>';
                                            }
                                        ?>
                                    </optgroup>
                                </select>
                            </li>
                            <li class="list-group-item">
                                <button name="change_subcategory" class="btn btn-success" type="submit">Submit </button>
                            </li>
                        </ul>
                    </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Update User Bio</h4>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <label>User ID</label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <label>Name </label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <label>Surname </label>
                                <input type="text">
                            </li>
                            <li class="list-group-item">
                                <textarea class="input-lg">Put user bio here</textarea>
                            </li>
                            <li class="list-group-item">
                                <button class="btn btn-success" type="button">Submit </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>