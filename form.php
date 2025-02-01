<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <meta name="description" content="Student records that track student information such as grades.
        ">
        <title>School of Fish | Student Record Tracker</title>
        <!-- google fonts link -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./css/style.css"> <!-- link to css -->
    </head>

    <body>
    <header>
            <div>
                <a href="index.php"><img src="./img/logo.png" alt="logo"></a>  <!-- logo -->

            </div>
            <section>
                <h1>School of Fish</h1> <!-- main header -->
                <nav>
                    <menu>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="form.php">Form</a></li>
                    </menu>
                </nav>
            </section>
        </header>

        <main>
            <section id="form"> <!-- start of form -->
                <form method="post">
                    <h2>Student Record Form</h2>
                    <div> <!-- instructor information -->
                        <label for="fnamei" >Instructor First Name :</label> <!-- ask for the instructor's first name -->
                        <input type="text" name="fnamei" id="fnamei" required>
                    </div>
                    <div>
                        <label for="lnamei" >Instructor Last Name :</label> <!--ask for instructor's last name -->
                        <input type="text" name="lnamei" id="lnamei" required>
                    </div>
                    <div>
                        <label for="emailAddress" >Instructor Email :</label> <!-- ask for instructor's email -->
                        <input type="email" name="emailAddress" id="emailAddress" required/>
                    </div>

                    <section class="studentSection">
                        <h2>Input Student Information Here</h2> <!-- student information -->
                        <div>
                            <label for="fnames" >Student First Name :</label> <!-- student first name -->
                            <input type="text" name="fnames" id="fnames" required>
                        </div>
                        <div>
                            <label for="lnames" >Student Last Name :</label> <!--student last name -->
                            <input type="text" name="lnames" id="lnames" required>
                        </div>
                        <div>
                            <label for="stuid" >Student ID :</label><!-- student id-->
                            <input type="number" name="stuid" id="stuid" required>
                        </div>
                        <div>
                            <label  for="course" >Course Name :</label> <!-- course name-->
                            <select name="course" class="button">
                                <option>Select Course</option> <!--course options -->
                                <option value="English">English</option>
                                <option value="Mathematics">Mathematics</option>
                                <option value="Art">Art</option>
                                <option value="Science">Science</option>
                                <option value="History">History</option>
                            </select>
                        </div>
                        <div>
                            <label for="grade" >Student Final Grade :</label> <!-- student's final grade-->
                            <input type="number" name="grade" id="grade" required>
                        </div>

                        <div>
                        <input class="button" type="submit" name="Submit" value="Add"> <!--button to submit the form -->
                        <input class="button" type="reset" value="Clear"> <!--button to clear the form -->
                        </div>
                    </section>
                    
                </form>
            </section>
            <?php 
include_once ('crud.php');
include_once ('validate.php');

//class objects for crud and validate class
$crud = new crud();
$valid = new validate();

if(isset($_POST['Submit'])){

//create the variables with the escape string function
  $fnamei = $crud->escape_string($_POST['fnamei']); //variable for the first name of the instructor
  $lnamei = $crud->escape_string($_POST['lnamei']); //variable for the last name of the intructor
  $emailAddress = $crud->escape_string($_POST['emailAddress']); // variable for the email of the instructor
  $fnames = $crud->escape_string($_POST['fnames']); // variable for the first name of the student
  $lnames = $crud->escape_string($_POST['lnames']); // variable for the last name of the student
  $stuid = $crud->escape_string($_POST['stuid']); //variable for the student id
  $course = $crud->escape_string($_POST['course']); // variable for the course
  $grade = $crud->escape_string($_POST['grade']); // variable for the final grade

  $input = $valid->checkIfBlank($_POST, array('fnamei', 'lnamei', 'emailAddress', 'fnames', 'lnames', 'stuid', 'course', 'grade')); //call the variable to check if the form is left blank
  $validateGrade = $valid->checkValidateGrade($_POST['grade']); // validate the grade 
  $validateEmailAddress = $valid->checkValidateEmail($_POST['emailAddress']); // validate the email address
  $validateId = $valid->checkValidateStudentId($_POST['stuid']); // validate the student id

  if($input != null){
    echo "<p>$input</p>";
  }
  elseif(!$validateGrade){  //if the grade isnt valid
    echo "<p>Invalid grade. Please enter a valid grade.</p>"; //let the user know
  }
  elseif(!$validateEmailAddress){ //if the email adress isnt valid
    echo "<p>Invalid email address. Please enter a valid email address.</p>"; //let the user know
  }
  elseif(!$validateId){ //if the id isnt valid
    echo "<p>Invalid student ID. Please enter a valid student ID.</p>"; //let the user know
  }
  else{

    $query = "INSERT INTO studentrecord (fnamei, lnamei, emailAddress, fnames, lnames, stuid, course, grade) VALUES ('$fnamei', '$lnamei', '$emailAddress', '$fnames', '$lnames', '$stuid', '$course', '$grade')"; //query to insert the values into the database
   

    // If all fields are valid execute the query
    $result = $crud->execute($query);
    
    
    if($result){
      echo "<p>The student's records have been added successfully!</p>"; // message that all the student records have been added
    } else {
      echo "<p>There was an error adding the student's records.</p>"; //if there was an error let the user know
    }
  }
}
?>

?>

        </main>

        <footer>
            <p><small>©schooloffish.com All rights reserved</small></p> <!-- footer -->
        </footer>
    </body>
</html>