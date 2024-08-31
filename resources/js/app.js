import './bootstrap'; // Ensure bootstrap imports Echo and Pusher
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: window.pusherKey,
    cluster: window.pusherCluster,
    forceTLS: true
});

// Listen for the 'task.updated' event on the 'tasks' channel
window.Echo.channel('tasks')
    .listen('.task.updated', (event) => {
        console.log('Task updated:', event.task);
        // Update UI with the new task data
        updateTaskUI(event.task); // Example function to update the UI
    });

// Example function to update the UI
function updateTaskUI(task) {
    // Implement the logic to update the UI with the new task data
    // This might involve updating DOM elements or rerendering components
}
