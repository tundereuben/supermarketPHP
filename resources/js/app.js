import "@fortawesome/fontawesome-free/css/all.css";

document.querySelectorAll("[data-cart-quantity-form]").forEach((form) => {
    const quantityInput = form.querySelector("[data-cart-quantity]");

    form.querySelectorAll("[data-quantity-step]").forEach((button) => {
        button.addEventListener("click", () => {
            const step = Number(button.dataset.quantityStep);
            const quantity = Math.max(
                Number(quantityInput.min) || 1,
                (Number(quantityInput.value) || 1) + step,
            );

            quantityInput.value = String(quantity);
            form.requestSubmit();
        });
    });

    quantityInput.addEventListener("change", () => {
        if (quantityInput.reportValidity()) {
            form.requestSubmit();
        }
    });
});

const adminSidebar = document.querySelector("[data-admin-sidebar]");

if (adminSidebar) {
    const sidebarToggle = document.querySelector("[data-admin-sidebar-toggle]");
    const sidebarBackdrop = document.querySelector(
        "[data-admin-sidebar-backdrop]",
    );
    const desktopViewport = window.matchMedia("(min-width: 768px)");
    let collapsed = false;

    const setMobileOpen = (open) => {
        adminSidebar.classList.toggle("-translate-x-full", !open);
        adminSidebar.classList.toggle("translate-x-0", open);
        sidebarBackdrop.classList.toggle("hidden", !open);
        sidebarToggle.setAttribute("aria-expanded", String(open));
        sidebarToggle.setAttribute(
            "aria-label",
            open ? "Close navigation" : "Open navigation",
        );
        document.body.classList.toggle("overflow-hidden", open);
    };

    const setCollapsed = (isCollapsed) => {
        collapsed = isCollapsed;
        adminSidebar.classList.toggle("md:w-20", collapsed);
        adminSidebar.classList.toggle("md:w-64", !collapsed);

        adminSidebar
            .querySelectorAll("[data-admin-sidebar-label]")
            .forEach((label) => {
                label.classList.toggle("md:hidden", collapsed);
            });

        adminSidebar.querySelectorAll("nav a").forEach((link) => {
            link.classList.toggle("md:justify-center", collapsed);
            link.classList.toggle("md:space-x-0", collapsed);
        });

        sidebarToggle.setAttribute("aria-expanded", String(!collapsed));
        sidebarToggle.setAttribute(
            "aria-label",
            collapsed ? "Expand navigation" : "Collapse navigation",
        );
    };

    sidebarToggle.setAttribute(
        "aria-expanded",
        String(desktopViewport.matches),
    );
    sidebarToggle.setAttribute(
        "aria-label",
        desktopViewport.matches ? "Collapse navigation" : "Open navigation",
    );

    sidebarToggle.addEventListener("click", () => {
        if (desktopViewport.matches) {
            setCollapsed(!collapsed);
        } else {
            setMobileOpen(adminSidebar.classList.contains("-translate-x-full"));
        }
    });

    sidebarBackdrop.addEventListener("click", () => setMobileOpen(false));

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && !desktopViewport.matches) {
            setMobileOpen(false);
        }
    });

    desktopViewport.addEventListener("change", (event) => {
        setMobileOpen(false);
        if (event.matches) {
            setCollapsed(false);
        }
    });
}
