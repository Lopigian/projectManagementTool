document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('taskModal');
    const form = document.getElementById('taskForm');
    const modalTitle = document.getElementById('modalTitle');
    const taskIdInput = document.getElementById('taskId');
    const taskNameInput = document.getElementById('taskName');
    const taskProjectIdInput = document.getElementById('taskProjectId');
    const taskStatusInput = document.getElementById('taskStatus');
    const taskDescriptionInput = document.getElementById('taskDescription');
    const modalSubmitButton = document.getElementById('modalSubmit');
    let currentAction = 'add';

    document.getElementById('add-task-btn').addEventListener('click', function () {
        currentAction = 'add';
        modalTitle.textContent = 'Add Task';
        taskIdInput.value = '';
        taskNameInput.value = '';
        taskStatusInput.value = '';
        taskDescriptionInput.value = '';
        showModal();
        loadProjects();
    });

    function openModal(action, id, name, projectId, status, description) {
        if (action === 'edit') {
            loadProjects(projectId);
            currentAction = 'edit';
            modalTitle.textContent = 'Edit Task';
            taskIdInput.value = id;
            taskNameInput.value = name;
            taskProjectIdInput.value = projectId;
            taskStatusInput.value = status;
            taskDescriptionInput.value = description;
        }
        showModal();
    }
    window.openModal = openModal;

    function showModal() {
        modal.style.display = 'block';
    }

    function closeModal() {
        modal.style.display = 'none';
    }

    document.querySelector('.close').addEventListener('click', closeModal);

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const name = taskNameInput.value;
        const projectId = taskProjectIdInput.value;
        const status = taskStatusInput.value;
        const description = taskDescriptionInput.value;
        const id = taskIdInput.value;

        if (currentAction === 'add') {
            addTask(name, projectId, status, description);
        } else if (currentAction === 'edit') {
            updateTask(id, name, projectId, status, description);
        }
    });

    function addTask(name, projectId, status, description) {
        fetch(window.routes.createTask, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ name, projectId, status, description }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const taskBody = document.getElementById('task-body');
                    const row = document.createElement('tr');
                    row.setAttribute('data-id', data.data.id);
                    row.innerHTML = `
                        <td>${data.data.id}</td>
                        <td>${data.data.name}</td>
                        <td>${data.data.project_id}</td>
                        <td>${data.data.description || 'N/A'}</td>
                        <td>${data.data.status}</td>
                        <td>
                            <button onclick="openModal('edit', ${data.data.id}, '${data.data.name}', '${data.data.project_id}', '${data.data.status}', '${data.data.description}'" id="editButton">Edit</button>
                            <button class="delete" onclick="deleteTask(${data.data.id})" id="deleteButton">Delete</button>
                        </td>
                    `;
                    taskBody.appendChild(row);
                    closeModal();
                    window.location.reload();
                } else {
                    showAlertModal(data.message);
                }
            })
            .catch(error => console.error('Error adding task:', error));
    }

    function updateTask(id, name, projectId, status, description) {
        fetch(window.routes.updateTask, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ id, name, projectId, status, description }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const row = document.querySelector(`tr[data-id='${id}']`);
                    row.children[1].textContent = data.data.name;
                    row.children[2].textContent = data.data.projectId;
                    row.children[3].textContent = data.data.status;
                    row.children[4].textContent = data.data.description || 'N/A';
                    closeModal();
                    window.location.reload()
                } else {
                    showAlertModal(data.message);
                }
            })
            .catch(error => console.error('Error updating task:', error));
    }

    window.deleteTask = function (id) {
        showConfirmModal('Are you sure you want to delete this task?', function () {
            fetch(window.routes.deleteTask.replace(':id', id), {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': `Bearer ${token}`,
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const row = document.querySelector(`tr[data-id='${id}']`);
                        row.remove();
                    } else {
                        showAlertModal('Failed to delete task');
                    }
                })
                .catch(error => console.error('Error deleting task:', error));
        });
    };

    // Load all tasks initially
    fetch(window.routes.getAllTasks, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'Authorization': `Bearer ${token}`,
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const taskBody = document.getElementById('task-body');
                data.data.forEach(task => {
                    const row = document.createElement('tr');
                    row.setAttribute('data-id', task.id);
                    row.innerHTML = `
                        <td>${task.id}</td>
                        <td>${task.name}</td>
                        <td>${task.project.name}</td>
                        <td>${task.description || 'N/A'}</td>
                        <td>${task.statusString}</td>
                        <td>
                            <button onclick="openModal('edit', ${task.id}, '${task.name}', ${task.project_id}, ${task.status}, '${task.description}')" id="editButton">Edit</button>
                            <button class="delete" onclick="deleteTask(${task.id})" id="deleteButton">Delete</button>
                        </td>
                    `;
                    taskBody.appendChild(row);
                });
            } else {
                showAlertModal('No tasks have been added yet!');
            }
        })
        .catch(error => console.error('Error loading tasks:', error));

    document.getElementById('closeModal').addEventListener('click', closeAlertModal);

    function showAlertModal(message) {
        const modal = document.getElementById('alertModal');
        const modalBody = document.getElementById('alertModalBody');
        modalBody.textContent = message;
        modal.style.display = 'flex'; // Show the modal
    }

    function closeAlertModal() {
        const modal = document.getElementById('alertModal');
        modal.style.display = 'none'; // Hide the modal
    }


    function showConfirmModal(message, onConfirm) {
        const modal = document.getElementById('confirmModal');
        const modalBody = document.getElementById('confirmModalBody');
        modalBody.textContent = message;
        modal.style.display = 'flex'; // Show the modal

        const yesButton = document.getElementById('confirmYes');
        const noButton = document.getElementById('confirmNo');
        yesButton.onclick = function() {
            onConfirm();
            closeConfirmModal();
        };
        noButton.onclick = closeConfirmModal;
    }

    function closeConfirmModal() {
        const modal = document.getElementById('confirmModal');
        modal.style.display = 'none';
    }

    function loadProjects(projectId = null) {
        const projectSelect = document.getElementById('taskProjectId');
        if (!projectSelect) {
            console.error('Select element not found');
            return;
        }
        fetch(window.routes.getAllProjects, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    data.data.forEach(project => {
                        const option = document.createElement('option');
                        option.value = project.id;
                        option.textContent = project.name;
                        if (projectId !== null && project.id === projectId) {
                            option.selected = true;
                            option.value = projectId;
                        }
                        projectSelect.appendChild(option);
                    });
                } else {
                    console.error('Failed to load projects');
                }
            })
            .catch(error => console.error('Error fetching project data:', error));
    }
});
