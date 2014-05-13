/* global $,document,console,quizMaster */
$(document).ready(function() {
	
	$(document).on("pageshow", "#quizPage", function() {
		console.log("Page show");
		//initialize the quiz
		quizMaster.execute("q1.json", ".quizdisplay", function(result) {
			console.log("SUCESS CB");
			console.dir(result);	
		});
	});

});