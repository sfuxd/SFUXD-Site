function on_load() {
	
	
	$(window).scroll(function(){
		if  ($(window).scrollTop() >= 229){
			$('#main_table').css({position:'relative',top:46});
		} else {
			$('#main_table').css({top:0});
        }
        
        if  ($(window).scrollTop() >= 229) {
			$('#navigation_table').css({position:'fixed',top:0,left:'50%',margin:'0 0 0 -487.5px'});
		}
	});
}

//$(document).ready(on_load)

function saveButtonFunction1()
{
	document.getElementsByClassName("saveButton1")[0].innerHTML="Saved!";
}

function saveButtonFunction2()
{
	document.getElementsByClassName("saveButton2")[0].innerHTML="Saved!";
}

function saveButtonFunction3()
{
	document.getElementsByClassName("saveButton3")[0].innerHTML="Saved!";
}

function saveButtonFunction4()
{
	document.getElementsByClassName("saveButton4")[0].innerHTML="Saved!";
}

function saveButtonFunction5()
{
	document.getElementsByClassName("saveButton5")[0].innerHTML="Saved!";
}

function saveButtonFunction6()
{
	document.getElementsByClassName("saveButton6")[0].innerHTML="Saved!";
}