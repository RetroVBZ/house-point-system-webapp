function openModal(houseID, action) {
    const modal = document.getElementById('pointModal');
    modal.style.display = 'flex';

    document.getElementById('modalHouseID').value = houseID;
    document.getElementById('modalAction').value = action;

    document.getElementById('modalTitle').innerText =
        action === 'add' ? 'Add Points' : 'Remove Points';
}

function closeModal() {
    document.getElementById('pointModal').style.display = 'none';
}

// close when clicking outside
window.onclick = function(e) {
    const modal = document.getElementById('pointModal');
    if (e.target === modal) {
        closeModal();
    }
}

// expose globally for inline onclick
window.openModal = openModal;
window.closeModal = closeModal;