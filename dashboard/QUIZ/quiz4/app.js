/* Quiz source: w3schools.com */

var quiz = {
    "JS": [{
            "id": 1,
            "question": "What is the first step of the Heimlich maneuver for choking victims?",
            "options": [{
                "a": "Call 911",
                "b": "Administer chest compressions",
                "c": "Administer abdominal thrusts",
                "d": "Administer mouth-to-mouth resuscitation"
            }],
            "answer": "Administer abdominal thrusts",
            "score": 0,
            "status": ""
        },
        {
            "id": 2,
            "question": "What should you do if the choking victim is unconscious?",
            "options": [{
                "a": "Administer chest compressions",
                "b": "Call 911",
                "c": "Perform abdominal thrusts",
                "d": "Give the victim water"
            }],
            "answer": "Administer chest compressions",
            "score": 0,
            "status": ""
        },
        {
            "id": 3,
            "question": "How many abdominal thrusts should be administered to a conscious choking victim?",
            "options": [{
                "a": "One",
                "b": "Two",
                "c": "Three",
                "d": "Four"
            }],
            "answer": "Two",
            "score": 0,
            "status": ""
        },
        {
            "id": 4,
            "question": "How do you position yourself when administering abdominal thrusts to a choking victim?",
            "options": [{
                "a": "Stand behind the victim and wrap your arms around their waist",
                "b": "Kneel beside the victim and place your hands on their abdomen",
                "c": "Stand in front of the victim and grasp their shoulders",
                "d": "None of the above"
            }],
            "answer": "Stand behind the victim and wrap your arms around their waist",
            "score": 0,
            "status": ""
        },
        {
            "id": 5,
            "question": "What should you do if the choking victim becomes unconscious while administering abdominal thrusts?",
            "options": [{
                "a": "Stop and wait for the victim to regain consciousness",
                "b": "Administer mouth-to-mouth resuscitation",
                "c": "Administer chest compressions",
                "d": "None of the above"
            }],
            "answer": "Administer mouth-to-mouth resuscitation",
            "score": 0,
            "status": ""
        },
        {
            "id": 6,
            "question": "What is the maximum number of back blows that should be administered to a choking ?",
            "options": [{
                "a": "One",
                "b": "Two",
                "c": "Three",
                "d": "Four"
            }],
            "answer": "Two",
            "score": 0,
            "status": ""
        },
        {
            "id": 7,
            "question": "What should you do if the choking victim is pregnant?",
            "options": [{
                "a": "Administer abdominal thrusts as usual",
                "b": "Perform chest compressions instead of abdominal thrusts",
                "c": "Call 911 immediately",
                "d": "None of the above"
            }],
            "answer": "Administer abdominal thrusts as usual",
            "score": 0,
            "status": ""
        },
        {
            "id": 8,
            "question": "What should you do if the choking victim is coughing and can speak?",
            "options": [{
                "a": "Administer abdominal thrusts",
                "b": "Encourage the victim to continue coughing",
                "c": "Call 911 immediately",
                "d": "None of the above"
            }],
            "answer": "Encourage the victim to continue coughing",
            "score": 0,
            "status": ""
        },
        {
            "id": 9,
            "question": "How do you check if the airway obstruction has been cleared after administering abdominal thrusts?",
            "options": [{
                "a": "Listen for breathing sounds",
                "b": "Look for a foreign object in the victim's mouth",
                "c": "Ask the victim if they can breathe",
                "d": "None of the above"
            }],
            "answer": "Listen for breathing sounds",
            "score": 0,
            "status": ""
        },
        {
            "id": 10,
            "question": "What should you do if the choking victim's condition deteriorates and they become unconscious?",
            "options": [{
                "a": "Stop and wait for the victim to regain consciousness",
                "b": "Administer chest compressions",
                "c": "Administer mouth-to-mouth resuscitation",
                "d": "Call 911 immediately"
            }],
            "answer": "Call 911 immediately",
            "score": 0,
            "status": ""
        },
    ]
}



var quizApp = function() {

    this.score = 0;
    this.qno = 1;
    this.currentque = 0;
    var totalque = quiz.JS.length;


    this.displayQuiz = function(cque) {
        this.currentque = cque;
        if (this.currentque < totalque) {
            $("#tque").html(totalque);
            $("#previous").attr("disabled", false);
            $("#next").attr("disabled", false);
            $("#qid").html(quiz.JS[this.currentque].id + '.');


            $("#question").html(quiz.JS[this.currentque].question);
            $("#question-options").html("");
            for (var key in quiz.JS[this.currentque].options[0]) {
                if (quiz.JS[this.currentque].options[0].hasOwnProperty(key)) {

                    $("#question-options").append(
                        "<div class='form-check option-block'>" +
                        "<label class='form-check-label'>" +
                        "<input type='radio' class='form-check-input' name='option'   id='q" + key + "' value='" + quiz.JS[this.currentque].options[0][key] + "'><span id='optionval'>" +
                        quiz.JS[this.currentque].options[0][key] +
                        "</span></label>"
                    );
                }
            }
        }
        if (this.currentque <= 0) {
            $("#previous").attr("disabled", true);
        }
        if (this.currentque >= totalque) {
            $('#next').attr('disabled', true);
            for (var i = 0; i < totalque; i++) {
                this.score = this.score + quiz.JS[i].score;
            }
            return this.showResult(this.score);
        }
    }

    this.showResult = function(scr) {
        $("#result").addClass('result');
        $("#result").html("<h1 class='res-header'>Total Score: &nbsp;" + scr + '/' + totalque + "</h1>");
        for (var j = 0; j < totalque; j++) {
            var res;
            if (quiz.JS[j].score == 0) {
                res = '<span class="wrong">' + quiz.JS[j].score + '</span><i class="fa fa-remove c-wrong"></i>';
            } else {
                res = '<span class="correct">' + quiz.JS[j].score + '</span><i class="fa fa-check c-correct"></i>';
            }
            $("#result").append(
                '<div class="result-question"><span>Q ' + quiz.JS[j].id + '</span> &nbsp;' + quiz.JS[j].question + '</div>' +
                '<div><b>Correct answer:</b> &nbsp;' + quiz.JS[j].answer + '</div>' +
                '<div class="last-row"><b>Score:</b> &nbsp;' + res +

                '</div>'

            );

        }
    }

    this.checkAnswer = function(option) {
        var answer = quiz.JS[this.currentque].answer;
        option = option.replace(/\</g, "&lt;") //for <
        option = option.replace(/\>/g, "&gt;") //for >
        option = option.replace(/"/g, "&quot;")

        if (option == quiz.JS[this.currentque].answer) {
            if (quiz.JS[this.currentque].score == "") {
                quiz.JS[this.currentque].score = 1;
                quiz.JS[this.currentque].status = "correct";
            }
        } else {
            quiz.JS[this.currentque].status = "wrong";
        }

    }

    this.changeQuestion = function(cque) {
        this.currentque = this.currentque + cque;
        this.displayQuiz(this.currentque);

    }

}


var jsq = new quizApp();

var selectedopt;
$(document).ready(function() {
    jsq.displayQuiz(0);

    $('#question-options').on('change', 'input[type=radio][name=option]', function(e) {

        //var radio = $(this).find('input:radio');
        $(this).prop("checked", true);
        selectedopt = $(this).val();
    });



});




$('#next').click(function(e) {
    e.preventDefault();
    if (selectedopt) {
        jsq.checkAnswer(selectedopt);
    }
    jsq.changeQuestion(1);
});

$('#previous').click(function(e) {
    e.preventDefault();
    if (selectedopt) {
        jsq.checkAnswer(selectedopt);
    }
    jsq.changeQuestion(-1);
});