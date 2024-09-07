@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header-information">
        <h1>Task Management</h1>
        <button id="add-task-btn">Add Task</button>
    </div>
    <table id="task-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Project</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="task-body">

        </tbody>
    </table>
</div>

<!-- Modal HTML -->
<div id="taskModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle">Add Task</h2>
        <form id="taskForm">
            <input type="hidden" id="taskId" name="id">
            <label for="taskName">Name:</label>
            <input type="text" id="taskName" name="name" required>
            <label for="projectSelect">Select Project:</label>
            <select id="taskProjectId" name="project_id" required>
                <option value="">-- Select a Project --</option>
            </select>
            <label for="projectStatusSelect">Select Project Status:</label>
                <select id="taskStatus" name="status" required>
                    <option value="">-- Select a Project Status --</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->value }}">{{ $status->name }}</option>
                    @endforeach
                </select>
            <label for="taskDescription">Description:</label>
            <textarea type="text" id="taskDescription" name="description"></textarea>
            <button type="submit" id="modalSubmit">Save</button>
        </form>
    </div>
</div>


<!-- Simple Alert Modal -->
<div id="alertModal">
    <div class="alertModal">
        <h2>Alert</h2>
        <p id="alertModalBody"></p>
        <button id="closeModal">Close</button>
    </div>
</div>


<!-- Confirm Modal -->
<div id="confirmModal">
    <div class="confirmModal">
        <h2>Confirmation</h2>
        <p id="confirmModalBody"></p>
        <button id="confirmYes">Yes</button>
        <button id="confirmNo">No</button>
    </div>
</div>
@endsection
