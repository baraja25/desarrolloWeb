document.addEventListener('DOMContentLoaded', () => {
    const taskInput = document.getElementById('taskInput');
    const addTaskButton = document.getElementById('addTaskButton');
    const taskList = document.getElementById('taskList');
    const clearTasksButton = document.getElementById('clearTasksButton');

    
    const loadTasks = () => {
        const tasks = JSON.parse(localStorage.getItem('tasks')) || [];
        taskList.innerHTML = '';
        tasks.forEach((task, index) => {
            const li = document.createElement('li');
            li.textContent = task;
            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Eliminar';
            deleteButton.classList.add('delete');
            deleteButton.addEventListener('click', () => {
                deleteTask(index);
            });
            li.appendChild(deleteButton);
            taskList.appendChild(li);
        });
    };

    
    const addTask = () => {
        const task = taskInput.value.trim();
        if (task) {
            const tasks = JSON.parse(localStorage.getItem('tasks')) || [];
            tasks.push(task);
            localStorage.setItem('tasks', JSON.stringify(tasks));
            taskInput.value = '';
            loadTasks();
        }
    };

    
    const deleteTask = (index) => {
        const tasks = JSON.parse(localStorage.getItem('tasks')) || [];
        tasks.splice(index, 1);
        localStorage.setItem('tasks', JSON.stringify(tasks));
        loadTasks();
    };

    
    const clearTasks = () => {
        localStorage.removeItem('tasks');
        loadTasks();
    };

    addTaskButton.addEventListener('click', addTask);
    clearTasksButton.addEventListener('click', clearTasks);

    loadTasks();
});