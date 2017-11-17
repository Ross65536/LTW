document.addEventListener('DOMContentLoaded', function () {
  var boxes = document.querySelectorAll('input[type=checkbox]');
  for (var i = 0; i < boxes.length; i++) {
    boxes[i].addEventListener('change', function() {
      if (this.checked) {
        this.parentElement.style.textDecoration = 'line-through';
      } else {
        this.parentElement.style.textDecoration = '';
      }
    })
  }
})

/**
* If the user trying to edit it the creator of the list it will take him to a new editing page
* No creator users can only add list items
*/
function edit_list() {
  document.querySelector('#new_item').style.display = 'block';
}

function addItem() {
  let item = document.querySelector("#item").value;
  var ul = document.getElementById("items_list");
  var li = document.createElement("li");
  var check = document.createElement("input");
  check.type = 'checkbox';
  li.appendChild(check);
  li.appendChild(document.createTextNode(' ' + item));
  ul.appendChild(li);
  document.querySelector("#item").value = "";
  /* if any chnge was made display the save button */
  document.getElementById('save_button').style.display = 'block';
};
