<?php include 'header.php'; ?>

<div class="container mt-5">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">User Management</h3>
    </div>

    <!-- Card/Table -->
    <div class="card border-0 shadow-lg rounded-4">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-secondary text-uppercase small">
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subjects</th>
                            <th>Gender</th>
                            <th>Country</th>
                            <th>Created</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <!-- Skeleton Loading Rows -->
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <tr class="skeleton-row">
                                <td>
                                    <div class="bg-secondary rounded-circle skeleton-circle"></div>
                                </td>
                                <td>
                                    <div class="bg-secondary skeleton-text"></div>
                                </td>
                                <td>
                                    <div class="bg-secondary skeleton-text"></div>
                                </td>
                                <td>
                                    <div class="bg-secondary skeleton-text"></div>
                                </td>
                                <td>
                                    <div class="bg-secondary skeleton-text"></div>
                                </td>
                                <td>
                                    <div class="bg-secondary skeleton-text"></div>
                                </td>
                                <td>
                                    <div class="bg-secondary skeleton-text"></div>
                                </td>
                                <td class="text-center">
                                    <div class="bg-secondary skeleton-button d-inline-block"></div>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>

                    <tbody>
                        <?php
                        include 'connect.php';

                        $sql = "SELECT * FROM users ORDER BY created_at DESC";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $subjects = explode(',', $row['subject']); // split subjects
                                ?>
                                <tr>
                                    <td>
                                        <?php if ($row['profile_image']): ?>
                                            <img src="uploads/<?= htmlspecialchars($row['profile_image']) ?>" width="45" height="45"
                                                class="rounded-circle object-fit-cover" alt="Profile">
                                        <?php else: ?>
                                            <div class="bg-secondary rounded-circle d-inline-block"
                                                style="width:45px; height:45px;"></div>
                                        <?php endif; ?>
                                    </td>

                                    <td class="fw-semibold"><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>

                                    <td>
                                        <?php foreach ($subjects as $subj): ?>
                                            <span class="badge bg-primary me-1"><?= htmlspecialchars($subj) ?></span>
                                        <?php endforeach; ?>
                                    </td>

                                    <td><?= htmlspecialchars($row['gender']) ?></td>
                                    <td><?= htmlspecialchars($row['country']) ?></td>
                                    <td><?= date('d M Y', strtotime($row['created_at'])) ?></td>

                                    <td class="text-center">
                                        <a href="update.php?id=<?= $row['id'] ?>"
                                            class="btn btn-sm btn-outline-warning rounded-pill me-1">
                                            Edit
                                        </a>
                                        <button class="btn btn-sm btn-outline-danger rounded-pill delete-btn"
                                            data-id="<?= $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    No users found.
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- DELETE CONFIRM MODAL -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header bg-danger text-white rounded-top-4">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <p class="mb-0 fs-5">
                    Are you sure you want to delete this user?
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                    Cancel
                </button>
                <a id="confirmDeleteBtn" class="btn btn-danger rounded-pill px-4">
                    Yes, Delete
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Delete button logic
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.getElementById('confirmDeleteBtn').href =
                'delete.php?id=' + this.dataset.id;
        });
    });
</script>

<?php include 'footer.php'; ?>