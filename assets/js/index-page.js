// assets/js/index-page.js — Infinity Crown Events home page UI (navbar, sidebar, gallery lightbox, contact redirect notice).

document.addEventListener("DOMContentLoaded", () => {
	const notice = document.getElementById("contact-form-notice");
	const inquiry = new URLSearchParams(window.location.search).get("inquiry");
	if (notice && (inquiry === "sent" || inquiry === "error")) {
		notice.classList.remove("d-none");
		notice.textContent =
			inquiry === "sent"
				? "Thank you — we received your message and will reply soon."
				: "We could not send your message from the server. Please call or email us directly.";
		notice.classList.add(inquiry === "sent" ? "text-success" : "text-danger");
		const path = window.location.pathname;
		const hash = window.location.hash || "#contact";
		window.history.replaceState({}, "", path + hash);
	}

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
