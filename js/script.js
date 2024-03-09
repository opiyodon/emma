/* ====================================================================================================================
================================   TOGGLE SIDEBAR   ================================================================
==================================================================================================================== */
document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");
  const menuButton = document.querySelector(".menu-button");
  const menuIcon = document.querySelector(".menu-icon");
  const menuButtonSmall = document.querySelector(".menu-button-small");
  const logoSection = document.querySelector(".logo-section");
  const sidebarText = document.querySelectorAll(".sidebarText");
  const aboutContainer = document.getElementById("aboutContainer");

  menuButton.addEventListener("click", function () {
    if (sidebar.classList.contains("sidebarOpen")) {
      sidebar.classList.remove("sidebarOpen");
      sidebar.classList.add("sidebarClose");
      localStorage.setItem("SIDEBARSTATE", "SideBarClose");
      logoSection.style.display = "none";
      aboutContainer.style.display = "none";
      sidebarText.forEach(function (element) {
        element.style.display = "none";
      });
      menuIcon.style.transform = "rotate(360deg)";
      if (menuIcon.classList.contains("fa-xmark")) {
        menuIcon.classList.remove("fa-xmark");
        menuIcon.classList.add("fa-bars-staggered");
      } else {
        menuIcon.classList.remove("fa-bars-staggered");
        menuIcon.classList.add("fa-xmark");
      }
      // Show menuButtonSmall only on mobile
      if (window.innerWidth <= 768) {
        menuButtonSmall.style.display = "flex";
      } else {
        menuButtonSmall.style.display = "none";
      }
      menuButtonSmall.addEventListener("click", function () {
        sidebar.classList.add("sidebarOpen");
        sidebar.classList.remove("sidebarClose");
        localStorage.setItem("SIDEBARSTATE", "SideBarOpen");
        logoSection.style.display = "flex";
        aboutContainer.style.display = "flex";
        sidebarText.forEach(function (element) {
          element.style.display = "flex";
        });
        menuIcon.style.transform = "rotate(-360deg)";
        if (menuIcon.classList.contains("fa-bars-staggered")) {
          menuIcon.classList.remove("fa-bars-staggered");
          menuIcon.classList.add("fa-xmark");
        } else {
          menuIcon.classList.remove("fa-xmark");
          menuIcon.classList.add("fa-bars-staggered");
        }
        menuButtonSmall.style.display = "none";
      });
    } else {
      sidebar.classList.add("sidebarOpen");
      sidebar.classList.remove("sidebarClose");
      localStorage.setItem("SIDEBARSTATE", "SideBarOpen");
      logoSection.style.display = "flex";
      aboutContainer.style.display = "flex";
      sidebarText.forEach(function (element) {
        element.style.display = "flex";
      });
      menuIcon.style.transform = "rotate(-360deg)";
      if (menuIcon.classList.contains("fa-bars-staggered")) {
        menuIcon.classList.remove("fa-bars-staggered");
        menuIcon.classList.add("fa-xmark");
      } else {
        menuIcon.classList.remove("fa-xmark");
        menuIcon.classList.add("fa-bars-staggered");
      }
      // Show menuButtonSmall only on mobile
      if (window.innerWidth <= 768) {
        menuButtonSmall.style.display = "none";
      } else {
        menuButtonSmall.style.display = "none";
      }
    }
  });

  // Check and apply the initial state based on local storage
  const initialState = localStorage.getItem("SIDEBARSTATE") || "SideBarClose";
  if (initialState === "SideBarOpen") {
    sidebar.classList.add("sidebarOpen");
    sidebar.classList.remove("sidebarClose");
    logoSection.style.display = "flex";
    aboutContainer.style.display = "flex";
    sidebarText.forEach(function (element) {
      element.style.display = "flex";
    });
    menuIcon.style.transform = "rotate(-360deg)";
    if (menuIcon.classList.contains("fa-bars-staggered")) {
      menuIcon.classList.remove("fa-bars-staggered");
      menuIcon.classList.add("fa-xmark");
    } else {
      menuIcon.classList.remove("fa-xmark");
      menuIcon.classList.add("fa-bars-staggered");
    }
    // Show menuButtonSmall only on mobile
    if (window.innerWidth <= 768) {
      menuButtonSmall.style.display = "none";
    } else {
      menuButtonSmall.style.display = "none";
    }
  } else if (initialState === "SideBarClose") {
    sidebar.classList.remove("sidebarOpen");
    sidebar.classList.add("sidebarClose");
    logoSection.style.display = "none";
    aboutContainer.style.display = "none";
    sidebarText.forEach(function (element) {
      element.style.display = "none";
    });
    menuIcon.style.transform = "rotate(360deg)";
    if (menuIcon.classList.contains("fa-xmark")) {
      menuIcon.classList.remove("fa-xmark");
      menuIcon.classList.add("fa-bars-staggered");
    } else {
      menuIcon.classList.remove("fa-bars-staggered");
      menuIcon.classList.add("fa-xmark");
    }
    // Show menuButtonSmall only on mobile
    if (window.innerWidth <= 768) {
      menuButtonSmall.style.display = "flex";
    } else {
      menuButtonSmall.style.display = "none";
    }
    menuButtonSmall.addEventListener("click", function () {
      sidebar.classList.add("sidebarOpen");
      sidebar.classList.remove("sidebarClose");
      logoSection.style.display = "flex";
      aboutContainer.style.display = "flex";
      sidebarText.forEach(function (element) {
        element.style.display = "flex";
      });
      menuIcon.style.transform = "rotate(-360deg)";
      if (menuIcon.classList.contains("fa-bars-staggered")) {
        menuIcon.classList.remove("fa-bars-staggered");
        menuIcon.classList.add("fa-xmark");
      } else {
        menuIcon.classList.remove("fa-xmark");
        menuIcon.classList.add("fa-bars-staggered");
      }
      menuButtonSmall.style.display = "none";
    });
  }
});

/* ====================================================================================================================
================================   LIGHT MODE | DARK MODE   ================================================================
==================================================================================================================== */
document.addEventListener("DOMContentLoaded", function () {
  const themeToggleButton = document.getElementById("theme-toggle-button");
  const themeIcon = document.getElementById("theme-icon");
  const themeText = document.getElementById("theme-text");

  // Theme toggle logic
  themeToggleButton.addEventListener("click", function () {
    const body = document.body;
    if (body.classList.contains("DARK")) {
      body.classList.remove("DARK");
      localStorage.setItem("DARK_MODE", "LIGHT");
      // Update icon and text for light mode
      themeIcon.classList.remove("fa-sun");
      themeIcon.classList.add("fa-moon");
      themeText.textContent = "Dark Mode";
    } else {
      body.classList.add("DARK");
      localStorage.setItem("DARK_MODE", "DARK");
      // Update icon and text for dark mode
      themeIcon.classList.remove("fa-moon");
      themeIcon.classList.add("fa-sun");
      themeText.textContent = "Light Mode";
    }
  });

  // Check and apply the initial theme based on local storage
  const initialTheme = localStorage.getItem("DARK_MODE") || "LIGHT";
  if (initialTheme === "DARK") {
    document.body.classList.add("DARK");
    // Set initial icon and text for dark mode
    themeIcon.classList.remove("fa-moon");
    themeIcon.classList.add("fa-sun");
    themeText.textContent = "Light Mode";
  } else if (initialTheme === "LIGHT") {
    document.body.classList.remove("DARK");
    // Set initial icon and text for light mode
    themeIcon.classList.remove("fa-sun");
    themeIcon.classList.add("fa-moon");
    themeText.textContent = "Dark Mode";
  }
});

/* ====================================================================================================================
================================   MODAL   ================================================================
==================================================================================================================== */
document.addEventListener("DOMContentLoaded", function () {
  const modalToggle = document.getElementById("modalToggle");
  const modal = document.getElementById("modal");
  const modalClose = document.getElementById("modalClose");

  modalToggle.addEventListener("click", function () {
    if (modal.classList.contains("modalClose")) {
      modal.classList.remove("modalClose");
      modal.classList.add("modalOpen");
    }
  });

  modalClose.addEventListener("click", function () {
    if (modal.classList.contains("modalOpen")) {
      modal.classList.remove("modalOpen");
      modal.classList.add("modalClose");
    }
  });
});

/* ====================================================================================================================
================================   MODAL CHANGE PROFILE   ======================================================
==================================================================================================================== */
var profileImgBox = document.querySelector(".profileImgBox");
var profileOverlay = document.querySelector(".profile-overlay");

// Add the 'profile-overlay-active' class on mouseover
profileImgBox.addEventListener("mouseover", function () {
  profileOverlay.classList.add("profile-overlay-active");
});

// Remove the 'profile-overlay-active' class on mouseout
profileImgBox.addEventListener("mouseout", function () {
  profileOverlay.classList.remove("profile-overlay-active");
});

/* ====================================================================================================================
================================   CHAT VIEW   ================================================================
==================================================================================================================== */
// Function to add chat history date
function addChatHistoryDate(date) {
  const chatHistoryDates = document.querySelectorAll(".chat-history-date");
  const chatHistoryDate = chatHistoryDates[chatHistoryDates.length - 1];
  const formattedDate = formatDateWithoutTime(new Date(date)); // Format the date without time
  const chatHistoryDateHTML = `
    <p class="chat-history-title">${formattedDate}</p>
  `;
  chatHistoryDate.innerHTML = chatHistoryDateHTML;
}

// Function to format the date without time
function formatDateWithoutTime(date) {
  const now = new Date();
  const messageDate = new Date(date);
  const diffTime = now - messageDate;
  const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
  if (diffDays === 0) {
    return "Today";
  } else if (diffDays === 1) {
    return "Yesterday";
  } else {
    return messageDate.toLocaleDateString("en-US", {
      year: "numeric",
      month: "2-digit",
      day: "2-digit",
    });
  }
}

// Function to format the date with time
function formatTimeStamp(date) {
  const now = new Date();
  const messageDate = new Date(date);
  const diffTime = now - messageDate;
  const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
  if (diffDays === 0) {
    return `Today at ${messageDate.toLocaleTimeString([], {
      hour: "2-digit",
      minute: "2-digit",
    })}`;
  } else if (diffDays === 1) {
    return `Yesterday at ${messageDate.toLocaleTimeString([], {
      hour: "2-digit",
      minute: "2-digit",
    })}`;
  } else {
    return `${messageDate.toLocaleDateString("en-US", {
      weekday: "long",
      year: "numeric",
      month: "long",
      day: "numeric",
    })} at ${messageDate.toLocaleTimeString([], {
      hour: "2-digit",
      minute: "2-digit",
    })}`;
  }
}

// Function to generate user message HTML
function generateUserMessageHTML(userMessage, timeStamp, userProfile) {
  return `
    <div class="message-user">
    <div class="message-content-user">
        <div class="message-title-box">
            <p class="message-title">You</p>
        </div>
        <div class="message-row">
            <p>${userMessage}</p>
            <div class="time-stamp-user">${timeStamp}</div>
        </div>
    </div>
    <div class="avatar">
        ${userProfile !== ""
      ? `<img src="img/userProfile/${userProfile}" alt="User Image" class="avatar-img" />`
      : `
        <div class='ERROR'>Image Not Added</div>`
    }
    </div>
</div>
  `;
}

// Function to generate chatbot message HTML
function generateChatbotMessageHTML(chatbotMessage, chatbotTimeStamp) {
  return `
    <div class="message-chatbot">
            <div class="avatar">
              <img
                class="avatar-img"
                src="img/emma.jpg"
                alt="Chatbot Avatar" />
            </div>
            <div class="message-content-chatbot">
              <div class="message-title-box">
                <p class="message-title">E.m.m.a</p>
              </div>
              <div class="message-row">
                <p>${chatbotMessage}</p>
                <div class="time-stamp-chatbot">${chatbotTimeStamp}</div>
              </div>
            </div>
          </div>
  `;
}

/* ====================================================================================================================
================================   ADD EMOJI TO MESSAGE   ================================================================
==================================================================================================================== */
document.addEventListener("DOMContentLoaded", function () {
  const emojiButton = document.getElementById("emoji-button");
  const modal = document.getElementById("emoji-modal");
  const closeButton = document.getElementById("emoji-modalClose");
  const messageInput = document.getElementById("message-input");
  const chatWrapper = document.getElementById("chat-wrapper");

  let cursorPosition;

  emojiButton.addEventListener("click", function (event) {
    event.preventDefault();
    cursorPosition = messageInput.selectionStart;
    if (modal.classList.contains("emoji-modalOpen")) {
      modal.classList.remove("emoji-modalOpen");
    }
    else {
      modal.classList.add("emoji-modalOpen");
    }
  });

  // Close modal when pressing the Close Button
  closeButton.addEventListener("click", function () {
    modal.classList.remove("emoji-modalOpen");
    messageInput.focus();
    messageInput.setSelectionRange(cursorPosition, cursorPosition);
  });

  // Close modal when pressing input button
  messageInput.addEventListener("click", function () {
    modal.classList.remove("emoji-modalOpen");
    messageInput.focus();
  });

  // Close modal when pressing chat wrapper
  chatWrapper.addEventListener("click", function () {
    modal.classList.remove("emoji-modalOpen");
  });

  // Close modal when pressing the Enter key
  window.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      modal.classList.remove("emoji-modalOpen");
      messageInput.focus();
      messageInput.setSelectionRange(cursorPosition, cursorPosition);
    }
  });

  // Generate emoji icons and add click event listeners to them
  const emojiList = [
    "😀", "😃", "😄", "😁", "😆", "😅", "😂", "🤣", "😊", "😇", "🙂", "🙃", "😉", "😌", "😍", "🥰", "😘", "😗", "😙", "😚", "😋", "😛", "😝", "😜", "🤪", "🤨", "🧐", "🤓", "😎", "🤩", "🥳", "😏", "😒", "😞", "😔", "😟", "😕", "🙁", "😣", "😖", "😫", "😩", "🥺", "😢", "😭", "😤", "😠", "😡", "🤬", "🤯", "😳", "🥵", "🥶", "😱", "😨", "😰", "😥", "😓", "🤗", "🤔", "🤭", "🤫", "🤥", "😶", "😐", "😑", "😬", "🙄", "😯", "😦", "😧", "😮", "😲", "🥱", "😴", "🤤", "😪", "😵", "🤐", "🥴", "🤢", "🤮", "🤧", "😷", "🤒", "🤕", "🤑", "🤠", "😈", "👿", "👹", "👺", "🤡", "💩", "👻", "💀", "☠️", "👽", "👾", "🤖", "🎃", "😺", "😸", "😹", "😻", "😼", "😽", "🙀", "😿", "😾", "🙈", "🙉", "🙊", "🐵", "🐒", "🦍", "🦧", "🐶", "🐕", "🦮", "🐕‍🦺", "🐩", "🐺", "🦊", "🦝", "🐱", "🐈", "🦁", "🐯", "🐅", "🐆", "🐴", "🐎", "🦄", "🦓", "🦌", "🐮", "🐂", "🐃", "🐄", "🐷", "🐖", "🐗", "🐽", "🐏", "🐑", "🐐", "🐪", "🐫", "🦙", "🦒", "🐘", "🦏", "🦛", "🐭", "🐁", "🐀", "🐹", "🐰", "🐇", "🐿️", "🦔", "🦇", "🐻", "🐻‍❄️", "🐨", "🐼", "🦥", "🦨", "🦘", "🦡", "🐾", "🦃", "🐔", "🐓", "🐣", "🐤", "🐥", "🐦", "🐧", "🕊️", "🦅", "🦆", "🦢", "🦉", "🦩", "🦚", "🦜", "🐸", "🐊", "🐢", "🦎", "🐍", "🐲", "🐉", "🦕", "🦖", "🐳", "🐋", "🐬", "🐟", "🐠", "🐡", "🦀", "🦞", "🦐", "🦑", "🐙", "🦧", "🐌", "🦋", "🐛", "🐜", "🐝", "🐞", "🦗", "🕷️", "🕸️", "🦂", "🦟", "🦠", "💐", "🌸", "💮", "🏵️", "🌹", "🥀", "🌺", "🌻", "🌼", "🌷", "🌱", "🌲", "🌳", "🌴", "🌵", "🌾", "🌿", "☘️", "🍀", "🍁", "🍂", "🍃", "🍇", "🍈", "🍉", "🍊", "🍋", "🍌", "🍍", "🥭", "🍎", "🍏", "🍐", "🍑", "🍒", "🍓", "🥝", "🍅", "🥥", "🥑", "🍆", "🥔", "🥕", "🌽", "🌶️", "🥒", "🥬", "🥦", "🧄", "🧅", "🍄", "🥜", "🌰", "🍞", "🥐", "🥖", "🥨", "🥯", "🥞", "🧇", "🧀", "🍖", "🍗", "🥩", "🥓", "🍔", "🍟", "🍕", "🌭", "🥪", "🌮", "🌯", "🥙", "🧆", "🥚", "🍳", "🥘", "🍲", "🫕", "🥣", "🥗", "🍿", "🧈", "🧂", "🥫", "🍱", "🍘", "🍙", "🍚", "🍛", "🍜", "🍝", "🍠", "🍢", "🍣", "🍤", "🍥", "🥮", "🍡", "🥟", "🥠", "🥡", "🦀", "🦞", "🦐", "🦑", "🍦", "🍧", "🍨", "🍩", "🍪", "🎂", "🍰", "🧁", "🥧", "🍫", "🍬", "🍭", "🍮", "🍯", "🍼", "🥛", "☕", "🍵", "🍶", "🍾", "🍷", "🍸", "🍹", "🍺", "🍻", "🥂", "🥃", "🥤", "🧃", "🧉", "🧊", "🥢", "🍽️", "🍴", "🥄", "🔪", "🏺", "🌍", "🌎", "🌏", "🌐", "🗺️", "🗾", "🧭", "🏔️", "⛰️", "🌋", "🗻", "🏕️", "🏖️", "🏜️", "🏝️", "🏞️", "🏟️", "🏛️", "🏗️", "🧱", "🏘️", "🏚️", "🏠", "🏡", "🏢"
  ]


  const modalContent = document.querySelector(".emoji-modal-content");

  emojiList.forEach((emoji) => {
    const emojiButtonIcon = document.createElement("button");
    emojiButtonIcon.textContent = emoji;
    emojiButtonIcon.classList.add("emoji");
    emojiButtonIcon.addEventListener("click", function () {
      const textBeforeCursor = messageInput.value.substring(0, cursorPosition);
      const textAfterCursor = messageInput.value.substring(cursorPosition);
      messageInput.value = textBeforeCursor + emoji + textAfterCursor;
      messageInput.focus();
      cursorPosition += emoji.length;
      messageInput.setSelectionRange(cursorPosition, cursorPosition);
      modal.classList.add("emoji-modalOpen");
    });
    modalContent.appendChild(emojiButtonIcon);
  });
});

/* ====================================================================================================================
================================   Function to send a message   ======================================================
==================================================================================================================== */
// Function to send a message
function sendMessage(event) {
  event.preventDefault();
  const messageInput = document.getElementById("message-input").value.trim();

  // Check if message is not empty
  if (messageInput !== "") {
    // Clear input field
    document.getElementById("message-input").value = "";

    // Get the current timestamp
    const timestamp = new Date().toISOString(); // Use ISO string for accurate timestamp

    // Check if there are existing message boxes
    const messageBoxes = document.querySelectorAll(".message-box");
    let messageBox;

    // If there are no existing message boxes, create a new one
    if (messageBoxes.length === 0) {
      const chatWrapper = document.getElementById("chat-wrapper");
      messageBox = document.createElement("div");
      messageBox.className = "message-box";
      chatWrapper.appendChild(messageBox);
    } else {
      // If there are existing message boxes, use the last one
      messageBox = messageBoxes[messageBoxes.length - 1];
    }

    // Add user message to chat history
    addChatToUI(messageInput, true, timestamp, messageBox, userProfile);

    // Update local storage with new chat history
    const newChatHistory =
      JSON.parse(localStorage.getItem("chatHistory")) || [];
    newChatHistory.push({
      message: messageInput,
      timeStamp: timestamp,
      isUser: true,
    });
    localStorage.setItem("chatHistory", JSON.stringify(newChatHistory));

    // Send message to Flask backend
    fetch("http://localhost:8000/get-response", {
      method: "POST",
      headers: {
        "Content-Type": "application/json;charset=utf-8",
      },
      body: JSON.stringify({ message: messageInput }),
    })
      .then((response) => response.json())
      .then((data) => {
        // Hide the message loading dots container
        document
          .querySelectorAll(".message-loading-dots")
          .forEach((dotsContainer) => {
            dotsContainer.style.display = "none";
          });

        // Handle response from Flask backend (data contains chatbot's response)
        const chatbotMessage = data.response;
        const chatbotTimeStamp = formatTimeStamp(new Date());

        // Generate HTML for chatbot message
        const chatbotMessageHTML = generateChatbotMessageHTML(
          chatbotMessage,
          chatbotTimeStamp
        );

        // Update UI with chatbot's response
        messageBox.insertAdjacentHTML("beforeend", chatbotMessageHTML);

        // Scroll to the bottom of the message container after chatbot's response
        const chatWrapper = document.getElementById('chat-wrapper');
        chatWrapper.scrollTop = chatWrapper.scrollHeight;
        messageBox.scrollTop = messageBox.scrollHeight;

        // Save messages to database via PHP
        saveToDatabase(messageInput, chatbotMessage); // Passing chatbot's response here
      })
      .catch((error) => console.error("Error:", error));
  }
}

// Function to load chat history from PHP
function loadChatHistoryFromPHP() {
  const userProfile = userProfile;

  fetch("loadChatHistory.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ userProfile: userProfile })
  })
    .then(response => response.text())
    .then(data => {
      // Replace message-box content with loaded chat history
      document.getElementById("message-box").outerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}



// ADD CHAT TO UI
function addChatToUI(/*chatHistoryDate, */message, isUser, timestamp, messageBox, userProfile) {
  const timeStamp = formatTimeStamp(new Date(timestamp));

  // Append the chat history date to the message container
  //messageBox.append(chatHistoryDate);

  // Generate HTML for the message
  const messageHTML = isUser
    ? generateUserMessageHTML(message, timeStamp, userProfile)
    : generateChatbotMessageHTML(message, timeStamp);

  // Append the message to the message container
  messageBox.insertAdjacentHTML("beforeend", messageHTML);

  // Scroll to the bottom of the message container
  const chatWrapper = document.getElementById('chat-wrapper');
  chatWrapper.scrollTop = chatWrapper.scrollHeight;
  messageBox.scrollTop = messageBox.scrollHeight;

  // ==============LOADING DOTS============
  // Add loading dots while waiting for the response from fake API
  const loadingDotsHTML = `<div class="message-loading-dots">
            <div class="avatar-loading-dots">
              <img
                class="avatar-img"
                src="img/emma.jpg"
                alt="Chatbot Avatar" />
            </div>
            <div class="message-content-loading-dots">
              <div class="message-row">
                <div class="loading-dots">
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
              </div>
            </div>
          </div>`;
  messageBox.insertAdjacentHTML("beforeend", loadingDotsHTML);

  // Scroll to the bottom of the message container after adding loading dots
  chatWrapper.scrollTop = chatWrapper.scrollHeight;
  messageBox.scrollTop = messageBox.scrollHeight;

  // Load chat history from PHP after adding new message
  loadChatHistoryFromPHP();
}

// Function to save messages to the database via PHP
function saveToDatabase(userMessage, chatbotResponse) {
  // Send messages to PHP to save to database
  const formData = new FormData();
  formData.append('userMessage', userMessage);
  formData.append('chatbotMessage', chatbotResponse);

  fetch("saveChatToDB.php", {
    method: 'POST',
    body: formData
  })
    .then(response => response.text())
    .then(data => console.log(data))
    .catch(error => console.error('Error:', error));
}

// Add event listener to the form for sending messages
document.getElementById("input-form").addEventListener("submit", sendMessage);

// Load chat history from PHP on page load
window.onload = loadChatHistoryFromPHP;

/* ====================================================================================================================
================================   CHAT AREA HEIGHT ADJUST   ================================================================
==================================================================================================================== */
document.addEventListener("DOMContentLoaded", function () {
  let textarea = document.querySelector("textarea");
  let form = document.getElementById("input-form");

  // Add an event listener for input event
  textarea.addEventListener("input", function () {
    if (this.value === "") {
      this.style.height = ""; // Reset the height to default when textarea is empty
    } else {
      this.style.height = "auto"; // Temporarily shrink the textarea to auto
      this.style.height = this.scrollHeight + "px"; // Increase the height of the textarea to its scroll height
    }
  });

  // Add an event listener for form submit
  form.addEventListener("submit", function () {
    // Reset the height of the textarea to default
    textarea.style.height = "";
  });
});

/* ====================================================================================================================
================================   ENTER KEY IS SEND   ================================================================
==================================================================================================================== */
document.addEventListener("DOMContentLoaded", function () {
  var messageInput = document.getElementById("message-input");
  var submitButton = document.getElementById("submit-button");

  // Add event listener for Enter key press
  messageInput.addEventListener("keypress", function (event) {
    if (event.key === "Enter" && !event.shiftKey) {
      event.preventDefault(); // Prevent the default submit behavior
      submitButton.click(); // Simulate click on the submit button
    }
  });
});

/* ====================================================================================================================
================================   TOGGLE MORE OPTIONS  ======================================================
==================================================================================================================== */
document.addEventListener("DOMContentLoaded", function () {
  const moreOptions = document.querySelectorAll(".more-options");
  const moreOptionsModal = document.querySelectorAll(".more-options-modal");
  const deleteButton = document.querySelectorAll(".more-options-delete-btn");
  const copyButton = document.querySelectorAll(".more-options-copy-btn");

  moreOptions.forEach((option, index) => {
    option.addEventListener("click", function (event) {
      event.stopPropagation();

      option.classList.toggle("more-options-on");
      moreOptionsModal[index].classList.toggle("more-options-modal-open");
    });

    deleteButton[index].addEventListener("click", function (event) {
      event.stopPropagation();

      option.classList.remove("more-options-on");
      moreOptionsModal[index].classList.remove("more-options-modal-open");
    });

    copyButton[index].addEventListener("click", function (event) {
      event.preventDefault(); // Prevents the form from submitting
      event.stopPropagation();

      const messageBubble = event.target.closest('.message-chatbot, .message-user');
      const message = messageBubble.querySelector('.message-row p');

      var range = document.createRange();
      range.selectNode(message);
      window.getSelection().removeAllRanges();
      window.getSelection().addRange(range);
      document.execCommand('copy');
      window.getSelection().removeAllRanges();
    });
  });

  document.addEventListener("click", function (event) {
    moreOptions.forEach((option, index) => {
      if (!option.contains(event.target) && !moreOptionsModal[index].contains(event.target)) {
        option.classList.remove("more-options-on");
        moreOptionsModal[index].classList.remove("more-options-modal-open");
      }
    });
  });
});

