let toggleERBtns = document.getElementById("toggler-btn");

function eventDelegation(event){
    if(event.target.tagName === "BUTTON"){
        let buttonFinder = event.target.closest("toggler-btn").id;
        
        console.log("gege")
    }
   
}

toggleERBtns.addEventListener("click", eventDelegation);