jQuery(document).ready(function($){
    function calculations() {
        var priceperday = parseFloat($('#pricePerDay').val());
        var numberOfPersons = parseInt($('#numberOfPersons').val());
        var maxNumberOfDays = parseInt($('#maxNumberOfDays').val());

        var total = maxNumberOfDays * priceperday;
        var pricePerPerson = total / numberOfPersons;
        

        $("#perPersonTotals").empty();
        var n = pricePerPerson;
        var val = Math.round(Number(n) *100) / 100;
        var parts = val.toString().split(".");
        var num = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
        $("#perPersonTotals").append("$"+num);

        $("#totalT").empty();
        var n = total;
        var val = Math.round(Number(n) *100) / 100;
        var parts = val.toString().split(".");
        var num = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
        $("#totalT").append("$"+num);
    }

    var maxDays = $('#maxNumberOfDays').prop('max');
    var maxPeople = $('#numberOfPersons').prop('max');

    $("#datepickerFrom").datepicker({ 
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        minDate: new Date(),
        maxDate: '+2y',
        onSelect: function(date){
    
            var selectedDate = new Date(date);
            var msecsInADay = 86400000;
            var endDate = new Date(selectedDate.getTime() + msecsInADay);
            var maxxx = new Date(selectedDate.getTime() + (msecsInADay * maxDays));
            
            $("#datepickerTo").datepicker( "option", "minDate", endDate );
            $("#datepickerTo").datepicker( "option", "maxDate", maxxx );
        }
    });
    
    $("#datepickerTo").datepicker({ 
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        onSelect: function(date){
            var fromDate = $("#datepickerFrom").datepicker( 'getDate' );
            var toDate = $("#datepickerTo").datepicker( 'getDate' );

            var daysSelected = toDate - fromDate;
            daysSelected = daysSelected / 86400000;
            $("#slider").val($( "#slider" ).slider("value", daysSelected));
            $("#maxNumberOfDays").val(daysSelected);
            calculations();
        }
    });
    

    $( "#slider" ).slider({
        min: 1,
        max: maxDays
    });

    $( "#slider" ).on( "slidechange", function( event, ui ) {
        $("#maxNumberOfDays").val($( "#slider" ).slider("option", "value"));
        var sliderVal = parseInt($( "#slider" ).slider("option", "value"));
        var newDateTo = $('#datepickerFrom').datepicker('getDate', '+'+sliderVal+'d'); 
        newDateTo.setDate(newDateTo.getDate()+sliderVal); 
        $('#datepickerTo').datepicker('setDate', newDateTo);
        calculations();
    });

    $( "#maxNumberOfDays" ).on( "change", function() {
        if ($(this).val() > maxDays){
            $(this).val(maxDays);
        }
        $("#slider").val($( "#slider" ).slider("value", $(this).val()));
        calculations();
    });

    $( "#numberOfPersons" ).on( "change", function() {
        if ($("#numberOfPersons").val() > maxPeople){
            $("#numberOfPersons").val(maxPeople);
        }
        console.log('aaaa');
        calculations();
    });
});
