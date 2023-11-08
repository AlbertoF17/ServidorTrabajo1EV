const hamburguer = document.querySelector(".menu-icon");
const sidebar = document.querySelector(".sidenav");
const mainContent = document.querySelector('main');
const dropdown = document.querySelectorAll(".dropdown-btn");

for (let i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function () {
        this.classList.toggle("active");
        const dropdownContent = this.nextElementSibling;
        const icon = this.querySelector(".bx");
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
            icon.style.transform = "rotate(0deg)";
        } else {
            dropdownContent.style.display = "block";
            icon.style.transform = "rotate(180deg)";
        }
    });
}

hamburguer.addEventListener('click', function () {
    sidebar.classList.toggle('retract');
    mainContent.classList.toggle('retract');
    hamburguer.classList.toggle("active");
});