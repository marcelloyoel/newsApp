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
