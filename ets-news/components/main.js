const filterComponent = document.querySelector('news-filter');

filterComponent.addEventListener('filter-news', (e) => {
    const { keyword, category } = e.detail;
    
    console.log("Mencari:", keyword, "di kategori:", category);

    document.querySelectorAll('news-item').forEach(item => {
        const title = item.getAttribute('title').toLowerCase();
        const itemCat = item.getAttribute('category');
        
        const matchKeyword = title.includes(keyword);
        const matchCategory = (category === 'Semua' || itemCat === category);

        if (matchKeyword && matchCategory) {
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }
    });
});