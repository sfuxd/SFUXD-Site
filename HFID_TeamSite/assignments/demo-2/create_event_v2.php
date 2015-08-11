<!DOCTYPE html PUBLIC"-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
$username = "root";
$password = "password";
mysql_connect("localhost", $username, $password);
mysql_select_db("mydb");

//$query = 'create table cwftable (
//		id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
//		eventTitle VARCHAR(255),
//		eventDish VARCHAR(255),
//		eventLocation VARCHAR(255)
//		);'
//mysql_query($query);
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../../static/css/demo.css">
		<script src="../../static/js/jquery.min.js" type="text/javascript"></script>
		<script src="../../static/js/jqueryUI.js" type="text/javascript"></script>
		<script src="../../static/js/timepicker.js" type="text/javascript"></script>
		<style>
		
		input[type="text"]{
			display:inline-block;
			float:center;
			background: #FFFFFF;
			border: 2px solid #000000;
			opacity:0.6;
			padding:7px;
			color: #000000;
			width: 430px;
			text-align:left;
			font-family:Trebuchet MS;
			font-size:18px;
		}	
		</style>
		
		<script type="text/javascript">
		
			background_images = new Array("url('../../static/images/prototype/food/raspberrycupcakes.jpg')", "url('../../static/images/prototype/food/rainbowCake2.jpg')", "url('../../revisedMockups/assets/strawberriesBg.png')", "url('../../static/images/prototype/food/sashimi.jpg')", "url('../../static/images/prototype/food/tuscanLemonChicken.jpg')");
		
			function funcToCall()
			{
				var randURL = background_images[Math.floor(Math.random() * background_images.length)];
				document.getElementById("mainBody").style.background = randURL;
			}
		
			function removeA(arr){
			    var what, a= arguments, L= a.length, ax;
			    while(L> 1 && arr.length){
			        what= a[--L];
			        while((ax= arr.indexOf(what))!= -1){
			            arr.splice(ax, 1);
			        }
			    }
			    return arr;
			}
			
			
			info = {
				'friends':[],
				'recipes':[],
				'dishes':[],
				'ingredients':[],
				'name':'',
				'date':'',
				'time':'',
				'location':''
				};
			tabs = new Array('#nameTab', '#recipeTab', '#friendsTab', '#dateTab', '#timeTab', '#locationTab', '#summaryTab');
			blocks = new Array('#nameBlock', '#recipeBlock', '#friendsBlock', '#dateBlock', '#timeBlock', '#locationBlock', '#summaryBlock');
			
			
			function toggle_visibility(idt, idb) {
				for(i=0;i<tabs.length;i++){
					$(blocks[i]).css('display', 'none');
					$(tabs[i]).css('margin', '0px -5px 0px 0px');
					$(tabs[i]).css('width', '180px');
					$(tabs[i]).css('height', '91px');
					$(tabs[i]).css('background-color', 'rgba(100, 100, 100, 0.6)');
					$(tabs[i]).css('border', '2px none');
				}
				$(idb).css('display', 'inline-block');
				$(idt).css('margin', '0px -5px 0px 0px');
				$(idt).css('width', '180px');
				$(idt).css('height', '90px');
				$(idt).css('background-color', 'rgba(255, 255, 255, 0)');
				$(idt).css('border', '2px none solid none solid');
				
				if (idt === '#summaryTab') {
					$('#sName').html($('#eName').html());
					$('#sDish').html(info.dishes.join(", "));
					$('#sIngredient').html(info.ingredients.join(", "));
					$('#sFriends').html(info.friends.join(", "));
					$('#sDate').html($('#eDate').html());
					$('#sTime').html($('#eTime').html());
					$('#sLocation').html($('#eLocation').html());
				}
			}
			
			function toggleFriend(f){
				if($(f).css('border-top-style') === 'none'){
					$(f).css('border', '2px solid #00CC00');
					$(f).css('margin-top', '3px');
					$(f).css('margin-right', '-2px');
					$(f).css('margin-bottom', '3px');
					$(f).css('margin-left', '-2px');
					info.friends.push($(f + ' > .friendTag').html());
				} else {
					$(f).css('border', 'none');
					$(f).css('margin-top', '5px');
					$(f).css('margin-right', '0px');
					$(f).css('margin-bottom', '5px');
					$(f).css('margin-left', '0px');
					removeA(info.friends, $(f + ' > .friendTag').html());
				}
				<!-- $('#eFriends').html(info.friends.join(", ")); -->
			}
			
			function toggleDate(d) {
				date = "10-" + d.toString().slice(1) + "-12";
				info.date = date;
				$('.date').css('background', '#CCCCCC');
				$('#'+d.toString()).css('background', 'green');
				$('#eDate').html(date);
			}
			
			function toggleTime(t) {
				
				
			}
			
			function removeDishes() {
				var r=confirm("Are you sure you want to remove all the dishes from the menu?");
				if (r==true) {
					<!-- n.style.display = 'none'; -->
					info.dishes = [];
					$('#dishTextBox').val("");
					$('#sDish_Recipe').html("");
				}
			}
			
			function removeIngredients() {
				var r=confirm("Are you sure you want to clear the whole ingredients list?");
				if (r==true) {
					<!-- n.style.display = 'none'; -->
					info.ingredients = [];
					$('#ingredientTextBox').val("");
					$('#sIngredient_Recipe').html("");
				}
			}
			
			$(document).ready(function() {
				$('#submitButtonClicked').click(function () {
					console.log("clicked submit button");
					var r= confirm("Ready to submit?");
					if (r==true) {
						alert("The event information has been submitted!");
					}
					return r;
				});
			
				$('#basic_example_2').datetimepicker();
				$('#timeTextBox').keypress(function(e) {
					if (e.which == 13) {
						console.log("time");
						<!-- toggle_visibility('#locationTab', '#locationBlock'); -->
						$('#eTime').html($('#timeTextBox').val());
					}
				});
				$('#nameTextBox').keypress(function(e) {
					if (e.which == 13) {
						console.log("name");
						<!-- toggle_visibility('#dateTab', '#dateBlock'); -->
						$('#eName').html($('#nameTextBox').val());
					}
				});
				$('#dishTextBox').keypress(function(e) {
					if (e.which == 13) {
						console.log("dish");
						<!-- toggle_visibility('#recipeTab', '#recipeBlock'); -->
						info.recipes.push($('#dishTextBox').val());
						info.dishes.push($('#dishTextBox').val());
						<!-- $('#eRecipes').html(info.recipes.join(", ")); -->
						$('#dishTextBox').val("");
						$('#sDish_Recipe').html(info.dishes.join(", "));
					}
				});
				$('#ingredientTextBox').keypress(function(e) {
					if (e.which == 13) {
						console.log("ingredient");
						<!-- toggle_visibility('#recipeTab', '#recipeBlock'); -->
						info.recipes.push($('#ingredientTextBox').val());
						info.ingredients.push($('#ingredientTextBox').val());
						<!-- $('#eRecipes').html(info.recipes.join(", ")); -->
						$('#ingredientTextBox').val("");
						$('#sIngredient_Recipe').html(info.ingredients.join(", "));
					}
				});
				$('#locationTextBox').keypress(function(e) {
					if (e.which == 13) {
						console.log("location");
						$('#eLocation').html($('#locationTextBox').val());
						toggle_visibility('#friendsTab', '#friendsBlock');
					}
				});
				$('#commentsTextBox').keypress(function(e) {
					if (e.which == 13) {
						console.log("comments");
						$('#sComments').html($('#commentsTextBox').val());
					}
				});
			});
			
		</script>
		
	</head>


	<body onload="funcToCall()">


<!------------------------------PHP for storing info in a Datatable-------- -->	
	
<?php
if (isset($_POST['submitbutton'])) {    //if the submit button is pressed
	echo '<p>hii</p>';
	$eventTitle = mysql_escape_string($_POST['eventTitle']);
	$eventDish = mysql_escape_string($_POST['eventDish']);				
	$eventLocation = mysql_escape_string($_POST['eventLocation']);		
	
	$query = 'insert into cwftable
			(eventTitle, eventDish, eventLocation)
			values
			("'.$eventTitle.'", "'.$eventDish.'" "'.$eventLocation.'")';
	mysql_query($query);
	
}
?>

<!------------------------------PHP for storing info in a Datatable-------- -->	
	
		<div style="position:relative; margin:40px 0px 0px 40px">
			<img class="ipad-img" src="../../static/images/prototype/ipadRev.png">
			<div class="template-div">  <!--756 by 576-->
				<div class="strawberryBody" id="mainBody">
					<!-- PUT STUFF HERE -->
					<div class="createEventHomeButtonDiv">
						<a href="mainpage_v2.html"><div class="mainPageNameButton">Cook With Friends</div></a>
					</div>	
						
					<div class = "createNewEventTitleButton">Create Event</div>
					
					
					<div class="eventBox">
						<div class="nav-bar">
							<a class="select" onclick="toggle_visibility('#nameTab', '#nameBlock');">
								<div class="nav-bar-link-tall-2" id="nameTab">
									<div>What's Cooking?</div>
									<div id="eName"></div>
								</div>
							</a>
							<a class="select" onclick="toggle_visibility('#dateTab', '#dateBlock');">
								<div class="nav-bar-link-tall" id="dateTab">
									<div>When? Where?</div>
									<div id="eDate"></div>
									<div id="eTime"></div>
									<div id="eLocation"></div>
								</div>
							</a>
							<a class="select" onclick="toggle_visibility('#friendsTab', '#friendsBlock');">
								<div class="nav-bar-link-tall" id="friendsTab">
									<div>Invite Friends</div>
									<div id="eFriends"></div>
								</div>
							</a>
							<a class="select" onclick="toggle_visibility('#summaryTab', '#summaryBlock');">
								<div class="nav-bar-link-tall" id="summaryTab">
									<div>Summary</div>
									<div id="eSummary"></div>
								</div>
							</a>
						</div>
						<div class="nav-bar-toggle-2" id="nameBlock">
							<div class="headingSmall">Title your event!</div>
							<div>Please hit "Enter" to save.</div>
							<input id="nameTextBox" type="text" name="eventTitle">
							
							
							<div class="headingSmall">Add a dish to the menu!</div>
							<!-- <div>Please hit "Enter" to save.</div> -->
							<input id="dishTextBox" type="text" name="eventDish">
							<a class="select" onclick="removeDishes();">
								<div class="x xCreateEventMargin"><img src="../../static/images/styling/x.png" width="10px"></div>
							</a> 
							<div>Cooking: <span id="sDish_Recipe"></span></div>
							
							<div class="headingSmall">What ingredients would you like others to bring?</div>
							<!-- <div>Please specify quantity.</div> -->
							<input id="ingredientTextBox" type="text" name="eventIngredient">
							
							<a class="select" onclick="removeIngredients();">
								<div class="x xCreateEventMargin"><img src="../../static/images/styling/x.png" width="10px"></div>
							</a> 
							<div>Ingredients: <span id="sIngredient_Recipe"></span></div>
							
							<!-- <div class="headingSmall">List recipes to cook:</div>
							<input id="nameTextBox" type="text" name="recipeList">
							<div class="headingSmall">List ingredients you will bring:</div>
							<input id="nameTextBox" type="text" name="ingredientList"> -->
						</div>
						<div class="nav-bar-toggle" id="recipeBlock">
							<div class="recipeBox">
								<div class="headingSmall">Recipes already selected:</div>
							</div>
							<a href="recipebook.html"><div class="uploadRecipeButton">Choose another recipe</div></a>
						</div>
						<div class="nav-bar-toggle" id="friendsBlock">
							<div class="headingSmall">Tap friends to invite them:</div>
							<div class="friendsBox">
								<a class="select" onclick="toggleFriend('#allie');"><div class="friendBlock" id="allie">
									<div class="friend"><img src="../../static/images/prototype/people/allie.jpg" width="90px"></div>
									<div class="friendTag">Allie S.</div>
								</div></a>
								<a class="select" onclick="toggleFriend('#bob');"><div class="friendBlock" id="bob">
									<div class="friend"><img src="../../static/images/prototype/people/bob.jpg" width="90px"></div>
									<div class="friendTag">Bob R.</div>
								</div></a>
								<a class="select" onclick="toggleFriend('#paul');"><div class="friendBlock" id="paul">
									<div class="friend"><img src="../../static/images/prototype/people/paul.jpg" width="90px"></div>
									<div class="friendTag">Paul K.</div>
								</div></a>
								<a class="select" onclick="toggleFriend('#sara');"><div class="friendBlock" id="sara">
									<div class="friend"><img src="../../static/images/prototype/people/sara.jpg" width="90px"></div>
									<div class="friendTag">Sara Y.</div>
								</div></a>
								<a class="select" onclick="toggleFriend('#deirdre');"><div class="friendBlock" id="deirdre">
									<div class="friend"><img src="../../static/images/prototype/people/deirdre.jpg" width="90px"></div>
									<div class="friendTag">Deirdre O.</div>
								</div></a>
								<a class="select" onclick="toggleFriend('#joe');"><div class="friendBlock" id="joe">
									<div class="friend"><img src="../../static/images/prototype/people/joe.jpg" width="90px"></div>
									<div class="friendTag">Joe F.</div>
								</div></a>
								<a class="select" onclick="toggleFriend('#gina');"><div class="friendBlock" id="gina">
									<div class="friend"><img src="../../static/images/prototype/people/gina.jpg" width="90px"></div>
									<div class="friendTag">Gina H.</div>
								</div></a>
								<a class="select" onclick="toggleFriend('#lisa');"><div class="friendBlock" id="lisa">
									<div class="friend"><img src="../../static/images/prototype/people/lisa.jpg" width="90px"></div>
									<div class="friendTag">Lisa S.</div>
								</div></a>
								<a class="select" onclick="toggleFriend('#tina');"><div class="friendBlock" id="tina">
									<div class="friend"><img src="../../static/images/prototype/people/tina.jpg" width="90px"></div>
									<div class="friendTag">Tina D.</div>
								</div></a>
							</div>
						</div>
						<div class="nav-bar-toggle" id="dateBlock">
							<div class="headingSmall2">Tap a date to select:</div>
							<center>December 2012</center>
							<div class="calendar">
								<div class="dateHolder"></div>
								<a href="#" onclick="toggleDate('d1');"><div class="date" id="d1">1</div></a>
								<a href="#" onclick="toggleDate('d2');"><div class="date" id="d2">2</div></a>
								<a href="#" onclick="toggleDate('d3');"><div class="date" id="d3">3</div></a>
								<a href="#" onclick="toggleDate('d4');"><div class="date" id="d4">4</div></a>
								<a href="#" onclick="toggleDate('d5');"><div class="date" id="d5">5</div></a>
								<a href="#" onclick="toggleDate('d6');"><div class="date" id="d6">6</div></a>
								<a href="#" onclick="toggleDate('d7');"><div class="date" id="d7">7</div></a>
								<a href="#" onclick="toggleDate('d8');"><div class="date" id="d8">8</div></a>
								<a href="#" onclick="toggleDate('d9');"><div class="date" id="d9">9</div></a>
								<a href="#" onclick="toggleDate('d10');"><div class="date" id="d10">10</div></a>
								<a href="#" onclick="toggleDate('d11');"><div class="date" id="d11">11</div></a>
								<a href="#" onclick="toggleDate('d12');"><div class="date" id="d12">12</div></a>
								<a href="#" onclick="toggleDate('d13');"><div class="date" id="d13">13</div></a>
								<a href="#" onclick="toggleDate('d14');"><div class="date" id="d14">14</div></a>
								<a href="#" onclick="toggleDate('d15');"><div class="date" id="d15">15</div></a>
								<a href="#" onclick="toggleDate('d16');"><div class="date" id="d16">16</div></a>
								<a href="#" onclick="toggleDate('d17');"><div class="date" id="d17">17</div></a>
								<a href="#" onclick="toggleDate('d18');"><div class="date" id="d18">18</div></a>
								<a href="#" onclick="toggleDate('d19');"><div class="date" id="d19">19</div></a>
								<a href="#" onclick="toggleDate('d20');"><div class="date" id="d20">20</div></a>
								<a href="#" onclick="toggleDate('d21');"><div class="date" id="d21">21</div></a>
								<a href="#" onclick="toggleDate('d22');"><div class="date" id="d22">22</div></a>
								<a href="#" onclick="toggleDate('d23');"><div class="date" id="d23">23</div></a>
								<a href="#" onclick="toggleDate('d24');"><div class="date" id="d24">24</div></a>
								<a href="#" onclick="toggleDate('d25');"><div class="date" id="d25">25</div></a>
								<a href="#" onclick="toggleDate('d26');"><div class="date" id="d26">26</div></a>
								<a href="#" onclick="toggleDate('d27');"><div class="date" id="d27">27</div></a>
								<a href="#" onclick="toggleDate('d28');"><div class="date" id="d28">28</div></a>
								<a href="#" onclick="toggleDate('d29');"><div class="date" id="d29">29</div></a>
								<a href="#" onclick="toggleDate('d30');"><div class="date" id="d30">30</div></a>
								<a href="#" onclick="toggleDate('d31');"><div class="date" id="d31">31</div></a>
								<div class="dateHolder"></div>
								<div class="dateHolder"></div>
								<div class="dateHolder"></div>
							</div>
							
							
							<div class="headingSmall2">Select a time:</div>
							<input id="timeTextBox" type="text" value="">
							
							<div class="headingSmall2">Enter the event location:</div>
							<input id="locationTextBox" type="text" name="eventLocation">
						</div>
						<div class="nav-bar-toggle" id="summaryBlock">
							<div class="alignLeftBlock">
								<div class="createEventSummaryMargins">What: <span id="sName">Dessert Party!</span></div>
								<div class="createEventSummaryMargins">Cooking: <span id="sDish">Dishes</span></div>
								<div class="createEventSummaryMargins">Ingredients: <span id="sIngredient">Ingredients</span></div>
								<div class="createEventSummaryMargins">When: <span id="sDate">October 1st, 2012</span> at <span id="sTime">2:30 pm</span></div>
								<div class="createEventSummaryMargins">Where: <span id="sLocation">My house</span></div>
								<div class="createEventSummaryMargins">Invited: <span id="sFriends">My friends</span></div>
								<!-- TODO: show correct friends, not defaults
								<div class="friendsSelected">
									<div class="friendsSelectedNormal">
										<div class="friendBlock">
											<div class="friend"><img src="../../static/images/prototype/people/allie.jpg" width="90px"></div>
											<div class="friendTag">Allie S.</div>
										</div>
										<div class="friendBlock">
											<div class="friend"><img src="../../static/images/prototype/people/joe.jpg" width="90px"></div>
											<div class="friendTag">Joe F.</div>
										</div>
										<div class="friendBlock">
											<div class="friend"><img src="../../static/images/prototype/people/deirdre.jpg" width="90px"></div>
											<div class="friendTag">Deirdre O.</div>
										</div>
									</div> -->
								<div class="createEventSummaryMargins">Comments: <span id="sComments"></div>
								<input id="commentsTextBox" type="text" name="eventComments" value="Your Comment Here">
								
									
								</div>
								<div class="buttonBlock">
									<a href="mainpage_v2.html"><div class="submitButton" id="submitButtonClicked">Submit</div></a>
									<input type="submit" name="submitbutton" value="Post" />
									<!-- <a href="mainpage_v1.html"><div class="cancelButton">Cancel</div></a> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>



