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
    console.log(data)

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
            let emailParagraph = document.createElement("p");
            emailParagraph.classList.add('text-home');
            emailParagraph.classList.add('fw-bold');
            emailParagraph.classList.add('email-div');
            emailParagraph.innerHTML = `Emails Found: ${Object.values(data?.emails).toString()}`
            box.appendChild(emailParagraph);
        }

        if(data?.phones){
            let phoneParagraph = document.createElement("p");
            phoneParagraph.classList.add('text-black');
            phoneParagraph.classList.add('fw-bold');
            phoneParagraph.innerHTML = `Phone Numbers Found: ${Object.values(data?.phones).toString()}`
            box.appendChild(phoneParagraph);
        }
    }, 1000);
});

window.axios = axios

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';