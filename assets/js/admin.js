
// ------------- NavBar -------------------------------------
const menuToggle = document.getElementById('menuToggle');
const sidebar = document.querySelector('.sidebar');

if (menuToggle && sidebar) {

    // فتح/إغلاق عند الضغط على الزر
    menuToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        sidebar.classList.toggle('active');
    });

    // إغلاق عند الضغط خارج القائمة
    document.addEventListener('click', (e) => {
        if (!sidebar.contains(e.target) && !menuToggle.contains(e.target)) {
            sidebar.classList.remove('active');
        }
    });

    // إغلاق عند الضغط على أي رابط داخل القائمة
    const links = sidebar.querySelectorAll('a');
    links.forEach(link => {
        link.addEventListener('click', () => {
            sidebar.classList.remove('active');
        });
    });

}

// ------------------------------------------------------------

// index page

document.addEventListener("DOMContentLoaded", () => {

    const cards = document.querySelectorAll(".dash-card");

    cards.forEach((card, i) => {

        setTimeout(() => {
            card.style.opacity = "1";
            card.style.transform = "translateY(0)";
        }, i * 120);

    });

});

// --------------------------------------------------------------------


// ---------------- Logout Confirm Box ----------------

const logoutLink = document.querySelector(".logout-link");

if (logoutLink) {

    logoutLink.addEventListener("click", (e) => {

        e.preventDefault();

        // منع التكرار
        if (document.querySelector(".logout-overlay")) return;

        const overlay = document.createElement("div");
        overlay.className = "logout-overlay";

        overlay.innerHTML = `

            <div class="logout-box">

                <div class="logout-icon">
                    <i class="bi bi-box-arrow-right"></i>
                </div>

                <h3>Logout?</h3>

                <p>
                    Are you sure you want to logout from the admin panel?
                </p>

                <div class="logout-actions">

                    <button class="cancel-btn">
                        <i class="bi bi-x-circle"></i>
                        Cancel
                    </button>

                    <button class="confirm-btn">
                        <i class="bi bi-check-circle"></i>
                        Logout
                    </button>

                </div>

            </div>

        `;

        document.body.appendChild(overlay);

        // Animation
        setTimeout(() => {
            overlay.classList.add("active");
        }, 10);

        // Cancel
        overlay.querySelector(".cancel-btn")
            .addEventListener("click", () => {

                overlay.classList.remove("active");

                setTimeout(() => {
                    overlay.remove();
                }, 300);

            });

        // Confirm
        overlay.querySelector(".confirm-btn")
            .addEventListener("click", () => {

                overlay.classList.remove("active");

                setTimeout(() => {
                    window.location.href = logoutLink.href;
                }, 250);

            });

        // Close when clicking outside
        overlay.addEventListener("click", (event) => {

            if (event.target === overlay) {

                overlay.classList.remove("active");

                setTimeout(() => {
                    overlay.remove();
                }, 300);

            }

        });

    });

}

// ----------------------------------------------------