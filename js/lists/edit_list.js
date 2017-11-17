document.addEventListener('DOMContentLoaded', function() {
  let buttons = document.querySelectorAll('.delete-button');
  for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', function() {
      var choice = confirm('Confirm your intention to delete?');
      if (choice) {
        this.parentNode.parentNode.removeChild(this.parentNode);
      }
    });
  }

  var boxes = document.querySelectorAll('input[type=checkbox]');
  for (var i = 0; i < boxes.length; i++) {
    boxes[i].addEventListener('change', function() {
      if (this.checked) {
        this.parentElement.style.textDecoration = 'line-through';
      } else {
        this.parentElement.style.textDecoration = '';
      }
    });
    if (boxes[i].checked) {
      boxes[i].parentElement.style.textDecoration = 'line-through';
    }
  }

  document.querySelector('input[name=name]').addEventListener('input', function(){
    verifyFieldsFull();
  });
});

function deleteList() {
  let choice = confirm('Are you sure you want to proceed?');
  if (choice) {
    let request = new XMLHttpRequest();
    //TODO
  }
}

function verifyFieldsFull() {
  if (document.querySelector('input[name=name]').value.length > 4
  && document.getElementById('items_list').getElementsByTagName('li').length > 0) {
    document.querySelector('input[type=submit]').style.display = 'block';
  } else {
    document.querySelector('input[type=submit]').style.display = 'none';
  }
}

function addUser() {
  let request = new XMLHttpRequest();
  request.open('get', 'ajax_calls.php?' + encodeForAjax({'function' : 'validUser', 'username' : document.querySelector("#user").value}), true);
  request.addEventListener('load', validUser);
  request.send();
}

function addItem() {
  let item = document.querySelector("#item").value;
  let name = item.split(' ').join('_');
  console.log('item ' + item);
  console.log('name ' + name);
  if (item.length < 1) {
    alert('[ERROR] Cannot add empty item to list.');
  } else {
    var ul = document.getElementById("items_list");
    var li = document.createElement("li");
    var input = document.createElement("input");
    input.type = 'hidden';
    input.value = name;
    input.setAttribute('name', 'items[]');
    var check = document.createElement("input");
    check.type = 'checkbox';
    check.setAttribute('name', item);
    let deleteButton = createDeleteButton();
    li.appendChild(check);
    li.appendChild(document.createTextNode(' ' + item));
    li.appendChild(input);
    li.appendChild(deleteButton);
    ul.appendChild(li);
    document.querySelector("#item").value = "";
    verifyFieldsFull();
  }
};

/**
* If the username exists and is not the creator it is added
*/
function validUser() {
  if (this.responseText == 0) {
    let user = document.querySelector("#user").value;
    var ul = document.getElementById("users_list");
    var li = document.createElement("li");
    var input = document.createElement("input");
    input.type = 'hidden';
    input.value = user;
    input.setAttribute('name', 'users[]');
    let deleteButton = createDeleteButton();
    li.appendChild(document.createTextNode(user));
    li.appendChild(input);
    li.appendChild(deleteButton);
    ul.appendChild(li);
    document.querySelector("#user").value = "";
  } else if (this.responseText == -1) {
    alert('[ERROR] You cannot add yourself.');
  } else if (this.responseText == -2){
    alert('[ERROR] That username does not exist.');
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
      this.parentNode.parentNode.removeChild(this.parentNode);
      verifyFieldsFull();
    }
  });
  return deleteButton;
}
