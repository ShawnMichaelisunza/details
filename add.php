<?php

    include('db_connect/connect.php');

    $lastName = $firstName = $middleName = $phoneNum = $email = $date = $compName = $compAdd = $jobOffer = $apptNo = $deadline = '';
    $error = array('last-name' =>'', 'first-name' =>'', 'middle-name' =>'', 'phone-number' =>'', 'email' =>'', 'date' =>'', 'comp-name' =>'',
    'comp-address' =>'', 'job-offer' =>'', 'applicant-no' =>'', 'deadline' =>'');

    if(isset($_POST['submit'])){
        
        //-------------

        $lastName = $_POST['last-name'];
        $firstName = $_POST['first-name'];
        $middleName = $_POST['middle-name'];
        $phoneNum = $_POST['phone-number'];
        $email = $_POST['email'];
        $date = $_POST['date'];
        $compName = $_POST['comp-name'];
        $compAdd = $_POST['comp-address'];
        $jobOffer = $_POST['job-offer'];
        $apptNo = $_POST['applicant-no'];
        $deadline = $_POST['deadline'];
        $jobDetails = $_POST['job-detail'];
        

        //-------------

        if(empty($_POST['last-name'])){
            $error['last-name'] = '* Last name is Required';

        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $lastName)){
                $error['last-name'] = '* Letters only';
            }
        }

        if(empty($_POST['first-name'])){
            $error['first-name'] = '* First name is Required';

        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $firstName)){
                $error['first-name'] = '*Letters only';
            }
        }

        if(empty($_POST['middle-name'])){
            $error['middle-name'] = '* Middle name is Required';

        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $middleName)){
                $error['middle-name'] = '* Letters only';
            }
        }

        if(empty($_POST['phone-number'])){
            $error['phone-number'] = '* Phone number is Required';

        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $phoneNum)){
                $error['phone-number'] = '* Numbers only';
            }
        }

        if(empty($_POST['email'])){
            $error['email'] = '* Enter an email';
        }else{
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $error['email'] = '* email must be a valid email address';
            }
        }

        if(empty($_POST['date'])){
            $error['date'] = '* Date is Required';
        }

        if(empty($_POST['comp-name'])){
            $error['comp-name'] = '* Company Name is Required';
        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $compName)){
                $error['comp-name'] = '* Letters only';
            }
        }

        if(empty($_POST['comp-address'])){
            $error['comp-address'] = '* Company Address is Required';
        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $compAdd)){
                $error['comp-address'] = '* Letters only';
            }
        }

        if(empty($_POST['job-offer'])){
            $error['job-offer'] = '* Job offer is Required';
        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $compAdd)){
                $error['job-offer'] = '* Letters only';
            }
        }

        if(empty($_POST['applicant-no'])){
            $error['applicant-no'] = '* Applicant needed is Required';

        }else{
            if(!preg_match('/^[a-zA-Z\s]+$/', $apptNo)){
                $error['applicant-no'] = '* Numbers only';
            }
        }

        if(empty($_POST['deadline'])){
            $error['deadline'] = '* Deadline is Required';
        }else{

        $lastName = mysqli_real_escape_string($conn, $_POST['last-name']);
        $firstName = mysqli_real_escape_string($conn, $_POST['first-name']);
        $middleName = mysqli_real_escape_string($conn, $_POST['middle-name']);
        $phoneNum = mysqli_real_escape_string($conn, $_POST['phone-number']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);
        $compName = mysqli_real_escape_string($conn, $_POST['comp-name']);
        $compAdd = mysqli_real_escape_string($conn, $_POST['comp-address']);
        $jobOffer = mysqli_real_escape_string($conn, $_POST['job-offer']);
        $apptNo = mysqli_real_escape_string($conn, $_POST['applicant-no']);
        $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);
        $jobDetails = mysqli_real_escape_string($conn, $_POST['job-detail']);

        $sql = "INSERT INTO add_request(l_name, f_name, m_name, p_num, email, today, comp_name, com_add, job_off, app_no, deadline, job_details)
        VALUES ('$lastName', '$firstName', '$middleName', '$phoneNum', '$email', '$date', '$compName', '$compAdd', '$jobOffer', '$apptNo', '$deadline', '$jobDetails')";

            if(mysqli_query($conn, $sql)){
                // success
                header('Location: index.php');
            }else{
                echo 'query errors' . mysqli_error($conn); 
            }
}
}



?>

<!DOCTYPE html>
<html lang="en">

<?php include('navbar/header.php'); ?>

<section class="container">
    <h1 style="text-align: center; margin: 30px 0 0 0;">Add Request Form</h1>
    <br>
    <div class="forms container-sm">
        <form action="add.php" method="POST">
            <div class="full-name">
                <div class="name">
                <label for="last-name">Last name</label>
                <input type="text" name="last-name" value="<?php echo htmlspecialchars($lastName)?>">
                <div style="font-family: arial; font-size: 13px; color: red;"><?php echo $error['last-name']?></div>
                </div>
                <div class="name">
                <label for="first-name">First name</label>
                <input type="text" name="first-name" value="<?php echo htmlspecialchars($firstName)?>">
                <div style="font-family: arial; font-size: 13px; color: red;"><?php echo $error['first-name']?></div>
                </div>
                <div class="name">
                <label for="middle-name">Middle name</label>
                <input type="text" name="middle-name" value="<?php echo htmlspecialchars($middleName)?>">
                <div style="font-family: arial; font-size: 13px; color: red;"><?php echo $error['middle-name']?></div>
                </div>

                <!--  -->
                <div class="name">
                <label for="phone-number">Phone Number</label>
                <input type="number" name="phone-number" value="<?php echo htmlspecialchars($phoneNum)?>">
                <div style="font-family: arial; font-size: 13px; color: red;"><?php echo $error['phone-number']?></div>
                </div>

                <div class="name">
                <label for="email">Email Address</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email)?>">
                <div style="font-family: arial; font-size: 13px; color: red;"><?php echo $error['email']?></div>
                </div>
                
                <div class="name">
                <label for="date">Date</label>
                <input type="date" name="date" value="<?php echo htmlspecialchars($date)?>">
                <div style="font-family: arial; font-size: 13px; color: red;"><?php echo $error['date']?></div>
                </div>
            </div>
            <br>
            <hr style="border: 1px solid white;">

            <div class="company">
                <div class="name">
                <label for="comp-name">Company name</label>
                <input type="text" name="comp-name" value="<?php echo htmlspecialchars($compName)?>">
                <div style="font-family: arial; font-size: 13px; color: red;"><?php echo $error['comp-name']?></div>
                </div>
                <div class="name">
                <label for="comp-address">Company Address</label>
                <input type="text" name="comp-address" value="<?php echo htmlspecialchars($compAdd)?>">
                <div style="font-family: arial; font-size: 13px; color: red;"><?php echo $error['comp-address']?></div>
                </div>
                </div>

                <div class="full-name">
                <div class="name">
                <label for="job-offer">Job Offer 's</label>
                <input type="text" name="job-offer" value="<?php echo htmlspecialchars($jobOffer)?>">
                <div style="font-family: arial; font-size: 13px; color: red;"><?php echo $error['job-offer']?></div>
                </div>

                <div class="name">
                <label for="job-offer" style="font-size: 15px;">No. of Applicants needed</label>
                <input type="number" name="applicant-no" value="<?php echo htmlspecialchars($apptNo)?>">
                <div style="font-family: arial; font-size: 13px; color: red;"><?php echo $error['applicant-no']?></div>
                </div>

                <div class="name">
                <label for="deadline">Deadline</label>
                <input type="date" name="deadline" value="<?php echo htmlspecialchars($deadline)?>">
                <div style="font-family: arial; font-size: 13px; color: red;"><?php echo $error['deadline']?></div>
                </div>
                </div>

                <div class="company">
                <div class="job-offer">
                    <label for="">Job Details</label>
                    <textarea name="job-detail" id="" cols="97" rows="5"></textarea>
                </div>
                </div>
                <hr style="border: 1px solid white;">
                <br>
                <div class="form-btn">
                    <input type="submit" name="submit" value="Submit">
                    <input type="reset" name="cancel" value="Cancel">
                </div>
                </div>
        </form>
    </div>
</section>

<?php include('navbar/footer.php'); ?>

