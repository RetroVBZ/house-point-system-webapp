// Custom dropdown with smooth animation
document.addEventListener('DOMContentLoaded', function() {
    console.log('JavaScript loaded'); // Debug: Check if JS is loading
    
    const dropdownBtn = document.getElementById('dropdownBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const dropdownArrow = document.getElementById('dropdownArrow');
    const gradeLevelInput = document.getElementById('grade_level');
    const filterForm = document.getElementById('gradeFilterForm');
    const selectedText = document.getElementById('selectedText');
    
    // Debug: Log if elements are found
    console.log('Dropdown button:', dropdownBtn);
    console.log('Dropdown menu:', dropdownMenu);
    console.log('Selected text:', selectedText);
    
    // Check if elements exist before adding event listeners
    if (dropdownBtn && dropdownMenu && dropdownArrow && gradeLevelInput && filterForm && selectedText) {
        // Toggle dropdown on button click
        dropdownBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
            dropdownArrow.classList.toggle('open');
            console.log('Dropdown toggled'); // Debug
        });
        
        // Handle option selection
        const options = dropdownMenu.querySelectorAll('a');
        console.log('Options found:', options.length); // Debug
        
        options.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                const value = this.getAttribute('data-value');
                const text = this.textContent;
                
                console.log('Selected:', value, text); // Debug
                
                // Update selected text
                selectedText.textContent = text;
                
                // Update hidden input and submit form
                gradeLevelInput.value = value;
                filterForm.submit();
                
                // Close dropdown
                dropdownMenu.classList.remove('show');
                dropdownArrow.classList.remove('open');
            });
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.custom-dropdown')) {
                dropdownMenu.classList.remove('show');
                dropdownArrow.classList.remove('open');
            }
        });
        
        // Prevent menu from closing when clicking inside it
        dropdownMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    } else {
        console.error('One or more dropdown elements not found!');
    }
    
    // Student name hover effect - other items move away
    const studentNames = document.querySelectorAll('.student-name');
    console.log('Student names found:', studentNames.length); // Debug
    
    studentNames.forEach(name => {
        const currentItem = name.closest('.student-item');
        const allItems = document.querySelectorAll('.student-item');
        
        name.addEventListener('mouseenter', function() {
            // Enlarge the current name
            this.style.transform = 'scale(1.2)';
            this.style.transition = 'transform 0.3s ease';
            this.style.display = 'inline-block';
            
            // Move other items away
            allItems.forEach(item => {
                if (item !== currentItem) {
                    item.style.opacity = '0.5';
                    item.style.transform = 'translateX(20px)';
                    item.style.transition = 'all 0.3s ease';
                }
            });
        });
        
        name.addEventListener('mouseleave', function() {
            // Reset current name
            this.style.transform = '';
            
            // Reset all other items
            allItems.forEach(item => {
                item.style.opacity = '';
                item.style.transform = '';
            });
        });
    });
});