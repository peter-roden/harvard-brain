jQuery(document).ready(function($){ 

	$('.alphabet-A').on('click', runMyAjaxA);
	$('.alphabet-B').on('click', runMyAjaxB);
	$('.alphabet-C').on('click', runMyAjaxC);
	$('.alphabet-D').on('click', runMyAjaxD);
	$('.alphabet-E').on('click', runMyAjaxE);
	$('.alphabet-F').on('click', runMyAjaxF);
	$('.alphabet-G').on('click', runMyAjaxG);
	$('.alphabet-H').on('click', runMyAjaxH);
	$('.alphabet-I').on('click', runMyAjaxI);
	$('.alphabet-J').on('click', runMyAjaxJ);
	$('.alphabet-K').on('click', runMyAjaxK);
	$('.alphabet-L').on('click', runMyAjaxL);
	$('.alphabet-M').on('click', runMyAjaxM);
	$('.alphabet-N').on('click', runMyAjaxN);
	$('.alphabet-O').on('click', runMyAjaxO);
	$('.alphabet-P').on('click', runMyAjaxP);
	$('.alphabet-Q').on('click', runMyAjaxQ);
	$('.alphabet-R').on('click', runMyAjaxR);
	$('.alphabet-S').on('click', runMyAjaxS);
	$('.alphabet-T').on('click', runMyAjaxT);
	$('.alphabet-U').on('click', runMyAjaxU);
	$('.alphabet-V').on('click', runMyAjaxV);
	$('.alphabet-W').on('click', runMyAjaxW);
	$('.alphabet-X').on('click', runMyAjaxX);
	$('.alphabet-Y').on('click', runMyAjaxY);
	$('.alphabet-Z').on('click', runMyAjaxZ);
	$('.alphabet-ALL').on('click', runMyAjaxALL);
	$('.alphabet-ALL').on('click', runMyAjaxALL);
	$('select[name="search-research-areas"]').on('change', runMyAjaxResearch);
		
	function runMyAjaxA(){
		var letter = $('.alphabet-A').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxB(){
		var letter = $('.alphabet-B').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxC(){
		var letter = $('.alphabet-C').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxD(){    
		var letter = $('.alphabet-D').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxE(){
		var letter = $('.alphabet-E').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxF(){
		var letter = $('.alphabet-F').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxG(){
		var letter = $('.alphabet-G').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxH(){
		var letter = $('.alphabet-H').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxI(){
		var letter = $('.alphabet-I').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxJ(){
		var letter = $('.alphabet-J').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxK(){
		var letter = $('.alphabet-K').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxL(){
		var letter = $('.alphabet-L').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxM(){
		var letter = $('.alphabet-M').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxN(){
		var letter = $('.alphabet-N').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxO(){
		var letter = $('.alphabet-O').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxP(){
		var letter = $('.alphabet-P').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxQ(){
		var letter = $('.alphabet-Q').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxR(){
		var letter = $('.alphabet-R').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxS(){
		var letter = $('.alphabet-S').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxT(){
		var letter = $('.alphabet-T').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxU(){
		var letter = $('.alphabet-U').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxV(){
		var letter = $('.alphabet-V').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxW(){
		var letter = $('.alphabet-W').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxX(){
		var letter = $('.alphabet-X').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxY(){
		var letter = $('.alphabet-Y').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}
	
	function runMyAjaxZ(){
		var letter = $('.alphabet-Z').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}	
	
	function runMyAjaxALL(){
		var letter = $('.alphabet-ALL').val();
		var data = {
		    'action': 'display_people_alphabetical',
		    'letter': letter,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}	

	function runMyAjaxResearch(){
		var research_area = $('#search-research-areas option:selected').text();
		var data = {
		    'action': 'display_people_research_area',
		    'research_area': research_area,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
	}	
        
	$('form#search-text').bind('submit', function() {
        var search = $('#search-term').val();
        var data = {
		    'action': 'display_people_search_text',
		    'search': search,
		    'nonce': frontEndAjax.nonce
		};
	   	$.post(frontEndAjax.ajaxurl, data, function(result) {
        	$('#people-search-results').html(result);  
        });
        return false;
    });

	window.addeventasync = function(){
	    addeventatc.settings({
		    css        : false,
	        appleical  : {show:true, text:"Apple Calendar"},
	        google     : {show:true, text:"Google <em>(online)</em>"},
	        outlook    : {show:true, text:"Outlook"},
	        outlookcom : {show:true, text:"Outlook.com <em>(online)</em>"},
	        yahoo      : {show:false, text:"Yahoo <em>(online)</em>"}
	    });
	};

});