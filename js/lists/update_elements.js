
var itemsInDB = [];
var usersInDB = [];

var pageName = (function () {
    var a = window.location.href,
        b = a.lastIndexOf("/");
    a = a.substr(b + 1);
    b = a.lastIndexOf('?');
    return a.substr(0, b);
}());

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
  itemsInDB = [];
    for (var i = 0; i < items.length; i++) {
      var item = items[i].description;
      itemsInDB.push(item);
      //if the item does not exist in the list
      if (allItems.indexOf(item) == -1) {

        allItems.push(item);

        addSingleItem(item);
      }
    }
      try {
        updateBoxes(items);
        toggleLoader(false);
      } catch (e) {

      }

      if (!itemsInDB.sort().compare(allItems.sort()))
        removeExtraItems();
}

function addUsers(users) {
  usersInDB = [];
  for (var i = 0; i < users.length; i++) {
    var username = users[i].username;
    usersInDB.push(username);
    //if the user does not exist in the list
    if (allUsers.indexOf(username) == -1) {
      allUsers.push(username);

      addSingleUser(username);
    }
  }
  try {
    toggleLoader(false);
  } catch (e) {

  }

  if (!usersInDB.sort().compare(allUsers.sort()))
    removeExtraUsers();
}

function removeExtraItems() {
  var itemsSpans = document.querySelectorAll("span.item");
  for (var i = 0; i < itemsSpans.length; i++) {
    if (itemsInDB.indexOf(itemsSpans[i].innerHTML) == -1) {
      removeFromArray(itemsSpans[i].innerHTML, allItems);
      var li = itemsSpans[i].parentElement;
      li.remove();
    }
  }
}

function removeExtraUsers() {
  var usersSpans = document.querySelectorAll("span.username");
  for (var i = 0; i < usersSpans.length; i++) {
    if (usersInDB.indexOf(usersSpans[i].innerHTML) == -1) {
      removeFromArray(usersSpans[i].innerHTML, allUsers);
      var li = usersSpans[i].parentElement;
      li.remove();
    }
  }
}

Array.prototype.compare = function(testArr) {
    if (this.length != testArr.length) return false;
    for (var i = 0; i < testArr.length; i++) {
        if (this[i].compare) { //To test values in nested arrays
            if (!this[i].compare(testArr[i])) return false;
        }
        else if (this[i] !== testArr[i]) return false;
    }
    return true;
}

Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}
