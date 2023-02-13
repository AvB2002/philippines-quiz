<?php require("php/questions.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Quiz Bee</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     <link rel="stylesheet" href="css/quiz-style.css"/>

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


      <form action="result.php" method="GET">

        <div class="card">
          <span class="card-header"></span>
          <div class="card-body">
             <div class="d-flex justify-content-between w-100">
               <h1>Philippines Quiz</h1>
               <p class="mt-2">10 points</p>
            </div>
               Please choose the correct answers to the following questions.
              <p class="mt-2 mb-0 fw-bold">Name</p> 
              <input type="text" name="fullName" class="form-control" placeholder="Enter your Full Name" required/> <!-- Text Input for Name -->
          </div>
        </div>

        <?php
            $random = array_rand($xml->xpath("quiz_question"),10); 
            shuffle($random); //generates random indexes to generate random questions

            $counter = 0;
            $box_counter = 0;
            $choice_ctr = 0;

            echo '<input type="hidden" name="randomQuestions" value="'. json_encode($random) .'" />';
            foreach($random as $n) {

              $a = (string)$xml->quiz_question[$n]->choices->a; //variable that will holds choice "a" value
              $b = (string)$xml->quiz_question[$n]->choices->b; //variable that will holds choice "b" value
              $c = (string)$xml->quiz_question[$n]->choices->c;  //variable that will holds choice "c" value

              $counter+=1;
              echo '<div class="card">';
              echo '<div class="card-body">';
              echo '<p class="fw-bold">' . $counter . '. ' . (string)$xml->quiz_question[$n]->question . '</p>';
              echo '<div>';
              $choice_ctr+=1;
              echo '<fieldset id="radioList-'.  $counter. '">';
              echo '<input type="radio" name="radioList-'.  $counter. '" id="choice-'.  $choice_ctr. '" onclick="disableRequired(this.id);" value="' .$a . '"/><label for="choice-'.  $choice_ctr. '" class="box box-'.  $choice_ctr . '"><div class="choices"> <span class="circle"></span>' . $a . '</span></div></label>';
              $choice_ctr+=1;
              echo '<input type="radio" name="radioList-'.  $counter. '" id="choice-'.  $choice_ctr. '" onclick="disableRequired(this.id);" value="' .$b . '"/><label for="choice-'.  $choice_ctr. '" class="box box-'.  $choice_ctr . '"><div class="choices"> <span class="circle"></span>' . $b . '</span></div></label>';
              $choice_ctr+=1;
              echo '<input type="radio" name="radioList-'.  $counter. '" id="choice-'.  $choice_ctr. '" onclick="disableRequired(this.id);" value="' . $c . '"/><label for="choice-'.  $choice_ctr. '" class="box box-'.  $choice_ctr . '"><div class="choices"> <span class="circle"></span>' . $c . '</span></div></label>';
              echo '</fieldset>';
              echo '<div class="d-flex justify-content-end p-2 pb-0">';
              echo '<button type="button" class="btn btn-outline-dark dark-ripple p-1" onclick=clearAllRadios("radioList-'. $counter .'")>Clear Selection</button>';
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
              echo '</div>';
            }
        ?>

        <div class="btn-container">
          <div class="d-flex justify-content-between">
             <button type="submit" name="submit" value="submit" onclick="return radioValidation();" class="btn btn-primary">Submit</button>
             <button type="reset" name="reset" class="btn btn-outline-dark dark-ripple p-1">Clear Form</button>
          </div>
        </div>
      </form>


  </div>
</main>

<script type="text/javascript">

  function clearAllRadios(element) {// clears the checked buttons in a radio group
    var radList = document.getElementsByName(element);
    for (var i = 0; i < radList.length; i++) {
      if(radList[i].checked) document.getElementById(radList[i].id).checked = false;
    }
  }

  function disableRequired(choice){// removes the required class
      var el = document.getElementById(choice);
      el.closest(".card").classList.remove("required");  
  }

 function radioValidation(){ // validate if the radio button is unchecked
      var ctr=0;
      for(var h=1; h<=10;h++){
          var question = document.getElementsByName('radioList-' + h);
          var qValue = false;

          for(var i=0; i<question.length;i++){
              if(question[i].checked == true){
                  qValue = true;    
              }
          }

          if(!qValue){
              ctr++;
              var el = document.getElementById('radioList-' + h);
              el.closest(".card").classList.add("required");  
          }
      }
        if(ctr==0){
              return true;
          }
        else{
          alert("Please ensure that you have answered all of the questions!");
          return false;
        }


    }

</script>
</body>
</html>