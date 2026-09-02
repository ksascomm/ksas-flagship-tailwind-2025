/**
 * Live-inject ACF Extended CodeMirror CSS into the Block Editor canvas
 */
window.wp &&
  window.wp.domReady &&
  window.wp.domReady(() => {
    const FIELD_ID = "acf-field_67f66e991d507";
    let cssTargetDoc = null;

    function getCanvasDocument() {
      const iframe = document.querySelector('iframe[name="editor-canvas"]');
      if (iframe && iframe.contentDocument && iframe.contentDocument.body) {
        return iframe.contentDocument;
      }
      return document;
    }

    function applyLiveStyle(css) {
      cssTargetDoc = getCanvasDocument();
      if (!cssTargetDoc) return;

      let styleEl = cssTargetDoc.getElementById("acf-custom-page-css-live");

      if (!styleEl) {
        styleEl = cssTargetDoc.createElement("style");
        styleEl.id = "acf-custom-page-css-live";
        cssTargetDoc.head.appendChild(styleEl);
      }

      styleEl.textContent = css;
    }

    function bindCodeMirror() {
      const textarea = document.getElementById(FIELD_ID);
      if (!textarea) return false;

      // Check for CodeMirror instance attached to the field container or wrapper
      const cmWrapper = textarea
        .closest(".acf-input-wrap")
        ?.querySelector(".CodeMirror");

      if (cmWrapper && cmWrapper.CodeMirror) {
        const cmInstance = cmWrapper.CodeMirror;

        // Apply initial CSS content on load
        applyLiveStyle(cmInstance.getValue());

        // Listen to CodeMirror's native change event
        cmInstance.on("change", (instance) => {
          applyLiveStyle(instance.getValue());
        });

        return true;
      }

      // Fallback for standard textarea if CodeMirror hasn't initialized
      if (textarea) {
        textarea.addEventListener("input", (e) =>
          applyLiveStyle(e.target.value),
        );
        if (textarea.value) applyLiveStyle(textarea.value);
        return true;
      }

      return false;
    }

    // CodeMirror initializes asynchronously after DOM ready; poll until available
    let retries = 0;
    const interval = setInterval(() => {
      const bound = bindCodeMirror();
      retries++;

      if (bound || retries > 30) {
        clearInterval(interval);
      }
    }, 300);
  });
