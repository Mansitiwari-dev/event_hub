// public/js/dashboard.js
document.addEventListener('DOMContentLoaded', function() {
    // Toggle sidebar
    const sidebarCollapse = document.getElementById('sidebarCollapse');
    if (sidebarCollapse) {
        sidebarCollapse.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.querySelector('.content-wrapper').classList.toggle('active');
        });
    }

    // Add active class to current nav item
    const currentLocation = location.href;
    const menuItems = document.querySelectorAll('.sidebar a');
    const menuLength = menuItems.length;
    
    for (let i = 0; i < menuLength; i++) {
        if (menuItems[i].href === currentLocation) {
            menuItems[i].classList.add('active');
            
            // If it's a dropdown item, also add active class to parent
            const parent = menuItems[i].parentElement;
            if (parent.classList.contains('dropdown-item')) {
                parent.closest('.dropdown-menu').previousElementSibling.classList.add('active');
                parent.closest('.collapse').classList.add('show');
            }
        }
    }

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });

    // Add animation to stats cards on scroll
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.stat-card');
        
        elements.forEach(element => {
            const elementPosition = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            
            if (elementPosition < windowHeight - 100) {
                element.style.transform = 'translateY(0)';
                element.style.opacity = '1';
            }
        });
    };

    // Initialize animations
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll();
});