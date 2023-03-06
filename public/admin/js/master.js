const currentLocation= location.href;
var sidebar= document.querySelector(".sidebar-nav").querySelectorAll("a");
var lisidebar= document.querySelector(".sidebar-nav").querySelectorAll("li");
for (let index = 0; index < sidebar.length; index++) {
    if (sidebar[index].href===currentLocation) {
        lisidebar[index].className='sidebar-item active';
    }        
}

(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();