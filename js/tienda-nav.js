/**
 * Menú móvil tienda — funciona con Bootstrap 4/5 y el tema Leo.
 */
(function () {
  function closeOpenMenus(except) {
    document
      .querySelectorAll(".leo-megamenu .leo-top-menu.collapse.show, .leo-megamenu .leo-top-menu.collapse.in")
      .forEach(function (menu) {
        if (menu !== except) {
          menu.classList.remove("show", "in");
        }
      });
    document.querySelectorAll(".leo-megamenu .navbar-toggler.is-open").forEach(function (btn) {
      if (!except || !btn.closest(".leo-megamenu") || !btn.closest(".leo-megamenu").contains(except)) {
        btn.classList.remove("is-open");
        btn.setAttribute("aria-expanded", "false");
      }
    });
  }

  function toggleMenu(button) {
    var nav = button.closest(".leo-megamenu") || button.closest("nav") || button.closest(".ApMegamenu");
    if (!nav) {
      return;
    }
    var menu =
      nav.querySelector(".leo-top-menu.collapse") ||
      document.querySelector(button.getAttribute("data-target") || "");
    if (!menu) {
      return;
    }
    var willOpen = !(menu.classList.contains("show") || menu.classList.contains("in"));
    closeOpenMenus(willOpen ? menu : null);
    menu.classList.toggle("show", willOpen);
    menu.classList.toggle("in", willOpen);
    button.classList.toggle("is-open", willOpen);
    button.setAttribute("aria-expanded", willOpen ? "true" : "false");
  }

  document.addEventListener("click", function (e) {
    var button = e.target.closest(".leo-megamenu .navbar-toggler, .ApMegamenu .navbar-toggler");
    if (button) {
      e.preventDefault();
      e.stopPropagation();
      toggleMenu(button);
      return;
    }
    if (!e.target.closest(".leo-megamenu, .ApMegamenu")) {
      closeOpenMenus(null);
    }
  });

  window.addEventListener("resize", function () {
    if (window.innerWidth >= 992) {
      closeOpenMenus(null);
      document.querySelectorAll(".leo-megamenu .leo-top-menu.collapse").forEach(function (menu) {
        menu.classList.remove("show", "in");
      });
    }
  });
})();
