class MyHeader extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <nav class="navbar navbar-dark bg-danger shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#">NEWS</a>

                <div class="d-flex align-items-center">
                    <button id="dark-mode-toggle" class="btn btn-outline-light btn-sm rounded-pill px-3">
                        <span id="dark-mode-icon"></span> Dark Mode
                    </button>
                </div>
            </div>
        </nav>
        `;

        this.setupDarkMode();
    }

    setupDarkMode() {
        const btn = this.querySelector('#dark-mode-toggle');
        const icon = this.querySelector('#dark-mode-icon');
        const body = document.body;

        btn.addEventListener('click', () => {
            const currentTheme = body.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            body.setAttribute('data-bs-theme', newTheme);

            if (newTheme === 'dark') {
                btn.innerHTML = 'Light Mode';
                btn.classList.replace('btn-outline-light', 'btn-light');
            } else {
                btn.innerHTML = 'Dark Mode';
                btn.classList.replace('btn-light', 'btn-outline-light');
            }
        });
    }
}
customElements.define('my-header', MyHeader);