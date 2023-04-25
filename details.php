<?php

    include('db_connect/connect.php');

    // delete form

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM add_request WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)){
            // success
            header('Location: index.php');
        }else{
            // failure
            echo 'query error' . mysqli_error($conn);
        }
    }
    
    // check GET id param

    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        // make sql
        $sql = "SELECT * FROM add_request WHERE id = $id";

        // get query result

        $result = mysqli_query($conn, $sql);

        // fetch result in array format

        $requests = mysqli_fetch_assoc($result);

        // free result from memory

        mysqli_free_result($result);

        // close connection

        mysqli_close($conn);
    }


?>


<!DOCTYPE html>
<html lang="en">
<?php include('navbar/header.php'); ?>
<div class="container details-bg">
<h1 style="text-align: center; margin: 30px 0 20px 0;">Details</h1>
<div class="details">
    <?php if($requests): ?>

        <h5>Company name : <?php echo htmlspecialchars($requests['comp_name']);?></h5>
        <h5>Company Address : <?php echo htmlspecialchars($requests['com_add']);?></h5>
        <hr>
        <div class="del-name">
        <h6>Last name : <?php echo htmlspecialchars($requests['l_name']);?></h6>
        <h6>First name : <?php echo htmlspecialchars($requests['f_name']);?></h6>
        <h6>M.I : <?php echo htmlspecialchars($requests['m_name']);?></h6>
        </div>
        <br>
        <h6>Phone Number : <?php echo htmlspecialchars($requests['p_num']);?></h6>
        <h6>Email Address : <?php echo htmlspecialchars($requests['email']);?></h6>
        <hr>
        <h6 style="text-align: end;">Request Date : <?php echo htmlspecialchars($requests['today']);?></h6>
        <h6 style="text-align: end;">Deadline : <?php echo htmlspecialchars($requests['today']);?></h6>
        <h6>Job Offer : <?php echo htmlspecialchars($requests['job_off']);?></h6>
        <h6>Job Details : <?php echo htmlspecialchars($requests['job_details']);?></h6>
        <br>
        <br>
        <br>
        <br>
        <div class="del-name">

        <h6 style="border-top: 1px solid black; width: 25%; text-align: center; padding-top: 5px;">Approved by </h6>
        <h6 style="border-top: 1px solid black; width: 25%; text-align: center; padding-top: 5px;"><?php echo htmlspecialchars($requests['l_name']." ".$requests['f_name']." ".$requests['m_name']);?></h6>
        </div>
        <br>
    <?php else: ?>
        <h3 style="text-align: center; margin: 30px 0 20px 0;">No such Details exists!!</h3>
    <?php endif;?>
</div>

        <form action="details.php" method="POST">
        <div class="Delete-btn">
        <input type="hidden" name="id_to_delete" value="<?php echo $requests['id'] ?>">
        <input type="submit" name="delete" value="Delete">
        </div>
        </form>
        <br>
        <br>
</div>
<?php include('navbar/footer.php'); ?>
</html>