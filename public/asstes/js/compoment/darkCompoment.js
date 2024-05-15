class DarkCompoment extends HTMLElement {
  constructor () {
    super () 
    this.innerHTML = `
    <button id="btn" class="btn-check" >
  <i class="fa-solid fa-moon" id="them"></i>
</button>
    `
  }
}

customElements.define('dark-compoment',DarkCompoment)