// ############################ CLOSE POP IN #################################

const closeButtons = document.querySelectorAll('.closePopIn');

closeButtons.forEach(function (closeButton) {
  closeButton.addEventListener('click', function () {
    const popin = closeButton.closest('section');
    if (popin) {
      popin.style.display = 'none';
    }
  });
});

// ####################################################################################



// ######################### TOGGLE BUTTON CONTAINER ON HOVER #########################

function showButtonContainer(container) {
  const buttonContainer = container.querySelector('.button_container');
  buttonContainer.style.display = 'block';
}

function hideButtonContainer(container) {
  const buttonContainer = container.querySelector('.button_container');
  buttonContainer.style.display = 'none';
}

const taskContainers = document.querySelectorAll('.task_container');

taskContainers.forEach(function (container) {
  container.addEventListener('mouseenter', function () {
    showButtonContainer(this);
  });

  container.addEventListener('mouseleave', function () {
    hideButtonContainer(this);
  });
});

// ##########################################################################



// ########################### TOGGLE EDIT INPUT ###########################

const editIcons = document.querySelectorAll('.edit');


editIcons.forEach(function (editIcon) {
  const taskContainer = editIcon.closest('.task_container');
  const editContainer = taskContainer.querySelector('.edit_container');

  editIcon.addEventListener('click', function () {
    if (editContainer.style.display === 'flex') {
      editContainer.style.display = 'none';
    } else {
      editContainer.style.display = 'flex';
    }
  });
});

// ########################### TOGGLE CALENDAR INPUT ###########################

const reminderIcons = document.querySelectorAll('.reminder');

reminderIcons.forEach(function (reminderIcon) {
  const taskContainer = reminderIcon.closest('.task_container');
  const reminderContainer = taskContainer.querySelector('.reminder_container');

  reminderIcon.addEventListener('click', function () {
    if (reminderContainer.style.display === 'flex') {
      reminderContainer.style.display = 'none';
    } else {
      reminderContainer.style.display = 'flex';
    }
  });
});




// ########################### ASYNCH ###########################

function getCsrfToken() {
  return document.querySelector('#token-csrf').value;
}

function doEditTask(idTask, desc) {
  document.querySelector(`[data-desc-id="${idTask}"]`).innerText = desc;
}

function editTask(idTask, desc) {
  const data = {
    action: "edit",
    idTask: idTask,
    token: getCsrfToken(),
    desc: desc
  };
  return callAPI('PUT', data)
}

async function callAPI(method, data) {
  try {
    const response = await fetch("api.php", {
      method: method,
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    });

    return response.json();
  }
  catch (error) {
    console.error("Unable to load datas from the server : " + error);
  }
}



// ########################### ASYNCH EDIT  ###########################
const submitEdit = document.querySelectorAll('.edit_container');


submitEdit.forEach((form) => {
  form.addEventListener('submit', e => {
    e.preventDefault()
    const editValue = e.target.querySelector('.input_field').value;
    editTask(e.target.dataset.id, editValue).then(apiResponse => {
      if (apiResponse.result) {
        doEditTask(apiResponse.idTask, apiResponse.desc);
        e.target.closest('form').style.display = 'none';
      }
      else {
        console.error('Problème avec la requête.');
        return;
      };      
    });
  })
})

