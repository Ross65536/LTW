var TYPE = "";
var ID = -1;

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
    if (allUsers.indexOf(usersSpans[i].innerHTML) == -1)
      allUsers.push(usersSpans[i].innerHTML);
  }
}

function createDeleteButton() {
  var deleteButton = document.createElement("button");
  deleteButton.type = "button";
  deleteButton.className = "delete-button";
  deleteButton.appendChild(document.createTextNode('X'));
  deleteButton.addEventListener('click', function() {
    var choice = confirm('Confirm your intention to delete?');
    if (choice) {
        if (this.parentNode.parentNode.getAttribute("id") == 'items_list') {
          removeItem(this.parentNode.querySelector("span.item").innerHTML);
        } else if (this.parentNode.parentNode.getAttribute("id") == 'users_list') {
          removeUser(this.parentNode.querySelector("span.username").innerHTML);
        }
        this.parentNode.parentNode.removeChild(this.parentNode);
    }
  });
  return deleteButton;
}

function toggleLoader(status) {
  if (status) {
    document.querySelector('.edit-form').style.opacity = 0.7;
    document.querySelector('.loader').style.display = "inline";
  } else {
    document.querySelector('.edit-form').style.opacity = 1;
    document.querySelector('.loader').style.display = "none";
  }
}

/* Requests user information from the database */
function addUser() {
  var type = document.querySelector("input[name=type]").getAttribute("value");
  let id = type == 'create' ? -1 : document.querySelector("input[name=id]").getAttribute("value");

  try {
    toggleLoader(true);
  } catch (e) {

  }
  let request = new XMLHttpRequest();
  request.open('get', 'PHP/actions/lists/ajax_list_edit.php?' + encodeForAjax({'function' : 'validUser',
   'username' : document.querySelector("#user").value,
   'id' : id}), true);
  request.addEventListener('load', validUser);
  request.send();
}

/**
* If the username exists and is not the creator it is added
*/
function validUser() {

  let user = document.querySelector("#user").value;

  let index = allUsers.indexOf(user);

  if (this.responseText == -3 || index != -1) {
    alert("[ERROR] That user is already on that list.");
  } else {
    if (this.responseText == 0) {
      document.querySelector("#user").value = "";
      if (TYPE == 'create')
        addSingleUser(user);
    } else if (this.responseText == -1) {
      alert('[ERROR] You cannot add yourself.');
    } else if (this.responseText == -2){
      alert('[ERROR] That username does not exist.');
    }
  }
  updateArrays();
  toggleLoader(false);
};


function addItem() {
  try {
    toggleLoader(true);
  } catch (e) {}

  let item = document.querySelector("#item").value;

  if (item.length < 1) {
    alert('[ERROR] Cannot add empty item to list.');
    toggleLoader(false)
    return;
  }

  let request = new XMLHttpRequest();
  request.open('get', 'PHP/actions/lists/ajax_list_edit.php?' + encodeForAjax({'function' : 'distinctItem',
   'id' : ID,
   'description' : item}), true);
  request.addEventListener('load', validItem);
  request.send();
}

function validItem() {
  let item = document.querySelector("#item").value;

  let index = allItems.indexOf(item);

  if (this.responseText == -1 || index != -1) {
    alert('[ERROR] That item is already on this list.');
  } else if (this.responseText == 0) {
    document.querySelector("#item").value = "";
    if (TYPE == 'create')
      addSingleItem(item);
  } else {
    alert("Oops, something went wrong.");
  }
  updateArrays();
  toggleLoader(false);
};

function addSingleItem(item) {

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
  if (TYPE != 'create' && TYPE != 'edit') {
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
}

function addSingleUser(username) {
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

function removeItem(description) {
  if (TYPE != 'create') {
    let request = new XMLHttpRequest();
    request.open('get', 'PHP/actions/lists/ajax_list_edit.php?' + encodeForAjax({'function' : 'removeItem',
     'description' : description,
     'id' : ID}), true);
    request.send();
  }
    removeFromArray(description, allItems);
}

function removeUser(username) {
  if (TYPE != 'create') {
    let request = new XMLHttpRequest();
    request.open('get', 'PHP/actions/lists/ajax_list_edit.php?' + encodeForAjax({'function' : 'removeUser',
     'username' : username,
     'id' : ID}), true);
    request.send();
  }
    removeFromArray(username, allUsers);
}

function removeFromArray(item, array) {
  var index = array.indexOf(item);
  array.splice(index, 1);
}


function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}
