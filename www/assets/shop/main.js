const telegram = window.Telegram.WebApp;
telegram.ready();
telegram.expand();
const productsContainer = document.getElementById('products-list');
const loaderBtn = document.getElementById('loader-btn');
const loaderImg = document.getElementById('loader-img');
const cartTable = document.querySelector('.table');
let page = 1;


async function getProducts()
{
    const res = await fetch('fromTelegramApp?page='+page);
    return res.text();
}


async function showProducts()
{
    const products = await getProducts();
    if (products)
    {
        productsContainer.insertAdjacentHTML('beforeend',products);
    }
    else
    {
        loaderBtn.classList.add('d-none');
    }
}


loaderBtn.addEventListener('click', ()=>{
    loaderImg.classList.add('d-inline-block');
    setTimeout(()=>{
        page++;
        showProducts().then(()=>{
            productQty(cart);
        });
        loaderImg.classList.remove('d-inline-block');
    },1000);
});


function getCart(setCart = false)
{
    if (setCart)
    {
        localStorage.setItem('cart', JSON.stringify(setCart));
    }
    return localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : {};
}


function add2Cart(product)
{
    console.log('product = ',product);
    let id = product.id;
    if (id in cart)
    {
        // console.log(cart[id]['qty'], id);
        cart[id]['qty'] += 1;
    }
    else
    {
        cart[id] = product;
        cart[id]['qty'] = 1;
    }
    getCart(cart);
    getCartSum(cart);
    productQty(cart);
    cartContent(cart);
}

function getCartSum(items)
{
    let cartSum = Object.entries(items).reduce(function(total,values)
    {
        const [key,value] = values;
        return total + (value['qty'] * value['price']);
    }, 0);
    let temp_01 = document.querySelector('.cart-sum').innerHTML = cartSum + '$';
    console.log('temp_01 = ',temp_01);
    return cartSum;
}

function productQty(items)
{
    document.querySelectorAll('.product-cart-qty').forEach(item => {
        let id = item.dataset.id;
        if (id in items)
        {
            item.innerHTML = items[id]['qty'];
        }
        else
        {
            item.innerHTML = '';
        }
    });
}

function cartContent(items)
{
    let cartTableBody = document.querySelector('.table tbody');
    let cartEmpty = document.querySelector('.empty-cart');
    let qty = Object.keys(items).length;
    if (qty)
    {
        telegram.MainButton.show();
        telegram.MainButton.setParams({
            text: 'CHECKOUT: '+getCartSum(items)+'$',
            color: '#d7b300'
        });
        cartTable.classList.remove('d-none');
        cartEmpty.classList.remove('d-block');
        cartEmpty.classList.add('d-none');
        cartTableBody.innerHTML = '';
        Object.keys(items).forEach(key => {
            cartTableBody.innerHTML += `
            <tr class="align-middle animate__animated">
                <th scope="row">${key}</th>
                <td><img src="images/shop/${items[key]['image']}" class="cart-img" alt=""></td>
                <td>${items[key]['title']}</td>
                <td>${items[key]['qty']}</td>
                <td>${items[key]['price']}</td>
                <td data-id="${key}"><button class="btn del-item">🗑</button></td>
            </tr>
            `;
        });
    }
    else
    {
        telegram.MainButton.hide();
        cartTableBody.innerHTML = '';
        cartTable.classList.add('d-none');
        cartEmpty.classList.remove('d-none');
        cartEmpty.classList.add('d-block');
    }
}

let cart = getCart();
getCartSum(cart);
productQty(cart);
cartContent(cart);

// add listener for add product

productsContainer.addEventListener('click', (e) => {
    if(e.target.classList.contains('add2cart'))
    {
        e.preventDefault();
        // animation: animate__rubberBand
        e.target.classList.add('animate__rubberBand');
        // console.log(JSON.parse(e.target.dataset.product));
        
        add2Cart(JSON.parse(e.target.dataset.product));

        setTimeout(()=>{
            e.target.classList.remove('animate__rubberBand');
            console.log(e.target);
        }, 1000);
    }
});

// add listener for remove product

cartTable.addEventListener('click', (e) => {
    const target = e.target.closest('.del-item');
    if (target)
    {
        let id = target.parentElement.dataset.id;
        target.parentElement.parentElement.classList.add('animate__zoomOut');
        
        setTimeout(()=>{
            delete cart[id];
            getCart(cart);
            getCartSum(cart);
            productQty(cart);
            cartContent(cart);
        }, 300);
    }
    console.log(target);
});


// ajax on bot

telegram.MainButton.onClick(()=>{
    // alert(telegram.initDataUnsafe.query_id);
    // console.log(telegram);
    fetch('fromJessica',{
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({
           query_id: telegram.initDataUnsafe.query_id,
           user: telegram.initDataUnsafe.user,
           cart: cart,
           total_sum: getCartSum(cart)
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
    });
    
});








