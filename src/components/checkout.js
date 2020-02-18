
import { scrollToId } from "./common";

/* global Stripe */
/* eslint no-param-reassign: "warn" */


const checkoutForm = document.querySelector('.form-checkout');
let paymentMethod = null;
const stripeStyle = {
  base: {
    fontFamily: '"Work Sans", "Helvetica", sans-serif',
    fontSize: '16px',
    color: 'black',
  },
};

if (checkoutForm) {

    // reload on access
    window.addEventListener( "pageshow", function ( event ) {
      var historyTraversal = event.persisted || 
                             ( typeof window.performance != "undefined" && 
                                  window.performance.navigation.type === 2 );
      if ( historyTraversal ) {
        // Handle page restore.
        window.location.reload();
      }
    });
    

    
    const back_btn = document.querySelector("#checkout-back-button");
    const frwd_btn = document.querySelector("#checkout-frwd-button");
    const delivery_btn = document.querySelector("#checkout-delivery-button");
    const payment_btn = document.querySelector("#checkout-payment-button");
    // const shipping_btn = document.querySelector("#checkout-shipping-button");

    back_btn.addEventListener('click', function(){
        document.location = this.getAttribute('data-back_href');
    });

    frwd_btn.addEventListener('click', function(){
        document.querySelector('#address').classList.add('visible');
        this.parentElement.remove();
        scrollToId('#address');
    });
    
    delivery_btn.addEventListener('click', function(){
        // document.querySelector('a[href="#delivery"]').classList.remove('disabled');
        document.querySelector('#delivery').classList.add('visible');
        this.parentElement.remove();
        scrollToId('#delivery');
    });

    payment_btn.addEventListener('click', function(){
        // document.querySelector('a[href="#payment"]').classList.remove('disabled');
        document.querySelector('#payment').classList.add('visible');
        this.parentElement.remove();
        scrollToId('#payment');
    });

    // shipping_btn.addEventListener('click', function(){
    //   fetch("shop-api/compute-shipping", {
    //     method: "POST",
    //     credentials: 'same-origin',
    //     body: new FormData(checkoutForm),
    //   }).then(response => response.json()).then((data) => {
    //     if (data.status === 200) {
    //       document.querySelector('#payment').classList.add('visible');
    //       this.parentElement.remove();  
    //       scrollToId('#payment');
    //     } else {
    //       const errorElement = checkoutForm.querySelector('.form-checkout__submit .error');
    //       errorElement.textContent = data.message;
    //     }
    //   }).catch((res) => {
    //     console.error(res);
    //     const errorElement = checkoutForm.querySelector('.form-checkout__submit .error');
    //     errorElement.textContent = 'Unknown Server Error.';
    //     unsetLoading();
    //   });
    // })
}




function setStripeToken(token) {
  const hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  checkoutForm.appendChild(hiddenInput);
}

function setLoading(paymentMethod) {
    // console.log(paymentMethod);
  checkoutForm.classList.add("is-loading");
  checkoutForm.classList.add(paymentMethod);
  [...checkoutForm.querySelectorAll('input, select, textarea')].forEach(inputElement => inputElement.setAttribute('readonly', true));
  [...checkoutForm.querySelectorAll('button')].forEach(buttonElement => buttonElement.setAttribute('disabled', true));
  [...checkoutForm.querySelectorAll('.error')].forEach((errorElement) => {
    errorElement.textContent = '';
  });
}

function unsetLoading() {
  checkoutForm.classList.remove('is-loading');
  [...checkoutForm.querySelectorAll('input, select, textarea')].forEach(inputElement => inputElement.removeAttribute('readonly'));
  [...checkoutForm.querySelectorAll('button')].forEach(buttonElement => buttonElement.removeAttribute('disabled'));
}

function changeSubmitText(submitElement, text, buttonTextDefault) {
  if (text.length > 0) {
    submitElement.textContent = text;
  } else {
    submitElement.textContent = buttonTextDefault;
  }
}

function changePaymentMethod(paymentMethodElements) {
  [...paymentMethodElements].forEach((paymentMethodElement) => {
    if (paymentMethodElement.dataset.paymentMethod === paymentMethod) {
      paymentMethodElement.hidden = false;
    } else {
      paymentMethodElement.hidden = true;
    }
  });
}

function showFieldErrors(data) {
  let isFocused = false;

  Object.keys(data).forEach((key) => {
    const inputElement = checkoutForm.querySelector(`input[name="${key}"]`);
    if (inputElement) {
      const errorElement = document.createElement('div');
      errorElement.classList.add('error');
      errorElement.textContent = Object.values(data[key].message)[0];
      inputElement.parentElement.appendChild(errorElement);
      if (!isFocused) {
        inputElement.focus();
        isFocused = true;
      }
    }
  });
}

function getClientSecret() {
  return fetch('shop-api/get-client-secret').then(response => response.json()).then(data => data.clientSecret).catch((exception) => {
    console.error(exception);
    const errorElement = checkoutForm.querySelector('.form-checkout__submit .error');
    errorElement.textContent = 'Unknown Server Error.';
  });
}


function submit() {
  fetch(checkoutForm.action, {
    method: checkoutForm.method,
    credentials: 'same-origin',
    body: new FormData(checkoutForm),
  }).then(response => response.json()).then((data) => {
    if (data.status === 201) {
      window.location = data.redirect;
    } else if (data.key === 'error.merx.fieldsvalidation') {
      showFieldErrors(data.details);
    } else {
      const errorElement = checkoutForm.querySelector('.form-checkout__submit .error');
      // console.log("data");
      // console.log(data);
      errorElement.textContent = data.message;
    }
    // unsetLoading();
  }).catch((res) => {
    console.error(res);
    const errorElement = checkoutForm.querySelector('.form-checkout__submit .error');
    errorElement.textContent = 'Unknown Server Error.';
    unsetLoading();
  });
}

function initStripe() {
  const stripePublishableKey = checkoutForm.querySelector('input[name="stripePublishableKey"]').value;
  const stripe = Stripe(stripePublishableKey);
  const stripeElements = stripe.elements();

  const stripeCardElement = document.querySelector('#stripe-card');
  const stripeSepaDebitElement = document.querySelector('#stripe-sepa-debit');

  const stripeCard = stripeElements.create('card', {
    style: stripeStyle,
    hidePostalCode: true,
  });

  const stripeSepaDebit = stripeElements.create('iban', {
    style: stripeStyle,
    supportedCountries: ['SEPA'],
    placeholderCountry: 'FR',
  });

  stripeCard.mount(stripeCardElement);
  stripeSepaDebit.mount(stripeSepaDebitElement);

  stripe.card = stripeCard;
  stripe.cardElement = stripeCardElement;

  stripe.sepaDebit = stripeSepaDebit;
  stripe.sepaDebitElement = stripeSepaDebitElement;

  return stripe;
}

if (checkoutForm) {
  const stripe = initStripe();
  const shippingAddressElement = checkoutForm.querySelector('#shipping-address');
  const radioShippingAddressElements = checkoutForm.querySelectorAll('input[name="deliveryAddress"]');
  const radioPaymentMethodElements = checkoutForm.querySelectorAll('input[name="paymentMethod"]');
  const paymentMethodElements = checkoutForm.querySelectorAll('[data-payment-method]');
  const submitElement = checkoutForm.querySelector('button[type="submit"]');
  const buttonTextDefault = submitElement.textContent;

  if (shippingAddressElement && radioShippingAddressElements) {
      [...radioShippingAddressElements].forEach((radioShippingAddressElement) => {
          radioShippingAddressElement.addEventListener('change', () => {
              if (radioShippingAddressElement.value=="useAnotherShippingAddress") {
                  shippingAddressElement.classList.remove("hidden");
              } else {
                  shippingAddressElement.classList.add("hidden");
              }
          });
      });
  }

  if (radioPaymentMethodElements) {
    [...radioPaymentMethodElements].forEach((radioPaymentMethodElement) => {
      radioPaymentMethodElement.addEventListener('change', () => {
        paymentMethod = radioPaymentMethodElement.value;
        const { submitText } = radioPaymentMethodElement.dataset;
        changeSubmitText(submitElement, submitText, buttonTextDefault);
        changePaymentMethod(paymentMethodElements);
      });
    });
  }

  checkoutForm.addEventListener('submit', async (event) => {
    event.preventDefault();

    if (checkoutForm.checkValidity()) {
        setLoading(paymentMethod);
        // scrollToId('#loading');
      if (paymentMethod === 'credit-card-sca') {
        const clientSecret = await getClientSecret();
        console.log(clientSecret);
        console.log(checkoutForm.name.value);
        const cardElement = stripe.card;
        
        const { error } = await stripe.handleCardPayment(
          clientSecret, cardElement, {
            payment_method_data: {
              billing_details: {
                name: `${checkoutForm.name.value}`,
                city: checkoutForm.city
              },
            },
          },
        );

        if (error) {
          unsetLoading();
          const errorElement = stripe.cardElement.parentElement.querySelector('.error');
          errorElement.textContent = error.message;
        } else {
          submit();
        }
      } else if (paymentMethod === 'sepa-debit') {
        const sourceData = {
          type: 'sepa_debit',
          currency: 'eur',
        };

        stripe.createSource(stripe.sepaDebit, sourceData).then((result) => {
          if (result.error) {
            unsetLoading();
            const errorElement = stripe.sepaDebitElement.parentElement.querySelector('.error');
            errorElement.textContent = result.error.message;
          } else {
            setStripeToken(result.source);
            submit();
          }
        });
      } else {
        submit();
      }
    } else {
      const errorElement = checkoutForm.querySelector('.form-checkout__submit .error');
      errorElement.textContent = 'Vos informations ne sont pas complètes';
      unsetLoading();
    }
  });
}
