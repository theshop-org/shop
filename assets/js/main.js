import Masonry from "masonry-layout";
import "bootstrap";
import * as THREE from "three";
import simpleParallax from "simple-parallax-js";
import Swiper from "swiper/bundle";
import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);
window.addEventListener("load", () => {
  const animationSettings = {
    y: "81%",
    opacity: 1,
    scrollTrigger: {
      trigger: ".scroll-animation1",
      start: "top top",
      end: "bottom bottom",
      scrub: true,
      once: true,
    },
  };

  // Function to check if an element exists
  const elementExists = (selector) => document.querySelector(selector) !== null;
  const screenWidth = window.innerWidth;

  // Apply animations directly on page load for devices below 500px
  if (screenWidth < 500) {
    // Seahorse animation on load for small devices
    if (elementExists(".seahorse")) {
      gsap.fromTo(
        ".seahorse",
        { y: "-170%", x: "-20%", opacity: 1 },
        { y: "81%", opacity: 1, duration: 1.5  }
      );
    }

    // Hippo animation on load for small devices
    if (elementExists(".hippo")) {
      gsap.fromTo(
        ".hippo",
        { y: "-95%", x: "-16%", opacity: 1 },
        { y: "112%", opacity: 1, duration: 1.5  }
      );
    }

    // Dino animation on load for small devices
    if (elementExists(".dino")) {
      gsap.fromTo(
        ".dino",
        { y: "-95%", x: "29%", opacity: 1 },
        { y: "75%", opacity: 1, duration: 1.5  }
      );
    }
  } else {
    // Animation for the seahorse image if element exists
    if (elementExists(".seahorse")) {
      const seahorseX = screenWidth <= 960 ? "-20%" : "-21%";
      gsap.fromTo(
        ".seahorse",
        { y: "-170%", x: seahorseX, opacity: 1 },
        animationSettings
      );
    }

    // Animation for the hippo image if element exists
    if (elementExists(".hippo")) {
      const hippoX = screenWidth <= 960 ? "-16%" : "-18%";
      gsap.fromTo(
        ".hippo",
        { y: "-95%", x: hippoX, opacity: 1 },
        {
          y: "112%",
          opacity: 1,
          scrollTrigger: {
            trigger: ".scroll-animation1",
            start: "top top",
            end: "bottom bottom",
            scrub: true,
            once: true,
          },
        }
      );
    }
  }

  // Animation for the dino image if element exists
  if (elementExists(".dino")) {
    const dinoElementX = screenWidth <= 960 ? "29%" : "24%";
    gsap.fromTo(
      ".dino",
      { y: "-95%", x: dinoElementX, opacity: 1 },
      {
        y: "75%",
        opacity: 1,
        scrollTrigger: {
          trigger: ".scroll-animation1",
          start: "top top",
          end: "bottom bottom",
          scrub: true,
          once: true,
        },
      }
    );
  }
});

document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("lostPasswordForm");

  if(form) {
    form.addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent the default form submission
  
      const formData = new FormData(form); // Gather form data
      formData.append("action", "custom_lost_password");
      formData.append(
        "woocommerce-lost-password-nonce",
        document.querySelector('input[name="woocommerce-lost-password-nonce"]')
          .value
      ); // Add the nonce
      jQuery.ajax({
        url: custom_script_vars.ajaxurl,
        method: "POST",
        data: formData,
        processData: false, // Prevent jQuery from automatically transforming the data into a query string
        contentType: false, // Prevent jQuery from overriding the content type header
        success: function (response) {
          if (response.success) {
            document.getElementById("modalText").textContent =
              "A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.";
          } else {
            alert(response.data);
          }
        },
        error: function (xhr, status, error) {
          alert("An error occurred. Please try again.");
        },
      });
    });
  }
  // Show password visibility hover icon on woocommerce forms
  // Wrap password inputs with a span element
  var passwordInputs = document.querySelectorAll(
    '.account__register form .input-text[type="password"]'
  );
  passwordInputs.forEach(function (input) {
    var wrapper = document.createElement("span");
    wrapper.classList.add("password-input");
    input.parentNode.insertBefore(wrapper, input);
    wrapper.appendChild(input);
  });

  // Append the visibility toggle icon
  var passwordWrappers = document.querySelectorAll(
    ".account__register form .password-input"
  );
  passwordWrappers.forEach(function (wrapper) {
    var toggleIcon = document.createElement("span");
    toggleIcon.classList.add("show-password-input");
    wrapper.appendChild(toggleIcon);
  });

  // Toggle password visibility
  document
    .querySelectorAll(".show-password-input")
    .forEach(function (toggleIcon) {
      toggleIcon.addEventListener("click", function () {
        var input = this.previousElementSibling;
        if (input.type === "password") {
          input.type = "text";
          this.classList.add("display-password");
        } else {
          input.type = "password";
          this.classList.remove("display-password");
        }
      });
    });

  var shopLogo = document.getElementById("shopLogo");
  if (shopLogo) {
    document.addEventListener("scroll", function () {
      // Calculate the middle of the viewport height
      var viewportHeight = window.innerHeight;
      var viewportMiddle = viewportHeight / 2; // Middle of the viewport

      // Get the position of the shopLogo element relative to the viewport
      var shopLogoRect = shopLogo.getBoundingClientRect();
      var shopLogoTopRelativeToViewport = shopLogoRect.top;
      var shopLogoBottomRelativeToViewport = shopLogoRect.bottom;

      // Calculate the scroll position relative to the document
      var scrollPosition = window.scrollY || window.pageYOffset;

      // Calculate the position of the shopLogo element relative to the document
      var shopLogoTopAbsolute = shopLogoRect.top + scrollPosition;

      // Determine if the shopLogo element is approximately centered in the viewport
      var isInMiddle =
        shopLogoTopRelativeToViewport <= viewportMiddle &&
        shopLogoBottomRelativeToViewport >= viewportMiddle;

      if (isInMiddle) {
        shopLogo.classList.add("animation-logo");
        setTimeout(function () {
          shopLogo.classList.add("fixed");
        }, 1300);
      }
    });
  }

  let singleColors = document.querySelectorAll(".single-colors-shop");

  if (singleColors) {
    singleColors.forEach(function (colorElement) {
      colorElement.addEventListener("click", function (e) {
        e.preventDefault();

        let colorValue = colorElement.getAttribute("data-color");
        let productId = colorElement.getAttribute("data-product-id");

        let productElement = colorElement.closest(".product");

        if (productElement) {
          productElement.setAttribute("data-selected-color", colorValue);
          productElement.setAttribute("data-product-cart", productId);
        }
      });
    });
  }

  const addToCartShop = document.querySelectorAll(".add-to-cart-shop");

  if (addToCartShop) {
    addToCartShop.forEach((btn) => {
      btn.addEventListener("click", function (e) {
        e.preventDefault();

        let productElement = btn.closest(".product");
        let productId = productElement.getAttribute("data-product-cart");
        let productLink = productElement.getAttribute("data-product-link");

        if (productId) {
          let quantity = 1;

          jQuery.ajax({
            url: custom_script_vars.ajaxurl,
            method: "POST",
            data: {
              action: "add_to_cart",
              nonce: custom_script_vars.nonce,
              productId: productId,
              quantity: parseInt(quantity),
            },
            success: function (response) {
              // Handle successful response
              console.log(response);

              document.getElementById("offcanvasCartButton").click();

              let currentCount = parseInt(jQuery("#cartCount").text());
              jQuery("#cartCount").text(currentCount + parseInt(quantity));
              let currentCountOffcanvas = parseInt(
                jQuery("#cartCountOffcanvas").text()
              );
              jQuery("#cartCountOffcanvas").text(
                currentCountOffcanvas + parseInt(quantity)
              );
            },
            error: function (xhr, status, error) {
              // Handle error
              console.error(
                "There was a problem with your AJAX request:",
                error
              );
            },
          });
        } else {
          window.location.href = productLink;
        }
      });
    });
  }

  const addToCartButtons = document.querySelectorAll(".add-to-cart-btn");

  if (addToCartButtons) {
    addToCartButtons.forEach((button) => {
      button.addEventListener("click", () => addToCart(button));
    });
  }

  function addToCart(button) {
    const productId = button.getAttribute("data-product-id");
    const quantity = button.getAttribute("data-quantity");

    // jQuery.ajax({
    //   url: custom_script_vars.ajaxurl,
    //   method: "POST",
    //   data: {
    //     action: "add_to_cart",
    //     nonce: custom_script_vars.nonce,
    //     productId: productId,
    //     quantity: parseInt(quantity),
    //   },
    //   success: function (response) {
    //     // Handle successful response
    //     console.log(response);
    //     // Add d-none class to .add-to-cart div
    //     jQuery(button).find(".add-to-cart").addClass("d-none");

    //     // Add d-block class to .added-to-cart div
    //     jQuery(button).find(".added-to-cart").addClass("d-block");

    //     let currentCount = parseInt(jQuery("#cartCount").text());
    //     jQuery("#cartCount").text(currentCount + 1);
    //   },
    //   error: function (xhr, status, error) {
    //     // Handle error
    //     console.error("There was a problem with your AJAX request:", error);
    //   },
    // });
  }

  // Menu button animation

  let overlay = document.querySelector(".main-header__overlay");
  let menuOpen = document.querySelector(".menu-open");
  let menuClose = document.querySelector(".menu-close");
  let icon = document.querySelector("#nav-icon4");
  let menuBtn = document.querySelector(".main-header__menu--btn");
  let headerCart = document.querySelector(".main-header__cart");

  if (menuBtn) {
    menuBtn.addEventListener("click", function () {
      // Toggle visibility classes
      menuOpen.classList.toggle("span-invisible");
      menuOpen.classList.toggle("span-visible");
      menuClose.classList.toggle("span-invisible");
      menuClose.classList.toggle("span-visible");

      icon.classList.toggle("open");
      overlay.classList.toggle("active");
      headerCart.classList.toggle("opacity-0");
      headerCart.classList.toggle("opacity-100");
    });
  }

  overlay.addEventListener("click", function () {
    // Toggle visibility classes
    menuOpen.classList.toggle("span-invisible");
    menuOpen.classList.toggle("span-visible");
    menuClose.classList.toggle("span-invisible");
    menuClose.classList.toggle("span-visible");

    icon.classList.toggle("open");
    overlay.classList.toggle("active");
    jQuery(".main-header__nav").collapse("hide");
  });

  // Add blur To menu items

  let mainHeaderImages = document.querySelector(".main-header__images");
  const menuItems = document.querySelectorAll(".primary-menu .menu-item");
  let loadImgSrc = "";
  function removeAllBlur() {
    menuItems.forEach(function (menuItem) {
      menuItem.classList.remove("blur-menu");
    });
  }

  function isAnyMenuItemHovered() {
    return Array.from(menuItems).some(function (menuItem) {
      return menuItem.matches(":hover");
    });
  }

  const container = document.getElementById("threejs-container");
  menuItems.forEach(function (item) {
    item.addEventListener("mouseover", function () {
      removeAllBlur();

      let menuItemID = item.getAttribute("id");
      let elementsWithMatchingID = document.querySelectorAll(
        '[data-hover-id="' + menuItemID + '"]'
      );

      loadImgSrc = elementsWithMatchingID[0].getAttribute("src");
      menuItems.forEach(function (menuItem) {
        if (menuItem !== item) {
          menuItem.classList.add("blur-menu");
        }
      });

      if (!container.classList.contains(menuItemID)) {
        // THREE JS
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, 1, 0.1, 1000); // Aspect ratio set to 1 for a square canvas

        const textureLoader = new THREE.TextureLoader();

        // Load your background image (replace with your image path)
        const texture = textureLoader.load(loadImgSrc);
        texture.wrapS = THREE.ClampToEdgeWrapping; // Prevent horizontal repetition
        texture.wrapT = THREE.ClampToEdgeWrapping; // Prevent vertical repetition

        const planeGeometry = new THREE.PlaneGeometry(4, 4);

        const vertexShader = `
  uniform float uTime;
  uniform float uAmplitude;
  uniform float uFrequency;

  varying vec2 vUv;

  void main() {
    float noise = sin(uFrequency * (vUv.x + uTime)) * sin(uFrequency * (vUv.y + uTime));
    vec3 pos = position + normal * noise * uAmplitude;
    gl_Position = projectionMatrix * modelViewMatrix * vec4(pos, 1.0);
    vUv = uv;
  }
`;

        const fragmentShader = `
  uniform sampler2D uTexture;
  uniform float uTime;
  uniform float uAmplitude;
  uniform float uFrequency;
  uniform vec3 uEmissive; // Emissive color for the glow

  varying vec2 vUv;

  void main() {
    float offset = sin(vUv.x + vUv.y) * 0.01;
    vec2 distortedUv = vUv + vec2(offset, 0.0);

    // Sample the texture with distortion
    vec4 baseColor = texture2D(uTexture, distortedUv);

    // Add a smaller noise for flickering effect
    float smallNoise = sin(uFrequency * 5.0 * (vUv.x + uTime)) * 0.005;
    distortedUv += vec2(smallNoise, 0.0);

    // Sample the texture again with additional noise for flickering
    vec4 flickerColor = texture2D(uTexture, distortedUv);

    // Combine base color with flickering and add emissive glow
    vec3 finalColor = mix(baseColor.rgb, flickerColor.rgb, 0.5) + uEmissive;

    gl_FragColor = vec4(finalColor, baseColor.a);
  }
`;

        const material = new THREE.ShaderMaterial({
          uniforms: {
            uTime: { value: 0.0 },
            uFrequency: { value: 3.0 }, // Adjust frequency for wave speed
            uTexture: { value: texture },
          },
          vertexShader,
          fragmentShader,
        });

        const plane = new THREE.Mesh(planeGeometry, material);
        scene.add(plane);

        camera.position.z = 2;

        let time = 0.0;

        const renderer = new THREE.WebGLRenderer();
        renderer.setViewport(0, 0, 400, 400);
        renderer.setSize(400, 400);

        container.appendChild(renderer.domElement);
        function animate() {
          requestAnimationFrame(animate);

          time += 0.01;

          material.uniforms.uTime.value = time;

          renderer.render(scene, camera);
        }

        animate();

        const canvas = container.querySelector("canvas:not([class])");
        if (canvas) {
          canvas.classList.add(menuItemID);
        }
      }

      container.classList.add(menuItemID);

      let canvasToShow = document.querySelectorAll(
        "canvas." + menuItemID + ", div." + menuItemID
      );

      canvasToShow.forEach(function (item) {
        item.classList.remove("d-none");
      });

      mainHeaderImages.classList.add("opacity-100");
      mainHeaderImages.classList.remove("opacity-0");
    });

    item.addEventListener("mouseleave", function () {
      if (!isAnyMenuItemHovered()) {
        removeAllBlur();
      }

      let menuItemID = item.getAttribute("id");

      let canvasToShow = document.querySelectorAll(
        "canvas." + menuItemID + ", div." + menuItemID
      );

      canvasToShow.forEach(function (item) {
        item.classList.add("d-none");
      });

      mainHeaderImages.classList.remove("opacity-100");
      mainHeaderImages.classList.add("opacity-0");
    });
  });

  // Hide preloader after 3 seconds
  let preloader = document.querySelector(".preloader");

  if (preloader) {
    setTimeout(() => preloader.classList.add("preloader-exit"), 2000);

    // Animate preloader titles after 400 milliseconds
    setTimeout(
      () =>
        document
          .querySelectorAll(".animate-preloader__title")
          .forEach((item) => (item.style.transform = "translateY(0)")),
      400
    );

    // Reverse animation of preloader titles after 2.9 seconds
    setTimeout(
      () =>
        document
          .querySelectorAll(".animate-preloader__title")
          .forEach((item) => (item.style.transform = "translateY(-100%)")),
      1900
    );
  }

  let parallaxImage = document.getElementById("parallaxImage");

  if (parallaxImage) {
    new simpleParallax(parallaxImage, {
      overflow: true,
      orientation: "down",
      maxTransition: 99,
      scale: 1.9,
    });
  }

  const singleColorElements = document.querySelectorAll(".single-colors");
  let addToCartButton = document.querySelector(".add-to-cart-single");

  if (singleColorElements) {
    singleColorElements.forEach(function (element) {
      addToCartButton.disabled = true; //disables add to cart button if color is not chosen
      element.addEventListener("click", function () {
        singleColorElements.forEach(function (el) {
          el.classList.remove("active");
        });

        element.classList.add("active");
        addToCartButton.disabled = false;

        var key = parseInt(this.getAttribute("data-key"));

        var slideIndex = key;

        var singleSlider = document.querySelector("#singleSlider");
        if (singleSlider.swiper) {
          singleSlider.swiper.slideTo(slideIndex);
        }
      });
    });
  }

  var quantityField = document.getElementById("productQuantity");

  if (quantityField) {
    // Increment quantity
    document
      .querySelector(".quantity .plus")
      .addEventListener("click", function () {
        var currentValue = parseInt(quantityField.value);
        quantityField.value = currentValue + 1;
      });

    // Decrement quantity
    document
      .querySelector(".quantity .minus")
      .addEventListener("click", function () {
        var currentValue = parseInt(quantityField.value);
        if (currentValue > 1) {
          quantityField.value = currentValue - 1;
        }
      });
  }

  // ADD TO CART SINGLE
  const addToCartButtonsSingle = document.querySelectorAll(
    ".add-to-cart-single"
  );

  addToCartButtonsSingle.forEach((button) => {
    button.addEventListener("click", () => addToCart(button));
  });

  function addToCart(button) {
    var productId = button.getAttribute("data-product-id");
    singleColorElements.forEach(function (colorLabel) {
      if (colorLabel.classList.contains("active")) {
        productId = colorLabel.getAttribute("data-product-id");
      }
    });
    const quantity = 1;

    jQuery.ajax({
      url: custom_script_vars.ajaxurl,
      method: "POST",
      data: {
        action: "add_to_cart",
        nonce: custom_script_vars.nonce,
        productId: productId,
        quantity: parseInt(quantity),
      },
      success: function (response) {
        // Handle successful response
        console.log(response);

        document.getElementById("offcanvasCartButton").click();

        let currentCount = parseInt(jQuery("#cartCount").text());
        jQuery("#cartCount").text(currentCount + parseInt(quantity));
        let currentCountOffcanvas = parseInt(
          jQuery("#cartCountOffcanvas").text()
        );
        jQuery("#cartCountOffcanvas").text(
          currentCountOffcanvas + parseInt(quantity)
        );
      },
      error: function (xhr, status, error) {
        // Handle error
        console.error("There was a problem with your AJAX request:", error);
      },
    });
  }

  const singleSlider = document.getElementById("singleSlider");

  if (singleSlider) {
    var swiper = new Swiper("#singleSlider", {
      slidesPerView: 1,
      loop: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  }

  // CART
  function updateOffcanvasCart(cartItems) {
    var offcanvasBody = document.getElementById("offcanvasBody");
    offcanvasBody.innerHTML = "";

    // Iterate over the cart items and create HTML for each item
    cartItems.forEach(function (item) {
      // Create a new div element for the cart item
      var cartItemDiv = document.createElement("div");
      cartItemDiv.className = "cart-item"; // Set class name
      let nameParts = item.product_name.split(" - ");
      let productName = nameParts[0];
      let productCode = nameParts.length > 1 ? nameParts[1] : ""; // Check if there is a part after " - "

      var cartItemDiv = document.createElement("div");
      cartItemDiv.className = "cart-item"; // Set class name

      // Construct the inner HTML content for the cart item
      var innerHTML =
        '<div class="product-thumbnail"><img src="' +
        item.image_url +
        '" alt="' +
        item.product_name +
        '"></div>' +
        '<div class="product-info">' +
        '<div class="product-name-price">' +
        '<div class="product-name">' +
        productName +
        "</div>" +
        '<div class="product-price">' +
        item.price +
        "</div>";

      // Conditionally add the product code and description if it's a variable product
      if (item.is_variable === "variation") {
        innerHTML +=
          '<div class="product-code">' +
          '<span style="background-color:' +
          productCode +
          '"></span>' +
          item.description +
          "</div>";
      }

      innerHTML +=
        "</div>" +
        '<div class="product-quantity-remove">' +
        '<div class="product-quantity">' +
        '<button class="quantity-decrease">-</button>' +
        '<input type="number" class="quantity" value="' +
        item.quantity +
        '" min="1" data-product-id="' +
        item.product_id +
        '" data-prev-quantity="' +
        item.quantity +
        '">' +
        '<button class="quantity-increase">+</button>' +
        "</div>" +
        '<button class="remove-item">Remove</button>' +
        "</div>" +
        "</div>";

      // Set the innerHTML of the cart item div
      cartItemDiv.innerHTML = innerHTML;

      // Append the cart item div to the offcanvas body
      offcanvasBody.appendChild(cartItemDiv);
    });

    // Add event listeners for quantity buttons
    offcanvasBody
      .querySelectorAll(".quantity-decrease")
      .forEach(function (button) {
        button.addEventListener("click", function () {
          var input = this.nextElementSibling;
          var prevQuantity = parseInt(input.getAttribute("data-prev-quantity"));
          if (input.value > 1) {
            input.value = parseInt(input.value) - 1;
            updateCartQuantity(input, prevQuantity);
          } else if (input.value == 1) {
            input.value = 0;
            updateCartQuantity(input, prevQuantity);
          }
        });
      });

    offcanvasBody
      .querySelectorAll(".quantity-increase")
      .forEach(function (button) {
        button.addEventListener("click", function () {
          var input = this.previousElementSibling;
          var prevQuantity = parseInt(input.getAttribute("data-prev-quantity"));
          input.value = parseInt(input.value) + 1;
          updateCartQuantity(input, prevQuantity);
        });
      });

    offcanvasBody.querySelectorAll(".quantity").forEach(function (input) {
      input.addEventListener("change", function () {
        if (input.value < 1) input.value = 0;
        var prevQuantity = parseInt(input.getAttribute("data-prev-quantity"));
        updateCartQuantity(input, prevQuantity);
      });
    });

    // Add event listeners for remove buttons
    offcanvasBody.querySelectorAll(".remove-item").forEach(function (button) {
      button.addEventListener("click", function () {
        var input = this.previousElementSibling.querySelector(".quantity");
        var productId = input.getAttribute("data-product-id");
        removeCartItem(productId, input.closest(".cart-item"));
      });
    });

    fetchCartTotal();
  }

  function updateCartQuantity(input, prevQuantity) {
    var quantity = parseInt(input.value);
    var productId = input.getAttribute("data-product-id");

    // Determine the action based on the new quantity
    var action = quantity > 0 ? "update_cart_quantity" : "remove_cart_item";

    // Update or remove WooCommerce cart item via AJAX
    jQuery.ajax({
      url: custom_script_vars.ajaxurl,
      type: "post",
      data: {
        action: action,
        product_id: productId,
        quantity: quantity,
      },
      success: function (response) {
        console.log(response);

        let currentCount = parseInt(jQuery("#cartCount").text());
        let currentCountOffcanvas = parseInt(
          jQuery("#cartCountOffcanvas").text()
        );

        if (quantity > prevQuantity) {
          jQuery("#cartCount").text(currentCount + 1);
          jQuery("#cartCountOffcanvas").text(currentCountOffcanvas + 1);
        } else if (quantity < prevQuantity) {
          jQuery("#cartCount").text(currentCount - 1);
          jQuery("#cartCountOffcanvas").text(currentCountOffcanvas - 1);
        }

        // Remove item from DOM if quantity is 0
        if (quantity === 0) {
          input.closest(".cart-item").remove();
        }

        // Update the previous quantity attribute
        input.setAttribute("data-prev-quantity", quantity);
        checkCartEmpty();

        fetchCartTotal();
      },
    });
  }

  function removeCartItem(productId, cartItemElement) {
    // Remove WooCommerce cart item via AJAX
    jQuery.ajax({
      url: custom_script_vars.ajaxurl,
      type: "post",
      data: {
        action: "remove_cart_item",
        product_id: productId,
      },
      success: function (response) {
        console.log(response);

        // Remove the cart item element from the DOM
        cartItemElement.remove();

        let currentCount = parseInt(jQuery("#cartCount").text());
        let currentCountOffcanvas = parseInt(
          jQuery("#cartCountOffcanvas").text()
        );

        // Update cart counts based on the quantity of the removed item
        let removedQuantity = parseInt(response.removed_quantity);
        jQuery("#cartCount").text(currentCount - removedQuantity);
        jQuery("#cartCountOffcanvas").text(
          currentCountOffcanvas - removedQuantity
        );
        checkCartEmpty();

        fetchCartTotal();
      },
    });
  }

  var offcanvasCartButton = document.getElementById("offcanvasCartButton");

  if (offcanvasCartButton) {
    offcanvasCartButton.addEventListener("click", function () {
      // Fetch WooCommerce cart items via AJAX
      jQuery.ajax({
        url: custom_script_vars.ajaxurl,
        type: "post",
        data: {
          action: "get_cart_contents", // PHP function to retrieve cart items
        },
        success: function (response) {
          console.log(response);
          updateOffcanvasCart(response);
          checkCartEmpty();

          fetchCartTotal();
        },
      });
    });
  }

  // Function to check if the cart is empty
  function checkCartEmpty() {
    // Fetch cart contents via AJAX
    jQuery.ajax({
      url: custom_script_vars.ajaxurl,
      type: "post",
      data: {
        action: "get_cart_contents",
      },
      success: function (response) {
        const postCardOption = document.querySelector(".post-card");
        if (response.length === 0) {
          document.getElementById("checkoutEmpty").classList.add("d-block");
          document.getElementById("checkoutEmpty").classList.remove("d-none");
          document.getElementById("checkoutOff").classList.add("d-none");
          document.getElementById("checkoutOff").classList.remove("d-block");
          if (postCardOption) {
            postCardOption.classList.add("d-none");
            postCardOption.classList.remove("d-block");
          }
        } else {
          document.getElementById("checkoutEmpty").classList.remove("d-block");
          document.getElementById("checkoutEmpty").classList.add("d-none");
          document.getElementById("checkoutOff").classList.remove("d-none");
          document.getElementById("checkoutOff").classList.add("d-block");
          if (postCardOption) {
            postCardOption.classList.remove("d-none");
            postCardOption.classList.add("d-block");
          }
        }
      },
    });
  }

  function fetchCartTotal() {
    // Make an AJAX request to fetch the cart total
    jQuery.ajax({
      type: "POST",
      url: custom_script_vars.ajaxurl, // WooCommerce AJAX URL
      data: {
        action: "get_cart_total", // Action to get cart total
      },
      success: function (response) {
        // Update the span element with the cart total
        document.getElementById("checkoutPrice").innerHTML = response;
      },
    });
  }

  // Call the function to fetch cart total
  fetchCartTotal();

  // Get all grid-style elements
  var gridStyles = document.querySelectorAll(".grid-style");

  // Get the products-grid element
  var productsGrid = document.querySelector(".shop-page");

  // Add click event listener to each grid-style element
  gridStyles.forEach(function (gridStyle) {
    gridStyle.addEventListener("click", function () {
      // Remove active class from all grid-style elements
      gridStyles.forEach(function (item) {
        item.classList.remove("active");
      });

      // Add active class to the clicked grid-style element
      gridStyle.classList.add("active");

      // Update the class of the shop-page element
      productsGrid.className = "shop-page " + gridStyle.id;
    });
  });

  // const searchInput = document.querySelector(
  //   '.woocommerce-product-search input[type="search"]'
  // );
  // const searchResults = document.querySelector(".search-results-wrapper");

  // searchInput.addEventListener("input", function () {
  //   const searchQuery = this.value;

  //   // Abort previous request if any
  //   if (this.previousSearchXHR) {
  //     this.previousSearchXHR.abort();
  //   }

  //   // Send AJAX request
  //   this.previousSearchXHR = new XMLHttpRequest();
  //   this.previousSearchXHR.open("POST", custom_script_vars.ajaxurl);
  //   this.previousSearchXHR.setRequestHeader(
  //     "Content-Type",
  //     "application/x-www-form-urlencoded"
  //   );
  //   this.previousSearchXHR.onload = function () {
  //     if (this.status >= 200 && this.status < 300) {
  //       searchResults.innerHTML = this.responseText;
  //     }
  //   };
  //   this.previousSearchXHR.send(
  //     "action=live_search&search_query=" + encodeURIComponent(searchQuery)
  //   );
  // });

  // Select all search input elements within .woocommerce-product-search
  const searchInputs = document.querySelectorAll(
    '.woocommerce-product-search input[type="search"]'
  );

  // Loop through each search input element
  searchInputs.forEach(function (searchInput) {
    searchInput.addEventListener("input", function () {
      const searchQuery = this.value;

      // Find the closest .search-results-wrapper that is a sibling to the current input
      const searchResults = this.closest(".offcanvas-body").querySelector(
        ".search-results-wrapper"
      );

      // Abort previous request if any
      if (this.previousSearchXHR) {
        this.previousSearchXHR.abort();
      }

      // Send AJAX request
      this.previousSearchXHR = new XMLHttpRequest();
      this.previousSearchXHR.open("POST", custom_script_vars.ajaxurl);
      this.previousSearchXHR.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
      );
      this.previousSearchXHR.onload = function () {
        if (this.status >= 200 && this.status < 300) {
          if (searchResults) {
            searchResults.innerHTML = this.responseText;
          }
        }
      };
      this.previousSearchXHR.send(
        "action=live_search&search_query=" + encodeURIComponent(searchQuery)
      );
    });
  });

  const inputs = document.querySelectorAll("input");

  inputs.forEach(function (input) {
    const label = document.querySelector(
      `label[for="${input.getAttribute("id")}"]`
    );

    if (label) {
      if (input.value !== "") {
        label.classList.add("focused");
      }
      input.addEventListener("focus", function () {
        label.classList.add("focused");
      });

      input.addEventListener("blur", function () {
        if (input.value === "") {
          label.classList.remove("focused");
        }
      });
    }
  });

  var textarea = document.getElementById("postCardMessage");
  var counter = document.getElementById("characterCount");
  var saveButton = document.getElementById("saveMessageButton");

  saveButton.addEventListener("click", function () {
    var message = document.getElementById("postCardMessage").value;
    if (message) {
      saveMessageToOrder(message);
    }
  });
  // Update character count on input
  textarea.addEventListener("input", function () {
    var currentLength = textarea.value.length;
    counter.textContent = currentLength + "/435 characters";

    if (currentLength > 0) {
      saveButton.removeAttribute("disabled");
    } else {
      saveButton.setAttribute("disabled", "disabled");
    }
  });

  // Example JavaScript function to save message and price
  function saveMessageToOrder(msg) {
    console.log(msg);
    var price = 10; // Example price, adjust as needed

    // Make AJAX request to save data to order
    var data = {
      action: "save_message_to_order",
      message: msg,
      price: price,
    };

    jQuery.post(wc_add_to_cart_params.ajax_url, data, function (response) {
      console.log("Message saved to order:", response);
      // Optionally, update UI or show confirmation message
    });
  }
});

//hide form after subscribe

document.addEventListener(
  "wpcf7mailsent",
  function (event) {
    var form = document.querySelector(".wpcf7-form");
    var message = event.detail.apiResponse.message;
    if (form) {
      form.style.display = "none ";
      var successMessage = document.createElement("div");
      successMessage.className = "subscribe-success-message";
      successMessage.innerHTML = message;
      form.parentNode.appendChild(successMessage);
    }
  },
  false
);

//postcard random images

document.addEventListener("DOMContentLoaded", function () {
  // Select both images
  var firstImage = document.querySelector(".postcard-first-image");
  var secondImage = document.querySelector(".postcard-second-image");

  // Randomly decide which one to show
  if (Math.random() < 0.5) {
    firstImage.style.display = "block";
    secondImage.style.display = "none";
  } else {
    firstImage.style.display = "none";
    secondImage.style.display = "block";
  }
});
