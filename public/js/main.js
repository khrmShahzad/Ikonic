var skeletonId = 'skeleton';
var contentId = 'content';
var skipCounter = 0;
var takeAmount = 10;


function getRequests(mode) {
  // your code here...

    $("#suggestion_section").hide();
    $("#sent_section").show();
    $("#received_section").hide();
    $("#connection_section").hide();

}

function getReceived(mode) {
    // your code here...

    $("#suggestion_section").hide();
    $("#sent_section").hide();
    $("#received_section").show();
    $("#connection_section").hide();

}

function getMoreRequests(mode) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnections() {
  // your code here...

    $("#suggestion_section").hide();
    $("#sent_section").hide();
    $("#received_section").hide();
    $("#connection_section").show();
}

function getMoreConnections() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnectionsInCommon(userId, connectionId) {
  // your code here...
}

function getMoreConnectionsInCommon(userId, connectionId) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getSuggestions() {
  // your code here...

    $("#suggestion_section").show();
    $("#sent_section").hide();
    $("#received_section").hide();
    $("#connection_section").hide();

    $("#skeleton").hide();
}

function getMoreSuggestions() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function sendRequest(suggestionId) {
  // your code here...

    var form = ajaxForm([
        ['suggestionId', suggestionId],
    ]);

    var functionsOnSuccess = [
        ['exampleOnSuccessFunction', 'x-suggestion'],
    ];

    ajax('userConnection/connectedUser','post', functionsOnSuccess, form);
}

function deleteRequest(requestId) {

    var form = ajaxForm([
        ['requestId', requestId],
    ]);

    var functionsOnSuccess = [
        ['exampleOnSuccessFunction', 'x-request'],
    ];

    ajax('userConnection/deleteRequest','post', functionsOnSuccess, form);
}

function acceptRequest(requestId) {

    var form = ajaxForm([
        ['requestId', requestId],
    ]);

    var functionsOnSuccess = [
        ['exampleOnSuccessFunction', 'x-request'],
    ];

    ajax('userConnection/acceptRequest','post', functionsOnSuccess, form);

}

function removeConnection(connectionId) {


    var form = ajaxForm([
        ['connectionId', connectionId],
    ]);

    var functionsOnSuccess = [
        ['exampleOnSuccessFunction', 'x-connection'],
    ];

    ajax('userConnection/removeConnection','post', functionsOnSuccess, form);
}

$(function () {
  getSuggestions();
});
