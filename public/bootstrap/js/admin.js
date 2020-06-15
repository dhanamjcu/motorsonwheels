/*********************sidebar********************************** */

const sideBarClose = document.querySelector('#sidebarClose');
const hamburger = document.querySelector('#hamburger');
const adminSidebar = document.querySelector('.Admin__sidebar');
const adminMainContent = document.querySelector('#admin_main_content');



hamburger.addEventListener('click', function () {
    adminSidebar.style.marginLeft = '0';
    adminMainContent.style.marginLeft = '260px';
});

sideBarClose.addEventListener('click', function () {
    adminSidebar.style.marginLeft = '-250px';
    adminMainContent.style.marginLeft = '50px';
   

});

/***************************Image Preview******************************** */

/* const thumpDisplay = document.querySelectorAll('.thumpDisplay')[0];

thumpDisplay.addEventListener('click', (e)=>{
    triggerClick(e);
});

function triggerClick(e){
    let imgTag = e.target.querySelector(".imgFile");
    imgTag.click();
    //  imgTag.addEventListener('change',displayImg());
    
}
function displayImg(e){
    if(e.files[0]){
        let reader = new FileReader();
        reader.onload = function(e){
            thumpDisplay.setAttribute('src',e.target.result);
        }
        reader.readAsDataURL(e.files[0]);
    }
} */