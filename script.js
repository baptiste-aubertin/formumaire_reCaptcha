const form = document.querySelector("form");

form.onsubmit = (e)=>{
    console.log("ic1")

    e.preventDefault();
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "mail.php", true);
    let formData = new FormData(form);
    xhr.send(formData);
    xhr.onload = ()=>{
        if(xhr.readyState === 4 && xhr.status == 200){
            let response = xhr.response;
            console.log(response)
            if(response.indexOf("field_required") !== -1 || response.indexOf("valid") !== -1 || response.indexOf("failed") !== -1){
            }
            else{
                form.reset();
                setTimeout(()=>{
                    form.reset();
                }, 3000);
            }
        }
    }

}