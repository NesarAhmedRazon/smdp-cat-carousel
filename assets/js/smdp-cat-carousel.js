document.addEventListener("DOMContentLoaded", function () {
  const lazyBgElements = document.querySelectorAll(".lazy-bg");

  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const el = entry.target;
        const bg = el.getAttribute("data-bg");
        if (bg) {
          el.style.backgroundImage = `url('${bg}')`;
          el.removeAttribute("data-bg");
        }
        obs.unobserve(el);
      }
    });
  });

  lazyBgElements.forEach((el) => observer.observe(el));
});
