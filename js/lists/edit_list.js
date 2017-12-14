
document.addEventListener('DOMContentLoaded', function() {

  /* Determine wether the page is creator or edit */
  TYPE = document.querySelector("input[name=type]").getAttribute("value");
  ID = TYPE == 'create' ? -1 : document.querySelector("input[name=id]").getAttribute("value");

  let buttons = document.querySelectorAll('button.delete');
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

  document.querySelector('input[type=submit]').addEventListener('click', function(e) {
      e.preventDefault();
      deactivateErrors();
      verifyFieldsFull();
  });
});

function verifyFieldsFull() {
  var valid = true;

  if (TYPE == 'create')
    if (document.querySelector('input[name=name]').value.length < 4) {
      document.getElementById("short_title").classList.remove('hidden');
      errors.push("short_title");
      valid = false;
    }
  if (document.getElementById('items_list').getElementsByTagName('li').length == 0) {
    document.getElementById("empty_list").classList.remove('hidden');
    errors.push("empty_list");
    valid = false;
  }

  if (!document.querySelector('input[type=file]').value.match(/[^/]+(jpg)$/) &&
    document.querySelector('input[type=file]').value != "") {
    document.getElementById("photo_extension").classList.remove('hidden');
    errors.push("photo_extension");
    valid = false;
  }

  if (valid)
    document.querySelector('form.edit-form').submit();

}

function updateCheckbox(description, value) {
  if (TYPE == 'edit') {
    let request = new XMLHttpRequest();
    request.open('get', 'PHP/actions/lists/ajax_list_edit.php?' + encodeForAjax({'function' : 'updateDone',
     'description' : description,
     'value' : value,
     'id' : ID}), true);
    request.addEventListener('load', updateItems);
    request.send();
  }
}
