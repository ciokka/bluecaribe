
/*
$('#myDiv').bind('DOMNodeInserted DOMNodeRemoved', function(event) {
    if (event.type == 'DOMNodeInserted') {
        alert('Content added! Current content:' + '\n\n' + this.innerHTML);
    } else {
        alert('Content removed! Current content:' + '\n\n' + this.innerHTML);
    }
});
*/

// $ = jQuery;

// $(function(){
//     //alert("Passo di qui ready!");
//     //console.log($(".ovabrw_datetimepicker").datetimepicker());
//     window.setTimeout(function(){
//         $('.ovabrw_datetimepicker').datetimepicker('destroy');
//         $('.ovabrw_datetimepicker').off('click');
//     }, 500);

    


//     $('.ovabrw_datetimepicker.ovabrw_start_date').on('click', function() {
//         // Time Picker
//         var timePicker = $(this).closest('.ovabrw-form').find('.ovabrw_timepicker');

//         /* Disable Date */
//         var disabledDates       = [];
//         var order_time_arr_new  = [];
//         var order_time          = $(this).attr( 'order_time' );

//         var product_disable_week_day = $(this).data('disable-week-day');
//         if ( product_disable_week_day == '0' ) {
//             product_disable_week_day = '0,';
//         }

//         if ( product_disable_week_day ) {
//             disweek_arr = product_disable_week_day.toString().split(',').map(function(item) {
//                 return parseInt(item, 10);
//             });
//         }

//         if ( order_time ) {
//             order_time_arr_new = JSON.parse( order_time );
//         }
        
//         order_time_arr_new.forEach( function(item, index) {
//             if ( item.hasOwnProperty('rendering') ) {
//                 if ( item.start_v2 ) {
//                     disabledDates.push(item.start_v2);
//                 }
//             }
//         });
        
//         // Default Hour Start
//         var defaultTime = $(this).attr('default_hour');

//         var time_format = '';
//         if ( typeof brw_format_time !== 'undefined' ) {
//             time_format = brw_format_time;    
//         }

//         var timepicker = $(this).attr('timepicker');
//         if ( timepicker == 'true' ) {
//             timepicker = true;
//         } else {
//             timepicker = false;
//         }

//         var time_to_book    = $(this).attr('time_to_book');
//         var allowTimes      = Brw_Frontend.ova_get_time_to_book_start(time_to_book);

//         var datePickerOptions = {
//             dayOfWeekStart: firstday,
//             minDate: today,
//             disabledWeekDays: disweek_arr,
//             autoclose: true,
//             step: data_step,
//             format: date_format+' '+time_format,    
//             formatDate: date_format,
//             formatTime: time_format,
//             defaultTime: defaultTime,
//             allowTimes: allowTimes,
//             timepicker: timepicker,
//             disabledDates: disabledDates,
//         };

//         if ( $(this).hasClass('no_time_picker') || (allowTimes.length == 0) || timepicker == false ) {
//             datePickerOptions = {
//                 dayOfWeekStart: firstday,
//                 minDate: today,
//                 disabledWeekDays: disweek_arr,
//                 autoclose: true,
//                 step: data_step,
//                 format: date_format,    
//                 formatDate: date_format,
//                 defaultTime: false,
//                 allowTimes: allowTimes,
//                 timepicker: false,
//                 disabledDates: disabledDates,
//                 onSelectDate:function( ct, $i ) {
//                     if ( timePicker.length > 0 ) {
//                         timePicker.val('');
//                         timePicker.focus();
//                     }
//                 }
//             };
//         }

//         $(this).datetimepicker(datePickerOptions);
//     });

// });