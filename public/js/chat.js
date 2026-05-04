
document.addEventListener('DOMContentLoaded', function() {
    // Safely get element - returns null if not found
    function getElement(selector) {
        return document.querySelector(selector);
    }

    // Safely get attribute - returns null if element or attribute not found
    function getAttribute(selector, attribute) {
        const element = getElement(selector);
        return element ? element.getAttribute(attribute) : null;
    }

    // Set CSRF token for all AJAX requests if jQuery is available
    if (typeof $ !== 'undefined') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': getAttribute('meta[name="csrf-token"]', 'content')
            }
        });
    } else {
        console.error('jQuery is not loaded. AJAX requests will not work.');
    }

    // Get DOM elements safely
    const messageForm = getElement('#message-form');
    const messageInput = getElement('#message-input');
    const receiverId = getElement('#receiver-id');
    const chatMessages = getElement('#chat-messages');
    
    // Get current user ID from meta tag
    const currentUserId = getAttribute('meta[name="user-id"]', 'content');
    
    console.log('Elements found:', {
        messageForm: !!messageForm,
        messageInput: !!messageInput,
        receiverId: !!receiverId,
        chatMessages: !!chatMessages,
        currentUserId: currentUserId
    });

    // Function to scroll to bottom of chat
    function scrollToBottom() {
        if (chatMessages) {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    }

    // Scroll to bottom on page load if chat messages exist
    if (chatMessages) {
        scrollToBottom();
    }

    // Send message
    if (messageForm && messageInput && receiverId && typeof $ !== 'undefined') {
        messageForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (messageInput.value.trim() === '') {
                return;
            }
            
            console.log('Sending message to:', receiverId.value);
            console.log('CSRF token:', getAttribute('meta[name="csrf-token"]', 'content'));
            
            // Get the form data
            const formData = new FormData();
            formData.append('receiver_id', receiverId.value);
            formData.append('message', messageInput.value);
            formData.append('_token', getAttribute('meta[name="csrf-token"]', 'content'));
            
            // Use fetch instead of jQuery AJAX
            fetch('/messages', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': getAttribute('meta[name="csrf-token"]', 'content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    receiver_id: receiverId.value,
                    message: messageInput.value
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.error || 'Server error');
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log('Message sent successfully:', data);
                
                // Add message to chat
                if (chatMessages) {
                    const messageElement = document.createElement('div');
                    messageElement.className = 'message sent';
                    messageElement.innerHTML = `
                        <div class="message-content">
                            <p>${data.message}</p>
                            <span class="message-time">${formatTime(new Date())}</span>
                        </div>
                    `;
                    chatMessages.appendChild(messageElement);
                    
                    // Clear input
                    messageInput.value = '';
                    
                    // Scroll to bottom
                    scrollToBottom();
                }
            })
            .catch(error => {
                console.error('Error sending message:', error);
                alert('Failed to send message: ' + error.message);
            });
        });
    } else {
        console.error('Required elements for sending messages are missing');
    }

    // Format time
    function formatTime(date) {
        let hours = date.getHours();
        let minutes = date.getMinutes();
        const ampm = hours >= 12 ? 'PM' : 'AM';
        
        hours = hours % 12;
        hours = hours ? hours : 12;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        
        return `${hours}:${minutes} ${ampm}`;
    }

    // Poll for new messages
    let selectedUserId = receiverId ? receiverId.value : null;
    
    function fetchMessages() {
        if (!selectedUserId || !chatMessages || typeof fetch === 'undefined') {
            return;
        }
        
        fetch(`/messages/${selectedUserId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(messages => {
                // Clear existing messages
                chatMessages.innerHTML = '';
                
                // Add messages to chat
                messages.forEach(function(message) {
                    const messageElement = document.createElement('div');
                    messageElement.className = message.sender_id == currentUserId ? 'message sent' : 'message received';
                    messageElement.innerHTML = `
                        <div class="message-content">
                            <p>${message.message}</p>
                            <span class="message-time">${formatTime(new Date(message.created_at))}</span>
                        </div>
                    `;
                    chatMessages.appendChild(messageElement);
                });
                
                // Scroll to bottom
                scrollToBottom();
            })
            .catch(error => {
                console.error('Error fetching messages:', error);
            });
    }

    // Check for unread messages
    function checkUnreadMessages() {
        const unreadBadge = getElement('#unread-badge');
        if (!unreadBadge) {
            return;
        }
        
        fetch('/messages/unread/count')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.unread_count > 0) {
                    unreadBadge.textContent = data.unread_count;
                    unreadBadge.style.display = 'flex';
                } else {
                    unreadBadge.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error checking unread messages:', error);
            });
    }

    // Initial fetch of messages
    if (selectedUserId) {
        fetchMessages();
    }

    // Poll for new messages every 5 seconds
    if (selectedUserId) {
        setInterval(fetchMessages, 5000);
    }
    
    // Check for unread messages every 10 seconds
    setInterval(checkUnreadMessages, 10000);
    
    // Initial check for unread messages
    checkUnreadMessages();
});
