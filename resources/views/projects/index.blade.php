@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header-information">
        <h1>Project Management</h1>
        <button id="add-project-btn">Add Project</button>
    </div>
    <table id="project-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="project-body">

        </tbody>
    </table>
</div>

<!-- Modal HTML -->
<div id="projectModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle">Add Project</h2>
        <form id="projectForm">
            <input type="hidden" id="projectId" name="id">
            <label for="projectName">Name:</label>
            <input type="text" id="projectName" name="name" required>
            <label for="projectDescription">Description:</label>
            <textarea type="text" id="projectDescription" name="description"></textarea>
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
