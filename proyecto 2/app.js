document.addEventListener('DOMContentLoaded', () => {
    const productContainer = document.getElementById('product-container');
    const searchInput = document.getElementById('searchInput');
    let allProducts = [];

    fetch('https://fakestoreapi.com/products')
        .then(response => response.json())
        .then(products => {
            allProducts = products;
            displayProducts(allProducts);
        })
        .catch(error => console.error('Error al obtener los productos:', error));

    function displayProducts(products) {
        productContainer.innerHTML = ''; 
        products.forEach(product => {
            const productCard = document.createElement('div');
            productCard.classList.add('product-card');

            productCard.innerHTML = `
                <img src="${product.image}" alt="${product.title}">
                <h2>${product.title}</h2>
                <p class="category">${product.category}</p>
                <p class="price">$${product.price}</p>
            `;
            productContainer.appendChild(productCard);
        });
    }

    searchInput.addEventListener('input', (event) => {
        const searchTerm = event.target.value.toLowerCase();
        
        const filteredProducts = allProducts.filter(product =>
            product.category.toLowerCase().includes(searchTerm)
        );
        displayProducts(filteredProducts);
    });
});