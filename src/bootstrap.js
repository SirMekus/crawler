import { registerEventListeners, on} from "mmuo"
import axios from 'axios';

window.addEventListener("DOMContentLoaded", function() {
    registerEventListeners()
}, false);

on('#other', 'click', function(event){
    const checked = event.target.checked;

    const manual = document.querySelector(".manual");

    const pre_filled = document.querySelector(".pre-filled");

    manual.classList.toggle('d-none');

    pre_filled.classList.toggle('d-none');

    if(checked){
        pre_filled.children[0].setAttribute('disabled', 'disabled');
        manual.children[0].removeAttribute('disabled');
    }
    else{
        manual.children[0].setAttribute('disabled', 'disabled');
        pre_filled.children[0].removeAttribute('disabled');
    }
})

document.addEventListener("myevent", (event) => {
    const data = event.detail.data.message;

    setTimeout(function(){
        const box = document.querySelector(".success")

        box.replaceChildren();

        let emailParagraph = document.createElement("p");
        emailParagraph.classList.add('text-success');
        emailParagraph.classList.add('fw-bold');
        emailParagraph.innerHTML = `Emails Found: ${data?.emails}`
        box.appendChild(emailParagraph);

        let phoneParagraph = document.createElement("p");
        phoneParagraph.classList.add('text-success');
        phoneParagraph.classList.add('fw-bold');
        phoneParagraph.innerHTML = `Phone Numbers Found: ${data?.phones}`
        box.appendChild(phoneParagraph);
    }, 1000);
});

window.axios = axios

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';