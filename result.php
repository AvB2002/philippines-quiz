<?php require("php/questions.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Quiz Bee Result</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/quizresult-style.css"/>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-light purple">
  <div class="container">
    <div class="d-flex justify-content-between w-100">
      <a class="navbar-brand" href="quiz.php">
        <img src="images/quiz.png" alt="" width="25" height="24">
        Quiz Bee
      </a>
      <button class="rounded-circle btn light-ripple" data-bs-toggle="modal" data-bs-target="#aboutModal"><i class="fas fa-info-circle"></i></button>

      <div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="aboutModalLabel">About Quiz Bee</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <b>Developed by:</b> Aldrian V. Barias
            <br><b>Section:</b> BSIT-3D
          </div>
        </div>
      </div>
    </div>

    </div>
  </div>
</nav>

<div class="panel deep-purple shadow"></div>

<main class="freeBird">
    <div class="container pb-3">

      <div class="card">
        <div class="card-body p-0">
          <div class="rounded ph-image"></div>
        </div>
      </div>

      <?php
            if(isset($_GET['submit'])){
              $random = json_decode($_GET['randomQuestions'], TRUE);
              $counter = 0;
              $i=0;
              foreach($random as $n) {
                  $i+=1;
                  $correctAnswer =(string)$xml->quiz_question[$n]->answer;
                  $answer=$_GET['radioList-'. $i];
                  if($correctAnswer == $answer){
                    $counter++;
                  }
              }
            }
        ?>

       <div class="card">
        <span class="card-header"></span>
        <div class="card-body">
           <div class="d-flex justify-content-between w-100">
             <h1>Philippines Quiz</h1>
             <div class="score rounded">
              <div class="d-flex justify-content-center">
                <p class="mt-2"><?php echo '<b>Score:&nbsp;</b> <h3>' . $counter . '</h3> /10'; //displays the score of the user and the number of items in the quiz bee?></p> 
              </div>
           </div>
          </div>
             Please choose the correct answers to the following questions.
            <p class="mt-2 mb-0 fw-bold">Name</p>
            <?php echo '<input type="text" name="fullName" class="form-control" placeholder="Enter your Full Name" value="'. $_GET['fullName'] .'" disabled/>'; ?>
        </div>
      </div>

     <form>
        <?php

            $counter = 0;
            $box_counter = 0;
            $choice_ctr = 0;

            foreach($random as $n) {
              $a = (string)$xml->quiz_question[$n]->choices->a; //variable that will holds choice "a" value
              $b = (string)$xml->quiz_question[$n]->choices->b; //variable that will holds choice "b" value
              $c = (string)$xml->quiz_question[$n]->choices->c;  //variable that will holds choice "c" value


              $correctAnswer =(string)$xml->quiz_question[$n]->answer; //variable that will holds the correct answer for the question of the specified number

              $counter+=1; //counts the "card" container of the questions
              echo '<div class="card">';
              echo '<div class="card-body">';
              echo '<p class="fw-bold">' . $counter . '. ' . (string)$xml->quiz_question[$n]->question . '</p>'; //displays the question
              echo '<div>';
              $choice_ctr+=1;
              echo '<fieldset id="radioList-'.  $counter. '">';
              $answer=$_GET['radioList-'. $counter];

                if($a == $correctAnswer){
                  echo '<input type="radio" name="radioList-'.  $counter. '" id="choice-'.  $choice_ctr. '" value="' .$a . '" disabled><label for="choice-'.  $choice_ctr. '" class="correct box box-'.  $choice_ctr . '"><div class="choices"> <span class="correct"><i class="fa-solid fa-check"></i></span>' . $a . '</span></div></label>';
                }
                else{
                  if($answer == $a){
                    echo '<input type="radio" name="radioList-'.  $counter. '" id="choice-'.  $choice_ctr. '" value="' .$a . '" disabled><label for="choice-'.  $choice_ctr. '" class="wrong box box-'.  $choice_ctr . '"><div class="choices"> <span class="wrong"><i class="fa-solid fa-xmark"></i></span>' . $a . '</span></div></label>';
                 }
                  else{
                     echo '<input type="radio" name="radioList-'.  $counter. '" id="choice-'.  $choice_ctr. ' value="' .$a . '" disabled><label for="choice-'.  $choice_ctr. '" class="box box-'.  $choice_ctr . '"><div class="choices"> <span class="circle"></span>' . $a . '</span></div></label>';
                  }
                }

              $choice_ctr+=1;

               if($b == $correctAnswer){
                  echo '<input type="radio" name="radioList-'.  $counter. '" id="choice-'.  $choice_ctr. '" value="' . $b . '" disabled><label for="choice-'.  $choice_ctr. '" class="correct box box-'.  $choice_ctr . '"><div class="choices"> <span class="correct"><i class="fa-solid fa-check"></i></span>' . $b . '</span></div></label>';
                }
                else{
                  if($answer == $b){
                    echo '<input type="radio" name="radioList-'.  $counter. '" id="choice-'.  $choice_ctr. '" value="' .$b . '" disabled><label for="choice-'.  $choice_ctr. '" class="wrong box box-'.  $choice_ctr . '"><div class="choices"> <span class="wrong"><i class="fa-solid fa-xmark"></i></span>' . $b . '</span></div></label>';
                  }
                  else{
                     echo '<input type="radio" name="radioList-'.  $counter. '" id="choice-'.  $choice_ctr. '" value="' .$b . '" disabled><label for="choice-'.  $choice_ctr. '" class="box box-'.  $choice_ctr . '"><div class="choices"> <span class="circle"></span>' . $b . '</span></div></label>';
                  }
                }

              $choice_ctr+=1;
               if($c == $correctAnswer){
                  echo '<input type="radio" name="radioList-'.  $counter. '" id="choice-'.  $choice_ctr. '" value="' . $c . '" disabled><label for="choice-'.  $choice_ctr. '" class="correct box box-'.  $choice_ctr . '"><div class="choices"> <span class="correct"><i class="fa-solid fa-check"></i></span>' . $c . '</span></div></label>';
                }
                else{
                  if($answer == $c){
                    echo '<input type="radio" name="radioList-'.  $counter. '" id="choice-'.  $choice_ctr. '" value="' .$c . '" disabled><label for="choice-'.  $choice_ctr. '" class="wrong box box-'.  $choice_ctr . '"><div class="choices"> <span class="wrong"><i class="fa-solid fa-xmark"></i></span>' . $c . '</span></div></label>';
                  }
                  else{
                     echo '<input type="radio" name="radioList-'.  $counter. '" id="choice-'.  $choice_ctr. '" value="' .$c . '" disabled><label for="choice-'.  $choice_ctr. '" class="box box-'.  $choice_ctr . '"><div class="choices"> <span class="circle"></span>' . $c . '</span></div></label>';
                  }
                } //validate and displays the correct answer, it will also shows the incorrect answer of the user

              echo '</fieldset>';
              echo '<div class="mt-3 d-flex justify-content-start">';
              if($answer == $correctAnswer){echo '<h6><i class="fas fa-smile"></i>&nbsp;Correct Answer</h6>';}else{echo '<h6><i class="fas fa-sad-cry"></i>&nbsp;Incorrect Answer</h6>';}
              echo '</div>';
              echo '<style>';
              for($i=$choice_ctr-2; $i<=$choice_ctr; $i++){
                echo '#choice-'. $i .':checked~label.box-'. $i . '{';
                echo 'border-color: #8e498e;';
                echo '}';
                echo '';
                echo '#choice-'. $i .':checked~label.box-'. $i .' .circle{';
                echo 'border: 2px solid #8e498e;';
                echo 'background-color: #fff;';
                echo '}';
                echo '@media (min-width: 768px) and (max-width: 1299px) {';
                echo '#choice-'. $i .':checked~label.box-'. $i .' .circle{';
                echo 'border: 3px solid #8e498e;';
                echo 'background-color: #fff;';
                echo '}';
                echo '}';
              }
              echo '</style>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
            }
        ?>
          <div class="btn-container">
          <div class="d-flex justify-content-start">
              <input type="button" class="btn btn-primary" onclick="location.href='quiz.php';" value="Retake Quiz!" />
          </div>
        </div>
      </form>


  </div>
</main>
</body>
</html>