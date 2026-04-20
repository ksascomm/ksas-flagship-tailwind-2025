/**
 * File custom-jquery.js.
 *
 * Customized juqery to enhance navbar.js and wai-dropdown.js
 * Handles menu interactions, ARIA accessibility, and video lazy loading.
 */

jQuery(document).ready(function ($) {
  /**
   * Mobile/Dropdown Menu Toggle Handler
   * Manages the opening/closing of sub-menus and ensures only one sub-menu
   * is active at a time within the primary navigation.
   */
  $("#primary-menu button.dropdown-toggle").on("click", function (e) {
    e.stopPropagation();

    // Check if the click target is the List Item itself (used in some menu structures)
    if ($(this).is("li")) {
      // Visual state management for the 'closed' indicator
      if ($(this).hasClass("opened")) {
        $(this).addClass("closed");
      } else {
        $(this).removeClass("closed");
      }

      // Accordion logic: Close sibling menus before opening the target
      $(this).siblings().children(".sub-menu").removeClass("visible");
      $(this).siblings().removeClass("current-menu-parent opened");

      // Toggle active states on the target menu item
      $(this).toggleClass("current-menu-parent opened");
      $(this).children(".sub-menu").toggleClass("visible");
    }
    // Logic for when the toggle button is a child of the List Item (Standard WP structure)
    else {
      if ($(this).parent().hasClass("opened")) {
        $(this).parent().addClass("closed");
      } else {
        $(this).parent().removeClass("closed");
      }
      // Accordion logic: Close sibling menus
      $(this).parent().siblings().children(".sub-menu").removeClass("visible");
      $(this).parent().siblings().removeClass("current-menu-parent");

      // Toggle visibility on the parent LI and its sub-menu child
      $(this).parent().children(".sub-menu").toggleClass("visible");
      $(this).parent().toggleClass("current-menu-parent opened");
    }
    // Ensure parent containers maintain the 'toggled-on' state for nested menus
    if ($("ul.has-sub-menu ul.sub-menu").hasClass("toggled-on")) {
      $(this).closest("ul.has-sub-menu").addClass("toggled-on");
    }
  });
  /**
   * Sidebar/Section Menu ARIA Enhancements
   * Sanitizes menu classes and injects WAI-ARIA roles to improve
   * screen reader navigation for the secondary sidebar menu.
   */
  $("#section-menu ul").addClass("menu nav");
  $("#section-menu ul").removeClass("sub-menu has-sub-menu");
  $("#section-menu ul").attr("role", "menu");
  $("#section-menu ul").attr("aria-labelledby", "menu-button");

  // Set role='none' on LI to ensure screen readers focus on the Anchor (menuitem)
  $("#section-menu li").attr("role", "none");
  $("#section-menu li a").attr("role", "menuitem");
  /**
   * Decorative Icon Accessibility
   * Hides purely decorative bucket icons from assistive technologies
   * to prevent redundant announcements inside links.
   */
  $(".grey-card-outline h3 a .bucket-icon").attr("aria-hidden", "true");
});

/**
 * YouTube Playlist Lazy Loading & Mutation Handling
 * Optimizes performance by delaying the loading of iframes and thumbnails
 * until they enter the viewport, and handles dynamically injected plugin content.
 */
document.addEventListener("DOMContentLoaded", function () {
  // 1. Setup the Intersection Observer for the actual lazy loading
  const lazyLoadObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const element = entry.target;

        // Handle Iframes
        if (element.tagName === "IFRAME" && element.dataset.src) {
          element.src = element.dataset.src;
        }

        // Handle Thumbnail Images
        if (element.tagName === "IMG" && element.dataset.src) {
          element.src = element.dataset.src;
        }

        observer.unobserve(element);
      }
    });
  });

  // 2. Function to process and prepare elements for lazy loading
  const prepareForLazyLoad = (container) => {
    // Handle the main iframe
    const iframes = container.querySelectorAll("iframe");
    iframes.forEach((iframe) => {
      if (iframe.src && !iframe.src.includes("about:blank")) {
        iframe.dataset.src = iframe.src;
        iframe.src = "about:blank";
        lazyLoadObserver.observe(iframe);
      }
    });

    // Handle the playlist thumbnails
    const thumbs = container.querySelectorAll(".ytpp-playlist-container img");
    thumbs.forEach((img) => {
      if (img.src && !img.dataset.src) {
        img.dataset.src = img.src;
        // Use a tiny transparent placeholder or base64 to prevent broken icon
        img.src =
          "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7";
        img.setAttribute("loading", "lazy"); // Native fallback
        lazyLoadObserver.observe(img);
      }
    });
  };

  // 3. Watch for the plugin to inject the HTML
  const targetNode = document.querySelector(".aspect-video");
  if (targetNode) {
    const observer = new MutationObserver((mutations) => {
      mutations.forEach((mutation) => {
        if (mutation.addedNodes.length) {
          prepareForLazyLoad(targetNode);
        }
      });
    });

    observer.observe(targetNode, { childList: true, subtree: true });

    // Initial check in case it's already there (cached by W3TC)
    prepareForLazyLoad(targetNode);
  }
});
