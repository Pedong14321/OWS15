
{{-- for sidebar button toggle --}}
<script> 
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.getElementById("sidebtn");
        const sidebar = document.getElementById("logo-sidebar");

        toggleButton.addEventListener("click", function() {
            // Toggle the 'hidden' class to show/hide the sidebar
            sidebar.classList.toggle("translate-x-0");
        });
    });
</script>

{{-- script for user menu-button --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.getElementById('user-menu-button');
        const dropdown = document.getElementById('user-dropdown');

        button.addEventListener('click', function() {
            if (dropdown.style.display === 'block') {
                dropdown.style.display = 'none';
            } else {
                dropdown.style.display = 'block';
            }
        });

        // Close the dropdown when clicking outside of it
        document.addEventListener('click', function(event) {
            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });
    });
</script>

</body>

</html>
