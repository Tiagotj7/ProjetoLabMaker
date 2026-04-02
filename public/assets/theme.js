(function () {
  const STORAGE_KEY = "labmaker_theme"; // 'dark' | 'light'

  function systemPrefersLight() {
    return window.matchMedia && window.matchMedia("(prefers-color-scheme: light)").matches;
  }

  function getTheme() {
    const saved = localStorage.getItem(STORAGE_KEY);
    if (saved === "light" || saved === "dark") return saved;
    return systemPrefersLight() ? "light" : "dark";
  }

  function applyTheme(theme) {
    document.documentElement.setAttribute("data-theme", theme);

    // sincroniza o switch (checked = dark)
    const toggle = document.getElementById("themeToggle");
    if (toggle) toggle.checked = (theme === "dark");
  }

  function setTheme(theme) {
    localStorage.setItem(STORAGE_KEY, theme);
    applyTheme(theme);
  }

  // inicializa
  applyTheme(getTheme());

  // expõe para uso em HTML, se quiser
  window.setTheme = setTheme;
  window.toggleTheme = function () {
    const current = document.documentElement.getAttribute("data-theme") || "dark";
    setTheme(current === "dark" ? "light" : "dark");
  };

  // liga o evento do switch quando o DOM estiver pronto
  document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("themeToggle");
    if (!toggle) return;

    // garantir estado correto ao carregar
    toggle.checked = (getTheme() === "dark");

    toggle.addEventListener("change", function () {
      setTheme(toggle.checked ? "dark" : "light");
    });
  });
})();