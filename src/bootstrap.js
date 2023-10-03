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

        //box.replaceChildren();

        if(data?.links){
            let link
            for(link in data.links){
                let linkNode = document.createElement("span");
                linkNode.classList.add('text-success');
                linkNode.classList.add('fw-bold');
                linkNode.classList.add('d-block');
                linkNode.innerHTML = `Crawled: ${data.links[link]}`
                box.appendChild(linkNode);
            }
        }

        if(data?.emails){
            let email
            for(email in data.emails){
                let emailParagraph = document.createElement("span");
                emailParagraph.classList.add('text-home');
                emailParagraph.classList.add('fw-bold');
                emailParagraph.classList.add('d-block');
                emailParagraph.innerHTML = `Email Found: ${data?.emails[email]}`
                box.appendChild(emailParagraph);
            }
        }

        if(data?.phones){
            let phone
            for(phone in data.phones){
                let phoneParagraph = document.createElement("span");
                phoneParagraph.classList.add('text-black');
                phoneParagraph.classList.add('fw-bold');
                phoneParagraph.classList.add('d-block');
                phoneParagraph.innerHTML = `Phone Number Found: ${data?.phones[phone]}`
                box.appendChild(phoneParagraph);
            }
        }
    }, 1000);
});

window.axios = axios

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';