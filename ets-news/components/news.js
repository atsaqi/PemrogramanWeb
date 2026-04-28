class NewsItem extends HTMLElement {
    connectedCallback() {
        const title = this.getAttribute('title') || "Judul Berita";
        const content = this.getAttribute('content') || "Isi berita belum tersedia.";
        const img = this.getAttribute('img') || "https://via.placeholder.com/150";
        const category = this.getAttribute('category') || "Umum";

        this.innerHTML = `
        <style>
            .news-card {
                height: 200px;
                max-height: 200px;
            }
            .news-text-truncate {
                display: -webkit-box;
                -webkit-line-clamp: 4; /* Dikurangi sedikit barisnya karena ada space buat kategori */
                -webkit-box-orient: vertical;  
                overflow: hidden;
            }
            .category-badge {
                font-size: 0.7rem;
                text-transform: uppercase;
                letter-spacing: 1px;
                color: #ff0000; /* Warna merah sesuai tema header kita tadi */
                font-weight: bold;
            }
        </style>

        <div class="card mb-3 shadow-sm overflow-hidden news-card">
            <div class="d-flex h-100 w-100">
                
                <div class="flex-grow-1 h-100" style="min-width: 0;">
                    <div class="card-body d-flex flex-column h-100">
                        <div class="category-badge mb-1">${category}</div>

                        <h5 class="card-title fw-bold text-truncate mb-2">${title}</h5>

                        <p class="card-text text-muted small news-text-truncate mb-0">
                            ${content}
                        </p>
                    </div>
                </div>

                <div class="h-100 p-2 d-flex align-items-center" 
                     style="width: fit-content; max-width: 40%;">
                    <img src="${img}" 
                         alt="News Image" 
                         style="max-height: 100%; width: auto; display: block; object-fit: contain;">
                </div>

            </div>
        </div>
        `;
    }
}

customElements.define('news-item', NewsItem);