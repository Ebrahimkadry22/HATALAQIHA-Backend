class FooterCompoment extends HTMLElement {
  constructor () {
    super()
    this.innerHTML = `
    <footer>
  <div class="container">
    <p>
      © 2024 Design <span>Ibrahim kadry</span>
    </p>
  </div>
</footer>
    
    `
  }
}

customElements.define('footer-compoment', FooterCompoment)