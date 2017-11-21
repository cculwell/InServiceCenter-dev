var Client_Id = "926767991162-l7nms773dl30u94mk72luumt6c92o07f.apps.googleusercontent.com";
var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"];
var SCOPES = "https://www.googleapis.com/auth/calendar";
var private_CalID ="inserviceathens@gmail.com";



//Handles the booked reservations page



function HandleUpdatePage(ReservationID, OriginalRoom) {
    $('#updateBookedEvent').on('click', function () {


        var form = $('#form_id'+ReservationID);
        sign_in();
        var form_data = form.serialize();

        $.ajax({
            type: 'POST',
            url: 'php/BookEvent.php',
            data: form_data,
            success: function () {
                console.log('Form Sent');
                UpdateEvents(form, OriginalRoom);
                $('#reservationQueue').load('php/CalendarAdmin.php');
            },
            error: function (data) {
                console.log('Error on sending form');
                $('#reservationQueue').load('php/CalendarAdmin.php');
            }
        });

        event.preventDefault();
    });


        var delete_button = $('#deleteEvent' + ReservationID).on('click', function(){
            var form = $('#form_id'+ReservationID);
            sign_in();
            $.ajax({
                type: 'POST',
                url: 'php/BookEvent.php',
                data: {DeleteEvent: "DELETE", ReservationID: ReservationID},
                success:function()
                {
                    deleteAllBookedEvents(form, OriginalRoom);
                },
                error:function () {
                    alert("Error Canceling Booked Event")
                }
            });
        });


}

//Handles pending, canceled(non-reserved), and created forms
function HandleClick(ReservationID)
{
    var book = $('#bookEvent');

    //Then start the booking process
    book.on('click', function () {
        sign_in();
        console.log(ReservationID);
        var global_form=$('#form_id'+ReservationID);
        var form_data = global_form.serialize();

        $.ajax({
            type: 'POST',
            url: 'php/BookEvent.php',
            data: form_data,
            success: function () {
                console.log('Form Sent');
                MainEventFunction(global_form, 'book');
                $('#reservationQueue').load('php/CalendarAdmin.php');
            },
            error: function (data) {
                console.log('Error on sending form');
                $('#reservationQueue').load('php/CalendarAdmin.php');
            }
        });

        event.preventDefault();
    });

    $('.deletePending').on('click',  function () {
        console.log("Cancel Event");

        $.ajax({
            type: 'POST',
            url: 'php/BookEvent.php',
            data: {DeleteEvent: "DELETE", ReservationID: ReservationID},
            success: function () {
                $('#reservationQueue').load('php/CalendarAdmin.php');
            },
            error: function (data) {
                alert('Error on sending Delete Request');
                $('#reservationQueue').load('php/CalendarAdmin.php');
            }
        });

        event.preventDefault();
    });



}
/*
 *  OAuth2 functions that allow the user to book calendar events within the admin page
 *  Must First Login to make any necessary changes to the Calendar i.e. Create, Update, Delete
 *  ===========================================================================================
 */
function handleClientLoad() {

    gapi.load('client:auth2', initClient);
}

function sign_in(event)
{
    gapi.auth2.getAuthInstance().signIn();
}
function initClient() {
    gapi.client.init({
        discoveryDocs: DISCOVERY_DOCS,
        clientId: Client_Id,
        scope: SCOPES
    }).then(function () {
        // Listen for sign-in state changes.
        gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

        // Handle the initial sign-in state.
        updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
    });
}
function updateSigninStatus(isSignedIn) {
    // When signin status changes, this function is called.
    // If the signin status is changed to signedIn, we make an API call.
    if (isSignedIn) {
        console.log("I am Signed In");
    }
}
//Where all of the google processing is at
function MainEventFunction(FormList, status) {
    var Form_Array = FormList.serializeArray();
    var FormData = [];
    $.each(Form_Array, function (i, field) {
        FormData.push(field.value);
    });
    var index = 0;
    var reservationID = FormData[0];
    var program = FormData[1];
    var sponsorGroup = FormData[2];
    var description = FormData[3];
    var contactName = FormData[4];
    var contactPhone = FormData[5];
    var contactEmail = FormData[6];
    var room = FormData[7];
    var num_people = FormData[8];
    //RegEx var to search through form for dates
    var dateReg = /^\d{1,2}\/\d{1,2}\/\d{4}$/;

    var date = [];
    var startTime = [];
    var endTime = [];
    var preTime = [];
    var EventsID = [];
    //Get Dates for the events
    for (index = 0; index < FormData.length; index++) {
        if (dateReg.test(FormData[index])) {
            date.push(FormData[index]);
            startTime.push(FormData[index + 1]);
            endTime.push(FormData[index + 2]);
            preTime.push(FormData[index + 3]);
            EventsID.push(FormData[index + 4]);
        }
    }
    //Loop to insert the dates to Google Calendar
    if (status === 'book') {
        for (index = 0; index < date.length; index++) {
            //Use closure if you need access to the eventID within the ajax call
            (function () {
                var eventID = EventsID[index];
                var start = DateTimeConvert(date[index], startTime[index]);

                var end = DateTimeConvert(date[index], endTime[index]);

                var private_event = {
                    'summary': room + ": " + program,
                    'location': '300 North Beaty Street\n' +
                    'Athens, AL 35611',
                    'description': description,
                    'start': {
                        'dateTime': start
                    },
                    'end': {
                        'dateTime': end
                    }

                };
                var public_event = {
                    'summary': room + ": Busy",
                    'location': '300 North Beaty Street\n' +
                    'Athens, AL 35611',
                    'description': 'Room will be busy during this time',
                    'start': {
                        'dateTime': start
                    },
                    'end': {
                        'dateTime': end
                    }
                };
                //Insert to the public calendar
                var PublicInsertGoogle = gapi.client.calendar.events.insert({
                    'calendarId': getID(room),
                    'resource': public_event
                });
                PublicInsertGoogle.execute(function (event) {
                    console.log(event);

                    $.ajax({
                        type: 'POST',
                        url: 'php/BookEvent.php',
                        data: {
                            PublicID: event.id,
                            EventID: eventID
                        },
                        success: function () {
                            console.log(event.id);
                        },
                        error: function () {
                            console.log('Error in sending Public ID')
                        }
                    });
                });
                //Insert to the private calendar
                var PrivateInsertGoogle = gapi.client.calendar.events.insert({
                    'calendarId': private_CalID,
                    'resource': private_event
                });
                PrivateInsertGoogle.execute(function (response) {
                    $.ajax({
                        type: 'POST',
                        url: 'php/BookEvent.php',
                        data: {
                            PrivateID: response.id,
                            EventID: eventID
                        },
                        success: function () {
                            console.log(response.id);
                        },
                        error: function () {
                            console.log('Error in sending Private ID')
                        }
                    });
                });
            })();
        }
    }
}
//Delete All of Events That are reserved
function deleteAllBookedEvents(FormList, OriginalRoom)
{
    var Form_Array = FormList.serializeArray();
    var FormData = [];
    $.each(Form_Array, function (i, field) {
        FormData.push(field.value);
    });
    var index = 0;
    var dateReg = /^\d{1,2}\/\d{1,2}\/\d{4}$/;

    var date = [];
    var EventsID=[];
    var publicID=[];
    var privateID=[];
    var status = [];

    for (index = 0; index < FormData.length; index++) {
        if (dateReg.test(FormData[index])) {
            status.push(FormData[index-1]);
            EventsID.push(FormData[index + 4]);
            privateID.push(FormData[index+5]);
            publicID.push(FormData[index+6]);

        }
    }
    for (index = 0; index < date.length; index++)
    {
        //Reserved Dates will be kept in mySQL but will be deleted from Calendar
        if(status[index] === 'reserved' || status[index] === 'delete')
        {
            googleDeleteEvent(OriginalRoom, publicID, privateID);
        }
        else if(status[index] === 'unreserved')
        {
            deleteEventSQL(EventsID[index]);
        }

    }
}
function UpdateEvents(FormList, OriginalRoom)
{
    var Form_Array = FormList.serializeArray();
    var FormData = [];
    $.each(Form_Array, function (i, field) {
        FormData.push(field.value);
    });
    var index = 0;
    var reservationID = FormData[0];
    var program = FormData[1];
    var sponsorGroup = FormData[2];
    var description = FormData[3];
    var contactName = FormData[4];
    var contactPhone = FormData[5];
    var contactEmail = FormData[6];
    var room = FormData[7];
    var num_people = FormData[8];

    //RegEx var to search through form for dates
    var dateReg = /^\d{1,2}\/\d{1,2}\/\d{4}$/;

    var date = [];
    var startTime = [];
    var endTime=[];
    var preTime=[];
    var EventsID=[];
    var publicID=[];
    var privateID=[];
    var status = [];
    for (index = 0; index < FormData.length; index++) {
        if (dateReg.test(FormData[index])) {
            status.push(FormData[index-1]);
            date.push(FormData[index]);
            startTime.push(FormData[index + 1]);
            endTime.push(FormData[index + 2]);
            preTime.push(FormData[index + 3]);
            EventsID.push(FormData[index + 4]);
            privateID.push(FormData[index+5]);
            publicID.push(FormData[index+6]);

        }
    }

    for (index = 0; index < date.length; index++)
    {
        (function(){
            var start = DateTimeConvert(date[index], startTime[index]);
            var end = DateTimeConvert(date[index], endTime[index]);


            var publicResource={
                'summary': room + ": Busy",
                'location': '300 North Beaty Street\n' +
                'Athens, AL 35611',
                'description': 'Room will be busy during this time',
                'start': {
                    'dateTime': start
                },
                'end': {
                    'dateTime': end
                }
            };
            var privateResource={
                'summary': room + ": " + program,
                'location': '300 North Beaty Street\n' +
                'Athens, AL 35611',
                'description': description,
                'start': {
                    'dateTime': start
                },
                'end': {
                    'dateTime': end
                }
            };
            console.log(status[index]);
            if(status[index] === 'delete')
            {
                console.log("Delete Id");
                googleDeleteEvent(OriginalRoom, publicID[index], privateID[index]);
                deleteEventSQL(EventsID[index]);
            }
            else if(status[index] === 'reserved' && OriginalRoom !== room)
            {
                console.log("Moving Date");
                moveEvents(room, OriginalRoom, EventsID[index], publicID[index]);
                updateGoogleEvents(privateResource, publicResource, room, publicID[index], privateID[index]);
            }
            else if(status[index] === 'unreserved')
            {
                console.log("Inserting Date");

                googleInsertEvent(privateResource, publicResource, room, EventsID[index]);
                $.ajax({
                    type: "POST",
                    url: 'php/BookEvent.php',
                    data: {EventID: EventsID[index], ChangeStatusTrigger: 'reserved'},
                    success: function(results){console.log(results);},
                    error: function(){return false;}
                });

            }
            else
            {
                updateGoogleEvents(privateResource, publicResource, room, publicID[index], privateID[index]);
            }

        })();

    }

}
function googleInsertEvent(privateResource, publicResource, room, eventID)
{
    var PublicInsertGoogle = gapi.client.calendar.events.insert({
        'calendarId': getID(room),
        'resource': publicResource
    });
    PublicInsertGoogle.execute(function (event) {
        console.log(event);
        $.ajax({
            type: 'POST',
            url: 'php/BookEvent.php',
            data: {
                PublicID: event.id,
                EventID: eventID
            },
            success: function (response) {
                console.log(response);
            },
            error: function () {
                console.log('Error in sending Public ID')
            }
        });
    });

    var PrivateInsertGoogle = gapi.client.calendar.events.insert({
        'calendarId': private_CalID,
        'resource': privateResource
    });
    PrivateInsertGoogle.execute(function (response) {
        $.ajax({
            type: 'POST',
            url: 'php/BookEvent.php',
            data: {
                PrivateID: response.id,
                EventID: eventID
            },
            success: function () {
                console.log(eventID);
            },
            error: function () {
                console.log('Error in sending Private ID')
            }
        });
    });

}
function updateGoogleEvents(privateResource, publicResource, room, publicId, privateId)
{
    var publicUpdate = gapi.client.calendar.events.update({
        'calendarId': getID(room),
        'eventId': publicId,
        'resource': publicResource
    });

    publicUpdate.execute(function (response) {
        console.log(response);
    });
    var privateUpdate = gapi.client.calendar.events.update({
        'calendarId': private_CalID,
        'eventId': privateId,
        'resource': privateResource
    });
    privateUpdate.execute(function (response) {
        console.log(response);
    });
}
function deleteEventSQL(EventId)
{
    $.ajax({
        type: 'POST',
        url: 'php/Edit_Form.php',
        data: {DeleteEventID: EventId},
        success:function(){
            console.log("Delete Sql worked");
        },
        error:function()
        {
            console.log("Problem with sql delete");
        }
    })
}
function googleDeleteEvent(room, publicID, privateID)
{
    var publicDelete = gapi.client.calendar.events.delete({
        'calendarId':getID(room),
        'eventId': publicID
    });
    publicDelete.execute(function(response){
        console.log(response);
    });
    var privateDelete = gapi.client.calendar.events.delete({
        'calendarId':private_CalID,
        'eventId': privateID
    });
    privateDelete.execute(function(response){
        console.log(response);
    })
}
function moveEvents(room, OriginalRoom, EventsID, publicID)
{
    var public_move = gapi.client.calendar.events.move({
        'calendarId': getID(OriginalRoom),
        'eventId': publicID,
        'destination': getID(room)
    });
    public_move.execute(function (results) {
        $.ajax({
            type: 'POST',
            url: 'php/BookEvent.php',
            data: {'PublicID': results.id, 'EventId': EventsID},
            success: function(){
                console.log("Event Moved");
                publicID = results.id;
            },
            error: function(){
                console.log("Unable to insert the new id");
            }
        });
    });
}
//Retrieve the room ID by comparing each room
function getID(room) {
    var CalendarID;
    if (room === 'Room A') {
        CalendarID = 'j1op03kcbf1qlc4sj2ugql60vo@group.calendar.google.com';
    }
    else if (room === 'Room B') {
        CalendarID = 'u8g195h4cs0r1dstm5vpv3nef4@group.calendar.google.com';
    }
    else if (room === 'Room C') {
        CalendarID = 'gqqkj2f7vk943ksirgdnjjj6c0@group.calendar.google.com';
    }
    else if (room === 'Conference') {
        CalendarID = 'qgud29lqo5gl2v2hrtf185asvo@group.calendar.google.com';
    }
    return CalendarID;
}

function DateTimeConvert(date, time) {
    var dateArray = date.split('/');

    return dateArray[2] + '-' + dateArray[0] + '-' + dateArray[1] + 'T' + Time24(time);
}

function Time24(time) {
    var hour = time.match(/^(\d+)/)[1];
    var minute = time.match(/:(\d+)/)[1];
    var am_pm = time.match(/[a-zA-Z]{2}$/);
    //Fix am_pm for any changes like lowercase and spaces
    am_pm[0] = am_pm[0].toUpperCase();
    am_pm[0] = am_pm[0].trim();
    var newHour = checkAM_PM(am_pm[0], hour);
    if (newHour.length < 2) {
        newHour = '0' + newHour;
    }
    return newHour + ':' + minute + ':00-06:00';
}

function checkAM_PM(am_pm, hour) {
    var fHour = parseFloat(hour, 10);
    if (am_pm === 'AM' && fHour === 12) {
        fHour -= 12;
    }
    else if (am_pm === 'PM' && fHour < 12) {
        fHour += 12;
    }
    else return fHour.toString();

    return fHour.toString();

}