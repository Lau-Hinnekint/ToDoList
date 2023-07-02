// ############################ CLOSE POP IN #################################

const closeButtons = document.querySelectorAll('.closePopIn');

closeButtons.forEach(function(closeButton) {
  closeButton.addEventListener('click', function() {
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



// ########################### TOGGLE MODIFY INPUT ###########################

const modifyIcons = document.querySelectorAll('.modify');


modifyIcons.forEach(function (modifyIcon) {
  const taskContainer = modifyIcon.closest('.task_container');
  const modifyContainer = taskContainer.querySelector('.modify_container');

  modifyIcon.addEventListener('click', function () {
    if (modifyContainer.style.display === 'flex') {
      modifyContainer.style.display = 'none';
    } else {
      modifyContainer.style.display = 'flex';
    }
  });
});

// ########################### TOGGLE CALENDAR INPUT ###########################

const reminderIcons = document.querySelectorAll('.reminder');
console.log(reminderIcons);

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