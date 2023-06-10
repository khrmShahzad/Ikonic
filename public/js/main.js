var skeletonId = 'skeleton';
var contentId = 'content';
var skipCounter = 0;
var takeAmount = 10;


function getRequests(mode) {
  // your code here...

    var functionsOnSuccess = [
        ['exampleOnSuccessFunction', 'tbl_requests'],
    ];

    ajax('userConnection/getSentRequests','get', functionsOnSuccess);

}

function getReceived(mode) {
    // your code here...

    var functionsOnSuccess = [
        ['exampleOnSuccessFunction', 'tbl_requests'],
    ];

    ajax('userConnection/getReceivedRequests','get', functionsOnSuccess);

}

function getMoreRequests(mode) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnections() {
  // your code here...

    var functionsOnSuccess = [
        ['exampleOnSuccessFunction', 'tbl_connection'],
    ];

    ajax('userConnection/getConnections','get', functionsOnSuccess);
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

 /*   var form = ajaxForm([
        ['exampleVariable', null],
    ]);
*/
    var functionsOnSuccess = [
        ['exampleOnSuccessFunction', 'tbl_suggestion'],
    ];

    ajax('userConnection/getNonConnectedUsers','get', functionsOnSuccess);
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
        ['exampleOnSuccessFunction', ['content','tbl_suggestion']],
    ];

    ajax('userConnection/connectedUser','post', functionsOnSuccess, form);
}

function deleteRequest(requestId) {

    var form = ajaxForm([
        ['requestId', requestId],
    ]);

    var functionsOnSuccess = [
        ['exampleOnSuccessFunction', ['content','tbl_requests']],
    ];

    ajax('userConnection/deleteRequest','post', functionsOnSuccess, form);
}

function acceptRequest(requestId) {

    var form = ajaxForm([
        ['requestId', requestId],
    ]);

    var functionsOnSuccess = [
        ['exampleOnSuccessFunction', ['content','tbl_requests']],
    ];

    ajax('userConnection/acceptRequest','post', functionsOnSuccess, form);

}

function removeConnection(connectionId) {

    var form = ajaxForm([
        ['connectionId', connectionId],
    ]);

    var functionsOnSuccess = [
        ['exampleOnSuccessFunction', ['content','tbl_connection']],
    ];

    ajax('userConnection/removeConnection','post', functionsOnSuccess, form);
}

$(function () {
  // getSuggestions();
});
