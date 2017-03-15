var tabsarr = [];											// tabsarr is an array
   $('a[data-toggle="collapse"]').click(function () {				// when data-toggle is clicked
       if($(this).hasClass('collapsed')){							// and if that tab is collapsed right now
            if(tabsarr[0] === ''){									// and if the tabsarr is empty
                tabsarr[0] = $(this).attr('id');					// then write tab id to array
                $.cookie('name', tabsarr, { expires: 365 });		// and issue the cookie with array
            	console.log(tabsarr);								// and console log
            }
            else{													// but if the tabarr is not empty
                tabsarr.push($(this).attr('id'));					// put this id in the array
                $.cookie('name', tabsarr, { expires: 365 });		// and issue the cookie with array
            	console.log(tabsarr);								// and console log
            }
       }
       else{														// but if the tab is not collapsed
            var tabid = tabsarr.indexOf($(this).attr('id'));		// tabid is the tabid of the tab
            if(tabid >= 0){											// if tabid is a number
              tabsarr.splice(tabid,1);								// add that tabid to the array
              $.cookie('name', tabsarr, { expires: 365 });			// and issue the cookie with array
              console.log(tabsarr);									// and console log
            }
       }
   });

var tabsactive = $.cookie('name');									// tabsactive is a cookie
var activetabs =  tabsactive.split(',');							// activetabs is tabsactive split up by comma
    $.each( activetabs, function( index, value ){					// for each of those values,
          $('#'+value).click(); 									// simulate a click of those tabs
    });

$(document).ready(function(){										// ready!
	console.log('madisonrightnow.com: DOM is ready.');
	$('#tab1').click();
	$('#tab2').click();

	//$('.panel').fadeIn(3000);

//	$("img.lazy").lazy({
//        visibleOnly: true});

	$('#closeButton').click(function(){
		$('.panel-collapse').removeClass('in');
	});
	$('#openButton').click(function(){
		$('.panel-collapse').addClass('in');
	});
});