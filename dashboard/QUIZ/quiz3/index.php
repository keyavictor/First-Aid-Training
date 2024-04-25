<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Javascript Quiz</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
</head>

<body>
    <header class="header bg-primary">
        <div class="left-title">JS Quiz</div>
        <div class="right-title">Total Questions: <span id="tque"></span></div>
        <div class="clearfix"></div>
    </header>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div id="result" class="quiz-body">
                        <form name="quizForm" onSubmit="">
                            <fieldset class="form-group">
                                <h4><span id="qid">1.</span> <span id="question"></span></h4>
                                <div class="option-block-container" id="question-options"> </div>
                                <!-- End of option block -->
                            </fieldset> <button name="previous" id="previous" class="btn btn-success">Previous</button>
                            &nbsp; <button name="next" id="next" class="btn btn-success">Next</button>
                        </form>
                    </div>
                </div> <!-- End of col-sm-12 -->
            </div> <!-- End of row -->
        </div> <!-- ENd of container fluid -->
    </div> <!-- End of content -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <script src="app.js"></script>
</body>

</html>