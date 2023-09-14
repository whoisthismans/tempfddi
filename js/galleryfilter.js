// JavaScript Document
$(document).ready(function(){
	
	// Once document is ready

	// Reference to dropdowns
	var ddlCampus = $('.campus');
	var selectedCampus = parseInt(ddlCampus.val());	
// 	var ddlActivities = $('#activities'+selectedCampus);
// 	var ddlSchools = $('#schools'+selectedCampus);
	
	// Hook up event handler for change event
 	ddlCampus.change( updateCampus );
// 	ddlActivities.change( doFilter );
// 	ddlSchools.change( doFilter );
	
	$('.activityli').hide();
	$('.schoolli').hide();
	var activityname = "campusactivities"+selectedCampus;
	$('#'+activityname).show();
		
	var schoolname = "campusschools"+selectedCampus;
	$('#'+schoolname).show();
		
	var ddlActivities = $('#activities'+selectedCampus);
	ddlActivities.change( doFilter );
		
	var ddlSchools = $('#schools'+selectedCampus);
	ddlSchools.change( doFilter );
	
	// Start with initial filtering
	doFilter();
	
	function updateCampus()
	{
		var selectedCampus = parseInt(ddlCampus.val());	
		//alert(selectedCampus);
		$('.activityli').hide();
		$('.schoolli').hide();
		var activityname = "campusactivities"+selectedCampus;
		$('#'+activityname).show();
		
		var schoolname = "campusschools"+selectedCampus;
		$('#'+schoolname).show();
		
		var ddlActivities = $('#activities'+selectedCampus);
		ddlActivities.change( doFilter );
		
		var ddlSchools = $('#schools'+selectedCampus);
		ddlSchools.change( doFilter );
		
		doFilter();
	}
	
	function doFilter(){
		//alert('tst');
		// Start with hiding all property item
		$('#property-load-section > .col-md-3').hide();
		
		var ddlCampus = $('.campus');
		var selectedCampus = parseInt(ddlCampus.val());	
		var ddlActivities = $('#activities'+selectedCampus);
		var ddlSchools = $('#schools'+selectedCampus);
	
		// Get the selected values
		var selectedCampus = parseInt(ddlCampus.val());
		var selectedType = ddlActivities.val();
		var selectedSchools = ddlSchools.val();
		console.log(selectedType);
		console.log(selectedSchools);
		
		// Get items matching campuss
		var matched = $('#property-load-section').find('.col-md-3').filter(function () {
			
			// Current property item
			var curPropertyItem = $(this)
			
			var curPropertyCampus = parseInt(curPropertyItem.attr('data-campus'));
			var curPropertyActivities = curPropertyItem.attr('data-activities');
			var curPropertySchools = curPropertyItem.attr('data-school');
			
			//console.log('Campus matched: ' + campusMatched());
			//console.log('Activities matched: ' + activitiesMatched());
			//console.log('Schools matched: ' + schoolsMatched())
			
			return ( campusMatched() && activitiesMatched() && schoolsMatched() );
			
			/*function campusMatched(){
				return curPropertyCampus >= selectedCampus;
			}*/
			
			function campusMatched(){
				if ( selectedCampus === 'all' ){
					return true;
				}
				else if( curPropertyCampus === selectedCampus ){
					return true;
				}
				else{
					return false;
				}
			}
			
			function activitiesMatched(){
				if ( selectedType === 'all' ){
					return true;
				}
				else if( curPropertyActivities === selectedType ){
					return true;
				}
				else{
					return false;
				}
			}
			
			function schoolsMatched(){
				
				if( selectedSchools === 'all' ){
					return true;
				}
				else if ( curPropertySchools === selectedSchools ){
					return true;
				}
				else{
					return false;
				}
			}			
		});
		
		// Show matched property
		//console.log('Matched items: ' + matched.length);
		matched.show();
	}	
})