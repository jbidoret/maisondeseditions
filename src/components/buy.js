

const forms = document.querySelectorAll('.form-buy');
[...forms].forEach(form => form.addEventListener('submit', submitForm));

function submitForm(event){
    event.preventDefault();
    const form = event.target;

    const errorElement = form ? form.querySelector('.error') : null;

    fetch(form.action, {
      method: form.method,
      credentials: 'same-origin',
      body: new FormData(form),
    }).then(response => response.json()).then((data) => {
      if (data.status === 201) {
        window.location = data.redirect;
      } else {
        // errorElement.textContent = data.message;
        console.log(data.message);
      }

    }).catch((res) => {
      console.error(res);
      console.log("Unknown Server Error.");

    });
}