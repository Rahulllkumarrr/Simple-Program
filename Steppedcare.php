<?php



session_start();



include '../functions/conn.php';



if(!(isset($_SESSION["userSession"]))){



    header("location:../index.php");



}







if(isset($_SESSION["userLevel"])){



    if($_SESSION["userLevel"] != 'Clinician'){



        echo "<script>window.history.back()</script>";



    }



}



$getuserDetails = "SELECT * FROM User WHERE UserID = '".$_SESSION['userSession']."'";

$getuserDetailsQ = mysqli_query($conn, $getuserDetails);

$getuserDetailsF = mysqli_fetch_assoc($getuserDetailsQ);

$title = $getuserDetailsF['Title'];

$firstName = $getuserDetailsF['FirstName'];

$lastName = $getuserDetailsF['LastName'];

$birthday = $getuserDetailsF['DateOfBirth'];

$landlineNumber = $getuserDetailsF['LandlineNumber'];

$mobileNumber = $getuserDetailsF['MobileNumber'];

$email = $getuserDetailsF['EmailAddress'];

?>



<!DOCTYPE html>



<html class="inner-page">



<head>



    <title>Clinician | Stepped Care</title>



    <link rel="icon" href="../img/favicon.ico" type="image/x-icon" />



    <link rel="stylesheet" href="../css/bootstrap.min.css">



    <link rel="stylesheet" href="../css/style.css">



    <link rel="stylesheet" href="../css/animate.css">



    <link rel="stylesheet" href="../css/font-awesome.min.css">



    <link rel="stylesheet" href="../css/jquery-ui.min.css">
    <link rel="stylesheet" href="../css/toastr.min.css">



    <script src="../js/jquery.js"></script>



    <script src="../js/bootstrap.min.js"></script>



    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/toastr.min.js"></script>



</head>



<body class="inner-page animated fadeIn">



<nav class="navbar navbar-default">



    <div class="container-fluid">



        <div class="navbar-header">



            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">



                <span class="sr-only">Toggle navigation</span>



                <span class="icon-bar"></span>



                <span class="icon-bar"></span>



                <span class="icon-bar"></span>



            </button>



            <a class="navbar-brand" href="index.php"><span class="brand-first"><strong>IEE</strong></span><small class="brand-second">Intervention Evolution Engine</small></a>



        </div>





        <div class="collapse navbar-collapse text-center" id="bs-example-navbar-collapse-1">



            <ul class="nav navbar-nav navbar-right">



                <li><a href="index.php" class="nav-link"><i class="fa fa-home"></i> Home</a></li>



                <li><a href="../functions/logout.php" class="nav-link"><i class="fa fa-sign-out"></i> Sign Out</a></li>



            </ul>



        </div>



    </div>



</nav>



<div class="container">



    <div class="row">



        <div class="col-lg-3 col-md-4 box-wrap">



            <div class="col-md-12 box">



                <div class="col-md-12 box-header-wrap">

                    <span class="box-header"><i class="fa fa-user"></i> Profile</span>

                </div>



                <div class="col-md-12 box-content">

                    <div class="col-md-12 profile-picture-wrap">

                        <img src="../img/user/default-doctor.png" class="img-responsive profile-picture" align="middle">

                    </div>

                    <div class="col-md-12 welcome-wrap text-center">

                        <span class="welcome">Welcome <?php echo $title.' '.$firstName; ?></span>

                    </div>

                    <div class="col-md-12 contact-wrap text-center">

                        <div class="col-md-12">

                            <?php echo $email; ?>

                        </div>

                        <div class="col-md-12">

                            <?php echo $mobileNumber; ?>

                        </div>

                    </div>

                </div>



            </div>



        </div>



        <div class="col-lg-9 col-md-8 box-wrap">



            <div class="col-md-12 box">
                <?php
                $PatientID = $_GET['id'];
                $RiskScore = $_GET['score'];
                $getPatientInfoQuery = "SELECT u.UserID, FirstName, LastName, DateOfBirth FROM Patient p INNER JOIN User u ON p.UserID = u.UserID WHERE p.PatientID = '$PatientID'";
                $getPatientInfoResult = mysqli_query($conn, $getPatientInfoQuery);
                $getPatientInfoNumRows = mysqli_num_rows($getPatientInfoResult);
                if ($getPatientInfoNumRows > 0) {
                    $getPatientInfo = mysqli_fetch_assoc($getPatientInfoResult);
                    $UserID = $getPatientInfo['UserID'];
                    $FirstName = $getPatientInfo['FirstName'];
                    $LastName = $getPatientInfo['LastName'];
                    $DateOfBirth = $getPatientInfo['DateOfBirth'];

                    $PatientBasicInfo = $PatientID.' '.$LastName.', '.$FirstName.' ('.date('d/m/Y', strtotime($DateOfBirth)).')';

                }

                if ($RiskScore=="Low"){
                    //get patient id from patient table for this userid
                    $getPatientQuestionnaireQuery = "SELECT * FROM `PatientQuestionnaire` WHERE `PatientID`= '".$PatientID."' && `QuestionnaireID` = '2001'";
                    $getPatientQuestionnaireResult = mysqli_query($conn, $getPatientQuestionnaireQuery);
                    $getPatientQuestionnaireFetch = mysqli_fetch_assoc($getPatientQuestionnaireResult);
                    //print_r($getPatientQuestionnaireFetch);
                    $user_PatientQuestionnaireID = $getPatientQuestionnaireFetch['PatientQuestionnaireID'];


                    // Get Lifestyle Activity Assessment Details
                    $getKnowledgeAttitudeQuery = "SELECT * FROM `KnowledgeAttitude` WHERE `PatientQuestionnaireID` = '".$user_PatientQuestionnaireID."'";
                    $getKnowledgeAttitudeResult = mysqli_query($conn, $getKnowledgeAttitudeQuery);
                    $getKnowledgeAttitudeFetch = mysqli_fetch_assoc($getKnowledgeAttitudeResult);
                    $SubmissionDate = $getPatientQuestionnaireFetch['DateSubmitted'];

                    $NSPDPE1A = $getKnowledgeAttitudeFetch['NSPDPE1A'];
                    $NSPDPE2A = $getKnowledgeAttitudeFetch['NSPDPE2A'];
                    $NSPDPE2B = $getKnowledgeAttitudeFetch['NSPDPE2B'];
                    $NSPDPE2C = $getKnowledgeAttitudeFetch['NSPDPE2C'];
                    $NSPDPE2D = $getKnowledgeAttitudeFetch['NSPDPE2D'];
                    $NSPDPE3A = $getKnowledgeAttitudeFetch['NSPDPE3A'];
                    $NSPDPE3B = $getKnowledgeAttitudeFetch['NSPDPE3B'];
                    $NSPDPE4A = $getKnowledgeAttitudeFetch['NSPDPE4A'];
                    $NSPDPE4B = $getKnowledgeAttitudeFetch['NSPDPE4B'];
                    $NSPDPE5A = $getKnowledgeAttitudeFetch['NSPDPE5A'];
                    $NSPDPE6A = $getKnowledgeAttitudeFetch['NSPDPE6A'];
                }
                elseif($RiskScore=="Moderate" || $RiskScore=="Increased" || $RiskScore=="High") {
                    //get patient id from patient table for this userid
                    $getPatientQuestionnaireQuery = "SELECT * FROM `PatientQuestionnaire` WHERE `PatientID`= '" . $PatientID . "' && `QuestionnaireID` = '3001'";
                    $getPatientQuestionnaireResult = mysqli_query($conn, $getPatientQuestionnaireQuery);
                    $getPatientQuestionnaireFetch = mysqli_fetch_assoc($getPatientQuestionnaireResult);
                    //print_r($getPatientQuestionnaireFetch);
                    $user_PatientQuestionnaireID = $getPatientQuestionnaireFetch['PatientQuestionnaireID'];


                    // Get Lifestyle Activity Assessment Details
                    $getLifestyleActivityQuery = "SELECT * FROM `LifestyleActivity` WHERE `PatientQuestionnaireID` = '" . $user_PatientQuestionnaireID . "'";
                    $getLifestyleActivityResult = mysqli_query($conn, $getLifestyleActivityQuery);
                    $getLifestyleActivityFetch = mysqli_fetch_assoc($getLifestyleActivityResult);
                    //print_r($getLifestyleActivityFetch);
                    $SubmissionDate = $getLifestyleActivityFetch['SubmissionDate'];


                    $NSPDDA1 = $getLifestyleActivityFetch['NSPDDA1'];
                    $NSPDDA2 = $getLifestyleActivityFetch['NSPDDA2'];
                    $NSPDDA3 = $getLifestyleActivityFetch['NSPDDA3'];
                    $UKDDQ1A = $getLifestyleActivityFetch['UKDDQ1A'];
                    $UKDDQ1B = $getLifestyleActivityFetch['UKDDQ1B'];
                    $UKDDQ1C = $getLifestyleActivityFetch['UKDDQ1C'];
                    $UKDDQ1D = $getLifestyleActivityFetch['UKDDQ1D'];
                    $UKDDQ1E = $getLifestyleActivityFetch['UKDDQ1E'];
                    $UKDDQ1F = $getLifestyleActivityFetch['UKDDQ1F'];
                    $UKDDQ1G = $getLifestyleActivityFetch['UKDDQ1G'];
                    $NSPDPA1 = $getLifestyleActivityFetch['NSPDPA1'];
                    $NSPDPA2 = $getLifestyleActivityFetch['NSPDPA2'];
                    $NSPDPA3 = $getLifestyleActivityFetch['NSPDPA3'];
                    $GPPAQ1A = $getLifestyleActivityFetch['GPPAQ1A'];
                    $GPPAQ2A = $getLifestyleActivityFetch['GPPAQ2A'];
                    $GPPAQ2B = $getLifestyleActivityFetch['GPPAQ2B'];
                    $GPPAQ2C = $getLifestyleActivityFetch['GPPAQ2C'];
                    $GPPAQ2D = $getLifestyleActivityFetch['GPPAQ2D'];
                    $GPPAQ2E = $getLifestyleActivityFetch['GPPAQ2E'];
                    $GPPAQ3A = $getLifestyleActivityFetch['GPPAQ3A'];
                    if ($RiskScore == "High") {
                        //get patient id from patient table for this userid
                        $getPatientQuestionnaireQuery = "SELECT * FROM `PatientQuestionnaire` WHERE `PatientID`= '" . $PatientID . "' && `QuestionnaireID` = '4001'";
                        $getPatientQuestionnaireResult = mysqli_query($conn, $getPatientQuestionnaireQuery);
                        $getPatientQuestionnaireFetch = mysqli_fetch_assoc($getPatientQuestionnaireResult);
                        //print_r($getPatientQuestionnaireFetch);
                        $user_PatientQuestionnaireID = $getPatientQuestionnaireFetch['PatientQuestionnaireID'];
                        //print_r($user_PatientQuestionnaireID);


                        // Get Lifestyle Activity Assessment Details
                        $getMedicationQuery = "SELECT * FROM MedicationDrug WHERE PatientQuestionnaireID = '" . $user_PatientQuestionnaireID . "'";
                        //print_r($getKnowledgeAttitudeQuery);
                        $getMedicationResult = mysqli_query($conn, $getMedicationQuery);
                        $getMedicationFetch = mysqli_fetch_assoc($getMedicationResult);
                        //print_r($getMedicationFetch);
                        $SubmissionDate = $getMedicationFetch['SubmissionDate'];

                        $NSPDMH1A = $getMedicationFetch['NSPDMH1A'];
                        $NSPDMH1B = $getMedicationFetch['NSPDMH1B'];
                        $NSPDMH1C = $getMedicationFetch['NSPDMH1C'];
                        $NSPDMH1D = $getMedicationFetch['NSPDMH1D'];
                        $NSPDMH1E = $getMedicationFetch['NSPDMH1E'];
                        $NSPDMH1F = $getMedicationFetch['NSPDMH1F'];
                        $NSPDMH2A = $getMedicationFetch['NSPDMH2A'];
                        $NSPDMH2B = $getMedicationFetch['NSPDMH2B'];
                    }
                }

                ?>



                <div class="col-md-12 box-header-wrap" style="padding: 0.5% 0%;">

						<span class="box-header"><i class="fa fa-file-text"></i> Stepped Care
                            <a href="CarePlan.php?id=<?php echo $PatientID; ?>" class="btn pull-right">
                            <i class="fa fa-heartbeat"></i> Patient Care Plan</a> <br>
                            <!--<strong><?php  echo $PatientBasicInfo; ?></strong>-->
                        </span>


                </div>



                <div class="col-md-12 box-content">
                    <div class="form-group input-wrap">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12" style="border-bottom: solid 1px #e7e7e7; padding: 5px 0;">
                                    <div class="col-md-2">
                                        <form id="form-assessment" action="../functions/generate-step.php" method="POST">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $PatientID; ?>">
                                            <input type="hidden" class="form-control" name="score" value="<?php echo $RiskScore; ?>">
                                            <button class="btn" id="btn-generate-step" disabled>Generate Step</button>
                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <form id="form-assessment2" action="../functions/generate-treatment.php" method="POST">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $PatientID; ?>">
                                            <input type="hidden" class="form-control" name="score" value="<?php echo $RiskScore; ?>">
                                            <button class="btn" id="btn-generate-treatment" disabled>Generate Treatment</button>
                                        </form>
                                    </div>

                                    <div class="col-md-8 text-right">


                                        <button type="button" class="btn" id="editStep" onclick="Step();">Edit Step</button>


                                    </div>
                                </div>
                                <div class="col-md-12" style="padding-top: 6px;">
                                    <span id="date-generated" hidden>Step Generated: <?php echo date('m/d/Y'); ?></span>

                                </div>


                            </div>
                        </div>
                    </div>
                    <?php
                    $querry="SELECT * FROM `PatientStep`WHERE `PatientID`= '".$PatientID."' ";
                    $output=mysqli_query($conn,$querry);
                    $val=mysqli_fetch_assoc($output);
                    $StepID=$val["StepID"];
                    $notes=$val["PatientStepNotes"];

                    ?>
                    <form id="form-diagnosis">

                        <div class="form-group">

                            <div class="col-md-12 input-wrap">

                                <label>Step ID: </label>

                                <textarea class="form-control" rows="1" style="resize: none;" readonly><?php echo $StepID?></textarea>

                            </div>

                        </div>
                        <?php
                        $stepname="SELECT `StepName` FROM `Step` Where `StepID`= '".$StepID."' ";
                        $res=mysqli_query($conn,$stepname);
                        $name=mysqli_fetch_assoc($res);
                        $StepName=$name["StepName"];
                        ?>

                        <div class="form-group">

                            <div class="col-md-12 input-wrap">

                                <label>Step Name: </label>

                                <textarea class="form-control" rows="1" style="resize: none;" readonly><?php echo $StepName?></textarea>

                            </div>

                        </div>
                        <?php
                        $treatmentname="SELECT * FROM `PatientTreatment` WHERE `PatientID`= '".$PatientID."' && `AdministrationDate` = (SELECT MAX(`AdministrationDate`) FROM `PatientTreatment` Where `PatientID`= '".$PatientID."') LIMIT 1";
                        $res=mysqli_query($conn,$treatmentname);
                        $ID=mysqli_fetch_assoc($res);
                        $TreatmentID=$ID["TreatmentID"];
                        ?>



                        <div class="form-group">

                            <div class="col-md-12 input-wrap">

                                <label>Treatment ID: </label>

                                <textarea class="form-control" rows="1" style="resize: none;" readonly><?php echo $TreatmentID?></textarea>

                            </div>

                        </div>
                        <?php
                        $treatname="SELECT * FROM `Treatment` Where `TreatmentID`= '".$TreatmentID."' ";
                        $res=mysqli_query($conn,$treatname);
                        $treat1name=mysqli_fetch_assoc($res);
                        $TreamentName=$treat1name["TreatmentName"];
                        $description=$treat1name["TreatmentDescription"];
                        ?>

                        <div class="form-group">

                            <div class="col-md-12 input-wrap">

                                <label>Treatment Name: </label>

                                <textarea class="form-control" rows="1" style="resize: none;" readonly><?php echo $TreamentName?></textarea>

                            </div>

                        </div>



                        <div class="form-group">

                            <div class="col-md-12 input-wrap">

                                <label>Description/Explanation: </label>

                                <textarea class="form-control" rows="1" style="resize: none;" readonly><?php echo $description?></textarea>

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-12 input-wrap">

                                <label>Other Notes: </label>

                                <textarea class="form-control" rows="2" id="Explanation"  style="resize: none;"><?php echo $notes?></textarea>

                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-12 text-center">

                                <button type="button" class="btn" id="btn-save-step" disabled>Save Step</button>

                            </div>
                        </div>


                    </form>

                </div>

            </div>

        </div>

    </div>



    <!-- MODAL EDIT PROFILE START -->

    <div class="modal fade" id="modal-edit-profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

        <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i> Edit Profile</h4>

                </div>

                <div class="modal-body">

                    <form id="form-edit-profile" autocomplete="off">

                        <div class="row" style="margin-bottom: 5px;">

                            <div class="col-md-12">

                                <div class="input-group">

                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>

                                    <select class="form-control" name="title">

                                        <option value="<?php echo $title; ?>" selected>-Don't Change-</option>

                                        <option value="Mr.">Mr.</option>

                                        <option value="Mrs.">Mrs.</option>

                                        <option value="Dr.">Dr.</option>

                                        <option value="Prof.">Prof.</option>

                                    </select>

                                    <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required value="<?php echo $firstName; ?>">

                                    <input type="text" name="mname" id="mname" class="form-control" placeholder="Middle Name" required>

                                    <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required value="<?php echo $lastName; ?>">

                                </div>

                            </div>

                        </div>

                        <div class="row" style="margin-bottom: 5px;">

                            <div class="col-md-12">

                                <div class="input-group">

                                    <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>

                                    <input type="text" name="adr1" id="adr1" class="form-control" placeholder="Address Line 1" required>

                                    <input type="text" name="adr2" id="adr2" class="form-control" placeholder="Address Line 2" required>

                                    <input type="text" name="town" id="town" class="form-control" placeholder="Town" required>

                                    <input type="text" name="county" id="county" class="form-control" placeholder="County" required>

                                    <input type="text" name="pcode" id="pcode" class="form-control" placeholder="Post Code" required>

                                    <input type="text" name="country" id="country" class="form-control" placeholder="Country" required>

                                </div>

                            </div>

                        </div>

                        <div class="row" style="margin-bottom: 5px;">

                            <div class="col-md-12">

                                <div class="input-group">

                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>

                                    <input type="text" name="bday" id="bday" class="form-control" placeholder="Birthday (DD-MM-YYYY)" required readonly value="<?php echo $birthday; ?>">

                                </div>

                            </div>

                        </div>

                        <div class="row" style="margin-bottom: 5px;">

                            <div class="col-md-12">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-venus-mars" style="font-size: 12px;"></i></span>

                                    <input type="text" name="gender" id="gender" class="form-control" placeholder="Gender" required readonly>

                                </div>

                            </div>

                        </div>

                        <div class="row" style="margin-bottom: 5px;">

                            <div class="col-md-12">

                                <div class="input-group">

                                    <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>

                                    <input type="text" name="hp" id="hp" class="form-control" placeholder="Home Phone" required>

                                    <input type="text" name="cn" id="cn" class="form-control" placeholder="Mobile Number" required value="<?php echo $mobileNumber; ?>">

                                </div>

                            </div>

                        </div>

                        <div class="row" style="margin-bottom: 5px;" hidden>

                            <div class="col-md-12">

                                <div class="input-group">

                                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>

                                    <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" required>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn" data-dismiss="modal">Close</button>

                    <button type="button" class="btn" id="btn-edit-profile">Save Changes</button>

                </div>

            </div>

        </div>

    </div>

    <!-- MODAL EDIT PROFILE END -->



    <!-- MODAL CHANGE PASSWORD START -->

    <div class="modal fade" id="modal-change-password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

        <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-lock"></i> Change Password</h4>

                </div>

                <div class="modal-body">

                    <form id="form-change-password" autocomplete="off">

                        <div class="row" style="margin-bottom: 5px;">



                            <div class="col-md-12">



                                <div class="input-group">



                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>



                                    <input type="password" name="old-pword" id="old-pword" class="form-control" placeholder="Old Password" required>



                                </div>



                            </div>



                        </div>

                        <div class="row" style="margin-bottom: 5px;">



                            <div class="col-md-12">



                                <div class="input-group">



                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>



                                    <input type="password" name="new-pword" id="new-pword" class="form-control" placeholder="New Password" required>



                                </div>



                            </div>



                        </div>

                        <div class="row" style="margin-bottom: 5px;">



                            <div class="col-md-12">



                                <div class="input-group">



                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>



                                    <input type="password" name="confirm-new-pword" id="confirm-new-pword" class="form-control" placeholder="Confirm New Password" required>



                                </div>



                            </div>



                        </div>

                    </form>

                </div>

                <div class="modal-footer">

                    <button type="button" class="btn" data-dismiss="modal">Close</button>

                    <button type="button" class="btn" id="btn-change-password">Save Changes</button>

                </div>

            </div>

        </div>

    </div>

    <!-- MODAL CHANGE PASSWORD END -->

</div>



<div class="col-md-12 footer">



    <small>&copy; <?php echo date('Y'); ?> All rights Reserved.</small>



</div>



<script>
    function Step(){
        document.getElementById("btn-generate-step").disabled = false;
        document.getElementById("btn-save-step").disabled = false;
        document.getElementById("btn-generate-treatment").disabled = false;
    }

    $(function(){



        $("#bday").datepicker()



        $("#bday").datepicker("option", "dateFormat", "dd-mm-yy")

        $(document).on('click', '#btn-generate-treatment', function(e){
            e.preventDefault();
            //toastr['success']('Step has been generated!')
            //$('#date-generated').prop('hidden', false)

            var form = $('#form-assessment2' +
                '')
            var data = form.serialize()

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: data,
                success: function (response) {
                    if (response == 1) {

                        toastr["success"]("Treatment has been generated!")

                        setTimeout(function() {

                            window.location.reload()

                        }, 1000)
                    }else if (response == ''){
                        toastr["error"]("Something went wrong! Please try again..")
                    } else {
                        toastr["error"](response)
                    }
                }
            })


        })

        $(document).on('click', '#btn-generate-step', function(e){
            e.preventDefault();
            //toastr['success']('Step has been generated!')
            //$('#date-generated').prop('hidden', false)

            var form = $('#form-assessment')
            var data = form.serialize()

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: data,
                success: function (response) {
                    if (response == 1) {

                        toastr["success"]("Step has been generated!")

                        setTimeout(function() {

                            window.location.reload()

                        }, 1000)
                    }else if (response == ''){
                        toastr["error"]("Something went wrong! Please try again..")
                    } else {
                        toastr["error"](response)
                    }
                }
            })


        })

        $(document).on('click', '#btn-save-step', function(){
            toastr['success']('Step details has successfully been saved to the IEE Database! Redirecting..')

            setTimeout(function() {

                window.location.href = "http://myiee.co.uk/clinician/CarePlan.php?id=<?php echo $PatientID?>";

            }, 6000)
        })
    })

</script>

</body>



</html>