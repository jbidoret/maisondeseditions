
import { scrollToId } from "./common";
const shippingForm = document.querySelector('.form-shipping');



function showFieldErrors(data) {
  let isFocused = false;

  Object.keys(data).forEach((key) => {
    const inputElement = shippingForm.querySelector(`input[name="${key}"]`);
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

if (shippingForm) {
  
    const delivery_btn = document.querySelector("#checkout-delivery-button");
    const shippingAddressElement = shippingForm.querySelector('#shipping-address');
    const radioShippingAddressElements = shippingForm.querySelectorAll('input[name="deliveryAddress"]');

    // step address to step delivery
    delivery_btn.addEventListener('click', function(){
        document.querySelector('#delivery').classList.add('visible');
        this.parentElement.remove();
        scrollToId('#delivery');
    });

    // shipping method selection
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

    // submit
    shippingForm.addEventListener('submit', async (event) => {
        event.preventDefault();

        if (shippingForm.checkValidity()) {
            console.log(shippingForm.action);
            
            fetch(shippingForm.action, {
                method: shippingForm.method,
                credentials: 'same-origin',
                body: new FormData(shippingForm),
            }).then(response => response.json()).then((data) => {
                if (data.status === 201) {
                window.location = data.redirect;
                } else if (data.key === 'error.merx.fieldsvalidation') {
                showFieldErrors(data.details);
                } else {
                const errorElement = shippingForm.querySelector('.form-checkout__submit .error');
                errorElement.textContent = data.message;
                }
            }).catch((res) => {
                console.error(res);
                // const errorElement = shippingForm.querySelector('.form-checkout__submit .error');
                // errorElement.textContent = 'Unknown Server Error.';
            });

        } else {
            console.log('badaboum');
            
            // const errorElement = shippingForm.querySelector('.form-checkout__submit .error');
            // errorElement.textContent = 'Vos informations ne sont pas complètes';
        }
    });
}
