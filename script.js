document.addEventListener("DOMContentLoaded", () => {
    const toggleButton = document.getElementById("toggle-theme");
  
    const sunIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#ffaa33" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>`;
    const moonIcon = `<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#ffaa33" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 0111.21 3 7 7 0 0012 21a9 9 0 009-8.21z"/></svg>`;
  
    const updateIcon = (theme) => {
      toggleButton.innerHTML = theme === 'light' ? sunIcon : moonIcon;
    };
  
    const savedTheme = localStorage.getItem("theme") || "dark";
    document.body.classList.remove("light", "dark");
    document.body.classList.add(savedTheme);
    updateIcon(savedTheme);
  
    toggleButton.addEventListener("click", () => {
      const currentTheme = document.body.classList.contains("light") ? "light" : "dark";
      const newTheme = currentTheme === "light" ? "dark" : "light";
  
      document.body.classList.remove(currentTheme);
      document.body.classList.add(newTheme);
      localStorage.setItem("theme", newTheme);
      updateIcon(newTheme);
    });
  
    const homeWrapper = document.querySelector(".home-wrapper");
    if (homeWrapper) {
      homeWrapper.style.opacity = 0;
      setTimeout(() => {
        homeWrapper.style.transition = "opacity 1s ease-in-out";
        homeWrapper.style.opacity = 1;
      }, 200);
    }
  function adicionarProduto() {
    const input = document.getElementById("qr-input");
    const produto = input.value.trim();
    if (produto) {
      document.getElementById("produto-lido").textContent = produto;
      document.getElementById("total").textContent = "R$ 29,00"; // valor fictício
      input.value = "";
    }
  }
  function simularLeituraQRCode() {
    alert("Leia o QR Code do seu produto");
  }
  });