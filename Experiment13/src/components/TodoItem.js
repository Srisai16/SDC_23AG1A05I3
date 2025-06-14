import React from 'react';

const TodoItem = ({ todo, index, toggleComplete, removeTodo }) => (
  <div style={{ 
    textDecoration: todo.completed ? 'line-through' : '' 
  }}>
    {todo.text}
    <button onClick={() => toggleComplete(index)}>✔️</button>
    <button onClick={() => removeTodo(index)}>❌</button>
  </div>
);

export default TodoItem;
