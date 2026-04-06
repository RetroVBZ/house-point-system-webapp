const roleRadios = document.querySelectorAll('.role-selection input[name="role"]');
const studentFields = document.querySelector('.student-fields');
const teacherFields = document.querySelector('.teacher-fields');
//login stuff
function toggleRoleFields(role) {
    if (role === 'student') {
        studentFields.classList.add('active');
        teacherFields.classList.remove('active');

        studentFields.querySelectorAll('input').forEach(i => i.disabled = false);
        teacherFields.querySelectorAll('input').forEach(i => i.disabled = true);
    } else {
        studentFields.classList.remove('active');
        teacherFields.classList.add('active');

        studentFields.querySelectorAll('input').forEach(i => i.disabled = true);
        teacherFields.querySelectorAll('input').forEach(i => i.disabled = false);
    }
}

roleRadios.forEach(radio => {
    radio.addEventListener('change', () => toggleRoleFields(radio.value));
});

// Initialize correct fields
document.querySelector('.role-selection input[name="role"]:checked').dispatchEvent(new Event('change'));