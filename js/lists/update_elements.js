
var allItems = [];
var allUsers = [];
/* Initialize the items and users arrays */
document.addEventListener("DOMContentLoaded", function() {
  updateArrays();
});

function updateArrays() {
  var itemsSpans = document.querySelectorAll("span.item");
  for (var i = 0; i < itemsSpans.length; i++) {
    if (allItems.indexOf(itemsSpans[i].innerHTML) == -1)
      allItems.push(itemsSpans[i].innerHTML);
  }

  var usersSpans = document.querySelectorAll("span.username");

  for (var i = 0; i < usersSpans.length; i++) {
    if (allItems.indexOf(usersSpans[i].innerHTML) == -1)
      allUsers.push(usersSpans[i].innerHTML);
  }
}

function updateElements() {
   updateItems();
   updateUsers();
   updateArrays();
}

window.setInterval(updateElements, 2000);

function updateItems() {
  let requestItems = new XMLHttpRequest();
  requestItems.open('get', 'PHP/actions/lists/ajax_list_update.php?' + encodeForAjax({'function' : 'updateListItems', 'id' : document.querySelector("input[name=id]").getAttribute('value')}), true);
  requestItems.onreadystatechange = function (aEvt) {
  if (requestItems.readyState == 4) {
     if(requestItems.status == 200) {
      var items = JSON.parse(requestItems.responseText)  ;
      addItems(items);
     }
     else
      console.error("Error");
  }
};
  requestItems.send();
}

function updateUsers() {
  let requestUsers = new XMLHttpRequest();
  requestUsers.open('get', 'PHP/actions/lists/ajax_list_update.php?' + encodeForAjax({'function' : 'updateListUsers', 'id' : document.querySelector("input[name=id]").getAttribute('value')}), true);
  requestUsers.onreadystatechange = function (aEvt) {
  if (requestUsers.readyState == 4) {
     if(requestUsers.status == 200){
      var users = JSON.parse(requestUsers.responseText) ;
      addUsers(users);
    }
     else
      console.error('Could not get items');
  }
};
  requestUsers.send();
}

function addItems(items) {
  var itemsInDB = [];
    for (var i = 0; i < items.length; i++) {
      var item = items[i].description;
      itemsInDB.push(item);
      //if the item does not exist in the list
      if (allItems.indexOf(item) == -1) {

        allItems.push(item);

        let name = item.split(' ').join('_');
        var ul = document.getElementById("items_list");
        var li = document.createElement("li");
        var input = document.createElement("input");
        var span = document.createElement('span');
        span.className = 'item';
        input.type = 'hidden';
        input.value = name;
        input.setAttribute('name', 'items[]');
        var check = document.createElement("input");
        check.type = 'checkbox';
        check.setAttribute('name', item);
        li.appendChild(check);
        li.appendChild(span);
        span.appendChild(document.createTextNode(item));
        li.appendChild(input);
        try {
          let deleteButton = createDeleteButton();
          li.appendChild(deleteButton);
        } catch (e) {

        }
        ul.appendChild(li);
        verifyFieldsFull();
      }
    }
}

function addUsers(users) {
  for (var i = 0; i < users.length; i++) {
    var username = users[i].username;
    //if the item does not exist in the list
    if (allUsers.indexOf(username) == -1) {
      allUsers.push(username);

      var ul = document.getElementById("users_list");
      var li = document.createElement("li");
      var input = document.createElement("input");
      input.type = 'hidden';
      input.value = username;
      var span = document.createElement('span');
      span.className = "username";
      input.setAttribute('name', 'users[]');
      li.appendChild(span);
      span.appendChild(document.createTextNode(username));
      li.appendChild(input);
      try {
        let deleteButton = createDeleteButton();
        li.appendChild(deleteButton);
      } catch (e) {

      }
      ul.appendChild(li);
    }
  }
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}
