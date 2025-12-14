// ----------------- Bootstrap Tooltips -----------------
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

// ----------------- Skeleton Loader (optional) -----------------
document.addEventListener('DOMContentLoaded', function() {
    // Skeleton rows fade out once table is loaded (server-side PHP already renders table)
    const skeletonRows = document.querySelectorAll('.skeleton-row');
    if (skeletonRows.length) {
        setTimeout(() => {
            skeletonRows.forEach(row => row.remove());
        }, 500); // Adjust delay if needed
    }
});

// ----------------- Delete Confirmation -----------------
document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.dataset.id;
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        confirmBtn.href = 'delete.php?id=' + id;
    });
});

// ----------------- Optional: Any other global JS -----------------
// e.g., form validation, dynamic elements, etc.
