var $ = jQuery.noConflict();



// count tickets 
function countTickets() {
	var currentTickets = parseInt( $("#tickets-list .reserve-fields-user").length );
	$("#tickets-amount").text(currentTickets);
}



// create empty HTML for ticket
function createEmptyTicket() {

	var currentTickets = parseInt( $("#tickets-list .reserve-fields-user").length );
	var thisTicket = currentTickets + 1;
	$("#tickets-amount").text(thisTicket);

	var newTicketHTML = $("#blank-ticket-example").clone().attr("id", "ticket-"+thisTicket);
	$(newTicketHTML).find("ticketnumber").text(thisTicket);

	$("#tickets-list").append(newTicketHTML);
	console.log(newTicketHTML);
}




// calculcate prices

function calculateTicketsPrice() {
	var price = 0;
	$("#tickets-list .reserve-fields-user").each(function(){

		var thisPrice = parseFloat ( $(this).find(".ticketPrices").find(':selected').attr('data-price') ) ;
		price +=  parseFloat(thisPrice);
	});
	price = price.toFixed(2);
	$("#totalprice span").text(price+" EUR");
}

// on document ready calculate event prices
$(document).ready(function() {
    calculateTicketsPrice();
});

// on ticket type change, update prices
$(document).on('change', '#tickets-list .ticketPrices', function()
{
    calculateTicketsPrice();
});

$(document).on('click', '.add-ticket', function() {
	createEmptyTicket();
	calculateTicketsPrice();
});



// validate fields
function validateTicketFields(){
	console.log("validate do");
}


// create tickets array 

function createTicketsArray() {
	var ticketsInfo = [];

	$("#tickets-list .reserve-fields-user").each(function(){
		var ticketInfo = {};

		$(this).find(".input").each(function()
        {
			var field = $(this).attr("value");
			var fieldValue = $(this).find(".inputValue").val();

			ticketInfo[field] = fieldValue;
		});
		ticketsInfo.push(ticketInfo);
	});
	return ticketsInfo;
}

// checkout

function ticketCheckout() {
  let data = new FormData();

  data.append('tickets', createTicketsArray());
  data.append('event_id', $(".event-signup-form").attr("event-id"));

  console.log(createTicketsArray());

  $.ajax({
     type: 'POST',
     url: '?pay=1',
     data: data,
     cache: false,
     contentType: false,
     processData: false
  })
  .done(function(response) {
      console.log(response);
  });
}

$("#checkout").on("click", function(){
  console.log('checkout');
	validateTicketFields();
	ticketCheckout();
});

// remove ticket
function recheckTicketIDS(){
	$("#tickets-list .reserve-fields-user").each(function(){
		var ind = $(this).index()+1;
		$(this).attr("id", "ticket-"+ind);
		$(this).find("ticketnumber").text(ind);
	});
}

$(document).on('click','.remove-ticket',function(){
	$(this).closest(".reserve-fields-user").remove();
	countTickets();
	recheckTicketIDS();
	calculateTicketsPrice();
});