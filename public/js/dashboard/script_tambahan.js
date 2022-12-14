const wrapper = document.querySelector(".wrapper");
const divImg = document.querySelector(".image");
const fileName = document.querySelector(".file-name");
const defaultBtn = document.querySelector("#thumbnail");
const customBtn = document.querySelector("#custom-btn");
const cancelBtn = document.querySelector("#cancel-btn i");
const img = document.querySelector("#preview");
// const img = document.querySelector("img");
let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
function defaultBtnActive() {
    defaultBtn.click();
}
defaultBtn.addEventListener("change", function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function () {
            const result = reader.result;
            img.src = result;
            wrapper.classList.add("active");
            divImg.classList.remove("displayBlock");
            divImg.classList.add("displayNone");
        }
        cancelBtn.addEventListener("click", function () {
            img.src = "";
            wrapper.classList.remove("active");
            divImg.classList.add("displayBlock");
            divImg.classList.remove("displayNone");
        })
        reader.readAsDataURL(file);
    }
    if (this.value) {
        let valueStore = this.value.match(regExp);
        fileName.textContent = valueStore;
    }
});
