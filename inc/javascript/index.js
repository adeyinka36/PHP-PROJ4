const buttons=document.getElementsByClassName("key");
const form = document.getElementById("keyform");
addEventListener("keyup",(e)=>{
    for(let i =0;i<buttons.length;i++){
        if(e.key==buttons[i].value){
            buttons[i].click();
        }
    }
})