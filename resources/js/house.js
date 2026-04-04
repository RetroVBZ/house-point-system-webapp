document.addEventListener('DOMContentLoaded', function() {

    // ===============================
    // Ranking helper function
    // ===============================
    function calculateRanks(items) {
        let lastPoints = null;
        let lastRank = 0;

        return items.map((item, index) => {
            const points = parseInt(item.points) || 0;

            if (points === lastPoints) {
                return { ...item, rank: lastRank, tied: true };
            }

            const rank = index + 1;
            lastPoints = points;
            lastRank = rank;

            return { ...item, rank, tied: false };
        });
    }

    // ===============================
    // Dropdown logic
    // ===============================
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

    // ===============================
    // Student hover effect
    // ===============================
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

    // ===============================
    // Poll house points + rank
    // ===============================
    const pointsH2 = document.querySelector('.points_h2[data-house]');
    const rankEl = document.getElementById('rank'); // optional, can add a rank <h2> in Blade

    if (pointsH2) {
        const houseKey = pointsH2.dataset.house.toLowerCase(); // ensure lowercase

        async function fetchHousePoints() {
            try {
                const res = await fetch('/home/points');
                if (!res.ok) throw new Error('Network error');
                const data = await res.json();

                // Convert backend data into sortable array
                const houses = Object.keys(data).map(key => ({
                    id: key.toLowerCase(),
                    points: data[key].points
                }));

                // Sort descending
                houses.sort((a, b) => b.points - a.points);

                // Apply ranking (with tie logic)
                const ranked = calculateRanks(houses);

                // Find the current house
                const current = ranked.find(h => h.id === houseKey);
                if (!current) return;

                // Update points
                pointsH2.innerText = `Points: ${current.points}`;

                // Update rank if rankEl exists
                if (rankEl) {
                    const suffix =
                        current.rank === 1 ? 'st' :
                        current.rank === 2 ? 'nd' :
                        current.rank === 3 ? 'rd' : 'th';
                    rankEl.innerText = `${current.tied ? '=' : ''}${current.rank}${suffix}`;
                }

            } catch (err) {
                console.error('Error fetching house points:', err);
            }
        }

        // Initial fetch
        fetchHousePoints();

        // Poll every 5 seconds
        setInterval(fetchHousePoints, 5000);
    }

});