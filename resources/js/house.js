// Even more annoying code

document.addEventListener('DOMContentLoaded', function() {

    // Dropdown logic
    const dropdownBtn = document.getElementById('dropdownBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const dropdownArrow = document.getElementById('dropdownArrow');
    const gradeLevelInput = document.getElementById('grade_level');
    const filterForm = document.getElementById('gradeFilterForm');
    const selectedText = document.getElementById('selectedText');

    if (dropdownBtn && dropdownMenu && dropdownArrow && gradeLevelInput && filterForm && selectedText) {
        dropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
            dropdownArrow.classList.toggle('open');
        });

        dropdownMenu.querySelectorAll('a').forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                const value = this.getAttribute('data-value');
                selectedText.textContent = this.textContent;
                gradeLevelInput.value = value;
                filterForm.submit();
                dropdownMenu.classList.remove('show');
                dropdownArrow.classList.remove('open');
            });
        });

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.custom-dropdown')) {
                dropdownMenu.classList.remove('show');
                dropdownArrow.classList.remove('open');
            }
        });

        dropdownMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }

    // Student hover effect
    const studentNames = document.querySelectorAll('.student-name');
    studentNames.forEach(name => {
        const currentItem = name.closest('.student-item');
        const allItems = document.querySelectorAll('.student-item');

        name.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.2)';
            this.style.transition = 'transform 0.3s ease';
            this.style.display = 'inline-block';

            allItems.forEach(item => {
                if (item !== currentItem) {
                    item.style.opacity = '0.5';
                    item.style.transform = 'translateX(20px)';
                    item.style.transition = 'all 0.3s ease';
                }
            });
        });

        name.addEventListener('mouseleave', function() {
            this.style.transform = '';
            allItems.forEach(item => {
                item.style.opacity = '';
                item.style.transform = '';
            });
        });
    });

    // Polling house points
    const pointsH2 = document.querySelector('.points_h2[data-house]');
    if (pointsH2) {
        const houseKey = pointsH2.dataset.house; // Now defined safely

        function fetchHousePoints() {
            fetch('/home/points')
                .then(res => res.json())
                .then(data => {
                    if (data[houseKey]) {
                        pointsH2.innerText = `Points: ${data[houseKey].points}`;
                    }
                })
                .catch(err => console.error('Error fetching house points:', err));
        }

        // Initial fetch
        fetchHousePoints();

        // Poll every 5 seconds
        setInterval(fetchHousePoints, 5000);
    }
});