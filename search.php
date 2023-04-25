<?php

include('db_connect/connect.php');

// search bar
$search = $_GET['search'];

// write query from all database
$sql = "SELECT * FROM add_request WHERE f_name LIKE '%$search%' or l_name LIKE '%$search%' or 
comp_name LIKE '%$search%' ORDER BY current_at";

// make query & get result
$result = mysqli_query($conn, $sql);

// fetch the resultiing rows an array

$requests = mysqli_fetch_all($result, MYSQLI_ASSOC);


//free result from memory
mysqli_free_result($result);

//close connection
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('navbar/header.php'); ?>

<div class="container">
    <form class="search" method="GET" action="search.php">
        <input class="form-control" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
      <br>
<h1 style="text-align: center; margin: 30px 0 20px 0;">Request Form</h1>
<div class="forms">
    <?php foreach($requests as $requesting){ ?>
        <div class="card" style="width: 18rem; margin: 10px;">
        <div class="card-body">
            <p style="text-align: end;"><?php echo htmlspecialchars($requesting['id']);?></p>
            <h5 class="card-title"><?php echo htmlspecialchars($requesting['l_name']." ".$requesting['f_name']." ".$requesting['m_name']);?></h5>
            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo htmlspecialchars($requesting['comp_name']);?></h6>
            <h6 class="card-subtitle mb-2 text-body-secondary"><?php echo htmlspecialchars($requesting['com_add']);?></h6>
            <br>
            <p style="text-align: end;"><?php echo htmlspecialchars($requesting['current_at']);?></p>
            <div class="card-btn">
            <a href="details.php?id=<?php echo $requesting['id']?>">More Info</a>
            </div>
        </div>
        </div>
    <?php }?>
</div>
</div>

<?php include('navbar/footer.php'); ?>
