
var pageName = (function () {
    var a = window.location.href,
        b = a.lastIndexOf("/");
    a = a.substr(b + 1);
    b = a.lastIndexOf('?');
    return a.substr(0, b);
}());

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

function updateBoxes(items) {
  for (var i = 0; i < items.length; i++) {
    var name = items[i].description.split(" ").join('_');
    var box = document.querySelector('input[name=' + name + ']');
    if (items[i].done == 0) {
      box.checked = false;
      box.parentElement.style.textDecoration = '';
    }
    else {
      box.checked = true;
      box.parentElement.style.textDecoration = 'line-through';
    }
    if (pageName == 'single_list.php') {
      box.disabled = true;
    }
  }
}

function updateElements() {
   updateItems();
   updateUsers();
   updateArrays();
}

window.setInterval(updateElements, 1000);

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
        check.setAttribute('name', name);
        check.addEventListener('change', function() {
          if (this.checked) {
            this.parentElement.style.textDecoration = 'line-through';
            updateCheckbox(this.name.split('_').join(' '), true);
          } else {
            this.parentElement.style.textDecoration = '';
            updateCheckbox(this.name.split('_').join(' '), false);
          }
        });
        if (pageName == 'single_list.php') {
          check.disabled = true;
        }
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

      updateBoxes(items);
      try {
        toggleLoader(false);
      } catch (e) {

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
  try {
    toggleLoader(false);
  } catch (e) {

  }
}

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}
