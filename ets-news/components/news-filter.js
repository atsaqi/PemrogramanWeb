class NewsFilter extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <div class="container my-4">
            <div class="row g-2">
                <div class="col-12 col-md-8">
                    <input type="text" id="search-box" class="form-control" placeholder="Cari judul berita...">
                </div>

                <div class="col-12 col-md-4">
                    <select id="category-box" class="form-select">
                        <option value="Semua">Semua Kategori</option>
                        <option value="Teknologi">Teknologi</option>
                        <option value="Olahraga">Olahraga</option>
                        <option value="Politik">Politik</option>
                        <option value="Hiburan">Hiburan</option>
                    </select>
                </div>
            </div>
        </div>
        `;

        this.setupEventListeners();
    }

    setupEventListeners() {
        const searchInput = this.querySelector('#search-box');
        const categorySelect = this.querySelector('#category-box');

        const emitFilterChange = () => {
            const detail = {
                keyword: searchInput.value.toLowerCase(),
                category: categorySelect.value
            };

            this.dispatchEvent(new CustomEvent('filter-news', {
                detail: detail,
                bubbles: true
            }));
        };

        searchInput.addEventListener('input', emitFilterChange);
        categorySelect.addEventListener('change', emitFilterChange);
    }
}

customElements.define('news-filter', NewsFilter);