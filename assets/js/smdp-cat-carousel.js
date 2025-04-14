/**
 * SMDP Category Carousel - Lazy Loading Implementation
 * Works in both frontend and Elementor editor
 * Version: 1.0.2
 */

(function () {
  "use strict";

  // Configuration
  const config = {
    rootMargin: "200px 0px",
    threshold: 0.01,
    processedAttribute: "data-lazy-processed"
  };

  /**
   * Initialize IntersectionObserver for lazy loading
   */
  function initLazyBg() {
    const elements = document.querySelectorAll(
      `.lazy-bg:not([${config.processedAttribute}])`
    );

    if (!elements.length) return;

    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            loadBackground(entry.target);
            observer.unobserve(entry.target);
          }
        });
      },
      {
        rootMargin: config.rootMargin,
        threshold: config.threshold
      }
    );

    elements.forEach((el) => {
      el.setAttribute(config.processedAttribute, "false");
      observer.observe(el);
    });
  }

  /**
   * Load background image for a single element
   */
  function loadBackground(el) {
    const bg = el.getAttribute("data-bg");
    if (bg) {
      el.style.backgroundImage = `url('${bg}')`;
      el.setAttribute(config.processedAttribute, "true");
    }
  }

  /**
   * Initialize with proper hooks and fallbacks
   */
  function initialize() {
    // Immediate initialization
    initLazyBg();

    // Elementor frontend integration
    if (window.elementorFrontend?.hooks) {
      elementorFrontend.hooks.addAction(
        "frontend/element_ready/widget",
        function ($scope) {
          if ($scope.find(".smdp-category-scroll").length) {
            setTimeout(initLazyBg, 100);
          }
        }
      );
    }

    // Elementor editor integration
    if (window.elementor?.on) {
      elementor.on("preview:loaded", initLazyBg);
      if (elementor.channels?.editor) {
        elementor.channels.editor.on("change", () =>
          setTimeout(initLazyBg, 300)
        );
      }
    }

    // Fallback for dynamic content
    if (window.MutationObserver) {
      new MutationObserver(initLazyBg).observe(document.body, {
        childList: true,
        subtree: true
      });
    }
  }

  // Start initialization
  if (document.readyState !== "loading") {
    setTimeout(initialize, 100);
  } else {
    document.addEventListener("DOMContentLoaded", initialize);
  }
})();
