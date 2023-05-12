const sideMenu = document.querySelector("aside");
const openMenu = document.querySelector("#menu-btn");
const closeMenu = document.querySelector("#close-btn");

openMenu.addEventListener('click', () => {
  sideMenu.style.display = "block";
  openMenu.style.display = "none"
})

closeMenu.addEventListener('click', () => {
  sideMenu.style.display = "none";
  openMenu.style.display = "block"
})