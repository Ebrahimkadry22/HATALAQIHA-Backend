class LinkCompoment extends HTMLElement {
  constructor () {
    super()
    this.innerHTML = `

    <a
    ${this.getAttribute('active') === this.getAttribute('to') ? 'class="active"' : null}
    href="${this.getAttribute('to')}"
    >
    ${this.textContent}
    </a>

    `

  }
}


class NavbarCompoment extends HTMLElement {
  constructor () {
    super()
    this.innerHTML =`
    <nav>
    <div class="container">
      <div class="navbar">
        <div class="logo">
          <a href="#"><span>hatalaqiha</span></a>
         </div>

         <div class="lists">
          <ul>
            <li><a href="#" class="active">Home</a></li>
            <li><a href="#">find jobs</a></li>

            </ul>
          <div class="left">
           <ul>
             <li><a href="accountlogin" ><button class="btn btn-check">login</button></a></li>
             <li><a href="registration" ><button class="btn btn-no-check">registra</button></a></li>
             <li><a href="post-job.html" ><button class="btn btn-no-check">post a job</button></a></li>
             @if(!Auth::check())
                <li><a href="" ><button class="btn btn-logout">logout</button></a></li>
             @else
             <li><a href="registration" ><button class="btn btn-no-check">Profile</button></a></li>
             @endif
           </ul>
          </div>
         </div>

         <div class="icon-bar">
           <i class="fa-solid fa-bars" id="bar"></i>
         </div>
      </div>


    </div>
  </nav>

    `

  }

}


customElements.define('navbar-compoment', NavbarCompoment)
customElements.define('link-compoment', LinkCompoment)
