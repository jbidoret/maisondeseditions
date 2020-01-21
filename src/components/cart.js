
const cartElement = document.querySelector('.cart');
const taxElement = cartElement ? cartElement.querySelector('.cart__tax') : null;
const sumElement = cartElement ? cartElement.querySelector('.cart__sum') : null;
const itemElements = cartElement ? cartElement.querySelectorAll('.cart-item') : [];

const cartButtonElement = document.querySelector('#cart-button') || null;
const shippingElements = document.querySelectorAll('.shipping-amount') || null;

function showError(message) {
  const errorOverlayElement = cartElement.querySelector('.cart__error-overlay');
  errorOverlayElement.textContent = message;
  errorOverlayElement.hidden = false;
  cartElement.classList.remove('is-updating');
}


function deactivateForm() {
  
  const formCheckoutElement = document.querySelector('.form-checkout');
  const elementsToHide = ["#checkout", ".sticky-h1", ".subnav", ".form-checkout"];
  const emptycart = document.querySelector('#emptycart');
  if (formCheckoutElement) {
      elementsToHide.forEach(el => document.querySelector(el).setAttribute('hidden', true));
      emptycart.classList.add('visible');      
    // formCheckoutElement.classList.add('is-deactivated');
    formCheckoutElement.querySelectorAll('input, textarea').forEach(inputElement => inputElement.setAttribute('readonly', true));
    formCheckoutElement.querySelectorAll('button').forEach(buttonElement => buttonElement.setAttribute('disabled', true));
  }
}


function updateCart(data) {
    var items_nb = 0;
  [...itemElements].forEach((itemElement) => {
    const { id } = itemElement;
    const item = data.items.find(_item => _item.id === id);
    if (item) {
      itemElement.querySelector('.cart-item__quantity').textContent = item.quantity;
      items_nb += parseInt(item.quantity);
      itemElement.querySelector('.cart-item__sum').textContent = item.sum;
    } else {
      itemElement.remove();
    }
  });

  sumElement.textContent = data.sum;
  taxElement.textContent = data.tax;
  cartElement.classList.remove('is-updating');
  if (data.error) {
    showError(data.error);
  }
  if (data.items.length <= 0) {
    deactivateForm();
  }
  if (cartButtonElement) {
      if (items_nb != 0) {
            cartButtonElement.textContent =  items_nb;
      } else {
            cartButtonElement.parentElement.removeChild(cartButtonElement);
      }
  }

  if(shippingElements){
    [...shippingElements].forEach((shippingElement) => {
      shippingElement.textContent = data.shipping
    })
  }


}


function increaseQuantity(event) {
  const itemElement = event.target.closest('tr');
  const { id } = itemElement;
  const quantity = parseFloat(itemElement.querySelector('.cart-item__quantity').textContent);
  const body = new FormData();
  cartElement.classList.add('is-updating');
  body.append('id', id);
  body.append('quantity', quantity + 1);
  fetch('/store/shop-api/update-cart-item', {
    method: 'POST',
    credentials: 'same-origin',
    body,
  }).then(response => response.json()).then((data) => {
    if (data.status === 200) {
      updateCart(data.data);
    } else if (data.status === 400 && data.message) {
      showError(data.message);
    }
  });
}
function decreaseQuantity(event) {
  const itemElement = event.target.closest('tr');
  const { id } = itemElement;
  const quantity = parseFloat(itemElement.querySelector('.cart-item__quantity').textContent);
  const body = new FormData();
  cartElement.classList.add('is-updating');
  body.append('id', id);
  body.append('quantity', quantity - 1);
  fetch('/store/shop-api/update-cart-item', {
    method: 'POST',
    credentials: 'same-origin',
    body,
  }).then(response => response.json()).then((data) => {
    if (data.status === 200) {
      updateCart(data.data);
    } else if (data.status === 400 && data.message) {
      showError(data.message);
    }
  });
}


[...itemElements].forEach((itemElement) => {
  const buttonIncrease = itemElement.querySelector('button[name="increase"]');
  const buttonDecrease = itemElement.querySelector('button[name="decrease"]');
  if (buttonIncrease) {
    buttonIncrease.addEventListener('click', increaseQuantity);
  }
  if (buttonDecrease) {
    buttonDecrease.addEventListener('click', decreaseQuantity);
  }
});
