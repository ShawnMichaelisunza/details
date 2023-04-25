<?php

include('db_connect/connect.php');


// get page number
if(isset($_GET['page_no']) && $_GET['page_no'] !==""){
    $page_no = $_GET['page_no'];
}else{
    $page_no = 1;
}

// total rows or records to display

$total_records_per_page = 12;

// get the page offset for the LIMIT query

$offset = ($page_no -1) * $total_records_per_page;

// get previous page
$previous_page = $page_no -1;
// get next page 
$next_page = $page_no + 1;


// get the total count of records
$result_count = mysqli_query($conn, "SELECT COUNT(*) as total_records FROM project_data.add_info")
 or die(mysqli_error($conn));

//  total records
$records = mysqli_fetch_array($result_count);
// store total_records to a variable

$total_records = $records['total_records'];

// get total pages
$total_no_of_pages = ceil($total_records / $total_records_per_page);

// write query from database

$sql = "SELECT * FROM add_request ORDER BY current_at LIMIT $offset , $total_records_per_page";

// make query & get result

$result = mysqli_query($conn, $sql);

// fetch the resultiing rows an array

$requests = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory

mysqli_free_result($result);

// close connection

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
<nav class="page_bar">
    <ul>
        <li><a class=" <?=($page_no <= 1)? 'disabled' : '';?>"
        <?= ($page_no > 1)? 'href=?page_no=' . $previous_page : '';?>>Previous</a></li>

        
        <?php for($counter =1; $counter <= $total_no_of_pages; $counter++){?>
            <?php if($page_no != $counter){?>
        <li><a href="?page_no=<?= $counter?>"><?= $counter?></a></li>
            <?php } else {?>
            <li><a><?= $counter?></a></li>
            <?php }?>
        <?php }?>


        <li><a class=" <?=($page_no >= $total_no_of_pages)? 'disabled' : '';?>"
        <?= ($page_no < $total_no_of_pages)? 'href=?page_no=' . $next_page : '';?>>Next</a></li>
    </ul>
    <div class="display-page">
    <strong>Page <?= $page_no;?> of <?= $total_no_of_pages;?></strong>
    </div>
</nav>
</div>

<?php include('navbar/footer.php'); ?>


