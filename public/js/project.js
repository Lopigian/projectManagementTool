document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('projectModal');
    const form = document.getElementById('projectForm');
    const modalTitle = document.getElementById('modalTitle');
    const projectIdInput = document.getElementById('projectId');
    const projectNameInput = document.getElementById('projectName');
    const projectDescriptionInput = document.getElementById('projectDescription');
    const modalSubmitButton = document.getElementById('modalSubmit');
    let currentAction = 'add';

    document.getElementById('add-project-btn').addEventListener('click', function () {
        currentAction = 'add';
        modalTitle.textContent = 'Add Project';
        projectIdInput.value = '';
        projectNameInput.value = '';
        projectDescriptionInput.value = '';
        showModal();
    });

    function openModal(action, id, name, description) {
        if (action === 'edit') {
            currentAction = 'edit';
            modalTitle.textContent = 'Edit Project';
            projectIdInput.value = id;
            projectNameInput.value = name;
            projectDescriptionInput.value = description;
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
        const name = projectNameInput.value;
        const description = projectDescriptionInput.value;
        const id = projectIdInput.value;

        if (currentAction === 'add') {
            addProject(name, description);
        } else if (currentAction === 'edit') {
            updateProject(id, name, description);
        }
    });

    function addProject(name, description) {
        fetch(window.routes.createProject, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ name, description }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const projectBody = document.getElementById('project-body');
                    const row = document.createElement('tr');
                    row.setAttribute('data-id', data.data.id);
                    row.innerHTML = `
                        <td>${data.data.id}</td>
                        <td>${data.data.name}</td>
                        <td>${data.data.description || 'N/A'}</td>
                        <td>
                            <button onclick="openModal('edit', ${data.data.id}, '${data.data.name}', '${data.data.description}')" id="editButton">Edit</button>
                            <button class="delete" onclick="deleteProject(${data.data.id})" id="deleteButton">Delete</button>
                        </td>
                    `;
                    projectBody.appendChild(row);
                    closeModal();
                    window.location.reload();
                } else {
                    showAlertModal('Failed to add project');
                }
            })
            .catch(error => console.error('Error adding project:', error));
    }

    function updateProject(id, name, description) {
        fetch(window.routes.updateProject, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`,
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ id, name, description }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const row = document.querySelector(`tr[data-id='${id}']`);
                    row.children[1].textContent = data.data.name;
                    row.children[2].textContent = data.data.description || 'N/A';
                    closeModal();
                    window.location.reload()
                } else {
                    showAlertModal(data.message);
                }
            })
            .catch(error => console.error('Error updating project:', error));
    }

    window.deleteProject = function (id) {
        showConfirmModal('Are you sure you want to delete this project?', function () {
            fetch(window.routes.deleteProject.replace(':id', id), {
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
                        showAlertModal('Failed to delete project');
                    }
                })
                .catch(error => console.error('Error deleting project:', error));
        });
    };

    // Load all projects initially
    fetch(window.routes.getAllProjects, {
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
                const projectBody = document.getElementById('project-body');
                data.data.forEach(project => {
                    const row = document.createElement('tr');
                    row.setAttribute('data-id', project.id);
                    row.innerHTML = `
                        <td>${project.id}</td>
                        <td>${project.name}</td>
                        <td>${project.description || 'N/A'}</td>
                        <td>
                            <button onclick="openModal('edit', ${project.id}, '${project.name}', '${project.description}')" id="editButton">Edit</button>
                            <button class="delete" onclick="deleteProject(${project.id})" id="deleteButton">Delete</button>
                        </td>
                    `;
                    projectBody.appendChild(row);
                });
            } else {
                showAlertModal('Failed to load project');
            }
        })
        .catch(error => console.error('Error loading projects:', error));

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
});
