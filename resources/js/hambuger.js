const menuBtn = document.querySelector(".menu-btn");
const sideNav = document.querySelector(".sidenav");
let menuOpen = false;
let sideNavOpen = false;

menuBtn.addEventListener("click", () => {
    if (!menuOpen) {
        menuBtn.classList.add("open");
        sideNav.classList.add("open");
        menuOpen = true;
        sideNavOpen = true;
    } else {
        menuBtn.classList.remove("open");
        sideNav.classList.remove("open");
        menuOpen = false;
        sideNavOpen = false;
    }
});
