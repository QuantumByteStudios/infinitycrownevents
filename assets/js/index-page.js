// assets/js/index-page.js — Infinity Crown Events home page UI (navbar toggler, sidebar, overlay). Static site; no PHP.

document.addEventListener("DOMContentLoaded", () => {
	const navbarTogglerNine = document.querySelector(".navbar-nine .navbar-toggler");
	if (navbarTogglerNine) {
		navbarTogglerNine.addEventListener("click", () => {
			navbarTogglerNine.classList.toggle("active");
		});
	}

	const sidebarLeft = document.querySelector(".sidebar-left");
	const overlayLeft = document.querySelector(".overlay-left");
	const sidebarClose = document.querySelector(".sidebar-close .close");

	if (overlayLeft && sidebarLeft) {
		overlayLeft.addEventListener("click", () => {
			sidebarLeft.classList.toggle("open");
			overlayLeft.classList.toggle("open");
		});
	}

	if (sidebarClose && sidebarLeft && overlayLeft) {
		sidebarClose.addEventListener("click", () => {
			sidebarLeft.classList.remove("open");
			overlayLeft.classList.remove("open");
		});
	}

	const sideMenuLeftNine = document.querySelector(".navbar-nine .menu-bar");
	if (sideMenuLeftNine && sidebarLeft && overlayLeft) {
		sideMenuLeftNine.addEventListener("click", () => {
			sidebarLeft.classList.add("open");
			overlayLeft.classList.add("open");
		});
	}

	if (sidebarLeft && overlayLeft) {
		sidebarLeft.querySelectorAll(".page-scroll").forEach((link) => {
			link.addEventListener("click", () => {
				sidebarLeft.classList.remove("open");
				overlayLeft.classList.remove("open");
			});
		});
	}

	if (typeof GLightbox !== "undefined") {
		GLightbox({
			selector: "#gallery .glightbox",
			loop: true,
			touchNavigation: true,
			keyboardNavigation: true,
			closeOnOutsideClick: true,
		});
	}
});
