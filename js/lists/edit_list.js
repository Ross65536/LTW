document.addEventListener('DOMContentLoaded', function() {
  let buttons = document.querySelectorAll('.delete-button');
  for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', function() {
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
  }

  var boxes = document.querySelectorAll('input[type=checkbox]');
  for (var i = 0; i < boxes.length; i++) {
    boxes[i].addEventListener('change', function() {
      if (this.checked) {
        this.parentElement.style.textDecoration = 'line-through';
        updateCheckbox(this.name.split('_').join(' '), true);
      } else {
        this.parentElement.style.textDecoration = '';
        updateCheckbox(this.name.split('_').join(' '), false);
      }
    });
    if (boxes[i].checked) {
      boxes[i].parentElement.style.textDecoration = 'line-through';
    }
  }
verifyFieldsFull();
});

function verifyFieldsFull() {
  if (document.getElementById('items_list').getElementsByTagName('li').length > 0) {
    document.querySelector('input[type=submit]').style.display = 'block';
  } else {
    document.querySelector('input[type=submit]').style.display = 'none';
  }
}

function updateCheckbox(description, value) {
  let request = new XMLHttpRequest();
  request.open('get', 'PHP/actions/lists/ajax_list_edit.php?' + encodeForAjax({'function' : 'updateDone',
   'description' : description,
   'value' : value,
   'id' : document.querySelector("input[name=id]").getAttribute("value")}), true);
  request.addEventListener('load', updateItems);
  request.send();
}

function addUser() {

  try {
    toggleLoader(true);
  } catch (e) {

  }
  let request = new XMLHttpRequest();
  request.open('get', 'PHP/actions/lists/ajax_list_edit.php?' + encodeForAjax({'function' : 'validUser',
   'username' : document.querySelector("#user").value,
   'id' : document.querySelector("input[name=id]").getAttribute("value")}), true);
  request.addEventListener('load', validUser);
  request.send();
}

function removeItem(description) {
  let request = new XMLHttpRequest();
  request.open('get', 'PHP/actions/lists/ajax_list_edit.php?' + encodeForAjax({'function' : 'removeItem',
   'description' : description,
   'id' : document.querySelector("input[name=id]").getAttribute("value")}), true);
  request.send();
}

function removeUser(username) {
  let request = new XMLHttpRequest();
  request.open('get', 'PHP/actions/lists/ajax_list_edit.php?' + encodeForAjax({'function' : 'removeUser',
   'username' : username,
   'id' : document.querySelector("input[name=id]").getAttribute("value")}), true);
  request.send();
}

function addItem() {
  try {
    toggleLoader(true);
  } catch (e) {

  }
  let item = document.querySelector("#item").value;

  if (item.length < 1) {
    alert('[ERROR] Cannot add empty item to list.'); return;
  }

  let request = new XMLHttpRequest();
  request.open('get', 'PHP/actions/lists/ajax_list_edit.php?' + encodeForAjax({'function' : 'distinctItem',
   'id' : document.querySelector("input[name=id]").getAttribute('value'),
   'description' : item}), true);
  request.addEventListener('load', validItem);
  request.send();
}

function validItem() {

  let item = document.querySelector("#item").value;
  if (this.responseText == -1) {
    alert('[ERROR] That item is already on this list.');
  } else if (this.responseText == 0) {
    document.querySelector("#item").value = "";
    verifyFieldsFull();
  } else {
    alert("Oops, something went wrong.");
  }
};

/**
* If the username exists and is not the creator it is added
*/
function validUser() {

  let user = document.querySelector("#user").value;
  if (this.responseText == -3) {
    alert("[ERROR] That user is already on that list.");
  } else {
    if (this.responseText == 0) {
      document.querySelector("#user").value = "";
    } else if (this.responseText == -1) {
      alert('[ERROR] You cannot add yourself.');
    } else if (this.responseText == -2){
      alert('[ERROR] That username does not exist.');
    }
  }
};

function encodeForAjax(data) {
  return Object.keys(data).map(function(k){
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
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
