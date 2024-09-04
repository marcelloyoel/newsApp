console.log('masuk');

const title = document.getElementById('title');
const slug = document.getElementById('slug');

title.addEventListener('change', function (){
    fetch('/createSlug?title=' + title.value)
    .then(response => response.json())
    .then(data => slug.value = data.slug)
});

document.addEventListener('trix-file-accept', function(e) {
    e.preventDefault();
})

function previewImage(){
    const image = document.getElementById('cover');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}
