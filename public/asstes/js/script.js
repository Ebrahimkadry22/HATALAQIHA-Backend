let btn = document.getElementById('btn')
let them = document.getElementById('them')

btn.addEventListener('click' ,()=>{
  document.body.classList.toggle('dark-them')

    if(document.body.classList.contains('dark-them')) {
      them.classList.remove('fa-moon')
      them.classList.add('fa-sun')


  }
  else {
    them.classList.add('fa-moon')
    them.classList.remove('fa-sun')
  }
})

// navbar
let iconbar = document.querySelector('.icon-bar')
let bar = document.getElementById('bar')
let lists = document.querySelector('.lists')

iconbar.addEventListener('click',()=> {
  lists.classList.toggle('active-bar')
  if(lists.classList.contains('active-bar')) {
    bar.classList.remove('fa-bars')
    bar.classList.add('fa-xmark')
  }else {
    bar.classList.add('fa-bars')
    bar.classList.remove('fa-xmark')

  }
})

// change profile image

let image = document.getElementById('image')
let close = document.getElementById('close')
let changeImage = document.getElementById('changeImage')

image.addEventListener('click', ()=> {
changeImage.classList.add('active')
})
close.addEventListener('click', ()=> {
changeImage.classList.remove('active')
})

const nav = document.querySelector('nav');
window.addEventListener ('scroll' , function(){
    nav.classList.toggle('fixed' , window.scrollY > 0 )

})


